<?php

/**
 * 
 */
class Mpublicacion extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}


	public function asociarPublicacionAusuario($datos)
	{
		$this->db->trans_begin();

		$data['id_usuario2'] = $this->session->userdata('id_usuario');

		$this->db->where('placa', $datos['placa']);
		$this->db->where('id_publicacion', $datos['id_publicacion']);
		$subquerymovil = "(vehiculo.tbl_publicaciones.moviluno ='" . $datos['movil'] . "' OR " . "vehiculo.tbl_publicaciones.movildos ='" . $datos['movil'] . "')";

		$this->db->where($subquerymovil);

		$this->db->update('vehiculo.tbl_publicaciones', $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function verificarTipoUsuarioPublicacion($datos)
	{
		$this->db->select('tbl_usuarios.id_grupo,cedula');
		$this->db->where('vehiculo.tbl_publicaciones.placa', $datos['placa']);

		$subquerymovil = "(vehiculo.tbl_publicaciones.moviluno ='" . $datos['movil'] . "' OR " . "vehiculo.tbl_publicaciones.movildos ='" . $datos['movil'] . "')";

		$this->db->where($subquerymovil);

		$this->db->where('vehiculo.tbl_publicaciones.id_publicacion', $datos['id_publicacion']);
		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2');
		$this->db->join('usuario.tbl_grupos', 'tbl_grupos.id_grupo = tbl_usuarios.id_grupo');
		$resultado = $this->db->get('vehiculo.tbl_publicaciones');

		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}

	public function getPublicacionPlacaTelefono($datos)
	{
		$this->db->select(' distinct(vehiculo.tbl_publicaciones.id_publicacion),
    							vehiculo.tbl_categorias.nombre AS categoria,
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
								ubicacion.tbl_parroquia.nombre AS parroquia,
								vehiculo.tbl_precios.id_precio AS id_precio,	
								vehiculo.tbl_precios.nombre AS nombre_precio,
								vehiculo.tbl_precios.incluye AS incluye_precio,	
								vehiculo.tbl_precios.precio AS precio_publicacion,
								vehiculo.tbl_precios.iva AS iva,
								vehiculo.tbl_precios.moneda AS moneda,
								vehiculo.tbl_precios.total AS total							
								');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo ');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria ');

		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.cedula = tbl_publicaciones.id_usuario ');

		$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'tbl_usuarios_vehiculo_geo.id_usuario = tbl_publicaciones.id_usuario');
		$this->db->join('ubicacion.tbl_estado', 'tbl_usuarios_vehiculo_geo.codigoestado = tbl_estado.codigoestado');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_usuarios_vehiculo_geo.codigomunicipio = tbl_municipio.codigomunicipio');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_usuarios_vehiculo_geo.codigoparroquia = tbl_parroquia.codigoparroquia');
		$this->db->join('vehiculo.tbl_precios', 'tbl_precios.id_precio = tbl_publicaciones.id_precio');

		$this->db->where("placa", $datos['placa']);

		$subquerymovil = "(vehiculo.tbl_publicaciones.moviluno ='" . $datos['movil'] . "' OR " . "vehiculo.tbl_publicaciones.movildos ='" . $datos['movil'] . "')";

		$this->db->where($subquerymovil);


		$resultado = $this->db->get("vehiculo.tbl_publicaciones");

		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}

	public function verificarSiExisteCodigoPublicacion($codigo)
	{
		//devuelve true sino existe la publicacion
		$this->db->where('codigo', $codigo);
		$resultado = $this->db->get('vehiculo.tbl_publicaciones');

		if ($resultado->num_rows() > 0)
			return false;
		else
			return true;
	}
	public function getPublicacionesImgOpcionales($datos)
	{

		$this->db->where('id_publicacion', $datos['id_publicacion']);
		$this->db->where('posicion', $datos['posicion']);
		$resultado = $this->db->get("vehiculo.publicaciones_img_opcionales");

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}



	public function ActualizarNombreImg($datos, $nombre_anterior)
	{
		$this->db->trans_begin();

		$this->db->where('imagen', $nombre_anterior);
		$this->db->where('posicion', $datos['posicion']);
		$this->db->where('id_publicacion', $datos['id_publicacion']);
		$this->db->where('posicion', $datos['posicion']);

		$this->db->update('vehiculo.publicaciones_img_opcionales', $datos);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function getPublicacionesImgOpcionales2($datos)
	{
		$this->db->order_by('vehiculo.publicaciones_img_opcionales.posicion', 'ASC');
		$this->db->where('vehiculo.publicaciones_img_opcionales.id_publicacion', $datos['id_publicacion']);
		$this->db->join('vehiculo.tbl_publicaciones', 'vehiculo.tbl_publicaciones.id_publicacion = vehiculo.publicaciones_img_opcionales.id_publicacion');
		$resultado = $this->db->get("vehiculo.publicaciones_img_opcionales");

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}



	public function guardarNombreImg($datos)
	{
		$this->db->trans_begin();

		$this->db->insert('vehiculo.publicaciones_img_opcionales', $datos);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function getPublicaciones($data)
	{

		$this->db->select(' vehiculo.tbl_publicaciones.*,
								vehiculo.tbl_marcas.marca, 
								vehiculo.tbl_modelos.modelo, 
								vehiculo.tbl_publicaciones.id_ano, 
								usuario.tbl_usuarios.id_usuario,
								usuario.tbl_usuarios.cedula,
								usuario.tbl_usuarios.nombres,
								usuario.tbl_usuarios.apellidos,
								ubicacion.tbl_estado.nombre AS estado, 
								ubicacion.tbl_municipio.nombre AS municipio, 
								ubicacion.tbl_parroquia.nombre AS parroquia,
								vehiculo.tbl_publicaciones_estatus.id AS id_estatus,
								vehiculo.tbl_publicaciones_estatus.nombre AS nombre_estatus,
								vehiculo.tbl_publicaciones_estatus.decripcion AS descripcion_estatus							
								');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo ');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca', 'LEFT');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria ');

		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2 ');
		$this->db->join('vehiculo.tbl_publicaciones_estatus', 'tbl_publicaciones_estatus.id = tbl_publicaciones.estatus');

		//$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'tbl_usuarios_vehiculo_geo.id_usuario = tbl_publicaciones.id_usuario');
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia');

		$this->db->order_by('creado', 'DESC');
		$this->db->limit($data['cantidad']);

		if (isset($data['categoria'])) {
			$this->db->where('tbl_publicaciones.id_categoria', $data['categoria']);
		}
		$this->db->where('tbl_publicaciones.estatus', $data['estatus']);
		$resultado = $this->db->get("vehiculo.tbl_publicaciones");

		if ($resultado->num_rows() > 0) {
			return $resultado->result();
		} else {
			return false;
		}
	}

	public function getPublicionesUsuario($datos)
	{

		$estatus = '8'; //

		$id_usuario = $datos['id_usuario'];
		$this->db->select(' vehiculo.tbl_publicaciones.id_publicacion,
								vehiculo.tbl_publicaciones.id_categoria,
								vehiculo.tbl_publicaciones.id_marca,
								vehiculo.tbl_publicaciones.id_modelo,
								vehiculo.tbl_publicaciones.id_ano, 
								vehiculo.tbl_publicaciones.id_usuario,
								vehiculo.tbl_publicaciones.url_uno,
								vehiculo.tbl_publicaciones.url_dos, 
								vehiculo.tbl_publicaciones.url_tres,
								vehiculo.tbl_publicaciones.url_cuatro,
								vehiculo.tbl_publicaciones.creado, 
								vehiculo.tbl_publicaciones.modificado,
								vehiculo.tbl_publicaciones.id_precio, 
								vehiculo.tbl_publicaciones.url_cinco,
								vehiculo.tbl_publicaciones.url_seis,
								vehiculo.tbl_publicaciones.busqueda, 
								vehiculo.tbl_publicaciones.titulo, 
								vehiculo.tbl_publicaciones.direccion, 
								vehiculo.tbl_publicaciones.estereo,
								vehiculo.tbl_publicaciones.tapizado, 
								vehiculo.tbl_publicaciones.transmision, 
								vehiculo.tbl_publicaciones.vidrios, reparado,
								vehiculo.tbl_publicaciones.traccion,
								vehiculo.tbl_publicaciones.puertas, 
								vehiculo.tbl_publicaciones.combustible, 
								vehiculo.tbl_publicaciones.condicion,
								vehiculo.tbl_publicaciones.color, 
								vehiculo.tbl_publicaciones.unico_dueno, 
								vehiculo.tbl_publicaciones.motor, 
								vehiculo.tbl_publicaciones.nro_cilindros,
								vehiculo.tbl_publicaciones.recorrido, 
								vehiculo.tbl_publicaciones.placa, 
								vehiculo.tbl_publicaciones.comentario, 
								vehiculo.tbl_publicaciones.negociable, 
								vehiculo.tbl_publicaciones.precio_bs, 
								vehiculo.tbl_publicaciones.precio_dol, 
								vehiculo.tbl_publicaciones.estatus, 
								vehiculo.tbl_publicaciones.comentario_adm,
								vehiculo.tbl_publicaciones.codigoestado,
								vehiculo.tbl_publicaciones.codigomunicipio,
								vehiculo.tbl_publicaciones.codigoparroquia,
								vehiculo.tbl_publicaciones.codigo,
								vehiculo.tbl_publicaciones.id_usuario2,
								vehiculo.tbl_publicaciones.precio_publicacion,
								vehiculo.tbl_publicaciones.moviluno, 
								vehiculo.tbl_publicaciones.movildos,
								vehiculo.tbl_publicaciones.paso,
								vehiculo.tbl_publicaciones.principal,
								vehiculo.tbl_marcas.marca, 
								vehiculo.tbl_modelos.modelo,
								vehiculo.tbl_publicaciones_estatus.id AS id_estatus,
								vehiculo.tbl_publicaciones_estatus.nombre AS nombre_estatus,
								vehiculo.tbl_publicaciones_estatus.decripcion AS descripcion_estatus,
								ubicacion.tbl_estado.nombre AS nombre_estado,
								ubicacion.tbl_municipio.nombre AS nombre_municipio,
								ubicacion.tbl_parroquia.nombre AS nombre_parroquia						
								');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo', 'left');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria', 'left');

		//$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.cedula = tbl_publicaciones.id_usuario ');
		$this->db->join('vehiculo.tbl_publicaciones_estatus', 'tbl_publicaciones_estatus.id = tbl_publicaciones.estatus', 'left');

		/*$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'tbl_usuarios_vehiculo_geo.id_usuario = tbl_publicaciones.id_usuario');*/
		$this->db->join('ubicacion.tbl_estado', 'vehiculo.tbl_publicaciones.codigoestado = tbl_estado.codigoestado', 'left');
		$this->db->join('ubicacion.tbl_municipio', 'vehiculo.tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio', 'left');
		$this->db->join('ubicacion.tbl_parroquia', 'vehiculo.tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia', 'left');

		$this->db->order_by('creado', 'DESC');

		$this->db->where("vehiculo.tbl_publicaciones.id_usuario2", $id_usuario);
		$this->db->where_not_in('tbl_publicaciones.estatus', $estatus);
		$resultado = $this->db->get("vehiculo.tbl_publicaciones");

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function accionespublicacion($datos)
	{

		$datos = $this->db->escape_str($datos);

		$this->db->trans_begin();
		$this->db->where("vehiculo.tbl_publicaciones.codigo", $datos['codigo']);
		$this->db->where("vehiculo.tbl_publicaciones.id_publicacion", $datos['id_publicacion']);
		$this->db->where("vehiculo.tbl_publicaciones.id_usuario2", $datos['id_usuario']);
		$this->db->update('vehiculo.tbl_publicaciones', $datos);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function finalizarPublicacionVendido($datos)
	{

		$dataP['estatus'] = 5;

		$this->db->trans_begin();

		$this->db->where("vehiculo.tbl_publicaciones.id_publicacion", $datos['id_publicacion']);
		$this->db->where("vehiculo.tbl_publicaciones.id_usuario2", $datos['id_usuario']);
		$this->db->update('vehiculo.tbl_publicaciones', $dataP);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function eliminarPublicacion($datos)
	{

		$dataP['estatus'] = 8;

		$this->db->trans_begin();

		$this->db->where("vehiculo.tbl_publicaciones.id_publicacion", $datos['id_publicacion']);
		$this->db->where("vehiculo.tbl_publicaciones.id_usuario2", $datos['id_usuario']);
		$this->db->update('vehiculo.tbl_publicaciones', $dataP);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function activarPublicacion($datos)
	{

		$dataP['estatus'] = 1;

		$this->db->trans_begin();

		$this->db->where("vehiculo.tbl_publicaciones.id_publicacion", $datos['id_publicacion']);
		$this->db->where("vehiculo.tbl_publicaciones.id_usuario2", $datos['id_usuario']);
		$this->db->update('vehiculo.tbl_publicaciones', $dataP);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function getPrecios()
	{

		$resultado = $this->db->get('vehiculo.tbl_precios');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}
	//sin uso
	public function eliminarPublicacionError($id_publicacion)
	{

		$this->db->where('id_publicacion', $id_publicacion);
		$this->db->delete('vehiculo.tbl_publicaciones');
	}
	//function copia de getPublicacionPorId() anulando join con tbl_precios porq da conflicto cuando no esta registrado
	public function getPublicacionPorIdDetalle($id_publicacion)
	{

		$this->db->select(' distinct(vehiculo.tbl_publicaciones.id_publicacion),
							vehiculo.tbl_categorias.nombre AS categoria,
							vehiculo.tbl_publicaciones.*,
							vehiculo.tbl_marcas.marca, 
							vehiculo.tbl_modelos.modelo, 
							vehiculo.tbl_publicaciones.id_ano, 
							usuario.tbl_usuarios.id_usuario,
							usuario.tbl_usuarios.nombres,
							usuario.tbl_usuarios.apellidos,
							ubicacion.tbl_estado.nombre AS estado, 
							ubicacion.tbl_municipio.nombre AS municipio, 
							ubicacion.tbl_parroquia.nombre AS parroquia							
							');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo', 'left');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria', 'left');

		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2', 'LEFT');

		//$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'tbl_usuarios_vehiculo_geo.id_usuario = tbl_publicaciones.id_usuario');
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia');


		$this->db->where("id_publicacion", $id_publicacion);
		$resultado = $this->db->get("vehiculo.tbl_publicaciones");

		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}

	public function getPublicacionPorId($id_publicacion)
	{

		$this->db->select(' distinct(vehiculo.tbl_publicaciones.id_publicacion),
    							vehiculo.tbl_categorias.nombre AS categoria,
    							vehiculo.tbl_publicaciones.*,
								vehiculo.tbl_marcas.marca, 
								vehiculo.tbl_modelos.modelo, 
								vehiculo.tbl_publicaciones.id_ano, 
								usuario.tbl_usuarios.id_usuario,
								usuario.tbl_usuarios.nombres,
								usuario.tbl_usuarios.apellidos,
								ubicacion.tbl_estado.nombre AS estado, 
								ubicacion.tbl_municipio.nombre AS municipio, 
								ubicacion.tbl_parroquia.nombre AS parroquia						
								');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo', 'left');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria', 'left');

		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2 ');

		/* 		$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'tbl_usuarios_vehiculo_geo.id_usuario = tbl_publicaciones.id_usuario'); */
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado', 'left');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio', 'left');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia', 'left');
		/* 		$this->db->join('vehiculo.tbl_precios', 'tbl_precios.id_precio = tbl_publicaciones.id_precio'); */

		$this->db->where("id_publicacion", $id_publicacion);
		$resultado = $this->db->get("vehiculo.tbl_publicaciones");

		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}


	public function getPublicacionCodigo($datos)
	{

		$datos = $this->db->escape_str($datos);

		$this->db->select(' distinct(vehiculo.tbl_publicaciones2.id_publicacion2),
    							vehiculo.tbl_categorias.nombre AS categoria,
    							vehiculo.tbl_publicaciones2.*,
								vehiculo.tbl_marcas.marca, 
								vehiculo.tbl_modelos.modelo, 
								vehiculo.tbl_publicaciones2.id_ano, 
								usuario.tbl_usuarios.id_usuario,
								usuario.tbl_usuarios.cedula,
								usuario.tbl_usuarios.nombres,
								usuario.tbl_usuarios.apellidos,
								ubicacion.tbl_estado.nombre AS estado, 
								ubicacion.tbl_municipio.nombre AS municipio, 
								ubicacion.tbl_parroquia.nombre AS parroquia,						
								');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones2.id_modelo ', 'left');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones2.id_marca', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones2.id_categoria ', 'left');

		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones2.id_usuario2 ', 'left');

		$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'tbl_usuarios_vehiculo_geo.id_usuario = tbl_publicaciones2.id_usuario', 'left');
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones2.codigoestado = tbl_estado.codigoestado', 'left');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones2.codigomunicipio = tbl_municipio.codigomunicipio', 'left');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones2.codigoparroquia = tbl_parroquia.codigoparroquia', 'left');

		$this->db->where("codigo", $datos['codigo']);
		$this->db->where("usuario.tbl_usuarios.id_usuario", $this->session->userdata('id_usuario'));
		$resultado = $this->db->get("vehiculo.tbl_publicaciones2");

		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}
	public function getPublicacionCodigo1($datos)
	{

		$this->db->select(' distinct(vehiculo.tbl_publicaciones.id_publicacion),
    							vehiculo.tbl_categorias.nombre AS categoria,
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
								ubicacion.tbl_parroquia.nombre AS parroquia,
								pe.nombre as nombre_estatus					
								');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo ', 'left');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria ', 'left');

		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2 ', 'left');

		//$this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'tbl_usuarios_vehiculo_geo.id_usuario = tbl_publicaciones.id_usuario', 'left');
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado', 'left');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio', 'left');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia', 'left');
		$this->db->join('vehiculo.tbl_publicaciones_estatus as pe', 'pe.id = vehiculo.tbl_publicaciones.estatus', 'left');

		$this->db->where("codigo", $datos['codigo']);
		$resultado = $this->db->get("vehiculo.tbl_publicaciones");

		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}
	public function getPublicacionCodigoUpload($datos)
	{
		$datos = $this->db->escape_str($datos);
		$this->db->where("codigo", $datos['codigo']);
		$this->db->where("id_usuario2", $datos['id_usuario2']);
		$resultado = $this->db->get("vehiculo.tbl_publicaciones2");

		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}

	public function uploadImage($datos)
	{
		$datos = $this->db->escape_str($datos);
		$this->db->where('codigo', $datos['codigo']);
		$this->db->where('id_usuario2', $datos['id_usuario2']);
		$this->db->update('vehiculo.tbl_publicaciones2', $datos);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function deleteImage($datos)
	{

		$this->db->where('codigo', $datos['codigo']);
		$this->db->where('id_usuario', $datos['id_usuario']);
		$this->db->update('vehiculo.upload', $datos);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function VerificarMarcas($datos){
		
		$this->db->where("marca", $datos['marca']);
		//$this->db->where('activo', 1);
		$resultado = $this->db->get("vehiculo.tbl_marcas");
		
		if ($resultado->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function VerificarModelo($datos){


		$this->db->where("id_marca", $datos['id_marca']);
		$this->db->where("modelo", $datos['modelo']);
		//$this->db->where('activo', 1);
		$resultado = $this->db->get("vehiculo.tbl_modelos");
		
		if ($resultado->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}



	public function insertMarcasModelos($datos)
	{

		$this->db->trans_begin();

		$datos = $this->db->escape_str($datos);

		$sql = "INSERT INTO vehiculo.tbl_marcas(marca, slug, activo, id_usuario) 
		VALUES ('" . $datos['marca'] . "', '" . $datos['slug-marca'] . "', " . $datos['activo'] . ", " . $datos['id_usuario'] . ") RETURNING id_marca;";

		$this->db->query($sql);
		$datos['id_marca']  = $this->db->insert_id();
		
		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}
		$sql2 = "INSERT INTO vehiculo.tbl_modelos(id_marca, modelo, slug, activo, id_usuario) 
		VALUES (" . $datos['id_marca'] . ",'" . $datos['modelo'] . "', '" . $datos['slug-modelo'] . "', " . $datos['activo'] . ", " . $datos['id_usuario'] . " ) RETURNING id_modelo;";
		
		$this->db->query($sql2);
		$datos['id_modelo']  = $this->db->insert_id();

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		$res['id_marca'] = $datos['id_marca'];
		$res['id_modelo'] = $datos['id_modelo'];

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $res;
		}

	}

	public function insertModelos($datos)
	{

		$this->db->trans_begin();

		if($datos['id_usuario'] == NULL){
			$datos['id_usuario'] = "NULL";
		}


		$sql2 = "INSERT INTO vehiculo.tbl_modelos(id_marca, modelo, slug, activo, id_usuario) 
		VALUES (" . $datos['id_marca'] . ",'" . $datos['modelo'] . "', '" . $datos['slug'] . "', " . $datos['activo'] . ", " . $datos['id_usuario'] . " ) RETURNING id_modelo;";
		
		$this->db->query($sql2);
		$res['id_modelo']  = $this->db->insert_id();

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $res;
		}
	}

	public function insertMarcasAdm($datos)
	{

		$this->db->trans_begin();

		$sql2 = "INSERT INTO vehiculo.tbl_marcas(marca, slug, activo) 
		VALUES ('" . $datos['marca'] . "', '" . $datos['slug'] . "', " . $datos['activo'] ." ) RETURNING id_marca;";
		
		$this->db->query($sql2);
		$res['id_marca']  = $this->db->insert_id();

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $res;
		}
	}

	public function registrarPublicacionUno($datos)
	{

		$this->db->trans_begin();

		$this->db->insert('vehiculo.tbl_publicaciones2', $datos);
		$insert_id = $this->db->insert_id();

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}


		$this->db->where('id_publicacion2', $insert_id);
		$resultado = $this->db->get('vehiculo.tbl_publicaciones2');


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $resultado->row();
		}
	}

	public function actualizarPublicacionFormUno($datos)
	{
		$this->db->trans_begin();

		$this->db->where('id_usuario2', $this->session->userdata('id_usuario'));
		$this->db->where('codigo', $datos['codigo']);
		$this->db->update('vehiculo.tbl_publicaciones2', $datos);

		//var_dump($this->db);exit;
		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function actualizarPublicacionFormTres($datos)
	{
		$this->db->trans_begin();

		$this->db->where('id_usuario2', $this->session->userdata('id_usuario'));
		$this->db->where('codigo', $datos['codigo']);
		$this->db->update('vehiculo.tbl_publicaciones', $datos);


		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if (!$this->updateBusqueda($datos['codigo'])) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function  modificarPublicacionUsuario($datos)
	{
		$this->db->trans_begin();

		$datos = $this->db->escape_str($datos);

		if ($datos['precio_bs']=="") {
			$datos['precio_bs'] = NULL;
		}

		$this->db->where('id_publicacion', $datos['id_publicacion']);
		$this->db->where('id_usuario2', $this->session->userdata('id_usuario'));
		$this->db->where('codigo', $datos['codigo']);
		$this->db->update('vehiculo.tbl_publicaciones', $datos);


		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if (!$this->updateBusqueda($datos['codigo'])) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function registrarPublicacionDosTres($datos)
	{

		$this->db->trans_begin();

		$datos = $this->db->escape_str($datos);

		$this->db->where('id_usuario2', $this->session->userdata('id_usuario'));
		$this->db->where('codigo', $datos['codigo']);
		$this->db->update('vehiculo.tbl_publicaciones2', $datos);


		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function reiniciocampobusquedadpublicacion(){

		$this->db->trans_begin();

		$this->db->select("
		vehiculo.tbl_publicaciones.*,
		vehiculo.tbl_categorias.nombre AS categoria,
		vehiculo.tbl_publicaciones.color AS color,
		vehiculo.tbl_publicaciones.id_ano,
		vehiculo.tbl_modelos.modelo AS modelo,
		vehiculo.tbl_marcas.marca AS marca,
		ubicacion.tbl_estado.nombre AS estado", false);
		$this->db->join('vehiculo.tbl_marcas', 'vehiculo.tbl_publicaciones.id_marca = vehiculo.tbl_marcas.id_marca', 'left');
		$this->db->join('vehiculo.tbl_modelos', 'vehiculo.tbl_publicaciones.id_modelo = vehiculo.tbl_modelos.id_modelo', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'vehiculo.tbl_publicaciones.id_categoria = vehiculo.tbl_categorias.id_categoria', 'left');
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado', 'left');
		$query = $this->db->get('vehiculo.tbl_publicaciones');
		


		if (!$query->num_rows() > 0)
			return false;

		$busqueda = $query->result();
		$procesado = 0;
		foreach ($busqueda as $value) {
			$var = $value->categoria . " " . $value->marca . " " . $value->modelo . " " . $value->color . " " . $value->id_ano . " " . $value->estado;
			$data = array(
				'busqueda' => mb_strtolower($var),
				'principal' => 1
			);
			$this->db->where('id_publicacion', $value->id_publicacion);
			$this->db->where('codigo', $value->codigo);
			$this->db->update('vehiculo.tbl_publicaciones', $data);

			if (!$this->db->affected_rows() > 0) {
				$this->db->trans_rollback();
				echo "ocurrio un error";
				break;
			}else{
				$procesado ++;
			}
		}
		$this->db->trans_commit();
		echo "Operación exitosa, se actualizo el campo busqueda de la tabla tbl_publicaciones ".$procesado." actualizaciones de manera exitosa";

	}

	public function updateBusqueda($codigo)
	{
		$this->db->trans_begin();

		$this->db->select("
		vehiculo.tbl_categorias.nombre AS categoria,
		vehiculo.tbl_publicaciones.color AS color,
		vehiculo.tbl_publicaciones.id_ano,
		vehiculo.tbl_modelos.modelo AS modelo,
		vehiculo.tbl_marcas.marca AS marca,
		ubicacion.tbl_estado.nombre AS estado", false);
		$this->db->from('vehiculo.tbl_publicaciones');
		$this->db->join('vehiculo.tbl_marcas', 'vehiculo.tbl_publicaciones.id_marca = vehiculo.tbl_marcas.id_marca', 'left');
		$this->db->join('vehiculo.tbl_modelos', 'vehiculo.tbl_publicaciones.id_modelo = vehiculo.tbl_modelos.id_modelo', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'vehiculo.tbl_publicaciones.id_categoria = vehiculo.tbl_categorias.id_categoria', 'left');
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado', 'left');


		$this->db->where('vehiculo.tbl_publicaciones.codigo', $codigo);
		$query = $this->db->get();
		$busqueda = $query->row();

		$var = $busqueda->categoria . " " . $busqueda->marca . " " . $busqueda->modelo . " " . $busqueda->color . " " . $busqueda->id_ano . " " . $busqueda->estado;


		$data = array(
			'busqueda' => mb_strtolower($var),
			'principal' => 1
		);

		$this->db->where('codigo', $codigo);
		$this->db->update('vehiculo.tbl_publicaciones', $data);


		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}

	}

	public function publicarPublicacionPrincipal($datos)
	{

		$this->db->trans_begin();

		$datos = $this->db->escape_str($datos);

		$this->db->where('id_usuario2', $this->session->userdata('id_usuario'));
		$this->db->where('codigo', $datos['codigo']);
		$this->db->update('vehiculo.tbl_publicaciones2', $datos);


		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}


		$sql = "INSERT INTO vehiculo.tbl_publicaciones (SELECT * FROM vehiculo.tbl_publicaciones2 where codigo = '" . $datos['codigo'] . "' limit 1);";
		$this->db->query($sql);

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		$sql2 = "DELETE FROM vehiculo.tbl_publicaciones2 WHERE codigo = '" . $datos['codigo'] . "';";
		$this->db->query($sql2);

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}


		if (!$this->updateBusqueda($datos['codigo'])) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}



	public function registrarPublicacion($datos)
	{

		$this->db->trans_begin();

		$this->db->insert('vehiculo.tbl_publicaciones', $datos);
		$insert_id = $this->db->insert_id();


		$this->db->select("vehiculo.tbl_publicaciones.*,
							   vehiculo.tbl_publicaciones.titulo AS titulo,
							   vehiculo.tbl_categorias.nombre AS categoria,
							   vehiculo.tbl_publicaciones.color AS color,
							   vehiculo.tbl_modelos.modelo AS modelo,
							   vehiculo.tbl_marcas.marca AS marca,
							   ubicacion.tbl_estado.nombre AS estado, 
							   ubicacion.tbl_municipio.nombre AS municipio, 
							   ubicacion.tbl_parroquia.nombre AS parroquia,
							   vehiculo.tbl_precios.*,
							   vehiculo.tbl_publicaciones.id_ano", false);
		$this->db->from('vehiculo.tbl_publicaciones');
		$this->db->join('vehiculo.tbl_marcas', 'vehiculo.tbl_publicaciones.id_marca = vehiculo.tbl_marcas.id_marca');
		$this->db->join('vehiculo.tbl_modelos', 'vehiculo.tbl_publicaciones.id_modelo = vehiculo.tbl_modelos.id_modelo');
		$this->db->join('vehiculo.tbl_categorias', 'vehiculo.tbl_publicaciones.id_categoria = vehiculo.tbl_categorias.id_categoria');
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia');
		$this->db->join('vehiculo.tbl_precios', 'tbl_publicaciones.id_precio = tbl_precios.id_precio');

		$this->db->where('vehiculo.tbl_publicaciones.id_publicacion', $insert_id);
		$query = $this->db->get();
		$busqueda = $query->row();

		$var = $busqueda->categoria . " " . $busqueda->marca . " " . $busqueda->modelo . " " . $busqueda->color . " " . $busqueda->id_ano . " " . $busqueda->estado;


		$data = array(
			'busqueda' => mb_strtolower($var)/*,
			        'precio_publicacion' => $busqueda->precio*/
		);

		$this->db->where('id_publicacion', $insert_id);
		$this->db->update('vehiculo.tbl_publicaciones', $data);


		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		//
		$data2['precio_publicacion'] =
			$this->db->where('id_publicacion', $insert_id);
		$this->db->update('vehiculo.tbl_publicaciones', $data);

		if (!$this->db->affected_rows() > 0) {
			$this->db->trans_rollback();
			return FALSE;
		}
		//

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $insert_id;
		}
	}

	public function getCategorias()
	{

		$this->db->order_by('favorito', 'ASC');

		$resultado = $this->db->get('vehiculo.tbl_categorias');

		return $resultado->result();
	}

	public function getCategoriasHome()
	{
		if ($this->session->userdata('marca')) {
			$this->db->where('vehiculo.tbl_categorias.id_categoria in (select distinct(id_categoria) FROM vehiculo.tbl_publicaciones where estatus in (1) and id_marca = ' . $this->session->userdata('marca') . ')', NULL, FALSE);
		} else {
			$this->db->where('vehiculo.tbl_categorias.id_categoria in (select distinct(id_categoria) FROM vehiculo.tbl_publicaciones where estatus in (1))', NULL, FALSE);
		}
		$this->db->order_by('favorito', 'ASC');
		$resultado = $this->db->get('vehiculo.tbl_categorias');

		return $resultado->result();
	}

	//para publicar select dependientes
	public function getMarca()
	{
		$this->db->where('activo', 1);
		if ($this->session->userdata('id_usuario')) {
			$this->db->or_where('id_usuario', $this->session->userdata('id_usuario'));
		}

		$this->db->order_by('vehiculo.tbl_marcas.id_marca ASC');
		$resultado = $this->db->get('vehiculo.tbl_marcas');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function getModelo($data)
	{
		$id_marca = $data['id_marca'];

		$this->db->where('id_marca', $id_marca);
		$this->db->where('activo', 1);
		if ($this->session->userdata('id_usuario')) {
			$this->db->or_where('id_usuario', $this->session->userdata('id_usuario'));
		}

		//$this->db->order_by('modelo', 'ASC');
		$resultado = $this->db->get('vehiculo.tbl_modelos');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}
	//para publicar select dependientes

	public function getMarcaHome($data)
	{
		$categoria = $data['categoria'];
		$this->db->select('distinct(p.id_marca) as id_marca, m.marca', false);
		$this->db->join('vehiculo.tbl_marcas as m', 'm.id_marca = p.id_marca', 'LEFT');
		$this->db->where('p.estatus ', 1);
		$this->db->where('m.activo ', 1);
		$this->db->where('p.id_categoria ', $categoria);
		$resultado = $this->db->get('vehiculo.tbl_publicaciones as p');
		//$this->db->order_by('vehiculo.tbl_marcas.id_marca DESC');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function getModeloHome($data)
	{
		$marca = $data['marca'];
		$this->db->select('distinct(p.id_marca), m.modelo, m.id_modelo', false);
		$this->db->join('vehiculo.tbl_modelos as m', 'm.id_modelo = p.id_modelo', 'LEFT');
		$this->db->order_by('m.modelo ASC');
		$this->db->where('m.activo ', 1);
		$this->db->where('p.estatus ', 1);
		$this->db->where('p.id_marca ', $marca);

		if(isset($data['categoria']) and $data['categoria']!=""){
			$this->db->where('p.id_categoria ', $data['categoria']);
		}
		$resultado = $this->db->get('vehiculo.tbl_publicaciones as p');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	//para filtros
	//carga en el home
	public function getMarca2()
	{

			$this->db->select('distinct(p.id_marca), m.marca', false);
			$this->db->join('vehiculo.tbl_marcas as m', 'm.id_marca = p.id_marca', 'LEFT');
			$this->db->where('p.estatus ', 1);
			$this->db->where('m.activo ', 1);

			if ($this->session->userdata('estado')) {
				$this->db->where('p.codigoestado ', $this->session->userdata('estado'));
			}	
			if ($this->session->userdata('categoria')) {
				$this->db->where('p.id_categoria ', $this->session->userdata('categoria'));
			}			
			
			$resultado = $this->db->get('vehiculo.tbl_publicaciones as p');

			if ($resultado->num_rows() > 0)
				return $resultado->result();
			else
				return false;
		
	}
	//carga en el home
	public function getModelos2()
	{

		$this->db->select('distinct(p.id_modelo), m.modelo', false);
		$this->db->join('vehiculo.tbl_modelos as m', 'm.id_modelo = p.id_modelo', 'LEFT');
		$this->db->where('p.estatus ', 1);
		$this->db->where('m.activo ', 1);

		if ($this->session->userdata('marca')) {
		$this->db->where('p.id_marca', $this->session->userdata('marca'));
		}
		
		$resultado = $this->db->get('vehiculo.tbl_publicaciones as p');
		


		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function getAnio()
	{

		if ($this->session->userdata('marca')) {
			$this->db->where('id_marca', $this->session->userdata('marca'));
		}
		if ($this->session->userdata('modelo')) {
			$this->db->where('id_modelo', $this->session->userdata('modelo'));
		}
		$this->db->select('distinct(id_ano)', false);
		$this->db->order_by('id_ano', 'DESC');
		$this->db->where('p.estatus ', 1);
		$resultado = $this->db->get('vehiculo.tbl_publicaciones as p');



		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function getEstados()
	{

		$this->db->select('distinct(ubicacion.tbl_estado.codigoestado),ubicacion.tbl_estado.*');
		$this->db->join('ubicacion.tbl_estado', 'ubicacion.tbl_estado.codigoestado = vehiculo.tbl_publicaciones.codigoestado', "right");
		
		if ($this->session->userdata('marca')) {
			$this->db->where("vehiculo.tbl_publicaciones.estatus in (1) and vehiculo.tbl_publicaciones.id_marca = ".$this->session->userdata('marca')."", NULL, FALSE);
		}else{
			$this->db->where("vehiculo.tbl_publicaciones.estatus in (1)", NULL, FALSE);
		}
		
		
		$this->db->order_by('ubicacion.tbl_estado.codigoestado', 'ASC');
		$query = $this->db->get('vehiculo.tbl_publicaciones');



		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function getMunicipios($data)
	{

		$codigoestado = $data['codigoestado'];

		$this->db->select('distinct(ubicacion.tbl_municipio.codigomunicipio),ubicacion.tbl_municipio.*');
		$this->db->join('ubicacion.tbl_municipio', 'ubicacion.tbl_municipio.codigomunicipio = vehiculo.tbl_publicaciones.codigomunicipio', "right");
		$this->db->where('ubicacion.tbl_municipio.codigoestado', $codigoestado);
		$this->db->where("vehiculo.tbl_publicaciones.estatus in (1) and vehiculo.tbl_publicaciones.codigoestado = '$codigoestado'", NULL, FALSE);
		$this->db->order_by('ubicacion.tbl_municipio.codigomunicipio', 'ASC');
		$query = $this->db->get('vehiculo.tbl_publicaciones');

		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	public function getParroquias($data)
	{

		$codigoestado = $data['codigoestado'];
		$codigomunicipio = $data['codigomunicipio'];


		$this->db->select('distinct(ubicacion.tbl_parroquia.codigoparroquia),ubicacion.tbl_parroquia.*');
		$this->db->join('ubicacion.tbl_parroquia', 'ubicacion.tbl_parroquia.codigoparroquia = vehiculo.tbl_publicaciones.codigoparroquia', "right");
		$this->db->where('ubicacion.tbl_municipio.codigoestado', $codigoestado);
		$this->db->where('ubicacion.tbl_municipio.codigomunicipio', $codigomunicipio);
		$this->db->where("vehiculo.tbl_publicaciones.estatus in (1) and vehiculo.tbl_publicaciones.codigoestado = '$codigoestado' and vehiculo.tbl_publicaciones.codigomunicipio = '$codigomunicipio'", NULL, FALSE);
		$this->db->order_by('ubicacion.tbl_municipio.codigoparroquia', 'ASC');
		$query = $this->db->get('vehiculo.tbl_publicaciones');


		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}


	public function verificarPlaca($placa)
	{

		$this->db->select('placa');
		$this->db->from('vehiculo.tbl_publicaciones');
		$this->db->where('placa', $placa);
		$this->db->where('estatus', 1);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function buscar($arrayBuscar, $inicio = FALSE, $cantidad = FALSE)
	{

		$arrayBuscar = $this->db->escape_str($arrayBuscar);
		foreach ($arrayBuscar as $value) {
			$this->db->or_like('vehiculo.tbl_publicaciones.busqueda', $this->db->escape_like_str($value));
		}

		if ($this->session->userdata('categoria')) {
			$this->db->where('vehiculo.tbl_publicaciones.id_categoria', $this->session->userdata('categoria'));
		}
		if ($this->session->userdata('marca')) {
			$this->db->where('vehiculo.tbl_publicaciones.id_marca', $this->session->userdata('marca'));
		}
		if ($this->session->userdata('modelo')) {
			$this->db->where('vehiculo.tbl_publicaciones.id_modelo', $this->session->userdata('modelo'));
		}
		if ($this->session->userdata('anio')) {
			$this->db->where('vehiculo.tbl_publicaciones.id_ano', $this->session->userdata('anio'));
		}
		if ($this->session->userdata('estado')) {
			$this->db->where('vehiculo.tbl_publicaciones.codigoestado', $this->session->userdata('estado'));
		}

		if ($this->session->userdata('estado') != "" and $this->session->userdata('municipio') != "") {
			$this->db->where('vehiculo.tbl_publicaciones.codigomunicipio', $this->session->userdata('municipio'));
		}

		if ($this->session->userdata('precio')) {
			$precio = $this->session->userdata('precio');
			//var_dump($precio);exit;

			if ($precio == '_500') {
				$this->db->where('vehiculo.tbl_publicaciones.precio_dol <=', '500');
			} else if ($precio == '_2000') {
				$this->db->where('vehiculo.tbl_publicaciones.precio_dol <=', '2000');
			} else if ($precio == '_5000') {
				$this->db->where('vehiculo.tbl_publicaciones.precio_dol <=', '5000');
			} else if ($precio == '5000_15000') {
				$this->db->where('vehiculo.tbl_publicaciones.precio_dol >=', '5000');
				$this->db->where('vehiculo.tbl_publicaciones.precio_dol <=', '15000');
			} else if ($precio == '15000_') {
				$this->db->where('vehiculo.tbl_publicaciones.precio_dol >', '15000');
			} else {
				$this->session->unset_userdata('precio');
			}
		}

		if ($this->session->userdata('km')) {
			$km = $this->session->userdata('km');

			if ($km == '_0_') {
				$this->db->where('vehiculo.tbl_publicaciones.recorrido', '0');
			} else if ($km == '_100000') {
				$this->db->where('vehiculo.tbl_publicaciones.recorrido >=', '100000');
			} else if ($km == '100000_200000') {
				$this->db->where('vehiculo.tbl_publicaciones.recorrido >=', '100000');
				$this->db->where('vehiculo.tbl_publicaciones.recorrido <=', '200000');
			} else if ($km == '200000_') {
				$this->db->where('vehiculo.tbl_publicaciones.recorrido >=', '200000');
			} else {
				$this->session->unset_userdata('km');
			}
		}

		//MENU LATERAL IZQUIERDO
		/*  
		$resultadocategoriamultiple="";  		
		if($this->session->userdata('categoriamultiple')){

			for ($i=0; $i < count($this->session->userdata('categoriamultiple')); $i++) {
				$resultadocategoriamultiple .= "vehiculo.tbl_publicaciones.id_categoria = ".$this->session->userdata('categoriamultiple')[$i];
			
			$cantidad = count($this->session->userdata('categoriamultiple'));
			if ( $cantidad  > 1 AND  ($i + 1) < $cantidad ) {
				$resultadocategoriamultiple .= " OR ";
			}

			}
			$resultadocategoriamultiple = "(".$resultadocategoriamultiple.")";
			$this->db->where($resultadocategoriamultiple);			
		}
		$resultadoubicacionmultiple="";
		if($this->session->userdata('ubicacionmultiple')){

			for ($i=0; $i < count($this->session->userdata('ubicacionmultiple')); $i++) {

				$resultadoubicacionmultiple .= "vehiculo.tbl_publicaciones.codigoestado = '".$this->session->userdata('ubicacionmultiple')[$i]."'";

			$cantidad = count($this->session->userdata('ubicacionmultiple'));
			if ( $cantidad  > 1 AND  ($i + 1) < $cantidad ) {
				$resultadoubicacionmultiple .= " OR ";
			}

			}
			$resultadoubicacionmultiple = "(".$resultadoubicacionmultiple.")";

			$this->db->where($resultadoubicacionmultiple);	

			
		}
		$resultadomarcamultiple = "";
		if($this->session->userdata('marcamultiple')){

			for ($i=0; $i < count($this->session->userdata('marcamultiple')); $i++) {

				$resultadomarcamultiple .= "vehiculo.tbl_publicaciones.id_marca = ".$this->session->userdata('marcamultiple')[$i];
			$cantidad = count($this->session->userdata('marcamultiple'));
			if ( $cantidad  > 1 AND  ($i + 1) < $cantidad ) {
				$resultadomarcamultiple .= " OR ";
			}

			}
			$resultadomarcamultiple = "(".$resultadomarcamultiple.")";
			$this->db->where($resultadomarcamultiple);	
			
			
		}
		$resultadomodelomultiple = "";
		if($this->session->userdata('modelomultiple')){


			for ($i=0; $i < count($this->session->userdata('modelomultiple')); $i++) {

				$resultadomodelomultiple .= "vehiculo.tbl_publicaciones.id_modelo = ".$this->session->userdata('modelomultiple')[$i];
			$cantidad = count($this->session->userdata('modelomultiple'));
			if ( $cantidad  > 1 AND  ($i + 1) < $cantidad ) {
				$resultadomodelomultiple .= " OR ";
			}

			}
			$resultadomodelomultiple = "(".$resultadomodelomultiple.")";
			$this->db->where($resultadomodelomultiple);	
			
		}
		*/
		//MENU LATERAL IZQUIERDO

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
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo', 'left');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria', 'left');
		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2', 'left');


		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado', 'left');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio', 'left');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia', 'left');
		$estatus = array(1, 5);
		$this->db->where_in('vehiculo.tbl_publicaciones.estatus', $estatus);

		$resultado = $this->db->get('vehiculo.tbl_publicaciones');

		if ($resultado->result() > 0) {
			return $resultado->result();
		} else {
			return FALSE;
		}
	}
	/*

	


		$query = "SELECT distinct(vehiculo.tbl_publicaciones.id_publicacion),
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
				FROM vehiculo.tbl_publicaciones
				JOIN vehiculo.tbl_modelos ON tbl_modelos.id_modelo = tbl_publicaciones.id_modelo
				JOIN vehiculo.tbl_marcas ON tbl_marcas.id_marca = tbl_publicaciones.id_marca
				JOIN vehiculo.tbl_categorias ON tbl_categorias.id_categoria = tbl_publicaciones.id_categoria
				JOIN usuario.tbl_usuarios ON tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2
				JOIN ubicacion.tbl_estado ON tbl_publicaciones.codigoestado = tbl_estado.codigoestado
				JOIN ubicacion.tbl_municipio ON tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio
				JOIN ubicacion.tbl_parroquia ON tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia WHERE vehiculo.tbl_publicaciones.estatus in(1,5)  ";


//MENU LATERAL IZQUIERDO   

for ($i=0; $i < count($this->session->userdata('categoriamultiple')); $i++) {
	$query .= "vehiculo.tbl_publicaciones.id_categoria = ".$this->session->userdata('categoriamultiple')[$i];

	$cantidad = count($this->session->userdata('categoriamultiple'));
	if ( $cantidad  > 1 AND  ($i + 1) < $cantidad ) {
		$query .= " OR ";
	}
}

for ($i=0; $i < count($this->session->userdata('marcamultiple')); $i++) { 
	$query .= "vehiculo.tbl_publicaciones.id_marca = ".$this->session->userdata('marcamultiple')[$i];

	$cantidad = count($this->session->userdata('marcamultiple'));
	if ( $cantidad  > 1 AND  ($i + 1) < $cantidad ) {
		$query .= " OR ";
	}
}

for ($i=0; $i < count($this->session->userdata('ubicacionmultiple')); $i++) { 
	$query .= "vehiculo.tbl_publicaciones.codigoestado = ".$this->session->userdata('ubicacionmultiple')[$i];

	$cantidad = count($this->session->userdata('ubicacionmultiple'));
	if ( $cantidad  > 1 AND  ($i + 1) < $cantidad ) {
		$query .= " OR ";
	}
}

for ($i=0; $i < count($this->session->userdata('modelomultiple')); $i++) { 
	$query .= "vehiculo.tbl_publicaciones.id_modelo = ".$this->session->userdata('modelomultiple')[$i];

	$cantidad = count($this->session->userdata('modelomultiple'));
	if ( $cantidad  > 1 AND  ($i + 1) < $cantidad ) {
		$query .= " OR ";
	}
}
//MENU LATERAL IZQUIERDO   

		foreach ($arrayBuscar as $value) {
			$this->db->or_like('busqueda',$value);
		}
		//$this->db->where();
		if($this->session->userdata('categoria_menu')){

			$query .=" vehiculo.tbl_publicaciones.id_categoria = ".$this->session->userdata('categoria_menu');
		}
		if($this->session->userdata('marca_menu')){
			$query .=" vehiculo.tbl_publicaciones.id_marca = ".$this->session->userdata('marca_menu');
		}
		if($this->session->userdata('modelo_menu')){
			$query .=" vehiculo.tbl_publicaciones.id_modelo = ".$this->session->userdata('modelo_menu');
		}
		if($this->session->userdata('ano_menu')){
			$query .=" vehiculo.tbl_publicaciones.id_ano = ".$this->session->userdata('ano_menu');
		}					
		if($this->session->userdata('ubicacion_menu')){
			$query .=" vehiculo.tbl_publicaciones.codigoestado = ".$this->session->userdata('ubicacion_menu');
		}
 

		if($inicio !== FALSE && $cantidad!== FALSE){
			$this->db->limit($cantidad,$inicio);
		}

		$resultado = $this->db->query($query);

		if ($resultado->result() > 0) {
			return $resultado->result();
		}else{
			return FALSE;
		}
		*/

	public function matchPublicaciones()
	{
		$this->db->select('*');
		$this->db->from('vehiculo.tbl_publicaciones2');
		//$this->db->where('placa',$placa);
		//$this->db->where('estatus',1);

		$resultado = $this->db->get();

		//var_dump($resultado->result());
		$count = 0;
		foreach ($resultado->result() as $key => $publicacion) {
			echo $publicacion->codigo . ":";
			$this->db->select('*');
			$this->db->from('vehiculo.tbl_publicaciones');
			$this->db->where('codigo', $publicacion->codigo);

			$resultado2 = $this->db->get();
			echo $resultado2->num_rows() . "<br>";
			if ($resultado2->num_rows() > 0) {
				$count++;
				$this->db->where('codigo', $publicacion->codigo);
				$this->db->delete('vehiculo.tbl_publicaciones2');
			}
		}
		echo "La cantidad de registro en 'publicacion2' dentro de 'publicacion'es de: " . $count;
	}

	public function matchFilePublicaciones()
	{
		$this->db->select('*');
		$this->db->from('vehiculo.tbl_publicaciones');
		//$this->db->where('placa',$placa);
		//$this->db->where('estatus',1);

		$resultado = $this->db->get();

		//var_dump($resultado->result());
		$count = 0;
		$count2 = 0;
		foreach ($resultado->result() as $key => $publicacion) {

			$carpeta = getcwd() . '/publicaciones/' . $publicacion->codigo;
			if (file_exists($carpeta)) {
				$count++;
				$carpeta = base_url() . '/publicaciones/' . $publicacion->codigo;
				echo $carpeta."<br>";
			} else {
				$count2++;
			
				$carpeta = base_url() . '/publicaciones/' . $publicacion->codigo;
				echo "<a href='$carpeta'>$carpeta</a><br>";
				$this->db->where('codigo', $publicacion->codigo);
				$this->db->delete('vehiculo.tbl_publicaciones');
			}
		}
		echo "cantidad de carpetas que coincide con las publiaciones: " . $count . "<br>";
		echo "cantidad de carpetas sin registros " . $count2 . "<br>";
		echo "total registros: " . count($resultado->result());
	}
}
