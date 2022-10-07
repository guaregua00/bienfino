
    <!-- Page Content -->
    <div class="container-fluid">

      <div class="row">

        <div class="col-md-3">
          <h1 class="my-4"><?php if ($this->session->userdata('buscar')){ echo $this->session->userdata('buscar');} ?></h1>
          <div class="list-group">
            <a href="#" class="list-group-item active">Opciones</a>
                <!--
                <?php
                foreach ($estados as $value) {
                  ?>
                    <ul>
                      <a href="<?php echo $value->codigoestado; ?>"><?php echo $value->nombre; ?></a>    
                    </ul>
             
                <?php 
                  }
                 ?>
                 -->        
            <a href="#" class="list-group-item">Filtros</a>


            <div class="hidden-xs hidden-sm">
              <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
            <!--
            <a href="#" class="list-group-item">Category 3</a>-->
          </div>
        </div>
        <!-- /.col-md-3 -->

        <div class="col-md-9">
        	<div class="row">
            <p>Resultado de la busquedad</p>
          </div>
          <div class="row">

    <?php
    if (isset($busqueda) AND $busqueda!="") {

      foreach ($busqueda as $value)
        {
        ?>
              <div class="clearfix visible-md-block"></div>
              <div class="col-md-6">
                  <a href="<?php echo base_url();?>Cpublicacion/verPublicacion/<?php echo $value->id_publicacion; ?>">
                    <img class="img-thumbnail img-responsive" src="<?php echo base_url()."publicaciones/".$value->codigo."/".$value->url_uno; ?>" alt="Foto" style="width: 450px; height: 300px;">
                  </a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="<?php echo base_url();?>Cpublicacion/verPublicacion/<?php echo $value->id_publicacion; ?>"><?php echo ucwords(strtolower($value->titulo)); ?></a>
                    </h4>
                    <?php 
                      $date = date_create($value->creado);
                      $objeto_DateTime = date_format($date, 'd /m /y');//g:ia \o\n l jS F Y
                    ?>
                    <h5><?php echo $objeto_DateTime ?> - <?php echo $value->estado; ?></h5>
                    <!--<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>-->
                  </div>

              </div>
              
              <?php
        }
      }else{
        echo "<h3>".$mensaje."</h3>";
      }       
      ?>

          </div>
          <!-- /.row -->
          <dir class="row">
          	<div class="col-md-12">
              <?php echo $this->pagination->create_links(); ?>
          	</div>
          </dir>
        </div>
        <!-- /.col-md-9 -->

      </div>

    </div>
    <!-- /.container -->


