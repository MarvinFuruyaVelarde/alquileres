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
       CREATE OR REPLACE FUNCTION public.obtener_nota_cobro_por_estado(
	p_estado integer DEFAULT NULL::integer,
	p_gestion integer DEFAULT NULL::integer,
	p_mes integer DEFAULT NULL::integer,
	p_tipo_factura text DEFAULT NULL::text,
	p_aeropuerto integer DEFAULT NULL::integer,
	p_cliente integer DEFAULT NULL::integer)
    RETURNS TABLE(id integer, aeropuerto integer, numero_nota_cobro character varying, gestion integer, mes integer, razon_social character varying, tipo_canon character varying, desc_canon character varying, forma_pago integer, desc_forma_pago character varying, tipo_factura character varying, cliente integer, id_documento bigint, estado integer) 
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    RETURN QUERY
    SELECT f.id,
           f.aeropuerto,
           f.numero_nota_cobro,
           f.gestion,
           f.mes,
           cl.razon_social,
           f.tipo_canon,
           CASE
                WHEN f.tipo_canon = 'F' THEN 'FIJO'
                WHEN f.tipo_canon = 'V' THEN 'VARIABLE'
                ELSE f.tipo_canon
           END AS desc_canon,
           f.forma_pago,
           fp.descripcion AS desc_forma_pago,
           f.tipo_factura,
           f.cliente,
	       f.id_documento,
           f.estado
      FROM factura f
      INNER JOIN cliente cl ON cl.id = f.cliente
      INNER JOIN forma_pago fp ON fp.id = f.forma_pago
      WHERE (f.estado IS NULL OR f.estado = p_estado)
		AND	(p_gestion IS NULL OR f.gestion = p_gestion)   
        AND (p_mes IS NULL OR f.mes = p_mes)
        AND (p_tipo_factura IS NULL OR f.tipo_factura = p_tipo_factura)
        AND (p_aeropuerto IS NULL OR f.aeropuerto = p_aeropuerto)
        AND (p_cliente IS NULL OR f.cliente = p_cliente);
END;
$$;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_obtener_nota_cobro_por_estado');
    }
};
