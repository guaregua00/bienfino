<!DOCTYPE html>
<html lang="es">
<head>
  <title>Bienfino Home</title>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/bootstrap441.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Bienfino-master/css/bienfinoK.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Bienfino-master/css/grid.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" integrity="sha256-MAgcygDRahs+F/Nk5Vz387whB4kSK9NXlDN3w58LLq0=" crossorigin="anonymous"></script>
    <!--<link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/bf.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>utilidadesadm/estilos/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>utilidadesadm/estilos/wickedpicker.min.css">  
    <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/jQuery-plugin-progressbar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />

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

<div id="pagina" class="white">
  	<div class="menu">
    	<nav class="navbar navbar-expand-lg navbar-bf bg-bf navbar-dark">
			<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/logo.svg" class="logo" alt="bienfino_logo" ></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div id="cont-component-busqueda" class="navbar-nav nav-center nav-search mr-auto">
				<div id="component-busqueda">
					<form method="POST" action="<?php echo base_url(); ?>busqueda">
			            <input type="text" name="buscar_palabra" id="buscar_palabra" placeholder="Escribe una palabra para buscar tu vehiculo..."
			            	class="form-control ml-3">
			            <button type="submit" class="btn btn-search">
			            	<i class="fas fa-search"></i>
			            </button> 
			            <input type="hidden" name="control" value="1">
			        </form>
				</div>
			</div>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="navbar-nav nav-items ml-auto">
					<a class="nav-item nav-link item active" href="<?php echo base_url(); ?>">INICIO <span class="sr-only">(current)</span></a>
					<a class="nav-item nav-link item " href="#">QUIENES SOMOS</a>
					<a class="nav-item nav-link item " href="#">SERVICIOS</a>
					<a class="nav-item nav-link item " href="#">CONTACTO</a>
					

					
					<?php if(isset($_SESSION['id_usuario'])) { ?>
				      	<a href="<?php echo base_url(); ?>publicar" class="nav-item nav-link" title="Publicar"><i class="fas fa-camera fa-2x"></i></a>
				      	<a href="<?php echo base_url(); ?>misPublicacionesExito" class="nav-item nav-link" title="Mis Publicaciones"><i class="fas fa-car fa-2x"></i></a>
				      	<a href="<?php echo base_url();?>cuentas" class="nav-item nav-link item" title="Ayuda"><i class="fas fa-coins fa-2x"></i></a>
				      	<!--User-->
				      	<div class="nav-item dropdown">
					        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          <i class="fas fa-user-circle fa-3x y-bf" style="color:#007bff"></i>
							</a>
							<span class="user-name-show truncate-text"><?php echo ucwords(strtolower($_SESSION['nombres']." ".$_SESSION['apellidos']));?></span>
					        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

							  <!--<a href="<?php echo site_url('oportunidadnegocio'); ?>" class="dropdown-item"> Oportunidad de negocio</a>	-->
				              <a href="<?php echo base_url();?>misdatos" class="dropdown-item">Mis Datos</a>
				              <a href="<?php echo base_url();?>cambiarclave" class="dropdown-item">Cambiar Contraseña</a>
				              <?php if(isset($_SESSION['id_usuario']) AND $_SESSION['completar']==0 or $_SESSION['completar']==1) { ?>  
				              	           
				                <a href="<?php echo base_url();?>cerrar_session" class="dropdown-item">Cerrar Sesion</a>
				              <?php }?>
					        </div>
					    </div>

				    <?php }?>
				    <?php if(!isset($_SESSION['id_usuario'])) { ?>
				    	<div class="nav-item dropdown">
					        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          <i class="fas fa-user-circle fa-3x y-bf"></i>
					        </a>
					        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						      	<a class="dropdown-item" href="<?php echo base_url();?>registrar">CREA TU CUENTA</a>
								<a class="dropdown-item" href="<?php echo base_url();?>ingresar">INGRESA</a>
					        </div>
					    </div>
				    <?php }?>
					
				</div>
			</div>
		</nav>
  
  
	</div>