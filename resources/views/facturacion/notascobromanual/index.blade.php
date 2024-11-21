@extends('layouts.app')
@section('titulo','Notas de Cobro Manual')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Notas de Cobro Manual</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Notas de Cobro Manual</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
        </div>
        @can('notacobromanual.create')
            <a href="{{route('notacobromanual.create')}}" class="btn btn-primary" title="Crea una nueva expensa"> <i class="bi bi-plus"></i> Registrar </a>
        @endcan
    </div>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Notas de Cobro Manual</h5>
                    <form action="{{route('notacobromanual.aprobarNotaCobroManual')}}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0 me-auto">Cada registro tiene la opción de visualizar <i class="btn btn-danger bi-file-earmark-pdf"></i> y editar <i class="btn btn-warning bi bi-pencil-square"></i> una Nota de Cobro Manual.</p>
                            <button id="aprobar" type="submit" class="btn btn-success" disabled>APROBAR</button>
                        </div>
                    
                        <!--CONTENIDO -->
                        <div class="table-responsive">
                            <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">NÚMERO NOTA DE COBRO</th>
                                        <th class="text-center">NOMBRE CLIENTE</th>
                                        <th class="text-center">TIPO</th>
                                        <th class="text-center">OPCIONES</th>
                                        <th class="text-center"><input type="checkbox" id="check-all" class="form-check-input" title="Seleccionar/Deseleccionar nota(s) de cobro"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notasCobroManual as $notaCobroManual)
                                        <tr>
                                            <td class="text-center">{{$notaCobroManual->numero_nota_cobro}}</td>
                                            <td class="text-center">{{$notaCobroManual->razon_social}}</td>
                                            <td class="text-center">{{$notaCobroManual->tipo}}</td>
                                            <td class="d-flex justify-content-center" >
                                                @can('notacobromanual.show')
                                                    <a href="{{route('notacobro.show', $notaCobroManual->id)}}" class='btn btn-danger bi-file-earmark-pdf' title='Visualizar nota de cobro' target='_blank'></a>
                                                @endcan
                                                @can('notacobromanual.edit')
                                                    <a href="{{route('notacobromanual.edit',$notaCobroManual->id)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                                @endcan
                                            </td>
                                            <td class='text-center'><input type='checkbox' name='aprobado[]' value='{{$notaCobroManual->id}}' class='form-check-input' title='Aprobar nota de cobro'></td>
                                        </tr>
                                    @endforeach
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