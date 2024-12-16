<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE FUNCTION public.dias_a_facturar(
	fecha_inicio_contrato date,
	fecha_fin_contrato date,
	periodo_inicio date,
	periodo_fin date)
    RETURNS integer
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $$
DECLARE
    dias_facturar INT;
    fecha_inicio_facturacion DATE;
    fecha_fin_facturacion DATE;
BEGIN
    -- Determinar la fecha de inicio de facturación como el máximo entre el inicio del contrato y el inicio del periodo de facturación
    fecha_inicio_facturacion := GREATEST(fecha_inicio_contrato, periodo_inicio);
    
    -- Determinar la fecha de fin de facturación como el mínimo entre el fin del contrato y el fin del periodo de facturación
    fecha_fin_facturacion := LEAST(fecha_fin_contrato, periodo_fin);
    
    -- Calcular el número de días si el intervalo es válido (inicio antes o igual al fin)
    IF fecha_inicio_facturacion <= fecha_fin_facturacion THEN
        dias_facturar := fecha_fin_facturacion - fecha_inicio_facturacion + 1;
    ELSE
        dias_facturar := 0; -- No hay días a facturar si el contrato no cubre el periodo
    END IF;
    
    RETURN dias_facturar;
END;
$$;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_dias_a_facturar');
    }
};
