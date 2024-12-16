<?php

namespace Database\Seeders;

use App\Models\Aeropuerto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AeropuertoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aeropuerto::create(['codigo'=>'SLLP', 'descripcion'=>'AEROPUERTO INTERNACIONAL EL ALTO', 'regional'=>'1', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLCB', 'descripcion'=>'AEROPUERTO INTERNACIONAL JORGE WILSTERMANN', 'regional'=>'2', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLVR', 'descripcion'=>'AEROPUERTO INTERNACIONAL VIRU VIRU', 'regional'=>'3', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLAL', 'descripcion'=>'AEROPUERTO ALCANTARI', 'regional'=>'2', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLTJ', 'descripcion'=>'AEROPUERTO CAPITAN ORIEL LEA PLAZA', 'regional'=>'2', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLPO', 'descripcion'=>'AEROPUERTO CAPITAN NICOLAS ROJAS', 'regional'=>'2', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLYA', 'descripcion'=>'AEROPUERTO YACUIBA', 'regional'=>'2', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLHI', 'descripcion'=>'AEROPUERTO CHIMORE', 'regional'=>'2', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLRQ', 'descripcion'=>'AEROPUERTO RURRENABAQUE', 'regional'=>'1', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLOR', 'descripcion'=>'AEROPUERTO TTE. CNL. JUAN MENDOZA', 'regional'=>'1', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLUY', 'descripcion'=>'AEROPUERTO LA JOYA ANDINA', 'regional'=>'1', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLCO', 'descripcion'=>'AEROPUERTO CAPITAN ANIBAL ARAB', 'regional'=>'1', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLET', 'descripcion'=>'AEROPUERTO EL TROMPILLO', 'regional'=>'3', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLTR', 'descripcion'=>'AEROPUERTO TTE. JORGE HENRICH ARAUZ', 'regional'=>'4', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLGY', 'descripcion'=>'AEROPUERTO CAP. AV. EMILIO BELTRAN', 'regional'=>'4', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLRI', 'descripcion'=>'AEROPUERTO CAP. AV. SELIN ZEITUN LOPEZ', 'regional'=>'4', 'estado'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLSB', 'descripcion'=>'AEROPUERTO CAP. AV. GERMAN QUIROGA', 'regional'=>'4', 'estado'=>'1' ]);
    }
}
