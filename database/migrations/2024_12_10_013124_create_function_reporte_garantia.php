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
            CREATE OR REPLACE FUNCTION public.reporte_garantia(
                p_aeropuerto integer DEFAULT NULL::integer,
                p_cliente_id integer DEFAULT NULL::integer)
                RETURNS TABLE(id integer, cod_aeropuerto character varying, id_cliente integer, cliente character varying, codigo_contrato character varying, garantia numeric, pagado numeric, saldo numeric, fecha_pago text, fecha_deposito text, cuenta character varying, numero_cuenta bigint)
                LANGUAGE 'plpgsql'
                COST 100
                VOLATILE PARALLEL UNSAFE
                ROWS 1000

            AS $$
            BEGIN
                RETURN QUERY
                SELECT 
                    G.ID,
                    A.CODIGO AS COD_AEROPUERTO,
                    CL.ID AS ID_CLIENTE,
                    CL.RAZON_SOCIAL AS CLIENTE,
                    C.CODIGO AS CODIGO_CONTRATO,
                    C.GARANTIA,
                    G.A_PAGAR AS PAGADO,
                    G.SALDO,
                    TO_CHAR(G.FECHA_PAGO, 'DD/MM/YYYY') AS FECHA_PAGO,
                    TO_CHAR(G.FECHA_DEPOSITO, 'DD/MM/YYYY') AS FECHA_DEPOSITO,
                    CU.DESCRIPCION AS CUENTA,
                    G.NUMERO_CUENTA
                FROM GARANTIA G
                INNER JOIN CONTRATO C ON C.ID = G.CONTRATO 
                INNER JOIN CLIENTE CL ON CL.ID = C.CLIENTE
                INNER JOIN AEROPUERTO A ON A.ID = C.AEROPUERTO
                INNER JOIN CUENTA CU ON CU.ID = G.CUENTA
                WHERE G.DELETED_AT IS NULL 
                AND (p_cliente_id IS NULL OR CL.ID = p_cliente_id)
                AND (p_aeropuerto IS NULL OR C.AEROPUERTO = p_aeropuerto)
                GROUP BY G.ID, A.CODIGO, CL.ID, CL.RAZON_SOCIAL, C.CODIGO, C.GARANTIA, C.PAGO_GARANTIA, C.SALDO_GARANTIA, G.FECHA_DEPOSITO, CU.DESCRIPCION, G.NUMERO_CUENTA
                ORDER BY CL.RAZON_SOCIAL ASC, G.ID DESC;
            END;
            $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_garantia');
    }
};
