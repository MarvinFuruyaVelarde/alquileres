

<?php $__env->startSection('titulo','Lactancia'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Lactancia</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Lactancia</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Adjuntar documentacion</h5> 
            
           <!--CONTENIDO -->
           <h6 class="text-right"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></h6>
           <hr>
            <p>Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.</p>
           <form action="<?php echo e(route('lactancias.storePrenatal')); ?>" method="POST" enctype="multipart/form-data">

            <h2>Documentacion Prenatal</h2>
            <br>
            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                    <label for="example-text-input" class="form-control-label">Certificado Medico</label>
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="documento_prenatal" id="" required  accept="application/pdf">
                    </div>
                    <br>
                    
                </div>
            </div>
                <div class="row mt-4">

                    <div class="col-md-8">
                        <div class="form-group d-flex">
                        <div class="col-md-6">
                        <?php echo e(Form::label('fecha_inicio_prenatal','Fecha Certificado Medico' )); ?> <span class="text-danger">(*)</span> 
                        </div>
                        <div class="col-md-6">
                        <input type="date" name="fecha_inicio_prenatal" id="fecha_inicio_prenatal" class="form-control <?php echo e($errors->has('fecha_inicio_prenatal') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_inicio_prenatal',$lactancia->fecha_inicio_prenatal)); ?>" required>
                        <?php if($errors->has('fecha_inicio_prenatal')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_inicio_prenatal')); ?>

                            </span>
                        <?php endif; ?>
                        </div>
                        </div>
                    </div>
                 
                </div>
               

            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

                              
          </form>
     




         
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/lactancia/createPrenatal.blade.php ENDPATH**/ ?>