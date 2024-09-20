
@extends('layouts.app')
@section('titulo','Nueva Cuenta')
@section('content')

<div class="pagetitle">
    <h1>CUENTAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cuentas.index') }}">Cuentas</a></li>
        <li class="breadcrumb-item active">Nueva Cuenta</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Cuenta</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'cuentas.store','class'=>'form-horizontal','id'=>'form_reg_cuenta','data-form-id'=>'form_reg_cuenta']) !!}
                @include('parametricas.cuentas._form',['texto' => 'Guardar','color'=>'primary'])
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
