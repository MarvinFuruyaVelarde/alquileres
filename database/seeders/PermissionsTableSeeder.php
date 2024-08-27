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
        Permission::create(['descripcion'=>'Ver todos los usuarios','name'=>'users.index']);
        Permission::create(['descripcion'=>'Registar nuevos usuarios','name'=>'users.create']);
        Permission::create(['descripcion'=>'Ver detalle de usuario','name'=>'users.show']);
        Permission::create(['descripcion'=>'Edición de usuarios','name'=>'users.edit']);
        Permission::create(['descripcion'=>'Eliminar usuario','name'=>'users.destroy']);

        //Roles
        Permission::create(['descripcion'=>'Ver todos los roles','name'=>'roles.index']);
        Permission::create(['descripcion'=>'Ver detalle de rol','name'=>'roles.show']);
        Permission::create(['descripcion'=>'Creación de roles','name'=>'roles.create']);
        Permission::create(['descripcion'=>'Edición de roles','name'=>'roles.edit']);
        Permission::create(['descripcion'=>'Eliminar rol','name'=>'roles.destroy']);
        
        //Permisos
        Permission::create(['descripcion'=>'Ver todos los permisos','name'=>'permissions.index']);
        Permission::create(['descripcion'=>'Ver detalle de permisos','name'=>'permissions.show']);
        Permission::create(['descripcion'=>'Creación de permisos','name'=>'permissions.create']);
        Permission::create(['descripcion'=>'Edición de permisos','name'=>'permissions.edit']);
        Permission::create(['descripcion'=>'Eliminar permisos','name'=>'permissions.destroy']);

        //Area
        Permission::create(['descripcion'=>'Ver todas las areas','name'=>'areas.index']);
        Permission::create(['descripcion'=>'Ver detalle de area','name'=>'areas.show']);
        Permission::create(['descripcion'=>'Creación de areas','name'=>'areas.create']);
        Permission::create(['descripcion'=>'Edición de areas','name'=>'areas.edit']);
        Permission::create(['descripcion'=>'Eliminar area','name'=>'areas.destroy']);

        //Cargos
        Permission::create(['descripcion'=>'Ver todas las cargos','name'=>'cargos.index']);
        Permission::create(['descripcion'=>'Ver detalle de cargo','name'=>'cargos.show']);
        Permission::create(['descripcion'=>'Creación de cargos','name'=>'cargos.create']);
        Permission::create(['descripcion'=>'Edición de cargos','name'=>'cargos.edit']);
        Permission::create(['descripcion'=>'Eliminar cargo','name'=>'cargos.destroy']);

        //Empleado
        Permission::create(['descripcion'=>'Ver todas las empleados','name'=>'empleados.index']);
        Permission::create(['descripcion'=>'Ver detalle de empleado','name'=>'empleados.show']);
        Permission::create(['descripcion'=>'Creación de empleados','name'=>'empleados.create']);
        Permission::create(['descripcion'=>'Edición de empleados','name'=>'empleados.edit']);
        Permission::create(['descripcion'=>'Eliminar empleado','name'=>'empleados.destroy']);

        //declaraciones
        Permission::create(['descripcion'=>'Ver todas las declaraciones juradas','name'=>'declaraciones.index']);
        Permission::create(['descripcion'=>'Ver detalle de declaracion jurada','name'=>'declaraciones.show']);
        Permission::create(['descripcion'=>'Creación de declaraciones juradas','name'=>'declaraciones.create']);
        Permission::create(['descripcion'=>'Edición de declaraciones juradas','name'=>'declaraciones.edit']);
        Permission::create(['descripcion'=>'Eliminar declaracion jurada','name'=>'declaraciones.destroy']);
        
        
        
        //complementarios
        Permission::create(['descripcion'=>'Ver todos los documentos complementarios','name'=>'complementarios.index']);
        Permission::create(['descripcion'=>'Ver detalle de documento complementario','name'=>'complementarios.show']);
        Permission::create(['descripcion'=>'Creación de documentos complementarios','name'=>'complementarios.create']);
        Permission::create(['descripcion'=>'Edición de documentos complementarios','name'=>'complementarios.edit']);
        Permission::create(['descripcion'=>'Eliminar documento complementario','name'=>'complementarios.destroy']);


        //discapacidad
        Permission::create(['descripcion'=>'Ver todas las discapacidades','name'=>'discapacidades.index']);
        Permission::create(['descripcion'=>'Ver detalle de discapacidad','name'=>'discapacidades.show']);
        Permission::create(['descripcion'=>'Creación de discapacidades','name'=>'discapacidades.create']);
        Permission::create(['descripcion'=>'Edición de discapacidades','name'=>'discapacidades.edit']);
        Permission::create(['descripcion'=>'Eliminar discapacidad','name'=>'discapacidades.destroy']);

        //Empleado
        Permission::create(['descripcion'=>'Ver todas los años de servicios','name'=>'servicio_años.index']);
        Permission::create(['descripcion'=>'Ver detalle del año servicio','name'=>'servicio_años.show']);
        Permission::create(['descripcion'=>'Creación de años de servicios','name'=>'servicio_años.create']);
        Permission::create(['descripcion'=>'Edición de años de servicios','name'=>'servicio_años.edit']);
        Permission::create(['descripcion'=>'Eliminar años de servicio','name'=>'servicio_años.destroy']);

         //Formación
         Permission::create(['descripcion'=>'Ver todas las formaciones','name'=>'formaciones.index']);
         Permission::create(['descripcion'=>'Ver detalle de formacion','name'=>'formaciones.show']);
         Permission::create(['descripcion'=>'Creación de formaciones','name'=>'formaciones.create']);
         Permission::create(['descripcion'=>'Edición de formaciones','name'=>'formaciones.edit']);
         Permission::create(['descripcion'=>'Eliminar formacion','name'=>'formaciones.destroy']);

        //Bancos
        Permission::create(['descripcion'=>'Ver todas los bancos','name'=>'bancos.index']);
        Permission::create(['descripcion'=>'Ver detalle de banco','name'=>'bancos.show']);
        Permission::create(['descripcion'=>'Creación de bancos','name'=>'bancos.create']);
        Permission::create(['descripcion'=>'Edición de bancos','name'=>'bancos.edit']);
        Permission::create(['descripcion'=>'Eliminar banco','name'=>'bancos.destroy']);

        //Seguro salud
        Permission::create(['descripcion'=>'Ver todas los seguros de salud','name'=>'salud_seguros.index']);
        Permission::create(['descripcion'=>'Ver detalle de salud_seguro','name'=>'salud_seguros.show']);
        Permission::create(['descripcion'=>'Creación de salud_seguros','name'=>'salud_seguros.create']);
        Permission::create(['descripcion'=>'Edición de salud_seguros','name'=>'salud_seguros.edit']);
        Permission::create(['descripcion'=>'Eliminar salud_seguro','name'=>'salud_seguros.destroy']);
        
          //AFP
        Permission::create(['descripcion'=>'Ver todas los afps','name'=>'afps.index']);
        Permission::create(['descripcion'=>'Ver detalle de afp','name'=>'afps.show']);
        Permission::create(['descripcion'=>'Creación de afps','name'=>'afps.create']);
        Permission::create(['descripcion'=>'Edición de afps','name'=>'afps.edit']);
        Permission::create(['descripcion'=>'Eliminar afp','name'=>'afps.destroy']);

        //Estado civil
        Permission::create(['descripcion'=>'Ver todas los estados civiles','name'=>'civil_estados.index']);
        Permission::create(['descripcion'=>'Ver detalle de estado civil','name'=>'civil_estados.show']);
        Permission::create(['descripcion'=>'Creación de estados civiles','name'=>'civil_estados.create']);
        Permission::create(['descripcion'=>'Edición de estado civil','name'=>'civil_estados.edit']);
        Permission::create(['descripcion'=>'Eliminar estado civil','name'=>'civil_estados.destroy']);
        
        //Ciudades
        Permission::create(['descripcion'=>'Ver todas las ciudades','name'=>'ciudades.index']);
        Permission::create(['descripcion'=>'Ver detalle de ciudad','name'=>'ciudades.show']);
        Permission::create(['descripcion'=>'Creación de ciudades','name'=>'ciudades.create']);
        Permission::create(['descripcion'=>'Edición de ciudades','name'=>'ciudades.edit']);
        Permission::create(['descripcion'=>'Eliminar ciudad','name'=>'ciudades.destroy']);
      
        //documentos
        Permission::create(['descripcion'=>'Ver documentacion recepcionada','name'=>'documentos.index']);
        Permission::create(['descripcion'=>'Ver detalle de la documentacion recepcionada','name'=>'documentos.show']);
        Permission::create(['descripcion'=>'Registrar la documentación recepcionada de un empleado','name'=>'documentos.create']);
        Permission::create(['descripcion'=>'Edición de documentación recepcionada de un empleado','name'=>'documentos.edit']);
        Permission::create(['descripcion'=>'Eliminar la documentación recepcionada de un empleado','name'=>'documentos.destroy']);

        //lactancia
        Permission::create(['descripcion'=>'Ver todos los registros de lactancia','name'=>'lactancias.index']);
        Permission::create(['descripcion'=>'Ver detalle de documento de lactancia adjunto','name'=>'lactancias.show']);
        Permission::create(['descripcion'=>'Registro de documentos de lactancias','name'=>'lactancias.create']);
        Permission::create(['descripcion'=>'Edición de documentos de lactancias','name'=>'lactancias.edit']);
        Permission::create(['descripcion'=>'Eliminar documento de lactancia','name'=>'lactancias.destroy']);
        
        //licencias
        Permission::create(['descripcion'=>'Ver todos los registros de licencia','name'=>'licencias.index']);
        Permission::create(['descripcion'=>'Ver detalle de documento de licencia adjunto','name'=>'licencias.show']);
        Permission::create(['descripcion'=>'Registro de documentos de licencias','name'=>'licencias.create']);
        Permission::create(['descripcion'=>'Edición de documentos de licencias','name'=>'licencias.edit']);
        Permission::create(['descripcion'=>'Eliminar documento de licencia','name'=>'licencias.destroy']);


    }
}
