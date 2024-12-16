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
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social',150);
            $table->integer('tipo_identificacion');
            $table->integer('es_aerolinea');
            $table->integer('es_pssat');
            $table->integer('tipo_solicitante');
            $table->integer('expedido')->nullable();
            $table->integer('estado');
            $table->foreign('estado')->references('id')->on('estado');
            $table->foreign('expedido')->references('id')->on('expedido');
            $table->foreign('tipo_identificacion')->references('id')->on('tipo_identificacion');
            $table->foreign('tipo_solicitante')->references('id')->on('tipo_solicitante');
            $table->string('numero_identificacion',30);
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
        Schema::dropIfExists('cliente');
    }
};
