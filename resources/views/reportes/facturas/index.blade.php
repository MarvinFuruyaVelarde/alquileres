@extends('layouts.app')
@section('titulo','Reporte de Facturas/Notas de Cobro')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte de Facturas/Notas de Cobro</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de Facturas/Notas de Cobro</li>
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
                    <h5 class="card-title">Reporte de Facturas/Notas de Cobro</h5>
                    <form {{--action="{{route('notacobro.aprobarNotaCobro')}}" method="POST"--}}>
                        @csrf
                        <div class="row mb-5 align-items-center">
                        
                            <div class="col-md-2">
                                <label for="gestion" class="col-form-label">Gestión</label>
                                <select id="gestion" class="form-control{{ $errors->has('gestion') ? ' error' : '' }}" name="gestion">
                                    <option value="">Seleccionar...</option>
                                    @foreach($gestiones as $gestion)
                                        <option value="{{ $gestion->gestion }}">
                                            {{ $gestion->gestion }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('gestion'))
                                    <span class="text-danger">
                                        {{ $errors->first('gestion') }}
                                    </span>
                                @endif                                                         
                            </div>

                            <div class="col-md-2">
                                <label for="mes" class="col-form-label">Mes</label>
                                <select id="mes" class="form-control{{ $errors->has('mes') ? ' error' : '' }}" name="mes">
                                    <option value="">Seleccionar...</option>
                                    @foreach($meses as $mes)
                                        <option value="{{ $mes->mes }}">
                                            {{ $mes->mes_literal }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('mes'))
                                    <span class="text-danger">
                                        {{ $errors->first('mes') }}
                                    </span>
                                @endif                                                         
                            </div>
                        </div>                    
            
                        <div id="reporte_contrato" class="table-responsive" style="display: none;"> 
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                    
                                        <th class="text-center">AEROPUERTO</th>
                                        <th class="text-center">CLIENTE</th>
                                        <th class="text-center">GESTIÓN</th>
                                        <th class="text-center">MES</th>
                                        <th class="text-center">NÚMERO NOTA DE COBRO</th>                                        
                                        <th class="text-center">TIPO FACTURA</th>
                                        <th class="text-center">NÚMERO DE FACTURA</th>
                                        <th class="text-center">MONTO TOTAL (BS)</th>
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
        $('#gestion, #mes').change(function() {
            actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var gestion = $('#gestion').val();
            var mes = $('#mes').val();

            // Verifica que al menos un campo tenga valor
            if (gestion || mes) {
                $.ajax({
                    url: '{{ url("reportefacturas/obtieneReporte/") }}',
                    method: 'get',
                    data: {'gestion': gestion, 'mes': mes},
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
                            <td class="text-center">${item.codigo || ''}</td>
                            <td class="text-center">${item.razon_social || ''}</td>
                            <td class="text-center">${item.gestion || ''}</td>
                            <td class="text-center">${item.mes_literal || ''}</td>
                            <td class="text-center">${item.numero_nota_cobro || ''}</td>
                            <td class="text-center">${item.tipo_factura || ''}</td>
                            <td class="text-center">${item.numero_factura || ''}</td>
                            <td class="text-center">${item.monto_total || ''}</td>
                            <td class="text-center">${item.estado || ''}</td>
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
        const gestion = document.getElementById('gestion').value;
        const mes = document.getElementById('mes').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reportefacturas.show') }}" 
            : "{{ route('reportefacturas.export') }}";

        url += `?gestion=${gestion}&mes=${mes}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }
</script>
@endsection