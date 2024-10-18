@extends('layouts.app')
@section('titulo','Plantilla')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Plantilla</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Plantilla</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
        </div>
        @can('plantillas.create')
            <a href="{{route('plantillas.create')}}" class="btn btn-primary" title="Crea una nueva plantilla"> <i class="bi bi-plus"></i> Registrar</a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Expensas Registradas</h5>
            <p>Cada registro tiene la opción de editar <i class="btn btn-warning bi bi-pencil-square"></i> , eliminar <i class=" btn btn-danger bi bi-trash"></i> y ver  <i class="btn btn-success bi-file-earmark-pdf"></i>  una Plantilla.</p>

           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">CLIENTE</th>
                            <th class="text-center">CODIGO CONTRATO</th>
                            <th class="text-center">FECHA</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contrato as $item)
                        <tr>
                            @php
                                $cliente= App\Models\Cliente::where('id',$item->cliente)->first();
                                $contrato= App\Models\Contrato::where('id',$item->contrato)->first();
                            @endphp
                            <td class="text-center">{{$cliente->razon_social}}</td>
                            <td class="text-center">{{$contrato->codigo}}</td>
                            <td class="text-center">{{$item->fecha}}</td>
                            <td class="d-flex justify-content-center">
                                @can('plantillas.edit')
                                    <a href="{{route('plantillas.edit',$item->contrato)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                
                                @can('plantillas.destroy')
                                    <form action="{{ route('plantillas.destroy', $item->contrato) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar la plantilla?');"><i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                                @can('plantillas.show')
                                    <a href="{{route('plantillas.show',$item->contrato)}}" class="btn btn-success bi-file-earmark-pdf " title="Visualizar Plantilla"  target="_blank"></a>
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