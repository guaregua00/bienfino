 <?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Cusuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Musuarios');
        $this->load->model('Mgeo');
        $this->load->model('Mpublicacion');
        $this->load->library('form_validation');
        //$this->load->library('encrypt');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->helper('mensajes_helper');
        //$this->output->enable_profiler(TRUE);
    }
    public function unsetSesion(){
        $this->session->unset_userdata('categoria');     
        $this->session->unset_userdata('estado');
        $this->session->unset_userdata('municipio');
        $this->session->unset_userdata('parroquia');
        $this->session->unset_userdata('estado');
        $this->session->unset_userdata('marca');
        $this->session->unset_userdata('modelo');
        $this->session->unset_userdata('anio');
        $this->session->unset_userdata('precio');
        $this->session->unset_userdata('km');
        //$this->session->unset_userdata('buscar_palabra');                 
    }    

    public function datosHeaderMenu(){
        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();


        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        return $datos;

    }

    public function Vnosotros(){
        $this->load->view('layouts/headerR');
        $this->load->view('usuarios/Vnosotros');        
    }
    public function Vpoliticas(){
        $this->load->view('layouts/headerR');
        $this->load->view('usuarios/Vpoliticas');        
    }

    public function VmisDatos(){
        comprobarUsuarioLogueado(NULL);
        
        $resultado = $this->Musuarios->getUsuariosCedula();
        $datos['usuarios'] = $resultado;
            if($datos){
                $this->load->view('layouts/headerI',$datos);
                //$this->load->view('usuarios/VmisDatos');
                $this->load->view('usuarios/misDatos');
            }
        
     
    }


    public function VoportunidadNegocio(){
        comprobarUsuarioLogueado(null);

            $datos = $this->datosHeaderMenu();
            if($datos){
                $this->load->view('layouts/Vheader',$datos);
                $this->load->view('usuarios/VoportunidadNegocio');
            }

     
    }



    public function registroOportunidadNegocio(){
        var_dump($_POST);


    function after($x, $inthat)
    {
        if (!is_bool(strpos($inthat, $x)))
        return substr($inthat, strpos($inthat,$x)+strlen($x));
    }

    function before($y, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $y));
    };

            
        $monto = $this->input->post('monto');
        $monto = trim($monto);
        $after = after('-',  $monto);
        $before = before ('-', $monto);
        echo "<br>antes".substr($before, 1);
        echo "<br>despues".substr($after, 2);
    }

    public function index() {
        $this->session->unset_userdata('buscar_palabra');
        //comprobarUsuarioLogueado(null);
        $this->unsetSesion();
        $this->session->unset_userdata('buscar');//elimina la palabra del buscador
        //$resultado = $this->Mpublicacion->getCategorias();
        //$resultado2 = $this->Mpublicacion->getMarca2();
        //$resultado3 = $this->Mgeo->getEstados();

        $data['estatus'] = 1;//activas
        $data['cantidad'] = 20;//cantidad
        $data['categoria'] = 1;//carros
        $resultado4 = $this->Mpublicacion->getPublicaciones($data);

        $data['estatus'] = 1;//activas
        $data['cantidad'] = 20;
        $data['categoria'] = 7;//camionetas 7
        $resultado5 = $this->Mpublicacion->getPublicaciones($data);  

        //$datos['categorias'] = $resultado;
        //$datos['marca'] = $resultado2;
        //$datos['estados'] = $resultado3;
        $datos['publicaciones'] = $resultado4;
        $datos['publicaciones2'] = $resultado5;

        //if ($resultado4!="" and $resultado5!="") {

                //$this->load->view('layouts/Vheader',$datos2);
                //$this->load->view('usuarios/Vinicio',$datos);

                $categorias = $this->Mpublicacion->getCategoriasHome();
                $estados = $this->Mgeo->getEstados();
                //$modelos = $this->Mpublicacion->getModelos2();
                $marcas = $this->Mpublicacion->getMarca2();
                $anio = $this->Mpublicacion->getAnio();

                $datos['categorias'] = $categorias;
                $datos['estados'] = $estados;                
                //$datos['modelos'] = $modelos;
                $datos['marcas'] = $marcas;
                $datos['anio'] = $anio;
                $this->load->view('layouts/headerR');
                $this->load->view('usuarios/homeR',$datos);
            

        //}
    }

    public function VdatosUbicacion(){
        comprobarUsuarioLogueado(null);

        $resultado2 = $this->Mgeo->getEstados();
        $datos['estados'] = $resultado2;
        if ($datos) {
            $this->load->view('layouts/headerI',$datos);
            $this->load->view('usuarios/VactualizarDatosUbi',$datos);
        }             

      
    }

    public function actualizarDatosUbicacion(){
    comprobarUsuarioLogueado(null);

        $this->form_validation->set_rules('codigoestado', 'Estado', 'trim|required|numeric');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'trim|required|numeric');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'trim|required|numeric');
        $this->form_validation->set_rules('direccion_esp', 'Dirección', 'trim|required|min_length[3]|max_length[255]|strip_tags');

            $this->form_validation->set_error_delimiters('<label class="red">', '</label>');

            $this->form_validation->set_message('required', 'Debe llenar el campo %s');

            if ($this->form_validation->run() === FALSE) {

                $this->session->set_flashdata('mensajeError', 'Ha ocurrido un error intente de nuevo.');
                redirect('misdatos'); 

            } else {
                $datos['codigoestado'] = $this->input->post('codigoestado');
                $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
                $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
                $datos['direccion_esp'] = $this->input->post('direccion_esp');
                
                $resultado2 = $this->Musuarios->actualizarDatosUbicacion($datos);
                
                if ($resultado2) {

                    $this->session->set_flashdata('mensajeExito', 'Datos actualizados correctamente.');
                    redirect('misdatos');

                }else{
                    $this->session->set_flashdata('mensajeError', 'Error al actualizar los datos.');
                    redirect('misdatos');             
                }
            }   

    }

    public function VdatosContacto(){
    comprobarUsuarioLogueado(null);

        $datos = $this->datosHeaderMenu();
        if ($datos) {
            $this->load->view('layouts/headerI',$datos);
            $this->load->view('usuarios/VactualizarDatosCon');
        } 
    }

    public function actualizarDatosContacto(){
    comprobarUsuarioLogueado(null);
            $this->form_validation->set_rules('moviluno', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|required|callback_telfmovil|strip_tags');

            if ($this->input->post('movildos')!="") {
                $this->form_validation->set_rules('movildos', 'Movil','trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');
            }


            //$this->form_validation->set_rules('email', 'Email', 'valid_email|required');

            $this->form_validation->set_error_delimiters('<label class="red">', '</label>');

            $this->form_validation->set_message('telfmovil', 'Ingresa un formato correcto %s');
            $this->form_validation->set_message('required', 'Debe llenar el campo %s');

            if ($this->form_validation->run() === FALSE) {

                $datos['mensaje'] = "Formulario incorrecto";  
                $this->load->view('layouts/Vheader');
                $this->load->view('usuarios/VactualizarDatosCon',$datos);
                
                $this->session->set_flashdata('mensajeError', 'Ha ocurrido un error intente de nuevo.');
                redirect('datospersonales'); 
            } else {
                //$datos['email'] = strtoupper($this->input->post('email'));
                $datos['moviluno'] = $this->input->post('moviluno');
                $datos['movildos'] = $this->input->post('movildos');

                
                //$resultado = $this->Musuarios->consultarJovenCedulaSession($datos);
                $resultado2 = $this->Musuarios->actualizarDatosContacto($datos);
                
                if ($resultado2) { 

                    $this->session->set_flashdata('mensaje2', 'Datos actualizados correctamente');
                    redirect("Cusuarios/VmisDatos"); 

                }else{
                    $this->session->set_flashdata('mensaje', 'Error al actualizar los datos');
                    redirect("Cusuarios/VmisDatos");               
                }
            }  

    }

    public function VdatosPersonales(){
    comprobarUsuarioLogueado(null);

    /*
            if (strlen($resultado->cedula)==9) {
                $resultado->nac = substr($resultado->cedula, 0,-8);
                $resultado->cedula = substr($resultado->cedula, 1);
            }elseif (strlen($resultado->cedula)==8) {
                $resultado->cedula = substr($resultado->cedula, 0,-7);
                $resultado->cedula = substr($resultado->cedula, 1);
            }else{
                $this->session->set_flashdata('mensaje2', 'Error no se puede actualizar su usuario');
                redirect();            
            }
    */

            $this->load->view('layouts/headerI');
            $this->load->view('usuarios/VactualizarDatosPer');
        
    }

    public function actualizarDatosPersonales(){

    comprobarUsuarioLogueado(NULL);

        /*$this->form_validation->set_rules('nac', 'Nacionalidad', 'trim|required|strip_tags');
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|numeric|min_length[7]|max_length[8]|strip_tags');*/
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]|max_length[60]|strip_tags|callback_alpha_dash_space');
        $this->form_validation->set_rules('apellidos', 'Apellidos|callback_alpha_dash_space', 'trim|required|min_length[3]|max_length[60]|strip_tags');

            $this->form_validation->set_error_delimiters('<label class="red">', '</label>');

            $this->form_validation->set_message('required', 'Debe llenar el campo %s');
            $this->form_validation->set_message('alpha_dash_space', 'Solo se permite letras en %s');

            if ($this->form_validation->run() === FALSE) {

/*
                if (strlen($resultado->cedula)==9) {
                    $resultado->nac = substr($resultado->cedula, 0,-8);
                    $resultado->cedula = substr($resultado->cedula, 1);
                }elseif (strlen($resultado->cedula)==8) {
                    $resultado->cedula = substr($resultado->cedula, 0,-7);
                    $resultado->cedula = substr($resultado->cedula, 1);
                }else{
                    $this->session->set_flashdata('mensaje2', 'Error no se puede actualizar su usuario');
                    redirect();            
                }
*/                
                $this->session->set_flashdata('mensajeError', 'Ha ocurrido un error intente de nuevo.');
                redirect('misdatos'); 

            } else {
                //$datos['cedula'] = $this->input->post('nac').$this->input->post('cedula');
                $datos['nombres'] = mb_strtolower($this->input->post('nombres'));
                $datos['apellidos'] = mb_strtolower($this->input->post('apellidos'));
                
                //$resultado = $this->Musuarios->consultarJovenCedulaSession($datos);
                $resultado2 = $this->Musuarios->actualizarDatosPersonales($datos);
                
                if ($resultado2) {

                    $s_usuario = array(
                        
                        'nombres' => $datos['nombres'],
                        'apellidos' => $datos['apellidos']
                    );
                    $this->session->set_userdata($s_usuario);   

                    $this->session->set_flashdata('mensajeExito', 'Datos actualizados correctamente.');
                    redirect('misdatos'); 

                }else{
                    $this->session->set_flashdata('mensajeError', 'Error al actualizar los datos.');
                    redirect("misdatos");               
                }
            }       
    }

    public function VrecuperarClave()
    {
        //$this->load->view('usuarios/Vheader');
        $this->load->view('usuarios/VrecuperarClave');
        //$this->load->view('usuarios/Vfooter');
    }



    public function VcambiarClave()
    {
        comprobarUsuarioLogueado(NULL);

        $this->load->view('layouts/headerI');
        $this->load->view('usuarios/VcambiarClave');
        
    }    

    public function registrar() {
        if ($this->session->userdata('id_usuario')) {
            redirect();
        }        

        $this->load->view('usuarios/Vregistrar');

    }
    public function VvalidarCuenta()
    {
        if (!$this->session->userdata('id_usuario')) {
            redirect();
        }

        $this->load->view('layouts/Vheader');
        $this->load->view('usuarios/VvalidarCuenta');
        //$this->load->view('usuarios/Vfooter');
    }    

    public function login() {

/*         if ($this->session->userdata('id_usuario')) {
            redirect();
        } */

        $this->load->view('usuarios/Vlogin');

    }

    public function recuperarClave(){

        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|min_length[3]|max_length[60]|required|strip_tags');

        //delimitadores de errores
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
        //delimitadores de errores
        //reglas de validación
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');
        $this->form_validation->set_message('valid_email', 'El campo %s no posee un email válido');
        //reglas de validación


        if ($this->form_validation->run() === FALSE) {
/*             $datos['mensaje'] = "Formulario incorrecto";
            //$this->load->view('usuarios/Vheader');
            $this->load->view('usuarios/VrecuperarClave',$datos);
            //$this->load->view('usuarios/Vfooter'); */
            $mensaje_error = validation_errors();
            $this->session->set_flashdata('mensaje2', $mensaje_error);            
            redirect('recuperarclave');
        } else {
            $datos['email'] = mb_strtolower($this->input->post('email'));
            
            $resultado = $this->Musuarios->consultarJovenEmail($datos);

            if ($resultado) {
                $datos['keypass'] = md5(time());
                $datos['new_pass'] = substr(sha1(time()),0,8);

                $link = base_url()."Cusuarios/reiniciarClave/" .$datos['keypass']."/".$resultado[0]->id_usuario;


                if($this->enviarEmailRecuperacion($datos,$resultado,$link)){
                    $datos["resultado"] = $resultado;
                    if($this->Musuarios->agregarKeyPassNewPass($datos)){

                    $this->session->set_flashdata('mensaje', 'Por favor revise la bandeja de entrada de su correo para continuar con el proceso de recuperación de contraseña');
                    redirect("recuperarclave"); 

                    }else{
                        $this->session->set_flashdata('mensaje2', 'Error no se pudo actualizar');//Error no se actualizo la tabla con el keypass y newpass
                        redirect("recuperarclave"); 
                    }

                }else{
                    $this->session->set_flashdata('mensaje2', 'Error no se pudo enviar el correo, intente de nuevo');
                    redirect("recuperarclave"); 
                }
            }else{
                $this->session->set_flashdata('mensaje2', 'Error el Email no existe en el sistema');
                redirect("recuperarclave"); 
            }
        }
    }

    public function enviarEmailRecuperacion($datos,$resultado,$link) {

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.bienfino.com',
            'smtp_user' => 'hola@bienfino.com',
            'smtp_pass' => 'bienfino2019',
            'smtp_port' => '465',
            'smtp_crypto' => 'ssl', 
            'mailtype' => 'html',
        /* 'wordwrap' => TRUE, */
            'charset' => 'utf-8'
    );
        //echo $CI->email->print_debugger();

        //envio de email de verificación
        $asunto = "Solicitud de cambio de contraseña";

        $mensaje = "<p>El dia <strong>".date('d/m/Y H:i:s')."</strong> se ha generado una Solicitud de cambio de contraseña</p>";
        $mensaje.= "<p>Si no has solicitado esto, has caso omiso a este mensaje, en cambio si deseas modificar tu contraseña debes hacer click en el encale de abajo</p>";


        $mensaje.= "<table><tr><th>Contraseña nueva generada</th><td>".$datos['new_pass']."</td></tr></table>";

        $mensaje.= "<table><tr><th>Si deseas utilizar la contraseña generada debes presionar </th><td><a href='".$link."'>AQUI</a></td></tr></table>";

        $mensaje.="<p>Sino a solicitado un cambio de contraseña no necesitas hacer nada.</p>";


        $this->email->initialize($config);
        $this->email->from('hola@bienfino.com', 'BienFino');
        $this->email->to($datos['email']);
        $this->email->subject($asunto);
        $this->email->message($mensaje);



        if($this->email->send()) {
            return true;        
        } else {
            return false;
        }    

    }


    public function cambiarClave(){

        comprobarUsuarioLogueado(null);

        $this->form_validation->set_rules('clave_actual', 'Contraseña actual', 'trim|min_length[6]|max_length[16]|required');
            $this->form_validation->set_rules('password', 'Contraseña nueva', 'trim|min_length[6]|max_length[16]|required');
            $this->form_validation->set_rules('new_password', 'Repetir Contraseña nueva', 'trim|matches[password]|required');

            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

            $this->form_validation->set_message('required', 'Debe llenar el campo %s');

            if ($this->form_validation->run() === FALSE) {

                $this->session->set_flashdata('mensajeError', 'Ha ocurrido un error intente de nuevo.');
                redirect('cambiarclave');                

            } else {
                $datos['clave_actual'] = $this->input->post('clave_actual');
                $datos['password'] = $this->input->post('password');
                $datos['new_password'] = password_hash($this->input->post('new_password'),PASSWORD_DEFAULT);

                
                $resultado = $this->Musuarios->consultarJovenCedulaSession($datos);

                if ($resultado) {

                    if (password_verify($datos['clave_actual'],$resultado[0]->clave)) {


                        $resultado = $this->Musuarios->cambiarPasswordJoven($datos);

                        if ($resultado) {

                            $this->session->set_flashdata('mensajeExito', 'Contraseña cambiada correctamente');
                            redirect(); 

                        }else{
                            $this->session->set_flashdata('mensajeExito', 'Error no se pudo cambiar la contraseña');
                            redirect('cambiarclave'); 
                        }
                  
                    }else{

                        $this->session->set_flashdata('mensajeError', 'Contraseña actual no coincide.');
                        redirect('cambiarclave');                                                       
                    }

                }else{
                    $this->session->set_flashdata('mensajeError', 'Ocurrio un error intente de nuevo.');
                    redirect('cambiarclave');               
                }
            }
    }  



    public function validarCuenta(){
        
        if ($this->session->userdata('verificado')==0) {

            $this->form_validation->set_rules('codigo', 'Código', 'trim|required');

            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

            $this->form_validation->set_message('required', 'Debe llenar el campo %s');

            if ($this->form_validation->run() === FALSE) {

                $datos['mensaje'] = "Formulario incorrecto";
                $this->load->view('layouts/Vheader');              
                $this->load->view('usuarios/VvalidarCuenta', $datos);
                //$this->load->view('usuarios/Vfooter');   

            } else {
                $datos['codigo'] = $this->input->post('codigo');
                
                
                $resultado = $this->Musuarios->validarCuenta($datos);

                if ($resultado) {

                        $s_usuario = array(
                            'verificado' => 1,
                        );

                        $this->session->set_userdata($s_usuario);

                            $this->session->set_flashdata('mensaje2', 'Cuenta activada correctamente, debes completar tus datos para poder realizar una publicación');
                            redirect('completarregistro');

                }else{

                    $datos['mensaje'] = "Código no coincide con el usuario";
                    $this->load->view('layouts/Vheader');
                    $this->load->view('usuarios/VvalidarCuenta', $datos);
                    //$this->load->view('usuarios/Vfooter');              

                }
            }
        }else{
            redirect();
        }

    }

    public function ingresarUsuario() {

        //validaciones
        $this->form_validation->set_rules('email', 'Email', 'trim|strip_tags|valid_email|max_length[60]|required');
        $this->form_validation->set_rules('clave', 'Clave', 'trim|strip_tags|required|min_length[6]|max_length[16]');
        //validaciones
        //delimitadores de errores
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //delimitadores de errores
        //reglas de validación
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');
        $this->form_validation->set_message('valid_email', 'El campo %s no posee un email válido');
        //reglas de validación


        if ($this->form_validation->run() === FALSE) {


            $mensaje_error = validation_errors();
            //var_dump($mensaje_error);exit();
            //$datos['mensaje'] = $mensaje_error;
    
            $this->session->set_flashdata('mensaje', $mensaje_error);
            redirect('ingresar');


            //$datos['mensaje'] = "Inicio de Sesión incorrecto";
            //$this->load->view('usuarios/Vlogin', $datos);

        } else {

            $datos['email'] = mb_strtolower($this->security->xss_clean($this->input->post('email')));
            $datos['clave'] = $this->security->xss_clean($this->input->post('clave'));

            $resultado = $this->Musuarios->ingresarUsuario($datos);
               
            if ($resultado) {

              $clave = $this->security->xss_clean($this->db->escape_str($datos['clave']));

                if(password_verify($clave,$resultado->clave)){

                    if ($resultado->activo == 0) {
                        //var_dump($resultado->activo);exit();
                        $this->session->set_flashdata('mensaje', 'Usuario inactivo');
                        redirect('ingresar');
                    }
                       
                    /*if ($resultado->verificado == "0") {
                        $this->session->set_flashdata('modal', 1);
                        $this->session->set_flashdata('email', $datos['email']);
                        $this->session->set_flashdata('id_usuario', $resultado->id_usuario);
                        $this->session->set_flashdata('codigo_verificacion', $resultado->codigo_verificacion);
                        redirect('ingresar');
                    }*/
                    
                    $this->session->unset_userdata('id_usuario');
                    $this->session->unset_userdata('email');
                    $this->session->unset_userdata('clave');
                    $this->session->unset_userdata('nombres');
                    $this->session->unset_userdata('apellidos');
                    $this->session->unset_userdata('cedula');
                    $this->session->unset_userdata('verificado');
                    $this->session->unset_userdata('activo');
                    $this->session->unset_userdata('id_grupo');
                    $this->session->unset_userdata('completar');


                    $a_usuario = array(
                        'id_usuario' => $resultado->id_usuario,
                        'email' => $resultado->email,
                        'clave' => $resultado->email,
                        'nombres' => $resultado->nombres,
                        'apellidos' => $resultado->apellidos,
                        'cedula' => $resultado->cedula,
                        'verificado' => $resultado->verificado,
                        'activo' => $resultado->activo,
                        'id_grupo' => $resultado->id_grupo,
                        'completar' => $resultado->completar,
                    );

                    $this->session->set_userdata($a_usuario);


                    if ($resultado->completar==0) {
                        $this->session->set_flashdata('mensaje', 'Debes completar tus datos para poder disfrutar de los Servicios de BienFino.');
                        redirect('completarregistro');
                    }else{

                        if(strip_tags(trim($this->uri->segment(3)))=='p'){redirect('publicar');}
                        else if(strip_tags(trim($this->uri->segment(3)))=='m'){redirect('misPublicacionesExito');}
                        else redirect();                      
                    }
                    

                } else {
                    //mando a la vista de error
                    $this->session->set_flashdata('mensaje', 'Email o Clave incorrectas');
                    redirect('ingresar');

                    //$datos['mensaje'] = "Email o Clave incorrectas";
                    //$this->load->view('usuarios/Vlogin', $datos);

                }
            }else {
                //$datos['mensaje'] = "Credenciales incorrectas";
                //$this->load->view('usuarios/Vlogin', $datos);

                $this->session->set_flashdata('mensaje', 'Credenciales incorrectas');
                redirect('ingresar');                
            }
        }
    }



    public function registrarUsuario() {


        //validaciones
/*         $this->form_validation->set_rules('nac', 'Nacionalidad', 'trim|required|strip_tags');
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|numeric|min_length[7]|max_length[8]|strip_tags');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]|max_length[60]|strip_tags|callback_alpha_dash_space');
        $this->form_validation->set_rules('apellidos', 'Apellidos|callback_alpha_dash_space', 'trim|required|min_length[3]|max_length[60]|strip_tags'); */
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|callback_email_check|strip_tags');
/*         $this->form_validation->set_rules('email_r', 'Repetir Email', 'valid_email|required|matches[email]'); */
        $this->form_validation->set_rules('clave', 'Clave', 'trim|required|min_length[6]|max_length[16]|strip_tags');
/*         $this->form_validation->set_rules('rclave', 'Repetir Clave', 'matches[clave]|required'); */
        $this->form_validation->set_rules('checkbox', 'terminos', 'required');
        //validaciones
        //delimitadores de errores
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //delimitadores de errores
        //reglas de validación
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');
        $this->form_validation->set_message('valid_email', 'El campo %s no posee un email válido');
        $this->form_validation->set_message('alpha_dash_space', 'Solo se permite letras en %s');
        //reglas de validación


        if ($this->form_validation->run() === FALSE) {

            $mensaje_error = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje_error);
            redirect('registrar');

            //$datos['mensaje'] = "Formulario incorrecto";
            //$this->load->view('usuarios/Vregistrar', $datos);

        } else {

            $datos['email'] = $this->security->xss_clean(mb_strtolower($this->input->post('email')));
            $datos['clave'] = password_hash($this->input->post('clave'),PASSWORD_DEFAULT);
            $datos['codigo_verificacion'] = $this->generarCodigo(10);

            $datos = $this->security->xss_clean($this->db->escape_str($datos));

            $this->session->unset_userdata('email');
            $this->session->unset_userdata('clave');
            $this->session->unset_userdata('codigo_verificacion');

            $a_usuario = array(
                'email' => $datos['email'],
                'clave' => $datos['clave'],
                'codigo_verificacion' => $datos['codigo_verificacion']
            );
            $this->session->set_userdata($a_usuario);
            $this->session->set_userdata('clave_descifrada',$this->security->xss_clean($this->db->escape_str($this->input->post('clave'))));
            

            $this->session->set_flashdata('mensaje', 'Completa la información para Registrarte!');
            redirect('completarregistro');                           
                  

        }
    }


    public function VcompletarRegistro(){
        
        if($this->session->userdata('email') and $this->session->userdata('clave')){
            $resultado2 = $this->Mgeo->getEstados();
            $datos['estados'] = $resultado2;

            if($datos){
                $this->load->view('layouts/headerI');
                $this->load->view('usuarios/VcompletarRegistro',$datos);
                //$this->load->view('usuarios/Vfooter');                   
            }
        }
    } 

    public function completarRegistro() {

        if($this->session->userdata('email') and $this->session->userdata('clave')){
            
        

        $this->form_validation->set_rules('nac', 'Nacionalidad', 'trim|required|strip_tags');
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|numeric|min_length[7]|max_length[8]|strip_tags');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]|max_length[60]|strip_tags|callback_alpha_dash_space');
        $this->form_validation->set_rules('apellidos', 'Apellidos','callback_alpha_dash_space|trim|required|min_length[3]|max_length[60]|strip_tags'); 
        $this->form_validation->set_rules('moviluno', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|required|callback_telfmovil|strip_tags');

        if ($this->input->post('movildos')!="") {
            $this->form_validation->set_rules('movildos', 'Movil','trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');

        }

        $this->form_validation->set_rules('codigoestado', 'Estado', 'required|numeric');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'required|numeric');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'required|numeric');
        $this->form_validation->set_rules('direccion_esp', 'Dirección', 'required|min_length[3]|max_length[255]');

        if ($this->input->post('marca')!="" || $this->input->post('modelo')!="" || $this->input->post('id_ano')!="") {
            $this->form_validation->set_rules('marca', 'Marca', 'required|trim|min_length[2]|max_length[60]|strip_tags');
            $this->form_validation->set_rules('modelo', 'Modelo','required|trim|min_length[2]|max_length[60]|strip_tags'); 
            $this->form_validation->set_rules('id_ano', 'Año','required|numeric|trim|min_length[1]|max_length[4]|strip_tags');
        }


        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('telfmovil', 'Ingresa un formato correcto %s');


        if ($this->form_validation->run() === FALSE) {

/*            $resultado = $this->Musuarios->getUsuariosCedula();
             $resultado2 = $this->Mgeo->getEstados();
            $datos['estados'] = $resultado2;
            $datos['usuarios'] = $resultado; */
            $mensaje_error = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje_error);

            redirect('completarregistro');
            //$this->load->view('usuarios/Vfooter');

        } else {

            $datos['email'] = $this->session->userdata('email');
            $datos['clave'] = $this->session->userdata('clave');
            $datos['verificado'] = 1;
            $datos['activo'] = 1;
            $datos['id_grupo'] = 1;
            $datos['completar'] = 1;
            $datos['codigo_verificacion'] = $this->session->userdata('codigo_verificacion');

            $datos['cedula'] = $this->input->post('nac') . $this->input->post('cedula');
            $datos['nombres'] = mb_strtolower($this->input->post('nombres'));
            $datos['apellidos'] = mb_strtolower($this->input->post('apellidos'));

            $datos['moviluno'] = $this->input->post('moviluno');
            $datos['movildos'] = $this->input->post('movildos');

            $datos['codigoestado'] = $this->input->post('codigoestado');
            $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
            $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
            $datos['direccion_esp'] = mb_strtolower($this->input->post('direccion_esp'));

            $datos['marca'] = mb_strtolower($this->input->post('marca'));
            $datos['modelo'] = mb_strtolower($this->input->post('modelo'));
            $datos['id_ano'] = $this->input->post('id_ano');


                $datos = $this->security->xss_clean($this->db->escape_str($datos));
                $insert_id_usuario = $this->Musuarios->RegistrarUsuarioCompleto($datos);
                
                //var_dump($insert_id_usuario);exit;
                
                if ($insert_id_usuario) {
                    $s_usuario = array(
                        'id_usuario' => $insert_id_usuario,
                        'email' => $datos['email'],
                        'nombres' => $datos['nombres'],
                        'apellidos' => $datos['apellidos'],
                        'cedula' => $datos['cedula'],                            
                        'completar' => 1,
                        'verificado' => $datos['verificado'],
                        'activo' => $datos['activo'],
                        'id_grupo' => $datos['id_grupo'],
                        'completar' => $datos['completar']
                    );
                    $this->session->set_userdata($s_usuario);
                    

                    $datos['asunto'] = "Confirmación Registro Exitoso";
                    $datos['titulo'] = "Bienvenid@ a BienFino.com";
                    $datos['mensaje'] = "¡Felicitaciones! Sus datos han sido ingresados exitosamente en nuestro sistema.";
                    $datos['usuario'] = $this->session->userdata('email');
                    $datos['clave'] = $this->session->userdata('clave_descifrada');
                    $datos['nombres'] = $datos['nombres'];
                    $datos['apellidos'] = $datos['apellidos'];
                    $datos['cedula'] = $datos['cedula'];

                    @$this->send_email($datos);
                    $this->session->unset_userdata('clave_descifrada');

                    $this->session->set_flashdata('mensajecompletado', 'Registro completo ya puede disfrutar de todos nuestros servicios');
                    redirect();

                } else {
                    $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
                    //mando a la vista de error
                    redirect('completarregistro');
                }

            }
        }                          
    }

    public function linkValidacionCuenta(){

        //$ruta = "bienfino.com/validarcuenta/codigovalidacion/id_usuario";

        $datos['codigo'] = strip_tags(trim($this->uri->segment(2)));
        $datos['id_usuario'] = strip_tags(trim($this->uri->segment(3)));
        $res = $this->Musuarios->getUsuarioCodigoId($datos);
        if($res){
            if(isset($datos['codigo']) and isset($datos['id_usuario'])){
                
                if($this->Musuarios->validarCuenta($datos)){
                    $this->session->set_flashdata('mensaje', 'Activación correcta ya puede iniciar sesión');
                    $this->session->set_flashdata('email', strtolower($res->email));
                    redirect('ingresar');
                }else{
                    
                    $this->session->set_flashdata('mensaje', 'No se pudo activar la cuenta intente de nuevo');
                    redirect();
                }
            }
        }else{
            $this->session->set_flashdata('mensaje', 'No coincide los datos');
            redirect();            
        }
        
        
    }

    public function reenvioCorreoLogin(){


        $this->form_validation->set_rules('codigo_verificacion', 'codigo_verificacion', 'trim|alpha_numeric|required|strip_tags');
        $this->form_validation->set_rules('id_usuario', 'id_usuario', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|strip_tags');


        if ($this->form_validation->run() === FALSE) {
            redirect('ingresar');
        } else {

            $datos['codigo_verificacion'] = $this->input->post('codigo_verificacion');
            $datos['id_usuario'] = $this->input->post('id_usuario');
            $datos['email'] = $this->input->post('email');
            
            $res = $this->Musuarios->getUsuarioCodigoIdEmail($datos);
            if($res){
                if($this->enviarEmailVerificacion($datos['codigo_verificacion'], $datos['id_usuario'], $datos['email'])){
                    $this->session->set_flashdata('mensaje', 'Hemos enviado un correo de verificación de cuenta, por favor ingresa en tu correo para poder continuar con el proceso de registro');
                    $this->session->set_flashdata('email', strtolower($datos['email']));
                    redirect('ingresar');
                }
            }
            

        }      
    }

    public function enviarEmailVerificacion($codigo_verificacion, $id_usuario, $email) {

      //  $config = array(
            /* 'protocol' => 'smtp',
              'smtp_host' => 'smtp.googlemail.com',
              'smtp_user' => 'romel174gl@gmail.com',
              'smtp_pass' => 'memonada',
              'smtp_port' => '456',
              'smtp_crypto' => 'ssl', */
        //    'mailtype' => 'html',
            /* 'wordwrap' => TRUE, */
         //   'charset' => 'utf-8'
      //  );

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.bienfino.com',
            'smtp_user' => 'hola@bienfino.com',
            'smtp_pass' => 'bienfino2019',
            'smtp_port' => '465',
            'smtp_crypto' => 'ssl', 
            'mailtype' => 'html',
        /* 'wordwrap' => TRUE, */
            'charset' => 'utf-8'
    );

        //envio de email de verificación
        $asunto = "Activación de cuenta BienFino";

        $mensaje = "<h1>Gracias por registrarte en ".base_url()."</h1><br><br>";
        $mensaje.= "<h3>Antes de que activemos tu cuenta debemos verificar tu correo!<br></h3><br>";
        $mensaje.= "<h3>Para activar tu cuenta en bienfino debes presionar este: "."<a href='".base_url()."validarcuenta/".$codigo_verificacion."/".$id_usuario."'>Link de Validación</a></h3>";

        $this->email->initialize($config);
        $this->email->from('hola@bienfino.com', 'BienFino');
        $this->email->to($email);
        $this->email->subject($asunto);
        $this->email->message($mensaje);

        if($this->email->send()) {
            return true;        
        } else {
            return false;
        }    

    }

    public function email_check($email) {
        $email = mb_strtolower($email);
        $resultado = $this->Musuarios->verificarEmail($email);
        if ($resultado) {
            $link = base_url()."recuperarclave";
            $aqui = "<a href='".$link."'>Aquí</a>";
            $this->form_validation->set_message('email_check', 'El email ' . $email . ' ya se encuentra registrado, puede recuperar su contraseña '.$aqui.'');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function cedula_check($cedula) {
        $resultado = $this->Musuarios->verificarCedula($cedula);
        if ($resultado) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function generarCodigo($longitud) {

        $key = '';
        $pattern = 'B08D08FA975390232334A4DA03B';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i++)
            $key .= $pattern[mt_rand(0, $max)];
        return $key;
    }
    //sin uso
    public function activarVerificarCuenta($codigo_verificacion) {

        if (!is_null($codigo_verificacion)) {

            $this->Musuarios->activarVerificarCuenta($codigo_verificacion);

            $datos['mensaje_cuenta_act'] = "Exito Cuenta activada por favor Inicie Sesión";

            $this->load->view('usuarios/Vlogin', $datos);

        } else {
            redirect("Cusuarios/ingresarUsuario");
        }
    }


///deprecado
    public function alpha_dash_space($str)
    {
        return (!preg_match("/^([-a-z_ñÑ ])+$/i", $str)) ? FALSE : TRUE;
    } 

    public function telfmovil($str)
    {
        return (!preg_match("/^[0][4|2][0-9]{9}$/i", $str)) ? FALSE : TRUE;
    }

    public function quitar_tildes($cadena) {

        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;

        }

    public function reiniciarClave($keypass,$id_usuario) {

        if (!is_null($keypass) AND !is_null($id_usuario)) {

            $new_pass = $this->Musuarios->reiniciarClave($keypass,$id_usuario);

            if ($new_pass) {
                $this->session->set_flashdata('mensaje', 'Contraseña cambiada correctamente intente Iniciar Sesión con ella:<h4>'.$new_pass.'</h4>');
                redirect('recuperarclave');           
            }else{
                $this->session->set_flashdata('mensaje2', 'No se pudo reiniciar la contraseña intente nuevamente');                
                redirect('recuperarclave');        
            }


        }else {
            redirect();
        }
    }



        public function send_email($datos) {

        $vista = $this->load->view('email/confirmacion',$datos,TRUE);
        
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.mailtrap.io',
          'smtp_port' => 2525,
          'smtp_user' => '2f78a451c2c93f',
          'smtp_pass' => '796c2c4b331bec',
          'crlf' => "\r\n",
          'newline' => "\r\n",
          'mailtype' => 'html',
        );
        
        /*
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.bienfino.com',
            'smtp_user' => 'hola@bienfino.com',
            'smtp_pass' => 'bienfino2019',
            /*'smtp_port' => '465',
            'smtp_crypto' => 'ssl',*
            'mailtype' => 'html',
            /* 'wordwrap' => TRUE, *
            'charset' => 'utf-8'
        );
        */

        $this->email->initialize($config);
        $this->email->from('hola@bienfino.com', 'BienFino');
        $this->email->to($datos['usuario']);
        $this->email->subject($datos['asunto']);
        $this->email->message($vista);



        if($this->email->send()) {
            return true;
        } else {
            return false;
        }    

    }

    public function cerrar_session() {
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('nombres');
        $this->session->unset_userdata('apellidos');
        $this->session->unset_userdata('cedula');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('buscar');
        $this->session->unset_userdata('id_grupo');        
        $this->session->unset_userdata('completar');
        $this->session->unset_userdata('verificado');
        $this->session->unset_userdata('clave');
        redirect();
    }

}
