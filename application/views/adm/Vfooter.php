 <footer class="main-footer">
    <div class="pull-right hidden-xs">
<!--       <b>Version</b> 2.3.8 -->
    </div>
    <strong>Copyright &copy; <?php echo date('Y');?> <a href="<?php echo base_url()?>">BienFino</a>.</strong>
  </footer>
  
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>utilidadesadm/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>utilidadesadm/bootstrap/js/bootstrap.min.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url();?>utilidadesadm/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>utilidadesadm/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>utilidadesadm/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>utilidadesadm/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>utilidadesadm/dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>utilidadesadm/dist/js/demo.js"></script>

<script src="<?php echo base_url();?>js/config_datatables.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>datatables/js/jquery.dataTables.min.js"></script>


<style>
table.dataTable tbody th, table.dataTable tbody td {
    padding: 2px 4px !important;
}
</style>

<script type="text/javascript">
    $(document).ready(function(){

      $('#listausuario').DataTable( {
        "ordering": false,
        "language": {
                processing:     "Procesando...",
                lengthMenu:     "Mostrar _MENU_ ",
                zeroRecords:    "No se encontraron resultados",
                emptyTable:     "Ningún dato disponible en esta tabla",
                info:           "Mostrando Filas de _START_ al _END_ de un total de _TOTAL_ Filas",
                infoEmpty:      "Mostrando Filas del 0 al 0 de un total de 0 Filas",
                infoFiltered:   "(filtrado de un total de _MAX_ Filas)",
                infoPostFix:    "",
                search:         "Buscar:",
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



    var table = $('#listausuario').DataTable();
     
    $('.boton').click(function () {
        var $date = table.row( this ).data();
        cambiar($date);
    } );

      $('#listahistoricopago').DataTable( {
        "ordering": false,
        "language": {
                processing:     "Procesando...",
                lengthMenu:     "Mostrar _MENU_ Reportes",
                zeroRecords:    "No se encontraron resultados",
                emptyTable:     "Ningún dato disponible en esta tabla",
                info:           "Mostrando Reportes de _START_ al _END_ de un total de _TOTAL_ Reportes",
                infoEmpty:      "Mostrando Reportes del 0 al 0 de un total de 0 Reportes",
                infoFiltered:   "(filtrado de un total de _MAX_ Reportes)",
                infoPostFix:    "",
                search:         "Buscar Reporte:",
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



    var table = $('#listahistoricopago').DataTable();


    $('.datatables').DataTable( {
        "ordering": false,
        "language": {
                processing:     "Procesando...",
                lengthMenu:     "Mostrar _MENU_ Reportes",
                zeroRecords:    "No se encontraron resultados",
                emptyTable:     "Ningún dato disponible en esta tabla",
                info:           "Mostrando Reportes de _START_ al _END_ de un total de _TOTAL_ Reportes",
                infoEmpty:      "Mostrando Reportes del 0 al 0 de un total de 0 Reportes",
                infoFiltered:   "(filtrado de un total de _MAX_ Reportes)",
                infoPostFix:    "",
                search:         "Buscar Reporte:",
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

      var table = $('.datatables').DataTable();

    } );

    <?php if($this->uri->segment(1)=='addDirectorio' || $this->uri->segment(1)=='VaddPagoDirectorio'){?>

        $('#banco-origen').attr('disabled', true);
        $('#banco-destino').attr('disabled', true);
        $('#referencia').attr('disabled', true);
        $('#monto').attr('disabled', true);
        $('#div-banco-origen').hide();
        $('#div-banco-destino').hide();
        $('#div-referencia').hide();
        $('#div-monto').hide();


    $("#metodo-pago").change(function(){
      
      $("#banco-origen").removeAttr('disabled');
      $("#banco-destino").removeAttr('disabled');
      $("#referencia").removeAttr('disabled');
      $("#monto").removeAttr('disabled');

        $('#div-banco-origen').show();
        $('#div-banco-destino').show();
        $('#div-referencia').show();
        $('#div-monto').show();
      if($("#metodo-pago option:selected").text()=='Efectivo'){
        $('#banco-origen').attr('disabled', true);
        $('#banco-destino').attr('disabled', true);
        $('#referencia').attr('disabled', true);
        $('#div-banco-origen').hide();
        $('#div-banco-destino').hide();
        $('#div-referencia').hide();
      }

      if($("#metodo-pago option:selected").text()=='Ninguno'){
        $('#div-banco-origen').hide();
        $('#div-banco-destino').hide();
        $('#div-referencia').hide();
        $('#div-monto').hide();
        $('#banco-origen').attr('disabled', true);
        $('#banco-destino').attr('disabled', true);
        $('#referencia').attr('disabled', true);
        $('#monto').attr('disabled', true);
      }
      
  });

  <?php }?>
    
</script>



</body>
</html>
