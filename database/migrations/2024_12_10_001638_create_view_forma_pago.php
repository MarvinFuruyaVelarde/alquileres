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
        CREATE OR REPLACE VIEW public.view_forma_pago
        AS
        SELECT f.id,
               f.descripcion,
               f.numero_dia,
               f.numero_mes,
               f.estado,
               es.descripcion AS desc_estado,
               f.deleted_at
          FROM forma_pago f
          JOIN estado es ON f.estado = es.id
         ORDER BY f.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_forma_pago');
    }
};
