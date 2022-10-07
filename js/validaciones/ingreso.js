$(function () {
    $('#ingreso').validate({
        rules: {
            'email':{
                required : true,
                email: true,
                maxlength: 60
            },
            'clave':{
                required : true,
                minlength : 6,
                maxlength: 16                
            }
        },
        messages:
        {
            email:{required: 'El campo es requerido', email: 'Dirección de Correo invalido', maxlength: 'Debe ser menor o igual 100 caracteres'},
            clave:{required: 'El campo es requerido', minlength:'La contraseña debe ser mayor o igual a 6 caracteres', maxlength:'La contraseña debe ser menor o igual a 16 caracteres'}
        },        
        highlight: function (input) {
            
            $(input).parents('.group-text-field').addClass('rojo');
        },
        unhighlight: function (input) {
            $(input).parents('.group-text-field').removeClass('rojo');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.group-text-field').append(error);
        },
        submitHandler: function (form) {
            form.submit(form);
            $('#boton_ingresar').attr('disabled', true);
            //$("#loader_romel").show();
        }
    });
});