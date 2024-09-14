@extends('layouts.app')
@section('titulo','Clientes')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Clientes</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            @can('clientes.show')
                <a href="{{route('clientes.show')}}" class="btn btn-danger bi-file-earmark-pdf" title="Generar reporte pdf"></a>
            @endcan

            @can('clientes.export')
                <a href="{{route('clientes.export')}}" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel"></a>
             @endcan
        </div>
        @can('clientes.create')
            <a href="{{route('clientes.create')}}" class="btn btn-primary" title="Crea un nuevo cliente">Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Clientes Registrados</h5>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">RAZÓN SOCIAL</th>
                            <th class="text-center">TIPO IDENTIFICACIÓN</th>
                            <th class="text-center">NRO. IDENTIFICACIÓN</th>
                            <th class="text-center">TIPO SOLICITANTE</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)

                            <tr>
                                <td class="text-center">{{$cliente->razon_social}}</td>
                                <td class="text-center">{{$cliente->desc_tipoidentificacion}}</td>
                                <td class="text-center">{{$cliente->numero_identificacion}}</td>
                                <td class="text-center">{{$cliente->desc_tiposolicitante}}</td>
                                <td class="text-center">{{$cliente->desc_estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('clientes.edit')
                                        <a href="{{route('clientes.edit',$cliente)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('clientes.destroy')
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar el CLIENTE?');"><i class="bi bi-trash"></i>
                                            </button>
                                        </form>
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