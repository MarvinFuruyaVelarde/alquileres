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
        Schema::create('documentacions', function (Blueprint $table) {
            $table->id();
            $table->string('hoja_vida')->nullable();
            $table->string('foto')->nullable();
            $table->string('fotocopia_carnet_identidad')->nullable();
            $table->string('fotocopia_certificado_nacimiento')->nullable();
            $table->string('fotocopia_servicio_militar')->nullable();
            $table->string('certificado_aymara')->nullable();
            $table->string('certificado_ley_safco')->nullable();
            $table->string('formulario_segip')->nullable();
            $table->string('cuenta_banco_union')->nullable();
            $table->string('gestora')->nullable();
            $table->string('formulario_seguro_avc_04')->nullable();
            $table->string('formulario_baja_seguro')->nullable();
            $table->string('ciudadania_digital')->nullable();
            $table->string('formulario_incompatibilidad')->nullable();
            $table->string('memorandum_designacion')->nullable();
            $table->string('memorandum_servidor_publico')->nullable();
            $table->string('memorandum_destitucion')->nullable();
            $table->string('cas')->nullable();
            $table->string('formulario_incompatibilidad_percepcion')->nullable();
            $table->string('formulario_declaracion_incompatibilidades')->nullable();
            $table->string('formulario_induccion')->nullable();
            $table->string('certificado_sipasse_rejap')->nullable();
            $table->string('licencias')->nullable();
            $table->string('vacaciones')->nullable();
            $table->string('lactancia')->nullable();
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('documentacions');
    }
};
