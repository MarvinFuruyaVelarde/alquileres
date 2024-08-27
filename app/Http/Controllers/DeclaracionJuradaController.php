<?php

namespace App\Http\Controllers;

use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\DeclaracionJurada;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class DeclaracionJuradaController extends Controller
{
     public function index()
    {
        $empleados=null;
        return view('declaraciones.consulta',compact('empleados'));
    }
    public function empleados()
    {
        $empleados=Empleado::with('declaraciones')->get();
        return view('declaraciones.empleados',compact('empleados'));
    }

    public function create(Empleado $empleado)
    {
        $declaraciones=DeclaracionJurada::where('empleado_id',$empleado->id)->get();
        return view('declaraciones.create',compact('empleado','declaraciones'));
    }

    public function store(Request $request)
    {
        $empleado=Empleado::find($request->empleado_id);
        $documento = new DeclaracionJurada();
        $fyear = date('Y');
        $fmon = date('m');
        $fday = date('d');
        $hh = date('H');
        $hi = date('i');
        $hs = date('s');
        //HOJA VIDA
        $path=public_path().'/declaraciones_juradas';
        $documento_declaracion=$request->file('nombre');
              $name="documento_declaracion".$fyear.$fmon.$fday.$hh.$hi.$hs.$empleado->ci;
              $nombredocumento_declaracion=$name.".". $documento_declaracion->extension();
              $documento_declaracion->move($path, $nombredocumento_declaracion);
        $documento->nombre = $nombredocumento_declaracion;
        $documento->tipo = $request->input('tipo');
        $documento->codigo = $request->input('codigo');
        $documento->fecha_certificacion = $request->input('fecha_certificacion');
        $documento->fecha_presentacion = $request->input('fecha_presentacion');
        //FOTOCOPIA CARNET IDENTIDAD
        $documento->empleado_id = $request->empleado_id;

        $documento->save();

        Alert::success('Guardado', 'Declaración Jurada Guardada con exito!!!');
        return redirect()->route('declaraciones.create',$empleado);
    }

    public function show(Empleado $empleado)
    {
        $files=DeclaracionJurada::where('empleado_id',$empleado->id)->orderBy('created_at','asc')->get();
        $merger = PDFMerger::init();
        for ($i=0; $i <=count($files)-1 ; $i++)
        {
            $merger->addPDF(public_path().'/declaraciones_juradas/'.$files[$i]->nombre,'all');
        }
        $merger->merge();
        $merger->setFileName('DDJJ-'.$empleado->ci.'.pdf');
        $merger->stream();
    }

    public function destroy(DeclaracionJurada $declaracionJurada)
    {
        $empleado=Empleado::find($declaracionJurada->empleado_id);
        $declaracionJurada->delete();
        Alert::success('Eliminación', 'Declaración Jurada Eliminada con exito!!!');
        return redirect()->route('declaraciones.create',$empleado);
    }
    public function buscar_empleado(Request $request)
    {
        $nombre=$request->nombre==null ? '' : $request->nombre;
        $ci=$request->ci==null ? '' : $request->ci;
        $empleados=DB::select("select e.*,c.nombre as cargo
        from empleados e inner join cargo_empleados ce on e.id=ce.empleado_id
        inner join cargos c on c.id=ce.cargo_id
        where ce.deleted_at is null and CONCAT(IFNULL(e.nombres,''),' ',IFNULL(e.ap_paterno,''),' ',IFNULL(e.ap_materno,'')) LIKE '%".$nombre."%' AND e.ci LIKE '%".$ci."%'");
        
        return view('declaraciones.consulta',compact('empleados'));
    }
}

