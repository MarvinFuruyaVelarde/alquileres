<?php $__env->startSection('titulo','Roles Sistema'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Roles de Acceso</h1>
    <div class="d-flex flex-row align-items-center justify-content-between mr-5">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
        </nav>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.create')): ?>
            <a href="<?php echo e(route('roles.create')); ?>" class="btn btn-primary" title="Crea un nuevo rol con sus permisos">Crear Nuevo</a>
        <?php endif; ?>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            
            <h5 class="card-title">Roles de acceso</h5>
                
           <!--CONTENIDO -->
           <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Rol</th>
                        <th class="text-center ">Descripción</th>
                        <th class="text-center" >Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="fw-bold"><?php echo e($role->name); ?></td>
                            <td class="text-wrap"><?php echo e($role->descripcion); ?></td>
                            <td class="d-flex justify-content-center" >
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.show')): ?>
                                    <a href="<?php echo e(route('roles.show',$role->id)); ?>" class="btn btn-info" title="Ver los permisos asignados al rol"><i class="bi bi-eye"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.edit')): ?>
                                    <a href="<?php echo e(route('roles.edit',$role->id)); ?>" class="btn btn-warning"title="Modificar Permisos asignados al rol" ><i class="bi bi-pencil"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.destroy')): ?>
                                    <?php echo Form::open(['route'=>['roles.destroy',$role->id],'method'=>'DELETE']); ?>

                                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                    <?php echo Form::close(); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/tablas/basica.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/roles/index.blade.php ENDPATH**/ ?>