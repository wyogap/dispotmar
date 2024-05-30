<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class JenisKonservasi extends CI_Model
{
    private $_table = "mst_jenis_konservasi";

    public $id_jenis_konservasi;

    public function get()
    {
		$this->db->where('is_active',1);
        return $this->db->get($this->_table)->result();
    }
    
    public function find($id)
    {
		$this->db->where('is_active',1);
        return $this->db->get_where($this->_table, ["id_jenis_konservasi" => $id,"is_active" => 1])->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
		$this->db->where('is_active',1);
        return $this->db->update($this->_table, $data, ["id_jenis_konservasi" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_jenis_konservasi" => $id]);
    }
}
