<?php

namespace App\Http\Controllers;

use App\Exports\ReporteTipoEspacioExport;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Espacio;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReporteTipoEspacioController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('estado', 1)
                            ->orderBy('id', 'asc')
                            ->get();
        $clientes = Cliente::where('estado', 1)
                            ->orderBy('razon_social', 'asc')
                            ->get();
        $tipoEspacios = Espacio::select('tipo_espacio',
                        DB::raw("CASE 
                                    WHEN tipo_espacio = 'P' THEN 'PUBLICITARIO'
                                    WHEN tipo_espacio = 'C' THEN 'COMERCIAL'
                                    ELSE 'OTRO'
                                END AS desc_tipo_espacio")
                        )
                            ->groupBy('tipo_espacio')
                            ->orderBy('tipo_espacio', 'ASC')
                            ->get();
        
        return view('reportes.tipoespacios.index', compact('aeropuertos', 'clientes', 'tipoEspacios'));
    }

    public function obtieneReporte(Request $request) 
    {
        $dato = Reporte::reporteTipoEspacio($request->query('aeropuerto'), $request->query('cliente'), $request->query('tipoEspacio'));
		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $tipoEspacios = Reporte::reporteTipoEspacio($request->query('aeropuerto'), $request->query('cliente'), $request->query('tipoEspacio'));
        $pdf->loadView('reportes.tipoespacios.pdf.reportegral',compact('tipoEspacios'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $cliente = $request->query('cliente');
        $tipoEspacio = $request->query('tipoEspacio');
        return Excel::download(new ReporteTipoEspacioExport($aeropuerto, $cliente, $tipoEspacio), 'reporte_tipo_espacios.xlsx');
    }
}
