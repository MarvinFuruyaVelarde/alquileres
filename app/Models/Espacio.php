<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Espacio extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    // Especifica el nombre de la tabla 
    protected $table = 'espacio';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = true;

    // Define los campos que se pueden llenar
    protected $fillable = ['id', 'contrato', 'tipo_canon', 'rubro', 'ubicacion', 'cantidad', 'unidad_medida', 
                           'precio_unitario', 'fecha_inicial', 'fecha_final', 'total_canonmensual', 'opcion_dcto',
                           'canon_dcto', 'garantia', 'cobro_expensa', 'forma_pago', 'numero_dia', 'objeto_contrato', 
                           'glosa_factura', 'tipo_espacio', 'estado'];
}
