<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View_Contrato extends Model
{
    use HasFactory;

    // Especifica el nombre de la vista 
    protected $table = 'view_contrato';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id','codigo_aeropuerto', 'codigo_contrato', 'nombre_cliente', 'representante', 'nit_ci', 'telefono_celular', 'correo', 'domicilio_legal', 'estado', 'desc_estado'];
}
