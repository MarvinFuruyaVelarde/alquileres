@extends('layouts.app')
@section('titulo','Permisos')
@section('content')

<section class="wrapper">
    <!--======== Page Title and Breadcrumbs Start ========-->
    <div class="top-page-header">

        <div class="page-title">
            <h2>Accesos del sistema</h2>
            <small>Rutas creadas para controlar el acceso a secciones del sistema</small>
            <div class="d-flex flex-row align-items-center justify-content-end mr-5">
                @can('permisos.create')
                    <a href="{{route('permisos.create')}}" class="btn btn-primary btn-round" title="Crea un nuevo rol con sus permisos">Crear Nuevo</a>
                @endcan
            </div>
        </div>

    </div>
    <!--======== Page Title and Breadcrumbs End ========-->
    <div class="row">
        <div class="col-md-12">
            <div class="c_panel">
                <div class="c_title">
                    Accesos registrados
                </div>
                <div class="c_content">
                    <table class="table table-striped">
                        <thead >
                            <tr>
                                <th class="text-center">Nombre del acceso o ruta</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($permisos as $p )
                                <tr>
                                    <td scope="row">{{ $p->name }}</td>
                                    <td>{{ $p->descripcion }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('permisos.edit',$p->id) }}" class="btn btn-success btn-round">Editar</a>
                                        <a href="{{ route('permisos.destroy',$p->id) }}" class="btn btn-danger btn-round">Eliminar</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
