<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE FUNCTION public.genera_nota_cobro_expensa(
                aeropuerto_id integer,
                ultimo_dia date)
                RETURNS TABLE(id_espacio integer, id_contrato integer, codigo_contrato character varying, id_cliente integer, tipo_solicitante integer, ci character varying, nit character varying, razon_social character varying, tarifa_fija character varying, aeropuerto integer, id_forma_pago integer, forma_pago character varying, expensa integer, monto numeric) 
                LANGUAGE 'plpgsql'
                COST 100
                VOLATILE PARALLEL UNSAFE
                ROWS 1000

            AS $$
            DECLARE
                primer_dia DATE := date_trunc('month', ultimo_dia);
            BEGIN
                RETURN QUERY
                SELECT 
                    E.id AS id_espacio,
                    E.contrato AS id_contrato, 
                    C.codigo AS codigo_contrato,                    
                    CL.id AS id_cliente,
                    C.tipo_solicitante,
                    C.ci,
                    C.nit,
                    CL.razon_social,
                    EE.tarifa_fija, 
                    C.aeropuerto, 
                    FP.id AS id_forma_pago,
                    FP.descripcion AS forma_pago,
                    EE.expensa,
                    EE.monto
                FROM 
                    ESPACIO E
                INNER JOIN 
                    ESPACIO_EXPENSA EE ON EE.ESPACIO = E.ID  
                INNER JOIN 
                    CONTRATO C ON C.ID = E.contrato
                INNER JOIN 
                    CLIENTE CL ON CL.ID = C.CLIENTE
                INNER JOIN 
                    forma_pago FP ON FP.id = E.forma_pago
                WHERE 
                    E.COBRO_EXPENSA = 'S'
                    AND EE.TARIFA_FIJA = 'F'
                    AND C.estado = 5
                    AND E.estado = 5
                    AND EE.DELETED_AT IS NULL
                    AND C.aeropuerto = aeropuerto_id
                    AND (primer_dia <= E.fecha_final AND ultimo_dia >= E.fecha_inicial)
                ORDER BY CL.razon_social; 
            END;
            $$;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_genera_nota_cobro_expensa');
    }
};
