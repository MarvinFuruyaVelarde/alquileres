<?php $__env->startSection('titulo','Lista Contratos Pendientes'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>


<div class="pagetitle">
    <h1>Aprobar Contratos</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Aprobar Contratos</li>
        </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            
        </div>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Contratos para Aprobar</h5>
            <p>Cada registro tiene la opción de aprobar <i class="btn btn-success bi bi-check-square"></i> un Contrato.</p>

           <!--CONTENIDO -->
            <div class="table-responsive">
                <table cellspacing="0" width="100%" id="datos" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">AEROPUERTO</th>
                            <th class="text-center">COD. CONTRATO</th>
                            <th class="text-center">NOMBRE CLIENTE</th>
                            <th class="text-center">REPRESENTANTE</th>
                            <th class="text-center">NIT/CI</th>
                            <th class="text-center">TELEFONO/CELULAR</th>
                            <th class="text-center">CORREO</th>
                            <th class="text-center">DOMICILIO LEGAL</th>
                            <th class="text-center">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contratos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td class="text-center"><?php echo e($contrato->codigo_aeropuerto); ?></td>
                                <td class="text-center"><?php echo e($contrato->codigo_contrato); ?></td>
                                <td class="text-center"><?php echo e($contrato->nombre_cliente); ?></td>
                                <td class="text-center"><?php echo e($contrato->representante); ?></td>
                                <td class="text-center"><?php echo e($contrato->nit_ci); ?></td>
                                <td class="text-center"><?php echo e($contrato->telefono_celular); ?></td>
                                <td class="text-center"><?php echo e($contrato->correo); ?></td>
                                <td class="text-center"><?php echo e($contrato->domicilio_legal); ?></td>
                                <td class="d-flex justify-content-center" >
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('aprobarcontratos.edit')): ?>
                                        <a href="<?php echo e(route('aprobarcontratos.edit',$contrato)); ?>" class="btn btn-success" title="Aprobar Contratos"><i class="bi bi-check-square"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sistema_alquileres\resources\views/contratos/aprobar/index.blade.php ENDPATH**/ ?>