<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoPelabuhanIkan extends CI_Model
{
    private $_table = "geo_pelabuhan_perikanan";

    public $id_pelabuhan_perikanan;

    public function get()
    {
		$sql = "SELECT DISTINCT
					ikan.*,
					satker.nama_satker,
					geografi.*,
					kelas_pelabuhanikan.nama AS kelas_pelabuhanikan,
					wpp.nama AS wpp
				FROM
					geo_pelabuhan_perikanan AS ikan
					JOIN org_satker AS satker
					ON ikan.id_satker = satker.id_satker
					JOIN mst_kelas_pelabuhanikan AS kelas_pelabuhanikan
					ON ikan.id_kelas_pelabuhanikan = kelas_pelabuhanikan.id_kelas_pelabuhanikan
					JOIN mst_wpp AS wpp
					ON ikan.id_wpp = wpp.id_wpp
					LEFT JOIN (SELECT DISTINCT
								PROV.id_geografi AS id_provinsi,
								KAB.id_geografi AS id_kabupaten,
								KEC.id_geografi AS id_kecamatan,
								KEL.id_geografi AS id_kelurahan,
								PROV.nama AS PROVINSI, 
								KAB.nama AS KABUPATEN, 
								KEC.nama AS KECAMATAN, 
								KEL.nama AS KELURAHAN
							FROM
								org_geografi AS PROV
								INNER JOIN
								org_geografi AS KAB
								ON 
									KAB.id_geografi_parent = PROV.id_geografi
								INNER JOIN
								org_geografi AS KEC
								ON 
									KEC.id_geografi_parent = KAB.id_geografi
								INNER JOIN
								org_geografi AS KEL
								ON 
									KEL.id_geografi_parent = KEC.id_geografi) AS geografi
				ON
					ikan.id_geografi = geografi.id_provinsi OR
					ikan.id_geografi = geografi.id_kabupaten OR
					ikan.id_geografi = geografi.id_kecamatan OR
					ikan.id_geografi = geografi.id_kelurahan
				WHERE
					ikan.is_active = 1 
				GROUP BY
					ikan.id_pelabuhan_perikanan
				ORDER BY
					ikan.id_pelabuhan_perikanan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('ikan.*,
		satker.nama_satker,
		geografi.*,
		kelas_pelabuhanikan.nama AS kelas_pelabuhanikan,
		wpp.nama AS wpp');
		$this->db->from('geo_pelabuhan_perikanan AS ikan');
		$this->db->join('org_satker AS satker','ikan.id_satker = satker.id_satker');
		$this->db->join('mst_kelas_pelabuhanikan AS kelas_pelabuhanikan','ikan.id_kelas_pelabuhanikan = kelas_pelabuhanikan.id_kelas_pelabuhanikan');
		$this->db->join('mst_wpp AS wpp','ikan.id_wpp = wpp.id_wpp');
		$this->db->join('(SELECT DISTINCT
		PROV.id_geografi AS id_provinsi,
		KAB.id_geografi AS id_kabupaten,
		KEC.id_geografi AS id_kecamatan,
		KEL.id_geografi AS id_kelurahan,
		PROV.nama AS PROVINSI, 
		KAB.nama AS KABUPATEN, 
		KEC.nama AS KECAMATAN, 
		KEL.nama AS KELURAHAN
	FROM
		org_geografi AS PROV
		INNER JOIN
		org_geografi AS KAB
		ON 
			KAB.id_geografi_parent = PROV.id_geografi
		INNER JOIN
		org_geografi AS KEC
		ON 
			KEC.id_geografi_parent = KAB.id_geografi
		INNER JOIN
		org_geografi AS KEL
		ON 
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','ikan.id_geografi = geografi.id_provinsi OR
			ikan.id_geografi = geografi.id_kabupaten OR
			ikan.id_geografi = geografi.id_kecamatan OR
			ikan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('ikan.id_satker', $request['satker']);
			}
		}
		$this->db->where('ikan.is_active',1);
		$this->db->group_by('ikan.id_pelabuhan_perikanan');
		$this->db->order_by('ikan.id_pelabuhan_perikanan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('ikan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		kelas_pelabuhanikan.nama AS kelas_pelabuhanikan,
		wpp.nama AS wpp,
		user1.nama_pegawai,
		DATE_FORMAT(ikan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pelabuhan_perikanan AS ikan');
		$this->db->join('org_satker AS satker','ikan.id_satker = satker.id_satker');
		$this->db->join('mst_kelas_pelabuhanikan AS kelas_pelabuhanikan','ikan.id_kelas_pelabuhanikan = kelas_pelabuhanikan.id_kelas_pelabuhanikan');
		$this->db->join('mst_wpp AS wpp','ikan.id_wpp = wpp.id_wpp');
		$this->db->join('org_geografi AS geografi','ikan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','ikan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('ikan.id_satker', $request['satker']);
			}
		}
		$this->db->where('ikan.is_active',1);
		$this->db->group_by('ikan.id_pelabuhan_perikanan');
		$this->db->order_by('ikan.id_pelabuhan_perikanan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('ikan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		kelas_pelabuhanikan.nama AS kelas_pelabuhanikan,
		wpp.nama AS wpp,
		user1.nama_pegawai,
		DATE_FORMAT(ikan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pelabuhan_perikanan AS ikan');
		$this->db->join('org_satker AS satker','ikan.id_satker = satker.id_satker');
		$this->db->join('mst_kelas_pelabuhanikan AS kelas_pelabuhanikan','ikan.id_kelas_pelabuhanikan = kelas_pelabuhanikan.id_kelas_pelabuhanikan');
		$this->db->join('mst_wpp AS wpp','ikan.id_wpp = wpp.id_wpp');
		$this->db->join('org_geografi AS geografi','ikan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','ikan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('ikan.id_satker', $id);
		}
		$this->db->where('ikan.is_active',1);
		$this->db->group_by('ikan.id_pelabuhan_perikanan');
		$this->db->order_by('ikan.id_pelabuhan_perikanan','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					ikan.*,
					satker.nama_satker,
					geografi.*,
					kelas_pelabuhanikan.nama AS kelas_pelabuhanikan,
					wpp.nama AS wpp
				FROM
					geo_pelabuhan_perikanan AS ikan
					JOIN org_satker AS satker
					ON ikan.id_satker = satker.id_satker
					JOIN mst_kelas_pelabuhanikan AS kelas_pelabuhanikan
					ON ikan.id_kelas_pelabuhanikan = kelas_pelabuhanikan.id_kelas_pelabuhanikan
					JOIN mst_wpp AS wpp
					ON ikan.id_wpp = wpp.id_wpp
					LEFT JOIN (SELECT DISTINCT
								PROV.id_geografi AS id_provinsi,
								KAB.id_geografi AS id_kabupaten,
								KEC.id_geografi AS id_kecamatan,
								KEL.id_geografi AS id_kelurahan,
								PROV.nama AS PROVINSI, 
								KAB.nama AS KABUPATEN, 
								KEC.nama AS KECAMATAN, 
								KEL.nama AS KELURAHAN
							FROM
								org_geografi AS PROV
								INNER JOIN
								org_geografi AS KAB
								ON 
									KAB.id_geografi_parent = PROV.id_geografi
								INNER JOIN
								org_geografi AS KEC
								ON 
									KEC.id_geografi_parent = KAB.id_geografi
								INNER JOIN
								org_geografi AS KEL
								ON 
									KEL.id_geografi_parent = KEC.id_geografi) AS geografi
				ON
					ikan.id_geografi = geografi.id_provinsi OR
					ikan.id_geografi = geografi.id_kabupaten OR
					ikan.id_geografi = geografi.id_kecamatan OR
					ikan.id_geografi = geografi.id_kelurahan
				WHERE
					ikan.is_active = 1 AND
					ikan.id_pelabuhan_perikanan = $id
				GROUP BY
					ikan.id_pelabuhan_perikanan
				ORDER BY
					ikan.id_pelabuhan_perikanan DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					ikan.*,
					satker.nama_satker,
					geografi.*,
					kelas_pelabuhanikan.nama AS kelas_pelabuhanikan,
					wpp.nama AS wpp
				FROM
					geo_pelabuhan_perikanan AS ikan
					JOIN org_satker AS satker
					ON ikan.id_satker = satker.id_satker
					JOIN mst_kelas_pelabuhanikan AS kelas_pelabuhanikan
					ON ikan.id_kelas_pelabuhanikan = kelas_pelabuhanikan.id_kelas_pelabuhanikan
					JOIN mst_wpp AS wpp
					ON ikan.id_wpp = wpp.id_wpp
					LEFT JOIN (SELECT DISTINCT
								PROV.id_geografi AS id_provinsi,
								KAB.id_geografi AS id_kabupaten,
								KEC.id_geografi AS id_kecamatan,
								KEL.id_geografi AS id_kelurahan,
								PROV.nama AS PROVINSI, 
								KAB.nama AS KABUPATEN, 
								KEC.nama AS KECAMATAN, 
								KEL.nama AS KELURAHAN
							FROM
								org_geografi AS PROV
								INNER JOIN
								org_geografi AS KAB
								ON 
									KAB.id_geografi_parent = PROV.id_geografi
								INNER JOIN
								org_geografi AS KEC
								ON 
									KEC.id_geografi_parent = KAB.id_geografi
								INNER JOIN
								org_geografi AS KEL
								ON 
									KEL.id_geografi_parent = KEC.id_geografi) AS geografi
				ON
					ikan.id_geografi = geografi.id_provinsi OR
					ikan.id_geografi = geografi.id_kabupaten OR
					ikan.id_geografi = geografi.id_kecamatan OR
					ikan.id_geografi = geografi.id_kelurahan
				WHERE
					ikan.is_active = 1 AND
					ikan.id_satker = $id
				GROUP BY
					ikan.id_pelabuhan_perikanan
				ORDER BY
					ikan.id_pelabuhan_perikanan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					ikan.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					kelas_pelabuhanikan.nama AS kelas_pelabuhanikan,
					wpp.nama AS wpp
				FROM
					geo_pelabuhan_perikanan AS ikan
					JOIN org_satker AS satker
					ON ikan.id_satker = satker.id_satker
					JOIN mst_kelas_pelabuhanikan AS kelas_pelabuhanikan
					ON ikan.id_kelas_pelabuhanikan = kelas_pelabuhanikan.id_kelas_pelabuhanikan
					JOIN mst_wpp AS wpp
					ON ikan.id_wpp = wpp.id_wpp
					LEFT JOIN org_geografi AS geografi ON ikan.id_geografi = geografi.id_geografi
				WHERE
					ikan.is_active = 1 AND
					ikan.id_satker = $id
				GROUP BY
					ikan.id_pelabuhan_perikanan
				ORDER BY
					ikan.id_pelabuhan_perikanan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_pelabuhan_perikanan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_pelabuhan_perikanan" => $id]);
    }
}
