<?php

namespace App\Http\Controllers;

use App\Exports\ReporteGarantiaExport;
use App\Models\Cliente;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReporteGarantiaController extends Controller
{
    public function index()
    {
        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();
        return view('reportes.garantias.index', compact('clientes'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteGarantia($request->query('cliente'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $garantias = Reporte::reporteGarantia($request->query('cliente'));
        $pdf->loadView('reportes.garantias.pdf.reportegral',compact('garantias'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $cliente = $request->query('cliente');
        return Excel::download(new ReporteGarantiaExport($cliente), 'reporte_garantias.xlsx');
    }
}
