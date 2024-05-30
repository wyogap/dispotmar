<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoGunung extends CI_Model
{
    private $_table = "geo_gunung";

    public $id_gunung;

    public function get()
    {
		$sql = "SELECT DISTINCT
					gunung.*,
					satker.nama_satker,
					geografi.*,
					status_gunung.nama AS status_gunung
				FROM
					geo_gunung AS gunung
					JOIN org_satker AS satker
					ON gunung.id_satker = satker.id_satker
					JOIN mst_status_gunung AS status_gunung
					ON gunung.id_status_gunung = status_gunung.id_status_gunung
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
					gunung.id_geografi = geografi.id_provinsi OR
					gunung.id_geografi = geografi.id_kabupaten OR
					gunung.id_geografi = geografi.id_kecamatan OR
					gunung.id_geografi = geografi.id_kelurahan
				WHERE
					gunung.is_active = 1 
				GROUP BY
					gunung.id_gunung
				ORDER BY
					gunung.id_gunung DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('gunung.*,
		satker.nama_satker,
		geografi.*,
		status_gunung.nama AS status_gunung');
		$this->db->from('geo_gunung AS gunung');
		$this->db->join('org_satker AS satker','gunung.id_satker = satker.id_satker');
		$this->db->join('mst_status_gunung AS status_gunung','gunung.id_status_gunung = status_gunung.id_status_gunung');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','gunung.id_geografi = geografi.id_provinsi OR
			gunung.id_geografi = geografi.id_kabupaten OR
			gunung.id_geografi = geografi.id_kecamatan OR
			gunung.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('gunung.id_satker', $request['satker']);
			}
		}
		$this->db->where('gunung.is_active',1);
		$this->db->group_by('gunung.id_gunung');
		$this->db->order_by('gunung.id_gunung','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('gunung.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		status_gunung.nama AS status_gunung,
		user1.nama_pegawai,
		DATE_FORMAT(gunung.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_gunung AS gunung');
		$this->db->join('org_satker AS satker','gunung.id_satker = satker.id_satker');
		$this->db->join('mst_status_gunung AS status_gunung','gunung.id_status_gunung = status_gunung.id_status_gunung');
		$this->db->join('org_geografi AS geografi','gunung.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','gunung.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('gunung.id_satker', $request['satker']);
			}
		}
		$this->db->where('gunung.is_active',1);
		$this->db->group_by('gunung.id_gunung');
		$this->db->order_by('gunung.id_gunung','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('gunung.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		status_gunung.nama AS status_gunung,
		user1.nama_pegawai,
		DATE_FORMAT(gunung.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_gunung AS gunung');
		$this->db->join('org_satker AS satker','gunung.id_satker = satker.id_satker');
		$this->db->join('mst_status_gunung AS status_gunung','gunung.id_status_gunung = status_gunung.id_status_gunung');
		$this->db->join('org_geografi AS geografi','gunung.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','gunung.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('gunung.id_satker', $id);
		}
		$this->db->where('gunung.is_active',1);
		$this->db->group_by('gunung.id_gunung');
		$this->db->order_by('gunung.id_gunung','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					gunung.*,
					satker.nama_satker,
					geografi.*,
					status_gunung.nama AS status_gunung
				FROM
					geo_gunung AS gunung
					JOIN org_satker AS satker
					ON gunung.id_satker = satker.id_satker
					JOIN mst_status_gunung AS status_gunung
					ON gunung.id_status_gunung = status_gunung.id_status_gunung
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
					gunung.id_geografi = geografi.id_provinsi OR
					gunung.id_geografi = geografi.id_kabupaten OR
					gunung.id_geografi = geografi.id_kecamatan OR
					gunung.id_geografi = geografi.id_kelurahan
				WHERE
					gunung.is_active = 1 AND
					gunung.id_gunung = $id
				GROUP BY
					gunung.id_gunung
				ORDER BY
					gunung.id_gunung DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					gunung.*,
					satker.nama_satker,
					geografi.*,
					status_gunung.nama AS status_gunung
				FROM
					geo_gunung AS gunung
					JOIN org_satker AS satker
					ON gunung.id_satker = satker.id_satker
					JOIN mst_status_gunung AS status_gunung
					ON gunung.id_status_gunung = status_gunung.id_status_gunung
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
					gunung.id_geografi = geografi.id_provinsi OR
					gunung.id_geografi = geografi.id_kabupaten OR
					gunung.id_geografi = geografi.id_kecamatan OR
					gunung.id_geografi = geografi.id_kelurahan
				WHERE
					gunung.is_active = 1 AND
					gunung.id_satker = $id
				GROUP BY
					gunung.id_gunung
				ORDER BY
					gunung.id_gunung DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					gunung.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					status_gunung.nama AS status_gunung
				FROM
					geo_gunung AS gunung
					JOIN org_satker AS satker
					ON gunung.id_satker = satker.id_satker
					JOIN mst_status_gunung AS status_gunung
					ON gunung.id_status_gunung = status_gunung.id_status_gunung
					LEFT JOIN org_geografi AS geografi ON gunung.id_geografi = geografi.id_geografi
				WHERE
					gunung.is_active = 1 AND
					gunung.id_satker = $id
				GROUP BY
					gunung.id_gunung
				ORDER BY
					gunung.id_gunung DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_gunung" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_gunung" => $id]);
    }
}
