@extends('layouts.app')
@section('titulo','Nuevo Usuario')
@section('content')

<div class="pagetitle">
    <h1>PLANTILLA
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plantillas.index') }}">Plantilla</a></li>
        <li class="breadcrumb-item active">Editar Plantilla</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Editar Plantilla</h5>
           <!--CONTENIDO -->
           <form action="{{ route('plantillas.update', $contrato->id) }}" method="POST" >
            @csrf
           <p>
            Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
            Al momento de registrar/editar una expensa</p>
            <input type='hidden' name='cliente' value='{{$cliente->id }}'/>
            <input type='hidden' name='contrato' value='{{$contrato->id }}'/>
        
            <div class="row mb-1">
                <div class="col-md-1">
                </div>
                <div class="col-md-10">
                        <div class="row mb-1">
                            <div class="col-md-4">
                                {{Form::label('cliente','Cliente')}} <span class="text-danger">(*)</span>
                                <input  id="cliente" class="form-control{{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" disabled value="{{$cliente->razon_social }}"/>
                                @if ($errors->has('cliente'))
                                    <span class="text-danger">
                                        {{ $errors->first('cliente') }}
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {{Form::label('contrato','Codigo De Contrato')}} <span class="text-danger">(*)</span>
                                <input  id="contrato" class="form-control{{ $errors->has('contrato') ? ' error' : '' }}" name="contrato" disabled value="{{$contrato->codigo }}"/>
                                @if ($errors->has('contrato'))
                                    <span class="text-danger">
                                        {{ $errors->first('contrato') }}
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {{Form::label('nota','Nro. De Notas Cobro')}} <span class="text-danger">(*)</span>
                                <input type="text" id="nota" class="form-control{{ $errors->has('nota') ? ' error' : '' }}" name="nota"  onkeydown="javascript: return event.keyCode === 8 ||
                                  event.keyCode === 46 ? true : !isNaN(Number(event.key))" value="{{$numero_cobro}}">
                                @if ($errors->has('nota'))
                                    <span class="text-danger">
                                        {{ $errors->first('nota') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <h3>
                   LISTA ESPACIO COMERCIAL PUBLICITARIO <br></h3>
                    <br>
                    <br>
                <div class="col-md-12">
                    
                    <style>
                        .oculto {
                            display: none; /* Oculta el elemento */
                        }
                        </style>
                   
                    <table cellspacing="0" width="150%" id="tabla" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">RUBRO</th>
                                <th class="text-center">UBICACION</th>
                                <th class="text-center">TIPO CANON</th>
                                <th class="text-center">FECHA INICIAL</th>
                                <th class="text-center">FECHA FINAL</th>
                                <th class="text-center">TOTAL CANON MENSUAL</th>
                                <th class="text-center">NRO.  NOTA COBRO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plantilla as $item)
                                <input type='hidden' name='fecha' value="{{$item->fecha}}"/>
                                @php
                                $espacio= App\Models\Espacio::where('id',$item->espacio)->first();
                                @endphp
                                <tr>
                                <td class='oculto'><input type='text' name='id_espacio[]' value='{{$espacio->id}}'/></td>
                                <td class='text-center'>{{$espacio->rubro}}</td>
                                <td class='text-center'>{{$espacio->ubicacion}}</td>
                                <td class='text-center tipo-canon'>{{ $espacio->tipo_canon == 'F' ? 'FIJO' : ($espacio->tipo_canon == 'V' ? 'VARIABLE' : $espacio->tipo_canon) }}</td>
                                <td class='text-center'>{{$espacio->fecha_inicial}}</td>
                                <td class='text-center'>{{$espacio->fecha_final}}</td>
                                <td class='text-center'>{{$espacio->total_canonmensual}}</td>
                                <td class='text-center'> <input type='Number' name='cobro[]' class='numero-cobro' value="{{$item->numero}}"/></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
                <div class="col-md-1">
                </div>
            </div>
        <div class="row mt-2">
            <div class="text-center">
                <button id="actualizar" type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('plantillas.index') }}" class="btn btn-warning">Cancelar</a>
            </div>
        </div>
    </form>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/validarcampos.js') }}" type="text/javascript"></script>
<script>
    document.getElementById('actualizar').addEventListener('click', function(event) {
        let tiposCanon = document.querySelectorAll('.tipo-canon'); // Selecciona todos los tipos de canon
        let numerosCobro = document.querySelectorAll('.numero-cobro'); // Selecciona todos los números de cobro
        let tipoCobroMap = {}; // Mapa para guardar los tipos de canon y sus números de cobro
    
        for (let i = 0; i < tiposCanon.length; i++) {
            let tipoCanon = tiposCanon[i].textContent.trim(); // Extrae el tipo de canon
            let numeroCobro = numerosCobro[i].value.trim(); // Extrae el número de cobro
    
            // Si ya existe ese número de cobro con un tipo de canon diferente, prevenir el envío
            if (tipoCobroMap[numeroCobro] && tipoCobroMap[numeroCobro] !== tipoCanon) {
                alert('No puede asignar el mismo número de nota de cobro a espacios con un tipo de canon diferente.');
                event.preventDefault(); // Evita el envío del formulario
                return;
            }
    
            // Guarda el número de cobro y el tipo de canon
            tipoCobroMap[numeroCobro] = tipoCanon;
        }
    });
</script>
@endsection
