<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReporteFacturaAnuladaController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();

        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();

        return view('reportes.facturaanulada.index', compact('aeropuertos', 'clientes'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteFacturaAnulada($request->query('aeropuerto'), $request->query('cliente'), $request->query('tipo_factura'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $facturas_anuladas = Reporte::reporteFacturaAnulada($request->query('aeropuerto'), $request->query('cliente'), $request->query('tipoFactura'));
        $pdf->loadView('reportes.facturaanulada.pdf.reportegral',compact('facturas_anuladas'))->setPaper('a3', 'landscape');
        return $pdf->stream();
    }

    /*public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $tipoSolicitante = $request->query('tipoSolicitante');
        $cliente = $request->query('cliente');
        $ciNit = $request->query('ciNit');
        $estado = $request->query('estado');
        return Excel::download(new ReporteContratoExport($aeropuerto, $tipoSolicitante, $cliente, $ciNit, $estado), 'reporte_contratos.xlsx');
    }*/
}
