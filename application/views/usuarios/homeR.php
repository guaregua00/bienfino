<main>
    <section class="banner">
        <div class="banner-filtro">
            <div class="banner-content">
                <div class="container">
                    <div class="titulo-principal">
                        <h3 class='title-principal-home'>Compra-Venta</h3>
                        <h3 class='title-principal-home'>de AUTOMÓVILES </h3>
                        <h3 class='title-principal-home'>Directorio Automotriz</h3>
                        <div class="botones">
                            <a href="#directorio" class="btn btn-yellow btn-margin-right"><i class="fas fa-info"></i></i>Directorio</a>
                            <a href="<?php base_url(); ?>registrar" class="btn"><i class="far fa-user"></i>Registrar&nbsp;</a>
                        </div>
                    </div>
                    <div class="formulario">
                        <h2>Selecciona lo que deseas Buscar</h2>

                        <form role="search" action="<?= base_url(); ?>buscar" id="formsearch">

                            <select id="categoria" name="categoria">
                                <option value="">Tipo de vehículos</option>
                                <?php
                                if (isset($categorias) and $categorias != "") {
                                    foreach ($categorias as $key => $categoria) {
                                        echo '<option value="' . $categoria->id_categoria . '">' . ucwords(strtolower($categoria->nombre)) . '</option>';
                                    }
                                }
                                ?>
                            </select>

                            <select id="marca" name="marca">
                                <option value="">Todas las marcas</option>
                                <?php
                                if (isset($marcas) and $marcas != "") {
                                    foreach ($marcas as $key => $marca) {
                                        echo '<option value="' . $marca->id_marca . '">' . ucwords(strtolower($marca->marca)) . '</option>';
                                    }
                                }
                                ?>

                            </select>

                            <select id="modelo" name="modelo">
                                <option value="">Todos los modelos</option>
                            </select>

                            <select id="anio" name="anio">
                                <option value="">Año</option>
                                <?php
                                if (isset($anio) and $anio != "") {
                                    foreach ($anio as $key => $ano) {
                                        echo '<option value="' . $ano->id_ano . '">' . ucwords(strtolower($ano->id_ano)) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <select id="precio" name="precio">
                                <option value="">Precio</option>
                                <option value="_2000">Hasta $2000</option>
                                <option value="_5000">Hasta $5000</option>
                                <option value="5000_15000">$5000 a $15.000</option>
                                <option value="15000_">Más de $15.000</option>
                            </select>
                            <!--<button class="btn btn-yellow"><i class="fas fa-search"></i>Buscar</button>-->
                            <a href="javascript:sendFormSearch()" class="btn btn-yellow"><i class="fas fa-search"></i>Buscar</a>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="elementor-shape elementor-shape-bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                <path class="elementor-shape-fill" d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z"></path>
            </svg>
        </div>

    </section>
    <!--
        <section class="imagen-principal">

            <div class="container">
                <div class="titulo-principal">
                    <h3>Compra Venta</h3>
                    <h3>de AUTOMÓVILES </h3>
                    <div class="botones">
                        <a href="javascript:void(0)" class="btn btn-yellow btn-margin-right"><i
                                class="fas fa-play"></i>Vender</a>
                        <a href="javascript:void(0)" class="btn"><i class="fas fa-info"></i>Ayuda&nbsp;</a>
                    </div>

                </div>
                <div class="formulario">
                    <h2>Selecciona lo que deseas Buscar</h2>

                    <form role="search">

                        <select>
                            <option value="">Carros y camionetas</option>
                            <option value="">Carros</option>
                            <option value="">Camionetas</option>
                        </select>

                        <select>
                            <option value="">Todas las marcas</option>
                            <option value="">Audi</option>
                            <option value="">Chevrolet</option>

                        </select>

                        <select>
                            <option value="">Todos los modelos</option>
                        </select>

                        <select>
                            <option value="">Año desde</option>
                        </select>

                        <select>
                            <option>Año hasta</option>
                        </select>
                        <a href="javascript:void(0)" class="btn btn-yellow"><i class="fas fa-search"></i>Buscar</a>
                    </form>


                </div>

            </div>
        </section>
    -->
    <section class="directorio" id="directorio" style="padding: 100px 0;">

        <div class="container titulo-section">
            <h2>Encuentra tu Repuesto<span class="heading-color"> </span></h2>
            <p class="heading-text">Concesionarios, Productos o Servicios Automotrices </p>
        </div>

        <form id="formdir" action="<?php echo base_url() ?>resultadodirectorio" method="get">
            <div class="search-form">
                <div class="margin-right">
                    <label></label>
                    <input type="text" name="buscador" minlength="3" id="buscador" class="input-search2" placeholder="Busca Empresas, Repuestos o Servicios" autocomplete="off" required>
                </div>
                <div class="">
                    <label></label>
                    <select class="input-select" name="codigoestado_directorio" id="codigoestado_directorio">
                        <option selected="selected" value="">Seleccione un estado</option>
                        <?php
                        foreach ($estados as $value) {
                        ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="hidden" name="nueva_busqueda" value="1" />
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

                    <!--<select class="input-select" name="estado_id">
                        <option value="0" selected>Seleccione el Estado</option>
                        <option value="2">Amazonas</option>
                        <option value="3">Anzoategui</option>
                        <option value="4">Apure</option>
                        <option value="5">Aragua</option>
                        <option value="6">Barinas</option>
                        <option value="7">Bolívar</option>
                        <option value="8">Carabobo</option>
                        <option value="9">Cojedes</option>
                        <option value="24">Delta Amacuro</option>
                        <option value="10">Falcón</option>
                        <option value="31">Falcón (Morrocoy)</option>
                        <option value="34">Falcón (Paraguaná)</option>
                        <option value="1">Gran Caracas</option>
                        <option value="11">Guarico</option>
                        <option value="12">Lara</option>
                        <option value="13">Mérida</option>
                        <option value="14">Miranda</option>
                        <option value="26">Miranda (Altos Mirandinos)</option>
                        <option value="28">Miranda (Barlovento)</option>
                        <option value="33">Miranda (Guarenas / Guatire)</option>
                        <option value="27">Miranda (Valles del Tuy)</option>
                        <option value="15">Monagas</option>
                        <option value="16">Nueva Esparta</option>
                        <option value="17">Portuguesa</option>
                        <option value="18">Sucre</option>
                        <option value="19">Tachira</option>
                        <option value="20">Trujillo</option>
                        <option value="21">Vargas</option>
                        <option value="22">Yaracuy</option>
                        <option value="23">Zulia</option>
                        <option value="32">Zulia (Costa Oriental de Lago)</option>
                    </select> -->
                    <button type="submit" class="btn btn-yellow">Enviar</button>
                </div>
            </div>
        </form>
        <div class="categorias-directorio">
            <!--
            <a class="list-search" title="Buscar bienfino.com" href="<?php echo base_url() ?>resultadodirectorio?buscador=servicio 1&nueva_busqueda=1">Servicio 1</a>
            <a class="list-search" title="Buscar bienfino.com" href="<?php echo base_url() ?>resultadodirectorio?buscador=servicio 2&nueva_busqueda=1">Servicio 2</a>
            <a class="list-search" title="Buscar bienfino.com" href="<?php echo base_url() ?>resultadodirectorio?buscador=servicio 3&nueva_busqueda=1">Servicio 3</a>
            <a class="list-search" title="Buscar bienfino.com" href="<?php echo base_url() ?>resultadodirectorio?buscador=servicio 4&nueva_busqueda=1">Servicio 4</a>
            -->
        </div>

    </section>

<div class="elementor-shape2 elementor-shape-top" data-negative="true">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"> <path class="elementor-shape-fill" d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z"></path> </svg>
        </div>
    <section class="vehiculos-publicaciones">

        <div class="container titulo-section">
            <h2 class="">Autos Destacados<span class="heading-color"> </span></h2>
            <p class="heading-text"></p>
        </div>


        <div class="carousel container">
            <div class="carousel__container">
                <button aria-label="Anterior" class="carousel_anterior"><i class="fas fa-chevron-left"></i></button>
                <div class="carousel__list">

                    <?php
                    if (isset($publicaciones) && $publicaciones != "") {
                        foreach ($publicaciones as $key => $publicacion) {
                    ?>
                            <div class="grid">

                                <div class="title-area">
                                    <!--<div class="category-title">
                                    <span class="padding_cats"><a href=""><?= mb_strtoupper($publicacion->marca) ?></a></span>
                                    <span class="padding_cats"><a href=""><?= mb_strtoupper($publicacion->modelo) ?></a></span>
                                </div>-->
                                    <h3><a href=""><?= $publicacion->id_ano . ' ' . ucwords(strtolower($publicacion->modelo)) . ' ' . mb_strtoupper($publicacion->marca) ?></a></h3>
                                    <p class="location"><i class="fa fa-map-marker-alt"></i><a href=""><?= mb_strtoupper($publicacion->parroquia) ?></a>, <a href=""><?= mb_strtoupper($publicacion->estado) ?></a></p>
                                </div>


                                <div class="image" onclick="cargarVista('detallepublicacion/<?php echo $publicacion->id_publicacion; ?>')">
                                    <a href="<?php echo base_url(); ?>detallepublicacion/<?php echo $publicacion->id_publicacion; ?>">
                                        <img loading="lazy" src="<?php echo base_url() . "publicaciones/" . trim($publicacion->codigo) . "/" . $publicacion->url_uno; ?>" alt="<?php echo $publicacion->modelo; ?>" class="img-responsive">
                                    </a>
                                    <div class="price-tag">
                                        <div class="price"><span class="precio">$<?= mb_strtoupper($publicacion->precio_dol) ?></span><span class="nego"></span></div>
                                    </div>
                                </div>

                                <div class="short-description">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-tachometer-alt"></i><?php echo $publicacion->recorrido; ?> km</li>
                                        <li><i class="fas fa-calendar-alt"></i><?php echo $publicacion->id_ano; ?></li>
                                        <?php if ($publicacion->transmision != "") { ?><li><i class="fas fa-cogs"></i><?php echo $publicacion->transmision; ?></li><?php } ?>
                                        <li><i class="fas fa-calendar-alt"></i>Negociable: <?php echo ucwords(strtolower($publicacion->negociable)); ?></li>
                                    </ul>
                                </div>
                                <!--
                            <div class="ad-info">
                                <p><i class="flaticon-calendar"></i> &nbsp;<span>January 24, 2019</span> </p>
                                <ul class="pull-right">
                                    <li> <a data-toggle="tooltip" data-placement="top" data-original-title="Saved Ad"
                                            href="javascript:void(0);" class="save-ad" data-adid="1552"><i
                                                class="fas fa-share-alt"></i></a>
                                        <input type="hidden" id="fav_ad_nonce" value="404a6064b2"> </li>
                                </ul>
                            </div>
                            -->
                            </div>
                    <?php }
                    } else {
                        echo "No existen registros";
                    } ?>
                </div>

                <button aria-label="Siguiente" class="carousel_siguiente"><i class="fas fa-chevron-right"></i></button>

            </div>
            <div role="tablist" class="carousel__indicadores"></div>
        </div>

        <div class="container titulo-section margin-top-80">
            <h2>Camionetas Destacadas<span class="heading-color"> </span></h2>
            <p class="heading-text"></p>
        </div>
        <div class="carousel container">
            <div class="carousel__container">
                <button aria-label="Anterior" class="carousel_anterior" id="carousel_anterior2"><i class="fas fa-chevron-left"></i></button>
                <div class="carousel__list2">

                    <?php
                    if (isset($publicaciones2) && $publicaciones2 != "") {
                        foreach ($publicaciones2 as $key => $publicacion2) {
                    ?>
                            <div class="grid">

                                <div class="title-area">
                                    <!-- <div class="category-title">
                                    <span class="padding_cats"><a href=""><?= mb_strtoupper($publicacion2->marca) ?></a></span>
                                    <span class="padding_cats"><a href=""><?= mb_strtoupper($publicacion2->modelo) ?></a></span>
                                </div>-->
                                    <h3><a href=""><?= $publicacion2->id_ano . ' ' . ucwords(strtolower($publicacion2->modelo)) . ' ' . ucwords(strtolower($publicacion2->marca)) ?></a></h3>
                                    <p class="location"><i class="fa fa-map-marker-alt"></i><a href=""><?= mb_strtoupper($publicacion2->parroquia) ?></a>, <a href=""><?= mb_strtoupper($publicacion2->estado) ?></a></p>
                                </div>


                                <div class="image" onclick="cargarVista('detallepublicacion/<?php echo $publicacion2->id_publicacion; ?>')">
                                    <a href="<?php echo base_url(); ?>detallepublicacion/<?php echo $publicacion2->id_publicacion; ?>">
                                        <img loading="lazy" src="<?php echo base_url() . "publicaciones/" . trim($publicacion2->codigo) . "/" . $publicacion2->url_uno; ?>" alt="<?php echo $publicacion2->modelo; ?>" class="img-responsive">
                                    </a>
                                    <div class="price-tag">
                                        <div class="price"><span class="precio">$<?= mb_strtoupper($publicacion2->precio_dol) ?></span><span class="nego"></span></div>
                                    </div>
                                </div>

                                <div class="short-description">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-tachometer-alt"></i><?php echo $publicacion2->recorrido; ?> km</li>
                                        <li><i class="fas fa-calendar-alt"></i><?php echo $publicacion2->id_ano; ?></li>
                                        <?php if ($publicacion->transmision != "") { ?><li><i class="fas fa-cogs"></i><?php echo $publicacion->transmision; ?></li><?php } ?>
                                        <li><i class="fas fa-calendar-alt"></i>Negociable: <?php echo ucwords(strtolower($publicacion2->negociable)); ?></li>
                                    </ul>
                                </div>
                                <!--
                            <div class="ad-info">
                                <p><i class="flaticon-calendar"></i> &nbsp;<span>January 24, 2019</span> </p>
                                <ul class="pull-right">
                                    <li> <a data-toggle="tooltip" data-placement="top" data-original-title="Saved Ad"
                                            href="javascript:void(0);" class="save-ad" data-adid="1552"><i
                                                class="fas fa-share-alt"></i></a>
                                        <input type="hidden" id="fav_ad_nonce" value="404a6064b2"> </li>
                                </ul>
                            </div>
                            -->
                            </div>
                    <?php }
                    } else {
                        echo "No existen registros";
                    } ?>

                </div>

                <button aria-label="Siguiente" class="carousel_siguiente" id="carousel_siguiente2"><i class="fas fa-chevron-right"></i></button>

            </div>
            <div role="tablist" class="carousel__indicadores" id="carousel__indicadores2"></div>
        </div>
    </section>

    <section class="search-marcas">
        <div class="container titulo-section">
            <h2 class="padding-top-80">Buscar por <span class="heading-color"> Marcas</span></h2>
            <p class="heading-text"></p>
        </div>

        <div class="carousel container">
            <div class="carousel__container">
                <button aria-label="Anterior" class="carousel_anterior" id="carousel_anterior3"><i class="fas fa-chevron-left"></i></button>
                <div class="carousel__list3">
                    <a href="<?php echo base_url(); ?>buscar?marca=2">
                        <img loading="lazy" src="<?php echo base_url(); ?>asset/img/logos-marcas/chevrolet.png" alt="">
                    </a>
                    <a href="<?php echo base_url(); ?>buscar?marca=19">
                        <img loading="lazy" src="<?php echo base_url(); ?>asset/img/logos-marcas/ford.png" alt="">
                    </a>
                    <a href="<?php echo base_url(); ?>buscar?marca=6">
                        <img loading="lazy" src="<?php echo base_url(); ?>asset/img/logos-marcas/chery.png" alt="">
                    </a>
                    <a href="<?php echo base_url(); ?>buscar?marca=3">
                        <img loading="lazy" src="<?php echo base_url(); ?>asset/img/logos-marcas/fiat.png" alt="">
                    </a>
                    <a href="<?php echo base_url(); ?>buscar?marca=1">
                        <img loading="lazy" src="<?php echo base_url(); ?>asset/img/logos-marcas/toyota.png" alt="">
                    </a>
                    <a href="<?php echo base_url(); ?>buscar?marca=9">
                        <img loading="lazy" src="<?php echo base_url(); ?>asset/img/logos-marcas/honda.png" alt="">
                    </a>
                    <a href="<?php echo base_url(); ?>buscar?marca=11">
                        <img loading="lazy" src="<?php echo base_url(); ?>asset/img/logos-marcas/jeep.png" alt="">
                    </a>
                    <a href="<?php echo base_url(); ?>buscar?marca=10">
                        <img loading="lazy" src="<?php echo base_url(); ?>asset/img/logos-marcas/renault.png" alt="">
                    </a>

                </div>
                <button aria-label="Siguiente" class="carousel_siguiente" id="carousel_siguiente3"><i class="fas fa-chevron-right"></i></button>

            </div>
            <div role="tablist" class="carousel__indicadores" id="carousel__indicadores3"></div>
        </div>
        <!--                        
            <div class="container box">
                <a href="#">
                    <img loading="lazy" src="img/logos-marcas/chevrolet.png" alt="">

                </a>
                <a href="">
                    <img loading="lazy" src="img/logos-marcas/ford.png" alt="">

                </a>
                <a href="">
                    <img loading="lazy" src="img/logos-marcas/chery.png" alt="">

                </a>
                <a href="">
                    <img loading="lazy" src="img/logos-marcas/fiat.png" alt="">

                </a>
                <a href="">
                    <img loading="lazy" src="img/logos-marcas/toyota.png" alt="">

                </a>
                <a href="">
                    <img loading="lazy" src="img/logos-marcas/honda.png" alt="">

                </a>
                <a href="">
                    <img loading="lazy" src="img/logos-marcas/jeep.png" alt="">

                </a>
                <a href="">
                    <img loading="lazy" src="img/logos-marcas/renault.png" alt="">

                </a>
            </div>
        -->
    </section>
    <!--<div class="loader">
        <div class="lds-dual-ring"></div>
    </div>-->

    <style>

    </style>
</main>

<?php $this->view('layouts/footerR'); ?>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/jquery.min.js"> </script>
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
<script src="<?php echo base_url(); ?>asset/js/glider/glider.js"></script>
<script src="<?php echo base_url(); ?>js/categoria_home.js"></script>

<script>
    //menu
    $("#categoria").change(function() {
        buscarMarca();
    });

    $("#marca").change(function() {
        buscarModelo();
    });
</script>



<script>
    window.addEventListener('load', function() {

        //$(".loader").fadeOut("slow");

        new Glider(document.querySelector('.carousel__list'), {
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: true,
            dots: '.carousel__indicadores',
            arrows: {
                prev: '.carousel_anterior',
                next: '.carousel_siguiente'
            },
            responsive: [{
                // screens greater than >= 775px
                breakpoint: 800,
                settings: {
                    // Set to `auto` and provide item width to adjust to viewport
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    itemWidth: 150,
                    duration: 0.25
                }
            }, {
                // screens greater than >= 1024px
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    itemWidth: 150,
                    duration: 0.25
                }
            }]
        });
        new Glider(document.querySelector('.carousel__list2'), {
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: true,
            dots: '#carousel__indicadores2',
            arrows: {
                prev: '#carousel_anterior2',
                next: '#carousel_siguiente2'
            },
            responsive: [{
                // screens greater than >= 775px
                breakpoint: 800,
                settings: {
                    // Set to `auto` and provide item width to adjust to viewport
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    itemWidth: 150,
                    duration: 0.25
                }
            }, {
                // screens greater than >= 1024px
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    itemWidth: 150,
                    duration: 0.25
                }
            }]
        });
        new Glider(document.querySelector('.carousel__list3'), {
            slidesToShow: 2,
            slidesToScroll: 2,
            draggable: true,
            dots: '#carousel__indicadores3',
            arrows: {
                prev: '#carousel_anterior3',
                next: '#carousel_siguiente3'
            },
            responsive: [{
                // screens greater than >= 775px
                breakpoint: 800,
                settings: {
                    // Set to `auto` and provide item width to adjust to viewport
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    itemWidth: 150,
                    duration: 0.25
                }
            }, {
                // screens greater than >= 1024px
                breakpoint: 1024,
                settings: {
                    slidesToShow: 7,
                    slidesToScroll: 2,
                    itemWidth: 150,
                    duration: 0.25
                }
            }]
        });
    });
</script>

<script>
    window.addEventListener('load', function() {


        document.querySelector('.glider').addEventListener('glider-slide-visible', function(event) {
            var glider = Glider(this);
            console.log('Slide Visible %s', event.detail.slide)
        });
        document.querySelector('.glider').addEventListener('glider-slide-hidden', function(event) {
            console.log('Slide Hidden %s', event.detail.slide)
        });
        document.querySelector('.glider').addEventListener('glider-refresh', function(event) {
            console.log('Refresh')
        });
        document.querySelector('.glider').addEventListener('glider-loaded', function(event) {
            console.log('Loaded')
        });

        window._ = new Glider(document.querySelector('.glider'), {
            slidesToShow: 4, //'auto',
            slidesToScroll: 4,
            itemWidth: 150,
            draggable: true,
            scrollLock: false,
            dots: '#dots',
            rewind: true,
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            },
            responsive: [{
                    breakpoint: 800,
                    settings: {
                        slidesToScroll: 'auto',
                        itemWidth: 300,
                        slidesToShow: 'auto',
                        exactWidth: true
                    }
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToScroll: 4,
                        slidesToShow: 4,
                        dots: false,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToScroll: 3,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToScroll: 2,
                        slidesToShow: 2,
                        dots: false,
                        arrows: false,
                        scrollLock: true
                    }
                }
            ]
        });
    });
</script>

<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
<?php $this->view('layouts/alertify'); ?>
</body>

</html>