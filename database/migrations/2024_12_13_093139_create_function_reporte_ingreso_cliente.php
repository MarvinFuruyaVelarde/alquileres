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
        CREATE OR REPLACE FUNCTION public.reporte_ingreso_cliente(
            p_id_aeropuerto integer DEFAULT NULL::integer,
            p_id_cliente integer DEFAULT NULL::integer,
            p_fecha_inicial date DEFAULT NULL::date,
            p_fecha_final date DEFAULT NULL::date)
            RETURNS TABLE(cod_aeropuerto character varying, desc_aeropuerto character varying, cliente character varying, total_ingreso numeric) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT A.CODIGO AS COD_AEROPUERTO,
                A.DESCRIPCION AS DESC_AEROPUERTO,
                CL.RAZON_SOCIAL AS CLIENTE,
                SUM(DP.A_PAGAR) AS TOTAL_INGRESO
            FROM DETALLE_PAGO_FACTURA DP
            INNER JOIN FACTURA F ON F.ID = DP.ID_FACTURA
            INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
            INNER JOIN CLIENTE CL ON CL.ID = F.CLIENTE
            WHERE (p_id_aeropuerto IS NULL OR F.AEROPUERTO = p_id_aeropuerto)
            AND (p_id_cliente IS NULL OR CL.ID = p_id_cliente)
            AND ((p_fecha_inicial IS NULL AND p_fecha_final IS NULL) OR
                (DP.FECHA_PAGO BETWEEN COALESCE(p_fecha_inicial, DP.FECHA_PAGO) AND COALESCE(p_fecha_final, DP.FECHA_PAGO)))
            GROUP BY F.AEROPUERTO, A.CODIGO, A.DESCRIPCION, CL.RAZON_SOCIAL
            ORDER BY F.AEROPUERTO ASC, CL.RAZON_SOCIAL ASC; 
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_ingreso_cliente');
    }
};
