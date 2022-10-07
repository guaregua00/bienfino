<div class="contenedor">
      <div class="flex-col">
        <div class="titulo-descripcion">
                <label>Asociar mi publicación</label>
                <span>De mananera muy sencilla puede asociar una publicación a su cuenta si coinciden los siguientes datos</span>
        </div>
      </div><!--flex-col-->  

          <form id="asociar" method="POST" action="<?php echo base_url();?>Cpublicacion/asociar">

          <div class="flex-row wrap">
            <div class="flex-col">
                <div class="group-text-field">
                <label for="placa">Placa</label>
                  <input type="text" class="input-form" id="placa" name="placa" maxlength="7" required>
                  <?php echo form_error('placa');?>
                  <span class="help-block">ABC123</span>
                  <!--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>-->
                </div>   

                <div class="group-text-field">
                  <label for="movil">Telefono Movil</label>
                  <input type="tel" class="input-form" id="movil" name="movil" maxlength="11">
                  <?php echo form_error('movil');?>
                  <span class="help-block">Ejemplo: 04141234567</span>
                </div>
            </div>
          </div><!--flex-row-->
          <div class="flex-row">
            <button class="btn-do right" id="boton_enviar_personales" type="botton">Siguiente</button>
          </div>
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
  $this->view('layouts/Vfooter');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
<script src="<?php echo base_url();?>js/validaciones/asociar.js"></script>




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
