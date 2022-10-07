    <!-- Page Content -->
    <div class="container">
      <div class="row">
      	<div class="col-md-12">

            <h1 class="text-danger text-center"> <span class="glyphicon glyphicon-dashboard"></span> &nbsp Mi Garaje</h1>
     
          <div class="panel panel-info">
            <div class="panel-heading"><h5 class="text-center">Vehiculos</h5></div>
            <div class="panel-body">

                <table id="migaraje" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="col-md-2">Imagen</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>

                    <tbody>
            <?php
            if (isset($garaje) AND $garaje!="") {
                foreach ($garaje as $value) {

                  echo "<tr>";
                    echo "<th><a href='".base_url()."Cpublicacion/verPublicacion/".$value->id_publicacion."'><img src='".base_url()."publicaciones/"."$value->codigo"."/".$value->url_uno."' alt='imagen' class='img-thumbnail'></a></th>";
                    echo "<th>".$value->marca."</th>";
                    echo "<th>".$value->modelo."</th>";
                    echo "<th>".$value->id_ano."</th>";
                    echo "<th><a href='".base_url()."Cpublicacion/verPublicacion/".$value->id_publicacion."'><span class='glyphicon glyphicon-search green'>&nbsp</span></a> <a href='".base_url()."Cgaraje/eliminarPublicacion/".$value->id_publicacion."'><span class='glyphicon glyphicon-remove red'>&nbsp</span></a></th>";
                  echo "</tr>";
                }
            }

            ?>
                    </tbody>
                </table>
            </div>
          </div>                
      	</div><!--col-md-8 col-md-offset-2"-->
      </div><!--row-->
    </div><!--container-fluid-->      