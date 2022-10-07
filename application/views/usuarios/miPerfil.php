    <!-- Page Content -->
    <div class="container">
      <div class="row">
      <br>
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

       <form action="<?php echo base_url();?>actualizarDatos" method="POST">
        <div class="panel panel-default">
          <div class="panel-heading"><h5 class="text-center">Mi Perfil</h5></div>
            <div class="panel-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="motor">Nombres</label>
                            <input type="text" class="form-control" id="recorrido" name="nombres" value="<?php echo $usuarios->nombres; ?>">
                            <?php echo form_error('nombres');?>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="motor">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $usuarios->apellidos; ?>">
                            <?php echo form_error('apellidos');?>
                          </div>
                        </div>                                    
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" id="email" name="email" value="<?php echo $usuarios->email; ?>">
                              <?php echo form_error('email');?>
                              <span class="help-block">Campo con el cual inicia sesión</span>
                          </div>                    
                        </div>                                  
                      </div>                  
                  </div>
                  <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Cedula</label>
                              <input type="tel" class="form-control" id="celula" name="celula" readonly value="<?php echo $usuarios->cedula; ?>">
                              <?php echo form_error('cedula');?>
                          </div>                       
                        </div> 
                        <div class="col-md-6">
                          <div class="form-group">

                              <div class="col-md-6">
                              <label> Telf Movil 1</label>
                                 <select class="form-control" id="coduno" name="coduno">
                                        <?php if($usuarios->coduno = '0414')echo '<option value="0414" selected >0414</option>'; else echo '<option value="0414">0414</option>'; ?>
                                        <?php if($usuarios->coduno = '0424')echo '<option value="0424" selected >0424</option>'; else echo '<option value="0424">0414</option>'; ?>
                                        <?php if($usuarios->coduno = '0412')echo '<option value="0412" selected >0412</option>'; else echo '<option value="0412">0412</option>'; ?>
                                        <?php if($usuarios->coduno = '0416')echo '<option value="0416" selected >0416</option>'; else echo '<option value="0416">0416</option>'; ?>
                                        <?php if($usuarios->coduno = '0426')echo '<option value="0426" selected >0426</option>'; else echo '<option value="0426">0426</option>'; ?>
                                  </select>
                                  <?php echo form_error('coduno');?>                           
                              </div>
                              <div class="col-md-6">
                              <label>&nbsp;</label>
                                  <input type="tel" class="form-control" id="moviluno" name="moviluno" maxlength="7" value="<?php echo $usuarios->moviluno; ?>" placeholder="Telf Movil"><?php echo form_error('moviluno');?>    
                              </div>
                          </div>                   
                      </div>
                  </div>
                      <div class="row">
                        <div class="col-md-6">

                        </div> 
                        <div class="col-md-6">
                          <div class="form-group">

                              <div class="col-md-6">
                              <label> Telf Movil 2</label>
                                 <select class="form-control" id="coddos" name="coddos">
                                        <option value="0414">0414</option>
                                        <option value="0424">0424</option>
                                        <option value="0412">0412</option>
                                        <option value="0416">0416</option>
                                        <option value="0426">0426</option>
                                  </select>
                                  <?php echo form_error('coddos');?>                                
                              </div>
                              <div class="col-md-6">
                              <label>&nbsp;</label>
                                  <input type="tel" class="form-control" id="movildos" name="movildos" maxlength="7" value="<?php echo $usuarios->movildos; ?>" placeholder="Telf Movil">
                                  <?php echo form_error('movildos');?>  
                              </div>
                          </div>                   
                      </div>
                  </div>                           
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Estado</label><span class="red"> *</span>
                          <select  class="form-control" name="codigoestado" id="codigoestado">
                            <option selected="selected" value="">Seleccione un estado</option>
                            <?php
                            foreach ($estados as $value) {
                              ?>
                              <option value="<?php echo $value->codigoestado; ?>"><?php echo $value->nombre; ?></option>
                           <?php 
                             }
                            ?>
                          </select>
                          <?php echo form_error('codigoestado');?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Municipio</label><span class="red"> *</span>
                          <select  class="form-control" name="codigomunicipio" id="codigomunicipio">
                            <option value="">Seleccione un municipio</option>
                          </select>
                          <?php echo form_error('codigomunicipio');?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Parroquia</label><span class="red"> *</span>
                          <select  class="form-control" name="codigoparroquia" id="codigoparroquia">
                            <option value="">Seleccione una parroquia</option>
                          </select>
                          <?php echo form_error('codigoparroquia');?>
                        </div>         
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Direccion Especifica</label>
                        <textarea class="form-control" rows="5" name="direccion_esp"><?php echo $usuarios->direccion_esp; ?></textarea>
                        <?php echo form_error('direccion_esp');?>  
                        </div>         
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>

          <button type="submit" class="btn btn-primary btn-block btn-flat">Actualizar</button>

       </form>
      </div><!--row-->
    </div><!--container-fluid-->      