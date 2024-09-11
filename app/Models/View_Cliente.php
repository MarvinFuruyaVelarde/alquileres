<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View_Cliente extends Model
{
    use HasFactory;

    // Especifica el nombre de la vista 
    protected $table = 'view_cliente';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id', 'razon_social', 'tipo_identificacion', 'numero_identificacion', 'tipo_solicitante', 'estado', 'desc_tipoidentificacion', 'desc_tiposolicitante', 'desc_estado'];
}
