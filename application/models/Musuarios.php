<?php

/**
 * 
 */
class Musuarios extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function reiniciarClave($keypass, $id_usuario)
	{

		$this->db->trans_begin();

		$this->db->limit(1);
		$this->db->where('id_usuario', $id_usuario);
		$this->db->where('keypass', $keypass);
		$resultado = $this->db->get('usuario.tbl_usuarios');

		$resultado = $resultado->result();
		if ($resultado) {
			$data = array(
				'clave' => password_hash($resultado[0]->new_pass, PASSWORD_DEFAULT),
				'id_usuario' => $id_usuario,
				'keypass' => "",
				'new_pass' => ""
			);
			$this->db->where('id_usuario', $id_usuario);
			$this->db->where('keypass', $keypass);
			$this->db->update('usuario.tbl_usuarios', $data);
			$new_pass = $resultado[0]->new_pass;
		} else {
			$this->db->trans_rollback();
			return FALSE;
		}




		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $new_pass;
		}
	}

	public function actualizarDatosContacto($datos)
	{
		$this->db->where('id_usuario2', $_SESSION["id_usuario"]);
		$this->db->update('usuario.tbl_usuarios_vehiculo_telefonos', $datos);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function actualizarDatosUbicacion($datos)
	{

		$this->db->where('id_usuario2', $_SESSION["id_usuario"]);
		$this->db->update('usuario.tbl_usuarios_vehiculo_geo', $datos);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function actualizarDatosPersonales($datos)
	{


		$this->db->where('id_usuario', $_SESSION["id_usuario"]);
		$this->db->update('usuario.tbl_usuarios', $datos);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function consultarJovenEmail($datos)
	{

		$this->db->from('usuario.tbl_usuarios');
		$this->db->where('email', $datos['email']);
		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return $resultado->result();
		} else {
			return FALSE;
		}
	}

	public function agregarKeyPassNewPass($datos)
	{

		$data = array(
			'keypass' => $datos['keypass'],
			'new_pass' => $datos['new_pass']
		);
		$this->db->where('id_usuario', $datos["resultado"][0]->id_usuario);
		$this->db->update('usuario.tbl_usuarios', $data);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function consultarJovenCedulaSession($datos)
	{

		$this->db->from('usuario.tbl_usuarios');
		$this->db->where('id_usuario', $this->session->userdata('id_usuario'));
		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return $resultado->result();
		} else {
			return FALSE;
		}
	}

	public function cambiarPasswordJoven($datos)
	{

		$data = array(
			'clave' => $datos['new_password'],
		);

		$this->db->where('id_usuario', $this->session->userdata('id_usuario'));
		$this->db->update('usuario.tbl_usuarios', $data);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function RegistrarUsuarioCompleto($datos)
	{

		$this->db->trans_begin();

		$datosuno['email'] = $datos['email'];
		$datosuno['clave'] = $datos['clave'];
		$datosuno['verificado'] = $datos['verificado'];
		$datosuno['activo'] = $datos['activo'];
		$datosuno['id_grupo'] = $datos['id_grupo'];
		$datosuno['completar'] = $datos['completar'];
		$datosuno['codigo_verificacion'] = $datos['codigo_verificacion'];
		$datosuno['cedula'] = $datos['cedula'];
		$datosuno['nombres'] = $datos['nombres'];
		$datosuno['apellidos'] = $datos['apellidos'];

		$this->db->insert('usuario.tbl_usuarios', $datosuno);
		$insert_id_usuario = $this->db->insert_id();

		if (!$this->db->affected_rows() > 0 and $insert_id_usuario!= "") {
			$this->db->trans_rollback();
			return FALSE;
		}

		$datosdos['moviluno'] = $datos['moviluno'];
		$datosdos['movildos'] = $datos['movildos'];
		$datosdos['id_usuario2'] = $insert_id_usuario;

		$datostres['codigoestado'] = $datos['codigoestado'];
		$datostres['codigomunicipio'] = $datos['codigomunicipio'];
		$datostres['codigoparroquia'] = $datos['codigoparroquia'];
		$datostres['direccion_esp'] = $datos['direccion_esp'];
		$datostres['id_usuario2'] = $insert_id_usuario;


		$this->db->insert('usuario.tbl_usuarios_vehiculo_telefonos', $datosdos);

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		$this->db->insert('usuario.tbl_usuarios_vehiculo_geo', $datostres);

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		$datoscuatro['marca'] = $datos['marca'];
		$datoscuatro['modelo'] = $datos['modelo'];
		$datoscuatro['ano'] = $datos['id_ano'];
		$datoscuatro['id_usuario'] = $insert_id_usuario;
		//var_dump($datoscuatro);exit;
		//var_dump($datoscuatro);exit;
		$this->db->insert('usuario.tbl_usuarios_vehiculos', $datoscuatro);
		
		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback(); 
			return FALSE;
		}


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $insert_id_usuario;
		}
	}

	public function actualizarUsuario($datos)
	{

		$datosuno['nombres'] = $datos['nombres'];
		$datosuno['apellidos'] = $datos['apellidos'];
		$datosuno['email'] = $datos['email'];
		$datosuno['completar'] = 1;

		$datosdos['coduno'] = $datos['coduno'];
		$datosdos['moviluno'] = $datos['moviluno'];
		$datosdos['coddos'] = $datos['coddos'];
		$datosdos['movildos'] = $datos['movildos'];

		$datostres['codigoestado'] = $datos['codigoestado'];
		$datostres['codigomunicipio'] = $datos['codigomunicipio'];
		$datostres['codigoparroquia'] = $datos['codigoparroquia'];
		$datostres['direccion_esp'] = $datos['direccion_esp'];

		$this->db->trans_begin();

		$this->db->where('id_usuario', $_SESSION["id_usuario"]);
		$this->db->update('usuario.tbl_usuarios', $datosuno);

		$this->db->where('id_usuario2', $_SESSION["id_usuario"]);
		$this->db->update('usuario.tbl_usuarios_vehiculo_telefonos', $datosdos);

		$this->db->where('id_usuario2', $_SESSION["id_usuario"]);
		$this->db->update('usuario.tbl_usuarios_vehiculo_geo', $datostres);

		$this->db->where('id_usuario', $_SESSION["id_usuario"]);
		$resultado = $this->db->get('usuario.tbl_usuarios');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $resultado->row();
		}
	}

	public function getUsuariosCedula()
	{
		$this->db->select('
    						usuario.tbl_usuarios.*,
							usuario.tbl_usuarios_vehiculo_telefonos.*,
							usuario.tbl_usuarios_vehiculo_geo.*,
							ubicacion.tbl_estado.nombre AS estado, 
							ubicacion.tbl_municipio.nombre AS municipio, 
							ubicacion.tbl_parroquia.nombre AS parroquia								
							');
		$this->db->join('usuario.tbl_usuarios_vehiculo_telefonos', 'usuario.tbl_usuarios_vehiculo_telefonos.id_usuario2 = usuario.tbl_usuarios.id_usuario', 'left');
		$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'usuario.tbl_usuarios_vehiculo_geo.id_usuario2 = usuario.tbl_usuarios.id_usuario', 'left');
		$this->db->join('ubicacion.tbl_estado', 'tbl_usuarios_vehiculo_geo.codigoestado = tbl_estado.codigoestado');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_usuarios_vehiculo_geo.codigomunicipio = tbl_municipio.codigomunicipio');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_usuarios_vehiculo_geo.codigoparroquia = tbl_parroquia.codigoparroquia');
		$this->db->where('usuario.tbl_usuarios.id_usuario', $this->session->userdata('id_usuario'));

		$resultado = $this->db->get('usuario.tbl_usuarios');

		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}
	//modificar
	public function getUsuariosCedulaParametro($id_usuario)
	{

		$this->db->select('
			usuario.tbl_usuarios.*,
			usuario.tbl_usuarios_vehiculo_telefonos.*,
			usuario.tbl_usuarios_vehiculo_geo.*,
			ubicacion.tbl_estado.nombre AS estado, 
			ubicacion.tbl_municipio.nombre AS municipio, 
			ubicacion.tbl_parroquia.nombre AS parroquia,
			usuario.tbl_usuarios.id_usuario as id_usuario							
			');
		$this->db->join('usuario.tbl_usuarios_vehiculo_telefonos', 'usuario.tbl_usuarios_vehiculo_telefonos.id_usuario2 = usuario.tbl_usuarios.id_usuario', 'left');
		$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'usuario.tbl_usuarios_vehiculo_geo.id_usuario2 = usuario.tbl_usuarios.id_usuario', 'left');
		$this->db->join('ubicacion.tbl_estado', 'usuario.tbl_usuarios_vehiculo_geo.codigoestado = tbl_estado.codigoestado', 'LEFT');
		$this->db->join('ubicacion.tbl_municipio', 'usuario.tbl_usuarios_vehiculo_geo.codigomunicipio = tbl_municipio.codigomunicipio', 'LEFT');
		$this->db->join('ubicacion.tbl_parroquia', 'usuario.tbl_usuarios_vehiculo_geo.codigoparroquia = tbl_parroquia.codigoparroquia', 'LEFT');
		$this->db->where('usuario.tbl_usuarios.id_usuario', $id_usuario);


		$resultado = $this->db->get('usuario.tbl_usuarios');

		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}


	public function verificarEmail($email)
	{

		$this->db->select('email');
		$this->db->from('usuario.tbl_usuarios');
		$this->db->where('email', $email);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function validarCuenta($datos)
	{


		$data = array(
			'verificado' => 1
		);
		$this->db->where('codigo_verificacion', $datos['codigo']);
		$this->db->where('id_usuario', $datos['id_usuario']);
		$this->db->update('usuario.tbl_usuarios', $data);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getUsuarioCodigoId($datos)
	{

		$this->db->select('*');
		$this->db->from('usuario.tbl_usuarios');
		$this->db->where('codigo_verificacion', $datos['codigo']);
		$this->db->where('id_usuario', $datos['id_usuario']);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}

	public function getUsuarioCodigoIdEmail($datos)
	{

		$this->db->select('*');
		$this->db->from('usuario.tbl_usuarios');
		$this->db->where('codigo_verificacion', $datos['codigo_verificacion']);
		$this->db->where('id_usuario', $datos['id_usuario']);
		$this->db->where('email', $datos['email']);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}

	public function verificarCedula($cedula)
	{

		$this->db->select('cedula');
		$this->db->from('usuario.tbl_usuarios');
		$this->db->where('cedula', $cedula);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	//modificar
	public function registrarUsuario($datos)
	{

		$this->db->trans_begin();

		$this->db->insert('usuario.tbl_usuarios', $datos);
		$insert_id_usuario = $this->db->insert_id();

		//$datosuno['id_usuario'] = $datos['cedula'];
		$datosuno['id_usuario2'] = $insert_id_usuario;

		/* 			$this->db->insert('usuario.tbl_usuarios_vehiculo_geo',$datosuno);
			$this->db->insert('usuario.tbl_usuarios_vehiculo_telefonos',$datosuno); */

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $insert_id_usuario;
		}
	}

	public function eliminarUsuario($insert_id_usuario)
	{

		$this->db->trans_begin();

		$this->db->where('id_usuario', $insert_id_usuario);
		$this->db->delete('usuario.tbl_usuarios');

		$this->db->where('id_usuario2', $insert_id_usuario);
		$this->db->delete('usuario.tbl_usuarios_vehiculo_geo');

		$this->db->where('id_usuario2', $insert_id_usuario);
		$this->db->delete('usuario.tbl_usuarios_vehiculo_telefonos');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function ingresarUsuario($datos)
	{


		$this->db->where('email', $this->db->escape_str($datos['email']));
		//$this->db->where('verificado','1');
		$resultado = $this->db->get('usuario.tbl_usuarios');


		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}

	public function activarVerificarCuenta($codigo_verificacion)
	{

		$data = array(
			'verificado' => 1
		);
		$this->db->where('codigo_verificacion', $codigo_verificacion);
		$this->db->update('usuario.tbl_usuarios', $data);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function buscar($arrayBuscar, $inicio = FALSE, $cantidad = FALSE, $id_categoria = FALSE, $id_marca = FALSE, $id_modelo = FALSE, $id_ano = FALSE)
	{

		foreach ($arrayBuscar as $value) {
			$this->db->or_like('busqueda', $value);
		}

		if ($this->session->userdata('categoria_menu')) {
			$this->db->where('vehiculo.tbl_publicaciones.id_categoria', $this->session->userdata('categoria_menu'));
		}
		if ($this->session->userdata('marca_menu')) {
			$this->db->where('vehiculo.tbl_publicaciones.id_marca', $this->session->userdata('marca_menu'));
		}
		if ($this->session->userdata('modelo_menu')) {
			$this->db->where('vehiculo.tbl_publicaciones.id_modelo', $this->session->userdata('modelo_menu'));
		}
		if ($this->session->userdata('ano_menu')) {
			$this->db->where('id_ano', $this->session->userdata('ano_menu'));
		}

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad, $inicio);
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
		$estatus = array(1, 5);
		$this->db->where_in('vehiculo.tbl_publicaciones.estatus', $estatus);

		$resultado = $this->db->get('vehiculo.tbl_publicaciones');

		if ($resultado->result() > 0) {
			return $resultado->result();
		} else {
			return FALSE;
		}
	}
}
