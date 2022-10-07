<?php
/**
* 
*/
class Mpago extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function eliminarReportePago($id_publicacion){

		$this->db->trans_begin();

		$data['id_usuario2'] = $this->session->userdata('id_usuario');
		$data['estatus'] = 4;
		$this->db->where('id_publicacion',$id_publicacion);
		$this->db->update('vehiculo.tbl_publicaciones',$data);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
		        return FALSE;
			}


		$this->db->where('id_usuario2',$data['id_usuario2']);
		$this->db->where('id_publicacion',$id_publicacion);
		$this->db->delete('vehiculo.tbl_pagos');

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
		        return FALSE;
			}

		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	        return FALSE;
		}
		else
		{
	        $this->db->trans_commit();
	        return TRUE;
		}		
	}


	public function getPagoXpublicacion($id_publicacion){

		$this->db->join('vehiculo.tbl_publicaciones', 'tbl_publicaciones.id_publicacion = tbl_pagos.id_publicacion');
		$this->db->join('vehiculo.tbl_tipo_pago', 'tbl_tipo_pago.id_tipo_pago = tbl_pagos.id_tipo_pago');
		$this->db->join('vehiculo.tbl_bancos_origen', 'tbl_bancos_origen.id_banco_ori = tbl_pagos.id_banco_ori');
		$this->db->join('vehiculo.tbl_bancos_destino', 'tbl_bancos_destino.id_banco_des = tbl_pagos.id_banco_des');

		$this->db->where('vehiculo.tbl_pagos.id_usuario2',$this->session->userdata('id_usuario'));

		$this->db->where("vehiculo.tbl_pagos.id_publicacion",$id_publicacion);
		$resultado = $this->db->get('vehiculo.tbl_pagos');

            if ($resultado->num_rows() > 0) 
                return $resultado->row();
            else
                return false;			
	}


	public function getPagos($id_pago_estatus){

		$this->db->join('vehiculo.tbl_publicaciones', 'tbl_publicaciones.id_publicacion = tbl_pagos.id_publicacion');
		$this->db->join('vehiculo.tbl_tipo_pago', 'tbl_tipo_pago.id_tipo_pago = tbl_pagos.id_tipo_pago');
		$this->db->join('vehiculo.tbl_bancos_origen', 'tbl_bancos_origen.id_banco_ori = tbl_pagos.id_banco_ori');
		$this->db->join('vehiculo.tbl_bancos_destino', 'tbl_bancos_destino.id_banco_des = tbl_pagos.id_banco_des');
		$this->db->join('usuario.tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_pagos.id_usuario2');
		$this->db->where('vehiculo.tbl_pagos.id_pago_estatus',$id_pago_estatus);
		$this->db->order_by("vehiculo.tbl_publicaciones.id_publicacion", "DESC");

		$resultado = $this->db->get('vehiculo.tbl_pagos');

            if ($resultado->num_rows() > 0) 
                return $resultado->result();
            else
                return false;			
	}

	
	public function getPrecioXpublicacion($id_precio){
		$this->db->where("id_precio",$id_precio);
		$resultado = $this->db->get('vehiculo.tbl_precios');

            if ($resultado->num_rows() > 0) 
                return $resultado->row();
            else
                return false;			
	}

	public function procesarPagoUpdate($data){

		$this->db->trans_begin();


		$this->db->where('id_usuario',$data['id_usuario']);
		$this->db->where('id_publicacion',$data['id_publicacion']);
		$this->db->update('vehiculo.tbl_pagos',$data);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
		        return FALSE;
			}

		$id_publicacion = $data['id_publicacion'];
		
		$this->db->join('vehiculo.tbl_precios', 'tbl_publicaciones.id_precio = tbl_precios.id_precio');		
		$query = $this->db->get('vehiculo.tbl_publicaciones',$id_publicacion);
		$precio = $query->row();
		
		$data['precio_publicacion'] = $precio->total;
		$dataP['estatus'] = 6;

		$this->db->where('id_publicacion',$id_publicacion);
		$this->db->update('vehiculo.tbl_publicaciones',$dataP);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
		        return FALSE;
			}

		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return FALSE;
		}
		else
		{
		        $this->db->trans_commit();
		        return TRUE;
		}			
	}

	public function procesarPagoInsert($datos){

		$this->db->trans_begin();

		$this->db->insert('vehiculo.tbl_pagos',$datos);

		$id_publicacion = $datos['id_publicacion'];

		$this->db->join('vehiculo.tbl_precios', 'tbl_publicaciones.id_precio = tbl_precios.id_precio');		
		$query = $this->db->get('vehiculo.tbl_publicaciones',$id_publicacion);
		$precio = $query->row();


		$data['estatus'] = 6;
		$data['precio_publicacion'] = $precio->total;

		$this->db->where('id_publicacion',$id_publicacion);
		$this->db->update('vehiculo.tbl_publicaciones',$data);

			if (!$this->db->affected_rows()>0) {
				$this->db->trans_rollback();
		        return FALSE;
			}
			
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return FALSE;
		}
		else
		{
		        $this->db->trans_commit();
		        return TRUE;
		}		
	}

	public function verificarPagoPublicacion($datos){

		$this->db->where('id_publicacion',$datos['id_publicacion']);
		$resultado = $this->db->get('vehiculo.tbl_pagos');

        if ($resultado->num_rows() > 0) 
            return $resultado->row();
        else
            return false;

	}

	public function getBancoOrigen(){

		$this->db->order_by("id_banco_ori", "asc");
		$resultado = $this->db->get('vehiculo.tbl_bancos_origen');

            if ($resultado->num_rows() > 0) 
                return $resultado->result();
            else
                return false;	
	}

	public function getBancoDestino(){

		$this->db->order_by("id_banco_des", "asc");
		$resultado = $this->db->get('vehiculo.tbl_bancos_destino');

            if ($resultado->num_rows() > 0) 
                return $resultado->result();
            else
                return false;			
	}

	public function getTipoPago(){

		$this->db->order_by("id_tipo_pago", "asc");
		$resultado = $this->db->get('vehiculo.tbl_tipo_pago');

            if ($resultado->num_rows() > 0) 
                return $resultado->result();
            else
                return false;			
	}


}
