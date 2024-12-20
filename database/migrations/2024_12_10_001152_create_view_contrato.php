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
            CREATE OR REPLACE VIEW public.view_contrato
            AS
            SELECT c.id,
                a.codigo AS codigo_aeropuerto,
                c.codigo AS codigo_contrato,
                cl.razon_social AS nombre_cliente,
                c.representante1 AS representante,
                c.numero_documento1 AS nit_ci,
                c.telefono_celular,
                c.correo,
                c.domicilio_legal,
                c.estado,
                e.descripcion AS desc_estado,
                c.deleted_at
            FROM contrato c
                JOIN aeropuerto a ON a.id = c.aeropuerto
                JOIN cliente cl ON cl.id = c.cliente
                JOIN estado e ON e.id = c.estado;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_contrato');
    }
};
