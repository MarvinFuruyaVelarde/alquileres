<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Espacio;
use App\Models\Estado;
use App\Models\Expensa;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\NotaCobro;
use App\Models\Regional;
use App\Models\TipoIdentificacion;
use App\Models\UsuarioRegional;
use App\Models\View_Espacio;
use App\Models\View_NotaCobraManual;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class NotaCobroManualController extends Controller
{
    public function index()
    {
        $notasCobroManual = View_NotaCobraManual::where('id','>',0)->get();
        return view('facturacion.notascobromanual.index', compact('notasCobroManual'));
    }

    public function obtieneCodigoContrato($aeropuerto, $cliente) 
    {   
        $codigosContrato = Contrato::where('aeropuerto', $aeropuerto)
                    ->where('cliente', $cliente)
                    ->where('estado', 5)
                    ->pluck('codigo');
        
        if ($codigosContrato->isEmpty()) {
            $html = '<option value="SIN/CODIGO">SIN CODIGO</option>';
            $disabled = false;  // Indicador para deshabilitar el select
        } else {
            $html = '<option value="">Seleccione</option>
                     <option value="SIN/CODIGO">SIN CODIGO</option>';
            foreach ($codigosContrato as $codigoContrato) {
                $selected = NULL;
                $html .= "<option value='$codigoContrato' $selected>$codigoContrato</option>";
                $disabled = false;
            }
        }
                   
		return response()->json(['success'=>true, 'item'=>$html, 'disabled' => $disabled]);
	}

    public function obtieneNumeroFactura(Request $request/*$codigoContrato*/) 
    {
        $codigoContrato = $request->codigoContrato;
        $numerosFactura = DB::table('contrato as c')
                ->join('factura as f', 'f.contrato', '=', 'c.id')
                ->join('detalle_pago_factura as dp', 'dp.id_factura', '=', 'f.id')
                ->where('dp.cobro_mora', 'S')
                ->where('c.codigo', $codigoContrato)
                ->groupBy('f.id')
                ->select('f.id', 'f.numero_factura', 'f.mes', 'f.gestion', DB::raw('SUM(dp.mora) as monto'))
                ->get();
        
        //dd($numerosFactura);
        
        if ($numerosFactura->isEmpty()) {
            $html = '<option value="">Sin numero de factura</option>';
            $disabled = true;  // Indicador para deshabilitar el select
        } else {
            $html = '<option value="">Seleccione</option>';
            foreach ($numerosFactura as $numeroFactura) {
                $selected = NULL;
                $html .= "<option value='$numeroFactura->id' data-monto='$numeroFactura->monto' data-mes='$numeroFactura->mes' data-gestion='$numeroFactura->gestion' $selected>$numeroFactura->numero_factura</option>";
                $disabled = false;
            }
        }
                   
		return response()->json(['success'=>true, 'item'=>$html, 'disabled' => $disabled]);
	}

    public function obtieneExpensa(Request $request) 
    {       
        $fechaFinal = $request->query('periodoFacturacion');
        $fechaInicial = Carbon::parse($fechaFinal)->startOfMonth()->format('Y-m-d'); 
        $expensas = NotaCobro::obtenerExpensasTarifaVariable($request->query('aeropuerto'), $request->query('cliente'), $request->query('codigo'), $fechaInicial, $fechaFinal);
        return response()->json(['expensas' => $expensas, 'fecha_inicial' => $fechaInicial, 'fecha_final' => $fechaFinal]);
	}

    public function obtieneEspacioCanonVariable(Request $request) 
    {    
        $fechaFinal = $request->query('periodoFacturacion');
        $fechaInicial = Carbon::parse($fechaFinal)->startOfMonth()->format('Y-m-d'); 
        $espacios = NotaCobro::obtenerEspacioCanonVariable($request->query('aeropuerto'), $request->query('cliente'), $request->query('codigo'), $fechaFinal);
        return response()->json(['espacios' => $espacios, 'fecha_inicial' => $fechaInicial, 'fecha_final' => $fechaFinal]);
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

        $clientes = Cliente::where('estado', 1)->select('id', 'razon_social')->get();
        $expensas = Expensa::where('id','>',0)->where('estado', 1)->orderBy('descripcion', 'asc')->get();
        return view('facturacion.notascobromanual.create', compact('aeropuertos', 'clientes', 'expensas'));
    }

    public function store(Request $request)
    {
        $contrato = Contrato::where('aeropuerto', $request->aeropuerto)
                            ->where('codigo', $request->codigo)
                            ->first();

        $regionalAeropuerto = Aeropuerto::where('id', $request->aeropuerto)->value('regional');
        $codRegional = Regional::where('id', $regionalAeropuerto)->value('codigo');
        $codAeropuerto = Aeropuerto::where('id', $request->aeropuerto)->value('codigo');
        $mes = Carbon::parse($request->periodo_facturacion)->format('m');
        $gestion = Carbon::parse($request->periodo_facturacion)->format('Y');   
        $ordenImpresion = NotaCobro::obtenerMaxOrdenImpresion($request->tipo, $mes, $gestion, $request->aeropuerto);
        $numeroNotaCobro = $request->tipo.'/'.$codRegional.'/COM/'.$codAeropuerto.'/'.$mes.'/'.$gestion.'/'.$ordenImpresion;        
        $cliente = Cliente::find($request->cliente);
        $tipoIdentificacion = TipoIdentificacion::find($cliente->tipo_identificacion);
        $fechaRegistro = Carbon::now()->format('Y-m-d H:i:s');
        $periodoFacturacion = $request->periodo_facturacion;
        $periodoInicialFacturacion = Carbon::parse($periodoFacturacion)->startOfMonth()->toDateString();

        if (($request->tipo == 'AL' && $request->codigo == 'SIN/CODIGO') || $request->tipo == 'MOR' || $request->tipo == 'OTR'){
            $factura = New Factura();
            $factura->aeropuerto = $request->aeropuerto;

            if ($request->tipo == 'AL' || $request->tipo == 'OTR')
                $factura->contrato = 0;
            elseif ($request->tipo == 'MOR')
                $factura->contrato = $contrato->id;

            $factura->codigo_contrato = $request->codigo;
            $factura->numero_nota_cobro = $numeroNotaCobro;
            $factura->orden_impresion = $ordenImpresion;
            $factura->mes = $mes;
            $factura->gestion = $gestion;
            $factura->tipo_solicitante = $cliente->tipo_solicitante;
            
            if ($tipoIdentificacion->descripcion == 'CI') 
                $factura->ci = $cliente->numero_identificacion;
            else
                $factura->nit = $cliente->numero_identificacion;

            if ($request->tipo == 'AL')
                $factura->tipo_canon = $request->tipo_espacio;
            else if($request->tipo == 'MOR' || $request->tipo == 'OTR')
                $factura->tipo_canon = 'V';

            $factura->forma_pago = 6;
            $factura->tipo_factura = $request->tipo;
            $factura->cliente = $request->cliente;
            $factura->razon_social_factura = $cliente->razon_social;

            if ($request->tipo == 'MOR')
                $factura->monto_total = $request->monto_mora;
            else
                $factura->monto_total = $request->monto;

            $factura->tipo_generacion = 'M';
            $factura->estado = 3;
            $factura->usuario_registro = auth()->id();
            $factura->fecha_registro = $fechaRegistro;
            $factura->save();
            $facturaId = $factura->id;

            $facturaDetalle = New FacturaDetalle();
            $facturaDetalle->factura = $facturaId;
            $facturaDetalle->glosa = $request->glosa_factura; 

            if ($request->tipo == 'AL')
                $facturaDetalle->concepto = $request->tipo_espacio;
            else if($request->tipo == 'MOR' || $request->tipo == 'OTR')
                $facturaDetalle->concepto = 'V';
            
            if ($request->tipo == 'MOR') {
                $facturaDetalle->fecha_inicial = Carbon::create($request->gestion, $request->mes, 1)->toDateString();
                $facturaDetalle->fecha_final = Carbon::create($request->gestion, $request->mes, 1)->endOfMonth()->toDateString();
            } else {
                $facturaDetalle->fecha_inicial = $request->periodo_inicial;
                $facturaDetalle->fecha_final = $request->periodo_final;
            }
            
            $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($request->periodo_inicial, $request->periodo_final, $periodoInicialFacturacion, $periodoFacturacion);
            
            if ($request->tipo == 'MOR') {
                $facturaDetalle->total_canonmensual = $request->monto_mora;
                $facturaDetalle->precio = $request->monto_mora;
            } else {
                $facturaDetalle->total_canonmensual = $request->monto;
                $facturaDetalle->precio = $request->monto;
            }

            $facturaDetalle->usuario_registro = auth()->id();
            $facturaDetalle->fecha_registro = $fechaRegistro;
            $facturaDetalle->save();
        } else if($request->tipo == 'EX' && $request->codigo == 'SIN/CODIGO'){
            $factura = New Factura();
            $factura->aeropuerto = $request->aeropuerto;
            $factura->contrato = 0;
            $factura->codigo_contrato = $request->codigo;
            $factura->numero_nota_cobro = $numeroNotaCobro;
            $factura->orden_impresion = $ordenImpresion;
            $factura->mes = $mes;
            $factura->gestion = $gestion;
            $factura->tipo_solicitante = $cliente->tipo_solicitante;

            if ($tipoIdentificacion->descripcion == 'CI') 
                $factura->ci = $cliente->numero_identificacion;
            else
                $factura->nit = $cliente->numero_identificacion;

            $factura->tipo_canon = 'V';
            $factura->forma_pago = 1;                                   
            $factura->tipo_factura = $request->tipo;                   
            $factura->cliente = $request->cliente;                      
            $factura->razon_social_factura = $cliente->razon_social;    
            $factura->monto_total = $request->monto;        
            $factura->tipo_generacion = 'M';                            
            $factura->estado = 3;                                       
            $factura->usuario_registro = auth()->id();                  
            $factura->fecha_registro = $fechaRegistro;                 
            $factura->save();
            $facturaId = $factura->id;

            $facturaDetalle = New FacturaDetalle();
            $facturaDetalle->factura = $facturaId;
            $facturaDetalle->glosa = $request->glosa_factura; 
            $facturaDetalle->concepto = 'V';
            $facturaDetalle->fecha_inicial = $request->periodo_inicial;
            $facturaDetalle->fecha_final = $request->periodo_final;
            $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($request->periodo_inicial, $request->periodo_final, $periodoInicialFacturacion, $periodoFacturacion);
            $facturaDetalle->total_canonmensual = $request->monto;
            $facturaDetalle->precio = $request->monto;
            $facturaDetalle->usuario_registro = auth()->id();
            $facturaDetalle->fecha_registro = $fechaRegistro;
            $facturaDetalle->save();

        } else if ($request->tipo == 'EX' && $request->codigo != 'SIN/CODIGO') { 
            $listaExpensas = $request->input('expensas');

            foreach ($listaExpensas as $expensaId => $expensa) {
                $ordenImpresion = NotaCobro::obtenerMaxOrdenImpresion($request->tipo, $mes, $gestion, $request->aeropuerto);
                $numeroNotaCobro = $request->tipo.'/'.$codRegional.'/COM/'.$codAeropuerto.'/'.$mes.'/'.$gestion.'/'.$ordenImpresion;   

                $factura = New Factura();
                $factura->aeropuerto = $request->aeropuerto;                
                $factura->contrato = $contrato->id;                         
                $factura->codigo_contrato = $request->codigo;               
                $factura->numero_nota_cobro = $numeroNotaCobro;             
                $factura->orden_impresion = $ordenImpresion;                
                $factura->mes = $mes;                                       
                $factura->gestion = $gestion;                               
                $factura->tipo_solicitante = $cliente->tipo_solicitante;    

                if ($tipoIdentificacion->descripcion == 'CI') 
                    $factura->ci = $cliente->numero_identificacion;
                else
                    $factura->nit = $cliente->numero_identificacion;            
            
                $factura->tipo_canon = 'V';

                $factura->forma_pago = 1;                                   
                $factura->tipo_factura = $request->tipo;                   
                $factura->cliente = $request->cliente;                      
                $factura->razon_social_factura = $cliente->razon_social;    
                $factura->monto_total = $expensa['total_a_pagar'];          
                $factura->tipo_generacion = 'M';                            
                $factura->estado = 3;                                       
                $factura->usuario_registro = auth()->id();                  
                $factura->fecha_registro = $fechaRegistro;                 
                $factura->save();
                $facturaId = $factura->id;

                $facturaDetalle = New FacturaDetalle();
                $facturaDetalle->factura = $facturaId;                      
                $facturaDetalle->espacio = $expensa['id_espacio'];          
                $facturaDetalle->expensa = $expensa['expensa'];             
                $facturaDetalle->glosa = $expensa['glosa_factura'];                    
                $facturaDetalle->concepto = 'V';                            
                $facturaDetalle->fecha_inicial = $expensa['fecha_inicial']; 
                $facturaDetalle->fecha_final = $expensa['fecha_final'];     
                $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($expensa['fecha_inicial'], $expensa['fecha_final'], $periodoInicialFacturacion, $periodoFacturacion); //ok
                $facturaDetalle->total_canonmensual = $expensa['total_a_pagar']; //ok     
                $facturaDetalle->precio = $expensa['total_a_pagar'];        
                $facturaDetalle->usuario_registro = auth()->id();           
                $facturaDetalle->fecha_registro = $fechaRegistro;           
                $facturaDetalle->save();
            }
        } else if($request->tipo == 'AL' && $request->codigo != 'SIN/CODIGO'){
            $factura = New Factura();
            $factura->aeropuerto = $request->aeropuerto;              
            $factura->contrato = $contrato->id;                       
            $factura->codigo_contrato = $request->codigo;             
            $factura->numero_nota_cobro = $numeroNotaCobro;           
            $factura->orden_impresion = $ordenImpresion;              
            $factura->mes = $mes;                                     
            $factura->gestion = $gestion;                             
            $factura->tipo_solicitante = $cliente->tipo_solicitante;  

            if ($tipoIdentificacion->descripcion == 'CI') 
                $factura->ci = $cliente->numero_identificacion;
            else
                $factura->nit = $cliente->numero_identificacion;    
        
            $factura->tipo_canon = 'V';                               

            $factura->forma_pago = 1;                                                            
            $factura->tipo_factura = $request->tipo;                  
            $factura->cliente = $request->cliente;                    
            $factura->razon_social_factura = $cliente->razon_social;                   
            $factura->tipo_generacion = 'M';                          
            $factura->estado = 3;                                     
            $factura->usuario_registro = auth()->id();
            $factura->fecha_registro = $fechaRegistro;
            $factura->save();

            $facturaId = $factura->id;
            $monto_total = 0;

            foreach ($request->espacios as $listaespacio) {
                $facturaDetalle = New FacturaDetalle();
                $facturaDetalle->factura = $facturaId;              
                $facturaDetalle->espacio = $listaespacio['id_espacio'];                       
                $facturaDetalle->concepto = 'V';                                                            
                $facturaDetalle->fecha_inicial = $listaespacio['fecha_inicial'];            
                $facturaDetalle->fecha_final = $listaespacio['fecha_final'];               
                $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($listaespacio['fecha_inicial'], $listaespacio['fecha_final'], $periodoInicialFacturacion, $periodoFacturacion);
                $facturaDetalle->total_canonmensual = $listaespacio['total_canonmensual'];      
                $facturaDetalle->precio = $listaespacio['total_canonmensual'];             
                $monto_total = $monto_total + $listaespacio['total_canonmensual'];
                $facturaDetalle->usuario_registro = auth()->id();                            
                $facturaDetalle->fecha_registro = $fechaRegistro;                                   
                $facturaDetalle->save();
                
                $espacio = Espacio::find($listaespacio['id_espacio']);
                $espacio->glosa_factura = $listaespacio['glosa_factura'];
                $espacio->save();
            }

            $factura = Factura::find($facturaId);
            $factura->monto_total = $monto_total;
            $factura->save();
        }

        Alert::success("Nota de Cobro Manual registrada correctamente");
        return redirect()->route('notacobromanual.index');
    }

    public function edit($id_factura)
    {
        $factura = Factura::join('factura_detalle as fd', 'fd.factura', '=', 'factura.id')
                        ->select('factura.tipo_factura', 'factura.aeropuerto', 'factura.contrato', 'factura.codigo_contrato', 'factura.mes', 'factura.gestion', 'factura.tipo_canon', 
                                 'factura.cliente', 'factura.monto_total', 'fd.espacio', 'fd.expensa', 'fd.glosa', 'fd.fecha_inicial', 'fd.fecha_final')
                        ->where('factura.tipo_generacion', 'M')
                        ->where('factura.id', $id_factura)
                        ->first();

        $idFactura = $id_factura;
        $tipo_factura = $factura['tipo_factura'];
        $aeropuerto = Aeropuerto::find($factura->aeropuerto);
        $aeropuertoDescripcion = $aeropuerto->descripcion;
        $cliente = Cliente::find($factura->cliente);
        $clienteRazonSocial = $cliente->razon_social;

        $codigosContrato = Contrato::where('aeropuerto', $factura->aeropuerto)
                    ->where('cliente', $factura->cliente)
                    ->where('estado', 5)
                    ->pluck('codigo');

        $codigoContratoReg = $factura->codigo_contrato;

        $mes = $factura->mes;
        $gestion = $factura->gestion;
        $fecha = Carbon::createFromDate($gestion, $mes, 1);
        $periodoFacturacion = $fecha->endOfMonth()->format('Y-m-d');
        $periodoInicialCobro = $factura->fecha_inicial;
        $periodoFinalCobro = $factura->fecha_final;
        $monto = $factura->monto_total;
        $glosa = $factura->glosa;
        $tipoCanon = $factura->tipo_canon;
        $facturaDetalles = collect();

        if ($factura['tipo_factura'] == 'EX' && $factura['codigo_contrato'] != 'SIN/CODIGO'){
            $viewEspacio = View_Espacio::where('id', $factura->espacio)
                                    ->where('contrato', $factura->contrato)
                                    ->first();
            $descripcionEspacio = $viewEspacio->descripcion;
            $expensa = Expensa::find($factura->expensa);
            $expensaDescripcion = $expensa->descripcion;
            $consumo = $monto/$expensa->factor;
            $expensaFactor = $expensa->factor;
        } else {
            $descripcionEspacio = 'Valor por defecto';
            $expensaDescripcion = 'Valor por defecto';
            $consumo = 'Valor por defecto';
            $expensaFactor = 'Valor por defecto';
        }

        if ($factura->tipo_factura == 'AL' && $factura->codigo_contrato != 'SIN/CODIGO'){
            $facturaDetalles = FacturaDetalle::where('factura', $id_factura)
                                        ->orderBy('id')
                                        ->get();
        }
        
        return view('facturacion.notascobromanual.edit',compact('tipo_factura', 'idFactura', 'aeropuertoDescripcion', 'clienteRazonSocial', 'codigosContrato', 'codigoContratoReg', 'periodoFacturacion', 'periodoInicialCobro', 'periodoFinalCobro', 'monto', 'glosa', 'tipoCanon', 'descripcionEspacio', 'expensaDescripcion', 'consumo', 'expensaFactor', 'facturaDetalles'));
    }

    public function update($idFactura, Request $request)
    {
        $factura = Factura::find($idFactura);
        //dd($request);
        if (($factura->tipo_factura == 'AL' && $factura->codigo_contrato == 'SIN/CODIGO') || $factura->tipo_factura == 'MOR' || $factura->tipo_factura == 'OTR'){
            $mes = Carbon::parse($request->periodo_facturacion)->format('m');
            $gestion = Carbon::parse($request->periodo_facturacion)->format('Y');   
            $periodoFacturacion = $request->periodo_facturacion;
            $periodoInicialFacturacion = Carbon::parse($periodoFacturacion)->startOfMonth()->toDateString();

            $factura->codigo_contrato = $request->codigo;
            $factura->mes = $mes;
            $factura->gestion = $gestion;
            $factura->tipo_canon = $request->tipo_espacio;
            $factura->monto_total = $request->monto;
            $factura->save();

            $facturaDetalle = FacturaDetalle::where('factura', $idFactura)->first();
            $facturaDetalle->glosa = $request->glosa_factura; 
            $facturaDetalle->concepto = $request->tipo_espacio;
            $facturaDetalle->fecha_inicial = $request->periodo_inicial;
            $facturaDetalle->fecha_final = $request->periodo_final;
            $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($request->periodo_inicial, $request->periodo_final, $periodoInicialFacturacion, $periodoFacturacion);
            $facturaDetalle->total_canonmensual = $request->monto;
            $facturaDetalle->precio = $request->monto;
            $facturaDetalle->save();
        } else if ($factura->tipo_factura == 'EX' && $factura->codigo_contrato == 'SIN/CODIGO'){
            $mes = Carbon::parse($request->periodo_facturacion)->format('m');
            $gestion = Carbon::parse($request->periodo_facturacion)->format('Y');   
            $periodoFacturacion = $request->periodo_facturacion;
            $periodoInicialFacturacion = Carbon::parse($periodoFacturacion)->startOfMonth()->toDateString();

            $factura->mes = $mes;
            $factura->gestion = $gestion;
            $factura->monto_total = $request->monto;
            $factura->save();

            $facturaDetalle = FacturaDetalle::where('factura', $idFactura)->first();
            $facturaDetalle->glosa = $request->glosa_factura; 
            $facturaDetalle->fecha_inicial = $request->periodo_inicial;
            $facturaDetalle->fecha_final = $request->periodo_final;
            $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($request->periodo_inicial, $request->periodo_final, $periodoInicialFacturacion, $periodoFacturacion);
            $facturaDetalle->total_canonmensual = $request->monto;
            $facturaDetalle->precio = $request->monto;
            $facturaDetalle->save();

        } else if ($factura->tipo_factura == 'EX' && $factura->codigo_contrato != 'SIN/CODIGO'){
            $mes = $factura->mes;
            $gestion = $factura->gestion; 
            $fecha = Carbon::createFromDate($gestion, $mes, 1);
            $periodoInicialFacturacion = $fecha->startOfMonth()->format('Y-m-d');
            $periodoFacturacion = $fecha->endOfMonth()->format('Y-m-d');

            $factura->monto_total = $request->g_total_a_pagar;
            $factura->save();

            $facturaDetalle = FacturaDetalle::where('factura', $idFactura)->first();
            $facturaDetalle->glosa = $request->g_glosa; 
            $facturaDetalle->fecha_inicial = $request->g_periodo_inicial;
            $facturaDetalle->fecha_final = $request->g_periodo_final;
            $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($request->g_periodo_inicial, $request->g_periodo_final, $periodoInicialFacturacion, $periodoFacturacion);
            $facturaDetalle->total_canonmensual = $request->g_total_a_pagar;
            $facturaDetalle->precio = $request->g_total_a_pagar;
            $facturaDetalle->save();
        } else if ($factura->tipo_factura == 'AL' && $factura->codigo_contrato != 'SIN/CODIGO'){
            $mes = $factura->mes;
            $gestion = $factura->gestion; 
            $fecha = Carbon::createFromDate($gestion, $mes, 1);
            $periodoInicialFacturacion = $fecha->startOfMonth()->format('Y-m-d');
            $periodoFacturacion = $fecha->endOfMonth()->format('Y-m-d');
            $monto_total = 0;
            foreach ($request->espacios as $listaespacio) {
                $facturaDetalle = FacturaDetalle::find($listaespacio['id_factura_detalle']);                                                          
                $facturaDetalle->fecha_inicial = $listaespacio['fecha_inicial'];            
                $facturaDetalle->fecha_final = $listaespacio['fecha_final'];               
                $facturaDetalle->dias_facturados = NotaCobro::obtenerDiasAFacturar($listaespacio['fecha_inicial'], $listaespacio['fecha_final'], $periodoInicialFacturacion, $periodoFacturacion);   
                $facturaDetalle->precio = $listaespacio['total_canonmensual'];             
                $monto_total = $monto_total + $listaespacio['total_canonmensual'];                                
                $facturaDetalle->save();
                
                $espacio = Espacio::find($listaespacio['id_espacio']);
                $espacio->glosa_factura = $listaespacio['glosa_factura'];
                $espacio->save();
            }
            $factura->monto_total = $monto_total;
            $factura->save();
        }

        Alert::success("Nota de cobro manual modificada correctamente");
        return redirect()->route('notacobromanual.index');
    }

    public function aprobarNotaCobroManual(Request $request)
    {
        // Verifica que el array 'aprobado' existe y contiene IDs
        if (isset($request->aprobado) && is_array($request->aprobado)) {
            // Actualiza el estado de todas las facturas con los IDs en el array
            Factura::whereIn('id', $request->aprobado)->update(['estado' => 5]); 
            
            //return response()->json(['success' => true, 'message' => 'Las notas de cobro han sido aprobadas.']);
            Alert::success('La(s) nota(s) de cobro ha(n) sido aprobada(s) correctamente');
            //return redirect()->back();
            return redirect()->route('notacobromanual.index');
        }

        // Si no se recibe el array 'aprobado' o es inválido, lanza un error
        return response()->json(['success' => false, 'message' => 'No se recibieron notas de cobro para aprobar.'], 400);
    }

}
