<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
@for ($i = 1; $i <= $numero_cobro; $i++)
<div >
    <div class="margin-top">
        <div style="border: solid 1px #4e4b4bfa; border-radius:20px;">
           <div style="padding: 12px">
              <table class="title" style="width: 100%;">
                 <tr class="items">
                    <td style="width: 30%; text-align:left">
                        <img src="{{'storage/descarga1.png'}}"  width="100px" alt="Image"/>
                     </td>
                       <td style="width: 35%; text-align:center; font-weight: bold;">
                          <div style="font-size: 12px; font-weight: bold;">
                            NAVEGACIÓN AÉREA Y AEROPUERTOS BOLIVIANOS 
                          </div>
                          <div style="font-size: 12px; font-weight: bold;">
                            SISTEMA ALQUILERES   
                          </div>
                          <div style="font-size: 12px; text-decoration: underline;">PLANTILLA</div>
                       </td>
                     
                       <td style="width: 35%; font-size: 10px; text-align: right;"> 
                        <span style="font-weight: bold;">FECHA DE IMPRESIÓN: </span> {{$fechaImpresion}}
                        <br><br><br><br>
                       </td>
                 </tr>
                 <br>
                 <tr>
                    <td colspan="3"><hr></td>
                    
                 </tr>
                 <br>
                 <tr >
                    <td colspan="2">
                      <div style="font-size: 14px;">
                        <span style="font-weight: bold;">AEROPUERTO: </span>{{$aeropuerto->descripcion}}
                      </div>
                      <div style="font-size: 14px;">
                        <span style="font-weight: bold;">SEÑOR(ES): </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cliente->razon_social}}
                      </div>
                      <br>
                      <div style="font-size: 14px; font-weight: bold;">
                        Nuestro cargo por concepto de : ALQUILER
                      </div>
                    <td></td>
                    <td></td>
                 </tr>
              </table>    
              
              <br>
   <table  style="width:100%; font-size:10">
    <thead>
        <tr style="background: darkgray; text-align: center;">
            <th>NUMERO</th>
            <th>DETALLE</th>
            <th>TOTAL Bs</th>
            
        </tr>
       
    </thead>

    <tbody>
      
        @php
            $suma_total=0;
            $j=1;
        @endphp
        @foreach($plantilla as $key => $item)
          @if ($i== $item->numero)
            @php
            
            $espacio= App\Models\View_Espacio::where('id',$item->espacio)->first();
            $suma_total=$suma_total+ $espacio->total_canonmensual;
            $salida= convertirNumeroATexto($suma_total);
            $enteros = floor($suma_total);
            $decimales = str_pad(round(($suma_total - $enteros) * 100), 2, '0', STR_PAD_LEFT);
            @endphp
            <tr>
              <td style="text-align:center;">{{$j++}} </td>
              <td style="text-align:center;">{{ $espacio->glosa_factura }}</td>
              <td style="text-align:center;">{{ $espacio->total_canonmensual }}</td>
            </tr>   
          @endif
        @endforeach
        <tr>
          <td colspan="3"><hr></td>
        </tr>
        <tr style=" text-align: center;">
          <td></td>
          <td></td>
          
          <td>{{$suma_total}}</td>
        </tr>
    </tbody>
 </table >
 <br>
 <span style="font-weight: bold; font-size: 14px;">Son: {{ucfirst($salida)}} {{$decimales}}/100 Bolivianos</span>
 <br>
 <br>
 <span style="font-size: 12px;">Nota: El pago sera moneda pactada y/o  en Bolivianos, al tipo de cambio de la fecha de cancelacion, debiendo ser cancelado dentro de los
   10 habiles apartir de la recepcion de la presente nota.
 </span>
           </div>
        </div>

        
    </div>
    
</div >
        @if($i+1 <= $numero_cobro)
            <div class="page-break"></div>
        @endif
@endfor
    
    
</body>
</html>