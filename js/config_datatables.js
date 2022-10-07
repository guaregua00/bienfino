
    $(document).ready(function(){

      

      $('#migaraje').DataTable( {
        "ordering": false,
        "language": {
                processing:     "Procesando...",
                lengthMenu:     "Mostrar _MENU_ Vehiculos",
                zeroRecords:    "No se encontraron resultados",
                emptyTable:     "Ningún dato disponible en esta tabla",
                info:           "Mostrando Vehiculos de _START_ al _END_ de un total de _TOTAL_ Vehiculos",
                infoEmpty:      "Mostrando Vehiculos del 0 al 0 de un total de 0 Vehiculos",
                infoFiltered:   "(filtrado de un total de _MAX_ Vehiculos)",
                infoPostFix:    "",
                search:         "Buscar Vehiculos:",
                url:            "",
                infoThousands:  ",",
                loadingRecords: "Cargando...",
                    
                paginate: {
                    first:    "Primero",
                    last:     "Último",
                    next:     "Siguiente",
                    previous: "Anterior"
                },

                aria: {
                    sortAscending:  ": Activar para ordenar la columna de manera ascendente",
                    sortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            }
      } );



    var table = $('#migaraje').DataTable();
    
    $('.boton').click(function () {
        var $date = table.row( this ).data();
        cambiar($date);
    } );

      $('#mispublicaciones').DataTable( {
        "ordering": false,
        "language": {
                processing:     "Procesando...",
                lengthMenu:     "Mostrar _MENU_ Vehículos",
                zeroRecords:    "No se encontraron resultados",
                emptyTable:     "Ningún dato disponible en esta tabla",
                info:           "Mostrando Vehículos de _START_ al _END_ de un total de _TOTAL_ Vehículos",
                infoEmpty:      "Mostrando Vehículos del 0 al 0 de un total de 0 Vehículos",
                infoFiltered:   "(filtrado de un total de _MAX_ Vehículos)",
                infoPostFix:    "",
                search:         "Buscar Vehículos:",
                url:            "",
                infoThousands:  ",",
                loadingRecords: "Cargando...",
                    
                paginate: {
                    first:    "Primero",
                    last:     "Último",
                    next:     "Siguiente",
                    previous: "Anterior"
                },

                aria: {
                    sortAscending:  ": Activar para ordenar la columna de manera ascendente",
                    sortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            }
      } );

    var table = $('#mispublicaciones').DataTable();
    $('#mispublicaciones_length.dataTables_length>label>select').addClass('select');
    //$('#mispublicaciones_length.dataTables_length>label>select').after('<div class=""></div>');
    //$('#mispublicaciones_length.dataTables_length>label>select').appendTo($( ".bienfino-select" )); // <-- add this line
    //customSelectCall();
    } );   
   