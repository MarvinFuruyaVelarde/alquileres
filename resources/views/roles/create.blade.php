@extends('layouts.app')
@section('titulo','Nuevo Rol')
@section('content')
<div class="pagetitle">
    <h1>Roles</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active"></li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
      {!! Form::open(['route'=>'roles.store','class'=>'forms-sample']) !!}
      @include('roles._form')
      
      {!! Form::close() !!}
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








