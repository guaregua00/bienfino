  <div class="row">
    <footer class="azul_oscuro" <?php if($this->uri->segment(1)=='miPerfil' || $this->uri->segment(1)=='actualizarDatos'){echo 'class="navbar navbar-fixed-bottom"';}?>>
      <div class="container letras-blancas">
        <div class="row">
            <div class="col-md-6">
              <strong class="pull-right">Copyright &copy; 2017 Rif: J-12345678-9</strong> 
            </div>
            <div class="col-md-6">
                <address>
                  <strong>BienFino, Inc.</strong><br>
                  1355 Market Street, Suite 900<br>
                  San Francisco, CA 94103<br>
                  <abbr title="Telefono Local">T:</abbr> (212) 000-000
                </address>

                <address>
                  <strong>Correo</strong><br>
                  <a href="mailto:#" class="letras-blancas">soluciones@bienfino.com</a>
                </address>              
            </div>
        </div>
        


      </div>
      <!-- /.container -->
    </footer>
  </div>
</div>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>plugins/jquery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url();?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>dist/js/demo.js"></script>

<script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>

<script src="<?php echo base_url();?>js/wickedpicker.min.js"></script>

<script src="<?php echo base_url();?>js/wickedpicker_romel.js"></script>

<script src="<?php echo base_url();?>js/datepicker_romel.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>datatables/js/jquery.dataTables.min.js"></script>

<!--<script src="<?php echo base_url();?>js/datepicker-es.js"></script>-->
<?php if($this->uri->segment(1)=='publicacion'){ ?>
<script src="<?php echo base_url();?>js/imagen_publicacion.js"></script>
<?php } ?>

<script src="<?php echo base_url();?>js/config_datatables.js"></script>

<script src="<?php echo base_url();?>js/geo.js"></script>

<script src="<?php echo base_url();?>js/categoria.js"></script>

<script src="<?php echo base_url();?>js/precio_migaraje.js"></script>

<!--<script src="<?php echo base_url();?>js/enviado.js"></script>-->

<!-- Validation Plugin Js -->
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/validaciones/registro.js"></script>
<script src="<?php echo base_url();?>js/validaciones/ingreso.js"></script>
<script src="<?php echo base_url();?>js/validaciones/verificacion.js"></script>
<script src="<?php echo base_url();?>js/validaciones/completar.js"></script>
<script src="<?php echo base_url();?>js/validaciones/cambiarclave.js"></script>
<script src="<?php echo base_url();?>js/validaciones/recuperar_clave.js"></script>
<script src="<?php echo base_url();?>js/validaciones/actualizarPersonales.js"></script>
<script src="<?php echo base_url();?>js/validaciones/actualizarContacto.js"></script>
<script src="<?php echo base_url();?>js/validaciones/actualizarUbicacion.js"></script>
<script src="<?php echo base_url();?>js/validaciones/publicacion_registro.js"></script>
<script src="<?php echo base_url();?>js/validaciones/reporte_pago.js"></script>

<script type="text/javascript">
  var base_url = "<?php echo base_url();?>";
</script>

<script type="text/javascript">
  
  $('.carousel').carousel({
    interval:false
  })

</script>
<!--
<script type="text/javascript">
  $( "#fecha_operacion" ).datepicker({
      dateFormat : 'yy-mm-dd',
      changeYear: true,
       yearRange: '1981:2003'

  });

  $( "#fecha_operacion" ).datepicker($.datepicker.regional[ "es" ]);  
</script>
-->

<script type="text/javascript">

$( "#consultar" ).click(function() {
  consultarPrecio();
});

$( "#agregar" ).click(function() {
  agregarMigaraje();
});


</script>



<?php if($this->uri->segment(1)!=''){ ?>
<script>

  $("#id_categoria").change(function(){
    buscarMarca();
  });
  $("#id_marca").change(function(){
    buscarModelo();
  });
  $("#id_modelo").change(function(){
    buscarAno();
  });

  $("#codigoestado").change(function(){
    buscarMunicipios();
  });
  $("#codigomunicipio").change(function(){
    buscarParroquia();
  });  

</script>
<?php } ?>


<?php if($this->uri->segment(1)==''){ ?>
<script>

  $("#id_categoria").change(function(){
    buscarMarca();
  });
  $("#id_marca").change(function(){
    buscarModelo();
  });


</script>
<?php } ?>


<!--
<script type="text/javascript">
  var modalConfirm = function(callback){
    
    $("#enviarpublicacion").on("click", function(){
      $("#mi-modal").modal('show');
    });

    $("#modal-btn-si").on("click", function(){
      callback(true);
      $("#mi-modal").modal('hide');
    });
    
    $("#modal-btn-no").on("click", function(){
      callback(false);
      $("#mi-modal").modal('hide');
    });
  };

  modalConfirm(function(confirm){
    if(confirm){
      //Acciones si el usuario confirma
      $("#result").html("CONFIRMADO");
    }else{
      //Acciones si el usuario no confirma
      $("#result").html("NO CONFIRMADO");
    }
  });
</script>
-->
</body>
</html>