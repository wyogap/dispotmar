<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Partai extends CI_Model
{
    private $_table = "mst_partai";

    public $id_partai;

    public function get()
    {
		$this->db->where('is_active',1);
        return $this->db->get($this->_table)->result();
    }
    
    public function find($id)
    {
		$this->db->where('is_active',1);
        return $this->db->get_where($this->_table, ["id_partai" => $id,"is_active" => 1])->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
		$this->db->where('is_active',1);
        return $this->db->update($this->_table, $data, ["id_partai" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_partai" => $id]);
    }
}
