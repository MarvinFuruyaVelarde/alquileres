$(document).ready(function () {
    calcularEdad();
    onSelectCiudadChange();
    tipoCargo();
    libretaMilitar();
    onSelectAreaChange();
    $('#ciudad_id').on('change', onSelectCiudadChange);
    $('#area_id').on('change', onSelectAreaChange);
    $('#tipo_cargo').on('change', onSelectAreaChange, tipoCargo);
    $('#fecha_nacimiento').on('change', calcularEdad);
    $("#foto").change(function () { //Cuando el input ccambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
        readURL(this);
    });
});

function calcularEdad() {
    var fecha = $('#fecha_nacimiento').val();
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    $("#campo_edad").val(edad);
}

function libretaMilitar() {
    var sexo = $('#sexo').val();
    if (sexo != 1) {
        $("#nro_libreta_militar").prop('disabled', false);
    }
    else {
        $("#nro_libreta_militar").prop('disabled', true);
    }
}

function onSelectCiudadChange() {
    var ciudad = $('#ciudad_id').val();
    var ruta = $('#ciudad_id').data('ruta');
    $.get(ruta, { id: ciudad }, function (respuesta) {
        $('#provincia').empty();
        $('#provincia').val(respuesta);
    });
};

function onSelectAreaChange() {
    var area = $('#area_id').val();
    var tipo = $('#tipo_cargo').val();
    var ruta = $('#area_id').data('ruta');
    var valor= $('#cargo_id').data('old');
    $.get(ruta, { area_id: area,tipo_cargo:tipo }, function (data) {
        $('#cargo_id').empty();
        var html_select='<option value="">-- SELECCIONE --</option>';
        var nroItemP='';
        for(var i=0; i<data.length; ++i){
            nroItemP=data[i].nro_item;
            if(nroItemP==null){
                nroItemP='';
            }
            html_select+='<option value="'+data[i].id +'"'+ (valor==data[i].id ? 'selected' : "") +'><strong>( '+data[i].denominacion_cargo_nombre+' )</strong>-->'+nroItemP+'-'+data[i].nombre+'</option>'
        }
        $('#cargo_id').html(html_select);
    });

    if(tipo=='ITEM'){
        $('#nro_item').prop('disabled', false);
        $("#nro_item").attr("required", true);
    }else{
        $("#nro_item").attr("required", false);
        $('#nro_item').prop('disabled', true);
    }
};

function tipoCargo() {
    var tc = $('#tipo_cargo').val();
    if (tc == 'CONSULTOR INDIVIDUAL EN LINEA' || tc =='CONSULTOR POR PROGRAMA') {
        $("#nit").prop('disabled', false);
    }
    else {
        $("#nit").prop('disabled', true);
    }
}

$("#ciudad_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#area_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#cargo_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

//SOLO LETRAS EN LOS CAMPOS DEL FORMULARIO EMPLEADO
function soloLetras(e) {
    var letra = e.keyCode;
    if ((letra > 64 && letra < 91) || (letra > 96 && letra < 123) || (letra === 8) || (letra === 32) || (letra === 9) || (letra === 164)) {
        return true;
    } else {
        return false;
    }

}

function readURL(input) {
    if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
        var reader = new FileReader(); //Leemos el contenido

        reader.onload = function (e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
            $('#imagen').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
