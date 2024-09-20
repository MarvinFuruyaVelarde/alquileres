@extends('layouts.app')
@section('titulo','Editar Usuario')
@section('content')

<div class="pagetitle">
    <h1>Usuarios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos del usuario</h5>
           <!--CONTENIDO -->
           {!! Form::model($user,['route'=>['users.update',$user->id],'method'=>'PUT']) !!}
                @include('users._form',['texto' => 'Actualizar','tipo'=>'2','texto_pass'=>'Cambiar Contraseña','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
@section('scripts')
<script>
  $(document).ready(function() {
      $('.marcar-todos').click(function() {
          var grupoId = $(this).data('grupo');
          var checked = $(this).prop('checked');
          $('input[type="checkbox"][data-grupo="' + grupoId + '"]').prop('checked', checked);
      });
  });
</script>
@endsection


