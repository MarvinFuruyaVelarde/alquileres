<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reporte extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla 
    protected $table = '';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Obtiene Reporte de Contratos
    public static function reporteContrato($aeropuerto = null, $tipoSolicitante = null, $cliente = null, $identificacion = null, $estado = null)
    {
        return DB::select('SELECT codigo, cod_aeropuerto, cliente_nombre, representante, desc_tipo_solicitante, ci, nit, domicilio_legal, telefono_celular, correo, desc_estado, canon_total FROM reporte_contrato(?, ?, ?, ?, ?)', [$aeropuerto, $tipoSolicitante, $cliente, $identificacion, $estado]);
    }

    // Obtiene Reporte de Detalle Espacios
    public static function reporteDetalleEspacio($aeropuerto = null, $cliente = null, $totalCanonMensual = null, $estado = null)
    {
        return DB::select('SELECT cod_aeropuerto, cliente, objeto_contrato, ubicacion, superficie, desc_unidad_medida, precio_unitario, total_canonmensual, fecha_inicial, fecha_final, codigo_contrato, garantia, forma_pago , expensas , estado FROM reporte_detalle_espacio(?, ?, ?, ?)', [$aeropuerto, $cliente, $totalCanonMensual, $estado]);
    }

    // Obtiene Reporte de Facturas
    public static function reporteFactura(array $regional, $gestion = null, $mes = null)
    {
        // Convertimos el array PHP a una cadena PostgreSQL tipo '{1,2,3}'
        $regional_pg_array = '{' . implode(',', $regional) . '}';
        return DB::select('SELECT codigo, razon_social, gestion, mes_literal, numero_nota_cobro, tipo_factura, numero_factura, monto_total, estado FROM reporte_factura(?::integer[], ?, ?)', [$regional_pg_array, $gestion, $mes]);
    }

    // Obtiene Reporte de Garantias
    public static function reporteGarantia($cliente = null)
    {
        return DB::select('SELECT cod_aeropuerto, cliente, codigo_contrato, garantia, pagado, saldo, fecha_pago, fecha_deposito, cuenta, numero_cuenta FROM reporte_garantia(?)', [$cliente]);
    }

    // Obtiene Reporte de Registro de Pagos
    public static function reporteRegistroPago($aeropuerto = null, $cliente = null, $gestion = null, $mes = null)
    {
        return DB::select('SELECT cliente, aeropuerto, ci, nit, gestion, mes_literal, fecha_nota_cobro, numero_nota_cobro, fecha_emision_factura, numero_factura, tipo, monto_factura, pagado, saldo, fecha_pago, numero_registro_deposito, numero_registro_cobro, observacion FROM reporte_registro_pago(?, ?, ?, ?)', [$aeropuerto, $cliente, $gestion, $mes]);
    }

    // Obtiene Reporte de Tipo de Espacios
    public static function reporteTipoEspacio($aeropuerto = null, $cliente = null, $tipoEspacio = null)
    {
        return DB::select('SELECT cod_aeropuerto, cliente, tipo_espacio, rubro, objeto_contrato, canon_mensual, fecha_inicial, fecha_final, codigo_contrato FROM reporte_tipo_espacio(?, ?, ?)', [$aeropuerto, $cliente, $tipoEspacio]);
    }

    // Obtiene Reporte Resumén de Contratos
    public static function reporteResumenContrato($regional = null, $aeropuerto = null, $gestionInicial = null, $mesInicial = null, $gestionFinal = null, $mesFinal = null )
    {
        return DB::select('SELECT regional, cod_aeropuerto, numero_contratos, total, estado FROM reporte_resumen_contrato(?, ?, ?, ?, ?, ?)', [$regional, $aeropuerto, $gestionInicial, $mesInicial, $gestionFinal, $mesFinal]);
    }

    // Obtiene Reporte de Ingreso por Aeropuerto
    public static function reporteIngresoAeropuerto($aeropuerto = null, $fechaInicial = null, $fechaFinal = null )
    {
        return DB::select('SELECT cod_aeropuerto, desc_aeropuerto, total_ingreso FROM reporte_ingreso_aeropuerto(?, ?, ?)', [$aeropuerto, $fechaInicial, $fechaFinal]);
    }

    // Obtiene Reporte de Ingreso por Cliente
    public static function reporteIngresoCliente($aeropuerto = null, $cliente = null, $fechaInicial = null, $fechaFinal = null )
    {
        return DB::select('SELECT cod_aeropuerto, desc_aeropuerto, cliente, total_ingreso FROM reporte_ingreso_cliente(?, ?, ?, ?)', [$aeropuerto, $cliente, $fechaInicial, $fechaFinal]);
    }

    // Obtiene Reporte de Deuda
    public static function reporteDeuda($aeropuerto = null, $cliente = null, $fechaInicial = null, $fechaFinal = null )
    {
        return DB::select('SELECT cod_aeropuerto, desc_aeropuerto, cliente, total_deuda FROM reporte_deuda(?, ?, ?, ?)', [$aeropuerto, $cliente, $fechaInicial, $fechaFinal]);
    }

    // Obtiene Reporte de Ingreso y Deuda
    public static function reporteIngresoDeuda($regional = null, $aeropuerto = null, $fechaInicial = null, $fechaFinal = null )
    {
        return DB::select('SELECT cod_regional, cod_aeropuerto, total_facturado, total_pagado, total_deuda FROM reporte_ingreso_deuda(?, ?, ?, ?)', [$regional, $aeropuerto, $fechaInicial, $fechaFinal]);
    }

    // Obtiene Reporte de Cuenta por Cobrar
    public static function reporteCuentaPorCobrar($aeropuerto = null, $cliente = null, $fechaInicial = null, $fechaFinal = null )
    {
        return DB::select('SELECT cod_aeropuerto, cliente, ci, nit, gestion, mes, fecha_nota_cobro, numero_nota_cobro, fecha_emision_factura, numero_factura, tipo, monto_facturado, monto_pagado, saldo, fecha_pago FROM reporte_cuenta_por_cobrar(?, ?, ?, ?)', [$aeropuerto, $cliente, $fechaInicial, $fechaFinal]);
    }

    // Obtiene Reporte de Mora
    public static function reporteMora($aeropuerto = null, $cliente = null )
    {
        return DB::select('SELECT codigo, cliente, tipo_factura, numero_factura, fecha_max_pago, fecha_actual, dia_mora, monto_a_pagar, monto_pagado, saldo, mora, fecha_pago FROM reporte_mora(?, ?)', [$aeropuerto, $cliente]);
    }

}
