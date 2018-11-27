<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	 public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('Clientes_model');
	 	}


	public function index()
	{

		$data['clientes']=$this->Clientes_model->get_all_clientes();
		$this->load->view('clientes_view',$data);
    }
    
	public function cliente_add()
		{
			$data = array(
					'cedula' => $this->input->post('cedula'),
					'nombre' => $this->input->post('nombre'),
					'apellidos' => $this->input->post('apellidos'),
					'telefono' => $this->input->post('telefono'),
				);
			$insert = $this->Clientes_model->cliente_add($data);
			echo json_encode(array("status" => TRUE));
        }
        

	public function cliente_delete($id)
	{
		$this->Clientes_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}
