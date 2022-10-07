


<div class="contenedor">

    <div class="flex-col">
      <div class="titulo-descripcion">
              <label>Reporte de pago</label>
              <!--<span>Cambiar contraseña</span>-->
      </div>
    </div><!--flex-col-->  
      <?php 
      if ($pago) {
      ?>
<p><a class="btn btn-back btn-lg" href="<?php echo base_url();?>misPublicacionesExito" role="button">Volver a Mis publicaciones</a></p>
     

            <table class="table table-hover">

                    <tr>
                      <th>Tipo Pago</th>
                      <th>Banco donde realizo el pago (Origen)</th>
                      <th>Banco dende realizo el pago (Destino)</th>
                      <th>Número Pago</th>                      
                      <th>Fecha</th>
                      <th>Hora</th>
                    </tr>
                    <tr>
                      <?php  
                      echo "<td>".$pago->nombre_tipo_pago."</td>";
                      echo "<td>".$pago->nombre_banco_origen."</td>";
                      echo "<td>".$pago->nombre_banco_destino."</td>";
                      echo "<td>".$pago->num_pago."</td>";                      
                      echo "<td>".$pago->fecha_operacion."</td>";
                      echo "<td>".$pago->hora_operacion."</td>";                   
                        
                      ?>
                    </tr>

                  </table>

                  <?php if($pago->id_pago_estatus == 1){?>
                  <form method='POST' action='<?php echo base_url();?>Cpago/eliminarReportePago'>
                      <input type='hidden' name='id_publicacion' value='<?php echo $pago->id_publicacion; ?>'>
                      <button type='submit' class='btn btn-danger'>&nbsp Eliminar Reporte de pago</button>
                  </form>
                  <?php } ?>


                  <br>                  
                  

            
        <?php 
          }
        ?>   
</div>

<?php
  $this->view('layouts/Vfooter');
?>
<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>


<script>
//menu
  $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });

  $("#marca_menu").change(function(){
    buscarModeloMenu();
  });

</script>



</body>
</html>
