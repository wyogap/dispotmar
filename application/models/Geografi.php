<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Geografi extends CI_Model
{
    private $_table = "org_geografi";

    public $id_geografi;

    public function get()
    {
		// $this->db->from($this->_table);
		// $this->db->join('org_level', 'org_level.id_level = org_satker.id_level');
		// $query = $this->db->get();

		// return $query->result();
    }
    
    public function find($id)
    {
        return $this->db->get_where($this->_table, ["id_geografi" => $id])->row();
    }

    public function getLevel($level)
    {
        $this->db->where('level_geografi',$level);
        $this->db->where('is_active',1);
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->_table)->result();
    }

    public function findLevel($id, $level)
    {
        $this->db->where('id_geografi_parent',$id);
        $this->db->where('level_geografi',$level);
        $this->db->where('is_active',1);
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->_table)->result();
    }

    public function findProvinsi($id, $level)
    {
        //$this->db->where('id_geografi',$id);
        $this->db->where('level_geografi',$level);
        $this->db->where('is_active',1);
        $this->db->where('id_geografi_parent',null);
        $this->db->where('code_geografi_parent',null);
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->_table)->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_geografi" => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, ["id_geografi" => $id]);
    }
}
