<?php # Table Read ?>


<div id="read" class="container <?= $table['total'] === 0 ? 'none' : '' ?>">
	<h1 class="flex"><span class="grow">Listado</span><div class="pointer text-red" onclick="add_none('#read')">x</div></h1>
	<div class="overflow" style="max-height: 75vh">
		<table class="table">
			<?php if ( $table['data'] ): ?>
				<?php foreach( $table['data'] AS $r ): ?>
					<tr>

						<td class="text-center" style="max-width: 75px">
							<div class="bold">ITEM #<?= $r->{'ID'} ?>:</div>
							<div class="flex column gap-1em pt-1em">

								<?php if( $r->{'Eliminado'} === 'No' ): ?>

									<?php $r->{'Horario_de_Trabajo_Desde_2'} = humanize_time( $r->{'Horario de Trabajo Desde'}, 24 ) ?>
									<?php $r->{'Horario_de_Trabajo_Hasta_2'} = humanize_time( $r->{'Horario de Trabajo Hasta'}, 24 ) ?>
									<button class="button" onclick="load_form( '#update', <?= tohtmljson( $r ) ?> )">Editar</button>

									<form class="flex" onsubmit="return send({
										'form':		this,
										'action':	'<?= base_url ?>/directorio/delete',
									})">
										<input name="id" value="<?= $r->ID  ?>" class="none">
										<button class="button red grow" >Eliminar</button>
									</form>

								<?php else: ?>

									<form class="flex" onsubmit="return send({
										'form':		this,
										'action':	'<?= base_url ?>/directorio/restore',
									})">
										<input name="id" value="<?= $r->ID  ?>" class="none">
										<button class="button green grow" >Restaurar</button>
									</form>

								<?php endif ?>
							</div>
						</td>

						<?php unset( $r->{'estado_id'} ) ?>
						<?php unset( $r->{'municipio_id'} ) ?>
						<?php unset( $r->{'parroquia_id'} ) ?>
						<?php unset( $r->{'Horario_de_Trabajo_Desde_2'} ) ?>
						<?php unset( $r->{'Horario_de_Trabajo_Hasta_2'} ) ?>

						<?php $r->{'Eliminado'} =
							$r->{'Eliminado'} === 'Si' ?
							"<span class=\"bold text-red\">{$r->{'Eliminado'}}</span>" :
					 		"<span class=\"bold text-green\">{$r->{'Eliminado'}}</span>"
						 ?>
						<?php $r->{'Fecha de Creación'}			= humanize_date( $r->{'Fecha de Creación'}, 'long' )				?>
						<?php $r->{'Última Módificación'}		= humanize_date( $r->{'Última Módificación'}, 'long' )				?>
						<?php $r->{'Teléfono de Contacto 1'}	= humanize_phone( $r->{'Teléfono de Contacto 1'} )					?>
						<?php $r->{'Teléfono de Contacto 2'}	= humanize_phone( $r->{'Teléfono de Contacto 2'} )					?>
						<?php $r->{'Teléfono de Contacto 3'}	= humanize_phone( $r->{'Teléfono de Contacto 3'} )					?>
						<?php $r->{'WhatsApp'}					= humanize_phone( $r->{'WhatsApp'} )								?>
						<?php $r->{'WhatsApp Business'}			= humanize_phone( $r->{'WhatsApp Business'} )						?>
						<?php $r->{'Horario de Trabajo Desde'}	= humanize_time( $r->{'Horario de Trabajo Desde'}, 12 ) 			?>
						<?php $r->{'Horario de Trabajo Hasta'}	= humanize_time( $r->{'Horario de Trabajo Hasta'}, 12 ) 			?>
						<?php $r->{'Preguntas BienFino'}		= strtr( $r->{'Preguntas BienFino'}, array( ' / ' => '<br>' ) ) 	?>
						<?php $r->{'Respuestas BienFino'}		= strtr( $r->{'Respuestas BienFino'}, array( ' / ' => '<br>' ) )	?>
						<?php $r->{'Categorias'}				= strtr( $r->{'Categorias'}, array( ' / ' => '<br>' ) )				?>
						<?php $r->{'Marcas'}					= strtr( $r->{'Marcas'}, array( ' / ' => '<br>' ) )					?>
						<?php $r->{'Métodos de Pago'}			= strtr( $r->{'Métodos de Pago'}, array( ' / ' => '<br>' ) )		?>
						<?php $r->{'Servicios'}					= strtr( $r->{'Servicios'}, array( ' / ' => '<br>' ) )				?>
						<?php $r->{'Servicios en Promoción'}	= strtr( $r->{'Servicios en Promoción'}, array( ' / ' => '<br>' ) )	?>
						<?php $r->{'Productos'}					= strtr( $r->{'Productos'}, array( ' / ' => '<br>' ) )				?>
						<?php $r->{'Productos en Promoción'}	= strtr( $r->{'Productos en Promoción'}, array( ' / ' => '<br>' ) )	?>
						<?php $r->{'Archivos'}					= recursive_files_in(
							root_folder."/storage/directorios/{$r->{'ID'}}/",
							'relative_path',
							'excursive',
							'exclude_folders',
							array()
						)?>
						<?php foreach( $r->{'Archivos'} AS &$a ){ $a = "<a target=\"_blank\" href=\"".base_url."/storage/directorios/{$r->{'ID'}}/{$a}\">{$a}</a>"; } ?>
						<?php $r->{'Archivos'} = implode('<br>', $r->{'Archivos'} ) ?>

						<?php foreach ($r AS $c => $v ): ?>
							<td>
								<div class="bold"><?= $c ?>:</div>
								<div><?= is_empty( $v ) ? '<i class="text-gray">Sin Datos</i>' : $v ?></div>
							</td>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td class="text-center">Sin resultados</td>
				</tr>
			<?php endif ?>
		</table>
	</div>
	<div class="flex wrap cpaginator">
		<?php if( $table['prev'] ): ?>
			<a href="<?= trimed_full_url ?>?pag=<?= $_GET['pag'] -1 ?>">
				<code class="pointer hover">Página Anterior</code>
			</a>
		<?php endif ?>
		<?php if( $table['next'] ): ?>
			<a href="<?= trimed_full_url ?>?pag=<?= $_GET['pag'] + 1 ?>">
				<code class="pointer text-right hover" >Página Siguiente</code>
			</a>
		<?php endif ?>
	</div>
	<p class="footer">
		Página: <?= $_GET['pag'] ?> de <?= $table['total'] ?> │ Total: <?= $table['count'] ?> items │ <a href="<?= base_url ?>/excel">Imprimir</a>
	</p>
</div>