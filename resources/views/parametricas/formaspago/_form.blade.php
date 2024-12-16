<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar una forma de pago</p>
<div class="row mb-1">
    <label for="descripcion" class="col-md-4 col-form-label text-right">Descripcion: <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}" name="descripcion" value="{{ old('descripcion',$formapago->descripcion) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-input-id="descripcion" data-validate="length" data-min-length="5" data-max-length="50">
        <span id="error-descripcion" class="error-descripcion" style="color: rgb(220, 53, 69);"></span>
        @if ($errors->has('descripcion'))
            <span class="text-danger">
                {{ $errors->first('descripcion') }}
            </span>
            
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="numero_dia" class="col-md-4 col-form-label text-right ">Nro. Dias</label>
    <div class="col-md-6">
        <input id="numero_dia" type="text" class="form-control{{ $errors->has('numero_dia') ? ' error' : '' }}" name="numero_dia" value="{{ old('numero_dia',$formapago->numero_dia) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="integer">
        <span id="error-numero_dia" class="error-numero_dia" style="color: rgb(220, 53, 69);"></span>
        @if ($errors->has('numero_dia'))
            <span class="text-danger">
                {{ $errors->first('numero_dia') }}
            </span>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="numero_mes" class="col-md-4 col-form-label text-right ">Nro. Meses</label>
    <div class="col-md-6">
        <input id="numero_mes" type="text" class="form-control{{ $errors->has('numero_mes') ? ' error' : '' }}" name="numero_mes" value="{{ old('numero_mes',$formapago->numero_mes) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="integer">
        <span id="error-numero_mes" class="error-numero_mes" style="color: rgb(220, 53, 69);"></span>
        @if ($errors->has('numero_mes'))
            <span class="text-danger">
                {{ $errors->first('numero_mes') }}
            </span>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="estado" class="col-md-4 col-form-label text-right ">Estado <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <select id="estado" class="form-control{{ $errors->has('estado') ? ' error' : '' }}" name="estado">
            <option value="">Seleccionar...</option>
            @foreach($estados as $estado)
                <option value="{{ $estado->id }}" 
                    {{ old('estado', $formapago->estado) == $estado->id ? 'selected' : '' }}>
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

<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('formaspago.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>

