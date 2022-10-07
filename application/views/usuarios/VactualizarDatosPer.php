<div class="contenedor">


      <div class="flex-col">
        <div class="titulo-descripcion">
                <label>Actualizar datos personales</label>
                <!--<span>Cambiar contraseña</span>-->
        </div>
      </div><!--flex-col-->  

          <form id="personales" method="POST" action="<?php echo base_url();?>Cusuarios/actualizarDatosPersonales">

                <!--
                <div class="form-group has-feedback">
                <label for="nacionalidad">Nacionalidad</label>
                  <select class="form-control" id="nac" name="nac">
                      <option value="">Seleccione</option>
                      <option value="V" <?php if($usuarios->nac == 'V') echo "selected"; ?>>Venezolano(a)</option>
                      <option value="E" <?php if($usuarios->nac == 'E') echo "selected"; ?>>Extranjero(a)</option>
                  </select>
                  <?php echo form_error('nac');?>
                </div>
                <div class="form-group has-feedback">
                  <label for="cedula">cedula</label>
                  <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" placeholder="Cedula" value="<?php echo $usuarios->cedula; ?>">
                  <?php echo form_error('cedula');?>
                </div>-->
          <div class="flex-row wrap">
            <div class="flex-col">
                <div class="group-text-field">
                <label for="nombres">nombres</label>
                  <input type="text" class="input-form" id="nombres" name="nombres" maxlength="100" required>
                  <?php echo form_error('nombres');?>
                  <!--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>-->
                </div>   

                <div class="group-text-field">
                  <label for="apellidos">Apellidos</label>
                  <input type="text" class="input-form" id="apellidos" name="apellidos">
                  <?php echo form_error('apellidos');?>
                </div>
            </div>
          </div><!--flex-row-->
          <div class="flex-row">
            <button class="btn btn-info" id="boton_enviar_personales" type="botton" style="margin-bottom: 20px;">Actualizar</button>
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
<script src="<?php echo base_url();?>js/validaciones/actualizarPersonales.js"></script>
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
