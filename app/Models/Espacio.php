<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacio extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla 
    protected $table = 'espacio';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id', 'contrato', 'tipo_canon', 'rubro', 'ubicacion', 'cantidad', 'unidad_medida', 
                           'precio_unitario', 'fecha_inicial', 'fecha_final', 'total_canonmensual', 'opcion_dcto',
                           'canon_dcto', 'garantia', 'cobro_expensa', 'forma_pago', 'numero_dia', 'objeto_contrato', 
                           'glosa_factura', 'tipo_espacio', 'estado'];
}
