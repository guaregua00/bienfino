<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
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
            <h3 class="box-title">Cambiar contraseña</h3>
          </div>

          <form class="form-horizontal" id="registro_adm" action="<?php echo base_url(); ?>Cadministrador/cambiarcontrasena/<?php echo $id_usuario; ?>" method="POST">
            <div class="box-body">


              <div class="form-group">
                <label for="clave" class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-10">
                  <input type="password" id="clave" placeholder="Contraseña" name="clave" class="form-control" minlength="6" maxlength="16" value="<?php echo set_value('clave'); ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="rclave" class="col-sm-2 control-label">Repetir Contraseña</label>
                <div class="col-sm-10">
                  <input type="password" id="rclave" placeholder="Repetir Email" name="rclave" class="form-control"  minlength="6" maxlength="16" value="<?php echo set_value('rclave'); ?>" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2 col-sm-offset-5">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
			
                  <button type="submit" id="boton_completar" class="btn btn-info btn-mini">Cambiar</button>
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
  </section>

</div>
<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script src="<?php echo base_url();?>js/geo.js"></script>
