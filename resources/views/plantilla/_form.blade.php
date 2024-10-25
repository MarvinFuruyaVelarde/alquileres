<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar/editar una expensa</p>

    <div class="row mb-1">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
                <div class="row mb-1">
                    <div class="col-md-4">
                        {{Form::label('cliente','Cliente')}} <span class="text-danger">(*)</span>
                        <select id="cliente" class="form-control{{ $errors->has('cliente') ? ' error' : '' }}" name="cliente">
                            <option value="" selected>Seleccionar...</option>
                            @foreach($contrato as $item)
                            @php
                                $cliente= App\Models\Cliente::where('id',$item->cliente)->first();
                            @endphp
                                <option value="{{ $cliente->id }}" 
                                  >
                                    {{ $cliente->razon_social }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('cliente'))
                            <span class="text-danger">
                                {{ $errors->first('cliente') }}
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{Form::label('contrato','Codigo De Contrato')}} <span class="text-danger">(*)</span>
                        <select id="contrato" class="form-control{{ $errors->has('contrato') ? ' error' : '' }}" name="contrato" disabled>
                            <option value="">Seleccionar...</option>
                        </select>
                        @if ($errors->has('contrato'))
                            <span class="text-danger">
                                {{ $errors->first('contrato') }}
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{Form::label('nota','Nro. De Notas Cobro')}} <span class="text-danger">(*)</span>
                        <input type="text" id="nota" class="form-control{{ $errors->has('nota') ? ' error' : '' }}" name="nota"  onkeydown="javascript: return event.keyCode === 8 ||
                          event.keyCode === 46 ? true : !isNaN(Number(event.key))">
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
            <table cellspacing="0" width="100%" id="tabla" class="table table-hover table-bordered">
            </table>
    </div>
        <div class="col-md-1">
        </div>
    </div>
<div class="row mt-2">
    <div class="text-center">
        <button id="guardar" type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('plantillas.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>

<script>

    // Limpia los datos cargados cuando se selecciona un nuevo Cliente
    document.getElementById('cliente').addEventListener('change', function() {
        let tabla = document.getElementById('tabla');

        let thead = tabla.querySelector('thead');
        if (thead) 
            thead.remove();

        // Elimina el cuerpo de la tabla (tbody) si existe
        let tbody = tabla.querySelector('tbody');
        if (tbody) 
            tbody.remove();
    });

    // Valida que no se asocien espacios con diferente Tipo de Canon y Forma de Pago
    document.getElementById('guardar').addEventListener('click', function(event) {
        let tiposCanon = document.querySelectorAll('.tipo-canon input'); // Selecciona los tipos de canon ocultos
        let numerosCobro = document.querySelectorAll('.numero-cobro'); // Selecciona todos los números de cobro
        let formasPago = document.querySelectorAll('.forma-pago'); // Selecciona todas las formas de pago
        
        let cobroMap = {}; // Mapa para guardar y verificar por tipo de canon y forma de pago
        
        for (let i = 0; i < numerosCobro.length; i++) {
            let tipoCanon = tiposCanon[i].value.trim(); // Extrae el tipo de canon desde el campo oculto
            let numeroCobro = numerosCobro[i].value.trim(); // Extrae el número de cobro
            let formaPago = formasPago[i].textContent.trim(); // Extrae la forma de pago desde la columna oculta

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

