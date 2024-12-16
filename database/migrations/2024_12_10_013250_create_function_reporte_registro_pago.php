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
            CREATE OR REPLACE FUNCTION public.reporte_registro_pago(
	p_aeropuerto integer DEFAULT NULL::integer,
	p_cliente integer DEFAULT NULL::integer,
	p_gestion integer DEFAULT NULL::integer,
	p_mes integer DEFAULT NULL::integer)
    RETURNS TABLE(cliente character varying, aeropuerto character varying, ci character varying, nit character varying, gestion integer, mes_literal text, fecha_nota_cobro date, numero_nota_cobro integer, fecha_emision_factura date, numero_factura bigint, tipo character varying, monto_factura numeric, pagado numeric, saldo numeric, fecha_pago date) 
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $$
BEGIN
    RETURN QUERY
    SELECT 
        CL.RAZON_SOCIAL AS cliente,
        A.CODIGO AS aeropuerto,
        F.CI,
        F.NIT,
        F.GESTION,
        UPPER(TO_CHAR(TO_DATE(F.MES::TEXT, 'MM'), 'TMMonth')) AS mes_literal,
        F.FECHA_REGISTRO::DATE AS fecha_nota_cobro,
        F.ORDEN_IMPRESION AS numero_nota_cobro,
        F.FECHA_EMISION AS fecha_emision_factura,
        F.NUMERO_FACTURA,
        F.TIPO_FACTURA AS tipo,
        F.MONTO_TOTAL AS monto_factura,
        D.A_PAGAR AS pagado,
        D.SALDO,
        D.FECHA_PAGO
    FROM FACTURA F
    INNER JOIN DETALLE_PAGO_FACTURA D ON D.ID_FACTURA = F.ID
    INNER JOIN CLIENTE CL ON CL.ID = F.CLIENTE
    INNER JOIN AEROPUERTO A ON A.ID = F.AEROPUERTO
    WHERE (p_aeropuerto IS NULL OR A.ID = p_aeropuerto)
      AND (p_cliente IS NULL OR CL.ID = p_cliente)
      AND (p_gestion IS NULL OR F.GESTION = p_gestion)
      AND (p_mes IS NULL OR F.MES = p_mes)
    ORDER BY CL.RAZON_SOCIAL ASC, D.ID DESC;
END;
$$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_registro_pago');
    }
};
