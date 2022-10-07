function buscarMunicipios2() {
    var estado = $("#codigoestado").val();

    if (estado == "") {
        $("#codigomunicipio").html('<option value="">Debe seleccionar un estado por favor</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"codigoestado": estado},
            url: base_url+"Cgeo/getMunicipios2",
            type: "post",
            beforeSend: function () {
                $("#codigomunicipio").html('<option>cargando municipios...</option>');
                customSelectCall();                
            },
            success: function (respuesta1) {

                $("#codigomunicipio").html(respuesta1.htmloption1);
                customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
            	alert("ocurrio un error intente de nuevo");
            }
        });
    }

}

function buscarParroquia() {
    var municipio = $("#codigomunicipio").val();
    var estado = $("#codigoestado").val();

    if (municipio == "") {
        $("#codigoparroquia").html('<option value="">Debe seleccionar un Municipio por favor</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"codigomunicipio": municipio,"codigoestado": estado},
            url: base_url+"Cgeo/getParroquias",
            type: "post",
            beforeSend: function () {
                $("#codigoparroquia").html('<option>cargando municipios...</option>');
                customSelectCall(); 
            },
            success: function (respuesta2) {
                $("#codigoparroquia").html(respuesta2.htmloption2);
                customSelectCall();
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
            	alert("ocurrio un error intente de nuevo");
            }
        });
    }
}

//para el admnistrador

function buscarMunicipiosadm() {
    var estado = $("#codigoestado").val();

    if (estado == "") {
        $("#codigomunicipio").html('<option value="">Debe seleccionar un estado por favor</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"codigoestado": estado},
            url: base_url+"Cgeo/getMunicipios2",
            type: "post",
            beforeSend: function () {
                $("#codigomunicipio").html('<option>cargando municipios...</option>');           
            },
            success: function (respuesta1) {

                $("#codigomunicipio").html(respuesta1.htmloption1);
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }

}

function buscarParroquiaadm() {
    var municipio = $("#codigomunicipio").val();
    var estado = $("#codigoestado").val();

    if (municipio == "") {
        $("#codigoparroquia").html('<option value="">Debe seleccionar un Municipio por favor</option>');
    }
    else {
        $.ajax({
            dataType: "json",
            data: {"codigomunicipio": municipio,"codigoestado": estado},
            url: base_url+"Cgeo/getParroquias",
            type: "post",
            beforeSend: function () {
                $("#codigoparroquia").html('<option>cargando municipios...</option>');
            },
            success: function (respuesta2) {
                $("#codigoparroquia").html(respuesta2.htmloption2);
            },
            error: function (xhr, err) {
                //alert("readyState =" + xhr.readyState + " estado =" + xhr.status + "respuesta =" + xhr.responseText);
                alert("ocurrio un error intente de nuevo");
            }
        });
    }
}