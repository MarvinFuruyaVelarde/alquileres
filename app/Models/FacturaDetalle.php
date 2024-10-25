<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla 
    protected $table = 'factura_detalle';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id', 'factura', 'espacio', 'concepto', 'precio', 'dias_facturados', 'usuario_registro', 'fecha_registro', 'usuario_actualizacion', 'fecha_actualizacion'];

}
