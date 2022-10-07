<?php class MPreguntas_BF extends CI_Model{

	public function list(){
		return sql_push_flat( 'id', sql_pdo()->query("
			SELECT	id, nombre
			FROM	directorio.preguntas_bf
		"));
	}
}