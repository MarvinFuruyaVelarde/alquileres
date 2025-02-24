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
                      <div style="font-size: 14px">REPORTE DE GARANTIAS</div>
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
            <th>CÓDIGO CONTRATO</th>
            <th>GARANTIA</th>
            <th>PAGADO</th>
            <th>SALDO</th>
            <th>FECHA DE PAGO</th>
            <th>FECHA DEPOSITO</th>
            <th>CUENTA</th>
            <th>NRO. CUENTA</th>
        </tr>
    </thead>

    <tbody>
        @foreach($garantias as $garantia)
        <tr>
            <td style="text-align:center;">{{ $garantia->cod_aeropuerto }}</td>
            <td style="text-align:center;">{{ $garantia->cliente }}</td>
            <td style="text-align:center;">{{ $garantia->codigo_contrato }}</td>
            <td style="text-align:center;">{{ $garantia->garantia }}</td>
            <td style="text-align:center;">{{ $garantia->pagado }}</td>
            <td style="text-align:center;">{{ $garantia->saldo }}</td>
            <td style="text-align:center;">{{ $garantia->fecha_pago }}</td>
            <td style="text-align:center;">{{ $garantia->fecha_deposito }}</td>
            <td style="text-align:center;">{{ $garantia->cuenta }}</td>
            <td style="text-align:center;">{{ $garantia->numero_cuenta }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >