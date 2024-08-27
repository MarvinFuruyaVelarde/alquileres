<?php $__env->startSection('titulo','Permisos de Rol'); ?>
<?php $__env->startSection('content'); ?>
<div class="pagetitle">
    <h1>Permisos de Accesso</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
        <li class="breadcrumb-item active">Permisos del rol</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Permisos habilitados</h5>
           <!--CONTENIDO -->
           <label for=""><strong><?php echo e($role->name); ?></strong></label>
           <div class="table-responsive">
            <table class="table table-bordered">
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><strong><?php echo e($permission->descripcion ?: 'Sin descripción'); ?></strong>
                            <em>(<?php echo e($permission->name); ?>)</em></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
           </div>
 
        <a href="javascript:history.back()" class="btn btn-warning btn-rounded">Volver</a>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/roles/show.blade.php ENDPATH**/ ?>