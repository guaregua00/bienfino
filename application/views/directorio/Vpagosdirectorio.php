
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pagos de Directorio
        <small>Panel  de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
                   
          <div class="container">
            <div class="row">
              <div class="col-md-12" style="padding:10px">
                <div class="alert alert-info"> 
                    <p><strong>Importante:</strong> en esta sección podra verificar los datos de pago asociados a cada directorio y poder activar los mismos.</p></div>
              </div>
            </div>
          </div>
         

          <?php if($this->session->flashdata('mensajecompletado')){ ?>
                <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success"> <?php echo $this->session->flashdata('mensajecompletado'); ?></div>
                  </div>
                </div>
          <?php }?>

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
                      <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
                  </div>
                </div>
          <?php }?>

          
    <section class="content">
      <div class="row">
        <div class="col-md-12">

            <!--<h1 class="text-danger text-center"> <span class="glyphicon glyphicon-dashboard"></span> &nbsp Usuarios</h1>-->

                <table id="listausuario" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>(ID)Empresa</th>
                            <th>Metodo de Pago</th>
                            <th>Banco Origen</th>
                            <th>Banco Destino</th>
                            <th>Monto</th>
                            <th>Referencia</th>
                            <th>Fecha Pago Creado</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php

        //var_dump($usuarios);exit;



            if (isset($pagosdirectorios) AND $pagosdirectorios!="") {
                foreach ($pagosdirectorios as $value) {

                  echo "<tr>";
                    echo "<th>".$value->email." (".$value->cedula.")</th>";
                    echo "<th>(".$value->id.") ".$value->nombre."</th>";
                    if($value->metodo_pago=="")
                    echo "<th>------------</th>";
                    else echo "<th>".$value->metodo_pago."</th>";
                    if($value->banco_origen=="")
                    echo "<th>------------</th>";
                    else echo "<th>".$value->banco_origen."</th>";
                    if($value->banco_destino=="")
                    echo "<th>------------</th>";
                    else echo "<th>".$value->banco_destino."</th>";
                    echo "<th>".$value->monto."</th>";
                    echo "<th>#".$value->referencia."</th>";
                    echo "<th>".humanize_date($value->fecha_creado, 'long')."</th>";
                    if ($value->estatus=='verificado') {
                      echo "<th class='green'>Verificado</th>";
                    }elseif ($value->estatus=='sin verificar') {
                      echo "<th class='red'>Sin Verificar</th>";
                    }elseif ($value->estatus=='reversado') {
                      echo "<th class='orange'>reversado</th>";
                    }else{
                      echo "<th>------------</th>";
                    }

                    echo '<th>
                        <div class="input-group-btn">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                          <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu dropdown-menu2">';

                          echo '<li><a href="'.base_url().'verificarActivarDirectorio/'.$value->id_directorio_pago.'/'.$value->id_directorio.'">Verificar y Activar Directorio</a></li>';
                          //Acceso a reversar solo x el administrador
                          if($this->session->userdata('id_perfil')=='1'){
                            echo '<li class="divider"></li>';
                            echo '<li><a href="'.base_url().'reversarDesactivarDirectorio/'.$value->id_directorio_pago.'/'.$value->id_directorio.'">Reversar y Desactivar Directorio</a></li>';
                          }
                          echo '</ul>
                        
                        </div>
                    </th>';                           
                  echo "</tr>";

                }
            }

            ?>
                    </tbody>
                </table>
        </div><!--col-md-8 col-md-offset-2"-->
      </div><!--row-->
    </section>

  </div>
<style>
  .dropdown-menu2{
    right: 0 !important;
  }
</style>