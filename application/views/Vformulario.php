


<div class="contenedor">
  
<!--
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>"> Inicio</a> <span class="divider">/</span></li>
    <li id="paso_a" class="negritas">Datos personales<span class="divider">/</span></li>
    <li id="paso_b">Domicilio <span class="divider">/</span></li>
    <li id="paso_c">Confirmación<span class="divider">/</span></li>
  </ul>
-->

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

  <?php
    $this->load->view('publicacion/formpublicacion/formpublicacionuno');
  ?>


  <?php
    $this->load->view('publicacion/formpublicacion/formpublicaciondos');
  ?>

  <?php
    $this->load->view('publicacion/formpublicacion/formpublicaciontres');
  ?>

</div>


<script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/imagen_publicacion.js"></script>
<script src="<?php echo base_url();?>js/geo.js"></script>
<script src="<?php echo base_url();?>js/categoria_publicar.js"></script>
<script src="<?php echo base_url();?>js/validaciones/publicacion_registro.js"></script>
<script src="<?php echo base_url();?>js/validaciones/publicacion_registro_paso_a.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>


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


<script>
//menu
  $("#categoria_menu").change(function(){
    buscarMarcaMenu();
  });

  $("#marca_menu").change(function(){
    buscarModeloMenu();
  });

</script>



<script type="text/javascript">

$(function(){
  // detectar que botón se esta accionando
  $('body').on('click','#cont_formularios a',function(elemento){
    elemento.preventDefault();

    mostrar = $(this).attr('id');
    
    // Seleccionar la sección a mostrar
    if(mostrar == 'back_paso_a'){
      $('#form_paso_b').hide();
      $('#form_paso_a').show();

      $('#paso_b').removeClass('negritas');
      $('#paso_a').addClass('negritas');
    }
    else if (mostrar == 'back_paso_b') {
      $('#form_paso_c').hide();
      $('#form_paso_b').show();

      $('#paso_c').removeClass('negritas');
      $('#paso_b').addClass('negritas');
    }
    else if (mostrar == 'go_terminar'){
      var dataForm = $('#form_a, #form_b').serialize();

      alert(dataForm);
    }
  });

  // Formulario datos personales
  $('#form_a').validate({
    submitHandler: function(){

    $('#form_paso_a').hide();
    $('#form_paso_b').show();

    $('#paso_b').addClass('negritas');

    return false;
    },
    errorPlacement: function(error, element) {
      error.appendTo(element.parent().append());
    }
  });

  $('#form_b').validate({
    submitHandler: function(){

      // Serilizamos formularios
      var datosForm = $('#form_a, #form_b').serialize();

      // Cargamos los datos de los campos a variables
      nombre    = $('#reg_nombre').val();
      paterno   = $('#reg_paterno').val();
      materno   = $('#reg_materno').val();
      calle     = $('#reg_calle').val();
      colonia   = $('#reg_colonia').val();
      ciudad    = $('#reg_ciudad').val();
      postal    = $('#reg_codigo_postal').val();
      delegacion  = $('#reg_delegacion').val();
      estado    = $('#reg_estado').val();



      // llenamos la lista en pantalla
      $('#txt_Nombre').text(nombre);
      $('#txt_Paterno').text(paterno);
      $('#txt_Materno').text(materno);
      $('#txt_Calle').text(calle);
      $('#txt_Colonia').text(colonia);
      $('#txt_Ciudad').text(ciudad);
      $('#txt_CPostal').text(postal);
      $('#txt_Delegacion').text(delegacion);
      $('#txt_Estado').text(estado);

      // mostramos y ocultamos areas
      $('#form_paso_c').show();
      $('#form_paso_b').hide();

      $('#paso_c').addClass('negritas');

      return false;
    },
    errorPlacement: function(error, element) {
      error.appendTo(element.parent().append());
    }
  });

});
    //al iniciar se muestra el paso 1
    $('#form_paso_a').show();
    $('#form_paso_b').hide();
    $('#form_paso_c').hide();


/*..................Continuar..................*/
        //continuar al paso 2
        
        $("#btn-a-continuar").click(function () {    
          $('#form_paso_a').hide();
          $('#form_paso_b').show("slow");
         });

        //continuar al paso 3
       $("#btn-b-continuar").click(function () {    
          $('#form_paso_c').show("slow");
          $('#form_paso_b').hide();
         });
         
/*..................Continuar..................*/


/*..................Regresar..................*/
       $("#btn-b-regresar").click(function () {    
          $('#form_paso_a').show("slow");
          $('#form_paso_b').hide();
         });

       $("#btn-c-regresar").click(function () {    
          $('#form_paso_b').show("slow");
          $('#form_paso_c').hide();
         })
/*..................Regresar..................*/              
</script>





  </body>
</html>

<!--
    24/04/19
1)buscar la forma de validar los campos por pasos
2)hacer la prueba de los step a ver si guarda la informacion correctamente
3)luego acomodar el formulario de acuerdo a los requerimientos
4)buscar la forma de subir la imagen en funcion del formulario actual
-->