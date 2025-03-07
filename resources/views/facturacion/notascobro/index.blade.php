@extends('layouts.app')
@section('titulo','Usuarios')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Notas de Cobro</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Notas de Cobro</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Notas de Cobro</h5>
                    <form action="{{route('notacobro.aprobarNotaCobro')}}" method="POST">
                        @csrf

                        <div class="row mb-5 align-items-center">
                            <!-- Generar / Visualizar Switches -->
                            <div class="col-12 col-md-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="check_generar" checked>
                                    <label class="form-check-label" for="check_generar">Generar</label>
                                </div>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="check_visualizar">
                                    <label class="form-check-label" for="check_visualizar">Visualizar</label>
                                </div>
                            </div>

                            <!-- Input de Fecha -->
                            <div class="col-12 col-md-2">
                                <label for="fecha" class="col-form-label">Periodo de Facturación <span class="text-danger">(*)</span></label>
                                <input id="fecha" type="date" class="form-control {{ $errors->has('fecha') ? 'error' : '' }}" name="fecha" autofocus>
                                @if ($errors->has('fecha'))
                                    <span class="text-danger">{{ $errors->first('fecha') }}</span>
                                @endif
                            </div>

                            <div class="col-12 col-md-2">
                                <label for="tipo" class="col-form-label">Tipo <span class="text-danger">(*)</span></label>
                                <select id="tipo" class="form-control" name="tipo" disabled>
                                    <option value="">Seleccionar...</option>
                                    <option value="AL">Alquiler</option>
                                    <option value="EX">Expensa</option>
                                </select>
                            </div>
                        
                            <div class="col-12 col-md-2">
                                <label for="aeropuerto" class="col-form-label">Aeropuerto <span class="text-danger">(*)</span></label>
                                <select id="aeropuerto" class="form-control{{ $errors->has('aeropuerto') ? ' error' : '' }}" name="aeropuerto" disabled>
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

                            <div id="select_cliente" class="col-12 col-md-2" style="display: none;">
                                <label for="cliente" class="col-form-label">Cliente <span class="text-danger">(*)</span></label>
                                <select id="cliente" class="form-control{{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" disabled>
                                    <option value="">Seleccionar...</option>
                                </select>
                                @if ($errors->has('cliente'))
                                    <span class="text-danger">
                                        {{ $errors->first('cliente') }}
                                    </span>
                                @endif            
                            </div>

                        
                            <div class="col-12 col-md-2 d-flex justify-content-center align-self-end">
                                @can('notacobro.generar')
                                    <button id="generar" type="" class="btn btn-primary me-2" disabled>GENERAR</button> 
                                @endcan
                                @can('notacobro.visualizar')
                                    <button id="visualizar" type="" class="btn btn-primary me-2" style="display: none;" disabled>VISUALIZAR</button>
                                @endcan
                                @can('notacobro.aprobar')
                                    <button id="aprobar" type="submit" class="btn btn-success" style="display: none;" disabled>APROBAR</button> 
                                @endcan
                            </div>
                        
                        </div>
                        <!--CONTENIDO -->
                        <div class="table-responsive">
                            <table cellspacing="0" width="100%" id="tabla" class="table table-hover table-bordered">
                                
                            </table>
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

    // Habilitar Filtro(s)
    var fechaInput = document.getElementById('fecha');
    var tipoSelect = document.getElementById('tipo');
    var aeropuertoSelect = document.getElementById('aeropuerto');
    var clienteSelect = document.getElementById('cliente');
    var buttonGenerar = document.getElementById('generar'); 
    var buttonVisualizar = document.getElementById('visualizar');

    // Habilitar/Deshabilitar Opción Generar o Visualizar Notas de Cobro
    document.getElementById('check_generar').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('check_visualizar').checked = false;
            document.getElementById('select_cliente').style.display = 'none';
            document.getElementById('generar').style.display = 'block';
            document.getElementById('visualizar').style.display  = 'none';
            document.getElementById('aprobar').style.display = 'none';
            fechaInput.value = "";
            tipoSelect.disabled = true;
            tipoSelect.value = "";
            aeropuertoSelect.disabled = true;
            aeropuertoSelect.value = "";
            clienteSelect.disabled = true;
            clienteSelect.value = "";
            buttonVisualizar.disabled = true;
            $('#tabla thead').remove();
            $('#tabla tbody').remove();
        }
    });

    document.getElementById('check_visualizar').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('check_generar').checked = false;  
            document.getElementById('select_cliente').style.display = 'block';   
            document.getElementById('generar').style.display = 'none';       
            document.getElementById('visualizar').style.display = 'block';
            document.getElementById('aprobar').style.display = 'block';
            fechaInput.value = "";
            tipoSelect.disabled = true;
            tipoSelect.value = "";
            aeropuertoSelect.disabled = true;
            aeropuertoSelect.value = "";
            clienteSelect.disabled = true;
            clienteSelect.value = "";
            buttonGenerar.disabled = true;
            $('#tabla thead').remove();
            $('#tabla tbody').remove();
        }
    });

    fechaInput.addEventListener('change', function() {
        if (fechaInput.value) {
            if (document.getElementById('check_visualizar').checked)
                buttonVisualizar.disabled = false;
            tipoSelect.disabled = false;
        } else {
            tipoSelect.disabled = true;
            tipoSelect.value = ""
            aeropuertoSelect.disabled = true;
            aeropuertoSelect.value = ""
            buttonGenerar.disabled = true;
            $('#tabla thead').remove();
            $('#tabla tbody').remove();
        }
    });

    tipoSelect.addEventListener('change', function() {
        if (tipoSelect.value) {
            aeropuertoSelect.disabled = false;
        } else {
            aeropuertoSelect.disabled = true;
        }
    });

    aeropuertoSelect.addEventListener('change', function() {
        if (tipoSelect.value) {
            if(document.getElementById('check_generar').checked)
                buttonGenerar.disabled = false;
            else
                buttonVisualizar.disabled = false;
        } else {
            buttonGenerar.disabled = true;
        }
    });

    // Cargar Cliente, cuando seleccione el aeropuerto
    $("#aeropuerto").change(function(event) {
        getCliente($(this).val());
    });
    
    function getCliente(aeropuerto, cliente=null) {
          
        var zone = $("#cliente");
        
        $.ajax({
          url: '{{ url("notacobro/obt_cliente/") }}/'+aeropuerto+'/'+cliente,
          method: 'get',
          data: {'aeropuerto':aeropuerto},
          beforeSend: function(){
            zone.attr('disabled', true);
          },
          success: function (response) {
            zone.attr('disabled', false).html(response.item);
          },
         
        });
    }

    // Genera nota de cobro dado el periodo de facturación,  tipo y aeropuerto
    $("#generar").click(function(event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto del botón (evitar submit si es necesario)

        var aeropuerto = $("#aeropuerto").val();
        var periodoFacturacion = $("#fecha").val();
        var tipo = $("#tipo").val();
        var fechaArray = periodoFacturacion.split("-");
        var periodoFacturacionF = fechaArray[2] + "/" + fechaArray[1] + "/" + fechaArray[0];

        // Llamar a la función que hace la petición AJAX con estos valores
        if (confirm("¿Está seguro de realizar la generación de Notas de Cobro a Fecha " + periodoFacturacionF + "?"))
            generaNotaCobro(aeropuerto, periodoFacturacion, tipo); 
    });

    function generaNotaCobro(aeropuerto, periodoFacturacion, tipo) {
      var tabla=$("#tabla");
     
      $.ajax({
        url: '{{ route('notacobro.generaNotaCobro') }}',
        method: 'get',
        data: {'aeropuerto':aeropuerto, 'periodoFacturacion':periodoFacturacion, 'tipo':tipo},
        success: function (response) {
          tabla.html(response.item1);  
        },
       
      });
    }

    // Visualiza nota de cobro dado el periodo de facturación, Tipo, Aeropuerto, Cliente
    $("#visualizar").click(function(event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto del botón (evitar submit si es necesario)

        var periodoFacturacion = $("#fecha").val();
        var tipo = $("#tipo").val();
        var aeropuerto = $("#aeropuerto").val();
        var cliente = $("#cliente").val();

         // Llamar a la función que hace la petición AJAX con estos valores
        visualizaNotaCobro(periodoFacturacion, tipo, aeropuerto, cliente);
    });

    function visualizaNotaCobro(periodoFacturacion, tipo, aeropuerto, cliente) {
      var tabla=$("#tabla");
     
      $.ajax({
        url: '{{ route('notacobro.visualizaNotaCobro') }}',
        method: 'get',
        data: {'periodoFacturacion':periodoFacturacion, 'tipo':tipo, 'aeropuerto':aeropuerto, 'cliente':cliente},
        success: function (response) {
          tabla.html(response.item1);  
        },
       
      });
    }

    // Selección masiva de nota(s) de cobro
    $(document).on('click', '#check-all', function() {
        let checkboxes = document.querySelectorAll('input[name="aprobado[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('check-all').checked;
        });
    });

    // Función para verificar si hay al menos un checkbox seleccionado para habilitar el botón Aprobar
    function verificarCheckSeleccionado() {
        let checkboxes = document.querySelectorAll('input[name="aprobado[]"]');
        let botonAprobar = document.getElementById('aprobar');

        // Verifica si hay algún checkbox seleccionado
        let algunoSeleccionado = Array.from(checkboxes).some(checkbox => checkbox.checked);
        
        // Si hay al menos uno seleccionado, habilita el botón
        if (algunoSeleccionado) 
            botonAprobar.disabled = false;
        else 
            botonAprobar.disabled = true;
    }

    // Habilitar botón Aprobar cuando se haya seleccionado el check masivo
    $(document).on('click', '#check-all', function() {
        let checkboxes = document.querySelectorAll('input[name="aprobado[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('check-all').checked;
        });

        verificarCheckSeleccionado(); // Verificar cuando se cambia el estado del check masivo
    });

    // Verificar si algún check individual esta seleccionado
    $(document).on('click', 'input[name="aprobado[]"]', function() {
        verificarCheckSeleccionado(); // Verificar cuando se cambia el estado de los checks individuales
    });

    // Nota(s) de Cobro seleccionada
    document.getElementById('aprobar').addEventListener('click', function(event) {
        // Obtener los checkboxes seleccionados
        let checkboxesSeleccionados = document.querySelectorAll('input[name="aprobado[]"]:checked');
        let notasCobroSeleccionadas = [];

        checkboxesSeleccionados.forEach(function(checkbox) {
            notasCobroSeleccionadas.push(checkbox.value);
        });

        if (notasCobroSeleccionadas.length === 0) {
            event.preventDefault(); // Prevenir el comportamiento por defecto del botón
            alert('Por favor, seleccione al menos una nota de cobro para aprobar.');
        } 
    });

</script>
@endsection