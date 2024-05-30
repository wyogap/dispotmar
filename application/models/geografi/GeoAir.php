<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoAir extends CI_Model
{
    private $_table = "geo_sumber_air";

    public $id_sumber_air;

    public function get()
    {
		$sql = "SELECT DISTINCT
					air.*,
					satker.nama_satker,
					geografi.*,
					jenis_sumberair.nama AS jenis_sumberair
				FROM
					geo_sumber_air AS air
					JOIN org_satker AS satker
					ON air.id_satker = satker.id_satker
					JOIN mst_jenis_sumberair AS jenis_sumberair
					ON air.id_jenis_sumberair = jenis_sumberair.id_jenis_sumberair
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
					air.id_geografi = geografi.id_provinsi OR
					air.id_geografi = geografi.id_kabupaten OR
					air.id_geografi = geografi.id_kecamatan OR
					air.id_geografi = geografi.id_kelurahan
				WHERE
					air.is_active = 1 
				GROUP BY
					air.id_sumber_air
				ORDER BY
					air.id_sumber_air DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('air.*,
		satker.nama_satker,
		geografi.*,
		jenis_sumberair.nama AS jenis_sumberair');
		$this->db->from('geo_sumber_air AS air');
		$this->db->join('org_satker AS satker','air.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_sumberair AS jenis_sumberair','air.id_jenis_sumberair = jenis_sumberair.id_jenis_sumberair');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','air.id_geografi = geografi.id_provinsi OR
			air.id_geografi = geografi.id_kabupaten OR
			air.id_geografi = geografi.id_kecamatan OR
			air.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('air.id_satker', $request['satker']);
			}
		}
		$this->db->where('air.is_active',1);
		$this->db->group_by('air.id_sumber_air');
		$this->db->order_by('air.id_sumber_air','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('air.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_sumberair.nama AS jenis_sumberair,
		user1.nama_pegawai,
		DATE_FORMAT(air.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_sumber_air AS air');
		$this->db->join('org_satker AS satker','air.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_sumberair AS jenis_sumberair','air.id_jenis_sumberair = jenis_sumberair.id_jenis_sumberair');
		$this->db->join('org_geografi AS geografi','air.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','air.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('air.id_satker', $request['satker']);
			}
		}
		$this->db->where('air.is_active',1);
		$this->db->group_by('air.id_sumber_air');
		$this->db->order_by('air.id_sumber_air','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('air.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_sumberair.nama AS jenis_sumberair,
		user1.nama_pegawai,
		DATE_FORMAT(air.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_sumber_air AS air');
		$this->db->join('org_satker AS satker','air.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_sumberair AS jenis_sumberair','air.id_jenis_sumberair = jenis_sumberair.id_jenis_sumberair');
		$this->db->join('org_geografi AS geografi','air.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','air.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('air.id_satker', $id);
		}
		$this->db->where('air.is_active',1);
		$this->db->group_by('air.id_sumber_air');
		$this->db->order_by('air.id_sumber_air','DESC');
			
		return $this->db->get()->result();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					air.*,
					satker.nama_satker,
					geografi.*,
					jenis_sumberair.nama AS jenis_sumberair
				FROM
					geo_sumber_air AS air
					JOIN org_satker AS satker
					ON air.id_satker = satker.id_satker
					JOIN mst_jenis_sumberair AS jenis_sumberair
					ON air.id_jenis_sumberair = jenis_sumberair.id_jenis_sumberair
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
					air.id_geografi = geografi.id_provinsi OR
					air.id_geografi = geografi.id_kabupaten OR
					air.id_geografi = geografi.id_kecamatan OR
					air.id_geografi = geografi.id_kelurahan
				WHERE
					air.is_active = 1 AND
					air.id_satker = $id
				GROUP BY
					air.id_sumber_air
				ORDER BY
					air.id_sumber_air DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					air.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_sumberair.nama AS jenis_sumberair
				FROM
					geo_sumber_air AS air
					JOIN org_satker AS satker
					ON air.id_satker = satker.id_satker
					JOIN mst_jenis_sumberair AS jenis_sumberair
					ON air.id_jenis_sumberair = jenis_sumberair.id_jenis_sumberair
					LEFT JOIN org_geografi AS geografi ON air.id_geografi = geografi.id_geografi
				WHERE
					air.is_active = 1 AND
					air.id_satker = $id
				GROUP BY
					air.id_sumber_air
				ORDER BY
					air.id_sumber_air DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					air.*,
					satker.nama_satker,
					geografi.*,
					jenis_sumberair.nama AS jenis_sumberair
				FROM
					geo_sumber_air AS air
					JOIN org_satker AS satker
					ON air.id_satker = satker.id_satker
					JOIN mst_jenis_sumberair AS jenis_sumberair
					ON air.id_jenis_sumberair = jenis_sumberair.id_jenis_sumberair
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
					air.id_geografi = geografi.id_provinsi OR
					air.id_geografi = geografi.id_kabupaten OR
					air.id_geografi = geografi.id_kecamatan OR
					air.id_geografi = geografi.id_kelurahan
				WHERE
					air.is_active = 1 AND
					air.id_sumber_air = $id
				GROUP BY
					air.id_sumber_air
				ORDER BY
					air.id_sumber_air DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_sumber_air" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_sumber_air" => $id]);
    }
}
