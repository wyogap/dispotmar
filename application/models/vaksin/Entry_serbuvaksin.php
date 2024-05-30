<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class entry_serbuvaksin extends CI_Model
{
    private $_table = "tblserbuvaksin";

    public $idvaksin;

	public function getdataForDatatable()
    {
		$this->db->select('vaksin.*,
		satker.nama_satker,
		satker2.nama_satker as namakotama,
		user.nama_pegawai');
		$this->db->from('tblserbuvaksin AS vaksin');
		$this->db->join('org_satker AS satker','vaksin.satkerpelaksana = satker.id_satker','left');
		$this->db->join('org_satker AS satker2','vaksin.kotama = satker2.id_satker','left');
		$this->db->join('mst_user AS user','vaksin.reportedby = user.id_user','left');
		$this->db->where('vaksin.is_active',1);
		$this->db->order_by('vaksin.idvaksin','DESC');
			
		return $this->db->get()->result();
	}

	public function find($id)
    {
		$sql = "SELECT DISTINCT
		vaksin.*,
        stkr.nama_satker,
        stkr2.nama_satker as namakotama,
        usr.nama_pegawai
		FROM
		tblserbuvaksin AS vaksin
        left join org_satker as stkr on vaksin.satkerpelaksana = stkr.id_satker
        left join org_satker as stkr2 on vaksin.kotama = stkr2.id_satker
        left join mst_user as usr on vaksin.reportedby = usr.id_user
		WHERE
		vaksin.is_active = 1 AND
		stkr2.is_active = 1 AND
		usr.is_active = 1 AND
		vaksin.idvaksin = $id";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

	public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["idvaksin" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["idvaksin" => $id]);
    }

	public function do_upload()
	{
			$config['upload_path']          = './uploads/covid19/serbuvaksin';
			$config['allowed_types']        = 'jpg|jpeg|png|pdf|xlsx|xls|doc|docx';
			$config['file_name']            = uniqid();
			$config['max_size']             = 3000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!empty($_FILES["lampirandok"]["name"])) {
				if ($this->upload->do_upload('lampirandok'))
				{
					return $this->upload->data('file_name');
				}
	
				return "null";
			} else {
				return $this->input->post('lampirandok');
			}
	}
}
