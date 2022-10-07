
    <div class="contenedor2">
        <div class="flex-row">
            <div class="titulo-descripcion text-lg line-none">
                <label>Cuentas Bancarias</label>
                <span>Elije la m&aacute;s comoda para realizar tu Transferencia o Pago Móvil</span>
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
                        <p><span>Teléfono:</span> 04241859088</p>
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
                        <p><span>Teléfono:</span> 04241859088</p>
                    </div>
                </div>
<!-- 
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
                </div> -->
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
    <div class="flex-row">

      <div class="panel">
                <h2>¡Publica con Nosotros!</h2>
                <p>Publica tu vehiculo! para poder activar la publicación debes indicarnos tu número de cédula, número de publicación y comprobante de pago a nuestro Whatsapp, 
            una vez verificada la información se procede a ACTIVAR.<p></span>
            <a href="https://api.whatsapp.com/send?phone=5804120269878"><i class="fab fa-whatsapp"></i></a>
            <div class="flex-row">
                <div class="group-text-field">
                  <!-- <a href="<?php echo base_url();?>publicar" class="btn btn-back">Volver a publicar</a> -->
                </div>
                <div class="group-text-field">
                  <a class="btn btn-success" href="<?php echo base_url();?>publicar" role="button">Publicar</a>             
                </div>
              </div>

      </div>
    </div>
</div>

<?php
  $this->view('layouts/footerR');
?>
<!--AreJS-->
<!--   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<!--End-->

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
    <script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
    <script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
</body>
</html>
