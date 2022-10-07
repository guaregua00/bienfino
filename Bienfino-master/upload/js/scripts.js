$(document).ready(function(){
    // Modal

    $(".modal").on("click", function (e) {
        //console.log(e);
        if (($(e.target).hasClass("modal-main") || $(e.target).hasClass("close-modal")) && $("#loading").css("display") == "none") {
            closeModal();
        }
    });

    // -> Modal

    // Abrir el inspector de archivos
    
    $(document).on("click", "#add-photo", function(){
        $("#add-new-photo").click();
    });
    
    // -> Abrir el inspector de archivos

    var formData = new FormData();

    // Cachamos el evento change
    /*romel se crea la preview de las imagenes y se valida el tipo de archivo*/
    $(document).on("change", "#add-new-photo", function () {
        let fileUpload = $("input[type='file']");
        let cantidadImgPrevisulizadas = document.getElementsByClassName("preview").length;//cantidad de imagenes ya previsualizasas antes
        let cantidadImgPorPrevisulizar = parseInt(fileUpload.get(0).files.length);//cantidad de imagenes x previsualizar
        let suma = cantidadImgPorPrevisulizar + cantidadImgPrevisulizadas;//cantidad maxima de img previsualizadas x cargar
        if (suma<=6){
        
            var files = this.files;
            var supportedImages = ["image/jpeg", "image/png", "image/gif"];
            var seEncontraronElementoNoValidos = false;
            var i = 0;
            for (var i = 0; i < files.length; i++) {
                //console.log(files[i]);//cada uno de las imagenes
                
                if (supportedImages.indexOf(files[i].type) != -1) {
                    var id = getRandomString(7);
                    createPreview(files[i], id);//se agrega un div con la minitura antes de boton add #add-new-photo
                    formData.append(id, files[i]);
                    if(suma==6){
                        $(".add-new-photo").hide();//oculta boton de cargar img al contener 6 preveiw
                    }                    
                    
                }
                else {
                    seEncontraronElementoNoValidos = true;
                }
            }
            
            if (seEncontraronElementoNoValidos) {
                alertify.myAlert('Se encontraron archivos no validos');
            }
            else {
                if(suma>=6){
                    $("#btn-upload").focus();
                }
                console.log("Img previsualizada correctamente.");

            }
        }else{
            //showMessage("Debe seleccionar maximo 6 imagenes");
            alertify.myAlert('Debe seleccionar maximo 6 imagenes');
        }
    
    });
    
    // -> Cachamos el evento change

    // Eliminar previsualizaciones
    
    $(document).on("click", "#Images .image-container", function(e){
        var parent = $(this).parent();
        console.log($(this).parent().attr("id"));
        var id = $(parent).attr("id");//captura el id del contenedor de la imagen
        formData.delete(id);//elimina la imagen en formData
        $(parent).remove();//remueve el contenedor de la imagen
        $(".add-new-photo").show();
 
    });
    
    // -> Eliminar previsualizaciones


    // Al enviar el formulario
    $(document).on("submit", "#upload-multi-images", function (e) {
    //$("#btn-upload").click(function(){
    //cuando envie el form
        e.preventDefault();
        //hidePreviewImg();

        formData.append("codigo",$('#codigo').val());
        //Envio mediante Ajax
        $.ajax({
            url: base_url+"Cpublicacion/uploadImage",
            type: "post",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                loading(true, "Subiendo foto...");
                $("#btn-upload").hide();
                $("#btn-b-continuar").hide();
                $("#btn-b-regresar").hide();
                $("figcaption").hide();
 
            },
            success: function (res) {
                //$( "#progressbar" ).progressbar("destroy");
                $("#progressbar").hide();   
                $("#btn-upload").show();
                $("#btn-b-continuar").show();
                $("#btn-b-regresar").show();
                $("figcaption").show();                
                if (res.status) {
                    createImages(res[0].all_ids);
                    $("#Images form .row > div:not(#add-photo-container)").remove();//remueve todo menos add-photo-container
                    $(".add-new-photo").show();
                    $('#MyImages').show();
                    //hidePreviewImg();
                    hideShowUpload();
                    formData = new FormData();
                } else {
                    if(res.error==0){
                        //alertify.myAlert(res.msg);
                        alertify.alert('Error', res.msg);
                    }
                    if(res.error==1){
                        alertify.errorAlert(res.msg+' intenta de nuevo.');
                        setTimeout(() => { window.location.href = base_url+'publicardos/'+$('#codigo').val(); }, 5000);
                    }
                    loading(false);                    
                    console.log(res);//imprime mensaje
                    
                }
            },
            xhr: function() {
                $("#progressbar").show()
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(e) {
                    if (e.lengthComputable) {
                      //var uploadPercent = e.loaded / e.total; typo uploadpercent (all lowercase)
                      var uploadpercent = e.loaded / e.total; 
                      uploadpercent = (uploadpercent * 100); //optional Math.round(uploadpercent * 100)
                      $( "#progressbar" ).progressbar({
                        value: uploadpercent
                      });
                    /*	$('.progress-bar').text(uploadpercent + '%');
                      $('.progress-bar').width(uploadpercent + '%');
                      if (uploadpercent == 100) {
                        $('.progress-bar').text('Completed');
                      }*/
                    }
                  }, false);                              
                return xhr;
            },                
            error: function (e) {
                console.log(e.responseText);
                $("#progressbar").hide();   
                $("#btn-upload").show();
                $("#btn-b-continuar").show();
                $("#btn-b-regresar").show();
                $("figcaption").show();                
            }
        });
        
    
    });
    
    // -> Al enviar el formulario

    // Eliminar imagenes subidas
    $(document).on("click", "#MyImages .image-container figcaption", function (e) {
        
        let formData2 = new FormData();
        let parent = $(this).parent().parent();
        console.log(parent);
        let id = $(parent).attr("data-id");
        $(parent).parent().remove();//remueve img seleccionada
        hideShowUpload();//muestra el boton de cargar
        let codigo = $('#codigo').val();
        formData2.append('codigo',codigo);
        formData2.append('id_img',id);

        $.ajax({
            url: base_url+"Cpublicacion/deleteImage",
            type: "post",
            dataType: "json",
            data: formData2,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                //loading(true, "Subiendo foto...");
            },
            success: function (res) {
                formData2 = new FormData();
                //loading(false);
                if (res.status) {
                    console.log(res.msg);
                } else {
                    //loading(false);                    
                    console.log(res.msg);//imprime mensaje
                    //showMessage(res.msg);
                }
            },
            error: function (e) {
                console.log(e.responseText);
            }
        });



    });

    // -> Eliminar imagenes subidas

});

//Genera una cadena aleatoria según la longitud dada
function getRandomString(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < length; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

//Genera las previsualizaciones
function createPreview(file, id) {
    var imgCodified = URL.createObjectURL(file);
    var img = $('<div class="img-cargada preview" id="' + id + '"><div class="image-container"> <figure> <img src="' + imgCodified + '" alt="Foto del usuario"> <figcaption> <i class="fas fa-times"></i> </figcaption> </figure> </div></div>');
    $(img).insertBefore("#add-photo-container");
}

//Crea todas las imágenes y las pone en el documento
function createImages(all_ids) {
    for (const key in all_ids) {
        var image = all_ids[key];

        var img = $('<div class="img-cargada romel" data-id="' + image.id + '"><div class="image-container" data-id="' + image.id + '"> <figure> <img src="'+base_url+'publicaciones/'+image.codigo+'/'+ image.name + '" alt="Foto del usuario"> <figcaption> <i class="fas fa-times"></i> </figcaption> </figure> </div></div>');
        $("#my-images").append(img);
    }
}



function showModal(card) {
    $("#" + card).show();
    $(".modal").addClass("show");
  }
  
  function closeModal() {
    $(".modal").removeClass("show");
    setTimeout(function () {
      $(".modal .modal-card").hide();
    }, 300);
  }
  
  function loading(status, tag) {
    if (status) {
      $("#loading .tag").text(tag);
      showModal("loading");
    }
    else {
      closeModal();
    }
  }
  
  function showMessage(message) {
    $("#Message .tag").text(message);
    showModal("Message");
  }
  //oculta y muestra la lista de imagenes previsualisadas y el boton de cargar cuando es igual a 6 las imagenes cargadas
  function hideShowUpload(){
    if(document.querySelectorAll('#my-images > .img-cargada').length=='6'){
        $("#Images").hide();
    }else if(document.querySelectorAll('#my-images > .img-cargada').length<'6'){
        $("#Images").show();
    }      
  }
//oculta las imagenes previsualisadas y limpia el obj formData
  function hidePreviewImg(){
    $(".preview").hide();
    formData = new FormData();  
  }
  function hideButtonAddPhoto(){
    $("#add-photo").hide();
    formData = new FormData();
  }


  
  