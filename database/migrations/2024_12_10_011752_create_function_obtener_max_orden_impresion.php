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
           CREATE OR REPLACE FUNCTION public.obtener_max_orden_impresion(
	p_tipo_factura character varying,
	p_mes integer,
	p_gestion integer)
    RETURNS integer
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $$
DECLARE
    max_orden INT;
BEGIN
    SELECT COALESCE(MAX(orden_impresion) + 1, 1)
      INTO max_orden
      FROM factura
     WHERE tipo_factura = p_tipo_factura
       AND mes = p_mes
       AND gestion = p_gestion;

    RETURN max_orden;
END;
$$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_obtener_max_orden_impresion');
    }
};
