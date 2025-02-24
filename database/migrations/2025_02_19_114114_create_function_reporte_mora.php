<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE FUNCTION public.reporte_mora(
            p_id_aeropuerto integer DEFAULT NULL::integer,
            p_id_cliente integer DEFAULT NULL::integer)
            RETURNS TABLE(codigo character varying, cliente character varying, tipo_factura character varying, numero_factura bigint, fecha_max_pago text, fecha_actual date, dia_mora integer, monto_a_pagar numeric, monto_pagado numeric, saldo numeric, mora numeric) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT A.CODIGO,
                C.RAZON_SOCIAL AS CLIENTE,
                F.TIPO_FACTURA,
                F.NUMERO_FACTURA,
                TO_CHAR(((TO_DATE(F.gestion || '-' || F.mes || '-01', 'YYYY-MM-DD') + INTERVAL '1 MONTH')::DATE + INTERVAL '9 DAYS')::DATE, 'DD/MM/YYY') AS FECHA_MAX_PAGO,
                CURRENT_DATE AS FECHA_ACTUAL,
                CURRENT_DATE - ((TO_DATE(F.gestion || '-' || F.mes || '-01', 'YYYY-MM-DD') + INTERVAL '1 MONTH')::DATE + INTERVAL '9 DAYS')::DATE AS DIA_MORA,
                F.MONTO_TOTAL AS MONTO_A_PAGAR,
                COALESCE(SUM(DP.A_PAGAR), 0) AS MONTO_PAGADO,
                F.MONTO_TOTAL - COALESCE(SUM(DP.A_PAGAR), 0) AS SALDO,
                ROUND(((F.MONTO_TOTAL - COALESCE(SUM(DP.A_PAGAR), 0)) * 0.03 / 30) * (CURRENT_DATE - ((TO_DATE(F.gestion || '-' || F.mes || '-01', 'YYYY-MM-DD') + INTERVAL '1 MONTH')::DATE + INTERVAL '9 DAYS')::DATE), 2) AS MORA
            FROM FACTURA F
            LEFT JOIN DETALLE_PAGO_FACTURA DP ON DP.ID_FACTURA = F.ID
            INNER JOIN CLIENTE C ON C.ID = F.CLIENTE
            INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
            GROUP BY F.ID, F.AEROPUERTO, F.CLIENTE, F.MONTO_TOTAL, A.CODIGO, C.RAZON_SOCIAL
            HAVING F.MONTO_TOTAL - COALESCE(SUM(DP.A_PAGAR), 0) > 0 
            AND CURRENT_DATE - ((TO_DATE(F.gestion || '-' || F.mes || '-01', 'YYYY-MM-DD') + INTERVAL '1 MONTH')::DATE + INTERVAL '9 DAYS')::DATE > 0
            AND F.TIPO_FACTURA IN ('AL')
            AND (p_id_aeropuerto IS NULL OR F.AEROPUERTO = p_id_aeropuerto)
            AND (p_id_cliente IS NULL OR F.CLIENTE = p_id_cliente)
            ORDER BY F.ID;
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_mora');
    }
};
