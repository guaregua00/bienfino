<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es" >
<head>
	<meta charset="utf-8">
	<title>Testing</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="<?= base_url ?>/resources/favicon.png">
	<?php $this->load->view('app/css'); ?>
	<?php $this->load->view('app/js'); ?>
</head>
<body class="body" onload="input_label_watcher()">

	<?php $this->load->view('directorio/appends'); ?>

	<div class="body-container">
		<?php $this->load->view('directorio/directorio_nav'); ?>
		<?php $this->load->view('directorio/directorio_text'); ?>
		<?php $this->load->view('directorio/directorio_search'); ?>
		<?php $this->load->view('directorio/directorio_table'); ?>
		<?php $this->load->view('directorio/directorio_insert'); ?>
		<?php $this->load->view('directorio/directorio_update'); ?>
	</div>
</body>
</html>