<div class="contenedor">
        <div class="flex-col">
          <div class="titulo-descripcion">
                  <label>Mi favorito</label>
                  <span>Listado de vehiculos que te gustaron</span>
          </div>
        </div>

    <div class="contenedor">
        <div class="flex-col">            


<div class="flex-row">    

<?php

    if (isset($migaraje) AND $migaraje!="") {

$i=0;
      foreach ($migaraje as $value){
       // var_dump($value->estado);exit();
      ?>

                        <div class="tarjeta-item-pub pub-fav lnk-listen">
 

                           <p class="small-hide"><?php echo ucwords(strtolower($value->titulo)); ?></p>

                           <p class="small-hide"><span>A&Ntilde;O:<?php echo $value->id_ano;?> </span><?php echo ucwords(strtolower($value->estado)); ?></p>
                              <img class="lnk-listen" src="<?php echo base_url()."publicaciones/".$value->codigo."/".$value->url_uno; ?>" alt="auto" data-href="<?php echo base_url()."detallepublicacion/".$value->id_publicacion;?>">
                           <div class="small-info normal-hide">
                               <div class="titulo-tarjeta truncate-text">
                                <?php
                                echo $value->titulo;
                                ?>
                                </div>
        <div class="linea-info"><span class="texto-azul-claro">AÑO:</span><span class="texto-gris"><?= $value->id_ano; ?></span> </div>
        <span class="linea-info"><span class="texto-azul-claro">MARCA:</span> <span class="texto-gris"><?= mb_strtoupper($value->marca) ?></span> </span>
        <span class="linea-info"><span class="texto-azul-claro">MODELO:</span> <span class="texto-gris"><?= mb_strtoupper($value->modelo) ?></span> </span>
        <span class="linea-info"><span class="texto-azul-claro">KILOMETRAJE:</span> <span class="texto-gris"><?= $value->recorrido." KM" ?></span> </span>
        <span class="linea-info"><span class="texto-azul-claro">TRACCIÓN:</span> <span class="texto-gris"><?= mb_strtoupper($value->traccion) ?></span> </span>
        <span class="linea-info"><span class="texto-azul-claro">UBICACIÓN:</span> <span class="texto-gris"><?= mb_strtoupper($value->estado) ?></span></span>
        <span class="linea-info small-hide"><span class="texto-negro">USUARIO:</span> <span class="texto-gris">

        <?php
        $nom_ape = mb_strtoupper($value->nombres." ".$value->apellidos);
        if (strlen($nom_ape) <= 25) {
          echo mb_strtoupper($nom_ape);
        }else{
          $titulo_corto = substr($nom_ape, 0,25);
          echo mb_strtoupper($titulo_corto)."...";
        }
        ?>      
        </span> </span>

                           </div>
                           <div>
                              <a href="#" class="btn-more modal-trigger small-hide" data-target="<?php echo 'modal'.$i;?>">AMPLIAR INFO</a>
                              <span onclick="capturar(this);" id="<?php echo $value->id_publicacion; ?>" class="icono-like">
                                <!--
                                <form>
                                  <input type="hidden" class="id_publicacion2" name="id_publicacion2" id="id_publicacion2" value="<?php echo $value->id_publicacion; ?>"></input>
                                  <button id="envio" class="icono-like"></button>
                                </form>
                                -->
                              </span>

                           </div>
                       </div>

                       <div class="modal-preview" id="<?php echo 'modal'.$i;?>">
                           <span class="modal-close"></span>
                            <div class="modal-body">
                                <div class="tarjeta-item-detail">
                                    <div class="tarjeta-item-detail-image">
                                        <img src="<?php echo base_url()."publicaciones/".$value->codigo."/".$value->url_uno; ?>" alt="foto_vehiculo">
                                    </div>
                                    <div class="tarjeta-item-detail-content">
                                        <p><?php echo ucwords(strtolower($value->titulo)); ?></p>
                                        <?php if(isset($value->marca)){echo '<p><span>A&Ntilde;O:</span>'.$value->id_ano.'</p>';} ?>
                                        <?php if(isset($value->marca)){echo '<p><span>MARCA:</span>'.$value->marca.'</p>';} ?>
                                        <?php if(isset($value->modelo)){echo '<p><span>MODELO:</span>'.$value->modelo.'</p>';} ?>
                                        <?php if(isset($value->recorrido)){echo '<p><span>KILOMETRAJE:</span>'.$value->recorrido.'</p>';} ?>
                                        <?php if(isset($value->traccion)){echo '<p><span>TRACCI&Oacute;N:</span>'.$value->traccion.'</p>';} ?>
                                        <?php if(isset($value->estado)){echo '<p><span>UBICACI&Oacute;N:</span>'.$value->estado.'</p>';} ?>
                                        <?php if(isset($value->nombres)){echo '<p><span>USUARIO:</span>'.ucwords(strtolower($value->nombres)).' '.ucwords(strtolower($value->apellidos)).'</p>';} ?>
                                        
                                        <div class="tarjeta-item-detail-opt">
                                            <span class="icono-check"></span>
                                            <span class="icono-auto-numero">2</span>
                                            <span class="icono-tiempo-year">2</span>
                                            <span class="user-picture"><img src="<?php echo base_url(); ?>Bienfino-master/imagenes/base/avatar_on.png" alt="profile_picture" class="profile"></span>
                                            <span class="icono-like-full"></span>
                                            <span class="icono-share"></span>
                                        </div>
                                        
                                    </div>
                                    <a href="#" class="btn-publicacion">Contactar Vendedor</a>
                                    <a href="<?php echo base_url();?>detallepublicacion/<?php echo $value->id_publicacion; ?>" class="btn-publicacion">Ver Detalles</a>
                                </div>
                            </div>
                            <!--
                            <a href="">
                            <div class="modal-publicidad">
                                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/publicidad/publicidad.png" alt="Google">
                            </div>
                            </a>
                            -->
                       </div>

              <?php
              $i++;
      }
    }else{
      echo "<h1>Mi favorito vacio</h1>";
    }
?>



      </div>
  </div>
 
</div>
</div>
<?php
  $this->view('layouts/Vfooter');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
<script src="<?php echo base_url();?>js/precio_migaraje.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    ajustImageInnerContent('tarjeta-item-pub', {top: 40, right: 0.8, bottom: 4, left: 0.8}, {top: 1, right: 0.9, bottom: 1, left: 0.9},'rem');
    ajustImageInnerContent('publicidad-item', {top: 0, right: 0, bottom: 0, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');
    ajustImageInnerContent('publicidad-banner', {top: 0, right: 0, bottom: 0, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');
});
</script>

<script>
//menu
  $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });

  $("#marca_menu").change(function(){
    buscarModeloMenu();
  });

</script>

<script>
/*  
$( ".agregar" ).click(function() {
  //agregarMigaraje();

});


$( "#envio" ).click(function() {
  event.preventDefault();
  valor = $('input[type=hidden]').val();
  alert(valor);
  //agregarMigaraje();

});
*/

function capturar(obj){
  var id_publicacion = obj.id
  agregarMigaraje(id_publicacion);
}
</script>
</body>
</html>
