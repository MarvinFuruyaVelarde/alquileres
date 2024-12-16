<?php

namespace Database\Seeders;

use App\Models\UnidadMedida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadMedidaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnidadMedida::create(['descripcion'=>'M2', 'estado'=>'1']);
        UnidadMedida::create(['descripcion'=>'HORA', 'estado'=>'1']);
        UnidadMedida::create(['descripcion'=>'MÉS', 'estado'=>'1']);
        UnidadMedida::create(['descripcion'=>'P/VEHICULO', 'estado'=>'1']);
        UnidadMedida::create(['descripcion'=>'P/DIA', 'estado'=>'1']);
        UnidadMedida::create(['descripcion'=>'C/U', 'estado'=>'1']);
    }
}
