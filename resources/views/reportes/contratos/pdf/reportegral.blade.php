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
                      <div style="font-size: 14px">REPORTE DE CONTRATOS</div>
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
            <th>CODIGO</th>
            <th>COD. AEROPUERTO</th>
            <th>CLIENTE</th>
            <th>CANON_TOTAL</th>
            <th>REPRESENTANTE</th>
            <th>TIPO SOLICITANTE</th>
            <th>NIT/CI</th>
            <th>DOMICILIO LEGAL</th>
            <th>TELÉFONO/CELULAR</th>
            <th>CORREO</th>
            <th>ESTADO</th>
        </tr>
    </thead>

    <tbody>
        @foreach($contratos as $contrato)
        <tr>
            <td style="text-align:center;">{{ $contrato->codigo }}</td>
            <td style="text-align:center;">{{ $contrato->cod_aeropuerto }}</td>
            <td style="text-align:center;">{{ $contrato->cliente_nombre }}</td>
            <td style="text-align:center;">{{ $contrato->canon_total }}</td>
            <td style="text-align:center;">{{ $contrato->representante }}</td>
            <td style="text-align:center;">{{ $contrato->desc_tipo_solicitante }}</td>
            <td style="text-align:center;">{{ $contrato->nit ?? $contrato->ci ?? '' }}</td>
            <td style="text-align:center;">{{ $contrato->domicilio_legal }}</td>
            <td style="text-align:center;">{{ $contrato->telefono_celular }}</td>
            <td style="text-align:center;">{{ $contrato->correo }}</td>
            <td style="text-align:center;">{{ $contrato->desc_estado }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >