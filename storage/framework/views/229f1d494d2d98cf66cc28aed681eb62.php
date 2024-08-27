
<?php $__env->startSection('titulo','Licencias'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Licencias</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Licencias</li>
        </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Solicitar Licencia</h3>
            <div class="text-center font-weight-bold">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.create')): ?>
              <a href="<?php echo e(route('licencias.createCon')); ?>" class="btn btn-primary" title="Pedir una nueva licencia">+ Licencia con Goce de Haber</a>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.create')): ?>
              <a href="<?php echo e(route('licencias.createSin')); ?>" class="btn btn-primary" title="Pedir una nueva licencia">+ Licencia sin Goce de Haber</a>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.create')): ?>
              <a href="<?php echo e(route('licencias.createVac')); ?>" class="btn btn-primary" title="Pedir una nueva licencia">+ Licencia a Cuenta de Vacacion</a>
              <?php endif; ?>
            </div>

            <br>
            <h3>Historial Solicitudes</h3>
            <br>



            <div class="table-responsive">
              <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered table-sm">
                  <thead>
                      <tr>
                          <th class="text-center">Nombre Completo</th>
                          <th class="text-center">Tipo</th>
                          <th class="text-center">Fecha Inicio</th>
                          <th class="text-center">Fecha Fin</th>
                          <th class="text-center">Motivo</th>
                          <th class="text-center">Estado</th>
                          <th class="text-center">Opciones</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php $__currentLoopData = $e->licencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $licencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                          <form action="<?php echo e(route('licencias.updateAceptar',$licencia->id)); ?>" method="PUT" enctype="multipart/form-data">

                          <tr>
                              <td><?php echo e($e->nombres); ?> <?php echo e($e->ap_paterno); ?> <?php echo e($e->ap_materno); ?></td>
                              <td class="text-center"><?php echo e($licencia->tipo); ?></td>
                              <td class="text-center"><?php echo e($licencia->fecha_inicio); ?></td>
                              <td class="text-center"><?php echo e($licencia->fecha_fin); ?></td>
                              <td class="text-center"><?php echo e($licencia->motivo); ?></td>

                              <?php if($licencia->estado == "pendiente"): ?>
                              <td class="text-center">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo e($licencia->estado); ?></button>
                              </td>
                              <?php else: ?>
                                  <?php if($licencia->estado == "denegado"): ?>
                                  <td class="text-center">
                                  <button type="button" class="btn btn-danger"><?php echo e($licencia->estado); ?></button>
                                  </td>
                                  <?php else: ?>
                                  <td class="text-center">
                                  <button type="button" class="btn btn-success"><?php echo e($licencia->estado); ?></button>
                                  </td>
                                  <?php endif; ?>
                                 <?php endif; ?>


                                 <td class="d-flex justify-content-center" >

                                  <?php if($licencia->estado != "denegado"): ?>
                                    <?php if($licencia->tipo == "con_goce"): ?>
                                    <a href="<?php echo e(route('licencias.showCon',$licencia)); ?>" class="btn btn-info" title="Documento Prenatal" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                    <?php endif; ?>
                                    <?php if($licencia->tipo == "sin_goce" ): ?>
                                    <a href="<?php echo e(route('licencias.showSin',$licencia)); ?>" class="btn btn-info" title="Documento Prenatal" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                    <?php endif; ?>
                                    <?php if($licencia->tipo == "vacacion" ): ?>
                                    <a href="<?php echo e(route('licencias.showVac',$licencia)); ?>" class="btn btn-info" title="Documento Prenatal" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                </td>
                              
                            
                          </tr>


                          
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                      </tbody>
              </table>


         </div>
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/index.blade.php ENDPATH**/ ?>