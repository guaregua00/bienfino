function buscarMarca() {

    var id_categoria = $("#id_categoria").val();
    console.log(id_categoria);
    if (id_categoria == "") {
        $("#id_marca").html('<option value="">CATEGORIA</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_categoria": id_categoria},
            url: base_url+"Cpublicacion/getMarca",
            type: "post",
            beforeSend: function () {
            },
            success: function (respuesta1) {
                console.log(respuesta1.htmloption1)
                $("#id_marca").html(respuesta1.htmloption1);
                customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }

}

function buscarModelo() {

    var id_marca = $("#id_marca").val();

    if (id_marca == "") {
        $("#id_modelo").html('<option value="">MARCA</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_marca": id_marca},
            url: base_url+"Cpublicacion/getModelo",
            type: "post",
            beforeSend: function () {
            },
            success: function (respuesta2) {
                $("#id_modelo").html(respuesta2.htmloption2);
                customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }
}

function buscarAno() {

    var id_modelo = $("#id_modelo").val();

    if (id_modelo == "") {
        $("#id_ano").html('<option value="">MODELO</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_modelo": id_modelo},
            url: base_url+"Cpublicacion/getAno",
            type: "post",
            beforeSend: function () {
            },
            success: function (respuesta3) {
                $("#id_ano").html(respuesta3.htmloption3);
                customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }
}