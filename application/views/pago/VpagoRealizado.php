
<div class="contenedor">

    <div class="flex-col">
      <div class="titulo-descripcion">
              <label>Reporte de pago</label>
              <!--<span>Cambiar contraseña</span>-->
      </div>
    </div><!--flex-col-->  


<div class="panel">
    <span class="check-success">&nbsp Su reporte de pago se ha realizado correctamente</span>
      <span>La activación de la publicación se Realizará posterior a la Verificacion del Pago</span>
        <a class="btn-do" href="<?php echo base_url();?>misPublicacionesExito" role="button">Volver a Mis publicaciones</a>

</div>
<br>
<br>        	
<br>
<br>
<br>
<br>


<?php
  $this->view('layouts/Vfooter');
?>
<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script>
//menu
  $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });

  $("#marca_menu").change(function(){
    buscarModeloMenu();
  });

</script>

</body>
</html>
