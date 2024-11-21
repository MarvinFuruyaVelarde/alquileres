<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View_NotaCobraManual extends Model
{
    use HasFactory;

    // Especifica el nombre de la vista 
    protected $table = 'view_nota_cobro_manual';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id','numero_nota_cobro', 'cliente', 'razon_social', 'tipo'];
}
