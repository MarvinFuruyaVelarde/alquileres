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
        Schema::create('factura_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura');
            $table->integer('espacio')->nullable();
            $table->integer('expensa')->nullable();
            $table->string('glosa',300)->nullable();
            $table->string('concepto',50)->nullable();
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->integer('dias_facturados')->nullable();
            $table->decimal('total_canonmensual', 12, 2)->nullable();
            $table->decimal('precio', 12, 2)->nullable();
            $table->integer('usuario_registro')->nullable();
            $table->timestamp('fecha_registro')->nullable();
            $table->integer('usuario_actualizacion')->nullable();
            $table->timestamp('fecha_actualizacion')->nullable();
            $table->foreign('factura')->references('id')->on('factura');
            $table->foreign('espacio')->references('id')->on('espacio');
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
        Schema::dropIfExists('factura_detalle');
    }
};
