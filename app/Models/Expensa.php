<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expensa extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla 
    protected $table = 'expensa';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id','descripcion', 'factor', 'estado', 'unidad_medida'];
}
