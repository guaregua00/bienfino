    <div class="contenedor">
        <div class="flex-col">
            <div class="titulo-descripcion expanded-center text-md">
                <label></label>
                <?php
//var_dump($busqueda);exit();
                if(isset($busqueda)){
                  $texto = "<span>Se han encontrado <b>".$cantidad_resultado." resultado(s)</b>";

                  if ($this->session->userdata("buscar_palabra")) {
                    $texto.=  " para tu búsqueda de <b> ' ".$this->session->userdata("buscar_palabra")." '<b> </span>";
                  }else{
                    $texto.= "</b></span>";
                  }

                  echo $texto;
                }  

                ?>
            </div>

            <!--div class="flex-row end margin-between">
                    <span class="text-lg-gray" style="padding-right: 0.5rem;">Vistas</span>
                    <span class="icono-list"></span>
                    <span class="icono-cuadricula"></span>
                    <div class="form-select bienfino-select">
                            <select name="filtro-visual">
                                <option value="">Filtro A&ntilde;adir</option>
                            </select>
                    </div>
            </div-->

            <div class="flex-row top start no-wrap small-hide">
              <div class="flex-col">
                  <h3>
                    <?php
                      echo "<h2>Filtros Aplicados</h2>";
                      if ($this->session->userdata('buscar_palabra')) {
                        echo "<h4>Palabra Clave:</h4>";
                        echo "<p>".$this->session->userdata('buscar_palabra')."</p>";
                      }
                      if($this->session->userdata("categoriamultiple")){
                        echo "<h4>Categorias:</h4>";
                        for ($i=0; $i <count($this->session->userdata("categoriamultiple")) ; $i++) { 
                          //echo $this->session->userdata("categoriamultiple")[$i];

                               foreach ($categorias as $categoria) {
                                //echo $categoria->id_categoria."<br>";
                                  if ($categoria->id_categoria == $this->session->userdata("categoriamultiple")[$i]) {
                                    echo "<p>".ucwords(strtolower($categoria->nombre))."</p>";
                                  }
                                }

                        }
                      }
                      if($this->session->userdata("ubicacionmultiple")){
                        echo "<h4>Ubicación:</h4>";
                        for ($i=0; $i <count($this->session->userdata("ubicacionmultiple")) ; $i++) { 
                          //echo $this->session->userdata("ubicacionmultiple")[$i];

                               foreach ($estados as $estado) {
                                //echo $categoria->id_categoria."<br>";
                                  if ($estado->codigoestado == $this->session->userdata("ubicacionmultiple")[$i]) {
                                    echo "<p>".ucwords(strtolower($estado->nombre))."</p>";
                                  }
                                }

                        }
                      }
                      if($this->session->userdata("marcamultiple")){
                        echo "<h4>Marcas:</h4>";
                        for ($i=0; $i <count($this->session->userdata("marcamultiple")) ; $i++) { 
                          //echo $this->session->userdata("ubicacionmultiple")[$i];

                               foreach ($marcas as $marca) {
                                //echo $categoria->id_categoria."<br>";
                                  if ($marca->id_marca == $this->session->userdata("marcamultiple")[$i]) {
                                    echo "<p>".ucwords(strtolower($marca->marca))."</p>";
                                  }
                                }

                        }
                      }

                      if($this->session->userdata("modelomultiple")){
                        echo "<h4>Modelos:</h4>";
                        for ($i=0; $i <count($this->session->userdata("modelomultiple")) ; $i++) { 
                          //echo $this->session->userdata("ubicacionmultiple")[$i];

                               foreach ($modelos as $modelo) {
                                //echo $categoria->id_categoria."<br>";
                                  if ($modelo->id_modelo == $this->session->userdata("modelomultiple")[$i]) {
                                    echo "<p>".ucwords(strtolower($modelo->modelo))."</p>";
                                  }
                                }

                        }
                      }                                                                  
                    ?>
                  </h3>
                  <?php
                    if (($this->session->userdata('categoriamultiple')) || ($this->session->userdata("ubicacionmultiple")) || ($this->session->userdata('marcamultiple'))) {
                  ?>
                  <h1><a href="<?php echo base_url();?>Cpublicacion/limpiarFiltro">Eliminar Filtros</a></h1>

                  <?php
                    }
                  ?>
              </div>
            </div>

            <div class="flex-row top start no-wrap ">

                   <div class="flex-col small-hide">

                    <form method="POST" action="<?php echo base_url(); ?>busqueda">

                    <?php if(!$this->session->userdata("categoriamultiple")){?>
                        <div class="form-select-multiple">
                          <select name="categoriamultiple[]" id="categoriamultiple" multiple>
                              <option value="">Categorias</option>
                                 <?php
                                foreach ($categorias as $value) {
                                  ?>
                                  <option value="<?php echo $value->id_categoria; ?>"><?php echo ucwords(strtolower($value->nombre)); ?></option>
                               <?php 
                                 }
                                ?>                             
                          </select>
                           
                        </div>
                    <?php }?>

                    <?php 
                    if($this->session->userdata("categoriamultiple")){
                    if(!$this->session->userdata("marcamultiple")){?>
                        <div class="form-select-multiple">
                            <select name="marcamultiple[]" id="marcamultiple" multiple>
                                <option value="">Marca</option>
                                  <?php
                                  foreach ($marcas as $value) {
                                    ?>
                                    <option value="<?php echo $value->id_marca; ?>"><?php echo ucwords(strtolower($value->marca)); ?></option>
                                 <?php 
                                   }
                                  ?>
                            </select>
                            
                        </div>
                    <?php }}?>

                    <?php
                    if ($this->session->userdata("marcamultiple")) {
                      if (!$this->session->userdata("modelomultiple")) {
                    ?>
                    
                    <div class="form-select-multiple">
                        <select name="modelomultiple[]" id="modelomultiple" multiple>
                            <option value="">Modelo</option>
                              <?php
                              foreach ($modelos as $value) {
                                ?>
                                <option value="<?php echo $value->id_modelo; ?>"><?php echo ucwords(strtolower($value->modelo)); ?></option>
                             <?php 
                               }
                              ?>   
                        </select>
                    </div>
                    <?php
                      }}
                    ?>

                    <?php if(!$this->session->userdata("ubicacionmultiple")){?>
                        <div class="form-select-multiple">
                            <select name="ubicacionmultiple[]" id="ubicacionmultiple" multiple>
                                <option value="">Ubicaci&oacute;n</option>
                                  <?php
                                  foreach ($estados as $value) {
                                    ?>
                                    <option value="<?php echo $value->codigoestado; ?>"><?php echo ucwords(strtolower($value->nombre)); ?></option>
                                 <?php 
                                   }
                                  ?>
                            </select>
                            
                        </div>
                    <?php }?>



                  <?php
                    if ((!$this->session->userdata('categoriamultiple')) || (!$this->session->userdata("ubicacionmultiple")) || (!$this->session->userdata('marcamultiple')) || (!$this->session->userdata('modelomultiple'))) {
                  ?>
                      <button type="submit" class="btn-ver-todo">Aplicar Filtro</button> 

                  <?php
                    }
                  ?>                        
                         
                        </form>   
                   </div>

<div class="flex-row">    

<?php

    if (isset($busqueda) AND $busqueda!="") {
      $i=0;

      

      foreach ($busqueda as $value){
        $busqueda[$i]->favoritouser = false;

      if (isset($migaraje) AND $migaraje!="") {

          foreach ($migaraje as $value2) {

            if( $value2->id_publicacion == $value->id_publicacion) {
              $busqueda[$i]->favoritouser = true;
              break;
           }
        }
       }      
      ?>
                      <?php
                      //var_dump($busqueda[$i]->favoritouser);exit();
                      if ($busqueda[$i]->favoritouser) {
                      ?>
                        <div class="tarjeta-item-pub pub-fav lnk-listen">
                      <?php 
                      }else{
                      ?>
                        <div class="tarjeta-item-pub lnk-listen">
                      <?php
                      
                      }
                      ?>
                           <p class="small-hide"><?php echo ucwords(strtolower($value->modelo)); ?></p>

                           <p class="small-hide"><span>A&Ntilde;O:<?php echo $value->id_ano;?> </span><?php echo ucwords(strtolower($value->estado)); ?></p>
                           <div style="background-image: url('<?php echo base_url()."publicaciones/".$value->codigo."/".$value->url_uno; ?>');background-size: cover;
                            width: 100%;
                            height: 180px;
                            -webkit-border-radius: 4px 4px 0 0;
                            border-radius: 4px 4px 0 0;
                            position: relative;
                            overflow: hidden;
                            "></div>
                            <br>
                              <!-- <img class="lnk-listen" src="<?php echo base_url()."publicaciones/".$value->codigo."/".$value->url_uno; ?>" alt="auto" data-href="<?php echo base_url()."detallepublicacion/".$value->id_publicacion;?>"> -->

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

                       <div class="modal-preview index-neg" id="<?php echo 'modal'.$i;?>">
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
                                    <a href="#" class="btn-publicacion">CONTACTAR</a>
                                    <a href="<?php echo base_url();?>detallepublicacion/<?php echo $value->id_publicacion; ?>" class="btn-publicacion">DETALLES</a>
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
        echo "<h3><br><br>".$mensaje."</h3>";
      }  
?>
<div class="pagination-container">
  <?php 
  
  if(!empty($this->pagination->create_links())){
    $limitePagina= $this->pagination->per_page;
  $totalPaginas = round($cantidad_resultado/$limitePagina);
  $actualPagina = $this->pagination->cur_page;
  if($actualPagina==1){
        echo "<div class='short_count_close_open'>&nbsp;</div>";
      }
      echo $this->pagination->create_links();
      echo "<div class='short_count normal-hide'>". $actualPagina." de ".$totalPaginas."</div>";
      if($totalPaginas==$actualPagina){
        echo "<div class='short_count_close'>&nbsp;</div>";
      }
  }
   ?>
  
</div>




<!--
                   <div class="flex-row">
                       <div class="tarjeta-item-pub">
                           <p>Focus - 2014</p>
                           <p>CARACAS</p>
                           <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto.jpg" alt="">
                           <div>
                              <a href="#" class="btn-more">AMPLIAR INFO</a>
                              <span class="icono-like"></span>
                           </div>
                       </div>
                       <div class="tarjeta-item-pub pub-fav">
                            <p>Focus - 2014</p>
                            <p>CARACAS</p>
                            <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto.jpg" alt="">
                            <div>
                               <a href="#" class="btn-more">AMPLIAR INFO</a>
                               <span class="icono-like-full"></span>
                            </div>
                        </div>
                        <div class="tarjeta-item-pub">
                                <p>Focus - 2014</p>
                                <p><span>UBICACI&Oacute;N: </span>CARACAS</p>
                                <p><span>A&Ntilde;O: </span>CARACAS</p>
                                <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto.jpg" alt="">
                                <div>
                                   <a href="" class="btn-more">AMPLIAR INFO</a>
                                </div>
                            </div>
                            <div class="tarjeta-item-pub">
                                    <p>Focus - 2014</p>
                                    <p><span>UBICACI&Oacute;N: </span>CARACAS</p>
                                    <p><span>A&Ntilde;O: </span>CARACAS</p>
                                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto.jpg" alt="">
                                    <div>
                                       <a href="" class="btn-more">AMPLIAR INFO</a>
                                       <span class="icono-like"></span>
                                    </div>
                                </div>
                                <div class="tarjeta-item-pub">
                                        <p>Focus - 2014</p>
                                        <p><span>UBICACI&Oacute;N: </span>CARACAS</p>
                                        <p><span>A&Ntilde;O: </span>CARACAS</p>
                                        <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto.jpg" alt="">
                                        <div>
                                           <a href="" class="btn-more">AMPLIAR INFO</a>
                                           <span class="icono-like"></span>
                                        </div>
                                    </div>
                                    
                                    <a href="#">
                                    <div class="publicidad-item">
                                            <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/publicidad/publicidad-item.png" alt="cinez">
                                    </div>
                                    </a>
                                    
                                    <div class="tarjeta-item-pub pub-destacado">
                                            <p>Focus - 2014</p>
                                            <p><span>UBICACI&Oacute;N: </span>CARACAS</p>
                                            <p><span>A&Ntilde;O: </span>CARACAS</p>
                                            <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto.jpg" alt="">
                                            <div>
                                               <a href="" class="btn-more">AMPLIAR INFO</a>
                                               <span class="icono-like"></span>
                                            </div>
                                        </div>
                                        <div class="tarjeta-item-pub">
                                                <p>Focus - 2014</p>
                                                <p><span>UBICACI&Oacute;N: </span>CARACAS</p>
                                                <p><span>A&Ntilde;O: </span>CARACAS</p>
                                                <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto.jpg" alt="">
                                                <div>
                                                   <a href="" class="btn-more">AMPLIAR INFO</a>
                                                   <span class="icono-like"></span>
                                                </div>
                                            </div>
                                            <div class="tarjeta-item-pub">
                                                    <p>Focus - 2014</p>
                                                    <p><span>UBICACI&Oacute;N: </span>CARACAS</p>
                                                    <p><span>A&Ntilde;O: </span>CARACAS</p>
                                                    <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/automoviles/auto.jpg" alt="">
                                                    <div>
                                                       <a href="" class="btn-more">AMPLIAR INFO</a>
                                                       <span class="icono-like"></span>
                                                    </div>
                                                </div>
                                                
                                                <a href="#">
                                                        <div class="publicidad-banner">
                                                                <img src="<?php echo base_url(); ?>Bienfino-master/imagenes/publicidad/publicidad.jpg" alt="Man of steel">
                                                        </div>
                                                </a>
                                                -->
                                              
                   </div>
            </div>
    </div>
 
</div>
<?php
  $this->view('layouts/footer');
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

<script>
  
</script>


</body>
</html>
