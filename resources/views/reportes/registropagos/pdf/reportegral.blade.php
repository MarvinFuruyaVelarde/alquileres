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
                      <div style="font-size: 14px">REPORTE DE REGISTRO DE PAGOS</div>
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
            <th>CI/NIT</th>
            <th>GESTIÓN</th>
            <th>MES</th>
            <th>FECHA NOTA COBRO</th>
            <th>NÚMERO NOTA COBRO</th>
            <th>FECHA EMISIÓN FACTURA</th>
            <th>NÚMERO FACTURA</th>
            <th>TIPO</th>
            <th>MONTO FACTURA (BS.)</th>
            <th>PAGADO (BS.)</th>
            <th>SALDO (BS.)</th>
            <th>FECHA DE PAGO</th>
        </tr>
    </thead>

    <tbody>
        @foreach($registropagos as $registropago)
        <tr>
            <td style="text-align:center;">{{ $registropago->aeropuerto }}</td>
            <td style="text-align:center;">{{ $registropago->cliente }}</td>
            <td style="text-align:center;">{{ $registropago->nit ?? $registropago->ci ?? '' }}</td>
            <td style="text-align:center;">{{ $registropago->gestion }}</td>
            <td style="text-align:center;">{{ $registropago->mes_literal }}</td>
            <td style="text-align:center;">{{ $registropago->fecha_nota_cobro }}</td>
            <td style="text-align:center;">{{ $registropago->numero_nota_cobro }}</td>
            <td style="text-align:center;">{{ $registropago->fecha_emision_factura }}</td>
            <td style="text-align:center;">{{ $registropago->numero_factura }}</td>
            <td style="text-align:center;">{{ $registropago->tipo }}</td>
            <td style="text-align:center;">{{ $registropago->monto_factura }}</td>
            <td style="text-align:center;">{{ $registropago->pagado }}</td>
            <td style="text-align:center;">{{ $registropago->saldo }}</td>
            <td style="text-align:center;">{{ $registropago->fecha_pago }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >