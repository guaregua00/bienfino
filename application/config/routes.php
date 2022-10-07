<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Cusuarios';

$route['validarcuenta'] = 'Cusuarios/VvalidarCuenta';

$route['asociar'] = 'Cpublicacion/Vasociar';

$route['mensajeusuario/(:num)'] = 'Cpublicacion/mensajeR/$1';
$route['publicareexito/(:any)'] = 'Cpublicacion/Vpublicareexito';
$route['nosotros'] = 'Cusuarios/Vnosotros';
$route['terminosycondiciones'] = 'Cusuarios/Vpoliticas';
$route['admbienfino'] = 'Cadministrador/login';
$route['misPublicacionesExito'] = 'Cpublicacion/misPublicacionesExito';
$route['migaraje'] = 'Cgaraje';
$route['registrar'] = 'Cusuarios/registrar';
$route['ingresar'] = 'Cusuarios/login';
$route['ingresar/(:any)'] = 'Cusuarios/login/$1';
$route['miPerfil'] = '';
$route['actualizarDatos'] = 'Cusuarios/actualizarDatos';
$route['cerrar_session'] = 'Cusuarios/cerrar_session';

/*Publicaciones*/

	$route['publicar'] = 'Cpublicacion/Vformpublicacionuno';
	$route['publicar/(:any)'] = 'Cpublicacion/Vformpublicacionuno/$1';
	$route['publicardos'] = 'Cpublicacion/Vformpublicaciondos';
	$route['publicardos/(:any)'] = 'Cpublicacion/Vformpublicaciondos/$1';
	$route['publicartres/(:any)'] = 'Cpublicacion/Vformpublicaciontres/$1';
	$route['publicaruploadimg'] = 'Cpublicacion/ajaxUploadImg';//subida imagen ajax
	$route['UploadImg'] = 'Cpublicacion/UploadImg';//subida imagen ajax romel
	$route['accionespublicacion'] = 'Cpublicacion/accionespublicacion';
	$route['modificarPublicacionUsuario'] = 'Cpublicacion/VmodificarPublicacionUsuario';

/*Publicaciones*/

	
$route['misdatos'] = 'Cusuarios/VmisDatos';
$route['recuperarclave'] = 'Cusuarios/VrecuperarClave';
$route['404_override'] = '';

$route['buscar/(:num)'] = 'Cpublicacion/buscar/$1';//para la paginacion
$route['busqueda'] = 'Cpublicacion/busquedaMenu';//route principal de busqueda luego redireciona a buscar
$route['buscar'] = 'Cpublicacion/buscar';//para la paginacion
$route['busqueda/(:num)'] = 'Cpublicacion/busquedaMenu';//busqueda del home
$route['cambiarclave'] = 'Cusuarios/VcambiarClave';//para la paginacion
$route['limpiarfiltro/(:num)'] = 'Cpublicacion/limpiarFiltro/$1';//limpiarfiltro
$route['comovender'] = 'Cpublicacion/Vcomovender';//limpiarfiltro
$route['detallepublicacion/(:num)'] = 'Cpublicacion/verPublicacion/$1';//para la paginacion

/*Publicaciones ADM*/
$route['crearmarcaadm'] = 'Cadministrador/crearmarcaadm';//crearmarcaadm
$route['crearmodeloadm'] = 'Cadministrador/crearmodeloadm';//crearmodeloadm



$route['completarregistro'] = 'Cusuarios/VcompletarRegistro';

$route['datosubicacion'] = 'Cusuarios/VdatosUbicacion';
$route['datoscontacto'] = 'Cusuarios/VdatosContacto';
$route['datospersonales'] = 'Cusuarios/VdatosPersonales';
$route['cuentas'] = 'Cpago/Vcuentas';
$route['mifavorito'] = 'Cgaraje';
$route['vistacargarimagen/(:num)'] = 'Cpublicacion/vistaCargarImgAdicional/$1';
$route['pago'] = 'Cpago/Vinicio';
$route['oportunidadnegocio'] = 'Cusuarios/VoportunidadNegocio';
$route['validarcuenta/(:any)/(:num)'] = 'Cusuarios/linkValidacionCuenta/$1/$1';


/*Directorio*/
	$route['excel']					= 'CExcel';
	$route['directorio']			= 'CDirectorio';
	$route['directorio/insert']		= 'CDirectorio/insert';
	$route['directorio/update']		= 'CDirectorio/update';
	$route['directorio/delete']		= 'CDirectorio/delete';
	$route['directorio/restore']	= 'CDirectorio/restore';
	$route['directorio/reversal']	= 'CDirectorio/reversal';
	//new
	$route['addDirectorio/(:num)']	= 'CDirectorio/VaddDirectorio/$1';
	$route['listarDirectorio']	= 'CDirectorio/VlistarDirectorio';
	$route['resultadodirectorio']	= 'CDirectorio/Vresultadodirectorio';
	$route['directoriodetalle/(:num)']	= 'CDirectorio/Vdirectoriodetalle/$1';
	$route['pagosdirectorios']	= 'CDirectorio/Vpagosdirectorio';
	$route['verificarActivarDirectorio/(:num)/(:num)']	= 'CDirectorio/verificarActivarDirectorio/$1/$1';
	$route['reversarDesactivarDirectorio/(:num)/(:num)']	= 'CDirectorio/reversarDesactivarDirectorio/$1/$1';
	$route['VaddPagoDirectorio']	= 'CDirectorio/VaddPagoDirectorio';
	$route['addPagoDirectorio']	= 'CDirectorio/addPagoDirectorio';

	
/*Administrador*/
$route['VlistarUsuarioAdm']	= 'Cadministrador/VlistarUsuarioAdm';
$route['VcrearUsuarioAdm']	= 'Cadministrador/VcrearUsuarioAdm';
$route['crearusuarioadm']	= 'Cadministrador/crearUsuarioAdm';
$route['eliminarUsuarioAdm/(:num)']	= 'Cadministrador/eliminarUsuarioAdm/$1';
$route['activarUsuarioAdm/(:num)']	= 'Cadministrador/activarUsuarioAdm/$1';
$route['VactualizarUsuarioAdm/(:num)']	= 'Cadministrador/VactualizarUsuarioAdm/$1';
$route['actualizarUsuarioAdm/(:num)']	= 'Cadministrador/actualizarUsuarioAdm/$1';
$route['VcambiarClaveUsuarioAdm/(:num)']	= 'Cadministrador/VcambiarClaveUsuarioAdm/$1';
$route['cambiarClaveUsuarioAdm/(:num)']	= 'Cadministrador/cambiarClaveUsuarioAdm/$1';



$route['ordenarFotos/(:num)/(:any)/(:num)'] = 'Cadministrador/Vordenar_fotos/$1/$1/$1';//ordernar fotos adm
$route['VmodificarPublicacion/(:num)/(:any)/(:any)'] = 'Cadministrador/VmodificarPublicacion/$1/$1/$1';

/*Administrador*/

/*CRON*/
$route['crondirectorio']	= 'Ccron/desactivarDirectorioPeriodoTiempo';
$route['reiniciocampobusquedadpublicacion']	= 'Cpublicacion/reiniciocampobusquedadpublicacion';
$route['eliminarcarpetassinresgistro']	=     'Cpublicacion/matchFilePublicaciones';//no funciona
$route['eliminarpublicacion2sinpublicacion1']	= 'Cpublicacion/matchPublicaciones';//funciona

/*CRON*/

$route['correo']	= 'CDirectorio/correo'; //prueba

$route['translate_uri_dashes'] = FALSE;