<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoKerawanan extends CI_Model
{
    private $_table = "geo_kerawanan";

    public $id_kerawanan;

    public function get()
    {
		$sql = "SELECT DISTINCT
					kerawanan.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_kerawanan AS kerawanan
					JOIN org_satker AS satker
					ON kerawanan.id_satker = satker.id_satker
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
					kerawanan.id_geografi = geografi.id_provinsi OR
					kerawanan.id_geografi = geografi.id_kabupaten OR
					kerawanan.id_geografi = geografi.id_kecamatan OR
					kerawanan.id_geografi = geografi.id_kelurahan
				WHERE
					kerawanan.is_active = 1 
				GROUP BY
					kerawanan.id_kerawanan
				ORDER BY
					kerawanan.id_kerawanan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('kerawanan.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('geo_kerawanan AS kerawanan');
		$this->db->join('org_satker AS satker','kerawanan.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','kerawanan.id_geografi = geografi.id_provinsi OR
			kerawanan.id_geografi = geografi.id_kabupaten OR
			kerawanan.id_geografi = geografi.id_kecamatan OR
			kerawanan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('kerawanan.id_satker', $request['satker']);
			}
		}
		$this->db->where('kerawanan.is_active',1);
		$this->db->group_by('kerawanan.id_kerawanan');
		$this->db->order_by('kerawanan.id_kerawanan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('kerawanan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(kerawanan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_kerawanan AS kerawanan');
		$this->db->join('org_satker AS satker','kerawanan.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','kerawanan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','kerawanan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('kerawanan.id_satker', $request['satker']);
			}
		}
		$this->db->where('kerawanan.is_active',1);
		$this->db->group_by('kerawanan.id_kerawanan');
		$this->db->order_by('kerawanan.id_kerawanan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('kerawanan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(kerawanan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_kerawanan AS kerawanan');
		$this->db->join('org_satker AS satker','kerawanan.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','kerawanan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','kerawanan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('kerawanan.id_satker', $id);
		}
		$this->db->where('kerawanan.is_active',1);
		$this->db->group_by('kerawanan.id_kerawanan');
		$this->db->order_by('kerawanan.id_kerawanan','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					kerawanan.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_kerawanan AS kerawanan
					JOIN org_satker AS satker
					ON kerawanan.id_satker = satker.id_satker
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
					kerawanan.id_geografi = geografi.id_provinsi OR
					kerawanan.id_geografi = geografi.id_kabupaten OR
					kerawanan.id_geografi = geografi.id_kecamatan OR
					kerawanan.id_geografi = geografi.id_kelurahan
				WHERE
					kerawanan.is_active = 1 AND
					kerawanan.id_kerawanan = $id
				GROUP BY
					kerawanan.id_kerawanan
				ORDER BY
					kerawanan.id_kerawanan DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					kerawanan.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_kerawanan AS kerawanan
					JOIN org_satker AS satker
					ON kerawanan.id_satker = satker.id_satker
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
					kerawanan.id_geografi = geografi.id_provinsi OR
					kerawanan.id_geografi = geografi.id_kabupaten OR
					kerawanan.id_geografi = geografi.id_kecamatan OR
					kerawanan.id_geografi = geografi.id_kelurahan
				WHERE
					kerawanan.is_active = 1 AND
					kerawanan.id_satker = $id
				GROUP BY
					kerawanan.id_kerawanan
				ORDER BY
					kerawanan.id_kerawanan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					kerawanan.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI
				FROM
					geo_kerawanan AS kerawanan
					JOIN org_satker AS satker
					ON kerawanan.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi ON kerawanan.id_geografi = geografi.id_geografi
				WHERE
					kerawanan.is_active = 1 AND
					kerawanan.id_satker = $id
				GROUP BY
					kerawanan.id_kerawanan
				ORDER BY
					kerawanan.id_kerawanan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_kerawanan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_kerawanan" => $id]);
    }
}
