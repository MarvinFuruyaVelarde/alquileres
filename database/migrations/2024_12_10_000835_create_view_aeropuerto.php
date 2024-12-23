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
            CREATE OR REPLACE VIEW public.view_aeropuerto
            AS
            SELECT a.id,
                a.codigo,
                a.descripcion,
                a.regional,
                a.estado,
                r.descripcion AS desc_regional,
                es.descripcion AS desc_estado,
                a.deleted_at
            FROM aeropuerto a
                JOIN regional r ON a.regional = r.id
                JOIN estado es ON a.estado = es.id
            ORDER BY a.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_aeropuerto');
    }
};
