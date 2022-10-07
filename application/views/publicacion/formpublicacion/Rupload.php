

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <!-- Booststrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--  /Booststrap -->

    <link href="<?php echo base_url(); ?>asset/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/fontawesome/css/brands.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/fontawesome/css/solid.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="<?= base_url();?>upload/css/grid.css">-->
    <link rel="stylesheet" href="<?= base_url();?>upload/css/modal.css">
    <link rel="stylesheet" href="<?= base_url();?>upload/css/styles.css">
    <title>Vista previa de imágenes</title>
</head>
<body>


    <div class="modal">
      <div class="modal-main">
        <div class="row">
          <div class="c-3-lg c-3-md c-1-sm close-modal"></div>
          <div class="c-6-lg c-6-md c-10-sm c-12-xs close-modal">
            <div class="modal-card" id="loading">
              <div class="preloader"></div>
              <span class="tag">Cargando...</span>
            </div>
            <div class="modal-card" id="Message">
              <span class="tag"></span>
            </div>
          </div>
          <div class="c-3-lg c-3-md c-1-sm close-modal"></div>
        </div>
      </div>
    </div>


    <header></header>

    <main>
        <div class="container">
            <section id="Images" class="images-cards">
                <form action="#" method="post" enctype="multipart/form-data" id="upload-multi-images">
                    <div class="row">
                        <div class="img-cargada" id="add-photo-container">
                            <div class="add-new-photo first" id="add-photo">
                                <span><i class="fas fa-camera"></i></span>
                            </div>
                            <input type="file" multiple id="add-new-photo" accept="image/png, .jpeg, .jpg, image/gif"  maxImg="6">
                            <input type="hidden" id="codigo" value="<?= $this->uri->segment(3)?>">
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit">Subir imágenes</button>
                    </div> 
                </form> 
            </section>
            <section id="MyImages" class="images-cards">
                <h2>Mis imágenes</h2>
                <div class="row" id="my-images">
                <?php if(isset($publicaciones)){ 
                    if($publicaciones->url_uno!=""){?>
                    <div class="img-cargada" data-id="<?= $publicaciones->id ?>">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container">
                            <figure> 
                                <img src="<?=base_url()?>upload/images/<?= $publicaciones->codigo.'/'.$publicaciones->url_uno ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }

                    if($publicaciones->url_dos!=""){?>
                    <div class="img-cargada" data-id="<?= $publicaciones->id ?>">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container">
                            <figure> 
                                <img src="<?=base_url()?>upload/images/<?= $publicaciones->codigo.'/'.$publicaciones->url_dos ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }
                    
                    if($publicaciones->url_tres!=""){?>
                    <div class="img-cargada" data-id="<?= $publicaciones->id ?>">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container">
                            <figure> 
                                <img src="<?=base_url()?>upload/images/<?= $publicaciones->codigo.'/'.$publicaciones->url_tres ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }
                    
                    if($publicaciones->url_cuatro!=""){?>
                    <div class="img-cargada" data-id="<?= $publicaciones->id ?>">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container">
                            <figure> 
                                <img src="<?=base_url()?>upload/images/<?= $publicaciones->codigo.'/'.$publicaciones->url_cuatro ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }
                    
                    if($publicaciones->url_cinco!=""){?>
                    <div class="img-cargada" data-id="<?= $publicaciones->id ?>">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container">
                            <figure> 
                                <img src="<?=base_url()?>upload/images/<?= $publicaciones->codigo.'/'.$publicaciones->url_cinco ?>" alt="Foto del usuario">
                                <figcaption> 
                                    <i class="fas fa-times"></i> 
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php }
                    
                    if($publicaciones->url_seis!=""){?>
                    <div class="img-cargada" data-id="<?= $publicaciones->id ?>">
                        <input type="hidden" name="photo-iohQc" value="test">
                        <div class="image-container">
                            <figure> 
                                <img src="<?=base_url()?>upload/images/<?= $publicaciones->codigo.'/'.$publicaciones->url_seis ?>" alt="Foto del usuario">
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
                </div>
            </section>
        </div>
    </main>

    <!-- Bootstrap y jQuery -->
    
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    <!--  /Bootstrap y jQuery -->


    <!--<script src="<?= base_url();?>upload/js/modal.js"></script>-->
    <!--<script src="js/functions.js"></script> -->
    <script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
    <script src="<?= base_url();?>upload/js/scripts.js"></script>
</body>
</html>