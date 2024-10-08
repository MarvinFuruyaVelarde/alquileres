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
                        <select id="contrato" class=" js-example-basic-multiple form-control{{ $errors->has('contrato') ? ' error' : '' }}" name="contrato" disabled>
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
        <button type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('plantillas.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>

