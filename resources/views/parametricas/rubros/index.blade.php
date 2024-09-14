@extends('layouts.app')
@section('titulo','Rubros')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Rubros</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Rubros</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            @can('rubros.show')
                <a href="{{route('rubros.show')}}" class="btn btn-danger bi-file-earmark-pdf" title="Generar reporte pdf"></a>
            @endcan
    
            @can('rubros.export')
                <a href="{{route('rubros.export')}}" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel"></a>
            @endcan
        </div>
        @can('rubros.create')
            <a href="{{route('rubros.create')}}" class="btn btn-primary" title="Crea un nuevo rubro">Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Rubros Registrados</h5>
            
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
                        @foreach($rubros as $rubro)

                            <tr>
                                <td class="text-center">{{$rubro->descripcion}}</td>
                                <td class="text-center">{{$rubro->desc_estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('rubros.edit')
                                        <a href="{{route('rubros.edit',$rubro)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('rubros.destroy')
                                        <form action="{{ route('rubros.destroy', $rubro->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar el RUBRO?');"><i class="bi bi-trash"></i>
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