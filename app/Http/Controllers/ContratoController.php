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
use App\Models\TipoSolicitante;
use App\Models\UnidadMedida;
use App\Models\View_Contrato;
use App\Models\View_Espacio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class ContratoController extends Controller
{
    public function index()
    {
        $contratos = View_Contrato::where('estado','=',3)->orderBy('id', 'asc')->get(); // Obtener todos los contratos registrados
        return view('contratos.lista.index', compact('contratos')); // Pasar a la vista
    }

    public function create()
    {
        $aeropuertos=Aeropuerto::where('id','>',0)->orderBy('id', 'asc')->get();
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
        if ($request->tipo_solicitante == 1) 
            $contrato->ci = $request->ci;
        else
            $contrato->nit = $request->nit;
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
        $clientes=Cliente::where('id','>',0)->orderBy('razon_social', 'asc')->get();
        $expedidos=Expedido::where('id','>',0)->orderBy('id', 'asc')->get();
        return view('contratos.lista.edit',compact('contrato', 'aeropuertos', 'tipossolicitante', 'clientes', 'expedidos'));
    }

    public function update(Request $request, Contrato $contrato)
    {
        /*dd("llega");
        $request->validate( [
            'descripcion'=>'required',
            'factor'=>'required',
            'estado'=>'required',
        ],[
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'factor.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );*/
        
        $contrato->codigo = $request->codigo;
        $contrato->aeropuerto = $request->aeropuerto;
        $contrato->tipo_solicitante = $request->tipo_solicitante;
        $contrato->cliente = $request->cliente;
        if ($request->tipo_solicitante == 1) 
            $contrato->ci = $request->ci;
        else
            $contrato->nit = $request->nit;
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
        $rubros=Rubro::where('id','>',0)->orderBy('id', 'asc')->get();
        $unidadesmedida=UnidadMedida::where('id','>',0)->orderBy('id', 'asc')->get();
        $formaspago=FormaPago::where('id','>',0)->orderBy('id', 'asc')->get();
        $espacio=new Espacio();
        $listaespacios=View_Espacio::where('contrato', $contrato->id)->get();
        $expensas = Expensa::where('id','>',0)->orderBy('id', 'asc')->get();
        return view('contratos.lista.create_espacio',compact('contrato', 'aeropuertos', 'clientes', 'rubros', 'unidadesmedida', 'formaspago', 'espacio', 'listaespacios', 'expensas'));
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
        $listaespacios=View_Espacio::where('contrato', $id_contrato)->get();
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
        $espacio->total_canonmensual = $request->total_canonmensual;
        $espacio->opcion_dcto = $request->opcion_dcto; 
        $espacio->canon_dcto = $request->canon_dcto;
        $espacio->garantia = $request->garantia;
        $espacio->cobro_expensa = $request->cobro_expensa;
        $espacio->forma_pago = $request->forma_pago;
        $espacio->numero_dia = $request->numero_dia;
        $espacio->objeto_contrato = $request->objeto_contrato;
        $espacio->glosa_factura = $request->glosa_factura;
        $espacio->tipo_espacio = $request->tipo_espacio;
        $espacio->save();

        $espacioId = $espacio->id;
        
        foreach ($listaExpensas as $expensaId => $expensa) {
            // Validar que el campo 'expensa' esté marcado como seleccionado
            if ($expensa['expensa'] != '0') {
                $espacioExpensa=new EspacioExpensa();
                $espacioExpensa->espacio=$espacioId;
                $espacioExpensa->expensa=$expensa['expensa'];
                $espacioExpensa->tarifa_fija=$expensa['tarifa_fija'];
                $espacioExpensa->monto=$expensa['monto'];
                $espacioExpensa->save();
                
            }
        }

        Alert::success("Espacio modificado correctamente!");

        //actualice los roles
        return redirect()->route('contratos.create_espacio', ['contrato' => $request->contrato]);
    }

    public function destroyEspacio(Espacio $espacio)
    {
        $espacio->delete();
        
        Alert::success('Espacio eliminado correctamente!');
        return redirect()->back();
    }
}
