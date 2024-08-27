<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un usuario, debe asignarle un rol, para que pueda solo ver y administrar la información que corresponda</p>

<h5>I. DATOS PERSONALES</h5>
@if(count($errors)>0)
<ul>
    @foreach ($errors->all() as $error)
        <li class="error">{{ $error }}</li>
    @endforeach
</ul>
@endif

@include('empleados.secciones.datos_personales')

<h5>PERSONA DE CONTACTO EN CASO DE EMERGENCIA</h5>
<div class="col-lg-4 mt-1">
    {{Form::label('contacto_nombre','Nombre completo' )}} <span class="text-danger">(*)</span>
    <input type="text" name="contacto_nombre" id="contacto_nombre" class="form-control {{ $errors->has('contacto_nombre') ? ' error' : '' }}" value="{{ old('contacto_nombre',$empleado->contacto_nombre) }}" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('contacto_nombre'))
        <span class="text-danger">
            {{ $errors->first('contacto_nombre') }}
        </span>
    @endif
</div>
<div class="col-lg-4 mt-1">
    {{Form::label('contacto_telefono','N° Telefono / Celular' )}} <span class="text-danger">(*)</span>
    <input type="text" name="contacto_telefono" id="contacto_telefono" class="form-control {{ $errors->has('contacto_telefono') ? ' error' : '' }}" value="{{ old('contacto_telefono',$empleado->contacto_telefono) }}" onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('contacto_telefono'))
        <span class="text-danger">
            {{ $errors->first('contacto_telefono') }}
        </span>
    @endif
</div>
<div class="col-lg-4 mt-1">
    {{Form::label('contacto_parentesco','Parentesco' )}} <span class="text-danger">(*)</span>
    <input type="text" name="contacto_parentesco" id="contacto_parentesco" class="form-control {{ $errors->has('contacto_parentesco') ? ' error' : '' }}" value="{{ old('contacto_parentesco',$empleado->contacto_parentesco) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
    @if ($errors->has('contacto_parentesco'))
        <span class="text-danger">
            {{ $errors->first('contacto_parentesco') }}
        </span>
    @endif
</div>
<h5>II. OCUPACIÓN</h5>
@include('empleados.secciones.ocupacion')

<h5>III. INSTITUCIONAL</h5>
@include('empleados.secciones.institucional')

<hr class="mb-1">
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>