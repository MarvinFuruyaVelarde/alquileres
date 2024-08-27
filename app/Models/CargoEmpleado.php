<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CargoEmpleado extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'fecha_inicio',
        'fecha_conclusion',
        'empleado_id',
        'cargo_id',
        'sueldo',
        'tipo_baja',
        'nro_memorandun',
        'archivo_memorandun'
    ];
}
