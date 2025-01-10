<?php $__env->startSection('titulo','Facturación Notas de Cobro'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Facturación Notas de Cobro</h1>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item active">Facturación Notas de Cobro</li>
            </ol>
        </nav>
    </div>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Facturación Notas de Cobro</h5>
                    <form action="<?php echo e(route('facturacion.generarFactura')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="row mb-5 align-items-center">
                            <!-- Generar / Visualizar Switches -->
                            <div class="col-12 col-md-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="check_pendiente" checked>
                                    <label class="form-check-label" for="check_pendiente">Pendiente</label>
                                </div>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="check_generado">
                                    <label class="form-check-label" for="check_generado">Generado</label>
                                </div>
                            </div>

                            <!-- Input de Fecha -->
                            <div class="col-12 col-md-2">
                                <label for="fecha" class="col-form-label">Periodo de Facturación <span class="text-danger">(*)</span></label>
                                <input id="fecha" type="date" class="form-control <?php echo e($errors->has('fecha') ? 'error' : ''); ?>" name="fecha" autofocus>
                                <?php if($errors->has('fecha')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('fecha')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="col-12 col-md-2">
                                <label for="tipo" class="col-form-label">Tipo <span class="text-danger">(*)</span></label>
                                <select id="tipo" class="form-control" name="tipo" disabled>
                                    <option value="">Seleccionar...</option>
                                    <option value="AL">ALQUILER</option>
                                    <option value="EX">EXPENSA</option>
                                    <option value="MOR">MORA</option>
                                    <option value="OTR">OTRO</option>
                                </select>
                            </div>
                        
                            <div class="col-12 col-md-2">
                                <label for="aeropuerto" class="col-form-label">Aeropuerto <span class="text-danger">(*)</span></label>
                                <select id="aeropuerto" class="form-control<?php echo e($errors->has('aeropuerto') ? ' error' : ''); ?>" name="aeropuerto" disabled>
                                    <option value="">Seleccionar...</option>
                                    <?php $__currentLoopData = $aeropuertos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aeropuerto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($aeropuerto->id); ?>">
                                            <?php echo e($aeropuerto->descripcion); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('aeropuerto')): ?>
                                    <span class="text-danger">
                                        <?php echo e($errors->first('aeropuerto')); ?>

                                    </span>
                                <?php endif; ?>                                                         
                            </div>

                            <div id="select_cliente" class="col-12 col-md-2" style="display: none;">
                                <label for="cliente" class="col-form-label">Cliente <span class="text-danger">(*)</span></label>
                                <select id="cliente" class="form-control<?php echo e($errors->has('cliente') ? ' error' : ''); ?>" name="cliente" disabled>
                                    <option value="">Seleccionar...</option>
                                </select>
                                <?php if($errors->has('cliente')): ?>
                                    <span class="text-danger">
                                        <?php echo e($errors->first('cliente')); ?>

                                    </span>
                                <?php endif; ?>            
                            </div>

                        
                            <div class="col-12 col-md-2 d-flex justify-content-center align-self-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('facturacion.buscar')): ?>
                                    <button id="buscar" type="" class="btn btn-primary me-2" disabled>BUSCAR</button>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('facturacion.generar')): ?>
                                    <button id="generar" type="" class="btn btn-success me-2" disabled>GENERAR</button>
                                <?php endif; ?> 
                            </div>
                        
                        </div>
                        <!--CONTENIDO -->
                        <div class="table-responsive">
                            <table cellspacing="0" width="100%" id="tabla" class="table table-hover table-bordered">
                                
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/tablas/basica.js')); ?>" type="text/javascript"></script>
<script>

    // Habilitar Filtro(s)
    var fechaInput = document.getElementById('fecha');
    var tipoSelect = document.getElementById('tipo');
    var aeropuertoSelect = document.getElementById('aeropuerto');
    var clienteSelect = document.getElementById('cliente');
    var buttonBuscar = document.getElementById('buscar'); 
    var buttonGenerar = document.getElementById('generar');

    // Habilitar/Deshabilitar Opción Generar o Visualizar Notas de Cobro
    document.getElementById('check_pendiente').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('check_generado').checked = false;
            document.getElementById('select_cliente').style.display = 'none';
            document.getElementById('buscar').style.display  = 'block';
            document.getElementById('generar').style.display = 'block';
            fechaInput.value = "";
            tipoSelect.disabled = true;
            tipoSelect.value = "";
            aeropuertoSelect.disabled = true;
            aeropuertoSelect.value = "";
            clienteSelect.disabled = true;
            clienteSelect.value = "";
            buttonGenerar.disabled = true;
            $('#tabla thead').remove();
            $('#tabla tbody').remove();
        }
    });

    document.getElementById('check_generado').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('check_pendiente').checked = false;  
            document.getElementById('select_cliente').style.display = 'block';   
            document.getElementById('buscar').style.display = 'block';       
            document.getElementById('generar').style.display = 'none';
            fechaInput.value = "";
            tipoSelect.disabled = true;
            tipoSelect.value = "";
            aeropuertoSelect.disabled = true;
            aeropuertoSelect.value = "";
            clienteSelect.disabled = true;
            clienteSelect.value = "";
            buttonBuscar.disabled = true;
            $('#tabla thead').remove();
            $('#tabla tbody').remove();
        }
    });

    fechaInput.addEventListener('change', function() {
        if (fechaInput.value) {
            tipoSelect.disabled = false;
        } else {
            tipoSelect.disabled = true;
            tipoSelect.value = "";
            aeropuertoSelect.disabled = true;
            aeropuertoSelect.value = "";
            clienteSelect.disabled = true;
            clienteSelect.value = "";
            buttonBuscar.disabled = true;
            $('#tabla thead').remove();
            $('#tabla tbody').remove();
        }
    });

    tipoSelect.addEventListener('change', function() {
        if (tipoSelect.value) {
            aeropuertoSelect.disabled = false;
        } else {
            aeropuertoSelect.disabled = true;
            aeropuertoSelect.value = "";
        }
    });

    aeropuertoSelect.addEventListener('change', function() {
        if (aeropuertoSelect.value) {
            buttonBuscar.disabled = false;
        } else {
            buttonBuscar.disabled = true;
        }
    });

    // Cargar Cliente, cuando seleccione el aeropuerto
    $("#aeropuerto").change(function(event) {
        getCliente($(this).val());
    });
    
    function getCliente(aeropuerto, cliente=null) {
          
        var zone = $("#cliente");
        
        $.ajax({
          url: '<?php echo e(url("notacobro/obt_cliente/")); ?>/'+aeropuerto+'/'+cliente,
          method: 'get',
          data: {'aeropuerto':aeropuerto},
          beforeSend: function(){
            zone.attr('disabled', true);
          },
          success: function (response) {
            zone.attr('disabled', false).html(response.item);
          },
         
        });
    }

    // Buscar nota de cobro dado el periodo de facturación, tipo y aeropuerto
    $("#buscar").click(function(event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto del botón (evitar submit si es necesario)

        var aeropuerto = $("#aeropuerto").val();
        var periodoFacturacion = $("#fecha").val();
        var tipo = $("#tipo").val();

         // Llamar a la función que hace la petición AJAX con estos valores
        buscarNotaCobroPendiente(aeropuerto, periodoFacturacion, tipo);
    });

    function buscarNotaCobroPendiente(aeropuerto, periodoFacturacion, tipo) {
      var tabla=$("#tabla");

      if(document.getElementById('check_pendiente').checked)
        ruta = '<?php echo e(route('facturacion.buscaNotaCobroPendiente')); ?>';
      else if(document.getElementById('check_generado').checked)
        ruta = '<?php echo e(route('facturacion.buscaNotaCobroGenerada')); ?>';
     
      $.ajax({
        url: ruta,
        method: 'get',
        data: {'aeropuerto':aeropuerto, 'periodoFacturacion':periodoFacturacion, 'tipo':tipo},
        success: function (response) {
          tabla.html(response.item1);  
        },
       
      });
    }

    // Selección masiva de nota(s) de cobro
    $(document).on('click', '#check-all', function() {
        let checkboxes = document.querySelectorAll('input[name="notacobro[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('check-all').checked;
        });
    });

    // Función para verificar si hay al menos un checkbox seleccionado para habilitar el botón Aprobar
    function verificarCheckSeleccionado() {
        let checkboxes = document.querySelectorAll('input[name="notacobro[]"]');
        let botonGenerar = document.getElementById('generar');

        // Verifica si hay algún checkbox seleccionado
        let algunoSeleccionado = Array.from(checkboxes).some(checkbox => checkbox.checked);
        
        // Si hay al menos uno seleccionado, habilita el botón
        if (algunoSeleccionado) 
            botonGenerar.disabled = false;
        else 
            botonGenerar.disabled = true;
    }

    // Habilitar botón Aprobar cuando se haya seleccionado el check masivo
    $(document).on('click', '#check-all', function() {
        let checkboxes = document.querySelectorAll('input[name="notacobro[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('check-all').checked;
        });

        verificarCheckSeleccionado(); // Verificar cuando se cambia el estado del check masivo
    });

    // Verificar si algún check individual esta seleccionado
    $(document).on('click', 'input[name="notacobro[]"]', function() {
        verificarCheckSeleccionado(); // Verificar cuando se cambia el estado de los checks individuales
    });

    // Nota(s) de Cobro seleccionada
    document.getElementById('generar').addEventListener('click', function(event) {
        // Obtener los checkboxes seleccionados
        let checkboxesSeleccionados = document.querySelectorAll('input[name="notacobro[]"]:checked');
        let notasCobroSeleccionadas = [];

        checkboxesSeleccionados.forEach(function(checkbox) {
            notasCobroSeleccionadas.push(checkbox.value);
        });

        if (notasCobroSeleccionadas.length === 0) {
            event.preventDefault(); // Prevenir el comportamiento por defecto del botón
            alert('Por favor, seleccione al menos una nota de cobro para generar.');
        } 
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sistema_alquileres\resources\views/facturacion/facturacion/index.blade.php ENDPATH**/ ?>