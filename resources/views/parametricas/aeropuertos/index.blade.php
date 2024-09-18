@extends('layouts.app')
@section('titulo','Usuarios')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Aeropuertos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Aeropuertos</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            @can('aeropuertos.show')
                <a href="{{route('aeropuertos.show')}}" class="btn btn-danger bi-file-earmark-pdf" title="Generar reporte pdf" target="_blank">PDF</a>
            @endcan

            @can('rubros.show')
                <a href="{{route('aeropuertos.export')}}" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel">EXCEL</a>
             @endcan
        </div>
        @can('aeropuertos.create')
            <a href="{{route('aeropuertos.create')}}" class="btn btn-primary" title="Crea un nuevo aeropuerto"> <i class="bi bi-plus"></i> Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Aeropuertos Registrados</h5>
            <p>Cada registro tiene la opción de editar <i class="btn btn-warning bi bi-pencil-square"></i> y eliminar <i class=" btn btn-danger bi bi-trash"></i> un Aeropuerto.</p>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">CÓDIGO</th>
                            <th class="text-center">AEROPUERTO</th>
                            <th class="text-center">REGIONAL</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aeropuertos as $aeropuerto)

                            <tr>
                                <td class="text-center">{{$aeropuerto->codigo}}</td>
                                <td class="text-center">{{$aeropuerto->descripcion}}</td>
                                <td class="text-center">{{$aeropuerto->desc_regional}}</td>
                                <td class="text-center">{{$aeropuerto->desc_estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('aeropuertos.edit')
                                        <a href="{{route('aeropuertos.edit',$aeropuerto)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('aeropuertos.destroy')
                                        <form action="{{ route('aeropuertos.destroy', $aeropuerto->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar el AEROPUERTO?');"><i class="bi bi-trash"></i>
                                            </button>
                                        </form>
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