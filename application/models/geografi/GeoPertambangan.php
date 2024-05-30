<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoPertambangan extends CI_Model
{
    private $_table = "geo_pertambangan";

    public $id_pertambangan;

    public function get()
    {
		$sql = "SELECT DISTINCT
					pertambangan.*,
					satker.nama_satker,
					geografi.*,
					jenis_bahantambang.nama AS jenis_bahantambang
				FROM
					geo_pertambangan AS pertambangan
					JOIN org_satker AS satker
					ON pertambangan.id_satker = satker.id_satker
					JOIN mst_jenis_bahantambang AS jenis_bahantambang
					ON pertambangan.id_jenis_bahantambang = jenis_bahantambang.id_jenis_bahantambang
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
					pertambangan.id_geografi = geografi.id_provinsi OR
					pertambangan.id_geografi = geografi.id_kabupaten OR
					pertambangan.id_geografi = geografi.id_kecamatan OR
					pertambangan.id_geografi = geografi.id_kelurahan
				WHERE
					pertambangan.is_active = 1 
				GROUP BY
					pertambangan.id_pertambangan
				ORDER BY
					pertambangan.id_pertambangan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('pertambangan.*,
		satker.nama_satker,
		geografi.*,
		jenis_bahantambang.nama AS jenis_bahantambang');
		$this->db->from('geo_pertambangan AS pertambangan');
		$this->db->join('org_satker AS satker','pertambangan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_bahantambang AS jenis_bahantambang','pertambangan.id_jenis_bahantambang = jenis_bahantambang.id_jenis_bahantambang');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','pertambangan.id_geografi = geografi.id_provinsi OR
			pertambangan.id_geografi = geografi.id_kabupaten OR
			pertambangan.id_geografi = geografi.id_kecamatan OR
			pertambangan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pertambangan.id_satker', $request['satker']);
			}
		}
		$this->db->where('pertambangan.is_active',1);
		$this->db->group_by('pertambangan.id_pertambangan');
		$this->db->order_by('pertambangan.id_pertambangan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('pertambangan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_bahantambang.nama AS jenis_bahantambang,
		user1.nama_pegawai,
		DATE_FORMAT(pertambangan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pertambangan AS pertambangan');
		$this->db->join('org_satker AS satker','pertambangan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_bahantambang AS jenis_bahantambang','pertambangan.id_jenis_bahantambang = jenis_bahantambang.id_jenis_bahantambang');
		$this->db->join('org_geografi AS geografi','pertambangan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pertambangan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pertambangan.id_satker', $request['satker']);
			}
		}
		$this->db->where('pertambangan.is_active',1);
		$this->db->group_by('pertambangan.id_pertambangan');
		$this->db->order_by('pertambangan.id_pertambangan','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('pertambangan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_bahantambang.nama AS jenis_bahantambang,
		user1.nama_pegawai,
		DATE_FORMAT(pertambangan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pertambangan AS pertambangan');
		$this->db->join('org_satker AS satker','pertambangan.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_bahantambang AS jenis_bahantambang','pertambangan.id_jenis_bahantambang = jenis_bahantambang.id_jenis_bahantambang');
		$this->db->join('org_geografi AS geografi','pertambangan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pertambangan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('pertambangan.id_satker', $id);
		}
		$this->db->where('pertambangan.is_active',1);
		$this->db->group_by('pertambangan.id_pertambangan');
		$this->db->order_by('pertambangan.id_pertambangan','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					pertambangan.*,
					satker.nama_satker,
					geografi.*,
					jenis_bahantambang.nama AS jenis_bahantambang
				FROM
					geo_pertambangan AS pertambangan
					JOIN org_satker AS satker
					ON pertambangan.id_satker = satker.id_satker
					JOIN mst_jenis_bahantambang AS jenis_bahantambang
					ON pertambangan.id_jenis_bahantambang = jenis_bahantambang.id_jenis_bahantambang
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
					pertambangan.id_geografi = geografi.id_provinsi OR
					pertambangan.id_geografi = geografi.id_kabupaten OR
					pertambangan.id_geografi = geografi.id_kecamatan OR
					pertambangan.id_geografi = geografi.id_kelurahan
				WHERE
					pertambangan.is_active = 1 AND
					pertambangan.id_pertambangan = $id
				GROUP BY
					pertambangan.id_pertambangan
				ORDER BY
					pertambangan.id_pertambangan DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					pertambangan.*,
					satker.nama_satker,
					geografi.*,
					jenis_bahantambang.nama AS jenis_bahantambang
				FROM
					geo_pertambangan AS pertambangan
					JOIN org_satker AS satker
					ON pertambangan.id_satker = satker.id_satker
					JOIN mst_jenis_bahantambang AS jenis_bahantambang
					ON pertambangan.id_jenis_bahantambang = jenis_bahantambang.id_jenis_bahantambang
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
					pertambangan.id_geografi = geografi.id_provinsi OR
					pertambangan.id_geografi = geografi.id_kabupaten OR
					pertambangan.id_geografi = geografi.id_kecamatan OR
					pertambangan.id_geografi = geografi.id_kelurahan
				WHERE
					pertambangan.is_active = 1 AND
					pertambangan.id_satker = $id
				GROUP BY
					pertambangan.id_pertambangan
				ORDER BY
					pertambangan.id_pertambangan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					pertambangan.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_bahantambang.nama AS jenis_bahantambang
				FROM
					geo_pertambangan AS pertambangan
					JOIN org_satker AS satker
					ON pertambangan.id_satker = satker.id_satker
					JOIN mst_jenis_bahantambang AS jenis_bahantambang
					ON pertambangan.id_jenis_bahantambang = jenis_bahantambang.id_jenis_bahantambang
					LEFT JOIN org_geografi AS geografi ON pertambangan.id_geografi = geografi.id_geografi
				WHERE
					pertambangan.is_active = 1 AND
					pertambangan.id_satker = $id
				GROUP BY
					pertambangan.id_pertambangan
				ORDER BY
					pertambangan.id_pertambangan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_pertambangan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_pertambangan" => $id]);
    }
}
