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
        CREATE OR REPLACE FUNCTION public.reporte_cuenta_por_cobrar(
            p_id_aeropuerto integer DEFAULT NULL::integer,
            p_id_cliente integer DEFAULT NULL::integer,
            p_fecha_inicial date DEFAULT NULL::date,
            p_fecha_final date DEFAULT NULL::date)
            RETURNS TABLE(id_factura integer, id_aeropuerto integer, cod_aeropuerto character varying, id_cliente integer, cliente character varying, ci character varying, nit character varying, gestion integer, mes integer, fecha_nota_cobro date, numero_nota_cobro integer, fecha_emision_factura date, numero_factura bigint, tipo character varying, monto_facturado numeric, monto_pagado numeric, saldo numeric) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000
        AS $$
        BEGIN
            RETURN QUERY
            SELECT F.ID AS ID_FACTURA,
                F.AEROPUERTO AS id_aeropuerto,
                A.CODIGO AS cod_aeropuerto,
                F.CLIENTE AS id_cliente,
                CL.RAZON_SOCIAL AS cliente,
                F.CI,
                F.NIT,
                F.GESTION,
                F.MES,
                DATE(F.FECHA_REGISTRO) AS fecha_nota_cobro,
                F.ORDEN_IMPRESION AS numero_nota_cobro,
                F.FECHA_EMISION AS fecha_emision_factura,
                F.NUMERO_FACTURA,
                F.TIPO_FACTURA AS tipo,
                F.MONTO_TOTAL AS monto_facturado,
                COALESCE(SUM(DP.A_PAGAR), 0) AS monto_pagado,
                F.MONTO_TOTAL - COALESCE(SUM(DP.A_PAGAR), 0) AS saldo
            FROM FACTURA F
            INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
            INNER JOIN CLIENTE CL ON CL.ID = F.CLIENTE
            LEFT JOIN DETALLE_PAGO_FACTURA DP ON DP.ID_FACTURA = F.ID
            WHERE (p_id_aeropuerto IS NULL OR F.AEROPUERTO = p_id_aeropuerto)
            AND (p_id_cliente IS NULL OR F.CLIENTE = p_id_cliente)  
            AND (p_fecha_inicial IS NULL OR F.FECHA_EMISION >= p_fecha_inicial)
            AND (p_fecha_final IS NULL OR F.FECHA_EMISION <= p_fecha_final)
            AND F.ESTADO = 8
            GROUP BY F.ID, A.ID, F.AEROPUERTO, A.CODIGO, F.CLIENTE, CL.RAZON_SOCIAL, F.CI, F.NIT, F.GESTION, F.MES, F.FECHA_REGISTRO, F.ORDEN_IMPRESION, F.FECHA_EMISION, F.NUMERO_FACTURA, F.TIPO_FACTURA, F.MONTO_TOTAL
            ORDER BY A.ID ASC, CL.RAZON_SOCIAL ASC;
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_cuenta_por_cobrar');
    }
};
