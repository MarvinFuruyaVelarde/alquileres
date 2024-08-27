var _modal1 = $('#profesion');
var csrf = $('input[name="_token"]').val();
var adminUrl=url_global;
$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function reset() {
    _modal1.find('input').each(function () {
        $(this).val(null)
    })
};
_modal1.on('shown.bs.modal', function () {
    $('#descripcion1').trigger('focus')
})

$(document).on('submit', '#storeProfesion', function(event) {
	event.preventDefault();
    var nombre=$('#descripcion1').val();
    $.ajax({
        method: 'POST',
        url: adminUrl + '/profesion',
        data: {descripcion:nombre},
        dataType: 'JSON',
        success: function (respuesta)
        { 
            reset()
            _modal1.modal('hide')
            var html_select='<option value="">Seleccionar..</option>';
            for(var i=0; i<respuesta.length; ++i){
                html_select+='<option value="'+respuesta[i].id+'"'+ (nombre==respuesta[i].descripcion ? 'selected' : '') +'>'+respuesta[i].descripcion+'</option>'
            }
            $('#profesion_id').html(html_select);
            $("#profesion_id").trigger("chosen:updated");
        },
        error: function (data) {
            console.log(data);
        }

    })
});