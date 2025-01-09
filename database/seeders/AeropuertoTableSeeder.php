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
        Aeropuerto::create(['codigo'=>'SLLP', 'descripcion'=>'AEROPUERTO INTERNACIONAL EL ALTO', 'regional'=>'1', 'estado'=>'1', 'url'=>'https://facturacion.lp.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJzZXJ2aWNlcyIsImlhdCI6MTY3NTIzMzA1OCwiZXhwIjoyMzA2Mzg1MDU4fQ.NtMXy-tHC1OLhZyEznH1I1gx2kbe9WLX8HjUqPBoIc8', 'sucursal'=>'4' ]);
        Aeropuerto::create(['codigo'=>'SLCB', 'descripcion'=>'AEROPUERTO INTERNACIONAL JORGE WILSTERMANN', 'regional'=>'2', 'estado'=>'1', 'url'=>'https://facturacion.cb.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJzZXJ2aWNlcyIsImlhdCI6MTY3NTM3NjQ1NCwiZXhwIjoyMzA2NTI4NDU0fQ.lWsrkIQjk489bb7OSXiYTFYPSBEKGybSb9rmJfoONHM', 'sucursal'=>'3' ]);
        Aeropuerto::create(['codigo'=>'SLVR', 'descripcion'=>'AEROPUERTO INTERNACIONAL VIRU VIRU', 'regional'=>'3', 'estado'=>'1', 'url'=>'https://facturacion.sc.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJzZXJ2aWNlcyIsImlhdCI6MTY3NTI2NjIyNCwiZXhwIjoyMzA2NDE4MjI0fQ.U_ziNLFGbBzH-FAd8wnUxVTPfpVuW-AcqZ_IlyGickI', 'sucursal'=>'29' ]);
        Aeropuerto::create(['codigo'=>'SLAL', 'descripcion'=>'AEROPUERTO ALCANTARI', 'regional'=>'2', 'estado'=>'1', 'url'=>'https://facturacion.sre.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJzZXJ2aWNlcyIsImlhdCI6MTY3NTI2ODIzMSwiZXhwIjoyMzA2NDIwMjMxfQ.vZ4Y8bXPso1GKULO2iRDlpNQmHEDeuFpaCLCZZfjDUE', 'sucursal'=>'37' ]);
        Aeropuerto::create(['codigo'=>'SLTJ', 'descripcion'=>'AEROPUERTO CAPITAN ORIEL LEA PLAZA', 'regional'=>'2', 'estado'=>'1', 'url'=>'https://facturacion.tja.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJzZXJ2aWNlcyIsImlhdCI6MTY3NTI3Nzc4NCwiZXhwIjoyMzA2NDI5Nzg0fQ.hx24mSRMwUYIEFNiMBrUdX32OKyqy_FSP-rmIKvU8f0', 'sucursal'=>'33' ]);
        Aeropuerto::create(['codigo'=>'SLPO', 'descripcion'=>'AEROPUERTO CAPITAN NICOLAS ROJAS', 'regional'=>'2', 'estado'=>'1', 'url'=>'https://facturacion.poi.naabol.gob.bo:8443/', 'token'=>'', 'sucursal'=>'26' ]);
        Aeropuerto::create(['codigo'=>'SLYA', 'descripcion'=>'AEROPUERTO YACUIBA', 'regional'=>'2', 'estado'=>'1', 'url'=>'https://facturacion.byc.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJXZWJTZXJ2aWNlcyIsImlhdCI6MTY4MzgxMzk0NywiZXhwIjoyMzE0OTY1OTQ3fQ.I-X1JdO4G9AjIoWTrF6_cjznwWXMJuBp9btwXsEf0ZE', 'sucursal'=>'30' ]);
        Aeropuerto::create(['codigo'=>'SLHI', 'descripcion'=>'AEROPUERTO CHIMORE', 'regional'=>'2', 'estado'=>'1', 'url'=>'https://facturacion.cb.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJzZXJ2aWNlcyIsImlhdCI6MTY3NTM3NjQ1NCwiZXhwIjoyMzA2NTI4NDU0fQ.lWsrkIQjk489bb7OSXiYTFYPSBEKGybSb9rmJfoONHM', 'sucursal'=>'31' ]);
        Aeropuerto::create(['codigo'=>'SLRQ', 'descripcion'=>'AEROPUERTO RURRENABAQUE', 'regional'=>'1', 'estado'=>'1', 'url'=>'https://facturacion.rqb.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJXZWJTZXJ2aWNlIiwiaWF0IjoxNjgxNDk4MTAxLCJleHAiOjIzMTI2NTAxMDF9.pfYyKLjYZ6QEgTct2JYvmhXehHFBLdFRGGstOiqvQLk', 'sucursal'=>'35' ]);
        Aeropuerto::create(['codigo'=>'SLOR', 'descripcion'=>'AEROPUERTO TTE. CNL. JUAN MENDOZA', 'regional'=>'1', 'estado'=>'1', 'url'=>'https://facturacion.lp.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJzZXJ2aWNlcyIsImlhdCI6MTY3NTIzMzA1OCwiZXhwIjoyMzA2Mzg1MDU4fQ.NtMXy-tHC1OLhZyEznH1I1gx2kbe9WLX8HjUqPBoIc8', 'sucursal'=>'5' ]);
        Aeropuerto::create(['codigo'=>'SLUY', 'descripcion'=>'AEROPUERTO LA JOYA ANDINA', 'regional'=>'1', 'estado'=>'1', 'url'=>'https://facturacion.uyu.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJXZWJTZXJ2aWNlcyIsImlhdCI6MTY4MjM3MjE0NSwiZXhwIjoyMzEzNTI0MTQ1fQ.B4amjTJri0yAOe4Gs86U_WsT0hkfBf6VCVKUhLG-Yvs', 'sucursal'=>'28' ]);
        Aeropuerto::create(['codigo'=>'SLCO', 'descripcion'=>'AEROPUERTO CAPITAN ANIBAL ARAB', 'regional'=>'1', 'estado'=>'1', 'url'=>'https://facturacion.cij.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJXZWJTZXJ2aWNlIiwiaWF0IjoxNzEyMTgwMzc0LCJleHAiOjIzNDMzMzIzNzR9.WaWci82_7GutdHNxpF6fDGH4sYL_QDdM0TyChv-0W6c', 'sucursal'=>'25' ]);
        Aeropuerto::create(['codigo'=>'SLET', 'descripcion'=>'AEROPUERTO EL TROMPILLO', 'regional'=>'3', 'estado'=>'1', 'url'=>'https://facturacion.srz.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJzZXJ2aWNlcyIsImlhdCI6MTY5NTkzMTUxOCwiZXhwIjoyMzI3MDgzNTE4fQ.VZfj0S9GoCjytOyWaubPHdXDTgeVcgzcTUVU0X22Z9g', 'sucursal'=>'2' ]);
        Aeropuerto::create(['codigo'=>'SLTR', 'descripcion'=>'AEROPUERTO TTE. JORGE HENRICH ARAUZ', 'regional'=>'4', 'estado'=>'1', 'url'=>'https://facturacion.tdd.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJXZWJTZXJ2aWNlIiwiaWF0IjoxNjgwNzAwNzg3LCJleHAiOjIzMTE4NTI3ODd9.eq9RuOp9mBzx4-7XIe4OldD57C0kAAJEDx0xr8bdiEg', 'sucursal'=>'1' ]);
        Aeropuerto::create(['codigo'=>'SLGY', 'descripcion'=>'AEROPUERTO CAP. AV. EMILIO BELTRAN', 'regional'=>'4', 'estado'=>'1', 'url'=>'https://facturacion.gya.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJXZWJTZXJ2aWNlcyIsImlhdCI6MTY4MjQ5MTg5MSwiZXhwIjoyMzEzNjQzODkxfQ.uxHkxNiFtMswlWcfgvPvLKTPlbNf3bWLMVHkgM6fJ9w', 'sucursal'=>'20' ]);
        Aeropuerto::create(['codigo'=>'SLRI', 'descripcion'=>'AEROPUERTO CAP. AV. SELIN ZEITUN LOPEZ', 'regional'=>'4', 'estado'=>'1', 'url'=>'https://facturacion.rib.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJXZWJTZXJ2aWNlcyIsImlhdCI6MTY4MjM5OTk1NSwiZXhwIjoyMzEzNTUxOTU1fQ.APNEQBetKAQLjo5S7hrQNyIZQCfltqfvX2mhqwa8r-8', 'sucursal'=>'34' ]);
        Aeropuerto::create(['codigo'=>'SLSB', 'descripcion'=>'AEROPUERTO CAP. AV. GERMAN QUIROGA', 'regional'=>'4', 'estado'=>'1', 'url'=>'https://facturacion.tdd.naabol.gob.bo:8443/', 'token'=>'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJXZWJTZXJ2aWNlIiwiaWF0IjoxNjgwNzAwNzg3LCJleHAiOjIzMTE4NTI3ODd9.eq9RuOp9mBzx4-7XIe4OldD57C0kAAJEDx0xr8bdiEg', 'sucursal'=>'24' ]);
    }
}
