<?php

/**
 *
 */
class Ccron extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Madministrador');
        $this->load->model('MDirectorio');
    }

    public function desactivarDirectorioPeriodoTiempo() {

        
        $pagosdirectorios = $this->Madministrador->listarPagosDirectorio();

        foreach ($pagosdirectorios as $value) {
            $timestamp1 = strtotime($value->fecha_final);
            $timestamp2 = strtotime("now");

            $segundos_diferencia = $timestamp1 - $timestamp2;
            $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
            $dias_diferencia = abs($dias_diferencia);
            $dias_diferencia = floor($dias_diferencia);
            echo "Dias ".$dias_diferencia;
            $dias_restantes = $dias_diferencia;

            if($dias_restantes<=0){
                $res = $this->Madministrador->desactivarDirectorioPeriodoTiempo($value);
                if($res){
                    echo "Directorio id: ".$res;
                }else{
                    $datos['error'] = "Error al desactivar el directorio id: ".$value->id." por el cron automatico";
                    $this->Madministrador->cron_errores($datos);
                    echo $datos['error'];
                }
            }
            echo "<br>";

        }

        
    }


}

?>