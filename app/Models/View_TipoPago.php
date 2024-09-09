<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View_TipoPago extends Model
{
    use HasFactory;
    
    // Especifica el nombre de la vista 
    protected $table = 'view_tipo_pago';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id','descripcion', 'numero_cuenta', 'moneda', 'estado', 'desc_moneda', 'desc_estado'];
}
