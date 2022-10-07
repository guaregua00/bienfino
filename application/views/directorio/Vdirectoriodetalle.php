<main class="main">
    <?php 
    
        if (isset($directoriodetalle['data'])) {
            foreach ($directoriodetalle['data'] as $r) {
                //if($r->ID ==$this->uri->segment(2)){ // if que no va

                $r->{'Archivos'} = recursive_files_in(
                    root_folder . "/storage/directorios/{$r->{'ID'}}/",
                    'relative_path',
                    'excursive',
                    'exclude_folders',
                    array()
                );
                foreach ($r->{'Archivos'} as $a) {
                    $b = getcwd() . "/storage/directorios/{$r->{'ID'}}/{$a}";
                    if (file_exists($b) and ($a == "logo.png" or $a == "logo.gif" or $a == "logo.jpg" or $a == "logo.jpeg")) {
                        $ruta_foto_logo = "" . base_url . "/storage/directorios/{$r->{'ID'}}/{$a}";
                    }
                    if (file_exists($b) and ($a == "banner.png" or $a == "banner.gif" or $a == "banner.jpg" or $a == "banner.jpeg")) {
                        $ruta_foto_banner = "" . base_url . "/storage/directorios/{$r->{'ID'}}/{$a}";
                    }
                }  ?>

    <div class="detalle">
        <div class="detalle-header">
            <?php if ($ruta_foto_banner) { ?><img loading="lazy" src="<?php echo $ruta_foto_banner; ?>" alt="<?php echo $r->ID; ?>"> <?php }$ba ="null"?>
            <div class="detalle-head" <?php if (!$ruta_foto_logo) { echo 'style="justify-content: center !important;"';} ?>>
                <div class="detalle-logo" >
                    <?php if ($ruta_foto_logo) { ?><img loading="lazy" src="<?php echo $ruta_foto_logo; ?>" alt="<?php echo $r->ID; ?>"> <?php }$a="null"?>
                </div><!-- detalle-logo -->
                <div class="detalle-items">
                    <h1><?php echo ucwords(strtolower($r->Nombre));?></h1>
                    <p class="ubicacion"><i class="fa fa-map-marker-alt"></i><a href="javascript:void(0)"><?= ucwords(mb_strtolower($r->{'Dirección Física'})) . ", " ?> <?= ucwords(mb_strtolower($r->{'Parroquia'})) ?> <?= ucwords(mb_strtolower($r->{'Municipio'})) ?> <?= ucwords(mb_strtolower($r->{'Estado'})) ?></a> </p>
                    <p><a target="_blank" href="mailto:<?php echo ucwords(strtolower($r->{'Email de la empresa'}));?>"><i class="far fa-envelope"></i><?php echo ucwords(strtolower($r->{'Email de la empresa'}));?></a></p>
                    <p><a target="_blank" href="<?php echo mb_strtolower($r->{'Página WEB'}) ?>"><i class="fas fa-globe"></i><?php echo mb_strtolower($r->{'Página WEB'}) ?></a></p>
                    <p class="numero">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 1'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 1'}) ?></a>
                        <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 2'}) ?>"><?php echo humanize_phone($r->{'Te
                            léfono de Contacto 2'}) ?></a>
                        <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 3'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 3'}) ?></a>
                    </p>
                    <div class="link-whatsapp2">
                        <?php if ($r->{'WhatsApp'}) { ?><a target="_blank" href="https://wa.me/<?php echo humanize_phone($r->{'WhatsApp'}) ?>"><i class="fab fa-whatsapp"></i></a> <?php } ?>
                        <?php if ($r->{'WhatsApp Business'}) { ?><a target="_blank" href="https://wa.me/<?php echo humanize_phone($r->{'WhatsApp Business'}) ?>"><i class="fab fa-whatsapp"></i></a><?php } ?>
                    </div>
                </div><!-- detalle-items -->
            </div><!-- detalle-head -->

        </div><!--detalle-header-->
    </div><!-- detalle -->

    <div class="container">
        <div class="detalle-fila">
            <div class="detalle-izq" >
                <div class="detalle-content">
                    <h2>Información General</h2>
            
                    <p><span>Categorias: </span><?php echo strtr($r->{'Categorias'}, array(' / ' => ', '))?></p>
                    <p><span>Marcas: </span><?php echo strtr($r->{'Marcas'}, array(' / ' => ', '))?></p>
                    <p><span>Servicios: </span><?php echo strtr($r->{'Servicios'}, array(' / ' => ', '))?></p>
                    <p><span>Productos: </span><?php echo strtr($r->{'Productos'}, array(' / ' => ', '))?></p>
                    <p><span>Horarios de atención: </span>
                        <?php echo  humanize_time( $r->{'Horario de Trabajo Desde'}, 12 )." a ";?>
						<?php echo  humanize_time( $r->{'Horario de Trabajo Hasta'}, 12 ) ?>
                    </p>
                    <p><span>Metodos de Pago: </span><?php echo strtr($r->{'Métodos de Pago'}, array(' / ' => ', '))?></p>
                    <p><span>RIF: </span><?php echo $r->{'RIF-J'}?></p>
                    <p class="descripcion"><span>Descripción: </span><?= ucwords(mb_strtolower($r->{'Descripción'})) . "" ?></p>
                                
                </div><!-- detalle-content -->

                <div class="detalle-mapa" >
                    <iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d251082.30795472919!2d-66.8742081452862!3d10.487966597526908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d10.4634313!2d-66.6057379!4m5!1s0x8c2a58fcd5daf429%3A0x1aac540da7fffa70!2sdireccion%20epa%20las%20mercedes!3m2!1d10.491311999999999!2d-66.8674372!5e0!3m2!1ses-419!2sve!4v1653448499915!5m2!1ses-419!2sve" width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div><!-- detalle-izq -->



            <div class="detalle-der" >
                <div class="cont-banner2">
                    <div class="banner-directorio">
                        <div class="image-banner">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="<?php echo base_url() ?>img/anunciate.gif" alt="<?php echo $r->ID; ?>">
                            </a>
                        </div>
                    </div>
                    <div class="banner-directorio">
                        <div class="image-banner">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="<?php echo base_url() ?>img/publicidad1.jpg" alt="<?php echo $r->ID; ?>">
                            </a>
                        </div>
                    </div>

                    <div class="banner-directorio">
                        <div class="image-banner">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="<?php echo base_url() ?>img/publicidad2.jpg" alt="<?php echo $r->ID; ?>">
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- detalle-der -->
        </div><!-- detalle-fila -->

    </div><!--container-->
    <?php }
        }//if que no va
     //} ?>
 </main>


<?php $this->view('layouts/footerR'); ?>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/jquery.min.js"> </script>
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
<script>
    let buttonFiltre2 = document.querySelector('#button-filtre2'),
        btnCerrarModal2 = document.getElementById('btn-cerrar-modal2'),
        menuLateral = document.querySelector('.menu-lateral');

    buttonFiltre = document.getElementById('button-filtre'),
        esDispositivoMovil = () => window.innerWidth <= 970;

    buttonFiltre2.addEventListener('click', (e) => {
        console.log(menuLateral);
        menuLateral.classList.toggle('active');
    });
    /*           btnCerrarModal2.addEventListener('click',(e) => {
                  modal3.classList.remove('active');
              });  */





    buttonFiltre.addEventListener('click', () => {
        if (window.innerWidth <= 600) {
            cards.classList.remove('columns1');
            cards.classList.toggle('columns2');
        } else {
            cards.classList.remove('columns2');
            cards.classList.toggle('columns1');
        }

    });

    function show(element) {

        element.style.setProperty("display", "none", "important");
        console.log(element.parentNode.children[1]);
        element.parentNode.children[1].style.setProperty("display", "inline-block", "important");
    }

    function limpiarFiltro(control) {
        window.location.href = base_url + 'Cdirectorio/limpiarfiltro/' + control;
    }
</script>



<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
</body>

</html>