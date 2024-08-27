<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('home')); ?>" href="<?php echo e(route('home')); ?>">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-heading">ADMINISTRACIÓN PERSONAL</li>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['empleados.*'])); ?>" data-bs-target="#empleados-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-plus"></i><span>Registro Funcionarios</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="empleados-nav" class="nav-content collapse <?php echo e(mostrar(['empleados.*'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('empleados.create')): ?>
          <li>
            <a href="<?php echo e(route('empleados.create')); ?>" class="<?php echo e(isActiveSubMenu('empleados.create')); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['empleados.index','empleados.edit','empleados.ficha'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Todos</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['documentos*.*'])); ?>" data-bs-target="#documentos-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-text"></i><span>Documentación</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="documentos-nav" class="nav-content collapse <?php echo e(mostrar(['documentos*.*'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documentos.create')): ?>
          <li>
            <a href="<?php echo e(route('documentos_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['documentos_empleados.index','documentos.create'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('documentos.index')); ?>" class="<?php echo e(isActiveSubMenu(['documentos.index','documentos.edit'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Todos</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('declaraciones.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('declaraciones*.*')); ?>" href="<?php echo e(route('declaraciones.index')); ?>">
          <i class="bi bi-grid"></i>
          <span>Declaraciones Juradas</span>
        </a>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.index')): ?>
        <li class="nav-heading">ADMINISTRACIÓN SISTEMA</li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('users.*')); ?>" href="<?php echo e(route('users.index')); ?>">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
          </a>
        </li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.index')): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(isActiveRoute('roles.*')); ?>" href="<?php echo e(route('roles.index')); ?>">
            <i class="bi bi-gear"></i>
            <span>Roles</span>
          </a>
        </li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>

  </aside><!-- End Sidebar--><?php /**PATH C:\xampp\htdocs\laravel\sistema_alquileres\resources\views/layouts/partials/menu.blade.php ENDPATH**/ ?>