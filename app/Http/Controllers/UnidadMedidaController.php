<?php

namespace App\Http\Controllers;

use App\Exports\UnidadesMedidaoExport;
use App\Http\Requests\UnidadMedidaRequest;
use App\Models\Estado;
use App\Models\UnidadMedida;
use App\Models\View_UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class UnidadMedidaController extends Controller
{
    public function index()
    {
        $unidadesmedida = View_UnidadMedida::where('id','>',0)->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        return view('parametricas.unidadesmedida.index', compact('unidadesmedida')); // Pasar a la vista
    }

    public function create()
    {
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        $unidadmedida=new UnidadMedida();
        return view('parametricas.unidadesmedida.create',compact('unidadmedida', 'estados'));
    }

    public function store(UnidadMedidaRequest $request)
    {
        
        $unidadmedida=new UnidadMedida();

        $unidadmedida->descripcion = $request->descripcion;
        $unidadmedida->estado = $request->estado;

        $unidadmedida->save();
        Alert::success("Unidad de Medida registrada correctamente!");
        return redirect()->route('unidadesmedida.index');
    }

    public function edit(UnidadMedida $unidadmedida)
    {
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        return view('parametricas.unidadesmedida.edit',compact('unidadmedida', 'estados'));
    }

    public function update(Request $request, UnidadMedida $unidadmedida)
    {
        $request->validate( [
            'descripcion'=>'required',
            'estado'=>'required',
        ],[
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $unidadmedida->descripcion=$request->descripcion;
        $unidadmedida->estado=$request->estado;

        $unidadmedida->save();

        //actualice los rubros
        return redirect()->route('unidadesmedida.index');
    }

    public function destroy(UnidadMedida $unidadmedida)
    {
        $unidadmedida->delete();
        
        Alert::success('Unidad de Medida eliminada correctamente!');
        return redirect()->route('unidadesmedida.index');
    }
    public function show()
    {
        $pdf = App::make('dompdf.wrapper');
        $unidadesmedida = View_UnidadMedida::all();
        $pdf->loadView('parametricas.unidadesmedida.pdf.reportegral',compact('unidadesmedida'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new UnidadesMedidaoExport, 'unidadesmedida.xlsx');
    }
}
