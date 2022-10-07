
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Reporte de Pago
        <?php
        switch ($id_pago_estatus) {
          case '1':
              echo "<small>Por Verificar</small>";
            break;
          case '2':
              echo "<small>Verificando</small>";
            break;
          case '3':
              echo "<small>Consolidado</small>";
            break;
          case '4':
              echo "<small>Anulado</small>";
            break;

          default:
              echo "Panel de Control";
            break;
        }
        ?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <br>
    <br>

              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning"> 
                        <p>1) ADVERTENCIA ESTE MODULO LOS PAGOS ANULADOS PODRAN CAMBIAR DE ESTATUS A "POR VERIFICAR" SI EL USUARIO VENDEDOR DESDE SU CUENTA GENERA UNO NUEVO, ACTUALIZANDO EL MISMO</p>
                    </div>
                </div>
              </div>  

          <?php if($this->session->flashdata('mensaje')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje'); ?></div>
                  </div>
                </div>
          <?php }?>
          <?php if($this->session->flashdata('mensaje2')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-sdanger"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
                  </div>
                </div>
          <?php }?>

    <!-- Main content -->
    <section class="content">

      <div class="row">
   
        <div class="col-md-12">

                <table id="listausuario" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                          <th class="col-md-1">Id Publicacion</th>
                          <th class="col-md-1">Usuario</th>
                          <th>Tipo Pago</th>
                          <th>Banco (Origen)</th>
                          <th>Banco (Destino)</th>
                          <th>Número Pago</th>                      
                          <th>Fecha</th>
                          <th>Hora de la operación</th>
                          <th>Monto</th>
                          <th>Fecha registro</th>
                          <?php if($id_pago_estatus==3 || $id_pago_estatus == 4) echo "<th >Estatus</th>";?>
                          <th >Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                      <?php
                      if (isset($pago) AND $pago!="") {
                      foreach($pago as $value){
                      ?>

                      <tr>
                        <?php
                          echo "<th><a target='_blank' href='".base_url()."Cpublicacion/verPublicacion/".$value->id_publicacion."'>".$value->id_publicacion."</a></th>";
                          echo "<th>".$value->cedula."</th>";
                          echo "<th>".$value->nombre_tipo_pago."</th>";
                          echo "<th>".$value->nombre_banco_origen."</th>";
                          echo "<th>".$value->nombre_banco_destino."</th>";
                          echo "<th>".$value->num_pago."</th>";                      
                          echo "<th>".$value->fecha_operacion."</th>";
                          echo "<th>".$value->hora_operacion."</th>";
                          echo "<th>".$value->precio_publicacion." BsS</th>";
                           echo "<th>".$value->fecha_now."</th>";


        switch ($id_pago_estatus) {
          case '1'://por verificar
              echo '<th>
                  <form action="'.base_url().'Cadministrador/VaccionesComentarioAdm" method="post">
                  <input type="hidden" class="form-control" name="id_pago_estatus" value="1">
                  <input type="hidden" class="form-control" name="accion" value="2">
                  <input type="hidden" class="form-control" name="id_pago" value="'.$value->id_pago.'">
                  <input type="hidden" class="form-control" name="ultimo_comentario" value="'.$value->ultimo_comentario.'">
                  <input type="hidden" class="form-control" name="id_publicacion" value="'.$value->id_publicacion.'">
                  <button class="btn btn-warning" type="submit">&nbsp&nbsp&nbspCambiar a Verificado&nbsp&nbsp&nbsp</button>
                  </form>
                  </th>';
            break;
          case '2'://Verificando

              echo '<th>
                  <form action="'.base_url().'Cadministrador/VaccionesComentarioAdm" method="post">
                  <input type="hidden" class="form-control" name="id_pago_estatus" value="2">
                  <input type="hidden" class="form-control" name="accion" value="3">
                  <input type="hidden" class="form-control" name="id_pago" value="'.$value->id_pago.'">
                  <input type="hidden" class="form-control" name="ultimo_comentario" value="'.$value->ultimo_comentario.'">
                  <input type="hidden" class="form-control" name="id_publicacion" value="'.$value->id_publicacion.'">
                  <button class="btn btn-success" type="submit">&nbsp&nbsp&nbspCambiar a consolidado&nbsp&nbsp&nbsp</button>
                  </form>
                  <form action="'.base_url().'Cadministrador/VaccionesComentarioAdm" method="post">
                  <input type="hidden" class="form-control" name="id_pago_estatus" value="2">
                  <input type="hidden" class="form-control" name="accion" value="4">
                  <input type="hidden" class="form-control" name="id_pago" value="'.$value->id_pago.'">
                  <input type="hidden" class="form-control" name="ultimo_comentario" value="'.$value->ultimo_comentario.'">
                  <input type="hidden" class="form-control" name="id_publicacion" value="'.$value->id_publicacion.'">
                  <button class="btn btn-danger">&nbsp&nbsp&nbspAnular reporte de pago&nbsp&nbsp&nbsp</button>
                  </form>                    
                  </th>';
            break;
          case '3'://Consolidado
              echo '<th>
                  <button class="btn btn-success">Pago consolidado <br> Publicación activa</button>
                  </th>';

              echo '<th>
                  <form action="'.base_url().'Cadministrador/VaccionesComentarioAdm" method="post">
                  <input type="hidden" class="form-control" name="id_pago_estatus" value="3">
                  <input type="hidden" class="form-control" name="accion" value="4">
                  <input type="hidden" class="form-control" name="id_pago" value="'.$value->id_pago.'">
                  <input type="hidden" class="form-control" name="ultimo_comentario" value="'.$value->ultimo_comentario.'">
                  <input type="hidden" class="form-control" name="id_publicacion" value="'.$value->id_publicacion.'">
                  <button class="btn btn-danger">&nbsp&nbsp&nbspAnular&nbsp&nbsp&nbsp</button>                    
                  </form>
                  </th>';   
            break;
          case '4'://Anulado

              echo '<th>
                  <button class="btn btn-danger">&nbsp&nbsp&nbspAnulado&nbsp&nbsp&nbsp</button>
                  </th>';
              echo '<th>
                  <form action="'.base_url().'Cadministrador/VaccionesComentarioAdm" method="post">
                  <input type="hidden" class="form-control" name="id_pago_estatus" value="4">
                  <input type="hidden" class="form-control" name="accion" value="1">
                  <input type="hidden" class="form-control" name="id_pago" value="'.$value->id_pago.'">
                  <input type="hidden" class="form-control" name="ultimo_comentario" value="'.$value->ultimo_comentario.'">
                  <input type="hidden" class="form-control" name="id_publicacion" value="'.$value->id_publicacion.'">
                  <button class="btn">REVERSAR</button>
                  </form> 

                  </th>';
            break;
        }                                 

                        ?>
                      </tr>
                      <?php } }?>
                    </tbody>
                </table>

        </div>
      </div>


    </section>

  </div>

