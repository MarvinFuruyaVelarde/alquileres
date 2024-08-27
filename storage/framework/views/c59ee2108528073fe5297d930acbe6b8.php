<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un usuario, debe asignarle un rol, para que pueda solo ver y administrar la información que corresponda</p>
<div class="row mb-1">
    <label for="name" class="col-md-4 col-form-label text-right">Nombre Completo: <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control <?php echo e($errors->has('name') ? ' error' : ''); ?>" name="name" value="<?php echo e(old('name',$user->name)); ?>"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
        <?php if($errors->has('name')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('name')); ?>

            </span>
            
        <?php endif; ?>
    </div>
</div>

<div class="row mb-1">
    <label for="role_id" class="col-md-4 col-form-label text-right ">Correo Electrónico <span class="text-danger">(*)</span></label>
    <div class="col-md-6">
        <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' error' : ''); ?>" name="email" value="<?php echo e(old('email',$user->email)); ?>">
        <?php if($errors->has('email')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('email')); ?>

            </span>
        <?php endif; ?>
    </div>
</div>

<div class="row mb-1">
    <label for="role_id" class="col-md-4 col-form-label text-right ">Rol <span class="text-danger">(*)</span></label>

    <div class="col-md-6 mb-0 pb-0">
        <select name="role_id"  class="form-control form-control <?php echo e($errors->has('role_id') ? ' error' : ''); ?>" id="role_id" >
            <option value="">Seleccionar...</option>
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($rol->id); ?>" <?php echo e(old('role_id',count($user->rol)>0 ? $user->rol[0]->id :'')== $rol->id ? 'selected' : ''); ?>><?php echo e($rol->name); ?> <em>(<?php echo e($rol->descripcion); ?>)</em></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">
                <?php echo e($message); ?>

            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

</div>

<div class="row mb-0">
    <label for="password" class="col-md-4 col-form-label text-right "><?php echo e($texto_pass); ?> <?php if($tipo==1): ?> <span class="text-danger">(*)</span> <?php endif; ?></label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" autocomplete="new-password">

        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">
                <?php echo e($message); ?>

            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<?php if($tipo==1): ?>
    <div class="row mt-1">
        <label for="password-confirm" class="col-md-4 col-form-label text-right "><?php echo e(__('Confirm Password')); ?> <span class="text-danger">(*)</span></label>
        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
        </div>
    </div>
<?php endif; ?>
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-<?php echo e($color); ?>"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-warning">Cancelar</a>
    </div>
</div>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/users/_form.blade.php ENDPATH**/ ?>