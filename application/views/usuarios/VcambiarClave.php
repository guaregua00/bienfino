
<div class="contenedor2">
  

          <div class="flex-col">
            <div class="titulo-descripcion">
                    <label>Cambio Contraseña</label>
                    <!--<span>Cambiar contraseña</span>-->
            </div>
          </div><!--flex-col-->  


              <div class="flex-row wrap">
                <div class="flex-col">
                  <form id="cambioClave" method="POST" action="<?php echo base_url();?>Cusuarios/cambiarClave">
                    <div class="group-text-field">
                                <label for="clave_actual">Contraseña actual</label>
                                <input type="password" class="input-form" id="clave_actual" name="clave_actual" placeholder="Contraseña actual" maxlength="16" required autofocus>
                              <?php echo form_error('clave_actual');?>
                    </div>

                    <div class="group-text-field">
                              <label for="password">Contraseña Nueva</label>
                              <input type="password" class="input-form" id="password" name="password" value="<?php echo set_value('password');?>" placeholder="Contraseña Nueva" maxlength="16" required autofocus>
                              <?php echo form_error('password');?>
                    </div>

                    <div class="group-text-field">
                              <label for="titulo">Repetir Contraseña Nueva</label>
                              <input type="password" class="input-form" id="new_password" name="new_password" maxlength="16" placeholder="Repetir Contraseña Nueva" required autofocus>
                              <?php echo form_error('new_password');?>
                    </div>

                    <div class="inputdata">
                      <button type="botton" id="boton_cambiar_clave" class="btn btn-info btn-mini">Cambiar Contraseña</button>
                    </div>
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        
                    
                 </form>

                    <?php if($this->session->flashdata('mensaje')){ ?>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                            </div>
                          </div>
                          <br>
                    <?php }?> 

                    <?php if(isset($mensaje)){ ?>
                        <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger"> <?php echo $mensaje; ?></div>
                          </div>
                        </div>
                  <?php }?>

                  <?php if(isset($mensaje2)){ ?>
                        <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-success"> <?php echo $mensaje2; ?></div>
                          </div>
                        </div>
                  <?php }?>

                </div>
              </div><!--flex-row-->

</div><!--contenedor-->
<?php
  $this->view('layouts/footerR');
?>

    

    </footer>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
<script src="<?php echo base_url();?>js/validaciones/cambiarclave.js"></script>
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
<script src="<?= base_url();?>upload/alertifyjs/alertify.js"></script>

<script type="text/javascript">        
        //override defaults
        alertify.defaults.transition = "zoom";
        alertify.defaults.theme.ok = "ui positive button";
        alertify.defaults.theme.cancel = "ui black button";



        if(!alertify.myAlert){
        //define a new dialog
        alertify.dialog('myAlert',function factory(){
            return{
            main:function(message){
                this.message = message;
            },
            setup:function(){
                return { 
                    buttons:[{text: "ok", key:27/*Esc*/}],
                    focus: { element:0 }
                };
            },
            prepare:function(){
                this.setContent(this.message);
            }
        }});
        }
        if(!alertify.errorAlert){
        //define a new errorAlert base on alert
        alertify.dialog('errorAlert',function factory(){
            return{
                    build:function(){
                        var errorHeader = '<span class="fa fa-times-circle fa-2x" '
                        +    'style="vertical-align:middle;color:#e10000;">'
                        + '</span> Ocurrio un error';
                        this.setHeader(errorHeader);
                    }
                };
            },true,'alert');
        }
</script>

        <?php if($this->session->flashdata('mensajePublicar')){ ?>
        <script>
        alertify.errorAlert();
        alertify.alert('Notificación', '<?=$this->session->flashdata('mensajePublicar')?>');
        </script>
        <?php }?>

        <?php if($this->session->flashdata('mensaje')){ ?>
        <script>
        alertify.alert('Notificación', '<?=$this->session->flashdata('mensaje')?>');
        </script>
        <?php }?>

        <?php if($this->session->flashdata('mensajeExito')){ ?>
        <script>
        alertify.success('Operación Exitosa!');
        alertify.alert('Exito!', '<?=$this->session->flashdata('mensajeExito')?>');
        </script>
        <?php }?>

        <?php if($this->session->flashdata('mensajeError')){ ?>
        <script>
        alertify.errorAlert('<?=$this->session->flashdata('mensajeError')?>');
        </script>
        <?php }?>

        <?php if(isset($mensaje)){ ?>
        <script>
        alertify.errorAlert();
        alertify.alert('Notificación', '<?=$mensaje?>');
        </script>
        <?php }?>

        <?php if(isset($mensaje_cuenta_act)){ ?>
        <script>
        alertify.errorAlert();
        alertify.alert('Notificación', '<?=$mensaje_cuenta_act?>');
        </script>
        <?php }?>

        <?php if($this->session->flashdata('mensajecompletado')){ ?>
            <script>
                alertify.success('Registro Completo!');
                alertify.alert('Exito!', '<?=$this->session->flashdata('mensajecompletado')?>');
            </script>
        <?php }?>        


</body>
</html>
