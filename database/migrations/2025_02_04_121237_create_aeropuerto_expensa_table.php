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
        Schema::create('aeropuerto_expensa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aeropuerto');
            $table->integer('expensa');
            $table->decimal('factor');
            $table->foreign('aeropuerto')->references('id')->on('aeropuerto');
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
        Schema::dropIfExists('aeropuerto_expensa');
    }
};
