<div class="col-lg-4 mt-2">
    {{Form::label('ap_paterno','Apellido Paterno')}} <span class="text-danger">(*)</span>
        <input id="ap_paterno" type="text" class="form-control {{ $errors->has('ap_paterno') ? ' error' : '' }}" name="ap_paterno" value="{{ old('ap_paterno',$empleado->ap_paterno) }}"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        @if ($errors->has('ap_paterno'))
            <span class="text-danger">
                {{ $errors->first('ap_paterno') }}
            </span>
        @endif
</div>
<div class="col-lg-4 mt-2">
    {{Form::label('ap_materno','Apellido Materno')}} <span class="text-danger">(*)</span>
    <input id="ap_materno" type="text" class="form-control {{ $errors->has('ap_materno') ? ' error' : '' }}" name="ap_materno" value="{{ old('ap_materno',$empleado->ap_materno) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('ap_materno'))
        <span class="text-danger">
            {{ $errors->first('ap_materno') }}
        </span>
    @endif
</div>           
<div class="col-lg-4 mt-2">
    {{Form::label('nombres','Nombres')}} <span class="text-danger">(*)</span>
    <input id="nombres" type="text" class="form-control {{ $errors->has('nombres') ? ' error' : '' }}" name="nombres" value="{{ old('nombres',$empleado->nombres) }}"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    @if ($errors->has('nombres'))
        <span class="text-danger">
            {{ $errors->first('nombres') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('fecha_nacimiento','Fecha Nacimiento')}} <span class="text-danger">(*)</span>
    <input type="date" class="form-control {{ $errors->has('fecha_nacimiento') ? ' error' : '' }}" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento',$empleado->fecha_nacimiento) }}" onkeyup="calcularEdad();">
    @if ($errors->has('fecha_nacimiento'))
        <span class="text-danger">
            {{ $errors->first('fecha_nacimiento') }}
        </span>
    @endif
</div>
<div class="col-lg-1 mt-2">
    {{Form::label('edad','Edad' )}} <span class="text-danger">(*)</span>
    <input type="number" name="edad" id="campo_edad" class="form-control" value="{{ old('edad',$empleado->edad) }}" readonly>

</div>
<div class="col-lg-3 mt-2">
    {{Form::label('sexo','Genero' )}} <span class="text-danger">(*)</span>
    <select name="sexo" id="sexo" class="form-control {{ $errors->has('sexo') ? ' error' : '' }}" onchange="libretaMilitar();">
        <option value="">-- SELECCIONE --</option>
        <option value="1" {{ old('sexo',$empleado->sexo) =='1' ? 'selected' :'' }}>Femenino</option>
        <option value="0" {{ old('sexo',$empleado->sexo) =='0' ? 'selected' :'' }}>Masculino</option>
    </select>
    @if ($errors->has('sexo'))
        <span class="text-danger">
            {{ $errors->first('sexo') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('estado_civil','Estado Civil' )}} <span class="text-danger">(*)</span>
    <select name="estado_civil" id="estado_civil" class="form-control {{ $errors->has('estado_civil') ? ' error' : '' }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($estados_civil as $ec)
            <option value="{{$ec->descripcion}}" {{ old('estado_civil',$empleado->estado_civil) ==$ec->descripcion ? 'selected' :'' }}>{{$ec->descripcion}}</option>
        @endforeach
    </select>
    @if ($errors->has('estado_civil'))
        <span class="text-danger">
            {{ $errors->first('estado_civil') }}
        </span>
    @endif
</div>
<div class="col-lg-2 mt-2">
    {{Form::label('nro_hijos','Número hij@(s)' )}}
     <input type="number" name="nro_hijos" id="nro_hijos" class="form-control" value="{{ old('nro_hijos',$empleado->nro_hijos) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('ciudad_id','Lugar Nacimiento')}} <span class="text-danger">(*)</span>
    <select name="ciudad_id" id="ciudad_id" class="form-control {{ $errors->has('ciudad_id') ? ' error' : '' }}" data-ruta="{{ route('provincia') }}" data-old="{{ old('ciudad_id',$empleado->ciudad_id) }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($ciudades as  $c)
            <option value="{{ $c->id }}" {{ old('ciudad_id',$empleado->ciudad_id) ==$c->id ? 'selected' :'' }}>{{ $c->ciudad }}</option>
        @endforeach
    </select>
    @if ($errors->has('ciudad_id'))
        <span class="text-danger">
            {{ $errors->first('ciudad_id') }}
        </span>
    @endif
</div>
<div class="col-lg-3 mt-2">
    {{Form::label('provincia','Provincia')}}
    <input type="text" name="provincia" id="provincia" class="form-control" readonly>
</div>
<div class="col-lg-2 mt-2">
    {{Form::label('ci','C.I.' )}} <span class="text-danger">(*)</span>
    <input type="text" class="form-control {{ $errors->has('ci') ? ' error' : '' }}" name="ci" id="ci" value="{{ old('ci',$empleado->ci) }}"  onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('ci'))
        <span class="text-danger">
            {{ $errors->first('ci') }}
        </span>
    @endif
</div>
<div class="col-lg-2 mt-2">
    {{Form::label('ci_complemento','C.I. Complemento' )}}
    <input type="text" class="form-control" name="ci_complemento" id="ci_complemento" value="{{ old('ci_complemento',$empleado->ci_complemento) }}" >
</div>
<div class="col-lg-2 mt-2">
    {{Form::label('ci_lugar','C.I. Lugar' )}} <span class="text-danger">(*)</span>
    <select name="ci_lugar" id="ci_lugar" class="form-control {{ $errors->has('ci_lugar') ? ' error' : '' }}">
        <option value="">-- SELECCIONE --</option>
        @foreach ($lugares_ci as $lugar)
            <option value="{{ $lugar->descripcion }}" {{ old('ci_lugar',$empleado->ci_lugar) ==$lugar->descripcion ? 'selected' :'' }}>{{ $lugar->descripcion }}</option>
        @endforeach
    </select>
    @if ($errors->has('ci_lugar'))
        <span class="text-danger">
            {{ $errors->first('ci_lugar') }}
        </span>
    @endif
</div>
<div class="col-lg-8 mt-2">
    {{Form::label('domicilio','Domicilio')}} <span class="text-danger">(*)</span>
    <input type="text" name="domicilio" id="domicilio" class="form-control {{ $errors->has('domicilio') ? ' error' : '' }}" value="{{ old('domicilio',$empleado->domicilio) }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
    @if ($errors->has('domicilio'))
        <span class="text-danger">
            {{ $errors->first('domicilio') }}
        </span>
    @endif
</div>
<div class="col-lg-4 mt-2">
    {{Form::label('nro_libreta_militar','Nro. Libreta Militar' )}}
    <input type="text" name="nro_libreta_militar" id="nro_libreta_militar" class="form-control" value="{{ old('nro_libreta_militar',$empleado->nro_libreta_militar) }}" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled >
</div>
<div class="col-md-4 mt-2">
    {{Form::label('email','Correo' )}} <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email',$empleado->email) }}" >
    @if ($errors->has('email'))
        <span class="text-danger">
            {{ $errors->first('email') }}
        </span>
    @endif
</div>
<div class="col-md-2 mt-2">
    {{Form::label('nro_celular','N°Celular' )}} <span class="text-danger">(*)</span>
    <input type="text" name="nro_celular" id="nro_celular" class="form-control" value="{{ old('nro_celular',$empleado->nro_celular) }}" onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    @if ($errors->has('nro_celular'))
        <span class="text-danger">
            {{ $errors->first('nro_celular') }}
        </span>
    @endif
</div>
<div class="col-md-2 mt-2">
    {{Form::label('nro_telefono','N° Telefono' )}}
    <input type="text" name="nro_telefono" id="nro_telefono" class="form-control" value="{{ old('nro_telefono',$empleado->telefono) }}" onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
</div>
<div class="col-md-4 mt-2">
    {{Form::label('redes_sociales','Cuenta Facebook/Instagram' )}}
    <input type="text" name="redes_sociales" id="redes_sociales" class="form-control" value="{{ old('redes_sociales',$empleado->redes_sociales) }}">
</div>