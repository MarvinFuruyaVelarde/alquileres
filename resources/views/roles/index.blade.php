@extends('layouts.app')
@section('titulo','Roles Sistema')
@section('content')
<div class="pagetitle">
    <h1>Roles de Acceso</h1>
    <div class="d-flex flex-row align-items-center justify-content-between mr-5">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
        </nav>
        @can('roles.create')
            <a href="{{route('roles.create')}}" class="btn btn-primary" title="Crea un nuevo rol con sus permisos"> <i class="bi bi-plus"></i> Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            
            <h5 class="card-title">Roles de acceso registrados</h5>
                
           <!--CONTENIDO -->
           <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ROL</th>
                        <th class="text-center ">DESCRIPCIÓN</th>
                        <th class="text-center ">NRO. USUARIO(S) <br> CON EL ROL</th>
                        <th class="text-center" >OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="text-center fw-bold">{{$role->name}}</td>
                            <td class="text-center text-wrap">{{$role->descripcion}}</td>
                            <td class="text-center text-wrap"><h5><span class="badge bg-primary">{{$role->users_count}} Usuarios</span></h5></td>
                            <td class="d-flex justify-content-center" >
                                @can('roles.show')
                                    <a href="{{route('roles.show',$role->id)}}" class="btn btn-info" title="Ver los permisos asignados al rol"><i class="bi bi-eye"></i></a>
                                @endcan
                                @can('roles.edit')
                                    <a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning"title="Modificar Permisos asignados al rol" ><i class="bi bi-pencil"></i></a>
                                @endcan
                                @can('roles.destroy')
                                    {!! Form::open(['route'=>['roles.destroy',$role->id],'method'=>'DELETE']) !!}
                                        <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar el ROL?');"><i class="bi bi-trash"></i></button>
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>


@endsection
@section('scripts')
<script src="{{ asset('js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection