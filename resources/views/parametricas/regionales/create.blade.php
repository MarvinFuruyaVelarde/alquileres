
@extends('layouts.app')
@section('titulo','Nuevo Usuario')
@section('content')

<div class="pagetitle">
    <h1>REGIONALES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('regionales.index') }}">Regionales</a></li>
        <li class="breadcrumb-item active">Nueva Regional</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Regional</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'regionales.store','class'=>'form-horizontal','id'=>'form_reg_regional','data-form-id'=>'form_reg_regional']) !!}
                @include('parametricas.regionales._form',['texto' => 'Guardar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/validarcampos.js') }}" type="text/javascript"></script>
@endsection
