<?php

namespace Database\Seeders;

use App\Models\Expedido;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExpedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expedido::create(['descripcion'=>'LA PAZ']);
        Expedido::create(['descripcion'=>'COCHABAMBA']);
        Expedido::create(['descripcion'=>'SANTA CRUZ']);
        Expedido::create(['descripcion'=>'POTOSI']);
        Expedido::create(['descripcion'=>'CHUQUISACA']);
        Expedido::create(['descripcion'=>'ORURO']);
        Expedido::create(['descripcion'=>'TARIJA']);
        Expedido::create(['descripcion'=>'BENI']);
        Expedido::create(['descripcion'=>'PANDO']);

      
    }
}
