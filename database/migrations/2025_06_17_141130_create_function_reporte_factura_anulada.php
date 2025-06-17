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
        CREATE OR REPLACE FUNCTION public.reporte_factura_anulada(
            p_aeropuerto integer DEFAULT NULL::integer,
            p_cliente integer DEFAULT NULL::integer,
            p_tipo_factura text DEFAULT NULL::text)
            RETURNS TABLE(aeropuerto integer, codigo_aeropuerto character varying, codigo_contrato character varying, numero_nota_cobro character varying, mes text, gestion integer, tipo_factura character varying, razon_social character varying, monto_total numeric, numero_factura bigint, fecha_emision text, updated_by bigint, usuario text, fecha_anulacion text) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT 
                F.AEROPUERTO,
                A.CODIGO,
                F.CODIGO_CONTRATO,
                F.NUMERO_NOTA_COBRO,
                UPPER(TO_CHAR(TO_DATE(F.MES::TEXT, 'MM'), 'TMMonth')) AS MES,
                F.GESTION,
                F.TIPO_FACTURA,
                F.RAZON_SOCIAL_FACTURA,
                F.MONTO_TOTAL,
                F.NUMERO_FACTURA,
                TO_CHAR(DATE(F.FECHA_EMISION), 'DD/MM/YYYY') AS FECHA_EMISION,
                F.UPDATED_BY,
                U.NAME || ' ' || U.APELLIDO_PATERNO || ' ' || U.APELLIDO_MATERNO AS USUARIO,
                TO_CHAR(DATE(F.UPDATED_AT), 'DD/MM/YYYY') AS FECHA_ANULACION
            FROM FACTURA F
            INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
            INNER JOIN USERS U ON U.ID = F.UPDATED_BY
            WHERE F.ESTADO = 7
            AND (p_aeropuerto IS NULL OR F.AEROPUERTO = p_aeropuerto)
            AND (p_cliente IS NULL OR F.CLIENTE = p_cliente)
            AND (p_tipo_factura IS NULL OR F.TIPO_FACTURA = p_tipo_factura)
            ORDER BY F.ID DESC;
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_factura_anulada');
    }
};
