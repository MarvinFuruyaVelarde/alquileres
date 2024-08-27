<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Documentacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;

class DocumentacionController extends Controller
{
    public function empleados()
    {
        $empleados=Empleado::with('documentacion')->get();
        //dd($empleados);
        return view('documentacion.empleados',compact('empleados'));
    }
    public function index()
    {
        $documentos=Documentacion::with('empleado')->get();
        //dd($documentos);
        return view('documentacion.index',compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Empleado $empleado)
    {
        return view('documentacion.create',compact('empleado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $empleado = Empleado::find($request->input('empleado_id'));
        $documento = new Documentacion();
        //HOJA VIDA
        $path=public_path().'/documentos_empleados';
        $hoja_vida=$request->file('hoja_vida');
        $name="hoja_vida".$request->input('ci');
        $nombrehoja_vida=$name.".". $hoja_vida->extension();
        $hoja_vida->move($path, $nombrehoja_vida);
        $documento->hoja_vida = $nombrehoja_vida;
        //
        //FOTO
        $foto=$request->file('foto');
        $name="foto".$request->input('ci');
        $nombrefoto=$name.".". $foto->extension(); 
        $foto->move($path, $nombrefoto);
        $documento->foto = $nombrefoto;
        //FOTOCOPIA CARNET IDENTIDAD
        $fotocopia_carnet_identidad=$request->file('fotocopia_carnet_identidad');
        $name="fotocopia_carnet_identidad".$request->input('ci');
        $nombrecarnet=$name.".". $fotocopia_carnet_identidad->extension();
        $fotocopia_carnet_identidad->move($path, $nombrecarnet);
        $documento->fotocopia_carnet_identidad = $nombrecarnet; 
        //////
        $documento->fotocopia_certificado_nacimiento=$request->input('fotocopia_certificado_nacimiento');
        $documento->fotocopia_servicio_militar=$request->input('fotocopia_servicio_militar');
        //CERTIFICADO AYMARA
        $certificado_aymara=$request->file('certificado_aymara');
        if($certificado_aymara){
            $name="certificado_aymara".$request->input('ci');
            $nombrecertificado=$name.".". $certificado_aymara->extension();
            $certificado_aymara->move($path, $nombrecertificado);
            $documento->certificado_aymara = $nombrecertificado; 

        }
        //
        $documento->certificado_ley_safco=$request->input('certificado_ley_safco');
        $documento->formulario_segip=$request->input('formulario_segip');
        $documento->cuenta_banco_union=$request->input('cuenta_banco_union');
        $documento->gestora=$request->input('gestora');
        //FORMULARIO SEGURO AVC 04
        $formulario_seguro=$request->file('formulario_seguro_avc_04');
        $name="formulario_seguro_avc_04".$request->input('ci');
        $nombreformulario=$name.".". $formulario_seguro->extension(); 
        $formulario_seguro->move($path, $nombreformulario);
        $documento->formulario_seguro_avc_04 = $nombreformulario;

        //
        $documento->formulario_baja_seguro=$request->input('formulario_baja_seguro');
        $documento->ciudadania_digital=$request->input('ciudadania_digital');
        $documento->formulario_incompatibilidad=$request->input('formulario_incompatibilidad');
        //////MEMORANDUM DE DESIGNACION
        $memorandum_designacion=$request->file('memorandum_designacion');
        $name="memorandum_designacion".$request->input('ci');
        $nombrememorandum=$name.".". $memorandum_designacion->extension();
        $memorandum_designacion->move($path, $nombrememorandum);
        $documento->memorandum_designacion = $nombrememorandum; 
        /////
        ////CALIFICACION DE AÑOS DE SERVICIO/////
        $cas=$request->file('cas');
          if($cas){
              $name="cas".$request->input('ci');
              $nombrecas=$name.".". $cas->extension();
              $cas->move($path, $nombrecas);
              $documento->cas = $nombrecas; 
  
          }
        /////////////////////////////////////
        ///////OTROS///
        /*$documentoOtros= new Otros();
        $otros=$request->file('otros');
        $name="otros".$request->input('ci');
        $otros->storeAs('', $name.".". $otros->extension(),'public');
        $nombreotros=$name.".". $otros->extension();
        $documentoOtros->otros = $nombreotros; 
        $documentoOtros->save();*/
        //////////
        $documento->memorandum_servidor_publico=$request->input('memorandum_servidor_publico');
        $documento->memorandum_destitucion=$request->input('memorandum_destitucion');
        $documento->formulario_incompatibilidad_percepcion=$request->input('formulario_incompatibilidad_percepcion');
        $documento->formulario_declaracion_incompatibilidades=$request->input('formulario_declaracion_incompatibilidades');
        $documento->formulario_induccion=$request->input('formulario_induccion');
        $documento->certificado_sipasse_rejap=$request->input('certificado_sipasse_rejap');
        $documento->licencias=$request->input('licencias');
        $documento->vacaciones=$request->input('vacaciones');
        $documento->lactancia=$request->input('lactancia');
        $documento->empleado_id = $request->input('empleado_id');
        $documento->save();

        Alert::success('Guardado', 'Documento Guardado con exito!!!');
        return redirect()->route('documentos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documentacion $documentacion)
    {
        $pdf = App::make('dompdf.wrapper');
        $empleado=Empleado::find($documentacion->empleado_id);
        $pdf->loadView('documentacion.pdf.file',compact('documentacion','empleado'));
        
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documentacion $documentacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documentacion $documentacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documentacion $documentacion)
    {
        //
    }
}
