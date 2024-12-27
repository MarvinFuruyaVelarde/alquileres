<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un usuario, debe asignarle un rol, para que pueda solo ver y administrar la información que corresponda</p>

<h5 >I. DATOS PERSONALES</h5>
<div class="row">
    <div class="col-lg-4">
      {{Form::label('name','Primer Nombre')}} <span class="text-danger">(*)</span>
          <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' error' : '' }}" name="name" maxlength="30" value="{{ old('name',$user->name) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
          @if ($errors->has('name'))
              <span class="text-danger">
                  {{ $errors->first('name') }}
              </span>
          @endif
    </div>
    <div class="col-lg-4">
        {{Form::label('segundo_nombre','Segundo Nombre')}} <span class="text-danger">(*)</span>
            <input id="segundo_nombre" type="text" class="form-control {{ $errors->has('segundo_nombre') ? ' error' : '' }}" name="segundo_nombre" maxlength="30" value="{{ old('segundo_nombre',$user->segundo_nombre) }}" onkeyup="this.value = this.value.toUpperCase();"">
            @if ($errors->has('segundo_nombre'))
                <span class="text-danger">
                    {{ $errors->first('segundo_nombre') }}
                </span>
            @endif
    </div>
    <div class="col-lg-4">
        {{Form::label('apellido_paterno','Apellido Paterno')}} <span class="text-danger">(*)</span>
            <input id="apellido_paterno" type="text" class="form-control {{ $errors->has('apellido_paterno') ? ' error' : '' }}" name="apellido_paterno" maxlength="30" value="{{ old('apellido_paterno',$user->apellido_paterno) }}" onkeyup="this.value = this.value.toUpperCase();">
            @if ($errors->has('apellido_paterno'))
                <span class="text-danger">
                    {{ $errors->first('apellido_paterno') }}
                </span>
            @endif
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4">
      {{Form::label('apellido_materno','Apellido Materno')}} <span class="text-danger">(*)</span>
          <input id="apellido_materno" type="text" class="form-control {{ $errors->has('apellido_materno') ? ' error' : '' }}" name="apellido_materno" maxlength="30" value="{{ old('apellido_materno',$user->apellido_materno) }}" onkeyup="this.value = this.value.toUpperCase();">
          @if ($errors->has('apellido_materno'))
              <span class="text-danger">
                  {{ $errors->first('apellido_materno') }}
              </span>
          @endif
    </div>
    <div class="col-lg-4">
        {{Form::label('ci','Carnet Identidad')}} <span class="text-danger">(*)</span>
            <input id="ci" type="text" class="form-control {{ $errors->has('ci') ? ' error' : '' }}" name="ci" maxlength="30" value="{{ old('ci',$user->ci) }}" onkeyup="this.value = this.value.toUpperCase();">
            @if ($errors->has('ci'))
                <span class="text-danger">
                    {{ $errors->first('ci') }}
                </span>
            @endif
    </div>
    <div class="col-lg-4">
    {{Form::label('expedido','Expedido' )}} <span class="text-danger">(*)</span>
    <select id="expedido" class="form-control{{ $errors->has('expedido') ? ' error' : '' }}" name="expedido">
        <option value="">Seleccionar...</option>
        @foreach($expedidos as $expedido)
            <option value="{{ $expedido->id }}" 
                {{ old('expedido', $user->expedido) == $expedido->id ? 'selected' : '' }}>
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
<br>
<div class="row">
    <div class="col-lg-4">
      {{Form::label('email','Correo')}} <span class="text-danger">(*)</span>
          <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' error' : '' }}" name="email" value="{{ old('email',$user->email) }}" >
          @if ($errors->has('email'))
              <span class="text-danger">
                  {{ $errors->first('email') }}
              </span>
          @endif
    </div>
    <div class="col-lg-4">
        {{Form::label('estado','Estado')}} <span class="text-danger">(*)</span>
        <select id="estado" class="form-control{{ $errors->has('estado') ? ' error' : '' }}" name="estado">
            <option value="">Seleccionar...</option>
            @foreach($estados as $estado)
                <option value="{{ $estado->id }}" 
                    {{ old('estado', $user->estado) == $estado->id ? 'selected' : '' }}>
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
    <div class="col-lg-4">
        {{Form::label('role_id','Rol')}} <span class="text-danger">(*)</span>
            <select name="role_id"  class="form-control{{ $errors->has('role_id') ? ' error' : '' }}" id="role_id" >
                <option value="">Seleccionar...</option>
                @foreach($roles as $rol)
                    <option value="{{$rol->id}}" {{ old('role_id',count($user->rol)>0 ? $user->rol[0]->id :'')== $rol->id ? 'selected' : '' }}>{{$rol->name}} <em>({{$rol->descripcion}})</em></option>
                @endforeach
            </select>
            @if ($errors->has('role_id'))
                <span class="text-danger">
                    {{ $errors->first('role_id') }}
                </span>
            @endif
        
    
    </div>
</div>
<br>
<h5 >II. ASIGNAR REGIONALES</h5>
   <!-- Accordion without outline borders --> 
   @if ($texto=='Registrar')
   <ul class="list-unstyled">
               
    <?php $cont=0; ?>
    @foreach($regionales as $regional)
  
    <?php $cont=$cont+1; ?>
    <li>
        <label>
            
            {{ Form::checkbox('regional[]', $regional->id, null, ['class' => 'form-check-input', 'id' => 'basic_checkbox_' . $cont]) }}
            &nbsp;&nbsp; {{$regional->descripcion ?: 'Sin descripción'}}
           
        </label>
    </li>
  
    @endforeach
    </ul>
       
   @else
   <ul class="list-unstyled">
               
    <?php $cont1=0; ?>
    @foreach($regionales as $regional)
  
    <?php $cont1=$cont1+1; ?>
    @php
        $verificacion=App\Models\UsuarioRegional::where('regional',$regional->id)->where('usuario',$user->id)->first();
      
    @endphp
    @if ($verificacion)
    <?php $cont=0; ?>
    <li>
        <label>
             
            {{ Form::checkbox('regional[]', $regional->id, true, ['class' => 'form-check-input', 'id' => 'basic_checkbox_' . $cont]) }}
            &nbsp;&nbsp; {{$regional->descripcion ?: 'Sin descripción'}}
        </label>
    </li>
        
    @else
    <?php $cont=0; ?>
    <li>
        <label>
             
            {{ Form::checkbox('regional[]', $regional->id, null, ['class' => 'form-check-input', 'id' => 'basic_checkbox_' . $cont]) }}
            &nbsp;&nbsp; {{$regional->descripcion ?: 'Sin descripción'}}
        </label>
    </li>
        
    @endif
    
  
    @endforeach
    </ul>
       
   @endif     
             
            



<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>
