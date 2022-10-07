<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrador
            <small>Panel de Control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>Cadministrador"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Agregar Pago Directorio</li>
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
            <div class="col-md-6 col-xs-12 col-md-offset-3">

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Agregar Pago a directorio</h3>
                    </div>
                    <?php if($id){?>
                    <form class="form-horizontal" id="addPagoDirectorio" action="<?php echo base_url(); ?>addPagoDirectorio" method="POST">
                        <div class="box-body">


                            <input type="hidden" name="id" type="number" value="<?php echo $id;?>">
                            <div class="form-group">
                                <div class="col-sm-6 col-md-offset-3" id="div-metodo-pago">
                                    <label for="metodo-pago" class="control-label">Metodo de Pago <span class="text-red">(*)</span></label>
                                    <select class="form-control" name="metodo-pago" id="metodo-pago" required>
                                        <option selected value="">Seleccione Metodo de Pago</option>
                                        <option value='Pago Móvil'>Pago Móvil</option>
                                        <option value='Transferencia'>Transferencia</option>
                                        <option value='Efectivo'>Efectivo</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-md-offset-3" id="div-banco-origen">
                                    <label for="banco-origen" class="control-label">Banco Origen <span class="text-blue">(*)</span></label>
                                    <select class="form-control" name="banco-origen" id="banco-origen" required>
                                        <option selected value="">Seleccione un Banco</option>
                                        <option value='banesco'>Banesco</option>
                                        <option value='provincial'>Provincial</option>
                                        <option value='mercantil'>Mercantil</option>
                                        <option value='banco-venezuela'>Banco de Venezuela</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-md-offset-3" id="div-banco-destino">
                                    <label for="banco-destino" class="control-label">Banco Destino <span class="text-blue">(*)</span></label>
                                    <select class="form-control" name="banco-destino" id="banco-destino" required>
                                        <option selected value="">Seleccione un Banco</option>
                                        <option value='banesco'>Banesco</option>
                                        <option value='provincial'>Provincial</option>
                                        <option value='mercantil'>Mercantil</option>
                                        <option value='banco-venezuela'>Banco de Venezuela</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-md-offset-3" id="div-monto">
                                    <label for="monto" class="control-label">Monto<span class="text-red">(*)</span></label>
                                    <input type="text" class="form-control" name="monto" id="monto" minlength="" placeholder="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-md-offset-3" id="div-referencia">
                                    <label for="referencia" class="control-label">Referencia</label>
                                    <input type="text" class="form-control" name="referencia" id="referencia" minlength="4" placeholder="N° de referencia" required>
                                </div>
                            </div>



                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-5">
                                    <button type="submit" id="boton_completar" class="btn btn-info btn-mini">Registrar</button>
                                </div>
                            </div>

                        </div>

                    </form>
                    <?php }?>
                </div>
                <!--box box-info-->

            </div>
            <!--col-md-6 col-xs-12 col-md-offset-3-->
        </div>
        <!--row-->

    </section>

</div>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/jquery.min.js"> </script>