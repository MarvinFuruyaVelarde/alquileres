<?php

namespace App\Models;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DetallePagoFactura extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'detalle_pago_factura';
    public $timestamps = true;

    // Define los campos que se pueden llenar
    protected $fillable = ['id', 'id_factura', 'a_pagar', 'fecha_pago', 'cuenta', 'fecha_deposito', 'nro_registro_deposito', 
                           'nro_registro_cobro', 'observacion'];
}
