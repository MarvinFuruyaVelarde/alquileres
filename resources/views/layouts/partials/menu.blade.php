<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute('home') }}" href="{{ route('home') }}">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li><!-- End Dashboard Nav -->  
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
      
      <li class="nav-heading">PARAMETRICAS</li>
      @can('aeropuertos.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('aeropuertos.*') }}" href="{{ route('aeropuertos.index') }}">
            <i class="bi bi-airplane-engines"></i>
            <span>Aeropuertos</span>
          </a>
        </li>
      @endcan
      @can('clientes.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('clientes.*') }}" href="{{ route('clientes.index') }}">
            <i class="bi bi-people"></i>
            <span>Clientes</span>
          </a>
        </li>
      @endcan
      @can('expensas.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('expensas.*') }}" href="{{ route('expensas.index') }}">
            <i class="bi bi-cash"></i>
            <span>Expensas</span>
          </a>
        </li>
      @endcan
      @can('formaspago.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('formaspago.*') }}" href="{{ route('formaspago.index') }}">
            <i class="bi bi-credit-card"></i>
            <span>Formas de Pago</span>
          </a>
        </li>
      @endcan
      @can('regionales.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('regionales.*') }}" href="{{ route('regionales.index') }}">
            <i class="bi bi-globe-americas"></i>
            <span>Regionales</span>
          </a>
        </li>
      @endcan
      @can('rubros.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('rubros.*') }}" href="{{ route('rubros.index') }}">
            <i class="bi bi-bookmark"></i>
            <span>Rubros</span>
          </a>
        </li>
      @endcan
      @can('tipospago.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('tipospago.*') }}" href="{{ route('tipospago.index') }}">
            <i class="bi bi-wallet2"></i>
            <span>Tipos de Pago</span>
          </a>
        </li>
      @endcan
      @can('unidadesmedida.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('unidadesmedida.*') }}" href="{{ route('unidadesmedida.index') }}">
            <i class="bi bi-unity"></i>
            <span>Unidades de Medida</span>
          </a>
        </li>
      @endcan
      
    </ul>

  </aside><!-- End Sidebar-->