<p>Debe rellenar todos los campos</p>
<div class="row mb-1">
        <label for="name" class="col-lg-3 col-md-3 col-xs-12 col-form-label text-right ">Nombre rol<span class="text-danger text-bold">(*)</span></label>
    <div class="col-lg-7 col-md-7 col-xs-12">
        <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" id="name" value="<?php echo e(old('name',$role->name)); ?>">
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <label class="error"><?php echo e($message); ?></label>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>

<div class="row mb-1">
    <label for="descripcion" class="col-lg-3 col-md-3 col-xs-12 col-form-label text-right">Descripción<span class="text-danger text-bold">(*)</span></label>
    <div class="col-lg-9 col-md-9 col-xs-12">
        <input type="text" class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="descripcion" id=descripcion value="<?php echo e(old('descripcion',$role->descripcion)); ?>">
    </div>
</div>

<hr>

<h3>Lista de Permisos</h3>
<p>Marque los permisos que quiere asignar al Rol</p>
<div class="demo-checkbox">
    <ul class="list-unstyled">
         <?php $cont=0;?>
        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $cont=$cont+1;?>
            <li>
                <label>
                <?php echo e(Form::checkbox('permissions[]',$permission->id,null,['class'=>'form-check-input','id'=>'basic_checkbox_'.$cont])); ?>

                    <?php echo e($permission->descripcion ?: 'Sin descripción'); ?>

                    <em>(<?php echo e($permission->name); ?>)</em>
                </label>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>

</div>

<div class="text-center">

    <?php echo e(Form::submit('Guardar',['class'=>'btn btn-primary btn-round'])); ?>

    <a href="javascript:history.back()" class="btn btn-warning btn-round">Cancelar</a>

</div>
<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/roles/_form.blade.php ENDPATH**/ ?>