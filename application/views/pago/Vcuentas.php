
    <div class="contenedor">
        <div class="flex-col">
            <div class="titulo-descripcion text-lg line-none">
                <label>Cuentas Bancarias</label>
                <span>Elije la m&aacute;s comoda para realizar tu transferencia</span>
            </div>
        </div>
        <div class="flex-row">    
            <div class="flex-row center">
                <div class="tarjeta-presentacion">
                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/mercantil.png" alt="logo">
                    <div>
                        <p><span>Banco:</span> Banco Mercantil</p>
                        <p><span>Cuenta:</span> 0105-0660-32-16600-27985</p>
                        <p><span>Titular:</span> Pedro Aguilar</p>
                        <p><span>Cédula:</span> V-17.610.914</p>
                        <p><span>Tipo:</span> Corriente</p>
                    </div>
                </div>

                <div class="tarjeta-presentacion">
                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/bdv.png" alt="logo">
                    <div>
                        <p><span>Banco:</span> Banco Venezuela</p>
                        <p><span>Cuenta:</span> 0102-0253-16-00000-88802</p>
                        <p><span>Titular:</span> Pedro Aguilar</p>
                        <p><span>Cédula:</span> V-17.610.914</p>
                        <p><span>Tipo:</span> Corriente</p>
                    </div>
                </div>

                <div class="tarjeta-presentacion">
                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/bicentenario.png" alt="logo">
                    <div>
                        <p><span>Banco:</span> Banco Bicentenario</p>
                        <p><span>Cuenta:</span> 0175-0468-14-00710-30210</p>
                        <p><span>Titular:</span> Tuasociado.com, C.A.</p>
                        <p><span>Rif:</span> J-29875195-9</p>
                        <p><span>Tipo:</span> Corriente</p>
                    </div>
                </div>

                <div class="tarjeta-presentacion">
                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/tesoro.png" alt="logo">
                    <div>
                        <p><span>Banco:</span> Banco del Tesoro</p>
                        <p><span>Cuenta:</span> 0163-0216-33-21630-02314</p>
                        <p><span>Titular:</span> Pedro Aguilar</p>
                        <p><span>Cédula:</span> V-17.610.914</p>
                        <p><span>Tipo:</span> Corriente</p>
                    </div>
                </div>
             <!--
                <div class="tarjeta-presentacion">
                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/banesco.png" alt="logo">
                    <div>
                        <p><span>Banco:</span> Banesco</p>
                        <p><span>Cuenta:</span> 0134 5896 3698 23698</p>
                        <p><span>Titular:</span> Pedro Aguilar</p>
                        <p><span>Rif:</span> J-40610798-8</p>
                        <p><span>Tipo:</span> Corriente</p>
                        <p><span>Email:</span> info@bienfino.com</p>
                    </div>
                </div>
                <div class="tarjeta-presentacion">
                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/banesco.png" alt="logo">
                    <div>
                        <p><span>Banco:</span> Banesco</p>
                        <p><span>Cuenta:</span> 0134 5896 3698 23698</p>
                        <p><span>Rif:</span> J-40610798-8</p>
                        <p><span>Tipo:</span> Corriente</p>
                        <p><span>Email:</span> info@bienfino.com</p>
                    </div>
                </div>
                <div class="tarjeta-presentacion">
                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/banesco.png" alt="logo">
                    <div>
                        <p><span>Banco:</span> Banesco</p>
                        <p><span>Cuenta:</span> 0134 5896 3698 23698</p>
                        <p><span>Rif:</span> J-40610798-8</p>
                        <p><span>Tipo:</span> Corriente</p>
                        <p><span>Email:</span> info@bienfino.com</p>
                    </div>
                </div>
            -->

                
            </div>
        <!--
            <form method="POST" action="" class="flex-row" style="margin: 2rem;">
            <button type="submit" class="btn btn-pago btn-largo">INFORMAR PAGO</button>
            </form>
        -->
    </div>
 
</div>

<?php
  $this->view('layouts/Vfooter');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>


<script>
//menu
  $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });

  $("#marca_menu").change(function(){
    buscarModeloMenu();
  });

</script>
</body>
</html>
