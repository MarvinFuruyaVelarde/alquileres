<div class="modal fade" id="nuevoCargo" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Agregar Nuevo Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storeCargo" role="form">
                <input type="hidden" id="areaIdModal">
                <input type="hidden" id="tipoCargoModal">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="nombre_cargo" class="col-control-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_cargo" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="sueldo" class="col-control-label">Sueldo</label>
                            <input type="number" step="0.01" class="form-control" id="sueldo" required>
                        </div>
                        <div class="col-6">
                            <label for="nro_item" class="col-control-label">Número Item</label>
                            <input type="number" step="0.01" class="form-control" id="nro_item" disabled>
                        </div>

                    </div>
                    <div class="col-12">
                        <label for="denominacion_cargo" class="col-control-label">Denominacion cargo</label>
                        <select name="denominacion_cargo" id="denominacion_cargo" class="form-control" required>
                            <option value="">-- SELECCIONE --</option>
                            @foreach ($denominaciones as $denominacion_cargo)
                                <option value="{{ $denominacion_cargo->id }}">{{ $denominacion_cargo->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="reset();">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>