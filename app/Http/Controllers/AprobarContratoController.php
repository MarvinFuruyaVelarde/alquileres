<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Espacio;
use App\Models\Expensa;
use App\Models\FormaPago;
use App\Models\Rubro;
use App\Models\TipoIdentificacion;
use App\Models\UnidadMedida;
use App\Models\UsuarioRegional;
use App\Models\View_Contrato;
use App\Models\View_Espacio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AprobarContratoController extends Controller
{
    public function index()
    {
        if(auth()->user()->id==1){
            $contratos = View_Contrato::where('estado','=',4)->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        } else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;

            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            $contratos = View_Contrato::where('estado','=',4)->whereNull('deleted_at')->whereIn('regional',$array)->orderBy('id', 'asc')->get();
        }

        return view('contratos.aprobar.index', compact('contratos')); // Pasar a la vista
    }

    public function edit(Contrato $contrato)
    {
        $aeropuertos=Aeropuerto::where('id', $contrato->aeropuerto)->first();
        $clientes=Cliente::where('id', $contrato->cliente)->first();
        $tipoIdentificacion=TipoIdentificacion::find($clientes->tipo_identificacion);
        $rubros=Rubro::where('id','>',0)->orderBy('id', 'asc')->get();
        $unidadesmedida=UnidadMedida::where('id','>',0)->orderBy('id', 'asc')->get();
        $formaspago=FormaPago::where('id','>',0)->orderBy('id', 'asc')->get();
        $espacio=new Espacio();
        $listaespacios=View_Espacio::where('contrato', $contrato->id)->where('estado', 4)->whereNull('deleted_at')->get();
        $expensas = Expensa::where('id','>',0)->orderBy('id', 'asc')->get();
        return view('contratos.aprobar.edit',compact('contrato', 'aeropuertos', 'clientes', 'rubros', 'unidadesmedida', 'formaspago', 'espacio', 'listaespacios', 'expensas', 'tipoIdentificacion'));

    }

    public function update(Contrato $contrato, Request $request)
    {   
        if ($request->accion === 'aprobar'){
            // Actualiza estado de espacios a Aprobado
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

            Alert::success("Contrato aprobado correctamente");
        } else if($request->accion === 'rechazar'){
            // Actualiza estado de espacios a Registrado
            $espacios = Espacio::where('contrato', $contrato->id)->get();

            foreach ($espacios as $espacio) {
                $espacio->estado = 3;
                $espacio->save();
            }

            $contrato->estado = 3; 
            $contrato->save();

            Alert::success("Contrato rechazado correctamente");
        }

        return redirect()->route('aprobarcontratos.index');
    }
}
