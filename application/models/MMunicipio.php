<?php class MMunicipio extends CI_Model {
	public function list(){
		return sql_push_flat( 'id', sql_pdo()->query(<<<'NOWDOC'
			SELECT		m.id, CONCAT( e.nombre, ' - ', m.nombre )
			FROM		ubicacion.tbl_municipio AS m
			JOIN		ubicacion.tbl_estado AS e ON m.estado_id = e.id
			WHERE		e.eliminado IS NULL
			AND			m.eliminado IS NULL
			ORDER BY	e.favorito ASC;
NOWDOC));
	}
} ?>