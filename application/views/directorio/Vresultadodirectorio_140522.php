<?php
//echo "dentro de resultado directorio";exit;
if (isset($table['data'])) {
    foreach ($table['data'] as $r) {

        /*         //var_dump($r);exit;
        echo "<br><br><br>";
        echo "ID: " . $r->ID . "<br>";
        echo "Nombre Directorio: " . $r->Nombre . "<br>";
        echo "Estado: " . $r->{'Estado'} . "<br>";
        echo "Municipio: " . $r->{'Municipio'} . "<br>";
        echo "Parroquia: " . $r->{'Parroquia'} . "<br>";
        //echo "Eliminado: ".$r->Eliminado."<br>";
        echo "Fecha de Creación: " . $r->{'Fecha de Creación'} . "<br>";
        echo "Teléfono de Contacto 1: " . humanize_phone($r->{'Teléfono de Contacto 1'}) . "<br>";
        echo "Teléfono de Contacto 2: " . humanize_phone($r->{'Teléfono de Contacto 2'}) . "<br>";
        echo "Teléfono de Contacto 3: " . humanize_phone($r->{'Teléfono de Contacto 3'}) . "<br>";
        echo "WhatsApp:" . humanize_phone($r->{'WhatsApp'}) . "<br>";
        echo "WhatsApp Business: " . humanize_phone($r->{'WhatsApp Business'}) . "<br>";
        echo "Categorias: " . strtr($r->{'Categorias'}, array(' / ' => ', '))    . "<br>";
        echo "Marcas: " . strtr($r->{'Marcas'}, array(' / ' => ', '))    . "<br>";
        echo "Servicios: " . strtr($r->{'Servicios'}, array(' / ' => ', '))    . "<br>";
        echo "Servicios en Promoción: " . strtr($r->{'Servicios en Promoción'}, array(' / ' => ', '))    . "<br>";
        echo "Productos: " . strtr($r->{'Productos'}, array(' / ' => ', '))    . "<br>";
        echo "Productos en Promoción: " . strtr($r->{'Productos en Promoción'}, array(' / ' => ', '))    . "<br>"; */
        $r->{'Archivos'} = recursive_files_in(
            root_folder . "/storage/directorios/{$r->{'ID'}}/",
            'relative_path',
            'excursive',
            'exclude_folders',
            array()
        );
        foreach ($r->{'Archivos'} as &$a) {
            $a = "" . base_url . "/storage/directorios/{$r->{'ID'}}/{$a}";
        }

        //$r->{'Archivos'} = implode('<br>', $r->{'Archivos'});
        /*         echo $a;
        $img = $r->{'Archivos'};
        echo $img;

        //echo "Logo: " . $r->{'Archivos'} . "<br>";

        echo "<br><br><br>";
        echo "<br><br><br>"; */
    }
}


?>
<main class="main">
    <div class="container">
        <div class="grid-resultado">

            <div class="cont-info">
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
                            ?>
                            <?php
                            if (isset($categorias2) and $categorias != "") {
                                foreach ($categorias as $key => $categoria) {
                                    if ($categoria->id_categoria == $this->session->userdata('categoria')) {
                                        echo '<span class="label-filtro">' . ucwords(strtolower($categoria->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(1)"></i></span>';
                                    }
                                }
                            }

                            if ($this->session->userdata('codigoestado_directorio') != "") {;
                                foreach ($estados as $key => $estado) {
                                    if ($estado->codigoestado == $this->session->userdata('codigoestado_directorio')) {
                                        echo '<span class="label-filtro">' . ucwords(strtolower($estado->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(2)"></i></span>';
                                    }
                                }
                            }


                            if (isset($municipios2) and $municipios != "") {
                                foreach ($municipios as $key => $municipio) {
                                    if ($municipio->codigomunicipio == $this->session->userdata('municipio')) {
                                        echo '<span class="label-filtro">' . ucwords(strtolower($municipio->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(3)"></i></span>';
                                    }
                                }
                            }
                            if (isset($parroquias2) and $parroquias != "") {
                                foreach ($parroquias as $key => $parroquia) {
                                    if ($parroquia->codigoparroquia == $this->session->userdata('parroquia')) {
                                        echo '<span class="label-filtro">' . ucwords(strtolower($parroquia->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(4)"></i></span>';
                                    }
                                }
                            }
                            if (isset($modelos) and $modelos != "") {
                                foreach ($modelos as $key => $modelo) {
                                    if ($modelo->id_modelo == $this->session->userdata('modelo')) {
                                        echo '<span class="label-filtro">' . ucwords(strtolower($modelo->modelo)) . '<i class="fas fa-times" onclick="limpiarFiltro(7)"></i></span>';
                                    }
                                }
                            }
                            if (isset($marcas2) and $marcas != "") {
                                foreach ($marcas as $key => $marca) {
                                    if ($marca->id_marca == $this->session->userdata('marca')) {
                                        echo '<span class="label-filtro">' . ucwords(strtolower($marca->marca)) . '<i class="fas fa-times" onclick="limpiarFiltro(6)"></i></span>';
                                    }
                                }
                            }
                            if ($this->session->userdata('anio')) {
                                echo '<span class="label-filtro">' . $this->session->userdata("anio") . '<i class="fas fa-times" onclick="limpiarFiltro(8)"></i></span>';
                            }
                            if ($this->session->userdata('precio')) {
                                echo '<span class="label-filtro">' . $this->session->userdata("precio") . ' $<i class="fas fa-times" onclick="limpiarFiltro(9)"></i></span>';
                            }
                            if ($this->session->userdata('km')) {
                                echo '<span class="label-filtro">' . $this->session->userdata("km") . ' km<i class="fas fa-times" onclick="limpiarFiltro(10)"></i></span>';
                            }

                            ?>
                        </div>


                        <div class="info-btn">
                            <!-- <button class="button-filtre" id="button-filtre"><i class="fa fa-grip-horizontal"></i></button> -->
                            <button class="button-filtre button-filtre2" id="button-filtre2"><i class="fas fa-filter"></i></button>
                        </div>
                    <?php } ?>

                </div>

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
            <!--cont-info-->

            <div class="cont-menu-lateral">
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
                                        echo '<li><a href="' . base_url() . 'resultadodirectorio?codigoestado_directorio=' . $estado->codigoestado . '&buscador=' . $buscador . '">' . ucwords(strtolower($estado->nombre)) . '</a></li>';
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

            <div class="cont-cards">

                <div class="cards cards2" id="cards">
                    <?php
                    if (isset($table['data'])) {
                        foreach ($table['data'] as $r) {
                    ?>
                            <div class="grid grid2">

                                <div class="title-area">
                                    <!--<div class="category-title">
                                        <span class="padding_cats"><a href=""><?= mb_strtoupper($r->ID) ?></a></span>
                                        <span class="padding_cats"><a href=""><?= mb_strtoupper($r->ID) ?></a></span>
                                    </div> -->
                                    <h3><a href="javascript:void(0)"><?= ucwords(strtolower($r->Nombre)) ?></a></h3>
                                    <p class="location"><i class="fa fa-map-marker-alt"></i><a href="javascript:void(0)"><?= mb_strtoupper($r->{'Municipio'}) ?></a>, <a href="javascript:void(0)"><?= mb_strtoupper($r->{'Estado'}) ?></a></p>
                                </div>

                                <?php if ($r->{'Archivos'} != null) { ?>
                                    <div class="image">
                                        <a href="javascript:void(0)">
                                            <img loading="lazy" src="<?php echo array_pop($r->{'Archivos'}); ?>" alt="<?php echo $r->ID; ?>" class="img-responsive">
                                        </a>
                                        <!-- <div class="price-tag">
                                        <div class="price"><span class="precio">$<?= mb_strtoupper($r->ID) ?></span><span class="nego"></span></div>
                                    </div> -->
                                    </div>
                                <?php } ?>


                                <div class="short-description">
                                    <ul class="list-unstyled list-unstyled2">
                                        <li><i class="fas fa-phone-alt"></i>
                                            <div class="link-directorio" onclick="show(this)">
                                                <p>Telefonos</p>
                                            </div>
                                            <div class="link-directorio2">
                                                <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 1'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 1'}) ?></a>
                                                <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 2'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 2'}) ?></a>
                                                <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 3'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 3'}) ?></a>
                                            </div>
                                        </li>
                                        <li class="li-whatsapp"><i class="fab fa-whatsapp"></i>
                                            <?php if ($r->{'WhatsApp'}) { ?><a href="https://wa.me/<?php echo humanize_phone($r->{'WhatsApp'}) ?>">WhatsApp 1</a> <?php } ?>
                                            <?php if ($r->{'WhatsApp Business'}) { ?><a href="https://wa.me/<?php echo humanize_phone($r->{'WhatsApp Business'}) ?>">WhatsApp 2</a><?php } ?>
                                        </li>
                                        <li><i class="fas fa-map-marked-alt"></i>Dirección: Av los Ilustres, etc</li>
                                        <li><i class="fab fa-buromobelexperte"></i>
                                            <p>Categorias:</p> <?php echo ucwords(strtr($r->{'Categorias'}, array(' / ' => ', '))); ?>
                                        </li>
                                        <li><i class="fas fa-car-alt"></i>
                                            <p>Marcas:</p> <?php echo ucwords(strtr($r->{'Marcas'}, array(' / ' => ', '))); ?>
                                        </li>
                                        <li><i class="fas fa-clipboard-check"></i>
                                            <p>Servicios:</p> <?php echo ucwords(strtr($r->{'Servicios'}, array(' / ' => ', '))); ?>
                                        </li>
                                        <li><i class="fas fa-clipboard-list"></i>
                                            <p>Productos:</p> <?php echo ucwords(strtr($r->{'Productos'}, array(' / ' => ', '))); ?>
                                        </li>
                                        <li><i class="fab fa-instagram"></i><?php echo ucwords($r->{'Instagram'}); ?></li>
                                        <li><i class="fas fa-globe"></i><?php echo ucwords($r->{'Página WEB'}); ?>

                                    </ul>
                                </div>

                            </div>
                            <!--grid-->
                    <?php }
                    } ?>
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
                    </div>
                    <!--pagination-container-->
                </div>
                <!--cards-->
            </div>
            <!--cont-cards-->
        </div>
        <!--grid-resultado-->

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
                                    if ($estado->codigoestado == $this->session->userdata('codigoestado_directorio')) {
                                        echo '<span class="label-filtro">' . ucwords(strtolower($estado->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(2)"></i></span>';
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
                                        echo '<li><a href="' . base_url() . 'resultadodirectorio?codigoestado_directorio=' . $estado->codigoestado . '&buscador=' . $buscador . '">' . ucwords(strtolower($estado->nombre)) . '</a></li>';
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
                <?php
                    if (isset($table['data'])) {
                        foreach ($table['data'] as $r) {?>
                    <div class="box-directorio">
                        <div class="box-img">
                            <div class="image">
                                <a href="javascript:void(0)">
                                    <img loading="lazy" src="<?php echo array_pop($r->{'Archivos'}); ?>" alt="<?php echo $r->ID; ?>">
                                </a>
                            </div>
                        </div>

                        <div class="box-inf">
                            <a class="titulo" href=""><h3><?= ucwords(strtolower($r->Nombre)) ?></h3></a>
                            <p class="productos"><span>Productos: </span><?php echo ucwords(strtr($r->{'Productos'}, array(' / ' => ', '))); ?></p>
                            <p class="servicios"><span>Servicios: </span><?php echo ucwords(strtr($r->{'Servicios'}, array(' / ' => ', ')));?></p>
                            <div class="dir">
                                <div class="link-directorio" onclick="show(this)">
                                    <p>Ver Telefonos</p>
                                </div>
                                <div class="link-directorio2">
                                    <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 1'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 1'}) ?></a>
                                    <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 2'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 2'}) ?></a>
                                    <a href="tel:<?php echo humanize_phone($r->{'Teléfono de Contacto 3'}) ?>"><?php echo humanize_phone($r->{'Teléfono de Contacto 3'}) ?></a>
                                </div>
                            </div>

                            <p class="descripcion"><span>Descripción: </span>Venta de respuesto para Jeep Originales de Planta mopar, ejemplp.</p>
                            <p class="ubicacion"><i class="fa fa-map-marker-alt"></i><a href="javascript:void(0)"><?= ucwords(mb_strtolower($r->{'Parroquia'})) ?> <?= ucwords(mb_strtolower($r->{'Municipio'})) ?> <?= ucwords(mb_strtolower($r->{'Estado'})) ?></a> </p>
                        </div>
                    </div>
                <?php }}?>
            </div>

            <div class="cont-banner2">
                <div class="banner1">
                    <div class="image">
                        <a href="javascript:void(0)">
                            <img loading="lazy" src="http://localhost/bienfino2022copia/img/anunciate.gif" alt="<?php echo $r->ID; ?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--container-->
    <?php if (isset($table['data']) and count($table['data']) == 0) { ?>
        <section class="directorio" style="padding: 50px 0;">
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
<div class="modal3" id="modal3">
    <div class="modal-container">
        <div class="modal-header">
            <div class="texto-compartir">
                <p>Tu cuenta aún no ah sido confirmada</p>
            </div>
            <div class="contenedor-botton">
                <button class="btn-cerrar-modal2" id="btn-cerrar-modal2">X</button>
            </div>
        </div>
        <div class="modal-iconos">
            <p>Filtro</p>
            <div class="menu-lateral active" id="menu-lateral">
                <div class="cont-filtros-busqueda">
                    <?php
                    if (isset($categorias) and $categorias != "") {
                        foreach ($categorias as $key => $categoria) {
                            if ($categoria->id_categoria == $this->session->userdata('categoria')) {
                                echo '<span class="label-filtro">' . ucwords(strtolower($categoria->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(1)"></i></span>';
                            }
                        }
                    }
                    if (isset($estados) and $estados != "") {
                        foreach ($estados as $key => $estado) {
                            if ($estado->codigoestado == $this->session->userdata('estado')) {
                                echo '<span class="label-filtro">' . ucwords(strtolower($estado->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(2)"></i></span>';
                            }
                        }
                    }
                    if (isset($municipios) and $municipios != "") {
                        foreach ($municipios as $key => $municipio) {
                            if ($municipio->codigomunicipio == $this->session->userdata('municipio')) {
                                echo '<span class="label-filtro">' . ucwords(strtolower($municipio->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(3)"></i></span>';
                            }
                        }
                    }
                    if (isset($parroquias) and $parroquias != "") {
                        foreach ($parroquias as $key => $parroquia) {
                            if ($parroquia->codigoparroquia == $this->session->userdata('parroquia')) {
                                echo '<span class="label-filtro">' . ucwords(strtolower($parroquia->nombre)) . '<i class="fas fa-times" onclick="limpiarFiltro(4)"></i></span>';
                            }
                        }
                    }
                    if (isset($modelos) and $modelos != "") {
                        foreach ($modelos as $key => $modelo) {
                            if ($modelo->id_modelo == $this->session->userdata('modelo')) {
                                echo '<span class="label-filtro">' . ucwords(strtolower($modelo->modelo)) . '<i class="fas fa-times" onclick="limpiarFiltro(7)"></i></span>';
                            }
                        }
                    }
                    if (isset($marcas) and $marcas != "") {
                        foreach ($marcas as $key => $marca) {
                            if ($marca->id_marca == $this->session->userdata('marca')) {
                                echo '<span class="label-filtro">' . ucwords(strtolower($marca->marca)) . '<i class="fas fa-times" onclick="limpiarFiltro(6)"></i></span>';
                            }
                        }
                    }
                    if ($this->session->userdata('anio')) {
                        echo '<span class="label-filtro">' . $this->session->userdata("anio") . '<i class="fas fa-times" onclick="limpiarFiltro(8)"></i></span>';
                    }
                    if ($this->session->userdata('precio')) {
                        echo '<span class="label-filtro">' . $this->session->userdata("precio") . ' $<i class="fas fa-times" onclick="limpiarFiltro(9)"></i></span>';
                    }
                    if ($this->session->userdata('km')) {
                        echo '<span class="label-filtro">' . $this->session->userdata("km") . ' km<i class="fas fa-times" onclick="limpiarFiltro(10)"></i></span>';
                    }

                    ?>

                </div>

                <?php if (!$this->session->userdata("estado")) { ?>
                    <div class="select-ubicacion">
                        <h3>Ubicación Estado<i class="fa fa-caret-down"></i></h3>
                        <ul>
                            <?php
                            if (isset($estados) and $estados != "") {
                                foreach ($estados as $key => $estado) {
                                    echo '<li><a href="' . base_url() . 'buscar?estado=' . $estado->codigoestado . '">' . ucwords(strtolower($estado->nombre)) . '</a></li>';
                                }
                            } else {
                                echo '<li><a href="#">Sin opciones</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if ($this->session->userdata("estado") && !$this->session->userdata("municipio")) { ?>
                    <div class="select-ubicacion">
                        <h3>Ubicación Municipio<i class="fa fa-caret-down"></i></h3>
                        <ul>
                            <?php
                            if (isset($municipios) and $municipios != "") {
                                foreach ($municipios as $key => $municipio) {
                                    echo '<li><a href="' . base_url() . 'buscar?municipio=' . $municipio->codigomunicipio . '">' . ucwords(strtolower($municipio->nombre)) . '</a></li>';
                                }
                            } else {
                                echo '<li><a href="#">Sin opciones</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if ($this->session->userdata("estado") && $this->session->userdata("municipio") && !$this->session->userdata("parroquia")) { ?>
                    <div class="select-ubicacion">
                        <h3>Ubicación Parroquia<i class="fa fa-caret-down"></i></h3>
                        <ul>
                            <?php
                            if (isset($parroquias) and $parroquias != "") {
                                foreach ($parroquias as $key => $parroquia) {
                                    echo '<li><a href="' . base_url() . 'buscar?parroquia=' . $parroquia->codigoparroquia . '">' . ucwords(strtolower($parroquia->nombre)) . '</a></li>';
                                }
                            } else {
                                echo '<li><a href="#">Sin opciones</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if (!$this->session->userdata("categoria")) { ?>
                    <div class="select-categoria">
                        <h3>Vehiculo<i class="fa fa-caret-down"></i></h3>
                        <ul>
                            <?php
                            if (isset($categorias) and $categorias != "") {
                                foreach ($categorias as $key => $categoria) {
                                    echo '<li><a href="' . base_url() . 'buscar?categoria=' . $categoria->id_categoria . '">' . ucwords(strtolower($categoria->nombre)) . '</a></li>';
                                }
                            } else {
                                echo '<li><a href="#">Sin opciones</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if (!$this->session->userdata("marca")) { ?>
                    <div class="select-marca">
                        <h3>Marca<i class="fa fa-caret-down"></i></h3>
                        <ul>
                            <?php
                            if (isset($marcas) and $marcas != "") {
                                foreach ($marcas as $key => $marca) {
                                    echo '<li><a href="' . base_url() . 'buscar?marca=' . $marca->id_marca . '">' . ucwords(strtolower($marca->marca)) . '</a></li>';
                                }
                            } else {
                                echo '<li><a href="#">Sin opciones</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if ($this->session->userdata("marca")) { ?>
                    <?php if (!$this->session->userdata("modelo")) { ?>
                        <div class="select-modelo">
                            <h3>Modelo<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if (isset($modelos) and $modelos != "") {
                                    foreach ($modelos as $key => $modelo) {
                                        echo '<li><a href="' . base_url() . 'buscar?modelo=' . $modelo->id_modelo . '">' . ucwords(strtolower($modelo->modelo)) . '</a></li>';
                                    }
                                } else {
                                    echo '<li><a href="#">Sin opciones</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                <?php }
                } ?>
                <?php if (!$this->session->userdata("anio")) { ?>
                    <div class="select-anio">
                        <h3>Año<i class="fa fa-caret-down"></i></h3>
                        <ul>
                            <?php
                            if (isset($anio) and $anio != "") {
                                foreach ($anio as $key => $ano) {
                                    echo "<li><a href='" . base_url() . "buscar?anio=" . $ano->id_ano . "'>" . $ano->id_ano . "</a></li>";
                                }
                            }
                            ?>

                        </ul>
                    </div>
                <?php } ?>
                <div class="select-precio">
                    <h3>Precio<i class="fa fa-caret-down"></i></h3>
                    <ul>
                        <li><a href="<?php echo base_url() . 'buscar?precio=' . '_500' ?>">Hasta $500</a></li>
                        <li><a href="<?php echo base_url() . 'buscar?precio=' . '_1000' ?>">Hasta $1000</a></li>
                        <li><a href="<?php echo base_url() . 'buscar?precio=' . '_3000' ?>">Hasta $3000</a></li>
                        <li><a href="<?php echo base_url() . 'buscar?precio=' . '5000_15000' ?>">$5000 a $15.000</a></li>
                        <li><a href="<?php echo base_url() . 'buscar?precio=' . '15000_' ?>">Más de $15.000</a></li>
                    </ul>
                </div>
                <!--
                            <div class="select-vendedor">
                                <h3>Vendedor<i class="fa fa-caret-down"></i></h3>
                                <ul>
                                    <li><a href="">Autolavados</a></li>
                                    <li><a href="">Consecionarios</a></li>
                                    <li><a href="">Certificados BF</a></li>
                                    <li><a href="">Particulares</a></li>
                                </ul>                      
                            </div>
                            -->
                <div class="select-kilometros">
                    <h3>Kilómetros<i class="fa fa-caret-down"></i></h3>
                    <ul>
                        <li><a href="<?php echo base_url() . 'buscar?km=' . '_0_' ?>">Cero Km</a></li>
                        <li><a href="<?php echo base_url() . 'buscar?km=' . '_50000' ?>">Hasta 50.000km</a></li>
                        <li><a href="<?php echo base_url() . 'buscar?km=' . '_100000' ?>">Hasta 100.000km</a></li>
                        <li><a href="<?php echo base_url() . 'buscar?km=' . '_200000' ?>">Hasta 200.000km</a></li>
                    </ul>
                </div>
                <!--
                            <div class="select-blindado">
                                <h3>Blindaje<i class="fa fa-caret-down"></i></h3>
                                <ul>
                                    <li><a href="">Ninguno</a></li>
                                    <li><a href="">Nivel 1</a></li>
                                    <li><a href="">Nivel 2</a></li>
                                    <li><a href="">Nivel 3</a></li>
                                    <li><a href="">Nivel 4</a></li>
                                    <li><a href="">Nivel 5</a></li>
                                </ul> 
                            </div>
                            -->
            </div>

        </div>
    </div>
</div>
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