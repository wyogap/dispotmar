<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Level extends CI_Model
{
    private $_table = "org_level";

    public $id_level;

    public function get()
    {
		$this->db->select('A.id_level,A.jenis_organisasi,A.id_level_parent,A.level,A.is_active,A.created_by,A.created_date,A.updated_by,A.updated_date,B.jenis_organisasi AS parent_organisasi,user1.nama_pegawai,DATE_FORMAT(A.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('org_level as A');
        $this->db->join('org_level as B','A.id_level_parent = B.id_level','LEFT');
		$this->db->join('mst_user AS user1','A.updated_by = user1.id_user','left');
        $this->db->where('A.is_active',1);
		$this->db->order_by('id_level', 'DESC');
		$query = $this->db->get();

		return $query->result();
        // return $this->db->get($this->_table)->result();
    }

    public function getLevel($id)
    {
        return $this->db->get_where($this->_table, ["level" => $id,"is_active" => 1])->result();
    }

    public function checkLevel($id)
    {
        return $this->db->get_where($this->_table, ["id_level_parent" => $id])->result();
    }
    
    public function find($id)
    {
        return $this->db->get_where($this->_table, ["id_level" => $id,"is_active" => 1])->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_level" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_level" => $id]);
        // return $this->db->delete($this->_table, ["id_level" => $id]);
    }
}
