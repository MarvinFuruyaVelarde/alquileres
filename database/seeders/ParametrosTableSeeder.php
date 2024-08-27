<?php

namespace Database\Seeders;

use App\Models\Parametro;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParametrosTableSeeder extends Seeder
{
   
    public function run()
    {
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'ITEM']);
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'PASANTE']);
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'CONSULTOR INDIVIDUAL EN LINEA']);
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'CONSULTOR POR PROGRAMA']);
        Parametro::create(['tipo'=>'tipo_cargo','descripcion'=>'PERSONAL EVENTUAL']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'SOLTERO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'CASADO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'CONCUBINO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'SEPARADO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'DIVORCIADO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'VIUDO(A)']);
        Parametro::create(['tipo'=>'estado_civil','descripcion'=>'UNION LIBRE']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'CH']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'LP']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'CB']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'OR']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'PT']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'TA']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'SC']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'BN']);
        Parametro::create(['tipo'=>'lugar_ci','descripcion'=>'PD']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'PROFESIONAL A NIVEL LICENCIATURA CON TITULO EN PROVICION NACIONAL']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'PROFESIONAL A NIVEL LICENCIATURA']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'TECNICO SUPERIOR']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'EGRESADO UNIVERSIDAD']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'TECNICO MEDIO']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'ESTUDIANTE UNIVERSIDAD 5TO SEM']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'BACHILLER EN HUMANIDADES']);
        Parametro::create(['tipo'=>'formacion','descripcion'=>'EDUCACIÓN PRIMARIA']);
        Parametro::create(['tipo'=>'banco','descripcion'=>'BANCO UNION']);
        Parametro::create(['tipo'=>'banco','descripcion'=>'BANCO BISA']);
        Parametro::create(['tipo'=>'banco','descripcion'=>'BANCO MERCANTIL SANTA CRUZ']);
        Parametro::create(['tipo'=>'banco','descripcion'=>'BANCO GANADERO']);
        Parametro::create(['tipo'=>'afp','descripcion'=>'GESTORA PUBLICA']);
        Parametro::create(['tipo'=>'seguro_salud','descripcion'=>'CAJA NACIONAL DE SALUD']);
        Parametro::create(['tipo'=>'seguro_salud','descripcion'=>'CAJA PETROLERA DE SALUD']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD MAYOR DE SAN ANDRÉS']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD PÚBLICA DE EL ALTO']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD MAYOR DE SAN SIMÓN']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AUTÓNOMA GABRIEL RENÉ MORENO']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AMAZÓNICA DE PANDO']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AUTÓNOMA TOMÁS FRÍAS']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD TÉCNICA DE ORURO']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD MAYOR REAL Y PONTIFICIA DE SAN FRANCISCO XAVIER']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD NACIONAL SIGLO XX']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AUTÓNOMA DEL BENI JOSÉ BALLIVIÁN']);
        Parametro::create(['tipo'=>'institucion_formacion','descripcion'=>'UNIVERSIDAD AUTÓNOMA JUAN MISAEL SARACHO']);
    }
}
