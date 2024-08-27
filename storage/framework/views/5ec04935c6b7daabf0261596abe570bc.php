<?php $__env->startSection('titulo','Declaración Jura'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Declaración Jurada</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Agregar Declaración</li>
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
           <form action="<?php echo e(route('declaraciones.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
           
              <div class="row mb-1">
                  <label for="nombre" class="col-md-4 col-form-label">Seleccionar Archivo de declaración: <span class="text-danger">(*)</span></label>
                  <div class="col-md-6">
                    <input type="file" name="nombre" id=""   accept="application/pdf" required>
                      <?php if($errors->has('nombre')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('nombre')); ?>

                          </span>
                          
                      <?php endif; ?>
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('codigo','Número De Certificado De D.J.B.R')); ?> <span class="text-danger">(*)</span>
                      <input id="codigo" type="text" class="form-control <?php echo e($errors->has('codigo') ? ' error' : ''); ?>" name="codigo" maxlength="8" value="<?php echo e(old('codigo')); ?>"  required onkeydown="javascript: return event.keyCode === 8 ||
                      event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                      <?php if($errors->has('codigo')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('codigo')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-4">
                  <?php echo e(Form::label('tipo','Tipo Declaración' )); ?> <span class="text-danger">(*)</span>
                  <select name="tipo" class="form-control" required>
                    <option value="" selected>-- SELECCIONE --</option>
                    <option value="1">Por Asumir</option>
                    <option value="2" >Por Actualización</option>
                    <option value="3">Después Del Ejercicio Del Cargo</option>
                  </select>
              </div>

              </div>
              <br>
              <div class="row">
                <div class="col-lg-4">
                  <?php echo e(Form::label('fecha_certificacion','Fecha De Certificación')); ?> <span class="text-danger">(*)</span>
                      <input id="fecha_certificacion" type="date" class="form-control <?php echo e($errors->has('fecha_certificacion') ? ' error' : ''); ?>" name="fecha_certificacion" value="<?php echo e(old('fecha_certificacion')); ?>"  required >
                      <?php if($errors->has('fecha_certificacion')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('fecha_certificacion')); ?>

                          </span>
                      <?php endif; ?>
                </div>
                <div class="col-lg-6">
                  <?php echo e(Form::label('fecha_presentacion','Fecha De Presentacion A Recursos Humanos')); ?> <span class="text-danger">(*)</span>
                  <input id="fecha_presentacion" type="date" class="form-control <?php echo e($errors->has('fecha_presentacion') ? ' error' : ''); ?>" name="fecha_presentacion"  value="<?php echo e(old('fecha_presentacion')); ?>"  required >
                  <?php if($errors->has('fecha_presentacion')): ?>
                      <span class="text-danger">
                          <?php echo e($errors->first('fecha_presentacion')); ?>

                      </span>
                  <?php endif; ?>
              </div>

              </div>

                  

            
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="<?php echo e(route('declaraciones.index')); ?>" class="btn btn-warning">Salir</a>
            </div>
         </form>
         <br>
         <?php if(count($declaraciones)>0): ?>
         <div class="d-flex align-items-center justify-content-between">
           <h4>Declaraciones registradas</h4>
           <?php if(count($declaraciones)>0): ?>
            <a href="<?php echo e(route('declaraciones.show', $empleado->id)); ?>" class="btn btn-primary" target="_blank">Ver Todos</a>
           <?php endif; ?>
         </div>
            <table class="table table-hover table-bordered table-sm table-responsive">
            <tr>
              <th class="text-center">Nombre documento</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Fecha registro</th>
              <th class="text-center">Opciones</th>
            </tr>
            <?php $__currentLoopData = $declaraciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?>. <?php echo e($document->nombre); ?></td>
                <?php
                switch ($document->tipo) {
                        case "1":
                        $tipo="Por Asumir";
                        break;
                        case "2":
                        $tipo="Por Actualización";
                        break;
                        case "3":
                        $tipo="Después Del Ejercicio Del Cargo";
                        break;
                }
                ?>
                <td><?php echo e($tipo); ?></td>
                <td class="text-center"><?php echo e(date('d-m-Y',strtotime($document->created_at))); ?></td>
                <td class="d-flex align-items-center justify-content-center">
                  <a href="<?php echo e(asset('declaraciones_juradas/'.$document->nombre)); ?>" target="_blank"> <button class="btn btn-success" title="Ver documento"><i class="bi bi-file-earmark-pdf"></i></button></a>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.destroy')): ?>
                  <?php echo Form::open(['route'=>['declaraciones.destroy',$document->id],'method'=>'DELETE']); ?>

                      <button class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar la DDJJ?');"><i class="bi bi-trash"></i></button>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/declaraciones/create.blade.php ENDPATH**/ ?>