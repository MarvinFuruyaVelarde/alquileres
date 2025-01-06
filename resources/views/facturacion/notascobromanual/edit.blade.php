@extends('layouts.app')
@section('titulo','Usuarios')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Notas de Cobro Manual</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Notas de Cobro Manual</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Notas de Cobro Manual</h5>
                    <form action="{{ route('notacobromanual.update', ['idFactura' => $idFactura]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <p>
                          Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
                          Al momento de registrar una nota de cobro manual
                        </p>
                        <div class="row mb-1">
                            <label>Tipo</label>
                            <br><br>
                            <div class="col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="AL" id="tipo_alquiler" {{ old('tipo', $tipo_factura ?? 'AL') == 'AL' ? 'checked' : '' }} disabled> 
                                    <label class="form-check-label" for="tipo_alquiler">Alquiler</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            
                            <div class="col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="EX" id="tipo_expensa" {{ old('tipo', $tipo_factura ?? 'EX') == 'EX' ? 'checked' : '' }} disabled> 
                                    <label class="form-check-label" for="tipo_expensa">Expensa</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                        
                            <div class="col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="MOR" id="tipo_mora" {{ old('tipo', $tipo_factura ?? 'MOR') == 'MOR' ? 'checked' : '' }} disabled> 
                                    <label class="form-check-label" for="tipo_mora">Mora</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>

                            <div class="col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="OTR" id="tipo_otro" {{ old('tipo', $tipo_factura ?? 'OTR') == 'OTR' ? 'checked' : '' }} disabled> 
                                    <label class="form-check-label" for="tipo_otro">Otro</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                        </div>
                        <br>

                        <div class="row mb-1">                            
                            <div class="col-md-4">                          
                                <label for="aeropuerto" class="col-form-label">Aeropuerto <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                  <input id="aeropuerto" disabled type="text" class="form-control {{ $errors->has('aeropuerto') ? ' error' : '' }}" name="aeropuerto" value="{{ $aeropuertoDescripcion }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                                </div>  
                                @if ($errors->has('aeropuerto'))
                                    <span class="text-danger">
                                       {{ $errors->first('aeropuerto') }}
                                    </span>
                                @endif                                   
                            </div>

                            <div id="select_cliente" class="col-md-4">
                                <label for="cliente" class="col-form-label">Cliente <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                  <input id="cliente" disabled type="text" class="form-control {{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" value="{{ $clienteRazonSocial }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                                @if ($errors->has('cliente'))
                                    <span class="text-danger">
                                        {{ $errors->first('cliente') }}
                                    </span>
                                @endif            
                            </div>

                            <div id="select_cliente" class="col-md-4">
                                <label for="codigo" class="col-form-label">Código Contrato <span class="text-danger">(*)</span></label>
                                <select id="codigo" class="form-control  {{ $errors->has('codigo') ? ' error' : '' }}" name="codigo" autofocus {{ in_array($tipo_factura, ['EX', 'AL']) ? 'disabled' : '' }}>
                                    <option value="">Seleccionar...</option>
                                    <option value="SIN/CODIGO" {{ old('codigo', $codigoContratoReg) == 'SIN/CODIGO' ? 'selected' : '' }}>SIN CODIGO</option>
                                    @foreach($codigosContrato as $codigoContrato)
                                        <option value="{{ $codigoContrato }}"
                                            {{ old('codigo', $codigoContratoReg) == $codigoContrato ? 'selected' : '' }}>
                                            {{ $codigoContrato }}
                                        </option>
                                    @endforeach
                                </select> 
                                @if ($errors->has('codigo'))
                                    <span class="text-danger">
                                        {{ $errors->first('codigo') }}
                                    </span>
                                @endif            
                            </div>
                        </div>     
                        
                        <div class="row mb-1">                            
                            <div class="col-md-4">
                                <label for="periodo_facturacion" class="col-form-label">Periodo de Facturación <span class="text-danger">(*)</span></label>
                                <input id="periodo_facturacion" type="date" class="form-control {{ $errors->has('periodo_facturacion') ? 'error' : '' }}" name="periodo_facturacion" value="{{ $periodoFacturacion }}">
                                @if ($errors->has('periodo_facturacion'))
                                    <span class="text-danger">{{ $errors->first('periodo_facturacion') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label for="periodo_inicial" class="col-form-label">Periodo Inicial de Cobro <span class="text-danger">(*)</span></label>
                                <input id="periodo_inicial" type="date" class="form-control {{ $errors->has('periodo_inicial') ? 'error' : '' }}" name="periodo_inicial" value="{{ $periodoInicialCobro }}">
                                @if ($errors->has('periodo_inicial'))
                                    <span class="text-danger">{{ $errors->first('periodo_inicial') }}</span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label for="periodo_final" class="col-form-label">Periodo Final de Cobro <span class="text-danger">(*)</span></label>
                                <input id="periodo_final" type="date" class="form-control {{ $errors->has('periodo_final') ? 'error' : '' }}" name="periodo_final" value="{{ $periodoFinalCobro }}">
                                @if ($errors->has('periodo_final'))
                                    <span class="text-danger">{{ $errors->first('periodo_final') }}</span>
                                @endif
                            </div>
                        </div> 

                        <div class="row mb-1">         
                            <div class="col-md-4">
                                <label for="monto" class="col-form-label me-2">Monto</label>
                                <input id="monto" type="text" class="form-control {{ $errors->has('monto') ? ' error' : '' }}" name="monto" value="{{ $monto }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                            </div>

                            <div class="col-md-4">
                                <label for="glosa_factura" class="col-form-label">Glosa para Facturación</label>
                                <textarea id="glosa_factura" class="form-control {{ $errors->has('glosa_factura') ? ' error' : '' }}" name="glosa_factura" rows="5">{{ $glosa }}</textarea>
                                <span id="error-glosa_factura" class="error-glosa_factura" style="color: rgb(220, 53, 69);"></span>
                                @if ($errors->has('glosa_factura'))
                                    <span class="text-danger">
                                        {{ $errors->first('glosa_factura') }}
                                    </span>
                                @endif
                            </div>

                            <div id="tipo_espacio" class="col-md-4" style="display: none;">
                                <div class="col-sm-10">
                                    <label for="tipo_espacio" class="col-form-label">Por concepto de</label>
                                </div>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input id="tipo_espacio1"  class="form-check-input" type="radio" name="tipo_espacio" value="F" {{ old('tipo_espacio', $tipoCanon ?? 'F') == 'F' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tipo_canon1">Alquiler</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="tipo_espacio2" class="form-check-input" type="radio" name="tipo_espacio" value="V" {{ old('tipo_espacio', $tipoCanon ?? '') == 'V' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tipo_canon2">Compra y Venta</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div id="label_tabla" class="row mb-1" style="display: none;">
                          <div>
                              <br><br>
                              <h5 class="text-muted">LISTA ESPACIO COMERCIAL Y/O PUBLICITARIO</h5>
                              <hr class="mb-1" style="border-top: 2px solid rgb(1, 41, 112);">
                              <br>
                          </div>
                        </div>

                        @if($codigoContratoReg !== 'SIN/CODIGO')
                          <div id="lista_espacio" class="table-responsive" style="display: none;"> 
                            <table class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th class="text-center">DESCRIPCIÓN</th>
                                      <th class="text-center">GLOSA</th>
                                      <th class="text-center">PERIODO INICIAL</th>
                                      <th class="text-center">PERIODO FINAL</th>
                                      <th class="text-center">TOTAL CANON MENSUAL</th>
                                  </tr>
                              </thead>
                              <tbody id="listaEspacios">
                                  @foreach($facturaDetalles as $index => $facturaDetalle)
                                    @php
                                      $espacio = App\Models\View_Espacio::find($facturaDetalle->espacio);
                                    @endphp
                                    <tr>    
                                      <input type='hidden' name='espacios[{{$index}}][id_factura_detalle]' value='{{$facturaDetalle->id}}'/>       
                                      <input type='hidden' name='espacios[{{$index}}][id_espacio]' value='{{$facturaDetalle->espacio}}'/> 
                                      <td class="text-center col-3">{{$espacio->descripcion}}</td>
                                      <td class="text-center col-3"><textarea name="espacios[{{$index}}][glosa_factura]" class="form-control text-center" rows="3">{{$espacio->glosa_factura}}</textarea></td>
                                      <td class='text-center col-1'><input type='date' name='espacios[{{$index}}][fecha_inicial]' class='form-control' value='{{$facturaDetalle->fecha_inicial}}' style='text-align: center;' /></td>
                                      <td class='text-center col-1'><input type='date' name='espacios[{{$index}}][fecha_final]' class='form-control' value='{{$facturaDetalle->fecha_final}}' style='text-align: center;' /></td>
                                      <td class='text-center col-1'><input type='text' name='espacios[{{$index}}][total_canonmensual]' class='form-control' value='{{$facturaDetalle->precio}}' style='text-align: center;' /></td>
                                    </tr>
                                  @endforeach                              
                              </tbody>
                            </table>
                          </div>
                        @endif
            
                        <div id="lista_expensa" class="table-responsive" style="display: none;"> 
                          <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">DESCRIPCIÓN</th>
                                    <th class="text-center">GLOSA</th>
                                    <th class="text-center">PERIODO INICIAL</th>
                                    <th class="text-center">PERIODO FINAL</th>
                                    <th class="text-center">EXPENSA</th>
                                    <th class="text-center">CONSUMO</th>
                                    <th class="text-center">MONTO A PAGAR</th>
                                </tr>
                            </thead>
                            <tbody id="listaExpensas">
                              <tr>
                                <input id="g_factor" type='hidden' name='g_factor' value='{{$expensaFactor}}'/>
                                <td class='text-center col-4'>{{$descripcionEspacio}}</td>
                                <td class="text-center col-3"><textarea name="g_glosa" class="form-control text-center" rows="3">{{$glosa}}</textarea></td>            
                                <td class='text-center col-1'><input type='date' name='g_periodo_inicial' class='form-control' value='{{$periodoInicialCobro}}' style='text-align: center;' /></td>
                                <td class='text-center col-1'><input type='date' name='g_periodo_final' class='form-control' value='{{$periodoFinalCobro}}' style='text-align: center;' /></td>
                                <td class='text-center col-1'>{{$expensaDescripcion}}</td>
                                <td class='text-center col-1'><input id="g_consumo" type='text' name='g_consumo' class='form-control' value='{{$consumo}}' style='text-align: center;' oninput="calcularTotal()" /></td>
                                <td class='text-center col-1'><input id="g_total_a_pagar" type='text' name='g_total_a_pagar' class='form-control' value='{{$monto}}' style='text-align: center;' readonly /></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <br>
                        <div class="row mt-2">
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary">Guardar</button>
                              <a href="{{ route('notacobromanual.index') }}" class="btn btn-warning">Cancelar</a>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
<script>
    // Validación para mostrar el campo por concepto de
    document.addEventListener("DOMContentLoaded", function () {
        const tipoEspacioDiv = document.getElementById("tipo_espacio");
        const tipoRadioButtons = document.querySelectorAll('input[name="tipo"]');

        function toggleTipoEspacio() {
            const selectedValue = document.querySelector('input[name="tipo"]:checked').value;
            tipoEspacioDiv.style.display = selectedValue === 'AL' && document.getElementById('codigo').value === 'SIN/CODIGO' ? 'block' : 'none';
        }

        // Llama a la función al cargar la página para asegurar el estado inicial
        toggleTipoEspacio();

        // Agrega el evento de cambio a cada botón de radio
        tipoRadioButtons.forEach((radio) => {
            radio.addEventListener("change", toggleTipoEspacio);
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
      // Inicializa la visibilidad
      toggleVisibility();
    });

    function toggleVisibility() {
      const tipoRadioButtons = document.querySelectorAll('input[name="tipo"]');
      const labelTabla = document.getElementById('label_tabla');
      const listaExpensa = document.getElementById('lista_expensa');
      const listaExpensas = document.getElementById('listaExpensas');
      const listaEspacio = document.getElementById('lista_espacio');
      const listaEspacios = document.getElementById('listaEspacios');

      // Obtiene el valor del radio button seleccionado
      const selectedTipo = document.querySelector('input[name="tipo"]:checked')?.value;

      // Si el tipo es "EX", mostrar los divs, de lo contrario, ocultarlos
      if (selectedTipo === 'AL' && document.getElementById('codigo').value != 'SIN/CODIGO') {
          labelTabla.style.display = 'block';
          listaEspacio.style.display = 'block';
      }
      else if (selectedTipo === 'EX') {
          labelTabla.style.display = 'block';
          listaExpensa.style.display = 'block';
      } else {
          labelTabla.style.display = 'none';
          listaExpensa.style.display = 'none';
          listaExpensas.innerHTML = '';
      }
    }

    // Deshabilitar campos cuando sea el tipo de nota Expensa
    document.addEventListener("DOMContentLoaded", function () {
      const periodoFacturacionInput = document.getElementById("periodo_facturacion");
      const periodoInicialInput = document.getElementById("periodo_inicial");
      const periodoFinalInput = document.getElementById("periodo_final");
      const monto = document.getElementById("monto");
      const glosaParaFacturacion = document.getElementById("glosa_factura");
      const tipoRadioButtons = document.querySelectorAll('input[name="tipo"]');
      
      function togglePeriodoInicial() {
          const selectedValue = document.querySelector('input[name="tipo"]:checked').value;
          // Desactiva el campo si el valor seleccionado es "EX", de lo contrario lo activa
          const shouldDisable = (selectedValue === 'EX' || (selectedValue === 'AL' && document.getElementById('codigo').value !== 'SIN/CODIGO'));
          periodoFacturacionInput.disabled = shouldDisable;
          periodoInicialInput.disabled = shouldDisable;
          periodoFinalInput.disabled = shouldDisable;
          monto.disabled = shouldDisable;
          glosaParaFacturacion.disabled = shouldDisable;

          // Limpia los valores si se selecciona "EX"
          if (shouldDisable) {
              periodoInicialInput.value = '';
              periodoFinalInput.value = '';
              monto.value = '';
              glosaParaFacturacion.value = '';
          }
      }

      // Llama a la función al cargar la página para ajustar el estado inicial
      togglePeriodoInicial();

      // Agrega el evento de cambio a cada botón de radio
      tipoRadioButtons.forEach((radio) => {
          radio.addEventListener("change", togglePeriodoInicial);
      });
    });

    // Cargar Codigo Contrato, cuando seleccione el aeropuerto y cliente
    $("#cliente").change(function(event) {
        let aeropuerto = document.getElementById('aeropuerto').value;
        getCodigoContrato(aeropuerto, $(this).val());
    });
    
    function getCodigoContrato(aeropuerto, cliente) {
        var zone = $("#codigo");
        
        $.ajax({
          url: '{{ url("notacobromanual/obtCodigoContrato/") }}/'+aeropuerto+'/'+cliente,
          method: 'get',
          data: {'aeropuerto':aeropuerto, 'cliente': cliente},
          beforeSend: function(){
            zone.attr('disabled', true);
          },
          success: function (response) {
            zone.html(response.item);
            if (response.disabled) 
                zone.attr('disabled', true);
            else
                zone.attr('disabled', false);
          },
          error: function() {
            alert('Error al cargar el código de contrato.');
          }
         
        });
    }

    // Función para calcular el total al ingresar un valor en el campo consumo
    function calcularTotal() {
        // Obtiene el valor de consumo ingresado y el factor oculto
        let consumo = document.getElementById('g_consumo').value;
        let factor = document.getElementById('g_factor').value;

        // Realiza la multiplicación y asigna el resultado al campo total_a_pagar
        let total = consumo * factor;
        document.getElementById('g_total_a_pagar').value = total.toFixed(2); // Redondear a 2 decimales si es necesario
    }

</script>
@endsection