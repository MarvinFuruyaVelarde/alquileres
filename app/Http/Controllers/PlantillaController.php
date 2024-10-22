<?php

namespace App\Http\Controllers;

use App\Models\Aeropuerto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Espacio;
use App\Models\FormaPago;
use App\Models\Plantilla;
use App\Models\Rubro;
use App\Models\View_Espacio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\App;

class PlantillaController extends Controller
{

    public function index()
    {
   
        $contratos=Contrato::all();
        $contrato=Plantilla::select('contrato','cliente','fecha')->distinct()->whereIn ('contrato',$contratos->pluck('id'))->get();
        
        
        return view('plantilla.index',compact('contrato')); // Pasar a la vistaasar a la vista
    }

    
    public function create()
    {
    
        $contrato= Contrato::whereIn('id', Espacio::pluck('contrato'))
                            ->where('estado', 5)
                            ->distinct('cliente')
                            ->get();
        //dd($contrato);
        return view('plantilla.create',compact('contrato'));
    }

    public function ajax($cliente, $contrato=NULL) {
        
         
		$contrato = Contrato::where('cliente', $cliente)->get();
		$html = '<option value="">Seleccione</option>';
		foreach ($contrato as $key => $item) {
			$selected = NULL;
			$html .= "<option value='$item->id' $selected>$item->codigo</option>";
		}
                   
		return response()->json(['success'=>true, 'item'=>$html]);
	}
    public function ajax1($contrato) {
        
		 $contratos = Contrato::where('id', $contrato)->first();
        
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
                        <th class="text-center">TIPO CANON</th>
                        <th class="text-center">RUBRO</th>
                        <th class="text-center">UBICACIÓN</th>
                        <th class="text-center">DESCRIPCIÓN</th>
                        <th class="text-center">FECHA INICIAL</th>
                        <th class="text-center">FECHA FINAL</th>
                        <th class="text-center">TOTAL CANON MENSUAL</th>
                        <th class="text-center">FORMA DE PAGO</th>
                        <th class="text-center">NRO. NOTA DE COBRO</th>
                    </tr>
                </thead>
                <tbody>';
                $espacio = Espacio::where('contrato',$contratos->id)->get();
        foreach ($espacio as $item){
            $rubro = Rubro::where('id',$item->rubro)->first();
            $forma_pago = FormaPago::find($item->forma_pago);
            $view_espacio = View_Espacio::find($item->id);
            $tipoCanon = $item->tipo_canon == 'F' ? 'FIJO' : ($item->tipo_canon == 'V' ? 'VARIABLE' : $item->tipo_canon);
            $html1.="<tr>
            <td class='oculto'><input type='text' name='id_espacio[]' value='{$item->id}'/></td>
            <td class='oculto'><input type='text' name='tipo_canon[]' value='{$item->tipo_canon}'></td>
            <td class='text-center tipo-canon'>{$tipoCanon}</td>
            <td class='text-center'>{$rubro->descripcion}</td>
            <td class='text-center'>{$item->ubicacion}</td>
            <td class='text-center col-3'>{$view_espacio->descripcion}</td>
            <td class='text-center'>{$item->fecha_inicial}</td>
            <td class='text-center'>{$item->fecha_final}</td>
            <td class='text-center'>{$item->total_canonmensual}</td>
            <td class='oculto forma-pago'>{$item->forma_pago}</td>
            <td class='text-center'>{$forma_pago->descripcion}</td>
            <td class='text-center'> <input type='Number'name='cobro[]' class='form-control numero-cobro' value='{{$item->numero}}'onkeydown='javascript: return event.keyCode === 8 ||
                          event.keyCode === 46 ? true : !isNaN(Number(event.key))'/></td>
            </tr>";

        }
        $html1.="   </tbody>
            </table>
            </div>
            " ;              
		return response()->json(['success'=>true, 'item1'=>$html1]);
	}
    public function store(Request $request){
        ///VERIFICANDO SI EXISTE REGISTRO/////
        $fechaActual = date('Y-m-d');
        $mes = date('m', strtotime($fechaActual));

        $verificando_registro=Plantilla::whereMonth('fecha',$mes)->where('contrato',$request->contrato)->first();
        if($verificando_registro){
            Alert::warning("Ya Existe plantilla registrado del mes actual!");
            return redirect()->route('plantillas.index');
        }else{
            $cantidad=count(Espacio::where('contrato',$request->contrato)->get());
        for ($i=0; $i < $cantidad ; $i++) { 
            $plantilla= new Plantilla();
            $plantilla->cliente= $request->cliente;
            $plantilla->contrato = $request->contrato;
            $plantilla->numero_nota = $request->nota;
            $plantilla->numero = intval($request->cobro[$i]);
            $plantilla->espacio = intval($request->id_espacio[$i]);
            $plantilla->tipo_canon = $request->tipo_canon[$i];
            $plantilla->fecha=$fechaActual;
            $plantilla->save();

            //Actualiza la columna plantilla en Contrato a S
            Contrato::where('id', $request->contrato)->update(['plantilla' => 'S']);
        }
        Alert::success("Plantilla registrado correctamente!");
        return redirect()->route('plantillas.index');

        }



        ///////////////////////////////////
        
        
    }
    public function show($id)
    {
       
        ////OBTENIENDO FECHA
        $obteniendo_fecha=Plantilla::where('contrato',$id)->first();
        $mes = date('m', strtotime($obteniendo_fecha->fecha));
        $año = date("Y", strtotime($obteniendo_fecha->fecha));
        $dias = cal_days_in_month(CAL_GREGORIAN, $mes, $año);
        
        ///////
       
        
        $pdf = App::make('dompdf.wrapper');
      
        $numero_cobro = Plantilla::where('contrato', $id)->distinct()->value('numero_nota');
     
        $plantilla=Plantilla::where('contrato',$id)->get();
        
        $i=0;
        $array=[];
        $array1=[];
        foreach ($plantilla as $key => $item) {
            $array[$i] = $item->espacio;
            $array1[$i] =$item->cliente;
            $i++;
		}
        $cliente=Cliente::whereIn('id',$array1)->first();
        $contrato =Contrato::where('id',$id)->first();
        $aeropuerto =Aeropuerto::where('id',$contrato->aeropuerto)->first();
        $espacios=Espacio::whereIn('id',$array)->get();
        $pdf->loadView('plantilla.pdf.nota',compact('numero_cobro','espacios','aeropuerto','cliente','plantilla','dias','mes','año'));
        return $pdf->stream();
    }
    public function destroy($id){
        $obteniendo_fecha=Plantilla::where('contrato',$id)->first();
        $mes = date('m', strtotime($obteniendo_fecha->fecha));
        Plantilla::where('contrato', $id)->whereMonth('fecha', $mes)->delete();

        //Actualiza la columna plantilla en Contrato a null
        Contrato::where('id', $id)->update(['plantilla' => null]);

        Alert::success('Plantilla eliminada correctamente!');
        return redirect()->route('plantillas.index');
        
    }
    public function edit( $id)
    {                     
        $plantilla=Plantilla::where('contrato',$id)->get();

        $cliente=Cliente::whereIn('id',$plantilla->pluck('cliente'))->first();
        
        $contrato =Contrato::whereIn('id',$plantilla->pluck('contrato'))->where('cliente',$cliente->id)->first();

        $numero_cobro = Plantilla::where('contrato', $id)->distinct()->value('numero_nota');
        return view('plantilla.edit',compact( 'cliente','contrato','numero_cobro','plantilla'));
    }
    public function update(Request $request,$id){
        
        $cantidad=count(Espacio::where('contrato',$request->contrato)->get());
        Plantilla::where('contrato', $request->contrato)->delete();
       
        
        for ($i=0; $i < $cantidad ; $i++) { 
            $plantilla= new Plantilla();
        $plantilla->cliente= $request->cliente;
        $plantilla->contrato = $request->contrato;
        $plantilla->numero_nota = $request->nota;
        $plantilla->numero = intval($request->cobro[$i]);
        $plantilla->espacio = intval($request->id_espacio[$i]);
        $plantilla->tipo_canon = $request->tipo_canon[$i];
        $plantilla->fecha=$request->fecha;
        $plantilla->save();
        }
        Alert::success('Plantilla actualizada correctamente!');
        return redirect()->route('plantillas.index');

    }
   
    
}
