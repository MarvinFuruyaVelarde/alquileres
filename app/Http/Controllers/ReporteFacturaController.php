<?php

namespace App\Http\Controllers;

use App\Exports\ReporteFacturaExport;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Reporte;
use App\Models\UsuarioRegional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReporteFacturaController extends Controller
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
        
        return view('reportes.facturas.index', compact('aeropuertos', 'clientes', 'gestiones', 'meses'));
    }

    public function obtieneReporte(Request $request) 
    {
        if(auth()->user()->id==1){
            $dato = Reporte::reporteFactura($request->query('aeropuerto'), $request->query('cliente'), [1, 2, 3, 4], $request->query('gestion'), $request->query('mes'));
        } else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;

            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            $dato = Reporte::reporteFactura($request->query('aeropuerto'), $request->query('cliente'), $array, $request->query('aeropuerto'), $request->query('cliente'), $request->query('gestion'), $request->query('mes'));
        }

		return $dato;
	}

    public function show(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');

        if(auth()->user()->id==1){
            $facturas = Reporte::reporteFactura($request->query('aeropuerto'), $request->query('cliente'), [1, 2, 3, 4], $request->query('gestion'), $request->query('mes'));
        } else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;

            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            $facturas = Reporte::reporteFactura($request->query('aeropuerto'), $request->query('cliente'), $array, $request->query('gestion'), $request->query('mes'));
        }

        ini_set('memory_limit', '1024M');
        set_time_limit(300);
        
        $pdf->loadView('reportes.facturas.pdf.reportegral',compact('facturas'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function export(Request $request)
    {
        $aeropuerto = $request->query('aeropuerto');
        $cliente = $request->query('cliente');
        $gestion = $request->query('gestion');
        $mes = $request->query('mes');

        if(auth()->user()->id==1){
            return Excel::download(new ReporteFacturaExport($aeropuerto, $cliente, [1, 2, 3, 4], $gestion, $mes), 'reporte_facturas_notas_cobro.xlsx');
        } else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;

            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            return Excel::download(new ReporteFacturaExport($aeropuerto, $cliente, $array, $gestion, $mes), 'reporte_facturas_notas_cobro.xlsx');
        }
    }
}
