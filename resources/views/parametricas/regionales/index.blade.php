@extends('layouts.app')
@section('titulo','Usuarios')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Regionales</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Regionales</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            @can('regionales.show')
                <a href="{{route('regionales.show')}}" class="btn btn-danger bi-file-earmark-pdf" title="Generar reporte pdf"></a>
            @endcan

            @can('formaspago.export')
                <a href="{{route('regionales.export')}}" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel"></a>
             @endcan
        </div>
        @can('regionales.create')
            <a href="{{route('regionales.create')}}" class="btn btn-primary" title="Crea una nueva regional">Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Regionales Registradas</h5>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">CÓDIGO</th>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($regionales as $regional)

                            <tr>
                                <td class="text-center">{{$regional->codigo}}</td>
                                <td class="text-center">{{$regional->descripcion}}</td>
                                <td class="text-center">{{$regional->desc_estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('regionales.edit')
                                        <a href="{{route('regionales.edit',$regional)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('regionales.destroy')
                                        <form action="{{ route('regionales.destroy', $regional->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar la REGIONAL?');"><i class="bi bi-trash"></i>
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