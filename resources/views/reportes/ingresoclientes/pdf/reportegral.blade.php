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
                      <div style="font-size: 14px">REPORTE DE INGRESOS POR CLIENTE</div>
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
            <th>AEROPUERTO</th>
            <th>CLIENTE</th>
            <th>TOTAL INGRESO (BS)</th>
        </tr>
    </thead>

    <tbody>
        @foreach($ingresoClientes as $ingresoCliente)
        <tr>
            <td style="text-align:center;">{{ $ingresoCliente->cod_aeropuerto }}</td>
            <td style="text-align:center;">{{ $ingresoCliente->desc_aeropuerto }}</td>
            <td style="text-align:center;">{{ $ingresoCliente->cliente }}</td>
            <td style="text-align:center;">{{ $ingresoCliente->total_ingreso }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >