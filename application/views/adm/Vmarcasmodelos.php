<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Listado de Marca y Modelos
      <?php
      ?>
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Marcas y Modelos registrados en el sistema</li>
    </ol>
  </section>
  <br>
  <br>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning">
          <p>ADVERTENCIA: se debe tener precaución al usar este modulo, se podra crear, eliminar y actualizar Marcas y Modelos cargados en el Sistema, funcional para los filtros de busqueda y creación de Publicaciones</p>
        </div>
      </div>
    </div>

    <?php if ($this->session->flashdata('mensaje')) { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>
      </div>
    <?php } ?>
    <?php if ($this->session->flashdata('mensajecompletado')) { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success"> <?php echo $this->session->flashdata('mensajecompletado'); ?></div>
        </div>
      </div>
    <?php } ?>
    <?php if ($this->session->flashdata('mensaje2')) { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
        </div>
      </div>
    <?php } ?>

    <div class="row">
      <div class="col-md-6 col-md-offset-3">

        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Crear Marca</h3>
          </div>
          <form class="form-horizontal" action="<?php echo base_url(); ?>crearmarcaadm" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label for="marca" class="col-sm-2 control-label">Marca</label>
                <div class="col-sm-10">
                  <input type="text" id="marca" name="marca" maxlength="30" placeholder="marca" class="form-control" value="<?php echo set_value('marca'); ?>" required>
                </div>
              </div>

              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
              <div class="form-group">
                <div class="col-sm-2 col-sm-offset-5">
                  <button type="submit" class="btn btn-info btn-mini">Crear Marca</button>
                </div>
              </div>

            </div>
          </form>
        </div>

        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Crear Modelo</h3>
          </div>

          <form class="form-horizontal" action="<?php echo base_url(); ?>crearmodeloadm" method="POST">
            <div class="box-body">

              <div class="form-group">
                <label for="id_marca" class="col-sm-2 control-label">Marcas</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_marca" id="id_marca" required>
                    <?php
                    foreach ($marcas_activo as $marca) {
                      echo '<option value="' . $marca->id_marca . '">' . ucwords($marca->marca) . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="modelo" class="col-sm-2 control-label">Modelo</label>
                <div class="col-sm-10">
                  <input type="text" id="modelo" name="modelo" maxlength="8" placeholder="modelo" class="form-control" value="<?php echo set_value('modelo'); ?>" required>
                </div>
              </div>


              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
              <div class="form-group">
                <div class="col-sm-2 col-sm-offset-5">
                  <button type="submit" class="btn btn-info btn-mini">Crear Modelo</button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
    <!--row-->




    <div class="row">
      <div class="col-md-12">
        <h1>Marcas Activas e Inactivas en el Sistema</h1>
        <table class="table datatables" style="background-color: white;">
          <thead class="thead-light">
            <tr>
              <th scope="col">id_marca</th>
              <th scope="col">Marcas</th>
              <th scope="col">Estatus</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($marcas_activo)) {
              foreach ($marcas_activo as $key => $marca) {
                echo '<tr>';
                echo '<th scope="row">' . $marca->id_marca . '</th>';
                echo '<td>' . $marca->marca . '</td>';
                echo '<td class="green">Activo</td>';
                echo '<td>
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                      <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu dropdown-menu2">';
                          echo '<li><a href="'.base_url().'addDirectorio/'.$value->id_usuario.'">Actualizar</a></li>';
                          echo '<li class="divider"></li>';
                          echo '<li><a href="'.base_url().'Cadministrador/eliminarUsuarioDesactivar/'.$value->id_usuario.'">Eliminar</a></li>';
                      echo '</ul>
                  </div>
                </td>';

                echo '</tr>';
              }
            }
            if (isset($marcas_inactivo)) {
              foreach ($marcas_inactivo as $key => $marca) {
                echo '<tr>';
                echo '<th scope="row">' . $marca->id_marca . '</th>';
                echo '<td>' . $marca->marca . '</td>';
                echo '<td class="red">Inactivo</td>';
                echo '<td>
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                      <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu dropdown-menu2">';
                          echo '<li><a href="'.base_url().'addDirectorio/'.$value->id_usuario.'">Actualizar</a></li>';
                          echo '<li class="divider"></li>';
                          echo '<li><a href="'.base_url().'Cadministrador/eliminarUsuarioDesactivar/'.$value->id_usuario.'">Eliminar</a></li>';
                      echo '</ul>
                  </div>
                </td>';
                echo '</tr>';
              }
            }

            ?>
          </tbody>
        </table>

        <h1>Modelos Activos e Inactivos en el Sistema</h1>
        <table class="table datatables" style="background-color: white;">
          <thead class="thead-light">
            <tr>
              <th scope="col">id_modelo</th>
              <th scope="col">Modelos</th>
              <th scope="col">Marcas(id_marca)</th>
              <th scope="col">Estatus</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($modelo_activo)) {
              foreach ($modelo_activo as $key => $modelo) {
                echo '<tr>';
                echo '<th scope="row">' . $modelo->id_modelo . '</th>';
                echo '<td>' . $modelo->modelo . '</td>';
                echo '<td>' . $modelo->marca . '(' . $modelo->id_marca . ')</td>';
                echo '<td class="green">Activo</td>';
                echo '<td>
                <div class="input-group-btn">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu dropdown-menu2">';
                        echo '<li><a href="'.base_url().'addDirectorio/'.$value->id_usuario.'">Actualizar</a></li>';
                        echo '<li class="divider"></li>';
                        echo '<li><a href="'.base_url().'Cadministrador/eliminarUsuarioDesactivar/'.$value->id_usuario.'">Eliminar</a></li>';
                    echo '</ul>
                </div>
              </td>';
                echo '</tr>';

              }
            }
            if (isset($modelo_inactivo)) {
              foreach ($modelo_inactivo as $key => $modelo) {
                echo '<tr>';
                echo '<th scope="row">' . $modelo->id_modelo . '</th>';
                echo '<td>' . $modelo->modelo . '</td>';
                echo '<td>' . $modelo->marca . '(' . $modelo->id_marca . ')</td>';
                echo '<td class="red">Inactivo</td>';
                echo '<td>
                <div class="input-group-btn">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Acciones
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu dropdown-menu2">';
                        echo '<li><a href="'.base_url().'addDirectorio/'.$value->id_usuario.'">Actualizar</a></li>';
                        echo '<li class="divider"></li>';
                        echo '<li><a href="'.base_url().'Cadministrador/eliminarUsuarioDesactivar/'.$value->id_usuario.'">Eliminar</a></li>';
                    echo '</ul>
                </div>
              </td>';
                echo '</tr>';
              }
            }
            ?>
          </tbody>
        </table>

      </div>


  </section>

</div>