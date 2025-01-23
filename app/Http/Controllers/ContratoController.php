<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratoRequest;
use App\Http\Requests\EspacioRequest;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Espacio;
use App\Models\EspacioExpensa;
use App\Models\Expedido;
use App\Models\Expensa;
use App\Models\FormaPago;
use App\Models\Rubro;
use App\Models\TipoIdentificacion;
use App\Models\TipoSolicitante;
use App\Models\UnidadMedida;
use App\Models\UsuarioRegional;
use App\Models\View_Aeropuerto;
use App\Models\View_Contrato;
use App\Models\View_Espacio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class ContratoController extends Controller
{
    public function index()
    {
        if(auth()->user()->id==1){
            $contratos = View_Contrato::where('estado','=',3)->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        } else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;

            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            $contratos = View_Contrato::where('estado','=',3)->whereNull('deleted_at')->whereIn('regional',$array)->orderBy('id', 'asc')->get();
        }

        return view('contratos.lista.index', compact('contratos')); // Pasar a la vista
    }

    public function obtieneCliente($tipoSolicitante) 
    {
        $clientes = Cliente::where('estado', 1)
                            ->where('tipo_solicitante', $tipoSolicitante)
                            ->orderBy('id', 'asc')
                            ->get();

		$html = '<option value="">Seleccione</option>';
		foreach ($clientes as $key => $item) {
			$selected = NULL;
			$html .= "<option value='$item->id' data-tipo-identificacion='$item->tipo_identificacion' data-numero-identificacion='$item->numero_identificacion' $selected>$item->razon_social</option>";
		}
                   
		return response()->json(['success'=>true, 'item'=>$html]);
	}

    public function verificaCodigoContrato(Request $request)
    {
        if ($request->codigo !== "SIN CODIGO") {
            $cont = Contrato::where('codigo', $request->codigo)->count();
            return response()->json(['cont' => $cont]);
        }
        return response()->json(['cont' => 0]);
    }

    public function create()
    {
        if(auth()->user()->id==1){
            $aeropuertos = Aeropuerto::where('estado', 1)->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        } else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;

            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            $aeropuertos = Aeropuerto::whereIn('regional',$array)->where('estado', 1)->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        }

        $tipossolicitante=TipoSolicitante::where('id','>',0)->orderBy('id', 'asc')->get();
        $clientes=Cliente::where('id','>',0)->orderBy('razon_social', 'asc')->get();
        $expedidos=Expedido::where('id','>',0)->orderBy('id', 'asc')->get();
        $contrato=new Contrato();

        return view('contratos.lista.create',compact('contrato', 'aeropuertos', 'tipossolicitante', 'clientes', 'expedidos'));
    }

    public function store(ContratoRequest $request)
    {
        $fechaHoraActual = Carbon::now()->format('Y-m-d H:i:s');
        $contrato=new Contrato();
    
        $contrato->codigo = $request->codigo;
        $contrato->aeropuerto = $request->aeropuerto;
        $contrato->fecha_hora_registro = $fechaHoraActual;
        $contrato->tipo_solicitante = $request->tipo_solicitante;
        $contrato->cliente = $request->cliente;
        $cliente = Cliente::find($request->cliente);
        $tipoIdentificacion = TipoIdentificacion::find($cliente->tipo_identificacion);
        
        if ($tipoIdentificacion->descripcion == 'CI') 
            $contrato->ci = $request->ci_o;
        else
            $contrato->nit = $request->nit_o;

        $contrato->domicilio_legal = $request->domicilio_legal;
        $contrato->telefono_celular = $request->telefono_celular;
        $contrato->correo = $request->correo;
        $contrato->actividad_principal = $request->actividad_principal;
        $contrato->matricula_comercio = $request->matricula_comercio;
        $contrato->estado = 3; 
        $contrato->representante1 = $request->representante1;
        $contrato->numero_documento1 = $request->numero_documento1;
        $contrato->expedido1 = $request->expedido1;
        $contrato->documento_designacion1 = $request->documento_designacion1;
        $contrato->fecha_emision_documento1 = $request->fecha_emision_documento1;
        $contrato->notaria1 = $request->notaria1;
        $contrato->notario1 = $request->notario1;
        $contrato->representante2 = $request->representante2;
        $contrato->numero_documento2 = $request->numero_documento2;
        $contrato->expedido2 = $request->expedido2;
        $contrato->documento_designacion2 = $request->documento_designacion2;
        $contrato->fecha_emision_documento2 = $request->fecha_emision_documento2;
        $contrato->notaria2 = $request->notaria2;
        $contrato->notario2 = $request->notario2;
        $contrato->representante3 = $request->representante3;
        $contrato->numero_documento3 = $request->numero_documento3;
        $contrato->expedido3 = $request->expedido3;
        $contrato->documento_designacion3 = $request->documento_designacion3;
        $contrato->fecha_emision_documento3 = $request->fecha_emision_documento3;
        $contrato->notaria3 = $request->notaria3;
        $contrato->notario3 = $request->notario3;
        $contrato->save();
        Alert::success("Contrato registrado correctamente!");
        return redirect()->route('contratos.index');
    }

    public function edit(Contrato $contrato)
    {
        $aeropuertos=Aeropuerto::where('id','>',0)->orderBy('id', 'asc')->get();
        $tipossolicitante=TipoSolicitante::where('id','>',0)->orderBy('id', 'asc')->get();
        $clientes = Cliente::where('estado', 1)->where('tipo_solicitante', $contrato->tipo_solicitante)->orderBy('razon_social', 'asc')->get();
        $expedidos=Expedido::where('id','>',0)->orderBy('id', 'asc')->get();
        return view('contratos.lista.edit',compact('contrato', 'aeropuertos', 'tipossolicitante', 'clientes', 'expedidos'));
    }

    public function update(Request $request, Contrato $contrato)
    {
        $contrato->codigo = $request->codigo;
        $contrato->aeropuerto = $request->aeropuerto;
        $contrato->tipo_solicitante = $request->tipo_solicitante;
        $contrato->cliente = $request->cliente;
        $cliente = Cliente::find($contrato->cliente);

        if ($cliente->tipo_identificacion == 1){ 
            $contrato->ci = $request->ci_o;
            $contrato->nit = null;
        }else{
            $contrato->nit = $request->nit_o;
            $contrato->ci = null;
        }
        
        $contrato->domicilio_legal = $request->domicilio_legal;
        $contrato->telefono_celular = $request->telefono_celular;
        $contrato->correo = $request->correo;
        $contrato->actividad_principal = $request->actividad_principal;
        $contrato->matricula_comercio = $request->matricula_comercio;
        $contrato->representante1 = $request->representante1;
        $contrato->numero_documento1 = $request->numero_documento1;
        $contrato->expedido1 = $request->expedido1;
        $contrato->documento_designacion1 = $request->documento_designacion1;
        $contrato->fecha_emision_documento1 = $request->fecha_emision_documento1;
        $contrato->notaria1 = $request->notaria1;
        $contrato->notario1 = $request->notario1;
        $contrato->representante2 = $request->representante2;
        $contrato->numero_documento2 = $request->numero_documento2;
        $contrato->expedido2 = $request->expedido2;
        $contrato->documento_designacion2 = $request->documento_designacion2;
        $contrato->fecha_emision_documento2 = $request->fecha_emision_documento2;
        $contrato->notaria2 = $request->notaria2;
        $contrato->notario2 = $request->notario2;
        $contrato->representante3 = $request->representante3;
        $contrato->numero_documento3 = $request->numero_documento3;
        $contrato->expedido3 = $request->expedido3;
        $contrato->documento_designacion3 = $request->documento_designacion3;
        $contrato->fecha_emision_documento3 = $request->fecha_emision_documento3;
        $contrato->notaria3 = $request->notaria3;
        $contrato->notario3 = $request->notario3;

        $contrato->save();

        //actualice los roles
        return redirect()->route('contratos.index');
    }

    public function destroy(Contrato $contrato)
    {
        $espaciosIds = Espacio::where('contrato', $contrato->id)->pluck('id');
    
        if ($espaciosIds->isNotEmpty()) {
            EspacioExpensa::whereIn('espacio', $espaciosIds)->delete();
        }

        Espacio::where('contrato', $contrato->id)->delete();

        $contrato->delete();
        
        Alert::success('Contrato eliminado correctamente');
        return redirect()->route('contratos.index');
    }

    public function send(Contrato $contrato)
    {        
        // Actualiza estado de espacios a Pendiente
        $espacios = Espacio::where('contrato', $contrato->id)->get();

        foreach ($espacios as $espacio) {
            $espacio->estado = 4;
            $espacio->save();
        }

        // Actualiza estado de Contrato a Pendiente
        $contrato->estado = 4; 
        $contrato->save();

        Alert::success('Contrato enviado para Aprobar');
        return redirect()->route('contratos.index');
    }

    /*public function show()
    {
        $pdf = App::make('dompdf.wrapper');
        $expensas = View_Expensa::all();
        $pdf->loadView('parametricas.expensas.pdf.reportegral',compact('expensas'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new ExpensasExport, 'expensas.xlsx');
    }*/

    public function createEspacio(Contrato $contrato)
    {
        //dd($contrato);
        $aeropuertos=Aeropuerto::where('id', $contrato->aeropuerto)->first();
        $clientes=Cliente::where('id', $contrato->cliente)->first();
        $rubros=Rubro::where('estado', 1)->orderBy('id', 'asc')->get();
        $unidadesmedida=UnidadMedida::where('estado', 1)->orderBy('id', 'asc')->get();
        $formaspago=FormaPago::where('estado', 1)->orderBy('id', 'asc')->get();
        $espacio=new Espacio();
        $listaespacios=View_Espacio::where('contrato', $contrato->id)->whereNull('deleted_at')->get();
        $expensas = Expensa::where('estado', 1)->orderBy('id', 'asc')->get();
        return view('contratos.lista.create_espacio',compact('contrato', 'aeropuertos', 'clientes', 'rubros', 'unidadesmedida', 'formaspago', 'espacio', 'listaespacios', 'expensas'));
    }

    public function storeEspacio(EspacioRequest $request)
    {
        //dd($request);
        // Obtener el array de lista_expensas desde la solicitud
        $listaExpensas = $request->input('lista_expensas');

        // Guardar en la tabla espacio
        $espacio=new Espacio();
        $espacio->contrato = $request->contrato;
        $espacio->tipo_canon = $request->tipo_canon;
        $espacio->rubro = $request->rubro;
        $espacio->ubicacion = $request->ubicacion;
        $espacio->cantidad = $request->cantidad;
        $espacio->unidad_medida = $request->unidad_medida;
        $espacio->precio_unitario = $request->precio_unitario;
        $espacio->fecha_inicial = $request->fecha_inicial;
        $espacio->fecha_final = $request->fecha_final;
        $espacio->total_canonmensual = $request->total_canonmensual_o;
        $espacio->opcion_dcto = $request->opcion_dcto; 
        $espacio->canon_dcto = $request->canon_dcto_o;
        $espacio->garantia = $request->garantia_o;
        $espacio->cobro_expensa = $request->cobro_expensa;
        $espacio->forma_pago = $request->forma_pago;
        $espacio->numero_dia = $request->numero_dia_o;
        $espacio->objeto_contrato = $request->objeto_contrato;
        $espacio->glosa_factura = $request->glosa_factura;
        $espacio->tipo_espacio = $request->tipo_espacio;
        $espacio->estado = 3;
        $espacio->save();

        $espacioId = $espacio->id;


        
        foreach ($listaExpensas as $expensaId => $expensa) {
            // Validar que el campo 'expensa' esté marcado como seleccionado
            if ($expensa['expensa'] != '0') {
                $espacioExpensa=new EspacioExpensa();
                $espacioExpensa->espacio=$espacioId;
                $espacioExpensa->expensa=$expensa['expensa'];
                $espacioExpensa->tarifa_fija=$expensa['tarifa_fija'];
                $espacioExpensa->monto=$expensa['monto'] ?? null;
                $espacioExpensa->save();
                
            }
        }

        Alert::success("Espacio registrado correctamente!");
        return redirect()->back();
    }

    public function editEspacio($id_contrato, Espacio $espacio)
    {
        //dd($espacio->id);
        $contrato=Contrato::where('id', $id_contrato)->first();

        $aeropuerto=Contrato::where('id', $id_contrato)->first();
        $aeropuertos=Aeropuerto::where('id', $aeropuerto->aeropuerto)->first();

        $cliente=Contrato::where('id', $id_contrato)->first();
        $clientes=Cliente::where('id', $cliente->cliente)->first();


        $rubros=Rubro::where('id','>',0)->orderBy('id', 'asc')->get();
        $unidadesmedida=UnidadMedida::where('id','>',0)->orderBy('id', 'asc')->get();
        $formaspago=FormaPago::where('id','>',0)->orderBy('id', 'asc')->get();
        $listaespacios=View_Espacio::where('contrato', $id_contrato)->whereNull('deleted_at')->get();
        $expensas = Expensa::where('id','>',0)->orderBy('id', 'asc')->get();
        $espacioexpensas=EspacioExpensa::where('espacio', $espacio->id)->orderBy('id', 'asc')->get();
        //dd($espacioexpensas);
        return view('contratos.lista.edit_espacio',compact('contrato', 'aeropuertos', 'clientes', 'rubros', 'unidadesmedida', 'formaspago', 'espacio', 'listaespacios', 'expensas', 'espacioexpensas'));
    }

    public function updateEspacio(EspacioRequest $request, Espacio $espacio)
    {   
        $listaExpensas = $request->input('lista_expensas');
        
        $espacio->tipo_canon = $request->tipo_canon;
        $espacio->rubro = $request->rubro;
        $espacio->ubicacion = $request->ubicacion;
        $espacio->cantidad = $request->cantidad;
        $espacio->unidad_medida = $request->unidad_medida;
        $espacio->precio_unitario = $request->precio_unitario;
        $espacio->fecha_inicial = $request->fecha_inicial;
        $espacio->fecha_final = $request->fecha_final;
        $espacio->total_canonmensual = $request->total_canonmensual_o;
        $espacio->opcion_dcto = $request->opcion_dcto; 
        $espacio->canon_dcto = $request->canon_dcto_o;
        $espacio->garantia = $request->garantia_o;
        $espacio->cobro_expensa = $request->cobro_expensa;
        $espacio->forma_pago = $request->forma_pago;
        $espacio->numero_dia = $request->numero_dia_o;
        $espacio->objeto_contrato = $request->objeto_contrato;
        $espacio->glosa_factura = $request->glosa_factura;
        $espacio->tipo_espacio = $request->tipo_espacio;
        $espacio->save();

        $espacioId = $espacio->id;

        // Obtener los IDs de expensas que se mantienen seleccionadas
        $expensasSeleccionadas = array_column($listaExpensas, 'expensa');

        // Eliminar expensas no seleccionadas
        EspacioExpensa::where('espacio', $espacioId)
                    ->whereNotIn('expensa', $expensasSeleccionadas)
                    ->delete();
        
        foreach ($listaExpensas as $expensaId => $expensa) {
            // Validar que el campo 'expensa' esté marcado como seleccionado
            if ($expensa['expensa'] != '0') {

                // Verificar si ya existe una relación entre el espacio y la expensa
                $espacioExpensa = EspacioExpensa::withTrashed()
                                                ->where('espacio', $espacioId)
                                                ->where('expensa', $expensa['expensa']) 
                                                ->first();

                if ($espacioExpensa) {
                    // Si ya existe, actualizarla
                    $espacioExpensa->tarifa_fija = $expensa['tarifa_fija'];
                    $espacioExpensa->monto = $expensa['monto'] ?? null;
                    $espacioExpensa->deleted_at = null;
                    $espacioExpensa->save();
                } else {
                    // Si no existe, crear una nueva
                    $espacioExpensa = new EspacioExpensa();
                    $espacioExpensa->espacio = $espacioId;
                    $espacioExpensa->expensa = $expensa['expensa'];
                    $espacioExpensa->tarifa_fija = $expensa['tarifa_fija'];
                    $espacioExpensa->monto = $expensa['monto'] ?? null;
                    $espacioExpensa->save();
                }
            }
        }

        Alert::success("Espacio modificado correctamente!");

        //actualice los roles
        return redirect()->route('contratos.create_espacio', ['contrato' => $request->contrato]);
    }

    public function destroyEspacio(Espacio $espacio)
    {
        EspacioExpensa::where('espacio', $espacio->id)->delete();
        $espacio->delete();

        Alert::success('Espacio eliminado correctamente!');
        return redirect()->back();
    }
}
