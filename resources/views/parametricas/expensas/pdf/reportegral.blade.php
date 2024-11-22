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
                      <div style="font-size: 14px">EXPENSAS</div>
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
            <th>Nº</th>
            <th>DESCRIPCIÓN</th>
            <th>FACTOR</th>
            <th>UNIDAD DE MEDIDA</th>
            <th>ESTADO</th>
        </tr>
    </thead>

    <tbody>
        @foreach($expensas as $expensa)
        <tr>
            <td style="text-align:center;">{{ $expensa->id }}</td>
            <td style="text-align:center;">{{ $expensa->descripcion }}</td>
            <td style="text-align:center;">{{ $expensa->factor }}</td>
            <td style="text-align:center;">{{ $expensa->unidad_medida }}</td>
            <td style="text-align:center;">{{ $expensa->desc_estado }}</td>
        </tr>
        @endforeach
    </tbody>
 </table >