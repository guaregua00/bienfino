<?php class MParroquia extends CI_Model
{
	public function list(){
		return sql_push_flat( 'id', sql_pdo()->query(<<<'NOWDOC'
			SELECT		m.id, CONCAT( e.nombre, ' - ', m.nombre, ' - ', p.nombre )
			FROM		ubicacion.tbl_parroquia	AS p
			LEFT JOIN	ubicacion.tbl_estado	AS e ON p.estado_id		= e.id
			LEFT JOIN	ubicacion.tbl_municipio AS m ON p.municipio_id	= m.id
			WHERE		e.eliminado IS NULL
			AND			m.eliminado IS NULL
			AND			p.eliminado IS NULL
			ORDER BY	e.favorito ASC;
NOWDOC));
	}
} ?>