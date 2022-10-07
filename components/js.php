<script>
	const $e_color	= 'background: #FEE; color: #F00';
	const $n_color	= 'background: #000; color: #bd5';
	const sleep		= ms => { return new Promise( resolve => setTimeout( resolve, ms ) ) }

	function send( $arr ){
		event.preventDefault();

		console.log( '\n');
		console.log(`%csending_form:`, $n_color );
		console.log( $arr );
		console.log( '\n');

		var $errors = document.querySelectorAll('error');
		for( var $x in $errors )
			$errors[ $x ].innerHTML = '&nbsp;';

		var $form		= $arr.form;
		var $action		= $arr.action;
		var $success	= $arr.success;
		var $inputs		= $form.querySelectorAll('[name]');
		delete $arr;

		var $data = new FormData();
		if( typeof $inputs === 'object' )
			for( var $x in $inputs )
				if( typeof $inputs[ $x ] === 'object' )
					if( $inputs[ $x ].getAttribute( 'type' ) === 'checkbox' ){
		 				if( $inputs[ $x ].checked ){
		 					var $name	= $inputs[ $x ].getAttribute( 'name' );
		 					var $value	= $inputs[ $x ].value;
		 					$data.append( $name, $value );
		 				}
					}
					else if( $inputs[ $x ].getAttribute( 'type' ) === 'file' ){
						if( $inputs[ $x ].files[0] ){
							var $value = $inputs[ $x ].files[0];
		 					var $name = $inputs[ $x ].getAttribute( 'name' );
		 					$data.append( $name, $value );
						}
					}
					else{
	 					var $name	= $inputs[ $x ].getAttribute( 'name' );
	 					var $value	= $inputs[ $x ].value;
	 					$data.append( $name, $value );
					}

		var $xhr = new XMLHttpRequest();
		$xhr.open('POST', $action );
		$xhr.send($data);
		$xhr.onload = async _ => {
			if( $xhr.response ){

				try{
					var $response	= JSON.parse( $xhr.response );

					console.log( '\n');
					console.log(`%cJSON $xhr.onload:`, $n_color );
					console.log(`Estatus: ${$xhr.status}`);
					console.log( '\n');

				}catch( $e ){
					if( $xhr.response.includes('POST Content-Length of') ){

						var $alerts		= document.querySelector('.alerts-page-container');
						var $alerts_c	= document.querySelector('.alerts-container');
						$alerts_c.innerHTML = '<b>REDUZCA EL TAMAÑO DE SUS ARCHIVOS.<br>LÍMITE DE PESO ACEPTADO POR EL SERVIDOR HA SIDO EXCEDIDO.</b>';
						$alerts.classList.remove('none');

						console.log( '\n');
						console.log(`%cERROR FILE LIMIT REACHED RESPONSE $xhr.onload:`, $e_color );
						console.log( $xhr.status );
						console.log( '\n');
					}else{

						var $alerts		= document.querySelector('.alerts-page-container');
						var $alerts_c	= document.querySelector('.alerts-container');
						$alerts_c.innerHTML = '<b>ERROR AL COMUNICARSE CON EL SERVIDOR</b>';
						$alerts.classList.remove('none');

						console.log( '\n');
						console.log(`%cERROR SERVER BAD RESPONSE $xhr.onload:`, $e_color );
						console.log( $xhr.status );
						console.log( $xhr.response );
						console.log( '\n');
					}

					return;
				}

				if( $response.error ){

					var $i		= 1;
					var $error	= $response.error;
					for( var $x in $error ){
						var $input = $form.querySelector(`[name="${$x}"]`);
						if( $input ){
							var $label = $input.closest('label');
							if( $label ){
								var $_error = $label.querySelector('error');
								$_error.innerHTML = $error[ $x ];
								if( $i === 1 ){
									$label.parentElement.scrollIntoView();
									$i = 0;
								}
							}
						}
					}

					var $alerts		= document.querySelector('.alerts-page-container');
					var $alerts_c	= document.querySelector('.alerts-container');
					$alerts_c.innerHTML = 'ERROR EN LOS CAMPOS ENVIADOS';
					$alerts.classList.remove('none');


					console.log( '\n');
					console.log(`%cERROR INPUT $xhr.onload:`, $e_color );
					console.log( $error );
					console.log( '\n');
				}

				if( $response.alert ){
					var $alerts			= document.querySelector('.alerts-page-container');
					var $alerts_c		= document.querySelector('.alerts-container');
					$alerts_c.innerHTML = $response.alert;
					$alerts.classList.remove('none');

					$form.scrollIntoView();

					console.log( '\n');
					console.log(`%cALERT $xhr.onload:`, $e_color );
					console.log( $error );
					console.log( '\n');
				}

				if( $response.end ){
					return;

					console.log( '\n');
					console.log(`%cEND CALLED BY SERVER $xhr.onload:`, $e_color );
					console.log( '\n');
				}

				if( $response.success ){

					if( $success )
						$success( $response );
					else{
						$form.scrollIntoView();
						window.location.reload();
					}

					console.log( '\n');
					console.log(`%cSUCCESS BY SERVER $xhr.onload:`, $n_color );
					console.log( $error );
					console.log( '\n');
				}

			}
			else{
				var $alerts		= document.querySelector('.alerts-page-container');
				var $alerts_c	= document.querySelector('.alerts-container');
				$alerts_c.innerHTML = 'ERROR AL COMUNICARSE CON EL SERVIDOR';
				$alerts.classList.remove('none');

				$form.scrollIntoView();

				console.log( '\n');
				console.log(`%cERROR SERVER NOT RESPONSE $xhr.onload:`, $n_color );
				console.log(`${$xhr.status} ${$xhr.response}`);
				console.log( '\n');
				return;
			}
		};
		$xhr.onerror = _ => {
			var $alerts		= document.querySelector('.alerts-page-container');
			var $alerts_c	= document.querySelector('.alerts-container');
			$alerts_c.innerHTML = 'ERROR AL COMUNICARSE CON EL SERVIDOR';
			$alerts.classList.remove('none');

			$form.scrollIntoView();

			console.log( '\n');
			console.log(`%cSERVER ERROR $xhr.onload:`, $n_color );
			console.log(`${$xhr.status} ${$xhr.response}`);
			console.log( '\n');
			return;
		};
		$xhr.onprogress = $event => {
			if( $xhr.loaded ){
				console.log( '\n');
				console.log(`%cSENDING:`, $n_color );
				console.log(`${$xhr.loaded} de ${$xhr.total}`)
				console.log( '\n');
			}
		};


		return false;
	}
	function load_form( $target, $list ){
		var $target = document.querySelector( $target );

		console.log( '\n');
		console.log(`%cCalled load_form:`, $n_color );
		console.log( $target );
		console.log( '\n');

		if( $target ){
			for( var $x in $list ){
				var $s = $x.split(' ').join('_');
				var $input = $target.querySelector(`[valued="${$s}"]`);

				if( $input ){
					var $type = $input.getAttribute('type');

					if( $type === 'checkbox' )
						$input.checked = $list[ $x ] === 'Si' ? true : false ;

					else{
						$input.value = $list[ $x ];
						$input.onkeyup();
					}

				}

				else{
					console.log(`%cALERT: INPUTS NOT LOADED`, $e_color );
					console.log( $s );
				}
			}

			$target.classList.remove( 'none' );
			$target.scrollIntoView();
		}
	}
	function input_data_watcher( $caller, $finded = false ){
		var $label		= $caller.closest('label');
		var $input		= $label.querySelector('[name]');
		var $alist		= $caller.getAttribute( 'list' );
		var $list		= document.querySelector(`#${$alist}`);
		var $options	= $list.querySelectorAll('option');

		if( typeof $options === 'object' )
			for( var $x in $options )
				if( typeof $options[ $x ] === 'object'  ){
					var $option = $options[ $x ];
					var $text	= $option.innerHTML;
					if( $caller.value === 'Vaciar' ){
						$input.value	= '';
						$caller.value	= '';
						$finded = true;
					}
					else if( $option.innerHTML === $caller.value ){
						var $value = $option.getAttribute( 'data-value' );
						$input.value = $value;
						$finded = true;
					}
				}

		if( $finded === false )
			$input.value	= 'Invalid';

		console.log( '\n');
		console.log(`%cCalled input_data_watcher:`, $n_color );
		console.log( $label );
		console.log( $list );
		console.log( '\n');
	}
	function input_selectable_watcher( $caller ){

		var $boxes	= document.querySelectorAll('.selectable-box');
		if( typeof $boxes === 'object' )
			for( var $x in $boxes )
				if( typeof $boxes[ $x ] === 'object'  )
					$boxes[ $x ].classList.add('none');

		var $label	= $caller.closest('label');
		var $box	= $label.querySelector('.selectable-box');

		$box.classList.remove('none');

		console.log( '\n');
		console.log(`%cCalled input_selectable_watcher:`, $n_color );
		console.log( $label );
		console.log( '\n');
	}
	function input_selectable_close( $caller ){

		var $box = $caller.closest('.selectable-box')
		$box.classList.add('none')

		console.log( '\n');
		console.log(`%cCalled input_selectable_close:`, $n_color );
		console.log( $caller );
		console.log( '\n');
	}
	function input_selectable_add( $caller ){
		var $label	= $caller.closest('label');
		var $input	= $label.querySelector('[name]');

		if( $input.value )
			$input.value += ` / ${$caller.value}`;
		else
			$input.value = $caller.value;

		$caller.value = null;

		console.log( '\n');
		console.log(`%cCalled input_selectable_add:`, $n_color );
		console.log( $input );
		console.log( '\n');

		$input.onkeyup();
	}
	function input_label_watcher(){
		$inputs = document.querySelectorAll('input:not(.input-label-listening)');
		if( typeof $inputs === 'object' )
			for( var $x in $inputs )
				if( typeof $inputs[ $x ] === 'object' ){
					$inputs[ $x ].onkeyup = function(){
						var $caller = this;
						if( $caller.value )
							$caller.classList.add( 'label-up' );
						else
							$caller.classList.remove( 'label-up' );
					};
					$inputs[ $x ].onkeyup = function(){
						var $caller = this;
						if( $caller.value )
							$caller.classList.add( 'label-up' );
						else
							$caller.classList.remove( 'label-up' );
					};
					if( $inputs[ $x ].value )
						$inputs[ $x ].classList.add( 'label-up' );
					else
						$inputs[ $x ].classList.remove( 'label-up' );
					$inputs[ $x ].classList.add( 'input-label-listening' );
				}
		console.log( '\n');
		console.log(`%cLoaded input_label_watcher:`, $n_color );
		console.log(`${$inputs.length} INPUTS`);
		console.log( '\n');
	}
	function input_time_watcher( $caller ){

		var $input	= document.querySelector('.input-time-listening');
		if( $input ) $input.classList.remove('input-time-listening');

		var $pos		= $caller.getBoundingClientRect();
		var $container	= document.querySelector('.time-container');
		var $time		= document.querySelector('.time');
		var $hora		= document.querySelector('#time_hora');
		var $min		= document.querySelector('#time_min');
		var $mer		= document.querySelector('#time_mer');

		$hora	.value = '';
		$min	.value = '';
		$mer	.value = '';

		$container.style.top	= `${$pos.y}px`;
		$container.style.left	= `${$pos.x}px`;

		if( $time.classList.contains('none') )
			$time.classList.remove('none');

		$caller.classList.add('input-time-listening');

		console.log( '\n');
		console.log(`%cCalled input_time_watcher:`, $n_color );
		console.log( $caller );
		console.log( '\n');
	}
	function input_date_watcher( $caller ){

		var $input	= document.querySelector('.input-date-listening');
		if( $input ) $input.classList.remove('input-date-listening');

		var $pos	= $caller.getBoundingClientRect();
		var $box	= document.querySelector('.date-box');
		var $date	= document.querySelector('.date');
		var $dia	= document.querySelector('#date_dia');
		var $mes	= document.querySelector('#date_mes');
		var $anio	= document.querySelector('#date_anio');

		$dia	.value = '';
		$mes	.value = '';
		$anio	.value = '';

		$box.style.top	= `${$pos.y}px`;
		$box.style.left	= `${$pos.x}px`;

		if( $date.classList.contains('none') )
			$date.classList.remove('none');

		$caller.classList.add('input-date-listening');

		console.log( '\n');
		console.log(`%cCalled input_date_watcher:`, $n_color );
		console.log( $caller );
		console.log( '\n');
	}
	function input_date_set(){

		var $input	= document.querySelector('.input-date-listening');
		var $date	= document.querySelector('.date');
		var $dia	= document.querySelector('#date_dia');
		var $mes	= document.querySelector('#date_mes');
		var $anio	= document.querySelector('#date_anio');

		$input.value = `${$anio.value}-${$mes.value}-${$dia.value}`;

		$date.classList.add('none');
		$input.classList.remove('input-date-listening');
		$input.onkeyup();

		console.log( '\n');
		console.log(`%cCalled input_date_set:`, $n_color );
		console.log( $input );
		console.log( '\n');
	}
	function input_date_clear(){

		var $input	= document.querySelector('.input-date-listening');
		var $date	= document.querySelector('.date');
		var $dia	= document.querySelector('#date_dia');
		var $mes	= document.querySelector('#date_mes');
		var $anio	= document.querySelector('#date_anio');

		$dia	.value = '';
		$mes	.value = '';
		$anio	.value = '';
		$input.value	= '';

		$date.classList.add('none');
		$input.classList.remove('input-date-listening');
		$input.onkeyup();

		console.log( '\n');
		console.log(`%cCalled input_date_clear:`, $n_color );
		console.log( $input );
		console.log( '\n');
	}
	function input_time_set(){

		var $input	= document.querySelector('.input-time-listening');
		var $time	= document.querySelector('.time');
		var $hora	= document.querySelector('#time_hora');
		var $min	= document.querySelector('#time_min');
		var $mer	= document.querySelector('#time_mer');

		$hora = parseInt( $hora.value );
		if( isNaN( $hora ) )
			$hora = 0;
		$min = $min.value ? $min.value : '00' ;
		$mer = $mer.value;

		if(
			$mer === 'am' &&
			$hora === 12
		)
			$hora = 0;
		else if(
			$mer === 'pm' &&
			$hora === 12
		)
			$hora = 12;
		else if(
			$mer === 'pm'
		)
			$hora += 12;


		$hora = $hora.toString().padStart( 2,'0');
		$input.value = `${$hora}:${$min}`;

		$time.classList.add('none');
		$input.classList.remove('input-time-listening');
		$input.onkeyup();

		console.log( '\n');
		console.log(`%cCalled input_time_set:`, $n_color );
		console.log( $input );
		console.log( '\n');
	}
	function input_time_clear(){

		var $input	= document.querySelector('.input-time-listening');
		var $time	= document.querySelector('.time');
		var $hora	= document.querySelector('#time_hora');
		var $min	= document.querySelector('#time_min');
		var $mer	= document.querySelector('#time_mer');

		$hora	.value	= '';
		$min	.value	= '';
		$mer	.value	= '';
		$input.value	= '';

		$time.classList.add('none');
		$input.classList.remove('input-time-listening');
		$input.onkeyup();

		console.log( '\n');
		console.log(`%cCalled input_time_clear:`, $n_color );
		console.log( $input );
		console.log( '\n');
	}
	function remove_none( $target ){
		var $target = document.querySelector( $target );
		if( $target ){
			$target.classList.remove('none');
			$target.scrollIntoView();

			console.log( '\n');
			console.log(`%cCalled remove_none:`, $n_color );
			console.log( $target );
			console.log( '\n');
		}
	}
	function add_none( $target ){
		console.log(`add_none: %c${$target}`, 'background: #222; color: #bada55' );
		var $target = document.querySelector( $target );
		if( $target ){
			$target.classList.add('none');

			console.log( '\n');
			console.log(`%cCalled add_none:`, $n_color );
			console.log( $target );
			console.log( '\n');
		}
	}
</script>