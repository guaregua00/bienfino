<div class="contenedor" style="margin-bottom: 0px;">
  <!--mensajes-->
          <?php if(isset($mensaje)){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-danger"> <?php echo $mensaje; ?></div>
                  </div>
                </div>
          <?php }?>
          <?php if($this->session->flashdata('mensaje')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                  </div>
                </div>
                <br>
          <?php }?>
          <?php if($this->session->flashdata('mensaje2')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
                  </div>
                </div>
          <?php }?>
          <?php echo validation_errors(); ?>
  <!--end mensajes-->

    <form id="imagenes_opcionales" action="<?php echo base_url(); ?>Cpublicacion/guardarImagenes" method="POST" enctype="multipart/form-data">

  <!--fotos-->
      <div class="flex-col">
        <div class="titulo-descripcion">
                <label>Fotos</label>
                <span>Carga las fotos opcionales de tu vehiculo</span>
        </div>
      </div>

<?php
/*
  echo "url imagen"." - "."codigo carpeta imagen"."<br>";
  echo $opcionales[0]->imagen." - ".$opcionales[0]->codigo."<br>";
  echo $opcionales[1]->imagen." - ".$opcionales[1]->codigo."<br>";
  echo $opcionales[2]->imagen." - ".$opcionales[2]->codigo."<br>";
  
  if(isset($opcionales) and $opcionales!=""){
    echo "el guevo mio";
    var_dump($opcionales);
  }*/
?>
            <div class="flex-row">
                <div class="image-publicacion-item">
                <input type="file" name="imagen1" id="foto1" class="file-input" >
                <label for="foto1"><img src="<?php if(isset($opcionales[0])){echo base_url()."publicaciones/".$opcionales[0]->codigo."/".$opcionales[0]->imagen; }?>" alt=""></label>
                </div>
                <div class="image-publicacion-item">
                <input type="file" name="imagen2" id="foto2" class="file-input" >
                <label for="foto2"><img src="<?php if(isset($opcionales[1])){echo base_url()."publicaciones/".$opcionales[0]->codigo."/".$opcionales[1]->imagen; }?>" alt=""></label>
                </div>
                <div class="image-publicacion-item">
                <input type="file" name="imagen3" id="foto3" class="file-input" >
                <label for="foto3"><img src="<?php if(isset($opcionales[2])){echo base_url()."publicaciones/".$opcionales[0]->codigo."/".$opcionales[0]->imagen; }?>" alt=""></label>
                </div>
                <div class="image-publicacion-item">
                <input type="file" name="imagen4" id="foto4" class="file-input" >
                <label for="foto4"><img src="<?php if(isset($opcionales[3])){echo base_url()."publicaciones/".$opcionales[0]->codigo."/".$opcionales[0]->imagen; }?>" alt=""></label>
                </div>
                <div class="image-publicacion-item">
                <input type="file" name="imagen5" id="foto5" class="file-input" >
                <label for="foto5"><img src="<?php if(isset($opcionales[4])){echo base_url()."publicaciones/".$opcionales[0]->codigo."/".$opcionales[0]->imagen; }?>" alt=""></label>
                </div>
                <div class="image-publicacion-item">
                <input type="file" name="imagen6" id="foto6" class="file-input" >
                <label for="foto6"><img src="<?php if(isset($opcionales[5])){echo base_url()."publicaciones/".$opcionales[0]->codigo."/".$opcionales[0]->imagen; }?>" alt=""></label>
                </div>
                <input type="hidden" name="id_publicacion" value="<?php echo $id_publicacion?>">               
            </div>

            <div class="flex-row">
                <div class="group-text-field">
                    <!--<button type="button" class="btn-do right" id="enviarimagenes">Guardar</button>-->
                    <input type="submit" class="btn-do right" value="Guardar">
                </div>
            </div>
        </div>
  </form>
    </div>
  <!--end fotos-->

</div>

<?php
  $this->view('layouts/Vfooter');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<!--<script src="<?php echo base_url();?>js/imagen_publicacion.js"></script>-->
<script src="<?php echo base_url();?>js/geo.js"></script>
<script src="<?php echo base_url();?>js/categoria_publicar.js"></script>
<script src="<?php echo base_url();?>js/validaciones/publicacion_registro.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>

<script>
//formulario
  $(".categoria").click(function(){
    buscarMarca();
  });

  $("#id_marca").change(function(){
    buscarModelo();
  });
  $("#id_modelo").change(function(){
    buscarAno();
  });

  $("#codigoestado").change(function(){
    buscarMunicipios2();
  });
  $("#codigomunicipio").change(function(){
    buscarParroquia();
  });  

</script>


<script>
//menu
  $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });

  $("#marca_menu").change(function(){
    buscarModeloMenu();
  });

</script>

</body>
</html>
