<div class="contenedor">

    <div class="flex-col">
      <div class="titulo-descripcion">
              <label>Generar reporte de pago</label>
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
      <?php }?>	

		<div class="flex-row">

			<div class="panel">
				<span class="check-success">Información General</span>
					<p>
						<ol>
						  <li>La activación de la publicación se realizara posterior a la verificacion del pago</li>
						  <li>Ejemplo: Si su pago proviene de OTRO BANCO, debera esperar el lapso correspondiente para hacerse disponible el pago en nuestras cuentas (aprox. 24 Horas)</li>
						</ol>
					</p>          			
			</div>
		</div>
<img src="">
		<div class="flex-row">
			<a href="<?php echo base_url();?>cuentas" class="flex-row btn btn-pago btn-largo" target="_blank">cuentas</a>
		</div>

<div class="flex-row">
	<h1 style="text-align: center;"><?php echo ucwords(mb_strtolower($publicacion->titulo));?></h1>
</div>
		<div class="flex-row top">

				<!--<img src="<?php echo base_url()."publicaciones/".$publicacion->codigo."/".$publicacion->url_uno."";?>" alt="foto" >-->

			<div class="flex-col">
					<form id="reporte_pago" action="<?php echo base_url(); ?>Cpago/procesarPago" method="POST">

			            <div class="group-text-field">
			            <label for="id_banco_ori" class="control-label">Banco desde donde realizo el pago (origen)</label>
									<div class="form-select bienfino-select">		
										<select class="input-form" name="id_banco_ori" id="id_banco_ori">
			                	<option value="" selected="">Seleccione</option>

			                	<?php 
			                		foreach ($bancoOri as $value) {
			                			echo "<option value='".$value->id_banco_ori."' >".$value->nombre_banco_origen."</option>";
			                		}
			                	?>

										</select>
									</div>
			                <?php echo form_error('id_banco_ori');?>
			            </div>						            
			            <div class="group-text-field">
			            <label for="id_banco_des" class="control-label">Banco donde realizo el pago (destino)</label>
									<div class="form-select bienfino-select">	
											<select class="input-form" name="id_banco_des" id="id_banco_des">
			                	<option value="" selected="">Seleccione</option>

			                	<?php 
			                		foreach ($bancoDes as $value) {
			                			echo "<option value='".$value->id_banco_des."' >".$value->nombre_banco_destino."</option>";
			                		}
			                	?>

			                </select>
									</div>
											<?php echo form_error('id_banco_des');?>
			            </div>
			            
						<div class="group-text-field">
									<label for="id_tipo_pago" class="control-label">Tipo de pago:</label>
									<div class="form-select bienfino-select">
			                <select class="input-form" name="id_tipo_pago" id="id_tipo_pago">
			                	<option value="" selected="">Seleccione</option>

			                	<?php 
			                		foreach ($tipoPago as $value) {
			                			echo "<option value='".$value->id_tipo_pago."' >".$value->nombre_tipo_pago."</option>";
			                		}
			                	?>

											</select>
									</div>
			                <?php echo form_error('id_tipo_pago');?>
			            </div>							            						            										
					  <div class="group-text-field">
					    <label for="num_pago">Número de referencia</label>
					    <input type="text" class="input-form" id="num_pago" name="num_pago" maxlength="10" value="<?php echo set_value('num_pago');?>">
					    <?php echo form_error('num_pago');?>
					    <span class="help-block">Debe contener solo números (Sin caracteres especiales)</span>
					  </div>
					  <div class="group-text-field">
					    <label for="fecha_operacion">Fecha de la operación</label>
					    <input type="text" class="input-form datepicker" id="fecha_operacion" name="fecha_operacion" value="<?php echo set_value('fecha_operacion');?>" readonly="">
					    <?php echo form_error('fecha_operacion');?>
					  </div>
					  <div class="group-text-field">
					    <label for="hora_operacion">Hora de la operación</label>
					    <input type="text" class="input-form timepicker" id="hora_operacion" name="hora_operacion" value="<?php echo set_value('hora_operacion');?>" readonly="">
					    <?php echo form_error('hora_operacion');?>
					  </div>									  
						<input type="hidden" class="form-control" name="id_publicacion" value="<?php echo $publicacion->id_publicacion;?>">  										  							
						<button type="botton" class="btn btn-do right" id="enviarreportepago">siguiente</button>
					</form>

			</div>
			<div class="flex-col margin-left">
				<table class="table" style="margin-top: 1.5rem;">
					<tr><th>Tipo Publicación</th>
						<td><?php echo $publicacion->nombre_precio;?></td>
					</tr>
					<tr><th>Precio</th>
						<td><?php echo $publicacion->precio_publicacion." ".$publicacion->moneda;?></td>
					</tr>
					<tr><th>Iva</th>
						<td><?php echo $publicacion->iva." %";?></td>
					</tr>
					<tr><th class="success"><strong>Total a pagar</strong></th>
						<td class="success"><?php echo "<h2>".$publicacion->total." ".$publicacion->moneda."</h2>";?></td>
					</tr>									
				</table>
				</div>
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
<script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/imagen_publicacion.js"></script>
<script src="<?php echo base_url();?>js/geo.js"></script>
<script src="<?php echo base_url();?>js/categoria_publicar.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
<script src="<?php echo base_url();?>js/wickedpicker.min.js"></script>

<script src="<?php echo base_url();?>js/datepicker_romel.js"></script>
<script src="<?php echo base_url();?>js/validaciones/reporte_pago.js"></script>
<script src="<?php echo base_url();?>js/wickedpicker_romel.js"></script>

<script>
//formulario
  $(".categoria").click(function(){
    buscarMarca();
  });

  $("#id_marca").change(function(){
    buscarModelo();
  });
  $("#id_modelo").change(function(){
    buscarAno();
  });

  $("#codigoestado").change(function(){
    buscarMunicipios2();
  });
  $("#codigomunicipio").change(function(){
    buscarParroquia();
  });  

</script>


<script>
//menu
  $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });

  $("#marca_menu").change(function(){
    buscarModeloMenu();
  });

</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
swal("Información General", "La activación de la publicación se realizara posterior a la verificacion del pago. \n\nEjemplo: Si su pago proviene de OTRO BANCO, debera esperar el lapso correspondiente para hacerse disponible el pago en nuestras cuentas (aprox. 24 Horas)", "success", {
  button: "Entendido",
});
</script>

</body>
</html>
