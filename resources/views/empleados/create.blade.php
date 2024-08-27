
@extends('layouts.app')
@section('titulo','Nuevo Empleado')
@section('content')

<div class="pagetitle">
    <h1>ADMINISTRACIÓN PERSONAL</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}">Empleados</a></li>
        <li class="breadcrumb-item active">Nuevo Empleado</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Empleado</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'empleados.store','class'=>'row g-3','enctype'=>"multipart/form-data"]) !!}
                @include('empleados._form',['texto' => 'Registrar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@include('empleados.modals._modal_instituto')
@include('empleados.modals._modal_profesion')
@include('empleados.modals._modal_formacion')
@include('empleados.modals._modal_cargo')
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/empleadosControlCampos.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregarCargo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaInstitucionFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaProfesion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/agregaFormacion.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/forms/mostrarSugerenciaParentesco.js') }}" type="text/javascript"></script>
@endsection
