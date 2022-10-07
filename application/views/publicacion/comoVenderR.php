<div class="container pasos">
    <div class="titulo-pasos">
        <h1>¿Cómo publicar tu vehículo?</h1>
        <p>
        Puedes publicar tu vehículo de manera rápida y sencilla <a href="<?= base_url()?>ingresar">Iniciando Sesión</a>, si no te has registrado
        hazlo ahora mismo <a href="<?= base_url()?>ingresar">Registrar</a> Ya iniciada la sesión en el sistema ingresa en <a href="<?= base_url()?>publicar">Vender</a>
        para publicar un vehiculo debes seguir 4 sencillos pasos.<br>
    </p>         
    </div>
    
   

    <div class="paso1">

        <div class="img-paso">
            <span class="fa-stack">
            <!-- The icon that will wrap the number -->
            <span class="fa fa-circle-o fa-stack-2x"></span>
            <!-- a strong element with the custom content, in this case a number -->
            <strong class="fa-stack-1x">
                1    
            </strong>
            </span>
        </div>
        <div class="inf-paso">
            <p>
                Paso 1/4<br>
                ¿Qué vehículo vas a publicar?
                Indica la Categoría (Tipo de Vehículo: Carro, Camioneta, Moto…), la Marca, el
                Modelo y el Año del vehículo.
                Verifica que los renglones seleccionados sean los correctos y después pulsa Continuar. 
            </p>
        </div>        
    </div>
    <div class="paso2">
        <div class="img-paso">
            <span class="fa-stack">
            <!-- The icon that will wrap the number -->
            <span class="fa fa-circle-o fa-stack-2x"></span>
            <!-- a strong element with the custom content, in this case a number -->
            <strong class="fa-stack-1x">
                2    
            </strong>
            </span>
        </div>
        <div class="inf-paso">
            <p>
                Paso 2/4<br>
                ¡Sube las imágenes del vehículo que deseas publicar!
                Podrás subir entre 4 y 6 imágenes.
                Pulsa en el ícono de la Cámara.
                Si estás registrando desde tu celular o tablet, podrás podrás tomar las fotos y subirlas directamente, o
                elegir las imágenes desde la Galería.
                Pulsa Subir imágenes. Espera unos instantes, notarás que ahora las imágenes están
                en la sección Imágenes cargadas, indicando que ya están guardadas en nuestros registros, sin
                embargo, todavía tienes la oportunidad de desechar alguna imagen y reemplazarla.
                Conforme con las imágenes subidas, pulsa Continuar.
            </p>
        </div>    
    </div>
    <div class="paso3">
    <div class="img-paso">
            <span class="fa-stack">
            <!-- The icon that will wrap the number -->
            <span class="fa fa-circle-o fa-stack-2x"></span>
            <!-- a strong element with the custom content, in this case a number -->
            <strong class="fa-stack-1x">
                3    
            </strong>
            </span>
        </div>
        <div class="inf-paso">        
            <p>
                Paso 3/4<br>
                ¡Describe tu Vehículo!
                Indica los datos de tu vehículo referentes al Precio, Ubicación, Contacto, Especificaciones y demás
                detalles. Algunos datos están marcados con un asterisco rojo (*), lo cual indica que debe describirlos
                necesariamente. Los que no tengan el asterisco rojo, puedes dejarlos vacíos si lo deseas, pero recuerda
                que mientras mas información registres, mas rápido lograrás vender su vehículo.
                Verifica que todos estos datos sean los correctos y luego pulsa Continuar.
            </p>
        </div>
    </div>
    <div class="paso4">
    <div class="img-paso">
            <span class="fa-stack">
            <!-- The icon that will wrap the number -->
            <span class="fa fa-circle-o fa-stack-2x"></span>
            <!-- a strong element with the custom content, in this case a number -->
            <strong class="fa-stack-1x">
                4   
            </strong>
            </span>
        </div>
        <div class="inf-paso">        
            <p>
            Paso 4/4<br>
            ¡Contactanos via Whatsapp!<br>
            Debes indicarnos tu número de cédula, número publicación y comprobante de pago, 
            una vez verificado el mismo se procede a activar la publicación de acuerdo al plan elegido.
            </p>
        </div>
    </div>

</div>

<?php
  $this->load->view('layouts/footerR');
?>
    <script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
    <script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
    <script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
</body>

</html>

