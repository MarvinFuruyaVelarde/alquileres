<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label text-right">Nombre de Ruta</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del permiso" value="{{ $permiso->name }}"/>
    </div>
</div>
<div class="form-group row">
    <label for="descripcion" class="col-sm-3 col-form-label text-right">Descripción</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del acceso o permiso" value="{{ $permiso->descripcion }}" />
    </div>
</div>
<div class="text-center">
    <button type="submit" class="btn btn-primary btn-round"> {{ $titulo }} </button>
    <a href="javascript:history.back()" class="btn btn-warning btn-round">Cancelar</a>
</div>
