<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Cargo::create(['nombre'=>'GOBERNADOR','sueldo'=>'14856','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'ASAMBLEISTA DEPARTAMENTAL','sueldo'=>'14436','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'SECRETARIO DEPARTAMENTAL','sueldo'=>'13512','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'ASESOR GENERAL','sueldo'=>'13512','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'DIRECTOR GENERAL','sueldo'=>'11332','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'OFICIAL MAYOR','sueldo'=>'11332','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'DIRECTOR','sueldo'=>'10920','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'DIRECTOR TECNICO','sueldo'=>'10920','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'JEFE UNIDAD ADMINISTRATIVA','sueldo'=>'10920','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'JEFE UNIDAD DE AUDITORIA INTERNA','sueldo'=>'10374','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'RESPONSABLE','sueldo'=>'8434','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'PROFESIONAL I','sueldo'=>'7550','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'JEFE DE UNIDAD','sueldo'=>'7550','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'ASESOR TECNICO','sueldo'=>'7550','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'PROFESIONAL II','sueldo'=>'6300','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'PERSONAL OPERATIVO I','sueldo'=>'6300','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'ENCARGADO DE AREA','sueldo'=>'6300','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'TECNICO I','sueldo'=>'4768','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'ENCARGADO I','sueldo'=>'4768','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'PROFESIONAL OPERATIVO II','sueldo'=>'4768','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'TECNICO II','sueldo'=>'4168','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'TECNICO OPERATIVO I','sueldo'=>'4168','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO I','sueldo'=>'3150','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'TECNICO OPERATIVO II','sueldo'=>'3150','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO II','sueldo'=>'2970','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'TECNICO OPERATIVO III','sueldo'=>'2970','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO III','sueldo'=>'2700','tipo_cargo'=>'ITEM']);
        Cargo::create(['nombre'=>'AUXILIAR OPERATIVO I','sueldo'=>'2700','tipo_cargo'=>'ITEM']);
        
        Cargo::create(['nombre'=>'RESPONSABLE','sueldo'=>'8738','tipo_cargo'=>'CONSULTOR']);
        Cargo::create(['nombre'=>'PROFESIONAL I','sueldo'=>'7776','tipo_cargo'=>'CONSULTOR']);
        Cargo::create(['nombre'=>'PROFESIONAL II','sueldo'=>'6489','tipo_cargo'=>'CONSULTOR']);
        Cargo::create(['nombre'=>'TECNICO I','sueldo'=>'4911','tipo_cargo'=>'CONSULTOR']);
        Cargo::create(['nombre'=>'TECNICO II','sueldo'=>'4293','tipo_cargo'=>'CONSULTOR']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO I','sueldo'=>'3244','tipo_cargo'=>'CONSULTOR']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO II','sueldo'=>'3059','tipo_cargo'=>'CONSULTOR']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO III','sueldo'=>'2781','tipo_cargo'=>'CONSULTOR']);

        Cargo::create(['nombre'=>'RESPONSABLE','sueldo'=>'8738','tipo_cargo'=>'PERSONAL EVENTUAL']);
        Cargo::create(['nombre'=>'PROFESIONAL I','sueldo'=>'7776','tipo_cargo'=>'PERSONAL EVENTUAL']);
        Cargo::create(['nombre'=>'PROFESIONAL II','sueldo'=>'6489','tipo_cargo'=>'PERSONAL EVENTUAL']);
        Cargo::create(['nombre'=>'TECNICO I','sueldo'=>'4911','tipo_cargo'=>'PERSONAL EVENTUAL']);
        Cargo::create(['nombre'=>'TECNICO II','sueldo'=>'4293','tipo_cargo'=>'PERSONAL EVENTUAL']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO I','sueldo'=>'3244','tipo_cargo'=>'PERSONAL EVENTUAL']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO II','sueldo'=>'3059','tipo_cargo'=>'PERSONAL EVENTUAL']);
        Cargo::create(['nombre'=>'ADMINISTRATIVO III','sueldo'=>'2781','tipo_cargo'=>'PERSONAL EVENTUAL']);
    }
}
