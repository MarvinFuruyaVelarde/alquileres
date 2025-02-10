<?php

namespace Database\Seeders;

use App\Models\Rubro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RubroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rubro::create(['codigo'=>'72113', 'descripcion'=>'ALQUILER DE ESPACIOS COMERCIALES', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72114', 'descripcion'=>'ALQUILER ESPACIOS PARA CONEXIONES', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72115', 'descripcion'=>'ALQUILER SERVICIO DE EXPLOTACION DE TELECOMUNICACIONES', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72116', 'descripcion'=>'ALQUILER SERVICIO DE EXPLOTACION DE TRANSPORTE', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72117', 'descripcion'=>'ALQUILER PARA USO DE DUCTOS', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72118', 'descripcion'=>'ALQUILER ESPACIOS PUBLICITARIOS', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72119', 'descripcion'=>'ALQUILER ESPACIO PARA EQUIPOS ATM', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72120', 'descripcion'=>'ALQUILER ESPACIO PARA JUEGOS MECANICOS ELECTRONICOS', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72121', 'descripcion'=>'ALQUILER SILLONES DE RELAJACION Y MASAJES', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72122', 'descripcion'=>'ALQUILER SESION DE FOTOGRAFIA Y FILMACION', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72123', 'descripcion'=>'ALQUILER INGRESOS TRANSPORTE SECTOR AERONAUTICO', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72124', 'descripcion'=>'ALQUILER INGRESO DE TRANSPORTE PUBLICO AL AEREA PUBLICA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72125', 'descripcion'=>'ALQUILER SERVICIO S.E.I.', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72126', 'descripcion'=>'ALQUILER ESPACIO DE CONSTRUCCION DE HANGAR', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72127', 'descripcion'=>'ALQUILER ESPACIO DE TERRENO HANGAR', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72128', 'descripcion'=>'ALQUILER SALA VIP', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72129', 'descripcion'=>'ALQUILER PUBLICIDAD CON LUMINARIA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72130', 'descripcion'=>'ALQUILER PUBLICIDAD SIN LUMINARIA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72131', 'descripcion'=>'ALQUILER COUNTERS MOSTRADORES CON BALANZA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72132', 'descripcion'=>'ALQUILER COUNTERS MOSTRADORES SIN BALANZA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72133', 'descripcion'=>'ALQUILER ESPACIO PARA AREA DE PARQUEO DE VEHICULOS', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72134', 'descripcion'=>'ALQUILER OFICINA ADMINISTRATIVA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72135', 'descripcion'=>'ALQUILER ESPACIO PLATAFORMA Y OTROS', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72136', 'descripcion'=>'ALQUILER ESPACIO PARA ANTENA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72137', 'descripcion'=>'ALQUILER ESPACIO SANITARIO DENTRO EL GALPON', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72138', 'descripcion'=>'ACTIVACIONES', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72139', 'descripcion'=>'ALQUILER DEPOSITO', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72140', 'descripcion'=>'ALQUILER GALPON EN PLATAFORMA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72141', 'descripcion'=>'ALQUILER ESPACIO COMERCIAL PARA ISLA', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72142', 'descripcion'=>'ALQUILER ESPACIOS DE TERRENO', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72143', 'descripcion'=>'ALQUILER ESPACIOS PARA RESTAURANTE, CAFETERIAS, SNACK, KIOSCOS', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72144', 'descripcion'=>'ALQUILER ESPACIO PARA CONTENEDOR', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72145', 'descripcion'=>'ALQUILER ESPACIO PARA ESTACIONAMIENTO EQUIPO SAT', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72146', 'descripcion'=>'ALQUILER MÁQUINA DE AUTOREGISTRO (SELF CHECK-IN)', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72147', 'descripcion'=>'ALQUILER MAQUINAS EXPENDEDORAS', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72148', 'descripcion'=>'ALQUILER SILLON LUSTRABOTAS', 'estado'=>'1']);
        Rubro::create(['codigo'=>'72149', 'descripcion'=>'OTROS ALQUILERES', 'estado'=>'1']);
        Rubro::create(['codigo'=>'99852', 'descripcion'=>'ALQUILER DE ESPACIOS COMERCIALES', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99871', 'descripcion'=>'ALQUILER ESPACIOS PARA CONEXIONES', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99872', 'descripcion'=>'ALQUILER SERVICIO DE EXPLOTACION DE TELECOMUNICACIONES', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99873', 'descripcion'=>'ALQUILER SERVICIO DE EXPLOTACION DE TRANSPORTE', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99874', 'descripcion'=>'ALQUILER PARA USO DE DUCTOS', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'998138', 'descripcion'=>'ALQUILER ESPACIOS PUBLICITARIOS', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99875', 'descripcion'=>'ALQUILER ESPACIO PARA EQUIPOS ATM', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99876', 'descripcion'=>'ALQUILER ESPACIO PARA JUEGOS MECANICOS ELECTRONICOS', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99877', 'descripcion'=>'ALQUILER SILLONES DE RELAJACION Y MASAJES', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99878', 'descripcion'=>'ALQUILER SESION DE FOTOGRAFIA Y FILMACION', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99879', 'descripcion'=>'ALQUILER INGRESOS TRANSPORTE SECTOR AERONAUTICO', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99880', 'descripcion'=>'ALQUILER INGRESO DE TRANSPORTE PUBLICO AL AEREA PUBLICA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99881', 'descripcion'=>'ALQUILER SERVICIO S.E.I.', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99882', 'descripcion'=>'ALQUILER ESPACIO DE CONSTRUCCION DE HANGAR', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99883', 'descripcion'=>'ALQUILER ESPACIO DE TERRENO HANGAR', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99870', 'descripcion'=>'ALQUILER SALA VIP', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99884', 'descripcion'=>'ALQUILER PUBLICIDAD CON LUMINARIA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99885', 'descripcion'=>'ALQUILER PUBLICIDAD SIN LUMINARIA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99886', 'descripcion'=>'ALQUILER COUNTERS MOSTRADORES CON BALANZA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99887', 'descripcion'=>'ALQUILER COUNTERS MOSTRADORES SIN BALANZA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99888', 'descripcion'=>'ALQUILER ESPACIO PARA AREA DE PARQUEO DE VEHICULOS', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99889', 'descripcion'=>'ALQUILER OFICINA ADMINISTRATIVA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99890', 'descripcion'=>'ALQUILER ESPACIO PLATAFORMA Y OTROS', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99891', 'descripcion'=>'ALQUILER ESPACIO PARA ANTENA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99892', 'descripcion'=>'ALQUILER ESPACIO SANITARIO DENTRO EL GALPON', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99893', 'descripcion'=>'ACTIVACIONES', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99894', 'descripcion'=>'ALQUILER DEPOSITO', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99895', 'descripcion'=>'ALQUILER GALPON EN PLATAFORMA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99896', 'descripcion'=>'ALQUILER ESPACIO COMERCIAL PARA ISLA', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99897', 'descripcion'=>'ALQUILER ESPACIOS DE TERRENO', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99898', 'descripcion'=>'ALQUILER ESPACIOS PARA RESTAURANTE, CAFETERIAS, SNACK, KIOSCOS', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'99899', 'descripcion'=>'ALQUILER ESPACIO PARA CONTENEDOR', 'estado'=>'1', 'aeropuerto'=>'12', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'998100', 'descripcion'=>'ALQUILER ESPACIO PARA ESTACIONAMIENTO EQUIPO SAT', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'998101', 'descripcion'=>'ALQUILER MÁQUINA DE AUTOREGISTRO (SELF CHECK-IN)', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'998102', 'descripcion'=>'ALQUILER MAQUINAS EXPENDEDORAS', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'998103', 'descripcion'=>'ALQUILER SILLON LUSTRABOTAS', 'estado'=>'1', 'aeropuerto'=>'12']);
        Rubro::create(['codigo'=>'998104', 'descripcion'=>'OTROS ALQUILERES', 'estado'=>'1', 'aeropuerto'=>'12']);
    }
}
