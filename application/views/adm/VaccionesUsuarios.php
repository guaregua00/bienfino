
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
          <?php echo var_dump($usuario); ?>
            <h4 class="text-center">ID usuario:<?php echo $usuario->id_usuario;?></h4>           
          </div>
          <div class="clearfix"></div>
          <form class="form-group" method="POST" action="<?php echo base_url();?>Cadministrador/procesarAccionUsuario">
            <label>Comentario</label>
            <input type="hidden" class="form-control" name="cedula" value="<?php echo $usuario->id_usuario;?>">
            <input type="hidden" class="form-control" name="accion" value="<?php echo $accion;?>">
            <textarea class="form-control" readonly rows="1"><?php echo $usuario->comentario_adm;?></textarea>
            <textarea class="form-control" name="comentario_adm" required rows="10"></textarea>
            <div class="form-group">
              <div class="col-md-offset-5">
                <!-- 
Activo 1
Inactivo 2
Pausado 3
Por pagar 4 
Vendido 6

                -->
                <?php 
                if ($accion == 1) {
                ?>
                <button class="btn btn-success" type="submit">&nbsp&nbsp&nbspActivar&nbsp&nbsp&nbsp</button>                
                <?php
                }
                if ($accion == 2) {
                ?>
                <button class="btn btn-danger" type="submit">&nbspInactivar&nbsp</button>
                <?php
                }
                ?>
              </div>
            </div>
          </form>
        </div>
      </div>


    </section>

  </div>

