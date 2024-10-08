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
      @can('cuentas.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('cuentas.*') }}" href="{{ route('cuentas.index') }}">
            <i class="bi bi-wallet2"></i>
            <span>Cuentas</span>
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
      @can('unidadesmedida.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('unidadesmedida.*') }}" href="{{ route('unidadesmedida.index') }}">
            <i class="bi bi-unity"></i>
            <span>Unidades de Medida</span>
          </a>
        </li>
      @endcan
      
      <li class="nav-heading">CONTRATOS</li>
      @can('contratos.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('contratos.*') }}" href="{{ route('contratos.index') }}">
            <i class="bi bi-list-columns"></i>
            <span>Lista de Contratos</span>
          </a>
        </li>
      @endcan
      @can('aprobarcontratos.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('aprobarcontratos.*') }}" href="{{ route('aprobarcontratos.index') }}">
            <i class="bi bi-clipboard-check"></i>
            <span>Aprobar Contratos</span>
          </a>
        </li>
      @endcan
      @can('cancelarcontratos.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('cancelarcontratos.*') }}" href="{{ route('cancelarcontratos.index') }}">
            <i class="bi bi-x-diamond-fill"></i>
            <span>Cancelar Contratos</span>
          </a>
        </li>
      @endcan
      @can('documentocontratos.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('documentocontratos.*') }}" href="{{ route('documentocontratos.index') }}">
            <i class="bi bi-file-earmark-arrow-up"></i>
            <span>Documento Contratos</span>
          </a>
        </li>
      @endcan

      <li class="nav-heading">GARANTIAS</li>
      @can('garantias.index')
      <li class="nav-item">
        <a class="nav-link {{ isActiveRoute('garantias.*') }}" href="{{ route('garantias.index') }}">
          <i class="bi bi-cash-coin"></i>
          <span>Garantía</span>
        </a>
      </li>
      @endcan

      <li class="nav-heading">PLANTILLAS</li>
      @can('plantillas.index')
        <li class="nav-item">
          <a class="nav-link {{ isActiveRoute('plantillas.*') }}" href="{{ route('plantillas.index') }}">
            <i class="bi bi-back"></i>
            <span>Lista de Plantillas</span>
          </a>
        </li>
      @endcan
    </ul>

  </aside><!-- End Sidebar-->