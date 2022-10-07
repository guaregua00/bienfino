
<div class="contenedor2">  
  <!--mensajes-->
          <?php if(isset($mensaje)){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-danger"> <?php echo $mensaje; ?></div>
                  </div>
                </div>
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
          <?php }?>
          <?php echo validation_errors(); ?>
  <!--end mensajes-->

<div id="form_paso_a">

  <h1>Paso 1/3</h1>

  <h3 style="color: #ffad03;">¿Qué vehículo vas a publicar?<h3>

  <form action="<?php echo base_url(); ?>Cpublicacion/registrarPublicacionUno" method="POST" id="form_a" name="form_a" >
        <div class="flex-col">
          <div class="titulo-descripcion">
              <label>Categorías</label>
              <span>Elije la categoría de tu publicación</span>

          </div>
          </div>
          <div class="flex-row">

                <div class="group-text-field">
                      <label>Vehículo que deseas publicar :</label>

                      <div class="form-select bienfino-select">
                      <select  class="input-form" name="id_categoria" id="id_categoria" require="">
                        <option value="">Debe seleccionar una Categoría</option>
                        <?php 
                        foreach ($categorias as $key => $categoria) {
                          if (isset($publicacion) && ($publicacion->id_categoria != "") && $publicacion->id_categoria ==$categoria->id_categoria){
                            echo '<option selected value="'.$categoria->id_categoria.'">'.$categoria->nombre.'</option>';
                          }else{
                            echo '<option value="'.$categoria->id_categoria.'">'.$categoria->nombre.'</option>';
                          }
                        }
                        ?>
                      </select>
                      </div> 

                </div>
                <div class="group-text-field" id="marca-text">
                  <label>Marca:</label>
                    <input type="text" class="input-form" id="marca-usuario" name="marca-usuario" placeholder="ejemplo: toyota" maxlength="20" value="<?php if(isset($publicacion)) echo $publicacion->placa;?>" >       
                </div>
                <div class="group-text-field" id="marca-select">
                      <label>Marca :</label>
                      <div class="form-select bienfino-select">
                      
                      <select  class="input-form" name="id_marca" id="id_marca" >
                        <option value="">Seleccionar una Marca</option>
                        
                        <?php
                        
                        if (isset($marcas)){
                          $marca_del_usuario = 1;
                          echo '<option value="500000">--Agregar Marca--</option>';
                          foreach ($marcas as $key => $marca) {
                            if (isset($publicacion) && ($publicacion->id_marca != "") && $marca->id_marca ==$publicacion->id_marca){
                              echo '<option selected value="'.$publicacion->id_marca.'">'.ucwords($publicacion->marca).'</option>';
                              $marca_del_usuario = 0;
                            }else{
                              echo '<option value="'.$marca->id_marca.'">'.ucwords($marca->marca).'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                      </div>
                      <?php 
                      //if(isset($marcas) and $marca_del_usuario==1)
                      //echo '<span class="help-block">Seleccionaste: '.ucwords(mb_strtolower($publicacion->marca)).'</span>'; 
                      ?>

                </div>                
          </div>

            <div class="flex-row">
                <div class="group-text-field" id="modelo-text">
                  <label>Modelo:</label>
                  <input type="text" class="input-form" id="modelo-usuario" name="modelo-usuario" placeholder="ejemplo: corolla" maxlength="20" value="<?php if(isset($publicacion)) echo $publicacion->placa;?>" >
                </div>
                <div class="group-text-field" id="modelo-select">
                      <label>Modelo:</label>
                      <div class="form-select bienfino-select">

                      <select  class="input-form" name="id_modelo" id="id_modelo">
                        <option value="">Debe seleccionar un Modelo</option>
                        
                        <?php 
                        if (isset($publicacion) && ($publicacion->id_modelo != ""))
                         echo '<option selected value="'.$publicacion->id_modelo.'">'.ucwords($publicacion->modelo).'</option>';
/*                          if (isset($modelos)){
                          foreach ($modelos as $key => $modelo) {
                            if (isset($publicacion) && ($publicacion->id_modelo != "") && $modelo->id_modelo ==$publicacion->id_modelo){
                              echo '<option selected value="'.$publicacion->id_modelo.'">'.$publicacion->modelo.'</option>';
                            }else{
                              echo '<option value="'.$marca->id_modelo.'">'.$modelo->modelo.'</option>';
                            }
                          }
                        } */                        
                        ?>
                      </select>
                      </div>
                      <?php 
                      if(isset($publicacion) && ($publicacion->id_modelo != ""))
                        echo "<span class='help-block'>selecciona la Marca para cambiar</span>"; 
                      ?>
              </div>        

              <div class="group-text-field">
                      <label>Año:</label>
                      <div class="form-select bienfino-select">
                      <select  class="input-form" name="id_ano" id="id_ano">
                        <option value="">Debe seleccionar un Año</option>
                        <?php 
                        for ($anio = date('Y'); $anio >= 1900 ; $anio--) {
                          if (isset($publicacion) && ($publicacion->id_ano != "") && $publicacion->id_ano == $anio){
                            echo '<option selected value="'.$anio.'">'.$anio.'</option>';
                          }else{
                            echo '<option value="'.$anio.'">'.$anio.'</option>';
                          }
                        }
                        ?>
                      </select>
                      </div>
              </div>
            </div><!--flex-row-->

        <div class="flex-row">
            <input type="hidden" name="codigo" value="<?php echo $this->uri->segment('2'); ?>" id="codigo">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            <button type="submit"  class="btn btn-info btn-mini" id="btn-a-continuar">Continuar</button>
        </div>

</form>

  </div><!--form_paso_a--> 
</div>

<?php
$this->load->view('layouts/footerR');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<!-- <script src="<?php echo base_url();?>js/imagen_publicacion.js"></script> -->
<!-- <script src="<?php echo base_url();?>js/geo.js"></script> -->
<script src="<?php echo base_url();?>js/categoria_publicar.js"></script>
<script src="<?php echo base_url();?>js/validaciones/publicacion_registro_paso_a.js"></script>
<!-- <script src="<?php echo base_url();?>js/menu_filtros.js"></script> -->
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>

<script>


$('#btn-c-continuar').attr('disabled', true);
$("#marca-text").hide();
$("#modelo-text").hide();

//formulario
  $("#id_categoria").change(function(){
    $("#marca-text").hide();
    $("#modelo-text").hide();
    $("#marca-select").show();
    $("#modelo-select").show();
    $("#id_marca").prop('disabled', false);
    $("#id_modelo").prop('disabled', false);        
    //buscarMarca();
  });

  $("#id_marca").change(function(){
    var id_marca = $("#id_marca").val();
      if(id_marca == 500000){
        $("#marca-text").show();
        $("#modelo-text").show();   
        $("#marca-select").hide();
        $("#modelo-select").hide();
        $("#id_marca").prop('disabled', true);
        $("#id_modelo").prop('disabled', true);
      }else{
        buscarModelo();
      }
    
  });


  $("#id_modelo").change(function(){
    var id_modelo = $("#id_modelo").val();
      if(id_modelo == 500000){
        $("#modelo-text").show();
        $("#modelo-select").hide(); 
        $("#id_modelo").prop('disabled', true);
      }
  });

</script>


<script>
//menu
/*   $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });
 */
/*   $("#marca_menu").change(function(){
    buscarModeloMenu();
  }); */

</script>

  </body>
</html>