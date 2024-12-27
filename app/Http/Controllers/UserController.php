<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Estado;
use App\Models\Expedido;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Regional;
use App\Models\UsuarioRegional;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users=User::where('estado', 1)->where('id', '<>', 1)->orderBy('id', 'asc')->get();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        $roles=Role::where('id','>',1)->get();
        $expedidos=Expedido::where('id','>',0)->get();
        $estados=Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        $regionales=Regional::where('id','>',0)->get();
        $user=new User();
        return view('users.create',compact('roles','user','expedidos','estados','regionales'));
    }

    public function store(UserRequest $request)
    {
        $user=new User();
        $user->name = $request->name;
        $user->segundo_nombre = $request->segundo_nombre;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->email = $request->email;
        $user->password = Hash::make($request->ci);
        $user->ci = $request->ci;
        $user->estado = $request->estado;
        $user->expedido = $request->expedido;
        $user->save();
        $user->roles()->sync($request->role_id);
        $busqueda_user=User::where('ci',$request->ci)->first();
        foreach ($request->regional as $valor) {
            $usuario_regional= new UsuarioRegional();
            $usuario_regional->regional=$valor;
            $usuario_regional->usuario=$busqueda_user->id;
            $usuario_regional->save();
        }
       
        Alert::success("Usuario registrado correctamente!");
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        $roles=Role::where('id','>',1)->get();
        $expedidos=Expedido::where('id','>',0)->get();
        $estados=Estado::where('id','>',0)->get();
        $regionales=Regional::all();
        $usuario_regional=UsuarioRegional::where('usuario',$user->id)->get();   
           
        return view('users.edit',compact('user','roles','expedidos','estados','regionales','usuario_regional'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->segundo_nombre = $request->segundo_nombre;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->email = $request->email;
        $user->password = Hash::make($request->ci);
        $user->ci = $request->ci;
        $user->estado = $request->estado;
        $user->expedido = $request->expedido;
        $user->save();
        $user->roles()->sync($request->role_id);
        //eliminando
        UsuarioRegional::where('usuario', $user->id)->delete();
        
        //agregando de nuevo
        foreach ($request->regional as $valor) {
            $usuario_regional= new UsuarioRegional();
            $usuario_regional->regional=$valor;
            $usuario_regional->usuario=$user->id;
            $usuario_regional->save();
        }
        //actualice los roles
        
        Alert::success('Datos actualizados correctamente!');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        Alert::success('Usuario Eliminado correctamente!');
        return redirect()->route('users.index');
    }
}
