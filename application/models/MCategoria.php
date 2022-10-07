<?php class MCategoria extends CI_Model
{
	public function list(){
		return sql_push_flat( 'id', sql_pdo()->query("
			SELECT	id, nombre
			FROM	directorio.categorias
		"));
	}
} ?>