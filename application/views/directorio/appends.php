<?php #Datalist ?>
	<?php #Date Selector ?>
		<datalist id="date_dias">
			<?php for( $x = 1; $x <= 31; $x++ ): ?>
				<option><?= sprintf( '%02d', $x ) ?></option>
			<?php endfor ?>
		</datalist>
		<datalist id="date_meses">
			<?php foreach( get_meses() AS $n => $v ): ?>
				<option value="<?= $n ?>" ><?= ucfirst( $v ) ?></option>
			<?php endforeach ?>
		</datalist>
		<datalist id="date_anios">
			<?php foreach( get_anios( 1 ) AS $v ): ?>
				<option ><?= $v ?></option>
			<?php endforeach ?>
		</datalist>
	<?php # ?>
	<?php # Time Selector ?>
		<datalist id="time_horas">
			<?php for( $x = 1; $x <= 12; $x++ ): ?>
				<option><?= sprintf( '%02d', $x ) ?></option>
			<?php endfor ?>
		</datalist>
		<datalist id="time_minutos">
			<?php for( $x = 0; $x <= 59; $x++ ): ?>
				<option><?= sprintf( '%02d', $x ) ?></option>
			<?php endfor ?>
		</datalist>
		<datalist id="time_meridiem">
			<option>am</option>
			<option>pm</option>
		</datalist>
	<?php # ?>
	<?php # Boolean ?>
		<datalist id="boolean_list">
			<option>Si</option>
			<option>No</option>
		</datalist>
	<?php # ?>
	<?php # Others ?>
		<datalist id="estado_list">
			<option>Vaciar</option>
			<?php foreach( $estados AS $id => $v ): ?>
				<option data-value="<?= $id ?>"><?= $v ?></option>
			<?php endforeach ?>
		</datalist>
		<datalist id="municipio_list">
			<option>Vaciar</option>
			<?php foreach( $municipios AS $id => $v ): ?>
				<option data-value="<?= $id ?>"><?= $v ?></option>
			<?php endforeach ?>
		</datalist>
		<datalist id="parroquia_list">
			<option>Vaciar</option>
			<?php foreach( $parroquias AS $id => $v ): ?>
				<option data-value="<?= $id ?>"><?= $v ?></option>
			<?php endforeach ?>
		</datalist>
	<?php # ?>
<?php # ?>

<?php #Date Selector ?>
<div class="date none">
	<div class="date-container">
		<div class="date-box">
			<input id="date_dia" list="date_dias" placeholder="<?= date('d') ?>">
			<input id="date_mes"  list="date_meses" placeholder="<?= date('m') ?>">
			<input id="date_anio"  list="date_anios" placeholder="<?= date('Y') ?>">
			<button class="button mini" onclick="input_date_set()">✓</button>
			<button class="button red mini" onclick="input_date_clear()">X</button>
		</div>
	</div>
</div>

<?php #Time Selector ?>
<div class="time none">
	<div class="time-container">
		<div class="time-box">
			<input id="time_hora" list="time_horas" placeholder="<?= date('h') ?>">
			<input id="time_min"  list="time_minutos" placeholder="<?= date('i') ?>">
			<input id="time_mer"  list="time_meridiem" placeholder="<?= date('a') ?>">
			<button class="button mini" onclick="input_time_set()">✓</button>
			<button class="button red mini" onclick="input_time_clear()">X</button>
		</div>
	</div>
</div>

<?php if( $_SESSION['ALERT'] ): ?>
	<div class="alerts-page-container" >
		<div class="alerts">
			<div class="alerts-close" onclick="this.closest('.alerts-page-container').remove()">
				<span class="bold text-red">x</span>
			</div>
			<div class="alerts-container text-green"><?= $_SESSION['ALERT'] ?></div>
			<div class="alerts-close" onclick="this.closest('.alerts-page-container').remove()">
				<span class="bold text-red">x</span>
			</div>
		</div>
	</div>
	<?php unset( $_SESSION['ALERT'] ) ?>
<?php endif ?>

<?php #TOP Alerts Display ?>
<div class="alerts-page-container none">
	<div class="alerts">
		<div class="alerts-close" onclick="this.closest('.alerts-page-container').classList.add('none')">
			<span class="bold text-red">x</span>
		</div>
		<div class="alerts-container text-red bold"><?= $_SESSION['ALERT'] ?></div>
		<div class="alerts-close" onclick="this.closest('.alerts-page-container').classList.add('none')">
			<span class="bold text-red">x</span>
		</div>
	</div>
</div>