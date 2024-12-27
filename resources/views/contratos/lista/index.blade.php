@extends('layouts.app')
@section('titulo','Lista Contratos')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Lista Contratos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Lista Contratos</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            {{--@can('contratos.show')
                <a href="{{route('expensas.show')}}" class="btn btn-danger bi-file-earmark-pdf" title="Generar reporte pdf"  target="_blank">PDF</a>
            @endcan

            @can('contratos.show')
                <a href="{{route('expensas.export')}}" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel" >EXCEL</a>
             @endcan--}}
        </div>
        @can('contratos.create')
            <a href="{{route('contratos.create')}}" class="btn btn-primary" title="Crea un nuevo contrato"> <i class="bi bi-plus"></i> Registrar </a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Contratos Registrados</h5>
            <p>Cada registro tiene la opción de editar <i class="btn btn-warning bi bi-pencil-square"></i> y eliminar <i class=" btn btn-danger bi bi-trash"></i> un Contrato.</p>

           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">AEROPUERTO</th>
                            <th class="text-center">COD. CONTRATO</th>
                            <th class="text-center">NOMBRE CLIENTE</th>
                            <th class="text-center">REPRESENTANTE</th>
                            <th class="text-center">NIT/CI</th>
                            <th class="text-center">TELEFONO/CELULAR</th>
                            <th class="text-center">CORREO</th>
                            <th class="text-center">DOMICILIO LEGAL</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contratos as $contrato)

                            <tr>
                                <td class="text-center">{{$contrato->codigo_aeropuerto}}</td>
                                <td class="text-center">{{$contrato->codigo_contrato}}</td>
                                <td class="text-center">{{$contrato->nombre_cliente}}</td>
                                <td class="text-center">{{$contrato->representante}}</td>
                                <td class="text-center">{{$contrato->nit_ci}}</td>
                                <td class="text-center">{{$contrato->telefono_celular}}</td>
                                <td class="text-center">{{$contrato->correo}}</td>
                                <td class="text-center">{{$contrato->domicilio_legal}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('contratos.edit')
                                        <a href="{{route('contratos.edit',$contrato)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('contratos.destroy')
                                        <form action="{{ route('contratos.destroy', $contrato->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar el CONTRATO?');"><i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                    @can('contratos.create_espacio')
                                        <a href="{{route('contratos.create_espacio',$contrato)}}" class="btn btn-dark" title="Registrar Espacio"><i class="bi bi-layout-text-sidebar"></i></a>
                                    @endcan
                                    @can('contratos.send')
                                        @if($contrato->numero_espacio > 0)
                                            <form action="{{ route('contratos.send', $contrato) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary" title="Enviar Contrato para Aprobar" onclick="return confirm('¿Está seguro que desea enviar el CONTRATO para Aprobar?');"><i class="bi bi-send"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection