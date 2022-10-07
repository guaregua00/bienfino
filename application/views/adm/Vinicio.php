<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $porrevisar[0]; ?></h3>

            <p>Publicaciones Por revisar</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="<?php echo base_url() ?>Cadministrador/publicaciones/6" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $activo[0]; ?><sup style="font-size: 20px"></sup></h3>

            <p>Publicaciones Activas</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url() ?>Cadministrador/publicaciones/1" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $usuarios[0]->cantidad; ?></h3>

            <p>Usuarios Registrados</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $rechazado[0]; ?></h3>

            <p>Publicaciones Rechazadas</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url() ?>Cadministrador/publicaciones/10" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-md-6 col-xs-12 col-md-offset-3">
        <div class="small-box bg-teal">
          <h4 class="title-dashboard">Cantidad de publicaciones por usuario</h4>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Publicaciones</th>
                <th>Usuarios</th>
              </tr>
            </thead>
            <tbody>

              <?php
              if (isset($usuarios)) {

                for ($i = 0; $i < count($usuarios); $i++) {
                  echo '<tr>';
                  echo '<th scope="row">' . $i . '</th>';
                  echo '<td>' . $usuarios[$i]->cantidad . '</td>';
                  echo '<td>' . $usuarios[$i]->usuario . '</td>';
                  echo '</tr>';
                }
              }
              ?>

            </tbody>
          </table>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>


  </section>

</div>
