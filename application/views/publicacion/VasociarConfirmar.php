<div class="contenedor">

<div class="detail-screen">
    <div class="detail-info">
        <div class="detail-header">
        <span>Categoria: <?php echo $publicacion->categoria.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?></span>
        <span>
        <?php
            $titulo = $publicacion->titulo;
            //maximo 16 caracteres
            if (strlen($titulo)<= 16) {
              echo ucwords(mb_strtolower($titulo));
            }else{
              $titulo_corto = substr($titulo, 0,13);
              echo ucwords(mb_strtolower($titulo_corto))."...";
            }
        ?>
        </span>
        <div class="cintillo-info">
            <span><?php echo ucwords(strtolower($publicacion->traccion));?></span>
            <span><?php echo $publicacion->recorrido.' Km';?></span>
            <span><?php echo ucwords(strtolower($publicacion->marca)).' '.ucwords(strtolower($publicacion->modelo)); ?></span>
            <span><?= $publicacion->id_ano; ?></span>
        </div>
        </div>
        <div class="photo-viewer">
            <div class="photo-viewer-panel">
                <img src="<?php echo base_url()."publicaciones/".$publicacion->codigo."/".$publicacion->url_uno;?> " alt="foto2" data-index="1">
                <img src="<?php echo base_url()."publicaciones/".$publicacion->codigo."/".$publicacion->url_dos;?>" alt="foto3" data-index="2">
                <img src="<?php echo base_url()."publicaciones/".$publicacion->codigo."/".$publicacion->url_tres;?>" alt="foto4" data-index="3">
                <img src="<?php echo base_url()."publicaciones/".$publicacion->codigo."/".$publicacion->url_cuatro;?>" alt="foto5"  data-index="4">
                <?php if($publicacion->url_cinco){?>
                <img src="<?php echo base_url()."publicaciones/".$publicacion->codigo."/".$publicacion->url_cinco;?>" alt="foto6"  data-index="5">
                <?php }
                if($publicacion->url_seis){
                ?>
                <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto_corolla.jpg" alt="foto1"  data-index="6">
                <?php } ?>
            </div>
            <div class="photo-viewer-visor">
                <!--<a href="#">VISTA 360</a>-->
                <span class="left-arrow"></span>
                <img src="<?php echo base_url()."publicaciones/".$publicacion->codigo."/".$publicacion->url_uno;?> " alt="imagen_central" data-position="1">
                <span class="right-arrow"></span>
            </div>
        </div>
    </div>
    <div class="detail-contact">
        <div class="ubicacion-pub">
            <span><?php echo ucwords(strtolower($publicacion->estado));?></span><!--<span>MEDIO</span>-->
        </div>

        <div class="detail-user">

       					<h3 class="text-center">Datos del Vehiculo</h3>
					<table class="" >
						<tr><th>Información Adicional</th>
							<td><?php echo ucwords(strtolower($publicacion->comentario));?></td>
						</tr>
						<tr><th>Vidrios</th>
							<td><?php echo ucwords(strtolower($publicacion->vidrios));?></td>
						</tr>
						<tr><th>Vidrios</th>
							<td><?php echo ucwords(strtolower($publicacion->tapizado));?></td>
						</tr>
						<tr><th>Vidrios</th>
							<td><?php echo ucwords(strtolower($publicacion->condicion));?></td>
						</tr>
						<tr><th>Reparado</th>
							<td><?php echo ucwords(strtolower($publicacion->reparado));?></td>
						</tr>
						<tr><th>Color</th>
							<td><?php echo ucwords(strtolower($publicacion->color));?></td>
						</tr>
						<tr><th>Unico Dueño</th>
							<td><?php echo ucwords(strtolower($publicacion->unico_dueno));?></td>
						</tr>
						<tr><th>Motor</th>
							<td><?php echo ucwords(strtolower($publicacion->motor));?></td>
						</tr>
						<tr><th>Kilometraje</th>
							<td><?php echo ucwords(strtolower($publicacion->recorrido)) . "Km";?></td>
						</tr>
						<tr><th>Negociable</th>
							<td><?php echo ucwords(strtolower($publicacion->negociable));?></td>
						</tr>											
					</table>              
        </div>
         
    </div>


</div>
    <div class="flex-row">
        <form method="POST" action="<?php echo base_url();?>Cpublicacion/asociarExito">
        	<input type="hidden" class="input-form" id="id_publicacion" name="id_publicacion" value="<?php echo $publicacion->id_publicacion;?>" required>
            <input type="hidden" class="input-form" id="placa" name="placa" value="<?php echo $datosPost['placa'];?>" required>
            <input type="hidden" class="input-form" id="movil" name="movil" value="<?php echo $datosPost['movil'];?>" required>
            <button type="submit" class="btn btn-pago btn-largo">Asociar a mi cuenta</button>
        </form>
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
