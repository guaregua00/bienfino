$(function () {
    $('#ubicacion').validate({
        rules: {
            'codigoestado': {
                required : true
            },
            'codigomunicipio': {
                required : true
            },           
            'codigoparroquia':{
                required: true
            },
            'direccion_esp':{
                required : true,
                minlength : 3,
                maxlength: 255
            }
        },
        messages:
        {
            moviluno:{required: 'El campo es requerido', minlength: 'Debe ser igual a 11 números', digits: 'Permitido solo números', maxlength: 'Debe ser igual a 11 números'},
            nac:{required: 'El campo es requerido'},
            codigoestado:{required: 'El campo es requerido'},
            codigomunicipio: {required: 'El campo es requerido'},
            codigoparroquia: {required: 'El campo es requerido'},
            direccion_esp:{required: 'El campo es requerido',minlength: 'Debe ser mayor o igual a 3 caracteres', maxlength: 'Debe ser menor o igual a 255 caracteres'}
        },

        highlight: function (input) {
            //console.log(input);
            $(input).parents('.group-text-field').addClass('rojo');
        },
        unhighlight: function (input) {
            $(input).parents('.group-text-field').removeClass('rojo');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.group-text-field').append(error);
        },
        submitHandler: function (form) {

            $('#boton_enviar_ubicacion').attr('disabled', true);
            form.submit(form);
        }
    });
});

$.validator.addMethod( "telfmovil", function( value, element ) {
    return this.optional( element ) || /^[0][4|2][0-9]{9}$/i.test( value );
}, "Ingresa un formato correcto" );


