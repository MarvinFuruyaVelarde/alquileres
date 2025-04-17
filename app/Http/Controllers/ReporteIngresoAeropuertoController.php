<?php

namespace App\Http\Controllers;

use App\Exports\ReporteIngresoAeropuertoExport;
use App\Models\Aeropuerto;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteIngresoAeropuertoController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        return view('reportes.ingresoaeropuertos.index', compact('aeropuertos'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteIngresoAeropuerto($request->query('aeropuerto'), $request->query('fechaInicial'), $request->query('fechaFinal'), $request->query('tipoFactura'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $ingresoAeropuertos = Reporte::reporteIngresoAeropuerto($request->query('aeropuerto'), $request->query('fechaInicial'), $request->query('fechaFinal'), $request->query('tipoFactura'));
        $pdf->loadView('reportes.ingresoaeropuertos.pdf.reportegral',compact('ingresoAeropuertos'))->setPaper('letter', 'portrait');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $fechaInicial = $request->query('fechaInicial');
        $fechaFinal = $request->query('fechaFinal');
        $tipoFactura = $request->query('tipoFactura');
        return Excel::download(new ReporteIngresoAeropuertoExport($aeropuerto, $fechaInicial, $fechaFinal, $tipoFactura), 'reporte_ingreso_aeropuerto.xlsx');
    }
}
