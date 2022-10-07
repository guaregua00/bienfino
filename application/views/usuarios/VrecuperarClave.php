<!DOCTYPE html>
<html>
<head>
  <title>Bienfino</title>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Bienfino-master/css/bienfino_login_registro.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/bf.css">
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
            <span><i><div class="icon graph-photo-camera-1-copia"></div></i> Compra tu auto a los mejores precios.</span>
            <span><i><div class="icon graph-steering-wheel"></div></i> Vende y compra repuestos.</span>
            <span><i><div class="icon graph-shield-copia"></div></i> Compra con seguridad.</span>
        </div>
        </div>
        <div class="footer-left-screen">
        <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/logo.svg" class="logo-gris logo-sm">
        <p>Todos los derechos reservados <b>&copy;Todo Bien Fino, C.A.J-41133916-4.</b><br>Caracas-Venezuela.</p>
        </div>
    </div>
    <div>
            <div class="body-right-screen">
            <a href="<?php echo base_url();?>ingresar" class="login-link absolute-top-right"><u><span><div class="icon graph-left-open-big one-line"></div></span>Regresar</u></a>
            <a href="index.html"><img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/logo.svg" class="logo-md" alt="bienfino_logo"></a>
            <h3>Ingresa la dirección de correo que usaste para registrarte. Nosotros te enviaremos un enlace para que puedas reiniciar la contraseña.</h3>
               
            <form id="recuperar_clave" method="POST" action="<?php echo base_url();?>Cusuarios/recuperarClave" method="POST">
<div class="group-text-field"> 
  
                    <input type="text" class="login-input" name="email" id="email"  maxlength="60" placeholder="Email">
                    <?php echo form_error('email');?>
</div>
                    <button type="botton" id="boton_recuperar" class="login-btn">Reiniciar Contraseña</button>
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                </form>

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

  <?php if($this->session->flashdata('mensaje')){ ?>
        <div class="row">
          <div class="col-md-12">
              <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje'); ?></div>
          </div>
        </div>
        <br>
  <?php }?> 
  <?php if($this->session->flashdata('mensaje2')){ ?>
        <div class="row">
          <div class="col-md-12">
              <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
          </div>
        </div>
        <br>
  <?php }?> 
                
            </div>
            <div class="footer-right-screen">
                <a  href="<?php echo base_url(); ?>registrar" class="login-link">¿Aun no estas registrado?</a>
            </div>
        </div>
    </div>
 
</div>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/validaciones/ingreso.js"></script>
</body>
</html>
