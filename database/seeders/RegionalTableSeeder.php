<?php

namespace Database\Seeders;

use App\Models\Regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regional::create(['codigo'=>'LPZ', 'descripcion'=>'LA PAZ', 'estado'=>'1' ]);
        Regional::create(['codigo'=>'CBBA', 'descripcion'=>'COCHABAMBA', 'estado'=>'1' ]);
        Regional::create(['codigo'=>'SCZ', 'descripcion'=>'SANTA CRUZ', 'estado'=>'1' ]);
        Regional::create(['codigo'=>'BNI', 'descripcion'=>'BENI', 'estado'=>'1' ]);
    }
}
