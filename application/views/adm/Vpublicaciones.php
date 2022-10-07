
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Publicaciones
        <small>Panel  de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>


    <section class="content">
      <div class="row">
        <div class="col-md-12">

            <h4 class="text-center">Lista de Publicaciones</h4>

                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-warning"> 
                          <p>ADVERTENCIA: se debe tener precaución al usar este modulo ya que el mismo genera cambio de estatus en las publicaciones registradas.</p>
                      </div>
                  </div>
                </div>               

          <?php if($this->session->flashdata('mensaje')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                  </div>
                </div>
          <?php }?>
                    <?php if($this->session->flashdata('mensajecompletado')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success"> <?php echo $this->session->flashdata('mensajecompletado'); ?></div>
                  </div>
                </div>
          <?php }?>
          <?php if($this->session->flashdata('mensaje2')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
                  </div>
                </div>
          <?php }?>
                <table id="listausuario" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="col-md-2">Imagen</th>
                            <th>Modelo</th>
                            <th>usuario</th>
                            <th class="col-md-2">Ubicación</th>
                            <th>Fecha Publicación</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
<!--
                    <tfoot>
                        <tr>
                            <th>Imagen</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Ubicación</th>

                        </tr>
                    </tfoot>
-->
                    <tbody>
            <?php
            if (isset($publicaciones) AND $publicaciones!="") {
                foreach ($publicaciones as $value) {
      

                 $date = date_create($value->creado);
                 $objeto_DateTime = date_format($date, 'd /m /y');//g:ia \o\n l jS F Y

                  echo "<tr>";
                   
                    echo "<th><a target='_blank' loading='lazy' href='".base_url()."detallepublicacion/".$value->id_publicacion."'><img src='".base_url()."publicaciones/".trim($value->codigo)."/".$value->url_uno."' alt='imagen' class='img-thumbnail'></a></th>";
                    echo "<th>ID ".$value->id_publicacion."<br>".ucwords($value->marca)." ".ucwords($value->modelo)." ".$value->id_ano."</th>";
                    echo "<th>".$value->email." <br> ".$value->cedula."</th>";
                    echo "<th>".ucwords($value->nombre_estado)." ".ucwords($value->nombre_municipio)." ".ucwords($value->nombre_parroquia)."</th>";
                    /* amarillo red blue */
                    echo "<th>".humanize_date($value->creado, 'long')."</th>";
                          
                    /*                     
                    Activo 1
                    Por revisar 6
                    Rechazado 10
                    Verificado 11 
                    Vendido 5    
                    */ 
                                 
                    if($value->estatus==1){
                        echo "<th class='status'>".$value->nombre_status."</th>";
                    }else if($value->estatus==6){
                        echo "<th class='status amarillo'>".$value->nombre_status."</th>";
                    }else if($value->estatus==10){
                        echo "<th class='status red'>".$value->nombre_status."</th>";
                    }else if($value->estatus==11){
                        echo "<th class='status blue'>".$value->nombre_status."</th>";
                    }else if($value->estatus==5){
                        echo "<th class='status'>".$value->nombre_status."</th>";
                    }else{
                        echo "<th class='status'>".$value->nombre_status."</th>";
                    }

                        ?>
<!--                         <th>
                        <form id="formaccion" action="<?php echo base_url()?>Cadministrador/accionesPublicacion" method="post">
                            <input type="hidden" class="form-control" name="id_publicacion" value="<?php echo $value->id_publicacion ?>">
                            <input type="hidden" class="form-control" name="codigo" value="<?php echo $value->codigo ?>">
                            <select id="accion" name="accion" class="accion">
                                <option selected>Seleccione</option>
                                <?php if($value->nombre_status!='Activo') echo '<option value="1">Activar</option>'; ?>
                                <?php if($value->nombre_status!='Rechazado') echo '<option value="10">Rechazar</option>'; ?>
                                <?php echo '<option value="2">Ordenar Fotos</option>'; ?>
                                <?php echo '<option value="3">Modificar</option>'; ?>
                            </select>
                            <input type="hidden" class="form-control" name="seccion_publicacion" value="<?php echo $this->uri->segment(3);?>">
                            <button type="submit" class="btn btn-success"><i class="fa fa-angle-right"></i></button>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                          </form>                                                                     
                        </th> -->
                        <?php
                        echo '<th>
                        <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                          <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu dropdown-menu2">';
                        if($value->nombre_status!='Activo'){
                          echo '<li><a href="'.base_url().'Cadministrador/procesarAccionPublicacion/'.$value->id_publicacion.'/'.trim($value->codigo).'/'.trim($value->id_usuario2).'/1/'.$this->uri->segment(3).'">Activar</a></li>';
                          echo '<li class="divider"></li>';
                        }
                        if($value->nombre_status!='Rechazado'){
                          echo '<li><a href="'.base_url().'Cadministrador/procesarAccionPublicacion/'.$value->id_publicacion.'/'.trim($value->codigo).'/'.trim($value->id_usuario2).'/10/'.$this->uri->segment(3).'">Rechazar</a></li>';
                          echo '<li class="divider"></li>';
                        }  
                          echo '<li><a href="'.base_url().'VmodificarPublicacion/'.$value->id_publicacion.'/'.trim($value->codigo).'/'.$this->uri->segment(3).'">Modificar</a></li>';
                          echo '<li class="divider"></li>';
                          echo '<li><a href="'.base_url().'ordenarFotos/'.$value->id_publicacion.'/'.trim($value->codigo).'/'.$this->uri->segment(3).'">Ordenar Fotos</a></li>';
                          echo '</ul>
                        
                        </div>
                    </th>';
                    ?>
                    

           <?php
                }
            }

            ?>
                    </tbody>
                </table>
        </div><!--col-md-8 col-md-offset-2"-->
      </div><!--row-->
    </section>

  </div>
  <script src="<?php echo base_url();?>utilidadesadm/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script>
/*   $("#accion").change(function(){
    $("#formaccion").submit();
  });   */   
  </script>
