<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estado::create(['descripcion'=>'HABILITADO']);
        Estado::create(['descripcion'=>'DESHABILITADO']);
        Estado::create(['descripcion'=>'REGISTRADO']);
        Estado::create(['descripcion'=>'PENDIENTE']);
        Estado::create(['descripcion'=>'APROBADO']);
        Estado::create(['descripcion'=>'MODIFICADO']);
        Estado::create(['descripcion'=>'ANULADO']);
        Estado::create(['descripcion'=>'GENERADO']);
    }
}
