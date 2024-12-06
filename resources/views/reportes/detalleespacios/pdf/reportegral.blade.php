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
                      <div style="font-size: 14px">REPORTE DETALLE DE ESPACIOS</div>
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
            <th>COD. AEROPUERTO</th>
            <th>CLIENTE</th>
            <th>OBJETO DE CONTRATO</th>
            <th>UBICACIÓN</th>
            <th>SUPERFICIE</th>
            <th>UNIDAD DE MEDIDA</th>
            <th>PRECIO UNITARIO (BS)</th>
            <th>TOTAL CANON MENSUAL</th>
            <th>FECHA INICIAL</th>
            <th>FECHA FINAL</th>
            <th>CODIGO CONTRATO</th>
            <th>ESTADO</th>
        </tr>
    </thead>

    <tbody>
        @foreach($detalleEspacios as $detalleEspacio)
        <tr>
            <td style="text-align:center;">{{ $detalleEspacio->cod_aeropuerto }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->cliente }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->objeto_contrato }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->ubicacion }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->superficie }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->desc_unidad_medida }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->precio_unitario }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->total_canonmensual }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->fecha_inicial }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->fecha_final }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->codigo_contrato }}</td>
            <td style="text-align:center;">{{ $detalleEspacio->estado }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >