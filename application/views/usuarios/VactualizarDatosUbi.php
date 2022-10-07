<div class="contenedor">


      <div class="flex-col">
        <div class="titulo-descripcion">
                <label>Actualizar datos de Ubicación</label>
                <!--<span>Cambiar contraseña</span>-->
        </div>
      </div><!--flex-col-->  

      <form id="ubicacion" method="POST" action="<?php echo base_url();?>Cusuarios/actualizarDatosUbicacion">

        <div class="flex-row wrap">
          <div class="flex-col">

              <div class="group-text-field">
                <label>Estado</label><span class="red"> *</span>
                <select  class="input-form" name="codigoestado" id="codigoestado">
                  <option selected="selected" value="">Seleccione un estado</option>
                  <?php
                  foreach ($estados as $value) {
                    ?>
                    <option value="<?php echo $value->codigoestado; ?>"><?php echo ucwords($value->nombre); ?></option>
                 <?php 
                   }
                  ?>                      
                </select>
                <?php echo form_error('codigoestado');?>
              </div>

              <div class="group-text-field">
                <label>Municipio</label><span class="red"> *</span>
                <select  class="input-form" name="codigomunicipio" id="codigomunicipio">
                  <option value="">Seleccione un municipio</option>
                </select>
                <?php echo form_error('codigomunicipio');?>
              </div>

              <div class="group-text-field">
                <label>Parroquia</label><span class="red"> *</span>
                <select  class="input-form" name="codigoparroquia" id="codigoparroquia">
                  <option value="">Seleccione una parroquia</option>
                </select>
                <?php echo form_error('codigoparroquia');?>
              </div> 

              <div class="group-text-field">
                  <label>Dirección Especifica</label><span class="red"> *</span>
                  <textarea class="input-form" rows="3" maxlength="255" id="direccion_esp" name="direccion_esp"></textarea>
                  <?php echo form_error('direccion_esp');?>  
              </div>

          </div>
        </div><!--flex-row-->
              <div class="flex-row">
                <button class="btn btn-info" id="boton_enviar_ubicacion" type="botton" style="margin-bottom: 20px;">Actualizar</button>
              </div>
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        
      </form>  
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
                   
</div>

<?php
  $this->view('layouts/footerR');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
<script src="<?php echo base_url();?>js/geo.js"></script>
<script src="<?php echo base_url();?>js/validaciones/actualizarUbicacion.js"></script>
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
<script>
//menu
  $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });

  $("#marca_menu").change(function(){
    buscarModeloMenu();
  });

</script>

<script>
//formulario

  $("#codigoestado").change(function(){
    buscarMunicipios2();
  });
  $("#codigomunicipio").change(function(){
    buscarParroquia();
  });  

</script>
</body>
</html>
