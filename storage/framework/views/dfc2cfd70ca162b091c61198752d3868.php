

<?php $__env->startSection('titulo','Nuevo Empleado'); ?>
<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>LICENCIAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('empleados.index')); ?>">Licencias</a></li>
        <li class="breadcrumb-item active">Peticion Licencia</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <br>



            <h2 class="card-title">Licencia a Cuenta de Vacacion</h2>
        

           <!--CONTENIDO -->
           <form action="<?php echo e(route('licencias.storeLicenciaVac')); ?>" method="POST" enctype="multipart/form-data">

            <br>
            <input type="hidden" name="empleado_id" id="empleado_id">
            <?php echo e(csrf_field()); ?>


            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <?php echo e(Form::label('empleado_id','Empleado id')); ?> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-6">
                        <input id="empleado_id" style="text-align: center" type="text" class="form-control <?php echo e($errors->has('empleado_id') ? ' error' : ''); ?>" name="empleado_id"  autofocus>
                            <?php if($errors->has('empleado_id')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('empleado_id')); ?>

                                </span>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
            <br>

            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <?php echo e(Form::label('dependiente','Dependiente de')); ?> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-6">
                        <input id="dependiente" style="text-align: center" type="text" class="form-control <?php echo e($errors->has('dependiente') ? ' error' : ''); ?>" name="dependiente"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                            <?php if($errors->has('dependiente')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('dependiente')); ?>

                                </span>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
         
            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <?php echo e(Form::label('numero_dias','Numero de Dias')); ?> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-6">
                        <input id="numero_dias" type="text" style="text-align: center" class="form-control <?php echo e($errors->has('numero_dias') ? ' error' : ''); ?>" name="numero_dias"  autofocus >
                            <?php if($errors->has('numero_dias')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('numero_dias')); ?>

                                </span>
                            <?php endif; ?>
                    </div>
                </div>
            </div>

            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <?php echo e(Form::label('a_cuenta','A cuenta de Vacaciones')); ?> <span class="text-danger">(*)</span>
                    
                    </div>
                    <div class="col-md-6">
                        <input id="a_cuenta" style="text-align: center" type="text" class="form-control <?php echo e($errors->has('a_cuenta') ? ' error' : ''); ?>" name="a_cuenta"  autofocus>
                            <?php if($errors->has('a_cuenta')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('a_cuenta')); ?>

                                </span>
                            <?php endif; ?>
                    </div>
                </div>
            </div>

            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                <div class="col-md-6">
                <?php echo e(Form::label('fecha_inicio','Desde el dia' )); ?> <span class="text-danger">(*)</span> 
                </div>
                <div class="col-md-6">
                <input type="date" style="text-align: center" name="fecha_inicio" id="fecha_inicio" class="form-control <?php echo e($errors->has('fecha_inicio') ? ' error' : ''); ?>" required>
                <?php if($errors->has('fecha_inicio')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('fecha_inicio')); ?>

                    </span>
                <?php endif; ?>
                </div>
                </div>
            </div>


            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                <div class="col-md-6">
                <?php echo e(Form::label('fecha_fin','Hasta el dia' )); ?> <span class="text-danger">(*)</span> 
                </div>
                <div class="col-md-6">
                <input type="date" style="text-align: center" name="fecha_fin" id="fecha_fin" class="form-control <?php echo e($errors->has('fecha_fin') ? ' error' : ''); ?>" required>
                <?php if($errors->has('fecha_fin')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('fecha_fin')); ?>

                    </span>
                <?php endif; ?>
                </div>
                </div>
            </div>

            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <?php echo e(Form::label('motivo','Motivo')); ?> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-6">
                        <input id="motivo" style="text-align: center" type="text" class="form-control <?php echo e($errors->has('motivo') ? ' error' : ''); ?>" name="motivo"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                            <?php if($errors->has('motivo')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('motivo')); ?>

                                </span>
                            <?php endif; ?>
                    </div>
                </div>
            </div>

               

            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                <div class="col-md-6">
                <?php echo e(Form::label('hora_inicio_manana','Mañana Hora Inicio' )); ?> <span class="text-danger">(*)</span> 
                </div>
                <div class="col-md-6">
                <input type="time" style="text-align: center" name="hora_inicio_manana" id="hora_inicio_manana" class="form-control <?php echo e($errors->has('hora_inicio_manana') ? ' error' : ''); ?>" required>
                <?php if($errors->has('hora_inicio_manana')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('hora_inicio_manana')); ?>

                    </span>
                <?php endif; ?>
                </div>
                </div>
            </div>
            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                <div class="col-md-6">
                <?php echo e(Form::label('hora_fin_manana','Mañana Hora Fin' )); ?> <span class="text-danger">(*)</span> 
                </div>
                <div class="col-md-6">
                <input type="time" style="text-align: center" name="hora_fin_manana" id="hora_fin_manana" class="form-control <?php echo e($errors->has('hora_fin_manana') ? ' error' : ''); ?>" required>
                <?php if($errors->has('hora_fin_manana')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('hora_fin_manana')); ?>

                    </span>
                <?php endif; ?>
                </div>
                </div>
            </div>



            
            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                <div class="col-md-6">
                <?php echo e(Form::label('hora_inicio_tarde','Tarde Hora Inicio' )); ?> <span class="text-danger">(*)</span> 
                </div>
                <div class="col-md-6">
                <input type="time" style="text-align: center" name="hora_inicio_tarde" id="hora_inicio_tarde" class="form-control <?php echo e($errors->has('hora_inicio_tarde') ? ' error' : ''); ?>" required>
                <?php if($errors->has('hora_inicio_tarde')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('hora_inicio_tarde')); ?>

                    </span>
                <?php endif; ?>
                </div>
                </div>
            </div>
            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                <div class="col-md-6">
                <?php echo e(Form::label('hora_fin_tarde','Tarde Hora Fin' )); ?> <span class="text-danger">(*)</span> 
                </div>
                <div class="col-md-6">
                <input type="time" style="text-align: center" name="hora_fin_tarde" id="hora_fin_tarde" class="form-control <?php echo e($errors->has('hora_fin_tarde') ? ' error' : ''); ?>" required>
                <?php if($errors->has('hora_fin_tarde')): ?>
                    <span class="text-danger">
                        <?php echo e($errors->first('hora_fin_tarde')); ?>

                    </span>
                <?php endif; ?>
                </div>
                </div>
            </div>





            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

                              
          </form>
            <!-- EndCONTENIDO Example -->











          </div>
        </div>
      </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/forms/empleadosControlCampos.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>" type="text/javascript"></script>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/createLicenciaVacacion.blade.php ENDPATH**/ ?>