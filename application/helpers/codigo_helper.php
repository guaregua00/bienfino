<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('cogido_publicacion'))
{
    function codigo_publicacion()
    {


    	return uniqid();


    	/*
        //para poder usar la base de datos en el helper debemos instanciar al core de codeigniter 
        $CI= & get_instance(); 
        //al ser instanciado es el equivalente a $this que se tiene en control
        //el siguiente proceso facil de entender igual no va al caso
        if ($CI->db->get("pedidos")->num_rows()>0)
        {
            $num=$CI->db->order_by("id","desc")->get("pedidos")->row_array();
            $num= (int) $num["codigo"];
            return str_pad($num+1, 8, "0", STR_PAD_LEFT);
 
        }
        else 
        {
            return str_pad(1, 10, "0", STR_PAD_LEFT);
        }
        */
    }
}
