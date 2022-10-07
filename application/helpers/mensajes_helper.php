<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('mensajes'))
{
    
    function mensajeMisPublicaciones()
    {
    	$t = "Estimado usuario, debe Iniciar Sesión para realizar su operación";
        return $t;
    }    
    function mensajePublicar()
    {
    	$t = "Estimado usuario, debe Iniciar Sesión para realizar su operación";
        return $t;
    }
    function tituloRegistrateIngresa()
    {
    	$t = "Ingresa en nuestro sistema";
        return $t;
    }
    function mensajeRegistrateIngresa()
    {
    	$m = "Estimado usuario para continuar presione el Boton";
        return $m;
    }

    function tituloCompletaTusDatos()
    {
    	$t = "Completa tus datos";
        return $t;
    }
    function mensajeCompletaTusDatos()
    {
    	$m = "Estimado usuario debe completar sus datos para tener acceso a esta funcionalidad";
        return $m;
    }
}