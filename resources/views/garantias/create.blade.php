
@extends('layouts.app')
@section('titulo','Nuevo Cliente')
@section('content')

<div class="pagetitle">
    <h1>GARANTÍA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('garantias.index') }}">Garantías</a></li>
        <li class="breadcrumb-item active">Registro de Garantía</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Registro de Garantía</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>['garantias.store'],'class'=>'form-horizontal']) !!}
                @include('garantias._form',['texto' => 'Guardar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

