<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute('home') }}" href="{{ route('home') }}">
        <i class="bi bi-grid"></i>
        <span>Inicio</span>
      </a>
    </li><!-- End Dashboard Nav -->  
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute(['users.*', 'roles.*']) }}" data-bs-target="#administracionSistema-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear"></i><span>ADMINISTRACIÓN</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="administracionSistema-nav" class="nav-content collapse {{ mostrar(['users.*', 'roles.*']) }}" data-bs-parent="#sidebar-nav">
        @can('users.index')
        <li>
          <a href="{{ route('users.index') }}" class="{{ isActiveSubMenu(['users.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Usuarios</span>
          </a>
        </li>
        @endcan
        @can('roles.index')
        <li>
          <a href="{{ route('roles.index') }}" class="{{ isActiveSubMenu(['roles.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Roles</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute(['aeropuertos.*', 'clientes.*', 'cuentas.*', 'expensas.*', 'formaspago.*', 'regionales.*', 'rubros.*', 'unidadesmedida.*']) }}" 
        data-bs-target="#parametricas-nav" 
        data-bs-toggle="collapse" 
        href="#">
        <i class="bi bi-sliders"></i>
        <span>PARAMÉTRICAS</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="parametricas-nav" class="nav-content collapse {{ mostrar(['aeropuertos.*', 'clientes.*', 'cuentas.*', 'expensas.*', 'formaspago.*', 'regionales.*', 'rubros.*', 'unidadesmedida.*']) }}" data-bs-parent="#sidebar-nav">
        @can('aeropuertos.index')
        <li>
          <a href="{{ route('aeropuertos.index') }}" class="{{ isActiveSubMenu(['aeropuertos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Aeropuertos</span>
          </a>
        </li>
        @endcan
        @can('clientes.index')
        <li>
          <a href="{{ route('clientes.index') }}" class="{{ isActiveSubMenu(['clientes.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Clientes</span>
          </a>
        </li>
        @endcan
        @can('cuentas.index')
        <li>
          <a href="{{ route('cuentas.index') }}" class="{{ isActiveSubMenu(['cuentas.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Cuentas</span>
          </a>
        </li>
        @endcan
        @can('expensas.index')
        <li>
          <a href="{{ route('expensas.index') }}" class="{{ isActiveSubMenu(['expensas.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Expensas</span>
          </a>
        </li>
        @endcan
        @can('formaspago.index')
        <li>
          <a href="{{ route('formaspago.index') }}" class="{{ isActiveSubMenu(['formaspago.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Formas de Pago</span>
          </a>
        </li>
        @endcan
        @can('regionales.index')
        <li>
          <a href="{{ route('regionales.index') }}" class="{{ isActiveSubMenu(['regionales.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Regionales</span>
          </a>
        </li>
        @endcan
        @can('rubros.index')
        <li>
          <a href="{{ route('rubros.index') }}" class="{{ isActiveSubMenu(['rubros.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Rubros</span>
          </a>
        </li>
        @endcan
        @can('unidadesmedida.index')
        <li>
          <a href="{{ route('unidadesmedida.index') }}" class="{{ isActiveSubMenu(['unidadesmedida.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Unidades de Medida</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute(['contratos.*', 'aprobarcontratos.*', 'cancelarcontratos.*', 'documentocontratos.*']) }}" 
        data-bs-target="#contratos-nav" 
        data-bs-toggle="collapse" 
        href="#">
        <i class="bi bi-briefcase"></i>
        <span>CONTRATOS</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="contratos-nav" class="nav-content collapse {{ mostrar(['contratos.*', 'aprobarcontratos.*', 'cancelarcontratos.*', 'documentocontratos.*']) }}" data-bs-parent="#sidebar-nav">
        @can('contratos.index')
        <li>
          <a href="{{ route('contratos.index') }}" class="{{ isActiveSubMenu(['contratos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Lista de Contratos</span>
          </a>
        </li>
        @endcan
        @can('aprobarcontratos.index')
        <li>
          <a href="{{ route('aprobarcontratos.index') }}" class="{{ isActiveSubMenu(['aprobarcontratos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Aprobar Contratos</span>
          </a>
        </li>
        @endcan
        @can('cancelarcontratos.index')
        <li>
          <a href="{{ route('cancelarcontratos.index') }}" class="{{ isActiveSubMenu(['cancelarcontratos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Cancelar Contratos</span>
          </a>
        </li>
        @endcan
        @can('documentocontratos.index')
        <li>
          <a href="{{ route('documentocontratos.index') }}" class="{{ isActiveSubMenu(['documentocontratos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Documento Contratos</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute(['garantias.*']) }}" 
        data-bs-target="#garantias-nav" 
        data-bs-toggle="collapse" 
        href="#">
        <i class="bi bi-cash-coin"></i>
        <span>GARANTÍAS</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="garantias-nav" class="nav-content collapse {{ mostrar(['garantias.*']) }}" data-bs-parent="#sidebar-nav">
        @can('garantias.index')
        <li>
          <a href="{{ route('garantias.index') }}" class="{{ isActiveSubMenu(['garantias.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Garantía</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute(['plantillas.*']) }}" data-bs-target="#plantillas-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-back"></i>
        <span>PLANTILLAS</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="plantillas-nav" class="nav-content collapse {{ mostrar(['plantillas.*']) }}" data-bs-parent="#sidebar-nav">
        @can('plantillas.index')
        <li>
          <a href="{{ route('plantillas.index') }}" class="{{ isActiveSubMenu(['plantillas.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Lista de Plantillas</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute(['notacobro.*', 'notacobromanual.*', 'facturacion.*']) }}" 
        data-bs-target="#facturacion-nav" 
        data-bs-toggle="collapse" 
        href="#">
        <i class="bi bi-card-text"></i>
        <span>FACTURACIÓN</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="facturacion-nav" class="nav-content collapse {{ mostrar(['notacobro.*', 'notacobromanual.*', 'facturacion.*']) }}" data-bs-parent="#sidebar-nav">
        @can('notacobro.index')
        <li>
          <a href="{{ route('notacobro.index') }}" class="{{ isActiveSubMenu(['notacobro.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Notas de Cobro</span>
          </a>
        </li>
        @endcan
        @can('notacobromanual.index')
        <li>
          <a href="{{ route('notacobromanual.index') }}" class="{{ isActiveSubMenu(['notacobromanual.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Notas de Cobro Manual</span>
          </a>
        </li>
        @endcan
        @can('facturacion.index')
        <li>
          <a href="{{ route('facturacion.index') }}" class="{{ isActiveSubMenu(['facturacion.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Facturación Notas de Cobro</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute(['registropagos.*']) }}" 
        data-bs-target="#registro-pagos-nav" 
        data-bs-toggle="collapse" 
        href="#">
        <i class="bi bi-card-text"></i>
        <span>REGISTRO PAGOS</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="registro-pagos-nav" class="nav-content collapse {{ mostrar(['registropagos.*']) }}" data-bs-parent="#sidebar-nav">
        @can('registropagos.index')
        <li>
          <a href="{{ route('registropagos.index') }}" class="{{ isActiveSubMenu(['registropagos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Registro de Pagos</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute(['reportecontratos.*', 'reportecuentaporcobrar.*', 'reportedetalleespacios.*','reportefacturas.*', 'reportegarantias.*', 'reporteregistropagos.*','reportetipoespacios.*', 'reporteresumencontratos.*', 'reporteingresoaeropuertos.*','reporteingresoclientes.*', 'reportedeudas.*', 'reporteingresodeudas.*', 'reportemora.*']) }}" data-bs-target="#reportes-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-card-checklist"></i>
        <span>REPORTES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="reportes-nav" class="nav-content collapse {{ mostrar(['reportecontratos.*', 'reportecuentaporcobrar.*', 'reportedetalleespacios.*','reportefacturas.*', 'reportegarantias.*', 'reporteregistropagos.*','reportetipoespacios.*', 'reporteresumencontratos.*', 'reporteingresoaeropuertos.*','reporteingresoclientes.*', 'reportedeudas.*', 'reporteingresodeudas.*', 'reportemora.*']) }}" data-bs-parent="#sidebar-nav">
        @can('reportecontratos.index')
        <li>
          <a href="{{ route('reportecontratos.index') }}" class="{{ isActiveSubMenu(['reportecontratos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Contratos</span>
          </a>
        </li>
        @endcan
        
        @can('reportecuentaporcobrar.index')
        <li>
          <a href="{{ route('reportecuentaporcobrar.index') }}" class="{{ isActiveSubMenu(['reportecuentaporcobrar.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Cuentas por Cobrar</span>
          </a>
        </li>
        @endcan
        
        @can('reportedetalleespacios.index')
        <li>
          <a href="{{ route('reportedetalleespacios.index') }}" class="{{ isActiveSubMenu(['reportedetalleespacios.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Detalle de Espacios</span>
          </a>
        </li>
        @endcan
        
        @can('reportefacturas.index')
        <li>
          <a href="{{ route('reportefacturas.index') }}" class="{{ isActiveSubMenu(['reportefacturas.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Facturas/Notas de Cobro</span>
          </a>
        </li>
        @endcan
        
        @can('reportegarantias.index')
        <li>
          <a href="{{ route('reportegarantias.index') }}" class="{{ isActiveSubMenu(['reportegarantias.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Garantías</span>
          </a>
        </li>
        @endcan
        
        @can('reporteregistropagos.index')
        <li>
          <a href="{{ route('reporteregistropagos.index') }}" class="{{ isActiveSubMenu(['reporteregistropagos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Registro de Pagos</span>
          </a>
        </li>
        @endcan
        
        @can('reportetipoespacios.index')
        <li>
          <a href="{{ route('reportetipoespacios.index') }}" class="{{ isActiveSubMenu(['reportetipoespacios.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Tipo de Espacios</span>
          </a>
        </li>
        @endcan
        
        @can('reporteresumencontratos.index')
        <li>
          <a href="{{ route('reporteresumencontratos.index') }}" class="{{ isActiveSubMenu(['reporteresumencontratos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Resumén de Contratos</span>
          </a>
        </li>
        @endcan
        
        @can('reporteingresoaeropuertos.index')
        <li>
          <a href="{{ route('reporteingresoaeropuertos.index') }}" class="{{ isActiveSubMenu(['reporteingresoaeropuertos.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Ingresos por Aeropuertos</span>
          </a>
        </li>
        @endcan
        
        @can('reporteingresoclientes.index')
        <li>
          <a href="{{ route('reporteingresoclientes.index') }}" class="{{ isActiveSubMenu(['reporteingresoclientes.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Ingresos por Clientes</span>
          </a>
        </li>
        @endcan
        
        @can('reportedeudas.index')
        <li>
          <a href="{{ route('reportedeudas.index') }}" class="{{ isActiveSubMenu(['reportedeudas.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Deudas</span>
          </a>
        </li>
        @endcan
        
        @can('reporteingresodeudas.index')
        <li>
          <a href="{{ route('reporteingresodeudas.index') }}" class="{{ isActiveSubMenu(['reporteingresodeudas.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Ingresos y Deudas</span>
          </a>
        </li>
        @endcan
        
        @can('reportemora.index')
        <li>
          <a href="{{ route('reportemora.index') }}" class="{{ isActiveSubMenu(['reportemora.*']) }}">
            <i class="bi bi-circle fs-6"></i><span>Mora</span>
          </a>
        </li>
        @endcan
        
      </ul>
    </li>
  </ul>

</aside><!-- End Sidebar-->