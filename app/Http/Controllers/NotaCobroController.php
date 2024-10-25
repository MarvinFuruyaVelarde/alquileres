<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Contrato;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\FormaPago;
use App\Models\NotaCobro;
use App\Models\Regional;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NotaCobroController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('id','>',0)->orderBy('id', 'asc')->get();
        return view('facturacion.notascobro.index',compact('aeropuertos'/*, 'clientes'*/));
    }

    public function generaNotaCobro(Request $request) 
    {
        $aeropuerto = $request->query('aeropuerto');
        $fechaRegistro = Carbon::now()->format('Y-m-d H:i:s');
        $periodoFacturacion = $request->query('periodoFacturacion');
        $periodoInicialFacturacion = Carbon::parse($periodoFacturacion)->startOfMonth()->toDateString();
        $numeroDiaFac = Carbon::parse($periodoFacturacion)->daysInMonth;
        $tipo = $request->query('tipo');
        $codAeropuerto = Aeropuerto::where('id', $aeropuerto)->value('codigo');
        $regionalAeropuerto = Aeropuerto::where('id', $aeropuerto)->value('regional');
        $codRegional = Regional::where('id', $regionalAeropuerto)->value('codigo');
        $mes = Carbon::parse($periodoFacturacion)->format('m');
        $anio = Carbon::parse($periodoFacturacion)->format('Y');

        // Llama a la función para generar todos los contratos dado el aeropuerto y periodo de facturación
        $notasCobro = NotaCobro::generaNotaCobro($aeropuerto, $periodoFacturacion);

        // Generar el secuencial
        $notaCobroGeneradas = collect($notasCobro)->map(function ($nota, $index) use ($tipo, $codRegional, $codAeropuerto, $mes, $anio) {
            $nota->correlativo = $index + 1;
            $nota->numero_nota_cobro = $tipo.'/'.$codRegional.'/COM/'.$codAeropuerto.'/'.$mes.'/'.$anio.'/'.$index + 1; // Inicia el conteo en 1
            return $nota;
        });

        $html1='  
        <style>
        .oculto {
            display: none; /* Oculta el elemento */
        }
        </style>
        <div class="table-responsive">
        <table cellspacing="0" width="150%" id="tabla" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">NÚMERO NOTA DE COBRO</th>
                        <th class="text-center">NOMBRE DEL CLIENTE</th>
                        <th class="text-center">TIPO DE CANON</th>
                        <th class="text-center">FORMA DE PAGO</th>
                        <th class="text-center">OPCIONES</th>
                    </tr>
                </thead>';  

        $cont = 0; 
        //dd($notaCobroGeneradas);
        foreach ($notaCobroGeneradas as $notaCobroGenerada) {
            // Verifica si ya existe en la estructura factura el contrato para la gestión, mes ingresado y tipo de canon
            $registroExistente = Factura::where('contrato', $notaCobroGenerada->id_contrato)
                                ->where('gestion', $anio)
                                ->where('mes', $mes)
                                ->where('tipo_canon', $notaCobroGenerada->tipo_canon)
                                ->exists();

            if (!$registroExistente) {
                $cont++;
                //Almacena datos de notas de cobro en la estructura factura
                $factura = New Factura();
                $factura->aeropuerto = $aeropuerto;
                $factura->contrato = $notaCobroGenerada->id_contrato;
                $factura->codigo_contrato = $notaCobroGenerada->codigo_contrato;
                $factura->numero_nota_cobro = $notaCobroGenerada->numero_nota_cobro;
                $factura->orden_impresion = $notaCobroGenerada->correlativo;
                $factura->gestion = $anio;
                $factura->mes = $mes;
                $factura->tipo_solicitante = $notaCobroGenerada->tipo_solicitante;
                if ($notaCobroGenerada->tipo_solicitante == 1) 
                    $factura->ci = $notaCobroGenerada->ci;
                else
                    $factura->nit = $notaCobroGenerada->nit;
                $factura->tipo_canon = $notaCobroGenerada->tipo_canon;
                $factura->forma_pago = $notaCobroGenerada->id_forma_pago;
                $factura->tipo_factura = 'AL';
                $factura->cliente = $notaCobroGenerada->id_cliente;
                $factura->razon_social_factura = $notaCobroGenerada->razon_social;
                $factura->estado = 3;
                $factura->usuario_registro = auth()->id();
                $factura->fecha_registro = $fechaRegistro;
                $factura->save();

                $facturaId = $factura->id;

                // Registra Factura Detalle
                $espacios = NotaCobro::obtenerEspaciosPorContrato($notaCobroGenerada->origen, $notaCobroGenerada->id_contrato, $notaCobroGenerada->id_forma_pago, $periodoInicialFacturacion, $periodoFacturacion, $notaCobroGenerada->tipo_canon, $notaCobroGenerada->numero);
                //dd($espacios);
                foreach ($espacios as $espacio) {

                    $facturaDetalle = New FacturaDetalle();
                    $facturaDetalle->factura = $facturaId;
                    $facturaDetalle->espacio = $espacio->id;
                    $facturaDetalle->concepto = $notaCobroGenerada->tipo_canon;
                    $facturaDetalle->fecha_inicial = $espacio->fecha_inicial;
                    $facturaDetalle->fecha_final = $espacio->fecha_final;
                    $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($espacio->fecha_inicial, $espacio->fecha_final, $periodoInicialFacturacion, $periodoFacturacion);
                    $facturaDetalle->total_canonmensual = $espacio->total_canonmensual;
                    $facturaDetalle->precio = ($espacio->total_canonmensual/$numeroDiaFac) * NotaCobro::obtenerDiasAFacturar($espacio->fecha_inicial, $espacio->fecha_final, $periodoInicialFacturacion, $periodoFacturacion);
                    $facturaDetalle->usuario_registro = auth()->id();
                    $facturaDetalle->fecha_registro = $fechaRegistro;
                    $facturaDetalle->save();
                }

                $tipoCanon = $notaCobroGenerada->tipo_canon == 'F' ? 'FIJO' : ($notaCobroGenerada->tipo_canon == 'V' ? 'VARIABLE' : $notaCobroGenerada->tipo_canon);
                //Genera html con las notas de cobro dado el preiodo de facturación
                $html1.="<tbody>
                         <tr>
                         <td class='oculto'><input type='text' name='id_espacio[]' value='{$notaCobroGenerada->id_contrato}'/></td>
                         <td class='text-center'>{$notaCobroGenerada->numero_nota_cobro}</td>
                         <td class='text-center'>{$notaCobroGenerada->razon_social}</td>
                         <td class='text-center'>{$tipoCanon}</td>
                         <td class='text-center'>{$notaCobroGenerada->forma_pago}</td>
                         <td class='d-flex justify-content-center'>
                            <a href='" . route('facturacion.show', $notaCobroGenerada->id_contrato) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar Plantilla' target='_blank'></a>
                         </td>
                         </tr>
                         </tbody>";
            } 
        }

        if ($cont == 0){
            $html1.="<tbody>
                     <tr>
                     <td class='text-center' colspan='5'>No existe notas de cobro para los datos ingresados</td>
                     </tr>
                     </tbody>";
        }
        $html1.="</table>
                 </div>
                 " ;      

        return response()->json(['success'=>true, 'item1'=>$html1]);
    }

    public function obtieneCliente($aeropuerto, $cliente=NULL) 
    {
        $clientes = Contrato::select('cliente')
                    ->selectRaw('(SELECT razon_social FROM cliente WHERE id = cliente) AS razon_social')
                    ->where('aeropuerto', $aeropuerto)
                    ->groupBy('cliente')
                    ->orderBy('cliente')
                    ->get();

		$html = '<option value="">Seleccione</option>';
		foreach ($clientes as $key => $item) {
			$selected = NULL;
			$html .= "<option value='$item->cliente' $selected>$item->razon_social</option>";
		}
                   
		return response()->json(['success'=>true, 'item'=>$html]);
	}

    public function visualizaNotaCobro(Request $request) 
    {
        $aeropuerto = $request->query('aeropuerto');
        $periodoFacturacion = $request->query('periodoFacturacion');
        $fecha = new DateTime($periodoFacturacion);
        $mes = $fecha->format('m'); 
        $gestion = $fecha->format('Y');
        $tipo = $request->query('tipo');
        $cliente = $request->query('cliente');

        // Llama a la función para generar todos los contratos dado el aeropuerto y periodo de facturación
        $notasCobro = NotaCobro::visualizaNotaCobro($mes, $gestion, $tipo, $aeropuerto, $cliente);

        $html1='  
        <style>
        .oculto {
            display: none; /* Oculta el elemento */
        }
        </style>
        <div class="table-responsive">
        <table cellspacing="0" width="150%" id="tabla" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">NÚMERO NOTA DE COBRO</th>
                        <th class="text-center">NOMBRE DEL CLIENTE</th>
                        <th class="text-center">TIPO DE CANON</th>
                        <th class="text-center">FORMA DE PAGO</th>
                        <th class="text-center">OPCIONES</th>
                        <th class="text-center"><input type="checkbox" id="check-all" class="form-check-input" title="Seleccionar/Deseleccionar nota(s) de cobro"></th>
                    </tr>
                </thead>';

        $cont = 0; 

        foreach ($notasCobro as $notaCobro) {
            $cont++;
            
            $forma_pago = FormaPago::find($notaCobro->forma_pago);
            
            $tipoCanon = $notaCobro->tipo_canon == 'F' ? 'FIJO' : ($notaCobro->tipo_canon == 'V' ? 'VARIABLE' : $notaCobro->tipo_canon);
            //Visualiza html con las notas de cobro dado el preiodo de facturación
            $html1.="<tbody>
            <tr>
            <td class='oculto'><input type='text' name='id_espacio[]' value='{$notaCobro->contrato}'/></td>
            <td class='text-center'>{$notaCobro->numero_nota_cobro}</td>
            <td class='text-center'>{$notaCobro->razon_social_factura}</td>
            <td class='text-center'>{$tipoCanon}</td>
            <td class='text-center'>{$forma_pago->descripcion}</td>
            <td class='d-flex justify-content-center'>
               <a href='" . route('facturacion.show', $notaCobro->contrato) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar nota de cobro' target='_blank'></a>
               <a href='" . route('facturacion.show', $notaCobro->contrato) . "' class='btn btn-warning bi bi-pencil-square' title='Modificar nota de cobro' target='_blank'></a>
            </td>
            <td class='text-center'><input type='checkbox' name='aprobado[]' value='{$notaCobro->id}' class='form-check-input' title='Aprobar nota de cobro'></td>
            </tr>
            </tbody>";

        }

        if ($cont == 0){
            $html1.="<tbody>
                     <tr>
                     <td class='text-center' colspan='5'>No existe notas de cobro para los datos ingresados</td>
                     </tr>
                     </tbody>";
        }

        $html1.="</table>
                 </div>
                 " ;    
        return response()->json(['success'=>true, 'item1'=>$html1]);
    }

    public function aprobarNotaCobro(Request $request)
    {
        // Verifica que el array 'aprobado' existe y contiene IDs
        if (isset($request->aprobado) && is_array($request->aprobado)) {
            // Actualiza el estado de todas las facturas con los IDs en el array
            Factura::whereIn('id', $request->aprobado)->update(['estado' => 5]); 
            
            //return response()->json(['success' => true, 'message' => 'Las notas de cobro han sido aprobadas.']);
            Alert::success('Las notas de cobro han sido aprobadas correctamente');
            //return redirect()->back();
            return redirect()->back();
        }

        // Si no se recibe el array 'aprobado' o es inválido, lanza un error
        return response()->json(['success' => false, 'message' => 'No se recibieron notas de cobro para aprobar.'], 400);
    }
}
