<?php

namespace App\Http\Controllers;

use App\Exports\RegionalesExport;
use App\Http\Requests\RegionalRequest;
use App\Models\Estado;
use App\Models\Regional;
use App\Models\UsuarioRegional;
use App\Models\View_Regional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class RegionalController extends Controller
{
    public function index()
    {
        /*if(auth()->user()->id==1){
            $regionales=View_Regional::where('id','>',0)->get();
        }else{
            $auth_user=auth()->user();
            $usuario_regional=UsuarioRegional::where('usuario',$auth_user->id)->get();
            $array = [];
            $cont=0;

            foreach ($usuario_regional as $value) {
                $array[$cont]=$value->regional;
                $cont++;
            }
            $regionales = View_Regional::whereIn('id',$array)->get();
        }*/
        
        $regionales=View_Regional::where('id','>',0)->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        return view('parametricas.regionales.index', compact('regionales')); // Pasar a la vista
    }

    public function create()
    {
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        $regional=new Regional();
        return view('parametricas.regionales.create',compact('regional', 'estados'));
    }

    public function store(RegionalRequest $request)
    {
        
        $regional=new Regional();

        $regional->codigo = $request->codigo;
        $regional->descripcion = $request->descripcion;
        $regional->estado = $request->estado;

        $regional->save();
        Alert::success("Regional registrada correctamente!");
        return redirect()->route('regionales.index');
    }

    public function edit(Regional $regional)
    {
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        return view('parametricas.regionales.edit',compact('regional', 'estados'));
    }

    public function update(Request $request, Regional $regional)
    {
        $request->validate( [
            'codigo'=>'required',
            'descripcion'=>'required',
            'estado'=>'required',
        ],[
                    'codigo.required' => 'El campo es de ingreso obligatorio.',
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $regional->codigo=$request->codigo;
        $regional->descripcion=$request->descripcion;
        $regional->estado=$request->estado;

        $regional->save();

        //actualice los roles
        return redirect()->route('regionales.index');
    }

    public function destroy(Regional $regional)
    {
        $regional->delete();
        
        Alert::success('Regional eliminada correctamente!');
        return redirect()->route('regionales.index');
    }

    public function show()
    {
        $pdf = App::make('dompdf.wrapper');
        $regionales = View_Regional::all();
        $pdf->loadView('parametricas.regionales.pdf.reportegral',compact('regionales'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new RegionalesExport, 'regionales.xlsx');
    }
}
