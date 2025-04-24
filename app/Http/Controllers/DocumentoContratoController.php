<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\DocumentoContrato;
use App\Models\View_Contrato;
use App\Models\View_DocumentoContrato;
use App\Models\View_Espacio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class DocumentoContratoController extends Controller
{
    public function index()
    {
        $contratos = View_DocumentoContrato::whereIn('estado', [3, 4, 5, 6])->get(); // Obtener todos los contratos registrados, pendientes, aprobados, modificados
        return view('contratos.documento.index', compact('contratos')); // Pasar a la vista
    }

    public function edit(Contrato $contrato)
    {
        $aeropuertos = Aeropuerto::find($contrato->aeropuerto);
        $clientes=Cliente::find($contrato->cliente);
        $listaespacios=View_Espacio::where('contrato', $contrato->id)->get();
        return view('contratos.documento.edit',compact('contrato', 'aeropuertos', 'clientes', 'listaespacios'));
    }

    public function update(Request $request, Contrato $contrato)
    {
        dd(ini_get('upload_max_filesize'), ini_get('post_max_size'));
        dd($request->all());
        //dd('LLega');
        // Generar el nombre del archivo
        $timestamp = now()->format('YmdHis');
        $name = "{$timestamp}_{$contrato->id}";
        ini_set('memory_limit', '1024M');
        set_time_limit(300);
        $extension = $request->file('documento_contrato')->extension();
        $nombre_documento = "{$name}.{$extension}";

        // Almacenar el archivo
        $path = public_path('/documento_contrato');
        $request->file('documento_contrato')->move($path, $nombre_documento);    

        // Guardar en la BD 
        $pathBd = 'documento_contrato';
        $documento_contrato = New DocumentoContrato();
        $documento_contrato->contrato = $contrato->id;
        $documento_contrato->ruta_documento = $pathBd.'/'.$nombre_documento;
        $documento_contrato->save();

        Alert::success("EL documento se ha cargado correctamente");

        return redirect()->route('documentocontratos.index');
    }
}
