function buscarMarcaMenu() {
    var categoria_menu = $("#categoria_menu").val();
    if (categoria_menu == "") {
        $("#marca_menu").html('<option value="">CATEGORIA</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_categoria": categoria_menu},
            url: base_url+"Cpublicacion/getMarca",
            type: "post",
            beforeSend: function () {
            },
            success: function (respuesta1) {

                $("#marca_menu").focus();
                $("#marca_menu").html(respuesta1.htmloption1);
                //customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }

}

function buscarModeloMenu() {

    var marca_menu = $("#marca_menu").val();

    if (marca_menu == "") {
        $("#modelo_menu").html('<option value="">MARCA</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_marca": marca_menu},
            url: base_url+"Cpublicacion/getModelo",
            type: "post",
            beforeSend: function () {
            },
            success: function (respuesta2) {
                $("#modelo_menu").focus();
                $("#modelo_menu").html(respuesta2.htmloption2);
                //customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }
}

function buscarMarcaMenuM() {
    var categoria_menu = $("#categoria_menu_m").val();
    if (categoria_menu == "") {
        $("#marca_menu_m").html('<option value="">CATEGORIA</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_categoria": categoria_menu},
            url: base_url+"Cpublicacion/getMarca",
            type: "post",
            beforeSend: function () {
            },
            success: function (respuesta1) {

                $("#marca_menu_m").focus();
                $("#marca_menu_m").html(respuesta1.htmloption1);
                //customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }

}

function buscarModeloMenuM() {

    var marca_menu = $("#marca_menu_m").val();

    if (marca_menu == "") {
        $("#modelo_menu_m").html('<option value="">MARCA</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"id_marca": marca_menu},
            url: base_url+"Cpublicacion/getModelo",
            type: "post",
            beforeSend: function () {
            },
            success: function (respuesta2) {
                $("#modelo_menu_m").focus();
                $("#modelo_menu_m").html(respuesta2.htmloption2);
                //customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }
}
