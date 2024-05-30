<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Modul extends CI_Model
{
    private $_table = "mst_modul";

    public $id_modul;

    public function getAll()
    {
		$this->db->select('modul.*,permission.id_permission,permission.create,permission.read,permission.read_all,permission.update,permission.delete');
		$this->db->where('modul.is_active',1);
		$this->db->order_by('modul.id_modul','DESC');
		$this->db->join('mst_permission AS permission','modul.id_modul = permission.id_modul','LEFT');
        return $this->db->get("$this->_table AS modul")->result();
	}
	
    public function get($id)
    {
		$this->db->select('modul.*,permission.id_permission,permission.create,permission.read,permission.read_all,permission.update,permission.delete');
		$this->db->where('modul.is_active',1);
		$this->db->where('permission.id_role',$id);
		$this->db->order_by('modul.id_modul','DESC');
		$this->db->join('mst_permission AS permission','modul.id_modul = permission.id_modul','LEFT');
        return $this->db->get("$this->_table AS modul")->result();
    }

    public function generate()
    {
		$this->db->where('modul.is_active',1);
		$this->db->order_by('modul.id_modul','DESC');
        return $this->db->get("$this->_table AS modul")->result();
	}
    
    public function find($id)
    {
        return $this->db->get_where($this->_table, ["id_modul" => $id,"is_active" => 1])->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_modul" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_modul" => $id]);
    }
}
