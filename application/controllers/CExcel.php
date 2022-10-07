<?php class CExcel extends CI_Controller {

    function __construct() {
		parent::__construct();
		$this->load->library('session');
    }

	# GET  /excel
	public function index(){
		excel_view( array(
			'sql'		=> $_SESSION['EXCEL']['SQL'],
			'count' 	=> $_SESSION['EXCEL']['COUNT'],
			'name'		=> $_SESSION['EXCEL']['NAME'].date( '_Y_m_d_H_i_s' ),
		));
		die();
	}
} ?>