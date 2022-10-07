<?php $this->load->view('adm/Vheader'); ?>
<?php $this->load->view('app/js'); ?>
<?php $this->load->view('app/css'); ?>

<script type="text/javascript">

$(window).on('beforeunload', function() {

   window.setTimeout(function() {
    $(window).scrollTop(0); 
}, 0);

});

</script>

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
                    <li class="active">Dashboard</li>
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
                        <div class="alert alert-sdanger"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
                    </div>
                </div>
            <?php } ?>
            
            <section class="content">
                <div class="row">
                    <div class="col-md-12 body">
                        <?php $this->load->view('directorio/directorio_insert'); ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>    
<?php $this->load->view('adm/Vfooter'); ?>