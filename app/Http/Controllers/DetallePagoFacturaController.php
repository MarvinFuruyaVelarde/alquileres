<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetallePagoFacturaRequest;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\DetallePagoFactura;
use App\Models\Factura;
use App\Models\UsuarioRegional;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DetallePagoFacturaController extends Controller
{
    public function index()
    {
        if(auth()->user()->id==1){
            $facturas = Factura::where('estado', 8)->orderBy('id', 'desc')->get();
        } else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;

            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            $facturas = Factura::join('aeropuerto as a', 'a.id', '=', 'factura.aeropuerto')->where('factura.estado', 8)->whereIn('a.regional', [$array])->orderByDesc('factura.id')->select('factura.id', 'factura.razon_social_factura', 'factura.numero_nota_cobro', 'factura.numero_factura', 'factura.monto_total')->get();
        }

        return view('registro_pagos.index', compact('facturas')); 
    }
    public function create(Factura $factura)
    {
        $cuentas=Cuenta::where('id','>',0)->get();
        $cliente = Cliente::find($factura->cliente);
        $pagado = DetallePagoFactura::where('id_factura', $factura->id)->sum('a_pagar');
        $fecha_actual=date('Y-m-d');

        return view('registro_pagos.create', compact('factura','cliente','pagado','fecha_actual','cuentas'));
    }
    public function store(DetallePagoFacturaRequest $request)
    {
        $fechaInicial = Carbon::createFromDate($request->gestion, $request->mes, 1)->startOfDay();
        $fechaLimite = $fechaInicial->addMonth()->day(10)->startOfDay();
        $diasMora = 0;
        $cobroMora = 'N';

        if (Carbon::parse($request->fecha_actual)->startOfDay() > $fechaLimite){
            $diasMora = Carbon::parse($request->fecha_actual)->startOfDay()->diffInDays($fechaLimite->startOfDay());
            $cobroMora='S';
        }
        $factura=Factura::find($request->factura_id);
        $pagado_saldo=DetallePagoFactura::where('id_factura',$request->factura_id)->latest('id') ->first();

        if($pagado_saldo==null){
            $suma_pagado=$request->pagar;
            $suma_saldo=$factura->monto_total;
        } else{ 
            $suma_pagado=$pagado_saldo->pagado+$request->pagar;
            $suma_saldo=$factura->monto_total-$suma_pagado;
        }

        $detalle_pago = new DetallePagoFactura();
        $detalle_pago->id_factura=$request->factura_id;
        $detalle_pago->a_pagar=$suma_pagado;
        $detalle_pago->saldo=$request->saldo_registro_pago - $request->pagar;
        $detalle_pago->mora=((($request->pagar*3)/100)/30)*$diasMora;
        $detalle_pago->fecha_pago=$request->fecha_actual;
        $detalle_pago->cuenta=$request->cuenta_destino;

        if($request->fecha_deposito == null)
            $detalle_pago->fecha_deposito=null;
        else
            $detalle_pago->fecha_deposito=$request->fecha_deposito;

        $detalle_pago->numero_registro_deposito=$request->registro_deposito;
        $detalle_pago->numero_registro_cobro=$request->recibo_cobro;
        $detalle_pago->observacion=$request->observacion;
        $detalle_pago->cobro_mora = $cobroMora;
        $detalle_pago->save();

        Alert::success("Registro de Pago registrado correctamente");
        return redirect()->route('registropagos.index');
    }
}
