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
            CREATE OR REPLACE VIEW public.view_nota_cobro_manual
            AS
            SELECT f.id,
                   f.numero_nota_cobro,
                   f.cliente,
                   cl.razon_social,
                   CASE
                    WHEN f.tipo_canon::text = 'F'::text AND f.tipo_factura::text = 'AL'::text THEN 'ALQUILER'::text
                    ELSE 'COMPRA VENTA'::text
                   END AS tipo,
                   a.regional
              FROM factura f
              JOIN cliente cl ON cl.id = f.cliente
              JOIN aeropuerto a ON a.id = f.aeropuerto
             WHERE f.estado = 3 AND f.tipo_generacion::text = 'M'::text
             ORDER BY f.id DESC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_nota_cobro_manual');
    }
};
