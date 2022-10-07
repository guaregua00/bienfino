//sin funcionalidad
function buscarMarca() {

    var id_categoria = $("#id_categoria").val();
    if (id_categoria == "") {
        $("#id_categoria").html('<option value="">Debe seleccionar una Categoria</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_categoria": id_categoria},
            url: base_url+"Cpublicacion/getMarca",
            type: "post",
            beforeSend: function () {
                $("#id_marca").html('<option>cargando marcas...</option>');
                customSelectCall();                
            },
            success: function (respuesta1) {
                $("#id_marca").html(respuesta1.htmloption1);
                customSelectCall();
            },
            error: function (xhr, err) {
                alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                //alert("ocurrio un error intente de nuevo");
            }
        });
    }

}

function buscarModelo() {

    var id_marca = $("#id_marca").val();

    if (id_marca == "") {
        $("#id_modelo").html('<option value="">Debe seleccionar una Marca</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_marca": id_marca},
            url: base_url+"Cpublicacion/getModelo",
            type: "post",
            beforeSend: function () {
                $("#id_modelo").html('<option>cargando modelos...</option>');
                customSelectCall();                
            },
            success: function (respuesta2) {
                $("#id_modelo").html(respuesta2.htmloption2);
                customSelectCall();
            },
            error: function (xhr, err) {
                console.log("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                //alert("ocurrio un error intente de nuevo");
            }
        });
    }
}

function buscarAno(anio) {
    
    let html = '<option value="">Año</option>';
    for (let i = anio; i >= 1900 ; $i--) {
        html += "<option value=" + i + ">" + i + "</option>";
    }
    $("#id_ano").html(html);
    customSelectCall();
}