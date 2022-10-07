<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cpublicacion extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mpublicacion');
        $this->load->model('Mgeo');
        $this->load->model('Mgaraje');
        $this->load->library('form_validation');
        //$this->load->library('encrypt');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->helper('codigo');
        $this->load->helper('mensajes_helper');
        //$this->output->enable_profiler(TRUE);
    }

    public function obtenerFechaVenezuela()
    {
        $utc = new DateTimeZone('UTC'); //UTC Tiempo Universal Coordinado
        $pdt = new DateTimeZone('America/Caracas');
        $midnight_utc = new DateTime('today midnight', $utc);
        $midnight_utc->setTimeZone($pdt);
        //echo $midnight_utc->format('Y-m-d H:i:s');
        return $midnight_utc->format('d-m-Y');
    }

    public function obtenerNombreKeyVariablePost($i)
    {
        $i = $i - 1; //por la posicion del array
        $keys = array_keys($_FILES); //capturo los keys (nombre de los inputs type file)
        $nombre_keys = $keys[$i];
        return $nombre_keys;
    }


    public function Vcomovender()
    {
        $this->load->view('layouts/headerR');
        $this->load->view('publicacion/comoVenderR');
    }

    public function mensajeR()
    {

        $datos['id_publicacion'] = strip_tags(trim($this->uri->segment(2)));
        $this->load->view('layouts/headerI');
        $this->load->view('publicacion/mensajeR', $datos);
    }
    //deprecado
    public function guardarImagenesAjax()
    {

        if (isset($_FILES)) {
            for ($i = 1; $i <= 6; $i++) {
                if ($_POST['control'] == $i) {
                    $file = $_FILES[$this->obtenerNombreKeyVariablePost($i)];
                }
            }


            $nombre = $_SESSION["cedula"] . "--p" . $_POST['control'] . "--" . $this->obtenerFechaVenezuela() . "--" . uniqid() . "--" . $file["name"]; //nombre real
            $tipo = $file["type"];
            $ruta_provisional = $file["tmp_name"]; //lugar temporal donde se guarda el archivo
            $size = $file["size"];
            $dimensiones = getimagesize($ruta_provisional);
            $width = $dimensiones[0];
            $height = $dimensiones[1];
            $carpeta = "publicaciones/temporales/";



            if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
                echo "Error, el archivo no es una imagen";
            } else if ($size > 1024 * 1024) {
                echo "Error, el tamaño máximo permitido es un 1MB";
            } else if ($width > 3000 || $height > 3000) {
                echo "Error la anchura y la altura maxima permitida es 3000px";
            } else if ($width < 60 || $height < 60) {
                echo "Error la anchura y la altura mínima permitida es 60px";
            } else {
                //abrir foto original
                if ($tipo == 'image/jpeg' || $tipo == 'image/jpg') {
                    $original = imagecreatefromjpeg($ruta_provisional);
                } elseif ($tipo == 'image/png') {
                    $original = imagecreatefrompng($ruta_provisional);
                } elseif ($tipo == 'image/gif') {
                    $original = imagecreatefromgif($ruta_provisional);
                } else {
                    die('No se pudo generar la imagen');
                }

                $ancho_original = imagesx($original);
                $alto_original = imagesy($original);


                //crear lienzo vacio

                $ancho_nuevo = 700;
                $alto_nuevo = round($ancho_nuevo * $alto_original / $ancho_original); //round redondea si se genera decimal

                $copia = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);

                //copiar original en copia
                //dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h

                //1-2 destino-original
                //3-4 eje X_Y pegado 0,0
                //5-6 eje X_Y original 0,0
                imagecopyresampled($copia, $original, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_original, $alto_original);

                //exportar guardar imagen


                $quality = 100;

                if ($tipo == 'image/jpg' || $tipo == 'image/jpeg') {
                    imagejpeg($copia, $carpeta . $nombre, $quality);
                } elseif ($tipo == 'image/png') {
                    $pngquality = floor(($quality - 10) / 10);
                    imagepng($copia, $carpeta . $nombre, $pngquality);
                } elseif ($tipo == 'image/gif') {
                    imagegif($copia, $carpeta . $nombre);
                }

                $src = $carpeta . $nombre;
                //move_uploaded_file($ruta_provisional, $src);
                echo "<img src='$src' class='card-img-top' alt='imagen'>";
            }
        }
    }

    public function datosHeaderMenu()
    {
        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        return $datos;
    }

    public function Vasociar()
    {

        comprobarUsuarioLogueado(NULL);

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }

        $this->load->view('layouts/Vheader', $datos);
        $this->load->view('publicacion/Vasociar');
    }

    public function asociar()
    {


        comprobarUsuarioLogueado(NULL);

        $this->form_validation->set_rules('movil', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');
        $this->form_validation->set_rules('placa', 'Placa', 'trim|required|strip_tags|callback_placa_check');

        if ($this->form_validation->run() === FALSE) {

            $datos['mensaje'] = "Formulario incorrecto";
            $datos = $this->datosHeaderMenu();
            if ($datos) {
                $this->load->view('layouts/Vheader', $datos);
                $this->load->view('publicacion/Vasociar', $datos);
            }
        } else {

            $datos['placa'] = mb_strtolower($this->input->post('placa'));
            $datos['movil'] = $this->input->post('movil');

            $publicacion = $this->Mpublicacion->getPublicacionPlacaTelefono($datos);
            // var_dump($publicacion);exit();
            if ($publicacion) {
                //echo "Vista previa publicación";
                $this->VasociarConfirmar($publicacion, $datos);
            } else {

                $resultado = $this->Mpublicacion->getCategorias();
                $resultado2 = $this->Mgeo->getEstados();
                $resultado3 = $this->Mpublicacion->getPrecios();

                if ($resultado and $resultado2 and $resultado3) {

                    $datos['categorias'] = $resultado;
                    $datos['estados'] = $resultado2;
                    $datos['precios'] = $resultado3;
                }
                $datos['mensaje'] = "Los datos ingresados no coinciden por favor intente de nuevo";
                $this->load->view('layouts/Vheader', $datos);
                $this->load->view('publicacion/VasociarError');
            }
        }
    }

    public function VasociarConfirmar($publicacion = false, $datosPost = false)
    {


        comprobarUsuarioLogueado(NULL);

        if (isset($publicacion) and $publicacion != "") {
            $resultado = $this->Mpublicacion->getCategorias();
            $resultado2 = $this->Mgeo->getEstados();
            $resultado3 = $this->Mpublicacion->getPrecios();

            if ($resultado and $resultado2 and $resultado3) {

                $datos['categorias'] = $resultado;
                $datos['estados'] = $resultado2;
                $datos['precios'] = $resultado3;
            }

            $data['datosPost'] = $datosPost;
            $data['publicacion'] = $publicacion;

            //var_dump($publicacion);exit();
            $this->load->view('layouts/Vheader', $datos);
            $this->load->view('publicacion/VasociarConfirmar', $data);
        }
    }

    public function asociarExito()
    {


        comprobarUsuarioLogueado(NULL);

        $this->form_validation->set_rules('movil', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');
        $this->form_validation->set_rules('placa', 'Placa', 'trim|required|strip_tags|callback_placa_check');
        $this->form_validation->set_rules('id_publicacion', 'IdPublicacion', 'trim|required|strip_tags');
        if ($this->form_validation->run() === FALSE) {

            $datos['mensaje'] = "Formulario incorrecto";
            $datos = $this->datosHeaderMenu();
            if ($datos) {
                $this->load->view('layouts/Vheader', $datos);
                $this->load->view('publicacion/Vasociar', $datos);
            }
        } else {

            $datos['placa'] = mb_strtolower($this->input->post('placa'));
            $datos['movil'] = $this->input->post('movil');
            $datos['id_publicacion'] = $this->input->post('id_publicacion');

            //function que asocia una publicacion al usuario a traves de los datos
            //placa, movil, id_publicacion y la session actual del usuario
            //solo lo permite si las publicaciones son de los usuarios de bienfino id_grupo usuario bienfino
            $resultTipoUsuario = $this->Mpublicacion->verificarTipoUsuarioPublicacion($datos);

            if ($resultTipoUsuario->id_grupo == 3) {
                //var_dump($resultTipoUsuario);exit();
                $resultAsociar = $this->Mpublicacion->asociarPublicacionAusuario($datos);

                if ($resultAsociar) {
                    $this->VasociarExito();
                } else {

                    $resultado = $this->Mpublicacion->getCategorias();
                    $resultado2 = $this->Mgeo->getEstados();
                    $resultado3 = $this->Mpublicacion->getPrecios();

                    if ($resultado and $resultado2 and $resultado3) {

                        $datos['categorias'] = $resultado;
                        $datos['estados'] = $resultado2;
                        $datos['precios'] = $resultado3;
                    }
                    $datos['mensaje'] = "Ocurrio un error intente de nuevo";
                    $this->load->view('layouts/Vheader', $datos);
                    $this->load->view('publicacion/VasociarError');
                }
            } else {
                $resultado = $this->Mpublicacion->getCategorias();
                $resultado2 = $this->Mgeo->getEstados();
                $resultado3 = $this->Mpublicacion->getPrecios();

                if ($resultado and $resultado2 and $resultado3) {

                    $datos['categorias'] = $resultado;
                    $datos['estados'] = $resultado2;
                    $datos['precios'] = $resultado3;
                }
                $datos['mensaje'] = "Esta publicación no puede ser asociada, puede comunicarse con nosotros a traves de este correo";
                $this->load->view('layouts/Vheader', $datos);
                $this->load->view('publicacion/VasociarError');
            }
        }
    }
    //sin uso
    public function VasociarError()
    {


        comprobarUsuarioLogueado(NULL);

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        $this->load->view('layouts/Vheader', $datos);
        $this->load->view('publicacion/VasociarError');
    }

    public function VasociarExito()
    {


        comprobarUsuarioLogueado(NULL);

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        $this->load->view('layouts/Vheader', $datos);
        $this->load->view('publicacion/VasociarExito');
    }

    public function Vpublicareexito()
    {

        comprobarUsuarioLogueado(NULL);

        $id_publicacion = strip_tags(trim($this->uri->segment(2)));

        $datos['id_publicacion'] = $id_publicacion;
        $this->load->view('layouts/headerI');
        $this->load->view('publicacion/formpublicacion/Vpublicareexito', $datos);
    }



    public function accionespublicacion()
    {
        comprobarUsuarioLogueado(null);
        $opcional = $this->security->xss_clean($this->input->post('opcional'));
        $datos['id_publicacion'] = $this->security->xss_clean($this->input->post('id_publicacion'));
        $datos['codigo'] = $this->security->xss_clean($this->input->post('codigo'));
        $datos['id_usuario'] = $this->session->userdata('id_usuario');
        switch ($opcional) {
            
            case '1':
                # Agregar/Actualizar Fotos
                redirect("publicar/" . $datos['id_publicacion']);
                break;
            case '2':
                # Modificar Categorias
                redirect("publicardos/" . $datos['id_publicacion']);
                break;
            case '3':
                # Modificar información
                $this->VmodificarPublicacionUsuario($datos);
                break;
            case '4':
                # Marcas como Vendido
                $datos['estatus'] = 5;
                $resultado = $this->Mpublicacion->accionespublicacion($datos);
                if ($resultado)
                    $this->session->set_flashdata('mensaje2', "Operación Exitosa.");
                else
                    $this->session->set_flashdata('mensaje', "Ocurrio un error intente de nuevo.");
                redirect('Cpublicacion/misPublicacionesExito');

                break;
            case '5':
                # Pausar
                $datos['estatus'] = 3;
                $resultado = $this->Mpublicacion->accionespublicacion($datos);
                if ($resultado)
                    $this->session->set_flashdata('mensaje2', "Operación Exitosa.");
                else
                    $this->session->set_flashdata('mensaje', "Ocurrio un error intente de nuevo.");
                redirect('Cpublicacion/misPublicacionesExito');

                break;
            case '6':
                # Eliminar
                $datos['estatus'] = 8;
                $resultado = $this->Mpublicacion->accionespublicacion($datos);
                if ($resultado)
                    $this->session->set_flashdata('mensaje2', "Operación Exitosa.");
                else
                    $this->session->set_flashdata('mensaje', "Ocurrio un error intente de nuevo.");
                redirect('Cpublicacion/misPublicacionesExito');
                break;

                case '7':
                    # Activar
                    $datos['estatus'] = 1;
                    $resultado = $this->Mpublicacion->accionespublicacion($datos);
                    if ($resultado)
                        $this->session->set_flashdata('mensaje2', "Operación Exitosa.");
                    else
                        $this->session->set_flashdata('mensaje', "Ocurrio un error intente de nuevo.");
                    redirect('Cpublicacion/misPublicacionesExito');
                    break;                                                                                         
            default:
                # code...
                break;
        }
    }


    public function VvistaCargarImgAdicional($id_publicacion)
    {


        $datos = $this->datosHeaderMenu();
        $datos['id_publicacion'] = $id_publicacion;
        $datos['mensaje'] = $this->session->flashdata('mensaje'); //danger
        $datos['mensaje2'] = $this->session->flashdata('mensaje2'); //success


        $resultado = $this->Mpublicacion->getPublicacionesImgOpcionales2($datos);

        $datos['opcionales'] = $resultado;

        if ($datos) {
            $this->load->view('layouts/Vheader', $datos);
            $this->load->view('publicacion/VimagenesAdicionales', $datos);
        }
    }

    public function vistaCargarImgAdicional()
    {
        comprobarUsuarioLogueado(NULL);
        $id_publicacion = $this->uri->segment('2');

        redirect('Cpublicacion/VvistaCargarImgAdicional/' . $id_publicacion);
    }



    public function index()
    {

        comprobarUsuarioLogueado(NULL);


        $datos = $this->datosHeaderMenu();
        if ($datos) {
            $this->load->view('layouts/Vheader', $datos);
            $this->load->view('publicacion/Vpublicacion');
        }
    }

    public function enviarEmailPublicacion()
    {
        if (!$this->session->userdata('id_usuario')) {
            $html1 = "Por favor registrate e ingresa para que puedas utilizar esta funcionalidad";
            $respuesta1 = array("htmloption1" => $html1);
            echo json_encode($respuesta1);
        } else {

            $resultado = $this->Mpublicacion->getPublicacionPorId($this->input->post('id_publicacion'));

            if ($resultado) {

                $config = array(
                    /* 'protocol' => 'smtp',
                              'smtp_host' => 'smtp.googlemail.com',
                              'smtp_user' => 'romel174gl@gmail.com',
                              'smtp_pass' => 'memonada',
                              'smtp_port' => '456',
                              'smtp_crypto' => 'ssl', */
                    'mailtype' => 'html',
                    /* 'wordwrap' => TRUE, */
                    'charset' => 'utf-8'
                );

                //envio de email de verificación
                $asunto = $resultado->titulo;

                $mensaje2 = "<h1>Datos del Vehiculo</h1><br>";
                $mensaje2 .= "<ul>";
                $mensaje2 .= "<li><strong>Dirección:</strong> " . ucwords(strtolower($resultado->direccion)) . "</li>";
                $mensaje2 .= "<li><strong>Estereo:</strong> " . ucwords(strtolower($resultado->estereo)) . "</li>";
                $mensaje2 .= "<li><strong>Tapizado:</strong> " . ucwords(strtolower($resultado->tapizado)) . "</li>";
                $mensaje2 .= "<li><strong>Transmision:</strong> " . ucwords(strtolower($resultado->transmision)) . "</li>";
                $mensaje2 .= "<li><strong>Vidrios:</strong> " . ucwords(strtolower($resultado->vidrios)) . "</li>";
                $mensaje2 .= "<li><strong>Reparado:</strong> " . ucwords(strtolower($resultado->reparado)) . " </li>";
                $mensaje2 .= "<li><strong>Tracción:</strong> " . ucwords(strtolower($resultado->traccion)) . " </li>";
                $mensaje2 .= "<li><strong>Puertas:</strong> " . ucwords(strtolower($resultado->puertas)) . " </li>";
                $mensaje2 .= "</ul><br>";

                $mensaje2 .= "<h2> Precio en Bs: " . $resultado->precio_bs . "</h2>";

                if ($resultado->precio_dol) {
                    $mensaje2 .= "<h2> Precio en $: " . $resultado->precio_dol . "</h2>";
                }


                $this->email->initialize($config);
                $this->email->from('romel174gl@gmail.com', 'BienFino.com');
                $this->email->to($this->session->userdata('email'));
                $this->email->subject($asunto);
                $this->email->message($mensaje2);

                if ($this->email->send()) {
                    $html1 = "La información se ha enviado a su correo correctamente";
                    $respuesta1 = array("htmloption1" => $html1);
                    echo json_encode($respuesta1);
                } else {
                    $html1 = "Error no se pudo enviar el correo correctamente";
                    $respuesta1 = array("htmloption1" => $html1);
                    echo json_encode($respuesta1);
                }
            } else {
                echo "Ocurrio un error";
            }
        }
    }

    public function verPublicacion()
    {

        if ($this->uri->segment(2) and is_numeric($this->uri->segment(2))) {
            $id_publicacion = strip_tags(trim($this->uri->segment(2)));


            //var_dump($publicacion);exit();
            $publicacion = $this->Mpublicacion->getPublicacionPorIdDetalle($id_publicacion);
            $favorito = $this->Mgaraje->getPublicionMiGarajeXidPublicacion($id_publicacion);

            if ($favorito) {
                $datos['favorito'] = "Este Vehiculo esta agregado en Mi Garaje";
            }
            if ($publicacion) {
                //$datos = $this->datosHeaderMenu();


                $datos['publicacion'] = $publicacion;
                //$datos['id_publicacion'] = $publicacion->id_publicacion;

                //$resultado = $this->Mpublicacion->getPublicacionesImgOpcionales2($datos);
                //$datos['opcionales'] = $resultado;       

                $this->load->view('layouts/headerR', $datos);
                //$this->load->view('publicacion/VverPublicacion',$datos);
                $this->load->view('publicacion/detallepublicacionR', $datos);
                //$this->load->view('usuarios/Vfooter');
            }
        }
    }

    public function misPublicacionesExito()
    {

        comprobarUsuarioLogueado('mispublicaciones');

        $datos['id_usuario'] = $this->session->userdata('id_usuario');
        $resultado = $this->Mpublicacion->getPublicionesUsuario($datos);
        $datos['publicaciones'] = $resultado;
        
        //var_dump($datos); exit;

        $this->load->view('layouts/headerI', $datos);
        $this->load->view('publicacion/VpublicacionRegistrada', $datos);
        //$this->load->view('usuarios/Vfooter');
    }

    /*
    Funcion creada para subir imagenes 
    parametros
    $nombre_img: el nombre con que se sube la img al servidor
    $name_input: nombre del atributo name del input desde donde se carga la img
    */

    //deprecado
    public function upload_img($nombre_img, $name_input, $id_publicacion, $codigo_carpeta)
    {
        comprobarUsuarioLogueado(NULL);

        //$publicacion = $this->Mpublicacion->getPublicacionPorId($this->session->userdata('id_usuario'));
        //var_dump($this->session->userdata('id_usuario'));exit();
        $publicacion = true;
        if ($publicacion) {

            //cargar imagen
            $config['max_size'] = '2048';
            $config['quality'] = '90%'; //calidad  
            $config['upload_path'] = './publicaciones/' . $codigo_carpeta . '/'; //ruta
            $config['file_name'] =  $nombre_img;
            $config['allowed_types'] = 'jpg|png|gif';
            $config['overwrite'] = true; //sobre escribe si existe un archivo con el mismo nombre
            $config['file_ext_tolower'] = true; //coloca la extension en minuscula

            $this->upload->initialize($config);

            if (!$this->upload->do_upload($name_input)) {
                $this->session->set_flashdata('mensaje', $this->upload->display_errors());
                redirect('Cpublicacion/VvistaCargarImgAdicional/' . $id_publicacion);
            }

            //procesar imagen
            $config2['source_image'] = './publicaciones/' . $codigo_carpeta . '/' . $nombre_img;
            $config2['quality'] = '90%'; //calidad  
            $config2['width'] = 600;
            $config2['height'] = 400;
            $config2['maintain_ratio'] = TRUE; //forza cambio de resolucion de la imagen

            //$config2['create_thumb'] = TRUE;

            $this->image_lib->initialize($config2);
            if (!$this->image_lib->resize()) {
                $this->session->set_flashdata('mensaje', $this->upload->display_errors());
                redirect('Cpublicacion/VvistaCargarImgAdicional/' . $id_publicacion);
            }

            $config3['source_image'] = './prueba/opcionales/' . $nombre_img;
            $config3['wm_text'] = 'BienFino.com';
            $config3['wm_type'] = 'text';
            //$config3['wm_font_path'] = './system/fonts/texb.ttf';//fuente de las letras
            $config3['wm_font_size'] = '16';
            $config3['wm_font_color'] = 'ffffff';
            $config3['wm_vrt_alignment'] = 'top';
            $config3['wm_hor_alignment'] = 'right';
            //$config3['wm_padding'] = '20;

            $this->image_lib->initialize($config3);

            $this->image_lib->watermark();
            $this->image_lib->clear();
        }
    }

    public function guardarImagenes()
    {

        comprobarUsuarioLogueado(NULL);

        $id_publicacion = $this->input->post('id_publicacion');

        $resultado = $this->Mpublicacion->getPublicacionPorId($id_publicacion);


        if ($resultado) {


            //var_dump($id_publicacion);exit();

            if (!empty($_FILES['imagen1']) and isset($_FILES['imagen1']['name']) and $_FILES['imagen1']['name'] != "") {
                $imagen1 = "1_opcionales_" . uniqid() . ".jpg";

                $this->upload_img($imagen1, 'imagen1', $id_publicacion, $resultado->codigo);

                $datos['imagen'] = $imagen1;
                $datos['id_publicacion'] = $id_publicacion;
                $datos['posicion'] = 1;

                $resultado = $this->Mpublicacion->getPublicacionesImgOpcionales($datos);

                if ($resultado) {
                    $nombre_anterior = $resultado[0]->imagen;

                    $this->Mpublicacion->ActualizarNombreImg($datos, $nombre_anterior);
                } else {
                    $this->Mpublicacion->guardarNombreImg($datos);
                }
            }
            if (!empty($_FILES['imagen2']) and isset($_FILES['imagen2']['name']) and $_FILES['imagen2']['name'] != "") {
                $imagen2 = "2_opcionales_" . uniqid() . ".jpg";

                $this->upload_img($imagen2, 'imagen2', $id_publicacion, $resultado->codigo);

                $datos['imagen'] = $imagen2;
                $datos['id_publicacion'] = $id_publicacion;
                $datos['posicion'] = 2;

                $resultado = $this->Mpublicacion->getPublicacionesImgOpcionales($datos);

                if ($resultado) {
                    $nombre_anterior = $resultado[0]->imagen;

                    $this->Mpublicacion->ActualizarNombreImg($datos, $nombre_anterior);
                } else {
                    $this->Mpublicacion->guardarNombreImg($datos);
                }
            }
            if (!empty($_FILES['imagen3']) and isset($_FILES['imagen3']['name']) and $_FILES['imagen3']['name'] != "") {
                $imagen3 = "3_opcionales_" . uniqid() . ".jpg";

                $this->upload_img($imagen3, 'imagen3', $id_publicacion, $resultado->codigo);

                $datos['imagen'] = $imagen3;
                $datos['id_publicacion'] = $id_publicacion;
                $datos['posicion'] = 3;

                $resultado = $this->Mpublicacion->getPublicacionesImgOpcionales($datos);

                if ($resultado) {
                    $nombre_anterior = $resultado[0]->imagen;

                    $this->Mpublicacion->ActualizarNombreImg($datos, $nombre_anterior);
                } else {
                    $this->Mpublicacion->guardarNombreImg($datos);
                }
            }
            if (!empty($_FILES['imagen4']) and isset($_FILES['imagen4']['name']) and $_FILES['imagen4']['name'] != "") {
                $imagen4 = "4_opcionales_" . uniqid() . ".jpg";

                $this->upload_img($imagen4, 'imagen4', $id_publicacion, $resultado->codigo);

                $datos['imagen'] = $imagen4;
                $datos['id_publicacion'] = $id_publicacion;
                $datos['posicion'] = 4;

                $resultado = $this->Mpublicacion->getPublicacionesImgOpcionales($datos);

                if ($resultado) {
                    $nombre_anterior = $resultado[0]->imagen;

                    $this->Mpublicacion->ActualizarNombreImg($datos, $nombre_anterior);
                } else {
                    $this->Mpublicacion->guardarNombreImg($datos);
                }
            }
            if (!empty($_FILES['imagen5']) and isset($_FILES['imagen5']['name']) and $_FILES['imagen5']['name'] != "") {
                $imagen5 = "5_opcionales_" . uniqid() . ".jpg";

                $this->upload_img($imagen5, 'imagen5', $id_publicacion, $resultado->codigo);

                $datos['imagen'] = $imagen5;
                $datos['id_publicacion'] = $id_publicacion;
                $datos['posicion'] = 5;

                $resultado = $this->Mpublicacion->getPublicacionesImgOpcionales($datos);

                if ($resultado) {
                    $nombre_anterior = $resultado[0]->imagen;

                    $this->Mpublicacion->ActualizarNombreImg($datos, $nombre_anterior);
                } else {
                    $this->Mpublicacion->guardarNombreImg($datos);
                }
            }
            if (!empty($_FILES['imagen6']) and isset($_FILES['imagen6']['name']) and $_FILES['imagen6']['name'] != "") {
                $imagen6 = "6_opcionales_" . uniqid() . ".jpg";

                $this->upload_img($imagen6, 'imagen6', $id_publicacion, $resultado->codigo);

                $datos['imagen'] = $imagen6;
                $datos['id_publicacion'] = $id_publicacion;
                $datos['posicion'] = 6;

                $resultado = $this->Mpublicacion->getPublicacionesImgOpcionales($datos);

                if ($resultado) {
                    $nombre_anterior = $resultado[0]->imagen;

                    $this->Mpublicacion->ActualizarNombreImg($datos, $nombre_anterior);
                } else {
                    $this->Mpublicacion->guardarNombreImg($datos);
                }
            }


            $this->session->set_flashdata('mensaje2', 'Imagenes subidas correctamente');
            redirect('Cpublicacion/misPublicacionesExito');
        }
    }


    public function Vformpublicacionuno()
    {

    comprobarUsuarioLogueado(NULL);

        $codigo = false;
        $codigo = strip_tags(trim($this->uri->segment(2)));
        
        $datos['codigo'] = $codigo;
        $datos = $this->security->xss_clean($datos);
        $datos['marcas'] = $this->Mpublicacion->getMarca();
        if (isset($codigo) and $codigo!=""){

            $resultado4 = $this->Mpublicacion->getPublicacionCodigo($datos);
            $data['id_categoria'] = $resultado4->id_categoria;
            $data['id_marca'] = $resultado4->id_marca;
            //$datos['modelos'] = $this->Mpublicacion->getModelo($data);
            //var_dump($datos['marcas']);exit;
            $datos['publicacion'] = $resultado4;
        }

        $resultado = $this->Mpublicacion->getCategorias();
        $datos['categorias'] = $resultado;
        if ($datos) {
            //$this->load->view('layouts/Vheader',$datos);
            $this->load->view('layouts/headerI');
            $this->load->view("publicacion/formpublicacion/formpublicacionuno", $datos);
        }
    }

    public function Vformpublicaciondos()
    {

        comprobarUsuarioLogueado('publicar');

        $datos['codigo'] = strip_tags(trim($this->uri->segment(2)));
        $datos['id_usuario2'] = $this->session->userdata('id_usuario');
        if ($datos['codigo']) {
            $res = $this->Mpublicacion->getPublicacionCodigoUpload($datos);
            //var_dump($res); exit();
            $data['publicaciones'] = $res;
            $this->load->view('layouts/headerR', $datos);
            $this->load->view('publicacion/formpublicacion/formpublicaciondos', $data);
        }
    }
    public function Vformpublicaciontres()
    {

        comprobarUsuarioLogueado('publicar');

        $datos['codigo'] = false;
        $datos['codigo'] = strip_tags(trim($this->uri->segment(2)));

        if ($datos['codigo']) {
            $resultado4 = $this->Mpublicacion->getPublicacionCodigo($datos);
            $datos['publicacion'] = $resultado4;
        }

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }

        $this->load->view('layouts/headerI');
        $this->load->view("publicacion/formpublicacion/formpublicaciontres", $datos);
    }

    public function VmodificarPublicacionUsuario($datos){

        comprobarUsuarioLogueado('publicar');

        if ($datos['codigo']) {
            $resultado4 = $this->Mpublicacion->getPublicacionCodigo1($datos);
            $datos['publicacion'] = $resultado4;
        }
        //var_dump($resultado4);exit;

        $resultado = $this->Mpublicacion->getCategorias();
        $resultado2 = $this->Mgeo->getEstados();
        $resultado3 = $this->Mpublicacion->getPrecios();

        if ($resultado and $resultado2 and $resultado3) {

            $datos['categorias'] = $resultado;
            $datos['estados'] = $resultado2;
            $datos['precios'] = $resultado3;
        }
        $this->load->view('layouts/headerI');
        $this->load->view("publicacion/formpublicacion/VmodificarPublicacionUsuario", $datos);   
    }

    
    public function registrarPublicacionUno()
    {

        $codigo = $this->input->post('codigo');
        comprobarUsuarioLogueado(NULL);

        //validaciones

        $this->form_validation->set_rules('id_categoria', 'Categoria', 'trim|numeric|required|strip_tags');

        if ($this->input->post('marca-usuario') != "") {
            $this->form_validation->set_rules('marca-usuario', 'Marca', 'trim|required|strip_tags');
        } else {
            $this->form_validation->set_rules('id_marca', 'Marca', 'trim|numeric|required|strip_tags');
        }
        if ($this->input->post('modelo-usuario') != "") {
            $this->form_validation->set_rules('modelo-usuario', 'Modelo', 'trim|required|strip_tags');
        } else {
            $this->form_validation->set_rules('id_modelo', 'Modelo', 'trim|numeric|required|strip_tags');
        }

        $this->form_validation->set_rules('id_ano', 'Modelo', 'trim|numeric|required|strip_tags');

        //validacione
        //delimitadores de errores
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //delimitadores de errores
        //reglas de validación
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');
        $this->form_validation->set_message('valid_email', 'El campo %s no posee un email válido');
        //reglas de validación


        if ($this->form_validation->run() === FALSE) {

            $mensaje_error = validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje_error);

            //redirect('publicar');
            redirect('publicar/' . $codigo);
        } else {
            

            //registra cuando el usuario ingresa la marca y el modelo texto
            if ($this->input->post('marca-usuario') != "" and $this->input->post('modelo-usuario') != "") {

                $data['marca'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('marca-usuario'))))));
                $data['slug-marca'] = $data['marca'];

                $data['modelo'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('modelo-usuario'))))));
                $data['slug-modelo'] = $data['modelo'];
                $data['activo'] = 0;
                $data['id_usuario'] = $this->session->userdata('id_usuario');

                $res2 = $this->Mpublicacion->VerificarMarcas($data);
     
                if($res2){
                    $this->session->set_flashdata('mensaje', 'Ya existe la Marca '.$data['marca'].' intenta de nuevo');
                    redirect('publicar/' . $codigo);
                }

                //registro de marca y modelo
                $res = $this->Mpublicacion->insertMarcasModelos($data);
                if(!$res){
                    $this->session->set_flashdata('mensaje', 'Error no se pudo crear marca y modelo intente de nuevo');
                    redirect('publicar/' . $codigo);
                }else{
                    $datos['id_marca'] = $res['id_marca'];
                    $datos['id_modelo'] = $res['id_modelo'];
                }
                
            }elseif ($this->input->post('id_marca') != "" and $this->input->post('modelo-usuario') != "") {
                //registra cuando el usuario selecciona la marca y escribe el modelo
                $data2['id_marca'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('id_marca'))))));
                $data2['modelo'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('modelo-usuario'))))));
                $data2['slug'] = $data2['modelo'];
                
                $data2['activo'] = 0;
                $data2['id_usuario'] = $this->session->userdata('id_usuario');
                
                //registro de modelo
                $res = $this->Mpublicacion->insertModelos($data2);
                
                if(!$res){
                    $this->session->set_flashdata('mensaje', 'Error no se pudo crear el modelo intente de nuevo');
                    redirect('publicar/' . $codigo);
                }else{
                    $datos['id_modelo'] = $res['id_modelo'];
                    $datos['id_marca'] = $data2['id_marca'];
                }

            }else {
                $datos['id_marca'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('id_marca'))))));
                $datos['id_modelo'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('id_modelo'))))));
            }
        
            
                
    

            //si modelo-usuario y marca-usuario es diferente de vacio agregarlo en la tabla tbl_marcas y tbl_modelos
            // los id resultantes van a la tabla
            //nuevos campos en las tablas activo,id_usuario
            //id_marca marca slug
            //id_modelo modelo slug


            $datos['id_categoria'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('id_categoria'))))));


            $datos['id_ano'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('id_ano'))))));
            //$datos['id_usuario'] = $this->session->userdata('cedula');
            $datos['id_usuario2'] = $this->session->userdata('id_usuario');
            $datos['estatus'] = 6; //Por completar
            $datos['paso'] = 1; //paso actual
            $datos['codigo'] = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('codigo'))))));

            if (isset($datos['codigo']) && $datos['codigo'] != "") {
                //actualizacion registro existente

                $res = $this->Mpublicacion->actualizarPublicacionFormUno($datos);
                //var_dump($res);exit;
                if ($res) {
                    redirect('publicardos/' . $datos['codigo']);
                } else {
                    //mando a la vista de error
                    $this->session->set_flashdata('mensaje', 'Error no se pudo actualizar la publicacion');
                    redirect('publicar/' . $codigo);
                }
            } else {
                //registro publicacion nueva
                $codigo = $this->generarCodigoUnicoPublicacion();
                if ($codigo != "") {
                    $datos['codigo'] = $codigo;
                    $path = getcwd() . "/publicaciones/" . $datos['codigo'];
                    if (!mkdir($path, 0777, true)) {
                        $this->session->set_flashdata('mensaje', 'Error no se pudo crear la carpeta');
                        redirect('publicar/' . $codigo);
                    }
                } else {
                    $this->session->set_flashdata('mensaje', 'Error al generar código por favor intente de nuevo');
                    redirect('publicar/' . $codigo);
                }


                
                //metodo para registrar una publicacion
                $resultado = $this->Mpublicacion->registrarPublicacionUno($datos);
                if ($resultado) {
                    redirect('publicardos/' . $resultado->codigo);
                } else {
                    //mando a la vista de error
                    $this->session->set_flashdata('mensaje', 'Error no se pudo registrar la publicacion');
                    redirect("publicar");
                }
            }
        }
    }

    /*--------------------------------------------publicardos---------------------------------------------*/


    public function upload_img2($newName, $key, $position, $ruta)
    {

        //cargar imagen
        $config['max_size'] = '20480';
        $config['quality'] = '70%'; //calidad  
        $config['upload_path'] = $ruta; //ruta
        $config['file_name'] =  $newName;
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
        $config['overwrite'] = true; //sobre escribe si existe un archivo con el mismo nombre
        $config['file_ext_tolower'] = true; //coloca la extension en minuscula

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($key)) {       //$this->upload->display_errors()
            $control['msg'] = $this->upload->display_errors() . $position;
            //$control['msg']= ' No se pudo guardar la imagen '.$position;
            $control['status'] = false;
            return $control;
        }

        //procesar imagen
        $config2['source_image'] = $ruta . $newName; //ruta
        $config2['quality'] = '70%'; //calidad  
        $config2['width'] = 800;
        $config2['height'] = 600;
        $config2['maintain_ratio'] = TRUE; //forza cambio de resolucion de la imagen

        //$config2['create_thumb'] = TRUE;

        $this->image_lib->initialize($config2);
        if (!$this->image_lib->resize()) {   //$this->upload->display_errors()    
            $control['msg'] = 'No se pudo procesar la imagen ' . $position;
            $control['status'] = false;
            return $control;
        }

        /*     $config3['source_image'] = $ruta.$newName; //ruta
    $config3['wm_text'] = 'BienFino.com';
    $config3['wm_type'] = 'text';
    $config3['wm_font_path'] = getcwd().'/asset/fonts/Roboto/Roboto-Italic.ttf';//fuente de las letras
    $config3['wm_font_size'] = '18';            
    $config3['wm_font_color'] = '23262f'; */

        $config3['source_image'] = $ruta . $newName;
        $config3['wm_type'] = "overlay";
        $config3['wm_overlay_path'] = getcwd() . '/asset/img/logo150.png'; //fuente de las letras
        $config3['wm_vrt_alignment'] = 'bottom';
        $config3['wm_hor_alignment'] = 'right';
        //$config3['wm_padding'] = '20';

        $this->image_lib->initialize($config3);

        $this->image_lib->watermark();
        echo $this->image_lib->display_errors();
        //$this->image_lib->clear();

        /* 
    //miniaturas
    $config4['source_image'] = $ruta.$newName;
    $config4['new_image'] = $ruta. 'mini/';
    $config4['create_thumb'] = TRUE;
    $config4['maintain_ratio'] = TRUE;
    $config4['width'] = 310;
    $config4['height'] = 200;
    $this->load->library('image_lib', $config4);
    $this->image_lib->resize(); 

    if ( ! $this->image_lib->resize())
    {   //$this->upload->display_errors()    
        $control['msg']= $this->upload->display_errors();
        $control['status']=false;
        return $control;                          

    } */

        $control['status'] = true;
        return $control;
    }

    public function uploadImage()
    {
        $codigo = strip_tags(trim($this->uri->segment(2)));
        $control['error'] = 0;
        if (isset($_FILES) && !empty($_FILES) and isset($codigo) && !empty($codigo) && $this->session->userdata('id_usuario')) {
            //$_FILES = $this->security->sanitize_filename($_FILES);
            $files = array_filter($_FILES, function ($item) {
                return $item["name"][0] != "";
            });
            //$data["status"] = "true";           
            //echo json_encode($_FILES);exit;
            $datos['paso'] = 2;
            $datos['codigo'] = $this->db->escape_str(trim($this->security->xss_clean($this->input->post('codigo'))));
            $datos['id_usuario2'] = $this->session->userdata('id_usuario');
            //echo json_encode($data['codigo']);exit;

            $position = 1; //valor default

            $publicacion = $this->Mpublicacion->getPublicacionCodigoUpload($datos);

            $control['status'] = true;
            $control['msg'] = '';
            //$data[][]='';
             
            foreach ($files as $key => $file) {

                if ($position <= 6) {
                    $tmp_name = $file["tmp_name"];
                    $name = $file["name"]; //nombre de la imagen
                    $extension = $this->getFileExtension($name);
                    $newName = $this->GenerarP(10) . $extension;
                    $path = "./publicaciones/" . $datos['codigo'] . "/";

                    //los if anidados garantisan que las imagenes siempre se van a subir en orden
                    //de acuerdo a el espacio disponible en bd
                    if ($publicacion->url_uno == "") {
                        $position = 1;
                        $publicacion->url_uno = 'cargado';
                    } else if ($publicacion->url_dos == "") {
                        $position = 2;
                        $publicacion->url_dos = 'cargado';
                    } else if ($publicacion->url_tres == "") {
                        $position = 3;
                        $publicacion->url_tres = 'cargado';
                    } else if ($publicacion->url_cuatro == "") {
                        $position = 4;
                        $publicacion->url_cuatro = 'cargado';
                    } else if ($publicacion->url_cinco == "") {
                        $position = 5;
                        $publicacion->url_cinco = 'cargado';
                    } else if ($publicacion->url_seis == "") {
                        $position = 6;
                        $publicacion->url_seis = 'cargado';
                    }

                    $datos['url_' . $this->numToLetra($position)] = $newName;
                    $res = $this->upload_img2($newName, $key, $position, $path);

                    //@move_uploaded_file($tmp_name, $path);
                    if ($res['status']) {
                        $wasUploaded = $this->Mpublicacion->uploadImage($datos);

                        if ($wasUploaded) {
                            $id = $position;
                            $data["all_ids"]["id_$id"]["id"] = $id;
                            $data["all_ids"]["id_$id"]["name"] = $newName;
                            $data["all_ids"]["id_$id"]["codigo"] = $datos['codigo'];
                            $control['msg'] = $control['msg'] . 'Imagen ' . $position . 'cargada correctamente ';
                        } else {
                            $control['msg'] = 'No se pudo guardo en bd la imagen, intente de nuevo' . $position;
                            $control['status'] = false;
                            break;
                        }
                    } else {
                        $control['msg'] = $res['msg'];
                        $control['status'] = false;
                        $control['error'] = 1; //redirecciona al paso 1 x que ocurre un error con la carga de img
                        break;
                    }
                }
                $position++;
            }
            if ($control['status']) {
                echo json_encode(['status' => $control['status'], 'error' => $control['error'], 'msg' => $control['msg'], $data]);
                exit();
            } else {
                echo json_encode(['status' => $control['status'], 'error' => $control['error'], 'msg' => $control['msg']]);
                exit();
            }
        }
        echo json_encode(['status' => false, 'msg' => 'No se enviaron imagenes, intente de nuevo', 'error' => $control['error']]);
    }

    public function deleteImage()
    {

        if ($this->input->post('id_img')) {
            $datos['url_' . $this->numToLetra($this->input->post('id_img'))] = "";
            $datos['codigo'] = $this->input->post('codigo');
            $datos['id_usuario2'] = $this->session->userdata('id_usuario');
            $wasUploaded = $this->Mpublicacion->uploadImage($datos);
            echo json_encode(['status' => true, 'msg' => $wasUploaded]);
            //die("true");
        }
    }

    public function GenerarP($long)
    {
        $passw = "";
        $cadena = "ABCDEFGHIJLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $longitud = strlen($cadena);
        $this->longitud = $long;

        for ($i = 0; $i <= $this->longitud; $i++) {
            $aleatorio = mt_rand(0, $longitud - 1);
            $passw .= substr($cadena, $aleatorio, 1);
        }

        $pass = $passw;
        $passw = "";

        return $pass;
    }
    public function getFileExtension(string $filename): string
    {
        //$filename = 1.jpg            |   ["1", "jpg"]       | return ".jpg"
        $name = explode(".", $filename);
        return "." . array_pop($name);
    }
    /*--------------------------------------------publicardos---------------------------------------------*/


    public function registrarPublicacionTres()
    {
        comprobarUsuarioLogueado(NULL);

        $datos['codigo'] = strip_tags(trim($this->input->post('codigo')));
        $datos['paso'] = 3;
        $codigo = $datos['codigo'];


        $this->form_validation->set_rules('precio_dol', 'Precio Dol', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('negociable', 'negociable', 'trim|required|strip_tags');
        $this->form_validation->set_rules('codigoestado', 'Estado', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('moviluno', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|required|callback_telfmovil|strip_tags');
        $this->form_validation->set_rules('recorrido', 'Recorrido', 'trim|required|strip_tags');
        $this->form_validation->set_rules('placa', 'Placa', 'trim|strip_tags');
        $this->form_validation->set_rules('color', 'Color', 'trim|required|strip_tags');
        $this->form_validation->set_rules('combustible', 'Combustible', 'trim|strip_tags');
        $this->form_validation->set_rules('unico_dueno', 'Dueño', 'trim|required|strip_tags');
        $this->form_validation->set_rules('condicion', 'Condición', 'trim|required|strip_tags');

        $this->form_validation->set_rules('direccion', 'Dirección', 'trim|strip_tags');
        $this->form_validation->set_rules('estereo', 'Estereo', 'trim|strip_tags');
        $this->form_validation->set_rules('tapizado', 'Tapizado', 'trim|strip_tags');
        $this->form_validation->set_rules('transmision', 'Transmisión', 'trim|required|strip_tags');
        $this->form_validation->set_rules('vidrios', 'Vidrios', 'trim|strip_tags');
        $this->form_validation->set_rules('reparado', 'Reparado', 'trim|strip_tags');
        $this->form_validation->set_rules('traccion', 'tracción', 'trim|strip_tags');
        $this->form_validation->set_rules('puertas', 'Puertas', 'trim|strip_tags');
        $this->form_validation->set_rules('motor', 'Motor', 'trim|strip_tags');
        $this->form_validation->set_rules('nro_cilindros', 'Cilindros', 'trim|strip_tags');
        $this->form_validation->set_rules('comentario', 'Comentario', 'trim|strip_tags');
        $this->form_validation->set_rules('precio_bs', 'Precio BS', 'trim|numeric|strip_tags');
        //$this->form_validation->set_rules('titulo', 'Titulo', 'trim|required|strip_tags');

        if ($this->input->post('movildos') != "") {
            $this->form_validation->set_rules('movildos', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');
        }
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //delimitadores de errores

        //reglas de validación
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');
        //reglas de validación


        if ($this->form_validation->run() === FALSE) {

            $mensaje_error = validation_errors();

            $datos['mensaje '] = $mensaje_error;
            $datos = $this->datosHeaderMenu();
            if ($datos) {
                $this->session->set_flashdata('mensaje', $mensaje_error);
                redirect('publicartres/' . $codigo);
            }
        } else {


            $datos['direccion'] = mb_strtolower($this->input->post('direccion'));
            $datos['estereo'] = mb_strtolower($this->input->post('estereo'));
            $datos['tapizado'] = mb_strtolower($this->input->post('tapizado'));
            $datos['transmision'] = $this->input->post('transmision');
            $datos['vidrios'] = mb_strtolower($this->input->post('vidrios'));
            $datos['reparado'] = mb_strtolower($this->input->post('reparado'));
            $datos['traccion'] = mb_strtolower($this->input->post('traccion'));
            $datos['puertas'] = mb_strtolower($this->input->post('puertas'));
            $datos['combustible'] = mb_strtolower($this->input->post('combustible'));
            $datos['condicion'] = mb_strtolower($this->input->post('condicion'));
            $datos['color'] = mb_strtolower($this->input->post('color'));
            $datos['unico_dueno'] = mb_strtolower($this->input->post('unico_dueno'));
            $datos['motor'] = mb_strtolower($this->input->post('motor'));
            $datos['nro_cilindros'] = mb_strtolower($this->input->post('nro_cilindros'));
            $datos['recorrido'] = $this->input->post('recorrido');
            $datos['placa'] = mb_strtolower($this->input->post('placa'));
            $datos['comentario'] = mb_strtolower($this->input->post('comentario'));
            $datos['negociable'] = mb_strtolower($this->input->post('negociable'));
            $datos['precio_dol'] = $this->input->post('precio_dol');

            if (isset($_POST['precio_bs']) && $_POST['precio_bs'] != "") {
                $datos['precio_bs'] = $this->input->post('precio_bs');
            }
            //$datos['titulo'] = mb_strtolower($this->quitar_tildes($this->input->post('titulo')));
            $datos['codigoestado'] = $this->input->post('codigoestado');
            $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
            $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
            //$datos['id_usuario'] = $this->session->userdata('cedula');
            $datos['id_usuario2'] = $this->session->userdata('id_usuario');

            /*             Activo 1
            Por revisar 6
            Rechazado 10
            Verificado 11 
            Vendido 5  */

            $datos['estatus'] = 6; //Por Verificar
            $datos['moviluno'] = $this->input->post('moviluno');

            if (isset($_POST['movildos']) && $_POST['movildos'] != "") {
                $datos['movildos'] = $this->input->post('movildos');
            }
            
            $datos = $this->security->xss_clean($datos);

            $resultado1 = false;
            $resultado2 = false;

            //metodo para registrar una publicacion
            $re = $this->Mpublicacion->getPublicacionCodigo($datos); //tbl_publicaciones2
            //var_dump($re->principal);exit;
            //devuelve false sino esta cargado en la tabla tbl_publicaciones2
            //principal es igual a 1 cuando se publico en tbl_publicaciones y 0 por defecto cuando no 
            if ($re->principal == 0) { //registra en la tabla tbl_publicaciones2 y luego lo pasa a tbl_publicaciones
                //$this->Mpublicacion->registrarPublicacionDosTres($datos); //tbl_publicaciones2
                $resultado1 = $this->Mpublicacion->publicarPublicacionPrincipal($datos); //tbl_publicaciones y cambia el campo principal a 1
                //$resultado2 = $this->Mpublicacion->updateBusqueda($datos['codigo']);  //tbl_publicaciones              
            } else if ($re->principal == 1) {
                $resultado2 = $this->Mpublicacion->actualizarPublicacionFormTres($datos); //tbl_publicaciones
                //$this->Mpublicacion->updateBusqueda($datos['codigo']);//tbl_publicaciones
            }
            if ($resultado1) {
                @$this->enviarEmailNotificacionPublicacion($re);
            }

            if ($resultado1 || $resultado2) {
                 $this->session->set_flashdata('mensajeExito', 'Operación Exitosa.');
                redirect('publicareexito/' . $re->id_publicacion2);
            } else {
                $this->session->set_flashdata('mensaje', 'Error no se pudo registrar la publicacion');
                redirect("publicartres/" . $codigo);
            }
        }
    }

    public function modificarPublicacionUsuario(){

        comprobarUsuarioLogueado(NULL);

        $datos['codigo'] = strip_tags(trim($this->input->post('codigo')));
        $datos['id_publicacion'] = strip_tags(trim($this->input->post('id_publicacion')));

        $this->form_validation->set_rules('precio_dol', 'Precio Dol', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('negociable', 'negociable', 'trim|required|strip_tags');
        $this->form_validation->set_rules('codigoestado', 'Estado', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('codigomunicipio', 'Municipio', 'trim|numeric|required|strip_tags');
        $this->form_validation->set_rules('codigoparroquia', 'Parroquia', 'trim|numeric|required|strip_tags');
        //$this->form_validation->set_rules('moviluno', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|required|callback_telfmovil|strip_tags');
        $this->form_validation->set_rules('recorrido', 'Recorrido', 'trim|required|strip_tags');
        $this->form_validation->set_rules('placa', 'Placa', 'trim|strip_tags');
        $this->form_validation->set_rules('color', 'Color', 'trim|required|strip_tags');
        $this->form_validation->set_rules('combustible', 'Combustible', 'trim|strip_tags');
        $this->form_validation->set_rules('unico_dueno', 'Dueño', 'trim|required|strip_tags');
        $this->form_validation->set_rules('condicion', 'Condición', 'trim|required|strip_tags');

        $this->form_validation->set_rules('direccion', 'Dirección', 'trim|strip_tags');
        $this->form_validation->set_rules('estereo', 'Estereo', 'trim|strip_tags');
        $this->form_validation->set_rules('tapizado', 'Tapizado', 'trim|strip_tags');
        $this->form_validation->set_rules('transmision', 'Transmisión', 'trim|required|strip_tags');
        $this->form_validation->set_rules('vidrios', 'Vidrios', 'trim|strip_tags');
        $this->form_validation->set_rules('reparado', 'Reparado', 'trim|strip_tags');
        $this->form_validation->set_rules('traccion', 'tracción', 'trim|strip_tags');
        $this->form_validation->set_rules('puertas', 'Puertas', 'trim|strip_tags');
        $this->form_validation->set_rules('motor', 'Motor', 'trim|strip_tags');
        $this->form_validation->set_rules('nro_cilindros', 'Cilindros', 'trim|strip_tags');
        $this->form_validation->set_rules('comentario', 'Comentario', 'trim|strip_tags');
        $this->form_validation->set_rules('precio_bs', 'Precio BS', 'trim|numeric|strip_tags');
        //$this->form_validation->set_rules('titulo', 'Titulo', 'trim|required|strip_tags');

        /*if ($this->input->post('movildos') != "") {
            $this->form_validation->set_rules('movildos', 'Movil', 'trim|min_length[11]|max_length[11]|numeric|callback_telfmovil|strip_tags');
        } */
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        //delimitadores de errores

        //reglas de validación
        $this->form_validation->set_message('required', 'Debe llenar el campo %s');
        //reglas de validación


        if ($this->form_validation->run() === FALSE) {

            $mensaje_error = validation_errors();

            $datos['mensaje '] = $mensaje_error;
            $datos = $this->datosHeaderMenu();

                $this->session->set_flashdata('mensaje', $mensaje_error);
                redirect('misPublicacionesExito');
        } else {


            $datos['direccion'] = mb_strtolower($this->input->post('direccion'));
            $datos['estereo'] = mb_strtolower($this->input->post('estereo'));
            $datos['tapizado'] = mb_strtolower($this->input->post('tapizado'));
            $datos['transmision'] = $this->input->post('transmision');
            $datos['vidrios'] = mb_strtolower($this->input->post('vidrios'));
            $datos['reparado'] = mb_strtolower($this->input->post('reparado'));
            $datos['traccion'] = mb_strtolower($this->input->post('traccion'));
            $datos['puertas'] = mb_strtolower($this->input->post('puertas'));
            $datos['combustible'] = mb_strtolower($this->input->post('combustible'));
            $datos['condicion'] = mb_strtolower($this->input->post('condicion'));
            $datos['color'] = mb_strtolower($this->input->post('color'));
            $datos['unico_dueno'] = mb_strtolower($this->input->post('unico_dueno'));
            $datos['motor'] = mb_strtolower($this->input->post('motor'));
            $datos['nro_cilindros'] = mb_strtolower($this->input->post('nro_cilindros'));
            $datos['recorrido'] = $this->input->post('recorrido');
            $datos['placa'] = mb_strtolower($this->input->post('placa'));
            $datos['comentario'] = mb_strtolower($this->input->post('comentario'));
            $datos['negociable'] = mb_strtolower($this->input->post('negociable'));
            $datos['precio_dol'] = $this->input->post('precio_dol');


            if (isset($_POST['precio_bs']) && $_POST['precio_bs'] != "") {
                $datos['precio_bs'] = $this->input->post('precio_bs');
            }else{
                $datos['precio_bs'] = NULL;
            }
            //$datos['titulo'] = mb_strtolower($this->quitar_tildes($this->input->post('titulo')));
            $datos['codigoestado'] = $this->input->post('codigoestado');
            $datos['codigomunicipio'] = $this->input->post('codigomunicipio');
            $datos['codigoparroquia'] = $this->input->post('codigoparroquia');
            //$datos['id_usuario'] = $this->session->userdata('cedula');
            //$datos['id_usuario2'] = $this->session->userdata('id_usuario');

            /*             Activo 1
            Por revisar 6
            Rechazado 10
            Verificado 11 
            Vendido 5  */

            //$datos['estatus'] = 6; //Por Verificar
            /*$datos['moviluno'] = $this->input->post('moviluno');

            if (isset($_POST['movildos']) && $_POST['movildos'] != "") {
                $datos['movildos'] = $this->input->post('movildos');
            } */
            
            $datos = $this->security->xss_clean($datos);
            
            $resultado1 = $this->Mpublicacion->modificarPublicacionUsuario($datos);            
            
            if($resultado1){
                $this->session->set_flashdata('mensaje2', 'Publicación Modificada Correctamente');
            }else{
                $this->session->set_flashdata('mensaje', 'Error al Actualizar');
            }
            redirect("misPublicacionesExito");
            }
                
    }


    public function correo()
    {
        $datos['codigo'] = '86-030221-601b0e301640e';
        $re = $this->Mpublicacion->getPublicacionCodigo1($datos);
        $this->enviarEmailNotificacionPublicacion($re);
    }

    public function enviarEmailNotificacionPublicacion($datos)
    {

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.bienfino.com',
            'smtp_user' => 'hola@bienfino.com',
            'smtp_pass' => 'bienfino2019',
            'smtp_port' => '465',
            'smtp_crypto' => 'ssl',
            'mailtype' => 'html',
            /* 'wordwrap' => TRUE, */
            'charset' => 'utf-8'
        );
        //echo $CI->email->print_debugger();

        //echo $CI->email->print_debugger();

        //envio de email de verificación
        $asunto = "Nueva Publicación nro: " . $datos->id_publicacion2;
        $mensaje = "<br><a href='" . base_url() . "detallepublicacion/" . $datos->id_publicacion2 . ">Ver Publicación</a>";

        $mensaje .= "<p>El dia <strong>" . date('d/m/Y H:i:s') . "</strong> se ha generado una publicación</p>";
        $mensaje .= "<p>Usuario: " . $datos->nombres . " " . $datos->apellidos . " " . $datos->cedula . "</p>";


        $mensaje .= "<table><tr><th>Revisar</th><td></td></tr></table>";

        $mensaje .= "<table><tr><th>Para revisar la publicacion, presiona el siguiente link </th><td><a href='" . base_url() . "admbienfino'>AQUI</a></td></tr></table>";


        $this->email->initialize($config);
        $this->email->from('hola@bienfino.com', 'BienFino');
        $this->email->to('publicaciones@bienfino.com');
        $this->email->subject($asunto);
        $this->email->message($mensaje);



        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function send_email($datos) {

        $vista = $this->load->view('email/confirmacion',$datos,TRUE);
        
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.mailtrap.io',
          'smtp_port' => 2525,
          'smtp_user' => '2f78a451c2c93f',
          'smtp_pass' => '796c2c4b331bec',
          'crlf' => "\r\n",
          'newline' => "\r\n",
          'mailtype' => 'html',
        );
        
        /*
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.bienfino.com',
            'smtp_user' => 'hola@bienfino.com',
            'smtp_pass' => 'bienfino2019',
            /*'smtp_port' => '465',
            'smtp_crypto' => 'ssl',*
            'mailtype' => 'html',
            /* 'wordwrap' => TRUE, *
            'charset' => 'utf-8'
        );
        */

        $this->email->initialize($config);
        $this->email->from('hola@bienfino.com', 'BienFino');
        $this->email->to($datos['usuario']);
        $this->email->subject($datos['asunto']);
        $this->email->message($vista);



        if($this->email->send()) {
            return true;
        } else {
            return false;
        }    

    }

    public function pausarPublicacion($codigo)
    {
        comprobarUsuarioLogueado(NULL);

        //$datos['id_publicacion'] = $this->input->post('id_publicacion');
        $datos['id_usuario'] = $this->session->userdata('id_usuario');
        $datos['codigo'] = $codigo;

        $resultado = $this->Mpublicacion->pausarPublicacion($datos);
        if ($resultado) {
            redirect('Cpublicacion/misPublicacionesExito');
        }
    }

    public function finalizarPublicacion()
    {
        comprobarUsuarioLogueado(NULL);

        $datos['id_publicacion'] = $this->input->post('id_publicacion');
        $datos['id_usuario'] = $this->session->userdata('id_usuario');

        $resultado = $this->Mpublicacion->finalizarPublicacionVendido($datos);

        if ($resultado) {
            redirect('Cpublicacion/misPublicacionesExito');
        }
    }

    public function activarPublicacion()
    {
        comprobarUsuarioLogueado(NULL);

        $datos['id_publicacion'] = $this->input->post('id_publicacion');
        $datos['id_usuario'] = $this->session->userdata('id_usuario');

        $resultado = $this->Mpublicacion->activarPublicacion($datos);

        if ($resultado) {
            redirect('Cpublicacion/misPublicacionesExito');
        }
    }


    //metodo

    public function getMarca()
    {
        $data = array(
            'id_categoria' => $this->input->post('id_categoria'),
        );

        $marca = $this->Mpublicacion->getMarca($data);

        if ($marca) {
            $html1 = '<option value="">Marca</option>';
            $html1 .= '<option value="500000">--Agregar Marca--</option>';
            for ($i = 0; $i < count($marca); $i++) {
                $html1 .= "<option value=" . $marca[$i]->id_marca . ">" . ucwords($marca[$i]->marca) . "</option>";
            }
        } else {
            $html1 = '<option value="">Marca</option>';
            $html1 .= '<option value="500000">--Agregar Marca--</option>';
        }
        $respuesta1 = array("htmloption1" => $html1);
        echo json_encode($respuesta1);
    }

    public function getMarcaHome()
    {
        $data = array(
            'categoria' => $this->input->post('categoria'),
        );

        $marca = $this->Mpublicacion->getMarcaHome($data);

        if ($marca) {
            $html1 = '<option value="">Marca</option>';
            for ($i = 0; $i < count($marca); $i++) {
                $html1 .= "<option value=" . $marca[$i]->id_marca . ">" . ucwords($marca[$i]->marca) . "</option>";
            }
        } else {
            $html1 = '<option value="">Marca</option>';
        }

        $respuesta1 = array("htmloption1" => $html1);
        echo json_encode($respuesta1);
    }

    public function getModelo()
    {
        $data = array(
            'id_marca' => $this->input->post('id_marca'),
        );

        $modelo = $this->Mpublicacion->getModelo($data);

        if ($modelo) {
            $html1 = '<option value="">Modelo</option>';
            $html1 .= '<option value="500000">--Agregar Modelo--</option>';
            for ($i = 0; $i < count($modelo, 0); $i++) {
                $html1 .= "<option value=" . $modelo[$i]->id_modelo . ">" . ucwords($modelo[$i]->modelo) . "</option>";
            }
        } else {
            $html1 = '<option value="">Modelo</option>';
            $html1 .= '<option value="500000">--Agregar Modelo--</option>';
        }
        $respuesta2 = array("htmloption2" => $html1);
        echo json_encode($respuesta2);
    }

    public function getModeloHome()
    {
        $data = array(
            'marca' => $this->input->post('marca'),
            'categoria' => $this->input->post('categoria'),
        );

        $modelo = $this->Mpublicacion->getModeloHome($data);

        if ($modelo) {
            $html1 = '<option value="">Modelo</option>';
            for ($i = 0; $i < count($modelo, 0); $i++) {
                $html1 .= "<option value=" . $modelo[$i]->id_modelo . ">" . ucwords($modelo[$i]->modelo) . "</option>";
            }
        } else {
            $html1 = 'false';
        }
        $respuesta2 = array("htmloption2" => $html1);
        echo json_encode($respuesta2);
    }

    public function getAno()
    {

        $ano = date('Y');
        $html1 = '<option value="">Año</option>';
        for ($i = $ano; $i >= 1900; $i--) {
            $html1 .= "<option value=" . $i . ">" . $i . "</option>";
        }
        $respuesta3 = array("htmloption3" => $html1);
        echo json_encode($respuesta3);
    }

    public function generarCodigoUnicoPublicacion()
    {
        $aux = true;
        while ($aux) {
            $codigo = $this->session->userdata('id_usuario') . '-' . date('dmy') . '-' . uniqid();
            if ($this->Mpublicacion->verificarSiExisteCodigoPublicacion($codigo)) {
                $aux = false;
            }
        }
        return $codigo;
    }
    public function quitar_tildes($cadena)
    {

        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
        $texto = str_replace($no_permitidas, $permitidas, $cadena);
        return $texto;
    }


    public function limpiarFiltro($control)
    {
        if ($this->uri->segment(2) == 1) {
            $this->session->unset_userdata('categoria');
        } else if ($this->uri->segment(2) == 2) {
            $this->session->unset_userdata('estado');
            $this->session->unset_userdata('municipio');
            $this->session->unset_userdata('parroquia');
        } else if ($this->uri->segment(2) == 3) {
            $this->session->unset_userdata('municipio');
            $this->session->unset_userdata('parroquia');
        } else if ($this->uri->segment(2) == 4) {
            $this->session->unset_userdata('parroquia');
        } else if ($this->uri->segment(2) == 5) {
            $this->session->unset_userdata('estado');
        } else if ($this->uri->segment(2) == 6) {
            $this->session->unset_userdata('marca');
            $this->session->unset_userdata('modelo');
        } else if ($this->uri->segment(2) == 7) {
            $this->session->unset_userdata('modelo');
        } else if ($this->uri->segment(2) == 8) {
            $this->session->unset_userdata('anio');
        } else if ($this->uri->segment(2) == 9) {
            $this->session->unset_userdata('precio');
        } else if ($this->uri->segment(2) == 10) {
            $this->session->unset_userdata('km');
        }
        redirect("buscar");
    }

    public function busquedaMenu()
    {

        //        $nuevo = $this->input->post('control');

        /*
        $categoriamultiple = $this->input->post('categoriamultiple');

        for ($i=0; $i < count($categoriamultiple); $i++) { 
           echo $categoriamultiple[$i];
           echo "<br>";
        }exit();
 */
        $buscar = "";
        //MENU LATERAL IZQUIERDO
        //    $this->session->unset_userdata('categoriamultiple');
        //    $this->session->unset_userdata('ubicacionmultiple');
        //    $this->session->unset_userdata('marcamultiple');
        //MENU LATERAL IZQUIERDO        


        //        $this->session->unset_userdata('categoria_menu');
        //        $this->session->unset_userdata('marca_menu');
        //        $this->session->unset_userdata('modelo_menu');
        //        $this->session->unset_userdata('ano_menu');
        //        $this->session->unset_userdata('ubicacion_menu');
        /*

        if ($this->uri->segment(2) and $this->uri->segment(2) == 1 or $this->uri->segment(2) == 7) {
            $this->session->set_userdata('categoria_menu', $this->uri->segment(2));
        }

        if ($this->input->post('categoria_menu')!="") {
            $this->session->set_userdata('categoria_menu', $this->input->post('categoria_menu'));
        }
        if ($this->input->post('marca_menu')!="") {
            $this->session->set_userdata('marca_menu', $this->input->post('marca_menu'));
        }
        if ($this->input->post('modelo_menu')!="") {
            $this->session->set_userdata('modelo_menu', $this->input->post('modelo_menu'));
        }
        if ($this->input->post('ano_menu')!="") {
            $this->session->set_userdata('ano_menu', $this->input->post('ano_menu'));
        }
        if ($this->input->post('ubicacion_menu')!="") {
            $this->session->set_userdata('ubicacion_menu', $this->input->post('ubicacion_menu'));
        }
//MENU LATELARAL IZQUIERZO
        if ($this->input->post('categoriamultiple')!="") {
            $this->session->set_userdata('categoriamultiple', $this->input->post('categoriamultiple'));
        }
        if ($this->input->post('ubicacionmultiple')!="") {
            $this->session->set_userdata('ubicacionmultiple', $this->input->post('ubicacionmultiple'));
        }
        if ($this->input->post('marcamultiple')!="") {
            $this->session->set_userdata('marcamultiple', $this->input->post('marcamultiple'));
        }
        if ($this->input->post('modelomultiple')!="") {
            $this->session->set_userdata('modelomultiple', $this->input->post('modelomultiple'));
        }                      
//MENU LATELARAL IZQUIERZO
*/


        $this->form_validation->set_rules('buscar_palabra', 'buscar_palabra', 'trim|max_length[50]|strip_tags');
        if ($this->form_validation->run() === FALSE) {
            //$mensaje_error = validation_errors();
            //echo $mensaje_error;
            echo "Ups que haces por aqui?";
            exit;
        }

        if ($this->input->post('buscar_palabra')) {
            $buscar = strip_tags(trim(mb_strtolower($this->quitar_tildes($this->security->xss_clean($this->input->post('buscar_palabra'))))));
            /*$this->session->unset_userdata('categoria_menu');
            $this->session->unset_userdata('marca_menu');
            $this->session->unset_userdata('modelo_menu');
            $this->session->unset_userdata('ano_menu');
            $this->session->unset_userdata('ubicacion_menu');*/
        }

        //if (isset($nuevo) and $nuevo==1) {
        $this->session->set_userdata("buscar_palabra", $buscar);
        //}

        $this->unsetSesion();

        redirect("buscar");
    }

    public function unsetSesion()
    {
        $this->session->unset_userdata('categoria');
        $this->session->unset_userdata('estado');
        $this->session->unset_userdata('municipio');
        $this->session->unset_userdata('parroquia');
        $this->session->unset_userdata('estado');
        $this->session->unset_userdata('marca');
        $this->session->unset_userdata('modelo');
        $this->session->unset_userdata('anio');
        $this->session->unset_userdata('precio');
        $this->session->unset_userdata('km');
        //$this->session->unset_userdata('buscar_palabra');         
    }

    public function buscar($nropagina = FALSE)
    {
        //echo $this->session->userdata("km");exit;

        /*
        $this->session->unset_userdata('estado');
        $this->session->unset_userdata('marca');
        $this->session->unset_userdata('modelo');
        $this->session->unset_userdata('anio');
        $this->session->unset_userdata('categoria');
        $this->session->unset_userdata('municipio');
*/

        //nuevo filtro

        /*         $datosRomel['nombreApellido'] = "romel guaregua";
        $datosRomel['cedula'] = 22035532;
        $this->session->set_userdata('datosRomel', $datosRomel); */

        
		
        if ($this->input->get('estado') != "") {
            $this->session->set_userdata('estado', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('estado')))));
        }
        if ($this->input->get('municipio') != "") {
            $this->session->set_userdata('municipio', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('municipio')))));
        }
        if ($this->input->get('parroquia') != "") {
            $this->session->set_userdata('parroquia', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('parroquia')))));
        }
        if ($this->input->get('marca') != "") {
            $this->session->set_userdata('marca', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('marca')))));
        }
        if ($this->input->get('modelo') != "") {
            $this->session->set_userdata('modelo', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('modelo')))));
        }
        if ($this->input->get('anio') != "") {
            $this->session->set_userdata('anio', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('anio')))));
        }
        if ($this->input->get('categoria') != "") {
            $this->session->set_userdata('categoria', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('categoria')))));
        }
        if ($this->input->get('precio') != "") {
            $this->session->set_userdata('precio', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('precio')))));
        }
        if ($this->input->get('km') != "") {
            $this->session->set_userdata('km', $this->db->escape_str(trim($this->security->xss_clean($this->input->get('km')))));
        }

        $arrayBuscar = array();

        if ($this->db->escape_str(trim($this->security->xss_clean($this->session->userdata("buscar_palabra"))))) {
            $cadena = $this->session->userdata("buscar_palabra");
            $arrayBuscar = explode(" ", $cadena);
        }

        $inicio = 0;
        $cantidad = 20;
        if ($nropagina) {
            $inicio = ($nropagina - 1) * $cantidad;
        }

        $resultado = $this->Mpublicacion->buscar($arrayBuscar);

        $cantidad_resultado = count($resultado);
        //libreria pagination
        $config['base_url'] = base_url() . "buscar";
        $config['total_rows'] = $cantidad_resultado;
        $config['per_page'] = $cantidad;
        $config['uri_segment'] = 2; //segmento donde se coloca el numero de paginacion
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url() . "buscar/";

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="near">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        //libreria pagination
 
        if ($cantidad_resultado > $cantidad) {
            $resultado = $this->Mpublicacion->buscar($arrayBuscar, $inicio, $cantidad);
        }

        if ($this->session->userdata("estado")) {
            $data['codigoestado'] = $this->session->userdata("estado");
            $municipios = $this->Mpublicacion->getMunicipios($data);
            $datos['municipios'] = $municipios;
        }
        if ($this->session->userdata("estado") and $this->session->userdata("municipio")) {
            $data['codigoestado'] = $this->session->userdata("estado");
            $data['codigomunicipio'] = $this->session->userdata("municipio");
            $parroquias = $this->Mgeo->getParroquias($data);
            $datos['parroquias'] = $parroquias;
        }

        $categorias = $this->Mpublicacion->getCategoriasHome();
        $estados = $this->Mpublicacion->getEstados();
        //$precios = $this->Mpublicacion->getPrecios();
        $modelos = $this->Mpublicacion->getModelos2();
        $marcas = $this->Mpublicacion->getMarca2();
        $anio = $this->Mpublicacion->getAnio();

        $datos['categorias'] = $categorias;
        $datos['estados'] = $estados;
        //$datos['precios'] = $precios;
        $datos['modelos'] = $modelos;
        $datos['marcas'] = $marcas;
        $datos['anio'] = $anio;

        if ($resultado) {

            if ($this->session->userdata('id_usuario')) {
                $resultado2 = $this->Mgaraje->getPublicionesMiGarajeXusuario();
                $datos['migaraje'] = $resultado2;
            }

            $datos['cantidad_resultado'] = $cantidad_resultado;
            $datos['busqueda'] = $resultado;
            $this->load->view('layouts/headerR', $datos);
            $this->load->view('publicacion/busquedaR', $datos);

        } else {

            $datos['mensaje'] = "Disculpe no se encontraron resultados, intente de nuevo";
            $this->load->view('layouts/headerR', $datos);
            $this->load->view('publicacion/busquedaR', $datos);
        }
    }

    public function telfmovil($str)
    {
        return (!preg_match("/^[0][4|2][0-9]{9}$/i", $str)) ? FALSE : TRUE;
    }

    public function placa_check($placa)
    {
        $placa = mb_strtolower($placa);
        $resultado = $this->Mpublicacion->verificarPlaca($placa);
        if ($resultado) {
            $this->form_validation->set_message('placa_check', 'La placa ' . $placa . ' ya se encuentra registrada');
            //return FALSE;
            return TRUE;
        } else {
            return TRUE;
        }
    }

    public function ajaxUploadImg()
    {
        // $userid= $this->session->userdata('id_usuario');
        comprobarUsuarioLogueado(NULL);

        $datos['id_precio'] = $this->input->post('id_precio');
        $codigo = $this->input->post('codigo');
        $position = $this->input->post('position');
        $datos['codigo'] = $codigo;

        if (empty($_FILES['file'])) {

            echo json_encode(['result' => false, 'msg' => 'Error no se recibio archivo, o el archivo es muy pesado']);
            set_status_header('500');
            exit();
        }

        $file = $_FILES['file'];
        //echo json_encode(['codigo'=>$codigo,'file'=>$file]);
        // var_dump( $file);
        // exit();

        //nombre de la imagen
        $nombre = $file['name'];
        //extension de la imagen
        //$nombre_ext = explode(".",$nombre);
        $nombre_ext = "jpg";
        $nombre_completo = $position . "_principal_" . uniqid() . "." . $nombre_ext;



        $datos['url_' . $this->numToLetra($position)] = $nombre_completo;


        $carpeta = getcwd() . '/publicaciones/' . $codigo;

        if (!file_exists($carpeta)) {
            if (!mkdir($carpeta, 0777, true)) {

                echo json_encode(['result' => false, 'msg' => 'Error no se pudo crear la carpeta']);
                exit();
            }
        }
        if (file_exists($carpeta)) {
            if (!empty($file)) {



                //cargar imagen
                $config['max_size'] = '4096';
                $config['quality'] = '90%'; //calidad  
                $config['upload_path'] = './publicaciones/' . $codigo; //ruta
                $config['file_name'] = $nombre_completo;
                $config['allowed_types'] = 'jpg|png|gif';
                //$config['overwrite'] = true; //sobre escribe si existe un archivo con el mismo nombre
                $config['file_ext_tolower'] = true; //coloca la extension en minuscula

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('file')) {

                    echo json_encode(['result' => false, 'msg' => '1) Error al cargar imagen(' . $position . ') por favor intente de nuevo']);
                    exit();
                }


                //procesar imagen

                $config2['source_image'] = './publicaciones/' . $codigo . '/' . $nombre_completo;
                $config2['quality'] = '90%'; //calidad  
                $config2['width'] = 1024;
                $config2['height'] = 800;
                $config2['maintain_ratio'] = TRUE; //forza cambio de resolucion de la imagen

                $this->image_lib->initialize($config2);
                if (!$this->image_lib->resize()) {

                    echo json_encode(['result' => false, 'msg' => 'mensaje', '2) Error al cargar imagen(' . $position . ')']);
                    exit();
                }

                $config3['source_image'] = './publicaciones/' . $codigo . '/' . $nombre_completo;
                $config3['wm_text'] = 'BienFino.com';
                $config3['wm_type'] = 'text';
                $config3['wm_font_path'] = './system/fonts/texb.ttf'; //fuente de las letras
                $config3['wm_font_size'] = '16';
                $config3['wm_font_color'] = 'ffffff';
                $config3['wm_vrt_alignment'] = 'top';
                $config3['wm_hor_alignment'] = 'right';
                //$config3['wm_padding'] = '20;

                $this->image_lib->initialize($config3);

                //$this->image_lib->watermark();
                $this->image_lib->clear();




                //metodo para registrar una publicacion
                $resultado = $this->Mpublicacion->registrarPublicacionDosTres($datos);

                if ($resultado) {
                    set_status_header('200');
                    echo json_encode(['result' => true, 'url' => $nombre_completo]);
                    exit();
                } else {
                    set_status_header('500');
                    //mando a la vista de error
                    echo json_encode(['result' => false, 'msg' => 'Error no se pudo guardar la imagen']);
                    exit();
                }
            }
        } else {
            set_status_header('500');
            echo json_encode(['result' => false, 'msg' => 'Error la carpeta no existe']);
            exit();
        } //si ocurre un error al subir alguna imagen elimina la publicacion y manda un mensaje de error diciendo que lo vuelva a intentar

    }

    public function numToLetra($num)
    {
        $letra = "";
        switch ($num) {
            case "1";
            case 1;
                $letra = "uno";
                break;
            case "2";
            case 2;
                $letra = "dos";
                break;
            case "3";
            case 3;
                $letra = "tres";
                break;
            case "4";
            case 4;
                $letra = "cuatro";
                break;
            case "5";
            case 5;
                $letra = "cinco";
                break;
            case "6";
            case "6";
                $letra = "seis";
                break;
            default:
                $letra = "undefined";
                break;
        }

        return $letra;
    }

    //recibo ruta y codigo de publicacion
    public function setImg($archivo, $carpeta, $codigo, $position, $id_precio)
    {

        echo json_encode(['result' => false, 'msg' => $carpeta]);
        exit();

        foreach ($archivo as $key => $file) {


            $ext = new SplFileInfo($file['name']);
            $extension = $ext->getExtension();
            $nombre_completo = $position . "_principal_" . uniqid() . "." . $extension;

            //cargar imagen
            $config['max_size'] = '4096';
            $config['quality'] = '90%'; //calidad  
            $config['upload_path'] = $carpeta; //ruta; //ruta
            $config['file_name'] = $nombre_completo;
            $config['allowed_types'] = 'jpg|png|gif';
            //$config['overwrite'] = true; //sobre escribe si existe un archivo con el mismo nombre
            $config['file_ext_tolower'] = true; //coloca la extension en minuscula

            $this->upload->initialize($config);
            $this->load->library('upload', $config);


            if (!$this->upload->do_upload($key)) {

                echo json_encode(['result' => false, 'msg' => '1) Error al cargar imagen por favor intente de nuevo', 'position' => $position]);
                exit();
            }
            //chmod($carpeta.'/'. $file['name'], 0777);

            //procesar imagen
            $config2['source_image'] = $carpeta . '/' . $nombre_completo;
            $config2['quality'] = '90%'; //calidad  
            $config2['width'] = 1024;
            $config2['height'] = 800;
            $config2['maintain_ratio'] = TRUE; //forza cambio de resolucion de la imagen

            $this->image_lib->initialize($config2);
            $this->load->library('image_lib', $config);
            if (!$this->image_lib->resize()) {

                echo json_encode(['result' => false, 'msg' => 'mensaje', '2) Error al procesa imagen', 'position' => $position]);
                exit();
            }
            /*
            $config3['source_image'] = $carpeta.'/'. $nombre_completo;
            $config3['wm_text'] = 'BienFino.com';
            $config3['wm_type'] = 'text';
            $config3['wm_font_path'] = './system/fonts/texb.ttf'; //fuente de las letras
            $config3['wm_font_size'] = '16';
            $config3['wm_font_color'] = 'ffffff';
            $config3['wm_vrt_alignment'] = 'button';
            $config3['wm_hor_alignment'] = 'right';
            //$config3['wm_padding'] = '20;

            $this->image_lib->initialize($config3);

            $this->image_lib->watermark();
            $this->image_lib->clear();

            $url = 'url_'.$this->numToLetra($i+1);//nombre del campo en bs url_uno, url_dos, etc
            $datos[$url] = $nombre_completo;

            $i++;
            */
        }

        $datos['url_' . $this->numToLetra($position)] = $nombre_completo;
        $datos['id_precio'] = $id_precio;
        $datos['id_usuario2'] = $this->session->userdata('id_usuario');
        $datos['codigo'] = $codigo;

        //echo json_encode(['result' => true, 'msg' => $datos]);

        if ($this->Mpublicacion->registrarPublicacionDosTres($datos)) {
            set_status_header('200');
            echo json_encode(['result' => true, 'msg' => 'Se registro  imagenes correctamente', 'position' => $position]);
            exit();
        } else {
            //set_status_header('500');
            echo json_encode(['result' => false, 'msg' => 'Error no se pudo registrar en bd las imagenes', 'position' => $position]);
            exit();
        }
    }

    //DEPRECADO
    public function UploadImg()
    {
        comprobarUsuarioLogueado(NULL);


        if (!empty($_FILES)) {

            $codigo = $this->input->post('codigo');
            $position = $this->input->post('position');
            $id_precio = $this->input->post('id_precio');
            $carpeta = './publicaciones/' . $codigo;
            $archivo = $_FILES;



            if (file_exists($carpeta)) {
                chmod($carpeta, 0777);
                $this->setImg($archivo, $carpeta, $codigo, $position, $id_precio);
            } else {
                @mkdir($carpeta, 0755, true);
                chmod($carpeta, 0777);
                $this->setImg($archivo, $carpeta, $codigo, $position, $id_precio);
            }
        } else {
            //echo json_encode(['result' => false, 'msg' => 'Error no se recibio archivo, o el archivo es muy pesado', 'position' => $position]);
            set_status_header('500');
            exit();
        }
    }

    public function loadImg()
    {

        $datos['codigo'] = $this->input->post('codigo');

        $resultado = $this->Mpublicacion->getPublicacionCodigo($datos);

        if ($resultado) {

            $data['1'] = $resultado->url_uno;
            $data['2'] = $resultado->url_dos;
            $data['3'] = $resultado->url_tres;
            $data['4'] = $resultado->url_cuatro;
            $data['5'] = $resultado->url_cinco;
            $data['6'] = $resultado->url_seis;
            $data['id_precio'] = $resultado->id_precio;

            echo json_encode(['result' => true, 'msg' => 'Exito', 'data' => $data]);
            set_status_header('200');
        }
    }

    public function insertPublicaciones()
    {
        $this->Mpublicacion->insertPublicaciones();
    }

    public function matchPublicaciones()
    {
        $this->Mpublicacion->matchPublicaciones();
    }

    public function matchFilePublicaciones()
    {
        $this->Mpublicacion->matchFilePublicaciones();
    }

    public function reiniciocampobusquedadpublicacion(){
        $this->Mpublicacion->reiniciocampobusquedadpublicacion();
    }
}
