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
        Schema::create('contrato_cancelado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrato')->nullable();
            $table->string('objetivo');
            $table->string('motivo',300);
            $table->string('ruta_documento',300);
            $table->string('codigo_nuevo')->nullable();
            $table->string('codigo_anterior')->nullable();
            $table->foreign('contrato')->references('id')->on('contrato');
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
        Schema::dropIfExists('contrato_cancelado');
    }
};
