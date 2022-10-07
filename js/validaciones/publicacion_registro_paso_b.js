$(function () {
    $('#form_a').validate({
        rules: {
            /*
            'cat-autos':{
                required : true,
                digits: true
            },
            'cat-camionetas':{
                required : true,
                digits: true
            },  
                    
            'id_marca':{
                required : true,
                digits: true
            },
            'id_modelo':{
                required : true,
                digits: true
            },
            'id_ano':{
                required : true,
                digits: true
            },
            'direccion':{
                required : true
            },
            'estereo':{
                required : true
            },
            'tapizado':{
                required : true
            },
            'transmision':{
                required : true
            },
            'vidrios':{
                required : true
            },
            'reparado':{
                required : true
            },
            'traccion':{
                required : true
            },
            'puertas':{
                required : true,
                digits: true
            },
            'combustible':{
                required : true
            },
            'condicion':{
                required : true
            },
            'color':{
                required : true
            },
            'unico_dueno':{
                required : true
            },
            'motor':{
                required : true
            },
            'nro_cilindros':{
                required : true
            },
            'recorrido':{
                required : true
            },
            'placa':{
                required : true
            },
            'comentario':{
                required : true,
                maxlength: 255
            },
            */
            'id_precio':{
                required : true
            },
            /*
            'negociable':{
                required : true
            },
            'precio_bs':{
                required : true,
                digits: true
            },
            'precio_dol':{
                digits: true
            },
            'codigoestado':{
                required : true
            },
            'codigomunicipio':{
                required : true
            },
            'codigoparroquia':{
                required : true
            },
            */
            'foto1':{
                required : true
            },
            'foto2':{
                required : true
            },
            'foto3':{
                required : true
            },
            'foto4':{
                required : true
            }
            /*
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

            
            'cedula': {
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
            },
            'email':{
                required : true,
                email: true,
                maxlength: 60
            },
            'email_r':{
                required : true,
                email: true,
                maxlength: 100,
                equalTo: '[name="email"]'
            },
            'clave':{
                required : true,
                minlength : 6,
                maxlength: 16                
            },
            'rclave':{
                required : true,
                equalTo: '[name="clave"]'
            },
            'checkbox': {
                required: true
            }
            */
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
        */
       
            $('#btn-b-continuar').attr('disabled', true);
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
