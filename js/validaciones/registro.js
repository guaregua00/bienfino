$(function () {
    $('#registro').validate({
        rules: {
/*             'cedula': {
                required : true,
                minlength : 7,
                maxlength: 8,
                digits: true
            },
            'nac': {
                required : true
            },
            'nombres':{
                required:true,
                minlength : 2,
                alpha: true
            },
            'apellidos':{
                required: true,
                minlength : 2,
                alpha: true
            }, */
            'email':{
                required : true,
                email: true,
                maxlength: 100
            },
/*             'email_r':{
                required : true,
                email: true,
                maxlength: 100,
                equalTo: '[name="email"]'
            }, */
            'clave':{
                required : true,
                minlength : 6,
                maxlength: 16                
            },
/*             'rclave':{
                required : true,
                equalTo: '[name="clave"]'
            }, */
            'checkbox': {
                required: true
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

            $('#boton_registro').attr('disabled', true);
            //$("#loader_romel").show();
            form.submit(form);
        }
    });
});

$.validator.addMethod( "alpha", function( value, element ) {
    return this.optional( element ) || /^([-a-z_ñÑ ])+$/i.test( value );
}, "No se aceptan caracteres especiales o números" );


