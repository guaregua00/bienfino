<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Publicaciones
            <small>Ordenar Fotos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ordenar Fotos</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if ($this->session->flashdata('mensajecompletado')) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success"> <?php echo $this->session->flashdata('mensajecompletado'); ?></div>
                </div>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('mensaje')) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ordenar Fotos Publicación</h3>
                        <h4>id_publicacion: <?php echo $publicacion->id_publicacion?></h4>
                    </div>

                    <form class="form-horizontal" id="ordenar_fotos" action="" method="POST">
                        <div class="box-body">

                            <div class="lista-imagenes" id="lista">

                                <div class="col-md-2" data-id="<?php echo trim($publicacion->url_uno)?>">
                                    <img loading="lazy" class="img-thumbnail" src="<?php echo base_url() . "publicaciones/" . trim($publicacion->codigo) . "/" . $publicacion->url_uno; ?>" alt="foto1">
                                    <span>1</span>
                                </div>
                                <div class="col-md-2" data-id="<?php echo trim($publicacion->url_dos)?>">
                                    <img loading="lazy" class="img-thumbnail" src="<?php echo base_url() . "publicaciones/" . trim($publicacion->codigo) . "/" . $publicacion->url_dos; ?>" alt="foto1">
                                    <span>2</span>
                                </div>
                                <div class="col-md-2" data-id="<?php echo trim($publicacion->url_tres)?>">
                                    <img loading="lazy" class="img-thumbnail" src="<?php echo base_url() . "publicaciones/" . trim($publicacion->codigo) . "/" . $publicacion->url_tres; ?>" alt="foto1">
                                    <span>3</span>
                                </div>
                                <div class="col-md-2" data-id="<?php echo trim($publicacion->url_cuatro)?>">
                                    <img loading="lazy" class="img-thumbnail" src="<?php echo base_url() . "publicaciones/" . trim($publicacion->codigo) . "/" . $publicacion->url_cuatro; ?>" alt="foto1">
                                    <span>4</span>
                                </div>

                                <?php if ($publicacion->url_cinco) { ?>
                                    <div class="col-md-2" data-id="<?php echo trim($publicacion->url_cinco)?>">
                                        <img loading="lazy" class="img-thumbnail" src="<?php echo base_url() . "publicaciones/" . trim($publicacion->codigo) . "/" . $publicacion->url_cinco; ?>" alt="foto1">
                                        <span>5</span>
                                    </div>
                                <?php } ?>

                                <?php if ($publicacion->url_seis) { ?>
                                    <div class="col-md-2" data-id="<?php echo trim($publicacion->url_seis)?>">
                                        <img loading="lazy" class="img-thumbnail" src="<?php echo base_url() . "publicaciones/" . trim($publicacion->codigo) . "/" . $publicacion->url_seis; ?>" alt="foto1">
                                        <span>6</span>
                                    </div>
                                <?php } ?>

                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-5">
                                    <input type="hidden" name="codigo" value="<?= $publicacion->codigo; ?>" />
                                    <input type="hidden" name="id_publicacion" value="<?= $publicacion->id_publicacion; ?>" />
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                    <button type="button" id="boton_procesar" class="btn btn-info btn-mini">Procesar</button>
                                </div>
                            </div>

                        </div>
                        <!--box-body-->
                    </form>
                </div>
                <!--box box-info-->
            </div>
            <!--col-md-6 col-xs-12 col-md-offset-3-->
        </div>
        <!--row-->
    </section>

</div>

<style>
    .lista-imagenes .col-md-2.seleccionado {
        transform: scale(1.02) rotate(-1deg);
        box-shadow: 0px 0px 20px rgba(149, 153, 159, 0.16);
    }

    .lista-imagenes .col-md-2.drag {
        opacity: 0;
    }

    .lista-imagenes img {
        cursor: move;
    }
</style>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var seccion_publicacion = "<?php echo $seccion_publicacion; ?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/jquery.min.js"> </script>
<script src="<?php echo base_url(); ?>js/geo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    //menu
    $("#codigoestado").change(function() {
        buscarMunicipiosadm();
    });
    $("#codigomunicipio").change(function() {
        buscarParroquiaadm();
    });

    function ordenar_fotos(orden) {

        const ordenar_fotos = document.getElementById("ordenar_fotos");
        var data = new FormData(ordenar_fotos);
        for (let i = 0; i < orden.length; i++) {
            data.append("orden"+[i+1], orden[i]);
        }
        /*
        for (const value of data.keys()) {
            console.log(value);
        }
         */
        
        jQuery.ajax({
            url: base_url + 'Cadministrador/ordenarFotos/',
            type: 'POST',
            processData: false,
            contentType: false,
            data: data,
            success: function(response) {

                res = JSON.parse(response);
                console.log(res);
                if (res.result) {
                    window.location.href = base_url + 'Cadministrador/publicaciones/'+ seccion_publicacion;
                }else{
                    location.reload();
                }

            },
            error: function() {
                alert("Error intente de nuevo");
            }
        });
    }


    document.getElementById('boton_procesar').style.display = 'none'; // hide

    $(document).ready(function() {
        localStorage.clear();
        const lista = document.getElementById("lista");

        /* Sortable.create() */
        new Sortable(lista, {
            animation: 150,
            chosenClass: "seleccionado",
            dragClass: 'drag',

            onEnd: () => {
                document.getElementById('boton_procesar').style.display = ''; // show
                //console.log("Se ejecuta al soltar un elemento");
            },
            group: "lista-imagenes",
            store: {
                //guardamos el orden de la lista
                set: (sortable) => {
                    const orden = sortable.toArray();
                    //console.log(orden);
                    localStorage.setItem('orden', orden.join('-')); //.join convierte un array en una cadena de texto para localStorage
                }
                /* ,
                        get: (sortable) => {
                            localStorage.getItem('orden').split('-');
                        } */
            }
        });

        const boton_procesar = document.getElementById("boton_procesar");

        boton_procesar.addEventListener('click', function() {

            const orden = localStorage.getItem('orden').split('-');
            //console.log(orden);
            ordenar_fotos(orden);

        });


    });
</script>