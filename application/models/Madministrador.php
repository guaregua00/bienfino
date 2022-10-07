<?php

/**
 * 
 */
class Madministrador extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mpublicacion');
	}
	public function countUsuariosPublicacion()
	{

		$query = $this->db->query("
		SELECT count(*) as cantidad, tbl_usuarios.nombres|| ' ' || apellidos as Usuario 
		FROM usuario.tbl_usuarios 
		INNER JOIN vehiculo.tbl_publicaciones
		ON usuario.tbl_usuarios.id_usuario = vehiculo.tbl_publicaciones.id_usuario2
		group by Usuario
		order by cantidad DESC");

		if ($query->result() > 0)
			return $query->result();
		else
			return false;
	}


	public function registrarUsuarioCompleto($datos)
	{

		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);

		$datosuno['cedula'] = $datos['cedula'];
		$datosuno['nombres'] = $datos['nombres'];
		$datosuno['apellidos'] = $datos['apellidos'];
		$datosuno['email'] = $datos['email'];
		$datosuno['clave'] = $datos['clave'];
		$datosuno['verificado'] = $datos['verificado'];
		$datosuno['activo'] = $datos['activo'];
		$datosuno['id_grupo'] = $datos['id_grupo'];
		$datosuno['codigo_verificacion'] = $datos['codigo_verificacion'];
		$datosuno['completar'] = 1;
		$datosuno['perfil_adm'] = $this->session->userdata('id_adm');

		$this->db->insert('usuario.tbl_usuarios', $datosuno);

		$datos['id_usuario'] = $this->db->insert_id();

		if (!$this->db->affected_rows()>0) {
			$this->db->trans_rollback();
			return FALSE;
		}


		$datosdos['moviluno'] = $datos['moviluno'];
		if ($datos['movildos']!= "") {
            $datosdos['movildos'] = $datos['movildos'];
        }

		$datosdos['id_usuario2'] = $datos['id_usuario'];

		$this->db->insert('usuario.tbl_usuarios_vehiculo_telefonos', $datosdos);

		if (!$this->db->affected_rows()>0) {
			$this->db->trans_rollback();
			return FALSE;
		}


		$datostres['codigoestado'] = $datos['codigoestado'];
		$datostres['codigomunicipio'] = $datos['codigomunicipio'];
		$datostres['codigoparroquia'] = $datos['codigoparroquia'];
		$datostres['direccion_esp'] = $datos['direccion_esp'];
		$datostres['id_usuario2'] = $datos['id_usuario'];

		$this->db->insert('usuario.tbl_usuarios_vehiculo_geo', $datostres);

		if (!$this->db->affected_rows()>0) {
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

	public function cambiarcontrasena($datos){

		$this->db->trans_begin();
		
		$datos = $this->db->escape_str($datos);

		$this->db->where('id_usuario', $datos['id_usuario']);
		$this->db->update('usuario.tbl_usuarios', $datos);

		
		if (!$this->db->affected_rows()>0) {
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

	public function ordenarFotos($datos){

		$this->db->trans_begin();
		
		$datos = $this->db->escape_str($datos);

			$this->db->where('codigo', $datos['codigo']);
			$this->db->where('id_publicacion', $datos['id_publicacion']);
			$this->db->update('vehiculo.tbl_publicaciones', $datos);
			
		
		if (!$this->db->affected_rows()>0) {
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
	

	public function actualizarUsuarioCompleto($datos)
	{

		$this->db->trans_begin();
		
		$datosuno['cedula'] = $datos['cedula'];
		$datosuno['nombres'] = $datos['nombres'];
		$datosuno['apellidos'] = $datos['apellidos'];
		$datosuno['completar'] = 1;
		$datosuno['verificado'] = 1;
		$datosuno['perfil_adm'] = $this->session->userdata('id_adm');
		//$datosuno['email'] = $datos['email'];
		
		$this->db->where('email', $datos['email']);
		$this->db->where('id_usuario', $datos['id_usuario']);
		$this->db->update('usuario.tbl_usuarios', $datosuno);
	
		if (!$this->db->affected_rows()>0) {
			$this->db->trans_rollback();
			return FALSE;
		}
		
		$datosdos['moviluno'] = $datos['moviluno'];
		if (isset($datos['movildos']) && $datos['movildos']!= "") {
            $datosdos['movildos'] = $datos['movildos'];
        }
		
		if($this->getUsuarioTelefono($datos['id_usuario'])){
			$this->db->where('id_usuario2', $datos['id_usuario']);
			$this->db->update('usuario.tbl_usuarios_vehiculo_telefonos', $datosdos);
		}else{

			$datosdos['id_usuario2'] = $datos['id_usuario'];
			$this->db->insert('usuario.tbl_usuarios_vehiculo_telefonos', $datosdos);
		}
		
		if (!$this->db->affected_rows()>0) {
			$this->db->trans_rollback();
			return FALSE;
		}
		

		$datostres['codigoestado'] = $datos['codigoestado'];
		$datostres['codigomunicipio'] = $datos['codigomunicipio'];
		$datostres['codigoparroquia'] = $datos['codigoparroquia'];
		$datostres['direccion_esp'] = $datos['direccion_esp'];

		if($this->getUsuarioGeo($datos['id_usuario'])){
			$this->db->where('id_usuario2', $datos['id_usuario']);
			$this->db->update('usuario.tbl_usuarios_vehiculo_geo', $datostres);
		}else{
			$datostres['id_usuario2'] = $datos['id_usuario'];
			$this->db->insert('usuario.tbl_usuarios_vehiculo_geo', $datostres);
		}

		if (!$this->db->affected_rows()>0) {
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

	public function eliminarUsuarioDesactivar($datos){

		$this->db->trans_begin();

		$dato['activo'] = 2;

		$this->db->where('id_usuario', $datos['id_usuario']);
		$this->db->update('usuario.tbl_usuarios', $dato);

		if (!$this->db->affected_rows()>0) {
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

	public function activarUsuario($datos){

		$this->db->trans_begin();

		$dato['activo'] = 1;

		$this->db->where('id_usuario', $datos['id_usuario']);
		$this->db->update('usuario.tbl_usuarios', $dato);

		if (!$this->db->affected_rows()>0) {
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

	public function getUsuarioTelefono($id_usuario){

		$this->db->from('usuario.tbl_usuarios_vehiculo_telefonos');
		$this->db->where('id_usuario2',$id_usuario);
		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getUsuarioGeo($id_usuario){

		$this->db->from('usuario.tbl_usuarios_vehiculo_geo');
		$this->db->where('id_usuario2',$id_usuario);
		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public function cambiarEstatusPago($datos)
	{


		$data['id_pago_estatus'] = $datos['accion'];

		$this->db->trans_begin();

		if ($datos['accion'] == 3) {

			$dataP['estatus'] = 1;
			$this->db->where('id_publicacion', $datos['id_publicacion']);
			$this->db->update('vehiculo.tbl_publicaciones', $dataP);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}
		} elseif ($datos['accion'] == 4) {

			$dataP['estatus'] = 7;
			$this->db->where('id_publicacion', $datos['id_publicacion']);
			$this->db->update('vehiculo.tbl_publicaciones', $dataP);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}
		}

		$this->db->where('id_pago', $datos['id_pago']);
		$this->db->update('vehiculo.tbl_pagos', $data);

		if (!$this->db->affected_rows()>0) {
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

	public function getCantidadPagoPorEstatus()
	{
		$this->db->trans_begin();

		for ($i = 1; $i < 5; $i++) {
			$this->db->where('id_pago_estatus', $i);
			$this->db->from('vehiculo.tbl_pagos');
			$resultado[] = $this->db->count_all_results();
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $resultado;
		}
	}
	public function getStatusPublicacionActivos()
	{

		$this->db->order_by("activo", "ASC");
		$this->db->where('activo', '1');
		$resultado = $this->db->get('vehiculo.tbl_publicaciones_estatus');

		if ($resultado->num_rows() > 0) {
			return $resultado->result();
		} else {
			return FALSE;
		}
	}

	public function getMarcas($datos)
	{
		$this->db->order_by("id_marca", "ASC");
		$this->db->where('activo', $datos['activo']);
		$resultado = $this->db->get('vehiculo.tbl_marcas');

		if ($resultado->num_rows() > 0) {
			return $resultado->result();
		} else {
			return FALSE;
		}
	}

	public function getModelos($datos)
	{
		$this->db->order_by("vehiculo.tbl_modelos.id_modelo", "ASC");
		$this->db->where('vehiculo.tbl_modelos.activo', $datos['activo']);
		$this->db->join('vehiculo.tbl_marcas', 'vehiculo.tbl_marcas.id_marca = vehiculo.tbl_modelos.id_marca','LEFT');
		$resultado = $this->db->get('vehiculo.tbl_modelos');

		if ($resultado->num_rows() > 0) {
			return $resultado->result();
		} else {
			return FALSE;
		}
	}

	public function getCantidadPublicacionPorEstatus($estatus)
	{
		$this->db->trans_begin();

		$this->db->where('estatus', $estatus);
		$this->db->from('vehiculo.tbl_publicaciones');
		$resultado[] = $this->db->count_all_results();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $resultado;
		}
	}

	public function procesarAccionUsuario($datos)
	{

		$accion = $datos['accion'];
		$comentario_adm = $datos['comentario_adm'];
		$id_usuario2 = $datos['id_usuario'];

		$data = array(
			'comentario_adm' => $comentario_adm,
			'activo' => $accion
		);

		$this->db->trans_begin();

		$this->db->where('id_usuario2', $id_usuario2);
		$this->db->update('usuario.tbl_usuarios', $data);


		if ($datos['accion'] == 1) {
			$accion_mensaje = "Se cambia el estatus del usuario a Activo";
		} elseif ($datos['accion'] == 2) {
			$accion_mensaje = "Se cambia el estatus del usuario a Inactivo";
		}

		$datos2 = array(
			'accion' => $accion_mensaje,
			'id_usuario' => $id_usuario2,
			'id_adm' => $this->session->userdata('id_adm'),
		);

		$this->auditoriaUsuario($datos2);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function procesarAccionPago($datos)
	{

		$data['id_pago_estatus'] = $datos['accion'];
		$data['ultimo_comentario'] = $datos['comentario_adm'];
		$comentario_adm = $datos['comentario_adm'];
		$id_publicacion = $datos['id_publicacion'];
		$id_pago = $datos['id_pago'];

		$this->db->trans_begin();

		if ($datos['accion'] == 1) { //si se reversa todo este es el estatus inicial

			$dataP['estatus'] = 6;
			$dataP['comentario_adm'] = $datos['comentario_adm'];
			$this->db->where('id_publicacion', $datos['id_publicacion']);
			$this->db->update('vehiculo.tbl_publicaciones', $dataP);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}

			$operacion = 'REVERSADO Cambio de estatus pago a "Por verificar" y publicacion a "Verificando reporte pago"';
			$dataPagoHistorico = array(
				'comentario_adm' => $comentario_adm,
				'id_administrador' => $this->session->userdata('id_adm'),
				'operacion' => $operacion,
				'id_pago' => $id_pago,
				'id_publicacion' => $id_publicacion
			);
			$this->db->insert('vehiculo.tbl_pagos_historicos', $dataPagoHistorico);
		} elseif ($datos['accion'] == 2) {

			$dataP['estatus'] = 6;
			$dataP['comentario_adm'] = $datos['comentario_adm'];
			$this->db->where('id_publicacion', $datos['id_publicacion']);
			$this->db->update('vehiculo.tbl_publicaciones', $dataP);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}

			$operacion = 'Cambio de estatus pago a "Verificando" y publicacion a "Verificando reporte pago"';
			$dataPagoHistorico = array(
				'comentario_adm' => $comentario_adm,
				'id_administrador' => $this->session->userdata('id_adm'),
				'operacion' => $operacion,
				'id_pago' => $id_pago,
				'id_publicacion' => $id_publicacion
			);
			$this->db->insert('vehiculo.tbl_pagos_historicos', $dataPagoHistorico);
		} elseif ($datos['accion'] == 3) {

			$dataP['estatus'] = 1;
			$dataP['comentario_adm'] = $datos['comentario_adm'];
			$this->db->where('id_publicacion', $datos['id_publicacion']);
			$this->db->update('vehiculo.tbl_publicaciones', $dataP);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}

			$operacion = 'Cambio de estatus pago a "Consolidado" y publicacion a "Activo"';
			$dataPagoHistorico = array(
				'comentario_adm' => $comentario_adm,
				'id_administrador' => $this->session->userdata('id_adm'),
				'operacion' => $operacion,
				'id_pago' => $id_pago,
				'id_publicacion' => $id_publicacion
			);
			$this->db->insert('vehiculo.tbl_pagos_historicos', $dataPagoHistorico);
		} elseif ($datos['accion'] == 4) {

			$dataP['estatus'] = 7;
			$dataP['comentario_adm'] = $datos['comentario_adm'];
			$this->db->where('id_publicacion', $datos['id_publicacion']);
			$this->db->update('vehiculo.tbl_publicaciones', $dataP);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}

			$operacion = 'Cambio de estatus pago "Anulado" y publicacion a "Pago anulado"';
			$dataPagoHistorico = array(
				'comentario_adm' => $comentario_adm,
				'id_administrador' => $this->session->userdata('id_adm'),
				'operacion' => $operacion,
				'id_pago' => $id_pago,
				'id_publicacion' => $id_publicacion
			);
			$this->db->insert('vehiculo.tbl_pagos_historicos', $dataPagoHistorico);
		}

		$this->db->where('id_pago', $datos['id_pago']);
		$this->db->update('vehiculo.tbl_pagos', $data);

		if (!$this->db->affected_rows()>0) {
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

	public function getPagoXidPublicacion($datos)
	{

		$id_publicacion = $datos['id_publicacion'];

		$this->db->where("vehiculo.tbl_pagos.id_publicacion", $id_publicacion);
		$resultado = $this->db->get('vehiculo.tbl_pagos');

		if ($resultado->num_rows() > 0)
			return $resultado->row();
		else
			return false;
	}


	public function procesarAccionPublicacion($datos)
	{

		$data = array(
			/* 'comentario_adm' => $comentario_adm, */
			'estatus' => $datos['accion'],
			'fecha_inicio' => $datos['fecha_inicio'],
			'fecha_final' => $datos['fecha_final']
		);

		$this->db->trans_begin();

		$this->db->where('id_usuario2', $datos['id_usuario']);
		$this->db->where('codigo', $datos['codigo']);
		$this->db->where('id_publicacion', $datos['id_publicacion']);
		$this->db->update('vehiculo.tbl_publicaciones', $data);

		if (!$this->db->affected_rows()>0) {
			$this->db->trans_rollback();
			return FALSE;
		}

		if ($datos['accion'] == 1) {
			$accion_mensaje = "Se cambia el estatus de la publicación a 'Activo'";
		} elseif ($datos['accion'] == 6) {
			$accion_mensaje = "Se cambia el estatus a 'Por revisar'";
		} elseif ($datos['accion'] == 10) {
			$accion_mensaje = "Se cambia el estatus a 'Rechazado'";
		} elseif ($datos['accion'] == 11) {
			$accion_mensaje = "Se cambia el estatus a 'Verificando'";
		} elseif ($datos['accion'] == 5) {
			$accion_mensaje = "Se cambia el estatus a 'Vendido'";
		}

		/*
    Activo 1
    Por revisar 6
    Rechazado 10
    Verificado 11 
    Vendido 5
	*/

		$datos2 = array(
			'accion' => $accion_mensaje,
			'id_publicacion' => $datos['id_publicacion'],
			'id_adm' => $this->session->userdata('id_adm'),
		);


		$this->auditoriaPublicaciones($datos2);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function auditoriaPublicaciones($datos)
	{
		$this->db->insert('vehiculo.tbl_publicaciones_historicos', $datos);
	}


	public function auditoriaUsuario($datos)
	{
		$this->db->insert('vehiculo.tbl_usuarios_historicos', $datos);
	}

	public function ingresarUsuario($datos)
	{
		$datos = $this->db->escape_str($datos);
		$usuario = $datos['usuario'];

		$this->db->select('
		adm.usuario,
		adm.id_perfil, 
		adm.nombres,
		adm.apellidos,
		adm.cedula,
		adm.clave,
		adm.fecha_hora,
		adm.creado_id_adm,
		adm.id_adm,
		adm.activo,
		per.nombre as nombre_perfil,
		per.descripcion
		');
		$this->db->where('usuario', $this->db->escape_str($usuario));
		$this->db->where('activo', '1');
		$this->db->join('vehiculo.tbl_perfiles per', 'per.id_perfil = adm.id_perfil', 'left');
		$resultado = $this->db->get('vehiculo.tbl_administradores as adm');
		

		if ($resultado->result() > 0) {
			return $resultado->row();
		} else {
			return FALSE;
		}
	}

	public function getPagoHistoricoPagos()
	{
		$this->db->order_by("vehiculo.tbl_pagos_historicos.id_pagos_historico", "DESC");
		$this->db->join('vehiculo.tbl_administradores', 'vehiculo.tbl_administradores.id_adm = vehiculo.tbl_pagos_historicos.id_administrador');
		$resultado = $this->db->get('vehiculo.tbl_pagos_historicos');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function getPagoHistoricoUsuarios()
	{
		$this->db->order_by("vehiculo.tbl_usuarios_historicos.id_auditoria", "DESC");
		$this->db->join('vehiculo.tbl_administradores', 'vehiculo.tbl_administradores.id_adm = vehiculo.tbl_usuarios_historicos.id_adm');
		$resultado = $this->db->get('vehiculo.tbl_usuarios_historicos');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function getPagoHistoricoPublicaciones()
	{
		$this->db->order_by("vehiculo.tbl_publicaciones_historicos.id_auditoria", "DESC");
		$this->db->join('vehiculo.tbl_administradores', 'vehiculo.tbl_administradores.id_adm = vehiculo.tbl_publicaciones_historicos.id_adm');
		$resultado = $this->db->get('vehiculo.tbl_publicaciones_historicos');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function getUsuarios()
	{
		$this->db->order_by('usuario.tbl_usuarios.fecha_registro', 'DESC');
		$resultado = $this->db->get('usuario.tbl_usuarios');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

	public function getPubliciones($id_status)
	{

		$id_status = $this->db->escape_str($id_status);

		$this->db->select(' vehiculo.tbl_categorias.id_categoria,
								vehiculo.tbl_categorias.nombre as categoria, 
								vehiculo.tbl_marcas.marca, 
								vehiculo.tbl_modelos.modelo,
								usuario.tbl_usuarios.*,
								vehiculo.tbl_publicaciones.*,
								ubicacion.tbl_estado.nombre as nombre_estado,
								ubicacion.tbl_municipio.nombre as nombre_municipio,
								ubicacion.tbl_parroquia.nombre as nombre_parroquia,
								tbl_publicaciones_estatus.nombre as nombre_status
								');
		$this->db->join('vehiculo.tbl_modelos', 'tbl_modelos.id_modelo = tbl_publicaciones.id_modelo', 'left');
		$this->db->join('vehiculo.tbl_marcas', 'tbl_marcas.id_marca = tbl_publicaciones.id_marca', 'left');
		$this->db->join('vehiculo.tbl_categorias', 'tbl_categorias.id_categoria = tbl_publicaciones.id_categoria', 'left');
		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_publicaciones.id_usuario2', 'left');

		/* $this->db->join('usuario.tbl_usuarios_vehiculo_geo', 'tbl_usuarios_vehiculo_geo.id_usuario = tbl_publicaciones.id_usuario'); */
		$this->db->join('ubicacion.tbl_estado', 'tbl_publicaciones.codigoestado = tbl_estado.codigoestado', 'left');
		$this->db->join('ubicacion.tbl_municipio', 'tbl_publicaciones.codigomunicipio = tbl_municipio.codigomunicipio', 'left');
		$this->db->join('ubicacion.tbl_parroquia', 'tbl_publicaciones.codigoparroquia = tbl_parroquia.codigoparroquia', 'left');
		$this->db->join('vehiculo.tbl_publicaciones_estatus', 'tbl_publicaciones_estatus.id = tbl_publicaciones.estatus', 'left');

		$this->db->where('tbl_publicaciones.estatus', $id_status);
		$this->db->order_by('vehiculo.tbl_publicaciones.creado', 'DESC');
		$resultado = $this->db->get('vehiculo.tbl_publicaciones');

		if ($resultado->num_rows() > 0)
			return $resultado->result();
		else
			return false;
	}

/*Administrador*/
	public function listarUsuarioAdm($datos){
		$datos = $this->db->escape_str($datos);
		$sql = "
		SELECT 
		A.id_adm,
		A.nombres,
		A.apellidos,
		A.cedula,
		A.usuario,
		A.clave,
		A.fecha_hora,
		A.creado_id_adm,
		B.id_perfil,
		B.nombre AS perfil,
		B.descripcion,
		A.activo
		FROM vehiculo.tbl_administradores as A
		LEFT JOIN vehiculo.tbl_perfiles as B
		ON A.id_perfil = B.id_perfil ";
		if($datos){$sql .="where A.id_adm =".$datos['id_adm']." ";}
		$sql .="ORDER BY id_adm DESC";

		$query = $this->db->query($sql);

		if ($query->result() > 0)
			return $query->result();
		else
			return false;

	}
	
	public function listarPagosDirectorio(){
		$sql = "
		SELECT
		A.id_directorio_pago,
		B.id,
		B.nombre,
		B.fecha_inicio,
		B.fecha_final,
		A.banco_origen,
		A.banco_destino,
		A.referencia,
		A.monto,
		A.metodo_pago,
		A.id_directorio,
		A.fecha_creado,
		A.estatus,
		U.id_usuario, 
		U.cedula, 
		U.nombres, 
		U.apellidos, 
		U.email,
		U.verificado, 
		U.activo,
		U.fecha_registro
		FROM directorio.tbl_directorios_pagos AS A
		LEFT JOIN directorio.directorios AS B
		ON A.id_directorio = B.id
		LEFT JOIN usuario.tbl_usuarios AS U
		ON B.usuario_id = U.id_usuario
		ORDER BY id_directorio_pago DESC
					";

		$query = $this->db->query($sql);
		if ($query->result() > 0)
			return $query->result();
		else
			return false;

	}

	
	public function addPagoDirectorio($datos){
		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);
		$this->db->insert('directorio.tbl_directorios_pagos', $datos);

		if (!$this->db->affected_rows()>0) {
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


	public function verificarActivarDirectorio($datos){
		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);
		
		$dato['estatus']= 'verificado';

		$this->db->where('id_directorio_pago', $datos['id_directorio_pago']);
		$this->db->update('directorio.tbl_directorios_pagos', $dato);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}

		$dato2['estatus']= 'activo';
		$dato2['fecha_inicio'] = $datos['fecha_inicio'];
		$dato2['fecha_final'] = $datos['fecha_final'];

		$this->db->where('id', $datos['id']);
		$this->db->update('directorio.directorios', $dato2);

			if (!$this->db->affected_rows()>0) {
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

	public function reversarDesactivarDirectorio($datos){
		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);

		$dato['estatus']= 'reversado';

		$this->db->where('id_directorio_pago', $datos['id_directorio_pago']);
		$this->db->update('directorio.tbl_directorios_pagos', $dato);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}

		$dato2['estatus']= 'inactivo';

		$this->db->where('id', $datos['id']);
		$this->db->update('directorio.directorios', $dato2);

			if (!$this->db->affected_rows()>0) {
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
	
	public function desactivarDirectorioPeriodoTiempo($datos){
		$this->db->trans_begin();
		//$datos = $this->db->escape_str($datos);

			
		$this->db->where('id_directorio_pago', $datos->id_directorio_pago);
		$this->db->delete('directorio.tbl_directorios_pagos');

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}

		$dato2['estatus']= 'por renovar';
		$dato2['fecha_inicio']= null;
		$dato2['fecha_final']= null;

		$this->db->where('id', $datos->id);
		$this->db->update('directorio.directorios', $dato2);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
				return FALSE;
			}


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return $datos->id;
		}	
	}

    public function crearUsuarioAdm($datos){
		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);
		$this->db->insert('vehiculo.tbl_administradores', $datos);

		if (!$this->db->affected_rows()>0) {
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

    public function eliminarUsuarioAdm($datos){

		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);

		$dato['activo'] = 2;

		$this->db->where('id_adm', $datos['id_adm']);
		$this->db->update('vehiculo.tbl_administradores', $dato);

		if (!$this->db->affected_rows()>0) {
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

	public function activarUsuarioAdm($datos){

		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);
		$dato['activo'] = 1;

		$this->db->where('id_adm', $datos['id_adm']);
		$this->db->update('vehiculo.tbl_administradores', $dato);

		if (!$this->db->affected_rows()>0) {
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

    public function actualizarUsuarioAdm($datos){

		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);
		$this->db->where('id_adm', $datos['id_adm']);
		$this->db->update('vehiculo.tbl_administradores', $datos);

		
		if (!$this->db->affected_rows()>0) {
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

	public function verificarEmailAdm($usuario){
		$this->db->select('usuario');
		$this->db->from('vehiculo.tbl_administradores');
		$this->db->where('usuario',$usuario);
		
		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}	
	}

	public function getPerfilesAdm(){
		$sql = "
		SELECT 
		A.id_perfil,
		A.nombre,
		A.descripcion
		FROM vehiculo.tbl_perfiles as A
		ORDER BY id_perfil DESC ";

		$query = $this->db->query($sql);

		if ($query->result() > 0)
			return $query->result();
		else
			return false;
	}


	public function cambiarcontrasenaAdm($datos){

		$this->db->trans_begin();
		$datos = $this->db->escape_str($datos);
		$this->db->where('id_adm', $datos['id_adm']);
		$this->db->update('vehiculo.tbl_administradores', $datos);

		
		if (!$this->db->affected_rows()>0) {
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



/*Administrador*/



public function cron_errores($datos){
	$this->db->trans_begin();

	$this->db->insert('directorio.tbl_cron_errores', $datos);

	if (!$this->db->affected_rows()>0) {
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

public function getModelo($data)
{
	$id_marca = $data['id_marca'];
	
	$this->db->where('activo', 1);
	$this->db->where('id_marca', $id_marca);
	$this->db->order_by('modelo', 'ASC');
	$resultado = $this->db->get('vehiculo.tbl_modelos');

	if ($resultado->num_rows() > 0)
		return $resultado->result();
	else
		return false;
}

public function modificarPublicacion($datos){

	$this->db->trans_begin();
		
	$datos = $this->db->escape_str($datos);

	$this->db->where('id_usuario', $datos['id_usuario']);
	$this->db->where('codigo', $datos['codigo']);
	$this->db->where('id_publicacion', $datos['id_publicacion']);
	$this->db->update('vehiculo.tbl_publicaciones', $datos);

	
	if (!$this->db->affected_rows()>0) {
		$this->db->trans_rollback();
		return FALSE;
	}

		if (!$this->Mpublicacion->updateBusqueda($datos['codigo'])) {
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

}
