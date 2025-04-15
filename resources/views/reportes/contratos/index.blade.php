@extends('layouts.app')
@section('titulo','Reporte de Contratos')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Reporte de Contratos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de Contratos</li>
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
                    <h5 class="card-title">Reporte de Contratos</h5>
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
                                <label for="tipo_solicitante" class="col-form-label">Tipo Solicitante</label>
                                <select id="tipo_solicitante" class="form-control{{ $errors->has('tipo_solicitante') ? ' error' : '' }}" name="tipo_solicitante">
                                    <option value="">Seleccionar...</option>
                                    @foreach($tiposSolicitantes as $tiposSolicitante)
                                        <option value="{{ $tiposSolicitante->id }}">
                                            {{ $tiposSolicitante->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tipo_solicitante'))
                                    <span class="text-danger">
                                        {{ $errors->first('tipo_solicitante') }}
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
                                <label for="ci_nit" class="col-form-label">Ci/Nit</label>
                                <div class="col-md-11">
                                    <input id="ci_nit" type="text" class="form-control{{ $errors->has('ci_nit') ? ' error' : '' }}" name="ci_nit" value="" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="6" data-max-length="30">
                                    <span id="error-ci_nit" class="error-ci_nit" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('numero_identificacion'))
                                        <span class="text-danger">
                                            {{ $errors->first('numero_identificacion') }}
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
                                        <th class="text-center">CODIGO</th>
                                        <th class="text-center">COD. AEROPUERTO</th>
                                        <th class="text-center">CLIENTE</th>
                                        <th class="text-center">CANON TOTAL</th>
                                        <th class="text-center">REPRESENTANTE</th>
                                        <th class="text-center">TIPO SOLICITANTE</th>
                                        <th class="text-center">NIT/CI</th>
                                        <th class="text-center">DOMICILIO LEGAL</th>
                                        <th class="text-center">TELÉFONO/CELULAR</th>
                                        <th class="text-center">CORREO</th>
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
        $('#aeropuerto, #tipo_solicitante, #cliente, #estado').change(function() {
            actualizarReporte();
        });

        // Detecta la escritura en el campo CI/NIT y actualiza el reporte dinámicamente
        $('#ci_nit').on('keyup', function() {
            const valor = $(this).val();
            if (valor.length >= 3 || valor.length === 0) 
                actualizarReporte();
        });

        // Función para enviar los datos al servidor y mostrar los resultados
        function actualizarReporte() {
            var aeropuerto = $('#aeropuerto').val();
            var tipoSolicitante = $('#tipo_solicitante').val();
            var cliente = $('#cliente').val();
            var ciNit = $('#ci_nit').val();
            var estado = $('#estado').val();

            // Verifica que al menos un campo tenga valor
            if (aeropuerto || tipoSolicitante || cliente || ciNit || estado) {
                $.ajax({
                    url: '{{ url("reportecontratos/obtieneReporte/") }}',
                    method: 'get',
                    data: {'aeropuerto': aeropuerto, 'tipoSolicitante': tipoSolicitante, 'cliente': cliente, 'ciNit': ciNit,'estado': estado},
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
                            <td class="text-center col-3">${item.codigo || ''}</td>
                            <td class="text-center col-3">${item.cod_aeropuerto || ''}</td>
                            <td class="text-center col-3">${item.cliente_nombre || ''}</td>
                            <td class="text-center col-3">${item.canon_total || ''}</td>
                            <td class="text-center col-3">${item.representante || ''}</td>
                            <td class="text-center col-3">${item.desc_tipo_solicitante || ''}</td>
                            <td class="text-center col-3">${item.nit || item.ci || ''}</td>
                            <td class="text-center col-3">${item.domicilio_legal || ''}</td>
                            <td class="text-center col-3">${item.telefono_celular || ''}</td>
                            <td class="text-center col-3">${item.correo || ''}</td>
                            <td class="text-center col-3">${item.desc_estado || ''}</td>
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
        const tipoSolicitante = document.getElementById('tipo_solicitante').value;
        const cliente = document.getElementById('cliente').value;
        const ciNit = document.getElementById('ci_nit').value;
        const estado = document.getElementById('estado').value;

        // Crear la URL con los parámetros
        let url = tipo === 'pdf' 
            ? "{{ route('reportecontratos.show') }}" 
            : "{{ route('reportecontratos.export') }}";

        url += `?aeropuerto=${aeropuerto}&tipoSolicitante=${tipoSolicitante}&cliente=${cliente}&ciNit=${ciNit}&estado=${estado}`;

        // Redirigir a la URL generada
        window.open(url, tipo === 'pdf' ? '_blank' : '_self');
    }


</script>
@endsection