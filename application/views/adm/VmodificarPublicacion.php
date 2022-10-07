<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Ubicar Publicación
      <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Ubicar Publicación</li>
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
            <br>
                <div class="col-md-8 col-md-offset-2" data-id="<?php echo trim($publicacion->url_uno)?>">

                    <a target='_blank' loading='lazy' href='<?php echo base_url()."detallepublicacion/".$publicacion->id_publicacion."'"?>'><img loading="lazy" class="img-thumbnail" src="<?php echo base_url() . "publicaciones/" . trim($publicacion->codigo) . "/" . $publicacion->url_uno; ?>" alt="foto1">
                      </a>
                      
                </div>
            <div class="clearfix"></div>
            <br>
          <div class="box-header with-border">
            <h3 class="box-title">Selección del usuario publicación id <strong><?php echo $publicacion->id_publicacion;?></strong></h3><br>
            <h4 class="box-title">Estatus Publicación: <strong><?php echo $publicacion->nombre_estatus;?></strong></h4><br><br>
            <h4 class="box-title">Categoria: <strong><?php echo $publicacion->categoria;?></strong></h4><br>
            <h4 class="box-title">Marca: <strong><?php echo ucwords($publicacion->marca);?></strong></h4><br>
            <h4 class="box-title">Modelo: <strong><?php echo ucwords($publicacion->modelo);?></strong></h4><br>
            <h4 class="box-title">Año: <strong><?php echo ucwords($publicacion->id_ano);?></strong></h4><br>
          </div>

          <form class="form-horizontal" id="modificarPublicacion" action="<?php echo base_url(); ?>Cadministrador/modificarPublicacion" method="POST">
            <div class="box-body">
                
              <div class="form-group">
                <label for="id_categoria" class="col-sm-2 control-label">Categoria</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_categoria" id="id_categoria" required>
                    <option selected="selected" value="">Seleccione una Categoría</option>
                    <?php 
                        foreach ($categorias as $key => $categoria) {
                          if (isset($publicacion) && ($publicacion->id_categoria != "") && $publicacion->id_categoria ==$categoria->id_categoria){
                            echo '<option selected value="'.$categoria->id_categoria.'">'.$categoria->nombre.'</option>';
                          }else{
                            echo '<option value="'.$categoria->id_categoria.'">'.$categoria->nombre.'</option>';
                          }
                        }
                        ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="id_marca" class="col-sm-2 control-label">Marca</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_marca" id="id_marca" required>
                    <option value="">Seleccionar una Marca</option>

                    <?php
                        
                        if (isset($marcas)){
                          $marca_del_usuario = 1;
                          
                          foreach ($marcas as $key => $marca) {
                            if (isset($publicacion) && ($publicacion->id_marca != "") && $marca->id_marca ==$publicacion->id_marca){
                              echo '<option selected value="'.$publicacion->id_marca.'">'.ucwords($publicacion->marca).'</option>';
                              $marca_del_usuario = 0;
                            }else{
                              echo '<option value="'.$marca->id_marca.'">'.ucwords($marca->marca).'</option>';
                            }
                          }
                        }
                        ?>

                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="id_modelo" class="col-sm-2 control-label">Modelo</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_modelo" id="id_modelo" required>
                    <option value="">Debe seleccionar un Modelo</option>

                    <?php 
                        if (isset($publicacion) && ($publicacion->id_modelo != ""))
                         echo '<option selected value="'.$publicacion->id_modelo.'">'.$publicacion->modelo.'</option>';
                       
                        ?>

                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="id_ano" class="col-sm-2 control-label">Año</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_ano" id="id_ano" required>
                    <option value="">Debe seleccionar un Año</option>
                    <?php 
                        for ($anio = date('Y'); $anio >= 1900 ; $anio--) {
                          if (isset($publicacion) && ($publicacion->id_ano != "") && $publicacion->id_ano == $anio){
                            echo '<option selected value="'.$anio.'">'.$anio.'</option>';
                          }else{
                            echo '<option value="'.$anio.'">'.$anio.'</option>';
                          }
                        }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2 col-sm-offset-5">

                  <input type="hidden" name="id_publicacion" value="<?= $publicacion->id_publicacion; ?>" />
                  <input type="hidden" name="codigo" value="<?= $publicacion->codigo; ?>" />
                  <input type="hidden" name="seccion_publicacion" value="<?= $seccion_publicacion; ?>" />
                  <input type="hidden" name="id_usuario" value="<?= $publicacion->id_usuario; ?>" />
                  
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                  <button type="submit" id="boton_completar" class="btn btn-info btn-mini">Actualizar</button>
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

<script>
//menu
   $("#id_marca").change(function(){
    buscarModelo2();
  });


  function buscarModelo2() {

    var id_marca = $("#id_marca").val();

    if (id_marca == "") {
        $("#id_modelo").html('<option value="">Debe seleccionar una Marca</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_marca": id_marca},
            url: base_url+"Cadministrador/getModelo",
            type: "post",
            beforeSend: function () {
                $("#id_modelo").html('<option>cargando modelos...</option>');
                //customSelectCall();                
            },
            success: function (respuesta2) {
                $("#id_modelo").html(respuesta2.htmloption2);
                //customSelectCall();
            },
            error: function (xhr, err) {
                console.log("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                //alert("ocurrio un error intente de nuevo");
            }
        });
    }
    }

</script>