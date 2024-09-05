<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionalRequest;
use App\Models\Estado;
use App\Models\Regional;
use App\Models\View_Regional;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RegionalController extends Controller
{
    public function index()
    {
        $regionales = View_Regional::all(); // Obtener todas las expensas
        return view('parametricas.regionales.index', compact('regionales')); // Pasar a la vista
    }

    public function create()
    {
        $estados=Estado::where('id','>',0)->get();
        $regional=new Regional();
        return view('parametricas.regionales.create',compact('regional', 'estados'));
    }

    public function store(RegionalRequest $request)
    {
        
        $regional=new Regional();

        $regional->codigo = $request->codigo;
        $regional->descripcion = $request->descripcion;
        $regional->estado = $request->estado;

        $regional->save();
        Alert::success("Regional registrada correctamente!");
        return redirect()->route('regionales.index');
    }

    public function edit(Regional $regional)
    {
        $estados=Estado::where('id','>',0)->get();
        return view('parametricas.regionales.edit',compact('regional', 'estados'));
    }

    public function update(Request $request, Regional $regional)
    {
        $request->validate( [
            'codigo'=>'required',
            'descripcion'=>'required',
            'estado'=>'required',
        ],[
                    'codigo.required' => 'El campo es de ingreso obligatorio.',
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $regional->codigo=$request->codigo;
        $regional->descripcion=$request->descripcion;
        $regional->estado=$request->estado;

        $regional->save();

        //actualice los roles
        return redirect()->route('regionales.index');
    }

    public function destroy(Regional $regional)
    {
        $regional->delete();
        
        Alert::success('Regional eliminada correctamente!');
        return redirect()->route('regionales.index');
    }
}
