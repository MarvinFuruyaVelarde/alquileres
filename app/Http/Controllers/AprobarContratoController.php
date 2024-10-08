<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Espacio;
use App\Models\Expensa;
use App\Models\FormaPago;
use App\Models\Rubro;
use App\Models\UnidadMedida;
use App\Models\View_Contrato;
use App\Models\View_Espacio;
use RealRashid\SweetAlert\Facades\Alert;

class AprobarContratoController extends Controller
{
    public function index()
    {
        $contratos = View_Contrato::where('estado','=',4)->orderBy('id', 'asc')->get(); // Obtener contratos en estado pendiente y 
        return view('contratos.aprobar.index', compact('contratos')); // Pasar a la vista
    }

    public function edit(Contrato $contrato)
    {
        $aeropuertos=Aeropuerto::where('id', $contrato->aeropuerto)->first();
        $clientes=Cliente::where('id', $contrato->cliente)->first();
        $rubros=Rubro::where('id','>',0)->orderBy('id', 'asc')->get();
        $unidadesmedida=UnidadMedida::where('id','>',0)->orderBy('id', 'asc')->get();
        $formaspago=FormaPago::where('id','>',0)->orderBy('id', 'asc')->get();
        $espacio=new Espacio();
        $listaespacios=View_Espacio::where('contrato', $contrato->id)->get();
        $expensas = Expensa::where('id','>',0)->orderBy('id', 'asc')->get();
        return view('contratos.aprobar.edit',compact('contrato', 'aeropuertos', 'clientes', 'rubros', 'unidadesmedida', 'formaspago', 'espacio', 'listaespacios', 'expensas'));

    }

    public function update(Contrato $contrato)
    {
        // Actualiza estado de espacios a Pendiente
        $espacios = Espacio::where('contrato', $contrato->id)->get();

        foreach ($espacios as $espacio) {
            $espacio->estado = 5;
            $espacio->save();
        }


        // Actualiza estado, registra garantia y saldo_garantia en Contrato
        $totalGarantia = Espacio::where('contrato', $contrato->id)
                        ->sum('garantia');

        $contrato->garantia = $totalGarantia; 
        $contrato->saldo_garantia = $totalGarantia; 
        $contrato->estado = 5; 
        $contrato->save();

        Alert::success("Contrato Aprobado");

        return redirect()->route('aprobarcontratos.index');
    }
}
