<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un usuario, debe asignarle un rol, para que pueda solo ver y administrar la información que corresponda</p>
<div class="row mb-1">
    <label for="name" class="col-md-4 col-form-label text-right">Nombre Completo: <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' error' : '' }}" name="name" value="{{ old('name',$user->name) }}"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
        @if ($errors->has('name'))
            <span class="text-danger">
                {{ $errors->first('name') }}
            </span>
            
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="role_id" class="col-md-4 col-form-label text-right ">Correo Electrónico <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' error' : '' }}" name="email" value="{{ old('email',$user->email) }}">
        @if ($errors->has('email'))
            <span class="text-danger">
                {{ $errors->first('email') }}
            </span>
        @endif
    </div>
</div>

<div class="row mb-1">
    <label for="role_id" class="col-md-4 col-form-label text-right ">Rol <span class="text-danger">(*)</span></label>

    <div class="col-md-6 mb-0 pb-0">
        <select name="role_id"  class="form-control form-control {{ $errors->has('role_id') ? ' error' : '' }}" id="role_id" >
            <option value="">Seleccionar...</option>
            @foreach($roles as $rol)
                <option value="{{$rol->id}}" {{ old('role_id',count($user->rol)>0 ? $user->rol[0]->id :'')== $rol->id ? 'selected' : '' }}>{{$rol->name}} <em>({{$rol->descripcion}})</em></option>
            @endforeach
        </select>
        @error('role_id')
            <span class="text-danger">
                {{$message}}
            </span>
        @enderror
    </div>

</div>

<div class="row mb-0">
    <label for="password" class="col-md-4 col-form-label text-right ">{{ $texto_pass }} @if($tipo==1) <span class="text-danger">(*)</span> @endif</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') error @enderror" name="password" autocomplete="new-password">

        @error('password')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
@if($tipo==1)
    <div class="row mt-1">
        <label for="password-confirm" class="col-md-4 col-form-label text-right ">{{ __('Confirm Password') }} <span class="text-danger">(*)</span></label>
        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
        </div>
    </div>
@endif
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>
