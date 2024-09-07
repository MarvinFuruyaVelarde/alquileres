@extends('layouts.app')
@section('titulo','Unidades de Medida')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Unidades de Medida</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Unidades de Medida</li>
        </ol>
        </nav>
        @can('unidadesmedida.create')
            <a href="{{route('unidadesmedida.create')}}" class="btn btn-primary" title="Crea una nueva unidad de medida">Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Unidades de Medida Registradas</h5>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unidadesmedida as $unidadmedida)

                            <tr>
                                <td class="text-center">{{$unidadmedida->descripcion}}</td>
                                <td class="text-center">{{$unidadmedida->desc_estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('unidadesmedida.edit')
                                        <a href="{{route('unidadesmedida.edit',$unidadmedida)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('unidadesmedida.destroy')
                                        <form action="{{ route('unidadesmedida.destroy', $unidadmedida->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar la UNIDAD DE MEDIDA?');"><i class="bi bi-trash"></i>
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