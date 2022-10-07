 
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

  <div id="form_paso_c">

  <h1>Paso 3/3</h1>
  <h3 style="color: #ffad03;">¡Describe tu Vehículo!</h3>

 <form action="<?php echo base_url(); ?>Cpublicacion/registrarPublicacionTres" method="POST" id="form_c" name="form_c">

<?php 
  //var_dump($publicacion);
?>
  <!--precio-->
      <div class="flex-col">
        <div class="titulo-descripcion">
                <label>Precio</label>
                <span>Precio del Vehículo</span>
        </div>
      </div> 
          <div class="flex-row">
              <div class="group-text-field">
                  <label for="precio_dol">Precio (USD)<span style="color: red"> *</span></label>
                  <input type="text" class="input-form" name="precio_dol" id="precio_dol" value="<?php if(isset($publicacion)) echo $publicacion->precio_dol;?>" maxlength="7">
                  <span class="help-block">Ejemplo: 2000</span>
              </div>            
              <div class="group-text-field">
                  <label for="precio_bs">Precio (Bs S) </label>
                  <input type="text" class="input-form" name="precio_bs" id="precio_bs" value="<?php if(isset($publicacion)) echo $publicacion->precio_bs;?>" maxlength="11">
                  <span class="help-block">&nbsp</span>
              </div>
              <div class="group-text-field">
                  <label for="negociable">Negociable<span style="color: red"> *</span></label>
                  <div class="form-select bienfino-select">
                      <select name="negociable" id="negociable" class="input-form">
                          <option value="" selected="">Debe seleccionar una opción</option>
                          <option value="si" <?php if(isset($publicacion)) if($publicacion->negociable == "si") echo "selected"?>>Si</option>
                          <option value="no" <?php if(isset($publicacion)) if($publicacion->negociable == "no") echo "selected"?>>No</option>
                      </select>
                  </div>
                  <span class="help-block">&nbsp</span>
              </div>    

          </div><!--flex-row wrap-->    
  <!--end precio-->

  <!--ubicacion-->
      <div class="flex-col">
        <div class="titulo-descripcion">
                <label>Ubicación</label>
                <span>Indicanos donde esta ubicado el Vehículo</span>
        </div>
      </div>
            <div class="flex-row">
                <div class="group-text-field">
                    <!--<div class="form-group">-->
                      <label>Estado<span style="color: red"> *</span></label>
                      <div class="form-select bienfino-select">
                      <select  class="input-form" name="codigoestado" id="codigoestado" required="">
                        <option selected="selected" value="">Seleccione un estado</option>
                        <?php
                        foreach ($estados as $value) {
                          ?>
                          <option value="<?php echo $value->codigoestado; ?>"><?php echo ucwords($value->nombre); ?></option>
                       <?php 
                         }
                        ?>
                      </select>

                    <!--</div>-->
                    </div>
                    <?php if(isset($publicacion) and $publicacion->estado!="") 
                      echo '<span class="help-block">Seleccionaste: '.ucwords($publicacion->estado).'</span>';
                    ?>
                    
                </div>

                <div class="group-text-field">
                    <!--<div class="form-group">-->
                      <label>Municipio<span style="color: red"> *</span></label>
                  <div class="form-select bienfino-select">
                        <select  class="input-form" name="codigomunicipio" id="codigomunicipio" required="">
                          <option value="">Seleccione un municipio</option>
                      </select>
                </div>
                    <?php if(isset($publicacion) and $publicacion->municipio!="") 
                      echo '<span class="help-block">Seleccionaste: '.ucwords($publicacion->municipio).'</span>';
                    ?>                
                    <!--</div>-->
                </div>

                <div class="group-text-field">
                  <!--<div class="form-group">-->  
                  <label>Parroquia<span style="color: red"> *</span></label>
                  <div class="form-select bienfino-select">
                      <select  class="input-form" name="codigoparroquia" id="codigoparroquia" required="">
                        <option value="">Seleccione una parroquia</option>
                      </select>
                </div>
                    <?php if(isset($publicacion) and $publicacion->parroquia!="") 
                      echo '<span class="help-block">Seleccionaste: '.ucwords($publicacion->parroquia).'</span>';
                    ?>                
                  </div>
                  <!--</div>-->
            </div>
  <!--end ubicacion-->


  <!--detallesubicacion-->
            <div class="flex-col">
              <div class="titulo-descripcion">
                      <label>Contacto</label>
                      <span>Datos de contanto</span>
              </div>
            </div>

              <div class="flex-row">

                    <div class="group-text-field">
                      <label for="moviluno">Teléfono<span style="color: red"> *</span></label>
                      <input type="tel" class="input-form" id="moviluno" name="moviluno" maxlength="11" value="<?php if(isset($publicacion)) echo $publicacion->moviluno;?>">
                      <span class="help-block">Ejemplo: 04141234567</span>

                    </div>  

                    <div class="group-text-field">
                      <label for="movildos">Teléfono Dos</label>
                      <input type="tel" class="input-form" id="movildos" name="movildos" maxlength="11" value="<?php if(isset($publicacion)) echo $publicacion->movildos;?>">
                      <span class="help-block">opcional</span>                     
                    </div>
                
              </div><!--flex-row-->

            <div class="flex-col">
              <div class="titulo-descripcion">
                      <label>Especificaciones</label>
                      <span>Completa estos datos</span>
              </div>
            </div>

              <div class="flex-row">
              <div class="group-text-field">
                      <label for="motor">Recorrido(km)<span style="color: red"> *</span></label>
                      <input type="text" class="input-form" id="recorrido" name="recorrido" maxlength="7" placeholder="ejemplo 100000" value="<?php if(isset($publicacion)) echo $publicacion->recorrido;?>" >
              </div>
              <div class="group-text-field">
                          <label>Condición<span style="color: red"> *</span></label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="condicion" id="condicion" required="">
                            <option value="">Seleccione una opción</option>
                            <option value="nuevo" <?php if(isset($publicacion)) if($publicacion->condicion == "nuevo") echo "selected"?>>Nuevo</option>
                            <option value="usado" <?php if(isset($publicacion)) if($publicacion->condicion == "usado") echo "selected"?>>Usado</option>
                          </select>
                          </div>           
              </div>                            
              <div class="group-text-field">
                          <label>Color<span style="color: red"> *</span></label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="color" id="color" required="">
                            <option value="">Seleccione una opción</option>
                            <option value="amarillo" <?php if(isset($publicacion)) if($publicacion->color == "amarillo") echo "selected"?>>Amarillo</option>
                            <option value="anaranjado" <?php if(isset($publicacion)) if($publicacion->color == "anaranjado") echo "selected"?>>Anaranjado</option>
                            <option value="azul" <?php if(isset($publicacion)) if($publicacion->color == "azul") echo "selected"?>>Azul</option>
                            <option value="beige" <?php if(isset($publicacion)) if($publicacion->color == "beige") echo "selected"?>>Beige</option>
                            <option value="blanco" <?php if(isset($publicacion)) if($publicacion->color == "blanco") echo "selected"?>>Blanco</option>
                            <option value="crema" <?php if(isset($publicacion)) if($publicacion->color == "crema") echo "selected"?>>Crema</option>
                            <option value="dorado" <?php if(isset($publicacion)) if($publicacion->color == "dorado") echo "selected"?>>Dorado</option>
                            <option value="gris" <?php if(isset($publicacion)) if($publicacion->color == "gris") echo "selected"?>>Gris</option>
                            <option value="marron" <?php if(isset($publicacion)) if($publicacion->color == "marron") echo "selected"?>>Marron</option>
                            <option value="morado" <?php if(isset($publicacion)) if($publicacion->color == "morado") echo "selected"?>>Morado</option>
                            <option value="negro" <?php if(isset($publicacion)) if($publicacion->color == "negro") echo "selected"?>>Negro</option>
                            <option value="plateado" <?php if(isset($publicacion)) if($publicacion->color == "plateado") echo "selected"?>>Plateado</option>
                            <option value="rojo" <?php if(isset($publicacion)) if($publicacion->color == "rojo") echo "selected"?>>Rojo</option>
                            <option value="verde" <?php if(isset($publicacion)) if($publicacion->color == "verde") echo "selected"?>>Verde</option>
                            <option value="vinotinto" <?php if(isset($publicacion)) if($publicacion->color == "vinotinto") echo "selected"?>>Vinotinto</option>
                            <option value="otro" <?php if(isset($publicacion)) if($publicacion->color == "otro") echo "selected"?>>Otro</option>
                          </select>
                          </div>            
              </div>                              
                <div class="group-text-field">            
                          <label>Transmisión<span style="color: red"> *</span></label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="transmision" id="transmision" >
                            <option value="">Seleccione una opción</option>
                            <option value="automatica secuencial" <?php if(isset($publicacion)) if($publicacion->transmision == "automatica secuencial") echo "selected"?>>Automática Secuencial</option>
                            <option value="sincronica" <?php if(isset($publicacion)) if($publicacion->transmision == "sincronica") echo "selected"?>>Sincrónica</option>
                          </select>
                          </div>             
              </div>                
              <div class="group-text-field">
                          <label>Único Dueño:<span style="color: red"> *</span></label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="unico_dueno" id="unico_dueno">
                            <option value="">Seleccione una opción</option>
                            <option value="si" <?php if(isset($publicacion)) if($publicacion->unico_dueno == "si") echo "selected"?>>Si</option>
                            <option value="no" <?php if(isset($publicacion)) if($publicacion->unico_dueno == "no") echo "selected"?>>No</option>
                          </select>
                          </div>               
              </div>               
              </div><!--flex-row-->
              <div class="flex-row">  

              <div class="group-text-field">
                      <label>Comentario</label>
                      <textarea class="input-form" rows="10" maxlength="1000" name="comentario" required=""></textarea>
                      <span class="help-block">Indica cualquier información adicional de tu vehículo.</span>
              </div>

              </div><!--flex-row-->
<!--end detallesubicacion-->


  <!--publicacion-->
        <div class="flex-col">
          <div class="titulo-descripcion">
                  <label>Vehículo</label>
                  <span>Detalles del Vehículo</span>
          </div>
        </div><!--flex-col-->  

           
        <button type="button" id="show" class="btn btn-success">Mostrar/Ocultar Especificaciones </button>
            

<div id="detalles_vehiculo">
            <div class="flex-row">
              <div class="group-text-field"> 
                          <label>Dirección</label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="direccion" id="direccion" >
                            <option value="">Seleccione una opción</option>
                            <option value="asistida" <?php if(isset($publicacion)) if($publicacion->direccion == "asistida") echo "selected"?>>Asistida</option>
                            <option value="hidraulica" <?php if(isset($publicacion)) if($publicacion->direccion == "hidraulica") echo "selected"?>>Hidráulica</option>
                            <option value="mecanica" <?php if(isset($publicacion)) if($publicacion->direccion == "mecanica") echo "selected"?>>Mecánica</option>
                            <option value="otro" <?php if(isset($publicacion)) if($publicacion->direccion == "otro") echo "selected"?>>Otro</option>
                          </select>
                          </div>            
              </div>
              <div class="group-text-field">
                          <label>Estéreo</label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="estereo" id="estereo" >
                            <option value="">Seleccione una opción</option>
                            <option value="cd" <?php if(isset($publicacion)) if($publicacion->estereo == "cd") echo "selected"?>>CD</option>
                            <option value="mp3" <?php if(isset($publicacion)) if($publicacion->estereo == "mp3") echo "selected"?>>MP3</option>
                            <option value="no" <?php if(isset($publicacion)) if($publicacion->estereo == "no") echo "selected"?>>No</option>
                            <option value="r rep" <?php if(isset($publicacion)) if($publicacion->estereo == "cuero") echo "selected"?>>R/Rep</option>
                          </select>
                          </div>       
              </div>
              <div class="group-text-field">
                          <label>Tapizado</label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="tapizado" id="tapizado" >
                            <option value="">Seleccione una opción</option>
                            <option value="cuero" <?php if(isset($publicacion)) if($publicacion->tapizado == "cuero") echo "selected"?>>Cuero</option>
                            <option value="semicuero" <?php if(isset($publicacion)) if($publicacion->tapizado == "semicuero") echo "selected"?>>Semi Cuero</option>
                            <option value="tela" <?php if(isset($publicacion)) if($publicacion->tapizado == "tela") echo "selected"?>>Tela</option>
                          </select>
                          </div>          
              </div>
            </div><!--flex-row-->

            <div class="flex-row">
            <div class="group-text-field">
                            <label>Combustible</label>
                            <div class="form-select bienfino-select">
                            <select  class="input-form" name="combustible" id="combustible" required="">
                              <option value="">Seleccione una opción</option>
                              <option value="gasolina" <?php if(isset($publicacion)) if($publicacion->combustible == "gasolina") echo "selected"?> >Gasolina</option>
                              <option value="gasoil" <?php if(isset($publicacion)) if($publicacion->combustible == "gasoil") echo "selected"?>>GasOil</option>
                              <option value="gnv" <?php if(isset($publicacion)) if($publicacion->combustible == "gnv") echo "selected"?>>GNV</option>
                              <option value="electrico" <?php if(isset($publicacion)) if($publicacion->combustible == "electrico") echo "selected"?>>Eléctrico</option>
                            </select>
                            </div>           
                </div>
              <div class="group-text-field">
                          <label>Vidrios</label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="vidrios" id="vidrios" >
                            <option value="">Seleccione una opción</option>
                            <option value="electricos" <?php if(isset($publicacion)) if($publicacion->vidrios == "electricos") echo "selected"?>>Eléctricos</option>
                            <option value="manuales" <?php if(isset($publicacion)) if($publicacion->vidrios == "manuales") echo "selected"?>>Manuales</option>
                          </select>
                          </div>            
              </div>
              <div class="group-text-field">            
                          <label>Motor recien reparado</label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="reparado" id="reparado" >
                            <option value="">Seleccione una opción</option>
                            <option value="no" <?php if(isset($publicacion)) if($publicacion->reparado == "no") echo "selected"?>>No</option>
                            <option value="si" <?php if(isset($publicacion)) if($publicacion->reparado == "si") echo "selected"?>>Si</option>
                          </select>
                          </div>             
              </div>
            </div><!--flex-row-->

            <div class="flex-row">
              <div class="group-text-field">          
                          <label>Tracción</label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="traccion" id="traccion">
                            <option value="">Seleccione una opción</option>
                            <option value="4x2" <?php if(isset($publicacion)) if($publicacion->traccion == "4x2") echo "selected"?>>4x2</option>
                            <option value="4x4" <?php if(isset($publicacion)) if($publicacion->traccion == "4x4") echo "selected"?>>4x4</option>
                          </select>
                          </div>             
              </div>
              <div class="group-text-field">
                          <label>Cant. de puertas</label>
                          <div class="form-select bienfino-select">
                          <select  class="input-form" name="puertas" id="puertas" >
                            <option value="">Seleccione una opción</option>
                            <?php
                              for ($i=2; $i < 8; $i++) {

                                if(isset($publicacion)) {
                                  if($publicacion->puertas == $i) echo "<option value=".$i." selected >$i</option>";
                                  else echo "<option value=".$i.">$i</option>";
                                }
                              }
                            ?>
                          </select>
                          </div>
              </div>
              <div class="group-text-field" >      
                      <label for="placa">Nro Placa</label>
                      <input type="text" class="input-form" id="placa" name="placa" placeholder="" maxlength="10" value="<?php if(isset($publicacion)) echo $publicacion->placa;?>" >
              </div>             

            </div><!--flex-row-->


            <div class="flex-row">        
              <div class="group-text-field">
                      <label for="motor">Motor</label>
                      <input type="text" class="input-form" id="motor" name="motor" placeholder="" maxlength="30" value="<?php echo set_value('motor'); ?>">
              </div>
              <div class="group-text-field">
                      <label for="motor">Nro Cilindros</label>
                      <input type="text" class="input-form" id="nro_cilindros" name="nro_cilindros" maxlength="2" placeholder="" >
              </div>
 
            </div><!--flex-row-->


</div><!--detalles_vehiculo-->            
  <!--end publicacion-->


            <!--
            <div class="flex-row">
              <div class="group-text-field">
                  <label for="titulo">Titulo</label>
                  <input type="titulo" class="input-form" id="titulo" name="titulo" placeholder="Titulo de la Publicación" required="">
                  <span class="help-block">Un buen título requiere por lo menos 50 caracteres..</span>
              </div>
            </div>
            -->
                  <input type="hidden" name="codigo" value="<?php echo $this->uri->segment('2'); ?>">



            <div class="flex-row">
                <div class="group-text-field">
                  <a href="<?php echo base_url();?>publicardos/<?php echo $this->uri->segment('2'); ?>" class="btn btn-mini btn-back" id="btn-c-regresar" >Regresar</a> 
                </div>
                <div class="group-text-field">
                    <button type="submit" class="btn btn-info btn-mini" id="btn-c-continuar">Continuar</button>
                </div>                
            </div>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            </form>

  </div><!-- form_paso_c -->
</div><!--contenedor-->
<?php
$this->load->view('layouts/footerR');
?>

<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/imagen_publicacion.js"></script>
<script src="<?php echo base_url();?>js/geo.js"></script>
<script src="<?php echo base_url();?>js/categoria_publicar.js"></script>
<script src="<?php echo base_url();?>js/validaciones/publicacion_registro_paso_c.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
<script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>

    <script>
      $('#detalles_vehiculo').toggle();
      $(function(){
        $('#show').click(function(){
          $('#detalles_vehiculo').toggle();
        });
      })
    </script>

<script>
//formulario
  $(".categoria").click(function(){
    buscarMarca();
  });

  $("#id_marca").change(function(){
    buscarModelo();
  });
  $("#id_modelo").change(function(){
    buscarAno();
  });

  $("#codigoestado").change(function(){
    buscarMunicipios2();
  });
  $("#codigomunicipio").change(function(){
    buscarParroquia();
  });  

</script>




  </body>
</html>
