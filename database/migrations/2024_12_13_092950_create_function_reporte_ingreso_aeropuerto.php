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
        CREATE OR REPLACE FUNCTION public.reporte_ingreso_aeropuerto(
            p_id_aeropuerto integer DEFAULT NULL::integer,
            p_fecha_inicial date DEFAULT NULL::date,
            p_fecha_final date DEFAULT NULL::date)
            RETURNS TABLE(aeropuerto integer, cod_aeropuerto character varying, desc_aeropuerto character varying, total_ingreso numeric) 
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
                SUM(DP.A_PAGAR) AS TOTAL_INGRESO
            FROM DETALLE_PAGO_FACTURA DP
            INNER JOIN FACTURA F ON F.ID = DP.ID_FACTURA
            INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
            WHERE (p_id_aeropuerto IS NULL OR F.AEROPUERTO = p_id_aeropuerto)
            AND (p_fecha_inicial IS NULL OR DP.FECHA_PAGO >= p_fecha_inicial)
            AND (p_fecha_final IS NULL OR DP.FECHA_PAGO <= p_fecha_final)
            GROUP BY F.AEROPUERTO, A.CODIGO, A.DESCRIPCION
            ORDER BY F.AEROPUERTO ASC;
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_ingreso_aeropuerto');
    }
};
