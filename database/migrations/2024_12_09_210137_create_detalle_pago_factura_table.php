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
        Schema::create('detalle_pago_factura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_factura')->nullable();
            $table->decimal('a_pagar', 12, 2)->nullable();
            $table->decimal('saldo', 12, 2)->nullable();
            $table->date('fecha_pago')->nullable();
            $table->integer('cuenta')->nullable();
            $table->date('fecha_deposito')->nullable();
            $table->integer('numero_registro_deposito')->nullable();
            $table->integer('numero_registro_cobro')->nullable();
            $table->text('observacion')->nullable();
            $table->foreign('id_factura')->references('id')->on('factura');
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
        Schema::dropIfExists('detalle_pago_factura');
    }
};
