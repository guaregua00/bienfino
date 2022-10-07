$(function () {
    $('#form_c').validate({
        rules: {
            
            'direccion':{
                required : false
            },
            'estereo':{
                required : false
            },
            'tapizado':{
                required : false
            },
            'transmision':{
                required: true
            },
            'vidrios':{
                required : false
            },
            'reparado':{
                required : false
            },
            'traccion':{
                required : false
            },
            'puertas':{
                required : false,
                digits: true
            },
            'combustible':{
                required : false
            },
            'condicion':{
                required : false
            },
            'color':{
                required : true
            },
            'unico_dueno':{
                required : true
            },
            'motor':{
                required : false
            },
            'nro_cilindros':{
                required : false
            },
            'recorrido':{
                required : true,
                digits: true
            },
 /*            'placa':{
                required : true
            }, */
            'comentario':{
                required : false,
                maxlength: 255
            },

            'negociable':{
                required : true
            },
            'precio_bs':{
                digits: true
            },
            'precio_dol':{
                required : true,
                digits: true
            },
            'moviluno':{
                required:true,
                minlength : 11,
                maxlength: 11,
                digits: true,
                telfmovil:true
            },
            'movildos':{
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

                    //continuar al paso 2
        /*
        $("#btn-a-continuar").click(function () {    
          $('#form_paso_a').hide();
          $('#form_paso_b').show("slow");
         });
        */  $('#btn-c-regresar').hide();
            $('#btn-c-continuar').attr('disabled', true);
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
