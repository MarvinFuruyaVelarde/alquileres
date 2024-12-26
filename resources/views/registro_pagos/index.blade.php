@extends('layouts.app')
@section('titulo','registro pagos')
@section('content')

@section('content')

<div class="pagetitle">
    <h1>Lista Registro de Pagos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Registro De Pagos</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
        </div>
    </div>
</div><!-- End Page Title -->
 <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pagos  Registrados</h5>
                    <p>Cada registro tiene la opción de registrar <i class="btn btn-warning bi bi-pencil-square"></i> pagos.</p>
                    
                    <!--CONTENIDO -->
                    <div class="table-responsive">
                        <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">NUMERO NOTA DE COBRO</th>
                                    <th class="text-center">NUMERO DE FACTURA</th>
                                    <th class="text-center">MONTO FACTURA EN Bs</th>
                                    <th class="text-center">PAGADO</th>
                                    <th class="text-center">SALDO</th> 
                                    <th class="text-center">OPCIONES</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facturas as $factura)
                                    @php                            
                                        $pagado = App\Models\DetallePagoFactura::where('id_factura', $factura->id)->sum('a_pagar');
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{$factura->numero_nota_cobro}}</td>
                                        <td class="text-center">{{$factura->id}}</td>
                                        <td class="text-center">{{$factura->monto_total}}</td>
                                        <td class="text-center">{{$pagado}}</td>
                                        <td class="text-center">{{number_format($factura->monto_total - $pagado, 2, '.', '')}}</td>
                                        <td class="d-flex justify-content-center" > 
                                        @can('registropagos.create')
                                                <a href="{{route('registropagos.create',$factura->id)}}" class="btn btn-warning" title="Registrar Pago"><i class="bi bi-pencil-square"></i></a>
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