<?php
/**
* 
*/
class Mprueba extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function buscar($arrayBuscar, $inicio = FALSE, $cantidad = FALSE){

		foreach ($arrayBuscar as $value) {
			$this->db->or_like('busqueda',$value);
		}

		if($this->session->userdata('categoria_menu')){
			$this->db->where('vehiculo.tbl_publicaciones.id_categoria',$this->session->userdata('categoria_menu'));
		}
		if($this->session->userdata('marca_menu')){
			$this->db->where('vehiculo.tbl_publicaciones.id_marca',$this->session->userdata('marca_menu'));
		}
		if($this->session->userdata('modelo_menu')){
			$this->db->where('vehiculo.tbl_publicaciones.id_modelo',$this->session->userdata('modelo_menu'));
		}
		if($this->session->userdata('ano_menu')){
			$this->db->where('id_ano',$this->session->userdata('ano_menu'));
		}					
		if($this->session->userdata('ubicacion_menu	')){
			$this->db->where('codigoestado',$this->session->userdata('ubicacion_menu'));
		}

		if($inicio !== FALSE && $cantidad!== FALSE){
			$this->db->limit($cantidad,$inicio);
		}

    	$resultado = $this->db->select(' distinct(vehiculo.tbl_publicaciones.id_publicacion),
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

		$this->db->order_by('id_publicacion', 'DESC');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo ');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria ');
		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.cedula = tbl_publicaciones.id_usuario ');


		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia');
		$estatus = array(1,5);
		$this->db->where_in('vehiculo.tbl_publicaciones.estatus',$estatus);

		$resultado = $this->db->get('vehiculo.tbl_publicaciones');

		if ($resultado->result() > 0) {
			return $resultado->result();
		}else{
			return FALSE;
		}
	}
}