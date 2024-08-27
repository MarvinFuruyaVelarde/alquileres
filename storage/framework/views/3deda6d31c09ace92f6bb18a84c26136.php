

<?php $__env->startSection('titulo','Ficha Personal'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Ficha Firmada del Empleado</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Ficha Personal firmada</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Agregar documento</h5>
           <!--CONTENIDO -->
           <form action="<?php echo e(route('ficha_firmada.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <label for="example-text-input" class="form-control-label">Ficha firmada</label>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="documento" id=""   accept="application/pdf">
                    </div>
                </div>
            
            </div>                  
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-warning">Salir</a>
            </div>
         </form>
         <br>
            <?php if($empleado->ficha_firmada != null): ?>
            <hr>
            <div class="text-center">
              <h6>Archivo Adjunto con la Ficha Firmada</h6>
                <embed src="<?php echo e(asset('fichas_firmadas/'.$empleado->ficha_firmada)); ?>" type="application/pdf" width="420px" height="630px">

            </div>
            <?php endif; ?>

        
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/empleados/ficha_firmada.blade.php ENDPATH**/ ?>