
@extends('layouts.app')
@section('titulo','Nuevo Espacio')
@section('content')

<div class="pagetitle">
    <h1>FACTOR POR AEROPUERTO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('expensas.index') }}">Expensas</a></li>
        <li class="breadcrumb-item active">Factor por Aeropuerto</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nuevo Factor por Aeropuerto</h5>
                
                    <p>
                    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
                    Al momento de registrar un factor</p>
                    <form action="{{route('expensas.store_aeropuerto_expensa')}}" method="post">
                        @csrf
                        <input id="expensa" type="hidden" name="expensa" value="{{ $expensa->id }}">
                        <div class="row mb-1">
                            <div class="col-md-1">
                            </div>
                        
                            <div class="col-md-4">
                                <label for="descripcion" class="col-form-label">Descripción </label>
                                <div class="col-md-11">
                                    <input id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}" name="descripcion" value="{{ old('descripcion',$expensa->descripcion) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-descripcion" class="error-descripcion" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('descripcion'))
                                        <span class="text-danger">
                                            {{ $errors->first('descripcion') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        
                            <div class="col-md-2">
                                <label for="unidad_medida" class="col-form-label">Unidad de Medida </label>
                                <div class="col-md-11">
                                    <input id="unidad_medida" type="text" class="form-control {{ $errors->has('unidad_medida') ? ' error' : '' }}" name="unidad_medida" value="{{ old('unidad_medida',$expensa->unidad_medida) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-unidad_medida" class="error-unidad_medida" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('unidad_medida'))
                                        <span class="text-danger">
                                            {{ $errors->first('unidad_medida') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="estado" class="col-form-label">Estado </label>
                                <div class="col-md-11">
                                    <input id="estado" type="text" class="form-control {{ $errors->has('estado') ? ' error' : '' }}" name="estado" value="{{ old('estado',$estadoDesc) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-estado" class="error-estado" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('estado'))
                                        <span class="text-danger">
                                            {{ $errors->first('estado') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        
                            <div class="col-md-1">
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div>
                                <br><br>
                                <h5 class="text-muted">REGISTRO FACTOR POR AEROPUERTO</h5>
                                <hr class="mb-1" style="border-top: 2px solid rgb(1, 41, 112);">
                                <br>
                            </div>
                        </div>

                        <div class="row mb-1">     
                            <div class="col-md-1">
                            </div>

                            <div class="col-md-4">
                                <label for="aeropuerto" class="col-form-label">Aeropuerto <span class="text-danger">(*)</span></label>
                                <div class="col-md-11">
                                    <select id="aeropuerto" class="form-control{{ $errors->has('aeropuerto') ? ' error' : '' }}" name="aeropuerto">
                                        <option value="">Seleccionar...</option>
                                        @foreach($aeropuertos as $aeropuerto)
                                            <option value="{{ $aeropuerto->id }}" >
                                                {{ $aeropuerto->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('aeropuerto'))
                                        <span class="text-danger">
                                            {{ $errors->first('aeropuerto') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <label for="factor" class="col-form-label">Factor <span class="text-danger">(*)</span></label>
                                <div class="col-md-11">
                                    <input id="factor" type="text" class="form-control{{ $errors->has('factor') ? ' error' : '' }}" name="factor" value="{{ old('factor',$expensa->factor) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="decimal">
                                    <span id="error-factor" class="error-factor" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('factor'))
                                        <span class="text-danger">
                                            {{ $errors->first('factor') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">Guardar</button>
                                    <a href="{{ route('expensas.index') }}" class="btn btn-warning">Cancelar</a>
                                </div>
                            </div>

                            <div class="col-md-1">
                            </div>
                        </div>
                        
                        <div class="row mb-1">
                            <div>
                                <br><br>
                                <h5 class="text-muted">LISTA DE FACTOR(ES) POR AEROPUERTO</h5>
                                <hr class="mb-1" style="border-top: 2px solid rgb(1, 41, 112);">
                                <br>
                            </div>                        
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">AEROPUERTO</th>
                                        <th class="text-center">FACTOR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aeropuertoExpensas as $aeropuertoExpensa)
                                        <tr>
                                            <td class="text-center col-2">{{ $aeropuertoExpensa->desc_aeropuerto }}</td>
                                            <td class="text-center col-2">{{ $aeropuertoExpensa->factor }}</td>                
                                            {{--<td class="text-center col-1" >
                                                <a href="{{route('contratos.edit_espacio', ['contrato' => $contrato->id, 'espacio' => $listaespacio->id])}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                                <form action="{{ route('contratos.destroy_espacio', $listaespacio->id) }}" method="POST" style="display:inline;">                                                
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Eliminar Registro" onclick="return confirm('¿Está seguro que desea eliminar el ESPACIO?');"><i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                                        
                                            </td>--}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No hay factor(es) registrado(s)</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <br>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>

</script>
@endsection