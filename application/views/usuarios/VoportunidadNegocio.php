<div class="contenedor">
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



  <h1>Planifica tu Busqueda</h1>

  <h3 style="color: #ffad03;">Te notificaremos cuando exista el vehiculo con las características que estas buscando<h3>

  <form action="<?php echo base_url(); ?>Cusuarios/registroOportunidadNegocio" method="POST" id="oport_neg" name="oport_neg" >
        <div class="flex-col">
          <div class="titulo-descripcion">
              <label>Coloca tu presupuesto</label>
              <span></span>

          </div>
          <div class="flex-row">
               <div class="group-text-field">
                  <label for="tipo_seleccion">Buscar Precio de Vehículos por<span style="color: red"> *</span></label>
                    <div class="form-select bienfino-select"> 
                      <select  class="input-form" name="tipo_seleccion" id="tipo_seleccion" >
                        <option value="">Seleccione una opción</option>
                        <option value="hasta">Hasta el Monto Disponible inclusive</option>
                        <option value="apartir">A partir del Monto Disponible inclusive</option>
                        <option value="exacto">Monto Disponible exacto</option>
                        <option value="rango">Rango (precios mínimo y máximo)</option>

                      </select>
                    </div>
                  <span class="help-block">&nbsp;</span>
              </div>  
          </div>
          <div class="flex-row">
            <div id="div_precio">
              <div class="group-text-field">
                  <label for="precio_dol">Precio (USD)<span style="color: red"> *</span></label>
                  <input type="text" class="input-form" name="precio_dol" id="precio_dol" value="<?php if(isset($publicacion)) echo $publicacion->precio_dol;?>" maxlength="7">
                  <span class="help-block">Ejemplo: 2000</span>
              </div>
            </div>
             
            <div id="div_rango"> 
              <div class="group-text-field">
                  <label for="monto">Rango de precio<span style="color: red"> *</span></label>
                  <input type="text" class="input-form" name="monto" id="monto" readonly style="border:0; color:#f6931f; font-weight:bold;">
                  <div id="slider-range"></div>
                  <span class="help-block">&nbsp;</span>
              </div>            
            </div>
          </div>
          <div class="flex-row">
              <div class="group-text-field">
                <label>Transmisión</label>
                <div class="form-select bienfino-select">     
                <select  class="input-form" name="transmision" id="transmision" >
                  <option value="">Seleccione una opción</option>
                  <option value="automatica secuencial" <?php if(isset($publicacion)) if($publicacion->transmision == "automatica secuencial") echo "selected"?>>Automática Secuencial</option>
                  <option value="sincronica" <?php if(isset($publicacion)) if($publicacion->transmision == "sincronica") echo "selected"?>>Sincrónica</option>
                </select>
                </div>
                <!--<span class="help-block">&nbsp;</span>-->
              </div> 
          </div>  
        </div>
 

          <div class="flex-row">  
            <button type="submit" class="btn btn-info btn-mini" id="btn-a-continuar">Guardar</button>
          </div>      
  </form>

    <div class="flex-col">
        <table id="presupuesto_usuario" class="display table-publicacion" cellspacing="0" >
            <thead>
              <tr class="">
                <th class="col-md-2">Precio</th>
                <th class="col-md-1">Transmisión</th>
                <th >Opciones</th>
              </tr>
            </thead>


            <tbody>
                <tr>
                  <th>
                   1000$
                  </th>                          
                  <th>
                   Automatico
                  </th>                          
                  <th class="grid-btn-res">
                   <button class='btn-do' type='submit'>Modificar</button>
                   <button class='btn-do' type='submit'>Eliminar</button>
                  </th>
              </tr>
            </tbody>
        </table>
    </div>
</div>



<?php
  $this->view('layouts/Vfooter');
?>
<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.min.js"></script>

<script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 100,
      max: 10000,
      values: [ 1000, 3000 ],
      slide: function( event, ui ) {
        $( "#monto" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#monto" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
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
  $('#div_rango').hide();
  $('#div_precio').hide();
  
      $("#tipo_seleccion").change(function () {   

        if($(this).val() == 'rango'){
          $('#div_precio').hide();
          $('#div_rango').show();
          //$('#foto5').attr('disabled', true);
          //$('#foto6').attr('disabled', true);


        }else if($(this).val() != 'rango'){
          $('#div_rango').hide();
          $('#div_precio').show();
        }

      });

</script>


</body>
</html>
