<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cpago extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Musuarios');
        $this->load->model('Mgeo');
        $this->load->model('Mpago');
        $this->load->model('Mpublicacion');
        $this->load->library('form_validation');
        //$this->load->library('encrypt');
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

    public function Vcuentas() {


            //$this->load->view('layouts/Vheader',$datos);
            //$this->load->view('pago/Vcuentas');
            $this->load->view('layouts/headerI');
            $this->load->view('pago/cuentas');
        

    }

    public function Vinicio() {

        if ($this->session->userdata('completar')==0) {
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect('Cusuarios/login');
        }

        $id_publicacion = $this->input->post('id_publicacion');

        if ($id_publicacion AND is_numeric($id_publicacion)) {

            $publicacion = $this->Mpublicacion->getPublicacionPorId($id_publicacion);


            $bancoOri = $this->Mpago->getBancoOrigen();
            $bancoDes = $this->Mpago->getBancoDestino();
            $tipoPago = $this->Mpago->getTipoPago();

            $datos = $this->datosHeaderMenu();
            if ($publicacion AND $bancoOri AND $bancoDes AND $tipoPago) {

                $datos['publicacion'] = $publicacion;
                $datos['bancoOri'] = $bancoOri;
                $datos['bancoDes'] = $bancoDes;
                $datos['tipoPago'] = $tipoPago;

        
                if ($datos) {
                        $this->load->view('layouts/Vheader',$datos);
                        $this->load->view('pago/VpagoPublicacion',$datos);
                        //$this->load->view('usuarios/Vfooter');
                }
            }

        }else{
            redirect('misPublicacionesExito');
        }

    }


    public function eliminarReportePago(){

        if ($this->session->userdata('completar')==0) {
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect('Cusuarios/login');
        }
        
        $id_publicacion = $this->input->post('id_publicacion');
        $resultado = $this->Mpago->eliminarReportePago($id_publicacion);

        if ($resultado) {
           $this->session->set_flashdata('mensaje2', 'El reporte se ha eliminado correctamente');
           redirect('Cpublicacion/misPublicacionesExito');
        }
    }


    public function verReportePago(){

        if ($this->session->userdata('completar')==0) {
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect('Cusuarios/login');
        }

        if ($this->input->post('id_publicacion')) {
            $id_publicacion = $this->input->post('id_publicacion');

            $resultado = $this->Mpago->getPagoXpublicacion($id_publicacion);
            $datos = $this->datosHeaderMenu();
            $datos['pago'] = $resultado;
            
            $this->load->view('layouts/Vheader',$datos);
            $this->load->view('pago/VreportePago',$datos);
            //$this->load->view('usuarios/Vfooter');  
        }
    }


    public function procesarPago(){

        if ($this->session->userdata('completar')==0) {
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect('Cusuarios/login');
        }

        $this->form_validation->set_rules('id_banco_ori', 'Banco origen', 'required|is_natural');
        $this->form_validation->set_rules('id_banco_des', 'Banco destino', 'required|is_natural');
        $this->form_validation->set_rules('id_tipo_pago', 'Tipo de pago', 'required|is_natural');
        $this->form_validation->set_rules('num_pago', 'Número de referencia o deposito', 'required|integer|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('fecha_operacion', 'Fecha de la operación', 'required');
        $this->form_validation->set_rules('hora_operacion', 'Hora de la operación', 'required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');


        if ($this->form_validation->run() === FALSE) {

            $id_publicacion = $this->input->post('id_publicacion');
            $publicacion = $this->Mpublicacion->getPublicacionPorId($id_publicacion);

            $bancoOri = $this->Mpago->getBancoOrigen();
            $bancoDes = $this->Mpago->getBancoDestino();
            $tipoPago = $this->Mpago->getTipoPago();

            if ($publicacion AND $bancoOri AND $bancoDes AND $tipoPago) {

                $datos['publicacion'] = $publicacion;
                $datos['bancoOri'] = $bancoOri;
                $datos['bancoDes'] = $bancoDes;
                $datos['tipoPago'] = $tipoPago;


                $this->load->view('layouts/Vheader');
                $this->load->view('pago/VpagoPublicacion',$datos);
                //$this->load->view('usuarios/Vfooter');

            }

        } else {
            $datos['id_usuario'] = $this->session->userdata('cedula');
            $datos['id_usuario2'] = $this->session->userdata('id_usuario');
            $datos['id_publicacion'] = $this->input->post('id_publicacion');
            $datos['id_banco_ori'] = $this->input->post('id_banco_ori');
            $datos['id_banco_des'] = $this->input->post('id_banco_des');
            $datos['id_tipo_pago'] = $this->input->post('id_tipo_pago');
            $datos['num_pago'] = $this->input->post('num_pago');
            $datos['fecha_operacion'] = $this->input->post('fecha_operacion');
            $datos['hora_operacion'] = $this->input->post('hora_operacion');
            $datos['id_pago_estatus'] = 1;


            $resultado2 = $this->Mpago->verificarPagoPublicacion($datos);


            if ($resultado2) {

                $resultado = $this->Mpago->procesarPagoUpdate($datos);
                if ($resultado) {
                    redirect('Cpago/VpagoRealizado');
                }else{
                    $this->session->set_flashdata('mensaje', 'Error no se pudo guardar los datos intende de nuevo');
                    redirect('misPublicacionesExito');                    
                }  

                   //$this->session->set_flashdata('mensaje', 'Error la publicacion ya tiene un reporte de pago activo');
                   //redirect('Cpublicacion/misPublicacionesExito');
            }else{

                $resultado = $this->Mpago->procesarPagoInsert($datos);
                if ($resultado) {
                    redirect('Cpago/VpagoRealizado');
                }else{
                    $this->session->set_flashdata('mensaje', 'Error no se pudo guardar los datos intende de nuevo');
                    redirect('misPublicacionesExito'); 
                }                
            }


        }          
    }

    public function VpagoRealizado(){
        if ($this->session->userdata('completar')==0) {
            redirect();
        }elseif(!$this->session->userdata('id_usuario')){
            redirect('Cusuarios/login');
        }

        $this->load->view('layouts/Vheader');
        $this->load->view('pago/VpagoRealizado');
        //$this->load->view('usuarios/Vfooter');
    }

}
