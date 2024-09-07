
@extends('layouts.app')
@section('titulo','Nuevo Rubro')
@section('content')

<div class="pagetitle">
    <h1>RUBRO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('expensas.index') }}">Rubros</a></li>
        <li class="breadcrumb-item active">Nuevo Rubro</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Rubro</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'rubros.store','class'=>'form-horizontal']) !!}
                @include('parametricas.rubros._form',['texto' => 'Guardar','color'=>'primary'])
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
