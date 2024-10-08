<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoCancelado extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla 
    protected $table = 'contrato_cancelado';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id','contrato', 'objetivo', 'motivo', 'ruta_documento','codigo_nuevo', 'codigo_anterior'];
}
