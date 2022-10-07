<div class="contenedor">
		<div class="flex-row">

			<div class="panel">
				<span class="check-success" style="background-color: red">Ocurrio un Error!</span>
					
         				<?php
                  if (isset($mensaje)) {
                    echo $mensaje;
                  }
                ?></span>
         				<a class="btn-do" href="<?php echo base_url();?>asociar" role="button">Ir a asociar Publicación</a>
			</div>
		</div>

</div>

<?php
  $this->view('layouts/Vfooter');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
<script src="<?php echo base_url();?>js/validaciones/actualizarContacto.js"></script>




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
