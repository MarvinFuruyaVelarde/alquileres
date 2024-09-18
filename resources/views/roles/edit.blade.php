@extends('layouts.app')
@section('titulo','Modificar Rol')
@section('content')
<div class="pagetitle">
    <h1>Roles</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Modificar Rol</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar permisos del Rol</h5>
           <!--CONTENIDO -->
           {!! Form::model($role,['route'=>['roles.update',$role->id],'method'=>'PUT']) !!}
                @include('roles._form')
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
