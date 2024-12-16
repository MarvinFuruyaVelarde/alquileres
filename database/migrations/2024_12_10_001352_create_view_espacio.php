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
            CREATE OR REPLACE VIEW public.view_espacio
 AS
 SELECT e.id,
    e.contrato,
    r.descripcion AS rubro,
    e.ubicacion,
    concat('POR UNA CANTIDAD DE ', e.cantidad, ' ', u.descripcion, ' DURANTE ', e.fecha_inicial, ' AL ', e.fecha_final, ' CON UNA GARANTIA DE ', e.garantia, ' CON UN CANON MENSUAL DE ', e.total_canonmensual) AS descripcion,
    e.fecha_inicial,
    e.fecha_final,
    e.total_canonmensual,
    e.glosa_factura,
    e.estado
   FROM espacio e
     JOIN rubro r ON r.id = e.rubro
     JOIN unidad_medida u ON u.id = e.unidad_medida
  ORDER BY e.contrato, e.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_espacio');
    }
};
