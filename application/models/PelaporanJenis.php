<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class PelaporanJenis extends CI_Model
{
    private $_table = "mst_activity_jenis";

    public $id_activity_jenis;

    public function get()
    {
        // $this->db->where('is_active',1);
        // $this->db->order_by('id_activity_jenis','DESC');
        // return $this->db->get($this->_table)->result();

        $this->db->select('A.*,user1.nama_pegawai,DATE_FORMAT(A.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('mst_activity_jenis as A');
		$this->db->join('mst_user AS user1','A.updated_by = user1.id_user','left');
        $this->db->where('A.is_active',1);
		$this->db->order_by('id_activity_jenis', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }
    
    public function getExport()
    {
		$this->db->select('A.*,user1.nama_pegawai,DATE_FORMAT(A.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('mst_activity_jenis as A');
		$this->db->join('mst_user AS user1','A.updated_by = user1.id_user','left');
        $this->db->where('A.is_active',1);
		$this->db->order_by('id_activity_jenis', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }

    public function find($id)
    {
        $this->db->where('is_active',1);
        return $this->db->get_where($this->_table, ["id_activity_jenis" => $id])->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_activity_jenis" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_activity_jenis" => $id]);
        // return $this->db->delete($this->_table, ["id_activity_sosial" => $id]);
    }
}
