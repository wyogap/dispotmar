<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class daftarvaksin extends CI_Model
{
    private $_table = "tbldaftarvaksin";

    public $iddaftar;

	public function getdataForDatatable()
    {
		$this->db->select('daftarvaksin.*,
		geografi1.nama as geo_provinsidomisili,
		geografi2.nama as geo_kabkotadomisili,
		geografi3.nama as geo_kecdomisili,
		geografi4.nama as geo_kelurahandomisili,
		user.nama_pegawai');
		$this->db->from('tbldaftarvaksin AS daftarvaksin');
		$this->db->join('org_geografi AS geografi1','daftarvaksin.provinsidomisili = geografi1.id_geografi');
		$this->db->join('org_geografi AS geografi2','daftarvaksin.kabkotadomisili = geografi2.id_geografi');
		$this->db->join('org_geografi AS geografi3','daftarvaksin.kecdomisili = geografi3.id_geografi');
		$this->db->join('org_geografi AS geografi4','daftarvaksin.kelurahandomisili = geografi4.id_geografi');
		$this->db->join('mst_user AS user','daftarvaksin.updated_by = user.id_user','left');
		$this->db->where('daftarvaksin.is_active',1);
		$this->db->order_by('daftarvaksin.iddaftar','DESC');
			
		return $this->db->get()->result();
	}

	public function find($id)
    {
		$sql = "SELECT DISTINCT
		daftarvaksin.*,
		prov.id_geografi AS id_provinsi,
		kab.id_geografi AS id_kabupaten,
		kec.id_geografi AS id_kecamatan,
		kel.id_geografi AS id_kelurahan,
		prov.nama AS PROVINSI, 
		kab.nama AS KABUPATEN, 
		kec.nama AS KECAMATAN, 
		kel.nama AS KELURAHAN
	FROM
		tbldaftarvaksin AS daftarvaksin
        left join org_geografi as prov on daftarvaksin.provinsidomisili = prov.id_geografi
        left join org_geografi as kab on daftarvaksin.kabkotadomisili = kab.id_geografi
        left join org_geografi as kec on daftarvaksin.kecdomisili = kec.id_geografi
        left join org_geografi as kel on daftarvaksin.kelurahandomisili = kel.id_geografi
		
	WHERE
		daftarvaksin.is_active = 1 AND
		daftarvaksin.iddaftar = $id";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

	public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["iddaftar" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["iddaftar" => $id]);
    }
}
