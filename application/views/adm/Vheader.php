<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">
  <title>AdminBienFino | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/dist/css/AdminLTE.css">

  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/estilos/style.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/dist/css/skins/_all-skins.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>utilidadesadm/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>datatables/css/jquery.dataTables.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>Cadministrador" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>BF</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><!--<b>Adm</b>-->BIENFINO</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!--
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
           -->
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>utilidadesadm/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>utilidadesadm/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>utilidadesadm/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>utilidadesadm/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>utilidadesadm/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
            
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <!--
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            -->
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <!--
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            -->
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>utilidadesadm/dist/img/user.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('usuario');?></span>
              <span class="hidden-xs"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>utilidadesadm/dist/img/user.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('usuario');?>
                  <small>Perfil: <?php echo $this->session->userdata('nombre_perfil');?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!--
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li>
              -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <!--
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                -->
                <div class="pull-right">
                  <a href="<?php echo base_url();?>Cadministrador/cerrar_session" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>utilidadesadm/dist/img/user.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('usuario');?></p>
          <p><?php echo $this->session->userdata('nombre_perfil');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <?php
        //acceso perfil administrador, Directorios, Directorios y Pagos
        if($this->session->userdata('id_perfil')=='1' or $this->session->userdata('id_perfil')=='2' or $this->session->userdata('id_perfil')=='4'){?>
          <li class="active treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span style="color:#605ca8;font-size: 16px;font-weight: bold;">Usuarios y Directorios</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if($this->uri->segment(2)=='VregistrarUsuario') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/VregistrarUsuario"><i class="fa fa-circle-o"></i>Registrar Usuario</a></li>
              <li class="<?php if($this->uri->segment(2)=='Vusuarios') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/Vusuarios"><i class="fa fa-circle-o"></i>Listar Usuarios<br>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Registrar Directorio</a></li>
              <li class="<?php if($this->uri->segment(1)=='listarDirectorio') echo 'active';?>"><a href="<?php echo base_url();?>listarDirectorio"><i class="fa fa-circle-o"></i>Listar Directorios</a></li>
              <?php
              //acceso perfil administrador o Directorios Pagos
              if($this->session->userdata('id_perfil')=='1' or $this->session->userdata('id_perfil')=='4'){?>
                <li class="<?php if($this->uri->segment(1)=='pagosdirectorios') echo 'active';?>"><a href="<?php echo base_url();?>pagosdirectorios"><i class="fa fa-circle-o"></i>Listar Pagos Directorios</a></li>
              <?php } ?>
          <!--<li class="<?php if($this->uri->segment(2)=='Vpublicaciones') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/Vpublicaciones"><i class="fa fa-circle-o"></i> Publicaciones</a></li> -->
            </ul>
          </li>
        <?php }?>
        <!--<li class="active treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Reporte pago</span>
            
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>

          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(3)=='1') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/reportePago/1"><i class="fa fa-circle-o"></i> Por verificar
              <span class="pull-right-container">
                <span class="label label-warning pull-right"><?php echo $porVerificar;?></span>
              </span>
            </a>
            </li>

            <li class="<?php if($this->uri->segment(3)=='2') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/reportePago/2"><i class="fa fa-circle-o"></i> Verificando
              <span class="pull-right-container">
                <span class="label label-primary pull-right"><?php echo $verificando;?></span>
              </span>
            </a>
            </li>

            <li class="<?php if($this->uri->segment(3)=='3') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/reportePago/3"><i class="fa fa-circle-o"></i> Consolidado
              <span class="pull-right-container">
                <span class="label label-success pull-right"><?php echo $consolidado;?></span>
              </span>
            </a>
            </li>

            <li class="<?php if($this->uri->segment(3)=='4') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/reportePago/4"><i class="fa fa-circle-o"></i> Anulado
              <span class="pull-right-container">
                <span class="label label-danger pull-right"><?php echo $anulado;?></span>
              </span>
            </a>
            </li>
        
          </ul>
        </li> -->

        <?php
        //acceso perfil administrador, Publicaciones
        if($this->session->userdata('id_perfil')=='1' or $this->session->userdata('id_perfil')=='3'){
          ?>

        <li class="active treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span style="color:#605ca8;font-size: 16px;font-weight: bold;">Publicaciones</span>
            
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <!--<span class="label label-primary pull-right">4</span>-->
            </span>
            
          </a>
          <!-- 
          Activo 1
          Por revisar 6
          Rechazado 10
          Verificado 11 
          Vendido 5 
          -->
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(3)=='6') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/publicaciones/6"><i class="fa fa-circle-o"></i> Por revisar
              <span class="pull-right-container">
                <span class="label label-warning pull-right"><?php echo $porrevisar[0];?></span>
              </span>
            </a>
            </li>

           <li class="<?php if($this->uri->segment(3)=='1') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/publicaciones/1"><i class="fa fa-circle-o"></i> Activo
              <span class="pull-right-container">
                <span class="label label-success pull-right"><?php echo $activo[0];?></span>
              </span>
            </a>
            </li>

            <!--            
            <li class="<?php if($this->uri->segment(3)=='11') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/publicaciones/11"><i class="fa fa-circle-o"></i> Verificando
              <span class="pull-right-container">
                <span class="label label-primary pull-right"><?php echo $verificado[0];?></span>
              </span>
            </a>
            </li> 
            -->

            <li class="<?php if($this->uri->segment(3)=='10') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/publicaciones/10"><i class="fa fa-circle-o"></i> Rechazado
              <span class="pull-right-container">
                <span class="label label-danger pull-right"><?php echo $rechazado[0];?></span>
              </span>
            </a>
            </li> 
        
          </ul>
        </li>
        <?php } ?>

        <?php
        //acceso solo administrador
        if($this->session->userdata('id_perfil')=='1'){
          ?>

        <li class="active treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span style="color:#605ca8;font-size: 16px;font-weight: bold;">Auditoria</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='VhistoricoPagos') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/VhistoricoPagos"><i class="fa fa-circle-o"></i> Historico Pagos
            </a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='VhistoricoUsuarios') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/VhistoricoUsuarios"><i class="fa fa-circle-o"></i> Historico Usuarios
            </a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='VhistoricoPublicaciones') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/VhistoricoPublicaciones"><i class="fa fa-circle-o"></i> Historico Publicaciones
            </a>
            </li>                        
          </ul>
        </li>

        <li class="active treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span style="color:#605ca8;font-size: 16px;font-weight: bold;">Marcas y Modelos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='marcasmodelos') echo 'active';?>"><a href="<?php echo base_url();?>Cadministrador/Vmarcasmodelos"><i class="fa fa-circle-o"></i> Ver
            </a>
            </li>                        
          </ul>
        </li>

        <li class="active treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span style="color:#605ca8;font-size: 16px;font-weight: bold;">Administrador</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2)=='marcasmodelos') echo 'active';?>">
              <a href="<?php echo base_url();?>VlistarUsuarioAdm"><i class="fa fa-circle-o"></i>Listar</a>
              <a href="<?php echo base_url();?>VcrearUsuarioAdm"><i class="fa fa-circle-o"></i>Registrar</a>
            </li>                        
          </ul>
        </li>
        <?php }?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>