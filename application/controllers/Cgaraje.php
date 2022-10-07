<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cgaraje extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mpublicacion');
        $this->load->model('Mgeo');
        $this->load->library('form_validation');
        //$this->load->library('encrypt');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('Mgaraje');
        //$this->load->helper('codigo');
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


    public function index(){
        
comprobarUsuarioLogueado();

            $datos = $this->datosHeaderMenu();

            if ($this->session->userdata('id_usuario')) {
               $resultado2 = $this->Mgaraje->getPublicionesMiGarajeXusuario();
               $datos['migaraje'] = $resultado2;
            }

            if ($datos) {
                //var_dump($datos);exit();
                $this->load->view('layouts/Vheader',$datos);
                $this->load->view('migaraje/Vmigaraje',$datos);
                //$this->load->view('usuarios/Vfooter');
            } 
  
    }

    public function eliminarPublicacion(){
        if ($this->uri->segment(3)) {
            $id_publicacion = $this->uri->segment(3);
            
            $resultado = $this->Mgaraje->eliminarPublicacionIdPublicacion($id_publicacion);

            if ($resultado) {
               redirect('migaraje');   
            }
        }
        
    }

    public function agregarMiGaraje(){
            if(!$this->session->userdata('id_usuario')){
                $html1 = "Debe Registrarse eh Iniciar Sesión para utilizar esta funcionalidad";
                $respuesta = array("htmloption1" => $html1);
                echo json_encode($respuesta);
            }else{
                $id_publicacion = $this->input->post('id_publicacion');

                $resultado = $this->Mgaraje->verificarVehiculoMiGaraje($id_publicacion);

                if (!$resultado) {

                    $resultado = $this->Mgaraje->agregarMiGaraje($id_publicacion);

                    if ($resultado) {
                        $html1 = "Vehiculo agregado correctamente";
                        $respuesta = array("htmloption2" => $html1);
                        echo json_encode($respuesta);
                    }
                }else{
                    
                    $resultado = $this->Mgaraje->eliminarMiGaraje($id_publicacion);
                    if ($resultado) {
                        $html2 = "Vehiculo removido correctamente";
                        $respuesta = array("htmloption3" => $html2);
                        echo json_encode($respuesta);  
                    }
              
                }                
            }





        
    }

}

