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
                                <th class="text-center">TIPO CANON</th>
                                <th class="text-center">RUBRO</th>
                                <th class="text-center">UBICACION</th>
                                <th class="text-center">DESCRIPCIÓN</th>
                                <th class="text-center">FECHA INICIAL</th>
                                <th class="text-center">FECHA FINAL</th>
                                <th class="text-center">TOTAL CANON MENSUAL</th>
                                <th class="text-center">FORMA DE PAGO</th>
                                <th class="text-center">NRO. NOTA DE COBRO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plantilla as $item)
                                <input type='hidden' name='fecha' value="{{$item->fecha}}"/>
                                @php
                                $espacio= App\Models\Espacio::where('id',$item->espacio)->first();
                                $rubro = App\Models\Rubro::where('id', $espacio->rubro)->first();
                                $forma_pago = App\Models\FormaPago::find($espacio->forma_pago);
                                $view_espacio = App\Models\View_Espacio::find($espacio->id);
                                @endphp
                                <tr>
                                <td class='oculto'><input type='text' name='id_espacio[]' value='{{$espacio->id}}'/></td>
                                <td class='oculto tipo-canon'><input type='text' name='tipo_canon[]' value='{{$espacio->tipo_canon}}'></td>
                                <td class='text-center'>{{ $espacio->tipo_canon == 'F' ? 'FIJO' : ($espacio->tipo_canon == 'V' ? 'VARIABLE' : $espacio->tipo_canon) }}</td>
                                <td class='text-center col-1'>{{$rubro->descripcion}}</td>
                                <td class='text-center'>{{$espacio->ubicacion}}</td>
                                <td class='text-center col-3'>{{$view_espacio->descripcion}}</td>
                                <td class='text-center'>{{$espacio->fecha_inicial}}</td>
                                <td class='text-center'>{{$espacio->fecha_final}}</td>
                                <td class='text-center'>{{$espacio->total_canonmensual}}</td>
                                <td class='oculto forma-pago'>{{$espacio->forma_pago}}</td>
                                <td class='text-center'>{{$forma_pago->descripcion}}</td>
                                <td class='text-center'> <input type='Number' name='cobro[]' class='form-control numero-cobro' value="{{$item->numero}}" onkeydown="javascript: return event.keyCode === 8 ||
                                                        event.keyCode === 46 ? true : !isNaN(Number(event.key))"/></td>
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

    // Valida que no se asocien espacios con diferente Tipo de Canon y Forma de Pago
    document.getElementById('actualizar').addEventListener('click', function(event) {
        let tiposCanon = document.querySelectorAll('.tipo-canon input'); // Selecciona los tipos de canon ocultos
        let numerosCobro = document.querySelectorAll('.numero-cobro'); // Selecciona todos los números de cobro
        let formasPago = document.querySelectorAll('.forma-pago'); // Selecciona todas las formas de pago
        
        let cobroMap = {}; // Mapa para guardar y verificar por tipo de canon y forma de pago
        
        for (let i = 0; i < numerosCobro.length; i++) {
            let tipoCanon = tiposCanon[i].value.trim(); // Extrae el tipo de canon desde el campo oculto
            let numeroCobro = numerosCobro[i].value.trim(); // Extrae el número de cobro
            let formaPago = formasPago[i].textContent.trim(); // Extrae la forma de pago desde la columna oculta
            let notaInput = document.getElementById('nota'); // Obtiene el input con id="nota"
            let numeroNotas = parseInt(notaInput.value.trim(), 10); // Obtiene el valor del input id="nota" y lo convierte en número

            // Validar que el campo id="nota" tenga un valor válido
            if (isNaN(numeroNotas) || numeroNotas <= 0) {
                alert('Debe ingresar un número válido en "Nro. De Notas Cobro".');
                event.preventDefault(); // Evita el envío del formulario
                return;
            }

            // Verificar que haya al menos `numeroNotas` filas
            if (numerosCobro.length < numeroNotas) {
                alert(`Debe haber al menos ${numeroNotas} filas para asignar las notas de cobro.`);
                event.preventDefault(); // Evita el envío del formulario
                return;
            }

            // Crear un array con los valores de los campos "NRO. NOTA DE COBRO"
            const valoresIngresados = Array.from(numerosCobro).map(input => parseInt(input.value.trim(), 10));

            // Validar que no existan números mayores al número máximo permitido (nroNotasCobro)
            const excedeRango = valoresIngresados.some(num => num > numeroNotas);

            // Verificar que los valores ingresados contengan todos los números del 1 al nroNotasCobro
            const rangoEsperado = Array.from({ length: numeroNotas }, (_, i) => i + 1);  // Crear un array con los números del 1 al nroNotasCobro
            const numerosPresentes = new Set(valoresIngresados);  // Usar un Set para asegurarse de que los números estén presentes

            // Comprobar si el conjunto de números presentes contiene todos los números del rango esperado
            const rangoValido = rangoEsperado.every(num => numerosPresentes.has(num));

            if (excedeRango) {
                alert(`No puede asignar números mayores a ${numeroNotas} en las Notas de Cobro.`);
                event.preventDefault(); // Detener el envío del formulario
                return;
            } else if (!rangoValido) {
                alert(`Debe asignar todos los números de Nota de Cobro del 1 al ${numeroNotas}.`);
                event.preventDefault(); // Detener el envío del formulario
                return;
            }

            // Si el número de cobro no está vacío
            if (numeroCobro) {
                let cobroKey = numeroCobro;

                // Verificar si el número de cobro ya existe en el mapa
                if (cobroMap[cobroKey]) {
                    // Si ya existe un número de cobro pero con un tipo de canon diferente
                    if (cobroMap[cobroKey].tipoCanon !== tipoCanon) {
                        alert('No puede asignar el mismo número de nota de cobro a espacios con tipo de canon diferente.');
                        event.preventDefault(); // Evita el envío del formulario
                        return;
                    }
                    // Si ya existe un número de cobro pero con una forma de pago diferente
                    if (cobroMap[cobroKey].formaPago !== formaPago) {
                        alert('No puede asignar el mismo número de nota de cobro a espacios con diferentes formas de pago.');
                        event.preventDefault(); // Evita el envío del formulario
                        return;
                    }
                } else {
                    // Almacena el número de cobro con su tipo de canon y forma de pago
                    cobroMap[cobroKey] = {
                        tipoCanon: tipoCanon,
                        formaPago: formaPago
                    };
                }
            }
        }
    });
</script>
@endsection
