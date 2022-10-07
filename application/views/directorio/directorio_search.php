<?php # FORM SEARCH ?>
<div id="search" class="container none">
	<h1 class="flex">
		<span class="grow">Buscar</span>
		<div class="pointer text-red" onclick="add_none('#search')">x</div>
	</h1>
	<form class="flex wrap cform overflow pb-3em" style="max-height: 75vh">

			<div class="esp1">
				<h3 class="pl-1em pt-1em bold">
					Buscador:
				</h3>
			</div>
			<div class="esp1">
				<label>
					<input name="buscador" value="<?= $_GET['buscador'] ?>">
					<div class="label">Escriba una búsqueda para iniciar</div>
				</label>
			</div>
		<?php # ?>

		<button class="none"></button>
	</form>
	<div class="flex p-1em gap-1em">
		<div class="esp1" onclick="this.closest('#search').querySelector('form').submit()">
			<button class="button">Buscar</button>
		</div>
		<div class="esp">
			<a href="<?= trimed_full_url ?>"><button class="button red">Reiniciar</button></a>
		</div>
	</div>
</div>