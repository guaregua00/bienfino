$(function () {
    $('#reporte_pago').validate({
        rules: {

            'id_banco_ori': {
                required : true,
                digits: true
            },
            'id_banco_des': {
                required : true,
                digits: true
            },
            'id_tipo_pago':{
                required:true,
                digits: true
            },
            'num_pago':{
                required:true,
                digits: true,
                minlength : 10,
                maxlength: 10                
            },
            'fecha_operacion':{
                required : true
            },
            'hora_operacion':{
                required : true
            }
        },
        messages:
        {
            cedula:{required: 'El campo es requerido', minlength: 'Debe ser mayor o igual a 7 caracteres', digits: 'Permitido solo números', maxlength: 'Debe ser menor o igual a 8 caracteres'},
            nac:{required: 'El campo es requerido'},
            email:{required: 'El campo es requerido', email: 'Dirección de Correo invalido', maxlength: 'Debe ser menor o igual 100 caracteres'},
            email_r:{required: 'El campo es requerido', email: 'Dirección de Correo invalido', maxlength: 'Debe ser menor o igual 100 caracteres', equalTo:'Debe coincidir con el campo email'},
            clave:{required: 'El campo es requerido', minlength:'La contraseña debe ser mayor o igual a 6 caracteres', maxlength:'La contraseña debe ser menor o igual a 16 caracteres'},
            rclave:{required: 'El campo es requerido', equalTo: 'Debe coincidir con el campo contraseña'},
            checkbox:{required: 'Debe aceptar los terminos y condiciones si desea registrarse'}
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

            $('#enviarreportepago').attr('disabled', true);
            //$("#loader_romel").show();
            form.submit(form);
        }
    });
});

$.validator.addMethod( "alpha", function( value, element ) {
    return this.optional( element ) || /^([-a-z_ñÑ ])+$/i.test( value );
}, "No se aceptan caracteres especiales o números" );


