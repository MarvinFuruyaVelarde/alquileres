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
       CREATE OR REPLACE FUNCTION public.reporte_factura(
	p_gestion integer DEFAULT NULL::integer,
	p_mes integer DEFAULT NULL::integer)
    RETURNS TABLE(cliente integer, razon_social character varying, mes integer, mes_literal text, gestion integer, numero_nota_cobro integer, numero_factura bigint) 
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    RETURN QUERY
    SELECT F.CLIENTE,
           CL.RAZON_SOCIAL,
           F.MES,
			UPPER(TO_CHAR(TO_DATE(F.MES::TEXT, 'MM'), 'TMMonth')) AS MES_LITERAL,
           F.GESTION,
           F.ORDEN_IMPRESION AS NUMERO_NOTA_COBRO,
           F.NUMERO_FACTURA
      FROM FACTURA F
     INNER JOIN CLIENTE CL ON CL.ID = F.CLIENTE
     WHERE (p_gestion IS NULL OR F.GESTION = p_gestion)
       AND (p_mes IS NULL OR F.MES = p_mes)
     ORDER BY CL.RAZON_SOCIAL;
END;
$$;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_factura');
    }
};
