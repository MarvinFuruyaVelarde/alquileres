<?php $__env->startSection('titulo','Kardex Empleado'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Kardex Empleado</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Archivo digital</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kardex del Empleado</h5>
            <form class="row g-3">
                <h5>I. DATOS PERSONALES</h5>
                <div class="col-lg-4">
                    <?php echo e(Form::label('ap_paterno','Apellido Paterno')); ?> 
                    <input id="ap_paterno" type="text" class="form-control" name="ap_paterno" value="<?php echo e(old('ap_paterno',$empleado->ap_paterno)); ?>"  readonly>
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('ap_materno','Apellido Materno')); ?> 
                    <input id="ap_materno" type="text" class="form-control <?php echo e($errors->has('ap_materno') ? ' error' : ''); ?>" name="ap_materno" value="<?php echo e(old('ap_materno',$empleado->ap_materno)); ?>"   readonly>
                </div>           
                <div class="col-lg-4">
                    <?php echo e(Form::label('nombres','Nombres')); ?> 
                    <input id="nombres" type="text" class="form-control <?php echo e($errors->has('nombres') ? ' error' : ''); ?>" name="nombres" value="<?php echo e(old('nombres',$empleado->nombres)); ?>"   readonly>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('fecha_nacimiento','Fecha Nacimiento')); ?> 
                    <input type="date" class="form-control <?php echo e($errors->has('fecha_nacimiento') ? ' error' : ''); ?>" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo e(old('fecha_nacimiento',$empleado->fecha_nacimiento)); ?>" readonly>
                </div>
                <div class="col-lg-1">
                    <?php echo e(Form::label('edad','Edad' )); ?> 
                    <input type="number" name="edad" id="campo_edad" class="form-control" value="<?php echo e(old('edad',$empleado->edad)); ?>" readonly>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('sexo','Genero' )); ?> 
                    <input type="text" value="<?php echo e(old('sexo',$empleado->sexo) =='1' ? 'FEMENINO' :'MASCULINO'); ?>" class="form-control" readonly>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('estado_civil','Estado Civil' )); ?> 
                    
                    <input type="text" value="<?php echo e($empleado->estado_civil); ?>" class="form-control" readonly>
                </div>
                <div class="col-lg-2">
                    <?php echo e(Form::label('nro_hijos','Número hij@(s)' )); ?>

                    <input type="number" name="nro_hijos" id="nro_hijos" class="form-control" value="<?php echo e(old('nro_hijos',$empleado->nro_hijos)); ?>" readonly>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('ciudad_id','Lugar Nacimiento')); ?> 
                    <select name="ciudad_id" id="ciudad_id" class="form-control" readonly>
                        <option value="">-- SELECCIONE --</option>
                        <?php $__currentLoopData = $ciudades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($c->id); ?>" <?php echo e(old('ciudad_id',$empleado->ciudad_id) ==$c->id ? 'selected' :''); ?>><?php echo e($c->ciudad); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('provincia','Provincia')); ?>

                    <input type="text" name="provincia" id="provincia" class="form-control" readonly>
                </div>
                <div class="col-lg-2">
                    <?php echo e(Form::label('ci','C.I.' )); ?> 
                    <input type="text" class="form-control <?php echo e($errors->has('ci') ? ' error' : ''); ?>" name="ci" id="ci" value="<?php echo e(old('ci',$empleado->ci)); ?>" >
                    <?php if($errors->has('ci')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('ci')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-2">
                    <?php echo e(Form::label('ci_complemento','C.I. Complemento' )); ?>

                    <input type="text" class="form-control" name="ci_complemento" id="ci_complemento" value="<?php echo e(old('ci_complemento',$empleado->ci_complemento)); ?>" >
                </div>
                <div class="col-lg-2">
                    <?php echo e(Form::label('ci_lugar','C.I. Lugar' )); ?> 
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
                <div class="col-lg-8">
                    <?php echo e(Form::label('domicilio','Domicilio')); ?> 
                    <input type="text" name="domicilio" id="domicilio" class="form-control <?php echo e($errors->has('domicilio') ? ' error' : ''); ?>" value="<?php echo e(old('domicilio',$empleado->domicilio)); ?>" readonly>
                    <?php if($errors->has('domicilio')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('domicilio')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('nro_libreta_militar','Nro. Libreta Militar' )); ?>

                    <input type="text" name="nro_libreta_militar" id="nro_libreta_militar" class="form-control" value="<?php echo e(old('nro_libreta_militar',$empleado->nro_libreta_militar)); ?>" readonly disabled>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::label('email','Correo' )); ?> 
                    <input type="text" name="email" id="email" class="form-control <?php echo e($errors->has('email') ? ' error' : ''); ?>" value="<?php echo e(old('email',$empleado->email)); ?>">
                    <?php if($errors->has('email')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('email')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-md-2">
                    <?php echo e(Form::label('nro_celular','N°Celular' )); ?> 
                    <input type="text" name="nro_celular" id="nro_celular" class="form-control" value="<?php echo e(old('nro_celular',$empleado->nro_celular)); ?>">
                    <?php if($errors->has('nro_celular')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('nro_celular')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-md-2">
                    <?php echo e(Form::label('nro_telefono','N° Telefono' )); ?>

                    <input type="text" name="nro_telefono" id="nro_telefono" class="form-control" value="<?php echo e(old('nro_telefono',$empleado->telefono)); ?>">
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::label('redes_sociales','Cuenta Facebook/Instagram' )); ?>

                    <input type="text" name="redes_sociales" id="redes_sociales" class="form-control" value="<?php echo e(old('redes_sociales',$empleado->redes_sociales)); ?>">
                </div>
                <h5>PERSONA DE CONTACTO EN CASO DE EMERGENCIA</h5>
                <div class="col-lg-4">
                    <?php echo e(Form::label('contacto_nombre','Nombre completo' )); ?> 
                    <input type="text" name="contacto_nombre" id="contacto_nombre" class="form-control <?php echo e($errors->has('contacto_nombre') ? ' error' : ''); ?>" value="<?php echo e(old('contacto_nombre',$empleado->contacto_nombre)); ?>" readonly>
                    <?php if($errors->has('contacto_nombre')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('contacto_nombre')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('contacto_telefono','N° Telefono / Celular' )); ?> 
                    <input type="text" name="contacto_telefono" id="contacto_telefono" class="form-control <?php echo e($errors->has('contacto_telefono') ? ' error' : ''); ?>" value="<?php echo e(old('contacto_telefono',$empleado->contacto_telefono)); ?>">
                    <?php if($errors->has('contacto_telefono')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('contacto_telefono')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php echo e(Form::label('contacto_parentesco','Parentesco' )); ?> 
                    <input type="text" name="contacto_parentesco" id="contacto_parentesco" class="form-control <?php echo e($errors->has('contacto_parentesco') ? ' error' : ''); ?>" value="<?php echo e(old('contacto_parentesco',$empleado->contacto_parentesco)); ?>" readonly>
                    <?php if($errors->has('contacto_parentesco')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('contacto_parentesco')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <h5>II. OCUPACIÓN</h5>
                <div class="col-lg-6">
                    <?php echo e(Form::label('formacion','Formación' )); ?> 
                    <select name="formacion_id" id="formacion_id" class="form-control <?php echo e($errors->has('formacion_id') ? ' error' : ''); ?>">
                        <option value="">-- SELECCIONE --</option>
                        <?php $__currentLoopData = $formaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($formacion->id); ?>" <?php echo e(old('formacion_id',$empleado->formacion_id) == $formacion->id ? 'selected' : ''); ?>><?php echo e($formacion->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('formacion_id')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('formacion_id')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <?php echo e(Form::label('institucion_formacion','Universidad o Instituto' )); ?> 
                    <select name="institucion_formacion_id" id="institucion_formacion_id" class="form-control <?php echo e($errors->has('institucion_formacion_id') ? ' error' : ''); ?>">
                        <option value="">-- SELECCIONE --</option>
                        <?php $__currentLoopData = $instituciones_formacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institucion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($institucion->id); ?>" <?php echo e(old('institucion_formacion_id',$empleado->institucion_formacion_id) == $institucion->id ? 'selected' : ''); ?>><?php echo e($institucion->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('institucion_formacion_id')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('institucion_formacion_id')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <?php echo e(Form::label('ultimo_empleo','Ultimo Empleo' )); ?> 
                    <input type="text" name="ultimo_empleo" id="ultimo_empleo" class="form-control <?php echo e($errors->has('ultimo_empleo') ? ' error' : ''); ?>" value="<?php echo e(old('ultimo_empleo',$empleado->ultimo_empleo)); ?>" readonly>
                    <?php if($errors->has('ultimo_empledo')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('ultimo_empledo')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                
                <h5>III. INSTITUCIONAL</h5>
                <div class="col-lg-3">
                    <?php echo e(Form::label('fecha_ingreso','Fecha Ingreso' )); ?> 
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control <?php echo e($errors->has('fecha_ingreso') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_ingreso',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->fecha_inicio : '')); ?>">
                    <?php if($errors->has('fecha_ingreso')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('fecha_ingreso')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('fecha_conclusion','Fecha conclusion' )); ?> 
                    <input type="date" name="fecha_conclusion" id="fecha_conclusion" class="form-control <?php echo e($errors->has('fecha_conclusion') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_conclusion',count($empleado->cargo)>0 ? $empleado->cargo[0]->pivot->fecha_conclusion : '')); ?>">
                    <?php if($errors->has('fecha_conclusion')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('fecha_conclusion')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('cargo_id','Puesto' )); ?> 
                    <select name="cargo_id" id="cargo_id" class="form-control <?php echo e($errors->has('cargo_id') ? ' error' : ''); ?>" data-ruta="<?php echo e(route('tipo_cargo')); ?>">
                        <option value="">-- SELECCIONE --</option>
                        <?php $__currentLoopData = $cargos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($c->id); ?>" <?php echo e(old('cargo_id',count($empleado->cargo)>0 ? $empleado->cargo[0]->id : '') == $c->id ? 'selected' : ''); ?>><?php echo e($c->nombre); ?> (<?php echo e($c->tipo_cargo); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('cargo_id')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('cargo_id')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('nit','NIT consultor' )); ?> 
                    <input type="text" name="nit" id="nit" class="form-control <?php echo e($errors->has('nit') ? ' error' : ''); ?>" value="<?php echo e(old('nit',$empleado->nit)); ?>" disabled>
                    <?php if($errors->has('nit')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('nit')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('nro_cuenta','Número Cuenta' )); ?> 
                    <input type="text" name="nro_cuenta" id="nro_cuenta" class="form-control <?php echo e($errors->has('nro_cuenta') ? ' error' : ''); ?>" value="<?php echo e(old('nro_cuenta',$empleado->nro_cuenta)); ?>">
                    <?php if($errors->has('nro_cuenta')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('nro_cuenta')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('banco_id','Banco' )); ?> 
                    <select name="banco_id" id="banco_id" class="form-control <?php echo e($errors->has('banco_id') ? ' error' : ''); ?>">
                        <option value="">-- SELECCIONE --</option>
                        <?php $__currentLoopData = $bancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d->id); ?>" <?php echo e(old('banco_id',$empleado->banco_id) == $d->id ? 'selected' : ''); ?>><?php echo e($d->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('banco_id')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('banco_id')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('afp_id','Seguro Largo Plazo AFP' )); ?> 
                    <select name="afp_id" id="afp_id" class="form-control <?php echo e($errors->has('afp_id') ? ' error' : ''); ?>">
                        <option value="">-- SELECCIONE --</option>
                        <?php $__currentLoopData = $afps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($a->id); ?>" <?php echo e(old('afp_id',$empleado->afp_id) == $a->id ? 'selected' : ''); ?>><?php echo e($a->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('afp_id')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('afp_id')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3">
                    <?php echo e(Form::label('seguro_salud_id','Seguro de Salud' )); ?> 
                    <select name="seguro_salud_id" id="seguro_salud_id" class="form-control <?php echo e($errors->has('seguro_salud_id') ? ' error' : ''); ?>">
                        <option value="">-- SELECCIONE --</option>
                        <?php $__currentLoopData = $seguros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($e->id); ?>" <?php echo e(old('seguro_salud_id',$empleado->seguro_salud_id) == $e->id ? 'selected' : ''); ?>><?php echo e($e->descripcion); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('seguro_salud_id')): ?>
                        <span class="text-danger">
                            <?php echo e($errors->first('seguro_salud_id')); ?>

                        </span>
                    <?php endif; ?>
                </div>
               
                <hr class="mb-1">
                <div class="row mt-3">
                    <div class="col-sm-8 d-flex align-items-center justify-content-left">
                        <label for="" class="col-control-label">Empleado con discapacidad o es tutor?</label> &nbsp;&nbsp;
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios1" value="1" <?php echo e(old('discapacidad',$empleado->discapacidad) ==1 ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="gridRadios1">
                            SI
                        </label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="discapacidad" id="gridRadios2" value="0" <?php echo e(old('discapacidad',$empleado->discapacidad) ==0 ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="gridRadios2">
                            NO
                        </label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <?php if(count($discapacidad)>0): ?>
                            <a href="<?php echo e(asset('discapacidad/'.$discapacidad[0]->adjunto)); ?>" class="btn btn-primary btn-sm" target="_blank">Ver documento adjunto de discapacidad</a>
                        <?php endif; ?>
                    </div>
                </div>
                <hr class="mb-1">
                <div class="row mt-2">
                    <div class="col-lg-4">
                        <?php echo e(Form::label('fecha_registro','Fecha Registro' )); ?> 
                        <input type="date" name="fecha_registro" id="fecha_registro" class="form-control <?php echo e($errors->has('fecha_registro') ? ' error' : ''); ?>" value="<?php echo e(old('fecha_registro',$empleado->fecha_registro)); ?>">
                        <?php if($errors->has('fecha_registro')): ?>
                            <span class="text-danger">
                                <?php echo e($errors->first('fecha_registro')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
            <hr class="mb-1">
            <h5 class="text-primary">DECLARACIONES JURADAS</h5>
            <?php if(count($declaraciones)>0): ?>
            <table class="table table-hover table-bordered table-sm" width="50%">
                <thead>
                    <tr>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Ver Archivo</th>
                    </tr>
                    <?php $__currentLoopData = $declaraciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="text-center"><?php echo e(date('d-m-Y',strtotime($document->created_at))); ?></td>
                      <td class="d-flex align-items-center justify-content-center">
                        <a href="<?php echo e(asset('declaraciones_juradas/'.$document->nombre)); ?>" target="_blank"> <button class="btn btn-success btn-sm" title="Ver documento">Ver Archivo</button></a>

                        </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </thead>
            </table>
            <?php else: ?>
            <p>No existen documentos adjuntos..</p>
            <?php endif; ?>
            <hr class="mb-1">
            <h5 class="text-primary">LACTANCIA</h5>
            <?php if(count($lactancia)>0): ?>
                <a href="<?php echo e(asset('documentos_lactancia/'.$lactancia[0]->documento)); ?>" class="btn btn-primary btn-sm" target="_blank">Ver Archivo</a>
            <?php else: ?>
                <p>No tiene archivo adjunto..</p>
            <?php endif; ?>
            
            <hr class="mb-1">
            <h5 class="text-primary">REGISTRO DE ENFERMEDAD TERMINAL</h5>
            <?php if(count($enfermedad)>0): ?>
                <a href="<?php echo e(asset('enfermedades/'.$enfermedad[0]->documento)); ?>" class="btn btn-primary btn-sm" target="_blank">Ver Archivo</a>
                <?php else: ?>
                <p>No tiene archivo adjunto..</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/kardex/archivo.blade.php ENDPATH**/ ?>