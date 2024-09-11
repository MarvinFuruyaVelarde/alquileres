<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un cliente</p>
<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-5">
        <label for="razon_social" class="col-form-label">Razón Social <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="razon_social" type="text" class="form-control {{ $errors->has('razon_social') ? ' error' : '' }}" name="razon_social" value="{{ old('razon_social',$cliente->razon_social) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
            @if ($errors->has('razon_social'))
                <span class="text-danger">
                    {{ $errors->first('razon_social') }}
                </span>
                
            @endif
        </div>
    </div>
    
    <div class="col-md-5">
        <label for="tipo_identificacion" class="col-form-label">Tipo de Identificación: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <select id="tipo_identificacion" class="form-control{{ $errors->has('tipo_identificacion') ? ' error' : '' }}" name="tipo_identificacion">
                <option value="">Seleccionar...</option>
                @foreach($tiposidentificacion as $tipoidentificacion)
                    <option value="{{ $tipoidentificacion->id }}" 
                        {{ old('tipo_identificacion', $cliente->tipo_identificacion) == $tipoidentificacion->id ? 'selected' : '' }}>
                        {{ $tipoidentificacion->descripcion }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('tipo_identificacion'))
                <span class="text-danger">
                    {{ $errors->first('tipo_identificacion') }}
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
        <label for="numero_identificacion" class="col-form-label">Nro. Identificación: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="numero_identificacion" type="text" class="form-control{{ $errors->has('numero_identificacion') ? ' error' : '' }}" name="numero_identificacion" value="{{ old('numero_identificacion',$cliente->numero_identificacion) }}" onkeyup="this.value = this.value.toUpperCase();">
            @if ($errors->has('numero_identificacion'))
                <span class="text-danger">
                    {{ $errors->first('numero_identificacion') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="row mb-1">
            <label for="es_aerolinea" class="col-md-4 col-form-label">¿Es Aerolínea?</label>
            <div class="col-md-8">
                <input type="hidden" name="es_aerolinea" value="0">
                <input id="es_aerolinea" type="checkbox" class="form-check-input" name="es_aerolinea" value="1" {{ old('es_aerolinea', $cliente->es_aerolinea) == 1 ? 'checked' : '' }}>
            </div>
        </div>
    
        <div class="row mb-1">
            <label for="es_pssat" class="col-md-4 col-form-label">¿Es Prestador de Servicios SAT?</label>
            <div class="col-md-8">
                <input type="hidden" name="es_pssat" value="0">
                <input id="es_pssat" type="checkbox" class="form-check-input" name="es_pssat" value="1" {{ old('es_pssat', $cliente->es_pssat) == 1 ? 'checked' : '' }}>
            </div>
        </div>
    </div>

</div>

<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-5">
        <label for="tipo_solicitante" class="col-form-label">Tipo Solicitante <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <select id="tipo_solicitante" class="form-control{{ $errors->has('tipo_solicitante') ? ' error' : '' }}" name="tipo_solicitante">
                <option value="">Seleccionar...</option>
                @foreach($tipossolicitante as $tiposolicitante)
                    <option value="{{ $tiposolicitante->id }}" 
                        {{ old('tipo_solicitante', $cliente->tipo_solicitante) == $tiposolicitante->id ? 'selected' : '' }}>
                        {{ $tiposolicitante->descripcion }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('tipo_solicitante'))
                <span class="text-danger">
                    {{ $errors->first('tipo_solicitante') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="expedido" class="col-form-label">Expedido en </label>
        <div class="col-md-11">
            <select id="expedido" class="form-control{{ $errors->has('expedido') ? ' error' : '' }}" name="expedido">
                <option value="">Seleccionar...</option>
                @foreach($expedidos as $expedido)
                    <option value="{{ $expedido->id }}" 
                        {{ old('expedido', $cliente->expedido) == $expedido->id ? 'selected' : '' }}>
                        {{ $expedido->descripcion }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('expedido'))
                <span class="text-danger">
                    {{ $errors->first('expedido') }}
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
        <label for="estado" class="col-form-label">Estado <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <select id="estado" class="form-control{{ $errors->has('estado') ? ' error' : '' }}" name="estado">
                <option value="">Seleccionar...</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}" 
                        {{ old('estado', $cliente->estado) == $estado->id ? 'selected' : '' }}>
                        {{ $estado->descripcion }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('estado'))
                <span class="text-danger">
                    {{ $errors->first('estado') }}
                </span>
            @endif
        </div>
    </div>
</div>

<br>

<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>