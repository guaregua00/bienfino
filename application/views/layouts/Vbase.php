
<div class="contenedor">

<form id="publicacion_registro" action="<?php echo base_url(); ?>Cpublicacion/registrarPublicacion" method="POST">


<!--
              <div class="group-text-field">            
                        <div class="form-group">
                          <label>Transmisión</label>
                          <select  class="input-form" name="transmision" id="transmision" required="">
                            <option value="">Seleccione una opción</option>
                            <option value="automatica secuencial">Automática Secuencial</option>
                            <option value="sincronica">Sincrónica</option>
                          </select>
                        </div>                 
              </div>
-->

        <div class="flex-col">
          <div class="titulo-descripcion">
                  <label>Cambio Contraseña</label>
                  <!--<span>Cambiar contraseña</span>-->
          </div>
        </div><!--flex-col-->  


            <div class="flex-row wrap">
              <div class="flex-col">

                <div class="group-text-field">
                  <div class="form-group">
                    <label for="titulo">Contraseña actual</label>
                    <input type="titulo" class="input-form" id="titulo" name="titulo" placeholder="Contraseña actual" required="">
                  </div>
                </div>

                <div class="group-text-field">
                  <div class="form-group">
                    <label for="titulo">Contraseña Nueva</label>
                    <input type="titulo" class="input-form" id="titulo" name="titulo" placeholder="Contraseña Nueva" required="">
                  </div>
                </div>

                <div class="group-text-field">
                  <div class="form-group">
                    <label for="titulo">Repetir Contraseña Nueva</label>
                    <input type="titulo" class="input-form" id="titulo" name="titulo" placeholder="Repetir Contraseña Nueva" required="">
                  </div>
                </div>
                <button type="botton" id="boton_registro" class="btn-do right">Cambiar Contraseña</button>
              </div>
            </div><!--flex-row-->
</form>
</div><!--contenedor-->

