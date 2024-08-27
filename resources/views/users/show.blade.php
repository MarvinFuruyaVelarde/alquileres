@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>CONFIGURACION</h2>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE USUARIO
                    <small>Personas registradas en el sistema.</small>
                </h2>
            </div>
            <div class="body">
                <p><strong>Nombre </strong>{{$user->name}}</p>
                <p><strong>Email </strong>{{$user->email}}</p>
            </div>
        </div>
    </div>
</div>
@endsection

