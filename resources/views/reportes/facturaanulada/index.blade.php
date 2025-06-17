@extends('layouts.app')
@section('titulo','Reporte de Facturas/Notas de Cobro')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte de Facturas Anuladas</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de Facturas Anuladas</li>
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
                    <h5 class="card-title">Reporte de Facturas Anuladas</h5>
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
                        
                            <div class="col-12 col-md-2">
                                <label for="tipo_factura" class="col-form-label">Tipo Factura <span class="text-danger">(*)</span></label>
                                <select id="tipo_factura" class="form-control" name="tipo_factura">
                                    <option value="">Seleccionar...</option>
                                    <option value="AL">ALQUILER</option>
                                    <option value="EX">EXPENSA</option>
                                    <option value="MOR">MORA</option>
                                    <option value="OTR">OTRO</option>
                                </select>
                            </div>
                        </div>                    
            
                        <div id="reporte_factura_anulada" class="table-responsive" style="display: none;"> 
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>                                    
                                        <th class="text-center">AEROPUERTO</th>
                                        <th class="text-center">CLIENTE</th>
                                        <th class="text-center">CODIGO CONTRATO</th>
                                        <th class="text-center">NUMERO NOTA DE COBRO</th>
                                        <th class="text-center">MES</th>                                        
                                        <th class="text-center">GESTIÓN</th>
                                        <th class="text-center">TIPO</th>
                                        <th class="text-center">MONTO TOTAL (BS)</th>
                                        <th class="text-center">NÚMERO FACTURA</th>
                                        <th class="text-center">FECHA EMISIÓN</th>
                                        <th class="text-center">ANULADO POR</th>
                                        <th class="text-center">FECHA ANULACIÓN</th>
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
        $('#aeropuerto, #cliente, #tipo').change(function() {
            actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var aeropuerto = $('#aeropuerto').val();
            var cliente = $('#cliente').val();
            var tipo_factura = $('#tipo_factura').val();

            // Verifica que al menos un campo tenga valor
            if (aeropuerto || cliente || tipo) {
                $.ajax({
                    url: '{{ url("reportefacturaanulada/obtieneReporte/") }}',
                    method: 'get',
                    data: {'aeropuerto': aeropuerto, 'cliente': cliente, 'tipo_factura': tipo_factura},
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
            document.getElementById('reporte_factura_anulada').style.display = 'block';
            let grillaHtml = '';

            if (data.length > 0) {
                data.forEach(function(item) {
                    grillaHtml += `
                        <tr>    
                            <td class="text-center">${item.codigo_aeropuerto || ''}</td>
                            <td class="text-center">${item.razon_social || ''}</td>
                            <td class="text-center">${item.codigo_contrato || ''}</td>
                            <td class="text-center">${item.numero_nota_cobro || ''}</td>
                            <td class="text-center">${item.mes || ''}</td>
                            <td class="text-center">${item.gestion || ''}</td>
                            <td class="text-center">${item.tipo_factura || ''}</td>
                            <td class="text-center">${item.monto_total || ''}</td>
                            <td class="text-center">${item.numero_factura || ''}</td>
                            <td class="text-center">${item.fecha_emision || ''}</td>
                            <td class="text-center">${item.usuario || ''}</td>
                            <td class="text-center">${item.fecha_anulacion || ''}</td>
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

    /*function generarReporte(tipo) {
        // Capturar valores seleccionados en los campos
        const aeropuerto = document.getElementById('aeropuerto').value;
        const cliente = document.getElementById('cliente').value;
        const gestion = document.getElementById('gestion').value;
        const mes = document.getElementById('mes').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reportefacturas.show') }}" 
            : "{{ route('reportefacturas.export') }}";

        url += `?aeropuerto=${aeropuerto}&cliente=${cliente}&gestion=${gestion}&mes=${mes}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }*/
</script>
@endsection