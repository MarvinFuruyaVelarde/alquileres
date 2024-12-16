<?php

namespace Database\Seeders;

use App\Models\FormaPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormaPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormaPago::create(['descripcion'=>'MENSUAL', 'numero_dia'=>'30', 'numero_mes'=>'1', 'estado'=>'1' ]);
        FormaPago::create(['descripcion'=>'BIMESTRAL', 'numero_dia'=>'60', 'numero_mes'=>'2', 'estado'=>'1' ]);
        FormaPago::create(['descripcion'=>'TRIMESTRAL', 'numero_dia'=>'90', 'numero_mes'=>'3', 'estado'=>'1' ]);
        FormaPago::create(['descripcion'=>'SEMESTRAL', 'numero_dia'=>'180', 'numero_mes'=>'6', 'estado'=>'1' ]);
        FormaPago::create(['descripcion'=>'ANUAL', 'numero_dia'=>'360', 'numero_mes'=>'12', 'estado'=>'1' ]);
        FormaPago::create(['descripcion'=>'PAGO ÚNICO U OTRO', 'numero_dia'=>null, 'numero_mes'=>null, 'estado'=>'1' ]);
    }
}
