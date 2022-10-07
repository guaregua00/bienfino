<?php

	#	sysconfig
		function sysconfig( string $x ){ switch ($x) {

			case 'title':
				return 'Sitema │ ';
			break;

			case 'app_color':
				if( $_SESSION['NIGHTWING'] )
					return array(

						/*Nightwind Color*/
						0 => '#151B24',				#	Color 20%
						1 => '#151B24'.'EE',		#	Color 20%
						2 => '#16A3B6',				#	Color 80%
						3 => '#16A3B6',				#	Color 50%
						'white' => '#0F1316'.'CC',
						'letter' => '#D67E5C',
					);
				else
					return array(

						/*APP Color*/
						0 => '#004466',				#	Color 20%
						1 => '#004466'.'CC',		#	Color 20%
						2 => '#99ddff',				#	Color 80%
						3 => '#00aaff',				#	Color 50%
						'white' => '#FFFFFF'.'CC',
						'letter' => '#212529',

					);
			break;

			case 'ciphering':
				return 'AES-256-CTR';
			break;

			case 'key_pass':
				return 'YG1XpY7';
			break;

			case 'key_check':
				return 'jO5C8eB';
			break;

			case 'key_iv':
				return '9414312859687740';
			break;
		}}
	#
	#	Encryptor
		class Encryptor{
			public function __construct(){

				$ciphering		= sysconfig('ciphering');
				$check_string	= sysconfig('key_check');
				$encryption_key = openssl_digest( sysconfig('key_pass'), 'MD5', true );
				$options		= 0;
				$this->config	= get_defined_vars();
			}
			public function encrypt( $string, $debug = false ){

				if( is_empty( $string ) )
					return null;

				if( $debug )
					printrt("Original String: {$string}");

				$string			= "{$this->config['check_string']}{$string}";
				$encryption_iv	= randhex( openssl_cipher_iv_length( $this->config['ciphering'] ), '0123456789' );
				$encryption		= openssl_encrypt(
					$string,
					$this->config['ciphering'],
					$this->config['encryption_key'],
					$this->config['options'],
					$encryption_iv
				);
				$encryption		= strtr( base64_encode( "{$encryption}•{$encryption_iv}" ), array( '=' => '' ) );

				if( $debug )
					dd("Encrypted String: {$encryption}" );

				return $encryption;
			}
			public function decrypt( $string, $debug = false ){

				if( is_empty( $string ) )
					return null;

				list( $encryption, $encryption_iv ) = explode('•', base64_decode( $string ), 2 );

				if( is_empty( $encryption_iv ) )
					return null;

				if( $debug )
					printrt("Original String: {$encryption}");

				$decryption = openssl_decrypt (
					$encryption,
					$this->config['ciphering'],
					$this->config['encryption_key'],
					$this->config['options'],
					$encryption_iv
				);


				if( substr( $decryption, 0, strlen( $this->config['check_string'] ) ) !== $this->config['check_string']  )
					return null;

				$decryption = substr( $decryption, strlen( $this->config['check_string'] ) );

				if( $debug )
					ddt("Decrypted String: {$decryption}" );

				return $decryption;
			}
			public function fixed_encrypt( $string, $debug = false ){

				if( is_empty( $string ) )
					return null;

				if( $debug )
					printr("Original String: {$string}");

				$string			= "{$this->config['check_string']}{$string}";
				$encryption		= openssl_encrypt(
					$string,
					$this->config['ciphering'],
					$this->config['encryption_key'],
					$this->config['options'],
					sysconfig('key_iv')
				);
				$encryption	= strtr( $encryption, array( '=' => '' ) );

				if( $debug )
					dd("Encrypted String: {$encryption}" );

				return $encryption;
			}
			public function fixed_decrypt( $string, $debug = false ){

				if( is_empty( $string ) )
					return null;

				if( $debug )
					printr("Original String: {$string}");

				$decryption = openssl_decrypt (
					$string,
					$this->config['ciphering'],
					$this->config['encryption_key'],
					$this->config['options'],
					sysconfig('key_iv')
				);

				if( substr( $decryption, 0, strlen( $this->config['check_string'] ) ) !== $this->config['check_string']  )
					return null;
				$decryption = substr( $decryption, strlen( $this->config['check_string'] ) );

				if( $debug )
					dd("Decrypted String: {$decryption}" );

				return $decryption;
			}
			public function encryptor_test( $string ){

				printr("Original String: {$string}");

				$encryption = $this->encrypt( $string );
				printr("Encrypted String: {$encryption}" );

				$decryption = $this->decrypt( $encryption );
				printr("Decrypted String: {$decryption}" );

				$encryption = $this->fixed_encrypt( $string );
				printr("Fixed Encrypted String: {$encryption}" );

				$decryption = $this->fixed_decrypt( $encryption );
				printr("Fixed Decrypted String: {$decryption}" );

				printr( array(
					'key_pass'	=> sysconfig('key_pass'),
					'key_check'	=> sysconfig('key_check'),
					'key_iv'	=> sysconfig('key_iv'),
				));

				dd( array(
					randhex( 7 ),
					randhex( 7 ),
					randhex( openssl_cipher_iv_length( sysconfig('ciphering') ), '0123456789' ),
				));
			}
		}
		function encrypt( $string = null, $debug = null ){
			return ( new Encryptor )->encrypt( $string, $debug );
		}
		function decrypt( $string = null, $debug = null ){
			return ( new Encryptor )->decrypt( $string, $debug );
		}
		function fixed_encrypt( $string = null, $debug = null ){
			return ( new Encryptor )->fixed_encrypt( $string, $debug );
		}
		function fixed_decrypt( $string = null, $debug = null ){
			return ( new Encryptor )->fixed_decrypt( $string, $debug );
		}
		function test_encrypt(){
			return ( new Encryptor )->encryptor_test( 'Test' );
		}
	#
	#
	#	Vendors Register
		spl_autoload_register( function( $called_class ) {
			$class	= explode('\\', $called_class );
			$root	= reset( $class );

			/**
			 * dompdf-master			Libreria PDF.
			 * lib						Liberia para DOMPDF.
			 * phpmailer-master			Libreria Mailer.
			 * phpspreadsheet-master	Libreria EXCEL.
			 * phpqrcode				Libreria QR
			 * simple-image-modified	Libreria Modificada de Edición de Imagenes
			 *
			 * simple-cache-master		Para PHPMailer y PHPSpreadsheet.
			 * zipstream-php-master		Para PHPSpreadsheet
			 * php-enum-master			Para zipstream-php-master.
			 */

			switch( $root ) {

				case 'Dompdf':
					array_shift( $class );

					/*Cpdf Fix*/
					if( reset( $class ) === 'Cpdf' ){
						$class	= implode('/', $class );
						$path	= root_folder."/vendors/dompdf-1.2.1/lib/{$class}.php";
						include $path;
					}

					/*DomPDF*/
					else{
						$class	= implode('/', $class );
						$path	= root_folder."/vendors/dompdf-1.2.1/src/{$class}.php";
						include $path;
					}
				break;
				case 'PHPMailer':
					$class	= end( $class );
					$path	= root_folder."/vendors/PHPMailer-6.5.0/{$class}.php";
					include $path;
				break;
				case 'PhpOffice':
					array_shift( $class );
					array_shift( $class );
					$class	= implode('/', $class );
					$path	= root_folder."/vendors/PhpSpreadsheet-1.17.1/{$class}.php";
					include $path;
				break;
				case 'Psr':
					$class	= array_pop( $class );
					$path	= root_folder."/vendors/simple-cache-1.0.1/{$class}.php";
					include $path;
				break;
				case 'ZipStream':
					array_shift($class);
					$class	= implode('/', $class );
					$path	= root_folder."/vendors/ZipStream-PHP-2.0.0/{$class}.php";
					include $path;
				break;
				case 'MyCLabs':
					array_shift($class);
					array_shift($class);
					$class	= implode('/', $class );
					$path	= root_folder."/vendors/php-enum-1.8.3/{$class}.php";
					include $path;
				break;
				case 'QRCode':
					include root_folder."/vendors/phpqrcode-2010100721_1.1.4/qrlib.php";
				break;
				case 'SimpleImage':
					include root_folder."/vendors/simple-image-modified/simple-image.php";
				break;
			}
		});
	#
	#	end_alert
		function end_alert( $message = null ){
			return_json( array(
				'end'	=> 1,
				'alert' => $message,
			));
			die();
		}
	#
	#	file_to_base64
		function file_to_base64( string $path ) {
			$mime = get_mime_by_path( $path );
			$data = base64_encode( file_get_contents( $path ) );
			return "data:{$mime}:base64,{$data}";
		}
	#
	#	randhex
		function randhex( $int = 20, $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789' ){
			return substr( str_shuffle( "{$salt}{$salt}{$salt}{$salt}" ), 0, $int );
		}
	#
	#	printr
		function printr( $x = null ){

			echo '<pre>';print_r( $x );echo '</pre>';
			echo '
				<style>
					body{
						background:		'.sysconfig('app_color')[1].';
					}
					pre{
						padding:		1em;
						border-radius:	5px;
						background:		'.sysconfig('app_color')[1].';
						color:			'.sysconfig('app_color')[2].';
						font-weight:	bold;
					}
				</style>
			';
			echo "\n";
		}
	#
	#	printrt
		function printrt( $x = null ){

			header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
			header('Pragma: no-cache');
			header('Content-type: text/plain');
			header('Content-disposition: inline; filename="log.txt"');

			print_r( $x );
			print_r("\n");
		}
	#
	#	ddt
		function ddt( $x = null ){
			printrt( $x );
			die();
		}
	#
	#	dd
		function dd( $x = null ){
			printr( $x );
			die();
		}
	#
	#	ip
		function ip(){

			if( $_SERVER['REMOTE_ADDR'] === '::1' )
				return '127.0.0.1';

			else
				return $_SERVER['REMOTE_ADDR'];
		}
	#
	#	in_strpos
		function in_strpos( $string = null, $array = null ){
			foreach( $array AS $value )
				if( $string === $value )
					return true;
			return false;
		}
	#
	#	return_json
		function return_json( $extras = array() ){
			header('Content-Type: application/json');
			header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
			header('Pragma: no-cache');
			echo tojson( $extras );
			die();
		}
	#
	#	delete_files
		function delete_files( $directory = array() ) {

			#	Delete File First
				foreach( $directory AS $key => $file )
					if( realpath( $file ) )
						if( is_file( $file ) ){
							unlink( $file );
							unset( $directory[ $key ] );
						}
			#
			#	Delete Folders After
				foreach( $directory AS $file )
					if( realpath( $file ) )
						if( is_dir( $file ) )
							rmdir( $file );
			#
		}
	#
	#	create_folder_path
		function create_folder_path( $path ){

			#	Parametrize Folder Path
				$path = strtr( $path, array( '/' => '•' ) );
				$path = strtr( $path, array( '\\' => '•' ) );
				$path = explode('•', $path );
				array_pop( $path );
			#
			#	Add Missing Folders
				$explorer = '';
				foreach( $path AS $folder ){

					$explorer .= "{$folder}/";

					if( !is_dir( $explorer ) )
						mkdir( $explorer );
				}
			#
		}
	#
	#	get_meses
		function get_meses(){ return array(
			'01' =>	'enero',
			'02' =>	'febrero',
			'03' =>	'marzo',
			'04' =>	'abril',
			'05' =>	'mayo',
			'06' =>	'junio',
			'07' =>	'julio',
			'08' =>	'agosto',
			'09' =>	'septiembre',
			'10' =>	'octubre',
			'11' =>	'noviembre',
			'12' =>	'diciembre',

			# Meses en 1 Año -Nombres-
		);}
	#
	#	get_mes
		function get_mes( $x ){ switch( (int)$x ){
			case 1:  return 'enero';	  break;
			case 2:  return 'febrero';	  break;
			case 3:  return 'marzo';	  break;
			case 4:  return 'abril';	  break;
			case 5:  return 'mayo';		  break;
			case 6:  return 'junio';	  break;
			case 7:  return 'julio';	  break;
			case 8:  return 'agosto';	  break;
			case 9:  return 'septiembre'; break;
			case 10: return 'octubre';	  break;
			case 11: return 'noviembre';  break;
			case 12: return 'diciembre';  break;

			# Obtener mes por Número
		}}
	#
	#	get_anios
		function get_anios( $int = 0 ){

			$actual = (int)date('Y') + $int;
			$limit	= $actual - 100;

			$to_return = array();
			for( $x = $actual; $x >= $limit; $x-- )
				$to_return[] = (string)$x;

			return $to_return;

			# Cantidad de años en 100 años hasta la actualidad
		}
	#
	#	user
		function user(){
			$user = $_SESSION['USER'];
			if( is_null( $user ) )
				return null;
			else
				return ( clone $user );
		}
	#
	#	recursive_files_in
		function recursive_files_in(
			$path				= null,
			$full_path			= 'full_path',
			$recursive			= 'recursive',
			$include_folders	= 'include_folders',
			$exclusions			= array()
		){
			#	Scan
				$path = realpath( $path );
				if( !$path )
					return array();

				$return	= array();
				$scandir= scandir( $path );
				array_shift( $scandir );
				array_shift( $scandir );
				foreach( $scandir AS $file ){
					unset( $scandir );

					#	Excluded Files
						if( in_strpos( $file , $exclusions ) )
							continue;
					#
					#	File Scan
						$file = "{$path}/{$file}";
						if( is_file( $file ) ){

							if( $full_path !== 'full_path' )
								$file = substr( $file, strlen( $path ) + 1 );

							if( $include_folders !== 'only_folders' )
								$return[] = $file;
						}
					#
					#	Folder Scan
						elseif( is_dir( $file ) ){

							#	Copy Var
								$copy = $file;
							#
							#	Relative Path
								if( $full_path !== 'full_path' )
									$file = substr( $file, strlen( $path ) + 1 );
							#
							#	Include Folder
								if(
									$include_folders === 'include_folders' ||
									$include_folders === 'only_folders'
								)
									$return[] = $file;
							#
							#	Scan Folder
								if( $recursive === 'recursive' ){

									$subfiles = recursive_files_in( $copy, 'full_path', $recursive, $include_folders, array() );

									foreach( $subfiles AS $file ){

										if( $full_path !== 'full_path' )
											$file = substr( $file, strlen( $path ) + 1 );

										$return[] = $file;
									}
								}
							#
						}
					#
				}
			#
			#	Return
				return $return;
			#
		}
	#
	#	count_files_in
		function count_files_in(
			$path				= null,
			$full_path			= 'full_path',
			$recursive			= 'recursive',
			$include_folders	= 'include_folders',
			$exclusions			= array()
		){
			return count( recursive_files_in( $path, $full_path, $recursive, $include_folders, $exclusions ) );
		}
	#
	#	excel_new
		function excel_new(){
			$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
			$sheet		 = $spreadsheet->getActiveSheet();
			return array( $spreadsheet, $sheet );
		}
	#
	#	excel_read
		function excel_read( string $path ){
			/*Prepare Reader*/
			$file			= realpath( $path );
			$type			= PhpOffice\PhpSpreadsheet\IOFactory::identify( $file );
			$reader			= PhpOffice\PhpSpreadsheet\IOFactory::createReader( $type );
			$spreadsheet	= $reader->load( $file );
			$sheet			= $spreadsheet->getActiveSheet();
			return array( $spreadsheet, $sheet );
		}
	#
	#	excel_cell
		function excel_cell( $sheet, $coords, $value, $border = false, $letter = false, $fill = false ){

			#	Cell Value
				$sheet->getCell( $coords )
					->setValueExplicit(
						$value,
						PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2
					)
				;
			#
			#	Cell Boder
				if( $border != false )
					$sheet->getStyle( $coords )
						->getBorders()
						->getOutline()
						->setBorderStyle(
							PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
						)
						->getColor()
						->setRGB( $border )
					;
			#
			#	Cell Letter Color
				if( $letter != false )
					$sheet->getStyle( $coords )
						->getFont()
						->getColor()
						->setARGB( $letter )
					;
			#
			#	Cell Fill Color
				if( $fill != false )
					$sheet->getStyle( $coords )
						->getFill()
						->setFillType(
							PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
						)
						->getStartColor()
						->setARGB( $fill )
					;
			#

			return $sheet;
		}
	#
	#	excel_write
		function excel_write( $spreadsheet, $name, $output = 'php://output' ){

			/*Make Header*/
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header("Content-Disposition: attachment; filename=\"{$name}.xlsx\"");

			/*Write*/
			$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx( $spreadsheet );
			$writer->save( $output );
		}
	#
	#	excel_view
		function excel_view( array $excel ){

			#	Return IF Not Query
				if( strlen( $excel['sql'] ) === 0 )
					return false;
			#
			#	EXCEL OR CSV
				$limit = 10000;
				$count = sql_pdo()->query( $excel['count'] )->fetchColumn();

				if( $count === 0 )
					return;

				#	Get
					$results = sql_pdo()->query( $excel['sql'] )->fetchAll( 2 );
				#
				#	Apply Headers
					$c		 = 'a';
					$f		 = 1;
					$headers = array_keys( reset( $results ) );
					list( $spreadsheet, $sheet ) = excel_new();
					foreach( $headers AS $header ){

						#	Set Value
							$sheet = excel_cell( $sheet, "{$c}{$f}", $header, $border = '000000', $letter = 'FFFFFF', $fill = '000000' );
						#
						#	Next
							$c++;
						#
					}
				#
				#	Apply Values
					$c = 'a'; $f++;
					foreach( $results AS $row ){
						unset( $results );

						foreach( $row AS $val ){
							unset( $row );

							#	Cell Value
								$sheet = excel_cell( $sheet, "{$c}{$f}", $val, $border = '000000', $letter = '000000', $fill = 'FFFFFF' );
							#	Next
								$c++;
							#
							unset( $val );
						}

						$c = 'a'; $f++;
					}
				#
				#	Write Excel
					excel_write( $spreadsheet, $excel['name'] );
					die();
				#
		}
	#
	#	excel_pdf
		function excel_pdf( $spreadsheet, $name, $output = 'php://output' ){
			header('Content-Type: application/pdf');
			header("Content-Disposition: attachment; filename=\"{$name}.pdf\"");
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf( $spreadsheet );
			$writer->save( $output );
		}
	#
	#	pdf_view
		function pdf_view( array $pdf ){

			/**
			 * $pdf => array(
			 *		'name'			=> '',
			 *		'file'			=> '',				# <- pdf.blade
			 *		'extras'		=> array(),
			 *		'store_path'	=> '',				# <- resource_folder.'/storepath.pdf'
			 * )
			 */
			extract( $pdf );
			unset( $pdf );

			$path = realpath( views_folder."/{$file}.blade.php" );

			if( !$path )
				dd( "pdf_view: PDF {$file}.blade.php no encontrado" );

			if( is_null( $extras ) )
				$extras = array();

			$pdf	= return_view( $file, $extras, 'return' ); unset( $extras );
			$dompdf	= new Dompdf\Dompdf();

			$dompdf->loadHtml( $pdf );
			$dompdf->render();

			if( strlen( $store_path ) !== 0 ){
				$store_path	= resources_folder."/{$store_path}";
				create_folder_path( $store_path );
				file_put_contents( $store_path, $dompdf->output() );
			}

			$name = end( explode('/', fragment_url ) );
			$date = date('d_m_Y-h_i_s_a');
			$dompdf->stream( "{$name}_{$date}", array('Attachment' => false ));
			die();
		}
	#
	#	zip_folder
		function zip_folder( $path, $files, $relative, $pass = null ){

			#	Prepare Zip
				create_folder_path( $path );
				$zip = new ZipArchive();
				$zip->open(
					$path,
					ZipArchive::CREATE | ZipArchive::OVERWRITE
				);
			#
			#	Zip Files
				foreach( $files AS $k => $f ){
					$zip->addFile( $f, $relative[ $k ] );
					if( strlen( $pass ) !== 0 )
						$zip->setEncryptionName( $relative[ $k ], ZipArchive::EM_AES_256, $pass );
				}
			#
			#	End
				$zip->close();
			#
		}
	#
	#	humanize_phone
		function humanize_phone( $phone = null ){

			if( is_empty( $phone ) )
				return null;

			#04143302564
			$a1 = substr( $phone, 0, 4 );
			$a2 = substr( $phone, 4, 3 );
			$a3 = substr( $phone, 7 );

			return "{$a1}-{$a2}-{$a3}";
		}
	#
	#	humanize_date
		function humanize_date( $date = null, $method = 'long', $force = null ){

			if( !istimestamp( $date ) )
				return null;

			if( strlen( $date ) > 19 )
				$date = substr( $date, 0, 19 );

			$extra	= null;
			list( $anio, $mes, $dia ) = explode('-', $date, 3 );
			if( strlen( $date ) === 19 ){

				list( $dia, $timestamp )	= explode(' ', $dia, 2 );
				list( $hora, $min, $seg )	= explode(':', $timestamp, 3 );

				$hours = (int)$hours;

				if( $hora < 12 ){
					$mer = 'AM';
					$hora = sprintf( '%02d', $hora );
				}
				elseif( $hora === 12 )
					$mer = 'PM';
				elseif( $hora > 12 ){
					$hora = sprintf( '%02d', $hora - 12 );
					$mer = 'PM';
				}

				if( $method === 'long' )
					$extra = " <br>{$hora}:{$min}:{$seg} {$mer}";
				else
					$extra = " {$hora}:{$min}:{$seg} {$mer}";
			}

			if( $method === 'long' ){

				$mes = get_mes( $mes );
				if( $force === true )
					return "{$dia} de {$mes} de {$anio}";
				else
					return "{$dia} de {$mes} de {$anio}{$extra}";
			}
			else{
				if( $force === true )
					return "{$dia}/{$mes}/{$anio}";
				else
					return "{$dia}/{$mes}/{$anio}{$extra}";
			}
		}
	#
	#	humanize_time
		function humanize_time( $time = null, $method = 12 ){

			list( $hours, $mins ) = explode('.', $time, 2 );

			$hours	= (int)$hours;
			$mins	= (int)$mins;

			if( $method === 12 ){


				if( $hours > 12 ){
					$hours	-=12;
					$mer	= 'PM';
					$hours	= sprintf( '%02d', $hours );
				}
				elseif( $hours === 12 )
					$mer	= 'PM';
				else{
					$mer = 'AM';
					$hours	= sprintf( '%02d', $hours );
				}

				$mins = sprintf( '%02d', $mins );

				return "{$hours}:{$mins} {$mer}";
			}

			else{

				$hours	= sprintf( '%02d', $hours );
				$mins = sprintf( '%02d', $mins );

				return "{$hours}:{$mins}";
			}
		}
	#
	#	php_captcha_generator
		function php_captcha_generator(){

			#	Basic Data
				$height		= 50;	/*Alto*/
				$width		= 199;	/*Ancho*/
			#
			#	Create Img
				$image = @imagecreatetruecolor( $width, $height ) or die('No puedo inicializar Imagen Stream');
			#
			#	Create Background
				imagefill(
					$image, 0, 0,
					imagecolorallocate( $image, rand(1,90), rand(1,90), rand(1,90) ) 			/*Color Fondo*/
				);
			#
			#	Create Lines
				for( $x=0; $x < 30 ; $x++ ){
					imagesetthickness(
						$image,
						rand( 5, 10 ) 															/*Grueso de Linea*/
					);
					imageline(
						$image, 0,
						rand( 0, $height + ( $height / 2 ) ), 									/*Posicion de Linea*/
						$width,
						rand( 0, $height ),														/*Inclinacion de Linea*/
						imagecolorallocate( $image, rand(1,100), rand(1,100), rand(1,100) )		/*Color de Linea*/
					);
				}
			#
			#	Add Text
				$s = 5;
				$text		= randhex( 5 );									/*Cantidad de Texto*/
				$spacing	= $width / strlen( $text );
				$text		= strtr( $text, array(
					'O'	=> randhex( 1 ),
					'0'	=> randhex( 1 ),
					'I' => randhex( 1 ),
					'l' => randhex( 1 ),
				));
				$_SESSION['CAPTCHA'] = strtoupper( $text );

				for( $x = 0, $len = strlen( $text ); $x < $len; $x++ ){
					imagechar(
						$image,
						rand( 5, 10 ),										/*Tamaño de Letra*/
						rand( $s, $s + ( $spacing / 2 ) ),					/*Posicion de la letra en X*/
						rand( 1, $height-15 ),								/*Posicion de la letra en Y*/
						$text[ $x ],
						imagecolorallocate( $image, rand(101,255), rand(101,255), rand(101,255) )	/*Color de Letra*/
					);
					$s += $spacing;
				}
			#
			#	Display
				header('Pragma: no-cache');
				header('Cache-Control: max-age=0, no-store, no-cache, must-revalidate');
				header('Content-type: image/png');
				imagepng( $image );
				imagedestroy( $image );
			#
		}
	#
	#	totable
		function is_empty( $obj ){

			if( is_array( $obj ) ){
				return clean_spaces( $obj ) === array();
			}
			elseif( is_object( $obj ) )
				return clean_spaces( (array)$obj ) === array();
			else
				return strlen( $obj ) === 0;
		}
		function clean_val( $type, $val ){

			switch( $type ) {
				case 'varchar':
					return sql_varchar( $val );
				break;
				case 'boolean':
					return sql_bol( $val );
				break;
				case 'int8':
					return sql_int8( $val );
				break;
				case 'int':
					return sql_int( $val );
				break;
				case 'float':
					return sql_float( $val );
				break;
				case 'time':
					return sql_time( $val );
				break;
				case 'timestamp':
					return sql_timestamp( $val );
				break;
				case 'date':
					return sql_date( $val );
				break;
				case 'raw':
					return $val;
				break;
				default:
					ddt( "Tipo \"{$type}\" no conseguido para \"{$val}\""  );
				break;
			}
		}
		function complex_select( $select, $sep, $find = array(), $debug = null ){

			$select = clean_spaces( explode("\",", $select ) );

			if( $find === array() ){

				$colector = array();
				foreach( $select AS $x => $query ){
					list( $query, $alias ) = explode(" AS \"", $query, 2 );
					$colector[] = $query;
				}
				$colector = 'CONCAT( '.implode( ", '{$sep}', ", $colector ).')';

				if( $debug )
					ddt( $colector );

				return $colector;
			}

			else{

				$colector = [];
				foreach( $select AS $x => $query ){
					list( $query, $alias ) = explode(" AS \"", $query, 2 );
					if( in_strpos( $alias, $find ) )
						$colector[] = $query;
				}
				$colector = 'CONCAT( '.implode( ", '{$sep}', ", $colector ).')';

				if( $debug )
					ddt( $colector );

				return $colector;
			}
		}
		function extract_select( $select, $find = null, $debug = null ){

			$select = clean_spaces( explode("\",", $select ) );

			if( $find === null ){

				foreach( $select AS $x => $query ){
					list( $query, $alias ) = explode(" AS \"", $query, 2 );
					unset( $select[ $x ] );
					$select[ $alias ] = $query;
				}

				if( $debug )
					ddt( $select );

				return $select;
			}

			else{

				$return = '';
				foreach( $select AS $x => $query ){
					list( $query, $alias ) = explode(" AS \"", $query, 2 );
					if( $alias === $find ){
						$return = $query;
						break;
					}
				}

				if( $debug )
					ddt( $return );

				return $return;
			}
		}
		function create_new_filter2( $where, $get, $method, $col, $debug = null ){

			/*if( $debug )
				ddt( get_defined_vars() );*/

			$get = clean_spaces( $_SESSION[ $get ] );

			if( is_empty( $get ) )
				return $where;

			$return = strpos( $where, 'WHERE') === false ?
				'WHERE ':
				"{$where} AND "
			;

			list( $type, $op ) = explode(':', $method );

			switch( $op ) {

				case 'like':
					$get = clean_val( $type, $get );
					if( $type === 'varchar' ){
						$col = "LOWER( {$col} )";
						$get = "LOWER( {$get} )";
					}
					return "{$return}{$col} LIKE CONCAT( '%', {$get}, '%' )";
				break;

				case 'between':

					if( !is_array( $get ) )
						return $where;

					$get1 = clean_val( $type, $get[0] );
					$get2 = clean_val( $type, $get[1] );

					return "{$return}{$col} BETWEEN {$get1} AND {$get2}";
				break;

				case 'isnull':
					return "{$return}{$col} IS NULL";
				break;

				case 'isnotnull':
					return "{$return}{$col} IS NOT NULL";
				break;

				default:
					ddt( "Operador para \"{$op}\" no encontrado en create_new_filter" );
				break;
			}
		}

		function create_new_filter( $where, $get, $method, $col, $debug = null ){

			/*if( $debug )
				ddt( get_defined_vars() );*/

			$get = clean_spaces( $_GET[ $get ] );

			if( is_empty( $get ) )
				return $where;

			$return = strpos( $where, 'WHERE') === false ?
				'WHERE ':
				"{$where} AND "
			;

			list( $type, $op ) = explode(':', $method );

			switch( $op ) {

				case 'like':
					$get = clean_val( $type, $get );
					if( $type === 'varchar' ){
						$col = "LOWER( {$col} )";
						$get = "LOWER( {$get} )";
					}
					return "{$return}{$col} LIKE CONCAT( '%', {$get}, '%' )";
				break;

				case 'between':

					if( !is_array( $get ) )
						return $where;

					$get1 = clean_val( $type, $get[0] );
					$get2 = clean_val( $type, $get[1] );

					return "{$return}{$col} BETWEEN {$get1} AND {$get2}";
				break;

				case 'isnull':
					return "{$return}{$col} IS NULL";
				break;

				case 'isnotnull':
					return "{$return}{$col} IS NOT NULL";
				break;

				default:
					ddt( "Operador para \"{$op}\" no encontrado en create_new_filter" );
				break;
			}
		}
		function totable( $select, $body, $extra, $limit, $debug ){
			$class = new class( $select, $body, $extra, $limit, $debug ){
				public function __construct( $select, $body, $extra, $limit, $debug ){

					$this->select	= $select;
					$this->body		= $body;
					$this->extra	= $extra;
					$this->limit	= $limit;
					$this->debug	= $debug;

					$this->offset();
					$this->prepare_sql();
					$this->execute_sql();
					$this->table();
				}

				private function offset(){
					$_GET['pag']	= $_GET['pag'] ? (int)$_GET['pag'] : 1;
					$offset			= ( $_GET['pag'] - 1 ) * $this->limit;
					$this->offset	= $offset;
				}

				private function prepare_sql(){
					$this->sql		= strtr( $this->body, array( '[select]' => $this->select ) );
					$this->count	= strtr( $this->body, array( '[select]' => 'COUNT(*)' ) );
					unset( $this->select, $this->body );
				}

				private function execute_sql(){
					$pdo = sql_pdo();

					try {
						$this->r_sql	= $pdo->query( "{$this->sql} {$this->extra}" )->fetchAll();
						$this->r_count	= $pdo->query( $this->count )->fetchColumn();
					}catch( Exception $e ){ if( $this->debug === 1 ) ddt( $e ); }

					if( $this->debug === 2 ){
						printrt( $this->sql );
						ddt( $this->count );
					}

					$_SESSION['EXCEL']['SQL']		= "{$this->sql} {$this->extra}";
					$_SESSION['EXCEL']['COUNT']		= $this->count;
					$_SESSION['EXCEL']['NAME']		= end( explode('/', fragment_url ) );

					unset( $this->sql, $this->count );
				}

				private function table(){
					$pags	= ceil( $this->r_count / $this->limit );
					$pag	= $_GET['pag'];
					$this->table = array(
						'total'	=> $this->r_count,
						'data'	=> $this->r_sql,
						'pag'	=> $pag,
						'pags'	=> $pags,
						'next'	=> $pag < $pags,
						'prev'	=> $pag > 1,
					);

					unset( $this->r_count, $this->r_sql );
				}

				public function return(){
					return $this->table;
				}
			};

			return $class->return();
		}
	#
	#	return_error
		function return_error( $string ){
			$to_return = array();
			list( $input, $error ) = explode(' = ', $string, 2 );
			return_json( array( 'error' => array( $input => $error ) ) );
		}
	#
	#	return_errors
		function return_errors( $error ){
			return_json( compact( 'error' ) );
		}
	#
	#	store_alert
		function store_alert( $string ){
			$_SESSION['ALERT'] = $string;
		}
	#
	#	return_success
		function return_success( $success ){
			return_json( array( 'success' => $success ));
		}
	#
	#	get_mime_by_path
		function get_mime_by_path( $path ){

			$ext = substr( $path, strrpos( $path, '.') );

			switch( $ext ) {

				case 'css':
					return 'text/css';
				break;

				case 'js':
					return 'application/javascript';
				break;

				case 'jpg':
				case 'png':
					return 'image/png';
				break;

				case 'gif':
					return 'image/gif';
				break;

				case 'bin':
				case 'bak':
					return 'application/octet-stream';
				break;

				case 'zip':
					return 'application/x-compressed';
				break;

				default:
					return mime_content_type( $path );
				break;
			}
		}
		function get_ext_by_path( $path ){

			$ext = substr( $path, strrpos( $path, '.') );

			switch( $ext ) {

				case 'text/css':
					return '.css';
				break;

				case 'application/javascript':
					return '.js';
				break;

				case 'image/jpeg':
				case 'image/png':
					return '.png';
				break;

				case 'image/gif':
					return '.gif';
				break;

				default:
					ddt( "get_ext_by_path: extensión \"{$ext}\" no registrada" );
				break;
			}
		}
	#
	#	php_qr
		function php_qr( $string ){
			ob_flush();
			ob_start();
				QRCode::png( $string, null, QR_ECLEVEL_L );
			$data = base64_encode( ob_get_clean() );
			return "data:image/jpeg;base64,{$data}";
		}
	#
	#	validator
		function clean_spaces( $obj ){

			if( is_string( $obj ) )
				$obj = preg_replace( '~\s+~', ' ', trim( $obj ) );

			elseif( is_array( $obj ) ){
				foreach( $obj AS $k => $v ){
					$v = clean_spaces( $v );
					if( is_empty( $v ) )
						unset( $obj[ $k ] );
					else
						$obj[ $k ] = $v;
				}
			}

			elseif( is_object( $obj ) ){
				foreach( $obj AS $k => $v ){
					$v = clean_spaces( $v );
					if( is_empty( $v ) )
						unset( $obj->{$k} );
					else
						$obj->{$k} = $v;
				}
			}

			return $obj;
		}
		class validator{

			public function __construct( $rules, $method ){

				$this->input		= $method === 'POST' ? $_POST : $_GET ;
				$this->rules		= $rules;
				$this->name			= array();
				$this->prepend		= array();
				$this->append		= array();
				$this->min			= array();
				$this->max			= array();
				$this->is_ausent	= array();
				$this->has_errors	= array();
				$this->errors		= array();

				foreach( array_keys( $rules ) AS $i ){

					$this->has_name(	$i );
					$this->has_prepend(	$i );
					$this->has_append(	$i );
					$this->is_ausent(	$i );
					$this->is_required(	$i );

					if( $this->is_ausent[ $i ] )
						continue;

					$this->varchar_rule( $i );
					$this->number_rule( $i );
					$this->float_rule( $i );
					$this->time_rule( $i );
					$this->date_rule( $i );
					$this->timestamp_rule( $i );
					$this->email_rule( $i );
					$this->telefono_rule( $i );
					$this->rifj_rule( $i );
					$this->rifp_rule( $i );
					$this->bol_rule( $i );
					$this->num_between_rule( $i );
					$this->min_max_rule( $i );
					$this->equal_rule( $i );
					$this->exact_rule( $i );
					$this->exist_in_rule( $i );
					$this->not_exist_in_rule( $i );
					$this->in_strpos_rule( $i );
					$this->not_in_strpos_rule( $i );
				}

				$this->message_errors();
			}

			public function has_name( $i ){

				if( ( $pos = strpos( $this->rules[ $i ], '|input:' ) ) === false ){
					$this->name[ $i ] = $i;
					return;
				}

				$frag = substr( $this->rules[ $i ], $pos + 7 );
				$frag = substr( $frag, 0, strpos( $frag, '|') );

				$this->name[ $i ] = $frag;
			}

			public function has_prepend( $i ){

				if( ( $pos = strpos( $this->rules[ $i ], '|prepend:' ) ) === false )
					return;

				$frag = substr( $this->rules[ $i ], $pos + 9 );
				$frag = substr( $frag, 0, strpos( $frag, '|') );

				$this->prepend[ $i ] = $frag;
			}

			public function has_append( $i ){

				if( ( $pos = strpos( $this->rules[ $i ], '|append:' ) ) === false )
					return;

				$frag = substr( $this->rules[ $i ], $pos + 8 );
				$frag = substr( $frag, 0, strpos( $frag, '|') );

				$this->append[ $i ] = $frag;
			}

			public function is_ausent( $i ){
				$this->is_ausent[ $i ] = is_empty( $this->input[ $i ] );
			}

			public function is_required( $i ){

				if( strpos( $this->rules[ $i ], '|required|' ) === false )
					return;

				if( $this->is_ausent[ $i ] ){
					$this->errors[ $i ]		= 'required';
					$this->has_errors[ $i ]	= true;
				}
			}

			/*Rules*/
				public function varchar_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( strpos( $this->rules[ $i ], '|varchar|' ) === false )
						return;

					if( !preg_match('^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s+]$', $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'varchar';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function number_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( strpos( $this->rules[ $i ], '|number|' )	=== false )
					if( strpos( $this->rules[ $i ], '|numbers|' )	=== false )
						return;

					if( !preg_match('~^[0-9]+(\.[0-9]{3})*(\,[0-9]{1,})*$~', $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'number';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function float_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( strpos( $this->rules[ $i ], '|float|' )	=== false )
						return;

					if( !preg_match('~^[0-9]+(\.[0-9]{3})*(\,[0-9]{1,}){*}$~', $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'float';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function time_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( strpos( $this->rules[ $i ], '|time|' )	=== false )
						return;

					if( !istime( $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'time';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function date_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( strpos( $this->rules[ $i ], '|date|' )	=== false )
						return;

					if( !isdate( $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'date';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function timestamp_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( strpos( $this->rules[ $i ], '|timestamp|' )	=== false )
						return;

					if( !istimestamp( $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'timestamp';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function email_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|email|' ) ) === false )
						return;

					if( !preg_match('~^[a-zA-Z0-9\.]{3,}@[a-z]{3,}\.[a-z]{2,3}$~', $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'email';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function telefono_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|telefono|' ) ) === false )
						return;

					if( !preg_match('~^[0-9]{10}$~', $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'telefono';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function rifj_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|rifj|' ) ) === false )
						return;

					if( !preg_match('~^(J){1}-[0-9]+-[0-9]{1}$~', $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'rifj';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function rifp_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|rifp|' ) ) === false )
						return;

					if( !preg_match('~^(V|E){1}[0-9]+$~', $this->input[ $i ] ) ){
						$this->errors[ $i ]		= 'rifp';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function bol_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|bol:' ) ) === false )
						return;

					$frag = substr( $this->rules[ $i ], $pos + 4 );
					$frag = substr( $frag, 0, strpos( $frag, '|') );
					list( $min, $max ) = explode('-', $frag, 2 );

					if( $min === $max ){
						if( $this->input[ $i ] !== $max ){
							$this->errors[ $i ]		= 'bol';
							$this->max[ $i ]		= $max;
							$this->has_errors[ $i ]	= true;
						}
					}
					else{
						if( $this->input[ $i ] !== $min )
						if( $this->input[ $i ] !== $max ){
							$this->errors[ $i ]		= 'bol';
							$this->min[ $i ]		= $min;
							$this->max[ $i ]		= $max;
							$this->has_errors[ $i ]	= true;
						}
					}
				}

				public function num_between_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|num_between:' ) ) === false )
						return;

					$frag = substr( $this->rules[ $i ], $pos + 13 );
					$frag = substr( $frag, 0, strpos( $frag, '|') );
					list( $min, $max ) = explode('-', $frag, 2 );

					if(
						(int)$this->input[ $i ] < (int)$min ||
						(int)$this->input[ $i ] > (int)$max
					){
						$this->errors[ $i ]		= 'num_between';
						$this->min[ $i ]		= $min;
						$this->max[ $i ]		= $max;
						$this->has_errors[ $i ]	= true;
					}
				}

				public function min_max_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|min_max:' ) ) === false )
						return;

					$frag = substr( $this->rules[ $i ], $pos + 9 );
					$frag = substr( $frag, 0, strpos( $frag, '|') );
					list( $min, $max ) = explode('-', $frag, 2 );

					if( $min === $max ){
						if( strlen( (string)$this->input[ $i ] ) !== (int)$max ){
							$this->errors[ $i ]		= 'min_max_2';
							$this->max[ $i ]		= $max;
							$this->has_errors[ $i ]	= true;
						}
					}
					else{
						if(
							strlen( (string)$this->input[ $i ] ) < $min ||
							strlen( (string)$this->input[ $i ] ) > $max
						){
							$this->errors[ $i ]		= 'min_max_1';
							$this->min[ $i ]		= $min;
							$this->max[ $i ]		= $max;
							$this->has_errors[ $i ]	= true;
						}
					}
				}

				public function equal_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|equal:' ) ) === false )
						return;

					$frag = substr( $this->rules[ $i ], $pos + 7 );
					$frag = substr( $frag, 0, strpos( $frag, '|') );

					if( $this->input[ $i ] !== $this->input[ $frag ] ){
							$this->errors[ $i ]		= 'equal';
							$this->has_errors[ $i ]	= true;
					}
				}

				public function exact_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|exact:' ) ) === false )
						return;

					$frag = substr( $this->rules[ $i ], $pos + 7 );
					$frag = substr( $frag, 0, strpos( $frag, '|') );


					if( $this->input[ $i ] !== $frag ){
							$this->errors[ $i ]		= 'exact';
							$this->has_errors[ $i ]	= true;
					}
				}

				public function exist_in_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|exist_in:' ) ) === false )
						return;

					$frag	= substr( $this->rules[ $i ], $pos + 10 );
					$frag	= substr( $frag, 0, strpos( $frag, '|') );
					list( $type, $table, $col ) = explode(',', $frag, 3 );
					$v = clean_val( $type, $this->input[ $i ] );

					$check = sql_pdo()->query("
						SELECT	1
						FROM	{$table}
						WHERE	{$col} = {$v}
						LIMIT	1
					")
					->fetchColumn();

					if( !$check ){
						$this->errors[ $i ]		= 'exist_in';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function not_exist_in_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|not_exist_in:' ) ) === false )
						return;

					$frag	= substr( $this->rules[ $i ], $pos + 14 );
					$frag	= substr( $frag, 0, strpos( $frag, '|') );
					list( $type, $table, $col ) = explode(',', $frag, 3 );
					$v = clean_val( $type, $this->input[ $i ] );

					$check = sql_pdo()->query("
						SELECT	1
						FROM	{$table}
						WHERE	{$col} = {$v}
						LIMIT	1
					")
					->fetchColumn();

					if( $check ){
						$this->errors[ $i ]		= 'not_exist_in';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function in_strpos_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|in_strpos:' ) ) === false )
						return;

					$frag = substr( $this->rules[ $i ], $pos + 11 );
					$frag = substr( $frag, 0, strpos( $frag, '<<|') );
					$frag = dejson( $frag );

					if( !in_strpos( $this->input[ $i ], $frag ) ){
						$this->errors[ $i ]		= 'in_strpos';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function not_in_strpos_rule( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|not_in_strpos:' ) ) === false )
						return;

					$frag = substr( $this->rules[ $i ], $pos + 15 );
					$frag = substr( $frag, 0, strpos( $frag, '<<|') );
					$frag = dejson( $frag );

					if( in_strpos( $this->input[ $i ], $frag ) ){
						$this->errors[ $i ]		= 'not_in_strpos';
						$this->has_errors[ $i ]	= true;
					}
				}
			/**/

			public function message_errors(){

				$errors		= array();
				$messages	= $this->messages();
				foreach( $this->errors AS $i => $m ){

					$name		= $this->name[ $i ];
					$prepend	= $this->prepend[ $i ];
					$append		= $this->append[ $i ];
					$message	= "{$prepend}{$messages[ $m ]}{$append}";

					/*Append Min*/
					if( strpos( $message, '[min]') !== false ){
						$min		= $this->min[ $i ];
						$message	= strtr( $message, array( '[min]' => $min ) );
					}

					/*Append Max*/
					if( strpos( $message, '[max]') !== false ){
						$max		= $this->max[ $i ];
						$message	= strtr( $message, array( '[max]' => $max ) );
					}

					$errors[ $name ] = $message;
				}
				$this->errors = $errors;
			}

			public function messages(){
				return array(
					'bol'			=> 'Este campo debe tener un valor entre <b>[min]</b> o <b>[max]</b>',
					'date'			=> 'Este campo debe ser una <b>fecha válida</b>',
					'email'			=> 'Este campo debe ser un <b>email válido</b> en el siguiente formato: <b>usuario@dominio.com</b>',
					'telefono'		=> 'Este campo debe ser un <b>teléfono válido</b> en el siguiente formato: <b>04141234567</b>',
					'equal'			=> 'Estos campo <b>no poseen</b> el mismo valor',
					'exact'			=> 'Este campo <b>no posee</b> el valor esperado',
					'exist_in'		=> '<b>No se encuentra registrado</b>',
					'float'			=> 'Este campo debe ser un <b>decimal delimitado por coma</b>',
					'in_strpos'		=> 'Este campo <b>no posee</b> el valor esperado',
					'min_max_1'		=> 'Este campo contener entre <b>[min]</b> y <b>[max]</b> caracteres',
					'min_max_2'		=> 'Este campo contener <b>[max]</b> caracteres',
					'not_equal'		=> 'Estos campo <b>poseen</b> el mismo valor',
					'not_exist_in'	=> '<b>Ya se encuentra registrado</b>',
					'not_in_strpos'	=> 'Este campo <b>no posee</b> el valor esperado',
					'num_between'	=> 'Este campo debe ser un número entre <b>[min]</b> y <b>[max]</b>',
					'number'		=> 'Este campo debe ser <b>numérico</b>',
					'required' 		=> 'Este campo es <b>requerido</b>',
					'rifj'			=> 'Este campo debe ser un <b>RIF júridico válido</b> en el siguiente formato: <b>J-123456789-0</b>',
					'rifp'			=> 'Este campo debe ser un <b>RIF personal válido</b> en el siguiente formato: <b>V123456789</b> o <b>E123456789</b>',
					'time'			=> 'Este campo debe ser una <b>hora válida</b>: 10:45',
					'timestamp'		=> 'Este campo debe ser una <b>fecha con hora válida</b>',
					'varchar' 		=> 'Este campo solo debe poseer <b>letras y/o espacios</b>',
				);
			}
		}
		function validate_post( $rules ){
			return ( new validator( $rules, 'POST' ) )->errors;
		}
		function validate_get( $rules ){
			return ( new validator( $rules, 'GET' ) )->errors;
		}
	#
	#	validate_file
		class validate_file{

			public function __construct( $rules ){

				$this->rules		= $rules;
				$this->name			= array();
				$this->prepend		= array();
				$this->append		= array();
				$this->max			= array();
				$this->is_ausent	= array();
				$this->has_errors	= array();
				$this->errors		= array();

				foreach( array_keys( $rules ) AS $i ){

					$this->has_name(	$i );
					$this->has_prepend(	$i );
					$this->has_append(	$i );
					$this->is_ausent(	$i );
					$this->is_required(	$i );

					if( $this->is_ausent[ $i ] )
						continue;

					$this->mime( $i );
					$this->max( $i );
				}

				$this->message_errors();
			}

			public function has_name( $i ){

				if( ( $pos = strpos( $this->rules[ $i ], '|input:' ) ) === false ){
					$this->name[ $i ] = $i;
					return;
				}

				$frag = substr( $this->rules[ $i ], $pos + 7 );
				$frag = substr( $frag, 0, strpos( $frag, '|') );

				$this->name[ $i ] = $frag;
			}

			public function has_prepend( $i ){

				if( ( $pos = strpos( $this->rules[ $i ], '|prepend:' ) ) === false )
					return;

				$frag = substr( $this->rules[ $i ], $pos + 9 );
				$frag = substr( $frag, 0, strpos( $frag, '|') );

				$this->prepend[ $i ] = $frag;
			}

			public function has_append( $i ){

				if( ( $pos = strpos( $this->rules[ $i ], '|append:' ) ) === false )
					return;

				$frag = substr( $this->rules[ $i ], $pos + 8 );
				$frag = substr( $frag, 0, strpos( $frag, '|') );

				$this->append[ $i ] = $frag;
			}

			public function is_ausent( $i ){
				$this->is_ausent[ $i ] = is_null( $_FILES[ $i ] );
			}

			public function is_required( $i ){

				if( strpos( $this->rules[ $i ], '|required|' ) === false )
					return;

				if( $this->is_ausent[ $i ] ){
					$this->errors[ $i ]		= 'required';
					$this->has_errors[ $i ]	= true;
				}
			}

			/*Rules*/
				public function mime_list(){
					return array(
						'xlsx'	=> 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
						'docx'	=> 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
						'pdf'	=> 'application/pdf',
						'jpg'	=> 'image/jpeg',
						'png'	=> 'image/png',
						'gif'	=> 'image/gif',
					);
				}

				public function mime( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|mime:' ) ) === false )
						return;

					$frag  = substr( $this->rules[ $i ], $pos + 6 );
					$frag  = substr( $frag, 0, strpos( $frag, '|') );
					$frag  = explode(',', $frag );
					$mimes = $this->mime_list();
					foreach( $frag AS $x => $f )
						$frag[ $x ] = $mimes[ $f ];

					if( !in_strpos( $_FILES[ $i ]['type'], $frag ) ){
						$this->errors[ $i ]		= 'mime';
						$this->has_errors[ $i ]	= true;
					}
				}

				public function max( $i ){

					if( $this->has_errors[ $i ] )
						return;

					if( ( $pos = strpos( $this->rules[ $i ], '|max:' ) ) === false )
						return;

					$frag = substr( $this->rules[ $i ], $pos + 5 );
					$frag = substr( $frag, 0, strpos( $frag, '|') );
					$_frag = (int)$frag * 1000000;

					if( $_FILES[ $i ]['size'] > $_frag ){
						$this->errors[ $i ]		= 'max';
						$this->max[ $i ]		= $frag;
						$this->has_errors[ $i ]	= true;
					}
				}
			/**/

			public function message_errors(){

				$errors		= array();
				$messages	= $this->messages();
				foreach( $this->errors AS $i => $m ){

					$name		= $this->name[ $i ];
					$prepend	= $this->prepend[ $i ];
					$append		= $this->append[ $i ];
					$message	= "{$prepend}{$messages[ $m ]}{$append}";

					/*Append Min*/
					if( strpos( $message, '[min]') !== false ){
						$min		= $this->min[ $i ];
						$message	= strtr( $message, array( '[min]' => $min ) );
					}

					/*Append Max*/
					if( strpos( $message, '[max]') !== false ){
						$max		= $this->max[ $i ];
						$message	= strtr( $message, array( '[max]' => $max ) );
					}

					$errors[ $name ] = $message;
				}
				$this->errors = $errors;
			}

			public function messages(){
				return array(
					'required' 	=> 'Este archivo es <b>requerido</b>',
					'mime' 		=> '<b>Tipo</b> de archivo no soportado',
					'max'		=> 'El archivo pesa mas de <b>[max]</b>'
				);
			}
		}
		function validate_file( $rules ){
			return ( new validate_file( $rules ) )->errors;
		}
	#
	#	isSequencial
		function isSequencial( $array ){

			if( $array === array() )
				return false;

			return array_keys( $array ) === range( 0, count( $array ) - 1 );
		}
	#
	#	isAssociative
		function isAssociative( $array ){

			if( $array === array() )
				return false;

			return array_keys( $array ) !== range( 0, count( $array ) - 1 );
		}
	#
	#	isdate
		function isdate( $v = null ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return false;

			list( $year, $month, $day ) = explode('-', $v, 3 );

			$year	= (int)$year;
			$month	= (int)$month;
			$day	= (int)substr( $day, 0, 2 );

			if( $year < 1950 || $year > ( (int)date('Y') + 10 )  )
				return false;

			if( $month < 1 || $month > 12  )
				return false;

			if( $day < 1 || $day > 31  )
				return false;

			return true;
		}
	#
	#	istimestamp
		function istimestamp( $v ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return false;

			list( $year, $month, $day )	= explode('-', $v, 3 );
			list( $day, $time )			= explode(' ', $day, 2 );
			list( $hour, $min, $seg )	= explode(':', $time, 3 );

			$year	= (int)$year;
			$month	= (int)$month;
			$day	= (int)$day;
			$hour	= (int)$hour;
			$min	= (int)$min;
			$seg	= (int)$seg;

			if( $year < 1950 || $year > ( (int)date('Y') + 10 )  )
				return false;

			if( $month < 1 || $month > 12 )
				return false;

			if( $day < 1 || $day > 31 )
				return false;

			if( $hour < 0 || $hour > 23 )
				return false;

			if( $min < 0 || $min > 59 )
				return false;

			if( $seg < 0 || $seg > 59 )
				return false;

			return true;
		}
	#
	#	istime
		function istime( $v ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return false;

			list( $hour, $min ) = explode(':', $v, 2 );

			if( is_empty( $hour ) )
				return false;

			if( is_empty( $min ) )
				return false;

			$hour	= (int)$hour;
			$min	= (int)$min;

			if( $hour < 0 || $hour > 23 )
				return false;

			if( $min < 0 || $min > 59 )
				return false;

			return true;
		}
	#
	#	isjson
		function isjson( $v = null ) {

			$v = (string)$v;
			if( is_empty( $v ) )
				return false;

			if( strpos( $v, '[') !== 0 )
			if( strpos( $v, '{') !== 0 )
				return false;

			json_decode( $v, true );

			if( json_last_error() === 0 )
				return true;
			else
				return false;
		}
	#
	#	tohtmljson
		function tohtmljson( $data = array() ){
			return htmlentities( tojson( $data )  , ENT_QUOTES, 'UTF-8' );
		}
	#
	#	tojson
		function tojson( $data = array() ){
			return json_encode( $data, JSON_UNESCAPED_UNICODE );
		}
	#
	#	toajson
		function toajson(){
			return json_encode( func_get_args(), JSON_UNESCAPED_UNICODE );
		}
	#
	#	dejson
		function dejson( $data ){

			if( !isjson( $data ) )
				return array();

			return json_decode( $data, true );
		}
	#
	#	CODEIGNITER
		function igniter_config( $key = null ){
			include root_folder.'/application/config/config.php';

			if( $key )
				return $config[ $key ];
			else
				return $config;
		}
		function csrf_name(){
			$config = igniter_config();
			if( $config['csrf_protection'] )
				return $config['csrf_token_name'];
			return null;
		}
		function csrf_value(){
			$config = igniter_config();
			if( $config['csrf_protection'] )
				return $_COOKIE[ $config['csrf_cookie_name'] ];
			return null;
		}
	#
	#	PDO
		function sql_pdo_driver(){
			include root_folder.'/application/config/database.php';
			$driver = new stdClass();
			$driver->host	= $db['default']['hostname'];
			$driver->user	= $db['default']['username'];
			$driver->pass	= $db['default']['password'];
			$driver->port	= $db['default']['port'];
			$driver->dbname	= $db['default']['database'];
			return $driver;
		}
		function sql_pdo_config(){
			return array(
				PDO::ATTR_CASE						=> PDO::CASE_NATURAL,
				PDO::ATTR_ERRMODE					=> PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_ORACLE_NULLS				=> PDO::NULL_EMPTY_STRING,
				PDO::ATTR_STRINGIFY_FETCHES			=> false,
				#PDO::ATTR_STATEMENT_CLASS			=> ,
				PDO::ATTR_TIMEOUT					=> 10,
				#PDO::ATTR_AUTOCOMMIT				=> false,
				PDO::ATTR_EMULATE_PREPARES			=> false,
				#PDO::MYSQL_ATTR_USE_BUFFERED_QUERY	=> false,
				PDO::ATTR_DEFAULT_FETCH_MODE		=> PDO::FETCH_OBJ,
			);
		}
		function sql_pdo_root(){ /*No Database*/
			$driver	= sql_pdo_driver();
			return new PDO(
				"pgsql:host={$driver->host};port={$driver->port};user={$driver->user};password={$driver->pass};options='--client_encoding=UTF8'",
				null,
				null,
				sql_pdo_config()
			);
		}
		functioN sql_pdo(){
			$driver	= sql_pdo_driver();
			return new PDO(
				"pgsql:host={$driver->host};port={$driver->port};user={$driver->user};password={$driver->pass};dbname={$driver->dbname};options='--client_encoding=UTF8'",
				null,
				null,
				sql_pdo_config()
			);
		}
		function sql_varchar( $v = null ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return 'NULL';

			if( strpos( $v, "'" ) !== false )
				$v = strtr( $v, array( "'"  => '' ) );

			return "'{$v}'";
		}
		function sql_bol( $v = null ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return 'NULL';

			if(
				$v === 'Si' ||
				$v === 't'
			)
				$v = 't';
			elseif(
				$v === 'No' ||
				$v === 'f'
			)
				$v = 'f';
			else
				return 'NULL';

			return "'{$v}'";
		}
		function sql_int8( $v = null ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return 'NULL';

			$v = (int)$v;

			return "'{$v}'";
		}
		function sql_int( $v = null ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return 'NULL';

			$v = (int)$v;

			if( $v > 2147483647 )
				$v = 2147483647;

			return "'{$v}'";
		}
		function sql_float( $v = null ) {

			$v = (string)$v;
			if( is_empty( $v ) )
				return 'NULL';

			if( strpos( $v, ',' ) !== false )
				$v = strtr( $v, array( ',' => '.' ) );

			$v = (float)$v;

			return "'{$v}'";
		}
		function sql_time( $v = null ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return 'NULL';

			list( $hour, $min ) = explode(':', $v, 2 );

			$hour	= (int)$hour;
			$min	= (int)$min;

			if( $hour < 0 || $hour > 23 )
				$hour = 0;

			if( $min < 0 || $min > 59 )
				$min = 0;

			$v = (float)"{$hour},{$min}";

			return "'{$v}'";
		}
		function sql_timestamp( $v = null ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return 'NULL';

			if( strlen( $v ) === 10 )
				$v .= ' 00:00:00';

			$v = DateTime::createFromFormat( 'Y-m-d H:i:s', $v );
			if( $v ){
				$v = $v->format('Y-m-d H:i:s');
				return "'{$v}'";
			}
			else
				return 'NULL';
		}
		function sql_date( $v = null ){

			$v = (string)$v;
			if( is_empty( $v ) )
				return 'NULL';

			if( strlen( $v ) > 10 )
				$v = substr( $v, 0, 10 );

			$v = DateTime::createFromFormat( 'Y-m-d', $v );
			if( $v ){
				$v = $v->format('Y-m-d');
				return "'{$v}'";
			}
			else
				return 'NULL';
		}
		function sql_push_flat( $col, $query ){

			$return = array();
			$results = $query->fetchAll( 2 );
			foreach( $results AS $v ){
				$k = $v[ $col ]; unset( $v[ $col ] );
				$return[ $k ] = reset( $v );
			}

			return $return;
		}
		function sql_flat( $query ){

			$return = array();
			$results = $query->fetchAll( 2 );
			foreach( $results AS $v )
				$return[] = reset( $v );
			return $return;
		}
		function sql_push( $col, $query ){

			$results = $query->fetchAll();
			foreach( $results AS $v ){
				$k = $v->{$col}; unset( $v->{$col} );
				$results[ $k ] = $v;
			}
			return $results;
		}
		function sql_ghost_col( $string, $sep, $extra = null ){
			if( !is_empty( $extra ) ) $extra = ",{$extra}";
			return "
				SELECT ghost.col {$extra}
				FROM ( SELECT DISTINCT TRIM( unnest( string_to_array( ".sql_varchar( $string ).", '{$sep}') ) ) AS col ) AS ghost
				WHERE ghost.col <> ''
			";
		}
	#
?>