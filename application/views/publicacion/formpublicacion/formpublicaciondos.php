
<div class="contenedor containerUpload">
  

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
<div class='mainUpload' id="form_paso_b">
  <h1>Paso 2/3</h1>

  <h3 style="color: #ffad03;">¡Sube las imágenes del vehículo que deseas publicar!<h3>

      <div class="flex-col">
        <div class="titulo-descripcion">
                <label>Fotos</label>
                <span>Debes cargar mínimo 4 fotos y máximo 6<br>
                      Formato de fotos permitido jpeg, jpg, png, gif<br>
                      Tamaño máximo permitido por foto 20mb</span>
        </div>

        <div class="flex-row sortable">
            <section id="Images" class="images-cards">
                <form action="" method="post" enctype="multipart/form-data" id="upload-multi-images">
                    <div class="row center-row">
                        <div class="add-photo-container" id="add-photo-container">
                            <div class="add-new-photo first" id="add-photo">
                                <span><i class="fas fa-camera"></i></span>
                            </div>
                            <input type="file" multiple id="add-new-photo" accept="image/png, .jpeg, .jpg, image/gif"  maxImg="6">
                            <input type="hidden" id="codigo" value="<?= $this->uri->segment(2)?>">
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit" id="btn-upload" class="btn btn-bf btn-success">Subir imágenes</button>
                    </div> 
			
                </form>
                <div id="progressbar" class="progressbar"></div> 
            </section>

            <section id="MyImages" class="images-cards">

            <div class="titulo-descripcion">
                <label>Imágenes cargadas</label>
            </div>
                
                <div class="row" id="my-images">
                <?php if(isset($publicaciones)){ 
                    if($publicaciones->url_uno!=""){?>
                    <div class="img-cargada">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container" data-id="1">
                            <figure> 
                                <img src="<?=base_url()?>publicaciones/<?= trim($publicaciones->codigo).'/'.$publicaciones->url_uno ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }

                    if($publicaciones->url_dos!=""){?>
                    <div class="img-cargada">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container" data-id="2">
                            <figure> 
                                <img src="<?=base_url()?>publicaciones/<?= trim($publicaciones->codigo).'/'.$publicaciones->url_dos ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }
                    
                    if($publicaciones->url_tres!=""){?>
                    <div class="img-cargada">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container" data-id="3">
                            <figure> 
                                <img src="<?=base_url()?>publicaciones/<?= trim($publicaciones->codigo).'/'.$publicaciones->url_tres ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }
                    
                    if($publicaciones->url_cuatro!=""){?>
                    <div class="img-cargada">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container" data-id="4">
                            <figure> 
                                <img src="<?=base_url()?>publicaciones/<?= trim($publicaciones->codigo).'/'.$publicaciones->url_cuatro ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }
                    
                    if($publicaciones->url_cinco!=""){?>
                    <div class="img-cargada">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container" data-id="5">
                            <figure> 
                                <img src="<?=base_url()?>publicaciones/<?=trim($publicaciones->codigo).'/'.$publicaciones->url_cinco ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }
                    
                    if($publicaciones->url_seis!=""){?>
                    <div class="img-cargada">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container" data-id="6">
                            <figure> 
                                <img src="<?=base_url()?>publicaciones/<?= trim($publicaciones->codigo).'/'.$publicaciones->url_seis ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }?>                    
                    <?php  
                    }
                    ?>
                </div><!--my-images-->
            </section><!--MyImages-->
        </div><!--flex-row sortable-->

        <div class="flex-row sortable">
            <div id="mensaje"></div>             
        </div>

        <div class="flex-row sortable">
            <div class="preload"></div>              
        </div> 

    </div><!--flex-col-->

    <div class="flex-button">
      <a href="<?php echo base_url();?>publicar/<?php echo $this->uri->segment('2'); ?>" id="btn-b-regresar"  class="btn btn-bf btn-mini btn-back">Regresar</a> 
        <button type="button" class="btn btn-bf btn-mini" id="btn-b-continuar">Continuar</button>
    </div>

  </div><!--form_paso_b-->
</div><!--contenedor-->

<?php
  $this->view('layouts/footerR');
?>


<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript"> var codigo = "<?php echo $this->uri->segment('2');?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.min.js"> </script>
<script src="<?= base_url();?>Bienfino-master/upload/alertifyjs/alertify.js"></script>
<script type="text/javascript">      
//override defaults
alertify.defaults.transition = "zoom";
alertify.defaults.theme.ok = "ui positive button";
alertify.defaults.theme.cancel = "ui black button";

if(!alertify.myAlert){
  //define a new dialog
  alertify.dialog('myAlert',function factory(){
    return{
      main:function(message){
        this.message = message;
      },
      setup:function(){
          return { 
            buttons:[{text: "ok", key:27/*Esc*/}],
            focus: { element:0 }
          };
      },
      prepare:function(){
        this.setContent(this.message);
      }
  }});
}
if(!alertify.errorAlert){
  //define a new errorAlert base on alert
  alertify.dialog('errorAlert',function factory(){
    return{
            build:function(){
                var errorHeader = '<span class="fa fa-times-circle fa-2x" '
                +    'style="vertical-align:middle;color:#e10000;">'
                + '</span> Ocurrio un error';
                this.setHeader(errorHeader);
            }
        };
    },true,'alert');
}

</script>  
<script src="<?= base_url();?>Bienfino-master/upload/js/scripts.js"></script>    

<script type="text/javascript">

        hideShowUpload();
        //$('#btn-b-continuar').attr('disabled', true);
    var btnContinuar = document.getElementById("btn-b-continuar");
    var myImages = document.getElementById("MyImages");
    var mensaje = document.getElementById("mensaje");      
    var preload = document.querySelector('.preload');

    //$('#btn-b-continuar').hide();
    //$('#MyImages').hide();
    
$("#btn-b-continuar").click(function(){

    if(document.querySelectorAll('#my-images > .img-cargada').length>='4'){
        preload.classList.add('activate-preload');
        $('#btn-b-continuar').hide();
        $('#btn-b-regresar').hide();
        window.location.href = base_url+'publicartres/'+codigo;
    }else{
        mensaje.innerHTML = "";
        alertify.alert('Error', 'Por favor carga las fotos del vehiculo');
    }

})
</script>
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
  </body>
</html>