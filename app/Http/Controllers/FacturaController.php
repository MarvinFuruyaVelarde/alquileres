<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Espacio;
use App\Models\Expensa;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\NotaCobro;
use App\Models\Rubro;
use App\Models\View_Factura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class FacturaController extends Controller
{
    public function index()
    {
        $aeropuertos = Aeropuerto::where('id','>',0)->orderBy('id', 'asc')->get();
        return view('facturacion.facturacion.index', compact('aeropuertos')); 
    }

    public function buscaNotaCobroPendiente(Request $request) 
    {
        //dd($request->query('periodoFacturacion'));
        $fecha = $request->query('periodoFacturacion'); 
        $mes = Carbon::parse($fecha)->format('m');
        $gestion = Carbon::parse($fecha)->format('Y');   
        $tipo = $request->query('tipo');
        $aeropuerto = $request->query('aeropuerto');

        // Obtiene las notas de cobro con los filtros ingresados
        $notasCobro = NotaCobro::obtenerNotaCobroPorEstado(5, $gestion, $mes, $tipo, $aeropuerto);

        $html1='  
        <style>
        .oculto {
            display: none; /* Oculta el elemento */
        /*}
        </style>
        <div class="table-responsive">
        <table cellspacing="0" width="150%" id="tabla" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">NÚMERO NOTA DE COBRO</th>
                        <th class="text-center">NOMBRE DEL CLIENTE</th>';
    
        if ($tipo == 'AL' || $tipo == 'MOR' || $tipo == 'OTR') {
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

        if ($tipo == 'AL' || $tipo == 'MOR' || $tipo == 'OTR'){
            foreach ($notasCobro as $notaCobro) {
                $cont++;
                $html1.="<tbody>
                            <tr>
                                <td class='oculto'><input type='text' name='id_espacio[]' value='{$notaCobro->id}'/></td>
                                <td class='text-center'>{$notaCobro->numero_nota_cobro}</td>
                                <td class='text-center'>{$notaCobro->razon_social}</td>
                                <td class='text-center'>{$notaCobro->desc_canon}</td>
                                <td class='text-center'>{$notaCobro->desc_forma_pago}</td>
                                <td class='d-flex justify-content-center'>
                                <a href='" . route('facturacion.show', $notaCobro->id) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar Plantilla' target='_blank'></a>
                                </td>
                                <td class='text-center'><input type='checkbox' name='notacobro[]' value='{$notaCobro->id}' class='form-check-input' title='Aprobar nota de cobro'></td>
                            </tr>
                        </tbody>";
            } 
        } else if ($tipo == 'EX'){
            foreach ($notasCobro as $notaCobro) {
                $facturaDetalle = FacturaDetalle::where('factura', $notaCobro->id)->first();
                $expensa = Expensa::find($facturaDetalle->expensa);
                $cont++;
                $html1.="<tbody>
                            <tr>
                                <td class='oculto'><input type='text' name='id_espacio[]' value='{$notaCobro->id}'/></td>
                                <td class='text-center'>{$notaCobro->numero_nota_cobro}</td>
                                <td class='text-center'>{$notaCobro->razon_social}</td>
                                <td class='text-center'>{$notaCobro->desc_canon}</td>
                                <td class='text-center'>{$expensa->descripcion}</td>
                                <td class='d-flex justify-content-center'>
                                <a href='" . route('facturacion.show', $notaCobro->id) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar Plantilla' target='_blank'></a>
                                </td>
                                <td class='text-center'><input type='checkbox' name='notacobro[]' value='{$notaCobro->id}' class='form-check-input' title='Aprobar nota de cobro'></td>
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

    public function generarFactura(Request $request)
    {
        // Obtiene el aeropuerto para generar factura(s)
        $aeropuerto = Aeropuerto::find($request->aeropuerto);

        //Amb Prueba $token = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJTZXJ2aWNlcyIsImlhdCI6MTY2Mjk4NzA4MSwiZXhwIjoyMjk0MTM5MDgxfQ.YEHBqciwMmQV2IKi5BbIEFo3xcHt2lbLswMII5GuxNo';
        $token = $aeropuerto->token;
        //Amb Prueba $url   = 'https://clic.naabol.com.bo:8443/clic-core/facturas/recibir-sincrono';
        $url   = $aeropuerto->url.'clic-core/facturas/recibir-sincrono';
        $uuid  = Str::uuid()->toString();
        //dd($url.' '.$token.' '.$aeropuerto->sucursal);
        $cont = 0;

        // Array de Notas de Cobro para ser facturadas
        $notascobro = $request->notacobro;

        //dd($notascobro);

        foreach ($notascobro as $id_notacobro) {

            // Obtiene Datos generales
            $factura = Factura::find($id_notacobro);

            if ($factura->tipo_solicitante == 1)
                $codigoCliente = $factura->ci;
            else 
                $codigoCliente = $factura->nit;

            $contrato = Contrato::find($factura->contrato);
            
            if ($contrato !== null) {
                $celularCliente = $contrato->telefono_celular;
                $emailCliente = $contrato->correo;
            } else {
                $celularCliente = null;
                $emailCliente = null;
            }

            // Obtiene Documento Fiscal
            $cliente = Cliente::find($factura->cliente);
            $nombreRazonSocial = $cliente->razon_social;
            
            if ($factura->tipo_solicitante == 1){
                $tipoDocumentoIdentidad = 'CI';
                $numeroDocumento = $factura->ci;
            } elseif ($factura->tipo_solicitante == 2){
                $tipoDocumentoIdentidad = 'NIT';
                $numeroDocumento = $factura->nit;
            }

            $montoTotalMoneda = FacturaDetalle::where('factura', $factura->id)
                                ->sum('precio');

            $montoTotal = FacturaDetalle::where('factura', $factura->id)
                            ->sum('precio');

            $montoTotalSujetoIva = FacturaDetalle::where('factura', $factura->id)
                                    ->sum('precio');

            $fecha = $request->fecha;
            $mesLiteral = strtoupper(Carbon::parse($fecha)->locale('es')->translatedFormat('F'));
            $gestion = Carbon::parse($fecha)->format('Y');  

            if ($factura->tipo_canon == 'F' && $factura->tipo_factura == 'AL'){
                $codigoUnidadMedida = 57;
                $tipoDocumentoSector = 2;
                $periodoFacturado = $mesLiteral.' '.$gestion;
            } else if ($factura->tipo_canon == 'V' && $factura->tipo_factura == 'AL'){
                $codigoUnidadMedida = 58;
                $tipoDocumentoSector = 1;
                $periodoFacturado = null;
            } else if ($factura->tipo_canon == 'F' && $factura->tipo_factura == 'EX'){
                $codigoUnidadMedida = 58;
                $tipoDocumentoSector = 1;
                $periodoFacturado = null;
            } else if ($factura->tipo_canon == 'V' && $factura->tipo_factura == 'EX'){
                $codigoUnidadMedida = 58;
                $tipoDocumentoSector = 1;
                $periodoFacturado = null;
            } else if ($factura->tipo_canon == 'V' && $factura->tipo_factura == 'MOR'){
                $codigoUnidadMedida = 58;
                $tipoDocumentoSector = 1;
                $periodoFacturado = null;
            } else if ($factura->tipo_canon == 'V' && $factura->tipo_factura == 'OTR'){
                $codigoUnidadMedida = 58;
                $tipoDocumentoSector = 1;
                $periodoFacturado = null;
            }

            $detalleArray = [];

            // Obtiene Detalle
            $facturas_detalle = FacturaDetalle::where('factura', $factura->id)->get();
            $subTotal = 0;
            $subtotal = 0;

            // Obtiene datos si tiene más de un espacio
            foreach ($facturas_detalle as $factura_detalle) {
                $espacio = Espacio::find($factura_detalle->espacio);
                $montoDescuentoDetalle = null;
                $codigoProducto = 1;
                
                if (($factura->tipo_factura == 'AL' && $factura->tipo_generacion == 'A') || ($factura->tipo_factura == 'AL' && $factura->tipo_generacion == 'M' && $factura->codigo_contrato != 'SIN/CODIGO')){
                    $descripcion = $espacio->glosa_factura;
                    if ($espacio){
                        $rubro = Rubro::find($espacio->rubro);
                        $codigoProducto = $rubro?->codigo;
                    }    
                } else if ($factura->tipo_factura == 'EX' || $factura->tipo_factura == 'MOR' || $factura->tipo_factura == 'OTR' || ($factura->tipo_factura == 'AL' && $factura->tipo_generacion == 'M' && $factura->codigo_contrato == 'SIN/CODIGO')){
                    $descripcion = $factura_detalle->glosa;

                    if ($factura->tipo_factura == 'EX')
                        $codigoProducto = 99714;
                    else if ($factura->tipo_factura == 'MOR')
                        $codigoProducto = 99112;
                    else if ($factura->tipo_factura == 'OTR')
                        $codigoProducto = 99114;
                    else if ($factura->tipo_factura == 'AL' && $factura->tipo_generacion == 'M' && $factura->codigo_contrato == 'SIN/CODIGO')
                        $codigoProducto = 72149;
                }

                $precioUnitario = $factura_detalle->precio;

                if ($espacio && $espacio->opcion_dcto !== null){
                    $subtotal = number_format($factura_detalle->precio - ($factura_detalle->precio * $espacio->opcion_dcto) / 100, 2, '.', '');
                    $subTotal = number_format($subTotal + ($factura_detalle->precio * $espacio->opcion_dcto) / 100, 2, '.', '');
                } else {
                    $subtotal = $factura_detalle->precio;
                    $subTotal = $subTotal;
                }
                
                if ($espacio)
                    $montoDescuentoDetalle = number_format(($factura_detalle->precio * ($espacio->opcion_dcto ?? 0)) / 100, 2, '.', '');

                $detalleArray[] = [
                    'codigoProducto' => $codigoProducto,
                    'descripcion' => $descripcion,
                    'cantidad' => 1,
                    'precioUnitario' => $precioUnitario,
                    'subtotal' => $subtotal,
                    'montoDescuentoDetalle' => $montoDescuentoDetalle,
                    'codigoDetalleTransaccion' => 1,
                    'codigoUnidadMedida' => $codigoUnidadMedida
                ];
            }

            // Consume Api Alquiler
            $response = Http::withToken($token)->withoutVerifying()->post($url, [
                'datosGenerales' => [
                    'nitEmisor' => 419945029,                  // nit naabol
                    'sucursalEmisor' => $aeropuerto->sucursal, // preguntar si siempre se debe mandar 0? esto es la sucursal de la empresa en clic donde solo se tiene un registro reyes ortiz
                    'puntoVentaEmisor' => null,                // preguntar si siempre se debe mandar 1?
                    'codigoIntegracion' => $uuid,              // es una cadena autogenerada (UID4 sugerencia) 
                    'codigoCliente' => $codigoCliente,         // factura->ci o factura->nit dependiendo de factura->tipo_solicitante
                    'celularCliente' => $celularCliente,       // contrato->telefono_celular
                    'emailCliente' => $emailCliente,           // contrato->correo
                    'atributosAdicionalesGeneral' => []
                ],
                'documentoFiscal' => [
                    'cabecera' => [
                        'tipoDocumentoFiscal' => '1', // 1 -> FACTURA CON DERECHO A CREDITO FISCAL se obtiene de Homologación -> Homologar Parametrica
                        'tipoDocumentoSector' => $tipoDocumentoSector, // 2 -> FACTURA DE ALQUILER DE BIENES INMUEBLES se obtiene de Homologación -> Homologar Parametrica 
                        'codigoExcepcion' => 1,                        // Valor que se envía para autorizar el registro de una factura con NIT inválido. Por defecto, se envía el valor de cero (0) y uno (1) cuando se autoriza el registro. (Manual)
                        'tipoEmision' => 1,                            // Modo de emisión de las facturas: 1=ON_LINE (Manual)
                        'fechaEmision' => null,                        // Fecha de emisión de la factura. Para facturas ON_LINE debe ser null ya que el sistema genera la fecha automaticamente.Para facturas ONLINE_MASIVO el campo fecha emision debe tener valor con el sig formato: 2022-01-15T10:53:06.637
                        'nombreRazonSocial' => $nombreRazonSocial,                 // cliente->razon_social
                        'tipoDocumentoIdentidad' => $tipoDocumentoIdentidad,       // $factura->tipo_solicitante = 1 -> CI ó = 2 -> NIT  
                        'numeroDocumento' => $numeroDocumento,                     // factura->ci ó factura->nit     
                        'complemento' => null,                                     // null
                        'fechaEmisionFactura' => 'null',                           // null
                        'metodoPago' => 1,                                         // null no tiene un metodo de pago definido el contrato (estaba con 1)
                        'codigoMoneda' => 'BOB',                                   // BOB catalogo de moneda
                        'tipoCambio' => 1,                                         // Si el tipo Moneda es Bolivianos, el tipo de cambio es 1.
                        'montoTotalMoneda' => $montoTotalMoneda - $subTotal,       // factura_detalle->total_canonmensual, agrupar espacios asociados a la Nota de Cobro
                        'montoTotal' => $montoTotal - $subTotal,                   // factura_detalle->total_canonmensual, agrupar espacios asociados a la Nota de Cobro
                        'montoTotalSujetoIva' => $montoTotalSujetoIva - $subTotal, // factura_detalle->total_canonmensual, agrupar espacios asociados a la Nota de Cobro
                        'periodoFacturado' => $periodoFacturado,                   // factura->mes factura->gestion 
                        'usuario' => 'admin'                                       // admin
                    ],
                    'detalle' => $detalleArray
                ]
            ]
            );

            //Respuesta
            if ($response->successful() && $response->json()['codigo'] == 200 && $response->json()['respuesta'] == "OK") {
                // Actualiza registro de Factura con la respuesta obtenida
                $factura->url_documento = $response->json()['urlDocumento'];
                $factura->id_documento = $response->json()['idDocumento'];
                $factura->tipo_emision = $response->json()['tipoEmision'];
                $factura->tipo_emision_descripcion = $response->json()['tipoEmisionDescripcion'];
                $factura->cuf = $response->json()['cuf'];
                $factura->cufd = $response->json()['cufd'];
                $factura->cuis = $response->json()['cuis'];
                $factura->numero_factura = $response->json()['numeroFactura'];
                $factura->fecha_emision = $response->json()['fechaEmision'];
                $factura->estado_documento_fiscal = $response->json()['estadoDocumentoFiscal'];
                $factura->codigo_recepcion_sin = $response->json()['codigoRecepcionSin'];
                $factura->codigo_integracion = $response->json()['codigoIntegracion'];
                $factura->urlsin = $response->json()['urlSin'];
                $factura->estado = 8;
                $factura->save();

                // Obtiene la respuesta en formato JSON
                $data = $response->json();

                // Devuelve la respuesta en formato JSON
                /*return response()->json([
                    'message' => 'Datos obtenidos correctamente',
                    'data' => $data,
                ]);*/
            } else {
                $cont++;
                // Maneja el error
                /*return response()->json([
                    'error' => 'No se pudo obtener los datos',
                    'status' => $response->status(),
                ], $response->status());*/
            }
        }

        // Verificamos si todo el proceso fue éxitoso
        if ($cont == 0){
            Alert::success("Se ha procesado de manera correcta la generación de factura(s)");
            return redirect()->route('facturacion.index');
        } else {
            Log::error('Error en la solicitud a la API', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers()
            ]);
            Alert::error("Ocurrio un inconveniente en la generación de factura(s)");
            return redirect()->route('facturacion.index');
        }
    }

    public function buscaNotaCobroGenerada(Request $request) 
    {
        //dd($request->query('periodoFacturacion'));
        $fecha = $request->query('periodoFacturacion'); 
        $mes = Carbon::parse($fecha)->format('m');
        $gestion = Carbon::parse($fecha)->format('Y');   
        $tipo = $request->query('tipo');
        $aeropuerto = $request->query('aeropuerto');

        // Obtiene las notas de cobro con los filtros ingresados
        $notasCobro = NotaCobro::obtenerNotaCobroPorEstado(8, $gestion, $mes, $tipo, $aeropuerto);

        $html1='  
        <style>
        .oculto {
            display: none; /* Oculta el elemento */
        /*}
        </style>
        <div class="table-responsive">
        <table cellspacing="0" width="150%" id="tabla" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">NÚMERO NOTA DE COBRO</th>
                        <th class="text-center">NOMBRE DEL CLIENTE</th>';

        if ($tipo == 'AL' || $tipo == 'MOR' || $tipo == 'OTR') {
            $html1 .= '<th class="text-center">TIPO DE CANON</th>
                       <th class="text-center">FORMA DE PAGO</th>';
        } elseif ($tipo == 'EX') {
            $html1 .= '<th class="text-center">TARIFA FIJA</th>
                       <th class="text-center">EXPENSA</th>';
        }
                        
        $html1.='      <th class="text-center">OPCIONES</th>
                    </tr>
                </thead>';  

        $cont = 0;
        
        if ($tipo == 'AL' || $tipo == 'MOR' || $tipo == 'OTR'){
            foreach ($notasCobro as $notaCobro) {
                $cont++;
                $html1.="<tbody>
                            <tr>
                                <td class='oculto'><input type='text' name='id_espacio[]' value='{$notaCobro->id}'/></td>
                                <td class='text-center'>{$notaCobro->numero_nota_cobro}</td>
                                <td class='text-center'>{$notaCobro->razon_social}</td>
                                <td class='text-center'>{$notaCobro->desc_canon}</td>
                                <td class='text-center'>{$notaCobro->desc_forma_pago}</td>
                                <td class='d-flex justify-content-center'>
                                <a href='" . route('facturacion.anular', $notaCobro->id) . "' class='btn btn-dark bi-arrow-90deg-left' title='Anular Factura'></a>
                                <a href='" . route('facturacion.imprimir', $notaCobro->id_documento) . "' class='btn btn-primary bi-printer-fill' title='Visualizar Factura' target='_blank'></a>
                                <a href='" . route('notacobro.show', $notaCobro->id) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar Nota de Cobro' target='_blank'></a>
                                </td>
                            </tr>
                        </tbody>";
            } 
        } else if ($tipo == 'EX'){
            foreach ($notasCobro as $notaCobro) {
                $facturaDetalle = FacturaDetalle::where('factura', $notaCobro->id)->first();
                $expensa = Expensa::find($facturaDetalle->expensa);
                $cont++;
                $html1.="<tbody>
                            <tr>
                                <td class='oculto'><input type='text' name='id_espacio[]' value='{$notaCobro->id}'/></td>
                                <td class='text-center'>{$notaCobro->numero_nota_cobro}</td>
                                <td class='text-center'>{$notaCobro->razon_social}</td>
                                <td class='text-center'>{$notaCobro->desc_canon}</td>
                                <td class='text-center'>{$expensa->descripcion}</td>
                                <td class='d-flex justify-content-center'>
                                <a href='" . route('facturacion.anular', $notaCobro->id) . "' class='btn btn-dark bi-arrow-90deg-left' title='Anular Factura'></a>
                                <a href='" . route('facturacion.imprimir', $notaCobro->id_documento) . "' class='btn btn-primary bi-printer-fill' title='Visualizar Factura' target='_blank'></a>
                                <a href='" . route('notacobro.show', $notaCobro->id) . "' class='btn btn-danger bi-file-earmark-pdf' title='Visualizar Nota de Cobro' target='_blank'></a>
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

    public function imprimir($id_documento) 
    {
        $idDocumento = $id_documento;

        // Obtiene el aeropuerto para generar factura(s)
        $idAeropuerto = Factura::where('id_documento', $idDocumento)->value('aeropuerto');
        $aeropuerto = Aeropuerto::find($idAeropuerto);

        //Amb Prueba $token = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJTZXJ2aWNlcyIsImlhdCI6MTY2Mjk4NzA4MSwiZXhwIjoyMjk0MTM5MDgxfQ.YEHBqciwMmQV2IKi5BbIEFo3xcHt2lbLswMII5GuxNo';
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJTZXJ2aWNlcyIsImlhdCI6MTY2Mjk4NzA4MSwiZXhwIjoyMjk0MTM5MDgxfQ.YEHBqciwMmQV2IKi5BbIEFo3xcHt2lbLswMII5GuxNo';
        //Amb Prueba $url = "https://clic.naabol.com.bo:8443/clic-core/facturas/{$idDocumento}/pdf";
        $url = "https://clic.naabol.com.bo:8443/clic-core/facturas/{$idDocumento}/pdf";
        //dd($token.' '.$url.' '.$idDocumento);
        $response = Http::withToken($token)->withoutVerifying()->get($url);
        //dd($response->json());

        if ($response->successful() && $response->json()['codigo'] == 200 && $response->json()['respuesta'] == "OK") {

            // Obtiene la respuesta en formato JSON
            $pdfBase64 = $response->json()['archivo'];
            $pdfContent = base64_decode($pdfBase64);
            $fileName = 'documento.pdf';

            return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$fileName.'"');
        } else {
            // Maneja el error
            return response()->json([
                'error' => 'No se pudo obtener la factura',
                'status' => $response->status(),
            ], $response->status());
        }
    }

    public function anular($id_factura) 
    {
        $factura = Factura::find($id_factura);
        $codigoIntegracion = $factura->codigo_integracion;
        $cuf = $factura->cuf;

        //Obtiene al aeropuerto
        $aeropuerto = Aeropuerto::find($factura->aeropuerto);

        //dd($codigoIntegracion.' '.$cuf);

        //Amb Prueba $token = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ3ZWJTZXJ2aWNlcyIsImlhdCI6MTY2Mjk4NzA4MSwiZXhwIjoyMjk0MTM5MDgxfQ.YEHBqciwMmQV2IKi5BbIEFo3xcHt2lbLswMII5GuxNo';
        $token = $aeropuerto->token;
        //Amb Prueba $url = "https://clic.naabol.com.bo:8443/clic-core/facturas/anular";
        $url = $aeropuerto->url."clic-core/facturas/anular";

        $cont = 0;
        // Consume Api Alquiler
        $response = Http::withToken($token)->withoutVerifying()->post($url, [
            'datosGenerales' => [
                'nitEmisor' => 419945029,
                'sucursalEmisor' => '0',        
                'puntoVentaEmisor' => 'pos-1',      
                'canalFacturacion' => 'core'        
            ],
            'documentoFiscal' => [
                'codigoIntegracion' => $codigoIntegracion, 
                'cuf' => $cuf, 
                'codigoMotivo' => 1
            ]
        ]
        );

        if ($response->successful() && $response->json()['codigo'] == 200 && $response->json()['respuesta'] == "OK") {
            $factura->estado = 7;
            $factura->save();
        } else 
            $cont++;

        if ($cont == 0){
            Alert::success("Se ha realizado la anulación de la factura correctamente");
            return redirect()->route('facturacion.index');
        } else {
            Alert::error("Ocurrio un inconveniente al anular la factura");
            return redirect()->route('facturacion.index');
        }

    }
}
