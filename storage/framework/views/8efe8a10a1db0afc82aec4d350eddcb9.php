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
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('complementarios.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute('complementarios*.*')); ?>" href="<?php echo e(route('complementarios_empleados.index')); ?>">
          <i class="bi bi-grid"></i>
          <span>Documentos Complementarios</span>
        </a>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discapacidades.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['discapacidades*.*'])); ?>" data-bs-target="#discapacidades-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-check"></i><span>Registro Discapacidades</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="discapacidades-nav" class="nav-content collapse <?php echo e(mostrar(['discapacidades*.*'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discapacidades.create')): ?>
          <li>
            <a href="<?php echo e(route('discapacidades_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['discapacidades_empleados.index','discapacidades.create'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('discapacidades.index')); ?>" class="<?php echo e(isActiveSubMenu(['discapacidades.index','discapacidades.edit'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Registrados</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['lactancias*.*'])); ?>" data-bs-target="#lactancias-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-suit-heart"></i><span>Registro lactancia</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="lactancias-nav" class="nav-content collapse <?php echo e(mostrar(['lactancias*.*'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lactancias.create')): ?>
          <li>
            <a href="<?php echo e(route('lactancias_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias_empleados.index','lactancias.create'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('lactancias.index')); ?>" class="<?php echo e(isActiveSubMenu(['lactancias.index','lactancias.edit'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Registrados</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('enfermedad.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['enfermedad*.*','buscar_empleado'])); ?>" data-bs-target="#enfermedad-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bookmark-x"></i><span>Registro Enfermedad Terminal</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="enfermedad-nav" class="nav-content collapse <?php echo e(mostrar(['enfermedad*.*','buscar_empleado'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('enfermedad.create')): ?>
          <li>
            <a href="<?php echo e(route('enfermedades.index')); ?>" class="<?php echo e(isActiveSubMenu(['enfermedades.index','enfermedades.create','buscar_empleado','enfermedades.store'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('enfermedades_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['enfermedades_empleados.index'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Registrados</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('kardex.index')): ?>
      <li class="nav-heading">KARDEX</li>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['kardex*.*','años_servicio*.*'])); ?>" data-bs-target="#kardex-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Kardex</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kardex-nav" class="nav-content collapse <?php echo e(mostrar(['kardex*.*','años_servicio*.*'])); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(route('kardex.index')); ?>" class="<?php echo e(isActiveSubMenu(['kardex.index','kardex.show'])); ?>">
              <i class="bi bi-circle"></i><span>Archivo Digital</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('años_servicio_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['años_servicio*.*'])); ?>">
              <i class="bi bi-circle"></i><span>Años de Servicio</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>



   
      <li class="nav-heading">LICENCIAS</li>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencias.index')): ?>
      <li class="nav-item">
        <a class="nav-link <?php echo e(isActiveRoute(['licencia*.*','buscar_empleado'])); ?>" data-bs-target="#licencia-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bookmark-x"></i><span>Licencias</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="licencia-nav" class="nav-content collapse <?php echo e(mostrar(['licencia*.*','buscar_empleado'])); ?>" data-bs-parent="#sidebar-nav">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licencia.create')): ?>
          <li>
            <a href="<?php echo e(route('licencias.index')); ?>" class="<?php echo e(isActiveSubMenu(['licencias.index','licencias.create','buscar_empleado','licencias.store'])); ?>">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('licencias_empleados.index')); ?>" class="<?php echo e(isActiveSubMenu(['licencias_empleados.index'])); ?>">
              <i class="bi bi-circle"></i><span>Ver Registrados</span>
            </a>
          </li>
        </ul>
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

  </aside><!-- End Sidebar--><?php /**PATH C:\xampp\htdocs\sistema_rrhh\resources\views/layouts/partials/menu.blade.php ENDPATH**/ ?>