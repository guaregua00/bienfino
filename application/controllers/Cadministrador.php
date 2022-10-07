<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cadministrador extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //$this->load->model('Mpublicacion');
        $this->load->model('Madministrador');
        $this->load->model('Mpublicacion');
        $this->load->model('Mpago');
        $this->load->model('Mgeo');
        $this->load->library('form_validation');
        $this->load->helper('mensajes_helper');
        //$this->load->library('encrypt');
        //$this->load->library('upload');
        //$this->load->library('image_lib');
        $this->load->model('Musuarios');
        //$this->load->helper('codigo');
        //$this->output->enable_profiler(TRUE);
    }

    public function index()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
        $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
        $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
        $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);


        //devuelve el numero de publicaciones x cada usuario
        $resultado3 = $this->Madministrador->countUsuariosPublicacion();
        $datos['usuarios'] = $resultado3;
        /* var_dump($datos['usuarios'][0]->cantidad);exit; */
        //var_dump($resultado3);exit();

        $resultado2 = $this->Mgeo->getEstados();
        $datos['estados'] = $resultado2;

        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/Vinicio', $datos);
        $this->load->view('adm/Vfooter');
    }


    public function Vcambiarcontrasena()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_usuario'] = strip_tags(trim($this->uri->segment(3)));
        if (!ctype_digit($datos['id_usuario'])) {
            echo "id usuario incorrecto";
            exit; //valida que es numero entero
        }

        $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
        $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
        $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
        $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);


        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/Vcambiarcontrasena', $datos);
        $this->load->view('adm/Vfooter');
    }

    public function cambiarcontrasena()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_usuario'] = strip_tags(trim($this->uri->segment(3)));
        if (!ctype_digit($datos['id_usuario'])) {
            echo "id usuario incorrecto";
            exit; //valida que es numero entero
        }

        $this->form_validation->set_rules('clave', 'Clave', 'trim|required|min_length[6]|max_length[16]|strip_tags');
        $this->form_validation->set_rules('rclave', 'Repetir Clave', 'matches[clave]|required');

        $this->form_validation->set_error_delimiters('<p class="#000">', '</p>');

        $this->form_validation->set_message('alpha_dash_space', 'Solo se permite letras en %s');
        $this->form_validation->set_message('telfmovil', 'Ingresa un formato correcto %s');


        if ($this->form_validation->run() === FALSE) {

            $mensaje = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje);

            redirect('Cadministrador/Vcambiarcontrasena/' . $datos['id_usuario'], $mensaje);
        } else {

            $datos['clave'] = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);

            if ($this->Madministrador->cambiarcontrasena($datos)) {

                $this->session->set_flashdata('mensajecompletado', 'Contraseña cambiada correctamente');
                redirect('Cadministrador/Vusuarios');
            } else {
                $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
                //mando a la vista de error
                redirect('administrador/Vusuarios');
            }
        }
    }

    public function VregistrarUsuario()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
        $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
        $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
        $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

        $resultado2 = $this->Mgeo->getEstados();
        $datos['estados'] = $resultado2;

        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/VregistrarUsuario', $datos);
        $this->load->view('adm/Vfooter');
    }

    public function VactualizarUsuario()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
        $datos['id_usuario'] = strip_tags(trim($this->uri->segment(3)));
        if (!ctype_digit($datos['id_usuario'])) {
            echo "id usuario incorrecto";
            exit; //valida que es numero entero
        }

        $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
        $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
        $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
        $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

        $resultado = $this->Musuarios->getUsuariosCedulaParametro($datos['id_usuario']);
        $datos['usuario'] = $resultado;

        $resultado2 = $this->Mgeo->getEstados();
        $datos['estados'] = $resultado2;



        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/VactualizarUsuario', $datos);
        $this->load->view('adm/Vfooter');
    }


    public function actualizarUsuario()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_usuario'] = strip_tags(trim($this->uri->segment(3)));

        if (!ctype_digit($datos['id_usuario'])) {
            echo "id usuario incorrecto";
            exit; //valida que es numero e
        }

        //validaciones
        $this->form_validation->set_rules('nac', 'Nacionalidad', 'trim|required|strip_tags');
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|numeric|min_length[7]|max_length[8]|strip_tags');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]|max_length[60]|strip_tags|callback_alpha_dash_space');
        $this->form_validation->set_rules('apellidos', 'Apellidos|callback_alpha_dash_space', 'trim|required|min_length[3]|max_length[60]|strip_tags');
        if ($this->input->post('email') != "") {
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|strip_tags');
        }
        $this->form_validation->set_rules('moviluno', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|required|callback_telfmovil|strip_tags');
        if ($this->input->post('movildos') != "") {
            $this->form_validation->set_rules('movildos', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');
        }
        $this->form_validation->set_rules('codigoestado', 'Estado', 'required|numeric');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'required|numeric');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'required|numeric');
        $this->form_validation->set_rules('direccion_esp', 'Dirección', 'required|min_length[3]|max_length[255]');

        $this->form_validation->set_error_delimiters('<p class="#000">', '</p>');

        $this->form_validation->set_message('alpha_dash_space', 'Solo se permite letras en %s');
        $this->form_validation->set_message('telfmovil', 'Ingresa un formato correcto %s');
        //validaciones

        if ($this->form_validation->run() === FALSE) {

            $mensaje = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje);


            redirect('Cadministrador/Vactualizarusuario/' . $datos['id_usuario'], $mensaje);
        } else {


            $datos['cedula'] = $this->input->post('nac') . $this->input->post('cedula');
            $datos['nombres'] = mb_strtolower($this->input->post('nombres'));
            $datos['apellidos'] = mb_strtolower($this->input->post('apellidos'));
            $datos['email'] = mb_strtolower($this->input->post('email'));
            $datos['moviluno'] = $this->input->post('moviluno');
            if ($this->input->post('movildos') != "") {
                $datos['movildos'] = $this->input->post('movildos');
            }
            $datos['codigoestado'] = $this->input->post('codigoestado');
            $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
            $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
            $datos['direccion_esp'] = mb_strtolower($this->input->post('direccion_esp'));


            if ($this->Madministrador->actualizarUsuarioCompleto($datos)) {
                $this->session->set_flashdata('mensajecompletado', 'Usuario actualizado correctamente');
                redirect('Cadministrador/VactualizarUsuario/' . $datos['id_usuario']);
            } else {

                $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
                //mando a la vista de error
                redirect('Cadministrador/VactualizarUsuario/' . $datos['id_usuario']);
            }
        }
    }

    public function eliminarUsuarioDesactivar()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_usuario'] = strip_tags(trim($this->uri->segment(3)));


        if (!ctype_digit($datos['id_usuario'])) {
            echo "id usuario incorrecto";
            exit;
        }

        if ($this->Madministrador->eliminarUsuarioDesactivar($datos)) {

            $this->session->set_flashdata('mensajecompletado', 'Operación Exitosa');
            redirect('Cadministrador/Vusuarios/');
        } else {
            $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
            //mando a la vista de error
            redirect('administrador/Vusuarios/');
        }
    }

    public function activarUsuario()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_usuario'] = strip_tags(trim($this->uri->segment(3)));


        if (!ctype_digit($datos['id_usuario'])) {
            echo "id usuario incorrecto";
            exit;
        }

        if ($this->Madministrador->activarUsuario($datos)) {

            $this->session->set_flashdata('mensajecompletado', 'Operación Exitosa');
            redirect('Cadministrador/Vusuarios/');
        } else {
            $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
            //mando a la vista de error
            redirect('administrador/Vusuarios/');
        }
    }


    public function registrarUsuario()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        //validaciones
        $this->form_validation->set_rules('nac', 'Nacionalidad', 'trim|required|strip_tags');
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|numeric|min_length[7]|max_length[8]|strip_tags');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]|max_length[60]|strip_tags|callback_alpha_dash_space');
        $this->form_validation->set_rules('apellidos', 'Apellidos|callback_alpha_dash_space', 'trim|required|min_length[3]|max_length[60]|strip_tags');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|callback_email_check|strip_tags');
        $this->form_validation->set_rules('remail', 'Repetir Email', 'trim|valid_email|required|matches[email]|callback_email_check|strip_tags');
        $this->form_validation->set_rules('moviluno', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|required|callback_telfmovil|strip_tags');
        if ($this->input->post('movildos') != "") {
            $this->form_validation->set_rules('movildos', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');
        }
        $this->form_validation->set_rules('codigoestado', 'Estado', 'required|numeric');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'required|numeric');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'required|numeric');
        $this->form_validation->set_rules('direccion_esp', 'Dirección', 'required|min_length[3]|max_length[255]');

        $this->form_validation->set_error_delimiters('<p class="#000">', '</p>');

        $this->form_validation->set_message('alpha_dash_space', 'Solo se permite letras en %s');
        $this->form_validation->set_message('telfmovil', 'Ingresa un formato correcto %s');
        //validaciones

        if ($this->form_validation->run() === FALSE) {

            $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
            $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
            $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
            $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

            $resultado2 = $this->Mgeo->getEstados();
            $datos['estados'] = $resultado2;

            $mensaje = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje);

            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/VregistrarUsuario', $datos);
            $this->load->view('adm/Vfooter');
        } else {

            $datos['cedula'] = $this->input->post('nac') . $this->input->post('cedula');
            $datos['nombres'] = mb_strtolower($this->input->post('nombres'));
            $datos['apellidos'] = mb_strtolower($this->input->post('apellidos'));
            $datos['email'] = mb_strtolower($this->input->post('email'));
            $datos['clave'] = password_hash($this->input->post('cedula'), PASSWORD_DEFAULT);
            $datos['moviluno'] = $this->input->post('moviluno');
            if ($this->input->post('movildos') != "") {
                $datos['movildos'] = $this->input->post('movildos');
            }
            $datos['codigoestado'] = $this->input->post('codigoestado');
            $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
            $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
            $datos['direccion_esp'] = mb_strtolower($this->input->post('direccion_esp'));
            $datos['verificado'] = 1;
            $datos['activo'] = 1;
            $datos['id_grupo'] = 1;
            $datos['codigo_verificacion'] = $this->generarCodigo(10);
            /*  ID   nombre
                1	"Persona Natural"
                2	"Persona Juridica"
                3	"Usuario Bienfino" 
            */

            if ($this->Madministrador->registrarUsuarioCompleto($datos)) {


                $datos['asunto'] = "Confirmación Registro Exitoso";
                $datos['titulo'] = "Bienvenid@ a BienFino.com";
                $datos['mensaje'] = "¡Felicitaciones! Sus datos han sido ingresados exitosamente en nuestro sistema.";
                $datos['usuario'] = $datos['email'];
                $datos['clave'] = $this->input->post('cedula');
                $datos['nombres'] = $datos['nombres'];
                $datos['apellidos'] = $datos['apellidos'];

                @$this->send_email($datos);

                $this->session->set_flashdata('mensajecompletado', 'Usuario registrado correctamente');
                redirect('Cadministrador/VregistrarUsuario');
            } else {
                $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
                //mando a la vista de error
                redirect('administrador/VregistrarUsuario');
            }
        }
    }


    public function send_email($datos)
    {

        $vista = $this->load->view('email/confirmacion', $datos, TRUE);

        $config = array(
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



        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }



    public function reportePago()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
        $id_pago_estatus = $this->uri->segment(3);

        if ($id_pago_estatus) {
            $resultado = $this->Mpago->getPagos($id_pago_estatus);
            $resultado2 = $this->Madministrador->getCantidadPagoPorEstatus();

            $datos['porVerificar'] = $resultado2[0];
            $datos['verificando'] = $resultado2[1];
            $datos['consolidado'] = $resultado2[2];
            $datos['anulado'] = $resultado2[3];

            $datos['pago'] = $resultado;
            $datos['id_pago_estatus'] = $id_pago_estatus;
            //$datos['cantidad'] = count($datos['pago']);

            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/VreportePago', $datos);
            $this->load->view('adm/Vfooter');
        }
    }

    public function publicaciones()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
        $id_status = $this->uri->segment(3);

        if ($id_status) {


            $publicaciones = $this->Madministrador->getPubliciones($id_status);
            //var_dump(count($publicaciones));exit;
            $datos['publicaciones'] = $publicaciones;

            $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
            $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
            $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
            $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/Vpublicaciones', $datos);
            $this->load->view('adm/Vfooter');
        }
    }


    public function VaccionesPago()
    {

        $resultado = $this->Mpago->getPagos($this->session->flashdata('id_pago_estatus'));


        $datos['pago'] = $resultado;
        $datos['id_pago_estatus'] = $this->session->flashdata('id_pago_estatus');

        $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
        $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
        $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
        $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/VreportePago', $datos);
        $this->load->view('adm/Vfooter');
    }

    public function accionesPago()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
        /*        
        // 1 por verificar
        // 2 Verificando
        // 3 Consolidado
        // 4 Anulado
        */
        $id_pago_estatus = $this->input->post('id_pago_estatus');
        $datos['accion'] = $this->input->post('accion');
        $datos['id_pago'] = $this->input->post('id_pago');
        $datos['id_publicacion'] = $this->input->post('id_publicacion');


        $resultado = $this->Madministrador->cambiarEstatusPago($datos);

        if ($resultado) {
            $this->session->set_flashdata('id_pago_estatus', $id_pago_estatus);
            $this->session->set_flashdata('mensaje', 'Operación Exitosa');
            redirect("Cadministrador/VaccionesPago");
        } else {
            $this->session->set_flashdata('id_pago_estatus', $id_pago_estatus);
            $this->session->set_flashdata('mensaje2', 'Error al realizar la operación');
            redirect("Cadministrador/VaccionesPago");
        }
    }


    public function login()
    {
        if ($this->session->userdata('id_adm')) {
            $this->index();
        }
        $this->load->view('adm/Vlogin');
    }

    public function Vusuarios()
    {
        $resultado = $this->Madministrador->getUsuarios();

        if ($resultado) {
            $datos['usuarios'] = $resultado;
            /*             $resultado2 = $this->Madministrador->getCantidadPagoPorEstatus(); */

            $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
            $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
            $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
            $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/Vusuarios', $datos);
            $this->load->view('adm/Vfooter');
        }
    }

    public function VhistoricoPagos()
    {
        $resultado = $this->Madministrador->getPagoHistoricoPagos();

        if ($resultado) {
            $datos['pagohistorico'] = $resultado;
            $resultado2 = $this->Madministrador->getCantidadPagoPorEstatus();

            $datos['porVerificar'] = $resultado2[0];
            $datos['verificando'] = $resultado2[1];
            $datos['consolidado'] = $resultado2[2];
            $datos['anulado'] = $resultado2[3];

            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/VhistoricoPago', $datos);
            $this->load->view('adm/Vfooter');
        }
    }

    public function VhistoricoUsuarios()
    {
        $resultado = $this->Madministrador->getPagoHistoricoUsuarios();

        if ($resultado) {
            $datos['pagohistorico'] = $resultado;

            $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
            $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
            $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
            $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/VhistoricoUsuarios', $datos);
            $this->load->view('adm/Vfooter');
        }
    }

    public function VhistoricoPublicaciones()
    {
        $resultado = $this->Madministrador->getPagoHistoricoPublicaciones();

        if ($resultado) {
            $datos['pagohistorico'] = $resultado;

            $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
            $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
            $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
            $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/VhistoricoPublicaciones', $datos);
            $this->load->view('adm/Vfooter');
        }
    }

    public function procesarAccionUsuario()
    {
        $datos['accion'] = $this->input->post('accion');
        //$datos['cedula'] = $this->input->post('cedula');
        $datos['cedula'] = $this->input->post('id_usuario');
        $datos['comentario_adm'] = $this->input->post('comentario_adm');

        if ($this->input->post('accion')) {
            $resultado = $this->Madministrador->procesarAccionUsuario($datos);
            if ($resultado) {
                $this->session->set_flashdata('mensaje', 'Operación Exitosa');
                redirect('Cadministrador/Vusuarios');
            } else {
                $this->session->set_flashdata('mensaje2', 'Error al realizar la Operación');
                redirect('Cadministrador/Vusuarios');
            }
        }
    }

    public function procesarAccionPublicacion()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
        /*
    Activo 1
    Por revisar 6
    Rechazado 10
    Verificado 11 
    Vendido 5
    */
        $datos['id_publicacion'] = strip_tags(trim($this->uri->segment(3)));
        $datos['codigo'] = strip_tags(trim($this->uri->segment(4)));
        $datos['id_usuario'] = strip_tags(trim($this->uri->segment(5)));
        $datos['accion'] = strip_tags(trim($this->uri->segment(6))); //estatus
        $datos['seccion_publicacion'] = strip_tags(trim($this->uri->segment(7))); //estatus

        if (isset($datos['accion']) and $datos['accion'] == 1) {
            $fecha_inicio = date_create();
            $datos['fecha_inicio'] = date_format($fecha_inicio, 'Y-m-d H:i:s.u');
            $fecha_final = date_create("45 days");
            $datos['fecha_final'] = date_format($fecha_final, 'Y-m-d H:i:s.u');
        }


        if (isset($datos) and $datos != "") {

            $resultado = $this->Madministrador->procesarAccionPublicacion($datos);

            if ($resultado) {
                $this->session->set_flashdata('mensaje', 'Operación Exitosa');
                redirect('Cadministrador/publicaciones/' . $datos['seccion_publicacion']);
            } else {
                $this->session->set_flashdata('mensaje2', 'Error al realizar la Operación');
                redirect('Cadministrador/publicaciones/' . $datos['seccion_publicacion']);
            }

            /*             }else{
                $this->session->set_flashdata('mensaje2','Error No se puede activar ó inactivar una publicación que no tiene un pago CONSOLIDADO asociado');
                redirect('Cadministrador/Vpublicaciones');   
            
            } */
        }
    }


    public function procesarAccionPago()
    {
        /*
    PUBLICACIONES
    Activo 1
    Inactivo 2
    Pausado 3
    Por pagar 4 
    Vendido 5
    Verificando Reporte Pago 6
    Anulado 7
    */

        /*
    PAGOS
    Por Verificar 1
    Verificando 2
    Consolidado 3
    Anulado 4 
    */

        $datos['accion'] = base64_decode($this->input->post('accion'));
        $datos['comentario_adm'] = $this->input->post('comentario_adm');
        $datos['id_publicacion'] = $this->input->post('id_publicacion');
        $datos['id_pago'] = $this->input->post('id_pago');


        if ($this->input->post('accion')) {
            $resultado = $this->Madministrador->procesarAccionPago($datos);
            if ($resultado) {
                $this->session->set_flashdata('mensaje', 'Operación Exitosa');

                if ($datos['accion'] == 1) {
                    redirect('Cadministrador/reportePago/1');
                } elseif ($datos['accion'] == 2) {
                    redirect('Cadministrador/reportePago/1');
                } elseif ($datos['accion'] == 3) {
                    redirect('Cadministrador/reportePago/2');
                } elseif ($datos['accion'] == 4) {
                    redirect('Cadministrador/reportePago/4');
                }
            } else {
                $this->session->set_flashdata('mensaje2', 'Error al realizar la Operación');
                redirect('Cadministrador/Vpublicaciones');
            }
        }
    }

    public function Vpublicaciones()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $resultado = $this->Madministrador->getPubliciones();
        $datos['publicaciones'] = $resultado;

        $resultado2 = $this->Madministrador->getCantidadPagoPorEstatus();

        $datos['porVerificar'] = $resultado2[0];
        $datos['verificando'] = $resultado2[1];
        $datos['consolidado'] = $resultado2[2];
        $datos['anulado'] = $resultado2[3];

        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/Vpublicaciones', $datos);
        $this->load->view('adm/Vfooter');
    }


    public function accionesUsuario()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['accion'] = $this->input->post('accion');
        $datos['id_usuario'] = $this->input->post('id_usuario');

        $resultado = $this->Musuarios->getUsuariosCedulaParametro($datos['id_usuario']);
        if ($resultado) {

            $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
            $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
            $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
            $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

            $datos['usuario'] = $resultado;
            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/VaccionesUsuarios', $datos);
            $this->load->view('adm/Vfooter');
        }
    }



    function VmodificarPublicacion()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_publicacion'] = strip_tags(trim($this->uri->segment(2)));
        $datos['codigo'] = strip_tags(trim($this->uri->segment(3)));
        $datos['seccion_publicacion'] = strip_tags(trim($this->uri->segment(4)));


        $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
        $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
        $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
        $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

        $datos['marcas'] = $this->Mpublicacion->getMarca();
        $datos['categorias'] = $this->Mpublicacion->getCategorias();;
        $datos['publicacion'] = $this->Mpublicacion->getPublicacionCodigo1($datos);;

        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/VmodificarPublicacion', $datos);
        $this->load->view('adm/Vfooter');
    }

    public function modificarPublicacion()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['codigo'] = strip_tags(trim($this->security->xss_clean($this->input->post('codigo'))));
        $datos['id_publicacion'] = strip_tags(trim($this->security->xss_clean($this->input->post('id_publicacion'))));
        $control['seccion_publicacion'] = strip_tags(trim($this->security->xss_clean($this->input->post('seccion_publicacion'))));


        //validaciones
        $this->form_validation->set_rules('id_categoria', 'Categoria', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('id_marca', 'Marca', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('id_modelo', 'Modelo', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('id_ano', 'Modelo', 'trim|numeric|required|strip_tags');

        $this->form_validation->set_error_delimiters('<p class="">', '</p>');
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');

        if ($this->form_validation->run() === FALSE) {

            $mensaje_error = validation_errors();
            $this->session->set_flashdata('mensaje2', $mensaje_error);
            redirect('Cadministrador/publicaciones/' . $control['seccion_publicacion']);
        } else {

            $datos['id_categoria'] = strip_tags(trim($this->security->xss_clean($this->input->post('id_categoria'))));
            $datos['id_marca'] = strip_tags(trim($this->security->xss_clean($this->input->post('id_marca'))));
            $datos['id_modelo'] = strip_tags(trim($this->security->xss_clean($this->input->post('id_modelo'))));
            $datos['id_ano'] = strip_tags(trim($this->security->xss_clean($this->input->post('id_ano'))));


            $datos['id_usuario2'] = strip_tags(trim($this->security->xss_clean($this->input->post('id_usuario'))));
            $datos['codigo'] = strip_tags(trim($this->security->xss_clean($this->input->post('codigo'))));
            $datos['id_publicacion'] = strip_tags(trim($this->security->xss_clean($this->input->post('id_publicacion'))));

            if (isset($datos['codigo']) && $datos['codigo'] != "" and isset($datos['id_publicacion']) && $datos['id_publicacion'] != "") {
                //actualizacion registro existente
                $res = $this->Madministrador->modificarPublicacion($datos);
                if ($res) {
                    $this->session->set_flashdata('mensajecompletado', 'Operación Exitosa');
                    redirect('Cadministrador/publicaciones/' . $control['seccion_publicacion']);
                } else {
                    //mando a la vista de error
                    $this->session->set_flashdata('mensaje2', 'Error no se pudo actualizar la publicacion');
                    redirect('Cadministrador/publicaciones/' . $control['seccion_publicacion']);
                }
            }
        }
    }

    public function getModelo()
    {
        $data = array(
            'id_marca' => $this->input->post('id_marca'),
        );

        $modelo = $this->Madministrador->getModelo($data);

        if ($modelo) {
            $html1 = '<option value="">Modelo</option>';
            for ($i = 0; $i < count($modelo, 0); $i++) {
                $html1 .= "<option value=" . $modelo[$i]->id_modelo . ">" . $modelo[$i]->modelo . "</option>";
            }
        } else {
            $html1 = '<option value="">Sin resultado</option>';
        }
        $respuesta2 = array("htmloption2" => $html1);
        echo json_encode($respuesta2);
    }


    public function Vordenar_fotos()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_publicacion'] = strip_tags(trim($this->uri->segment(2)));
        $datos['codigo'] = strip_tags(trim($this->uri->segment(3)));
        $datos['seccion_publicacion'] = strip_tags(trim($this->uri->segment(4)));


        $datos['porrevisar'] = $this->Madministrador->getCantidadPublicacionPorEstatus(6);
        $datos['activo'] = $this->Madministrador->getCantidadPublicacionPorEstatus(1);
        $datos['verificado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(11);
        $datos['rechazado'] = $this->Madministrador->getCantidadPublicacionPorEstatus(10);

        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPublicacionCodigo1($datos);
        $datos['estados'] = $resultado2;
        $datos['publicacion'] = $resultado3;

        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/Vordenar_fotos', $datos);
        $this->load->view('adm/Vfooter');
    }

    public function ordenarFotos()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['url_uno'] = $this->input->post('orden1');
        $datos['url_dos'] = $this->input->post('orden2');
        $datos['url_tres'] = $this->input->post('orden3');
        $datos['url_cuatro'] = $this->input->post('orden4');
        $datos['url_cinco'] = $this->input->post('orden5');
        $datos['url_seis'] = $this->input->post('orden6');
        $datos['id_publicacion'] = $this->input->post('id_publicacion');
        $datos['codigo'] = $this->input->post('codigo');

        $res = $this->Madministrador->ordenarFotos($datos);

        if ($res) {
            $this->session->set_flashdata('mensajecompletado', 'Operación Exitosa');
        } else {
            $this->session->set_flashdata('mensaje2', 'Ocurrio un error');
        }
        echo json_encode(['result' => $res, 'msg' => 'Exito', 'data' => $res]);
    }


    public function VaccionesComentarioAdm()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_pago_estatus'] = $this->input->post('id_pago_estatus'); //para controlar la vista
        $datos['accion'] = base64_encode($this->input->post('accion'));
        $datos['id_publicacion'] = $this->input->post('id_publicacion');
        $datos['id_pago'] = $this->input->post('id_pago');
        $datos['ultimo_comentario'] = $this->input->post('ultimo_comentario');

        $resultado = $this->Mpublicacion->getPublicacionPorId($datos['id_publicacion']);
        if ($resultado) {

            $resultado2 = $this->Madministrador->getCantidadPagoPorEstatus();

            $datos['porVerificar'] = $resultado2[0];
            $datos['verificando'] = $resultado2[1];
            $datos['consolidado'] = $resultado2[2];
            $datos['anulado'] = $resultado2[3];

            $datos['publicacion'] = $resultado;
            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/VaccionesPago', $datos);
            $this->load->view('adm/Vfooter');
        }
    }


    public function ingresarUsuario()
    {

        //validaciones
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[50]|strip_tags|required');
        $this->form_validation->set_rules('clave', 'Clave', 'trim|max_length[16]|strip_tags|required');
        //validaciones
        //delimitadores de errores
        //$this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //delimitadores de errores
        //reglas de validación
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');
        $this->form_validation->set_message('valid_email', 'El campo %s no posee un email válido');
        //reglas de validación


        if ($this->form_validation->run() === FALSE) {
            //$datos['mensaje'] = "Inicio de Sesión incorrecto";

            //$this->load->view('adm/Vlogin',$datos);
            $mensaje_error = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje_error);
            redirect('admbienfino');
        } else {
            $datos['usuario'] = $this->security->xss_clean(trim(strtolower($this->input->post('email'))));
            //encriptamos clave codeigniter

            //$datos['clave'] = password_hash($this->input->post('clave'),PASSWORD_DEFAULT);

            $datos['clave'] = $this->security->xss_clean(trim($this->input->post('clave')));
            //var_dump($datos['clave']);exit();

            $resultado = $this->Madministrador->ingresarUsuario($datos);

            if ($resultado) {
                //verificar que el usuario este verificado para poder realizar el ingreso              
                //$clave = $resultado->clave;

                if (password_verify($datos['clave'], $resultado->clave) and ($datos['usuario'] == $resultado->usuario)) {

                    //otra forma de crear sesiones sin array
                    //$this->session->userdata('s_idUsuario', $r->id_usuario);
                    //sesion que se borra con actualizar la pagina
                    //$this->session->set_flashdata('dsdsd');

                    $a_usuario = array(
                        'id_adm' => $resultado->id_adm,
                        'usuario' => $resultado->usuario,
                        'id_perfil' => $resultado->id_perfil,
                        'nombre_perfil' => $resultado->nombre_perfil
                    );

                    $this->session->set_userdata($a_usuario);

                    redirect('Cadministrador');
                } else {
                    //mando a la vista de error
                    //$datos['mensaje'] = "Usuario o Clave incorrectas";
                    //$this->load->view('adm/Vlogin',$datos);
                    $this->session->set_flashdata('mensaje', "Usuario o Clave incorrectas");
                    redirect('admbienfino');
                }
            } else {
                //$datos['mensaje'] = "Credenciales incorrectas";
                //$this->load->view('adm/Vlogin',$datos);
                $this->session->set_flashdata('mensaje', "Usuario incorrecto o desactivado");
                redirect('admbienfino');
            }
        }
    }

    public function Vmarcasmodelos()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
        $datos['activo'] = 1;
        $marcas_activo = $this->Madministrador->getMarcas($datos);

        $datos['activo'] = 0;
        $marcas_inactivo = $this->Madministrador->getMarcas($datos);

        $datos['activo'] = 1;
        $modelo_activo = $this->Madministrador->getModelos($datos);

        $datos['activo'] = 0;
        $modelo_inactivo = $this->Madministrador->getModelos($datos);

        $datos['marcas_activo'] = $marcas_activo;
        $datos['marcas_inactivo'] = $marcas_inactivo;
        $datos['modelo_activo'] = $modelo_activo;
        $datos['modelo_inactivo'] = $modelo_inactivo;

        $this->load->view('adm/Vheader', $datos);
        $this->load->view('adm/Vmarcasmodelos', $datos);
        $this->load->view('adm/Vfooter');
    }

    public function crearmarcaadm()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $this->form_validation->set_rules('marca', 'Marca', 'trim|required|strip_tags');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');

        if ($this->form_validation->run() === FALSE) {

            $mensaje_error = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje_error);
            redirect('Cadministrador/Vmarcasmodelos');
        } else {


            $data['marca'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('marca'))))));
            $data['slug'] = $data['marca'];
            $data['activo'] = 1;

            $res2 = $this->Mpublicacion->VerificarMarcas($data);

            if ($res2) {
                $this->session->set_flashdata('mensaje2', 'Ya existe la Marca ' . $data['marca'] . ' intenta de nuevo');
                redirect('Cadministrador/Vmarcasmodelos');
            }
            $res = $this->Mpublicacion->insertMarcasAdm($data);
            if ($res) {
                $this->session->set_flashdata('mensaje', 'Operación Exitosa! Se creo la marca Correctamente');
                redirect('Cadministrador/Vmarcasmodelos');
            } else {
                $this->session->set_flashdata('mensaje2', 'Ocurrio un error al insertar la marca');
                redirect('Cadministrador/Vmarcasmodelos');
            }
        }
    }

    public function crearmodeloadm()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $this->form_validation->set_rules('id_marca', 'Marca', 'trim|required|strip_tags');
        $this->form_validation->set_rules('modelo', 'Modelo', 'trim|required|strip_tags');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');

        if ($this->form_validation->run() === FALSE) {

            $mensaje_error = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje_error);
            redirect('Cadministrador/Vmarcasmodelos');
        } else {

            $data['id_marca'] = $this->input->post('id_marca');
            $data['modelo'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('modelo'))))));
            $data['slug'] = $data['modelo'];
            $data['activo'] = 1;
            $data['id_usuario'] = NULL;

            $res2 = $this->Mpublicacion->VerificarModelo($data);

            if ($res2) {
                $this->session->set_flashdata('mensaje2', 'Ya existe el Modelo asociado a la marca, intenta de nuevo');
                redirect('Cadministrador/Vmarcasmodelos');
            }
            $res = $this->Mpublicacion->insertModelos($data);
            if ($res) {
                $this->session->set_flashdata('mensaje', 'Operación Exitosa! Se creo la marca Correctamente');
                redirect('Cadministrador/Vmarcasmodelos');
            } else {
                $this->session->set_flashdata('mensaje2', 'Ocurrio un error al insertar la marca');
                redirect('Cadministrador/Vmarcasmodelos');
            }
        }

    }



    public function generarCodigo($longitud)
    {

        $key = '';
        $pattern = 'B08D08FA975390232334A4DA03B';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i++)
            $key .= $pattern[mt_rand(0, $max)];
        return $key;
    }

    public function alpha_dash_space($str)
    {
        return (!preg_match("/^([-a-z_ñÑ ])+$/i", $str)) ? FALSE : TRUE;
    }


    public function email_check($email)
    {
        $email = mb_strtolower($email);
        $resultado = $this->Musuarios->verificarEmail($email);
        if ($resultado) {
            $this->form_validation->set_message('email_check', 'El email ' . $email . ' ya se encuentra registrado');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function email_check_adm($usuario)
    {
        $usuario = mb_strtolower($usuario);
        $resultado = $this->Madministrador->verificarEmailAdm($usuario);
        if ($resultado) {
            $this->form_validation->set_message('email_check_adm', 'El email ' . $usuario . ' ya se encuentra registrado');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function telfmovil($str)
    {
        return (!preg_match("/^[0][4|2][0-9]{9}$/i", $str)) ? FALSE : TRUE;
    }

    public function cerrar_session()
    {

        $this->session->unset_userdata('id_adm');
        $this->session->unset_userdata('usuario');
        $this->session->unset_userdata('id_perfil');

        redirect('admbienfino');
    }
    /*Administrador*/

    public function VlistarUsuarioAdm()
    {

        $resultado = $this->Madministrador->listarUsuarioAdm(null);

        if ($resultado) {
            $datos['usuarios'] = $resultado;
            $this->load->view('adm/Vheader', $datos);
            $this->load->view('adm/administrador/VlistarUsuarioAdm', $datos);
            $this->load->view('adm/Vfooter');
        }
    }

    public function VcrearUsuarioAdm()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $resultado2 = $this->Madministrador->getPerfilesAdm();
        $datos['perfiles'] = $resultado2;


        $this->load->view('adm/Vheader');
        $this->load->view('adm/administrador/VcrearUsuarioAdm', $datos);
        $this->load->view('adm/Vfooter');
    }

    public function crearUsuarioAdm()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        //validaciones
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|numeric|min_length[7]|max_length[8]|strip_tags');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]|max_length[60]|strip_tags|callback_alpha_dash_space');
        $this->form_validation->set_rules('apellidos', 'Apellidos|callback_alpha_dash_space', 'trim|required|min_length[3]|max_length[60]|strip_tags');
        $this->form_validation->set_rules('usuario', 'Email', 'trim|valid_email|required|callback_email_check_adm|strip_tags');
        $this->form_validation->set_rules('rusuario', 'Repetir Email', 'trim|valid_email|required|matches[usuario]|strip_tags');
        $this->form_validation->set_rules('id_perfil', 'Perfil', 'required|numeric');
        $this->form_validation->set_rules('clave', 'Clave', 'trim|required|min_length[6]|max_length[16]|strip_tags');
        $this->form_validation->set_rules('rclave', 'Repetir Clave', 'matches[clave]|required');

        $this->form_validation->set_message('alpha_dash_space', 'Solo se permite letras en %s');
        $this->form_validation->set_error_delimiters('<p class="#000">', '</p>');
        //validaciones

        if ($this->form_validation->run() === FALSE) {

            $mensaje = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje);

            $resultado2 = $this->Madministrador->getPerfilesAdm();
            $datos['perfiles'] = $resultado2;

            $this->load->view('adm/Vheader');
            $this->load->view('adm/administrador/VcrearUsuarioAdm', $datos);
            $this->load->view('adm/Vfooter');
        } else {

            $datos['cedula'] = $this->input->post('cedula');
            $datos['nombres'] = mb_strtolower($this->input->post('nombres'));
            $datos['apellidos'] = mb_strtolower($this->input->post('apellidos'));
            $datos['usuario'] = mb_strtolower($this->input->post('usuario'));
            $datos['clave'] = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
            $datos['id_perfil'] = $this->input->post('id_perfil');
            $datos['activo'] = 1;
            $datos['creado_id_adm']  = $this->session->userdata('id_adm');

            if ($this->Madministrador->crearUsuarioAdm($datos)) {

                $datos['asunto'] = "Usuario Administrador Creado exitosamente";
                $datos['titulo'] = "Administrador BienFino";
                $datos['mensaje'] = "¡Felicitaciones! Sus datos han sido ingresados exitosamente en nuestro sistema.";
                $datos['usuario'] = $datos['usuario'];
                $datos['clave'] = $this->input->post('clave');
                $datos['nombres'] = $datos['nombres'];
                $datos['apellidos'] = $datos['apellidos'];
                $datos['cedula'] = $datos['cedula'];

                @$this->send_email($datos);

                $this->session->set_flashdata('mensajecompletado', 'Usuario registrado correctamente');
                redirect('VcrearUsuarioAdm');
            } else {
                $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
                //mando a la vista de error
                redirect('VcrearUsuarioAdm');
            }
        }
    }

    public function eliminarUsuarioAdm()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_adm'] = strip_tags(trim($this->uri->segment(2)));


        if (!ctype_digit($datos['id_adm'])) {
            echo "id usuario incorrecto";
            exit;
        }

        if ($this->Madministrador->eliminarUsuarioAdm($datos)) {

            $this->session->set_flashdata('mensajecompletado', 'Operación Exitosa');
            redirect('VlistarUsuarioAdm');
        } else {
            $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
            //mando a la vista de error
            redirect('VlistarUsuarioAdm');
        }
    }

    public function activarUsuarioAdm()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_adm'] = strip_tags(trim($this->uri->segment(2)));


        if (!ctype_digit($datos['id_adm'])) {
            echo "id usuario incorrecto";
            exit;
        }

        if ($this->Madministrador->activarUsuarioAdm($datos)) {

            $this->session->set_flashdata('mensajecompletado', 'Operación Exitosa');
            redirect('VlistarUsuarioAdm');
        } else {
            $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
            //mando a la vista de error
            redirect('VlistarUsuarioAdm');
        }
    }


    public function VactualizarUsuarioAdm()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_adm'] = strip_tags(trim($this->uri->segment(2)));

        if (!ctype_digit($datos['id_adm'])) {
            echo "id usuario incorrecto";
            exit;
        }

        $resultado = $this->Madministrador->listarUsuarioAdm($datos);
        $resultado2 = $this->Madministrador->getPerfilesAdm();

        $datos['usuario'] = $resultado;
        $datos['perfiles'] = $resultado2;

        $this->load->view('adm/Vheader');
        $this->load->view('adm/administrador/VactualizarUsuarioAdm', $datos);
        $this->load->view('adm/Vfooter');
    }
    public function actualizarUsuarioAdm()
    {

        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        //validaciones
        $this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|numeric|min_length[7]|max_length[8]|strip_tags');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]|max_length[60]|strip_tags|callback_alpha_dash_space');
        $this->form_validation->set_rules('apellidos', 'Apellidos|callback_alpha_dash_space', 'trim|required|min_length[3]|max_length[60]|strip_tags');
        $this->form_validation->set_rules('id_perfil', 'Perfil', 'required|numeric');
        $this->form_validation->set_rules('id_adm', 'id_adm', 'required|numeric');

        $this->form_validation->set_message('alpha_dash_space', 'Solo se permite letras en %s');
        $this->form_validation->set_error_delimiters('<p class="#000">', '</p>');
        //validaciones

        if ($this->form_validation->run() === FALSE) {

            $mensaje = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje);

            $datos['id_adm'] = strip_tags(trim($this->uri->segment(2)));

            if (!ctype_digit($datos['id_adm'])) {
                echo "id usuario incorrecto";
                exit;
            }

            $resultado = $this->Madministrador->listarUsuarioAdm($datos);
            $resultado2 = $this->Madministrador->getPerfilesAdm();

            $datos['usuario'] = $resultado;
            $datos['perfiles'] = $resultado2;

            $this->load->view('adm/Vheader');
            $this->load->view('adm/administrador/VactualizarUsuarioAdm', $datos);
            $this->load->view('adm/Vfooter');
        } else {

            $datos['cedula'] = $this->input->post('cedula');
            $datos['nombres'] = mb_strtolower($this->input->post('nombres'));
            $datos['apellidos'] = mb_strtolower($this->input->post('apellidos'));
            $datos['id_perfil'] = $this->input->post('id_perfil');
            $datos['id_adm'] = $this->input->post('id_adm');

            if ($this->Madministrador->actualizarUsuarioAdm($datos)) {

                $this->session->set_flashdata('mensajecompletado', 'Usuario registrado correctamente');
                redirect('VlistarUsuarioAdm');
            } else {
                $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
                //mando a la vista de error
                redirect('VlistarUsuarioAdm');
            }
        }
    }

    public function VcambiarClaveUsuarioAdm()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_adm'] = strip_tags(trim($this->uri->segment(2)));

        if (!ctype_digit($datos['id_adm'])) {
            echo "id usuario incorrecto";
            exit;
        }
        $resultado = $this->Madministrador->listarUsuarioAdm($datos);
        $datos['usuario'] = $resultado;

        $this->load->view('adm/Vheader');
        $this->load->view('adm/administrador/VcambiarClaveUsuarioAdm', $datos);
        $this->load->view('adm/Vfooter');
    }

    public function cambiarClaveUsuarioAdm()
    {
        if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

        $datos['id_adm'] = strip_tags(trim($this->uri->segment(2)));
        if (!ctype_digit($datos['id_adm'])) {
            echo "id usuario incorrecto";
            exit; //valida que es numero entero
        }

        $this->form_validation->set_rules('clave', 'Clave', 'trim|required|min_length[6]|max_length[16]|strip_tags');
        $this->form_validation->set_rules('rclave', 'Repetir Clave', 'matches[clave]|required');

        $this->form_validation->set_error_delimiters('<p class="#000">', '</p>');

        $this->form_validation->set_message('alpha_dash_space', 'Solo se permite letras en %s');
        $this->form_validation->set_message('telfmovil', 'Ingresa un formato correcto %s');


        if ($this->form_validation->run() === FALSE) {

            $mensaje = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje);

            $datos['id_adm'] = strip_tags(trim($this->uri->segment(2)));

            if (!ctype_digit($datos['id_adm'])) {
                echo "id usuario incorrecto";
                exit;
            }

            $resultado = $this->Madministrador->listarUsuarioAdm($datos);
            $datos['usuario'] = $resultado;

            $this->load->view('adm/Vheader');
            $this->load->view('adm/administrador/VcambiarClaveUsuarioAdm', $datos);
            $this->load->view('adm/Vfooter');
        } else {

            $datos['clave'] = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);

            if ($this->Madministrador->cambiarcontrasenaAdm($datos)) {

                $this->session->set_flashdata('mensajecompletado', 'Contraseña cambiada correctamente');
                redirect('VlistarUsuarioAdm');
            } else {
                $this->session->set_flashdata('mensaje', 'Ocurrio un error intente de nuevo');
                //mando a la vista de error
                redirect('VlistarUsuarioAdm');
            }
        }
    }


    /*Administrador*/

    public function quitar_tildes($cadena)
    {

        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
        $texto = str_replace($no_permitidas, $permitidas, $cadena);
        return $texto;
    }

}
