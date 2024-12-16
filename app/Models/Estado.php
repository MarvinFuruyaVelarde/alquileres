<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estado extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    // Especifica el nombre de la tabla 
    protected $table = 'estado';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = true;

    // Define los campos que se pueden llenar
    protected $fillable = ['id','descripcion'];
}
