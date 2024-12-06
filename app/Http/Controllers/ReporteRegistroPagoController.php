<?php

namespace App\Http\Controllers;

use App\Exports\ReporteRegistroPagoExport;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReporteRegistroPagoController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();
        $gestiones = Factura::select('gestion')
                            ->groupBy('gestion')
                            ->orderBy('gestion', 'desc')
                            ->get();
        $meses = DB::select("SELECT generate_series AS mes, 
                                    UPPER(TO_CHAR(TO_DATE(generate_series::TEXT, 'MM'), 'TMMonth')) AS mes_literal
                               FROM generate_series(1, 12)
                              ORDER BY mes;");
        return view('reportes.registropagos.index', compact('aeropuertos', 'clientes', 'gestiones', 'meses'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteRegistroPago($request->query('aeropuerto'), $request->query('cliente'), $request->query('gestion'), $request->query('mes'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $registropagos = Reporte::reporteRegistroPago($request->query('aeropuerto'), $request->query('cliente'), $request->query('gestion'), $request->query('mes'));
        $pdf->loadView('reportes.registropagos.pdf.reportegral',compact('registropagos'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $cliente = $request->query('cliente');
        $gestion = $request->query('gestion');
        $mes = $request->query('mes');
        return Excel::download(new ReporteRegistroPagoExport($aeropuerto, $cliente, $gestion, $mes), 'reporte_registro_pagos.xlsx');
    }
}
