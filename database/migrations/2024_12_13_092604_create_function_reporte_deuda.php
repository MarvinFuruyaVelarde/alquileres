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
        CREATE OR REPLACE FUNCTION public.reporte_deuda(
            p_id_aeropuerto integer DEFAULT NULL::integer,
            p_id_cliente integer DEFAULT NULL::integer,
            p_fecha_inicial date DEFAULT NULL::date,
            p_fecha_final date DEFAULT NULL::date)
            RETURNS TABLE(aeropuerto integer, cod_aeropuerto character varying, desc_aeropuerto character varying, cliente character varying, total_facturado numeric, total_pagado numeric, total_deuda numeric) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT F.AEROPUERTO,
                A.CODIGO AS COD_AEROPUERTO,
                A.DESCRIPCION AS DESC_AEROPUERTO,
                CL.RAZON_SOCIAL AS CLIENTE,
                COALESCE(SUM(F.MONTO_TOTAL), 0) AS TOTAL_FACTURADO,
                COALESCE(P.PAGADO, 0) AS TOTAL_PAGADO,
                COALESCE(SUM(F.MONTO_TOTAL), 0) - COALESCE(P.PAGADO, 0) AS TOTAL_DEUDA
            FROM FACTURA F
            INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
            INNER JOIN CLIENTE CL ON CL.ID = F.CLIENTE
            LEFT JOIN (SELECT F.AEROPUERTO, 
                                F.CLIENTE, 
                                SUM(DP.A_PAGAR) AS PAGADO       
                        FROM DETALLE_PAGO_FACTURA DP
                        INNER JOIN FACTURA F ON F.ID = DP.ID_FACTURA
                        WHERE (p_id_aeropuerto IS NULL OR F.AEROPUERTO = p_id_aeropuerto)
                            AND (p_id_cliente IS NULL OR F.CLIENTE = p_id_cliente)
                            AND (p_fecha_inicial IS NULL OR DP.FECHA_PAGO >= p_fecha_inicial)
                            AND (p_fecha_final IS NULL OR DP.FECHA_PAGO <= p_fecha_final)
                        GROUP BY F.AEROPUERTO, F.CLIENTE
                        ) P ON F.AEROPUERTO = P.AEROPUERTO AND F.CLIENTE = P.CLIENTE  
            WHERE (p_id_aeropuerto IS NULL OR F.AEROPUERTO = p_id_aeropuerto)
            AND (p_id_cliente IS NULL OR F.CLIENTE = p_id_cliente)
            AND (p_fecha_inicial IS NULL OR F.FECHA_EMISION >= p_fecha_inicial)
            AND (p_fecha_final IS NULL OR F.FECHA_EMISION <= p_fecha_final)
            AND F.ESTADO = 8
            GROUP BY F.AEROPUERTO, A.CODIGO, A.DESCRIPCION, F.CLIENTE, CL.RAZON_SOCIAL, P.PAGADO
            ORDER BY F.AEROPUERTO, CL.RAZON_SOCIAL;
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_deuda');
    }
};
