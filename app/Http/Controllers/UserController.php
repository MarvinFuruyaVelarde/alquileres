<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users=User::with('roles')->get();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        $roles=Role::where('id','>',1)->get();
        $user=new User();
        return view('users.create',compact('roles','user'));
    }

    public function store(UserRequest $request)
    {
        
        $user=new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        $user->roles()->sync($request->role_id);
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
        return view('users.edit',compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate( [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id, 'id')
            ],
            'name'=>'required',
            'role_id'=>'required',
        ],[
                    'name.required' => 'El campo es de ingreso obligatorio.',
                    'email.required' => 'El campo es de ingreso obligatorio.',
                    'email.unique'   => 'El correo ingresado ya fue utilizado.',
                    'role_id.required' => 'Debe asignar un rol al usuario.',
            ]
        );
        $user->name=$request->name;
        $user->email=$request->email;

        if(isset($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        //actualice los roles
        $user->roles()->sync($request->role_id);
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
