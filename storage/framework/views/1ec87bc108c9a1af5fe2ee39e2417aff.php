<?php $__env->startSection('titulo','Nuevo Usuario'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>ADMINISTRACIÓN SISTEMA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>">Usuarios</a></li>
        <li class="breadcrumb-item active">Nuevo Usuario</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Usuario</h5>
           <!--CONTENIDO -->
           <?php echo Form::open(['route'=>'users.store','class'=>'form-horizontal']); ?>

                <?php echo $__env->make('users._form',['texto' => 'Registrar','tipo'=>'1','texto_pass'=>'Contraseña','color'=>'primary'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::close(); ?>

            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/forms/validacion_rol.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/users/create.blade.php ENDPATH**/ ?>