@extends('layouts.app')
@section('titulo','Permisos de Rol')
@section('content')
<div class="pagetitle">
    <h1>Permisos de Accesso</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Permisos del rol</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Permisos habilitados para el rol <strong>{{$role->name}}</strong></h5>
              {{-- <a href="{{ route('roles.index') }}" class="btn btn-danger">Volver</a> --}}
            </div>
            <hr>
           <!--CONTENIDO -->
           
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach($grupos as $cont_grupo=>$grupo)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-{{ $cont_grupo }}" aria-expanded="false" aria-controls="flush-collapseOne-{{ $cont_grupo }}">
                            {{ $cont_grupo + 1 }} - GESTIÓN DE {{ $grupo->grupo }}
                        </button>
                    </h2>
                    <div id="flush-collapseOne-{{ $cont_grupo }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <ul class="list-unstyled">
                           
                            <?php $cont=0; ?>
                            @foreach($permissions as $permission)
                            @if($permission->grupo==$grupo->grupo)
                            <?php $cont=$cont+1; ?>
                            <li>
                                <label>
                                    {{$permission->descripcion ?: 'Sin descripción'}}
                                    <em>({{$permission->name}})</em>
                                </label>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
              <a href="{{ route('roles.index') }}" class="btn btn-danger">Volver</a>
            </div>
          </div>
 
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>


@endsection