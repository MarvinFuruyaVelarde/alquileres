<?php $__env->startSection('titulo','Años de Servicio'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Años de Servicio</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Años de servicio al empleado</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Agregar documento</h5>
            <h6 class="text-right"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></h6>
            <hr class="mb-1">
           <!--CONTENIDO -->
           <form action="<?php echo e(route('años_servicio.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
            <div class="row">

                <div class="col-lg-4">
                    <?php echo e(Form::label('años_servicio','Años de Servicio' )); ?> <span class="text-danger">(*)</span>
                    <input type="number" name="nro_años" id="nro_años" class="form-control <?php echo e($errors->has('nro_años') ? ' error' : ''); ?>" value="<?php echo e(old('nro_años')); ?>">
                    <?php if($errors->has('nro_años')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('nro_años')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-8 mt-4">
                    <div class=" d-flex align-items-center justify-content-center">
                        <label for="example-text-input">Documento de respaldo </label> <span class="text-danger">(*)</span> &nbsp;&nbsp;
                        <input type="file" name="archivo" class="<?php echo e($errors->has('archivo') ? ' error' : ''); ?>"   accept="application/pdf">
                        <?php if($errors->has('archivo')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('archivo')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>                  
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('años_servicio_empleados.index')); ?>" class="btn btn-warning">Salir</a>
            </div>
         </form>
         <hr>
         <?php if(count($años_servicio)>0): ?>
         <div class="d-flex align-items-center justify-content-between">
           <h4>Documentos registrados</h4>
           <?php if(count($años_servicio)>0): ?>
            <a href="<?php echo e(route('años_servicio.show', $empleado->id)); ?>" class="btn btn-primary" target="_blank">Ver Todos</a>
           <?php endif; ?>
         </div>
            <table class="table table-hover table-bordered table-sm table-responsive">
            <tr>
              <th class="text-center">Nombre documento</th>
              <th class="text-center">Nro Años</th>
              <th class="text-center">Fecha registro</th>
              <th class="text-center">Opciones</th>
            </tr>
            <?php $__currentLoopData = $años_servicio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?>. <?php echo e($document->archivo); ?></td>
                <td class="text-center"> <?php echo e($document->nro_años); ?></td>
                <td class="text-center"><?php echo e(date('d-m-Y',strtotime($document->created_at))); ?></td>
                <td class="d-flex align-items-center justify-content-center">
                  <a href="<?php echo e(asset('documentos_empleados/años_servicio/'.$document->archivo)); ?>" target="_blank"> <button class="btn btn-success" title="Ver documento"><i class="bi bi-file-earmark-pdf"></i></button></a>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('años_servicio.destroy')): ?>
                  <?php echo Form::open(['route'=>['años_servicio.destroy',$document->id],'method'=>'DELETE']); ?>

                      <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar el documento?');"><i class="bi bi-trash"></i></button>
                  <?php echo Form::close(); ?>

                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
        <?php endif; ?>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/kardex/años_create.blade.php ENDPATH**/ ?>