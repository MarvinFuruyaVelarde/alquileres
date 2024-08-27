@extends('layouts.app')
@section('titulo','Documentacion')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Documentacion</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Documentacion</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Empleados Registrados con Documentación</h5>
            
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">CI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documentos as $e)
                            <tr>
                                <td>{{$e->empleado->nombres}} {{ $e->empleado->ap_paterno }} {{ $e->empleado->ap_materno }}</td>
                                <td class="text-center">{{$e->empleado->ci}} @if($e->empleado->ci_complemento != null) - {{ $e->empleado->ci_complemento }} @endif {{ $e->empleado->ci_lugar }}</td>
                                <td class="text-center">{{$e->empleado->cargo[0]->nombre}} <small>({{ $e->empleado->cargo[0]->tipo_cargo }})</small></td>
                               <td class="text-center">
                                @can('documentos.show')
                                        <a href="{{route('documentos.show',$e->id)}}" class="btn btn-info" title="Ver File Personal" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                    @endcan
                               </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/tablas/basica.js') }}" type="text/javascript"></script>
@endsection
