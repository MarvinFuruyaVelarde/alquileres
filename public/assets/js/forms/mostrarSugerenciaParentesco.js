var adminUrl=url_global;
var csrf = $('input[name="_token"]').val();

$.ajaxSetup({
   headers: {'X-CSRF-Token': csrf}
});

   var adminUrl=url_global;
   $( "#contacto_parentesco" ).autocomplete({
      source: function( request, response ) {
         var ruta=adminUrl+'/tipo_parentesco';
         // Fetch data
         $.ajax({
         url: ruta,
         type: 'post',
         dataType: "json",
         data: {
            search: request.term
         },
         success: function( data ) {
            response( data );
         }
         });
      },
      select: function (event, ui) {
         $('#contacto_parentesco').val(ui.item.value); // save selected id to input
         return false;
      }
      
   });