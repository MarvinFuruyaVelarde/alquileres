<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $empleados=DB::select('SELECT c.nombre as cargo, c.tipo_cargo, c.sueldo, (select count(*) from cargo_empleados ce where ce.cargo_id=c.id and ce.deleted_at is null) nro_empleados
        from cargos c 
        WHERE c.deleted_at is null');
        $items=DB::select("select count(*) AS nro_empleados, SUM(t.sueldo) as total_sueldo
        from 
        (SELECT c.nombre, c.sueldo, c.tipo_cargo, (select count(*) from cargo_empleados ce where ce.cargo_id=c.id and ce.deleted_at is null) nro_empleados
        from cargos c 
        WHERE c.deleted_at is null ) as t
        where t.tipo_cargo='ITEM' and nro_empleados > 0");
        $consultores=DB::select("select count(*) AS nro_empleados, SUM(t.sueldo) as total_sueldo
        from 
        (SELECT c.nombre, c.sueldo, c.tipo_cargo, (select count(*) from cargo_empleados ce where ce.cargo_id=c.id and ce.deleted_at is null) nro_empleados
        from cargos c 
        WHERE c.deleted_at is null ) as t
        where t.tipo_cargo='CONSULTOR' and nro_empleados > 0");
        $eventuales=DB::select("select count(*) AS nro_empleados, SUM(t.sueldo) as total_sueldo
        from 
        (SELECT c.nombre, c.sueldo, c.tipo_cargo, (select count(*) from cargo_empleados ce where ce.cargo_id=c.id and ce.deleted_at is null) nro_empleados
        from cargos c 
        WHERE c.deleted_at is null ) as t
        where t.tipo_cargo='PERSONAL EVENTUAL' and nro_empleados > 0");
        return view('home', compact('empleados','items','consultores','eventuales'));
    }
}
