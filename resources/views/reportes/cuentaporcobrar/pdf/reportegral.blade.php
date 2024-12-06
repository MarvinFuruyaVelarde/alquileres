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
                      <div style="font-size: 14px">REPORTE DE CUENTAS POR COBRAR</div>
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
            <th>GESTION</th>
            <th>MES</th>
            <th>FECHA NOTA DE COBRO</th>
            <th>NÚMERO NOTA DE COBRO</th>                                   
            <th>FECHA EMISIÓN FACTURA</th>
            <th>NÚMERO FACTURA</th>
            <th>TIPO</th>
            <th>MONTO FACTURA</th>                                   
            <th>PAGADO</th>
            <th>SALDO</th>
        </tr>
    </thead>

    <tbody>
        @foreach($cuentasporcobrar as $cuentaporcobrar)
        <tr>
            <td style="text-align:center;">{{ $cuentaporcobrar->cod_aeropuerto }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->cliente }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->nit ?? $cuentaporcobrar->ci ?? '' }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->gestion }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->mes }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->fecha_nota_cobro }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->numero_nota_cobro }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->fecha_emision_factura }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->numero_factura }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->tipo }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->monto_facturado }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->monto_pagado }}</td>
            <td style="text-align:center;">{{ $cuentaporcobrar->saldo }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >