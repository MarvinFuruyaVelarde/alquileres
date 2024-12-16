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
        Schema::create('espacio_expensa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('espacio')->nullable();
            $table->integer('expensa')->nullable();
            $table->string('tarifa_fija');
            $table->decimal('monto')->nullable();
            $table->foreign('espacio')->references('id')->on('espacio');
            $table->foreign('expensa')->references('id')->on('expensa');
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
        Schema::dropIfExists('espacio_expensa');
    }
};
