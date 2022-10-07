<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgeo extends CI_Model {


		public function getEstados(){

            $this->db->select('distinct(ubicacion.tbl_estado.codigoestado), ubicacion.tbl_estado.*');
            $this->db->from('ubicacion.tbl_estado');
            $this->db->join('vehiculo.tbl_publicaciones', 'vehiculo.tbl_publicaciones.codigoestado = ubicacion.tbl_estado.codigoestado','right');
            $this->db->order_by('ubicacion.tbl_estado.favorito', 'ASC');
                $query = $this->db->get();

                if ($query->num_rows() > 0) 
                    return $query->result();
                else
                    return false;			
		}
		public function getEstadoId($codigoestado){


            $this->db->from('ubicacion.tbl_estado');
            $this->db->where('ubicacion.tbl_estado.codigoestado',$codigoestado);
            $query = $this->db->get();

                if ($query->num_rows() > 0) 
                    return $query->result();
                else
                    return false;			
		}
        public function getMunicipios($data){

                $codigoestado = $data['codigoestado'];

                $this->db->select('distinct(ubicacion.tbl_municipio.codigomunicipio),ubicacion.tbl_municipio.*');
                $this->db->join('ubicacion.tbl_municipio', 'ubicacion.tbl_municipio.codigomunicipio = vehiculo.tbl_publicaciones.codigomunicipio',"right");
                $this->db->where('ubicacion.tbl_municipio.codigoestado', $codigoestado);
                $this->db->where("vehiculo.tbl_publicaciones.estatus in (1) and vehiculo.tbl_publicaciones.codigoestado = '$codigoestado'", NULL, FALSE);
                //$this->db->order_by('ubicacion.tbl_municipio.codigomunicipio', 'ASC');
                $query = $this->db->get('vehiculo.tbl_publicaciones');
                
                if ($query->num_rows() > 0) 
                    return $query->result();
                else
                    return false;
        }

        public function getMunicipios2($data){

            $codigoestado = $data['codigoestado'];

            $this->db->select('*');
            $this->db->from('ubicacion.tbl_municipio');
            $this->db->order_by('ubicacion.tbl_municipio.codigomunicipio', 'ASC');
            $this->db->where('ubicacion.tbl_municipio.codigoestado', $codigoestado);
            $query = $this->db->get();

            if ($query->num_rows() > 0) 
                return $query->result();
            else
                return false;
    }
        public function getParroquias($data){

                $codigoestado = $data['codigoestado'];
                $codigomunicipio = $data['codigomunicipio'];

                $this->db->select('codigoparroquia, nombre');
                $this->db->from('ubicacion.tbl_parroquia');
                $this->db->order_by('nombre', 'ASC');
                $this->db->where('codigoestado', $codigoestado);
                $this->db->where('codigomunicipio', $codigomunicipio);
                $query = $this->db->get();

                if ($query->num_rows() > 0) 
                    return $query->result();
                else
                    return false;
        }        

}

?>