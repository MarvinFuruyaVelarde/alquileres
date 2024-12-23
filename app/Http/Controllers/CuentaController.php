<?php

namespace App\Http\Controllers;

use App\Exports\CuentasExport;
use App\Http\Requests\CuentaRequest;
use App\Models\Cuenta;
use App\Models\Estado;
use App\Models\Moneda;
use App\Models\View_Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = View_Cuenta::where('estado','=',1)->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        return view('parametricas.cuentas.index', compact('cuentas')); // Pasar a la vista
    }

    public function create()
    {
        $monedas=Moneda::where('id','>',0)->get();
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        $cuenta=new Cuenta();
        return view('parametricas.cuentas.create',compact('cuenta', 'monedas', 'estados'));
    }

    public function store(CuentaRequest $request)
    {
        
        $cuenta=new Cuenta();

        $cuenta->descripcion = $request->descripcion;
        $cuenta->numero_cuenta = $request->numero_cuenta;
        $cuenta->moneda = $request->moneda;
        $cuenta->estado = $request->estado;

        $cuenta->save();
        Alert::success("Cuenta registrada correctamente!");
        return redirect()->route('cuentas.index');
    }

    public function edit(Cuenta $cuenta)
    {
        $monedas=Moneda::where('id','>',0)->get();
        $estados = Estado::whereIn('id', [1, 2])->orderBy('id', 'asc')->get();
        return view('parametricas.cuentas.edit',compact('cuenta', 'monedas', 'estados'));
    }

    public function update(Request $request, Cuenta $cuenta)
    {
        $request->validate( [
            'descripcion'=>'required',
            'numero_cuenta'=>'required',
            'moneda'=>'required',
            'estado'=>'required',
        ],[
                    'descripcion.required' => 'El campo es de ingreso obligatorio.',
                    'numero_cuenta.required' => 'El campo es de ingreso obligatorio.',
                    'moneda.required' => 'El campo es de ingreso obligatorio.',
                    'estado.required' => 'El campo es de ingreso obligatorio.',
            ]
        );
        
        $cuenta->descripcion=$request->descripcion;
        $cuenta->numero_cuenta=$request->numero_cuenta;
        $cuenta->moneda=$request->moneda;
        $cuenta->estado=$request->estado;

        $cuenta->save();

        //actualice los roles
        return redirect()->route('cuentas.index');
    }

    public function destroy(Cuenta $cuenta)
    {
        $cuenta->delete();
        
        Alert::success('Cuenta eliminada correctamente!');
        return redirect()->route('cuentas.index');
    }

    public function show()
    {
        $pdf = App::make('dompdf.wrapper');
        $cuentas = View_Cuenta::all();
        $pdf->loadView('parametricas.cuentas.pdf.reportegral',compact('cuentas'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new CuentasExport, 'cuentas.xlsx');
    }
}
