<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePagoFactura extends Model
{
    use HasFactory;
    protected $table = 'detalle_pago_factura';
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id', 'id_factura', 'a_pagar', 'fecha_pago', 'cuenta', 'fecha_deposito', 'nro_registro_deposito', 
                           'nro_registro_cobro', 'observacion'];
}
