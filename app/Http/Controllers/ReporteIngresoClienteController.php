<?php

namespace App\Http\Controllers;

use App\Exports\ReporteIngresoClienteExport;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteIngresoClienteController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();
        return view('reportes.ingresoclientes.index', compact('aeropuertos', 'clientes'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteIngresoCliente($request->query('aeropuerto'), $request->query('cliente'), $request->query('fechaInicial'), $request->query('fechaFinal'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $ingresoClientes = Reporte::reporteIngresoCliente($request->query('aeropuerto'), $request->query('cliente'), $request->query('fechaInicial'), $request->query('fechaFinal'));
        $pdf->loadView('reportes.ingresoclientes.pdf.reportegral',compact('ingresoClientes'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $cliente = $request->query('cliente');
        $fechaInicial = $request->query('fechaInicial');
        $fechaFinal = $request->query('fechaFinal');
        return Excel::download(new ReporteIngresoClienteExport($aeropuerto, $cliente, $fechaInicial, $fechaFinal), 'reporte_ingreso_cliente.xlsx');
    }
}
