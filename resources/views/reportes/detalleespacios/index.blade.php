@extends('layouts.app')
@section('titulo','Reporte de Detalle de Espacios')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte de Detalle de Espacios</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de Detalle de Espacios</li>
        </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between">
        <div class="d-flex">
            @can('expensas.show')
                <a href="javascript:void(0);" class="btn btn-danger bi-file-earmark-pdf " title="Generar reporte pdf"  onclick="generarReporte('pdf')" target="_blank">PDF</a>
            @endcan

            @can('expensas.show')
                <a href="javascript:void(0);" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel" onclick="generarReporte('excel')">EXCEL</a>
             @endcan
        </div>
    </div>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalle de Espacios</h5>
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
                                <label for="total_canon_mensual" class="col-form-label">Total Canon Mensual</label>
                                <div class="col-md-11">
                                    <input id="total_canon_mensual" type="text" class="form-control{{ $errors->has('total_canon_mensual') ? ' error' : '' }}" name="total_canon_mensual" value="" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="6" data-max-length="30">
                                    <span id="error-total_canon_mensual" class="error-total_canon_mensual" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('total_canon_mensual'))
                                        <span class="text-danger">
                                            {{ $errors->first('total_canon_mensual') }}
                                        </span>
                                    @endif
                                </div>           
                            </div>

                            <div class="col-md-2">
                                <label for="estado" class="col-form-label">Estado</label>
                                <select id="estado" class="form-control{{ $errors->has('estado') ? ' error' : '' }}" name="estado" >
                                    <option value="">Seleccionar...</option>
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado->id }}">
                                            {{ $estado->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('estado'))
                                    <span class="text-danger">
                                        {{ $errors->first('estado') }}
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
                                        <th class="text-center">OBJETO DE CONTRATO</th>
                                        <th class="text-center">UBICACIÓN</th>
                                        <th class="text-center">SUPERFICIE</th>
                                        <th class="text-center">UNIDAD DE MEDIDA</th>
                                        <th class="text-center">PRECIO UNITARIO (BS)</th>
                                        <th class="text-center">TOTAL CANON MENSUAL</th>
                                        <th class="text-center">FECHA INICIAL</th>
                                        <th class="text-center">FECHA FINAL</th>
                                        <th class="text-center">CODIGO CONTRATO</th>
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
        $('#aeropuerto, #cliente, #estado').change(function() {
            actualizarReporte();
        });

        // Detecta la escritura en el campo CI/NIT y actualiza el reporte dinámicamente
        $('#total_canon_mensual').on('keyup', function() {
            const valor = $(this).val();
            if (valor.length >= 0 || valor.length === 0) 
                actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var aeropuerto = $('#aeropuerto').val();
            var cliente = $('#cliente').val();
            var totalCanonMensual = $('#total_canon_mensual').val();
            var estado = $('#estado').val();

            // Verifica que al menos un campo tenga valor
            if (aeropuerto || cliente || totalCanonMensual || estado) {
                $.ajax({
                    url: '{{ url("reportedetalleespacios/obtieneReporte/") }}',
                    method: 'get',
                    data: {'aeropuerto': aeropuerto, 'cliente': cliente, 'totalCanonMensual': totalCanonMensual,'estado': estado},
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
                        <td colspan="12" class="text-center">No existen datos para la consulta realizada</td>
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
                            <td class="text-center col-1">${item.cod_aeropuerto || ''}</td>
                            <td class="text-center col-1">${item.cliente || ''}</td>
                            <td class="text-center col-1">${item.objeto_contrato || ''}</td>
                            <td class="text-center col-1">${item.ubicacion || ''}</td>
                            <td class="text-center col-1">${item.superficie || ''}</td>
                            <td class="text-center col-1">${item.desc_unidad_medida || ''}</td>
                            <td class="text-center col-1">${item.precio_unitario || ''}</td>
                            <td class="text-center col-1">${item.total_canonmensual || ''}</td>
                            <td class="text-center col-1">${item.fecha_inicial || ''}</td>
                            <td class="text-center col-1">${item.fecha_final || ''}</td>
                            <td class="text-center col-1">${item.codigo_contrato || ''}</td>
                            <td class="text-center col-1">${item.estado || ''}</td>
                        </tr>
                    `;
                });
            } else {
                grillaHtml = `
                    <tr>
                        <td colspan="12" class="text-center">No existen datos para la consulta realizada</td>
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
        const totalCanonMensual = document.getElementById('total_canon_mensual').value;
        const estado = document.getElementById('estado').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reportedetalleespacios.show') }}" 
            : "{{ route('reportedetalleespacios.export') }}";

        url += `?aeropuerto=${aeropuerto}&cliente=${cliente}&totalCanonMensual=${totalCanonMensual}&estado=${estado}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }


</script>
@endsection