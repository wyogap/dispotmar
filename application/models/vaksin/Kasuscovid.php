<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class kasuscovid extends CI_Model
{
    private $_table = "tblkasuscovid";

    public $idkasus;

	public function getdataForDatatable()
    {
		$this->db->select('kasuscovid.*,
		satker.nama_satker,
		satker2.nama_satker as namakotama,
		geografi1.nama as geo_provinsidomisili,
		geografi2.nama as geo_kabkotadomisili,
		geografi3.nama as geo_kecdomisili,
		geografi4.nama as geo_kelurahandomisili,
		user.nama_pegawai,
		count(kontakerat.idkontak) as TotalKontak');
		$this->db->from('tblkasuscovid AS kasuscovid');
		$this->db->join('org_satker AS satker','kasuscovid.satkerpelapor = satker.id_satker','left');
		$this->db->join('org_satker AS satker2','kasuscovid.kotama = satker2.id_satker','left');
		$this->db->join('org_geografi AS geografi1','kasuscovid.provinsidomisili = geografi1.id_geografi');
		$this->db->join('org_geografi AS geografi2','kasuscovid.kabkotadomisili = geografi2.id_geografi');
		$this->db->join('org_geografi AS geografi3','kasuscovid.kecdomisili = geografi3.id_geografi');
		$this->db->join('org_geografi AS geografi4','kasuscovid.kelurahandomisili = geografi4.id_geografi');
		$this->db->join('mst_user AS user','kasuscovid.reportedby = user.id_user','left');
		$this->db->join('tblkontakerat AS kontakerat','kasuscovid.idkasus = kontakerat.idkasus and kontakerat.is_active = 1','left');
		$this->db->where('kasuscovid.is_active',1);
		$this->db->where('user.is_active',1);
		$this->db->group_by('kasuscovid.idkasus');
		$this->db->order_by('kasuscovid.idkasus','DESC');
			
		return $this->db->get()->result();
	}

	public function find($id)
    {
		$sql = "SELECT DISTINCT
		kasuscovid.*,
        stkr.nama_satker,
        stkr2.nama_satker as namakotama,
        usr.nama_pegawai,
		prov.id_geografi AS id_provinsi,
		kab.id_geografi AS id_kabupaten,
		kec.id_geografi AS id_kecamatan,
		kel.id_geografi AS id_kelurahan,
		prov.nama AS PROVINSI, 
		kab.nama AS KABUPATEN, 
		kec.nama AS KECAMATAN, 
		kel.nama AS KELURAHAN
		FROM
		tblkasuscovid AS kasuscovid
        left join org_geografi as prov on kasuscovid.provinsidomisili = prov.id_geografi
        left join org_geografi as kab on kasuscovid.kabkotadomisili = kab.id_geografi
        left join org_geografi as kec on kasuscovid.kecdomisili = kec.id_geografi
        left join org_geografi as kel on kasuscovid.kelurahandomisili = kel.id_geografi
        left join org_satker as stkr on kasuscovid.satkerpelapor = stkr.id_satker
        left join org_satker as stkr2 on kasuscovid.kotama = stkr2.id_satker
        left join mst_user as usr on kasuscovid.reportedby = usr.id_user
		WHERE
		kasuscovid.is_active = 1 AND
		stkr2.is_active = 1 AND
		usr.is_active = 1 AND
		kasuscovid.idkasus = $id";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

	public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["idkasus" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["idkasus" => $id]);
    }
	
	public function roleCheck($id)
    {
		$this->db->where('idkasus', $id);
		$this->db->where('is_active', 1);
		return $this->db->get('tblkontakerat')->result();
	}
}
