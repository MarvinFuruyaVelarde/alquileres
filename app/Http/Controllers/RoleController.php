<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
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
        $roles=Role::where('id','>',1)->withCount('users')->get();
        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        $permissions=Permission::all();
        $grupos=Permission::select('grupo')->distinct()->get();
        $role= new Role();
        return view('roles.create',compact('permissions','role','grupos'));
    }


     public function store(RoleRequest $request)
    {
        $role=Role::create(['name'=>$request->name,'descripcion'=>$request->descripcion,'guard_name'=>'web']);
        //actualice los permisos

        //$role->syncPermissions($request->get('permissions'));
        $role->permissions()->sync($request->get('permissions'));
        Alert::success('Guardado','Rol creado con exito!');
        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        $permissions=$role->permissions;
        $grupos=DB::table('role_has_permissions as rp')->join('permissions as p','p.id','=','rp.permission_id')->where('rp.role_id',$role->id)->select('grupo')->distinct()->get();
        return view('roles.show',compact('role','permissions','grupos'));
    }

    public function edit(Role $role)
    {
        $permissions=Permission::all();
        $grupos=Permission::select('grupo')->distinct()->get();
        return view('roles.edit',compact('role','permissions','grupos'));
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
        DB::table('role_has_permissions')->where('role_id',$role->id)->delete();
        DB::table('roles')->where('id',$role->id)->delete();
       Alert::success('Eliminado','Rol eliminado con exito!');
       return redirect()->route('roles.index');
    }
}
