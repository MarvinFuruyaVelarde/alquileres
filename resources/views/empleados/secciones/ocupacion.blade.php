<div class="col-lg-4 mt-2">
    {{Form::label('formacion','Formación' )}} <span class="text-danger">(*)</span>
    <div class="d-flex align-items-center justify-content-between">
        <select name="formacion_id" id="formacion_id" class="form-control {{ $errors->has('formacion_id') ? ' error' : '' }}">
            <option value="">-- SELECCIONE --</option>
            @foreach ($formaciones as $formacion)
                <option value="{{ $formacion->id }}" {{ old('formacion_id',$empleado->formacion_id) == $formacion->id ? 'selected' : '' }}>{{ $formacion->descripcion }}</option>
            @endforeach
        </select>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formacion" title="Agregar Formacion">
            <i class="bi bi-plus-lg"></i>
        </button>
        @if ($errors->has('formacion_id'))
            <span class="text-danger">
                {{ $errors->first('formacion_id') }}
            </span>
        @endif
    </div>
</div>

<div class="col-lg-4 mt-2">
    {{Form::label('profesion','Carrera Universitaria' )}} <span class="text-danger">(*)</span>
    <div class="d-flex align-items-center justify-content-between">
    <select name="profesion_id" id="profesion_id" class="form-control {{ $errors->has('profesion_id') ? ' error' : '' }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($profesiones as $profesion)
            <option value="{{ $profesion->id }}" {{ old('profesion_id',$empleado->profesion_id) == $profesion->id ? 'selected' : '' }}>{{ $profesion->descripcion }}</option>
        @endforeach
    </select>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profesion" title="Agregar Institución">
        <i class="bi bi-plus-lg"></i>
      </button>
    @if ($errors->has('profesion_id'))
        <span class="text-danger">
            {{ $errors->first('profesion_id') }}
        </span>
    @endif
</div>
</div>

<div class="col-lg-4 mt-2 ">
    {{Form::label('institucion_formacion','Universidad o Instituto' )}} <span class="text-danger">(*)</span>
    <div class="d-flex align-items-center justify-content-between">

        <select name="institucion_formacion_id" id="institucion_formacion_id" class="form-control {{ $errors->has('institucion_formacion_id') ? ' error' : '' }}">
            <option value="">-- SELECCIONE --</option>
            @foreach ($instituciones_formacion as $institucion)
                <option value="{{ $institucion->id }}" {{ old('institucion_formacion_id',$empleado->institucion_formacion_id) == $institucion->id ? 'selected' : '' }}>{{ $institucion->descripcion }}</option>
            @endforeach
        </select>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#institutos" title="Agregar Institución">
            <i class="bi bi-plus-lg"></i>
          </button>
        @if ($errors->has('institucion_formacion_id'))
            <span class="text-danger">
                {{ $errors->first('institucion_formacion_id') }}
            </span>
        @endif
    </div>
</div>
<div class="col-12">
    {{Form::label('ultimo_empleo','Ultimo Empleo' )}} <span class="text-danger">(*)</span>
    <input type="text" name="ultimo_empleo" id="ultimo_empleo" class="form-control {{ $errors->has('ultimo_empleo') ? ' error' : '' }}" value="{{ old('ultimo_empleo',$empleado->ultimo_empleo) }}" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('ultimo_empledo'))
        <span class="text-danger">
            {{ $errors->first('ultimo_empledo') }}
        </span>
    @endif
</div>