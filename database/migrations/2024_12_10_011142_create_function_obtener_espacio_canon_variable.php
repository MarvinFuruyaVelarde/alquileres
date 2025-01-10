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
       CREATE OR REPLACE FUNCTION public.obtener_espacio_canon_variable(
	id_aeropuerto integer,
	p_cliente integer,
	cod_contrato text,
	ultimo_dia date)
    RETURNS TABLE(id_espacio integer, id_contrato integer, detalle_espacio text, glosa_factura character varying, total_canonmensual numeric, codigo_contrato character varying, id_cliente integer, tipo_solicitante integer, ci character varying, nit character varying, razon_social character varying, tipo_canon character varying, aeropuerto integer, id_forma_pago integer, forma_pago character varying, numero integer, origen text) 
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
  SELECT E.id AS id_espacio,
	  	 E.contrato AS id_contrato,
	  	 CONCAT('POR UNA CANTIDAD DE ', E.cantidad, ' ', u.descripcion, ' DURANTE ', E.fecha_inicial, ' AL ', E.fecha_final, 
                  ' CON UNA GARANTIA DE ', E.garantia, ' CON UN CANON MENSUAL DE ', E.total_canonmensual) AS detalle_espacio,
	     E.glosa_factura,
	     E.total_canonmensual,
         C.codigo AS codigo_contrato,
         CL.id AS id_cliente,
         C.tipo_solicitante,
         C.ci,
         C.nit,
         CL.razon_social,
         E.tipo_canon,
         C.aeropuerto,
         FP.id AS id_forma_pago,
         FP.descripcion AS forma_pago,
         1 AS numero,
         'M' AS origen
    FROM espacio E
   INNER JOIN contrato C ON C.id = E.contrato
   INNER JOIN cliente CL ON CL.id = C.cliente
   INNER JOIN forma_pago FP ON FP.id = E.forma_pago
   INNER JOIN unidad_medida U ON U.id = E.unidad_medida 
   WHERE E.tipo_canon = 'V'
     AND C.estado = 5
     AND E.ESTADO = 5
     AND C.PLANTILLA IS NULL
     AND C.aeropuerto = id_aeropuerto
     AND C.CLIENTE = p_cliente
     AND C.CODIGO = cod_contrato
     AND (primer_dia <= E.fecha_final AND ultimo_dia >= E.fecha_inicial)
     AND ((E.forma_pago = 1 AND E.fecha_inicial <= ultimo_dia AND E.fecha_final >= primer_dia)
      OR (E.forma_pago = 2 AND 
          (MOD(EXTRACT(MONTH FROM AGE(ultimo_dia, E.fecha_inicial)), 2) = 0 OR 
          (EXTRACT(MONTH FROM E.fecha_inicial) = EXTRACT(MONTH FROM ultimo_dia) 
           AND E.fecha_inicial <= ultimo_dia AND E.fecha_final >= primer_dia)))
      OR (E.forma_pago = 3 AND 
          (MOD(EXTRACT(MONTH FROM AGE(ultimo_dia, E.fecha_inicial)), 3) = 0 OR 
          (EXTRACT(MONTH FROM E.fecha_inicial) = EXTRACT(MONTH FROM ultimo_dia) 
           AND E.fecha_inicial <= ultimo_dia AND E.fecha_final >= primer_dia)))
      OR (E.forma_pago = 4 AND 
          (MOD(EXTRACT(MONTH FROM AGE(ultimo_dia, E.fecha_inicial)), 6) = 0 OR 
          (EXTRACT(MONTH FROM E.fecha_inicial) = EXTRACT(MONTH FROM ultimo_dia) 
           AND E.fecha_inicial <= ultimo_dia AND E.fecha_final >= primer_dia)))
      OR (E.forma_pago = 5 AND 
          (MOD(EXTRACT(MONTH FROM AGE(ultimo_dia, E.fecha_inicial)), 12) = 0 OR 
          (EXTRACT(MONTH FROM E.fecha_inicial) = EXTRACT(MONTH FROM ultimo_dia) 
           AND E.fecha_inicial <= ultimo_dia AND E.fecha_final >= primer_dia)))
      OR (E.forma_pago = 6 AND 
          (MOD(EXTRACT(MONTH FROM AGE(ultimo_dia, E.fecha_inicial)), 12) = 0 OR 
          (EXTRACT(MONTH FROM E.fecha_inicial) = EXTRACT(MONTH FROM ultimo_dia) 
           AND E.fecha_inicial <= ultimo_dia AND E.fecha_final >= primer_dia))))
  GROUP BY E.id, E.contrato, detalle_espacio, C.codigo, CL.id, C.tipo_solicitante, C.ci, C.nit, E.tipo_canon, C.aeropuerto, FP.id, FP.descripcion;
END;
$$;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_obtener_espacio_canon_variable');
    }
};
