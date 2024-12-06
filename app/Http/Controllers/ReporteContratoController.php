<?php

namespace App\Http\Controllers;

use App\Exports\ExpensasExport;
use App\Exports\ReporteContratoExport;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Reporte;
use App\Models\TipoSolicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteContratoController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        $tiposSolicitantes = TipoSolicitante::orderBy('descripcion', 'asc')->get();
        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();
        $estados = Estado::whereIn('id', [3, 4, 5, 6, 7])
                            ->orderBy('id', 'asc')
                            ->get();
        return view('reportes.contratos.index', compact('aeropuertos', 'tiposSolicitantes', 'clientes', 'estados'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteContrato($request->query('aeropuerto'), $request->query('tipoSolicitante'), $request->query('cliente'), $request->query('ciNit'), $request->query('estado'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $contratos = Reporte::reporteContrato($request->query('aeropuerto'), $request->query('tipoSolicitante'), $request->query('cliente'), $request->query('ciNit'), $request->query('estado'));
        $pdf->loadView('reportes.contratos.pdf.reportegral',compact('contratos'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $tipoSolicitante = $request->query('tipoSolicitante');
        $cliente = $request->query('cliente');
        $ciNit = $request->query('ciNit');
        $estado = $request->query('estado');
        return Excel::download(new ReporteContratoExport($aeropuerto, $tipoSolicitante, $cliente, $ciNit, $estado), 'reporte_contratos.xlsx');
    }
}
