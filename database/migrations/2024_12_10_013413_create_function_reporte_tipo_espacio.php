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
           CREATE OR REPLACE FUNCTION public.reporte_tipo_espacio(
	p_aeropuerto integer DEFAULT NULL::integer,
	p_cliente integer DEFAULT NULL::integer,
	p_tipo_espacio character DEFAULT NULL::bpchar)
    RETURNS TABLE(cod_aeropuerto character varying, cliente character varying, tipo_espacio text, rubro character varying, objeto_contrato character varying, canon_mensual numeric, fecha_inicial text, fecha_final text, codigo_contrato character varying)
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    RETURN QUERY
    SELECT A.CODIGO AS cod_aeropuerto,
           CL.RAZON_SOCIAL AS cliente,
           CASE 
               WHEN E.TIPO_ESPACIO = 'P' THEN 'PUBLICITARIO'
               WHEN E.TIPO_ESPACIO = 'C' THEN 'COMERCIAL'
               ELSE 'OTRO'
           END AS tipo_espacio,
           R.DESCRIPCION AS rubro,
           E.OBJETO_CONTRATO,
           E.TOTAL_CANONMENSUAL AS canon_mensual,
           TO_CHAR(E.FECHA_INICIAL, 'DD/MM/YYYY') AS FECHA_INICIAL,
           TO_CHAR(E.FECHA_FINAL, 'DD/MM/YYYY') AS FECHA_FINAL,
           C.CODIGO AS codigo_contrato
      FROM ESPACIO E
     INNER JOIN CONTRATO C ON C.ID = E.CONTRATO
     INNER JOIN RUBRO R ON R.ID = E.RUBRO
     INNER JOIN CLIENTE CL ON CL.ID = C.CLIENTE
     INNER JOIN AEROPUERTO A ON A.ID = C.AEROPUERTO
     WHERE (p_aeropuerto IS NULL OR A.ID = p_aeropuerto) AND
           (p_cliente IS NULL OR CL.ID = p_cliente) AND
           (p_tipo_espacio IS NULL OR E.TIPO_ESPACIO = p_tipo_espacio)
     ORDER BY CL.RAZON_SOCIAL ASC, E.TIPO_ESPACIO ASC;
END;
$$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_tipo_espacio');
    }
};
