@extends('layouts.app')

@section('titulo','Declaración Jura')

@section('content')

<div class="pagetitle">
    <h1>Declaración Jurada</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Declaración</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Agregar documento</h5>
           <!--CONTENIDO -->
           <h6  class="mt-0 text-right">{{ $empleado->nombres }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</h6>
           <hr >
           <form action="{{route('declaraciones.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
           
              <div class="row mb-1">
                  <label for="nombre" class="col-md-4 col-form-label">Seleccionar Archivo de declaración: <span class="text-danger">(*)</span></label>
                  <div class="col-md-6">
                    <input type="file" name="nombre" id=""   accept="application/pdf" required>
                      @if ($errors->has('nombre'))
                          <span class="text-danger">
                              {{ $errors->first('nombre') }}
                          </span>
                          
                      @endif
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  {{Form::label('codigo','Número De Certificado De D.J.B.R')}} <span class="text-danger">(*)</span>
                      <input id="codigo" type="text" class="form-control {{ $errors->has('codigo') ? ' error' : '' }}" name="codigo" maxlength="8" value="{{ old('codigo') }}"  required onkeydown="javascript: return event.keyCode === 8 ||
                      event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                      @if ($errors->has('codigo'))
                          <span class="text-danger">
                              {{ $errors->first('codigo') }}
                          </span>
                      @endif
                </div>
                <div class="col-lg-4">
                  {{Form::label('tipo','Tipo Declaración' )}} <span class="text-danger">(*)</span>
                  <select name="tipo" class="form-control" required>
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1">Por Asumir</option>
                    <option value="2" >Por Actualización</option>
                    <option value="3">Después Del Ejercicio Del Cargo</option>
                  </select>
              </div>

              </div>
              <br>
              <div class="row">
                <div class="col-lg-4">
                  {{Form::label('fecha_certificacion','Fecha De Certificación')}} <span class="text-danger">(*)</span>
                      <input id="fecha_certificacion" type="date" class="form-control {{ $errors->has('fecha_certificacion') ? ' error' : '' }}" name="fecha_certificacion" value="{{ old('fecha_certificacion') }}"  required >
                      @if ($errors->has('fecha_certificacion'))
                          <span class="text-danger">
                              {{ $errors->first('fecha_certificacion') }}
                          </span>
                      @endif
                </div>
                <div class="col-lg-6">
                  {{Form::label('fecha_presentacion','Fecha De Presentacion A Recursos Humanos')}} <span class="text-danger">(*)</span>
                  <input id="fecha_presentacion" type="date" class="form-control {{ $errors->has('fecha_presentacion') ? ' error' : '' }}" name="fecha_presentacion"  value="{{ old('fecha_presentacion') }}"  required >
                  @if ($errors->has('fecha_presentacion'))
                      <span class="text-danger">
                          {{ $errors->first('fecha_presentacion') }}
                      </span>
                  @endif
              </div>

              </div>

                  

            
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('declaraciones.index') }}" class="btn btn-warning">Salir</a>
            </div>
         </form>
         <br>
         @if(count($declaraciones)>0)
         <div class="d-flex align-items-center justify-content-between">
           <h4>Declaraciones registradas</h4>
           @if(count($declaraciones)>0)
            <a href="{{ route('declaraciones.show', $empleado->id) }}" class="btn btn-primary" target="_blank">Ver Todos</a>
           @endif
         </div>
            <table class="table table-hover table-bordered table-sm table-responsive">
            <tr>
              <th class="text-center">Nombre documento</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Fecha registro</th>
              <th class="text-center">Opciones</th>
            </tr>
            @foreach ($declaraciones as  $key=>$document)
              <tr>
                <td>{{ $key+1 }}. {{ $document->nombre }}</td>
                @php
                switch ($document->tipo) {
                        case "1":
                        $tipo="Por Asumir";
                        break;
                        case "2":
                        $tipo="Por Actualización";
                        break;
                        case "3":
                        $tipo="Después Del Ejercicio Del Cargo";
                        break;
                }
                @endphp
                <td>{{ $tipo }}</td>
                <td class="text-center">{{ date('d-m-Y',strtotime($document->created_at)) }}</td>
                <td class="d-flex align-items-center justify-content-center">
                  <a href="{{ asset('declaraciones_juradas/'.$document->nombre)}}" target="_blank"> <button class="btn btn-success" title="Ver documento"><i class="bi bi-file-earmark-pdf"></i></button></a>
                  @can('declaraciones.destroy')
                  {!! Form::open(['route'=>['declaraciones.destroy',$document->id],'method'=>'DELETE']) !!}
                      <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar la DDJJ?');"><i class="bi bi-trash"></i></button>
                  {!! Form::close() !!}
                  @endcan
</td>
              </tr>
            @endforeach
          </table>
        @endif
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endSection