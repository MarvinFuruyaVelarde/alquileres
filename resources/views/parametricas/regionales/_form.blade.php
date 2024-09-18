<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar una regional</p>
<div class="row mb-1">
    <label for="codigo" class="col-md-4 col-form-label text-right ">Código <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="codigo" type="text" class="form-control{{ $errors->has('codigo') ? ' error' : '' }}" name="codigo" value="{{ old('codigo',$regional->codigo) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-input-id="codigo" data-validate="length" data-min-length="3" data-max-length="4">
        <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
        @if ($errors->has('codigo'))
            <span class="text-danger">
                {{ $errors->first('codigo') }}
            </span>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="descripcion" class="col-md-4 col-form-label text-right">Descripcion: <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}" name="descripcion" value="{{ old('descripcion',$regional->descripcion) }}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-input-id="descripcion" data-validate="length" data-min-length="12" data-max-length="50">
        <span id="error-descripcion" class="error-descripcion" style="color: rgb(220, 53, 69);"></span>
        @if ($errors->has('descripcion'))
            <span class="text-danger">
                {{ $errors->first('descripcion') }}
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
                    {{ old('estado', $regional->estado) == $estado->id ? 'selected' : '' }}>
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
        <a href="{{ route('regionales.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>

