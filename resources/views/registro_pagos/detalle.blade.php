
@extends('layouts.app')
@section('titulo','Detalle de Garantía')
@section('content')

<div class="pagetitle">
    <h1>DETALLE REGISTRO DE PAGOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('registropagos.index') }}">Registro de Pagos</a></li>
        <li class="breadcrumb-item active">Detalle Registro de Pagos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Detalle de Registro de Pagos</h5>
            <p>A continuación tiene el Detalle de Registro de Pago(s) </p>
              <input type="hidden" name="factura_id" id="factura_id" value="{{ $factura->id }}">
              <input type="hidden" name="mes" id="mes" value="{{ $factura->mes }}">
              <input type="hidden" name="gestion" id="gestion" value="{{ $factura->gestion }}">
            <div class="row mb-1">
                <div class="col-md-1">
                </div>
            
                <div class="col-md-5">
                    <label for="codigo" class="col-form-label">Numero Nota de Cobro: <span class="text-danger">(*)</span></label>
                    <div class="col-md-11">
                        <input id="numero_nota_cobro" type="text" class="form-control {{ $errors->has('numero_nota_cobro') ? ' error' : '' }}" name="numero_nota_cobro" value="{{ old('numero_nota_cobro',$factura->numero_nota_cobro) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                        <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('numero_nota_cobro'))
                            <span class="text-danger">
                                {{ $errors->first('numero_nota_cobro') }}
                            </span>
                        @endif
                    </div>
                </div>
            
                <div class="col-md-5">
                    <label for="aeropuerto" class="col-form-label">Numero de Factura <span class="text-danger">(*)</span></label>
                    <div class="col-md-11">
                        <input id="numero_factura" type="text" class="form-control {{ $errors->has('numero_factura') ? ' error' : '' }}" name="numero_factura" value="{{ old('numero_factura',$factura->numero_factura) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                        <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('numero_factura'))
                            <span class="text-danger">
                                {{ $errors->first('numero_factura') }}
                            </span>
                        @endif
                    </div>
                </div>
            
                <div class="col-md-1">
                </div>
            
            </div>
            
            <div class="row mb-1">
                <div class="col-md-1">
                </div>
            
                <div class="col-md-5">
                    <label for="tipo_solicitante" class="col-form-label ">Cliente <span class="text-danger">(*)</span></label>
                    <div class="col-md-11">
                        <input id="cliente" type="text" class="form-control {{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" value="{{ old('cliente',$cliente->razon_social) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                        <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('cliente'))
                            <span class="text-danger">
                                {{ $errors->first('cliente') }}
                            </span>
                        @endif
                    </div>
                </div>
            
                <div class="col-md-5">
                    <label for="cliente" class="col-form-label ">Monto Factura (Bs.)<span class="text-danger">(*)</span></label>
                    <div class="col-md-11">
                        <input id="monto_factura" type="text" class="form-control {{ $errors->has('monto_factura') ? ' error' : '' }}" name="monto_factura" value="{{ old('monto_factura',$factura->monto_total) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                        <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('monto_factura'))
                            <span class="text-danger">
                                {{ $errors->first('monto_factura') }}
                            </span>
                        @endif
                    </div>
                </div>
            
                <div class="col-md-1">
                </div>
            
            </div>
            
            <div class="row mb-1">
                <div class="col-md-1">
                </div>
            
                <div id="ci-container" class="col-md-5">
                    <label for="ci" class="col-form-label">Pagado (Bs.) <span class="text-danger">(*)</span></label>
                    <div class="col-md-11">
                        <input id="pagado" type="text" class="form-control {{ $errors->has('pagado') ? ' error' : '' }}" name="pagado" value="{{ old('pagado',$pagado) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                        <span id="error-codigo" class="error-ci" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('pagado'))
                            <span class="text-danger">
                                {{ $errors->first('pagado') }}
                            </span>
                        @endif
                    </div>
                </div>
            
                <div id="nit-container" class="col-md-5" >
                    <label for="nit" class="col-form-label">Saldo (Bs.) <span class="text-danger">(*)</span></label>
                    <div class="col-md-11">
                        <input id="saldo_registro_pago" type='hidden' name='saldo_registro_pago' value="{{ old('saldo_registro_pago', number_format($factura->monto_total - $pagado,2, '.', '')) }}"/>
                        <input id="saldo" type="text" class="form-control {{ $errors->has('saldo') ? ' error' : '' }}" name="saldo" value="{{ old('saldo', number_format($factura->monto_total - $pagado,2, '.', '')) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50", disabled>
                        <span id="error-codigo" class="error-nit" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('saldo'))
                            <span class="text-danger">
                                {{ $errors->first('saldo') }}
                            </span>
                        @endif
                    </div>
                </div>
            
                <div class="col-md-1">
                </div>
            
            </div>

            <br>

            <div id="label_tabla"class="row mb-1">
              <div>
                  <br><br>
                  <h5 class="text-muted text-center">LISTA DE REGISTRO(S) DE PAGO</h5>
                  <hr class="mb-1" style="border-top: 2px solid rgb(1, 41, 112);">
                  <br>
              </div>
            </div>

            <div id="lista_detalle_registro_pago" class="table-responsive"> 
              <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">A PAGAR</th>
                        <th class="text-center">FECHA DE PAGO</th>
                        <th class="text-center">NRO. REG. DEPOSITO/CHQ/TRANSF.</th>
                        <th class="text-center">NRO. RECIBO COBRO</th>
                        <th class="text-center">CUENTA</th>
                        <th class="text-center">FEC. DEPOSITO EN CUENTA</th>
                        <th class="text-center">OBSERVACIÓN</th>
                        <th class="text-center">OPCIONES</th> 
                    </tr>
                </thead>
                <tbody>
                  @forelse($detallePagoFacturas as $detallePagoFactura)
                  @php
                    $cuenta= App\Models\Cuenta::where('id',$detallePagoFactura->cuenta)->first();
                  @endphp
                      <tr id="registro_pago-{{ $detallePagoFactura->id }}">
                          <td class="text-center">{{ $detallePagoFactura->a_pagar }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($detallePagoFactura->fecha_pago)->format('d/m/Y') }}</td>
                          <td class="text-center">{{ $detallePagoFactura->numero_registro_deposito }}</td>
                          <td class="text-center">{{ $detallePagoFactura->numero_registro_cobro }}</td>
                          <td class="text-center">{{ $cuenta->descripcion }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($detallePagoFactura->fecha_deposito)->format('d/m/Y') }}</td>
                          <td class="text-center">{{ $detallePagoFactura->observacion }}</td>
                          <td class="text-center">
                            <button type="button" class="btn btn-danger {{ $loop->first ? 'btn-eliminar' : '' }}" data-id="{{ $detallePagoFactura->id }}" title="{{ $loop->first ? 'Eliminar Registro' : 'Solo puede eliminar el último registro' }}" {{ $loop->first ? '' : 'disabled' }}>
                              <i class="bi bi-trash"></i>
                            </button>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="8" class="text-center">No hay registro(s) de pago disponible(s)</td>
                      </tr>
                  @endforelse
                </tbody>
              </table>
            </div> 

            <br>
            <div class="row mt-2">
                <div class="text-center">
                    <a href="{{ route('registropagos.index') }}" class="btn btn-warning">Cancelar</a>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
  function eliminarHandler(e) {
    e.preventDefault();
    const id = this.getAttribute('data-id');
  
    if (confirm('¿Está seguro que desea eliminar el REGISTRO DE PAGO?')) {
      fetch(`/registropagos/detalle/${id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: JSON.stringify({ _method: 'DELETE' })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Eliminar visualmente la fila
          document.getElementById(`registro_pago-${id}`).remove();
  
          // Mostrar mensaje
          alert(data.message);
  
          // Actualizar campos de pagado y saldo
          document.getElementById('pagado').value = data.nuevo_pagado;
          document.getElementById('saldo').value = (document.getElementById('monto_factura').value - data.nuevo_pagado).toFixed(2);
  
          // Verificar si quedan registros
          const tbody = document.querySelector('#lista_detalle_registro_pago tbody');
          const rows = tbody.querySelectorAll('tr');
  
          if (rows.length === 0) {
            tbody.innerHTML = `
              <tr>
                <td colspan="8" class="text-center">No hay registro de pago(s) disponible(s)</td>
              </tr>
            `;
          } else {
            // Habilitar y reasignar evento al nuevo último botón
            const lastRow = tbody.querySelector('tr:last-child');
            const lastDeleteBtn = lastRow.querySelector('button');
            if (lastDeleteBtn && !lastDeleteBtn.onclick) {
              lastDeleteBtn.disabled = false;
              lastDeleteBtn.classList.add('btn-eliminar');
              lastDeleteBtn.title = 'Eliminar Registro';
              lastDeleteBtn.addEventListener('click', eliminarHandler);
            }
          }
        } else {
          alert('Error al eliminar. Intente nuevamente.');
        }
      })
      .catch(error => {
        console.error(error);
        alert('Error de conexión con el servidor.');
      });
    }
  }
  
  document.addEventListener('DOMContentLoaded', function () {
    // Asignar el manejador a todos los botones ya existentes
    document.querySelectorAll('.btn-eliminar').forEach(button => {
      button.addEventListener('click', eliminarHandler);
    });
  });
</script>
  
@endsection