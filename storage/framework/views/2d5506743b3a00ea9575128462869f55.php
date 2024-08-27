<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('formacion','Formación' )); ?> <span class="text-danger">(*)</span>
    <div class="d-flex align-items-center justify-content-between">
        <select name="formacion_id" id="formacion_id" class="form-control <?php echo e($errors->has('formacion_id') ? ' error' : ''); ?>">
            <option value="">-- SELECCIONE --</option>
            <?php $__currentLoopData = $formaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($formacion->id); ?>" <?php echo e(old('formacion_id',$empleado->formacion_id) == $formacion->id ? 'selected' : ''); ?>><?php echo e($formacion->descripcion); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formacion" title="Agregar Formacion">
            <i class="bi bi-plus-lg"></i>
        </button>
        <?php if($errors->has('formacion_id')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('formacion_id')); ?>

            </span>
        <?php endif; ?>
    </div>
</div>

<div class="col-lg-4 mt-2">
    <?php echo e(Form::label('profesion','Carrera Universitaria' )); ?> <span class="text-danger">(*)</span>
    <div class="d-flex align-items-center justify-content-between">
    <select name="profesion_id" id="profesion_id" class="form-control <?php echo e($errors->has('profesion_id') ? ' error' : ''); ?>">
        <option value="">-- SELECCIONE --</option>
        <?php $__currentLoopData = $profesiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($profesion->id); ?>" <?php echo e(old('profesion_id',$empleado->profesion_id) == $profesion->id ? 'selected' : ''); ?>><?php echo e($profesion->descripcion); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profesion" title="Agregar Institución">
        <i class="bi bi-plus-lg"></i>
      </button>
    <?php if($errors->has('profesion_id')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('profesion_id')); ?>

        </span>
    <?php endif; ?>
</div>
</div>

<div class="col-lg-4 mt-2 ">
    <?php echo e(Form::label('institucion_formacion','Universidad o Instituto' )); ?> <span class="text-danger">(*)</span>
    <div class="d-flex align-items-center justify-content-between">

        <select name="institucion_formacion_id" id="institucion_formacion_id" class="form-control <?php echo e($errors->has('institucion_formacion_id') ? ' error' : ''); ?>">
            <option value="">-- SELECCIONE --</option>
            <?php $__currentLoopData = $instituciones_formacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institucion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($institucion->id); ?>" <?php echo e(old('institucion_formacion_id',$empleado->institucion_formacion_id) == $institucion->id ? 'selected' : ''); ?>><?php echo e($institucion->descripcion); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#institutos" title="Agregar Institución">
            <i class="bi bi-plus-lg"></i>
          </button>
        <?php if($errors->has('institucion_formacion_id')): ?>
            <span class="text-danger">
                <?php echo e($errors->first('institucion_formacion_id')); ?>

            </span>
        <?php endif; ?>
    </div>
</div>
<div class="col-12">
    <?php echo e(Form::label('ultimo_empleo','Ultimo Empleo' )); ?> <span class="text-danger">(*)</span>
    <input type="text" name="ultimo_empleo" id="ultimo_empleo" class="form-control <?php echo e($errors->has('ultimo_empleo') ? ' error' : ''); ?>" value="<?php echo e(old('ultimo_empleo',$empleado->ultimo_empleo)); ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
    <?php if($errors->has('ultimo_empledo')): ?>
        <span class="text-danger">
            <?php echo e($errors->first('ultimo_empledo')); ?>

        </span>
    <?php endif; ?>
</div><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/empleados/secciones/ocupacion.blade.php ENDPATH**/ ?>