@extends('layouts.app')
@section('titulo','Declaracion Jurada')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Declaraciones Juradas</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active"> Declaraciones Juradas</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Agregar documento de Declaracion Jurada</h5>
            <p>Ingresar el nombre, apellidos o carnet de identidad para buscar al empleado.</p>
            <form action="{{route('buscar_empleados')}}" method="post">
                @csrf
                <div class="row">
                    <label for="nombre" class="col-md-4 col-control label text-right">Nombre Empleado</label>
                    <div class="col-lg-8">
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ci" class="col-md-4 col-control label text-right">C.I.</label>
                    <div class="col-lg-8">
                        <input type="text" name="ci" id="ci" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        <a href="{{ route('declaraciones.index') }}" class="btn btn-warning">Salir</a>
                    </div>
                </div>
            </form>
           @if ($empleados != null)
               <h6>Empleado(s) que coinciden con la busqueda</h6>
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
                            <td class="text-center">
                                <strong>{{$e->cargo}}</strong>
                                 </td>
                                 <td class="d-flex justify-content-center" >
                                    @can('declaraciones.create')
                                        <a href="{{route('declaraciones.create',$e->id)}}" class="btn btn-warning" title="Ver / Registrar un DDJJ"><i class="bi bi-cloud-upload"></i></a>
                                    @endcan
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           @endif
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection