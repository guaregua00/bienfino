
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        <small>Panel  de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
          <div class="container">
            <div class="row">
              <div class="col-md-12" style="padding:10px">
                <div class="alert alert-info"> 
                    <p><strong>Importante:</strong> para registrar un Directorio debes seleccionar un Usuario con el registro Completo y seleccionar en el boton de Acciones (Registrar Directorio).</p>
                </div>
              </div>
            </div>
          </div>

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
                            <th>Nombres y Apellidos</th>
                            <th>Email</th>
                            <th>Fecha Registro</th>
                            <th>Estatus</th>
                            <th>Completo</th>
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
                    echo "<th>------------</th>";
                    else echo "<th>".$value->cedula."</th>";

                    if($value->nombres=="" and $value->apellidos=="")
                    echo "<th>------------</th>";
                    else echo "<th>".$value->nombres." ".$value->apellidos."</th>";
                    echo "<th>".$value->email."</th>";
                    echo "<th>".$objeto_DateTime."</th>";
                    if ($value->activo == 1) {
                      echo "<th class='green'>Activo</th>";
                    }elseif ($value->activo == 2) {
                      echo "<th class='red'>Inactivo</th>";
                    }else{
                      echo "<th>------------</th>";
                    }

                    if ($value->completar == 1) {
                      echo "<th class='green'>Completo</th>";
                    }elseif ($value->activo == 0) {
                      echo "<th class='red'>Incompleto</th>";
                    }else{
                      echo "<th>Indefinido</th>";
                    }


                    echo '<th>
                        <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                          <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu dropdown-menu2">';
                          if($value->completar == 1){
                            echo '<li><a href="'.base_url().'addDirectorio/'.$value->id_usuario.'">Registrar Directorio</a></li>';
                            echo '<li class="divider"></li>';
                          }
                            echo '<li><a href="'.base_url().'Cadministrador/Vactualizarusuario/'.$value->id_usuario.'">Actualizar o Completar</a></li>';

                          if($this->session->userdata('id_perfil')=='1'){
                            if ($value->activo == 1) {
                              echo '<li class="divider"></li>
                              <li><a href="'.base_url().'Cadministrador/eliminarUsuarioDesactivar/'.$value->id_usuario.'">Eliminar</a></li>';
                            }elseif ($value->activo == 2) {
                              echo '<li class="divider"></li>
                              <li><a href="'.base_url().'Cadministrador/activarUsuario/'.$value->id_usuario.'">Activar</a></li>';
                            }echo '<li class="divider"></li>
                              <li><a href="'.base_url().'Cadministrador/Vcambiarcontrasena/'.$value->id_usuario.'">Cambiar Contraseña</a></li>';
                          }
                          echo '</ul>
                        
                        </div>

                    </th>';

/*                     if ($value->activo == 1) {
                    echo '<th>                    
                              <form action="'.base_url().'Cadministrador/accionesUsuario" method="post">
                              <input type="hidden" class="form-control" name="accion" value="2">
                              <input type="hidden" class="form-control" name="id_usuario" value="'.$value->id_usuario.'">
                              <button class="btn btn-danger" type="submit">&nbspInactivar&nbsp</button>
                              </form>                                                                     
                          </th>'; 
                    }elseif ($value->activo == 2) {
                    echo '<th>
                              <form action="'.base_url().'Cadministrador/accionesUsuario" method="post">
                              <input type="hidden" class="form-control" name="accion" value="1">
                              <input type="hidden" class="form-control" name="id_usuario" value="'.$value->id_usuario.'">
                              <button class="btn btn-success" type="submit">&nbsp&nbsp&nbspActivar&nbsp&nbsp&nbsp</button>
                              </form> 
                          </th>'; 
                    }else{
                      echo "<th>--sin completar--</th>";
                    } */
                                       
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
<!--                 <div class="input-group-btn">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">Actualizar</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Eliminar</a></li>
                  </ul>
                </div> -->
<style>
  .dropdown-menu2{
    right: 0 !important;
  }
</style>