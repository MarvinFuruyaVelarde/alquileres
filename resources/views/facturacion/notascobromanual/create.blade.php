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
          <form action="{{ route('notacobromanual.store') }}" method="POST">
            @csrf
            <p>
              Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
              Al momento de registrar una nota de cobro manual
            </p>
            <input id="mes" type='hidden' name='mes' value=''/>
            <input id="gestion" type='hidden' name='gestion' value=''/>
            <div class="row mb-1">
              <label>Tipo</label>
              <br><br>
              <div class="col-md-1">
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipo" value="AL" id="tipo_alquiler" checked> 
                      <label class="form-check-label" for="tipo_alquiler">Alquiler</label>
                  </div>
              </div>
              <div class="col-md-1">
              </div>
              
              <div class="col-md-1">
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipo" value="EX" id="tipo_expensa"> 
                      <label class="form-check-label" for="tipo_expensa">Expensa</label>
                  </div>
              </div>
              <div class="col-md-1">
              </div>
          
              <div class="col-md-1">
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipo" value="MOR" id="tipo_mora"> 
                      <label class="form-check-label" for="tipo_mora">Mora</label>
                  </div>
              </div>
              <div class="col-md-1">
              </div>

              <div class="col-md-1">
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipo" value="OTR" id="tipo_otro"> 
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
                  <select id="aeropuerto" class="form-control  {{ $errors->has('aeropuerto') ? ' error' : '' }}" name="aeropuerto" autofocus>
                      <option value="">Seleccionar...</option>
                      @foreach($aeropuertos as $aeropuerto)
                          <option value="{{ $aeropuerto->id }}">
                              {{ $aeropuerto->descripcion }}
                          </option>
                      @endforeach
                  </select>         
                  @if ($errors->has('aeropuerto'))
                      <span class="text-danger">
                          {{ $errors->first('aeropuerto') }}
                      </span>
                  @endif                                   
              </div>

              <div id="select_cliente" class="col-md-4">
                  <label for="cliente" class="col-form-label">Cliente <span class="text-danger">(*)</span></label>
                  <select id="cliente" class="form-control{{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" disabled>
                      <option value="">Seleccionar...</option>
                      @foreach($clientes as $cliente)
                          <option value="{{ $cliente->id }}">
                              {{ $cliente->razon_social }}
                          </option>
                      @endforeach
                  </select>
                  @if ($errors->has('cliente'))
                      <span class="text-danger">
                          {{ $errors->first('cliente') }}
                      </span>
                  @endif            
              </div>

              <div id="select_cliente" class="col-md-4">
                  <label for="codigo" class="col-form-label">Código Contrato <span class="text-danger">(*)</span></label>
                  <select id="codigo" class="form-control{{ $errors->has('codigo') ? ' error' : '' }}" name="codigo" disabled>
                      <option value="">Seleccionar...</option>
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
                  <input id="periodo_facturacion" type="date" class="form-control {{ $errors->has('periodo_facturacion') ? 'error' : '' }}" name="periodo_facturacion">
                  @if ($errors->has('periodo_facturacion'))
                      <span class="text-danger">{{ $errors->first('periodo_facturacion') }}</span>
                  @endif
              </div>

              <div id="f_periodo_inicial" class="col-md-4">
                  <label for="periodo_inicial" class="col-form-label">Periodo Inicial de Cobro <span class="text-danger">(*)</span></label>
                  <input id="periodo_inicial" type="date" class="form-control {{ $errors->has('periodo_inicial') ? 'error' : '' }}" name="periodo_inicial">
                  @if ($errors->has('periodo_inicial'))
                      <span class="text-danger">{{ $errors->first('periodo_inicial') }}</span>
                  @endif
              </div>

              <div id="f_numero_factura" class="col-md-4" style="display: none;">
                <label for="numero_factura" class="col-form-label">Número de Factura</label>
                <select id="numero_factura" class="form-control{{ $errors->has('numero_factura') ? ' error' : '' }}" name="numero_factura">
                    <option value="">Seleccionar...</option>
                </select>
                @if ($errors->has('numero_factura'))
                    <span class="text-danger">
                        {{ $errors->first('numero_factura') }}
                    </span>
                @endif                                                         
              </div>

              <div id="f_periodo_final" class="col-md-4">
                  <label for="periodo_final" class="col-form-label">Periodo Final de Cobro <span class="text-danger">(*)</span></label>
                  <input id="periodo_final" type="date" class="form-control {{ $errors->has('periodo_final') ? 'error' : '' }}" name="periodo_final">
                  @if ($errors->has('periodo_final'))
                      <span class="text-danger">{{ $errors->first('periodo_final') }}</span>
                  @endif
              </div>
            </div> 

            <div class="row mb-1">         
              <div class="col-md-4">
                  <label for="monto" class="col-form-label me-2">Monto</label>
                  <input id="monto_mora" type='hidden' name='monto_mora' value=''/>
                  <input id="monto" type="text" class="form-control {{ $errors->has('monto') ? ' error' : '' }}" name="monto" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
              </div>

              <div class="col-md-4">
                  <label for="glosa_factura" class="col-form-label">Glosa para Facturación</label>
                  <textarea id="glosa_factura" class="form-control {{ $errors->has('glosa_factura') ? ' error' : '' }}" name="glosa_factura" rows="5" onkeyup="this.value = this.value.toUpperCase();"></textarea>
                  <span id="error-glosa_factura" class="error-glosa_factura" style="color: rgb(220, 53, 69);"></span>
                  @if ($errors->has('glosa_factura'))
                      <span class="text-danger">
                          {{ $errors->first('glosa_factura') }}
                      </span>
                  @endif
              </div>

              <div id="tipo_espacio" class="col-md-4">
                  <div class="col-sm-10">
                      <label for="tipo_espacio" class="col-form-label">Por concepto de</label>
                  </div>
                  <div class="col-sm-10 d-flex align-items-center">
                      <div class="form-check me-3">
                          <input id="tipo_espacio1"  class="form-check-input" type="radio" name="tipo_espacio" value="F" {{ old('tipo_espacio', $espacio->tipo_espacio ?? 'F') == 'F' ? 'checked' : '' }}>
                          <label class="form-check-label" for="tipo_canon1">Alquiler</label>
                      </div>
                      <div class="form-check">
                          <input id="tipo_espacio2" class="form-check-input" type="radio" name="tipo_espacio" value="V" {{ old('tipo_espacio', $espacio->tipo_espacio ?? '') == 'V' ? 'checked' : '' }}>
                          <label class="form-check-label" for="tipo_canon2">Compra y Venta</label>
                      </div>
                  </div>
              </div>
            </div>
            <br>

            <div id="label_tabla"class="row mb-1" style="display: none;">
              <div>
                  <br><br>
                  <h5 class="text-muted">LISTA ESPACIO COMERCIAL Y/O PUBLICITARIO</h5>
                  <hr class="mb-1" style="border-top: 2px solid rgb(1, 41, 112);">
                  <br>
              </div>
            </div>

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
                    <!-- Aquí se cargarán los datos dinámicos -->
                </tbody>
              </table>
            </div>

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
                    <!-- Aquí se cargarán los datos dinámicos -->
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

    //Limpiar el formulario cuando se seleccione otro tipo Alquiler, Expensa, Mora u Otro
    document.addEventListener('DOMContentLoaded', function() {
        const tipoRadios = document.querySelectorAll('input[name="tipo"]'); // Todos los radio buttons con nombre "tipo"
        tipoRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('aeropuerto').value = '';
                document.getElementById('cliente').value = '';
                document.getElementById('codigo').value = '';
                document.getElementById('periodo_facturacion').value = '';
                document.getElementById('periodo_inicial').value = '';
                document.getElementById('periodo_final').value = '';
                document.getElementById('monto').value = ''; 
                document.getElementById('glosa_factura').value = ''; 
                document.getElementById('label_tabla').style.display = 'none';
                document.getElementById('lista_espacio').style.display = 'none';
                $('#listaEspacios').html('');  
                document.getElementById('lista_expensa').style.display = 'none';
                $('#listaExpensas').html('');
            });
        });
    });

    // Ocultar el campo Por concepto de
    document.querySelectorAll('input[name="tipo"]').forEach((radio) => {
      radio.addEventListener('change', function() {
          if (this.value === 'EX' || this.value === 'OTR') {
              document.getElementById('tipo_espacio').style.display = 'none'; // Ocultar campo
              document.getElementById('f_numero_factura').style.display = 'none';
              document.getElementById('f_periodo_inicial').style.display = 'block';
              document.getElementById('f_periodo_final').style.display = 'block';
          } else if (this.value === 'MOR') {
              document.getElementById('tipo_espacio').style.display = 'none';
              document.getElementById('f_numero_factura').style.display = 'block';
              document.getElementById('f_periodo_inicial').style.display = 'none';
              document.getElementById('f_periodo_final').style.display = 'none';

              // Cargar Número de Factura, cuando seleccione el código de contrato
              $("#codigo").change(function(event) {
                  if ($(this).val())
                    getNumeroFactura($(this).val());
              });
              
              function getNumeroFactura(codigoContrato) {
                  var zone = $("#numero_factura");
                  var encodedCodigoContrato = encodeURIComponent(codigoContrato);
                  
                  $.ajax({
                    url: '{{ url("notacobromanual/obtNumeroFactura/") }}/'+encodedCodigoContrato,
                    method: 'get',
                    data: {'codigoContrato':encodedCodigoContrato},
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
                      alert('Error al cargar el numero de factura.');
                    }
                  
                  });
              }

              // Cargar monto dado el numero de factura seleccionado
              document.getElementById('numero_factura').addEventListener('change', function () {
                var numerosFactura = document.getElementById("numero_factura");
                var montoFacturaSeleccionado = numerosFactura.options[numerosFactura.selectedIndex].getAttribute('data-monto');
                var mesFacturaSeleccionado = numerosFactura.options[numerosFactura.selectedIndex].getAttribute('data-mes');
                var gestionFacturaSeleccionado = numerosFactura.options[numerosFactura.selectedIndex].getAttribute('data-gestion');
                document.getElementById('monto').disabled = true;
                document.getElementById("monto").value = montoFacturaSeleccionado;
                document.getElementById("monto_mora").value = montoFacturaSeleccionado;
                document.getElementById("mes").value = mesFacturaSeleccionado;
                document.getElementById("gestion").value = gestionFacturaSeleccionado;
              });
            
          } else {
              document.getElementById('f_numero_factura').style.display = 'none';
              document.getElementById('f_periodo_inicial').style.display = 'block';
              document.getElementById('f_periodo_final').style.display = 'block';
              document.getElementById('tipo_espacio').style.display = 'block'; // Mostrar campo
          }
      });
    });

    document.addEventListener("DOMContentLoaded", function () {
      const periodoInicialInput = document.getElementById("periodo_inicial");
      const periodoFinalInput = document.getElementById("periodo_final");
      const monto = document.getElementById("monto");
      const glosaParaFacturacion = document.getElementById("glosa_factura");
      const tipoRadioButtons = document.querySelectorAll('input[name="tipo"]');

      function togglePeriodoInicial() {
          const selectedValue = document.querySelector('input[name="tipo"]:checked').value;
          // Desactiva el campo si el valor seleccionado es "EX", de lo contrario lo activa
          const shouldDisable = (selectedValue === 'EX');
          periodoInicialInput.disabled = shouldDisable;
          periodoFinalInput.disabled = shouldDisable;
          monto.disabled = shouldDisable;
          glosaParaFacturacion.disabled = shouldDisable;
      }

      // Llama a la función al cargar la página para ajustar el estado inicial
      togglePeriodoInicial();

      // Agrega el evento de cambio a cada botón de radio
      tipoRadioButtons.forEach((radio) => {
          radio.addEventListener("change", togglePeriodoInicial);
      });
    });

    // Cargar Cliente, cuando seleccione el aeropuerto
    $("#aeropuerto").change(function(event) {
      document.getElementById('cliente').disabled = false;
    });

    // Cargar Codigo Contrato, cuando seleccione el aeropuerto y cliente
    $("#cliente").change(function(event) {
        let aeropuerto = document.getElementById('aeropuerto').value;
        if (aeropuerto && $(this).val())
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

    $(document).ready(function() {

      // Detectar el cambio en el tipo de nota de cobro
      $('input[name="tipo"]').change(function() {
          var tipoSeleccionado = $('input[name="tipo"]:checked').val();
          
          // Si se selecciona Alquiler o Expensa, se carga la tabla
          if (tipoSeleccionado === 'AL' || tipoSeleccionado === 'EX') {
              $('#aeropuerto, #cliente, #codigo, #periodo_facturacion').change();
          } else {
              // Si no es Alquiler o Expensa, ocultar y limpiar la tabla
              document.getElementById('label_tabla').style.display = 'none';
              document.getElementById('lista_espacio').style.display = 'none';
              $('#listaEspacios').html('');  // Limpiar la tabla
              document.getElementById('lista_expensa').style.display = 'none';
              $('#listaExpensas').html('');  // Limpiar la tabla
          }
      });

      //Detecta cambios en los filtro para actualizar la lista de expensas
      $('#aeropuerto, #cliente, #codigo, #periodo_facturacion').change(function() {
          // Obtén los valores de los campos
          var aeropuerto = $('#aeropuerto').val();
          var cliente = $('#cliente').val();
          var codigo = $('#codigo').val();
          var periodoFacturacion = $('#periodo_facturacion').val();
          var tipoSeleccionado = $('input[name="tipo"]:checked').val();
      
          // Verifica que todos los campos requeridos estén llenos
          if (aeropuerto && cliente && codigo && periodoFacturacion && (tipoSeleccionado === 'AL' || tipoSeleccionado === 'EX')) {
              if (tipoSeleccionado === 'AL') {
                if (codigo !== 'SIN/CODIGO'){
                  $.ajax({
                    url: '{{ url("notacobromanual/obtieneEspacioCanonVariable/") }}',
                    method: 'get',
                    data: {'aeropuerto': aeropuerto, 'cliente': cliente, 'codigo': codigo, 'periodoFacturacion': periodoFacturacion},
                    success: function(response) {
                        document.getElementById('label_tabla').style.display = 'block';
                        document.getElementById('lista_espacio').style.display = 'block';
                        document.getElementById('periodo_inicial').value = '';
                        document.getElementById('periodo_final').value = '';
                        document.getElementById('monto').value = ''; 
                        document.getElementById('glosa_factura').value = ''; 
                        // Llama a la función para cargar la grilla con los datos obtenidos
                        cargarEspacio(response);
                    },
                    error: function(xhr) {
                        console.error("Error al obtener los espacios", xhr);
                    }
                  });
                } else{
                  document.getElementById('periodo_inicial').disabled = false;
                  document.getElementById('periodo_final').disabled = false;
                  document.getElementById('monto').disabled = false;
                  document.getElementById('glosa_factura').disabled = false;
                  document.getElementById('tipo_espacio').style.display = 'block';
                  document.getElementById('label_tabla').style.display = 'none';
                  document.getElementById('lista_espacio').style.display = 'none';
                  $('#listaEspacios').html('');
                }
              } else if (tipoSeleccionado === 'EX') {
                if (codigo !== 'SIN/CODIGO'){
                  $.ajax({
                    url: '{{ url("notacobromanual/obtieneExpensa/") }}',
                    method: 'get',
                    data: {'aeropuerto': aeropuerto, 'cliente': cliente, 'codigo': codigo, 'periodoFacturacion': periodoFacturacion},
                    success: function(response) {
                        // Si aeropuerto, cliente, codigo y periodoFacturacion estan llenados y el tipo es Expensa mostramos la grilla y deshabilitamos periodo_inicial, final, monto y glosa
                        document.getElementById('label_tabla').style.display = 'block';
                        document.getElementById('lista_expensa').style.display = 'block';
                        document.getElementById('periodo_inicial').disabled = true;
                        document.getElementById('periodo_final').disabled = true;
                        document.getElementById('monto').disabled = true;
                        document.getElementById('glosa_factura').disabled = true;
                        document.getElementById('periodo_inicial').value = '';
                        document.getElementById('periodo_final').value = '';
                        document.getElementById('monto').value = ''; 
                        document.getElementById('glosa_factura').value = ''; 
                        // Llama a la función para cargar la grilla con los datos obtenidos
                        cargarExpensa(response);
                    },
                    error: function(xhr) {
                        console.error("Error al obtener las expensas", xhr);
                    }
                  });
                } else{
                  document.getElementById('periodo_inicial').disabled = false;
                  document.getElementById('periodo_final').disabled = false;
                  document.getElementById('monto').disabled = false;
                  document.getElementById('glosa_factura').disabled = false;
                  document.getElementById('label_tabla').style.display = 'none';
                  document.getElementById('lista_expensa').style.display = 'none';
                  $('#listaExpensas').html('');
                }
              }
          } else {
            document.getElementById('periodo_inicial').disabled = false;
            document.getElementById('periodo_final').disabled = false;
            document.getElementById('monto').disabled = false;
            document.getElementById('glosa_factura').disabled = false;

            if (tipoSeleccionado == 'AL')
              document.getElementById('tipo_espacio').style.display = 'block';

            document.getElementById('label_tabla').style.display = 'none';
            document.getElementById('lista_espacio').style.display = 'none';
            $('#listaEspacios').html('');  
            document.getElementById('lista_expensa').style.display = 'none';
            $('#listaExpensas').html('');
          }
      });

      // Estrctura la data de Lista de Expensas
      function cargarEspacio(data) {
        if (data.espacios.length > 0) {
          const periodoInicialInput = document.getElementById("periodo_inicial");
          const periodoFinalInput = document.getElementById("periodo_final");
          const monto = document.getElementById("monto");
          const glosaParaFacturacion = document.getElementById("glosa_factura");
          const selectedValue = document.querySelector('input[name="tipo"]:checked').value;
          // Desactiva el campo si el valor seleccionado es "EX", de lo contrario lo activa
          const shouldDisable = (selectedValue === 'AL');
          periodoInicialInput.disabled = shouldDisable;
          periodoFinalInput.disabled = shouldDisable;
          monto.disabled = shouldDisable;
          glosaParaFacturacion.disabled = shouldDisable;
          document.getElementById('tipo_espacio').style.display = 'none';

          var grillaHtml = '';
          data.espacios.forEach(function(espacio, index) {
              grillaHtml += `
                  <tr>    
                      <input type='hidden' name='espacios[${index}][id_espacio]' value='${espacio.id_espacio}'/>       
                      <td class="text-center col-3">${espacio.detalle_espacio}</td>
                      <td class="text-center col-3"><textarea name="espacios[${index}][glosa_factura]" class="form-control text-center" rows="3">${espacio.glosa_factura}</textarea></td>
                      <td class='text-center col-1'><input type='date' name='espacios[${index}][fecha_inicial]' class='form-control' value='${data.fecha_inicial}' style='text-align: center;' /></td>
                      <td class='text-center col-1'><input type='date' name='espacios[${index}][fecha_final]' class='form-control' value='${data.fecha_final}' style='text-align: center;' /></td>
                      <td class='text-center col-1'><input type='text' name='espacios[${index}][total_canonmensual]' class='form-control' value='${espacio.total_canonmensual}' style='text-align: center;' /></td>
                  </tr>
              `;
          });
        } else {
          grillaHtml = `
              <tr>
                  <td colspan="5" class="text-center">No hay espacios disponibles</td>
              </tr>
          `;
          document.getElementById("periodo_inicial").disabled = true;
          document.getElementById("periodo_final").disabled = true;
          document.getElementById("monto").disabled = true;
          document.getElementById("glosa_factura").disabled = true;
          document.getElementById('tipo_espacio').style.display = 'none';
        }
        $('#listaEspacios').html(grillaHtml);
      }

      // Estrctura la data de Lista de Expensas
      function cargarExpensa(data) {
        var grillaHtml = '';
        if (data.expensas && data.expensas.length > 0) {
          data.expensas.forEach(function(expensa, index) {
              grillaHtml += `
                  <tr>
                      <input type='hidden' name='expensas[${index}][id_espacio]' value='${expensa.id_espacio}'/>
                      <input type='hidden' name='expensas[${index}][expensa]' value='${expensa.expensa}'/>
                      <input id="factor_${index}" type='hidden' name='expensas[${index}][factor]' value='${expensa.factor}'/>
                      <td class='text-center col-4'>${expensa.detalle_espacio}</td>
                      <td class="text-center col-3"><textarea name="expensas[${index}][glosa_factura]" class="form-control text-center" rows="3">EXPENSA (${expensa.unidad_medida})</textarea></td>            
                      <td class='text-center col-1'><input type='date' name='expensas[${index}][fecha_inicial]' class='form-control' value='${data.fecha_inicial}' style='text-align: center;' /></td>
                      <td class='text-center col-1'><input type='date' name='expensas[${index}][fecha_final]' class='form-control' value='${data.fecha_final}' style='text-align: center;' /></td>
                      <td class='text-center col-1'>${expensa.descripcion}</td>
                      <td class='text-center col-1'><input id="consumo_${index}" name='expensas[${index}][consumo]' type='text' class='form-control' value='' style='text-align: center;' oninput="calcularTotal(${index})" /></td>
                      <td class='text-center col-1'><input id="total_a_pagar_${index}" type='text' name='expensas[${index}][total_a_pagar]' class='form-control' value='' style='text-align: center;' readonly /></td>
                  </tr>
              `;
          });
        } else {
          grillaHtml = `
              <tr>
                  <td colspan="7" class="text-center">No hay espensas disponibles</td>
              </tr>
          `;
        }
        $('#listaExpensas').html(grillaHtml);
      }

    });

    // Función para calcular el total al ingresar un valor en el campo consumo
    function calcularTotal(index) {
        // Obtiene el valor de consumo ingresado y el factor oculto
        let consumo = document.getElementById(`consumo_${index}`).value;
        let factor = document.getElementById(`factor_${index}`).value;

        // Realiza la multiplicación y asigna el resultado al campo total_a_pagar
        let total = consumo * factor;
        document.getElementById(`total_a_pagar_${index}`).value = total.toFixed(2); // Redondear a 2 decimales si es necesario
    }

</script>
@endsection