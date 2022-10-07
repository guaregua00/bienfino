<div class="contenedor2">

        <div class="flex-col">
          <div class="titulo-descripcion">
                  <label>Mis publicaciones</label>
                  <!--<span>Cambiar contraseña</span>-->
          </div>
        </div><!--flex-col-->  

            <?php
              if ($publicaciones) {
            ?>
            <a href="<?php echo base_url();?>publicar" class="btn btn-back btn-lg">Volver a publicar</a>
            <?php 
            } 
            ?>
            <br><br>

              <?php if(isset($mensaje)){ ?>
                    <div class="row">
                      <div class="col-md-12">
                          <div class="alert alert-danger"> <?php echo $mensaje; ?></div>
                      </div>
                    </div>
                    <br>
              <?php }?>

              <?php if($this->session->flashdata('mensaje')){ ?>
                    <div class="row">
                      <div class="col-md-12">
                          <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                      </div>
                    </div>
                    <br>
              <?php }?>


              <?php if($this->session->flashdata('mensaje2')){ ?>
                    <div class="row">
                      <div class="col-md-12">
                          <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
                      </div>
                    </div>
                    <br>
              <?php }?>
         <div class="small-hide publicregistrada" style="padding: 10px 5px;">
         
                <table id="mispublicaciones" class="display table-publicacion" cellspacing="0" width="100%">
                    <thead>
                      <tr class="">
                        <th class="col-md-2">Fotos</th>
                        <th>Marca Modelo Año</th>
                        <th>Ubicación</th> 
                        <th>Precio</th>
                        <th>Fecha de la publicación</th>
                        <th class="col-md-1">Estatus</th>
                        <th class="col-md-2">Acciones</th>
                      </tr>
                    </thead>


                    <tbody>
            <?php
            if (isset($publicaciones) AND $publicaciones!="") {
                foreach ($publicaciones as $value) {

                if($value->paso == 1 || $value->paso == 2 ){
                  echo "<tr class='tr-red'>";
                }else{
                  echo "<tr>";
                }
                    echo "<th><a href=".base_url()."detallepublicacion/".$value->id_publicacion."><img loading='lazy' src='".base_url()."publicaciones/".trim($value->codigo)."/".$value->url_uno."' alt='imagen' style='width:150px; height:100px;'></a></th>";
                    echo "<th>".$value->marca." ".$value->modelo." ".$value->id_ano."</th>";
                    echo "<th>".ucwords(mb_strtolower($value->nombre_parroquia))." ".ucwords(mb_strtolower($value->nombre_municipio))." ".ucwords(mb_strtolower($value->nombre_estado))."</th>";
                    echo "<th>$value->precio_dol"."$";
                    if($value->negociable=='si') echo " negociable</th>";elseif($value->negociable=='no') echo " no negociable</th>";
                    echo "<th>".humanize_date($value->creado, 'long')."</th>";
                    echo "<th><abbr title='".$value->descripcion_estatus."' class='initialism tips'>".$value->nombre_estatus."</abbr></th>";                      
                  
                    echo "<th>
                              <form id='form-imgopcional' method='POST' action='".base_url()."Cpublicacion/accionespublicacion'>
                                <div class='flex-row center'>
                                <div class='form-select bienfino-select' style='width: 100%;'>
                                  <select name='opcional' id='opcional' class='reducir' required>";

                                    echo "<option value='' disabled selected>Opciones</option>";
                                    /*echo "<option value='1'>Agregar/Actualizar Fotos</option>";
                                    echo "<option value='2'>Modificar Categorias</option>"; */
                                    echo "<option value='3'>Modificar</option>";
                                    if($value->nombre_estatus=='Activo'){
                                      echo "<option value='4'>Marcas como Vendido</option>";
                                      echo "<option value='5'>Pausar</option>";
                                    }
                                    if($value->nombre_estatus=='Verificado'){

                                    }
                                    if($value->nombre_estatus=='Rechazado'){

                                    }
                                    if($value->nombre_estatus=='Vendido'){
                                      echo "<option value='7'>Activar</option>";
                                    }
                                    if($value->nombre_estatus=='Por Verificar'){
                                    
                                    }
                                    if($value->nombre_estatus=='Pausado'){
                                      echo "<option value='7'>Activar</option>";
                                    }
                                    
                                    echo "<option value='6'>Eliminar</option>";

                                  echo "</select>
                                  <input type='hidden' name='id_publicacion' id='id_publicacion' value='".$value->id_publicacion."'>
                                  <input type='hidden' name='codigo' id='codigo' value='".$value->codigo."'>
                                  </div>
                                  <button type='submit' class='btn-do' type='button'>Siguiente</button>
                                  </div>
                                  <input type='hidden' name='".$this->security->get_csrf_token_name()."' value='".$this->security->get_csrf_hash()."' />
                              </form>
                          </th>";
                    echo "</tr>";
                }
            }
            
            ?>
                    </tbody>
                </table>
          </div>
          <div id="mispublicaciones-dropInto" class="normal-hide">
            
          </div>
</div>

<?php
  $this->view('layouts/footerR');
?>


<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>js/categoria_publicar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>js/config_datatables.js"></script>
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>

<script type="text/javascript">
/*
  $("select[name=opcional]").change(function(){
            var opcional = $('select[name=opcional]').val();
            if (opcional == 1) {
              $("#form-imgopcional").submit();
            }
        });
*/
$(document).ready(function(){
  $("#opcional").change(function(){
    //$("#form-imgopcional").submit();
  });
});
</script>



<script>

  $('#notificar').click(function (){
    let id_publicacion = $(this).data("id");
    window.location.href = base_url+'mensajeusuario/'+id_publicacion;
  });

</script>

<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>


</body>
</html>
