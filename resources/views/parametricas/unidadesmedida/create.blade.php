
@extends('layouts.app')
@section('titulo','Nueva Unidad de Medida')
@section('content')

<div class="pagetitle">
    <h1>UNIDAD DE MEDIDA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('unidadesmedida.index') }}">Unidades de Medida</a></li>
        <li class="breadcrumb-item active">Nueva Unidad de Medida</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Unidad de Medida</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'unidadesmedida.store','class'=>'form-horizontal','id'=>'form_reg_unidadmedida','data-form-id'=>'form_reg_unidadmedida']) !!}
                @include('parametricas.unidadesmedida._form',['texto' => 'Guardar','color'=>'primary'])
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
