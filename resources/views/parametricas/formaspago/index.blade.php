@extends('layouts.app')
@section('titulo','Forma de Pago')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Formas de Pago</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Formas de Pago</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            @can('formaspago.show')
                <a href="{{route('formaspago.show')}}" class="btn btn-danger bi-file-earmark-pdf " title="Generar reporte pdf"  target="_blank">PDF</a>
            @endcan

            @can('formaspago.show')
                <a href="{{route('formaspago.export')}}" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel" >EXCEL</a>
             @endcan
        </div>
        @can('formaspago.create')
            <a href="{{route('formaspago.create')}}" class="btn btn-primary" title="Crea una nueva forma de pago"> <i class="bi bi-plus"></i> Registrar </a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Formas de Pago Registradas</h5>
            <p>Cada registro tiene la opción de editar <i class="btn btn-warning bi bi-pencil-square"></i> y eliminar <i class=" btn btn-danger bi bi-trash"></i> una Forma de Pago.</p>
            
           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">NRO. DÍAS</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formaspago as $formapago)

                            <tr>
                                <td class="text-center">{{$formapago->descripcion}}</td>
                                <td class="text-center">{{$formapago->numero_dia}}</td>
                                <td class="text-center">{{$formapago->desc_estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('formaspago.edit')
                                        <a href="{{route('formaspago.edit',$formapago)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('formaspago.destroy')
                                        <form action="{{ route('formaspago.destroy', $formapago->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar la FORMA DE PAGO?');"><i class="bi bi-trash"></i>
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