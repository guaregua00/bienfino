<?php
/**
* 
*/
class Mgaraje extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function getPublicionesMiGarajeXusuario(){

			$this->db->select(' distinct(vehiculo.tbl_publicaciones.id_publicacion),
    							vehiculo.tbl_publicaciones.*,
								vehiculo.tbl_marcas.marca, 
								vehiculo.tbl_modelos.modelo, 
								vehiculo.tbl_publicaciones.id_ano, 
								usuario.tbl_usuarios.id_usuario,
								usuario.tbl_usuarios.cedula,
								usuario.tbl_usuarios.nombres,
								usuario.tbl_usuarios.apellidos,
								ubicacion.tbl_estado.nombre AS estado, 
								ubicacion.tbl_municipio.nombre AS municipio, 
								ubicacion.tbl_parroquia.nombre AS parroquia								
								');	
    		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo ');
    		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca');
    		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria ');
    		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2 ');
			$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado');
			$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio');
			$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia');    		
    		$this->db->where_in("id_publicacion", "SELECT id_publicacion FROM vehiculo.tbl_garajes WHERE id_usuario2 = '".$this->session->userdata('id_usuario')."'",false);
            $resultado = $this->db->get('vehiculo.tbl_publicaciones');

            if ($resultado->num_rows() > 0) 
                return $resultado->result();
            else
                return false;		
	}

	public function getPublicionMiGarajeXidPublicacion($id_publicacion){


    		$this->db->where("id_publicacion", $id_publicacion);
    		$this->db->where("id_usuario2", $this->session->userdata('id_usuario'));
            $resultado = $this->db->get('vehiculo.tbl_garajes');

            if ($resultado->num_rows() > 0)
                return $resultado->result();
            else
                return false;		
	}	

	public function eliminarPublicacionIdPublicacion($id_publicacion){

		$this->db->trans_begin();

		$this->db->where('id_publicacion',$id_publicacion);
		$this->db->where('id_usuario2',$this->session->userdata('id_usuario'));
		$resultado = $this->db->delete('vehiculo.tbl_garajes');

		if (!$this->db->affected_rows()>0) {
			$this->db->trans_rollback();
	        return FALSE;
		}

		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return FALSE;
		}
		else
		{
		        $this->db->trans_commit();
		        return TRUE;
		}	
	}

	public function agregarMiGaraje($id_publicacion){
		$datos['id_publicacion'] = $id_publicacion;
		$datos['id_usuario2'] = $this->session->userdata('id_usuario');

		$this->db->trans_begin();

		$this->db->insert('vehiculo.tbl_garajes',$datos);

		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
		        return FALSE;
		}
		else
		{
				$this->db->trans_commit();
		        return TRUE;
		}	

	}


	public function eliminarMiGaraje($id_publicacion){
		$datos['id_publicacion'] = $id_publicacion;
		$datos['id_usuario2'] = $this->session->userdata('id_usuario');

		$this->db->trans_begin();

		$this->db->delete('vehiculo.tbl_garajes',$datos);

		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
		        return FALSE;
		}
		else
		{
				$this->db->trans_commit();
		        return TRUE;
		}	

	}

	public function verificarVehiculoMiGaraje($id_publicacion){

		$this->db->where('id_publicacion',$id_publicacion);
		$this->db->where('id_usuario2',$this->session->userdata('id_usuario'));
		$resultado = $this->db->get('vehiculo.tbl_garajes');

            if ($resultado->num_rows() > 0) 
                return TRUE;
            else
                return FALSE;
				
	}	

}
