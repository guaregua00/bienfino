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


    public function VmisDatos(){
        if ($this->session->userdata('completar')==0) {
             $this->session->set_flashdata('mensaje', 'Por favor completa tus datos para poder ingresar a esta seccion de la pagina');
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect();
        }
        $resultado = $this->Musuarios->getUsuariosCedula();

        if ($resultado) {
            $datos = $this->datosHeaderMenu();
            $datos['usuarios'] = $resultado;
            if($datos){
                $this->load->view('layouts/headerI',$datos);
                //$this->load->view('usuarios/VmisDatos');
                $this->load->view('usuarios/misDatos');
            }
        }
     
    }


    public function VoportunidadNegocio(){
        comprobarUsuarioLogueado();

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

        $this->session->unset_userdata('buscar');//elimina la palabra del buscador
        //$resultado = $this->Mpublicacion->getCategorias();
        //$resultado2 = $this->Mpublicacion->getMarca2();
        //$resultado3 = $this->Mgeo->getEstados();

        $data['estatus'] = 1;//activas
        $data['cantidad'] = 3;//cantidad
        $data['categoria'] = 1;//carros
        $resultado4 = $this->Mpublicacion->getPublicaciones($data);

        $data['estatus'] = 1;//activas
        $data['cantidad'] = 10;
        $data['categoria'] = 7;//camionetas
        $resultado5 = $this->Mpublicacion->getPublicaciones($data);  

        //$datos['categorias'] = $resultado;
        //$datos['marca'] = $resultado2;
        //$datos['estados'] = $resultado3;
        $datos['publicaciones'] = $resultado4;
        $datos['publicaciones2'] = $resultado5;

        //if ($resultado4!="" and $resultado5!="") {
	if (true) {
	       $datos2 = $this->datosHeaderMenu();
            if ($datos2) {
                //$this->load->view('layouts/Vheader',$datos2);
                //$this->load->view('usuarios/Vinicio',$datos);
                $this->load->view('layouts/header',$datos2);
                $this->load->view('usuarios/inicio',$datos);
            }
            //$this->load->view('usuarios/Vfooter');
        }
    }

    public function VdatosUbicacion(){
        comprobarUsuarioLogueado();

        $resultado2 = $this->Mgeo->getEstados();
        $datos['estados'] = $resultado2;
        $datos = $this->datosHeaderMenu();
        if ($datos) {
            $this->load->view('layouts/Vheader',$datos);
            $this->load->view('usuarios/VactualizarDatosUbi',$datos);
        }             

      
    }

    public function actualizarDatosUbicacion(){
comprobarUsuarioLogueado();

        $this->form_validation->set_rules('codigoestado', 'Estado', 'trim|required|numeric');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'trim|required|numeric');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'trim|required|numeric');
        $this->form_validation->set_rules('direccion_esp', 'Dirección', 'trim|required|min_length[3]|max_length[255]|strip_tags');

            $this->form_validation->set_error_delimiters('<label class="red">', '</label>');

            $this->form_validation->set_message('required', 'Debe llenar el campo %s');

            if ($this->form_validation->run() === FALSE) {

                $datos['estados'] = $resultado2;
                $datos['mensaje'] = "Formulario incorrecto";             
                $this->load->view('layouts/Vheader');
                $this->load->view('usuarios/VactualizarDatosUbi',$datos);
                $this->load->view('usuarios/Vfooter'); 

            } else {
                $datos['codigoestado'] = $this->input->post('codigoestado');
                $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
                $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
                $datos['direccion_esp'] = $this->input->post('direccion_esp');
                
                $resultado2 = $this->Musuarios->actualizarDatosUbicacion($datos);
                
                if ($resultado2) {

                    $this->session->set_flashdata('mensaje2', 'Datos actualizados correctamente');
                    redirect("Cusuarios/VmisDatos"); 

                }else{
                    $this->session->set_flashdata('mensaje', 'Error al actualizar los datos');
                    redirect("Cusuarios/VmisDatos");               
                }
            }   

    }

    public function VdatosContacto(){
comprobarUsuarioLogueado();

        $datos = $this->datosHeaderMenu();
        if ($datos) {
            $this->load->view('layouts/Vheader',$datos);
            $this->load->view('usuarios/VactualizarDatosCon');
        } 
    }

    public function actualizarDatosContacto(){
comprobarUsuarioLogueado();
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
comprobarUsuarioLogueado();

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
        $datos = $this->datosHeaderMenu();
        if ($datos) {
            $this->load->view('layouts/Vheader',$datos);
            $this->load->view('usuarios/VactualizarDatosPer');
        }  
    }

    public function actualizarDatosPersonales(){

comprobarUsuarioLogueado();

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
                $datos['mensaje'] = "Formulario incorrecto";

                $this->load->view('layouts/Vheader');
                $this->load->view('usuarios/VactualizarDatosPer',$datos);

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

                    $this->session->set_flashdata('mensaje2', 'Datos actualizados correctamente');
                    redirect("Cusuarios/VmisDatos"); 

                }else{
                    $this->session->set_flashdata('mensaje', 'Error al actualizar los datos');
                    redirect("Cusuarios/VmisDatos");               
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
        if ($this->session->userdata('completar')==0) {
            $this->session->set_flashdata('mensaje', 'Por favor completa tus datos para poder ingresar a esta seccion de la pagina');
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect();
        }

        $datos = $this->datosHeaderMenu();

        if ($datos) {
            $this->load->view('layouts/Vheader',$datos);
            $this->load->view('usuarios/VcambiarClave');
        }

        
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

        if ($this->session->userdata('id_usuario')) {
            redirect();
        }

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
            $datos['mensaje'] = "Formulario incorrecto";
            //$this->load->view('usuarios/Vheader');
            $this->load->view('usuarios/VrecuperarClave',$datos);
            //$this->load->view('usuarios/Vfooter');
        } else {
            $datos['email'] = mb_strtolower($this->input->post('email'));
            
            $resultado = $this->Musuarios->consultarJovenEmail($datos);

            if ($resultado) {
                $datos['keypass'] = md5(time());
                $datos['new_pass'] = substr(sha1(time()),0,8);

                $link = base_url()."Cusuarios/reiniciarClave/" .$datos['keypass']."/".$resultado[0]->cedula;


                if($this->enviarEmailRecuperacion($datos,$resultado,$link)){
                    $datos["resultado"] = $resultado;
                    if($this->Musuarios->agregarKeyPassNewPass($datos)){

                    $this->session->set_flashdata('mensaje', 'Por favor revise la bandeja de entrada de su correo para continuar con el proceso de recuperación de contraseña');
                    redirect("Cusuarios/VrecuperarClave"); 

                    }else{
                        $this->session->set_flashdata('mensaje2', 'Error no se pudo actualizar');//Error no se actualizo la tabla con el keypass y newpass
                        redirect("Cusuarios/VrecuperarClave"); 
                    }

                }else{
                    $this->session->set_flashdata('mensaje2', 'Error no se pudo enviar el correo, intente de nuevo');
                    redirect("Cusuarios/VrecuperarClave"); 
                }
            }else{
                $this->session->set_flashdata('mensaje2', 'Error el Email no existe en el sistema');
                redirect("Cusuarios/VrecuperarClave"); 
            }
        }
    }

    public function enviarEmailRecuperacion($datos,$resultado,$link) {

        $config = array(
            /* 'protocol' => 'smtp',
              'smtp_host' => 'smtp.googlemail.com',
              'smtp_user' => 'romel174gl@gmail.com',
              'smtp_pass' => 'memonada',
              'smtp_port' => '456',
              'smtp_crypto' => 'ssl', */
            'mailtype' => 'html',
            /* 'wordwrap' => TRUE, */
            'charset' => 'utf-8'
        );

        //envio de email de verificación
        $asunto = "Solicitud de cambio de contraseña";

        $mensaje = "<p>El dia <strong>".date('d/m/Y H:i:s')."</strong> se ha generado una Solicitud de cambio de contraseña</p>";
        $mensaje.= "<p>Si no has solicitado esto, has caso omiso a este mensaje, en cambio si deseas modificar tu contraseña debes hacer click en el encale de abajo</p>";


        $mensaje.= "<table><tr><th>Contraseña nueva generada</th><td>".$datos['new_pass']."</td></tr></table>";

        $mensaje.= "<table><tr><th>Si deseas utilizar la contraseña generada debes presionar </th><td><a href='".$link."'>AQUI</a></td></tr></table>";

        $mensaje.="<p>Sino a solicitado un cambio de contraseña no necesitas hacer nada.</p>";


        $this->email->initialize($config);
        $this->email->from('romel174gl@gmail.com', 'Bien Fino');
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

comprobarUsuarioLogueado();

        $this->form_validation->set_rules('clave_actual', 'Contraseña actual', 'trim|min_length[6]|max_length[16]|required');
            $this->form_validation->set_rules('password', 'Contraseña nueva', 'trim|min_length[6]|max_length[16]|required');
            $this->form_validation->set_rules('new_password', 'Repetir Contraseña nueva', 'trim|matches[password]|required');

            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

            $this->form_validation->set_message('required', 'Debe llenar el campo %s');

            if ($this->form_validation->run() === FALSE) {
                $datos['mensaje'] = "Formulario incorrecto";
                $this->load->view('layouts/Vheader');
                $this->load->view('usuarios/VcambiarClave',$datos);

            } else {
                $datos['clave_actual'] = $this->input->post('clave_actual');
                $datos['password'] = $this->input->post('password');
                $datos['new_password'] = password_hash($this->input->post('new_password'),PASSWORD_DEFAULT);

                
                $resultado = $this->Musuarios->consultarJovenCedulaSession($datos);

                if ($resultado) {

                    if (password_verify($datos['clave_actual'],$resultado[0]->clave)) {


                        $resultado = $this->Musuarios->cambiarPasswordJoven($datos);

                        if ($resultado) {

                            $this->session->set_flashdata('mensaje', 'Contraseña cambiada correctamente');
                            redirect('Cusuarios/VcambiarClave');

                        }else{
                            $this->session->set_flashdata('mensaje', 'Error no se pudo cambiar la contraseña');
                            redirect('Cusuarios/VcambiarClave');
                        }
                  
                    }else{

                        $datos['mensaje'] = "contraseña actual no coincide";
                        $this->load->view('layouts/Vheader');
                        $this->load->view('usuarios/VcambiarClave', $datos);
                        $this->load->view('usuarios/Vfooter');                            
                    }



                }else{
                    $datos['mensaje'] = "Ocurrio un error intente de nuevo";
                    $this->load->view('layouts/Vheader');
                    $this->load->view('usuarios/VcambiarClave', $datos);
                    $this->load->view('usuarios/Vfooter');                
                }
            }
    }    

    public function completarRegistro() {

        if ($this->session->userdata('completar')==1) {
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect();
        }

        $this->form_validation->set_rules('moviluno', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|required|callback_telfmovil|strip_tags');

        if ($this->input->post('movildos')!="") {
            $this->form_validation->set_rules('movildos', 'Movil','trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');

        }

        $this->form_validation->set_rules('codigoestado', 'Estado', 'required|numeric');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'required|numeric');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'required|numeric');
        $this->form_validation->set_rules('direccion_esp', 'Dirección', 'required|min_length[3]|max_length[255]');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('telfmovil', 'Ingresa un formato correcto %s');


        if ($this->form_validation->run() === FALSE) {

            $resultado = $this->Musuarios->getUsuariosCedula();
            $resultado2 = $this->Mgeo->getEstados();
            $datos['estados'] = $resultado2;
            $datos['usuarios'] = $resultado;

            $datos['mensaje'] = "Error Verifique los campos";
            $this->load->view('layouts/Vheader');
            $this->load->view('usuarios/VcompletarRegistro',$datos);
            //$this->load->view('usuarios/Vfooter');

        } else {

            $datos['moviluno'] = $this->input->post('moviluno');
            $datos['movildos'] = $this->input->post('movildos');
            $datos['codigoestado'] = $this->input->post('codigoestado');
            $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
            $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
            $datos['direccion_esp'] = mb_strtolower($this->input->post('direccion_esp'));


                $resultado = $this->Musuarios->completarRegistro($datos);
                
                if ($resultado) {
                        $s_usuario = array(
                            'completar' => 1
                        );
                        $this->session->set_userdata($s_usuario);

                    $this->session->set_flashdata('mensaje', 'Se completo los datos correctamente');
                    redirect();

                } else {
                    $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
                    //mando a la vista de error
                    redirect('completarregistro');
                }

        }                             
    }
    //sin uso
    public function actualizarDatos() {

        $this->form_validation->set_rules('nombres', 'Nombres', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        //$this->form_validation->set_rules('cedula', 'Cedula', 'required');
        $this->form_validation->set_rules('coduno', 'Codigo', 'required');
        $this->form_validation->set_rules('moviluno', 'Movil', 'required');
        $this->form_validation->set_rules('coddos', 'Codigo', '');
        $this->form_validation->set_rules('movildos', 'Movil','' );
        $this->form_validation->set_rules('codigoestado', 'Estado', 'required');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'required');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'required');
        $this->form_validation->set_rules('direccion_esp', 'Dirección', 'required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');


        if ($this->form_validation->run() === FALSE) {

            $resultado = $this->Musuarios->getUsuariosCedula();
            $resultado2 = $this->Mgeo->getEstados();
            $datos['estados'] = $resultado2;
            $datos['usuarios'] = $resultado;

            $datos['mensaje'] = "Error Verifique los campos";
            $this->load->view('usuarios/Vheader');
            $this->load->view('usuarios/miPerfil',$datos);
            $this->load->view('usuarios/Vfooter');

        } else {
            $datos['nombres'] = $this->input->post('nombres');
            $datos['apellidos'] = $this->input->post('apellidos');
            $datos['email'] = $this->input->post('email');
            $datos['coduno'] = $this->input->post('coduno');
            $datos['moviluno'] = $this->input->post('moviluno');
            $datos['coddos'] = $this->input->post('coddos');
            $datos['movildos'] = $this->input->post('movildos');
            $datos['codigoestado'] = $this->input->post('codigoestado');
            $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
            $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
            $datos['direccion_esp'] = $this->input->post('direccion_esp');


                $resultado = $this->Musuarios->actualizarUsuario($datos);

                        $s_usuario = array(
                            'id_usuario' => $resultado->id_usuario,
                            'nombres' => $resultado->nombres,
                            'apellidos' => $resultado->apellidos,
                            'cedula' => $resultado->cedula,
                            'email' => $resultado->email,
                            'id_grupo' => $resultado->id_grupo,
                            'completar' => $resultado->completar
                        );
                        $this->session->set_userdata($s_usuario);

                    if ($resultado) {
                        $this->session->set_flashdata('mensaje2', 'Se cambio los datos correctamente');
                        redirect('miPerfil');

                    } else {
                        $this->session->set_flashdata('mensaje', 'Ocurrio un error');
                        //mando a la vista de error
                        redirect('miPerfil');
                    }

        }                             
    }
    //sin uso
    public function miPerfil() {
        $resultado = $this->Musuarios->getUsuariosCedula();
        $resultado2 = $this->Mgeo->getEstados();
        $datos['estados'] = $resultado2;
        $datos['usuarios'] = $resultado;


        $this->load->view('usuarios/Vheader');
        $this->load->view('usuarios/miPerfil',$datos);
        $this->load->view('usuarios/Vfooter');
    }

    public function VcompletarRegistro(){

        if ($this->session->userdata('completar')==1) {
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect();
        }

        $resultado2 = $this->Mgeo->getEstados();
        $datos['estados'] = $resultado2;

        $datos = $this->datosHeaderMenu();
        if($datos){
            $this->load->view('layouts/Vheader',$datos);
            $this->load->view('usuarios/VcompletarRegistro',$datos);
            //$this->load->view('usuarios/Vfooter');                   
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
        $this->form_validation->set_rules('clave', 'Clave', 'required|min_length[6]|max_length[16]');
        //validaciones
        //delimitadores de errores
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //delimitadores de errores
        //reglas de validación
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');
        $this->form_validation->set_message('valid_email', 'El campo %s no posee un email válido');
        //reglas de validación


        if ($this->form_validation->run() === FALSE) {
            $datos['mensaje'] = "Inicio de Sesión incorrecto";

            $this->load->view('usuarios/Vlogin', $datos);

        } else {

            $datos['email'] = mb_strtolower($this->input->post('email'));
            $datos['clave'] = $this->input->post('clave');



            $resultado = $this->Musuarios->ingresarUsuario($datos);
            
            if ($resultado->activo == 0) {
                //var_dump($resultado->activo);exit();
                $this->session->set_flashdata('mensaje', 'Usuario inactivo');
                redirect('Cusuarios/login');
            }

            if ($resultado) {
            //verificar que el usuario este verificado para poder realizar el ingreso		       
                $clave = $resultado->clave;

                if(password_verify($datos['clave'],$resultado->clave)){

                    $s_usuario = array(
                        
                        'id_usuario' => $resultado->id_usuario,
                        'nombres' => $resultado->nombres,
                        'apellidos' => $resultado->apellidos,
                        'cedula' => $resultado->cedula,
                        'email' => $resultado->email,
                        'id_grupo' => $resultado->id_grupo,
                        'completar' => $resultado->completar,
                        'verificado' => $resultado->verificado
                    );
                    $this->session->set_userdata($s_usuario);

                    if ($this->session->userdata('verificado')==0) {
                        redirect('validarcuenta');
                    }else{
                        if ($this->session->userdata('completar')==0) {

                            $this->session->set_flashdata('mensaje', 'Debes completar tus datos para poder realizar una publicación');
                            redirect('completarregistro');
                        }else{
                            redirect();                        
                        }
                    }

                } else {
                    //mando a la vista de error
                    $datos['mensaje'] = "Email o Clave incorrectas";

                    $this->load->view('usuarios/Vlogin', $datos);

                }
            } else {
                $datos['mensaje'] = "Credenciales incorrectas";

                $this->load->view('usuarios/Vlogin', $datos);

            }
        }
    }

    public function cerrar_session() {
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('nombres');
        $this->session->unset_userdata('apellidos');
        $this->session->unset_userdata('cedula');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('buscar');
        $this->session->unset_userdata('verificado');

        redirect();
    }

    public function registrarUsuario() {


        //validaciones
        $this->form_validation->set_rules('nac', 'Nacionalidad', 'trim|required|strip_tags');
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|numeric|min_length[7]|max_length[8]|strip_tags');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]|max_length[60]|strip_tags|callback_alpha_dash_space');
        $this->form_validation->set_rules('apellidos', 'Apellidos|callback_alpha_dash_space', 'trim|required|min_length[3]|max_length[60]|strip_tags');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|callback_email_check');
        $this->form_validation->set_rules('email_r', 'Repetir Email', 'valid_email|required|matches[email]');
        $this->form_validation->set_rules('clave', 'Clave', 'required|min_length[6]|max_length[16]');
        $this->form_validation->set_rules('rclave', 'Repetir Clave', 'matches[clave]|required');
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
            $datos['mensaje'] = "Formulario incorrecto";

            $this->load->view('usuarios/Vregistrar', $datos);

        } else {

            $datos['cedula'] = $this->input->post('nac') . $this->input->post('cedula');
            $datos['nombres'] = mb_strtolower($this->input->post('nombres'));
            $datos['apellidos'] = mb_strtolower($this->input->post('apellidos'));
            $datos['email'] = mb_strtolower($this->input->post('email'));
            $datos['clave'] = password_hash($this->input->post('clave'),PASSWORD_DEFAULT);
            $datos['verificado'] = 0;
            $datos['activo'] = 1;
            $datos['id_grupo'] = 1;
            $datos['codigo_verificacion'] = $this->generarCodigo(10);


            $validacion = $this->cedula_check($datos['cedula']); //devuelve false si encuentra la cedula
            if ($validacion) {

                $resultado = $this->enviarEmailVerificacion($datos['codigo_verificacion'], $datos['email'], $datos['cedula']);//reponde TRUE si se envio el email

                if ($resultado) {
                    //metodo para registrar un usuario
                    $resultado2 = $this->Musuarios->registrarUsuario($datos);

                    if ($resultado2) {
                        $this->load->view('layouts/Vheader');
                        $this->load->view('usuarios/Vverificar');
                        //$this->load->view('usuarios/Vfooter');
                    }else{
                        $datos['mensaje'] = "ERROR no se pudo registrar el usuario intente de nuevo";

                        $this->load->view('usuarios/Vregistrar', $datos);
                          
                    }
                }else{
                    $datos['mensaje'] = "ERROR no se pudo enviar el email";

                    $this->load->view('usuarios/Vregistrar', $datos);
                  
                }

            }else{

                $datos['mensaje'] = "La cédula ya se encuentra registrada";

                $this->load->view('usuarios/Vregistrar', $datos);

            }
        }
    }

    public function enviarEmailVerificacion($codigo_verificacion, $email) {

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

        $mensaje = "<h1>Gracias por registrarte en BienFino.com</h1><br>";
        $mensaje.= "<h3>Antes de que activemos tu cuenta un último paso debe tomarse para completar tu registro!<br> 
            Por favor ten en cuenta que debes completar este último paso para convertirte en usuario registrado.<br> Solo necesitas iniciar sesión y pegar el codigo a continuación para verificar tu cuenta.<br></h3><br>";

        $mensaje.= "<table><tr><th>Código de Verificación</th><td>".$codigo_verificacion."</td></tr></table>";

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
            $this->form_validation->set_message('email_check', 'El email ' . $email . ' ya se encuentra registrado');
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
    public function busqueda(){
        $buscar = "";
        
        $this->session->unset_userdata('id_categoria');
        $this->session->unset_userdata('id_marca');
        $this->session->unset_userdata('id_modelo');
        $this->session->unset_userdata('id_ano');

        if ($this->uri->segment(3) and $this->uri->segment(3) == 1 or $this->uri->segment(3) == 7) {
            $this->session->set_userdata('id_categoria', $this->uri->segment(3));
        }

        if ($this->input->post('id_categoria')!="") {
            $this->session->set_userdata('id_categoria', $this->input->post('id_categoria'));
        }
        if ($this->input->post('id_marca')!="") {
            $this->session->set_userdata('id_marca', $this->input->post('id_marca'));
        }
        if ($this->input->post('id_modelo')!="") {
            $this->session->set_userdata('id_modelo', $this->input->post('id_modelo'));
        }
        if ($this->input->post('id_ano')!="") {
            $this->session->set_userdata('id_ano', $this->input->post('id_ano'));
        }

        if ($this->input->post('buscar')) {
            $buscar = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->input->post('buscar')))));
            $this->session->unset_userdata('id_categoria');
            $this->session->unset_userdata('id_marca');
            $this->session->unset_userdata('id_modelo');
            $this->session->unset_userdata('id_ano');
        }

        $this->session->set_userdata("buscar",$buscar);
        redirect("Cusuarios/buscar");
    }

    public function buscar($nropagina = FALSE){

        $this->session->userdata('id_categoria');
        $this->session->userdata('id_marca');
        $this->session->userdata('id_modelo');
        $this->session->userdata('id_ano');

           // var_dump($id_categoria,$id_marca,$id_modelo, $id_ano);
           // exit();

        $arrayBuscar = array();

        if ($this->session->userdata("buscar")) {
            $cadena = $this->session->userdata("buscar");
            $arrayBuscar = explode(" ", $cadena);
        }


        $inicio = 0;
        $mostrarpor = 2;
        if ($nropagina) {
            $inicio = ($nropagina - 1) * $mostrarpor;
        }

        $resultado = $this->Musuarios->buscar($arrayBuscar);
 

        //libreria pagination
        $config['base_url'] = base_url()."buscar/";
        $config['total_rows'] = count($resultado);
        $config['per_page'] = $mostrarpor;
        $config['uri_segment'] = 2;//segmento donde se coloca el numero de paginacion
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."buscar";

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        //libreria pagination
        $resultado = $this->Musuarios->buscar($arrayBuscar, $inicio, $mostrarpor);

        if ($resultado) {
            //$resultado3 = $this->Mgeo->getEstados();               
            $datos['busqueda'] = $resultado;
            //$datos['estados'] = $resultado3;

            $this->load->view('usuarios/Vheader');
            $this->load->view('usuarios/Vbuscar',$datos);
            $this->load->view('usuarios/Vfooter');         
        }else{

            $datos['mensaje'] = "Disculpe no se encontraron resultados, intente de nuevo";
            $this->load->view('usuarios/Vheader');
            $this->load->view('usuarios/Vbuscar',$datos);
            $this->load->view('usuarios/Vfooter');         
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

    public function reiniciarClave($keypass,$cedula) {

        if (!is_null($keypass) AND !is_null($cedula)) {

            $new_pass = $this->Musuarios->reiniciarClave($keypass,$cedula);

            if ($new_pass) {
                $this->session->set_flashdata('mensaje2', 'Contraseña cambiada correctamente intente Iniciar Sesión con ella:<h4>'.$new_pass.'</h4>');
                redirect('ingresar');           
            }else{
                $this->session->set_flashdata('mensaje', 'No se pudo reiniciar la contraseña intente nuevamente');                
                redirect('ingresar');        
            }


        }else {
            redirect();
        }
    } 

}
