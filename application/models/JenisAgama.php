<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class JenisAgama extends CI_Model
{
    private $_table = "mst_jenis_agama";

    public $id_jenis_agama;

    public function get()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function find($id)
    {
        return $this->db->get_where($this->_table, ["id_satker" => $id])->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_satker" => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, ["id_satker" => $id]);
    }
}
