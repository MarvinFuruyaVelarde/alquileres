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
        CREATE OR REPLACE FUNCTION public.reporte_resumen_contrato(
            p_id_regional integer DEFAULT NULL::integer,
            p_id_aeropuerto integer DEFAULT NULL::integer,
            p_gestion_inicial integer DEFAULT NULL::integer,
            p_mes_inicial integer DEFAULT NULL::integer,
            p_gestion_final integer DEFAULT NULL::integer,
            p_mes_final integer DEFAULT NULL::integer)
            RETURNS TABLE(regional character varying, cod_aeropuerto character varying, numero_contratos bigint, total numeric, estado text) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT R.CODIGO AS regional,
                   A.CODIGO AS cod_aeropuerto,
                   COUNT(C.ID) AS numero_contratos,
                   SUM(COALESCE(FS.monto_total, 0)) AS total,
                   'GENERADO' AS estado
              FROM CONTRATO C
			 INNER JOIN AEROPUERTO A ON A.ID = C.AEROPUERTO
			 INNER JOIN REGIONAL R ON R.ID = A.REGIONAL
			  LEFT JOIN (SELECT F.CONTRATO, SUM(F.MONTO_TOTAL) AS monto_total
			     		   FROM FACTURA F
				          WHERE F.ESTADO = 8
				          	AND TIPO_FACTURA = 'AL'
				           	AND ((F.GESTION || TO_CHAR(F.MES, 'FM00'))::INTEGER BETWEEN 
				   			   	(p_gestion_inicial || TO_CHAR(p_mes_inicial, 'FM00'))::INTEGER AND
				   			   	(p_gestion_final || TO_CHAR(p_mes_final, 'FM00'))::INTEGER)
			      		  GROUP BY F.CONTRATO) FS ON FS.CONTRATO = C.ID
			 WHERE ((p_id_regional IS NULL) OR (R.ID = p_id_regional))
			   AND ((p_id_aeropuerto IS NULL) OR (A.ID = p_id_aeropuerto))
		     GROUP BY R.CODIGO, A.CODIGO
			 ORDER BY R.CODIGO ASC, A.CODIGO ASC;
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_resumen_contrato');
    }
};
