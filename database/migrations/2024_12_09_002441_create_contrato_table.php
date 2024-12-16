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
        Schema::create('contrato', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',50);
            $table->integer('aeropuerto');
            $table->dateTime('fecha_hora_registro');
            $table->integer('tipo_solicitante');
            $table->integer('cliente');
            $table->string('ci',30)->nullable();
            $table->string('nit',30)->nullable();
            $table->string('domicilio_legal',150);
            $table->string('telefono_celular',10);
            $table->string('correo',50);
            $table->string('actividad_principal',50);
            $table->string('matricula_comercio',50)->nullable();
            $table->decimal('garantia',13, 2)->nullable();
            $table->decimal('saldo_garantia',13, 2)->nullable();
            $table->decimal('pago_garantia',13, 2)->nullable();
            $table->integer('estado');
            $table->string('representante1',150);
            $table->string('numero_documento1',30);
            $table->integer('expedido1')->nullable();
            $table->string('documento_designacion1',30)->nullable();
            $table->date('fecha_emision_documento1')->nullable();
            $table->string('notaria1',50)->nullable();
            $table->string('notario1',150)->nullable();
            $table->string('representante2',150)->nullable();
            $table->string('numero_documento2',30)->nullable();
            $table->integer('expedido2')->nullable();
            $table->string('documento_designacion2',30)->nullable();
            $table->date('fecha_emision_documento2')->nullable();
            $table->string('notaria2',50)->nullable();
            $table->string('notario2',150)->nullable();
            $table->string('representante3',150)->nullable();
            $table->string('numero_documento3',30)->nullable();
            $table->integer('expedido3')->nullable();
            $table->string('documento_designacion3',30)->nullable();
            $table->date('fecha_emision_documento3')->nullable();
            $table->string('notaria3')->nullable();
            $table->string('notario3')->nullable();
            $table->string('plantilla')->nullable();
            $table->foreign('aeropuerto')->references('id')->on('aeropuerto');
            $table->foreign('tipo_solicitante')->references('id')->on('tipo_solicitante');
            $table->foreign('cliente')->references('id')->on('cliente');
            $table->foreign('expedido1')->references('id')->on('expedido');
            $table->foreign('expedido2')->references('id')->on('expedido');
            $table->foreign('expedido3')->references('id')->on('expedido');
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
        Schema::dropIfExists('contrato');
    }
};
