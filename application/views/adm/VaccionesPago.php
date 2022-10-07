
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Dashboard
        <small>Panel  de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        
        <div class="col-md-8 col-md-offset-2">
          <div class="col-md-4 col-md-offset-4">
            <img src="<?php echo base_url()."publicaciones/".$publicacion->codigo."/".$publicacion->url_uno?>" class="img-responsive img-thumbnail">            
          </div>
          <div class="clearfix"></div>
          <form class="form-group" method="POST" action="<?php echo base_url();?>Cadministrador/procesarAccionPago">
            <label>Comentario del pago</label>
            <input type="hidden" class="form-control" name="id_publicacion" value="<?php echo $id_publicacion;?>">
            <input type="hidden" class="form-control" name="accion" value="<?php echo $accion;?>">
            <input type="hidden" class="form-control" name="id_pago" value="<?php echo $id_pago;?>">
            <textarea class="form-control" readonly rows="1"><?php echo $ultimo_comentario;?></textarea>
            <textarea class="form-control" name="comentario_adm" required maxlength="100" rows="10"></textarea>
<br>

              <?php 
              if($id_pago_estatus == 4){
              ?>
              <div class="alert alert-danger">
                <p>Al reversar el pago el estatus del mismo cambia a "Por verificar" y la publicación a "Verificando Reporte de Pago"</p>
              </div>
              <?php
              }
              ?>

            <div class="form-group">
              <div class="col-md-offset-5">

                <button class="btn btn-default" type="submit">&nbsp&nbsp&nbspGuardar&nbsp&nbsp&nbsp</button>                


              </div>
            </div>
          </form>
        </div>
      </div>


    </section>

  </div>

