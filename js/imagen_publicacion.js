  //codigo donde oculto o muestro las opciones de imagenes de acuerdo a a seleccion

  $(document).ready(function()
    {
      $("#foto5").attr('checked', false);
      $("#foto6").attr('checked', false);
      $("#foto5").attr("required", "false");
      $("#foto6").attr("required", "false");      
      $(".imagenes-plan").hide();
    $("input[name=id_precio]").change(function () {   
        if($(this).val() == 1){
          $('.imagenes-plan').hide();
          $('#foto5').attr('disabled', true);
          $('#foto6').attr('disabled', true);


        }else if($(this).val() == 2){
          $('.imagenes-plan').show();
          $("#foto5").removeAttr('disabled');
          $("#foto6").removeAttr('disabled');
          $("#foto5").attr("required", "true");
          $("#foto6").attr("required", "true");
        }

      });


});