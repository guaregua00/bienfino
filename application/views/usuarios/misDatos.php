


<div class="contenedor2">
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
              		<i class="fas fa-user-circle fa-4x y-bf"></i>

              		
              			
            <h3 class="text-center title" style="padding-bottom: 15px;">Datos personales</h3>

              <div class="detalle">
                  <ul class="ul-detalle">
                      <li class="li-detalle"><span>Nombres:</span> <?php echo ucwords(mb_strtolower($usuarios->nombres));?></li>
                      <li class="li-detalle"><span>Apellidos:</span> <?php echo ucwords(mb_strtolower($usuarios->apellidos));?></li>
                  </ul>  
              </div>
              <a href="<?php echo base_url();?>datospersonales" id="btn btn-info btn-mini" class="btn btn-mini btn-info">Modificar</a>

              		
            <h3 class="text-center title" style="padding-bottom: 15px;">Datos de Ubicación</h3>

            <div class="detalle">
                  <ul class="ul-detalle">
                      <li class="li-detalle"><span>Estado:</span> <?php echo ucwords(mb_strtolower($usuarios->estado));?></li>
                      <li class="li-detalle"><span>Municipio:</span> <?php echo ucwords(mb_strtolower($usuarios->municipio));?></li>
                      <li class="li-detalle"><span>Parroquia:</span> <?php echo ucwords(mb_strtolower($usuarios->parroquia));?></li>
                      <li class="li-detalle"><span>Dirección:</span> <?php echo ucwords(mb_strtolower($usuarios->direccion_esp));?></li>
                    </ul>  
            </div>

            <a href="<?php echo base_url();?>datosubicacion" id="btn btn-info btn-mini" class="btn btn-mini btn-info">Modificar</a>

            </div><!--flex-row-->

        </div>
    </div>
</div><!--contenedor-->
<?php
  $this->view('layouts/footerR');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
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
