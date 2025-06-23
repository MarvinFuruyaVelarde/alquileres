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
           CREATE OR REPLACE VIEW public.view_garantia
            AS
            SELECT cl.id AS id_cliente,
                   cl.razon_social,
                   c.id AS id_contrato,
                   c.codigo AS contrato,
                   COALESCE(c.garantia, 0::numeric) AS garantia,
                   COALESCE(c.pago_garantia, 0::numeric) AS pagado,
                   COALESCE(c.saldo_garantia, 0::numeric) AS saldo,
                   a.regional
              FROM contrato c
              JOIN cliente cl ON cl.id = c.cliente
             INNER JOIN aeropuerto a on a.id = c.aeropuerto
             WHERE c.saldo_garantia > 0::numeric OR c.garantia = c.pago_garantia
             ORDER BY c.id DESC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_garantia');
    }
};
