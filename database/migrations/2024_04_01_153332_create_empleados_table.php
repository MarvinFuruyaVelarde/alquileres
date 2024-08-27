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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_registro');
            $table->string('ap_paterno',150);
            $table->string('ap_materno',150)->nullable();
            $table->string('nombres',200);
            $table->boolean('sexo')->comment('1=Femenino, 0=Masculino');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('estado_civil');
            $table->integer('nro_hijos')->default(0);
            $table->unsignedBigInteger('ciudad_id');
            $table->string('ci');
            $table->string('ci_complemento',4)->nullable();
            $table->string('ci_lugar',4);
            $table->string('domicilio',250);
            $table->string('nro_libreta_militar')->nullable();
            $table->string('email');
            $table->string('nro_celular',20);
            $table->string('nro_telefono',10)->nullable();
            $table->string('redes_sociales',250)->nullable();
            $table->string('contacto_nombre',150);
            $table->string('contacto_telefono',15);
            $table->string('contacto_parentesco',150);
            $table->unsignedBigInteger('formacion_id');
            $table->unsignedBigInteger('institucion_formacion_id');
            $table->unsignedBigInteger('profesion_id');
            $table->string('ultimo_empleo',250);
            $table->string('nro_cuenta',50);
            $table->unsignedBigInteger('banco_id');
            $table->unsignedBigInteger('afp_id');
            $table->unsignedBigInteger('seguro_salud_id');
         
            $table->text('foto')->nullable();
            $table->boolean('discapacidad')->default(0)->comment('1=tiene discapacidad');
            $table->string('nit')->nullable();
            $table->string('ficha_firmada')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('ciudad_id')->references('id')->on('ciudads');
            $table->foreign('formacion_id')->references('id')->on('parametros');
            $table->foreign('institucion_formacion_id')->references('id')->on('parametros');
            $table->foreign('profesion_id')->references('id')->on('parametros');
            $table->foreign('banco_id')->references('id')->on('parametros');
            $table->foreign('afp_id')->references('id')->on('parametros');
            $table->foreign('seguro_salud_id')->references('id')->on('parametros');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};