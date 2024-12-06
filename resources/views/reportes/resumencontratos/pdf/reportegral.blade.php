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
                      <div style="font-size: 14px">REPORTE RESUMÉN DE CONTRATOS</div>
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
            <th>COD. REGIONAL</th>
            <th>COD. AEROPUERTO</th>
            <th>NUMERO DE CONTRATOS</th>
            <th>TOTAL (BS.)</th>
            <th>ESTADO</th>
        </tr>
    </thead>

    <tbody>
        @foreach($resumenContratos as $resumenContrato)
        <tr>
            <td style="text-align:center;">{{ $resumenContrato->regional }}</td>
            <td style="text-align:center;">{{ $resumenContrato->cod_aeropuerto }}</td>
            <td style="text-align:center;">{{ $resumenContrato->numero_contratos }}</td>
            <td style="text-align:center;">{{ $resumenContrato->total }}</td>
            <td style="text-align:center;">{{ $resumenContrato->estado }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >