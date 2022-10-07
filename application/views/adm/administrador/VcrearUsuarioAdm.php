<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrador
      <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url()?>Cadministrador"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url()?>VlistarUsuarioAdm"><i class="fa fa-dashboard"></i> Listar Admnistrador</a></li>
      <li class="active">Crear usuario administrador</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
  
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
                      <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                  </div>
                </div>
    <?php }?>

    <div class="row">
      <div class="col-md-6 col-xs-12 col-md-offset-3">

        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Registrar Usuario Administrador</h3>
          </div>

          <form class="form-horizontal" id="registro_adm" action="<?php echo base_url(); ?>crearusuarioadm" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label for="cedula" class="col-sm-2 control-label">Cedula</label>
                <div class="col-sm-10">
                  <input type="text" id="cedula" name="cedula" maxlength="8" placeholder="Cédula" class="form-control" value="<?php echo set_value('cedula'); ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="nombres" class="col-sm-2 control-label">Nombres</label>
                <div class="col-sm-10">
                  <input type="text" id="nombres" placeholder="Nombres" name="nombres" maxlength="100" class="form-control" value="<?php echo set_value('nombres'); ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-10">
                  <input type="text" id="apellidos" placeholder="Apellidos" name="apellidos" maxlength="100" class="form-control" value="<?php echo set_value('apellidos'); ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="usuario" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" id="usuario" autocomplete="new-email" placeholder="Email" maxlength="100" name="usuario" class="form-control" value="<?php echo set_value('email'); ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="rusuario" class="col-sm-2 control-label">Repetir Email</label>
                <div class="col-sm-10">
                  <input type="email" id="rusuario" autocomplete="new-email" placeholder="Repetir Contraseña" maxlength="100" class="form-control" name="rusuario" maxlength="16" value="<?php echo set_value('remail'); ?>" required>
        
                </div>
              </div>

              <div class="form-group">
                <label for="id_perfil" class="col-sm-2 control-label">Perfil</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_perfil" id="id_perfil" required>
                    <?php
                        foreach ($perfiles as $perfil) {
                            echo '<option value="'.$perfil->id_perfil.'">'.$perfil->nombre.'</option>';
                        }
                    ?>  
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="clave" class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-10">
                  <input type="password" id="clave" autocomplete="new-password" placeholder="Contraseña" name="clave" class="form-control" minlength="6" maxlength="16" value="<?php echo set_value('clave'); ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="rclave" class="col-sm-2 control-label">Repetir Contraseña</label>
                <div class="col-sm-10">
                  <input type="password" id="rclave" autocomplete="new-password" placeholder="Repetir Email" name="rclave" class="form-control"  minlength="6" maxlength="16" value="<?php echo set_value('rclave'); ?>" required>
                </div>
              </div>
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
              <div class="form-group">
                <div class="col-sm-2 col-sm-offset-5">
                  <button type="submit" id="boton_completar" class="btn btn-info btn-mini">Registrar</button>
                </div>
              </div>

            </div>
            <!--box-body-->
            <!--
          <input type="text" name="user_email" placeholder="Usuario, o Email" class="login-input" required>
          <input type="password" name="pass" placeholder="Contraseña" class="login-input" required>                    
          <a href="#" class="login-link">¿Olvidaste tu contrase&ntilde;a?</a>
          <input type="submit" name="acceder" value="Acceder" class="login-btn">
          -->
          </form>
        </div><!--box box-info-->

      </div><!--col-md-6 col-xs-12 col-md-offset-3-->
    </div><!--row-->

    <div class="row">
      <div class="col-md-6 col-xs-12 col-md-offset-3">
        <div class="box box-info">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">ID</th>
                  <th>Perfil</th>
                  <th>Descripción</th>
                </tr>

                <?php
                  foreach ($perfiles as $perfil) {
                    echo "<tr>";
                      echo '<td>'.$perfil->id_perfil.'</td>';
                      echo '<td>'.$perfil->nombre.'</td>';
                      echo '<td>'.$perfil->descripcion.'</td>';
                    echo "</tr>";
                  }
                ?>

              </tbody>
            </table>

        </div>
      </div><!--col-md-6 col-xs-12 col-md-offset-3-->
    </div><!--row-->    


  </section>

</div>
<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
