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
            CREATE OR REPLACE FUNCTION public.obtener_espacios_por_contrato(
                p_origen character,
                p_contrato integer,
                p_forma_pago integer,
                fecha_inicio date,
                fecha_fin date,
                p_tipo_canon character varying DEFAULT NULL::character varying,
                p_numero integer DEFAULT NULL::integer)
                RETURNS TABLE(id integer, tipo_canon character varying, fecha_inicial date, fecha_final date, total_canonmensual numeric, forma_pago integer) 
                LANGUAGE 'plpgsql'
                COST 100
                VOLATILE PARALLEL UNSAFE
                ROWS 1000

            AS $$
            BEGIN
                -- Si el parámetro tipo_consulta es 'A', ejecuta la primera consulta
                IF p_origen = 'A' THEN
                    RETURN QUERY
                    SELECT E.ID,
                        E.TIPO_CANON,
                        E.fecha_inicial,
                        E.fecha_final,
                        E.total_canonmensual,
                        E.FORMA_PAGO
                    FROM ESPACIO E
                    WHERE E.ESTADO = 5
                    AND E.tipo_canon = 'F'
                    AND E.forma_pago = p_forma_pago
                    AND E.CONTRATO = p_contrato
                    AND (fecha_inicio <= E.fecha_final AND fecha_fin >= E.fecha_inicial)
                    AND (
                            (E.forma_pago = 1 
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 1) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 1) = 0
                                )
                            )  
                            OR (E.forma_pago = 2  
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 2) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 2) = 0
                                )
                            ) 
                            OR (E.forma_pago = 3  
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 3) = 0  
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 3) = 0
                                )
                            )
                            OR (E.forma_pago = 4 
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 6) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 6) = 0
                                )
                            ) 
                            OR (E.forma_pago = 5 
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0
                                )
                            )
                            OR (E.forma_pago = 6 
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0
                                )
                            )
                    );
                -- Si el parámetro tipo_consulta es 'P', ejecuta la segunda consulta
                ELSIF p_origen = 'P' THEN
                    RETURN QUERY
                    SELECT P.espacio AS id,
                        E.TIPO_CANON,
                        E.fecha_inicial,
                        E.fecha_final,
                        E.total_canonmensual,
                        E.FORMA_PAGO
                    FROM PLANTILLA P
                    INNER JOIN ESPACIO E ON E.ID = P.ESPACIO
                    WHERE E.ESTADO = 5
                    AND E.tipo_canon = p_tipo_canon 
                    AND E.forma_pago = p_forma_pago
                    AND P.numero = p_numero
                    AND P.CONTRATO = p_contrato
                    AND (fecha_inicio <= E.fecha_final AND fecha_fin >= E.fecha_inicial)
                    AND (
                            (E.forma_pago = 1 
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 1) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 1) = 0
                                )
                            )  
                            OR (E.forma_pago = 2  
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 2) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 2) = 0
                                )
                            ) 
                            OR (E.forma_pago = 3  
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 3) = 0  
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 3) = 0
                                )
                            )
                            OR (E.forma_pago = 4 
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 6) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 6) = 0
                                )
                            ) 
                            OR (E.forma_pago = 5 
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0
                                )
                            )
                            OR (E.forma_pago = 6 
                                AND (
                                    MOD(EXTRACT(YEAR FROM fecha_inicio) * 12 + EXTRACT(MONTH FROM fecha_inicio) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0 
                                    OR MOD(EXTRACT(YEAR FROM fecha_fin) * 12 + EXTRACT(MONTH FROM fecha_fin) - 
                                        (EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0
                                )
                            )
                    );
                END IF;
            END;
            $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_obtener_espacios_por_contrato');
    }
};
