@extends('layouts.app')
@section('titulo','Reporte de Tipo de Espacios')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte de Tipo de Espacios</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de Tipo de Espacios</li>
        </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between">
        <div class="d-flex">
            <a href="javascript:void(0);" class="btn btn-danger bi-file-earmark-pdf " title="Generar reporte pdf"  onclick="generarReporte('pdf')" target="_blank">PDF</a>
            <a href="javascript:void(0);" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel" onclick="generarReporte('excel')">EXCEL</a>            
        </div>
    </div>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reporte de Tipo de Espacios</h5>
                    <form {{--action="{{route('notacobro.aprobarNotaCobro')}}" method="POST"--}}>
                        @csrf
                        <div class="row mb-5 align-items-center">
                        
                            <div class="col-md-4">
                                <label for="aeropuerto" class="col-form-label">Aeropuerto</label>
                                <select id="aeropuerto" class="form-control{{ $errors->has('aeropuerto') ? ' error' : '' }}" name="aeropuerto">
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

                            <div class="col-md-4">
                                <label for="cliente" class="col-form-label">Cliente</label>
                                <select id="cliente" class="form-control{{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" >
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

                            <div class="col-md-2">
                                <label for="tipo_espacio" class="col-form-label">Tipo de Espacio</label>
                                <select id="tipo_espacio" class="form-control{{ $errors->has('tipo_espacio') ? ' error' : '' }}" name="tipo_espacio" >
                                    <option value="">Seleccionar...</option>
                                    @foreach($tipoEspacios as $tipoEspacio)
                                        <option value="{{ $tipoEspacio->tipo_espacio }}">
                                            {{ $tipoEspacio->desc_tipo_espacio }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tipo_espacio'))
                                    <span class="text-danger">
                                        {{ $errors->first('tipo_espacio') }}
                                    </span>
                                @endif            
                            </div>
                        </div>                    
            
                        <div id="reporte_contrato" class="table-responsive" style="display: none;"> 
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">COD. AEROPUERTO</th>
                                        <th class="text-center">CLIENTE</th>
                                        <th class="text-center">TIPO DE ESPACIO</th>
                                        <th class="text-center">RUBRO</th>
                                        <th class="text-center">OBJETO DE CONTRATO</th>
                                        <th class="text-center">CANON MENSUAL (BS)</th>
                                        <th class="text-center">FECHA INICIAL</th>
                                        <th class="text-center">FECHA FINAL</th>
                                        <th class="text-center">CÓDIGO CONTRATO</th>
                                    </tr>
                                </thead>
                                <tbody id="dato">
                                    <!-- Aquí se cargarán los datos dinámicos -->
                                </tbody>
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
    $(document).ready(function() {
        // Detecta cambios en los filtros y actualiza el reporte
        $('#aeropuerto, #cliente, #tipo_espacio').change(function() {
            actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var aeropuerto = $('#aeropuerto').val();
            var cliente = $('#cliente').val();
            var tipoEspacio = $('#tipo_espacio').val();

            // Verifica que al menos un campo tenga valor
            if (aeropuerto || cliente || tipoEspacio) {
                $.ajax({
                    url: '{{ url("reportetipoespacios/obtieneReporte/") }}',
                    method: 'get',
                    data: {'aeropuerto': aeropuerto, 'cliente': cliente, 'tipoEspacio': tipoEspacio},
                    success: function(response) {
                        mostrarConsulta(response);
                    },
                    error: function(xhr) {
                        console.error("Error al mostrar la información solicitada", xhr);
                    }
                });
            } else {
                $('#dato').html(`
                    <tr>
                        <td colspan="9" class="text-center">No existen datos para la consulta realizada</td>
                    </tr>
                `);
            }
        }

        // Estructura la data para mostrarla en la tabla
        function mostrarConsulta(data) {
            document.getElementById('reporte_contrato').style.display = 'block';
            let grillaHtml = '';

            if (data.length > 0) {
                data.forEach(function(item) {
                    grillaHtml += `
                        <tr>    
                            <td class="text-center">${item.cod_aeropuerto || ''}</td>
                            <td class="text-center">${item.cliente || ''}</td>
                            <td class="text-center">${item.tipo_espacio || ''}</td>
                            <td class="text-center">${item.rubro || ''}</td>
                            <td class="text-center">${item.objeto_contrato || ''}</td>
                            <td class="text-center">${item.canon_mensual || ''}</td>
                            <td class="text-center col-1">${item.fecha_inicial || ''}</td>
                            <td class="text-center col-1">${item.fecha_final || ''}</td>
                            <td class="text-center">${item.codigo_contrato || ''}</td>
                        </tr>
                    `;
                });
            } else {
                grillaHtml = `
                    <tr>
                        <td colspan="9" class="text-center">No existen datos para la consulta realizada</td>
                    </tr>
                `;
            }
            $('#dato').html(grillaHtml);
        }
    });

    function generarReporte(tipo) {
        // Capturar valores seleccionados en los campos
        const aeropuerto = document.getElementById('aeropuerto').value;
        const cliente = document.getElementById('cliente').value;
        const tipoEspacio = document.getElementById('tipo_espacio').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reportetipoespacios.show') }}" 
            : "{{ route('reportetipoespacios.export') }}";

        url += `?aeropuerto=${aeropuerto}&cliente=${cliente}&tipoEspacio=${tipoEspacio}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }
</script>
@endsection