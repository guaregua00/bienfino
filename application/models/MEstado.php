<?php class MEstado extends CI_Model
{
	public function list(){
		return sql_push_flat( 'id', sql_pdo()->query(<<<'NOWDOC'
			SELECT	id,nombre
			FROM	ubicacion.tbl_estado
			WHERE	eliminado IS NULL
			ORDER	BY favorito ASC;
NOWDOC));
	}
} ?>