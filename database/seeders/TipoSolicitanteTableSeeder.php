<?php

namespace Database\Seeders;

use App\Models\TipoSolicitante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSolicitanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoSolicitante::create(['descripcion'=>'PERSONA NATURAL']);
        TipoSolicitante::create(['descripcion'=>'PERSONA JURIDICA']);
    }
}
