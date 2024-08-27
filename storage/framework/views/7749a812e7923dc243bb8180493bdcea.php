<?php $__env->startSection('titulo','Documento Complementario'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Documentos Complementarios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Documento Complementario</li>
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
           <h6  class="mt-0 text-right"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></h6>
           <hr >
           <form action="<?php echo e(route('complementarios.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
            <div class="row mb-1">
                <div class="form-group d-flex">
                    <div class="col-md-4">
                        <label for="example-text-input" class="form-control-label">Documento Complementario</label><span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="nombre" id=""   accept="application/pdf" required>
                    </div>
                </div>
            </div>  
            <br>    
            <div class="col-md-12">
              <div class="form-group d-flex">
                  <div class="col-md-4">
                    <?php echo e(Form::label('descripcion','Descripcion' )); ?> <span class="text-danger">(*)</span>
                  </div>
                  <div class="col-md-8">
                    <input id="descripcion" type="text" class="form-control <?php echo e($errors->has('descripcion') ? ' error' : ''); ?>" name="descripcion" required >
                    <?php if($errors->has('descripcion')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('descripcion')); ?>

                        </span>
                    <?php endif; ?>
                  </div>
              </div>
          </div>  
      
            

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('complementarios_empleados.index')); ?>" class="btn btn-warning">Salir</a>
            </div>
         </form>
         <br>
         <?php if(count($complementarios)>0): ?>
         <div class="d-flex align-items-center justify-content-between">
           <h4>Documentos Complementarios Registrados</h4>
           <?php if(count($complementarios)>0): ?>
            <a href="<?php echo e(route('complementarios.show', $empleado->id)); ?>" class="btn btn-primary" target="_blank">Ver Todos</a>
           <?php endif; ?>
         </div>
            <table class="table table-hover table-bordered table-sm table-responsive">
            <tr>
              <th class="text-center">Nombre documento</th>
              <th class="text-center">Descripcion</th>
              <th class="text-center">Fecha registro</th>
              <th class="text-center">Opciones</th>
            </tr>
            <?php $__currentLoopData = $complementarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?>. <?php echo e($document->nombre); ?></td>
                <td><?php echo e($document->descripcion); ?></td>
                <td class="text-center"><?php echo e(date('d-m-Y',strtotime($document->created_at))); ?></td>
                <td class="d-flex align-items-center justify-content-center">
                  <a href="<?php echo e(asset('documentos_complementarios/'.$document->nombre)); ?>" target="_blank"> <button class="btn btn-success" title="Ver documento"><i class="bi bi-file-earmark-pdf"></i></button></a>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('complementarios.destroy')): ?>
                  <?php echo Form::open(['route'=>['complementarios.destroy',$document->id],'method'=>'DELETE']); ?>

                      <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar el Documento Complementario?');"><i class="bi bi-trash"></i></button>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/complementarios/create.blade.php ENDPATH**/ ?>