<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registrarse</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Registrate en Bien Fino, Compra tu auto a los mejores precios.">
    <meta name="keywords" content="Venta Auto, Compra Auto, Carro, Moto, Gandola, Venta Carro Venezuela,
    Compra Auto Venezuela, Vender Auto Venezuela, Automovil, Vehiculo, Vender, Comprar, publicar Vehiculo">

    <meta name="theme-color" content="#23262f">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>asset/img/favicon-32x32.png">
    <link href="apple-touch-icon" href="img/logo.png">
    <!--pwa--->
    <link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>asset/img/logo.png">
    <!--pwa--->
    <link href="<?php echo base_url(); ?>asset/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Bienfino-master/css/bienfino_login_registro.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/bf.css"> 
  <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/grid_login_registro.css">
  <link rel="stylesheet" href="<?= base_url();?>Bienfino-master/upload/alertifyjs/alertify.css">
    <link rel="stylesheet" href="<?= base_url();?>Bienfino-master/upload/alertifyjs/themes/semantic.css">    
 <!--[if lte IE 11]>        
    <style type="text/css">#pagina {display:none;}</style>
  <![endif]-->
</head>
<body>
<!--[if lte IE 11]>        
  <div id="ie7lower">
    <a href="https://www.mozilla.org/">
      <p>Para visualizar esta pagina de forma correcta debes actualizar tu navegador..</p>
    </a>
  </div>
<![endif]-->

<div id="pagina">
    <div class="dual-screen">
    <div>
        <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/driving.jpg" class="background-picture" alt="l_banner">
        <div class="overlay"></div>
        <div class="body-left-screen">
          <div class="flex-col">
            <span><i><div class="icon graph-photo-camera-1-copia"></div></i> Compra autos al mejor precio.</span>
            <!-- <span><i><div class="icon graph-steering-wheel"></div></i> Compra y vende repuestos.</span> -->
            <span><i><div class="icon graph-shield-copia"></div></i> Compra con seguridad.</span>
          </div>
        </div>
        <div class="footer-left-screen">
        <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/logo.svg" class="logo-gris logo-sm">
        <p>Copyright &copy;BienFino.com RIF:J-41133916-4.</p>
        </div>
    </div>
    <div>
            <div class="body-right-screen lg-max">
            <a href="<?php echo base_url(); ?>" class="login-link absolute-top-right"><span><div class="icon graph-left-open-big one-line link"></div></span>Regresar</a>
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/logo.svg" class="logo-md" alt="bienfino_logo"></a>
            <p>&Uacute;nete a nuestra comunidad</p>
            <h1>¡Regístrate!</h1>

    <form id="registro" action="<?php echo base_url(); ?>Cusuarios/registrarUsuario" method="POST">
          
          <div class="form-select normal bienfino-select form-group">
<!--             <select name="nac" id="nac" class="input-form">
                <option value="V">Venezolan@</option>
                <option value="E">Extranjer@</option>
            </select>
          </div>
          <div class="group-text-field">
            <input type="text" id="cedula" name="cedula" maxlength="8" placeholder="Cédula" class="input-form" value="<?php echo set_value('cedula');?>">
            <?php echo form_error('cedula');?>
          </div>                        
          <div class="group-text-field">
            <input type="text" placeholder="Nombres" name="nombres" class="input-form" value="<?php echo set_value('nombres');?>">
            <?php echo form_error('nombres');?>
          </div>
          <div class="group-text-field">
            <input type="text" placeholder="Apellidos" name="apellidos" class="input-form" value="<?php echo set_value('apellidos');?>">
            <?php echo form_error('apellidos');?>
          </div> -->
          <div class="group-text-field">
            <input type="email" placeholder="Email" name="email" class="input-form" value="<?php echo set_value('email');?>">
            <?php echo form_error('email');?>
          </div>
<!--           <div class="group-text-field">
            <input type="email" placeholder="Repetir Email" name="email_r" class="input-form" value="<?php echo set_value('email_r');?>">
            <?php echo form_error('email_r');?>
          </div> -->
          <div class="group-text-field">
            <input type="password" placeholder="Contraseña" name="clave" class="input-form" maxlength="16" value="<?php echo set_value('clave');?>">
            <?php echo form_error('clave');?>
          </div>
<!--           <div class="group-text-field">
            <input type="password" placeholder="Repetir Contraseña" class="input-form" name="rclave" maxlength="16" value="<?php echo set_value('rclave');?>">
            <?php echo form_error('rclave');?>
          </div> -->

          <div class="group-text-field">
              <label>
              <input name="checkbox" id="checkbox" type="checkbox"> Términos y condiciones <a target="_blank" href="<?php echo base_url()?>terminosycondiciones" class="link"><em>Leer </em></a>
              </label>
          </div>
          <br>
          <div class="btn-registro">
            <button type="botton" id="boton_registro" class="btn-do right">Registrar</button>
          </div>
          <!--
          <input type="text" name="user_email" placeholder="Usuario, o Email" class="login-input" required>
          <input type="password" name="pass" placeholder="Contraseña" class="login-input" required>                    
          <a href="#" class="login-link">¿Olvidaste tu contrase&ntilde;a?</a>
          <input type="submit" name="acceder" value="Acceder" class="login-btn">
          -->
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    
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
 
            </div>

            <div class="footer-right-screen">
                <a  href="<?php echo base_url();?>ingresar" class="login-link">¿Ya estás registrado?</a>
            </div>
            
        </div>
    </div>
 
</div>



<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/validaciones/registro.js"></script>
<script src="<?= base_url();?>Bienfino-master/upload/alertifyjs/alertify.js"></script>

<script src="<?= base_url();?>Bienfino-master/upload/alertifyjs/alertify.js"></script>
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
<script>

/*       compartir = document.querySelector('#compartir'), */
      let btnCerrarModal2 = document.getElementById('btn-cerrar-modal2');
      
 
/*     compartir.addEventListener('click', (e) => {
        modal2.classList.add('active');
    }); */
    btnCerrarModal2.addEventListener('click',(e) => {
        modal2.classList.remove('active');
    }); 
    
    <?php if($this->session->flashdata('modal')==1){ ?>
  modal2.classList.add('active');
    <?php } ?>    
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
  alertify.success('Registro Exitoso!');
  alertify.alert('Registro Exitoso!', '<?=$this->session->flashdata('mensajeExito')?>');
</script>
<?php }?>

<?php if($this->session->flashdata('mensaje2')){ ?>
<script>
  alertify.errorAlert();
  alertify.alert('Notificación', '<?=$this->session->flashdata('mensaje2')?>');
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


</body>
</html>
