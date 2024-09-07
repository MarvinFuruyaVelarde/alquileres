<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un rubro</p>
<div class="row mb-1">
    <label for="descripcion" class="col-md-4 col-form-label text-right">Descripcion: <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' error' : '' }}" name="descripcion" value="{{ old('descripcion',$rubro->descripcion) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
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
                    {{ old('estado', $rubro->estado) == $estado->id ? 'selected' : '' }}>
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
        <a href="{{ route('rubros.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>

