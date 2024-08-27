@extends('layouts.app')
@section('titulo','Nuevo Acceso')
@section('content')

<section class="wrapper">
    <!--======== Page Title and Breadcrumbs Start ========-->
    <div class="top-page-header">

        <div class="page-title">
            <h2>Accesos</h2>
            <small></small>
        </div>

    </div>
    <!--======== Page Title and Breadcrumbs End ========-->
    <div class="row">
        <div class="col-md-12">
            <div class="c_panel">
                <div class="c_title">
                    Registrar nuevo acceso
                </div>
                <div class="c_content">
                    {!! Form::open(['route'=>'permisos.store']) !!}
                        @include('permisos._form',['titulo'=>'Guardar'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
