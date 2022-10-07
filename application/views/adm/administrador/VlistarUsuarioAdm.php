
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios Administrador
        <small>Panel  de Control</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="<?php echo base_url()?>Cadministrador"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Administrador</li>
      </ol>
    </section>

          <?php if($this->session->flashdata('mensajecompletado')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success"> <?php echo $this->session->flashdata('mensajecompletado'); ?></div>
                  </div>
                </div>
          <?php }?>

          <?php if($this->session->flashdata('mensaje')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                  </div>
                </div>
          <?php }?>
          <?php if($this->session->flashdata('mensaje2')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-sdanger"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
                  </div>
                </div>
          <?php }?>
    <section class="content">
      <div class="row">
        <div class="col-md-12">

            <!--<h1 class="text-danger text-center"> <span class="glyphicon glyphicon-dashboard"></span> &nbsp Usuarios</h1>-->

                <table id="listausuario" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cedula</th>
                            <th>Nombre y Apellido</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>Fecha Registro</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php

        //var_dump($usuarios);exit;
        
            if (isset($usuarios) AND $usuarios!="") {
                foreach ($usuarios as $value) {

                 $date = date_create($value->fecha_registro);
                 $objeto_DateTime = date_format($date, 'd /m /y H:i:s');//g:ia \o\n l jS F Y
                  echo "<tr>";
                    echo "<th>$value->id_usuario</th>";
                    if($value->cedula=="")
                    echo "<th>--------</th>";
                    else echo "<th>".$value->cedula."</th>";

                    if($value->nombres=="" and $value->apellidos=="")
                    echo "<th>--------</th>";
                    else echo "<th>".$value->nombres." ".$value->apellidos."</th>";
                    echo "<th>".$value->usuario."</th>";
                    echo "<th>".$value->perfil."</th>";
                    echo "<th>".$objeto_DateTime."</th>";
                    if ($value->activo == 1) {
                      echo "<th class='green'>Activo</th>";
                    }elseif ($value->activo == 2) {
                      echo "<th class='red'>Inactivo</th>";
                    }else{
                      echo "<th>--------</th>";
                    }


                    echo '<th>
                        <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                          <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu dropdown-menu2">
                          <li><a href="'.base_url().'VactualizarUsuarioAdm/'.$value->id_adm.'">Actualizar</a></li>
                          ';
                          if ($value->activo == 1) {
                          echo '<li class="divider"></li>
                          <li><a href="'.base_url().'eliminarUsuarioAdm/'.$value->id_adm.'">Eliminar</a></li>';
                          }elseif ($value->activo == 2) {
                          echo '<li class="divider"></li>
                          <li><a href="'.base_url().'activarUsuarioAdm/'.$value->id_adm.'">Activar</a></li>';
                          }echo '<li class="divider"></li>
                          <li><a href="'.base_url().'VcambiarClaveUsuarioAdm/'.$value->id_adm.'">Cambiar Clave</a></li>';
                          echo '</ul>
                      </div>

                    </th>';
                                       
                  echo "</th>";

                }
            }

            ?>
                    </tbody>
                </table>
        </div><!--col-md-8 col-md-offset-2"-->
      </div><!--row-->
    </section>

  </div>
                </div>
<style>
  .dropdown-menu2{
    right: 0 !important;
  }
</style>