<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('titulo') | {{ config('app.name') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('layouts.partials.styles')

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script>var url_global='{{url("/")}}';</script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/descarga1.png') }}" alt="">
        <span class="d-none d-lg-block">NAVEGACION AEREA Y AEROPUERTOS <br>BOLIVIANOS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        @php
          $user=Auth::user();
          $user_regional=App\Models\UsuarioRegional::where('usuario',$user->id)->first();
          if ($user_regional !=null)
            $regional=App\Models\Regional::where('id',$user_regional->regional)->first();
        @endphp
        <li class="nav-item dropdown pe-3">
          @if (auth()->user()->rol[0]->name == "superadmin")
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="{{ asset('assets/img/avatar-4.jpg') }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }} </span>
            </a><!-- End Profile Iamge Icon -->
          @else
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="{{ asset('assets/img/avatar-4.jpg') }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name.' '.Auth::user()->apellido_paterno }} <br> {{'REGIONAL '.$regional->descripcion}} </span>
            </a><!-- End Profile Iamge Icon -->
          @endif

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <hr class="dropdown-divider">
            <li>
              <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Salir</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li>

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  @include('layouts.partials.menu')

  <main id="main" class="main">

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    
  </footer><!-- End Footer -->

  @include('layouts.partials.scripts')

</body>

</html>