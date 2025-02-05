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
        CREATE OR REPLACE FUNCTION public.obtener_expensas_tarifa_variable(
            p_aeropuerto integer,
            p_cliente integer,
            p_codigo character varying,
            p_fecha_inicial date,
            p_fecha_final date)
            RETURNS TABLE(id_contrato integer, id_espacio integer, detalle_espacio text, expensa integer, descripcion character varying, factor numeric, unidad_medida character varying, tarifa_fija character varying) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000

        AS $$
        BEGIN
            RETURN QUERY
            SELECT C.ID AS id_contrato,
                E.ID AS id_espacio,
                CONCAT('POR UNA CANTIDAD DE ', e.cantidad, ' ', u.descripcion, ' DURANTE ', e.fecha_inicial, ' AL ', e.fecha_final, 
                        ' CON UNA GARANTIA DE ', e.garantia, ' CON UN CANON MENSUAL DE ', e.total_canonmensual) AS detalle_espacio,
                EE.EXPENSA,
                EX.DESCRIPCION,
                AE.FACTOR,
                EX.UNIDAD_MEDIDA,
                EE.TARIFA_FIJA
            FROM CONTRATO C
            INNER JOIN ESPACIO E ON E.CONTRATO = C.ID
            INNER JOIN ESPACIO_EXPENSA EE ON EE.ESPACIO = E.ID
            INNER JOIN UNIDAD_MEDIDA U ON U.ID = E.UNIDAD_MEDIDA 
            INNER JOIN EXPENSA EX ON EX.ID = EE.EXPENSA
             LEFT JOIN AEROPUERTO_EXPENSA AE ON AE.AEROPUERTO = C.AEROPUERTO AND AE.EXPENSA = EX.ID  
            WHERE C.ESTADO = 5
            AND E.ESTADO = 5
            AND EE.TARIFA_FIJA = 'V'
            AND EE.DELETED_AT IS NULL
            AND C.AEROPUERTO = p_aeropuerto
            AND C.CLIENTE = p_cliente
            AND C.CODIGO = p_codigo
            AND (p_fecha_inicial <= E.fecha_final AND p_fecha_final >= E.fecha_inicial);
        END;
        $$;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_obtener_expensas_tarifa_variable');
    }
};
