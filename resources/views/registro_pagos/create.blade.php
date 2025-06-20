
@extends('layouts.app')
@section('titulo','registro pagos')
@section('content')

<div class="pagetitle">
    <h1>REGISTRO DE PAGOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('registropagos.index') }}">Registro de Pagos</a></li>
        <li class="breadcrumb-item active">Registro de Pagos</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Registro de Pagos</h5>
          <!--CONTENIDO -->
          {!! Form::open(['route'=>['registropagos.store'],'class'=>'form-horizontal']) !!}
              @include('registro_pagos._form',['texto' => 'Guardar','color'=>'primary'])
          {!! Form::close() !!}
          <!-- EndCONTENIDO Example -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

