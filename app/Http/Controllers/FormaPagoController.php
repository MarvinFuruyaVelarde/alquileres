<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormaPagoRequest;
use App\Models\Estado;
use App\Models\FormaPago;
use App\Models\View_FormaPago;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FormaPagoController extends Controller
{
    public function index()
    {
        $formaspago = View_FormaPago::all(); // Obtener todas las expensas
        return view('parametricas.formaspago.index', compact('formaspago')); // Pasar a la vista
    }
    public function create()
    {
        $estados=Estado::where('id','>',0)->get();
        $formapago=new FormaPago();
        return view('parametricas.formaspago.create',compact('formapago', 'estados'));
    }

    public function store(FormaPagoRequest $request)
    {
        
        $formapago=new FormaPago();

        $formapago->descripcion = $request->descripcion;
        $formapago->numero_dia = $request->numero_dia;
        $formapago->estado = $request->estado;

        $formapago->save();
        Alert::success("Forma de Pago registrada correctamente!");
        return redirect()->route('formaspago.index');
    }

    public function edit(FormaPago $formapago)
    {
        $estados=Estado::where('id','>',0)->get();
        return view('parametricas.formaspago.edit',compact('formapago', 'estados'));
    }

    public function update(Request $request, FormaPago $formapago)
    {
        $request->validate( [
            'descripcion'=>'required',
            'estado'=>'required',
        ],[
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $formapago->descripcion=$request->descripcion;
        $formapago->estado=$request->estado;

        $formapago->save();

        //actualice los roles
        return redirect()->route('formaspago.index');
    }

    public function destroy(FormaPago $formapago)
    {
        $formapago->delete();
        
        Alert::success('Forma de Pago eliminada correctamente!');
        return redirect()->route('formaspago.index');
    }
}
