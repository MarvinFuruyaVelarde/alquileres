@extends('layouts.app')
@section('titulo','Tipos de Pago')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Tipos de Pago</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Tipos de Pago</li>
        </ol>
        </nav>
        @can('tipospago.create')
            <a href="{{route('tipospago.create')}}" class="btn btn-primary" title="Crea una nuevo tipo de pago">Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tipos de Pago Registrados</h5>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">NRO. CUENTA</th>
                            <th class="text-center">MONEDA</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipospago as $tipopago)

                            <tr>
                                <td class="text-center">{{$tipopago->descripcion}}</td>
                                <td class="text-center">{{$tipopago->numero_cuenta}}</td>
                                <td class="text-center">{{$tipopago->desc_moneda}}</td>
                                <td class="text-center">{{$tipopago->desc_estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('tipospago.edit')
                                        <a href="{{route('tipospago.edit',$tipopago)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('tipospago.destroy')
                                        <form action="{{ route('tipospago.destroy', $tipopago->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar el TIPO DE PAGO?');"><i class="bi bi-trash"></i>
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