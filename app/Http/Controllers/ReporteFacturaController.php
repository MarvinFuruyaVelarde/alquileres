<?php

namespace App\Http\Controllers;

use App\Exports\ReporteFacturaExport;
use App\Models\Factura;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReporteFacturaController extends Controller
{
    public function index()
    {
        $gestiones = Factura::select('gestion')
                        ->groupBy('gestion')
                        ->orderBy('gestion', 'desc')
                        ->get();

        $meses = DB::select("SELECT generate_series AS mes, 
                                    UPPER(TO_CHAR(TO_DATE(generate_series::TEXT, 'MM'), 'TMMonth')) AS mes_literal
                               FROM generate_series(1, 12)
                              ORDER BY mes;");
        
        return view('reportes.facturas.index', compact('gestiones', 'meses'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteFactura($request->query('gestion'), $request->query('mes'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $facturas = Reporte::reporteFactura($request->query('gestion'), $request->query('mes'));
        $pdf->loadView('reportes.facturas.pdf.reportegral',compact('facturas'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $gestion = $request->query('gestion');
        $mes = $request->query('mes');
        return Excel::download(new ReporteFacturaExport($gestion, $mes), 'reporte_facturas_notas_cobro.xlsx');
    }
}
