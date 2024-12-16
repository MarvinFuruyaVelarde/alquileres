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
        Schema::create('garantia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrato');
            $table->decimal('a_pagar',12,2);
            $table->decimal('saldo',12,2);
            $table->date('fecha_pago');
            $table->unsignedBigInteger('cuenta');
            $table->bigInteger('numero_cuenta')->nullable();
            $table->date('fecha_deposito')->nullable();
            $table->foreign('contrato')->references('id')->on('contrato');
            $table->foreign('cuenta')->references('id')->on('cuenta');
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
        Schema::dropIfExists('garantia');
    }
};
