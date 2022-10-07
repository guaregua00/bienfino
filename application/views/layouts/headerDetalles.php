<!DOCTYPE html>
<html lang="es">
<head>
	<title>Bienfino Home</title>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Bienfino-master/css/bienfino.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/bf.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/grid.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>datatables/css/jquery.dataTables.min.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>estilos/jquery-ui.min.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>estilos/wickedpicker.min.css">  
  	<link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/jQuery-plugin-progressbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    
</head>
<body>
<!--[if lte IE 11]>        
  <div id="ie7lower">
    <a href="https://www.mozilla.org/">
      <p>Para visualizar esta pagina de forma correcta debes actualizar tu navegador..</p>
    </a>
  </div>
<![endif]-->

<div id="paginaDetalles">
<nav class="nav-menu">
    <span class="sm-container"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/logo.svg" class="logo-md-1" alt="bienfino_logo"></a></span>

    <div class="component-busqueda">
        <form method="POST" action="<?php echo base_url(); ?>busqueda">
            
            <input type="text" name="buscar_palabra" id="buscar_palabra" placeholder="Escribe una palabra para buscar tu vehiculo...">
            <input type="hidden" name="control" value="1">
            <button type="submit"></button> 
            <span class="mapa-filtro"></span>
        </form>
        <div class="flex-row end normal-hide sm-container">
          <form method="POST" action="<?php echo base_url(); ?>busqueda" class="find-small-form hide">
              <input type="text" name="buscar_palabra" placeholder="Escribe una palabra para buscar tu vehiculo...">
              <input type="hidden" name="control" value="1">
              <button type="submit" class="icon-lupa"></button> 
          </form>
          <span class="find-switch"><span>
        </div>
    </div>

    <?php if(isset($_SESSION['id_usuario'])) { ?>
    <!--<a href="<?php echo base_url(); ?>publicar" class="option-nav opt-camara tips" title="Publicar"></a>-->
    <a href="<?php echo base_url(); ?>misPublicacionesExito" class="option-nav opt-carro tips" title="Mis Publicaciones"></a>
    <?php }?>
    <!--<a href="<?php echo base_url();?>mifavorito" class="option-nav opt-book-marca tips" title="Mis Favoritos"></a>-->
    <a href="#" class="option-nav opt-card tips" title="Mis Mensajes"></a>
    <a href="<?php echo base_url();?>cuentas" class="option-nav opt-coins  tips" title="Cuentas"></a>
    <!--<a href="<?php echo base_url();?>cuentas" class="option-nav opt-question tips" title="Ayuda"></a>-->

    <div class="menu-usuario profile-nav">
      <?php if(isset($_SESSION['id_usuario'])) { echo "<span class='user-name-show truncate-text'>".ucwords($_SESSION['nombres'])." ".ucwords($_SESSION['apellidos'])."</span>";} ?>
            <a href="#" onclick="menuUsuarioOpen()" class="dropbtn" ><!--<div class="icon graph-avatar-off profile"></div>--><img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/avatar_on.png" alt="profile_picture" class="profile" /></a>


<?php if(!isset($_SESSION['id_usuario'])) { ?>
            <div id="menu-usuario" class="menu-usuario-content">
              <a href="<?php echo base_url();?>ingresar">Ingresar</a>
              <a href="<?php echo base_url();?>registrar">Registrar</a>
            </div>
<?php
}?>
    
            <div id="menu-usuario" class="menu-usuario-content">
    <!-- Opciones Disponibles en responsive -->       
    <?php if(isset($_SESSION['id_usuario'])) { ?>
    <a href="<?php echo base_url(); ?>publicar" class="large-hide">Publicar</a>
    <?php }?>
    <a href="<?php echo base_url();?>mifavorito" class="large-hide">Mis Favoritos</a>
    <a href="#" class="large-hide">Mis Publicaciones</a>
    <a href="<?php echo base_url();?>cuentas" class="large-hide">Bancos</a>
    <a href="<?php echo base_url();?>cuentas" class="large-hide">Ayuda</a>

<!--Fin Opciones Disponibles en responsive -->

              <a href="<?php echo site_url('oportunidadnegocio'); ?>"><span class="glyphicon glyphicon-user"></span> Oportunidad de negocio</a>

              <a href="<?php echo base_url();?>misdatos">Mis Datos</a>
              <a href="<?php echo base_url();?>cambiarclave">Cambiar Contraseña</a>
<?php if(isset($_SESSION['id_usuario']) AND $_SESSION['completar']==0 or $_SESSION['completar']==1) { ?>                 
              <a href="<?php echo base_url();?>cerrar_session">Cerrar Sesion</a>
<?php }?>
            </div>
         
    </div> 
</nav>
