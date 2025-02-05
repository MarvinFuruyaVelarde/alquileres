<?php

namespace Database\Seeders;

use App\Models\Expensa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpensaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expensa::create(['descripcion'=>'AGUA', 'unidad_medida'=>'MC', 'estado'=>'1' ]);
        Expensa::create(['descripcion'=>'LUZ', 'unidad_medida'=>'KWH', 'estado'=>'1' ]);
        Expensa::create(['descripcion'=>'GAS', 'unidad_medida'=>'MC', 'estado'=>'1' ]);
        Expensa::create(['descripcion'=>'INTERNET', 'unidad_medida'=>'MBPS', 'estado'=>'1' ]);
    }
}
