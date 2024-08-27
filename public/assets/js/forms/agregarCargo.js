var _modalCargoNuevo = $('#nuevoCargo');
var csrf = $('input[name="_token"]').val();
var adminUrl=url_global;
$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function reset() {
    _modalCargoNuevo.find('input').each(function () {
        $(this).val(null)
    })
};
_modalCargoNuevo.on('shown.bs.modal', function () {
    reset()
    $('#nombre_cargo').trigger('focus')
    var tipoCargo=$('#tipo_cargo').val();
    var areaId=$('#area_id').val();
    $('#areaIdModal').val(areaId);
    $('#tipoCargoModal').val(tipoCargo);
})

$(document).on('submit', '#storeCargo', function(event) {
	event.preventDefault();
    var nombreCargo=$('#nombre_cargo').val();
    var sueldo=$('#sueldo').val();
    var tipoCargo=$('#tipoCargoModal').val();
    var areaId=$('#areaIdModal').val();
    var denominacionId=$('#denominacion_cargo').val();
    var denominacionNombre=$("#denominacion_cargo option:selected").text();
    var nroItem=$('#nro_item').val();
    $.ajax({
        method: 'POST',
        url: adminUrl + '/cargo_store',
        data: {nombre:nombreCargo,sueldo:sueldo,tipo_cargo:tipoCargo,area_id:areaId,denominacion_id:denominacionId,denominacion_nombre:denominacionNombre,nro_item:nroItem},
        dataType: 'JSON',
        success: function (respuesta)
        { 
            reset()
            _modalCargoNuevo.modal('hide');
            var ruta = $('#area_id').data('ruta');
            var valor= nombreCargo;
            $.get(ruta, { area_id: areaId,tipo_cargo:tipoCargo }, function (data) {
                $('#cargo_id').empty();
                var html_select='<option value="">-- SELECCIONE --</option>';
                var nroItem='';
                for(var i=0; i<data.length; ++i){
                    nroItem=data[i].nro_item;
                    if(nroItem==null){
                        nroItem='';
                    }
                    html_select+='<option value="'+data[i].id +'"'+ (valor==data[i].nombre ? 'selected' : "") +'><strong>( '+data[i].denominacion_cargo_nombre+' )</strong>-->'+nroItem+'-'+data[i].nombre+'</option>'
                }
                $('#cargo_id').html(html_select);
            });
            $("#cargo_id").trigger("chosen:updated");
        },
        error: function (data) {
            console.log(data);
        }

    })
});