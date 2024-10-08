@extends('layouts.app')
@section('titulo','Lista Contratos Pendientes')
@section('content')

@section('content')


<div class="pagetitle">
    <h1>Aprobar Contratos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Aprobar Contratos</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            {{--@can('contratos.show')
                <a href="{{route('expensas.show')}}" class="btn btn-danger bi-file-earmark-pdf" title="Generar reporte pdf"  target="_blank">PDF</a>
            @endcan

            @can('contratos.show')
                <a href="{{route('expensas.export')}}" class="btn btn-success bi-file-earmark-excel" title="Generar reporte excel" >EXCEL</a>
             @endcan--}}
        </div>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Contratos para Aprobar</h5>
            <p>Cada registro tiene la opción de aprobar <i class="btn btn-success bi bi-check-square"></i> un Contrato.</p>

           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">AEROPUERTO</th>
                            <th class="text-center">COD. CONTRATO</th>
                            <th class="text-center">NOMBRE CLIENTE</th>
                            <th class="text-center">REPRESENTANTE</th>
                            <th class="text-center">NIT/CI</th>
                            <th class="text-center">TELEFONO/CELULAR</th>
                            <th class="text-center">CORREO</th>
                            <th class="text-center">DOMICILIO LEGAL</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contratos as $contrato)

                            <tr>
                                <td class="text-center">{{$contrato->codigo_aeropuerto}}</td>
                                <td class="text-center">{{$contrato->codigo_contrato}}</td>
                                <td class="text-center">{{$contrato->nombre_cliente}}</td>
                                <td class="text-center">{{$contrato->representante}}</td>
                                <td class="text-center">{{$contrato->nit_ci}}</td>
                                <td class="text-center">{{$contrato->telefono_celular}}</td>
                                <td class="text-center">{{$contrato->correo}}</td>
                                <td class="text-center">{{$contrato->domicilio_legal}}</td>
                                <td class="d-flex justify-content-center" >
                                    @can('aprobarcontratos.edit')
                                        <a href="{{route('aprobarcontratos.edit',$contrato)}}" class="btn btn-success" title="Modificar Datos"><i class="bi bi-check-square"></i></a>
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