
@extends('layouts.app')
@section('titulo','Detalle de Garantía')
@section('content')

<div class="pagetitle">
    <h1>DETALLE GARANTÍA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('garantias.index') }}">Garantia</a></li>
        <li class="breadcrumb-item active">Detalle Garantia</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Detalle de Garantía</h5>
            <p>A continuación tiene el Detalle de Pago(s) de Garantia </p>
            <div class="row mb-1">
              <div class="col-md-1">
              </div>
              <div class="col-md-5" style= "display: none;">
                  <label for="contrato" class="col-form-label">Contrato </label>
                  <div class="col-md-11">
                      <input id="contrato"  type="text"  name="contrato" value="{{ $contrato->id }}" >
                  </div>
              </div>    
          
              <div class="col-md-5">
                  <label for="codigo_contrato" class="col-form-label">Código Contrato </label>
                  <div class="col-md-11">
                      <input id="codigo_contrato" disabled type="text" class="form-control {{ $errors->has('razon_social') ? ' error' : '' }}" name="razon_social" value="{{ $contrato->codigo }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                  </div>
              </div>    
              
              <div class="col-md-5">
                  <label for="cliente" class="col-form-label">Cliente </label>
                  <div class="col-md-12">
                      <input id="cliente" disabled type="text" class="form-control {{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" value="{{ $cliente->razon_social }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                  </div>
              </div>
          
              <div class="col-md-1">
              </div>
            </div>
          
            <div class="row mb-1">
                <div class="col-md-1">
                </div>
            
                <div class="col-md-4">
                    <label for="garantia" class="col-form-label">Garantía </label>
                    <div class="col-md-11">
                        <input id="garantia" disabled type="text" class="form-control {{ $errors->has('garantia') ? ' error' : '' }}" name="garantia" value="{{ old('garantia',$contrato->garantia) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                    </div>
                </div>
            
                <div class="col-md-3">
                    <label for="pagado" class="col-form-label">Pagado(Bs.) </label>
                    <div class="col-md-11">
                        <input id="pagado" disabled type="text" class="form-control {{ $errors->has('pagado') ? ' error' : '' }}" name="pagado" value="{{ old('pagado',$contrato->pago_garantia) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                    </div>
                </div>
            
                <div class="col-md-3">
                    <label for="saldo" class="col-form-label">Saldo (Bs.) </label>
                    <div class="col-md-12">
                        <input type='hidden' name='saldo_garantia' value='{{ old('saldo',$contrato->saldo_garantia) }}'/>
                        <input id="saldo" disabled type="text" class="form-control {{ $errors->has('saldo') ? ' error' : '' }}" name="saldo" value="{{ old('saldo',$contrato->saldo_garantia) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
                    </div>
                </div>
                    
                <div class="col-md-1">
                </div>
            </div>

            <br>

            <div id="label_tabla"class="row mb-1">
              <div>
                  <br><br>
                  <h5 class="text-muted text-center">LISTA DE PAGO DE GARANTIA</h5>
                  <hr class="mb-1" style="border-top: 2px solid rgb(1, 41, 112);">
                  <br>
              </div>
            </div>

            <div id="lista_detalle_garantia" class="table-responsive"> 
              <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">A PAGAR</th>
                        <th class="text-center">CUENTA</th>
                        <th class="text-center">NUMERO DE CUENTA</th>
                        <th class="text-center">FECHA PAGO</th>
                        <th class="text-center">FECHA DE DEPOSITO</th>
                        <th class="text-center">OPCIONES</th> 
                    </tr>
                </thead>
                <tbody>
                  @forelse($garantias as $garantia)
                  @php
                      $cuenta = App\Models\Cuenta::where('id',$garantia->cuenta)->first();
                  @endphp
                      <tr id="garantia-{{ $garantia->id }}">
                          <td class="text-center">{{ $garantia->a_pagar }}</td>
                          <td class="text-center">{{ $cuenta->descripcion }}</td>
                          <td class="text-center">{{ $garantia->numero_cuenta }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($garantia->fecha_pago)->format('d/m/Y') }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($garantia->fecha_deposito)->format('d/m/Y') }}</td>
                          <td class="text-center">
                            <button type="button" class="btn btn-danger {{ $loop->first ? 'btn-eliminar' : '' }}" data-id="{{ $garantia->id }}" title="{{ $loop->first ? 'Eliminar Registro' : 'Solo puede eliminar el último registro' }}" {{ $loop->first ? '' : 'disabled' }}>
                              <i class="bi bi-trash"></i>
                            </button>                          
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="6" class="text-center">No hay pago de garantia disponible(s)</td>
                      </tr>
                  @endforelse
                </tbody>
              </table>
            </div>  

            <br>

            <div class="row mt-2">
                <div class="text-center">
                    <a href="{{ route('garantias.index') }}" class="btn btn-warning">Cancelar</a>
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
  
    if (confirm('¿Está seguro que desea eliminar el registro de PAGO DE GARANTIA?')) {
      fetch(`/garantias/detalle/${id}`, {
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
          document.getElementById(`garantia-${id}`).remove();
  
          // Mostrar mensaje
          alert(data.message);
  
          // Actualizar campos de pagado y saldo
          document.getElementById('pagado').value = data.nuevo_pagado;
          document.getElementById('saldo').value = data.nuevo_saldo;
  
          // Verificar si quedan registros
          const tbody = document.querySelector('#lista_detalle_garantia tbody');
          const rows = tbody.querySelectorAll('tr');
  
          if (rows.length === 0) {
            tbody.innerHTML = `
              <tr>
                <td colspan="6" class="text-center">No hay pago de garantia disponible(s)</td>
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