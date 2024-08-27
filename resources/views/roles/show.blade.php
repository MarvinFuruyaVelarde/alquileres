@extends('layouts.app')
@section('titulo','Permisos de Rol')
@section('content')
<div class="pagetitle">
    <h1>Permisos de Accesso</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Permisos del rol</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Permisos habilitados</h5>
           <!--CONTENIDO -->
           <label for=""><strong>{{$role->name}}</strong></label>
           <div class="table-responsive">
            <table class="table table-bordered">
                @foreach ($permissions as $permission)
                    <tr>
                        <td><strong>{{$permission->descripcion ?: 'Sin descripción'}}</strong>
                            <em>({{$permission->name}})</em></td>
                    </tr>
                @endforeach
            </table>
           </div>
 
        <a href="javascript:history.back()" class="btn btn-warning btn-rounded">Volver</a>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>


@endsection