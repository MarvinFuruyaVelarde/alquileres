@extends('layouts.app')
@section('titulo','Cuentas')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Cuentas</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Cuentas</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            @can('cuentas.show')
                <a href="{{route('cuentas.show')}}" class="btn btn-danger bi-file-earmark-pdf " title="Generar reporte pdf"  target="_blank">PDF</a>            
            @endcan

            @can('cuentas.show')
                <a href="{{route('cuentas.export')}}" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel" >EXCEL</a>            
             @endcan
        </div>
        @can('cuentas.create')
            <a href="{{route('cuentas.create')}}" class="btn btn-primary" title="Crea una nueva cuenta"> <i class="bi bi-plus"></i> Registrar </a>
        @endcan
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cuentas Registradas</h5>
            <p>Cada registro tiene la opción de editar <i class="btn btn-warning bi bi-pencil-square"></i> y eliminar <i class=" btn btn-danger bi bi-trash"></i> una Cuenta.</p>

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
                        @foreach($cuentas as $cuenta)

                            <tr>
                                <td class="text-center">{{$cuenta->descripcion}}</td>
                                <td class="text-center">{{$cuenta->numero_cuenta}}</td>
                                <td class="text-center">{{$cuenta->desc_moneda}}</td>
                                <td class="text-center">{{$cuenta->desc_estado}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('cuentas.edit')
                                        <a href="{{route('cuentas.edit',$cuenta)}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('cuentas.destroy')
                                        <form action="{{ route('cuentas.destroy', $cuenta->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar la CUENTA?');"><i class="bi bi-trash"></i>
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