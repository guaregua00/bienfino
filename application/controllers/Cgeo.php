<?php

/**
 *
 */
class Cgeo extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mgeo');
    }

    public function getMunicipios() {
        $data = array(
            'codigoestado' => $this->input->post('codigoestado'),
        );

        $municipios = $this->Mgeo->getMunicipios($data);

        $html1 = '<option value="">Seleccione un municipio</option>';
        for ($i = 0; $i < count($municipios, 0); $i++) {
            $html1 .= "<option value=" . $municipios[$i]->codigomunicipio . ">" . ucwords(mb_strtolower($municipios[$i]->nombre)) . "</option>";
        }
        $respuesta1 = array("htmloption1" => $html1);
        echo json_encode($respuesta1);
    }

    public function getMunicipios2() {
        $data = array(
            'codigoestado' => $this->input->post('codigoestado'),
        );

        $municipios = $this->Mgeo->getMunicipios2($data);

        $html1 = '<option value="">Seleccione un municipio</option>';
        for ($i = 0; $i < count($municipios, 0); $i++) {
            $html1 .= "<option value=" . $municipios[$i]->codigomunicipio . ">" . ucwords(mb_strtolower($municipios[$i]->nombre)) . "</option>";
        }
        $respuesta1 = array("htmloption1" => $html1);
        echo json_encode($respuesta1);
    }
    public function getParroquias() {
        $data = array(
            'codigoestado' => $this->input->post('codigoestado'),
            'codigomunicipio' => $this->input->post('codigomunicipio'),
        );

        $parroquias = $this->Mgeo->getParroquias($data);

        $html2 = '<option value="">Seleccione una parroquia</option>';
        for ($i = 0; $i < count($parroquias, 0); $i++) {
            $html2 .= "<option value=" . $parroquias[$i]->codigoparroquia . ">" . ucwords(mb_strtolower($parroquias[$i]->nombre)) . "</option>";
        }
        $respuesta2 = array("htmloption2" => $html2);
        echo json_encode($respuesta2);
    }

}

?>