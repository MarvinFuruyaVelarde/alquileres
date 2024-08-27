

<?php $__env->startSection('titulo','Nueva Licencia'); ?>
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



            <?php if($licencia_con == true): ?> 
            <h2 class="card-title">Licencia con Goce de Haberes</h2>
            <?php else: ?>
            <h2 class="card-title">Licencia sin Goce de Haberes</h2>
            <?php endif; ?>

           <!--CONTENIDO -->
           <form action="<?php echo e(route('licencias.storeLicencia')); ?>" method="POST" enctype="multipart/form-data">

            <?php if($licencia_con == true): ?> 
            <input type="hidden" name="licencia_tipo" id="licencia_tipo" value="con_goce">
             <?php else: ?>
            <input type="hidden" name="licencia_tipo" id="licencia_tipo" value="sin_goce">
             <?php endif; ?>
           
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

            <?php if($licencia_con == true): ?> 
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <?php echo e(Form::label('nombre_funcionario','Nombre Completo del Funcionario')); ?> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-6">
                        <input id="nombre_funcionario" style="text-align: center" type="text" class="form-control <?php echo e($errors->has('nombre_funcionario') ? ' error' : ''); ?>" name="nombre_funcionario"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                            <?php if($errors->has('nombre_funcionario')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('nombre_funcionario')); ?>

                                </span>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <?php echo e(Form::label('area','Area Organizacional')); ?> <span class="text-danger">(*)</span>
                    </div>
                    <div class="col-md-6">
                        <input id="area" type="text" style="text-align: center" class="form-control <?php echo e($errors->has('area') ? ' error' : ''); ?>" name="area"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                            <?php if($errors->has('area')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('area')); ?>

                                </span>
                            <?php endif; ?>
                    </div>
                </div>
            </div>

            <br>
            <div class="col-md-8">
                <div class="form-group d-flex">
                    <div class="col-md-6">
                        <?php if($licencia_con == true): ?> 
                        <?php echo e(Form::label('nombre_autoridad_o_jefe','Nombre Jefe Inmediato Superior')); ?> <span class="text-danger">(*)</span>
                        <?php else: ?>
                        <?php echo e(Form::label('nombre_autoridad_o_jefe','Nombre Autoridad Ejecutiva')); ?> <span class="text-danger">(*)</span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <input id="nombre_autoridad_o_jefe" style="text-align: center" type="text" class="form-control <?php echo e($errors->has('nombre_autoridad_o_jefe') ? ' error' : ''); ?>" name="nombre_autoridad_o_jefe"  autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return soloLetras(event);">
                            <?php if($errors->has('nombre_autoridad_o_jefe')): ?>
                                <span class="text-danger">
                                    <?php echo e($errors->first('nombre_autoridad_o_jefe')); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/createLicenciaHaber.blade.php ENDPATH**/ ?>