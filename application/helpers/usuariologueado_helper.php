<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('usuariologueado'))
{

    function comprobarUsuarioLogueado($ruta){
        $ci =& get_instance();
        
        if (!$ci->session->userdata('id_usuario') && $ruta =='publicar') {

            $ci->session->set_flashdata('mensajePublicar', mensajePublicar());
            //$ci->session->set_flashdata('tituloRegistrateIngresa', tituloRegistrateIngresa());
            redirect('ingresar/p');

        }else if (!$ci->session->userdata('id_usuario') && $ruta =='mispublicaciones') {
            
            $ci->session->set_flashdata('mensajePublicar', mensajeMisPublicaciones());
            //$ci->session->set_flashdata('tituloRegistrateIngresa', tituloRegistrateIngresa());
            redirect('ingresar/m');

        }else if (!$ci->session->userdata('id_usuario')) {
            $ci->session->set_flashdata('mensajeRegistrateIngresa', mensajeRegistrateIngresa());
            $ci->session->set_flashdata('tituloRegistrateIngresa', tituloRegistrateIngresa());

            redirect();

        }elseif($ci->session->userdata('completar')==0){
            $ci->session->set_flashdata('mensaje', mensajeCompletaTusDatos());
            $ci->session->set_flashdata('tituloCompletaTusDatos', tituloCompletaTusDatos());
            redirect('completarregistro');
        }
    }
}