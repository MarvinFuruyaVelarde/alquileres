
@extends('layouts.app')
@section('titulo','Nuevo Cliente')
@section('content')

<div class="pagetitle">
    <h1>CLIENTES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="breadcrumb-item active">Nuevo Cliente</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Cliente</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'clientes.store','class'=>'form-horizontal','id'=>'form_reg_cliente','data-form-id'=>'form_reg_cliente']) !!}
                @include('parametricas.clientes._form',['texto' => 'Guardar','color'=>'primary'])
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
