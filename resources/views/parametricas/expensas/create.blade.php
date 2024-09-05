
@extends('layouts.app')
@section('titulo','Nuevo Usuario')
@section('content')

<div class="pagetitle">
    <h1>EXPENSAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('expensas.index') }}">Expensas</a></li>
        <li class="breadcrumb-item active">Nueva Expensa</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Expensa</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'expensas.store','class'=>'form-horizontal']) !!}
                @include('parametricas.expensas._form',['texto' => 'Guardar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/forms/validacion_rol.js') }}" type="text/javascript"></script>
@endsection
