@extends('layouts.app')
@section('titulo','Empleados')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Empleados</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Empleados</li>
        </ol>
        </nav>
        @can('empleados.create')
            <a href="{{route('empleados.create')}}" class="btn btn-primary" title="Crea un nuevo rol con sus permisos">Agregar Nuevo</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados</h5>
            
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $e)
                            <tr>
                                <td>{{$e->nombres}} {{ $e->ap_paterno }} {{ $e->ap_materno }}</td>
                                <td class="text-center">{{$e->ci}} @if($e->ci_complemento != null) - {{ $e->ci_complemento }} @endif {{ $e->ci_lugar }}</td>
                                <td class="text-center">@foreach ($e->cargo as $c )
                                    <strong>{{$c->nombre}} <br> <small>({{ $c->tipo_cargo  }})</small></strong>
                                    @endforeach </td>
                                    
                                <td class="d-flex justify-content-center" >
                                    @can('empleados.edit')
                                        <a href="{{route('empleados.edit',$e->id)}}" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('empleados.show')
                                    <a href="{{route('empleados.show',$e->id)}}" class="btn btn-info" title="Ver ficha" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                    @endcan
                                    @can('empleados.create')
                                    <a href="{{route('empleados.ficha',$e->id)}}" class="btn btn-success" title="Subir ficha de personal firmado"><i class="bi bi-vector-pen"></i></a>
                                    @endcan
                                    @can('empleados.destroy')
                                    {!! Form::open(['route'=>['empleados.destroy',$e->id],'method'=>'DELETE']) !!}
                                        <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar al empleado?');"><i class="bi bi-trash"></i></button>
                                    {!! Form::close() !!}
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
