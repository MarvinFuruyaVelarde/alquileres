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
                      <div style="font-size: 14px">REPORTE DE MORA</div>
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
            <th>TIPO FACTURA</th>
            <th>NUMERO FACTURA</th>
            <th>FECHA MAX. PAGO</th>
            <th>DIA(S) MORA</th>
            <th>MONTO A PAGAR</th>
            <th>MONTO PAGADO</th>
            <th>SALDO</th>
            <th>MORA</th>
        </tr>
    </thead>

    <tbody>
        @foreach($moras as $mora)
        <tr>
            <td style="text-align:center;">{{ $mora->codigo }}</td>
            <td style="text-align:center;">{{ $mora->cliente }}</td>
            <td style="text-align:center;">{{ $mora->tipo_factura }}</td>
            <td style="text-align:center;">{{ $mora->numero_factura }}</td>
            <td style="text-align:center;">{{ $mora->fecha_max_pago }}</td>
            <td style="text-align:center;">{{ $mora->dia_mora }}</td>
            <td style="text-align:center;">{{ $mora->monto_a_pagar }}</td>
            <td style="text-align:center;">{{ $mora->monto_pagado }}</td>
            <td style="text-align:center;">{{ $mora->saldo }}</td>
            <td style="text-align:center;">{{ $mora->mora }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >