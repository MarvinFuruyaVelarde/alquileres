

<?php $__env->startSection('titulo','Enfermedad Terminal'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Enfermedad Terminal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Documento</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Adjuntar documento de Enfermedad Terminal</h5>
             <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>
           <!--CONTENIDO -->
            <form action="<?php echo e(route('enfermedades.store')); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
                <?php echo e(csrf_field()); ?>

                  
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <div class="col-md-6">
                            <label for="example-text-input" class="form-control-label">Documento de Enfermedad Terminal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="documento" id="" required  accept="application/pdf">
                        </div>
                    </div>
                </div>

                <br>
                <div class="col-md-8">
                  <div class="form-group d-flex">
                  <div class="col-md-6">
                    <?php echo e(Form::label('descripcion','Descripcion')); ?> <span class="text-danger">(*)</span> 
                  </div>
                  <div class="col-md-6">
                    <input id="descripcion" type="text" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" name="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" required>
                    <?php if($errors->has('descripcion')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('descripcion')); ?>

                        </span>
                    <?php endif; ?>
                  </div>
                  </div>
              </div>


              <br>
                <div class="col-md-8">
                  <div class="form-group d-flex">
                  <div class="col-md-6">
                    <?php echo e(Form::label('nombre_medico','Nombre Medico')); ?> <span class="text-danger">(*)</span>
                  </div>
                  <div class="col-md-6">
                    <input id="nombre_medico" type="text" class="form-control <?php echo e($errors->has('nombre_medico') ? ' error' : ''); ?>" name="nombre_medico"  onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" required>
                      <?php if($errors->has('nombre_medico')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('nombre_medico')); ?>

                          </span>
                      <?php endif; ?>
                  </div>
                  </div>
              </div>



              <br>
                <div class="col-md-8">
                  <div class="form-group d-flex">
                  <div class="col-md-6">
                    <?php echo e(Form::label('institucion','Institución')); ?> <span class="text-danger">(*)</span>
                  </div>
                  <div class="col-md-6">
                    <input id="institucion" type="text" class="form-control <?php echo e($errors->has('institucion') ? ' error' : ''); ?>" name="institucion"  onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);" required>
                      <?php if($errors->has('institucion')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('institucion')); ?>

                          </span>
                      <?php endif; ?>
                  </div>
                  </div>
              </div>

              <br>
              <div class="col-md-8">
                <div class="form-group d-flex">
                <div class="col-md-6">
                <?php echo e(Form::label('fecha_inicio_enfermedad','Fecha Inicio Enfermedad,' )); ?> <span class="text-danger">(*)</span> 
                </div>
                <div class="col-md-6">
                <input type="date" name="fecha_inicio_enfermedad" id="fecha_inicio_enfermedad" class="form-control <?php echo e($errors->has('fecha_inicio_enfermedad') ? ' error' : ''); ?>"  required>
                <?php if($errors->has('fecha_inicio_enfermedad')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('fecha_inicio_enfermedad')); ?>

                    </span>
                <?php endif; ?>
                </div>
                </div>
            </div>







                
                
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo e(route('enfermedades.index')); ?>" class="btn btn-warning">Salir</a>
                </div>

                <br>
                <?php if($enfermedad != null): ?>
                <hr>
                <div class="text-center">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6>Archivo Adjunto con la Ficha Firmada</h6>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discapacidades.destroy')): ?>
                        <a href="<?php echo e(route('enfermedades.destroy',$enfermedad[0]->id)); ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar el documento?');">Eliminar documento</a>

                        <?php endif; ?>

                    </div>
                    <embed src="<?php echo e(asset('enfermedades/'.$enfermedad[0]->documento)); ?>" type="application/pdf" width="420px" height="630px">
    
                </div>
                <?php endif; ?>
        
            </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/enfermedades/create.blade.php ENDPATH**/ ?>