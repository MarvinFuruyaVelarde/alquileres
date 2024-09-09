@extends('layouts.app')
@section('titulo','Editar Tipo de Pago')
@section('content')

<div class="pagetitle">
    <h1>Tipos de Pago</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos de tipo de pago</h5>
           <!--CONTENIDO -->
           {!! Form::model($tipopago,['route'=>['tipospago.update',$tipopago->id],'method'=>'PUT']) !!}
                @include('parametricas.tipospago._form',['texto' => 'Actualizar','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection