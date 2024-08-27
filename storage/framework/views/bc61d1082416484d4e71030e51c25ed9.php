<?php $__env->startSection('titulo','Discapacidad'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Discapacidad</h1>
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
            <h5 class="card-title">Adjuntar documento de discapacidad</h5>
           <!--CONTENIDO -->
            <form action="<?php echo e(route('discapacidades.store')); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="col-sm-10">
                    <label for="" class="col-control-label">El empleado es:</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipo_discapacidad" id="gridRadios1" value="1">
                      <label class="form-check-label" for="gridRadios1">
                        Discapacitado
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipo_discapacidad" id="gridRadios2" value="2">
                      <label class="form-check-label" for="gridRadios2">
                        Tutor
                      </label>
                    </div>
                </div>
                  
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <div class="col-md-6">
                        <label for="example-text-input" class="form-control-label">Documento Persona con Discapacidad</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="documento" id="" required  accept="application/pdf">
                        </div>
                    </div>

                
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo e(route('discapacidades.index')); ?>" class="btn btn-warning">Salir</a>
                </div>

                                
            </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/discapacidad/create.blade.php ENDPATH**/ ?>