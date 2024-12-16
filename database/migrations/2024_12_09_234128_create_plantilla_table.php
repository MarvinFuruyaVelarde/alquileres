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
        Schema::create('plantilla', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente')->nullable();
            $table->integer('contrato')->nullable();
            $table->integer('numero_nota')->nullable();
            $table->integer('numero')->nullable();
            $table->integer('espacio')->nullable();
            $table->date('fecha')->nullable();
            $table->foreign('cliente')->references('id')->on('cliente');
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
        Schema::dropIfExists('plantilla');
    }
};
