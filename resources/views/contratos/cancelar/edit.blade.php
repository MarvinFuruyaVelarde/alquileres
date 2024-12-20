
@extends('layouts.app')
@section('titulo','Cancelar Contrato')
@section('content')

<div class="pagetitle">
    <h1>Cancelar Contrato</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cancelarcontratos.index') }}">Contratos</a></li>
        <li class="breadcrumb-item active">Cancelar Contrato</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumén Contrato</h5>
                
                    <form action="{{route('cancelarcontratos.update', ['contrato' => $contrato->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        <input id="tipo_solicitante" type="hidden" name="tipo_solicitante" value="{{ $contrato->tipo_solicitante }}">
                        <input id="ci" type="hidden" name="ci" value="{{ $contrato->ci }}">
                        <input id="nit" type="hidden" name="nit" value="{{ $contrato->nit }}">
                        <input id="contrato" type="hidden" name="contrato" value="{{ $contrato->id }}">
                        <input id="contrato" type="hidden" name="contrato" value="{{ $contrato->id }}">
                        <div class="row mb-1">
                            <div class="col-md-1">
                            </div>
                        
                            <div class="col-md-5">
                                <label for="codigo_old" class="col-form-label">Código Contrato <span class="text-danger">(*)</span></label>
                                <div class="col-md-11">
                                    <input id="codigo_old" type="text" class="form-control {{ $errors->has('codigo_old') ? ' error' : '' }}" name="codigo_old" value="{{ old('codigo_old',$contrato->codigo) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-codigo_old" class="error-codigo_old" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('codigo_old'))
                                        <span class="text-danger">
                                            {{ $errors->first('codigo_old') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        
                            <div class="col-md-5">
                                <label for="aeropuerto" class="col-form-label">Aeropuerto <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="aeropuerto" type="text" class="form-control {{ $errors->has('aeropuerto') ? ' error' : '' }}" name="aeropuerto" value="{{ old('aeropuerto',$aeropuertos->descripcion) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-aeropuerto" class="error-aeropuerto" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('aeropuerto'))
                                        <span class="text-danger">
                                            {{ $errors->first('aeropuerto') }}
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
                                <label for="cliente" class="col-form-label">Cliente <span class="text-danger">(*)</span></label>
                                <div class="col-md-11">
                                    <input id="cliente" type="text" class="form-control {{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" value="{{ old('cliente',$clientes->razon_social) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-cliente" class="error-cliente" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('cliente'))
                                        <span class="text-danger">
                                            {{ $errors->first('cliente') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        
                            <div class="col-md-5">
                                <label for="ci_nit" class="col-form-label">Ci/Nit <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="ci_nit" type="text" class="form-control {{ $errors->has('ci_nit') ? ' error' : '' }}" name="ci_nit" value="" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-ci_nit" class="error-ci" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('ci_nit'))
                                        <span class="text-danger">
                                            {{ $errors->first('ci_nit') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-md-1">
                            </div>
                        
                        </div>
                        <br>

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
                                        <th class="text-center">RUBRO</th>
                                        <th class="text-center">UBICACIÓN</th>
                                        <th class="text-center">DESCRIPCIÓN</th>
                                        <th class="text-center">FECHA INICIAL</th>
                                        <th class="text-center">FECHA FINAL</th>
                                        <th class="text-center">TOTAL CANON MENSUAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($listaespacios as $listaespacio)
                                        <tr>
                                            <td class="text-center col-2">{{ $listaespacio->rubro }}</td>
                                            <td class="text-center col-2">{{ $listaespacio->ubicacion }}</td>
                                            <td class="text-center col-4">{{ $listaespacio->descripcion }}</td>
                                            <td class="text-center col-1">{{ $listaespacio->fecha_inicial }}</td>
                                            <td class="text-center col-1">{{ $listaespacio->fecha_final }}</td>
                                            <td class="text-center col-1">{{ $listaespacio->total_canonmensual }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No hay espacios registrados</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <br>

                        <div class="row mb-1">
                        
                            <div class="col-md-2">
                                <div class="col-sm-10">
                                    <label for="objetivo" class="col-form-label">Objetivo <span class="text-danger">(*)</span></label>
                                </div>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input id="objetivo1" class="form-check-input" type="radio" name="objetivo" value="M" checked autofocus>
                                        <label class="form-check-label" for="objetivo1">Modificar</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="objetivo2" class="form-check-input" type="radio" name="objetivo" value="A">
                                        <label class="form-check-label" for="objetivo2">Anular</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="motivo" class="col-form-label">Motivo <span class="text-danger">(*)</span></label>
                                <textarea id="motivo" class="form-control {{ $errors->has('motivo') ? ' error' : '' }}" name="motivo" rows="5"></textarea>
                                <span id="error-motivo" class="error-motivo" style="color: rgb(220, 53, 69);"></span>
                                @if ($errors->has('motivo'))
                                    <span class="text-danger">
                                        {{ $errors->first('motivo') }}
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label for="documento_respaldo" class="col-form-label">Adjunte Documento de Respaldo (PDF) <span class="text-danger">(*)</span></label>
                                <input type="file" class="form-control" id="documento_respaldo" name="documento_respaldo" accept="application/pdf">
                            </div>

                            <div class="col-md-3">
                                <label for="codigo" class="col-form-label">Nuevo Código de Contrato <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="codigo" type="text" class="form-control {{ $errors->has('codigo') ? ' error' : '' }}" name="codigo" value="" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                                    <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('codigo'))
                                        <span class="text-danger">
                                            {{ $errors->first('codigo') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
    
                        <div class="row mt-2">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('cancelarcontratos.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                        
                    </form>  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
  //Asignación de Ci/Nit
  if(document.getElementById('tipo_solicitante').value === '1'){
    document.getElementById('ci_nit').value = document.getElementById('ci').value
  } else{
    document.getElementById('ci_nit').value = document.getElementById('nit').value
  }
</script>
@endsection