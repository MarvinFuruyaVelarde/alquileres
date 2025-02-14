<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelarContratoRequest;
use App\Http\Requests\EspacioRequest;
use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\ContratoCancelado;
use App\Models\Espacio;
use App\Models\EspacioExpensa;
use App\Models\Expensa;
use App\Models\FormaPago;
use App\Models\Rubro;
use App\Models\UnidadMedida;
use App\Models\View_Contrato;
use App\Models\View_Espacio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CancelarContratoController extends Controller
{
    public function index()
    {
        $contratos = View_Contrato::whereIn('estado', [5, 6])->orderBy('id', 'asc')->get(); // Obtener todos los contratos aprobados
        return view('contratos.cancelar.index', compact('contratos')); // Pasar a la vista
    }

    public function edit(Contrato $contrato)
    {
        $aeropuertos = Aeropuerto::find($contrato->aeropuerto);
        $clientes=Cliente::find($contrato->cliente);
        $listaespacios=View_Espacio::where('contrato', $contrato->id)->where('estado', 5)->whereNull('deleted_at')->get();
        return view('contratos.cancelar.edit',compact('contrato', 'aeropuertos', 'clientes', 'listaespacios'));
    }

    public function update(CancelarContratoRequest $request, Contrato $contrato)
    {
        //dd( $request->codigo);
        // Generar el nombre del archivo
        $timestamp = now()->format('YmdHis');
        $name = "{$timestamp}_{$contrato->id}";
        $extension = $request->file('documento_respaldo')->extension();
        $nombre_documento = "{$name}.{$extension}";

        // Almacenar el archivo
        $path = public_path('/contrato_cancelado');
        $request->file('documento_respaldo')->move($path, $nombre_documento);    
        
        //dd($path.'/'.$nombre_documento);

        // Guardar en la BD 
        $contrato_cancelado = New ContratoCancelado();

        $contrato_cancelado->contrato = $contrato->id;
        $contrato_cancelado->objetivo = $request->objetivo;
        $contrato_cancelado->motivo = $request->motivo;
        $contrato_cancelado->ruta_documento = $path.'/'.$nombre_documento;

        if ($request->objetivo == 'M'){
            $contrato_cancelado->codigo_nuevo = $request->codigo;
            $contrato_cancelado->codigo_anterior = $contrato->codigo;
        }

        $contrato_cancelado->save();

        //Cambia el estado a los espacios del contrato 
        $espacios = Espacio::where('contrato', $contrato->id)->get();

        // Recorrer cada espacio y actualizar su estado a Modificado
        foreach ($espacios as $espacio) {

            if ($request->objetivo == 'M')
                $espacio->estado = 6;
            else 
                $espacio->estado = 7;

            $espacio->save();
        }

        
        if ($request->objetivo == 'M'){
            $contrato->codigo = $request->codigo;    
            $contrato->estado = 6;
        } else {
            $contrato->estado = 7;
        } 

        // Guardar los cambios
        $contrato->save();
        Alert::success("Contrato cancelado correctamente");

        return redirect()->route('cancelarcontratos.index');
    }

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
        return view('contratos.cancelar.create_espacio',compact('contrato', 'aeropuertos', 'clientes', 'rubros', 'unidadesmedida', 'formaspago', 'espacio', 'listaespacios', 'expensas'));
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
        return view('contratos.cancelar.edit_espacio',compact('contrato', 'aeropuertos', 'clientes', 'rubros', 'unidadesmedida', 'formaspago', 'espacio', 'listaespacios', 'expensas', 'espacioexpensas'));
    }

    public function updateEspacio(EspacioRequest $request, Espacio $espacio)
    {   
        //Actualizar Información del Contrato 
        $cliente = Cliente::find($request->id_cliente);
        $contrato = Contrato::find($request->id_cliente);
        $contrato->tipo_solicitante = $cliente->tipo_solicitante;
        if ($cliente->tipo_identificacion == 1){
            $contrato->ci = $cliente->numero_identificacion;
            $contrato->nit = null;
        } else{
            $contrato->nit = $cliente->numero_identificacion;
            $contrato->ci = null;
        }
        $contrato->save();
        
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
        $espacio->estado = $request->estado;
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
                $espacioExpensa = EspacioExpensa::where('espacio', $espacioId)
                                                ->where('expensa', $expensa['expensa'])
                                                ->first();

                if ($espacioExpensa) {
                    // Si ya existe, actualizarla
                    $espacioExpensa->tarifa_fija = $expensa['tarifa_fija'];
                    $espacioExpensa->monto = $expensa['monto'];
                    $espacioExpensa->save();
                } else {
                    // Si no existe, crear una nueva
                    $espacioExpensa = new EspacioExpensa();
                    $espacioExpensa->espacio = $espacioId;
                    $espacioExpensa->expensa = $expensa['expensa'];
                    $espacioExpensa->tarifa_fija = $expensa['tarifa_fija'];
                    $espacioExpensa->monto = $expensa['monto'];
                    $espacioExpensa->save();
                }
            }
        }

        Alert::success("Espacio modificado correctamente!");

        //actualice los roles
        return redirect()->route('cancelarcontratos.create_espacio', ['contrato' => $request->contrato]);
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
        return redirect()->route('cancelarcontratos.index');
    }
}
