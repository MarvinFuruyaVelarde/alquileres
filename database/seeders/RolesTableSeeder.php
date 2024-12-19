<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'superadmin', 'descripcion'=> 'Super Administrador'])
        ->givePermissionTo(Permission::all());
        Role::create(['name'=>'ADMINISTRADOR','descripcion'=>'ADMINISTRADOR DE SISTEMA'])
        ->givePermissionTo(Permission::all());
        /*Role::create(['name'=>'Registro','descripcion'=>'Ingresar información al sistema']);*/        
    }
}
