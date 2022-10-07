$(function () {
    $('#recuperar_clave').validate({
        rules: {
            'email':{
                required : true,
                email: true,
                maxlength: 60
            }
        },
        messages:
        {
            email:{required: 'El campo es requerido', email: 'Dirección de Correo invalido', maxlength: 'Debe ser menor o igual 100 caracteres'}
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
            $('#boton_recuperar').attr('disabled', true);
            form.submit(form);
            //$("#loader_romel").show();
        }
    });
});