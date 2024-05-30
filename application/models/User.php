<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User extends CI_Model
{
    private $_table = "mst_user";

    public $id_user;

    public function get()
    {
		$this->db->select('mst_user.*, org_satker.nama_satker, mst_role.nama_role, user1.nama_pegawai as nama_pegawai2, DATE_FORMAT(mst_user.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('mst_user as mst_user');
		$this->db->join('mst_role', 'mst_role.id_role = mst_user.id_role');
		$this->db->join('org_satker', 'org_satker.id_satker = mst_user.id_satker');
		$this->db->join('mst_user AS user1','mst_user.updated_by = user1.id_user','left');
        $this->db->where('mst_user.is_active',1);
		$this->db->order_by('id_user', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('mst_user.*, org_satker.nama_satker, mst_role.nama_role, user1.nama_pegawai as nama_pegawai2, DATE_FORMAT(mst_user.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('mst_user as mst_user');
		$this->db->join('mst_role', 'mst_role.id_role = mst_user.id_role');
		$this->db->join('org_satker', 'org_satker.id_satker = mst_user.id_satker');
		$this->db->join('mst_user AS user1','mst_user.updated_by = user1.id_user','left');
		$this->db->where('mst_user.is_active',1);
		
		if ($id != 0) {
			$this->db->where('mst_user.id_satker', $id);
		}

		$this->db->order_by('id_user', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }
    
    public function find($id)
    {
        return $this->db->get_where($this->_table, ["id_user" => $id,"is_active" => 1])->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_user" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE, 'email' => ''], ["id_user" => $id]);
        // return $this->db->delete($this->_table, ["id_user" => $id]);
    }

	public function do_upload()
	{
			$config['upload_path']          = './uploads/users/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['file_name']            = uniqid();
			//$config['max_size']             = 2000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!empty($_FILES["photo"]["name"])) {
				if ($this->upload->do_upload('photo'))
				{
					return $this->upload->data('file_name');
				}
	
				return "null.jpg";
			} else {
				return $this->input->post('photo');
			}
	}
}
