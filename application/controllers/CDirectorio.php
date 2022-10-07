<?php class CDirectorio extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->library('session');
		$this->load->model('MMigrator');
		$this->load->model('MDirectorio');
		$this->load->model('MEstado');
		$this->load->model('MParroquia');
		$this->load->model('MMunicipio');
		$this->load->model('MCategoria');
		$this->load->model('MMarcas');
		$this->load->model('MPreguntas_BF');
		$this->load->model('MMetodo_Pago');
		$this->load->model('Madministrador');

		$this->load->model('Musuarios');
        $this->load->library('pagination');
        $this->load->library('email');
		$this->load->model('Mgeo');
		//$this->output->enable_profiler(TRUE);

	}

	# GET  /directorio/migrate
	public function reversal(){
		$this->MMigrator->reversal();
		ddt('Tablas Creada');
	}

	# GET  /directorio
	public function index(){


		$this->load->view('directorio/index',array(
			'table'			=> $this->MDirectorio->get('directorio/index'),
			'estados'		=> $this->MEstado->list(),
			'parroquias'	=> $this->MParroquia->list(),
			'municipios'	=> $this->MMunicipio->list(),
			'categorias'	=> $this->MCategoria->list(),
			'marcas'		=> $this->MMarcas->list(),
			'preguntas_bf'	=> $this->MPreguntas_BF->list(),
			'metodos_pago'	=> $this->MMetodo_Pago->list(),
		));
		
	}

	# POST /directorio/insert
	public function insert(){

		$_POST['responsable_id'] = $_SESSION['data']['responsable_id'];
		$_POST['usuario_id'] = $_SESSION['data']['usuario_id'];
		
		$id = $this->MDirectorio->insert('directorio/insert');
		store_alert( "<b>Directorio {$id} creado</b>" );
		return_success( 1 );
		//redirect('listarDirectorio');
	}

	# POST /directorio/update
	public function update(){
		$id = $this->MDirectorio->update('directorio/update');
		store_alert( "<b>Directorio {$id} actualizado</b>" );
		return_success( 1 );
	}

	# POST /directorio/delete
	public function delete(){
		$id = $this->MDirectorio->delete('directorio/delete');
		store_alert( "<b>Directorio {$id} eliminado</b>" );
		return_success( 1 );
	}

	# POST /directorio/restore
	public function restore(){
		$id = $this->MDirectorio->restore('directorio/restore');
		store_alert( "<b>Directorio {$id} restaurado</b>" );
		return_success( 1 );
	}

////////////////////////////////////////////////////////////////////////////////////////////////////


	public function VlistarDirectorio(){

		if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
		$this->session->unset_userdata('buscador');
		
		$this->load->view('directorio/VlistarDirectorio',array(
			'table'			=> $this->MDirectorio->get('directorio/index',NULL,TRUE),
			'estados'		=> $this->MEstado->list(),
			'parroquias'	=> $this->MParroquia->list(),
			'municipios'	=> $this->MMunicipio->list(),
			'categorias'	=> $this->MCategoria->list(),
			'marcas'		=> $this->MMarcas->list(),
			'preguntas_bf'	=> $this->MPreguntas_BF->list(),
			'metodos_pago'	=> $this->MMetodo_Pago->list(),
		));

	}

	public function VaddDirectorio(){

		if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
		
		$datos['usuario_id'] = strip_tags(trim($this->uri->segment(2)));

        if (!ctype_digit($datos['usuario_id'])) {
            echo "id usuario incorrecto";
            exit; //valida que es numero e
        }
		$_POST['responsable_id'] = $this->session->userdata('id_adm');
        $_SESSION['data']['responsable_id'] = $this->session->userdata('id_adm');
        $_SESSION['data']['usuario_id'] = $datos['usuario_id'];

		$this->load->view('directorio/VaddDirectorio',array(
			'table'			=> $this->MDirectorio->get(''),
			'estados'		=> $this->MEstado->list(),
			'parroquias'	=> $this->MParroquia->list(),
			'municipios'	=> $this->MMunicipio->list(),
			'categorias'	=> $this->MCategoria->list(),
			'marcas'		=> $this->MMarcas->list(),
			'preguntas_bf'	=> $this->MPreguntas_BF->list(),
			'metodos_pago'	=> $this->MMetodo_Pago->list(),
		));

	}

	public function Vresultadodirectorio(){

		$data['nueva_busqueda'] = trim(strip_tags($this->input->get('nueva_busqueda')));

		if($data['nueva_busqueda']==1){
			$data['buscador'] = trim(strip_tags($this->input->get('buscador')));
		}else{
			$data['buscador'] = $this->session->userdata('buscador');
		}
		$data['codigoestado_directorio'] = trim(strip_tags($this->input->get('codigoestado_directorio')));
		$data = $this->security->xss_clean($data);
		
		//recibe buscador y codigoestado y creo var session
		$this->session->set_userdata(array(
			'buscador' => $data['buscador'],
			'codigoestado_directorio' => $data['codigoestado_directorio']
		));

		//$this->session->userdata('buscador');
		//$this->session->userdata('codigoestado_directorio');

		
		//var_dump($this->MDirectorio->get('directorio/index',TRUE));exit;

		$this->load->view('layouts/headerR',array('resultadodirectorio'=> true));
		$this->load->view('directorio/Vresultadodirectorio',array(
			//se le envia true para traer directorios activos
			'table'			=> $this->MDirectorio->get('directorio/index',TRUE),
			'estados'		=> $this->MEstado->list(),
			'parroquias'	=> $this->MParroquia->list(),
			'municipios'	=> $this->MMunicipio->list(),
			'categorias'	=> $this->MCategoria->list(),
			'marcas'		=> $this->MMarcas->list(),
			'preguntas_bf'	=> $this->MPreguntas_BF->list(),
			'metodos_pago'	=> $this->MMetodo_Pago->list(),
			'estados'       => $this->Mgeo->getEstados()
		));
 		
	}

	public function Vdirectoriodetalle(){

		$datos['id'] = strip_tags(trim($this->uri->segment(2)));
        if (!ctype_digit($datos['id'])) {
            echo "id incorrecto";
            exit; //valida que es numero entero
        }

		$this->session->unset_userdata('buscador');

		$this->session->set_userdata(array(
			'id' => $datos['id']
		));
		//un modelo que envie el id del directorio y me retorne los datos
		//renderizar en la vista

		$this->load->view('layouts/headerR',array('resultadodirectorio'=> true));
		//exit;
		$this->load->view('directorio/Vdirectoriodetalle',array(
			'directoriodetalle' => $this->MDirectorio->get('directorio/index',TRUE),
			'estados'		=> $this->MEstado->list(),
			'parroquias'	=> $this->MParroquia->list(),
			'municipios'	=> $this->MMunicipio->list(),
			'categorias'	=> $this->MCategoria->list(),
			'marcas'		=> $this->MMarcas->list(),
			'preguntas_bf'	=> $this->MPreguntas_BF->list(),
			'metodos_pago'	=> $this->MMetodo_Pago->list(),
			'estados'       => $this->Mgeo->getEstados()
		));
 		
	}


	public function limpiarFiltro($control)
    {
		//var_dump($this->uri->segment(3));exit;
        if ($this->uri->segment(3) == 2) {
            $this->session->unset_userdata('codigoestado_directorio');
        }
        redirect("resultadodirectorio");
    }

	public function correo()
    {

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.bienfino.com',
            'smtp_user' => 'hola@bienfino.com',
            'smtp_pass' => 'bienfino2019',
            'smtp_port' => '587',
            //'smtp_crypto' => 'ssl',
            //'mailtype' => 'html',
            /* 'wordwrap' => TRUE, */
            'charset' => 'utf-8'
        );
		
        //echo $CI->email->print_debugger();

        //echo $CI->email->print_debugger();

        //envio de email de verificación
        $asunto = "Prueba correo";
        $mensaje = "<p>El dia <strong>" . date('d/m/Y H:i:s') . "</strong> se ha generado una publicación</p>";


        $this->email->initialize($config);
        $this->email->from('hola@bienfino.com', 'BienFino');
        $this->email->to('romel174gl@gmail.com');
        $this->email->subject($asunto);
        $this->email->message($mensaje);

		//var_dump($this->email->send());exit;

        if ($this->email->send()) {
			echo "Correo enviado";
            return true;
        } else {
			$this->email->print_debugger();
			echo "Correo no enviando";
            return false;
        }
    }

	public function Vpagosdirectorio(){

		if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
		
		$resultado = $this->Madministrador->listarPagosDirectorio();
		$datos['pagosdirectorios'] = $resultado;
		
		$this->load->view('adm/Vheader');
		$this->load->view('directorio/Vpagosdirectorio',$datos);
		$this->load->view('adm/Vfooter');

	}

	public function verificarActivarDirectorio(){

		if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

		$datos['id_directorio_pago'] = strip_tags(trim($this->uri->segment(2)));
		$datos['id'] = strip_tags(trim($this->uri->segment(3)));
        if (!ctype_digit($datos['id_directorio_pago']) and !ctype_digit($datos['id'])) {
            echo "ids incorrectos";
            exit; //valida que es numero entero
        }

		$fecha_inicio = date_create();
        $datos['fecha_inicio'] = date_format($fecha_inicio, 'Y-m-d H:i:s.u');
		

		$fecha_final = date_create("91 days");
        $datos['fecha_final'] = date_format($fecha_final, 'Y-m-d H:i:s.u');

		if($this->Madministrador->verificarActivarDirectorio($datos))
			$this->session->set_flashdata('mensajecompletado', 'Operación procesada correctamente');
		else
			$this->session->set_flashdata('mensaje2', 'Ocurrio un error intente de nuevo');
		
		redirect('pagosdirectorios');

		
	}

	public function reversarDesactivarDirectorio(){

		if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

		$datos['id_directorio_pago'] = strip_tags(trim($this->uri->segment(2)));
		$datos['id'] = strip_tags(trim($this->uri->segment(3)));
        if (!ctype_digit($datos['id_directorio_pago']) and !ctype_digit($datos['id'])) {
            echo "ids incorrectos";
            exit; //valida que es numero entero
        }

		if($this->Madministrador->reversarDesactivarDirectorio($datos))
			$this->session->set_flashdata('mensajecompletado', 'Operación procesada correctamente');
		else
			$this->session->set_flashdata('mensaje2', 'Ocurrio un error intente de nuevo');
		redirect('pagosdirectorios');
	}

	public function VaddPagoDirectorio(){
		if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }

		$datos['id'] = $this->input->post('id');

        $this->load->view('adm/Vheader');
        $this->load->view('directorio/VaddPagoDirectorio',$datos);
        $this->load->view('adm/Vfooter');
	}
	
	public function addPagoDirectorio(){
		if (!$this->session->userdata('id_adm')) {
            redirect('admbienfino');
        }
		
		$datos['id_directorio'] = $this->input->post('id');
		$datos['metodo_pago'] = $this->input->post('metodo-pago');

		if ($this->input->post('banco-origen')!="") {
			$datos['banco_origen'] = $this->input->post('banco-origen');
		}
		if ($this->input->post('banco-destino')!="") {
			$datos['banco_destino'] = $this->input->post('banco-destino');
		}
		$datos['monto'] = $this->input->post('monto');

		if ($this->input->post('referencia')!="") {
			$datos['referencia'] = $this->input->post('referencia');
		}
		$datos['estatus'] = 'sin verificar';

		if($datos['id_directorio'] and $datos['metodo_pago'] and $datos['monto']){
			if($this->Madministrador->addPagoDirectorio($datos))
			$this->session->set_flashdata('mensajecompletado', 'Operación procesada correctamente');
		else
			$this->session->set_flashdata('mensaje2', 'Ocurrio un error intente de nuevo');
		redirect('listarDirectorio');
		}

	}



} ?>
