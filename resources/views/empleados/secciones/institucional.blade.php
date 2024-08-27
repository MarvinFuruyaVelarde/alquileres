<div class="col-lg-2 mt-1">
    {{Form::label('tipo_cargo','Tipo Puesto' )}} <span class="text-danger">(*)</span>
    <select name="tipo_cargo" id="tipo_cargo" class="form-control" data-old="{{ old('tipo_cargo',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.tipo_cargo'] : '') }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($tipos_cargo as $tc)
            <option value="{{ $tc->descripcion }}" {{ old('tipo_cargo',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.tipo_cargo'] : '') == $tc->descripcion ? 'selected' : '' }}>{{ $tc->descripcion }}</option>
        @endforeach
    </select>
</div>

<div class="col-lg-10 mt-1">
    {{Form::label('area','Área' )}} <span class="text-danger">(*)</span>
    <select name="area" id="area_id" class="form-control" data-old="{{ old('area',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.area_id'] : '') }}" data-ruta="{{ route('obtener_cargos') }}" >
        <option value="">-- SELECCIONE --</option>
        @foreach ($areas as $a)
            <option value="{{ $a->id }}" {{ old('cargo_id',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot['cargos.area_id'] : '') == $a->id ? 'selected' : '' }}>{{ $a->descripcion }}</option>
        @endforeach
    </select>
</div>

<div class="col-lg-12 mt-2">
    {{Form::label('cargo_id','(Denominación Cargo)--> Cargo Funcional' )}} <span class="text-danger">(*)</span>
    <div class="d-flex">
        <select name="cargo_id" id="cargo_id" class="form-control" data-old="{{ old('cargo_id',count($empleado->cargo)>0 ? $empleado->cargo[0]->id : '') }}"></select>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#nuevoCargo" title="Agregar Cargo">
            <i class="bi bi-plus-lg"></i>
        </button>
    </div>
</div>

<div class="col-lg-3 mt-2">
    {{Form::label('fecha_ingreso','Fecha Ingreso' )}} <span class="text-danger">(*)</span>
    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control {{ $errors->has('fecha_ingreso') ? ' error' : '' }}" value="{{ old('fecha_ingreso',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->fecha_inicio : '') }}">
    @if ($errors->has('fecha_ingreso'))
        <span class="text-danger">
            {{ $errors->first('fecha_ingreso') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('fecha_conclusion','Fecha conclusion' )}} 
    <input type="date" name="fecha_conclusion" id="fecha_conclusion" class="form-control {{ $errors->has('fecha_conclusion') ? ' error' : '' }}" value="{{ old('fecha_conclusion',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->fecha_conclusion : '') }}">
    @if ($errors->has('fecha_conclusion'))
        <span class="text-danger">
            {{ $errors->first('fecha_conclusion') }}
        </span>
    @endif
</div>

<div class="col-lg-3 mt-2">
    {{Form::label('nit','Nro de NIT' )}} 
    <input type="text" name="nit" id="nit" class="form-control {{ $errors->has('nit') ? ' error' : '' }}" value="{{ old('nit',$empleado->nit) }}" disabled onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('nit'))
        <span class="text-danger">
            {{ $errors->first('nit') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('nro_cuenta','Número Cuenta' )}} <span class="text-danger">(*)</span>
    <input type="text" name="nro_cuenta" id="nro_cuenta" class="form-control {{ $errors->has('nro_cuenta') ? ' error' : '' }}" value="{{ old('nro_cuenta',$empleado->nro_cuenta) }}" onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('nro_cuenta'))
        <span class="text-danger">
            {{ $errors->first('nro_cuenta') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('banco_id','Banco' )}} <span class="text-danger">(*)</span>
    <select name="banco_id" id="banco_id" class="form-control {{ $errors->has('banco_id') ? ' error' : '' }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($bancos as $d)
            <option value="{{ $d->id }}" {{ old('banco_id',$empleado->banco_id) == $d->id ? 'selected' : '' }}>{{ $d->descripcion }}</option>
        @endforeach
    </select>
    @if ($errors->has('banco_id'))
        <span class="text-danger">
            {{ $errors->first('banco_id') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('afp_id','Seguro Largo Plazo AFP' )}} <span class="text-danger">(*)</span>
    <select name="afp_id" id="afp_id" class="form-control {{ $errors->has('afp_id') ? ' error' : '' }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($afps as $a)
            <option value="{{ $a->id }}" {{ old('afp_id',$empleado->afp_id) == $a->id ? 'selected' : '' }}>{{ $a->descripcion }}</option>
        @endforeach
    </select>
    @if ($errors->has('afp_id'))
        <span class="text-danger">
            {{ $errors->first('afp_id') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('seguro_salud_id','Seguro de Salud' )}} <span class="text-danger">(*)</span>
    <select name="seguro_salud_id" id="seguro_salud_id" class="form-control {{ $errors->has('seguro_salud_id') ? ' error' : '' }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($seguros as $e)
            <option value="{{ $e->id }}" {{ old('seguro_salud_id',$empleado->seguro_salud_id) == $e->id ? 'selected' : '' }}>{{ $e->descripcion }}</option>
        @endforeach
    </select>
    @if ($errors->has('seguro_salud_id'))
        <span class="text-danger">
            {{ $errors->first('seguro_salud_id') }}
        </span>
    @endif
</div>
<hr class="mb-1">
<div class="row mt-3">
    <div class="col-lg-6">
        @if(isset($empleado->foto))
            <label for="foto" class="">Cambiar Fotografía</label>
        @else
            <label for="foto" class="">Seleccionar archivo o captura de la foto del empleado</label>
        @endif
        <input type="file" name="foto" id="foto" type="file" class="{{ $errors->has('foto') ? ' error' : '' }}" id="foto" accept="image/*;capture=camera"accept="image/*" value="{{ old('foto') }}">
        @if ($errors->has('foto'))
            <span class="text-danger">
                {{ $errors->first('foto') }}
            </span>
        @endif
    </div>
    <div class="col-lg 4">
        @if (isset($empleado->foto))
        <img id="imagen" src="{{ asset('fotos_empleados/'.$empleado->id.'/'.$empleado->foto) }}" width="100px" height="100px">
        @else
        <img id="imagen" src="{{ asset('assets/img/sin_foto.png') }}" width="100px" height="100px">
        @endif
    </div>
</div>
<hr class="mb-1">
<div class="row mt-3">
    <div class="col-sm-10 d-flex align-items-center justify-content-left">
        <label for="" class="col-control-label">Empleado con discapacidad o es tutor?</label> &nbsp;&nbsp;
        <div class="form-check">
          <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios1" value="1" {{ old('discapacidad',$empleado->discapacidad) ==1 ? 'checked' : ''  }}>
          <label class="form-check-label" for="gridRadios1">
            SI
          </label>
        </div>&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="form-check">
          <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios2" value="0" {{ old('discapacidad',$empleado->discapacidad) ==0 ? 'checked' : ''  }}>
          <label class="form-check-label" for="gridRadios2">
            NO
          </label>
        </div>
    </div>
</div>
<hr class="mb-1">
<div class="row mt-2">
    <div class="col-lg-4">
        {{Form::label('fecha_registro','Fecha Registro' )}} <span class="text-danger">(*)</span>
        <input type="date" name="fecha_registro" id="fecha_registro" class="form-control {{ $errors->has('fecha_registro') ? ' error' : '' }}" value="{{ old('fecha_registro',$empleado->fecha_registro) }}" >
        @if ($errors->has('fecha_registro'))
            <span class="text-danger">
                {{ $errors->first('fecha_registro') }}
            </span>
        @endif
    </div>
</div>