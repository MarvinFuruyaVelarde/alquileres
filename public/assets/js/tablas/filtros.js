$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#datos thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#datos thead');

    var table = $('#datos').DataTable({
        
        "language": {
            "processing": "Procesando...",
            "lengthMenu": 'Filtrar <select>'+
                '<option value="10">10</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="40">40</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">Todos</option>'+
                '</select> Registros',
            "paginate": {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            "info": "Pagina _PAGE_ de _PAGES_",
            "search": "Buscador Gral.:",
            "emptyTable": "No existen datos registrados.",
            "infoEmpty": "",
        },
        orderCellsTop: true,
        ordering: false,
        pageLength: -1,
        processing:true,
        initComplete: function () {
            var api = this.api();

            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    
                    var title = $(cell).text();
                    if(colIdx==3){
                        $(cell).html('<input type="text" class="form-control bg-yellow-50 col-md-1" placeholder="Buscar "'+title+' />');
                    }
                    else{
                        $(cell).html('');
                    }
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();

                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();

                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },

    });

    $('#datos_detallado thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#datos_detallado thead');

    var table = $('#datos_detallado').DataTable({
        
        "language": {
            "processing": "Procesando...",
            "lengthMenu": 'Filtrar <select>'+
                '<option value="10">10</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="40">40</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">Todos</option>'+
                '</select> Registros',
            "paginate": {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            "info": "Pagina _PAGE_ de _PAGES_",
            "search": "Buscador Gral.:",
            "emptyTable": "No existen datos registrados.",
            "infoEmpty": "",
        },
        orderCellsTop: true,
        ordering: false,
        pageLength: -1,
        processing:true,
        initComplete: function () {
            var api = this.api();

            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    
                    var title = $(cell).text();
                    if(colIdx==4){
                        $(cell).html('<input type="text" class="form-control col-md-1 bg-yellow-50" placeholder="Buscar "'+title+' />');
                    }
                    else{
                        $(cell).html('');
                    }
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();

                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();

                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },

    });
});