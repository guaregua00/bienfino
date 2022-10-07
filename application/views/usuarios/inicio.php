<div id="carousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carousel" data-slide-to="0" class="active"></li>
		<li data-target="#carousel" data-slide-to="1"></li>
		<li data-target="#carousel" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="<?php echo base_url(); ?>img/fondo.gif" class="d-block w-100" alt="...">
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url(); ?>img/fondo.gif" class="d-block w-100" alt="...">
		</div>
		<div class="carousel-item">
			<img src="<?php echo base_url(); ?>img/fondo.gif" class="d-block w-100" alt="...">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
	<div id="carrusel-title" class="d-blok d-sm-blok d-md-none">
		<div class="title">
			<h1>Compra Venta </h1>
			<h1>de <em>AUTOMÓVILES</em></h1>
		</div>
	</div>
	<div id="buscador" class="d-none d-sm-none d-md-block">
		<div class="title">
			<h1>Compra Venta </h1>
			<h1>de <em>AUTOMÓVILES</em></h1>
		</div>
		<form method="POST" action="<?php echo base_url(); ?>busqueda">
			<div class="form">
				<div>
					<p>CATEGORÍAS</p>
				</div>
				<div>
					<select class="form-control" id="categoria_menu">
						<option value="">Todas las categorías</option>
						<?php
						foreach ($categorias as $value) {
						?>
							<option value="<?php echo $value->id_categoria; ?>"><?php echo strtoupper($value->nombre); ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div>
					<p>MODELO</p>
				</div>
				<div>
					<select class="form-control selectfocus" id="modelo_menu" name="modelo_menu">
						<option value="">Todas los modelos</option>
					</select>
				</div>
				<div>
					<p>MARCA</p>
				</div>
				<div>
					<select class="form-control" id="marca_menu" name="marca_menu">
						<option value="">Todas las marcas</option>
					</select>
				</div>
				<div>
					<p>AÑO</p>
				</div>
				<div class="year">
					<select class="form-control" id="ano_menu">
						<option value="">Desde</option>
						<?php
						$ano = date('Y');
						for ($i = $ano; $i >= 1900; $i--) {
							echo "<option value=" . $i . ">" . $i . "</option>";
						}
						?>
					</select>
					<select class="form-control">
						<option value="">Hasta</option>
						<?php
						$ano = date('Y');
						for ($i = $ano; $i >= 1900; $i--) {
							echo "<option value=" . $i . ">" . $i . "</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="btn-search">
				<button type="submit" class="btn btn-bf btn-buscador">BUSCAR</button>
			</div>
		</form>
	</div>
</div>

<main>
	<div class="bg-cars">
		<div class="container">
			<div class="d-block d-sm-block d-md-none" id="buscadorMobil">
				<form method="POST" action="<?php echo base_url(); ?>busqueda">
					<div class="buscador-fondo">
						<div class="form-group row">
							<label for="staticEmail" class="col-4 col-form-label">CATEGORÍAS</label>
							<div class="col-8">
								<select class="form-control" id="categoria_menu_m" name="categoria_menu_m">
									<option value="">Todas las categorías</option>
									<?php
									foreach ($categorias as $value) {
									?>
										<option value="<?php echo $value->id_categoria; ?>"><?php echo strtoupper($value->nombre); ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row mb-5">
							<label for="staticEmail" class="col-4 col-form-label">MARCA</label>
							<div class="col-8">
								<select class="form-control" id="marca_menu_m" name="marca_menu_m">
									<option value="">Todas las marcas</option>
								</select>
							</div>
						</div>
						<div class="form-group row mt-3">
							<label for="inputPassword" class="col-4 col-form-label">MODELO</label>
							<div class="col-8">
								<select class="form-control" id="modelo_menu_m" name="modelo_menu_m">
									<option value="">Todas los modelos</option>
								</select>
							</div>
						</div>
						<div class="form-group row last">
							<label for="inputPassword" class="col-4 col-form-label">AÑO</label>
							<div class="col-8">
								<div class="year">
									<select class="form-control" id="ano_menu" name="ano_menu">
										<option value="">Desde</option>
										<?php
										$ano = date('Y');
										for ($i = $ano; $i >= 1900; $i--) {
											echo "<option value=" . $i . ">" . $i . "</option>";
										}
										?>
									</select>
									<select class="form-control">
										<option value="">Hasta</option>
										<?php
										$ano = date('Y');
										for ($i = $ano; $i >= 1900; $i--) {
											echo "<option value=" . $i . ">" . $i . "</option>";
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="btn-search">
						<button type="submit" class="btn btn-bf btn-buscador">BUSCAR</button>
					</div>
				</form>
			</div>

			<h3 class="text-center text-white title">AUTOS DESTACADOS </h3>
			<div class="row justify-content-center ">
				<div class="grid-details">

					<?php
					for ($i = 0; $i < 3; $i++) {
						
						//$srcImg = getcwd() . "/publicaciones/" . $publicaciones[$i]->codigo . "/" . $publicaciones[$i]->url_uno;
						if (isset($publicaciones[$i]) and $publicaciones[$i]!="") {
					?>

							<div class="card">
								<img src="<?php echo base_url() . "publicaciones/" . $publicaciones[$i]->codigo . "/" . $publicaciones[$i]->url_uno; ?>" class="card-img-top" alt="...">
								<div class="card-body">
									<div class="details">
										<button type="button" class="btn btn-bf btn-details" data-toggle="modal" data-target="#car<?php echo $i; ?>">DETALLES</button>
										<h5 class="text-bold"><?php echo $publicaciones[$i]->modelo; ?></h5>
										<p><?php echo $publicaciones[$i]->id_ano; ?></p>
										<h5 class="text-bold">Precio a convenir</h5>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>

				</div>
			</div>
			<!--Mobile-->
		<!--
			<div class="row justify-content-center  d-flex d-sm-flex d-md-none mt-4">
				<div class="col-6 ">

				<?php
					for ($i = 0; $i < 3; $i++) {
						
						//$srcImg = getcwd() . "/publicaciones/" . $publicaciones[$i]->codigo . "/" . $publicaciones[$i]->url_uno;
						if (isset($publicaciones[$i]) and $publicaciones[$i]!="") {
					?>

					<div class="card card-mobil">
					<img src="<?php echo base_url() . "publicaciones/" . $publicaciones[$i]->codigo . "/" . $publicaciones[$i]->url_uno; ?>" class="card-img-top" alt="...">
						<div class="card-body">
							<div class="details">
								<button type="button" class="btn btn-bf btn-details" data-toggle="modal" data-target="#car3">DETALLES</button>
								<h5 class="text-bold"><?php echo mb_strtoupper($publicaciones[$i]->modelo); ?></h5>
								<p><?php echo $publicaciones[$i]->id_ano; ?></p>
								<h5 class="text-bold">Precio a convenir</h5>
							</div>
						</div>
					</div>

					<?php
						}
					}
					?>					
				</div>
			</div>
		-->

			<!--Modals-->
			<?php
			for ($i = 0; $i < 3; $i++) {
				$srcImg = getcwd() . "/publicaciones/" . $publicaciones[$i]->codigo . "/" . $publicaciones[$i]->url_uno;
				if (isset($publicaciones[$i])) {
			?>

					<div class="modal fade" id="car<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="labelcar1" aria-hidden="true">

						<div class="modal-dialog" role="document">

							<div class="times">
								<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
									<i class="fas fa-times fa-2x"></i>
								</button>
							</div>
							<div class="modal-content bg-modal">
								<div class="modal-info">
									<div class="img">
										<img src="<?php echo base_url() . "publicaciones/" . $publicaciones[$i]->codigo . "/" . $publicaciones[$i]->url_uno; ?>">
									</div>
									<div class="info">
										<h4 class="mb-4"><?php echo mb_strtoupper($publicaciones[$i]->modelo); ?></h4>
										<h5 class="mb-3">CARACTERÍSTICAS</h5>
										<h4><strong>Año:</strong><?php echo $publicaciones[$i]->id_ano; ?></h4>
										<h4><strong>Km:</strong> <?php echo $publicaciones[$i]->recorrido; ?></h4>
										<h4><strong>Ubicación:</strong> <?php echo mb_strtoupper($publicaciones[$i]->estado); ?></h4>
										<h4><strong>Contacto:</strong> <?php echo $publicaciones[$i]->moviluno; ?></h4>
									</div>
								</div>
								<div class="footer">
									<div class="status">
										<i class="fas fa-check-circle fa-2x text-primary"></i>
										<i class="fas fa-heart fa-2x text-warning"></i>
										<i class="fas fa-share-alt fa-2x text-secondary"></i>
									</div>
									<div class="actions">
										<button class="btn btn-bf  btn-modal" onclick="location.href ='detallepublicacion/'+<?php echo $publicaciones[$i]->id_publicacion?>">DETALLES</button>
										<button class="btn btn-bf btn-modal" onclick="location.href ='detallepublicacion/'+<?php echo $publicaciones[$i]->id_publicacion?>">CONTACTAR</button>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php
				}
			}
			?>

			<!--Banner registro-->
			<?php if (!isset($_SESSION['id_usuario'])) { ?>
				<div class="row justify-content-center mt-5">
					<div class="col-12 col-md-8" id="banner-registro">
						<div class="card card-body">
							<h2>Únete a nuestra comunidad</h2>
							<h1>Registrate</h1>
							<div class="row justify-content-center mt-3">
								<div class="col-6">

									<a class="btn btn-bf btn-block" href="<?php echo base_url(); ?>registrar">EMPIEZA</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<div>

	</div>
</main>

<?php
$this->view('layouts/footer');
?>

</div>

<!--AreJS-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>Bienfino-master/js/bootstrap441.min.js" ></script>
<!--End-->

<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/jquery.min.js"> </script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/jquery.min.js?1"> </script>
<script type="text/javascript" src="<?php echo base_url(); ?>Bienfino-master/js/bienfino.js?1"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/accionesmenu.js"></script>
<script src="<?php echo base_url(); ?>js/menu_filtros.js"></script>
<!--<script src="<?php echo base_url(); ?>js/push.js-master/push.min.js"></script>-->

<script type="text/javascript">
//	init_home_carousel();
</script>


<script>
	//menu
	$("#categoria_menu").change(function() {
		buscarMarcaMenu();
	});

	$("#marca_menu").change(function() {
		buscarModeloMenu();
	});
</script>


<script type="text/javascript">
	function mensaje(mensajeRegistrateIngresa = null, tituloRegistrateIngresa = null, mensajeCompletaTusDatos = null, tituloCompletaTusDatos = null) {
		//var mensaje = 'Por favor completa tus datos para poder ingresar a esta seccion de la pagina';
		// alert(mensaje);
		if (mensajeRegistrateIngresa && tituloRegistrateIngresa) {
			swal({
				title: tituloRegistrateIngresa,
				text: mensajeRegistrateIngresa,
				icon: "warning",
				button: "Continuar",

			}).then(function() {
				window.location = "ingresar";
			});
		}

		if (mensajeCompletaTusDatos && tituloCompletaTusDatos) {
			swal({
				title: tituloCompletaTusDatos,
				text: mensajeCompletaTusDatos,
				icon: "warning",
				button: "Continuar",

			}).then(function() {
				window.location = "completarregistro";
			});
		}
	}
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php if ($this->session->flashdata('mensajeRegistrateIngresa') && $this->session->flashdata('tituloRegistrateIngresa')) { ?>

	<script type="text/javascript">
		var mensajeRegistrateIngresa = "<?php echo $this->session->flashdata('mensajeRegistrateIngresa'); ?>";
		var tituloRegistrateIngresa = "<?php echo $this->session->flashdata('tituloRegistrateIngresa'); ?>";
	</script>
	<?php echo '<script type="text/javascript"> mensaje(mensajeRegistrateIngresa,tituloRegistrateIngresa); </script>'; ?>

<?php } ?>

<?php if ($this->session->flashdata('mensajeCompletaTusDatos') && $this->session->flashdata('tituloCompletaTusDatos')) { ?>

	<script type="text/javascript">
		var mensajeCompletaTusDatos = "<?php echo $this->session->flashdata('mensajeCompletaTusDatos'); ?>";
		var tituloCompletaTusDatos = "<?php echo $this->session->flashdata('tituloCompletaTusDatos'); ?>";
	</script>
	<?php echo '<script type="text/javascript"> mensaje(mensajeCompletaTusDatos,tituloCompletaTusDatos); </script>'; ?>

<?php } ?>
<script type="text/javascript">
	function focusBusquedad() {
		var buscar_palabra = document.getElementById("buscar_palabra");
		buscar_palabra.focus();
		buscar_palabra.style.color = "orange";
		buscar_palabra.scrollIntoView();
	}
</script>
<!--
<script type="text/javascript">
Push.create("fgfgfgfg", {
    body: "How's it hangin'?",
    icon: 'homeimg.jpg',
    timeout: 4000,
    onClick: function () {
        window.focus();
        this.close();
    }
});  
</script>
-->
<script>
	//menu
	$("#categoria_menu").change(function() {
		buscarMarcaMenu();
	});

	$("#marca_menu").change(function() {
		buscarModeloMenu();
	});
	//movil
	$("#categoria_menu_m").change(function() {
		buscarMarcaMenuM();
	});

	$("#marca_menu_m").change(function() {
		buscarModeloMenuM();
	});




	function loadPage() {

//defaultImgOnError('.grid-details>.card>img', base_url + '/Bienfino-master/imagenes/base/logo.gif');
//defaultImgOnError('.modal-info>.img>img', base_url + '/Bienfino-master/imagenes/base/logo.gif');
}

window.onload = loadPage();

function defaultImgOnError(selector, urlImage) {

var tagImg = document.querySelectorAll(selector);
if (!tagImg == false) {

	//console.log(tagImg);
	for (var i = 0; i < tagImg.length; i++) {
		//tagImg[i]
		if (tagImg[i].naturalHeight == 0 && tagImg[i].naturalWidth == 0)
			tagImg[i].src = urlImage;
	}

}

}

</script>
<!--<script src="<?php echo base_url(); ?>Bienfino-master/js/bienfinoR.js"></script>-->
</body>

</html>