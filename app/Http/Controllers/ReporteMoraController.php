<?php

namespace App\Http\Controllers;

use App\Exports\ReporteMoraExport;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteMoraController extends Controller
{
    public function index()
    {
        $aeropuertos =  Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();
        return view('reportes.mora.index', compact('aeropuertos', 'clientes'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteMora($request->query('aeropuerto'), $request->query('cliente'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $moras = Reporte::reporteMora($request->query('aeropuerto'), $request->query('cliente'));
        $pdf->loadView('reportes.mora.pdf.reportegral',compact('moras'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $cliente = $request->query('cliente');
        return Excel::download(new ReporteMoraExport($aeropuerto, $cliente), 'reporte_mora.xlsx');
    }
}
