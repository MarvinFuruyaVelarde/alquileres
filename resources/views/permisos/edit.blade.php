@extends('layouts.app')
@section('titulo','Permisos')
@section('content')

<section class="wrapper">
    <!--======== Page Title and Breadcrumbs Start ========-->
    <div class="top-page-header">

        <div class="page-title">
            <h2>Accesos del sistema</h2>
            <small>Modificar los datos del acceso</small>
        </div>

    </div>
    <!--======== Page Title and Breadcrumbs End ========-->
    <div class="row">
        <div class="col-md-12">
            <div class="c_panel">
                <div class="c_title">
                    Datos del acceso
                </div>
                <div class="c_content">
                    {!! Form::model($permiso,['route'=>['permisos.update',$permiso->id],'method'=>'PUT','class'=>'needs-validation']) !!}
                        @include('permisos._form',['titulo'=>'Guardar'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
