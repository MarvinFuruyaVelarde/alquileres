<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Expedido;
use App\Models\TipoIdentificacion;
use App\Models\TipoSolicitante;
use App\Models\View_Cliente;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = View_Cliente::all(); 
        return view('parametricas.clientes.index', compact('clientes')); 
    }

    public function create()
    {
        $tiposidentificacion=TipoIdentificacion::where('id','>',0)->get();
        $tipossolicitante=TipoSolicitante::where('id','>',0)->get();
        $expedidos=Expedido::where('id','>',0)->get();
        $estados=Estado::where('id','>',0)->get();
        $cliente=new Cliente();
        return view('parametricas.clientes.create',compact('cliente', 'tiposidentificacion', 'tipossolicitante', 'expedidos', 'estados'));
    }

    public function store(ClienteRequest $request)
    {
        $cliente=new Cliente();
        $cliente->razon_social = $request->razon_social;
        $cliente->tipo_identificacion = $request->tipo_identificacion;
        $cliente->numero_identificacion = $request->numero_identificacion;
        $cliente->es_aerolinea = $request->es_aerolinea;
        $cliente->es_pssat = $request->es_pssat;
        $cliente->tipo_solicitante = $request->tipo_solicitante;
        $cliente->expedido = $request->expedido;
        $cliente->estado = $request->estado;

        $cliente->save();
        Alert::success("Cliente registrado correctamente!");
        return redirect()->route('clientes.index');
    }

    public function edit(Cliente $cliente)
    {
        $tiposidentificacion=TipoIdentificacion::where('id','>',0)->get();
        $tipossolicitante=TipoSolicitante::where('id','>',0)->get();
        $expedidos=Expedido::where('id','>',0)->get();
        $estados=Estado::where('id','>',0)->get();
        $estados=Estado::where('id','>',0)->get();
        return view('parametricas.clientes.edit',compact('cliente', 'tiposidentificacion', 'tipossolicitante', 'expedidos', 'estados'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate( [
            'razon_social'=>'required',
            'tipo_identificacion'=>'required',
            'numero_identificacion'=>'required',
            'tipo_solicitante'=>'required',
            'estado'=>'required',
        ],[
            'razon_social.required' => 'El campo es de ingreso obligatorio.',
            'tipo_identificacion.required' => 'El campo es de ingreso obligatorio.',
            'numero_identificacion.required' => 'El campo es de ingreso obligatorio.',
            'tipo_solicitante.required' => 'El campo es de ingreso obligatorio.',
            'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        ); 
        
        $cliente->razon_social=$request->razon_social;
        $cliente->tipo_identificacion=$request->tipo_identificacion;
        $cliente->numero_identificacion=$request->numero_identificacion;
        $cliente->es_aerolinea=$request->es_aerolinea;
        $cliente->es_pssat=$request->es_pssat;
        $cliente->tipo_solicitante=$request->tipo_solicitante;
        $cliente->expedido=$request->expedido;
        $cliente->estado=$request->estado;

        $cliente->save();

        //actualice los roles
        return redirect()->route('clientes.index');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        
        Alert::success('Cliente eliminado correctamente!');
        return redirect()->route('clientes.index');
    }
}
