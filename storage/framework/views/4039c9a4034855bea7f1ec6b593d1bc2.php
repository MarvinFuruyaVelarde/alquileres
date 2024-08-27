<?php $__env->startSection('titulo','Inicio'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Inicio</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Inicio</a></li>
        <li class="breadcrumb-item active">Resúmen de Información</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section dashboard">
  <div class="row">

  <div class="col-lg-6">
    <div class="row">

      <!-- Sales Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title"># Consultores</span></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-person"></i>
              </div>
              <div class="ps-3">
                <h6><?php echo e($consultores[0]->nro_empleados); ?></h6>
                <span class="text-primary small pt-1 fw-bold"><?php echo e(number_format($consultores[0]->total_sueldo)); ?></span> <span class="text-muted small pt-2 ps-1">Bolivianos</span>
              </div>
            </div>
          </div>

        </div>
      </div><!-- End Sales Card -->

      <!-- Revenue Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card revenue-card">

          <div class="card-body">
            <h5 class="card-title"># Eventuales</span></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-currency-dollar"></i>
              </div>
              <div class="ps-3">
                <h6><?php echo e($eventuales[0]->nro_empleados); ?></h6>
                <span class="text-success small pt-1 fw-bold"><?php echo e(number_format($eventuales[0]->total_sueldo)); ?></span> <span class="text-muted small pt-2 ps-1">Bolivianos</span>

              </div>
            </div>
          </div>

        </div>
      </div><!-- End Revenue Card -->

      <!-- Customers Card -->
      <div class="col-xxl-4 col-xl-12">

        <div class="card info-card customers-card">

          <div class="card-body">
            <h5 class="card-title"># Empleados <span>| con ITEM</span></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                <h6><?php echo e($items[0]->nro_empleados); ?></h6>
                <span class="text-success small pt-1 fw-bold"><?php echo e(number_format($items[0]->total_sueldo)); ?></span> <span class="text-muted small pt-2 ps-1">Bolivianos</span>
              </div>
            </div>

          </div>
        </div>

      </div><!-- End Customers Card -->

    </div>
  </div><!-- End Left side columns -->

  <!-- Right side columns -->
  <div class="col-lg-6">

    <!-- Recent Activity -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Número de empleados por cargo</h5>

        <div class="activity">

          <div class="table-responsive">
            <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <th class="text-center"><small>Denomicación del Cargo</small></th>
                  <th class="text-center"><small>Haber básico</small></th>
                  <th class="text-center"><small>Cant. Items</small></th>
                  <th class="text-center"><small>Haber Mensual</small></th>
                  <th class="text-center"><small>Salario Anual</small></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($e->nro_empleados > 0): ?>
                  <tr>
                    <td><small><?php echo e($e->cargo); ?> (<?php echo e($e->tipo_cargo); ?>)</small></td>
                    <td class="text-center"><small><?php echo e(number_format($e->sueldo)); ?></small></td>
                    <td class="text-center"><small><?php echo e($e->nro_empleados); ?></small></td>
                    <td class="text-center"><small><?php echo e(number_format($e->sueldo * $e->nro_empleados)); ?></small></td>
                    <td class="text-center"><small><?php echo e(number_format($e->sueldo * $e->nro_empleados*12)); ?></small></td>
                  </tr>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div><!-- End Recent Activity -->

  </div>
</div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/home.blade.php ENDPATH**/ ?>