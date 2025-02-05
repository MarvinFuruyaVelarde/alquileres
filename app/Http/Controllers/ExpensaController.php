<?php

namespace App\Http\Controllers;

use App\Exports\ClientesExport;
use App\Exports\ExpensasExport;
use App\Http\Requests\AeropuertoExpensaRequest;
use App\Http\Requests\ExpensaRequest;
use App\Models\Aeropuerto;
use App\Models\AeropuertoExpensa;
use App\Models\Estado;
use App\Models\Expensa;
use App\Models\UsuarioRegional;
use App\Models\View_AeropuertoExpensa;
use App\Models\View_Expensa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ExpensaController extends Controller
{
    public function index()
    {
        $expensas = View_Expensa::where('id','>',0)->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        return view('parametricas.expensas.index', compact('expensas')); // Pasar a la vista
    }

    public function create()
    {
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        $expensa=new Expensa();
        return view('parametricas.expensas.create',compact('expensa', 'estados'));
    }

    public function store(ExpensaRequest $request)
    {
        
        $expensa=new Expensa();

        $expensa->descripcion = $request->descripcion;
        $expensa->estado = $request->estado;
        $expensa->unidad_medida = $request->unidad_medida;

        $expensa->save();
        Alert::success("Expensa registrada correctamente!");
        return redirect()->route('expensas.index');
    }

    public function edit(Expensa $expensa)
    {
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        return view('parametricas.expensas.edit',compact('expensa', 'estados'));
    }

    public function update(Request $request, Expensa $expensa)
    {
        $request->validate( [
            'descripcion'=>'required',
            'estado'=>'required',
        ],[
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $expensa->descripcion=$request->descripcion;
        //$expensa->factor=$request->factor;
        $expensa->estado=$request->estado;
        $expensa->unidad_medida = $request->unidad_medida;

        $expensa->save();

        //actualice los roles
        return redirect()->route('expensas.index');
    }

    public function destroy(Expensa $expensa)
    {
        $expensa->delete();
        
        Alert::success('Expensa eliminada correctamente!');
        return redirect()->route('expensas.index');
    }

    public function createAeropuertoExpensa(Expensa $expensa)
    {
        $estado = Estado::find($expensa->estado);
        $estadoDesc = $estado->descripcion;
        
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

        $aeropuertoExpensas = View_AeropuertoExpensa::where('expensa', $expensa->id)->get();
        //dd($aeropuertoExpensas);
        return view('parametricas.expensas.create_factor',compact('expensa', 'estadoDesc', 'aeropuertos', 'aeropuertoExpensas'));
    }

    public function storeAeropuertoExpensa(AeropuertoExpensaRequest $request)
    {
        $aeropuertoExpensa = new AeropuertoExpensa();
        $aeropuertoExpensa->aeropuerto = $request->aeropuerto;
        $aeropuertoExpensa->expensa = $request->expensa;
        $aeropuertoExpensa->factor = $request->factor;
        $aeropuertoExpensa->save();


        Alert::success("Factor registrado correctamente!");
        return redirect()->back();
    }

    public function show()
    {
        $pdf = App::make('dompdf.wrapper');
        $expensas = View_Expensa::all();
        $pdf->loadView('parametricas.expensas.pdf.reportegral',compact('expensas'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new ExpensasExport, 'expensas.xlsx');
    }
}
