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
            CREATE OR REPLACE VIEW public.view_cuenta
            AS
            SELECT t.id,
                t.descripcion,
                t.numero_cuenta,
                t.moneda,
                t.estado,
                m.descripcion AS desc_moneda,
                es.descripcion AS desc_estado,
                t.deleted_at
            FROM cuenta t
                LEFT JOIN moneda m ON t.moneda = m.id
                JOIN estado es ON t.estado = es.id
            ORDER BY t.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_cuenta');
    }
};
