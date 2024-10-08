<?php

namespace App\Http\Controllers;
use App\Http\Requests\GarantiaRequest;
use App\Models\View_Garantia;
use App\Models\Garantia; 
use App\Models\Contrato; 
use App\Models\Cliente; 
use App\Models\Cuenta;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class GarantiaController extends Controller
{
    public function index()
    {
        $garantias = View_Garantia::all(); 
        return view('garantias.index', compact('garantias')); 
    }

    public function detalle_garantia()
    {
        return view('garantias.detalle');
    }
    
    public function edit()
    {
        $contrato=Contrato::where('id','=',1)->get();
        $cliente=Cliente::where('id','=',1)->get();       
        return view('garantias.detalle',compact('contrato', 'cliente'));
    }

    public function create(Contrato $contrato)    {

        $cliente = Cliente::where('id', '=', $contrato->cliente)->first();  
        //$contratos=Contrato::where('id','=',$contrato->id)->get();     
     $cuentas=Cuenta::where('id','>',0)->get();
        $garantia=new Garantia();
        //dd($cuentas);
        return view('garantias.create',compact('garantia','contrato','cliente','cuentas'));
    }

    public function store(GarantiaRequest $request)
    {
        //dd($request);
        $garantia=new Garantia();
        $garantia->contrato = $request->contrato;
        $garantia->a_pagar = $request->a_pagar;
        $garantia->fecha_pago = now();
        $garantia->cuenta = $request->cuenta_destino;
        $garantia->numero_cuenta = $request->nro_cuenta??0;
        $garantia->fecha_deposito = $request->fecha_deposito??now();        
        

        $contrato = Contrato::find($request->contrato);
        if ($contrato) {
            // Aquí puedes actualizar los campos necesarios
            $contrato->saldo_garantia -= $request->a_pagar;
            $contrato->pago_garantia += $request->a_pagar; // Ejemplo: restar el monto de a_pagar
            $contrato->save();
        }

        $garantia->save();

        Alert::success("Garantía registrada correctamente!");
        return redirect()->route('garantias.index');
    }
}
