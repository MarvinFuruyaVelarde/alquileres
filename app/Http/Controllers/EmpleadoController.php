<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cargo;
use App\Models\Ciudad;
use App\Models\Empleado;
use App\Models\Parametro;
use App\Models\AñoServicio;
use Illuminate\Http\Request;
use App\Models\CargoEmpleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\InstitucionEducativa;
use App\Http\Requests\EmpleadoRequest;
use RealRashid\SweetAlert\Facades\Alert;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $empleados=Empleado::with('cargo')->get();
        //dd($empleados->cargo[0]);
        return view('empleados.index',compact('empleados'));
    }

    public function create()
    {
        $empleado=new Empleado();
        $ciudades=Ciudad::all();
        $formaciones=Parametro::where('tipo','formacion')->get();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        $instituciones_formacion=Parametro::where('tipo','institucion_formacion')->get();
        $tipos_cargo=Parametro::where('tipo','tipo_cargo')->get();
        $bancos=Parametro::where('tipo','banco')->get();
        $areas=Parametro::where('tipo','area')->get();
        $afps=Parametro::where('tipo','afp')->get();
        $seguros=Parametro::where('tipo','seguro_salud')->get();
        $estados_civil=Parametro::where('tipo','estado_civil')->get();
        $profesiones=Parametro::where('tipo','profesion')->get();
        $denominaciones=Parametro::where('tipo','denominacion_cargo')->get();
        return view('empleados.create',compact('empleado','ciudades','formaciones','lugares_ci','instituciones_formacion','tipos_cargo','areas','bancos','seguros','afps','estados_civil','profesiones','denominaciones'));
    }

    public function obtener_cargos(Request $request){
        $area=$request->area_id;
        $tipo=$request->tipo_cargo;
        $cargos=Cargo::where('area_id',$area)->where('tipo_cargo',$tipo)->get();
        return response()->json($cargos);
    }

    public function obtener_provincia(Request $request)
    {
        $ciudad=Ciudad::find($request->id);
        return response()->json($ciudad->provincia);
    }

    public function cargo_store(Request $request)
    {
        $area=Parametro::find($request->area_id);
        $cargo=new Cargo();
        $cargo->nombre=$request->nombre;
        $cargo->sueldo=$request->sueldo;
        $cargo->tipo_cargo=$request->tipo_cargo;
        $cargo->nro_item=$request->nro_item;
        $cargo->area_id=$request->area_id;
        $cargo->area_nombre=$area->descripcion;
        $cargo->denominacion_cargo_id=$request->denominacion_id;
        $cargo->denominacion_cargo_nombre=$request->denominacion_nombre;
        $cargo->save();

        $cargos=Cargo::where('area_id',$request->area)->where('tipo_cargo',$request->tipo_cargo)->get();
        return response()->json($cargos);
    }

    public function store(EmpleadoRequest $request)
    {
        //dd($request->all());
        if($request->tipo_cargo=='CONSULTOR'){
            $request->validate([
                'nit' => 'required',
                'fecha_conclusion' => 'required'
            ]);
        }else{
            if($request->tipo_cargo=='PERSONAL EVENTUAL'){
                $request->validate([
                    'fecha_conclusion' => 'required'
                ]);
            }
            
        }
    
            $empleado=Empleado::create($request->all());
            $cargo=Cargo::find($request->cargo_id);
            $file_foto=$request->file('foto');
            if($file_foto){
                $path=public_path().'/fotos_empleados/'.$empleado->id;
                $filename=uniqid().$file_foto->getClientOriginalName();
                $file_foto->move($path, $filename);
                $empleado->foto=$filename;
            }
    
            
            $empleado->save();
            CargoEmpleado::create([
                'empleado_id'=>$empleado->id,
                'cargo_id'=>$request->cargo_id,
                'fecha_inicio'=>$request->fecha_ingreso,
                'fecha_conclusion'=>$request->fecha_conclusion,
                'sueldo'=>$cargo->sueldo
            ]);
        
        
        Alert::success('Registro', 'Empleado Registrado con exito!!!');

        return redirect()->route('empleados.index');
    }

    public function show(Empleado $empleado)
    {
        $pdf = App::make('dompdf.wrapper');
        $ciudad=Ciudad::find($empleado->ciudad_id);
        $institucion_educativa=Parametro::find($empleado->institucion_formacion_id);
        $formacion=Parametro::find($empleado->formacion_id);
        $banco=Parametro::find($empleado->banco_id);
        $seguro_salud=Parametro::find($empleado->seguro_salud_id);
        $afp=Parametro::find($empleado->afp_id);
        $cargo=CargoEmpleado::where('empleado_id',$empleado->id)->get();  
        $profesion=Parametro::find($empleado->profesion_id);
      
        $pdf->loadView('empleados.pdf.ficha',compact('empleado','ciudad','institucion_educativa','formacion','banco','seguro_salud','afp','cargo','profesion'));
        
        return $pdf->stream();
    }

    public function edit(Empleado $empleado)
    {
        $ciudades=Ciudad::all();
        $formaciones=Parametro::where('tipo','formacion')->get();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        $instituciones_formacion=Parametro::where('tipo','institucion_formacion')->get();
        $tipos_cargo=Parametro::where('tipo','tipo_cargo')->get();
        $bancos=Parametro::where('tipo','banco')->get();
        $areas=Parametro::where('tipo','area')->get();
        $afps=Parametro::where('tipo','afp')->get();
        $seguros=Parametro::where('tipo','seguro_salud')->get();
        $estados_civil=Parametro::where('tipo','estado_civil')->get();
        $profesiones=Parametro::where('tipo','profesion')->get();
        $denominaciones=Parametro::where('tipo','denominacion_cargo')->get();
        //dd($empleado->cargo[0]->pivot['cargos.tipo_cargo']);
        return view('empleados.edit',compact('empleado','ciudades','formaciones','lugares_ci','instituciones_formacion','tipos_cargo','areas','bancos','seguros','afps','estados_civil','profesiones','denominaciones'));
    }

    public function update(EmpleadoRequest $request, Empleado $empleado)
    {
        if($request->tipo_cargo=='CONSULTOR'){
            $request->validate([
                'nit' => 'required',
                'fecha_conclusion' => 'required'
            ]);
        }else{
            if($request->tipo_cargo=='PERSONAL EVENTUAL'){
                $request->validate([
                    'fecha_conclusion' => 'required'
                ]);
            }
            
        }

        $empleado->update($request->all());

        $file_foto=$request->file('foto');
        if($file_foto){
            $path=public_path().'/fotos_empleados/'.$empleado->id;
            $filename=uniqid().$file_foto->getClientOriginalName();
            $file_foto->move($path, $filename);
            $empleado->foto=$filename;
        }

      
        $empleado->save();
        
        DB::table('cargo_empleados')->where('empleado_id', $empleado->id)->where('cargo_id', $empleado->cargo[0]->id)->whereNull('deleted_at')
        ->update([
            'cargo_id'=>$request->cargo_id,
            'fecha_inicio'=>$request->fecha_ingreso,
            'fecha_conclusion'=>$request->fecha_conclusion
        ]);
        Alert::success('Atualización', 'Datos del Empleado Actualizado con exito!!!');

        return redirect()->route('empleados.index');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        Alert::success('Eliminación', 'Empleado Eliminado con exito!!!');

        return redirect()->route('empleados.index');
    }

    public function ficha(Empleado $empleado)
    {
        return view('empleados.ficha_firmada',compact('empleado'));
    }

    public function ficha_store(Request $request)
    {
        $empleado=Empleado::find($request->empleado_id);
        $path=public_path().'/fichas_firmadas';
        $documento=$request->file('documento');
        $name="ficha_firmada".$empleado->ci;
        $nombredocumento=$name.".". $documento->extension();
        $documento->move($path, $nombredocumento);
        $empleado->ficha_firmada = $nombredocumento;
        $empleado->save();
        Alert::success('Guardado', 'Archivo de Ficha Firmada Guardada con exito!!!');
        return redirect()->route('empleados.index');
    }

    public function tipo_parentesco(Request $request)
    {
        $search = $request->search;
        
        $nombres = DB::table('empleados')->select('contacto_parentesco')->where('contacto_parentesco', 'like', '%' .$search . '%' )->limit(5)->distinct('contacto_parentesco')->get();
        $response = array();
        foreach($nombres as $codigo){
            $response[] = array("value"=>$codigo->contacto_parentesco);
        }
        return response()->json($response);
    }

    public function institucion_store(Request $request)
    {
        $instituto=new Parametro();
        $instituto->descripcion=$request->descripcion;
        $instituto->tipo='institucion_formacion';
        $instituto->save();

        $instituciones_formacion=Parametro::where('tipo','institucion_formacion')->get();
        return response()->json($instituciones_formacion);
    }
    public function profesion_store(Request $request)
    {
        $profesion=new Parametro();
        $profesion->descripcion=$request->descripcion;
        $profesion->tipo='profesion';
        $profesion->save();
        $profesion=Parametro::where('tipo','profesion')->get();
        return response()->json($profesion);
    }
    public function formacion_store(Request $request)
    {
        $formacion=new Parametro();
        $formacion->descripcion=$request->descripcion;
        $formacion->tipo='formacion';
        $formacion->save();
        $formacion=Parametro::where('tipo','formacion')->get();
        return response()->json($formacion);
    }
}
