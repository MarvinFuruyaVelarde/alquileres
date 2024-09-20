<?php

namespace App\Http\Controllers;

use App\Exports\AeropuertosExport;
use App\Http\Requests\AeropuertoRequest;
use App\Models\Aeropuerto;
use App\Models\Estado;
use App\Models\Regional;
use App\Models\UsuarioRegional;
use App\Models\View_Aeropuerto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AeropuertoController extends Controller
{
    public function index()
    {
        if(auth()->user()->id==1){
            $aeropuertos = View_Aeropuerto::all();
        }else{
            $auth_user=auth()->user();
        $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
        $array = [];
        $cont=0;
        foreach ($usuario_regional as $value) {
            $array[$cont]=$value->regional;
            $cont++;
        }
        $aeropuertos = View_Aeropuerto::whereIn('regional',$array)->get();
        }
        return view('parametricas.aeropuertos.index', compact('aeropuertos')); // Pasar a la vista
    }

    public function create()
    {
        if(auth()->user()->id==1){
            $regionales=Regional::where('id','>',0)->get();
        }else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;
            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            $regionales = Regional::whereIn('id',$array)->get();
            }
        
        $estados=Estado::where('id','>',0)->get();
        $aeropuerto=new Aeropuerto();
        return view('parametricas.aeropuertos.create',compact('aeropuerto', 'regionales', 'estados'));
    }

    public function store(AeropuertoRequest $request)
    {
        
        $aeropuerto=new Aeropuerto();

        $aeropuerto->codigo = $request->codigo;
        $aeropuerto->descripcion = $request->descripcion;
        $aeropuerto->regional = $request->regional;
        $aeropuerto->estado = $request->estado;

        $aeropuerto->save();
        Alert::success("Aeropuerto registrado correctamente!");
        return redirect()->route('aeropuertos.index');
    }

    public function edit(Aeropuerto $aeropuerto)
    {
        $regionales=Regional::where('id','>',0)->get();
        $estados=Estado::where('id','>',0)->get();
        return view('parametricas.aeropuertos.edit',compact('aeropuerto', 'regionales', 'estados'));
    }

    public function update(Request $request, Aeropuerto $aeropuerto)
    {
        $request->validate( [
            'codigo'=>'required',
            'descripcion'=>'required',
            'regional'=>'required',
            'estado'=>'required',
        ],[
                    'codigo.required' => 'El campo es de ingreso obligatorio.',
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'factor.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $aeropuerto->codigo=$request->codigo;
        $aeropuerto->descripcion=$request->descripcion;
        $aeropuerto->regional=$request->regional;
        $aeropuerto->estado=$request->estado;

        $aeropuerto->save();

        //actualice los roles
        return redirect()->route('aeropuertos.index');
    }

    public function destroy(Aeropuerto $aeropuerto)
    {
        $aeropuerto->delete();
        
        Alert::success('Aeropuerto eliminado correctamente!');
        return redirect()->route('aeropuertos.index');
    }

    public function show()
    {
        $pdf = App::make('dompdf.wrapper');
        $aeropuertos = View_Aeropuerto::all();
        $pdf->loadView('parametricas.aeropuertos.pdf.reportegral',compact('aeropuertos'));
        return $pdf->stream();
    }
    public function export()
    {
        return Excel::download(new AeropuertosExport, 'aeropuertos.xlsx');
    }
}
