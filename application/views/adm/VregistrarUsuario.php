<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Registrar Usuario Natural
      <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Registrar Usuario Natural</li>
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
            <h3 class="box-title">Registrar Usuario Natural BienFino</h3>
          </div>

          <form class="form-horizontal" id="registro_adm" action="<?php echo base_url(); ?>Cadministrador/registrarUsuario" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label for="nac" class="col-sm-2 control-label">Nacionalidad</label>
                <div class="col-sm-10">
                  <select name="nac" id="nac" class="form-control" required>
                    <option value="V">Venezolan@</option>
                    <option value="E">Extranjer@</option>
                  </select>
                </div>
              </div>

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
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" id="email" placeholder="Email" maxlength="100" name="email" class="form-control" value="<?php echo set_value('email'); ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="remail" class="col-sm-2 control-label">Repetir Email</label>
                <div class="col-sm-10">
                  <input type="email" id="remail" placeholder="Repetir Contraseña" maxlength="100" class="form-control" name="remail" maxlength="16" value="<?php echo set_value('remail'); ?>" required>
        
                </div>
              </div>

              <div class="form-group">
                <label for="moviluno" class="col-sm-2 control-label">Movil Uno</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="moviluno" name="moviluno" maxlength="11" placeholder="Telf Movil" value="<?php echo set_value('moviluno'); ?>" required>
                  <span class="help-block">Ejemplo: 04141234567</span>
                </div>
              </div>

              <div class="form-group">
                <label for="movildos" class="col-sm-2 control-label">Movil Dos</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="movildos" name="movildos" maxlength="11" placeholder="Telf Movil" value="<?php echo set_value('movildos');?>">
          
                </div>
              </div>

              <div class="form-group">
                <label for="codigoestado" class="col-sm-2 control-label">Estado</label>
                <div class="col-sm-10">
                  <select class="form-control" name="codigoestado" id="codigoestado" required>
                    <option selected="selected" value="">Seleccione un estado</option>
                    <?php
                    foreach ($estados as $value) {
                    ?>
                      <option value="<?php echo $value->codigoestado; ?>"><?php echo ucwords($value->nombre); ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>


              <div class="form-group">
                <label for="codigomunicipio" class="col-sm-2 control-label">Municipio</label>
                <div class="col-sm-10">
                  <select class="form-control" name="codigomunicipio" id="codigomunicipio" required>
                    <option value="">Seleccione un municipio</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="codigoparroquia" class="col-sm-2 control-label">Parroquia</label>
                <div class="col-sm-10">
                  <select class="form-control" name="codigoparroquia" id="codigoparroquia" required>
                    <option value="">Seleccione una parroquia</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="direccion_esp" class="col-sm-2 control-label">Dirección Especifica</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3" maxlength="255" id="direccion_esp" name="direccion_esp" required><?php echo set_value('direccion_esp'); ?></textarea>
                </div>
              </div>

            <!--               
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
            -->

              <div class="form-group">
                <div class="col-sm-2 col-sm-offset-5">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
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
  </section>

</div>
<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script src="<?php echo base_url();?>js/geo.js"></script>
<script>
//menu
  $("#codigoestado").change(function(){ 
    buscarMunicipiosadm();
  });
  $("#codigomunicipio").change(function(){
    buscarParroquiaadm();
  });  

</script>