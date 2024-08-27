<p>Debe rellenar todos los campos</p>
<div class="row mb-1">
        <label for="name" class="col-lg-3 col-md-3 col-xs-12 col-form-label text-right ">Nombre rol<span class="text-danger text-bold">(*)</span></label>
    <div class="col-lg-7 col-md-7 col-xs-12">
        <input type="text" class="form-control @error('name') error @enderror" name="name" id="name" value="{{ old('name',$role->name) }}">
        @error('name')
            <label class="error">{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="row mb-1">
    <label for="descripcion" class="col-lg-3 col-md-3 col-xs-12 col-form-label text-right">Descripción<span class="text-danger text-bold">(*)</span></label>
    <div class="col-lg-9 col-md-9 col-xs-12">
        <input type="text" class="form-control @error('descripcion') error @enderror" name="descripcion" id=descripcion value="{{ old('descripcion',$role->descripcion) }}">
    </div>
</div>

<hr>

<h3>Lista de Permisos</h3>
<p>Marque los permisos que quiere asignar al Rol</p>
<div class="demo-checkbox">
    <ul class="list-unstyled">
         <?php $cont=0;?>
        @foreach($permissions as $permission)
        <?php $cont=$cont+1;?>
            <li>
                <label>
                {{ Form::checkbox('permissions[]',$permission->id,null,['class'=>'form-check-input','id'=>'basic_checkbox_'.$cont]) }}
                    {{$permission->descripcion ?: 'Sin descripción'}}
                    <em>({{$permission->name}})</em>
                </label>
            </li>
        @endforeach

    </ul>

</div>

<div class="text-center">

    {{ Form::submit('Guardar',['class'=>'btn btn-primary btn-round']) }}
    <a href="javascript:history.back()" class="btn btn-warning btn-round">Cancelar</a>

</div>
