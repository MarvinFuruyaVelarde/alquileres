<?php

namespace App\Http\Controllers;

use App\Exports\ReporteDetalleEspacioExport;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteDetalleEspacioController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();
        $estados = Estado::whereIn('id', [3, 4, 5, 6, 7])
                            ->orderBy('id', 'asc')
                            ->get();
        return view('reportes.detalleespacios.index', compact('aeropuertos', 'clientes', 'estados'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteDetalleEspacio($request->query('aeropuerto'), $request->query('cliente'), $request->query('totalCanonMensual'), $request->query('estado'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $detalleEspacios = Reporte::reporteDetalleEspacio($request->query('aeropuerto'), $request->query('cliente'), $request->query('totalCanonMensual'), $request->query('estado'));
        $pdf->loadView('reportes.detalleespacios.pdf.reportegral',compact('detalleEspacios'))->setPaper('a3', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $cliente = $request->query('cliente');
        $totalCanonMensual = $request->query('totalCanonMensual');
        $estado = $request->query('estado');
        return Excel::download(new ReporteDetalleEspacioExport($aeropuerto, $cliente, $totalCanonMensual, $estado), 'reporte_detalle_espacios.xlsx');
    }
}
