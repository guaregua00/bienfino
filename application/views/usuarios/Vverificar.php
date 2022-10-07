<div class="contenedor">

		<div class="flex-row">

			<div class="panel">
				<span class="check-success">Información General</span>
					<span>Confirmación de registro!</h4>
         				Acabamos de enviarte un email para que confirmes tu registro.Haz click en el link del email para confirmar tu registración. Si no recibes un email en 15 minutos, revisa tu bandeja de Spam.</span>
         				<a class="btn-do" href="<?php echo base_url();?>" role="button">Volver a Pagina principal</a>
			</div>
		</div>
</div>

<?php
  $this->view('layouts/Vfooter');
?>
<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>


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
