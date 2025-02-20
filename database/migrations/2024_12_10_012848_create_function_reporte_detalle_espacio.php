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
        CREATE OR REPLACE FUNCTION public.reporte_detalle_espacio(
            p_aeropuerto integer DEFAULT NULL::integer,
            p_cliente integer DEFAULT NULL::integer,
            p_total_canonmensual text DEFAULT NULL::text,
            p_estado integer DEFAULT NULL::integer)
            RETURNS TABLE(cod_aeropuerto character varying, cliente character varying, objeto_contrato character varying, ubicacion character varying, superficie numeric, desc_unidad_medida character varying, precio_unitario numeric, total_canonmensual numeric, fecha_inicial date, fecha_final date, codigo_contrato character varying, estado character varying, garantia numeric, forma_pago character varying, expensas text) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT A.CODIGO AS cod_aeropuerto,
                CL.RAZON_SOCIAL AS cliente,
                E.OBJETO_CONTRATO,
                E.UBICACION,
                E.CANTIDAD AS superficie,
                UM.DESCRIPCION AS desc_unidad_medida,
                E.PRECIO_UNITARIO,
                E.TOTAL_CANONMENSUAL,
                E.FECHA_INICIAL,
                E.FECHA_FINAL,
                C.CODIGO AS codigo_contrato,
                ES.DESCRIPCION AS estado,
                E.GARANTIA,
                FP.DESCRIPCION AS FORMA_PAGO,
                STRING_AGG(EX.DESCRIPCION, ', ') AS EXPENSAS
            FROM ESPACIO E
            INNER JOIN CONTRATO C ON C.ID = E.CONTRATO
            INNER JOIN AEROPUERTO A ON A.ID = C.AEROPUERTO 
            INNER JOIN CLIENTE CL ON CL.ID = C.CLIENTE
            INNER JOIN UNIDAD_MEDIDA UM ON UM.ID = E.UNIDAD_MEDIDA  
            INNER JOIN ESTADO ES ON ES.ID = E.ESTADO
            INNER JOIN FORMA_PAGO FP ON FP.ID = E.FORMA_PAGO 
            LEFT JOIN ESPACIO_EXPENSA EE ON EE.ESPACIO = E.ID    
            LEFT JOIN EXPENSA EX ON EX.ID = EE.EXPENSA
            WHERE (p_aeropuerto IS NULL OR C.AEROPUERTO = p_aeropuerto)
            AND (p_cliente IS NULL OR C.CLIENTE = p_cliente)
            AND (p_total_canonmensual IS NULL OR CAST(E.TOTAL_CANONMENSUAL AS TEXT) LIKE '%' || p_total_canonmensual || '%')
            AND (p_estado IS NULL OR E.ESTADO = p_estado)
            GROUP BY E.ID, A.CODIGO, CL.RAZON_SOCIAL, UM.DESCRIPCION, C.CODIGO, ES.DESCRIPCION, FP.DESCRIPCION;   
        END;
        $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_reporte_detalle_espacio');
    }
};
