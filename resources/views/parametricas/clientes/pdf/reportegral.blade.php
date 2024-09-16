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
                      <div style="font-size: 14px">CLIENTES</div>
                   </td>
                   <td style="width: 20%; text-align:center"> 
                   </td>
             </tr>
          </table>        
       </div>
    </div>
</div>

<br>
<table  style="width:100%; font-size:8">
    <thead>
        <tr style="background: darkgray; text-align: center;">
            <th>Nº</th>
            <th>RAZÓN SOCIAL</th>
            <th>TIPO IDENTIFICACIÓN</th>
            <th>NRO. IDENTIFICACIÓN</th>
            <th>¿ES AEROLINEA?</th>
            <th>¿ES PRESTADOR DE SERVICIOS SAT?</th>
            <th>TIPO SOLICITANTE</th>
            <th>EXPEDIDO</th>
            <th>ESTADO</th>
        </tr>
    </thead>

    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td style="text-align:center;">{{ $cliente->id }}</td>
            <td style="text-align:center;">{{ $cliente->razon_social }}</td>
            <td style="text-align:center;">{{ $cliente->desc_tipoidentificacion }}</td>
            <td style="text-align:center;">{{ $cliente->numero_identificacion }}</td>
            <td style="text-align:center;">{{ $cliente->desc_esaerolinea }}</td>
            <td style="text-align:center;">{{ $cliente->desc_espssat }}</td>
            <td style="text-align:center;">{{ $cliente->desc_tiposolicitante }}</td>
            <td style="text-align:center;">{{ $cliente->desc_expedido }}</td>
            <td style="text-align:center;">{{ $cliente->desc_estado }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >