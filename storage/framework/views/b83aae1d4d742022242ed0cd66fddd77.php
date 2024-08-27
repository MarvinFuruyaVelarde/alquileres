<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar un usuario, debe asignarle un rol, para que pueda solo ver y administrar la información que corresponda</p>

<h5>I. DATOS PERSONALES</h5>
<?php if(count($errors)>0): ?>
<ul>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="error"><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php endif; ?>

<?php echo $__env->make('empleados.secciones.datos_personales', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<h5>PERSONA DE CONTACTO EN CASO DE EMERGENCIA</h5>
<div class="col-lg-4 mt-1">
    <?php echo e(Form::label('contacto_nombre','Nombre completo' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="contacto_nombre" id="contacto_nombre" class="form-control <?php echo e($errors->has('contacto_nombre') ? ' error' : ''); ?>" value="<?php echo e(old('contacto_nombre',$empleado->contacto_nombre)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('contacto_nombre')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('contacto_nombre')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-4 mt-1">
    <?php echo e(Form::label('contacto_telefono','N° Telefono / Celular' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="contacto_telefono" id="contacto_telefono" class="form-control <?php echo e($errors->has('contacto_telefono') ? ' error' : ''); ?>" value="<?php echo e(old('contacto_telefono',$empleado->contacto_telefono)); ?>" onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('contacto_telefono')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('contacto_telefono')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-4 mt-1">
    <?php echo e(Form::label('contacto_parentesco','Parentesco' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="contacto_parentesco" id="contacto_parentesco" class="form-control <?php echo e($errors->has('contacto_parentesco') ? ' error' : ''); ?>" value="<?php echo e(old('contacto_parentesco',$empleado->contacto_parentesco)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    <?php if($errors->has('contacto_parentesco')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('contacto_parentesco')); ?>

        </span>
    <?php endif; ?>
</div>
<h5>II. OCUPACIÓN</h5>
<?php echo $__env->make('empleados.secciones.ocupacion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<h5>III. INSTITUCIONAL</h5>
<?php echo $__env->make('empleados.secciones.institucional', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<hr class="mb-1">
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-<?php echo e($color); ?>"><?php echo e($texto); ?></button>
        <a href="<?php echo e(route('empleados.index')); ?>" class="btn btn-warning">Cancelar</a>
    </div>
</div><?php /**PATH C:\xampp\htdocs\laravel\sistema_alquileres\resources\views/empleados/_form.blade.php ENDPATH**/ ?>