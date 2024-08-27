var _modal = $('#institutos');
var csrf = $('input[name="_token"]').val();
var adminUrl=url_global;
$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function reset() {
    _modal.find('input').each(function () {
        $(this).val(null)
    })
};
_modal.on('shown.bs.modal', function () {
    $('#descripcion').trigger('focus')
})

$(document).on('submit', '#storeInstituto', function(event) {
	event.preventDefault();
    var nombre=$('#descripcion').val();
    $.ajax({
        method: 'POST',
        url: adminUrl + '/institucion_formacion',
        data: {descripcion:nombre},
        dataType: 'JSON',
        success: function (respuesta)
        { 
            reset()
            _modal.modal('hide')
            var html_select='<option value="">Seleccionar..</option>';
            for(var i=0; i<respuesta.length; ++i){
                html_select+='<option value="'+respuesta[i].id+'"'+ (nombre==respuesta[i].descripcion ? 'selected' : '') +'>'+respuesta[i].descripcion+'</option>'
            }
            $('#institucion_formacion_id').html(html_select);
            $("#institucion_formacion_id").trigger("chosen:updated");
        },
        error: function (data) {
            console.log(data);
        }

    })
});