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
       CREATE OR REPLACE VIEW public.view_cliente
 AS
 SELECT c.id,
    c.razon_social,
    c.tipo_identificacion,
    c.numero_identificacion,
    c.es_aerolinea,
    c.es_pssat,
    c.tipo_solicitante,
    c.expedido,
    c.estado,
    t.descripcion AS desc_tipoidentificacion,
        CASE
            WHEN c.es_aerolinea = 0 THEN 'NO'::text
            WHEN c.es_aerolinea = 1 THEN 'SÍ'::text
            ELSE 'DESCONOCIDO'::text
        END AS desc_esaerolinea,
        CASE
            WHEN c.es_pssat = 0 THEN 'NO'::text
            WHEN c.es_pssat = 1 THEN 'SÍ'::text
            ELSE 'DESCONOCIDO'::text
        END AS desc_espssat,
    s.descripcion AS desc_tiposolicitante,
    e.descripcion AS desc_expedido,
    es.descripcion AS desc_estado
   FROM cliente c
     LEFT JOIN tipo_identificacion t ON c.tipo_identificacion = t.id
     LEFT JOIN tipo_solicitante s ON c.tipo_solicitante = s.id
     LEFT JOIN expedido e ON c.expedido = e.id
     LEFT JOIN estado es ON c.estado = es.id
  ORDER BY c.id;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_cliente');
    }
};
