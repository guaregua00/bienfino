<div class="contenedor">


      <div class="flex-col">
        <div class="titulo-descripcion">
                <label>Actualizar datos de Contacto</label>
                <!--<span>Cambiar contraseña</span>-->
        </div>
      </div><!--flex-col-->  
          <form id="contacto" method="POST" action="<?php echo base_url();?>Cusuarios/actualizarDatosContacto">

<!--
          <div class="form-group has-feedback">
            <label for="Correo">Correo</label>
            <input type="text" class="form-control" id="email" name="email" maxlength="60" placeholder="Email" value="">
            <?php echo form_error('cedula');?>
          </div>

-->
              <div class="flex-row wrap">
                <div class="flex-col">

                    <div class="group-text-field">
                      <label for="moviluno">Movil Uno</label><span class="red"> *</span>
                      <input type="tel" class="input-form" id="moviluno" name="moviluno" maxlength="11"><?php echo form_error('moviluno');?>
                      <span class="help-block">Ejemplo: 04141234567</span>

                    </div>  

                    <div class="group-text-field">
                      <label for="movildos">Movil Dos</label>
                      <input type="tel" class="input-form" id="movildos" name="movildos" maxlength="11">
                      <?php echo form_error('movildos');?>                          
                    </div>

                  </div>
              </div><!--flex-row-->
              <div class="flex-row">
                <button class="btn btn-info" id="boton_enviar_contacto" type="botton" style="margin-bottom: 20px;">Actualizar</button>
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
<script src="<?php echo base_url();?>js/validaciones/actualizarContacto.js"></script>
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

</body>
</html>
