<?php class MDirectorio extends CI_Model {

	private $sep	= '/';
	private $limit	= 20;
	
	function __construct()
	{
		parent::__construct();
	}

	
	public function get( $string,$controlActivo=NULL,$mostrarPorResponsable=NULL ){ switch( $string ) {
		case 'directorio/index':

			$where = '';
			$select	= <<<NOWDOC
				d.estado_id		AS "estado_id",
				d.municipio_id	AS "municipio_id",
				d.parroquia_id	AS "parroquia_id",

				d.id					AS "ID",

				/*Delete Case*/
				CASE WHEN d.eliminado IS NULL THEN 'No'
				ELSE 'Si'
				END AS "Eliminado",

				d.nombre				AS "Nombre",
				d.nombre				AS "Nombre empresa",
				d.creado				AS "Fecha de Creación",
				d.modificado			AS "Última Módificación",

				CONCAT( 'id:', a.id_adm, ', ', a.usuario )
					AS "Creador Responsable",

				CONCAT( 'id:',u.id, ', ', u.nombres, ' ', u.apellidos, ' - ', u.email, ' - ', u.cedula )
					AS "Dueño del directorio",

				d.email					AS "Email de la empresa",
				d.contacto_1			AS "Teléfono de Contacto 1",
				d.contacto_2			AS "Teléfono de Contacto 2",
				d.contacto_3			AS "Teléfono de Contacto 3",
				d.whatsapp_1			AS "WhatsApp",
				d.whatsapp_2			AS "WhatsApp Business",
				d.coordenadas			AS "Coordenadas",
				d.rifj					AS "RIF-J",
				d.horario_trab_desde	AS "Horario de Trabajo Desde",
				d.horario_trab_hasta	AS "Horario de Trabajo Hasta",
				e.nombre				AS "Estado",
				m.nombre				AS "Municipio",
				p.nombre				AS "Parroquia",
				d.foro_local			AS "Foro Local",
				d.actividad_economica	AS "Actividad Económica",
				d.direccion_fisica		AS "Dirección Física",
				d.descripcion			AS "Descripción",
				d.otras_ciudades		AS "Otras Ciudades",
				d.consejos				AS "Consejos y Sugerencias",
				d.responsable_bf		AS "Responsable BienFino",
				d.comunidad				AS "Comunidad",
				d.posicionamiento		AS "Posicionamiento",
				d.facebook				AS "Facebook",
				d.instagram				AS "Instagram",
				d.twitter				AS "Twitter",
				d.mercadolibre			AS "MercadoLibre",
				d.infoguia				AS "InfoGuia",
				d.pagina_web			AS "Página WEB",
				d.sigueme				AS "Sigueme y te Sigo",
				d.nro_publicaciones		AS "Número de Publicaciones",
				d.nro_seguidores		AS "Número de Seguidores",
				d.nro_seguidos			AS "Número de Seguidos",
				d.logo					AS "Logo de la Empresa",
				d.gif					AS "GIF de la empresa",
				d.video_instagram		AS "Video Instagram",
				d.foto_comercio			AS "Foto Comercio",
				d.foto_grupal			AS "Foto Grupal",
				d.foto_instagram		AS "Foto Instagram",
				d.estatus         		AS "estatus",
				d.fecha_inicio			AS "fecha_inicio",
				d.fecha_final			AS "fecha_final",

				/*Booleans Si/No/Null*/
				CASE d.concesionario
					WHEN 't' THEN 'Si'
					WHEN 'f' THEN 'No'
					ELSE NULL
				END AS "¿Es Concesionario?",

				/*Booleans Si/No/Null*/
				CASE d.prestador_servicio
					WHEN 't' THEN 'Si'
					WHEN 'f' THEN 'No'
					ELSE NULL
				END	AS "¿Es Prestador de Servicio?",

				/*Booleans Si/No/Null*/
				CASE d.respuesto
					WHEN 't' THEN 'Si'
					WHEN 'f' THEN 'No'
					ELSE NULL
				END AS "¿Es Vendedor de Repuestos?",

				/*ONE MANY INLINE*/
				(
					SELECT	STRING_AGG( ds.nombre, ' {$this->sep} '  )
					FROM	directorio.directorios_servicios	AS ds
					WHERE	ds.directorio_id = d.id
				) AS "Servicios",
				(
					SELECT	STRING_AGG( ds.nombre, ' {$this->sep} '  )
					FROM	directorio.directorios_servicios	AS ds
					WHERE	ds.directorio_id	= d.id
					AND		ds.promocion		IS NOT NULL
				) AS "Servicios en Promoción",

				/*ONE MANY INLINE*/
				(
					SELECT	STRING_AGG( dp.nombre, ' {$this->sep} '  )
					FROM	directorio.directorios_productos	AS dp
					WHERE	dp.directorio_id = d.id
				) AS "Productos",
				(
					SELECT	STRING_AGG( dp.nombre, ' {$this->sep} '  )
					FROM	directorio.directorios_productos	AS dp
					WHERE	dp.directorio_id	= d.id
					AND		dp.promocion		IS NOT NULL
				) AS "Productos en Promoción",

				/*MANY MANY INLINE*/
				(
					SELECT	STRING_AGG( c.nombre, ' {$this->sep} '  )
					FROM	directorio.directorios_categorias	AS dc
					JOIN	directorio.categorias				AS c	ON c.id = dc.categoria_id
					WHERE	dc.directorio_id	= d.id
				) AS "Categorias",

				/*MANY MANY INLINE*/
				(
					SELECT	STRING_AGG( m.nombre, ' {$this->sep} '  )
					FROM	directorio.directorios_marcas	AS dm
					JOIN	directorio.marcas				AS m	ON m.id = dm.marca_id
					WHERE	dm.directorio_id	= d.id
				) AS "Marcas",

				/*MANY MANY INLINE*/
				(
					SELECT	STRING_AGG( mp.nombre, ' {$this->sep} '  )
					FROM	directorio.directorios_metodos_pago	AS dmp
					JOIN	directorio.metodos_pago				AS mp	ON mp.id = dmp.metodo_pago_id
					WHERE	dmp.directorio_id	= d.id
				) AS "Métodos de Pago",

				/*MANY MANY INLINE*/
				(
					SELECT	STRING_AGG( pbf.nombre, ' {$this->sep} '  )
					FROM	directorio.directorios_preguntas_bf	AS dpbf
					JOIN	directorio.preguntas_bf				AS pbf	ON pbf.id = dpbf.pregunta_bf_id
					WHERE	dpbf.directorio_id	= d.id
				) AS "Preguntas BienFino",

				/*MANY MANY INLINE*/
				(
					SELECT	
					dipa.metodo_pago || ' monto:' || dipa.monto
					FROM	directorio.tbl_directorios_pagos AS dipa
					WHERE	dipa.id_directorio = d.id limit 1
				) AS "pago",

				/*MANY MANY INLINE*/
				(
					SELECT	fecha_creado
					FROM	directorio.tbl_directorios_pagos AS dipa
					WHERE	dipa.id_directorio = d.id limit 1
				) AS "fecha_creado",

				d.respuestas_bf			AS "Respuestas BienFino"
			NOWDOC; 
						
			#extract_select( $select, null, 1 );
			/*Filters*/
				/*
					if(		$_GET['eliminado'] === 'Si' )	$_GET['es_eliminado']	= 1;
					elseif(	$_GET['eliminado'] === 'No' )	$_GET['no_eliminado']	= 1;
					else									unset( $_GET['es_eliminado'], $_GET['no_eliminado'] );
					$where = create_new_filter( $where, 'es_eliminado',		'raw:isnotnull',	'd.eliminado'							);
					$where = create_new_filter( $where, 'no_eliminado',		'raw:isnull',		'd.eliminado'							);
				*/
				#$where = create_new_filter( $where, 'between_id',		'int8:between',		extract_select( $select, 'ID' )			);
				 /* $where = create_new_filter( $where, 'estado_id',	'int8:between',		extract_select( $select, 'estado_id' )		); */
				$where = create_new_filter2( $where, 'buscador',			'varchar:like',		complex_select( $select, ', ', array(
					'Nombre',
					'Categorias',
					'Marcas',
					'Servicios',
					'Productos',
				))
				
			
			);
			//$where = $where." AND WHERE directorio.directorios.estado_id='1' ";
			//echo $where;exit;
			//and WHERE	directorio.estado_id = {$this->session->userdata('codigoestado_directorio')};
				#ddt( $where );
			/**/
			$body = <<<NOWDOC
				SELECT
					[select]
				FROM		directorio.directorios	AS d
				LEFT JOIN	ubicacion.tbl_estado		AS e	ON e.id = d.estado_id
				LEFT JOIN	ubicacion.tbl_municipio		AS m	ON m.id = d.municipio_id
				LEFT JOIN	ubicacion.tbl_parroquia		AS p	ON p.id = d.parroquia_id
				/* LEFT JOIN	usuario.tbl_usuarios		AS r	ON r.id = d.responsable_id */
				LEFT JOIN	usuario.tbl_usuarios		AS u	ON u.id = d.usuario_id
				LEFT JOIN	vehiculo.tbl_administradores AS a	ON a.id_adm = d.responsable_id
				/* LEFT JOIN	directorio.tbl_directorios_pagos AS pa	ON pa.id_directorio = d.id */

				{$where}
				
		NOWDOC;
			$extra = <<<'NOWDOC'
				ORDER BY	d.id DESC
		
		NOWDOC;
			/*romel*/

			if($controlActivo){
				if($where=="")
					$body = $body." where d.estatus ='activo'";
				else
					$body = $body." and d.estatus ='activo'";
			}

			if($this->session->userdata('codigoestado_directorio')){
				$id=$this->session->userdata('codigoestado_directorio');
				$body = $body." and d.estado_id = '".$id."'";
			}

			if($this->session->userdata('id')){
				$id=$this->session->userdata('id');
				$body = $body." and d.id = '".$id."'";
				$this->session->unset_userdata('id');
			}
			//Se el directorio por responsable execto (administrador id = 1) y (Directorios y Pagos id = 4)	
			if($mostrarPorResponsable){

				switch ($this->session->userdata('id_perfil')) {
					case '1':
						break;
	
					case '2':
						$responsable_id = $this->session->userdata('id_adm');
						$body = $body." where d.responsable_id = $responsable_id";
						break;
	
					case '3':
						$responsable_id = $this->session->userdata('id_adm');
						$body = $body." where d.responsable_id = $responsable_id";
						break;
	
					case '4':
						break;	
	
					default:
						$responsable_id = $this->session->userdata('id_adm');
						$body = $body." where d.responsable_id = $responsable_id";
						break;
				}

			}



			/*romel*/
			//echo $select;exit;
			//echo $body;exit;
			//var_dump($this->limit);exit;
			return totable( $select, $body, $extra, $this->limit , null );
		break;
	}}

	public function insert( $string ){ switch( $string ) {

		case 'directorio/insert':
			#printrt( 'STOP' );

			if( $_SERVER['REQUEST_METHOD'] !== 'POST' )
				show_404();
			$_POST = clean_spaces( $_POST );

			$error = validate_file( array(
				'gif'				=> '|max:10mb|mime:jpg,png,gif|',
				'logo'				=> '|max:10mb|mime:jpg,png,gif|',
				'banner'		    => '|max:10mb|mime:jpg,png,gif|',
				'foto_instagram'	=> '|max:10mb|mime:jpg,png,gif|',
				'foto_comercio'		=> '|max:10mb|mime:jpg,png,gif|',
				'foto_grupal'		=> '|max:10mb|mime:jpg,png,gif|',
			));
			if( $error !== array() )
				return_errors( $error );

			$error = validate_post( array(
				'nombre'					=> '|required|not_exist_in:varchar,directorio.directorios,nombre|',
				'email'						=> '|required|email|',
				'contacto_1'				=> '|required|telefono|',
				'contacto_2'				=> '|telefono|',
				'contacto_3'				=> '|telefono|',
				'whatsapp_1'				=> '|required|telefono|',
				'whatsapp_2'				=> '|required|telefono|',
				'coordenadas'				=> '|required|',
				'rifj'						=> '|required|rifj|',
				'horario_trab_desde'		=> '|required|time|',
				'horario_trab_hasta'		=> '|required|time|',
				'estado_id'					=> '|required|exist_in:int8,ubicacion.tbl_estado,id|',
				'municipio_id'				=> '|required|exist_in:int8,ubicacion.tbl_municipio,id|',
				'parroquia_id'				=> '|required|exist_in:int8,ubicacion.tbl_parroquia,id|',
				'foro_local'				=> '|required|num_between:1-100|',
				#'actividad_economica'		=> '||',
				'direccion_fisica'			=> '|required|',
				'descripcion'				=> '|required|',
				#'otras_ciudades'			=> '||',
				'concesionario'				=> '|exact:Si|',
				'prestador_servicio'		=> '|exact:Si|',
				'respuesto'					=> '|exact:Si|',
				#'monto'						=> '|required|',
				#'metodo-pago'				=> '|required|',
				'responsable_id'			=> '|required|',
				'usuario_id'			 	=> '|required|',
				#'consejos'					=> '||',
				#'respuestas_bf'			=> '||',
				#'responsable_bf'			=> '||',
				#'comunidad'				=> '||',
				#'posicionamiento'			=> '||',
				#'facebook'					=> '||',
				#'instagram'				=> '||',
				#'twitter'					=> '||',
				#'mercadolibre'				=> '||',
				#'infoguia'					=> '||',
				#'pagina_web'				=> '||',
				#'sigueme'					=> '||',
				'nro_publicaciones'			=> '|numbers|',
				'nro_seguidores'			=> '|numbers|',
				'nro_seguidos'				=> '|numbers|'
			));
			if( $error !== array() )
				return_errors( $error );

			$pdo = sql_pdo();
			$sql = '
				INSERT INTO directorio.directorios(
					creado,

					responsable_id,
					nombre,
					usuario_id,
					email,

					contacto_1,
					contacto_2,
					contacto_3,
					whatsapp_1,
					whatsapp_2,

					coordenadas,
					rifj,
					horario_trab_desde,
					horario_trab_hasta,

					estado_id,
					municipio_id,
					parroquia_id,

					foro_local,
					actividad_economica,
					direccion_fisica,
					descripcion,
					otras_ciudades,

					concesionario,
					prestador_servicio,
					respuesto,

					consejos,
					respuestas_bf,
					responsable_bf,
					comunidad,

					posicionamiento,
					facebook,
					instagram,
					twitter,
					mercadolibre,
					infoguia,
					pagina_web,
					sigueme,

					nro_publicaciones,
					nro_seguidores,
					nro_seguidos
				)VALUES(
					NOW(),

					'.sql_int8( $_SESSION['data']['responsable_id'] ).',
					'.sql_varchar( $_POST['nombre'] ).',
					'.sql_int8( $_SESSION['data']['usuario_id'] ).',
					'.sql_varchar( $_POST['email'] ).',

					'.sql_varchar( $_POST['contacto_1'] ).',
					'.sql_varchar( $_POST['contacto_2'] ).',
					'.sql_varchar( $_POST['contacto_3'] ).',
					'.sql_varchar( $_POST['whatsapp_1'] ).',
					'.sql_varchar( $_POST['whatsapp_2'] ).',

					'.sql_varchar( $_POST['coordenadas'] ).',
					'.sql_varchar( $_POST['rifj'] ).',
					'.sql_time( $_POST['horario_trab_desde'] ).',
					'.sql_time( $_POST['horario_trab_hasta'] ).',

					'.sql_int8( $_POST['estado_id'] ).',
					'.sql_int8( $_POST['municipio_id'] ).',
					'.sql_int8( $_POST['parroquia_id'] ).',

					'.sql_int( $_POST['foro_local'] ).',
					'.sql_varchar( $_POST['actividad_economica'] ).',
					'.sql_varchar( $_POST['direccion_fisica'] ).',
					'.sql_varchar( $_POST['descripcion'] ).',
					'.sql_varchar( $_POST['otras_ciudades'] ).',

					'.sql_bol( $_POST['concesionario'] ).',
					'.sql_bol( $_POST['prestador_servicio'] ).',
					'.sql_bol( $_POST['respuesto'] ).',

					'.sql_varchar( $_POST['consejos'] ).',
					'.sql_varchar( $_POST['respuestas_bf'] ).',
					'.sql_varchar( $_POST['responsable_bf'] ).',
					'.sql_varchar( $_POST['comunidad'] ).',

					'.sql_varchar( $_POST['posicionamiento'] ).',
					'.sql_varchar( $_POST['facebook'] ).',
					'.sql_varchar( $_POST['instagram'] ).',
					'.sql_varchar( $_POST['twitter'] ).',
					'.sql_varchar( $_POST['mercadolibre'] ).',
					'.sql_varchar( $_POST['infoguia'] ).',
					'.sql_varchar( $_POST['pagina_web'] ).',
					'.sql_varchar( $_POST['sigueme'] ).',

					'.sql_int8( $_POST['nro_publicaciones'] ).',
					'.sql_int8( $_POST['nro_seguidores'] ).',
					'.sql_int8( $_POST['nro_seguidos'] ).'
				)
				ON CONFLICT DO NOTHING
				RETURNING id;
			';
			$directorio_id = 0;
			try{ $directorio_id = $pdo->query( $sql )->fetchColumn(); }catch( Exception $e ) { ddt( $e ); }
			if( $directorio_id === 0 )
				end_alert('<b>Falla al insertar, insert no devolvió ID de directorio.</b>');

			$sql = null;
			/*ONE TO MANY - Update tbl_directorios_pagos*/

			/* 
			monto
			banco-origen
			banco-destino
			metodo-pago
			referencia
			tbl_directorios_pagos
			*/

			if( !is_empty( $_POST['metodo-pago'] ) and !is_empty( $_POST['monto'] )){
				$_POST = $this->db->escape_str($_POST);
				if( $_POST['metodo-pago']!='Ninguno' ){
					$sql .= "
					INSERT INTO directorio.tbl_directorios_pagos ( banco_origen, banco_destino, referencia, metodo_pago, monto, id_directorio, estatus ) 
					VALUES( '".$_POST['banco-origen']."', '".$_POST['banco-destino']."', '".$_POST['referencia']."', '".$_POST['metodo-pago']."', '".$_POST['monto']."', ".$directorio_id.", 'sin verificar') ON CONFLICT DO NOTHING;";
				}
			}

			/**/

			/*ONE TO MANY - Update directorios_servicios*/
				if( !is_empty( $_POST['directorios_servicios'] ) )
					$sql .= "
						/*directorios_servicios*/
						INSERT INTO directorio.directorios_servicios( nombre, directorio_id )
						".sql_ghost_col( $_POST['directorios_servicios'], $this->sep, $directorio_id )."
						ON CONFLICT DO NOTHING;
					";
				if( !is_empty( $_POST['directorios_servicios_promocion'] ) )
					$sql .= "
						/*directorios_servicios_promocion*/
						INSERT INTO directorio.directorios_servicios( nombre, directorio_id, promocion )
						".sql_ghost_col( $_POST['directorios_servicios_promocion'], $this->sep, "{$directorio_id}, 't'" )."
						ON CONFLICT ( nombre, directorio_id ) DO UPDATE
						SET	promocion = 't';
					";
			/**/
			/*ONE TO MANY - Update directorios_productos*/
				if( !is_empty( $_POST['directorios_productos'] ) )
					$sql .= "
						/*directorios_productos*/
						INSERT INTO directorio.directorios_productos( nombre, directorio_id )
						".sql_ghost_col( $_POST['directorios_productos'], $this->sep, $directorio_id )."
						ON CONFLICT DO NOTHING;
					";
				if( !is_empty( $_POST['directorios_productos_promocion'] ) )
					$sql .= "
						/*directorios_productos_promocion*/
						INSERT INTO directorio.directorios_productos( nombre, directorio_id, promocion )
						".sql_ghost_col( $_POST['directorios_productos_promocion'], $this->sep, "{$directorio_id}, 't'" )."
						ON CONFLICT ( nombre, directorio_id ) DO UPDATE
						SET	promocion = 't';
					";
			/**/
			/*MANY TO MANOY - Update categorias*/
				if( !is_empty( $_POST['categorias'] ) ){
					$ghost_col	= sql_ghost_col( $_POST['categorias'], $this->sep );
					$sql		.= <<<NOWDOC
						/*categorias*/
						INSERT	INTO directorio.categorias( nombre ) {$ghost_col}
						ON		CONFLICT DO NOTHING;

						/*directorios_categorias*/
						INSERT	INTO directorio.directorios_categorias( directorio_id, categoria_id )
						SELECT	{$directorio_id}, id
						FROM	directorio.categorias
						WHERE	nombre IN ( {$ghost_col} )
						ON		CONFLICT DO NOTHING;
NOWDOC;
				}
			/**/
			/*MANY TO MANOY - Update metodos_pago*/
				if( !is_empty( $_POST['metodos_pago'] ) ){
					$ghost_col	= sql_ghost_col( $_POST['metodos_pago'], $this->sep );
					$sql		.= <<<NOWDOC
						/*metodos_pago*/
						INSERT	INTO directorio.metodos_pago( nombre ) {$ghost_col}
						ON		CONFLICT DO NOTHING;

						/*directorios_metodos_pago*/
						INSERT	INTO directorio.directorios_metodos_pago( directorio_id, metodo_pago_id )
						SELECT	{$directorio_id}, id
						FROM	directorio.metodos_pago
						WHERE	nombre IN ( {$ghost_col} )
						ON		CONFLICT DO NOTHING;
NOWDOC;
				}
			/**/
			/*MANY TO MANOY - Update marcas*/
				if( !is_empty( $_POST['marcas'] ) ){
					$ghost_col	= sql_ghost_col( $_POST['marcas'], $this->sep );
					$sql		.= <<<NOWDOC
						/*marcas*/
						INSERT	INTO directorio.marcas( nombre ) {$ghost_col}
						ON		CONFLICT DO NOTHING;

						/*directorios_marcas*/
						INSERT	INTO directorio.directorios_marcas( directorio_id, marca_id )
						SELECT	{$directorio_id}, id
						FROM	directorio.marcas
						WHERE	nombre IN ( {$ghost_col} )
						ON		CONFLICT DO NOTHING;
NOWDOC;
				}
			/**/
			/*MANY TO MANOY - Update preguntas_bf*/
				if( !is_empty( $_POST['preguntas_bf'] ) ){
					$ghost_col	= sql_ghost_col( $_POST['preguntas_bf'], $this->sep );
					$sql		.= <<<NOWDOC
						/*preguntas_bf*/
						INSERT	INTO directorio.preguntas_bf( nombre ) {$ghost_col}
						ON		CONFLICT DO NOTHING;

						/*directorios_preguntas_bf*/
						INSERT	INTO directorio.directorios_preguntas_bf( directorio_id, pregunta_bf_id )
						SELECT	{$directorio_id}, id
						FROM	directorio.preguntas_bf
						WHERE	nombre IN ( {$ghost_col} )
						ON		CONFLICT DO NOTHING;
NOWDOC;
				}
			/**/
			try{
				$pdo->beginTransaction();
				foreach( clean_spaces( explode(';', $sql ) ) AS $sql ) $pdo->query( $sql );
				$pdo->commit();
			}catch( Exception $e ){ ddt( $e ); $pdo->rollBack();}


			/*Store Files*/
				create_folder_path( root_folder."/storage/directorios/{$directorio_id}/file.ext" );
				foreach( $_FILES AS $name => $file ){
					$ext = get_ext_by_path( $file['type'] );
					move_uploaded_file( $file['tmp_name'], root_folder."/storage/directorios/{$directorio_id}/{$name}{$ext}" );
				}
			/**/

			return $directorio_id;
		break;
	}}

	public function update( $string ){ switch( $string ) {
		case 'directorio/update':
			#printrt( 'STOP' );

			if( $_SERVER['REQUEST_METHOD'] !== 'POST' )
				show_404();
			$_POST = clean_spaces( $_POST );

			$error = validate_file( array(
				'gif'				=> '|max:10mb|mime:jpg,png,gif|',
				'logo'				=> '|max:10mb|mime:jpg,png,gif|',
				'foto_instagram'	=> '|max:10mb|mime:jpg,png,gif|',
				'foto_comercio'		=> '|max:10mb|mime:jpg,png,gif|',
				'foto_grupal'		=> '|max:10mb|mime:jpg,png,gif|',
			));
			if( $error !== array() )
				return_errors( $error );

			$error = validate_post( array(
				'id'						=> '|required|exist_in:int8,directorio.directorios,id|',
				'email'						=> '|required|email|',
				'nombre'					=> '|required|',
				'contacto_1'				=> '|required|telefono|',
				'contacto_2'				=> '|telefono|',
				'contacto_3'				=> '|telefono|',
				'whatsapp_1'				=> '|required|telefono|',
				'whatsapp_2'				=> '|required|telefono|',
				'coordenadas'				=> '|required|',
				'rifj'						=> '|required|rifj|',
				'horario_trab_desde'		=> '|required|time|',
				'horario_trab_hasta'		=> '|required|time|',
				'estado_id'					=> '|required|exist_in:int8,ubicacion.tbl_estado,id|',
				'municipio_id'				=> '|required|exist_in:int8,ubicacion.tbl_municipio,id|',
				'parroquia_id'				=> '|required|exist_in:int8,ubicacion.tbl_parroquia,id|',
				'foro_local'				=> '|required|num_between:1-100|',
				#'actividad_economica'		=> '||',
				'direccion_fisica'			=> '|required|',
				'descripcion'				=> '|required|',
				#'otras_ciudades'			=> '||',
				'concesionario'				=> '|exact:Si|',
				'prestador_servicio'		=> '|exact:Si|',
				'respuesto'					=> '|exact:Si|',
				#'responsable_id'			=> '|required|',
				#'usuario_id'			 	=> '|required|',
				#'consejos'					=> '||',
				#'respuestas_bf'			=> '||',
				#'responsable_bf'			=> '||',
				#'comunidad'				=> '||',
				#'posicionamiento'			=> '||',
				#'facebook'					=> '||',
				#'instagram'				=> '||',
				#'twitter'					=> '||',
				#'mercadolibre'				=> '||',
				#'infoguia'					=> '||',
				#'pagina_web'				=> '||',
				#'sigueme'					=> '||',
				'nro_publicaciones'			=> '|numbers|',
				'nro_seguidores'			=> '|numbers|',
				'nro_seguidos'				=> '|numbers|'
			));
			if( $error !== array() )
				return_errors( $error );

			$_POST['id']		= sql_int8( $_POST['id'] );
			$_POST['nombre']	= sql_varchar( $_POST['nombre'] );

			$check = sql_pdo()
				->query(<<<NOWDOC
					SELECT	1
					FROM	directorio.directorios
					WHERE	nombre	= {$_POST['nombre']}
					AND		id		<> {$_POST['id']}
NOWDOC)
				->fetchColumn()
			;
			if( $check )
				return_error('nombre = <b>Este nombre ya se encuentra en uso por otro item</b>');

			$sql = "
				UPDATE directorio.directorios
				SET
					email					= ".sql_varchar( $_POST['email'] ).",
					nombre					= {$_POST['nombre']},
					contacto_1				= ".sql_varchar( $_POST['contacto_1'] ).",
					contacto_2				= ".sql_varchar( $_POST['contacto_2'] ).",
					contacto_3				= ".sql_varchar( $_POST['contacto_3'] ).",
					whatsapp_1				= ".sql_varchar( $_POST['whatsapp_1'] ).",
					whatsapp_2				= ".sql_varchar( $_POST['whatsapp_2'] ).",
					coordenadas				= ".sql_varchar( $_POST['coordenadas'] ).",
					rifj					= ".sql_varchar( $_POST['rifj'] ).",
					horario_trab_desde		= ".sql_time( $_POST['horario_trab_desde'] ).",
					horario_trab_hasta		= ".sql_time( $_POST['horario_trab_hasta'] ).",
					estado_id				= ".sql_int8( $_POST['estado_id'] ).",
					municipio_id			= ".sql_int8( $_POST['municipio_id'] ).",
					parroquia_id			= ".sql_int8( $_POST['parroquia_id'] ).",
					foro_local				= ".sql_int( $_POST['foro_local'] ).",
					actividad_economica		= ".sql_varchar( $_POST['actividad_economica'] ).",
					direccion_fisica		= ".sql_varchar( $_POST['direccion_fisica'] ).",
					descripcion				= ".sql_varchar( $_POST['descripcion'] ).",
					otras_ciudades			= ".sql_varchar( $_POST['otras_ciudades'] ).",
					concesionario			= ".sql_bol( $_POST['concesionario'] ).",
					prestador_servicio		= ".sql_bol( $_POST['prestador_servicio'] ).",
					respuesto				= ".sql_bol( $_POST['respuesto'] ).",
					consejos				= ".sql_varchar( $_POST['consejos'] ).",
					respuestas_bf			= ".sql_varchar( $_POST['respuestas_bf'] ).",
					responsable_bf			= ".sql_varchar( $_POST['responsable_bf'] ).",
					comunidad				= ".sql_varchar( $_POST['comunidad'] ).",
					posicionamiento			= ".sql_varchar( $_POST['posicionamiento'] ).",
					facebook				= ".sql_varchar( $_POST['facebook'] ).",
					instagram				= ".sql_varchar( $_POST['instagram'] ).",
					twitter					= ".sql_varchar( $_POST['twitter'] ).",
					mercadolibre			= ".sql_varchar( $_POST['mercadolibre'] ).",
					infoguia				= ".sql_varchar( $_POST['infoguia'] ).",
					pagina_web				= ".sql_varchar( $_POST['pagina_web'] ).",
					sigueme					= ".sql_varchar( $_POST['sigueme'] ).",
					nro_publicaciones		= ".sql_int8( $_POST['nro_publicaciones'] ).",
					nro_seguidores			= ".sql_int8( $_POST['nro_seguidores'] ).",
					nro_seguidos			= ".sql_int8( $_POST['nro_seguidos'] )."
				WHERE
					id = {$_POST['id']}
				;
			";
			
/* 			$id_directorio = $_POST['id'];
			
			$_POST['id']		= sql_int8( $_POST['id'] );
			$_POST['nombre']	= sql_varchar( $_POST['nombre'] );

			$check = sql_pdo()
				->query(<<<NOWDOC
					SELECT	1
					FROM	directorio.tbl_directorios_pagos
					WHERE	id_directorio	= {$_POST['id']}
			NOWDOC)
				->fetchColumn();

				var_dump($check); */
/* 			if( $check )
				return_error('nombre = <b>Directorio ya tiene un pago asociado</b>');

			if( !is_empty( $_POST['metodo-pago'] ) and !is_empty( $_POST['monto'] )){
				$_POST = $this->db->escape_str($_POST);
				if( $_POST['metodo-pago']!='Ninguno' ){
					$sql .= "
					INSERT INTO directorio.tbl_directorios_pagos ( banco_origen, banco_destino, referencia, metodo_pago, monto, id_directorio, estatus ) 
					VALUES( '".$_POST['banco-origen']."', '".$_POST['banco-destino']."', '".$_POST['referencia']."', '".$_POST['metodo-pago']."', '".$_POST['monto']."', ".$id_directorio.", 'sin verificar') ON CONFLICT DO NOTHING;";
				}
			} */


			/*ONE TO MANY - Update directorios_servicios*/
				if( !is_empty( $_POST['directorios_servicios'] ) ){
					$sql .= "
						/*directorios_servicios*/
						INSERT INTO directorio.directorios_servicios( nombre, directorio_id )
						".sql_ghost_col( $_POST['directorios_servicios'], $this->sep, $_POST['id'] )."
						ON CONFLICT DO NOTHING;

						/*UPDATE directorios_servicios*/
						DELETE
						FROM	directorio.directorios_servicios
						WHERE	directorio_id = {$_POST['id']}
						AND		nombre NOT IN( ".sql_ghost_col( $_POST['directorios_servicios'], $this->sep )." );
					";
				}
				if( !is_empty( $_POST['directorios_servicios_promocion'] ) ){
					$sql .= "
						/*directorios_servicios_promocion*/
						INSERT INTO directorio.directorios_servicios( nombre, directorio_id, promocion )
						".sql_ghost_col( $_POST['directorios_servicios_promocion'], $this->sep, "{$_POST['id']}, 't'" )."
						ON CONFLICT ( nombre, directorio_id ) DO UPDATE
						SET	promocion = 't';

						/*UPDATE directorios_servicios_promocion*/
						UPDATE	directorio.directorios_servicios
						SET		promocion = NULL
						WHERE	directorio_id = {$_POST['id']}
						AND		nombre NOT IN( ".sql_ghost_col( $_POST['directorios_servicios_promocion'], $this->sep )." );
					";
				}
			/**/
			/*ONE TO MANY - Update directorios_productos*/
				if( !is_empty( $_POST['directorios_productos'] ) )
					$sql .= "
						/*directorios_productos*/
						INSERT INTO directorio.directorios_productos( nombre, directorio_id )
						".sql_ghost_col( $_POST['directorios_productos'], $this->sep, $_POST['id'])."
						ON CONFLICT DO NOTHING;

						/*UPDATE directorios_productos*/
						DELETE
						FROM	directorio.directorios_productos
						WHERE	directorio_id = {$_POST['id']}
						AND		nombre NOT IN( ".sql_ghost_col( $_POST['directorios_productos'], $this->sep )." );
					";
				if( !is_empty( $_POST['directorios_productos_promocion'] ) )
					$sql .= "
						/*directorios_productos_promocion*/
						INSERT INTO directorio.directorios_productos( nombre, directorio_id, promocion )
						".sql_ghost_col( $_POST['directorios_productos_promocion'], $this->sep, "{$_POST['id']}, 't'" )."
						ON CONFLICT ( nombre, directorio_id ) DO UPDATE
						SET	promocion = 't';

						/*UPDATE directorios_productos_promocion*/
						UPDATE	directorio.directorios_productos
						SET		promocion = NULL
						WHERE	directorio_id = {$_POST['id']}
						AND		nombre NOT IN( ".sql_ghost_col( $_POST['directorios_productos_promocion'], $this->sep )." );
					";
			/**/
			/*MANY TO MANOY - Update categorias*/
				if( !is_empty( $_POST['categorias'] ) ){
					$ghost_col	= sql_ghost_col( $_POST['categorias'], $this->sep );
					$sql		.= <<<NOWDOC
						/*categorias*/
						INSERT	INTO directorio.categorias( nombre ) {$ghost_col}
						ON		CONFLICT DO NOTHING;

						/*directorios_categorias*/
						INSERT	INTO directorio.directorios_categorias( directorio_id, categoria_id )
						SELECT	{$_POST['id']}, id
						FROM	directorio.categorias
						WHERE	nombre IN ( {$ghost_col} )
						ON		CONFLICT DO NOTHING;

						/*UPDATE directorios_categorias*/
						DELETE
						FROM	directorio.directorios_categorias
						WHERE	directorio_id	= {$_POST['id']}
						AND		categoria_id	IN(
							SELECT	id
							FROM	directorio.categorias
							WHERE	nombre NOT IN ( {$ghost_col} )
						);
NOWDOC;
				}
			/**/
			/*MANY TO MANOY - Update metodos_pago*/
				if( !is_empty( $_POST['metodos_pago'] ) ){
					$ghost_col	= sql_ghost_col( $_POST['metodos_pago'], $this->sep );
					$sql		.= <<<NOWDOC
						/*metodos_pago*/
						INSERT	INTO directorio.metodos_pago( nombre ) {$ghost_col}
						ON		CONFLICT DO NOTHING;

						/*directorios_metodos_pago*/
						INSERT	INTO directorio.directorios_metodos_pago( directorio_id, metodo_pago_id )
						SELECT	{$_POST['id']}, id
						FROM	directorio.metodos_pago
						WHERE	nombre IN ( {$ghost_col} )
						ON		CONFLICT DO NOTHING;

						/*UPDATE metodos_pago*/
						DELETE
						FROM	directorio.directorios_metodos_pago
						WHERE	directorio_id	= {$_POST['id']}
						AND		metodo_pago_id	IN(
							SELECT	id
							FROM	directorio.metodos_pago
							WHERE	nombre NOT IN ( {$ghost_col} )
						);
NOWDOC;
				}
			/**/
			/*MANY TO MANOY - Update marcas*/
				if( !is_empty( $_POST['marcas'] ) ){
					$ghost_col	= sql_ghost_col( $_POST['marcas'], $this->sep );
					$sql		.= <<<NOWDOC
						/*marcas*/
						INSERT	INTO directorio.marcas( nombre ) {$ghost_col}
						ON		CONFLICT DO NOTHING;

						/*directorios_marcas*/
						INSERT	INTO directorio.directorios_marcas( directorio_id, marca_id )
						SELECT	{$_POST['id']}, id
						FROM	directorio.marcas
						WHERE	nombre IN ( {$ghost_col} )
						ON		CONFLICT DO NOTHING;

						/*UPDATE directorios_marcas*/
						DELETE
						FROM	directorio.directorios_marcas
						WHERE	directorio_id	= {$_POST['id']}
						AND		marca_id		IN(
							SELECT	id
							FROM	directorio.marcas
							WHERE	nombre NOT IN ( {$ghost_col} )
						);
NOWDOC;
				}
			/**/
			/*MANY TO MANOY - Update preguntas_bf*/
				if( !is_empty( $_POST['preguntas_bf'] ) ){
					$ghost_col	= sql_ghost_col( $_POST['preguntas_bf'], $this->sep );
					$sql		.= <<<NOWDOC
						/*preguntas_bf*/
						INSERT	INTO directorio.preguntas_bf( nombre ) {$ghost_col}
						ON		CONFLICT DO NOTHING;

						/*directorios_preguntas_bf*/
						INSERT	INTO directorio.directorios_preguntas_bf( directorio_id, pregunta_bf_id )
						SELECT	{$_POST['id']}, id
						FROM	directorio.preguntas_bf
						WHERE	nombre IN ( {$ghost_col} )
						ON		CONFLICT DO NOTHING;

						/*UPDATE directorios_preguntas_bf*/
						DELETE
						FROM	directorio.directorios_preguntas_bf
						WHERE	directorio_id	= {$_POST['id']}
						AND		pregunta_bf_id	IN(
							SELECT	id
							FROM	directorio.preguntas_bf
							WHERE	nombre NOT IN ( {$ghost_col} )
						);
NOWDOC;
				}
			/**/

			$pdo = sql_pdo();
			try{
				$pdo->beginTransaction();
				foreach( clean_spaces( explode(';', $sql ) ) AS $sql ) $pdo->query( $sql );
				$pdo->commit();
			}catch( Exception $e ){ ddt( $e );  $pdo->rollBack();}


			/*Store Files*/
				create_folder_path( root_folder."/storage/directorios/{$directorio_id}/file.ext" );
				foreach( $_FILES AS $name => $file ){
					$ext = get_ext_by_path( $file['type'] );
					move_uploaded_file( $file['tmp_name'], root_folder."/storage/directorios/{$directorio_id}/{$name}{$ext}" );
				}
			/**/

			return $_POST['id'];
		break;
	}}

	public function delete( $string ){ switch( $string ) {
		case 'directorio/delete':

			if( $_SERVER['REQUEST_METHOD'] !== 'POST' )
				show_404();
			$_POST = clean_spaces( $_POST );

			$error = validate_post( array(
				'id' => '|required|exist_in:int8,directorio.directorios,id|'
			));
			if( $error !== array() )
				return_errors( $error );

			$_POST['id'] = sql_int8( $_POST['id'] );
			$sql = <<<NOWDOC
				UPDATE	directorio.directorios
				SET		eliminado = 't'
				WHERE	id = {$_POST['id']};
NOWDOC;

			$pdo = sql_pdo();
			try{
				$pdo->beginTransaction();
				foreach( clean_spaces( explode(';', $sql ) ) AS $sql ) $pdo->query( $sql );
				$pdo->commit();
			}catch( Exception $e ){ ddt( $e ); }

			return $_POST['id'];
		break;
	}}

	public function restore( $string ){ switch( $string ) {
		case 'directorio/restore':

			if( $_SERVER['REQUEST_METHOD'] !== 'POST' )
				show_404();
			$_POST = clean_spaces( $_POST );

			$error = validate_post( array(
				'id' => '|required|exist_in:int8,directorio.directorios,id|'
			));
			if( $error !== array() )
				return_errors( $error );

			$_POST['id'] = sql_int8( $_POST['id'] );
			$sql = <<<NOWDOC
				UPDATE	directorio.directorios
				SET		eliminado = NULL
				WHERE	id = {$_POST['id']};
NOWDOC;

			$pdo = sql_pdo();
			try{
				$pdo->beginTransaction();
				foreach( clean_spaces( explode(';', $sql ) ) AS $sql ) $pdo->query( $sql );
				$pdo->commit();
			}catch( Exception $e ){ ddt( $e ); }

			return $_POST['id'];
		break;
	}}
}

?>