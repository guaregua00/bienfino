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

<?php 
var_dump($this->session->flashdata('mensajecompletado'));
?>