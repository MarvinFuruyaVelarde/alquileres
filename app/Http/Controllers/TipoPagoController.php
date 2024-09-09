<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoPagoRequest;
use App\Models\Estado;
use App\Models\Moneda;
use App\Models\TipoPago;
use App\Models\View_TipoPago;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TipoPagoController extends Controller
{
    public function index()
    {
        $tipospago = View_TipoPago::all(); // Obtener todas las expensas
        return view('parametricas.tipospago.index', compact('tipospago')); // Pasar a la vista
    }

    public function create()
    {
        $monedas=Moneda::where('id','>',0)->get();
        $estados=Estado::where('id','>',0)->get();
        $tipopago=new TipoPago();
        return view('parametricas.tipospago.create',compact('tipopago', 'monedas', 'estados'));
    }

    public function store(TipoPagoRequest $request)
    {
        
        $tipopago=new TipoPago();

        $tipopago->descripcion = $request->descripcion;
        $tipopago->numero_cuenta = $request->numero_cuenta;
        $tipopago->moneda = $request->moneda;
        $tipopago->estado = $request->estado;

        $tipopago->save();
        Alert::success("Tipo de Pago registrado correctamente!");
        return redirect()->route('tipospago.index');
    }

    public function edit(TipoPago $tipopago)
    {
        $monedas=Moneda::where('id','>',0)->get();
        $estados=Estado::where('id','>',0)->get();
        return view('parametricas.tipospago.edit',compact('tipopago', 'monedas', 'estados'));
    }

    public function update(Request $request, TipoPago $tipopago)
    {
        $request->validate( [
            'descripcion'=>'required',
            'numero_cuenta'=>'required',
            'moneda'=>'required',
            'estado'=>'required',
        ],[
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'numero_cuenta.required' => 'El campo es de ingreso obligatorio.',
                    'moneda.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $tipopago->descripcion=$request->descripcion;
        $tipopago->numero_cuenta=$request->numero_cuenta;
        $tipopago->moneda=$request->moneda;
        $tipopago->estado=$request->estado;

        $tipopago->save();

        //actualice los roles
        return redirect()->route('tipospago.index');
    }

    public function destroy(TipoPago $tipopago)
    {
        $tipopago->delete();
        
        Alert::success('Tipo de Pago eliminado correctamente!');
        return redirect()->route('tipospago.index');
    }
}
