<div class="modal fade" id="formacion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Agregar Nueva Formación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="storeFormacion" role="form">
                <div class="modal-body">
                    <div class="col-12">
                        <label for="descripcion" class="col-control-label">Nombre</label>
                        <input type="text" class="form-control" id="descripcion2" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sistema_alquileres\resources\views/empleados/modals/_modal_formacion.blade.php ENDPATH**/ ?>