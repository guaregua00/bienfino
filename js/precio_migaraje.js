
function consultarPrecio() {
    var id_publicacion = $("#id_publicacion").val();

    if (id_publicacion == "") {
        alert("Error a enviar un email de la publicación actual");
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_publicacion": id_publicacion},
            url: base_url+"Cpublicacion/enviarEmailPublicacion",
            type: "post",
            beforeSend: function () {
                $('#consultar').attr('disabled',true);
            },
            complete: function() { 
                $('#consultar').attr('disabled',false);
            },
            success: function (respuesta1) {
                alert(respuesta1.htmloption1);
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }

}



function agregarMigaraje(id_publicacion) {
    //var id_publicacion = id_publicacion
    if (id_publicacion == "") {
        alert("Error ");
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_publicacion": id_publicacion},
            url: base_url+"Cgaraje/agregarMiGaraje",
            type: "post",
            beforeSend: function () {
                $('#agregar').attr('disabled',true);
            },
            complete: function() { 
                $('#agregar').attr('disabled',false);
            },
            success: function (respuesta) {
                //var like = document.getElementsByTagName('icono-like');
               // var r = like[0].innerHTML;
                //console.log(like);
                if (respuesta.htmloption2) {
                    //alert(respuesta.htmloption2);
                    $('.icono-like').each(function(){
                        valor =$(this).attr('id');
                        if(valor==id_publicacion){
                            $(this).parents().parents().addClass('pub-fav');
                        }
                    });
                }else if(respuesta.htmloption1){
                    alert(respuesta.htmloption1);
                }else if(respuesta.htmloption3){

                    //alert(respuesta.htmloption3);
                    $('.icono-like').each(function(){
                        valor =$(this).attr('id');
                        if(valor==id_publicacion){
                            $(this).parents().parents().removeClass('pub-fav');
                        }
                    });                    
                }
                
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }

}
