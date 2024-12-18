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
       CREATE OR REPLACE FUNCTION public.genera_nota_cobro(
		aeropuerto_id integer,
		ultimo_dia date)
		RETURNS TABLE(id_espacio integer, id_contrato integer, codigo_contrato character varying, id_cliente integer, tipo_solicitante integer, ci character varying, nit character varying, razon_social character varying, tipo_canon character varying, aeropuerto integer, id_forma_pago integer, forma_pago character varying, numero integer, origen text) 
		LANGUAGE 'plpgsql'
		COST 100
		VOLATILE PARALLEL UNSAFE
		ROWS 1000

		AS $$
		DECLARE
			primer_dia DATE;
		BEGIN
			
			primer_dia := date_trunc('month', ultimo_dia);

			RETURN QUERY
			-- Primera consulta
			SELECT 
				E.id AS id_espacio,
				E.contrato AS id_contrato,
				C.codigo AS codigo_contrato,
				CL.id AS id_cliente,
				c.tipo_solicitante,
				c.ci,
				c.nit,
				CL.razon_social,
				E.tipo_canon,
				C.aeropuerto,
				FP.id AS id_forma_pago,
				FP.descripcion AS forma_pago,
				1 AS numero,
				'A' AS origen
			FROM 
				espacio E
			INNER JOIN 
				contrato C ON C.id = E.contrato
			INNER JOIN 
				cliente CL ON CL.id = C.cliente
			INNER JOIN 
				forma_pago FP ON FP.id = E.forma_pago
			WHERE 
				E.tipo_canon = 'F'
				AND C.estado = '5'
				AND C.PLANTILLA IS NULL
				AND C.aeropuerto = aeropuerto_id
				AND ((primer_dia <= E.fecha_final AND ultimo_dia >= E.fecha_inicial))
				AND ((E.forma_pago = 1 
					AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 1) = 0 
					OR  MOD(EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 1) = 0))
				OR (E.forma_pago = 2 
					AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 2) = 0 
					OR MOD(EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 2) = 0))
				OR (E.forma_pago = 3 
					AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 3) = 0 
					OR MOD(EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 3) = 0))
				OR (E.forma_pago = 4 
					AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 6) = 0 
					OR MOD((EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial))), 6) = 0))
				OR (E.forma_pago = 5 
					AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0 
					OR MOD(EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0)))
			GROUP BY 
				E.id, E.contrato, C.codigo, CL.id, c.tipo_solicitante, c.ci, c.nit, E.tipo_canon, C.aeropuerto, FP.id, FP.descripcion
			
			UNION ALL 
			
			-- Segunda consulta
			SELECT 
				E.id AS id_espacio,
				pl.contrato AS id_contrato,
				c.codigo AS codigo_contrato,  
				pl.cliente AS id_cliente,
				c.tipo_solicitante,
				c.ci,
				c.nit,
				cl.razon_social,
				e.tipo_canon,
				c.aeropuerto,
				E.FORMA_PAGO as id_forma_pago,
				fp.descripcion AS forma_pago,
				pl.numero,
				'P' AS origen 
			FROM 
				plantilla pl
			INNER JOIN 
				contrato c ON c.id = pl.contrato  
			INNER JOIN 
				cliente cl ON cl.id = pl.cliente
			INNER JOIN 
				espacio e ON e.id = pl.espacio
			INNER JOIN 
				forma_pago fp ON fp.id = e.forma_pago
			WHERE c.estado = 5
			AND c.aeropuerto = aeropuerto_id
			AND ((primer_dia <= E.fecha_final AND ultimo_dia >= E.fecha_inicial))
			AND ((E.forma_pago = 1 
					AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 1) = 0 
					OR MOD(EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
							(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 1) = 0))
			OR (E.forma_pago = 2 
				AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
						(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 2) = 0 
					OR MOD(EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
						(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 2) = 0))
			OR (E.forma_pago = 3 
				AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
						(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 3) = 0 
					OR MOD(EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
						(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 3) = 0))
			OR (E.forma_pago = 4 
				AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
						(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 6) = 0 
					OR MOD((EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
						(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial))), 6) = 0))
			OR (E.forma_pago = 5 
				AND (MOD(EXTRACT(YEAR FROM primer_dia) * 12 + EXTRACT(MONTH FROM primer_dia) -
						(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0 
					OR MOD(EXTRACT(YEAR FROM ultimo_dia) * 12 + EXTRACT(MONTH FROM ultimo_dia) -
						(EXTRACT(YEAR FROM E.fecha_inicial) * 12 + EXTRACT(MONTH FROM E.fecha_inicial)), 12) = 0)))
			GROUP BY 
				E.id, pl.contrato, c.codigo, pl.cliente, c.tipo_solicitante, c.ci, c.nit, cl.razon_social, e.tipo_canon, c.aeropuerto, E.FORMA_PAGO, fp.descripcion, pl.numero
			
			ORDER BY 
				razon_social;
		END;
		$$;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_genera_nota_cobro');
    }
};
