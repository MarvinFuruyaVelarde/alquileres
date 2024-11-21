@extends('layouts.app')
@section('titulo','Editar Usuario')
@section('content')

<div class="pagetitle">
    <h1>Notas de Cobro</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos de notas de cobro</h5>
            <p>
              Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
              Al momento de registrar/editar una expensa</p>
              <div class="row mb-1">
                <div class="col-md-4">
                  <label for="cliente" class="col-form-label">Cliente </label>
                  <div class="col-md-12">
                      <input id="cliente" disabled type="text" class="form-control {{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" value="{{ $clienteRazonSocial }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                  </div>
                 </div>  
            
                <div class="col-md-4">
                    <label for="codigo_contrato" class="col-form-label">Código Contrato </label>
                    <div class="col-md-12">
                        <input id="codigo_contrato" disabled type="text" class="form-control {{ $errors->has('codigo_contrato') ? ' error' : '' }}" name="codigo_contrato" value="{{ $codigoContrato }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                    </div>
                </div>    
                
                <div class="col-md-4">
                    <label for="numero_nota_cobro" class="col-form-label">Número Nota de Cobro </label>
                    <div class="col-md-12">
                        <input id="numero_nota_cobro" disabled type="text" class="form-control {{ $errors->has('numero_nota_cobro') ? ' error' : '' }}" name="numero_nota_cobro" value="{{ $numero_nota_cobro }}" >
                    </div>
                </div>  
              </div>

              <div class="row mb-1">                  
                <div>
                    <br><br>
                    <h5 class="text-muted">LISTA ESPACIO COMERCIAL Y/O PUBLICITARIO</h5>
                    <hr class="mb-1" style="border-top: 2px solid rgb(1, 41, 112);">
                    <br>
                </div>            
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">GLOSA</th>
                            <th class="text-center">FECHA INICIAL</th>
                            <th class="text-center">FECHA FINAL</th>
                            <th class="text-center">TOTAL CANON MENSUAL</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($facturaDetalles as $facturaDetalle)
                            <tr>
                                @php
                                $espacio = App\Models\View_Espacio::find($facturaDetalle->espacio);
                                if ($tipoFactura == 'AL')
                                  $glosa = $espacio->glosa_factura;
                                else if ($tipoFactura == 'EX')
                                  $glosa = $facturaDetalle->glosa;
                                $rangoFacturacionMensual = App\Models\NotaCobro::obtenerRangoFacturacion($mes, $gestion, $facturaDetalle->fecha_inicial, $facturaDetalle->fecha_final);
                                @endphp
                                <form action="{{ route('notacobro.update', ['id' => $facturaDetalle->id]) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('PUT')
                                  <td class="text-center col-4">{{ $espacio->descripcion }}<input type="hidden" name="id_espacio" value="{{ $facturaDetalle->espacio }}"></td>
                                  <td class="text-center col-4"><textarea name="glosa_factura" class="form-control text-center" rows="3">{{ $glosa }}</textarea></td>
                                  <td class="text-center col-1"><input type="date" name="fecha_inicio" class="form-control text-center" value="{{ $rangoFacturacionMensual['fecha_inicio'] }}"></td>
                                  <td class="text-center col-1"><input type="date" name="fecha_fin" class="form-control text-center" value="{{ $rangoFacturacionMensual['fecha_fin'] }}"></td>
                                  <td class="text-center col-1"><input type="text" name="precio" class="form-control text-center" value="{{ $facturaDetalle->precio }}" step="0.01"></td>      
                                  <td class="text-center col-1">
                                    @can('notacobro.edit')                                        
                                      <button type="submit" class="btn btn-primary" title="Modificar Datos">
                                          <i class="bi bi-floppy"></i>
                                      </button>
                                    @endcan                                     
                                  </td>   
                                </form>                           
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hay espacios registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
              </div>
              <div class="row mt-2">
                <div class="text-center">
                  <button type="button" onclick="history.back()" class="btn btn-warning">Cancelar</button>
                </div>              
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection