<div class="margin-top">
    <div style="border: solid 1px #4e4b4bfa; border-radius:20px;">
       <div style="padding: 12px">
          <table class="title" style="width: 100%;">
             <tr class="items">
                <td style="width: 20%; text-align:center">
                    <img src="{{'storage/descarga1.png'}}"  width="100px" alt="Image"/>
                 </td>
                   <td style="width: 100%; text-align:center; font-weight: bold;">
                      <div style="font-size: 18px; font-weight: bold;">
                        NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS 
                      </div>
                      <div style="font-size: 16px; font-weight: bold;">
                        SISTEMA ALQUILERES   
                      </div>
                      <div style="font-size: 14px">REPORTE DE FACTURAS ANULADAS</div>
                   </td>
                   <td style="width: 20%; text-align:center"> 
                   </td>
             </tr>
          </table>        
       </div>
    </div>
</div>

<br>
<table  style="width:100%; font-size:10">
    <thead>
        <tr style="background: darkgray; text-align: center;">
            <th>AEROPUERTO</th>
            <th>CLIENTE</th>
            <th>CODIGO CONTRATO</th>
            <th>NUMERO NOTA DE COBRO</th>
            <th>MES</th>
            <th>GESTIÓN</th>
            <th>TIPO</th>
            <th>MONTO TOTAL (BS)</th>
            <th>NÚMERO FACTURA</th>
            <th>FECHA EMISIÓN</th>
            <th>ANULADO POR</th>
            <th>FECHA ANULACIÓN</th>
        </tr>
    </thead>

    <tbody>
        @foreach($facturas_anuladas as $factura_anulada)
        <tr>
            <td style="text-align:center;">{{ $factura_anulada->codigo_aeropuerto }}</td>
            <td style="text-align:center;">{{ $factura_anulada->razon_social }}</td>
            <td style="text-align:center;">{{ $factura_anulada->codigo_contrato }}</td>
            <td style="text-align:center;">{{ $factura_anulada->numero_nota_cobro }}</td>
            <td style="text-align:center;">{{ $factura_anulada->mes }}</td>
            <td style="text-align:center;">{{ $factura_anulada->gestion }}</td>
            <td style="text-align:center;">{{ $factura_anulada->tipo_factura }}</td>
            <td style="text-align:center;">{{ $factura_anulada->monto_total }}</td>
            <td style="text-align:center;">{{ $factura_anulada->numero_factura }}</td>
            <td style="text-align:center;">{{ $factura_anulada->fecha_emision }}</td>
            <td style="text-align:center;">{{ $factura_anulada->usuario }}</td>
            <td style="text-align:center;">{{ $factura_anulada->fecha_anulacion }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >