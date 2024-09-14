<?php

namespace App\Http\Controllers;

use App\Exports\RubrosExport;
use App\Http\Requests\RubroRequest;
use App\Models\Estado;
use App\Models\Rubro;
use App\Models\View_Rubro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class RubroController extends Controller
{
    public function index()
    {
        $rubros = View_Rubro::all(); // Obtener todos los rubros
        return view('parametricas.rubros.index', compact('rubros')); // Pasar a la vista
    }

    public function create()
    {
        $estados=Estado::where('id','>',0)->get();
        $rubro=new Rubro();
        return view('parametricas.rubros.create',compact('rubro', 'estados'));
    }

    public function store(RubroRequest $request)
    {
        
        $rubro=new Rubro();

        $rubro->descripcion = $request->descripcion;
        $rubro->estado = $request->estado;

        $rubro->save();
        Alert::success("Rubro registrado correctamente!");
        return redirect()->route('rubros.index');
    }

    public function edit(Rubro $rubro)
    {
        $estados=Estado::where('id','>',0)->get();
        return view('parametricas.rubros.edit',compact('rubro', 'estados'));
    }

    public function update(Request $request, Rubro $rubro)
    {
        $request->validate( [
            'descripcion'=>'required',
            'estado'=>'required',
        ],[
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $rubro->descripcion=$request->descripcion;
        $rubro->estado=$request->estado;

        $rubro->save();

        //actualice los rubros
        return redirect()->route('rubros.index');
    }

    public function destroy(Rubro $rubro)
    {
        $rubro->delete();
        
        Alert::success('Rubro eliminado correctamente!');
        return redirect()->route('rubros.index');
    }

    public function show()
    {
        $pdf = App::make('dompdf.wrapper');
        $rubros = View_Rubro::all();
        $pdf->loadView('parametricas.rubros.pdf.reportegral',compact('rubros'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new RubrosExport, 'rubros.xlsx');
    }
}
