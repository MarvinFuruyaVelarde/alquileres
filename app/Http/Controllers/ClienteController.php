<?php

namespace App\Http\Controllers;

use App\Exports\ClientesExport;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Expedido;
use App\Models\TipoIdentificacion;
use App\Models\TipoSolicitante;
use App\Models\View_Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
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
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
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
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        return view('parametricas.clientes.edit',compact('cliente', 'tiposidentificacion', 'tipossolicitante', 'expedidos', 'estados'));
    }

    public function update(ClienteRequest $request, Cliente $cliente)
    {   
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

    public function show()
    {
        $pdf = App::make('dompdf.wrapper');
        $clientes = View_Cliente::all();
        $pdf->loadView('parametricas.clientes.pdf.reportegral',compact('clientes'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new ClientesExport, 'clientes.xlsx');
    }
}
