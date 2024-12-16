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
        Schema::create('espacio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrato');
            $table->string('tipo_canon');
            $table->integer('rubro');
            $table->string('ubicacion',150);
            $table->decimal('cantidad');
            $table->integer('unidad_medida');
            $table->decimal('precio_unitario');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->decimal('total_canonmensual');
            $table->decimal('opcion_dcto')->nullable();
            $table->decimal('canon_dcto')->nullable();
            $table->decimal('garantia')->nullable();
            $table->string('cobro_expensa');
            $table->integer('forma_pago');
            $table->integer('numero_dia')->nullable();
            $table->string('objeto_contrato',300)->nullable();
            $table->string('glosa_factura',300)->nullable();
            $table->string('tipo_espacio');
            $table->integer('estado');
            $table->foreign('contrato')->references('id')->on('contrato');
            $table->foreign('rubro')->references('id')->on('rubro');
            $table->foreign('unidad_medida')->references('id')->on('unidad_medida');
            $table->foreign('forma_pago')->references('id')->on('forma_pago');
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
        Schema::dropIfExists('espacio');
    }
};
