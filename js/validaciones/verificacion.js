$(function () {
    $('#verificacion').validate({
        rules: {
            'codigo': {
                required : true
            }
        },
        messages:
        {
            codigo:{required: 'El campo es requerido', minlength: 'Debe tener 10 caracteres', maxlength: 'Debe tener 10 caracteres'}
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
            
            $('#boton_verificar').attr('disabled', true);
            //$("#loader_romel").show();
            form.submit(form);
        }
    });
});

