<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoPelabuhanLaut extends CI_Model
{
    private $_table = "geo_pelabuhan_laut";

    public $id_pelabuhan_laut;

    public function get()
    {
		$sql = "SELECT DISTINCT
					laut.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pelabuhan_laut AS laut
					JOIN org_satker AS satker
					ON laut.id_satker = satker.id_satker
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
					laut.id_geografi = geografi.id_provinsi OR
					laut.id_geografi = geografi.id_kabupaten OR
					laut.id_geografi = geografi.id_kecamatan OR
					laut.id_geografi = geografi.id_kelurahan
				WHERE
					laut.is_active = 1 
				GROUP BY
					laut.id_pelabuhan_laut
				ORDER BY
					laut.id_pelabuhan_laut DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('laut.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('geo_pelabuhan_laut AS laut');
		$this->db->join('org_satker AS satker','laut.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','laut.id_geografi = geografi.id_provinsi OR
			laut.id_geografi = geografi.id_kabupaten OR
			laut.id_geografi = geografi.id_kecamatan OR
			laut.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('laut.id_satker', $request['satker']);
			}
		}
		$this->db->where('laut.is_active',1);
		$this->db->group_by('laut.id_pelabuhan_laut');
		$this->db->order_by('laut.id_pelabuhan_laut','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('laut.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(laut.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pelabuhan_laut AS laut');
		$this->db->join('org_satker AS satker','laut.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','laut.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','laut.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('laut.id_satker', $request['satker']);
			}
		}
		$this->db->where('laut.is_active',1);
		$this->db->group_by('laut.id_pelabuhan_laut');
		$this->db->order_by('laut.id_pelabuhan_laut','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('laut.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(laut.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pelabuhan_laut AS laut');
		$this->db->join('org_satker AS satker','laut.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','laut.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','laut.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('laut.id_satker', $id);
		}
		$this->db->where('laut.is_active',1);
		$this->db->group_by('laut.id_pelabuhan_laut');
		$this->db->order_by('laut.id_pelabuhan_laut','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					laut.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pelabuhan_laut AS laut
					JOIN org_satker AS satker
					ON laut.id_satker = satker.id_satker
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
					laut.id_geografi = geografi.id_provinsi OR
					laut.id_geografi = geografi.id_kabupaten OR
					laut.id_geografi = geografi.id_kecamatan OR
					laut.id_geografi = geografi.id_kelurahan
				WHERE
					laut.is_active = 1 AND
					laut.id_pelabuhan_laut = $id
				GROUP BY
					laut.id_pelabuhan_laut
				ORDER BY
					laut.id_pelabuhan_laut DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					laut.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pelabuhan_laut AS laut
					JOIN org_satker AS satker
					ON laut.id_satker = satker.id_satker
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
					laut.id_geografi = geografi.id_provinsi OR
					laut.id_geografi = geografi.id_kabupaten OR
					laut.id_geografi = geografi.id_kecamatan OR
					laut.id_geografi = geografi.id_kelurahan
				WHERE
					laut.is_active = 1 AND
					laut.id_satker = $id
				GROUP BY
					laut.id_pelabuhan_laut
				ORDER BY
					laut.id_pelabuhan_laut DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					laut.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI
				FROM
					geo_pelabuhan_laut AS laut
					JOIN org_satker AS satker
					ON laut.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi ON laut.id_geografi = geografi.id_geografi
				WHERE
					laut.is_active = 1 AND
					laut.id_satker = $id
				GROUP BY
					laut.id_pelabuhan_laut
				ORDER BY
					laut.id_pelabuhan_laut DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_pelabuhan_laut" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_pelabuhan_laut" => $id]);
    }
}
