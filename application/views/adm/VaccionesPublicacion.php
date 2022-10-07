
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
            <img src="<?php echo base_url()."publicaciones/".trim($publicacion->codigo)."/".trim($publicacion->url_uno)?>" class="img-responsive img-thumbnail">            
            <p>Publicación nro: <span><?= $publicacion->id_publicacion ?></span></p>
            <p>Usuario: <span><?= $publicacion->nombres." ".$publicacion->apellidos ?></span></p>
          </div>
          <div class="clearfix"></div>

          <div class="col-md-12">
              <div class="alert alert-warning"> 
                  <p>¿Está seguro de realizar esta operación?</p>
              </div>
          </div>

          <form class="form-group" method="POST" action="<?php echo base_url();?>Cadministrador/procesarAccionPublicacion">
<!--             <label>Comentario administrador publicación</label> -->
            <input type="hidden" class="form-control" name="id_publicacion" value="<?php echo $id_publicacion;?>">
            <input type="hidden" class="form-control" name="accion" value="<?php echo $accion;?>">
            <input type="hidden" class="form-control" name="seccion_publicacion" value="<?php echo $seccion_publicacion;?>">
<!--             <textarea class="form-control" readonly rows="1"><?php echo $publicacion->comentario_adm;?></textarea> -->
<!--             <textarea class="form-control" name="comentario_adm" required rows="10"></textarea> -->
            <div class="form-group">
              <div class="col-md-offset-5">
                <!-- 
Activo 1
Por revisar 6
Rechazado 10
Verificado 11 
Vendido 5

                -->
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />  
                <button class="btn btn-success" type="submit">&nbsp&nbsp&nbspGuardar&nbsp&nbsp&nbsp</button> 

              </div>
            </div>
          </form>
        </div>
      </div>


    </section>

  </div>

