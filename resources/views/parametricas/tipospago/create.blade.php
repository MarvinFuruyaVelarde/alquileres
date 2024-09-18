
@extends('layouts.app')
@section('titulo','Nuevo Tipo de Pago')
@section('content')

<div class="pagetitle">
    <h1>TIPOS DE PAGO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('tipospago.index') }}">Tipos de Pago</a></li>
        <li class="breadcrumb-item active">Nuevo Tipo de Pago</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Tipo de Pago</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'tipospago.store','class'=>'form-horizontal','id'=>'form_reg_tipopago','data-form-id'=>'form_reg_tipopago']) !!}
                @include('parametricas.tipospago._form',['texto' => 'Guardar','color'=>'primary'])
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
