<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('ap_paterno','Apellido Paterno')); ?> <span class="text-danger">(*)</span>
        <input id="ap_paterno" type="text" class="form-control <?php echo e($errors->has('ap_paterno') ? ' error' : ''); ?>" name="ap_paterno" value="<?php echo e(old('ap_paterno',$empleado->ap_paterno)); ?>"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
        <?php if($errors->has('ap_paterno')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('ap_paterno')); ?>

            </span>
        <?php endif; ?>
</div>
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('ap_materno','Apellido Materno')); ?> <span class="text-danger">(*)</span>
    <input id="ap_materno" type="text" class="form-control <?php echo e($errors->has('ap_materno') ? ' error' : ''); ?>" name="ap_materno" value="<?php echo e(old('ap_materno',$empleado->ap_materno)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('ap_materno')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ap_materno')); ?>

        </span>
    <?php endif; ?>
</div>           
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nombres','Nombres')); ?> <span class="text-danger">(*)</span>
    <input id="nombres" type="text" class="form-control <?php echo e($errors->has('nombres') ? ' error' : ''); ?>" name="nombres" value="<?php echo e(old('nombres',$empleado->nombres)); ?>"   onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('nombres')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nombres')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('fecha_nacimiento','Fecha Nacimiento')); ?> <span class="text-danger">(*)</span>
    <input type="date" class="form-control <?php echo e($errors->has('fecha_nacimiento') ? ' error' : ''); ?>" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo e(old('fecha_nacimiento',$empleado->fecha_nacimiento)); ?>" onkeyup="calcularEdad();">
    <?php if($errors->has('fecha_nacimiento')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('fecha_nacimiento')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-1 mt-2">
    <?php echo e(Form::label('edad','Edad' )); ?> <span class="text-danger">(*)</span>
    <input type="number" name="edad" id="campo_edad" class="form-control" value="<?php echo e(old('edad',$empleado->edad)); ?>" readonly>

</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('sexo','Genero' )); ?> <span class="text-danger">(*)</span>
    <select name="sexo" id="sexo" class="form-control <?php echo e($errors->has('sexo') ? ' error' : ''); ?>" onchange="libretaMilitar();">
        <option value="">-- SELECCIONE --</option>
        <option value="1" <?php echo e(old('sexo',$empleado->sexo) =='1' ? 'selected' :''); ?>>Femenino</option>
        <option value="0" <?php echo e(old('sexo',$empleado->sexo) =='0' ? 'selected' :''); ?>>Masculino</option>
    </select>
    <?php if($errors->has('sexo')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('sexo')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('estado_civil','Estado Civil' )); ?> <span class="text-danger">(*)</span>
    <select name="estado_civil" id="estado_civil" class="form-control <?php echo e($errors->has('estado_civil') ? ' error' : ''); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $estados_civil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($ec->descripcion); ?>" <?php echo e(old('estado_civil',$empleado->estado_civil) ==$ec->descripcion ? 'selected' :''); ?>><?php echo e($ec->descripcion); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($errors->has('estado_civil')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('estado_civil')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-2 mt-2">
    <?php echo e(Form::label('nro_hijos','Número hij@(s)' )); ?>

     <input type="number" name="nro_hijos" id="nro_hijos" class="form-control" value="<?php echo e(old('nro_hijos',$empleado->nro_hijos)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('ciudad_id','Lugar Nacimiento')); ?> <span class="text-danger">(*)</span>
    <select name="ciudad_id" id="ciudad_id" class="form-control <?php echo e($errors->has('ciudad_id') ? ' error' : ''); ?>" data-ruta="<?php echo e(route('provincia')); ?>" data-old="<?php echo e(old('ciudad_id',$empleado->ciudad_id)); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $ciudades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($c->id); ?>" <?php echo e(old('ciudad_id',$empleado->ciudad_id) ==$c->id ? 'selected' :''); ?>><?php echo e($c->ciudad); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($errors->has('ciudad_id')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ciudad_id')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-3 mt-2">
    <?php echo e(Form::label('provincia','Provincia')); ?>

    <input type="text" name="provincia" id="provincia" class="form-control" readonly>
</div>
<div class="col-lg-2 mt-2">
    <?php echo e(Form::label('ci','C.I.' )); ?> <span class="text-danger">(*)</span>
    <input type="text" class="form-control <?php echo e($errors->has('ci') ? ' error' : ''); ?>" name="ci" id="ci" value="<?php echo e(old('ci',$empleado->ci)); ?>"  onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('ci')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ci')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-2 mt-2">
    <?php echo e(Form::label('ci_complemento','C.I. Complemento' )); ?>

    <input type="text" class="form-control" name="ci_complemento" id="ci_complemento" value="<?php echo e(old('ci_complemento',$empleado->ci_complemento)); ?>" >
</div>
<div class="col-lg-2 mt-2">
    <?php echo e(Form::label('ci_lugar','C.I. Lugar' )); ?> <span class="text-danger">(*)</span>
    <select name="ci_lugar" id="ci_lugar" class="form-control <?php echo e($errors->has('ci_lugar') ? ' error' : ''); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $lugares_ci; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($lugar->descripcion); ?>" <?php echo e(old('ci_lugar',$empleado->ci_lugar) ==$lugar->descripcion ? 'selected' :''); ?>><?php echo e($lugar->descripcion); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($errors->has('ci_lugar')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ci_lugar')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-8 mt-2">
    <?php echo e(Form::label('domicilio','Domicilio')); ?> <span class="text-danger">(*)</span>
    <input type="text" name="domicilio" id="domicilio" class="form-control <?php echo e($errors->has('domicilio') ? ' error' : ''); ?>" value="<?php echo e(old('domicilio',$empleado->domicilio)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
    <?php if($errors->has('domicilio')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('domicilio')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('nro_libreta_militar','Nro. Libreta Militar' )); ?>

    <input type="text" name="nro_libreta_militar" id="nro_libreta_militar" class="form-control" value="<?php echo e(old('nro_libreta_militar',$empleado->nro_libreta_militar)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled >
</div>
<div class="col-md-4 mt-2">
    <?php echo e(Form::label('email','Correo' )); ?> <span class="text-danger">(*)</span>
    <input type="email" name="email" id="email" class="form-control <?php echo e($errors->has('email') ? ' error' : ''); ?>" value="<?php echo e(old('email',$empleado->email)); ?>" >
    <?php if($errors->has('email')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('email')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-md-2 mt-2">
    <?php echo e(Form::label('nro_celular','N°Celular' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="nro_celular" id="nro_celular" class="form-control" value="<?php echo e(old('nro_celular',$empleado->nro_celular)); ?>" onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
    <?php if($errors->has('nro_celular')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('nro_celular')); ?>

        </span>
    <?php endif; ?>
</div>
<div class="col-md-2 mt-2">
    <?php echo e(Form::label('nro_telefono','N° Telefono' )); ?>

    <input type="text" name="nro_telefono" id="nro_telefono" class="form-control" value="<?php echo e(old('nro_telefono',$empleado->telefono)); ?>" onkeydown="javascript: return event.keyCode === 8 ||
    event.keyCode === 46 ? true : !isNaN(Number(event.key))">
</div>
<div class="col-md-4 mt-2">
    <?php echo e(Form::label('redes_sociales','Cuenta Facebook/Instagram' )); ?>

    <input type="text" name="redes_sociales" id="redes_sociales" class="form-control" value="<?php echo e(old('redes_sociales',$empleado->redes_sociales)); ?>">
</div><?php /**PATH C:\xampp\htdocs\laravel\sistema_alquileres\resources\views/empleados/secciones/datos_personales.blade.php ENDPATH**/ ?>