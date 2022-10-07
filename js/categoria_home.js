
function buscarMarca() {

    let categoria = $("#categoria").val();
    let formsearch = document.getElementById("formsearch");
    let data = new FormData(formsearch);
    data.append("categoria",categoria);

            
        /*for (const value of data.keys()) {
            console.log(value);
        } */
    if (categoria == "") {
        $("#marca").html('<option>Debe seleccionar una categoria</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            data: data,
            url: base_url+"Cpublicacion/getMarcaHome",
            type: "post",
            beforeSend: function () {
                $("#marca").html('<option>cargando marcas...</option>');
            },
            success: function (respuesta1) {
                $("#marca").html(respuesta1.htmloption1);
            },
            error: function (xhr, err) {
                alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                //alert("ocurrio un error intente de nuevo");
                $("#marca").html('<option>Error seleccione la categoria...</option>');
            }
        });
    }

}

function buscarModelo() {

    let marca = $("#marca").val();

    let formsearch = document.getElementById("formsearch");
    let data2 = new FormData(formsearch);
    data2.append("marca",marca);
        for (const value of data2.keys()) {
            console.log(value);
        }
    if (marca == "") {
        $("#modelo").html('<option value="">Debe seleccionar una Marca</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            cache: false,
            data: data2,
            url: base_url+"Cpublicacion/getModeloHome",
            type: "post",
            beforeSend: function () {
                $("#modelo").html('<option>cargando modelos...</option>');
            },
            success: function (respuesta2) {
                $("#modelo").html('<option></option>');
                console.log(respuesta2.htmloption2);
                if(respuesta2.htmloption2=='false'){
                    $("#modelo").hide();
                }else{
                    $("#modelo").html(respuesta2.htmloption2);
                    $("#modelo").show();
                }
                

            },
            error: function (xhr, err) {
                alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                //alert("ocurrio un error intente de nuevo");
                $("#marca").html('<option>Error seleccione la marca...</option>');
            }
        });
    }
}

function buscarAno() {

    let modelo = $("#modelo").val();

    if (modelo == "") {
        $("#anio").html('<option value="">Debe seleccionar un Modelo</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"modelo": modelo},
            url: base_url+"Cpublicacion/getAno",
            type: "post",
            beforeSend: function () {
            },
            success: function (respuesta3) {
                $("#id_ano").html(respuesta3.htmloption3);
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }
}