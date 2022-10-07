
<div class="contenedor">


        <div class="flex-col">
          <div class="titulo-descripcion">
                  <label>Verifica tu cuenta</label>
                  <span>Se envio un email para que confirmes tu registro.Inicia Sesión copia y pega el codigo para activar tu cuenta.<br> Si no recibes un email en 5 minutos, revisa tu bandeja de Spam.</span>
          </div>
        </div><!--flex-col-->  


            <div class="flex-row wrap">
              <div class="flex-col">

                    <form id="verificacion" method="POST" action="<?php echo base_url();?>Cusuarios/validarCuenta">
                  <div class="group-text-field">
                      <input type="email" class="input-form" value="<?php echo $this->session->userdata('email');?>" readonly>
                  </div>
                  <div class="group-text-field">
                      <input type="text" class="input-form" id="codigo" name="codigo" placeholder="codigo verificación" required autofocus>
                        <?php echo form_error('password');?>
                    </div>   
                  </div>

                  <button class="btn-do right" id="boton_verificar" type="botton">Verificar</button>
                           
                    </form>
                </div>
              </div>
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
                      <?php if(isset($mensaje2)){ ?>
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="alert alert-success"> <?php echo $mensaje2; ?></div>
                              </div>
                            </div>
                      <?php }?>
                      

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
<script src="<?php echo base_url();?>js/validaciones/verificacion.js"></script>


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
