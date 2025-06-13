@extends('layouts.app')
@section('titulo','Reporte de Ingresos por Aeropuerto')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte de Ingresos por Aeropuerto</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de Ingresos por Aeropuerto</li>
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
                    <h5 class="card-title">Reporte de Ingresos por Aeropuerto</h5>
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

                            <div class="col-md-2">
                                <label for="fecha_inicial" class="col-form-label">Fecha Inicial</label>
                                <input id="fecha_inicial" type="date" class="form-control {{ $errors->has('fecha_inicial') ? 'error' : '' }}" name="fecha_inicial" autofocus>
                                @if ($errors->has('fecha_inicial'))
                                    <span class="text-danger">{{ $errors->first('fecha_inicial') }}</span>
                                @endif
                            </div>

                            <div class="col-md-2">
                                <label for="fecha_final" class="col-form-label">Fecha Final</label>
                                <input id="fecha_final" type="date" class="form-control {{ $errors->has('fecha_final') ? 'error' : '' }}" name="fecha_final" autofocus>
                                @if ($errors->has('fecha_final'))
                                    <span class="text-danger">{{ $errors->first('fecha_final') }}</span>
                                @endif
                            </div>

                            <div class="col-md-2">
                                <label for="tipo_factura" class="col-form-label">Tipo de Factura</label>
                                <select id="tipo_factura" class="form-control{{ $errors->has('tipo_factura') ? ' error' : '' }}" name="tipo_factura">
                                    <option value="">Seleccionar...</option>
                                    <option value="AL">ALQUILER</option>
                                    <option value="EX">EXPENSA</option>
                                    <option value="MOR">MORA</option>
                                    <option value="OTR">OTRO</option>
                                </select>
                                @if ($errors->has('tipo_factura'))
                                    <span class="text-danger">
                                        {{ $errors->first('tipo_factura') }}
                                    </span>
                                @endif
                            </div>
                        </div>                    
            
                        <div id="reporte_contrato" class="table-responsive" style="display: none;"> 
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">COD. AEROPUERTO</th>
                                        <th class="text-center">AEROPUERTO</th>
                                        <th class="text-center">TIPO FACTURA</th>
                                        <th class="text-center">TOTAL INGRESO (BS)</th>
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
        $('#aeropuerto, #fecha_inicial, #fecha_final, #tipo_factura').change(function() {
            actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var aeropuerto = $('#aeropuerto').val();
            var fechaInicial = $('#fecha_inicial').val();
            var fechaFinal = $('#fecha_final').val();
            var tipoFactura = $('#tipo_factura').val();

            // Verifica que al menos un campo tenga valor
            if (aeropuerto || (fechaInicial && fechaFinal) || tipoFactura) {
                $.ajax({
                    url: '{{ url("reporteingresoaeropuertos/obtieneReporte/") }}',
                    method: 'get',
                    data: {'aeropuerto': aeropuerto, 'fechaInicial': fechaInicial, 'fechaFinal': fechaFinal, 'tipoFactura': tipoFactura},
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
                        <td colspan="3" class="text-center">No existen datos para la consulta realizada</td>
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
                            <td class="text-center col-3">${item.cod_aeropuerto || ''}</td>
                            <td class="text-center col-3">${item.desc_aeropuerto || ''}</td>
                            <td class="text-center col-3">${item.tipo_factura || ''}</td>
                            <td class="text-center col-3">${item.total_ingreso || ''}</td>
                        </tr>
                    `;
                });
            } else {
                grillaHtml = `
                    <tr>
                        <td colspan="4" class="text-center">No existen datos para la consulta realizada</td>
                    </tr>
                `;
            }
            $('#dato').html(grillaHtml);
        }
    });

    function generarReporte(tipo) {
        // Capturar valores seleccionados en los campos
        const aeropuerto = document.getElementById('aeropuerto').value;
        const fechaInicial = document.getElementById('fecha_inicial').value;
        const fechaFinal = document.getElementById('fecha_final').value;
        const tipoFactura = document.getElementById('tipo_factura').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reporteingresoaeropuertos.show') }}" 
            : "{{ route('reporteingresoaeropuertos.export') }}";

        url += `?aeropuerto=${aeropuerto}&fechaInicial=${fechaInicial}&fechaFinal=${fechaFinal}&tipoFactura=${tipoFactura}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }
</script>
@endsection