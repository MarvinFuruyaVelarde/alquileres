@extends('layouts.app')
@section('titulo','Reporte de Registro de Pagos')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte de Registro de Pagos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de Registro de Pagos</li>
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
                    <h5 class="card-title">Reporte de Registro de Pagos</h5>
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
                                        <th class="text-center">COD. AEROPUERTO</th>
                                        <th class="text-center">CLIENTE</th>
                                        <th class="text-center">CI/NIT</th>
                                        <th class="text-center">GESTIÓN</th>
                                        <th class="text-center">MES</th>
                                        <th class="text-center">FECHA NOTA COBRO</th>
                                        <th class="text-center">NÚMERO NOTA COBRO</th>
                                        <th class="text-center">FECHA EMISIÓN FACTURA</th>
                                        <th class="text-center">NÚMERO FACTURA</th>
                                        <th class="text-center">TIPO</th>
                                        <th class="text-center">MONTO FACTURA (BS.)</th>
                                        <th class="text-center">PAGADO (BS.)</th>
                                        <th class="text-center">SALDO (BS.)</th>
                                        <th class="text-center">FECHA DE PAGO</th>
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
        $('#aeropuerto, #cliente, #gestion, #mes').change(function() {
            actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var aeropuerto = $('#aeropuerto').val();
            var cliente = $('#cliente').val();
            var gestion = $('#gestion').val();
            var mes = $('#mes').val();

            // Verifica que al menos un campo tenga valor
            if (aeropuerto || cliente || gestion || mes) {
                $.ajax({
                    url: '{{ url("reporteregistropagos/obtieneReporte/") }}',
                    method: 'get',
                    data: {'aeropuerto': aeropuerto, 'cliente': cliente, 'gestion': gestion, 'mes': mes},
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
                        <td colspan="14" class="text-center">No existen datos para la consulta realizada</td>
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
                            <td class="text-center">${item.aeropuerto || ''}</td>
                            <td class="text-center">${item.cliente || ''}</td>
                            <td class="text-center">${item.ci || item.nit || ''}</td>
                            <td class="text-center">${item.gestion || ''}</td>
                            <td class="text-center">${item.mes_literal || ''}</td>
                            <td class="text-center">${item.fecha_nota_cobro || ''}</td>
                            <td class="text-center">${item.numero_nota_cobro || ''}</td>
                            <td class="text-center">${item.fecha_emision_factura || ''}</td>
                            <td class="text-center">${item.numero_factura || ''}</td>
                            <td class="text-center">${item.tipo || ''}</td>
                            <td class="text-center">${item.monto_factura || ''}</td>
                            <td class="text-center">${item.pagado || ''}</td>
                            <td class="text-center">${item.saldo || ''}</td>
                            <td class="text-center">${item.fecha_pago || ''}</td>
                        </tr>
                    `;
                });
            } else {
                grillaHtml = `
                    <tr>
                        <td colspan="14" class="text-center">No existen datos para la consulta realizada</td>
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
        const gestion = document.getElementById('gestion').value;
        const mes = document.getElementById('mes').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reporteregistropagos.show') }}" 
            : "{{ route('reporteregistropagos.export') }}";

        url += `?aeropuerto=${aeropuerto}&cliente=${cliente}&gestion=${gestion}&mes=${mes}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }


</script>
@endsection