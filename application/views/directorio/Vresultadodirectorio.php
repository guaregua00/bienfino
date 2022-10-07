<main class="main">
    <div class="container">

        <div class="grid-resultado-directorio">
            <div class="cont-info2">
                <div class="info">
                    <?php
                    if (isset($table['data'])) { ?>
                        <p>Se han encontrado<span> <?= count($table['data']) ?> Resultado(s)</span></p>
                    <?php } else { ?>
                        <p><span></span></p>
                    <?php } ?>
                </div>
                <div class="result-info-btn">
                    <?php
                    if (isset($table['data']) and count($table['data']) != 0) { ?>
                        <div class="result-busqueda">
                            <?php
                            if ($this->session->userdata('buscador') != "") {
                                echo   "<p>Búsquedas relacionadas: <span>" . $this->session->userdata('buscador') . "</span></p>";
                            }

                            if ($this->session->userdata('codigoestado_directorio') != "") {;
                                foreach ($estados as $key => $estado) {
                                    if ($estado->id == $this->session->userdata('codigoestado_directorio')) {
                                        echo '<span class="label-filtro">' . ucwords(strtoupper($estado->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(2)"></i></span>';
                                    }
                                }
                            }
                            ?>
                        </div>

                        <div class="info-btn">
                            <!-- <button class="button-filtre" id="button-filtre"><i class="fa fa-grip-horizontal"></i></button> -->
                            <button class="button-filtre button-filtre2" id="button-filtre2"><i class="fas fa-filter"></i></button>
                        </div>
                    <?php } ?>

                </div>

<!--                 <div class="flex wrap cpaginator">
                            <?php if ($table['prev']) : ?>
                                <a href="<?= trimed_full_url ?>?pag=<?= $_GET['pag'] - 1 ?>">
                                    <code class="pointer hover">Página Anterior</code>
                                </a>
                            <?php endif ?>
                            <?php if ($table['next']) : ?>
                                <a href="<?= trimed_full_url ?>?pag=<?= $_GET['pag'] + 1 ?>">
                                    <code class="pointer text-right hover">Página Siguiente</code>
                                </a>
                            <?php endif ?>
                        </div>
                <p class="footer">
                    Página: <?= $_GET['pag'] ?> de <?= $table['total'] ?> │ Total: <?= $table['count'] ?> items │ <a href="<?= base_url ?>/excel">Imprimir</a>
                </p> -->


                <!--                 
                    <div class="pagination-container">
                        <?php

                        if (!empty($this->pagination->create_links())) {
                            $limitePagina = $this->pagination->per_page;
                            $totalPaginas = round($cantidad_resultado / $limitePagina);
                            $actualPagina = $this->pagination->cur_page;
                            if ($actualPagina == 1) {
                                echo "<div class='short_count_close_open'>&nbsp;</div>";
                            }
                            echo $this->pagination->create_links();
                            echo "<div class='short_count normal-hide'>" . $actualPagina . " de " . $totalPaginas . "</div>";
                            if ($totalPaginas == $actualPagina) {
                                echo "<div class='short_count_close'>&nbsp;</div>";
                            }
                        }
                        ?>
                    </div> -->
                <!--<div class="pagination-container">
                                <div class="short_count_close_open">&nbsp;</div>
                                <ul class="pagination">
                                    <li class="active"><a href="#">1</a></li><li><a href="javascript:void(0)" data-ci-pagination-page="2">2</a></li>
                                    <li><a href="javascript:void(0)" data-ci-pagination-page="3">3</a></li>
                                    <li class="near"><a href="javascript:void(0)" data-ci-pagination-page="2">»</a></li>
                                </ul><div class="short_count normal-hide">1 de 5</div>
                    </div> -->

                <!--pagination-container-->
            </div>
            <div class="cont-menu-lateral2">
                <div class="div-filtros" id="div-filtros">
                    <button class="btn btn-yellow">Filtros</button>
                </div>
                <div class="menu-lateral" id="menu-lateral">
                    <div class="cont-filtros-busqueda">


                    </div><?php
                            if (isset($table['data']) and count($table['data']) != 0) { ?>
                        <div class="select-ubicacion">
                            <h3>Ubicación Estado<i class="fa fa-caret-down"></i></h3>
                            <ul><?php
                                if (isset($estados) and $estados != "") {
                                    foreach ($estados as $key => $estado) {
                                        $buscador = $this->session->userdata('buscador');
                                        echo '<li><a href="' . base_url() . 'resultadodirectorio?codigoestado_directorio=' . $estado->id . '">' . ucwords(strtoupper($estado->nombre)) . '</a></li>';
                                    }
                                } else {
                                    echo '<li><a href="#">Sin opciones</a></li>';
                                }

                                ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="cont-cards2">

                <?php if (isset($table['data']) and count($table['data']) == 0) { ?>
                    <section class="directorio" style="margin-top:50px ">
                        <div class="container titulo-section">
                            <h2>Intenta con otra busqueda<span class="heading-color"> </span></h2>
                            <p class="heading-text">Concesionarios, Productos o Servicios Automotriz </p>
                        </div>

                        <form id="formdir" action="<?php echo base_url() ?>resultadodirectorio" method="get">
                            <div class="search-form">
                                <div class="margin-right">
                                    <label></label>
                                    <input type="text" name="buscador" id="buscador" value="" minlength="3" class="input-search2" placeholder="Busca Empresas, Repuestos o Servicios" autocomplete="off" required>
                                </div>
                                <div class="">
                                    <label></label>
                                    <select class="input-select" name="codigoestado_directorio" id="codigoestado_directorio">
                                        <option selected="selected" value="">Seleccione un estado</option>
                                        <?php
                                        foreach ($estados as $value) {
                                        ?>
                                            <option value="<?php echo $value->codigoestado; ?>"><?php echo $value->nombre; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <button type="submit" class="btn btn-yellow">Enviar</button>
                                </div>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

                        </form>

                    </section>
                <?php } ?>

                <?php
                if (isset($table['data'])) {
                    $i = 1;
                    foreach ($table['data'] as $r) {

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
                                break;
                            }
                        } ?>

                        <div class="box-directorio" <?php if (!$ruta_foto_logo) {
                                                        echo "style='grid-template-columns: 1fr;'";
                                                    } ?>>
                            <div class="box-img">

                                <?php if ($ruta_foto_logo) { ?>
                                    <div class="image">
                                        <a href="<?php echo base_url() ?>directoriodetalle/<?= $r->ID ?>">
                                            <img loading="lazy" src="<?php echo $ruta_foto_logo; ?>" alt="<?php echo $r->ID; ?>">
                                        </a>
                                    </div>
                                <?php } $ruta_foto_logo=null?>

                            </div>

                            <div class="box-inf">
                                <a class="titulo" href="<?php echo base_url() ?>directoriodetalle/<?= $r->ID ?>"><span><?php echo $i . ". "; ?></span>
                                    <h3> <?php echo ucwords(strtolower($r->Nombre));
                                            $i++; ?></h3>
                                </a>
                                <p class="productos"><span>Productos: </span><?php echo ucwords(strtr($r->{'Productos'}, array(' / ' => ', '))); ?></p>
                                <p class="servicios"><span>Servicios: </span><?php echo ucwords(strtr($r->{'Servicios'}, array(' / ' => ', '))); ?></p>
                                <div class="dir">
                                    <div class="link-directorio" onclick="show(this)">
                                        <p>Ver Telefonos</p>
                                    </div>
                                    <div class="link-directorio2">
                                        <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 1'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 1'}) ?></a>
                                        <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 2'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 2'}) ?></a>
                                        <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 3'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 3'}) ?></a>
                                    </div>
                                    <div class="link-whatsapp">
                                        <?php if ($r->{'WhatsApp'}) { ?><a target="_blank" href="https://wa.me/<?php echo humanize_phone($r->{'WhatsApp'}) ?>"><i class="fab fa-whatsapp"></i></a> <?php } ?>
                                        <?php if ($r->{'WhatsApp Business'}) { ?><a target="_blank" href="https://wa.me/<?php echo humanize_phone($r->{'WhatsApp Business'}) ?>"><i class="fab fa-whatsapp"></i></a><?php } ?>
                                    </div>

                                </div>

                                <p class="descripcion"><span>Descripción: </span><?= ucwords(mb_strtolower($r->{'Descripción'})) . ", " ?></p>
                                <div class="link-instagram-web">
                                    <?php if ($r->{'Instagram'}) { ?><a target="_blank" href="https://instagram.com/<?php echo ucwords(mb_strtolower($r->{'Instagram'})) ?>"><i class="fab fa-instagram"></i></a> <?php } ?>
                                    <?php if ($r->{'Página WEB'}) { ?><a target="_blank" href="<?php echo mb_strtolower($r->{'Página WEB'}) ?>"><i class="fas fa-globe"></i><?php echo mb_strtolower($r->{'Página WEB'}) ?></a><?php } ?>
                                </div>
                                <p class="ubicacion"><i class="fa fa-map-marker-alt"></i><a href="javascript:void(0)"><?= ucwords(mb_strtolower($r->{'Dirección Física'})) . ", " ?> <?= ucwords(mb_strtolower($r->{'Parroquia'})) ?> <?= ucwords(mb_strtolower($r->{'Municipio'})) ?> <?= ucwords(mb_strtolower($r->{'Estado'})) ?></a> </p>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>

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
        </div>

    </div>
    <!--container-->
    <?php if (isset($table['data']) and count($table['data']) == 0) { ?>
        <section class="directorio" style="padding: 50px 0; display: none;">
            <div class="container titulo-section">
                <h2>Intenta con otra busqueda<span class="heading-color"> </span></h2>
                <p class="heading-text">Concesionarios, Productos o Servicios Automotriz </p>
            </div>

            <form id="formdir" action="<?php echo base_url() ?>resultadodirectorio" method="get">
                <div class="search-form">
                    <div class="margin-right">
                        <label></label>
                        <input type="text" name="buscador" id="buscador" value="" minlength="3" class="input-search2" placeholder="Busca Empresas, Repuestos o Servicios" autocomplete="off" required>
                    </div>
                    <div class="">
                        <label></label>
                        <select class="input-select" name="codigoestado_directorio" id="codigoestado_directorio">
                            <option selected="selected" value="">Seleccione un estado</option>
                            <?php
                            foreach ($estados as $value) {
                            ?>
                                <option value="<?php echo $value->codigoestado; ?>"><?php echo $value->nombre; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-yellow">Enviar</button>
                    </div>
                </div>
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

            </form>

        </section>
    <?php } ?>
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