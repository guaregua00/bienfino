


<div class="contenedor">


	    <div class="flex-col">
	      <div class="titulo-descripcion">
	              <label>Mis datos</label>
	              <!--<span>Cambiar contraseña</span>-->
	      </div>
	    </div><!--flex-col-->  

		      <?php if(isset($mensaje)){ ?>
		            <div class="row">
		              <div class="col-md-12">
		                  <div class="alert alert-danger"> <?php echo $mensaje; ?></div>
		              </div>
		            </div>
		      <?php }?>
		      <?php if($this->session->flashdata('mensaje')){ ?>
		            <div class="row">
		              <div class="col-md-12">
		                  <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje'); ?></div>
		              </div>
		            </div>
		            <br>
		      <?php }?> 

		      <?php if($this->session->flashdata('mensaje2')){ ?>
		            <div class="row">
		              <div class="col-md-12">
		                  <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
		              </div>
		            </div>
		            <br>
		      <?php }?>  
		      
		      <?php if(isset($mensaje2)){ ?>
		            <div class="row">
		              <div class="col-md-12">
		                  <div class="alert alert-success"> <?php echo $mensaje2; ?></div>
		              </div>
		            </div>
		      <?php }?>
      
            <div class="flex-row wrap">
              <div class="flex-col center">

					<h3 class="text-center">Datos personales</h3>
					<table class="table">
						<tr><th>Nombres</th>
							<td><?php echo ucwords(mb_strtolower($usuarios->nombres));?></td>
						</tr>
						<tr><th>Apellidos</th>
							<td><?php echo ucwords(mb_strtolower($usuarios->apellidos));?></td>
						</tr>

						<tr><th>&nbsp</th>
							<td><div  class="float-bottom-center"><a  class="btn-do" href="<?php echo base_url();?>datospersonales">Modificar</a><div></td>
						</tr>									
					</table>

<!--
					<h3 class="text-center">Datos de Contacto</h3>
					<table class="table">
						<tr><th>Movil uno</th>
							<td><?php echo $usuarios->moviluno;?></td>
						</tr>
						<tr><th>Movil dos</th>
							<td><?php if(isset($usuarios->movildos))echo $usuarios->movildos;?></td>
						</tr>

						<tr><th>&nbsp</th>
							<td><div  class="float-bottom-center"><a  class="btn-do"  href="<?php echo base_url();?>datoscontacto">Modificar</a></td>
						</tr>									
					</table> 
-->

					<h3 class="text-center">Datos de Ubicación</h3>
					<table class="table">
						<tr><th>Estado</th>
							<td><?php echo ucwords(mb_strtolower($usuarios->estado));?></td>
						</tr>
						<tr><th>Municipio</th>
							<td><?php echo ucwords(mb_strtolower($usuarios->municipio));?></td>
						</tr>
						<tr><th>Parroquia</th>
							<td><?php echo ucwords(mb_strtolower($usuarios->parroquia));?></td>
						</tr>
						<tr><th>Dirección Especifica</th>
							<td><?php echo ucwords(mb_strtolower($usuarios->direccion_esp));?></td>
						</tr>													
						<tr><th>&nbsp</th>
							<td><div  class="float-bottom-center"><a  class="btn-do"  href="<?php echo base_url();?>datosubicacion">Modificar</a></td>
						</tr>									
					</table> 
              </div>
            </div><!--flex-row-->


</div><!--contenedor-->
<?php
  $this->view('layouts/Vfooter');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>


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
