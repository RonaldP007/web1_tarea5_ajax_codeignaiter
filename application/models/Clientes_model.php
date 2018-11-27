<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model
{

	var $table = 'cliente';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


    public function get_all_clientes()
    {
        $this->db->from('cliente');
        $query=$this->db->get();
        return $query->result();
    }


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('cedula',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function cliente_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}


	public function delete_by_id($id)
	{
		$this->db->where('registro', $id);
		$this->db->delete($this->table);
	}


}