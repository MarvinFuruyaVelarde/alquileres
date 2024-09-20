<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usuarios
        Permission::create(['descripcion'=>'Ver todos los usuarios','name'=>'users.index','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Registar nuevos usuarios','name'=>'users.create','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Ver detalle de usuario','name'=>'users.show','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Edición de usuarios','name'=>'users.edit','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Eliminar usuario','name'=>'users.destroy','grupo'=>'ADMINISTRACIÓN']);

        //Roles
        Permission::create(['descripcion'=>'Ver todos los roles','name'=>'roles.index','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Ver detalle de rol','name'=>'roles.show','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Creación de roles','name'=>'roles.create','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Edición de roles','name'=>'roles.edit','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Eliminar rol','name'=>'roles.destroy','grupo'=>'ADMINISTRACIÓN']);
        
        //Aeropuertos
        Permission::create(['descripcion'=>'Ver todos los registros de aeropuertos','name'=>'aeropuertos.index','grupo'=>'AEROPUERTOS']);
        Permission::create(['descripcion'=>'Ver detalle de documento de aeropuerto','name'=>'aeropuertos.show','grupo'=>'AEROPUERTOS']);
        Permission::create(['descripcion'=>'Registro de documentos de aeropuerto','name'=>'aeropuertos.create','grupo'=>'AEROPUERTOS']);
        Permission::create(['descripcion'=>'Edición de documentos de aeropuertos','name'=>'aeropuertos.edit','grupo'=>'AEROPUERTOS']);
        Permission::create(['descripcion'=>'Eliminar documento de aeropuerto','name'=>'aeropuertos.destroy','grupo'=>'AEROPUERTOS']);

        //Clientes
        Permission::create(['descripcion'=>'Ver todos los registros de clientes','name'=>'clientes.index','grupo'=>'CLIENTES']);
        Permission::create(['descripcion'=>'Ver detalle de documento de cliente','name'=>'clientes.show','grupo'=>'CLIENTES']);
        Permission::create(['descripcion'=>'Registro de documentos de cliente','name'=>'clientes.create','grupo'=>'CLIENTES']);
        Permission::create(['descripcion'=>'Edición de documentos de clientes','name'=>'clientes.edit','grupo'=>'CLIENTES']);
        Permission::create(['descripcion'=>'Eliminar documento de cliente','name'=>'clientes.destroy','grupo'=>'CLIENTES']);

        //Expensas
        Permission::create(['descripcion'=>'Ver todos los registros de expensas','name'=>'expensas.index','grupo'=>'EXPENSAS']);
        Permission::create(['descripcion'=>'Ver detalle de documento de expensa','name'=>'expensas.show','grupo'=>'EXPENSAS']);
        Permission::create(['descripcion'=>'Registro de documentos de expensa','name'=>'expensas.create','grupo'=>'EXPENSAS']);
        Permission::create(['descripcion'=>'Edición de documentos de expensas','name'=>'expensas.edit','grupo'=>'EXPENSAS']);
        Permission::create(['descripcion'=>'Eliminar documento de expensa','name'=>'expensas.destroy','grupo'=>'EXPENSAS']);

        //Formas Pago
        Permission::create(['descripcion'=>'Ver todos los registros de formas pago','name'=>'formaspago.index','grupo'=>'FORMAS DE PAGO']);
        Permission::create(['descripcion'=>'Ver detalle de documento de formas pago','name'=>'formaspago.show','grupo'=>'FORMAS DE PAGO']);
        Permission::create(['descripcion'=>'Registro de documentos de formas pago','name'=>'formaspago.create','grupo'=>'FORMAS DE PAGO']);
        Permission::create(['descripcion'=>'Edición de documentos de formas pago','name'=>'formaspago.edit','grupo'=>'FORMAS DE PAGO']);
        Permission::create(['descripcion'=>'Eliminar documento de formas pago','name'=>'formaspago.destroy','grupo'=>'FORMAS DE PAGO']);

        //Regionales
        Permission::create(['descripcion'=>'Ver todos los registros de regionales','name'=>'regionales.index','grupo'=>'REGIONALES']);
        Permission::create(['descripcion'=>'Ver detalle de documento de regional','name'=>'regionales.show','grupo'=>'REGIONALES']);
        Permission::create(['descripcion'=>'Registro de documentos de regional','name'=>'regionales.create','grupo'=>'REGIONALES']);
        Permission::create(['descripcion'=>'Edición de documentos de regionales','name'=>'regionales.edit','grupo'=>'REGIONALES']);
        Permission::create(['descripcion'=>'Eliminar documento de regional','name'=>'regionales.destroy','grupo'=>'REGIONALES']);

        //Rubros
        Permission::create(['descripcion'=>'Ver todos los registros de rubros','name'=>'rubros.index','grupo'=>'RUBROS']);
        Permission::create(['descripcion'=>'Ver detalle de documento de rubro','name'=>'rubros.show','grupo'=>'RUBROS']);
        Permission::create(['descripcion'=>'Registro de documentos de rubro','name'=>'rubros.create','grupo'=>'RUBROS']);
        Permission::create(['descripcion'=>'Edición de documentos de rubros','name'=>'rubros.edit','grupo'=>'RUBROS']);
        Permission::create(['descripcion'=>'Eliminar documento de rubro','name'=>'rubros.destroy','grupo'=>'RUBROS']);

        //Tipos de pago
        Permission::create(['descripcion'=>'Ver todos los registros de cuentas','name'=>'cuentas.index','grupo'=>'CUENTAS']);
        Permission::create(['descripcion'=>'Ver detalle de documento de cuentas','name'=>'cuentas.show','grupo'=>'CUENTAS']);
        Permission::create(['descripcion'=>'Registro de documentos de cuentas','name'=>'cuentas.create','grupo'=>'CUENTAS']);
        Permission::create(['descripcion'=>'Edición de documentos de cuentas','name'=>'cuentas.edit','grupo'=>'CUENTASO']);
        Permission::create(['descripcion'=>'Eliminar documento de cuentas','name'=>'cuentas.destroy','grupo'=>'CUENTAS']);

        //Unidad de medida
        Permission::create(['descripcion'=>'Ver todos los registros de unidad de medida','name'=>'unidadesmedida.index','grupo'=>'UNIDAD DE MEDIDA']);
        Permission::create(['descripcion'=>'Ver detalle de documento de unidad de medida','name'=>'unidadesmedida.show','grupo'=>'UNIDAD DE MEDIDA']);
        Permission::create(['descripcion'=>'Registro de documentos de unidad de medida','name'=>'unidadesmedida.create','grupo'=>'UNIDAD DE MEDIDA']);
        Permission::create(['descripcion'=>'Edición de documentos de unidad de medida','name'=>'unidadesmedida.edit','grupo'=>'UNIDAD DE MEDIDA']);
        Permission::create(['descripcion'=>'Eliminar documento de unidad de medida','name'=>'unidadesmedida.destroy','grupo'=>'UNIDAD DE MEDIDA']);

    }
}
