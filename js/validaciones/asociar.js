$(function () {
    $('#asociar').validate({
        rules: {
            'placa':{
                required : true,
                minlength : 7,
                maxlength: 7
            },
            'movil':{
                required:true,
                minlength : 11,
                maxlength: 11,
                digits: true,
                telfmovil:true
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
        ignore:[],
        
        highlight: function (input) {
            console.log(input);
            $(input).parents('.group-text-field').addClass('rojo');
        },
        unhighlight: function (input) {
            $(input).parents('.group-text-field').removeClass('rojo');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.group-text-field').append(error);
        },
        submitHandler: function (form) {

            console.log(input);
            form.submit(form);
        }
    });
});

$.validator.addMethod( "alpha", function( value, element ) {
    return this.optional( element ) || /^([-a-z_ñÑ ])+$/i.test( value );
}, "No se aceptan caracteres especiales o números" );

$.validator.addMethod( "telfmovil", function( value, element ) {
    return this.optional( element ) || /^[0][4|2][0-9]{9}$/i.test( value );
}, "Ingresa un formato correcto" );
