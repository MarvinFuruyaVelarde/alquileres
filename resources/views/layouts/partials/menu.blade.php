<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute('home') }}" href="{{ route('home') }}">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-heading">ADMINISTRACIÓN PERSONAL</li>
      @can('empleados.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute(['empleados.*']) }}" data-bs-target="#empleados-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-plus"></i><span>Registro Funcionarios</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="empleados-nav" class="nav-content collapse {{ mostrar(['empleados.*']) }}" data-bs-parent="#sidebar-nav">
          @can('empleados.create')
          <li>
            <a href="{{ route('empleados.create') }}" class="{{ isActiveSubMenu('empleados.create') }}">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          @endif
          <li>
            <a href="{{ route('empleados.index') }}" class="{{ isActiveSubMenu(['empleados.index','empleados.edit','empleados.ficha']) }}">
              <i class="bi bi-circle"></i><span>Ver Todos</span>
            </a>
          </li>
        </ul>
      </li>
      @endcan
      @can('documentos.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute(['documentos*.*']) }}" data-bs-target="#documentos-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-text"></i><span>Documentación</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="documentos-nav" class="nav-content collapse {{ mostrar(['documentos*.*']) }}" data-bs-parent="#sidebar-nav">
          @can('documentos.create')
          <li>
            <a href="{{ route('documentos_empleados.index') }}" class="{{ isActiveSubMenu(['documentos_empleados.index','documentos.create']) }}">
              <i class="bi bi-circle"></i><span>Nuevo</span>
            </a>
          </li>
          @endcan
          <li>
            <a href="{{ route('documentos.index') }}" class="{{ isActiveSubMenu(['documentos.index','documentos.edit']) }}">
              <i class="bi bi-circle"></i><span>Ver Todos</span>
            </a>
          </li>
        </ul>
      </li>
      @endcan
      @can('declaraciones.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute('declaraciones*.*') }}" href="{{ route('declaraciones.index') }}">
          <i class="bi bi-grid"></i>
          <span>Declaraciones Juradas</span>
        </a>
      </li>
      @endcan
      @can('users.index')
        <li class="nav-heading">ADMINISTRACIÓN SISTEMA</li>
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('users.*') }}" href="{{ route('users.index') }}">
            <i class="bi bi-people"></i>
            <span>Usuarios</span>
          </a>
        </li>
        @can('roles.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('roles.*') }}" href="{{ route('roles.index') }}">
            <i class="bi bi-gear"></i>
            <span>Roles</span>
          </a>
        </li>
        @endcan
      @endcan
      @can('expensas.index')
        <li class="nav-heading">PARAMETRICAS</li>
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('aeropuertos.*') }}" href="{{ route('aeropuertos.index') }}">
            <i class="bi bi-people"></i>
            <span>Aeropuertos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('expensas.*') }}" href="{{ route('expensas.index') }}">
            <i class="bi bi-people"></i>
            <span>Expensas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('formaspago.*') }}" href="{{ route('formaspago.index') }}">
            <i class="bi bi-people"></i>
            <span>Formas de Pago</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('regionales.*') }}" href="{{ route('regionales.index') }}">
            <i class="bi bi-people"></i>
            <span>Regionales</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('rubros.*') }}" href="{{ route('rubros.index') }}">
            <i class="bi bi-people"></i>
            <span>Rubros</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('unidadesmedida.*') }}" href="{{ route('unidadesmedida.index') }}">
            <i class="bi bi-people"></i>
            <span>Unidades de Medida</span>
          </a>
        </li>
      @endcan
    </ul>

  </aside><!-- End Sidebar-->