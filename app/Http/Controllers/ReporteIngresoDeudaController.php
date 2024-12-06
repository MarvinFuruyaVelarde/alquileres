<?php

namespace App\Http\Controllers;

use App\Exports\ReporteIngresoDeudaExport;
use App\Models\Aeropuerto;
use App\Models\Regional;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteIngresoDeudaController extends Controller
{
    public function index()
    {
        $regionales = Regional::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        return view('reportes.ingresodeudas.index', compact('regionales', 'aeropuertos'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteIngresoDeuda($request->query('regional'), $request->query('aeropuerto'), $request->query('fechaInicial'), $request->query('fechaFinal'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $ingresodeudas = Reporte::reporteIngresoDeuda($request->query('regional'), $request->query('aeropuerto'), $request->query('fechaInicial'), $request->query('fechaFinal'));
        $pdf->loadView('reportes.ingresodeudas.pdf.reportegral',compact('ingresodeudas'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $regional = $request->query('regional');
        $aeropuerto = $request->query('aeropuerto');
        $fechaInicial = $request->query('fechaInicial');
        $fechaFinal = $request->query('fechaFinal');
        return Excel::download(new ReporteIngresoDeudaExport($regional, $aeropuerto, $fechaInicial, $fechaFinal), 'reporte_ingreso_deuda.xlsx');
    }
}
