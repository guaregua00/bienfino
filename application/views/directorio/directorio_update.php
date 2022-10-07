<?php # FORM INSERT ?>
<div id="update" class="container none overflow" style="max-height: 75vh; min-height: 75vh">
	<h1 class="flex">
		<span class="grow">Editar</span>
		<div class="pointer text-red" onclick="add_none('#update')">x</div>
	</h1>
	<div class="pl-1em">
		<span class="bold text-blue">(*)</span> Campos Opcionales<br>
		<span class="bold text-red">(*)</span> Campos Requeridos<br>
	</div>
 	<form class="flex wrap cform" onsubmit="return send({
		'form':		this,
		'action':	'<?= base_url ?>/directorio/update',
	})">

	<!-- <form class="flex wrap cform" action="<?= base_url ?>/directorio/update" method="post"> -->
		<input type="hidden" name="id" type="number" valued="ID">

		<div>
			<label>
				<input name="nombre" required type="nombre" valued="Nombre">
				<div class="label">Nombre de la empresa <span class="text-red">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="email" required type="email" valued="Email_de_la_empresa">
				<div class="label">Correo de la empresa <span class="text-red">(*)</span></div>
				<small>Formato Correcto: email@email.com</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="contacto_1" required pattern="[0-9]{10}" valued="Teléfono_de_Contacto_1">
				<div class="label">Teléfono de Contacto 1 <span class="text-red">(*)</span></div>
				<small>Ejemplo Formato Correcto: 0414123456</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="contacto_2" pattern="[0-9]{10}" valued="Teléfono_de_Contacto_2">
				<div class="label">Teléfono de Contacto 2 <span class="text-blue">(*)</span></div>
				<small>Ejemplo Formato Correcto: 0414123456</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="contacto_3" pattern="[0-9]{10}" valued="Teléfono_de_Contacto_3">
				<div class="label">Teléfono de Contacto 3 <span class="text-blue">(*)</span></div>
				<small>Ejemplo Formato Correcto: 0414123456</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="whatsapp_1" required pattern="[0-9]{10}" valued="WhatsApp">
				<div class="label">WhatsApp 1 <span class="text-blue">(*)</span></div>
				<small>Ejemplo Formato Correcto: 0414123456</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="whatsapp_2" required pattern="[0-9]{10}" valued="WhatsApp_Business">
				<div class="label">WhatsApp Business <span class="text-red">(*)</span></div>
				<small>Ejemplo Formato Correcto: 0414123456</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="coordenadas" required valued="Coordenadas">
				<div class="label">Coordenadas o Link <span class="text-red">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="rifj" required pattern="(J){1}-[0-9]+-[0-9]{1}" valued="RIF-J">
				<div class="label">RIF-J <span class="text-red">(*)</span></div>
				<small>Ejemplo Formato Correcto: J-1234-1</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="horario_trab_desde" required pattern="[0-9]{2}:[0-9]{2}" onclick="input_time_watcher(this)" valued="Horario_de_Trabajo_Desde_2">
				<div class="label">Horario de trabajo Desde <span class="text-red">(*)</span></div>
				<small>Ejemplo Formato Correcto: Debe seleccionar un item de la lista desplegable</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="horario_trab_hasta" required pattern="[0-9]{2}:[0-9]{2}" onclick="input_time_watcher(this)" valued="Horario_de_Trabajo_Hasta_2">
				<div class="label">Horario de trabajo Hasta <span class="text-red">(*)</span></div>
				<small>Ejemplo Formato Correcto: Debe seleccionar un item de la lista desplegable</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input class="none" name="estado_id" valued="estado_id">
				<input list="estado_list" onchange="input_data_watcher(this)" required valued="Estado">
				<div class="label">Estado <span class="text-red">(*)</span></div>
				<small>Ejemplo Formato Correcto: Debe seleccionar un item de la lista desplegable</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input class="none" name="municipio_id" valued="municipio_id">
				<input list="municipio_list" onchange="input_data_watcher(this)" required valued="Municipio">
				<div class="label">Municipio <span class="text-blue">(*)</span></div>
				<small>Ejemplo Formato Correcto: Debe seleccionar un item de la lista desplegable</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input class="none" name="parroquia_id" valued="parroquia_id">
				<input list="parroquia_list" onchange="input_data_watcher(this)" required valued="Parroquia">
				<div class="label">Parroquia <span class="text-blue">(*)</span></div>
				<small>Ejemplo Formato Correcto: Debe seleccionar un item de la lista desplegable</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="foro_local" type="number" min="1" max="100" required valued="Foro_Local">
				<div class="label">Foro Local <span class="text-red">(*)</span></div>
				<small>Ejemplo Formato Correcto: Número del 1 al 100</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="actividad_economica" valued="Actividad_Económica">
				<div class="label">Actividad Económica <span class="text-red">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="direccion_fisica" required valued="Dirección_Física">
				<div class="label">Dirección Física <span class="text-red">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="descripcion" required valued="Descripción">
				<div class="label">Descripción <span class="text-red">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="otras_ciudades" valued="Otras_Ciudades">
				<div class="label">Otras Ciudades <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<div class="flex">
					<input type="checkbox" name="concesionario" checked value="Si" valued="¿Es_Concesionario?">
					<span class="bold">¿Es Concesionario? <span class="text-blue">(*)</span></span>
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<div class="flex">
					<input type="checkbox" name="prestador_servicio" checked value="Si" valued="¿Es_Prestador_de_Servicio?">
					<span class="bold">¿Es Prestador de Servicio? <span class="text-blue">(*)</span></span>
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<div class="flex">
					<input type="checkbox" name="respuesto" checked value="Si" valued="¿Es_Vendedor_de_Repuestos?">
					<span class="bold">¿Es Vendedor de Repuestos? <span class="text-blue">(*)</span></span>
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="categorias" onclick="input_selectable_watcher(this)" valued="Categorias">
				<div class="label">Categorias <span class="text-blue">(*)</span></div>
				<div class="selectable-box flex none">
					<select class="selectable" size="10" onchange="input_selectable_add(this)" >
						<?php foreach( $categorias AS $id => $v ): ?>
							<option data><?= $v ?></option>
						<?php endforeach ?>
					</select>
					<button type="button" class="button red mini select-button-1" onclick="input_selectable_close(this)">
						X
					</button>
				</div>
				<small>Ejemplo de Formato Correcto:<ul>
					<li>Separe diferentes items con una barra diagonal ( / )</li>
					<li>Puede seleccionar múltiples elementos de la lista desplegable</li>
				</ul></small>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="metodos_pago" onclick="input_selectable_watcher(this)" valued="Métodos_de_Pago">
				<div class="label">Métodos de Pago <span class="text-blue">(*)</span></div>
				<div class="selectable-box flex none">
					<select class="selectable" size="10" onchange="input_selectable_add(this)" >
						<?php foreach( $metodos_pago AS $id => $v ): ?>
							<option data><?= $v ?></option>
						<?php endforeach ?>
					</select>
					<button type="button" class="button red mini select-button-1" onclick="input_selectable_close(this)">
						X
					</button>
				</div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / )</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="marcas" onclick="input_selectable_watcher(this)" valued="Marcas">
				<div class="label">Marcas con las que trabaja <span class="text-blue">(*)</span></div>
				<div class="selectable-box flex none">
					<select class="selectable" size="10" onchange="input_selectable_add(this)" >
						<?php foreach( $marcas AS $id => $v ): ?>
							<option data><?= $v ?></option>
						<?php endforeach ?>
					</select>
					<button type="button" class="button red mini select-button-1" onclick="input_selectable_close(this)">
						X
					</button>
				</div>
				<small>Ejemplo de Formato Correcto:<ul>
					<li>Separe diferentes items con una barra diagonal ( / )</li>
					<li>Puede seleccionar múltiples elementos de la lista desplegable</li>
				</ul></small>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="consejos" valued="Consejos_y_Sugerencias">
				<div class="label">Consejos y Recomendaciones <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / )</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="directorios_servicios" valued="Servicios">
				<div class="label">Servicios que ofrece <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / )</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="directorios_servicios_promocion" valued="Servicios_en_Promoción">
				<div class="label">Servicios en promoción que ofrece <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / )</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="directorios_productos" valued="Productos">
				<div class="label">Productos que ofrece <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / )</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="directorios_productos_promocion" valued="Productos_en_Promoción">
				<div class="label">Productos en promoción que ofrece <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / )</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="preguntas_bf" onclick="input_selectable_watcher(this)" valued="Preguntas_BienFino">
				<div class="label">Preguntas BF <span class="text-blue">(*)</span></div>
				<div class="selectable-box flex none">
					<select class="selectable" size="10" onchange="input_selectable_add(this)" >
						<?php foreach( $preguntas_bf AS $id => $v ): ?>
							<option data><?= $v ?></option>
						<?php endforeach ?>
					</select>
					<button type="button" class="button red mini select-button-1" onclick="input_selectable_close(this)">
						X
					</button>
				</div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / ) en el mismo orden del campo siguiente</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div class="esp1">
			<label>
				<input name="respuestas_bf" valued="Respuestas_BienFino">
				<div class="label">Respuestas BienFino <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / ) en el mismo orden del campo anterior</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="responsable_bf" valued="Responsable_BienFino">
				<div class="label">Responsable BienFino <span class="text-red">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / )</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="comunidad" valued="Comunidad">
				<div class="label">Comunidad <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Separe diferentes items con una barra diagonal ( / )</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="posicionamiento" valued="Posicionamiento">
				<div class="label">Posicionamiento <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="facebook" valued="Facebook">
				<div class="label">Link Facebook <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="instagram" valued="Instagram">
				<div class="label">Link Instagram <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div>
			<label>
				<input name="twitter" valued="Twitter">
				<div class="label">Link Twitter <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="mercadolibre" valued="MercadoLibre">
				<div class="label">Link Mercadolibre <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="infoguia" valued="InfoGuia">
				<div class="label">Link Infoguia <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="pagina_web" valued="Página_WEB">
				<div class="label">Página web <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="sigueme" valued="Sigueme_y_te_Sigo">
				<div class="label">Sigueme y te Sigo <span class="text-blue">(*)</span></div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="nro_publicaciones" type="number" valued="Número_de_Publicaciones">
				<div class="label">Número Publicaciones <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Números</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="nro_seguidores" type="number" valued="Número_de_Seguidores">
				<div class="label">Número Seguidores <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Números</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<input name="nro_seguidos" type="number" valued="Número_de_Seguidos">
				<div class="label">Número Seguidos <span class="text-blue">(*)</span></div>
				<small>Ejemplo de Formato Correcto: Números</small><br>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<div class="flex">
					<div class="no-break mr-1em">
						<div class="bold">Logo <span class="text-red"><br>(PNG / JPG / GIF)</span><span class="text-blue">(*)</span></div>
					</div>
					<input name="logo" type="file">
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<div class="flex">
					<div class="no-break mr-1em">
						<div class="bold">GIF<br><span class="text-red">(GIF)</span><span class="text-blue">(*)</span></div>
					</div>
					<input name="gif" type="file">
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<div class="flex">
					<div class="no-break mr-1em">
						<div class="bold">Barner <span class="text-red"><br>(PNG / JPG / GIF)</span><span class="text-blue">(*)</span></div>
					</div>
					<input name="logo" type="file">
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<div class="flex">
					<div class="no-break mr-1em">
						<div class="bold">Foto Instagram <span class="text-red"><br>(PNG / JPG / GIF)</span><span class="text-blue">(*)</span></div>
					</div>
					<input name="foto_instagram" type="file">
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<div class="flex">
					<div class="no-break mr-1em">
						<div class="bold">Foto Comercio <span class="text-red"><br>(PNG / JPG / GIF)</span><span class="text-blue">(*)</span></div>
					</div>
					<input name="foto_comercio" type="file">
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<div class="flex">
					<div class="no-break mr-1em">
						<div class="bold">Foto Grupal <span class="text-red"><br>(PNG / JPG / GIF)</span><span class="text-blue">(*)</span></div>
					</div>
					<input name="foto_grupal" type="file">
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<div >
			<label>
				<div class="flex">
					<div class="no-break mr-1em">
						<div class="bold">Video Instagram <span class="text-red"><br>(PNG / JPG / GIF)</span><span class="text-blue">(*)</span></div>
					</div>
					<input name="foto_instagram" type="file">
				</div>
				<error>&nbsp;</error>
			</label>
		</div>
		<!-- 
		<div class="esp1">
			
			<div class="col-sm-3" id="div-metodo-pago">
				<label for="metodo-pago" class="control-label">Metodo de Pago <span class="text-red">(*)</span></label>
				<select class="form-control" name="metodo-pago" id="metodo-pago">
					<option selected value="">Seleccione Metodo de Pago</option>
					<option value='Ninguno'>Ninguno</option>
					<option value='Pago Móvil'>Pago Móvil</option>
					<option value='Transferencia'>Transferencia</option>
					<option value='Efectivo'>Efectivo</option>
					
				</select>
			</div>
			<div class="col-sm-3" id="div-banco-origen">
				<label for="banco-origen" class="control-label">Banco Origen <span class="text-blue">(*)</span></label>
				<select class="form-control" name="banco-origen" id="banco-origen">
					<option selected value="">Seleccione un Banco</option>
					<option value='banesco'>Banesco</option>
					<option value='provincial'>Provincial</option>    
					<option value='mercantil'>Mercantil</option>
					<option value='banco-venezuela'>Banco de Venezuela</option>  
					
				</select>
			</div>
			<div class="col-sm-3" id="div-banco-destino">
				<label for="banco-destino" class="control-label">Banco Destino <span class="text-blue">(*)</span></label>
				<select class="form-control" name="banco-destino" id="banco-destino">
					<option selected value="">Seleccione un Banco</option>
					<option value='banesco'>Banesco</option>
					<option value='provincial'>Provincial</option>    
					<option value='mercantil'>Mercantil</option>
					<option value='banco-venezuela'>Banco de Venezuela</option>  
					
				</select>
			</div>
			<div class="col-sm-1" id="div-monto">
				<label for="monto" class="control-label">Monto<span class="text-red">(*)</span></label>
				<input type="text" class="form-control" name="monto" id="monto" minlength="" placeholder="Bs">
			</div>
			<div class="col-sm-1" id="div-referencia" >
				<label for="referencia" class="control-label">Referencia</label>
				<input type="text" class="form-control" name="referencia" id="referencia" minlength="4" placeholder="Ref">
			</div>
		</div>
 		-->
		<div class="esp1 p-1em">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
			<button class="button">Guardar</button>
		</div>
	</form>
</div>