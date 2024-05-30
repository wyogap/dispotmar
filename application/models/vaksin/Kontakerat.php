<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class kontakerat extends CI_Model
{
    private $_table = "tblkontakerat";

    public $idkontak;

	public function getdataForDatatable($id)
    {
		$this->db->select('kontak.*,
        user.nama_pegawai,
        kasus.nik as nikterpapar,
        kasus.namaktp as namaterpapar,
		geografi1.id_geografi AS id_provinsi,
		geografi2.id_geografi AS id_kabupaten,
		geografi3.id_geografi AS id_kecamatan,
		geografi1.nama AS PROVINSI, 
		geografi2.nama AS KABUPATEN, 
		geografi3.nama AS KECAMATAN');
		$this->db->from('tblkontakerat AS kontak');
		$this->db->join('org_geografi AS geografi1','kontak.provinsidomisili = geografi1.id_geografi');
		$this->db->join('org_geografi AS geografi2','kontak.kabkotadomisili = geografi2.id_geografi');
		$this->db->join('org_geografi AS geografi3','kontak.kecdomisili = geografi3.id_geografi');
		$this->db->join('mst_user AS user','kontak.updated_by = user.id_user','left');
		$this->db->join('tblkasuscovid AS kasus','kontak.idkasus = kasus.idkasus','left');
		$this->db->where('kontak.is_active',1);
		$this->db->where('kasus.is_active',1);
		$this->db->where('kontak.idkasus',$id);
		$this->db->order_by('kontak.idkontak','DESC');
			
		return $this->db->get()->result();
	}

	public function find($id)
    {
		$sql = "SELECT DISTINCT
		kontak.*,
		prov.id_geografi AS id_provinsi,
		kab.id_geografi AS id_kabupaten,
		kec.id_geografi AS id_kecamatan,
		prov.nama AS PROVINSI, 
		kab.nama AS KABUPATEN, 
		kec.nama AS KECAMATAN
		FROM
		tblkontakerat AS kontak
        left join org_geografi as prov on kontak.provinsidomisili = prov.id_geografi
        left join org_geografi as kab on kontak.kabkotadomisili = kab.id_geografi
        left join org_geografi as kec on kontak.kecdomisili = kec.id_geografi
		WHERE
		kontak.is_active = 1 and
		kontak.idkontak = $id";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

	public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["idkontak" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["idkontak" => $id]);
    }
}
