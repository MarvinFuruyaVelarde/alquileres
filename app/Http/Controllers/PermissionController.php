<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permisos=Permission::all();
        return view('permisos.index',compact('permisos'));
    }

    public function create()
    {
        $permiso=new Permission();
        return view('permisos.create',compact('permiso'));
    }

    public function store(Request $request)
    {
        $permiso=Permission::create($request->all());
        return redirect()->route('permisos.index')
            ->with('info','Permiso registrado con éxito');

    }

    public function edit(Permission $permiso)
    {
        return view('permisos.edit',compact('permiso'));
    }

    public function update(Request $request, Permission $permiso)
    {
        $permiso->update($request->all());

        return redirect()->route('permisos.index')
            ->with('info','Permiso actualizado con éxito');
    }

    public function destroy(Permission $permiso)
    {
        $permiso->delete();
        return redirect()->route('permisos.index')
            ->with('info','Permiso eliminado con éxito');
    }
}
