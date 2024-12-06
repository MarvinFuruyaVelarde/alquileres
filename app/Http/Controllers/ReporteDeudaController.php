<?php

namespace App\Http\Controllers;

use App\Exports\ReporteDeudaExport;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteDeudaController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();
        return view('reportes.deudas.index', compact('aeropuertos', 'clientes'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteDeuda($request->query('aeropuerto'), $request->query('cliente'), $request->query('fechaInicial'), $request->query('fechaFinal'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $deudas = Reporte::reporteDeuda($request->query('aeropuerto'), $request->query('cliente'), $request->query('fechaInicial'), $request->query('fechaFinal'));
        $pdf->loadView('reportes.deudas.pdf.reportegral',compact('deudas'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $cliente = $request->query('cliente');
        $fechaInicial = $request->query('fechaInicial');
        $fechaFinal = $request->query('fechaFinal');
        return Excel::download(new ReporteDeudaExport($aeropuerto, $cliente, $fechaInicial, $fechaFinal), 'reporte_deuda.xlsx');
    }
}
