<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE FUNCTION public.visualiza_nota_cobro(
	p_mes integer DEFAULT NULL::integer,
	p_gestion integer DEFAULT NULL::integer,
	p_tipo_factura text DEFAULT NULL::text,
	p_aeropuerto integer DEFAULT NULL::integer,
	p_cliente integer DEFAULT NULL::integer)
    RETURNS TABLE(id integer, aeropuerto integer, contrato integer, codigo_contrato character varying, numero_nota_cobro character varying, orden_impresion integer, gestion integer, mes integer, tipo_canon character varying, forma_pago integer, tipo_factura character varying, cliente integer, razon_social_factura character varying) 
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    RETURN QUERY
    SELECT f.id, f.aeropuerto, f.contrato, f.codigo_contrato, f.numero_nota_cobro, f.orden_impresion, f.gestion, f.mes, f.tipo_canon, f.forma_pago, f.tipo_factura, f.cliente, f.razon_social_factura 
    FROM factura f
    WHERE f.estado = 3
      AND (p_mes IS NULL OR f.mes = p_mes)
      AND (p_gestion IS NULL OR f.gestion = p_gestion)
      AND (p_tipo_factura IS NULL OR f.tipo_factura = p_tipo_factura)
      AND (p_aeropuerto IS NULL OR f.aeropuerto = p_aeropuerto)
      AND (p_cliente IS NULL OR f.cliente = p_cliente)
    ORDER BY f.id;

END; 
$$;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_visualiza_nota_cobro');
    }
};
