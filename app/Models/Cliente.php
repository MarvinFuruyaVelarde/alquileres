<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla 
    protected $table = 'cliente';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id','razon_social', 'tipo_identificacion', 'numero_identificacion', 'es_aerolinea', 'es_pssat', 'tipo_solicitante', 'expedido', 'estado'];
}
