@extends('layouts.app')
@section('titulo','Reporte Resumén de Contratos')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte Resumén de Contratos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte Resumén de Contratos</li>
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
                    <h5 class="card-title">Reporte Resumén de Contratos</h5>
                    <form>
                        @csrf
                        <div class="row mb-5 align-items-center">
                            <div class="col-md-2">
                                <label for="regional" class="col-form-label">Regional</label>
                                <select id="regional" class="form-control{{ $errors->has('regional') ? ' error' : '' }}" name="regional">
                                    <option value="">Seleccionar...</option>
                                    @foreach($regionales as $regional)
                                        <option value="{{ $regional->id }}">
                                            {{ $regional->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('regional'))
                                    <span class="text-danger">
                                        {{ $errors->first('regional') }}
                                    </span>
                                @endif                                                         
                            </div>
                        
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

                            <div class="col-md-3">
                                <label for="periodo_inicial" class="col-form-label">Periodo Inicial <span class="text-danger">(*)</span></label>
                                <input id="periodo_inicial" type="month" class="form-control {{ $errors->has('periodo_inicial') ? 'error' : '' }}" name="periodo_inicial" autofocus>
                                @if ($errors->has('periodo_inicial'))
                                    <span class="text-danger">{{ $errors->first('periodo_inicial') }}</span>
                                @endif
                            </div>

                            <div class="col-md-3">
                                <label for="periodo_final" class="col-form-label">Periodo Final <span class="text-danger">(*)</span></label>
                                <input id="periodo_final" type="month" class="form-control {{ $errors->has('periodo_final') ? 'error' : '' }}" name="periodo_final" autofocus>
                                @if ($errors->has('periodo_final'))
                                    <span class="text-danger">{{ $errors->first('periodo_final') }}</span>
                                @endif
                            </div>
                        </div>                    
            
                        <div id="reporte_contrato" class="table-responsive" style="display: none;"> 
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">COD. REGIONAL</th>
                                        <th class="text-center">COD. AEROPUERTO</th>
                                        <th class="text-center">NUMERO DE CONTRATOS</th>
                                        <th class="text-center">TOTAL (BS.)</th>
                                        <th class="text-center">ESTADO</th>
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
        $('#regional, #aeropuerto, #periodo_inicial, #periodo_final').change(function() {
            actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var regional = $('#regional').val();
            var aeropuerto = $('#aeropuerto').val();
            var periodoInicial = $('#periodo_inicial').val();
            var periodoFinal = $('#periodo_final').val();
            // Verifica que al menos un campo tenga valor
            if (periodoInicial && periodoFinal) {
                $.ajax({
                    url: '{{ url("reporteresumencontratos/obtieneReporte/") }}',
                    method: 'get',
                    data: {'regional': regional || null, 'aeropuerto': aeropuerto || null, 'periodoInicial': periodoInicial, 'periodoFinal': periodoFinal},
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
                        <td colspan="5" class="text-center">No existen datos para la consulta realizada</td>
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
                            <td class="text-center col-3">${item.regional || ''}</td>
                            <td class="text-center col-3">${item.cod_aeropuerto || ''}</td>
                            <td class="text-center col-3">${item.numero_contratos || ''}</td>
                            <td class="text-center col-3">${item.total || ''}</td>
                            <td class="text-center col-3">${item.estado || ''}</td>                            
                        </tr>
                    `;
                });
            } else {
                grillaHtml = `
                    <tr>
                        <td colspan="5" class="text-center">No existen datos para la consulta realizada</td>
                    </tr>
                `;
            }
            $('#dato').html(grillaHtml);
        }
    });

    function generarReporte(tipo) {
        // Capturar valores seleccionados en los campos
        const regional = document.getElementById('regional').value;
        const aeropuerto = document.getElementById('aeropuerto').value;
        const periodoInicial = document.getElementById('periodo_inicial').value;
        const periodoFinal = document.getElementById('periodo_final').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reporteresumencontratos.show') }}" 
            : "{{ route('reporteresumencontratos.export') }}";

        url += `?regional=${regional}&aeropuerto=${aeropuerto}&periodoInicial=${periodoInicial}&periodoFinal=${periodoFinal}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }
</script>
@endsection