<?php $this->load->view('adm/Vheader'); ?>
<?php $this->load->view('app/css'); ?>
<?php $this->load->view('app/js'); ?>

<body class="body" onload="input_label_watcher()">

    <?php //$this->load->view('directorio/appends'); 
    ?>

    <div class="body-container">

        <div class="content-wrapper">

            <section class="content-header">
                <h1>
                    Usuarios Directorio
                    <small>Panel de Control</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Listar Directorio</li>
                </ol>
            </section>

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
                        <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('mensaje2')) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($_SESSION['ALERT']) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success"> <?php echo $_SESSION['ALERT']; ?></div>
                    </div>
                </div>
            <?php }
            unset($_SESSION['ALERT']) ?>

            <section class="content">
                <div class="row">
                    <div class="col-md-12 body">
                        <table class="table table-bordered" id="">
                            <?php if ($table['data']) : ?>
                                <?php foreach ($table['data'] as $r) : ?>
                                    <tr>

                                        <td class="text-center">
                                            <div class="bold">ID:<?= $r->{'ID'} ?></div>
                                            <div class="flex column gap-1em pt-1em">

                                                <?php if ($r->{'Eliminado'} === 'No') : ?>

                                                    <?php $r->{'Horario_de_Trabajo_Desde_2'} = humanize_time($r->{'Horario de Trabajo Desde'}, 24) ?>
                                                    <?php $r->{'Horario_de_Trabajo_Hasta_2'} = humanize_time($r->{'Horario de Trabajo Hasta'}, 24) ?>
                                                    <button class="button" onclick="load_form( '#update', <?= tohtmljson($r) ?> )">Editar</button>

                                                    <form class="flex" onsubmit="return send({
                                                        'form':		this,
                                                        'action':	'<?= base_url() ?>directorio/delete',
                                                    })">
                                                        <input name="id" value="<?= $r->ID  ?>" class="none">
                                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

                                                        <!-- <button class="button red grow">Eliminar</button> -->
                                                    </form>

                                                    <?php  if(($r->{'estatus'}=='inactivo' or $r->{'estatus'}=='por renovar') and !$r->{'pago'}){?>
                                                        <form class="flex" action='<?= base_url() ?>VaddPagoDirectorio' method="POST">
                                                            <input name="id" value="<?= $r->ID  ?>" class="none">
                                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

                                                            <button class="button red grow">Agregar Pago</button>
                                                        </form>
                                                    <?php } ?>

                                                <?php else : ?>

                                                    <form class="flex" onsubmit="return send({
                                                        'form':		this,
                                                        'action':	'<?= base_url() ?>directorio/restore',
                                                    })">
                                                        <input name="id" value="<?= $r->ID  ?>" class="none">
                                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

                                                        <button class="button green grow">Restaurar</button>
                                                    </form>

                                                <?php endif ?>
                                            </div>
                                        </td>

                                        <?php
                                        if($r->{'estatus'}=='activo'){
                                            
                                          
                                        $timestamp1 = strtotime($r->{'fecha_final'});
                                        $timestamp2 = strtotime("now");

                                        $segundos_diferencia = $timestamp1 - $timestamp2;
                                        $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
                                        $dias_diferencia = abs($dias_diferencia);
                                        $dias_diferencia = floor($dias_diferencia);
                                        //echo "Dias ".$dias_diferencia." ";
                                        $dias_restantes = $dias_diferencia;
                                        }
                                            ?>

                                        <td>
                                            <div class="bold">Estatus:<br>
                                                <?php
                                                if($r->{'estatus'}=='activo'){
                                                    //echo "<span class='text-green'>".mb_strtoupper($r->{'estatus'})."</span><br>";
                                                    echo "<span class='text-green'>Activo</span><br>";
                                                    echo "<span class='text-green'>".$dias_restantes." dias</span>";
                                                }
                                                elseif($r->{'estatus'}=='inactivo')
                                                    echo "<span class='text-red'>INACTIVO</span>";
                                                elseif($r->{'estatus'}=='por renovar')
                                                    echo "<span class='text-red'>".mb_strtoupper($r->{'estatus'})."</span>";
                                                ?>
                                            
                                            </div>
                                        </td>
                                        <?php
                                        if($r->{'estatus'}=='activo'){
                                            ?>
                                        <td>
                                            <div class="bold">Fecha Inicio Activo:<br>
                                                <?php
                                                echo "<span class=''>".humanize_date($r->{'fecha_inicio'}, 'long')."</span><br>";
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="bold">Fecha Final Activo:<br>
                                                <?php
                                                echo "<span class=''>".humanize_date($r->{'fecha_final'}, 'long')."</span><br>";
                                                ?>
                                            </div>
                                        </td>
                                        <?php }?>




                                        <td>
                                            <div class="bold">Pago:<br>
                                                <?php
                                                if ($r->{'pago'}) {
                                                    echo "<span class=''>".$r->{'pago'}."</span>";
                                                }else{
                                                    echo "<span class='text-red'>---</span>";
                                                }
                                                    
                                                ?>
                                            </div>
                                        </td>
                                        <!--<td>
                                            <div class="bold">Pago Creado:<br>
                                                <?php
                                                if ($r->{'fecha_creado'}) {
                                                    echo "<span class=''>".humanize_date($r->{'fecha_creado'}, 'long')."</span>";
                                                }else{
                                                    echo "<span class='text-red'>---</span>";
                                                }
                                                    
                                                ?>
                                            </div>
                                        </td> -->
                                        <?php unset($r->{'Fecha de Creación'}) ?>
                                        <?php unset($r->{'fecha_inicio'}) ?>
                                        <?php unset($r->{'fecha_final'}) ?>
                                        <?php unset($r->{'Última Módificación'}) ?>
                                        <?php unset($r->{'fecha_creado'}) ?>
                                        <?php unset($r->{'pago'}) ?>
                                        <?php unset($r->{'ID'}) ?>
                                        <?php unset($r->{'Nombre'}) ?>
                                        <?php unset($r->{'Eliminado'}) ?>
                                        <?php unset($r->{'estado_id'}) ?>
                                        <?php unset($r->{'municipio_id'}) ?>
                                        <?php unset($r->{'parroquia_id'}) ?>
                                        <?php unset($r->{'Horario_de_Trabajo_Desde_2'}) ?>
                                        <?php unset($r->{'Horario_de_Trabajo_Hasta_2'}) ?>

                                        <?php $r->{'Eliminado'} =
                                            $r->{'Eliminado'} === 'Si' ?
                                            "<span class=\"bold text-red\">{$r->{'Eliminado'}}</span>" :
                                            "<span class=\"bold text-green\">{$r->{'Eliminado'}}</span>"
                                        ?>
                                        <?php $r->{'Fecha de Creación'}            = humanize_date($r->{'Fecha de Creación'}, 'long')                ?>
                                        <?php $r->{'Última Módificación'}        = humanize_date($r->{'Última Módificación'}, 'long')                ?>
                                        <?php $r->{'Teléfono de Contacto 1'}    = humanize_phone($r->{'Teléfono de Contacto 1'})                    ?>
                                        <?php $r->{'Teléfono de Contacto 2'}    = humanize_phone($r->{'Teléfono de Contacto 2'})                    ?>
                                        <?php $r->{'Teléfono de Contacto 3'}    = humanize_phone($r->{'Teléfono de Contacto 3'})                    ?>
                                        <?php $r->{'WhatsApp'}                    = humanize_phone($r->{'WhatsApp'})                                ?>
                                        <?php $r->{'WhatsApp Business'}            = humanize_phone($r->{'WhatsApp Business'})                        ?>
                                        <?php $r->{'Horario de Trabajo Desde'}    = humanize_time($r->{'Horario de Trabajo Desde'}, 12)             ?>
                                        <?php $r->{'Horario de Trabajo Hasta'}    = humanize_time($r->{'Horario de Trabajo Hasta'}, 12)             ?>
                                        <?php $r->{'Preguntas BienFino'}        = strtr($r->{'Preguntas BienFino'}, array(' / ' => '<br>'))     ?>
                                        <?php $r->{'Respuestas BienFino'}        = strtr($r->{'Respuestas BienFino'}, array(' / ' => '<br>'))    ?>
                                        <?php $r->{'Categorias'}                = strtr($r->{'Categorias'}, array(' / ' => '<br>'))                ?>
                                        <?php $r->{'Marcas'}                    = strtr($r->{'Marcas'}, array(' / ' => '<br>'))                    ?>
                                        <?php $r->{'Métodos de Pago'}            = strtr($r->{'Métodos de Pago'}, array(' / ' => '<br>'))        ?>
                                        <?php $r->{'Servicios'}                    = strtr($r->{'Servicios'}, array(' / ' => '<br>'))                ?>
                                        <?php $r->{'Servicios en Promoción'}    = strtr($r->{'Servicios en Promoción'}, array(' / ' => '<br>'))    ?>
                                        <?php $r->{'Productos'}                    = strtr($r->{'Productos'}, array(' / ' => '<br>'))                ?>
                                        <?php $r->{'Productos en Promoción'}    = strtr($r->{'Productos en Promoción'}, array(' / ' => '<br>'))    ?>
                                        <?php $r->{'Archivos'}                    = recursive_files_in(
                                            root_folder . "/storage/directorios/{$r->{'ID'}}/",
                                            'relative_path',
                                            'excursive',
                                            'exclude_folders',
                                            array()
                                        ) ?>
                                        <?php foreach ($r->{'Archivos'} as &$a) {
                                            $a = "<a target=\"_blank\" href=\"" . base_url . "/storage/directorios/{$r->{'ID'}}/{$a}\">{$a}</a>";
                                        } ?>
                                        <?php $r->{'Archivos'} = implode('<br>', $r->{'Archivos'}) ?>

                                        <?php foreach ($r as $c => $v) : ?>
                                            <td>
                                                <div class="bold"><?= $c ?>:</div>
                                                <div><?= is_empty($v) ? '<i class="text-gray">Sin Datos</i>' : $v ?></div>
                                            </td>
                                        <?php endforeach ?>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td class="text-center">Sin resultados</td>
                                </tr>
                            <?php endif ?>
                        </table>
                        <div class="flex wrap cpaginator">
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
                        </p>
                    </div>

                </div>
            </section>


            <section class="content">
                <div class="row">
                    <div class="col-md-12 body">
                        <?php $this->load->view('directorio/directorio_update'); ?>
                    </div>
                </div>
            </section>
        </div>


    </div>
</body>
<?php $this->load->view('adm/Vfooter'); ?>