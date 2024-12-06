<p>
     Debe rellenar todos los campos marcados con <strong class="text-danger">(*)</strong>.
    Al momento de registrar la garantía</p>
<div class="row mb-1">
    <div class="col-md-1">
    </div>
    <div class="col-md-5" style= "display: none;">
        <label for="contrato" class="col-form-label">Contrato </label>
        <div class="col-md-11">
            <input id="contrato"  type="text"  name="contrato" value="{{ $contrato->id }}" >
        </div>
    </div>    

    <div class="col-md-5">
        <label for="codigo_contrato" class="col-form-label">Código Contrato </label>
        <div class="col-md-11">
            <input id="codigo_contrato" disabled type="text" class="form-control {{ $errors->has('razon_social') ? ' error' : '' }}" name="razon_social" value="{{ $contrato->codigo }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
        </div>
    </div>    
    
    <div class="col-md-5">
        <label for="cliente" class="col-form-label">Cliente </label>
        <div class="col-md-11">
            <input id="cliente" disabled type="text" class="form-control {{ $errors->has('cliente') ? ' error' : '' }}" name="cliente" value="{{ $cliente->razon_social }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
        </div>
    </div>

    <div class="col-md-1">
    </div>
</div>

<div class="row mb-1">
    <div class="col-md-1">
    </div>

    <div class="col-md-3">
        <label for="garantia" class="col-form-label">Garantía </label>
        <div class="col-md-11">
            <input id="garantia" disabled type="text" class="form-control {{ $errors->has('garantia') ? ' error' : '' }}" name="garantia" value="{{ old('garantia',$contrato->garantia) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
        </div>
    </div>

    <div class="col-md-3">
        <label for="pagado" class="col-form-label">Pagado(Bs.) </label>
        <div class="col-md-11">
            <input id="pagado" disabled type="text" class="form-control {{ $errors->has('pagado') ? ' error' : '' }}" name="pagado" value="{{ old('pagado',$contrato->pago_garantia) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
        </div>
    </div>

    <div class="col-md-4">
        <label for="saldo" class="col-form-label">Saldo (Bs.) </label>
        <div class="col-md-11">
            <input type='hidden' name='saldo_garantia' value='{{ old('saldo',$contrato->saldo_garantia) }}'/>
            <input id="saldo" disabled type="text" class="form-control {{ $errors->has('saldo') ? ' error' : '' }}" name="saldo" value="{{ old('saldo',$contrato->saldo_garantia) }}" autofocus onkeyup="this.value = this.value.toUpperCase();">
        </div>
    </div>
        
    <div class="col-md-1">
    </div>
</div>   
<div class="row mb-1">
    <div class="col-md-1">
    </div>    

    <div class="col-md-5">
        <label for="a_pagar" class="col-form-label">A Pagar (Bs.) <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <input id="a_pagar"  type="text" class="form-control {{ $errors->has('a_pagar') ? ' error' : '' }}" name="a_pagar" value=" " autofocus onkeyup="this.value = this.value.toUpperCase();">
        @if ($errors->has('a_pagar'))
            <span class="text-danger">
                {{ $errors->first('a_pagar') }}
            </span>            
        @endif
        </div>
    </div>

    <div class="col-md-5">
        <label for="cuenta_destino" class="col-form-label">Cuenta Destino <span class="text-danger">(*)</span></label>
        <div class="col-md-11">
            <select id="cuenta_destino" class="form-control{{ $errors->has('cuenta_destino') ? ' error' : '' }}" name="cuenta_destino">
                <option value="">Seleccionar...</option>
                @foreach($cuentas as $cuenta)
                    <option value="{{ $cuenta->id }}" data-numero-cuenta="{{ $cuenta->numero_cuenta }}">
                        {{ $cuenta->descripcion }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('cuenta_destino'))
                <span class="text-danger">
                    {{ $errors->first('cuenta_destino') }}
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
        <label for="nro_cuenta" class="col-form-label">Numero de Cuenta </span></label>
        <div class="col-md-11">
            <input id="nro_cuenta_garantia" type='hidden' name='nro_cuenta_garantia' value=''/>
            <input id="nro_cuenta" type="text" class="form-control {{ $errors->has('nro_cuenta') ? ' error' : '' }}" name="nro_cuenta" value=" " autofocus onkeyup="this.value = this.value.toUpperCase();" disabled>
        </div>
    </div>
    <div class="col-md-5">
        <div id = 'fecha_container' style= "display: none;">
            <label for="fecha_deposito" class="col-form-label">Fecha de Deposito en Cuenta <span class="text-danger">(*)</span></label>
            <div class="col-md-11">
                <input id="fecha_deposito"  type="date" class="form-control {{ $errors->has('fecha_deposito') ? ' error' : '' }}" name="fecha_deposito" value=" " autofocus onkeyup="this.value = this.value.toUpperCase();">
                @if ($errors->has('fecha_deposito'))
                    <span class="text-danger">
                        {{ $errors->first('fecha_deposito') }}
                    </span>
            @endif
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
        <a href="{{ route('garantias.index') }}" class="btn btn-warning">Cancelar</a>
    </div>
</div>

<script>
document.getElementById('cuenta_destino').addEventListener('change', function () {
    var id_cuenta = this.value; // Obtener el número de cuenta seleccionado
    var fecha_deposito = document.getElementById('fecha_container');
    var cuentas = document.getElementById("cuenta_destino");
    var numeroCuentaSeleccionado = cuentas.options[cuentas.selectedIndex].getAttribute('data-numero-cuenta');
    //document.getElementById('nro_cuenta').value = numCuenta; // Asignar al campo de número de cuenta
    if (id_cuenta == '8'){
        fecha_deposito.style.display = 'block'; // Mostrar campo
    } else {
        fecha_deposito.style.display = 'none'; // Ocultar campo
    }
    document.getElementById("nro_cuenta_garantia").value = numeroCuentaSeleccionado;
    document.getElementById("nro_cuenta").value = numeroCuentaSeleccionado;
});
</script>
    