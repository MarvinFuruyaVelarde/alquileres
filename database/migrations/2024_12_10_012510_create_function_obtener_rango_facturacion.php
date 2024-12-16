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
            CREATE OR REPLACE FUNCTION public.obtener_rango_facturacion(
	p_mes integer,
	p_anio integer,
	p_fecha_inicio_contrato date,
	p_fecha_fin_contrato date)
    RETURNS TABLE(fecha_inicio date, fecha_fin date) 
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    -- Definir el primer y último día del mes de facturación
    fecha_inicio := GREATEST(DATE_TRUNC('month', make_date(p_anio, p_mes, 1))::DATE, p_fecha_inicio_contrato);
    fecha_fin := LEAST((DATE_TRUNC('month', make_date(p_anio, p_mes, 1)) + INTERVAL '1 month - 1 day')::DATE, p_fecha_fin_contrato);

    -- Comprobar si el rango de fechas es válido
    IF fecha_fin >= fecha_inicio THEN
        RETURN QUERY SELECT fecha_inicio, fecha_fin;
    END IF;
END;
$$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_obtener_rango_facturacion');
    }
};
