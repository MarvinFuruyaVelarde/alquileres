<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    // Especifica el nombre de la tabla 
    protected $table = 'factura';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = true;

    // Define los campos que se pueden llenar
    protected $fillable = ['id', 'aeropuerto', 'contrato', 'numero_nota_cobro', 'orden_impresion', 'gestion', 'mes', 'tipo_solicitante', 'ci', 'nit',
                           'tipo_canon', 'tipo_factura', 'razon_social_factura', 'numero_factura', 'cuf', 'cufd', 'autorizacion_feel', 'codigo_qr_feel', 'fecha_factura', 'fecha_emision', 
                           'fecha_vencimiento', 'estado', 'usuario_registro', 'fecha_registro', 'usuario_actualizacion', 'fecha_actualizacion'];
}
