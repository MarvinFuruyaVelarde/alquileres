@extends('layouts.app')
@section('titulo','Editar Usuario')
@section('content')

<div class="pagetitle">
    <h1>Expensas</h1>
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
            <h5 class="card-title">Modificar datos de expensa</h5>
           <!--CONTENIDO -->
           {!! Form::model($expensa,['route'=>['expensas.update',$expensa->id],'method'=>'PUT']) !!}
                @include('parametricas.expensas._form',['texto' => 'Actualizar','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection