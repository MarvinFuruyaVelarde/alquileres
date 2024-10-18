
@extends('layouts.app')
@section('titulo','Modificar Espacio')
@section('content')

<div class="pagetitle">
    <h1>ESPACIO COMERCIAL Y/O PUBLICITARIO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('contratos.index') }}">Contratos</a></li>
        <li class="breadcrumb-item active">Nuevo Contrato</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nuevo Espacio</h5>
                
                    <p>
                    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
                    Al momento de registrar un espacio</p>
                    <form action="" method="post">
                        @csrf
                        <input id="tipo_solicitante" type="hidden" name="tipo_solicitante" value="{{ $contrato->tipo_solicitante }}">
                        <input id="ci" type="hidden" name="ci" value="{{ $contrato->ci }}">
                        <input id="nit" type="hidden" name="nit" value="{{ $contrato->nit }}">
                        <input id="contrato" type="hidden" name="contrato" value="{{ $contrato->id }}">
                        <input id="contrato" type="hidden" name="contrato" value="{{ $contrato->id }}">
                        <div class="row mb-1">
                            <div class="col-md-1">
                            </div>
                        
                            <div class="col-md-5">
                                <label for="codigo" class="col-form-label">Código Contrato <span class="text-danger">(*)</span></label>
                                <div class="col-md-11">
                                    <input id="codigo" type="text" class="form-control {{ $errors->has('codigo') ? ' error' : '' }}" name="codigo" value="{{ old('codigo',$contrato->codigo) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('codigo'))
                                        <span class="text-danger">
                                            {{ $errors->first('codigo') }}
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

                        <div class="row mb-1">
                        
                            <div>
                                <br><br>
                                <h5 class="text-muted">DETALLE ESPACIO COMERCIAL Y/O PUBLICITARIO</h5>
                                <hr class="mb-1" style="border-top: 2px solid rgb(1, 41, 112);">
                                <br>
                            </div>
                        
                        </div>
                        
                        <div class="row mb-1">
                        
                            <div class="col-md-3">
                                <div class="col-sm-10">
                                    <label for="tipo_canon" class="col-form-label">Tipo de Canón <span class="text-danger">(*)</span></label>
                                </div>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input id="tipo_canon1" class="form-check-input" type="radio" name="tipo_canon" value="F" {{ old('tipo_canon', $espacio->tipo_canon ?? 'F') == 'F' ? 'checked' : '' }} autofocus disabled>
                                        <label class="form-check-label" for="tipo_canon1">Fijo</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="tipo_canon2" class="form-check-input" type="radio" name="tipo_canon"  value="V" {{ old('tipo_canon', $espacio->tipo_canon ?? '') == 'V' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="tipo_canon2">Variable</label>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <label for="rubro" class="col-form-label">Rubro <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <select id="rubro" class="form-control{{ $errors->has('rubro') ? ' error' : '' }}" name="rubro" disabled>
                                        <option value="">Seleccionar...</option>
                                        @foreach($rubros as $rubro)
                                            <option value="{{ $rubro->id }}" 
                                                {{ old('rubro', $espacio->rubro) == $rubro->id ? 'selected' : '' }}>
                                                {{ $rubro->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('rubro'))
                                        <span class="text-danger">
                                            {{ $errors->first('rubro') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <label for="ubicacion" class="col-form-label">Ubicación <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="ubicacion" type="text" class="form-control {{ $errors->has('ubicacion') ? ' error' : '' }}" name="ubicacion" value="{{ old('ubicacion',$espacio->ubicacion) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-ubicacion" class="error-ubicacion" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('ubicacion'))
                                        <span class="text-danger">
                                            {{ $errors->first('ubicacion') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="cantidad" class="col-form-label">Cantidad <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="cantidad" type="text" class="form-control {{ $errors->has('cantidad') ? ' error' : '' }}" name="cantidad" value="{{ old('cantidad',$espacio->cantidad) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-cantidad" class="error-cantidad" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('cantidad'))
                                        <span class="text-danger">
                                            {{ $errors->first('cantidad') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        
                        </div>
                        
                        
                        <div class="row mb-1">
                        
                            <div class="col-md-3">
                                <label for="unidad_medida" class="col-form-label">Unidad de Medida <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <select id="unidad_medida" class="form-control{{ $errors->has('unidad_medida') ? ' error' : '' }}" name="unidad_medida" disabled>
                                        <option value="">Seleccionar...</option>
                                        @foreach($unidadesmedida as $unidadmedida)
                                            <option value="{{ $unidadmedida->id }}" 
                                                {{ old('unidad_medida', $espacio->unidad_medida) == $unidadmedida->id ? 'selected' : '' }}>
                                                {{ $unidadmedida->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('unidad_medida'))
                                        <span class="text-danger">
                                            {{ $errors->first('unidad_medida') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="precio_unitario" class="col-form-label">Precio Unitario <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="precio_unitario" type="text" class="form-control {{ $errors->has('precio_unitario') ? ' error' : '' }}" name="precio_unitario" value="{{ old('precio_unitario',$espacio->precio_unitario) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-precio_unitario" class="error-precio_unitario" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('precio_unitario'))
                                        <span class="text-danger">
                                            {{ $errors->first('precio_unitario') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <label for="fecha_inicial" class="col-form-label">Fecha Inicial <span class="text-danger">(*)</span></label>
                                <input id="fecha_inicial" type="date" class="form-control {{ $errors->has('fecha_inicial') ? ' error' : '' }}" name="fecha_inicial" value="{{ old('fecha_inicial',$espacio->fecha_inicial) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                <span id="error-fecha_inicial" class="error-fecha_inicial" style="color: rgb(220, 53, 69);"></span>
                                @if ($errors->has('fecha_inicial'))
                                    <span class="text-danger">
                                        {{ $errors->first('fecha_inicial') }}
                                    </span>
                                @endif
                            </div>
                        
                            <div class="col-md-3">
                                <label for="fecha_final" class="col-form-label">Fecha Inicial <span class="text-danger">(*)</span></label>
                                <input id="fecha_final" type="date" class="form-control {{ $errors->has('fecha_final') ? ' error' : '' }}" name="fecha_final" value="{{ old('fecha_final',$espacio->fecha_final) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                <span id="error-fecha_final" class="error-fecha_final" style="color: rgb(220, 53, 69);"></span>
                                @if ($errors->has('fecha_final'))
                                    <span class="text-danger">
                                        {{ $errors->first('fecha_final') }}
                                    </span>
                                @endif
                            </div>
                        
                        </div>
                        
                        <div class="row mb-1"> 
                            
                            <div class="col-md-3">
                                <label for="total_canonmensual" class="col-form-label">Total Canon Mensual <span class="text-danger">(*)</span></label>
                                <input id="total_canonmensual" type="text" class="form-control {{ $errors->has('total_canonmensual') ? ' error' : '' }}" name="total_canonmensual" value="{{ old('total_canonmensual',$espacio->total_canonmensual) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                <span id="error-total_canonmensual" class="error-total_canonmensual" style="color: rgb(220, 53, 69);"></span>
                                @if ($errors->has('total_canonmensual'))
                                    <span class="text-danger">
                                        {{ $errors->first('total_canonmensual') }}
                                    </span>
                                @endif
                            </div>
                        
                            <div class="col-md-3">
                                <label for="opcion_dcto" class="col-form-label">Opción Descuento (%) <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="opcion_dcto" type="text" class="form-control {{ $errors->has('opcion_dcto') ? ' error' : '' }}" name="opcion_dcto" value="{{ old('opcion_dcto',$espacio->opcion_dcto) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-opcion_dcto" class="error-opcion_dcto" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('opcion_dcto'))
                                        <span class="text-danger">
                                            {{ $errors->first('opcion_dcto') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="canon_dcto" class="col-form-label">Canon con Descuento <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="canon_dcto" type="text" class="form-control {{ $errors->has('canon_dcto') ? ' error' : '' }}" name="canon_dcto" value="{{ old('canon_dcto',$espacio->canon_dcto) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-canon_dcto" class="error-canon_dcto" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('canon_dcto'))
                                        <span class="text-danger">
                                            {{ $errors->first('canon_dcto') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <label for="garantia" class="col-form-label">Garantia <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="garantia" type="text" class="form-control {{ $errors->has('garantia') ? ' error' : '' }}" name="garantia" value="{{ old('garantia',$espacio->garantia) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-garantia" class="error-garantia" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('garantia'))
                                        <span class="text-danger">
                                            {{ $errors->first('garantia') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row mb-1">
                        
                            <div class="col-md-3">
                                <div class="col-sm-10">
                                    <label for="cobro_expensa" class="col-form-label">¿Cobro de Expensa? <span class="text-danger">(*)</span></label>
                                </div>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input id="cobro_expensa1"  class="form-check-input" type="radio" name="cobro_expensa" value="S" {{ old('cobro_expensa', $espacio->cobro_expensa ?? 'S') == 'S' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="tipo_canon1">Si</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="cobro_expensa2" class="form-check-input" type="radio" name="cobro_expensa" value="N" {{ old('cobro_expensa', $espacio->cobro_expensa ?? '') == 'N' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="tipo_canon2">No</label>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <label for="forma_pago" class="col-form-label">Forma de Pago <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <select id="forma_pago" class="form-control{{ $errors->has('forma_pago') ? ' error' : '' }}" name="forma_pago" disabled>
                                        <option value="">Seleccionar...</option>
                                        @foreach($formaspago as $formapago)
                                            <option value="{{ $formapago->id }}" 
                                                {{ old('forma_pago', $espacio->forma_pago) == $formapago->id ? 'selected' : '' }}>
                                                {{ $formapago->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('forma_pago'))
                                        <span class="text-danger">
                                            {{ $errors->first('forma_pago') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="numero_dia" class="col-form-label">Nro. Dias <span class="text-danger">(*)</span></label>
                                <div class="col-md-12">
                                    <input id="numero_dia" type="text" class="form-control {{ $errors->has('numero_dia') ? ' error' : '' }}" name="numero_dia" value="{{ old('numero_dia',$espacio->numero_dia) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                    <span id="error-numero_dia" class="error-numero_dia" style="color: rgb(220, 53, 69);"></span>
                                    @if ($errors->has('numero_dia'))
                                        <span class="text-danger">
                                            {{ $errors->first('numero_dia') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <div class="col-sm-10">
                                    <label for="tipo_espacio" class="col-form-label">Tipo de Espacio <span class="text-danger">(*)</span></label>
                                </div>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input id="tipo_espacio1"  class="form-check-input" type="radio" name="tipo_espacio" value="C" {{ old('tipo_espacio', $espacio->tipo_espacio ?? 'C') == 'C' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="tipo_canon1">Comercial</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="tipo_espacio2" class="form-check-input" type="radio" name="tipo_espacio" value="P" {{ old('tipo_espacio', $espacio->tipo_espacio ?? '') == 'P' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="tipo_canon2">Publicitario</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row mb-1">
                            <div id="lista_expensa" class="col-md-6" name="lista_expensa" style="">
                                <label class="col-form-label">Expensas</label>
                                <div>
                                    @foreach($expensas as $expensa)
                                    <div class="accordion-item">
                    
                                        <ul class="list-unstyled">
                                            <li>
                                                <div class="row mb-3 align-items-center">   
                                                    <div class="col-md-1">
                                                    </div>           

                                                    <div class="col-md-3">
                                                        {{--<input id="expensa{{ $expensa->id }}" class="form-check-input" type="checkbox" name="lista_expensas[{{ $expensa->id }}][expensa]" value="N" {{ ($espacio->expensa ?? '') == 'N' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="expensa{{ $expensa->id }}">&nbsp;&nbsp; {{$expensa->descripcion ?: 'Sin descripción'}}</label>--}}
                                                        <input type="hidden" name="lista_expensas[{{ $expensa->id }}][expensa]" value="0">
                                                        <input id="expensa{{ $expensa->id }}" type="checkbox" class="form-check-input" name="lista_expensas[{{ $expensa->id }}][expensa]" value="{{$expensa->id}}" {{ old('expensa', $espacio->id) == 1 ? 'checked' : '' }} disabled>
                                                        <label class="form-check-label" for="expensa{{ $expensa->id }}">&nbsp;&nbsp; {{$expensa->descripcion ?: 'Sin descripción'}}</label>
                                                    </div>

                                                    <div class="col-md-4 d-flex align-items-center">
                                                        <label for="tarifa_fija{{ $expensa->id }}" class="col-form-label me-3" for="">Tarifa Fija: </label>
                                                        <div class="form-check me-3">                                                    
                                                            <input id="tarifa_fija{{ $expensa->id }}"  class="form-check-input" type="radio" name="lista_expensas[{{ $expensa->id }}][tarifa_fija]" value="S" {{ ($espacio->tarifa_fija ?? '') == 'S' ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label" for="tipo_canon1">Sí</label>                                                                                                                                                              
                                                        </div>
                                                        <div class="form-check">                                                
                                                            <input id="tarifa_fija{{ $expensa->id }}" class="form-check-input" type="radio" name="lista_expensas[{{ $expensa->id }}][tarifa_fija]" value="N" {{ ($espacio->tarifa_fija ?? 'N') == 'N' ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label" for="tarifa_fija2">No</label>                                                            
                                                        </div>

                                                    </div>
                                                
                                                    <!-- Input de texto -->
                                                    <div class="col-md-3">
                                                        <div class="d-flex align-items-center">
                                                            <label for="monto" class="col-form-label me-2">Monto</label>
                                                            <input id="monto{{ $expensa->id }}" type="text" class="form-control {{ $errors->has('monto') ? ' error' : '' }}" name="lista_expensas[{{ $expensa->id }}][monto]" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1">
                                                    </div>   
                                                    
                                                </div>
                                            </li>
                                        </ul>
                                        
                                    </div>
                                    @endforeach
                                </div>
                            </div>                          

                            <div class="col-md-3">
                                <label for="objeto_contrato" class="col-form-label">Objeto de Contrato</label>
                                <textarea id="objeto_contrato" class="form-control {{ $errors->has('objeto_contrato') ? ' error' : '' }}" name="objeto_contrato" rows="5" disabled>{{ old('objeto_contrato',$espacio->objeto_contrato) }}</textarea>
                                <span id="error-objeto_contrato" class="error-objeto_contrato" style="color: rgb(220, 53, 69);"></span>
                                @if ($errors->has('objeto_contrato'))
                                    <span class="text-danger">
                                        {{ $errors->first('objeto_contrato') }}
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-md-3">
                                <label for="glosa_factura" class="col-form-label">Glosa para Facturación</label>
                                <textarea id="glosa_factura" class="form-control {{ $errors->has('glosa_factura') ? ' error' : '' }}" name="glosa_factura" rows="5" disabled>{{ old('glosa_factura', $espacio->glosa_factura) }}</textarea>
                                <span id="error-glosa_factura" class="error-glosa_factura" style="color: rgb(220, 53, 69);"></span>
                                @if ($errors->has('glosa_factura'))
                                    <span class="text-danger">
                                        {{ $errors->first('glosa_factura') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-1 align-items-center">
                            <div class="col-md-3 d-flex align-items-center">
                                <label for="es_aerolinea" class="col-form-label me-4">Estado para Facturar</label>
                                <input type="hidden" name="estado" value="0">
                                <input type="checkbox" class="form-check-input" disabled title="Estado del Espacio">
                            </div>
                        </div>  
                        
                        <br>
                        
                        <div class="row mt-2">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" disabled>Actualizar</button>
                                <a href="{{ route('cancelarcontratos.index') }}" class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                        
                    </form>  
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
                                    <th class="text-center">ESTADO PARA FACTURAR</th>
                                    <th class="text-center">OPCIONES</th>
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
                                        <td class="text-center col-1"><input type="checkbox" class="form-check-input" {{ $listaespacio->estado == 6 ? 'checked' : '' }} {{ ($listaespacio->estado == 6 || $listaespacio->estado == 2) ? 'disabled' : '' }} title="Estado del Espacio"></td>
                                        <td class="text-center col-1" >
                                            @can('cancelarcontratos.create_espacio')
                                                <a href="{{route('cancelarcontratos.edit_espacio', ['contrato' => $contrato->id, 'espacio' => $listaespacio->id])}}" class="btn btn-warning" title="Modificar Datos"><i class="bi bi-pencil-square"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No hay espacios registrados</td>
                                    </tr>
                                @endforelse
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
<script>
  //Asignación de Ci/Nit
  if(document.getElementById('tipo_solicitante').value === '1'){
    document.getElementById('ci_nit').value = document.getElementById('ci').value
  } else{
    document.getElementById('ci_nit').value = document.getElementById('nit').value
  }
</script>
@endsection