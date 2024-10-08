<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de editar un contrato</p>
<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-5">
        <label for="codigo" class="col-form-label">Código: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="codigo" type="text" class="form-control {{ $errors->has('codigo') ? ' error' : '' }}" name="codigo" value="{{ old('codigo',$contrato->codigo) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
            <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('codigo'))
                <span class="text-danger">
                    {{ $errors->first('codigo') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="aeropuerto" class="col-form-label">Aeropuerto <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <select id="aeropuerto" class="form-control{{ $errors->has('aeropuerto') ? ' error' : '' }}" name="aeropuerto">
                <option value="">Seleccionar...</option>
                @foreach($aeropuertos as $aeropuerto)
                    <option value="{{ $aeropuerto->id }}" 
                        {{ old('aeropuerto', $contrato->aeropuerto) == $aeropuerto->id ? 'selected' : '' }}>
                        {{ $aeropuerto->descripcion }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('aeropuerto'))
                <span class="text-danger">
                    {{ $errors->first('aeropuerto') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-1">
    </div>

</div>

<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-5">
        <label for="tipo_solicitante" class="col-form-label ">Tipo Solicitante <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <select id="tipo_solicitante" class="form-control{{ $errors->has('tipo_solicitante') ? ' error' : '' }}" name="tipo_solicitante">
                <option value="">Seleccionar...</option>
                @foreach($tipossolicitante as $tiposolicitante)
                    <option value="{{ $tiposolicitante->id }}" 
                        {{ old('tipo_solicitante', $contrato->tipo_solicitante) == $tiposolicitante->id ? 'selected' : '' }}>
                        {{ $tiposolicitante->descripcion }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('tipo_solicitante'))
                <span class="text-danger">
                    {{ $errors->first('tipo_solicitante') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="cliente" class="col-form-label ">Cliente <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <select id="cliente" class="form-control{{ $errors->has('cliente') ? ' error' : '' }}" name="cliente">
                <option value="">Seleccionar...</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" 
                        {{ old('cliente', $contrato->cliente) == $cliente->id ? 'selected' : '' }}>
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
    </div>

    <div class="col-md-1">
    </div>

</div>

<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div id="ci-container" class="col-md-5">
        <label for="ci" class="col-form-label">Ci: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="ci" type="text" class="form-control {{ $errors->has('ci') ? ' error' : '' }}" name="ci" value="{{ old('ci',$contrato->ci) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
            <span id="error-ci" class="error-ci" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('ci'))
                <span class="text-danger">
                    {{ $errors->first('ci') }}
                </span>
            @endif
        </div>
    </div>

    <div id="nit-container" class="col-md-5" style="display: none;">
        <label for="nit" class="col-form-label">Nit: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="nit" type="text" class="form-control {{ $errors->has('nit') ? ' error' : '' }}" name="nit" value="{{ old('nit', $contrato->nit) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
            <span id="error-nit" class="error-nit" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('nit'))
                <span class="text-danger">
                    {{ $errors->first('nit') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="domicilio_legal" class="col-form-label">Domicilio Legal: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="domicilio_legal" type="text" class="form-control {{ $errors->has('domicilio_legal') ? ' error' : '' }}" name="domicilio_legal" value="{{ old('domicilio_legal',$contrato->domicilio_legal) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
            <span id="error-domicilio_legal" class="error-domicilio_legal" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('domicilio_legal'))
                <span class="text-danger">
                    {{ $errors->first('domicilio_legal') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-1">
    </div>

</div>

<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-5">
        <label for="telefono_celular" class="col-form-label">Telefono/Celular: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="telefono_celular" type="text" class="form-control {{ $errors->has('telefono_celular') ? ' error' : '' }}" name="telefono_celular" value="{{ old('telefono_celular',$contrato->telefono_celular) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
            <span id="error-telefono_celular" class="error-telefono_celular" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('telefono_celular'))
                <span class="text-danger">
                    {{ $errors->first('telefono_celular') }}
                </span>
            @endif
        </div>
    </div>
    
    <div class="col-md-5">
        <label for="correo" class="col-form-label">Correo: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="correo" type="text" class="form-control {{ $errors->has('correo') ? ' error' : '' }}" name="correo" value="{{ old('correo',$contrato->correo) }}" autofocus autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
            <span id="error-correo" class="error-correo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('correo'))
                <span class="text-danger">
                    {{ $errors->first('correo') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-1">
    </div>

</div>

<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-5">
        <label for="actividad_principal" class="col-form-label">Actividad Principal: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="actividad_principal" type="text" class="form-control {{ $errors->has('actividad_principal') ? ' error' : '' }}" name="actividad_principal" value="{{ old('actividad_principal',$contrato->actividad_principal) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
            <span id="error-actividad_principal" class="error-actividad_principal" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('actividad_principal'))
                <span class="text-danger">
                    {{ $errors->first('actividad_principal') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="matricula_comercio" class="col-form-label">Matricula Comercio: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="matricula_comercio" type="text" class="form-control {{ $errors->has('matricula_comercio') ? ' error' : '' }}" name="matricula_comercio" value="{{ old('matricula_comercio',$contrato->matricula_comercio) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
            <span id="error-matricula_comercio" class="error-matricula_comercio" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('matricula_comercio'))
                <span class="text-danger">
                    {{ $errors->first('matricula_comercio') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-1">
    </div>

</div>

<br>

<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-10">
        <div class="row mb-1">
            <p>
                <input onclick="agregarRepresentante();" type="button" value="Agregar Representante +" class="btn btn-success" />
            </p>
        </div>
        <div id="campos">
            <div id="rep1">
                <div class="row mb-1">
                    <div class="col-md-5">
                        {{Form::label('representante1','Representante')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="representante1" type="text" class="form-control {{ $errors->has('representante1') ? ' error' : '' }}" name="representante1" value="{{ old('representante1',$contrato->representante1) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-representante1" class="error-representante1" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('representante1'))
                            <span class="text-danger">
                                {{ $errors->first('representante1') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('numero_documento1','Número De Documento')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="numero_documento1" type="text" class="form-control {{ $errors->has('numero_documento1') ? ' error' : '' }}" name="numero_documento1" value="{{ old('numero_documento1',$contrato->numero_documento1) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-numero_documento1" class="error-numero_documento1" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('numero_documento1'))
                            <span class="text-danger">
                                {{ $errors->first('numero_documento1') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('expedido1','Expedido en')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <select id="expedido1" class="form-control{{ $errors->has('expedido1') ? ' error' : '' }}" name="expedido1">
                            <option value="">Seleccionar...</option>
                            @foreach($expedidos as $expedido)
                                <option value="{{ $expedido->id }}" 
                                    {{ old('expedido1', $contrato->expedido1) == $expedido->id ? 'selected' : '' }}>
                                    {{ $expedido->descripcion }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('expedido'))
                            <span class="text-danger">
                                {{ $errors->first('expedido') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                    {{Form::label('','')}} <span class="text-danger"></span>
                    <br>
                    <div class="col-md-12">
                    <button type="button" class="btn btn-danger">-</button>
                    </div>
                    </div>
                </div>
                <div id="cjur-container" class="row mb-1" style="display: none;">
                    <div class="col-md-3">
                        {{Form::label('documento_designacion1','Documento de Designación')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="documento_designacion1" type="text" class="form-control {{ $errors->has('documento_designacion1') ? ' error' : '' }}" name="documento_designacion1" value="{{ old('documento_designacion1',$contrato->documento_designacion1) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-documento_designacion1" class="error-documento_designacion1" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('documento_designacion1'))
                            <span class="text-danger">
                                {{ $errors->first('documento_designacion1') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('fecha_emision_documento1','Fecha Emisión de Documento')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="fecha_emision_documento1" type="date" class="form-control {{ $errors->has('fecha_emision_documento1') ? ' error' : '' }}" name="fecha_emision_documento1" value="{{ old('fecha_emision_documento1',$contrato->fecha_emision_documento1) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-fecha_emision_documento1" class="error-fecha_emision_documento1" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('fecha_emision_documento1'))
                            <span class="text-danger">
                                {{ $errors->first('fecha_emision_documento1') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('notaria1','Notaria')}} <span class="text-danger">(*)</span>
                        <div class="col-md-112">
                        <input id="notaria1" type="text" class="form-control {{ $errors->has('notaria1') ? ' error' : '' }}" name="notaria1" value="{{ old('notaria1',$contrato->notaria1) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-notaria1" class="error-notaria1" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('notaria1'))
                            <span class="text-danger">
                                {{ $errors->first('notaria1') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('notario1','Notario (a)')}} <span class="text-danger">(*)</span>
                        <div class="col-md-10">
                        <input id="notario1" type="text" class="form-control {{ $errors->has('notario1') ? ' error' : '' }}" name="notario1" value="{{ old('notario1',$contrato->notario1) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-notario1" class="error-notario1" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('notario1'))
                            <span class="text-danger">
                                {{ $errors->first('notario1') }}
                            </span>
                        @endif
                        </div>
                    </div>
                </div>
            </div>

            <div id="row-2" style="display: none;">
                <div class="row mb-1">
                    <div class="col-md-5">
                        {{Form::label('representante2','Representante')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="representante2" type="text" class="form-control {{ $errors->has('representante2') ? ' error' : '' }}" name="representante2" value="{{ old('representante2',$contrato->representante2) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-representante2" class="error-representante2" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('representante2'))
                            <span class="text-danger">
                                {{ $errors->first('representante2') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('numero_documento2','Número De Documento')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="numero_documento2" type="text" class="form-control {{ $errors->has('numero_documento2') ? ' error' : '' }}" name="numero_documento2" value="{{ old('numero_documento2',$contrato->numero_documento2) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-numero_documento2" class="error-numero_documento2" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('numero_documento2'))
                            <span class="text-danger">
                                {{ $errors->first('numero_documento2') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('expedido2','Expedido en')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <select id="expedido2" class="form-control{{ $errors->has('expedido2') ? ' error' : '' }}" name="expedido2">
                            <option value="">Seleccionar...</option>
                            @foreach($expedidos as $expedido)
                                <option value="{{ $expedido->id }}" 
                                    {{ old('expedido2', $contrato->expedido2) == $expedido->id ? 'selected' : '' }}>
                                    {{ $expedido->descripcion }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('expedido2'))
                            <span class="text-danger">
                                {{ $errors->first('expedido2') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                    {{Form::label('','')}} <span class="text-danger"></span>
                    <br>
                    <div class="col-md-12">
                    <button onclick="eliminarRepresentante(2);" type="button" class="btn btn-danger">-</button>
                    </div>
                    </div>
                </div>
                <div id="cjur2-container" class="row mb-1" style="display: none;">
                    <div class="col-md-3">
                        {{Form::label('documento_designacion2','Documento de Designación')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="documento_designacion2" type="text" class="form-control {{ $errors->has('documento_designacion2') ? ' error' : '' }}" name="documento_designacion2" value="{{ old('documento_designacion2',$contrato->documento_designacion2) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-documento_designacion2" class="error-documento_designacion2" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('documento_designacion2'))
                            <span class="text-danger">
                                {{ $errors->first('documento_designacion2') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('fecha_emision_documento2','Fecha Emisión de Documento')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="fecha_emision_documento2" type="date" class="form-control {{ $errors->has('fecha_emision_documento2') ? ' error' : '' }}" name="fecha_emision_documento2" value="{{ old('fecha_emision_documento2',$contrato->fecha_emision_documento2) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-fecha_emision_documento2" class="error-fecha_emision_documento2" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('fecha_emision_documento2'))
                            <span class="text-danger">
                                {{ $errors->first('fecha_emision_documento2') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('notaria2','Notaria')}} <span class="text-danger">(*)</span>
                        <div class="col-md-112">
                        <input id="notaria2" type="text" class="form-control {{ $errors->has('notaria2') ? ' error' : '' }}" name="notaria2" value="{{ old('notaria2',$contrato->notaria2) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-notaria2" class="error-notaria2" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('notaria2'))
                            <span class="text-danger">
                                {{ $errors->first('notaria2') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('notario2','Notario (a)')}} <span class="text-danger">(*)</span>
                        <div class="col-md-10">
                        <input id="notario2" type="text" class="form-control {{ $errors->has('notario2') ? ' error' : '' }}" name="notario2" value="{{ old('notario2',$contrato->notario2) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-notario2" class="error-notario2" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('notario2'))
                            <span class="text-danger">
                                {{ $errors->first('notario2') }}
                            </span>
                        @endif
                        </div>
                    </div>
                </div>
            </div>

            <div id="row-3" style="display: none;">
                <div class="row mb-1">
                    <div class="col-md-5">
                        {{Form::label('representante3','Representante')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="representante3" type="text" class="form-control {{ $errors->has('representante3') ? ' error' : '' }}" name="representante3" value="{{ old('representante3',$contrato->representante3) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-representante3" class="error-representante3" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('representante3'))
                            <span class="text-danger">
                                {{ $errors->first('representante3') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('numero_documento3','Número De Documento')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="numero_documento3" type="text" class="form-control {{ $errors->has('numero_documento3') ? ' error' : '' }}" name="numero_documento3" value="{{ old('numero_documento3',$contrato->numero_documento3) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-numero_documento3" class="error-numero_documento3" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('numero_documento3'))
                            <span class="text-danger">
                                {{ $errors->first('numero_documento3') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('expedido3','Expedido en')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <select id="expedido3" class="form-control{{ $errors->has('expedido3') ? ' error' : '' }}" name="expedido3">
                            <option value="">Seleccionar...</option>
                            @foreach($expedidos as $expedido)
                                <option value="{{ $expedido->id }}" 
                                    {{ old('expedido3', $contrato->expedido3) == $expedido->id ? 'selected' : '' }}>
                                    {{ $expedido->descripcion }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('expedido3'))
                            <span class="text-danger">
                                {{ $errors->first('expedido3') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                    {{Form::label('','')}} <span class="text-danger"></span>
                    <br>
                    <div class="col-md-12">
                    <button onclick="eliminarRepresentante(3);" type="button" class="btn btn-danger">-</button>
                    </div>
                    </div>
                </div>
                <div id="cjur3-container" class="row mb-1" style="display: none;">
                    <div class="col-md-3">
                        {{Form::label('documento_designacion3','Documento de Designación')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="documento_designacion3" type="text" class="form-control {{ $errors->has('documento_designacion3') ? ' error' : '' }}" name="documento_designacion3" value="{{ old('documento_designacion3',$contrato->documento_designacion3) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-documento_designacion3" class="error-documento_designacion3" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('documento_designacion3'))
                            <span class="text-danger">
                                {{ $errors->first('documento_designacion3') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('fecha_emision_documento3','Fecha Emisión de Documento')}} <span class="text-danger">(*)</span>
                        <div class="col-md-12">
                        <input id="fecha_emision_documento3" type="date" class="form-control {{ $errors->has('fecha_emision_documento3') ? ' error' : '' }}" name="fecha_emision_documento3" value="{{ old('fecha_emision_documento3',$contrato->fecha_emision_documento3) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-fecha_emision_documento3" class="error-fecha_emision_documento3" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('fecha_emision_documento3'))
                            <span class="text-danger">
                                {{ $errors->first('fecha_emision_documento3') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('notaria3','Notaria')}} <span class="text-danger">(*)</span>
                        <div class="col-md-112">
                        <input id="notaria3" type="text" class="form-control {{ $errors->has('notaria3') ? ' error' : '' }}" name="notaria3" value="{{ old('notaria3',$contrato->notaria3) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-notaria3" class="error-notaria3" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('notaria3'))
                            <span class="text-danger">
                                {{ $errors->first('notaria3') }}
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('notario3','Notario (a)')}} <span class="text-danger">(*)</span>
                        <div class="col-md-10">
                        <input id="notario3" type="text" class="form-control {{ $errors->has('notario3') ? ' error' : '' }}" name="notario3" value="{{ old('notario3',$contrato->notario3) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">
                        <span id="error-notario3" class="error-notario3" style="color: rgb(220, 53, 69);"></span>
                        @if ($errors->has('notario3'))
                            <span class="text-danger">
                                {{ $errors->first('notario3') }}
                            </span>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="col-md-1">
    </div>
</div>

<br>

<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('contratos.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>