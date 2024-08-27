<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $roles=Role::where('id','>',1)->get();
        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        $permissions=Permission::get();
        $role= new Role();
        return view('roles.create',compact('permissions','role'));
    }


     public function store(RoleRequest $request)
    {
        //dd($request->all());
        $role=Role::create(['name'=>$request->name,'descripcion'=>$request->descripcion]);
        //actualice los permisos

        $role->syncPermissions($request->get('permissions'));
        Alert::success('Guardado','Rol creado con exito!');
        return redirect()->route('roles.index');

    }

    public function show(Role $role)
    {
        $permissions=$role->permissions;
        return view('roles.show',compact('role','permissions'));
    }

    public function edit(Role $role)
    {
        $permissions=Permission::get();
        return view('roles.edit',compact('role','permissions'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        //actualice el rol
        $role->update($request->all());

        //actualice los permisos
        $role->permissions()->sync($request->get('permissions'));

        Alert::success('Actualizado','Datos del Rol actualizado con exito!');
        return redirect()->route('roles.index');
    }


    public function destroy(Role $role)
    {
       $role->delete();
       Alert::success('Eliminado','Rol eliminado con exito!');
       return redirect()->route('roles.index');
    }
}
