<?php

namespace App\Http\Controllers;

use App\Exports\ReporteResumenContratoExport;
use App\Models\Aeropuerto;
use App\Models\Regional;
use App\Models\Reporte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteResumenContratoController extends Controller
{
    public function index()
    {
        $regionales = Regional::where('estado', 1)
                                ->orderBy('id', 'asc')
                                ->get();
        $aeropuertos = Aeropuerto::where('estado', 1)
                                ->orderBy('id', 'asc')
                                ->get();
        return view('reportes.resumencontratos.index', compact('regionales', 'aeropuertos'));
    }

    public function obtieneReporte(Request $request) 
    {
        $regional = $request->query('regional') ? $request->query('regional') : null;
        $aeropuerto = $request->query('aeropuerto') ? $request->query('aeropuerto') : null;
        $periodoInicial = Carbon::createFromFormat('Y-m', $request->query('periodoInicial'));
        $gestionInicial = $periodoInicial->year;
        $mesInicial = $periodoInicial->month;  
        $periodoFinal = Carbon::createFromFormat('Y-m', $request->query('periodoFinal'));
        $gestionFinal = $periodoFinal->year;
        $mesFinal = $periodoFinal->month; 

        $dato = Reporte::reporteResumenContrato($regional, $aeropuerto, $gestionInicial, $mesInicial, $gestionFinal, $mesFinal);
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $regional = $request->query('regional') ? $request->query('regional') : null;
        $aeropuerto = $request->query('aeropuerto') ? $request->query('aeropuerto') : null;
        $periodoInicial = Carbon::createFromFormat('Y-m', $request->query('periodoInicial'));
        $gestionInicial = $periodoInicial->year;
        $mesInicial = $periodoInicial->month;  
        $periodoFinal = Carbon::createFromFormat('Y-m', $request->query('periodoFinal'));
        $gestionFinal = $periodoFinal->year;
        $mesFinal = $periodoFinal->month; 
        $resumenContratos = Reporte::reporteResumenContrato($regional, $aeropuerto, $gestionInicial, $mesInicial, $gestionFinal, $mesFinal);
        $pdf->loadView('reportes.resumencontratos.pdf.reportegral',compact('resumenContratos'))->setPaper('letter', 'portrait');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $regional = $request->query('regional') ? $request->query('regional') : null;
        $aeropuerto = $request->query('aeropuerto') ? $request->query('aeropuerto') : null;
        $periodoInicial = Carbon::createFromFormat('Y-m', $request->query('periodoInicial'));
        $gestionInicial = $periodoInicial->year;
        $mesInicial = $periodoInicial->month;  
        $periodoFinal = Carbon::createFromFormat('Y-m', $request->query('periodoFinal'));
        $gestionFinal = $periodoFinal->year;
        $mesFinal = $periodoFinal->month; 
        return Excel::download(new ReporteResumenContratoExport($regional, $aeropuerto, $gestionInicial, $mesInicial, $gestionFinal, $mesFinal), 'reporte_resumen_contratos.xlsx');
    }
}
