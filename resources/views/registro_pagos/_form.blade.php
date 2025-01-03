<p>
    Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar un registro de pago.</p>
    <input type="hidden" name="factura_id" id="factura_id" value="{{ $factura->id }}">
    <input type="hidden" name="mes" id="mes" value="{{ $factura->mes }}">
    <input type="hidden" name="gestion" id="gestion" value="{{ $factura->gestion }}">
<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-5">
        <label for="codigo" class="col-form-label">Numero Nota de Cobro: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="numero_nota_cobro" type="text" class="form-control {{ $errors->has('numero_nota_cobro') ? ' error' : '' }}" name="numero_nota_cobro" value="{{ old('numero_nota_cobro',$factura->numero_nota_cobro) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
            <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('numero_nota_cobro'))
                <span class="text-danger">
                    {{ $errors->first('numero_nota_cobro') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="aeropuerto" class="col-form-label">Numero de Factura <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="numero_factura" type="text" class="form-control {{ $errors->has('numero_factura') ? ' error' : '' }}" name="numero_factura" value="{{ old('numero_factura',$factura->numero_factura) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
            <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('numero_factura'))
                <span class="text-danger">
                    {{ $errors->first('numero_factura') }}
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
        <label for="tipo_solicitante" class="col-form-label ">Cliente <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="cliente" type="text" class="form-control {{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" value="{{ old('cliente',$cliente->razon_social) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
            <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('cliente'))
                <span class="text-danger">
                    {{ $errors->first('cliente') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="cliente" class="col-form-label ">Monto Factura (Bs.)<span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="monto_factura" type="text" class="form-control {{ $errors->has('monto_factura') ? ' error' : '' }}" name="monto_factura" value="{{ old('monto_factura',$factura->monto_total) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
            <span id="error-codigo" class="error-codigo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('monto_factura'))
                <span class="text-danger">
                    {{ $errors->first('monto_factura') }}
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
        <label for="ci" class="col-form-label">Pagado (Bs.) <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="pagado" type="text" class="form-control {{ $errors->has('pagado') ? ' error' : '' }}" name="pagado" value="{{ old('pagado',$pagado) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50" disabled>
            <span id="error-codigo" class="error-ci" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('pagado'))
                <span class="text-danger">
                    {{ $errors->first('pagado') }}
                </span>
            @endif
        </div>
    </div>

    <div id="nit-container" class="col-md-5" >
        <label for="nit" class="col-form-label">Saldo (Bs.) <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="saldo_registro_pago" type='hidden' name='saldo_registro_pago' value="{{ old('saldo_registro_pago', number_format($factura->monto_total - $pagado,2, '.', '')) }}"/>
            <input id="saldo" type="text" class="form-control {{ $errors->has('saldo') ? ' error' : '' }}" name="saldo" value="{{ old('saldo', number_format($factura->monto_total - $pagado,2, '.', '')) }}" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50", disabled>
            <span id="error-codigo" class="error-nit" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('saldo'))
                <span class="text-danger">
                    {{ $errors->first('saldo') }}
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
        <label for="domicilio_legal" class="col-form-label">A Pagar(Bs.): <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="pagar" type="text" class="form-control {{ $errors->has('pagar') ? ' error' : '' }}" name="pagar" value="{{ old('pagar') }}" autofocus >
            <span id="error-domicilio_legal" class="error-domicilio_legal" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('pagar'))
                <span class="text-danger">
                    {{ $errors->first('pagar') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="telefono_celular" class="col-form-label">Fecha de Pago: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="fecha_actual" type="date" class="form-control {{ $errors->has('fecha_actual') ? ' error' : '' }}" name="fecha_actual" value="{{ old('fecha_actual',$fecha_actual) }}">
            <span id="error-telefono_celular" class="error-telefono_celular" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('fecha_actual'))
                <span class="text-danger">
                    {{ $errors->first('fecha_actual') }}
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
        <label for="correo" class="col-form-label">Nro. Registro Deposito/Cheque/Transferencia: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="registro_deposito" type="text" class="form-control {{ $errors->has('registro_deposito') ? ' error' : '' }}" name="registro_deposito" value="{{ old('registro_deposito') }}" autofocus onkeydown="javascript: return event.keyCode === 8 ||
                      event.keyCode === 46 ? true : !isNaN(Number(event.key))">
            <span id="error-codigo" class="error-correo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('registro_deposito'))
                <span class="text-danger">
                    {{ $errors->first('registro_deposito') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="actividad_principal" class="col-form-label">Nro. Recibo Cobro:</label>
        <div class="col-md-11">
            <input id="recibo_cobro" type="text" class="form-control {{ $errors->has('recibo_cobro') ? ' error' : '' }}" name="recibo_cobro" value="{{ old('recibo_cobro') }}" autofocus onkeydown="javascript: return event.keyCode === 8 ||
                      event.keyCode === 46 ? true : !isNaN(Number(event.key))">
            <span id="error-actividad_principal" class="error-actividad_principal" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('recibo_cobro'))
                <span class="text-danger">
                    {{ $errors->first('recibo_cobro') }}
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
        <label for="correo" class="col-form-label">Cuenta: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <select id="cuenta_destino" class="form-control{{ $errors->has('cuenta_destino') ? ' error' : '' }}" name="cuenta_destino"  Onchange = "mostrar()" data-old="{{ old('cuenta_destino') }}">
                <option value="">Seleccionar...</option>
                @foreach($cuentas as $cuenta)
                    <option value="{{ $cuenta->id }}" {{ old('cuenta_destino') == $cuenta->id ? 'selected' : '' }}>
                        {{ $cuenta->descripcion }}
                    </option>
                @endforeach
            </select>
            <span id="error-codigo" class="error-correo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('cuenta_destino'))
                <span class="text-danger">
                    {{ $errors->first('cuenta_destino') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-5" style="display: none" id="bloque">
        <label for="actividad_principal" class="col-form-label" style="display: none" id="label">Fecha Deposito en Cuenta: <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="fecha_deposito" type="date" class="form-control {{ $errors->has('fecha_deposito') ? ' error' : '' }}" name="fecha_deposito" value="{{ old('fecha_deposito') }}">
            <span id="error-actividad_principal" class="error-actividad_principal" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('fecha_deposito'))
                <span class="text-danger">
                    {{ $errors->first('fecha_deposito') }}
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
        <label for="correo" class="col-form-label">Observacion</label>
        <div class="col-md-11">
            <textarea id="observacion" name="observacion" rows="4" cols="40" class="form-control {{ $errors->has('observacion') ? ' error' : '' }}"></textarea>
            <span id="error-codigo" class="error-correo" style="color: rgb(220, 53, 69);"></span>
            @if ($errors->has('observacion'))
                <span class="text-danger">
                    {{ $errors->first('observacion') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-1">
    </div>

</div>
<br>
<div class="row mt-2">
    <div class="text-center">
        <button type="submit" class="btn btn-{{ $color }}">{{ $texto }}</button>
        <a href="{{ route('registropagos.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>
<script>
    mostrar();
    function mostrar() {
        var x = $("#cuenta_destino").val() != null ? $("#cuenta_destino").val() : $("#cuenta_destino").data('old');
        
        if (x==7 || x==8) {
            $("#fecha_deposito").show();
            $("#fecha_deposito").prop("", true);
            var el = document.getElementById("bloque");
            el.setAttribute("style", "display:block");
            var el1 = document.getElementById("label");
            el1.setAttribute("style", "display:block");
        } else {
            $("#fecha_deposito").hide();
            $("#fecha_deposito").removeAttr("");
            var el1 = document.getElementById("label");
            el1.setAttribute("style", "display:none");
        } 
    }  
</script>