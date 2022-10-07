<div class="contenedor">
		<div class="flex-row">
<?php $publicacion_gratis = true?>
			<div class="panel">
				<span class="check-success">Operación Exitosa!</span>
        <?php if($publicacion_gratis){?>
                <h2>¡Publicación Gratis creada correctamente!</h2>
         				<p>Una vez verificadas las fotos e información, se procede a activarlar.<p>
      <?php }else{?>
        <h2>¡Contactanos via Whatsapp!</h2>
                <h2>Publicación nro: <?php echo $id_publicacion;?></h2>
         				<p>Tu publicación se ha creado correctamente, debes indicarnos tu número de cédula, número de publicación y comprobante de pago a nuestro Whatsapp, 
            una vez verificada la información se procede a ACTIVAR.<p>
            <a href="https://api.whatsapp.com/send?phone=5804120269878"><i class="fab fa-whatsapp"></i></a>
        <?php }?>
            <div class="flex-row">
                <div class="group-text-field">
                  <a href="<?php echo base_url();?>publicar" class="btn btn-back">Volver a publicar</a>
                </div>
                <div class="group-text-field">
                  <a class="btn btn-success" href="<?php echo base_url();?>misPublicacionesExito" role="button">Ir a mis Publicaciones</a>             
                </div>
            </div>

			</div>
		</div>

</div>

<?php
  $this->load->view('layouts/footerR');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script> 
<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
  



<script src="<?= base_url(); ?>Bienfino-master/upload/alertifyjs/alertify.js"></script>
<script type="text/javascript">
    //override defaults
    alertify.defaults.transition = "zoom";
    alertify.defaults.theme.ok = "ui positive button";
    alertify.defaults.theme.cancel = "ui black button";



    if (!alertify.myAlert) {
        //define a new dialog
        alertify.dialog('myAlert', function factory() {
            return {
                main: function(message) {
                    this.message = message;
                },
                setup: function() {
                    return {
                        buttons: [{
                            text: "ok",
                            key: 27 /*Esc*/
                        }],
                        focus: {
                            element: 0
                        }
                    };
                },
                prepare: function() {
                    this.setContent(this.message);
                }
            }
        });
    }
    if (!alertify.errorAlert) {
        //define a new errorAlert base on alert
        alertify.dialog('errorAlert', function factory() {
            return {
                build: function() {
                    var errorHeader = '<span class="fa fa-times-circle fa-2x" ' +
                        'style="vertical-align:middle;color:#e10000;">' +
                        '</span> Ocurrio un error';
                    this.setHeader(errorHeader);
                }
            };
        }, true, 'alert');
    }
</script>


<?php if ($this->session->flashdata('mensajePublicar')) { ?>
    <script>
        alertify.errorAlert();
        alertify.alert('Notificación', '<?= $this->session->flashdata('mensajePublicar') ?>');
    </script>
<?php } ?>

<?php if ($this->session->flashdata('mensaje')) { ?>
    <script>
        alertify.alert('Notificación', '<?= $this->session->flashdata('mensaje') ?>');
    </script>
<?php } ?>

<?php if ($this->session->flashdata('mensajeExito')) { ?>
    <script>
        alertify.success('Operación Exitosa!');
        alertify.alert('Exito!', '<?= $this->session->flashdata('mensajeExito') ?>');
    </script>
<?php } ?>

<?php if ($this->session->flashdata('mensaje2')) { ?>
    <script>
        alertify.errorAlert();
        alertify.alert('Notificación', '<?= $this->session->flashdata('mensaje2') ?>');
    </script>
<?php } ?>

<?php if (isset($mensaje)) { ?>
    <script>
        alertify.errorAlert();
        alertify.alert('Notificación', '<?= $mensaje ?>');
    </script>
<?php } ?>

<?php if (isset($mensaje_cuenta_act)) { ?>
    <script>
        alertify.errorAlert();
        alertify.alert('Notificación', '<?= $mensaje_cuenta_act ?>');
    </script>
<?php } ?>

<?php if ($this->session->flashdata('mensajecompletado')) { ?>
    <script>
        alertify.success('Registro Completo!');
        alertify.alert('Exito!', '<?= $this->session->flashdata('mensajecompletado') ?>');
    </script>
<?php } ?>


</body>
</html>
