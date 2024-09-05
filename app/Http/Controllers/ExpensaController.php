<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpensaRequest;
use App\Models\Estado;
use App\Models\Expensa;
use App\Models\View_Expensa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ExpensaController extends Controller
{
    public function index()
    {
        $expensas = View_Expensa::all(); // Obtener todas las expensas
        return view('parametricas.expensas.index', compact('expensas')); // Pasar a la vista
    }

    public function create()
    {
        $estados=Estado::where('id','>',0)->get();
        $expensa=new Expensa();
        return view('parametricas.expensas.create',compact('expensa', 'estados'));
    }

    public function store(ExpensaRequest $request)
    {
        
        $expensa=new Expensa();

        $expensa->descripcion = $request->descripcion;
        $expensa->factor = $request->factor;
        $expensa->estado = $request->estado;

        $expensa->save();
        Alert::success("Expensa registrada correctamente!");
        return redirect()->route('expensas.index');
    }

    public function edit(Expensa $expensa)
    {
        $estados=Estado::where('id','>',0)->get();
        return view('parametricas.expensas.edit',compact('expensa', 'estados'));
    }

    public function update(Request $request, Expensa $expensa)
    {
        $request->validate( [
            'descripcion'=>'required',
            'factor'=>'required',
            'estado'=>'required',
        ],[
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'factor.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $expensa->descripcion=$request->descripcion;
        $expensa->factor=$request->factor;
        $expensa->estado=$request->estado;

        $expensa->save();

        //actualice los roles
        return redirect()->route('expensas.index');
    }

    public function destroy(Expensa $expensa)
    {
        $expensa->delete();
        
        Alert::success('Expensa eliminada correctamente!');
        return redirect()->route('expensas.index');
    }
}
