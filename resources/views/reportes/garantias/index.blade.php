@extends('layouts.app')
@section('titulo','Reporte de Garantias')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte de Garantias</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de Garantias</li>
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
                    <h5 class="card-title">Reporte de Garantias</h5>
                    <form {{--action="{{route('notacobro.aprobarNotaCobro')}}" method="POST"--}}>
                        @csrf
                        <div class="row mb-5 align-items-center">

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

                        </div>                    
            
                        <div id="reporte_contrato" class="table-responsive" style="display: none;"> 
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">COD. AEROPUERTO</th>
                                        <th class="text-center">CLIENTE</th>
                                        <th class="text-center">CÓDIGO CONTRATO</th>
                                        <th class="text-center">GARANTIA</th>
                                        <th class="text-center">PAGADO</th>
                                        <th class="text-center">SALDO</th>
                                        <th class="text-center">FECHA DEPOSITO</th>
                                        <th class="text-center">CUENTA</th>
                                        <th class="text-center">NRO. CUENTA</th>
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
        $('#cliente').change(function() {
            actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var cliente = $('#cliente').val();

            // Verifica que al menos un campo tenga valor
            if (cliente) {
                $.ajax({
                    url: '{{ url("reportegarantias/obtieneReporte/") }}',
                    method: 'get',
                    data: {'cliente': cliente},
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
                            <td class="text-center col-1">${item.cod_aeropuerto || ''}</td>
                            <td class="text-center col-3">${item.cliente || ''}</td>
                            <td class="text-center col-2">${item.codigo_contrato || ''}</td>
                            <td class="text-center col-1">${item.garantia || ''}</td>
                            <td class="text-center col-1">${item.pagado || ''}</td>
                            <td class="text-center col-1">${item.saldo || ''}</td>
                            <td class="text-center col-1">${item.fecha_deposito || ''}</td>
                            <td class="text-center col-3">${item.cuenta || ''}</td>
                            <td class="text-center col-1">${item.numero_cuenta || ''}</td>
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
        const cliente = document.getElementById('cliente').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reportegarantias.show') }}" 
            : "{{ route('reportegarantias.export') }}";

        url += `?cliente=${cliente}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }
</script>
@endsection