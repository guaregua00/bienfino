$(function () {
    $('#cambioClave').validate({
        rules: {
            'clave_actual':{
                required : true,
                maxlength: 60
            },
            'password':{
                required : true,
                minlength : 6,
                maxlength: 16                
            },
            'new_password':{
                required : true,
                equalTo: '[name="password"]'
            }
        },
        messages:
        {
            clave_actual:{required: 'El campo es requerido'},
            password:{required: 'El campo es requerido', minlength:'La contraseña debe ser mayor o igual a 6 caracteres', maxlength:'La contraseña debe ser menor o igual a 16 caracteres'},
            new_password:{required: 'El campo es requerido'}
        },        
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
            $('#boton_cambiar_clave').attr('disabled', true);
            form.submit(form);            
            //$("#loader_romel").show();
        }
    });
});