
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Historico de operaciones de reporte de pago
        <?php
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


    <!-- Main content -->
    <section class="content">

      <div class="row">
   
        <div class="col-md-12">

                <table id="listahistoricopago" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                          <th>Id Usuario</th>                   
                          <th>Acción</th>
                          <th>Administrador</th>
                          <th>Fecha</th>

                        </tr>
                    </thead>

                    <tbody>
                      <?php
                      if (isset($pagohistorico) AND $pagohistorico!="") {
                      foreach($pagohistorico as $value){
                      ?>

                      <tr>
                        <?php
                          echo "<th>".$value->id_usuario."</th>";                          
                          echo "<th>".$value->accion."</th>";
                          echo "<th>".$value->usuario."</th>";                          
                          echo "<th>".$value->fecha."</th>";
                            ?>
                          </tr>
                          <?php } }?>
                    </tbody>
                </table>

        </div>
      </div>


    </section>

  </div>

