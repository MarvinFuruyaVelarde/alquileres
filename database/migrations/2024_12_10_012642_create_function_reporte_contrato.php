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
        CREATE OR REPLACE FUNCTION public.reporte_contrato(
            p_aeropuerto integer DEFAULT NULL::integer,
            p_tipo_solicitante integer DEFAULT NULL::integer,
            p_cliente integer DEFAULT NULL::integer,
            p_identificacion text DEFAULT NULL::text,
            p_estado integer DEFAULT NULL::integer)
            RETURNS TABLE(codigo character varying, aeropuerto integer, cod_aeropuerto character varying, cliente integer, cliente_nombre character varying, representante character varying, tipo_solicitante integer, desc_tipo_solicitante character varying, ci character varying, nit character varying, domicilio_legal character varying, telefono_celular character varying, correo character varying, estado integer, desc_estado character varying, canon_total numeric) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT C.CODIGO,
                   C.AEROPUERTO,
                   A.CODIGO AS COD_AEROPUERTO,
                   C.CLIENTE,
                   CL.RAZON_SOCIAL AS CLIENTE,
                   C.REPRESENTANTE1 AS REPRESENTANTE,
                   C.TIPO_SOLICITANTE,
                   TS.DESCRIPCION AS DESC_TIPO_SOLICITANTE,
                   C.CI,
                   C.NIT,
                   C.DOMICILIO_LEGAL,
                   C.TELEFONO_CELULAR,
                   C.CORREO,
                   C.ESTADO,
                   E.DESCRIPCION AS DESC_ESTADO,
	               COALESCE(SUM(ES.TOTAL_CANONMENSUAL), 0) AS CANON_TOTAL
              FROM CONTRATO C
             INNER JOIN AEROPUERTO A ON A.ID = C.AEROPUERTO
             INNER JOIN CLIENTE CL ON CL.ID = C.CLIENTE
             INNER JOIN TIPO_SOLICITANTE TS ON TS.ID = C.TIPO_SOLICITANTE
             INNER JOIN ESTADO E ON E.ID = C.ESTADO
              LEFT JOIN ESPACIO ES ON ES.CONTRATO = C.ID
             WHERE (p_aeropuerto IS NULL OR C.AEROPUERTO = p_aeropuerto)
               AND (p_tipo_solicitante IS NULL OR C.TIPO_SOLICITANTE = p_tipo_solicitante)
               AND (p_cliente IS NULL OR C.CLIENTE = p_cliente)
               AND (p_identificacion IS NULL 
                    OR (C.CI ILIKE '%' || p_identificacion || '%') 
                    OR (C.NIT ILIKE '%' || p_identificacion || '%' AND C.NIT IS NOT NULL))
               AND (p_estado IS NULL OR C.ESTADO = p_estado)
             GROUP BY C.ID, C.CODIGO, C.AEROPUERTO, A.CODIGO, C.CLIENTE, CL.RAZON_SOCIAL, C.REPRESENTANTE1, C.TIPO_SOLICITANTE, TS.DESCRIPCION,
                   C.CI, C.NIT, C.DOMICILIO_LEGAL, C.TELEFONO_CELULAR, C.CORREO, C.ESTADO, E.DESCRIPCION;
        END;
        $$;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_contrato');
    }
};
