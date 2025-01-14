@extends('layouts.app')
@section('titulo','garantias')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Lista de Garantías</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Garantia</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
           
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Garantías Registradas</h5>
            <p>Cada registro tiene la opción de editar <i class="btn btn-warning bi bi-pencil-square"></i> la garantía de un Cliente.</p>
            
           <!--CONTENIDO -->
           <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">CLIENTE</th>
                            <th class="text-center">CÓDIGO CONTRATO</th>
                            <th class="text-center">GARANTÍA</th>
                            <th class="text-center">PAGADO</th>
                            <th class="text-center">SALDO</th> 
                            <th class="text-center">OPCIONES</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($garantias as $garantia)

                            <tr>
                                <td class="text-center">{{$garantia->razon_social}}</td>
                                <td class="text-center">{{$garantia->contrato}}</td>
                                <td class="text-center">{{$garantia->garantia}}</td>
                                <td class="text-center">{{$garantia->pagado}}</td>
                                <td class="text-center">{{$garantia->saldo}}</td>
                                <td class="d-flex justify-content-center" > 
                                @if($garantia->saldo != 0)
                                    @can('garantias.create')
                                            <a href="{{route('garantias.create',$garantia->id_contrato)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                @endif                
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