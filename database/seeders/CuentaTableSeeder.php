<?php

namespace Database\Seeders;

use App\Models\Cuenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuentaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cuenta::create(['descripcion'=>'NAABOL - ADMINISTRACIÓN CENTRAL', 'numero_cuenta'=>'8702034001', 'moneda'=>'1', 'estado'=>'1' ]);
        Cuenta::create(['descripcion'=>'NAABOL - ADMINISTRACION CENTRAL DE RECAUDACIONES', 'numero_cuenta'=>'10000043813703', 'moneda'=>'1', 'estado'=>'1' ]);
        Cuenta::create(['descripcion'=>'NAABOL - REGIONAL LA PAZ - RECAUDACIONES', 'numero_cuenta'=>'10000043834808', 'moneda'=>'1', 'estado'=>'1' ]);
        Cuenta::create(['descripcion'=>'NAABOL - REGIONAL SANTA CRUZ - RECAUDACIONES', 'numero_cuenta'=>'10000044108103', 'moneda'=>'1', 'estado'=>'1' ]);
        Cuenta::create(['descripcion'=>'NAABOL - OFICINA CENTRAL - FONDO ROTATIVO', 'numero_cuenta'=>'10000044089949', 'moneda'=>'1', 'estado'=>'1' ]);
        Cuenta::create(['descripcion'=>'NAABOL - REGIONAL COCHABAMBA - RECAUDACIONES', 'numero_cuenta'=>'10000044427941', 'moneda'=>'1', 'estado'=>'1' ]);
        Cuenta::create(['descripcion'=>'CHEQUE', 'numero_cuenta'=>null, 'moneda'=>'1', 'estado'=>'1' ]);
        Cuenta::create(['descripcion'=>'EFECTIVO', 'numero_cuenta'=>null, 'moneda'=>'1', 'estado'=>'1' ]);
    }
}
