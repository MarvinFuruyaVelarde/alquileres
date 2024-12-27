@extends('layouts.app')
@section('titulo','Usuarios')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Usuarios</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
        </ol>
        </nav>
        @can('users.create')
            <a href="{{route('users.create')}}" class="btn btn-primary" title="Crea un nuevo rol con sus permisos"> <i class="bi bi-plus"></i> Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Usuarios Registrados</h5>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">NOMBRE COMPLETO</th>
                            <th class="text-center">CORREO</th>
                            <th class="text-center">ROL ASIGNADO</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)

                            <tr>
                                <td class="text-center">{{$user->name}} {{$user->segundo_nombre}} {{$user->apellido_paterno}} {{$user->apellido_materno}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">
                                    @foreach ($user->roles as $rol )
                                    <strong>{{$rol->name}}</strong>
                                    @endforeach
                                </td>
                                <td class="d-flex justify-content-center" >
                                    @can('users.edit')
                                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning" title="Modificar datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('users.destroy')
                                        <a href="{{route('users.destroy',$user->id)}}" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar al USUARIO?');" ><i class="bi bi-trash"></i></a>
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
