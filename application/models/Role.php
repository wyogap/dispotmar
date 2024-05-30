<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Role extends CI_Model
{
    private $_table = "mst_role";

    public $id_role;

    public function get()
    {
        // $this->db->where('is_active',1);
		// $this->db->order_by('id_role', 'DESC');
        // return $this->db->get($this->_table)->result();

        $this->db->select('A.*, user1.nama_pegawai, DATE_FORMAT(A.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('mst_role as A');
		$this->db->join('mst_user AS user1','A.updated_by = user1.id_user','left');
        $this->db->where('A.is_active',1);
		$this->db->order_by('id_role', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }

    public function getJson($keyword = null)
    {
        $this->db->where('is_active',1);
		$data = $this->db->get($this->_table)->like('nama_role',$keyword)->get();

		$roles = [];
		foreach($data as $role){
			$roles[] = array("id" => $role['id_role'], "text" => $role['nama_role']);
		}
		return $roles;
    }
    
    public function find($id)
    {
        return $this->db->get_where($this->_table, ["id_role" => $id,"is_active" => 1])->row();
    }

    public function roleCheck($id)
    {
		$this->db->where('id_role', $id);
		return $this->db->get('mst_user')->result();
	}
	
    public function create($data)
    {		
		return $this->db->insert($this->_table, $data);

		// $this->db->limit(1);
		// $this->db->order_by('id_role','DESC');
		// $query = $this->db->get($this->_table);

		// return $query->row();
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, array("id_role" => $id));
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_role" => $id]);
        // return $this->db->delete($this->_table, array("id_role" => $id));
    }
}
