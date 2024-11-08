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
    <div>
      <div class="margin-top">
        <div style="border: solid 1px #4e4b4bfa; border-radius:20px;">
          <div style="padding: 12px">
            <table class="title" style="width: 100%;">
              <tr class="items">

                <td style="width: 35%; text-align: left;">
                  <img src="{{ ('storage/descarga1.png') }}" width="100px" alt="Image"/>
                </td>
                
                <td style="width: 40%; text-align: center; font-weight: bold;">
                  <div style="font-size: 18px; text-decoration: underline;">
                    NOTA DE COBRO
                  </div>
                </td>
                
                <td style="width: 35%; font-size: 10px; text-align: right;">
                  <span style="font-weight: bold;">FECHA DE IMPRESIÓN: </span> {{$fechaImpresion}}
                </td>

              </tr>
              <tr class="items">
                <td style="width: 35%; text-align: left;">
                </td>
                <td style="width: 40%; text-align: center;">
                </td>
                <td style="width: 35%; font-size: 12px; text-align: right;">
                  {{$numero_nota_cobro}}
                </td>
              </tr>
                    
              <tr>
                <td colspan="3"><hr></td>
              </tr>
              <br>

              <tr>
                <td colspan="2">
                  <div style="font-size: 14px;">
                    <span style="font-weight: bold;">AEROPUERTO: </span>{{$aeropuertoDescripcion}} 
                  </div>
                  <div style="font-size: 14px;">
                    <span style="font-weight: bold;">SEÑOR(ES): </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$clienteRazonSocial}}
                  </div>
                  <div style="font-size: 14px;">
                    <span style="font-weight: bold;">REFERENCIA: </span>&nbsp;&nbsp;Factura correspondiente a &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-weight: bold;">{{$fechaInicio}} a {{$fechaFin}}</span>
                  </div>
                  <br>
                  <div style="font-size: 14px; font-weight: bold;">
                    Nuestro cargo por concepto de : {{$concepto}}</div>
                  </td>
                <td></td>
                <td></td>
              </tr>
            </table>    
            <br>

            <table style="width:100%; font-size:10">
              <thead>
                <tr style="background: darkgray; text-align: center; font-size: 12px;">
                    <th>NUMERO</th>
                    <th>DETALLE</th>
                    <th>TOTAL Bs</th>
                </tr>
              </thead>

              <tbody>

                @php
                $j=1;
                $montoTotal= convertirNumeroATexto($monto_total);
                $enteros = floor($monto_total);
                $decimales = str_pad(round(($monto_total - $enteros) * 100), 2, '0', STR_PAD_LEFT);
                @endphp

                @foreach($facturaDetalles as $facturaDetalle)
                @php
                $espacio = App\Models\View_Espacio::find($facturaDetalle->espacio);
                if ($tipoFactura == 'AL')
                  $detalle = $espacio->descripcion;
                else if ($tipoFactura == 'EX')
                  $detalle = $facturaDetalle->glosa_expensa;
                @endphp
                <tr>
                  <td style="width: 10%; text-align:center; font-size: 12px;">{{$j++}} </td>
                  <td style="width: 70%; text-align:center; font-size: 12px;">{{ $detalle }}</td>
                  <td style="text-align:center; font-size: 12px;">{{ $facturaDetalle->precio }}</td>
                </tr>   
                @endforeach
                <tr>
                  <td colspan="3"><hr></td>
                </tr>
                <tr style=" text-align: center;">
                  <td></td>
                  <td></td>
                  <td style="font-size: 12px;">{{$monto_total}}</td>
                </tr>
              </tbody>
            </table>
            <br>
            <span style="font-weight: bold; font-size: 14px;">Son: {{ucfirst($montoTotal)}} {{$decimales}}/100 Bolivianos</span>
            <br>
            <br>
            <span style="font-size: 12px;">
              Nota: El pago será moneda pactada y/o  en Bolivianos, al tipo de cambio de la fecha de cancelación, debiendo ser cancelado dentro de los 10 habiles a partir de la recepción de la presente nota.
            </span>
          </div>
        </div>
      </div>
    </div>    
  </body>
</html>