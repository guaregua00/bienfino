<!DOCTYPE html>
<html lang="es">
<head>
    <title>BienFino | Portal Lider Compra Venta Autos en Venezuela</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Somos el amigo que te acompaña a comprar o vender tu vehiculo de forma rapida, segura y sencilla.">
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
<!--     <link href="<?php echo base_url(); ?>asset/fontawesome/css/brands.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/fontawesome/css/solid.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Bienfino-master/css/bienfino.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/bf.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/grid_login_registro.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>datatables/css/jquery.dataTables.min.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>utilidadesadm/estilos/jquery-ui.min.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>utilidadesadm/estilos/wickedpicker.min.css">  
  	<link rel="stylesheet" href="<?php echo base_url(); ?>Bienfino-master/css/jQuery-plugin-progressbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= base_url();?>Bienfino-master/upload/alertifyjs/alertify.css">
    <link rel="stylesheet" href="<?= base_url();?>Bienfino-master/upload/alertifyjs/themes/semantic.css">
    
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
<header>
<nav class="menu" id="menu">
            <div class="contenedorM contenedor-botones-menu">
                <button id="btn-menu-barras" class="btn-menu-barras"><i class="fas fa-bars"></i></button>

                <form method="POST" action="<?php echo base_url(); ?>busqueda" id="formhome">
                    <input type="text" class="input-search" placeholder="Buscar Vehículo" name="" id="" minlength="2" maxlength="50">
                    <a href="javascript:void(0)" onclick="enviarForm('formhome')" class="fas fa-search boton-search"></a>

                </form>

                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>asset/img/logo.gif" alt="" class="logo">
                </a>
                <button id="btn-menu-cerrar" class="btn-menu-cerrar"><i class="fas fa-times"></i></button>
            </div>

            <div class="contenedorM contenedor-enlaces-nav">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>asset/img/logo.gif" alt="" class="logo" >
                </a>
                <form method="POST" action="<?php echo base_url(); ?>busqueda" id="formhome2">
                    <input type="text" class="input-search" placeholder="Buscar Vehículo" name="buscar_palabra" id="buscar_palabra" minlength="2" maxlength="50">
                    <a href="javascript:void(0)" onclick="enviarForm('formhome2')"
                        class="fas fa-search boton-search"></a>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
			
                </form>
                <div class="enlaces">
                    <a href="<?php echo base_url(); ?>">Inicio</a>
                    <a href="<?php echo base_url(); ?>publicar">Vender</a>
                    <a href="<?php echo base_url(); ?>buscar">Comprar</a>
<!--                     <a href="<?php echo base_url();?>cuentas">Ayuda</a> -->
                    <a href="<?php echo base_url();?>cuentas">Cuentas</a>
                        <?php if(!$this->session->userdata('id_usuario')) { ?>
                            <a href="<?php echo base_url();?>ingresar" class="border-login">Ingresar</a>
                        <?php }?>
                </div>
                <div class="btn-departamentos" id="btn-departamentos">
                    <?php if($this->session->userdata('id_usuario')) { ?>
                    <p>Mi Cuenta<span><?php echo ucwords(strtolower($this->session->userdata('email')));?></span></p>
                    <i class="fas fa-user"></i>                    
                    <?php }?>
                    <?php if(!$this->session->userdata('id_usuario')) { ?><!--no se muestra cuando se inicia sesion-->
                    <p><span>BienFino</span></p>
                    <i class="fas fa-caret-down"></i>
                    <?php }?>
                    
                </div>
            </div>

            <div class="contenedorM contenedor-grid">
                <div class="grid" id="grid">
                    <div class="categorias">
                        <button class="btn-regresar"><i class="fas fa-arrow-left"></i> Regresar</button>
                        <h3 class="subtitulo">Categorias</h3>
                        <a href="<?php echo base_url(); ?>misPublicacionesExito">Mis Publicaciones<i class="fas fa-angle-right"></i></a> 
                        <?php if($this->session->userdata('id_usuario')) { ?>
                            <!-- <a href="#" data-categoria="micuenta">Mi Cuenta<i class="fas fa-angle-right"></i></a> -->
                                                       
                            <a href="<?php echo base_url();?>misdatos">Mis Datos<i class="fas fa-angle-right"></i></a>
                            <a href="<?php echo base_url();?>cambiarclave">Cambiar Contraseña<i class="fas fa-angle-right"></i></a>
                            <?php }?>

                            <!-- <a href="<?php echo site_url('oportunidadnegocio'); ?>" data-categoria="oportunidadnegocio">Oportunidad de Negocio <i
                                class="fas fa-angle-right"></i></a> -->
                        <!-- <a href="#" data-categoria="publicaciones">Publicaciones<i class="fas fa-angle-right"></i></a> -->
                        <?php if($this->session->userdata('id_usuario')) { ?>
                        <a href="<?php echo base_url();?>cerrar_session" data-categoria="hogar-y-cocina">Cerrar Sesión<i class="fas fa-angle-right"></i></a>
                        <?php }?>    
                    </div>

                    <div class="contenedor-subcategorias">

                        <div class="subcategoria " data-categoria="micuenta">
                            <div class="enlaces-subcategoria">
                                <button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
                                <h3 class="subtitulo">Mi Cuenta</h3>
                                <a href="<?php echo base_url();?>misdatos">Mis Datos</a>
                                <a href="<?php echo base_url();?>cambiarclave">Cambiar Contraseña</a>
                            </div>


                        </div>

                        <div class="subcategoria " data-categoria="oportunidadnegocio">
                            <div class="enlaces-subcategoria">
                                <button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
                                <h3 class="subtitulo">Oportunidad de Negocio</h3>
                                <a href="#">Generar alerta de busqueda</a>
                            </div>


                        </div>

                        <div class="subcategoria" data-categoria="publicaciones">
                            <div class="enlaces-subcategoria">
                                <button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
                                <!-- <h3 class="subtitulo">Mis Publicaciones</h3> -->
                                <a href="<?php echo base_url(); ?>misPublicacionesExito">Mis Publicaciones</a>
<!--                                 <a href="#">Actualizar Publicación</a>
                                <a href="#">Modificar Datos </a>
                                <a href="#">Info de mi Publicación</a> -->
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </header>
    <script>
        function enviarForm(nombreForm){
            let formhome = document.getElementById(nombreForm);
            formhome.submit();        
        }
        function cargarVista(nombreVista){
            window.location = nombreVista;
        }
    </script>