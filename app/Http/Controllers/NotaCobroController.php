<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Espacio;
use App\Models\EspacioExpensa;
use App\Models\Expensa;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\FormaPago;
use App\Models\NotaCobro;
use App\Models\Regional;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\App;

class NotaCobroController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('id','>',0)->orderBy('id', 'asc')->get();
        return view('facturacion.notascobro.index',compact('aeropuertos'));
    }

    public function generaNotaCobro(Request $request) 
    {
        $tipo = $request->query('tipo');

        if ($tipo == 'AL')
            $html1 = $this->generaNotaCobroAlquiler($request);
        else if ($tipo == 'EX')
            $html1 = $this->generaNotaCobroExpensa($request);

        return response()->json(['success'=>true, 'item1'=>$html1]);
    }

    public function generaNotaCobroAlquiler(Request $request) 
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
        $notasCobro = NotaCobro::generaNotaCobroAlquiler($aeropuerto, $periodoFacturacion);
        $ordenImpresion = NotaCobro::obtenerMaxOrdenImpresion($tipo, $mes, $anio, $aeropuerto);
        // Generar el secuencial
        $notaCobroGeneradas = collect($notasCobro)->map(function ($nota) use ($tipo, $codRegional, $codAeropuerto, $mes, $anio, &$ordenImpresion) {
            $nota->correlativo = $ordenImpresion;
            $nota->numero_nota_cobro = $tipo.'/'.$codRegional.'/COM/'.$codAeropuerto.'/'.$mes.'/'.$anio.'/'.$ordenImpresion;
            $ordenImpresion++;
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
                                ->where('espacio', $notaCobroGenerada->id_espacio)
                                ->exists();

            if (!$registroExistente) {
                $cont++;
                //Almacena datos de notas de cobro en la estructura factura
                $factura = New Factura();
                $factura->aeropuerto = $aeropuerto;
                $factura->espacio = $notaCobroGenerada->id_espacio;
                $factura->contrato = $notaCobroGenerada->id_contrato;
                $factura->codigo_contrato = $notaCobroGenerada->codigo_contrato;
                $factura->numero_nota_cobro = $notaCobroGenerada->numero_nota_cobro;
                $factura->orden_impresion = $notaCobroGenerada->correlativo;
                $factura->mes = $mes;
                $factura->gestion = $anio;
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
                $factura->tipo_generacion = 'A';
                $factura->estado = 3;
                $factura->usuario_registro = auth()->id();
                $factura->fecha_registro = $fechaRegistro;
                $factura->save();

                $facturaId = $factura->id;
                //dd($notaCobroGenerada->origen.' '.$notaCobroGenerada->id_contrato.' '.$notaCobroGenerada->id_forma_pago.' '.$periodoInicialFacturacion.' '.$periodoFacturacion.' '.$notaCobroGenerada->tipo_canon.' '.$notaCobroGenerada->numero);
                // Registra Factura Detalle
                $espacios = NotaCobro::obtenerEspaciosPorContrato($notaCobroGenerada->origen, $notaCobroGenerada->id_contrato, $notaCobroGenerada->id_forma_pago, $periodoInicialFacturacion, $periodoFacturacion, $notaCobroGenerada->tipo_canon, $notaCobroGenerada->numero);
                $monto_total = 0;
                foreach ($espacios as $espacio) {
                    //Obtiene Forma de Pago 
                    $consultaEspacio = Espacio::find($espacio->id);
                    $formaPago = FormaPago::find($consultaEspacio->forma_pago);
                    $numeroMes = $formaPago->numero_mes;

                    //dd($consultaEspacio);
                    $facturaDetalle = New FacturaDetalle();
                    $facturaDetalle->factura = $facturaId;
                    $facturaDetalle->espacio = $espacio->id;
                    $facturaDetalle->concepto = $notaCobroGenerada->tipo_canon;
                    $facturaDetalle->fecha_inicial = $espacio->fecha_inicial;
                    $facturaDetalle->fecha_final = $espacio->fecha_final;
                    $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($espacio->fecha_inicial, $espacio->fecha_final, $periodoInicialFacturacion, $periodoFacturacion);
                    $facturaDetalle->total_canonmensual = $espacio->total_canonmensual;
                    
                    //Obtener Fecha de Inicio dado el año, mes de facturación y el dia de inicio de contrato
                    $fechaInicio = Carbon::parse($periodoFacturacion)->format('Y').'-'.Carbon::parse($periodoFacturacion)->format('m').'-'.Carbon::parse($consultaEspacio->fecha_inicial)->format('d'); //2024-07-15
                    $fechaInicioCarbon = Carbon::parse($fechaInicio);
                    $fechaFinalContrato = Carbon::parse($consultaEspacio->fecha_final);// 2024-07-31 
                    $fechaProximoPago = $fechaInicioCarbon->addMonths($numeroMes);
                    
                    // Verifica que monto se obtiene para realizar el calculo
                    if ($consultaEspacio->canon_dcto != null)
                        $canon = $consultaEspacio->canon_dcto;
                    else
                        $canon = $espacio->total_canonmensual;
                    
                    ///dd('fechaInicio '.$fechaInicio.' fechaFinalContrato '.$fechaFinalContrato.' fechaProximoPago '.$fechaProximoPago->toDateString());
                    
                    if ($numeroMes === 1){
                        $facturaDetalle->precio = ($canon/$numeroDiaFac) * NotaCobro::obtenerDiasAFacturar($espacio->fecha_inicial, $espacio->fecha_final, $periodoInicialFacturacion, $periodoFacturacion);
                    } else{
                        // Verifica si habra próximo pago
                        if ($fechaProximoPago > $fechaFinalContrato){
                            $numeroMeses = $fechaFinalContrato->diffInMonths($fechaInicio) ?? 0;
                            if ($numeroMeses > 0){
                                $nuevaFechaInicioCarbon = Carbon::parse($fechaInicio);
                                $nuevaFechaInicio = $nuevaFechaInicioCarbon->addMonths($numeroMeses)->toDateString();
                                $nuevoNumeroDias = $fechaFinalContrato->diffInDays($nuevaFechaInicio) + 1;
                                if ($nuevoNumeroDias > 0){
                                    $facturaDetalle->precio = number_format(($canon * $numeroMeses) + ($canon/$numeroDiaFac * $nuevoNumeroDias), 2, '.', '');
                                }
                            } else{ //Caso donde el calculo es por dias
                                $numeroDias = $fechaFinalContrato->diffInDays($fechaInicio) + 1;
                                $facturaDetalle->precio = number_format(($canon/$numeroDiaFac) * $numeroDias, 2, '.', '');                                
                            }

                        } else {
                            $facturaDetalle->precio = number_format($canon * $numeroMes, 2, '.', '');
                        }                           
                    }
                    $monto_total = $monto_total + $facturaDetalle->precio;
                    $facturaDetalle->usuario_registro = auth()->id();
                    $facturaDetalle->fecha_registro = $fechaRegistro;
                    $facturaDetalle->save();
                }
                
                $factura = Factura::find($facturaId);
                $factura->monto_total = $monto_total;
                $factura->save();

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
                            <a href='" . route('notacobro.show', $facturaId) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar Plantilla' target='_blank'></a>
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

        return $html1;
    }

    public function generaNotaCobroExpensa(Request $request) 
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
        $notasCobro = NotaCobro::generaNotaCobroExpensa($aeropuerto, $periodoFacturacion);
        $ordenImpresion = NotaCobro::obtenerMaxOrdenImpresion($tipo, $mes, $anio, $aeropuerto);

        // Generar el secuencial
        $notaCobroGeneradas = collect($notasCobro)->map(function ($nota) use ($tipo, $codRegional, $codAeropuerto, $mes, $anio, &$ordenImpresion) {
            $nota->correlativo = $ordenImpresion;
            $nota->numero_nota_cobro = $tipo.'/'.$codRegional.'/COM/'.$codAeropuerto.'/'.$mes.'/'.$anio.'/'.$ordenImpresion;
            $ordenImpresion++;
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
                        <th class="text-center">TARIFA</th>
                        <th class="text-center">EXPENSA</th>
                        <th class="text-center">OPCIONES</th>
                    </tr>
                </thead>';  

        $cont = 0; 

        foreach ($notaCobroGeneradas as $notaCobroGenerada) {
            $espacio = Espacio::find($notaCobroGenerada->id_espacio);
            $expensa = Expensa::find($notaCobroGenerada->expensa);
            
            // Verifica si ya existe en la estructura factura la expensa para la gestión, mes ingresado y tipo de canon
            $registroExistente = Factura::where('contrato', $notaCobroGenerada->id_contrato)
                                ->where('gestion', $anio)
                                ->where('mes', $mes)
                                ->where('tipo_canon', $notaCobroGenerada->tarifa_fija)
                                ->where('tipo_factura', $tipo)
                                ->whereHas('facturaDetalle', function ($query) use ($notaCobroGenerada) {
                                    $query->where('expensa', $notaCobroGenerada->expensa);
                                })
                                ->exists();

            if (!$registroExistente) {
                $cont++;
                //Almacena datos de notas de cobro en la estructura factura
                $factura = New Factura();
                $factura->aeropuerto = $aeropuerto;
                $factura->espacio = $notaCobroGenerada->id_espacio;
                $factura->contrato = $notaCobroGenerada->id_contrato;
                $factura->codigo_contrato = $notaCobroGenerada->codigo_contrato;
                $factura->numero_nota_cobro = $notaCobroGenerada->numero_nota_cobro;
                $factura->orden_impresion = $notaCobroGenerada->correlativo;
                $factura->mes = $mes;
                $factura->gestion = $anio;
                $factura->tipo_solicitante = $notaCobroGenerada->tipo_solicitante;
                if ($notaCobroGenerada->tipo_solicitante == 1) 
                    $factura->ci = $notaCobroGenerada->ci;
                else
                    $factura->nit = $notaCobroGenerada->nit;
                $factura->tipo_canon = $notaCobroGenerada->tarifa_fija;
                $factura->forma_pago = $notaCobroGenerada->id_forma_pago;
                $factura->tipo_factura = 'EX';
                $factura->cliente = $notaCobroGenerada->id_cliente;
                $factura->razon_social_factura = $notaCobroGenerada->razon_social;
                $factura->monto_total = ($notaCobroGenerada->monto/$numeroDiaFac) * NotaCobro::obtenerDiasAFacturar($espacio->fecha_inicial, $espacio->fecha_final, $periodoInicialFacturacion, $periodoFacturacion);
                $factura->tipo_generacion = 'A';
                $factura->estado = 3;
                $factura->usuario_registro = auth()->id();
                $factura->fecha_registro = $fechaRegistro;
                $factura->save();

                $facturaId = $factura->id;

                $facturaDetalle = New FacturaDetalle();
                $facturaDetalle->factura = $facturaId;
                $facturaDetalle->espacio = $notaCobroGenerada->id_espacio;
                $facturaDetalle->expensa = $notaCobroGenerada->expensa;
                $facturaDetalle->glosa = 'EXPENSA ('.$expensa->unidad_medida.')';
                $facturaDetalle->concepto = $notaCobroGenerada->tarifa_fija;
                $facturaDetalle->fecha_inicial = $espacio->fecha_inicial;
                $facturaDetalle->fecha_final = $espacio->fecha_final;
                $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($espacio->fecha_inicial, $espacio->fecha_final, $periodoInicialFacturacion, $periodoFacturacion);
                $facturaDetalle->total_canonmensual = $notaCobroGenerada->monto;
                $facturaDetalle->precio = ($notaCobroGenerada->monto/$numeroDiaFac) * NotaCobro::obtenerDiasAFacturar($espacio->fecha_inicial, $espacio->fecha_final, $periodoInicialFacturacion, $periodoFacturacion);
                $facturaDetalle->usuario_registro = auth()->id();
                $facturaDetalle->fecha_registro = $fechaRegistro;
                $facturaDetalle->save();
                

                $tarifaFija = $notaCobroGenerada->tarifa_fija == 'F' ? 'FIJO' : ($notaCobroGenerada->tarifa_fija == 'V' ? 'VARIABLE' : $notaCobroGenerada->tarifa_fija);
                //Genera html con las notas de cobro dado el preiodo de facturación
                $html1.="<tbody>
                         <tr>
                         <td class='oculto'><input type='text' name='id_espacio[]' value='{$notaCobroGenerada->id_contrato}'/></td>
                         <td class='text-center'>{$notaCobroGenerada->numero_nota_cobro}</td>
                         <td class='text-center'>{$notaCobroGenerada->razon_social}</td>
                         <td class='text-center'>{$tarifaFija}</td>
                         <td class='text-center'>{$expensa->descripcion}</td>
                         <td class='d-flex justify-content-center'>
                            <a href='" . route('notacobro.show', $facturaId) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar Plantilla' target='_blank'></a>
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

        return $html1;
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
                        <th class="text-center">NOMBRE DEL CLIENTE</th>';

        // Condicional para el tipo de canon o tarifa fija
        if ($tipo == 'AL') {
            $html1 .= '<th class="text-center">TIPO DE CANON</th>
                       <th class="text-center">FORMA DE PAGO</th>';
        } elseif ($tipo == 'EX') {
            $html1 .= '<th class="text-center">TARIFA FIJA</th>
                       <th class="text-center">EXPENSA</th>';
        }
        
        $html1.='      <th class="text-center">OPCIONES</th>
                       <th class="text-center"><input type="checkbox" id="check-all" class="form-check-input" title="Seleccionar/Deseleccionar nota(s) de cobro"></th>
                    </tr>
                </thead>';

        $cont = 0; 


        if ($tipo == 'AL'){
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
                <a href='" . route('notacobro.show', $notaCobro->id) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar nota de cobro' target='_blank'></a>
                <a href='" . route('notacobro.edit', $notaCobro->id) . "' class='btn btn-warning bi bi-pencil-square' title='Modificar nota de cobro'></a>
                </td>
                <td class='text-center'><input type='checkbox' name='aprobado[]' value='{$notaCobro->id}' class='form-check-input' title='Aprobar nota de cobro'></td>
                </tr>
                </tbody>";
            }
        } else if ($tipo == 'EX'){
            foreach ($notasCobro as $notaCobro) {
                $cont++;
        
                $facturaDetalle = FacturaDetalle::where('factura', $notaCobro->id)->first();
                $expensa = Expensa::find($facturaDetalle->expensa);

                $tipoCanon = $notaCobro->tipo_canon == 'F' ? 'FIJO' : ($notaCobro->tipo_canon == 'V' ? 'VARIABLE' : $notaCobro->tipo_canon);
                //Visualiza html con las notas de cobro dado el preiodo de facturación
                $html1.="<tbody>
                <tr>
                <td class='oculto'><input type='text' name='id_espacio[]' value='{$notaCobro->contrato}'/></td>
                <td class='text-center'>{$notaCobro->numero_nota_cobro}</td>
                <td class='text-center'>{$notaCobro->razon_social_factura}</td>
                <td class='text-center'>{$tipoCanon}</td>
                <td class='text-center'>{$expensa->descripcion}</td>
                <td class='d-flex justify-content-center'>
                <a href='" . route('notacobro.show', $notaCobro->id) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar nota de cobro' target='_blank'></a>
                <a href='" . route('notacobro.edit', $notaCobro->id) . "' class='btn btn-warning bi bi-pencil-square' title='Modificar nota de cobro'></a>
                </td>
                <td class='text-center'><input type='checkbox' name='aprobado[]' value='{$notaCobro->id}' class='form-check-input' title='Aprobar nota de cobro'></td>
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

    public function edit($id_notacobro)
    {
        $factura = Factura::find($id_notacobro);
        //dd($factura);
        $aeropuerto = Aeropuerto::find($factura->aeropuerto);
        $aeropuertoDescripcion = $aeropuerto->descripcion;
        $cliente = Cliente::find($factura->cliente);
        $clienteRazonSocial = $cliente->razon_social;
        $codigoContrato = $factura->codigo_contrato;
        $mes = $factura->mes;
        $gestion = $factura->gestion;
        $ultimoDia = Carbon::createFromDate($gestion, $mes)->endOfMonth()->day;
        $fechaInicio = sprintf('%02d/%02d/%d', 1, $mes, $gestion);
        $fechaFin = sprintf('%02d/%02d/%d', $ultimoDia, $mes, $gestion);
        $fechaImpresion = Carbon::now()->format('Y-m-d H:i:s');
        $numero_nota_cobro = $factura->numero_nota_cobro;

        if ($factura->tipo_canon == 'F')
            $concepto = 'ALQUILER';
        else if ($factura->tipo_canon == 'V')
            $concepto = 'COMPRA Y VENTA';

        $facturaDetalles = FacturaDetalle::where('factura', $id_notacobro)->get();
        $monto_total = $factura->monto_total;
        $tipoFactura = $factura->tipo_factura;
       
        return view('facturacion.notascobro.edit',compact( 'clienteRazonSocial', 'codigoContrato', 'numero_nota_cobro', 'facturaDetalles', 'mes', 'gestion', 'tipoFactura'));
    }

    public function update(Request $request, $id_factura_detalle)
    {
        $fechaInicio = Carbon::parse($request->input('fecha_inicio'));
        $fechaFin = Carbon::parse($request->input('fecha_fin'));
        $dias_facturados = $fechaFin->diffInDays($fechaInicio) + 1;
        
        $facturaDetalle = FacturaDetalle::find($id_factura_detalle);
        $factura = Factura::find($facturaDetalle->factura);

        if ($factura->tipo_factura == 'EX')
            $facturaDetalle->glosa = $request->input('glosa_factura');

        $facturaDetalle->fecha_inicial = $request->input('fecha_inicio');
        $facturaDetalle->fecha_final = $request->input('fecha_fin');
        $facturaDetalle->dias_facturados=$dias_facturados;
        $facturaDetalle->precio = $request->input('precio');
        $facturaDetalle->save();

        if ($factura->tipo_factura == 'AL'){
            $espacio = Espacio::find($request->input('id_espacio'));
            $espacio->glosa_factura = $request->input('glosa_factura');
            $espacio->save(); 
        }

        Alert::success("Nota de cobro actualizada correctamente");
        //return redirect()->back();
        return redirect()->route('notacobro.index');
    }

    public function show($id_notacobro)
    {
        $factura = Factura::find($id_notacobro);

        if ($factura->espacio){
            $espacio = Espacio::find($factura->espacio);
            $formaPago = FormaPago::find($espacio->forma_pago);
        } else {
            $formaPago = FormaPago::find($factura->forma_pago);
        }

        $aeropuerto = Aeropuerto::find($factura->aeropuerto);
        $aeropuertoDescripcion = $aeropuerto->descripcion;
        $cliente = Cliente::find($factura->cliente);
        $clienteRazonSocial = $cliente->razon_social;
        $mes = $factura->mes;
        $gestion = $factura->gestion;

        if ($factura->tipo_factura == 'EX')
            $numeroMes = 1;
        else
            $numeroMes = $formaPago->numero_mes;

        // Cuando la Nota de Cobro no corresponde a ningún Contrato es Temporal
        if ($factura->espacio){
            $fechaInicio = sprintf('%02d/%02d/%d', Carbon::parse($espacio->fecha_inicial)->format('d'), $mes, $gestion);

            if ($factura->tipo_factura == 'EX'){
                $ultimoDia = Carbon::createFromDate($gestion, $mes)->endOfMonth()->day;
                $fechaFin = sprintf('%02d/%02d/%d', $ultimoDia, $mes, $gestion);
            } else {
                $fechaInicioCarbon = Carbon::createFromFormat('d/m/Y', $fechaInicio);
                $fechaFinCarbon = $fechaInicioCarbon->copy()->addMonths($numeroMes)->subDay();
                $fechaFin = $fechaFinCarbon->format('d/m/Y');
            }

        } else{
            $facturaDetalles = FacturaDetalle::where('factura', $id_notacobro)->first();
            $fechaInicio = Carbon::parse($facturaDetalles->fecha_inicial)->format('d/m/Y');
            $fechaFin = Carbon::parse($facturaDetalles->fecha_final)->format('d/m/Y');
        }
        
        $fechaImpresion = Carbon::now()->format('Y-m-d H:i:s');
        $numero_nota_cobro = $factura->numero_nota_cobro;

        if ($factura->tipo_canon == 'F' && $factura->tipo_factura == 'AL')
            $concepto = 'ALQUILER';
        else if ($factura->tipo_canon == 'V' && $factura->tipo_factura == 'AL')
            $concepto = 'COMPRA Y VENTA';
        else if ($factura->tipo_canon == 'F' && $factura->tipo_factura == 'EX')
            $concepto = 'COMPRA Y VENTA';
        else if ($factura->tipo_canon == 'V' && $factura->tipo_factura == 'EX')
            $concepto = 'COMPRA Y VENTA';
        else if ($factura->tipo_canon == 'V' && $factura->tipo_factura == 'MOR')
            $concepto = 'COMPRA Y VENTA';
        else if ($factura->tipo_canon == 'V' && $factura->tipo_factura == 'OTR')
            $concepto = 'COMPRA Y VENTA';

        $facturaDetalles = FacturaDetalle::where('factura', $id_notacobro)->get();
        $monto_total = $factura->monto_total;
        $tipoFactura = $factura->tipo_factura;
        $tipoGeneracion = $factura->tipo_generacion;
        //dd('aeropuertoDescripcion '.$aeropuertoDescripcion.' clienteRazonSocial '.$clienteRazonSocial.' fechaInicio '.$fechaInicio.' fechaFin '.$fechaFin.' fechaImpresion '.$fechaImpresion.' numero_nota_cobro '.$numero_nota_cobro.' concepto '.$concepto.' facturaDetalles '.$facturaDetalles.' monto_total '.$monto_total.' tipoFactura '.$tipoFactura.' tipoGeneracion '.$tipoGeneracion);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('facturacion.notascobro.pdf.nota_cobro',compact('aeropuertoDescripcion', 'clienteRazonSocial', 'fechaInicio', 'fechaFin', 'fechaImpresion', 'numero_nota_cobro', 'concepto', 'facturaDetalles', 'monto_total', 'tipoFactura', 'tipoGeneracion'));
        return $pdf->stream();
    }

}
