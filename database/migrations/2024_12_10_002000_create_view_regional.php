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
            CREATE OR REPLACE VIEW public.view_regional
            AS
            SELECT r.id,
                r.codigo,
                r.descripcion,
                r.estado,
                es.descripcion AS desc_estado,
                r.deleted_at
            FROM regional r
            JOIN estado es ON r.estado = es.id
            ORDER BY r.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_regional');
    }
};
