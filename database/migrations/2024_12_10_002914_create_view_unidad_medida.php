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
            CREATE OR REPLACE VIEW public.view_unidad_medida
 AS
 SELECT u.id,
    u.descripcion,
    u.estado,
    es.descripcion AS desc_estado
   FROM unidad_medida u
     JOIN estado es ON u.estado = es.id
  ORDER BY u.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_unidad_medida');
    }
};
