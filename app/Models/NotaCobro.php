<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NotaCobro extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla 
    protected $table = '';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Genera Nota(s) de Cobro dado el Period de Facturación
    public static function generaNotaCobro($aeropuertoId, $ultimoDia)
    {
        return DB::select('SELECT id_contrato, codigo_contrato, id_cliente, tipo_solicitante, ci, nit, razon_social, tipo_canon, id_forma_pago, forma_pago, numero, origen FROM genera_nota_cobro(?, ?)', [$aeropuertoId, $ultimoDia]);
    }

    // Visualiza nota(s) de cobro generadas 
    public static function visualizaNotaCobro($mes = null, $gestion = null, $tipoFactura = null, $aeropuerto = null, $cliente = null)
    {
        return DB::select('SELECT id, aeropuerto, contrato, codigo_contrato, numero_nota_cobro, orden_impresion, gestion, mes, tipo_canon, forma_pago, tipo_factura, cliente, razon_social_factura FROM visualiza_nota_cobro(?, ?, ?, ?, ?)',[$mes, $gestion, $tipoFactura, $aeropuerto, $cliente]);
    }

    // Obtiene espacios por contrato
    public static function obtenerEspaciosPorContrato($p_origen, $p_contrato, $p_forma_pago, $fechaInicio, $fechaFin, $p_tipo_canon = null, $p_numero = null)
    {
        return DB::select('SELECT * FROM obtener_espacios_por_contrato(?, ?, ?, ?, ?, ?, ?)', [$p_origen, $p_contrato, $p_forma_pago, $fechaInicio, $fechaFin, $p_tipo_canon, $p_numero]);
    }

    // Obtiene el número de dias a facturar
    public static function obtenerDiasAFacturar($fecha_inicio_cobro, $fecha_fin_cobro, $fecha_inicio_contrato, $fecha_fin_contrato)
    {
        $dias = DB::select("SELECT dias_a_facturar(?, ?, ?, ?) AS dias", [$fecha_inicio_cobro, $fecha_fin_cobro, $fecha_inicio_contrato, $fecha_fin_contrato]);
        return $dias[0]->dias;
    }

    

}
