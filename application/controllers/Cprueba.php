<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cprueba extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mprueba');
        $this->load->model('Mpublicacion');
        $this->load->model('Mgeo');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        //$this->output->enable_profiler(TRUE);
    }


    public function datosHeaderMenu() {
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


    public function Vasociar(){

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }

        $this->load->view('layouts/Vheader',$datos);
        $this->load->view('publicacion/Vasociar');
    }

    public function asociar(){

        $this->form_validation->set_rules('movil', 'Movil','trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');
        $this->form_validation->set_rules('placa', 'Placa', 'trim|required|strip_tags|callback_placa_check');

        if ($this->form_validation->run() === FALSE) {

            $datos['mensaje'] = "Formulario incorrecto";
            $datos = $this->datosHeaderMenu();
            if ($datos) {
                $this->load->view('layouts/Vheader',$datos);
                $this->load->view('publicacion/Vasociar',$datos);
            }
        }else{

            $datos['placa'] = mb_strtolower($this->input->post('placa'));
            $datos['movil'] = $this->input->post('movil');

            $resultado = $this->Mpublicacion->getPublicacionPlacaTelefono($datos);

            if($resultado){
                echo "Vista previa publicación";
            }else{
                echo "Devuelve vista indicando que los datos no coinciden que intente de nuevo";
            }
        }

    }

    public function VasociarConfirmar(){

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        $this->load->view('layouts/Vheader',$datos);
        $this->load->view('publicacion/VasociarConfirmar');
    }

    public function VasociarExito(){

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        $this->load->view('layouts/Vheader',$datos);
        $this->load->view('publicacion/VasociarExito');

    }

    public function Vcuentas() {

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }

        $this->load->view('pago/Vcuentas',$datos);
    }

    public function verificar() {

        $this->load->view('layouts/Vheader');
        $this->load->view('usuarios/Vverificar');
        //$this->load->view('usuarios/Vfooter');
    }


    public function verpublicacion() {

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }

        //$this->load->view('usuarios/Vheader');
        $this->load->view('publicacion/VverPublicacion2',$datos);
    }



    public function busqueda() {

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        //$this->load->view('layouts/Vheader',$datos);
        $this->load->view('publicacion/Vvistaprevia');
    }

    public function login() {
        $this->load->view('usuarios/Vheader');
        $this->load->view('usuarios/Vlogin');
        $this->load->view('usuarios/Vfooter');
    }

    public function base(){

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        $this->load->view('layouts/Vheader',$datos);
        $this->load->view('layouts/Vbase');
        $this->load->view('layouts/Vfooter');
    }

    public function prueba(){

    echo date('dmy');
    }

    public function busquedaMenu(){
        $buscar = "";
        
        $this->session->unset_userdata('categoria_menu');
        $this->session->unset_userdata('marca_menu');
        $this->session->unset_userdata('modelo_menu');
        $this->session->unset_userdata('ano_menu');
        $this->session->unset_userdata('ubicacion_menu');

        if ($this->input->post('categoria_menu')!="") {
            $this->session->set_userdata('categoria_menu', $this->input->post('categoria_menu'));
        }
        if ($this->input->post('marca_menu')!="") {
            $this->session->set_userdata('marca_menu', $this->input->post('marca_menu'));
        }
        if ($this->input->post('modelo_menu')!="") {
            $this->session->set_userdata('modelo_menu', $this->input->post('modelo_menu'));
        }
        if ($this->input->post('ano_menu')!="") {
            $this->session->set_userdata('ano_menu', $this->input->post('ano_menu'));
        }
        if ($this->input->post('ubicacion_menu')!="") {
            $this->session->set_userdata('ubicacion_menu', $this->input->post('ubicacion_menu'));
        }

        if ($this->input->post('buscar_palabra')) {
            $buscar = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->input->post('buscar_palabra')))));
            /*$this->session->unset_userdata('categoria_menu');
            $this->session->unset_userdata('marca_menu');
            $this->session->unset_userdata('modelo_menu');
            $this->session->unset_userdata('ano_menu');
            $this->session->unset_userdata('ubicacion_menu');*/
        }

        $this->session->set_userdata("buscar_palabra",$buscar);
        redirect("buscar");
    }

    public function buscar($nropagina = FALSE){
        /*
            $this->session->unset_userdata('categoria_menu');
            $this->session->unset_userdata('marca_menu');
            $this->session->unset_userdata('modelo_menu');
            $this->session->unset_userdata('ano_menu');
            $this->session->unset_userdata('ubicacion_menu');
        */
            $arrayBuscar = array();

            if ($this->session->userdata("buscar_palabra")) {
                $cadena = $this->session->userdata("buscar_palabra");
                $arrayBuscar = explode(" ", $cadena);
            }

            $inicio = 0;
            $mostrarpor = 2;
            if ($nropagina) {
                $inicio = ($nropagina - 1) * $mostrarpor;
            }

            $resultado = $this->Mprueba->buscar($arrayBuscar);
     

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
            $resultado = $this->Mprueba->buscar($arrayBuscar, $inicio, $mostrarpor);

            if ($resultado) {
                //$resultado3 = $this->Mgeo->getEstados();               
                $datos['busqueda'] = $resultado;
                //$datos['estados'] = $resultado3;

                $this->load->view('publicacion/Vbusqueda',$datos);
                $this->load->view('usuarios/Vfooter');         
            }else{

                $datos['mensaje'] = "Disculpe no se encontraron resultados, intente de nuevo";

                $this->load->view('publicacion/Vbusqueda',$datos);
                $this->load->view('usuarios/Vfooter');         
            }
            
        }
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
    }
