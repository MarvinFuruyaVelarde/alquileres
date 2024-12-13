<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetallePagoFacturaRequest;
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\DetallePagoFactura;
use App\Models\Factura;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DetallePagoFacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::all(); 
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
        $fecha_actual=date('Y-m-d');
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
        $detalle_pago->fecha_pago=$request->fecha_actual;
        $detalle_pago->cuenta=$request->cuenta_destino;

        if($request->fecha_deposito == null)
            $detalle_pago->fecha_deposito=null;
        else
            $detalle_pago->fecha_deposito=$request->fecha_deposito;

        $detalle_pago->nro_registro_deposito=$request->registro_deposito;
        $detalle_pago->nro_registro_cobro=$request->recibo_cobro;
        $detalle_pago->observacion=$request->observacion;
        $detalle_pago->save();

        Alert::success("Registro de Pago registrado correctamente");
        return redirect()->route('registropagos.index');
    }
}
