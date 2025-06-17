<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Reporte;
use Illuminate\Http\Request;

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
}
