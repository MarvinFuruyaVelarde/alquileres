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
        CREATE OR REPLACE FUNCTION public.reporte_ingreso_deuda(
            p_id_regional integer DEFAULT NULL::integer,
            p_id_aeropuerto integer DEFAULT NULL::integer,
            p_fecha_inicial date DEFAULT NULL::date,
            p_fecha_final date DEFAULT NULL::date)
            RETURNS TABLE(regional integer, cod_regional character varying, aeropuerto integer, cod_aeropuerto character varying, total_facturado numeric, total_pagado numeric, total_deuda numeric) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT A.REGIONAL,
                R.CODIGO AS COD_REGIONAL,
                F.AEROPUERTO,
                A.CODIGO AS COD_AEROPUERTO,
                COALESCE(SUM(F.MONTO_TOTAL), 0) AS TOTAL_FACTURADO,
                COALESCE(P.PAGADO, 0) AS TOTAL_PAGADO,
                COALESCE(SUM(F.MONTO_TOTAL), 0) - COALESCE(P.PAGADO, 0) AS TOTAL_DEUDA
            FROM FACTURA F
            INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
            INNER JOIN REGIONAL R ON R.ID = A.REGIONAL
            LEFT JOIN ( SELECT A.REGIONAL,
                                F.AEROPUERTO, 
                                SUM(DP.A_PAGAR) AS PAGADO
                            FROM DETALLE_PAGO_FACTURA DP
                        INNER JOIN FACTURA F ON F.ID = DP.ID_FACTURA
                        INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
                        WHERE (p_id_regional IS NULL OR A.REGIONAL = p_id_regional)
                            AND (p_id_aeropuerto IS NULL OR F.AEROPUERTO = p_id_aeropuerto)
                            AND (p_fecha_inicial IS NULL OR DP.FECHA_PAGO >= p_fecha_inicial)
                            AND (p_fecha_final IS NULL OR DP.FECHA_PAGO <= p_fecha_final) 
                        GROUP BY A.REGIONAL, F.AEROPUERTO
                        ) P ON F.AEROPUERTO = P.AEROPUERTO AND A.REGIONAL = P.REGIONAL 
            WHERE (p_id_regional IS NULL OR A.REGIONAL = p_id_regional)
            AND (p_id_aeropuerto IS NULL OR F.AEROPUERTO = p_id_aeropuerto)
            AND (p_fecha_inicial IS NULL OR F.FECHA_EMISION >= p_fecha_inicial)
            AND (p_fecha_final IS NULL OR F.FECHA_EMISION <= p_fecha_final)
            AND F.ESTADO = 8
            GROUP BY A.REGIONAL, R.CODIGO, F.AEROPUERTO, A.CODIGO, P.PAGADO
            ORDER BY A.REGIONAL ASC, F.AEROPUERTO ASC;
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_ingreso_deuda');
    }
};
