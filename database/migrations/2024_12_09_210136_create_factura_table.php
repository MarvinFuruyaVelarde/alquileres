<?php

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
        Schema::create('factura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aeropuerto');
            $table->integer('contrato')->nullable();
            $table->string('codigo_contrato',50)->nullable();
            $table->string('numero_nota_cobro',250);
            $table->integer('orden_impresion');
            $table->integer('mes');
            $table->integer('gestion');
            $table->integer('tipo_solicitante');
            $table->string('ci',50)->nullable();
            $table->string('nit',50)->nullable();
            $table->string('tipo_canon');
            $table->integer('forma_pago');
            $table->string('tipo_factura',25);
            $table->integer('cliente');
            $table->string('razon_social_factura',250);
            $table->decimal('monto_total', 12, 2)->nullable();
            $table->string('tipo_generacion');
            $table->text('url_documento')->nullable();
            $table->bigInteger('id_documento')->nullable();
            $table->integer('tipo_emision')->nullable();
            $table->string('tipo_emision_descripcion')->nullable();
            $table->string('cuf', 100)->nullable();
            $table->string('cufd', 100)->nullable();
            $table->string('cuis', 100)->nullable();
            $table->bigInteger('numero_factura')->nullable();
            $table->date('fecha_emision')->nullable();
            $table->string('estado_documento_fiscal', 100)->nullable();
            $table->string('codigo_recepcion_sin', 100)->nullable();
            $table->string('codigo_integracion', 100)->nullable();
            $table->text('urlsin')->nullable();
            $table->integer('estado');
            $table->integer('usuario_registro');
            $table->timestamp('fecha_registro');
            $table->integer('usuario_actualizacion')->nullable();
            $table->timestamp('fecha_actualizacion')->nullable();
            $table->foreign('aeropuerto')->references('id')->on('aeropuerto');
            $table->foreign('tipo_solicitante')->references('id')->on('tipo_solicitante');
            $table->foreign('cliente')->references('id')->on('cliente');
            $table->foreign('estado')->references('id')->on('estado');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura');
    }
};
