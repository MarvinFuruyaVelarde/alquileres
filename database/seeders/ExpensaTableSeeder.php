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
        Expensa::create(['descripcion'=>'AGUA', 'factor'=>'1.25', 'unidad_medida'=>'MC', 'estado'=>'1' ]);
        Expensa::create(['descripcion'=>'LUZ', 'factor'=>'0.75', 'unidad_medida'=>'KWH', 'estado'=>'1' ]);
        Expensa::create(['descripcion'=>'GAS', 'factor'=>'2', 'unidad_medida'=>'MC', 'estado'=>'1' ]);
        Expensa::create(['descripcion'=>'INTERNET', 'factor'=>'2.5', 'unidad_medida'=>'MBPS', 'estado'=>'1' ]);
    }
}
