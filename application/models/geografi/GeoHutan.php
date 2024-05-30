<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoHutan extends CI_Model
{
    private $_table = "geo_hutan";

    public $id_hutan;

    public function get()
    {
		$sql = "SELECT DISTINCT
					hutan.*,
					satker.nama_satker,
					geografi.*,
					jenis_tanaman.nama AS jenis_tanaman,
					status_hutan.nama AS status_hutan
				FROM
					geo_hutan AS hutan
					JOIN org_satker AS satker
					ON hutan.id_satker = satker.id_satker
					JOIN mst_jenis_tanaman_hutan AS jenis_tanaman
					ON hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan
					JOIN mst_status_hutan AS status_hutan
					ON hutan.id_status_hutan = status_hutan.id_status_hutan
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
					hutan.id_geografi = geografi.id_provinsi OR
					hutan.id_geografi = geografi.id_kabupaten OR
					hutan.id_geografi = geografi.id_kecamatan OR
					hutan.id_geografi = geografi.id_kelurahan
				WHERE
					hutan.is_active = 1 
				GROUP BY
					hutan.id_hutan
				ORDER BY
					hutan.id_hutan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('hutan.*,
		satker.nama_satker,
		geografi.*,
		jenis_tanaman.nama AS jenis_tanaman,
		status_hutan.nama AS status_hutan');
		$this->db->from('geo_hutan AS hutan');
		$this->db->join('org_satker AS satker','hutan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_tanaman_hutan AS jenis_tanaman','hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan');
		$this->db->join('mst_status_hutan AS status_hutan','hutan.id_status_hutan = status_hutan.id_status_hutan');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','hutan.id_geografi = geografi.id_provinsi OR
			hutan.id_geografi = geografi.id_kabupaten OR
			hutan.id_geografi = geografi.id_kecamatan OR
			hutan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('hutan.id_satker', $request['satker']);
			}
		}
		$this->db->where('hutan.is_active',1);
		$this->db->group_by('hutan.id_hutan');
		$this->db->order_by('hutan.id_hutan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('hutan.*,
		satker.nama_satker,
		geografi.nama as wilayah, 
		geografi.*,
		jenis_tanaman.nama AS jenis_tanaman,
		status_hutan.nama AS status_hutan,
		user1.nama_pegawai,
		DATE_FORMAT(hutan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_hutan AS hutan');
		$this->db->join('org_satker AS satker','hutan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_tanaman_hutan AS jenis_tanaman','hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan');
		$this->db->join('mst_status_hutan AS status_hutan','hutan.id_status_hutan = status_hutan.id_status_hutan');
		$this->db->join('org_geografi AS geografi','hutan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','hutan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('hutan.id_satker', $request['satker']);
			}
		}
		$this->db->where('hutan.is_active',1);
		$this->db->group_by('hutan.id_hutan');
		$this->db->order_by('hutan.id_hutan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('hutan.*,
		satker.nama_satker,
		geografi.nama as wilayah, 
		geografi.*,
		jenis_tanaman.nama AS jenis_tanaman,
		status_hutan.nama AS status_hutan,
		user1.nama_pegawai,
		DATE_FORMAT(hutan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_hutan AS hutan');
		$this->db->join('org_satker AS satker','hutan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_tanaman_hutan AS jenis_tanaman','hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan');
		$this->db->join('mst_status_hutan AS status_hutan','hutan.id_status_hutan = status_hutan.id_status_hutan');
		$this->db->join('org_geografi AS geografi','hutan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','hutan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('hutan.id_satker', $id);
		}
		$this->db->where('hutan.is_active',1);
		$this->db->group_by('hutan.id_hutan');
		$this->db->order_by('hutan.id_hutan','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					hutan.*,
					satker.nama_satker,
					geografi.*,
					jenis_tanaman.nama AS jenis_tanaman,
					status_hutan.nama AS status_hutan
				FROM
					geo_hutan AS hutan
					JOIN org_satker AS satker
					ON hutan.id_satker = satker.id_satker
					JOIN mst_jenis_tanaman_hutan AS jenis_tanaman
					ON hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan
					JOIN mst_status_hutan AS status_hutan
					ON hutan.id_status_hutan = status_hutan.id_status_hutan
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
					hutan.id_geografi = geografi.id_provinsi OR
					hutan.id_geografi = geografi.id_kabupaten OR
					hutan.id_geografi = geografi.id_kecamatan OR
					hutan.id_geografi = geografi.id_kelurahan
				WHERE
					hutan.is_active = 1 AND
					hutan.id_hutan = $id
				GROUP BY
					hutan.id_hutan
				ORDER BY
					hutan.id_hutan DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					hutan.*,
					satker.nama_satker,
					geografi.*,
					jenis_tanaman.nama AS jenis_tanaman,
					status_hutan.nama AS status_hutan
				FROM
					geo_hutan AS hutan
					JOIN org_satker AS satker
					ON hutan.id_satker = satker.id_satker
					JOIN mst_jenis_tanaman_hutan AS jenis_tanaman
					ON hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan
					JOIN mst_status_hutan AS status_hutan
					ON hutan.id_status_hutan = status_hutan.id_status_hutan
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
					hutan.id_geografi = geografi.id_provinsi OR
					hutan.id_geografi = geografi.id_kabupaten OR
					hutan.id_geografi = geografi.id_kecamatan OR
					hutan.id_geografi = geografi.id_kelurahan
				WHERE
					hutan.is_active = 1  AND
					hutan.id_satker = $id
				GROUP BY
					hutan.id_hutan
				ORDER BY
					hutan.id_hutan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					hutan.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_tanaman.nama AS jenis_tanaman,
					status_hutan.nama AS status_hutan
				FROM
					geo_hutan AS hutan
					JOIN org_satker AS satker
					ON hutan.id_satker = satker.id_satker
					JOIN mst_jenis_tanaman_hutan AS jenis_tanaman
					ON hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan
					JOIN mst_status_hutan AS status_hutan
					ON hutan.id_status_hutan = status_hutan.id_status_hutan
					LEFT JOIN org_geografi AS geografi ON hutan.id_geografi = geografi.id_geografi
				WHERE
					hutan.is_active = 1  AND
					hutan.id_satker = $id
				GROUP BY
					hutan.id_hutan
				ORDER BY
					hutan.id_hutan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_hutan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_hutan" => $id]);
    }
}
