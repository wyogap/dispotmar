<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoPertanian extends CI_Model
{
    private $_table = "geo_pertanian";

    public $id_pertanian;

    public function get()
    {
		$sql = "SELECT DISTINCT
					pertanian.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama_komoditas
				FROM
					geo_pertanian AS pertanian
					JOIN org_satker AS satker
					ON pertanian.id_satker = satker.id_satker
					JOIN mst_pangan_komoditas AS komoditas
					ON pertanian.id_komoditas = komoditas.id_komoditas
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
					pertanian.id_geografi = geografi.id_provinsi OR
					pertanian.id_geografi = geografi.id_kabupaten OR
					pertanian.id_geografi = geografi.id_kecamatan OR
					pertanian.id_geografi = geografi.id_kelurahan
				WHERE
					pertanian.is_active = 1 
				GROUP BY
					pertanian.id_pertanian
				ORDER BY
					pertanian.id_pertanian DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('pertanian.*,
		satker.nama_satker,
		geografi.*,
		komoditas.nama_komoditas');
		$this->db->from('geo_pertanian AS pertanian');
		$this->db->join('org_satker AS satker','pertanian.id_satker = satker.id_satker');
		$this->db->join('mst_pangan_komoditas AS komoditas','pertanian.id_komoditas = komoditas.id_komoditas');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','pertanian.id_geografi = geografi.id_provinsi OR
			pertanian.id_geografi = geografi.id_kabupaten OR
			pertanian.id_geografi = geografi.id_kecamatan OR
			pertanian.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pertanian.id_satker', $request['satker']);
			}
		}
		$this->db->where('pertanian.is_active',1);
		$this->db->group_by('pertanian.id_pertanian');
		$this->db->order_by('pertanian.id_pertanian','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('pertanian.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		komoditas.nama as nama_komoditas,
		user1.nama_pegawai,
		DATE_FORMAT(pertanian.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pertanian AS pertanian');
		$this->db->join('org_satker AS satker','pertanian.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_tanaman AS komoditas','pertanian.id_komoditas = komoditas.id_jenis_tanaman');
		$this->db->join('org_geografi AS geografi','pertanian.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pertanian.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pertanian.id_satker', $request['satker']);
			}
		}
		$this->db->where('pertanian.is_active',1);
		$this->db->group_by('pertanian.id_pertanian');
		$this->db->order_by('pertanian.id_pertanian','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('pertanian.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		komoditas.nama as nama_komoditas,
		user1.nama_pegawai,
		DATE_FORMAT(pertanian.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pertanian AS pertanian');
		$this->db->join('org_satker AS satker','pertanian.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_tanaman AS komoditas','pertanian.id_komoditas = komoditas.id_jenis_tanaman');
		$this->db->join('org_geografi AS geografi','pertanian.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pertanian.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('pertanian.id_satker', $id);
		}
		$this->db->where('pertanian.is_active',1);
		$this->db->group_by('pertanian.id_pertanian');
		$this->db->order_by('pertanian.id_pertanian','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					pertanian.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama as nama_komoditas
				FROM
					geo_pertanian AS pertanian
					JOIN org_satker AS satker
					ON pertanian.id_satker = satker.id_satker
					JOIN mst_jenis_tanaman AS komoditas
					ON pertanian.id_komoditas = komoditas.id_jenis_tanaman
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
					pertanian.id_geografi = geografi.id_provinsi OR
					pertanian.id_geografi = geografi.id_kabupaten OR
					pertanian.id_geografi = geografi.id_kecamatan OR
					pertanian.id_geografi = geografi.id_kelurahan
				WHERE
					pertanian.is_active = 1 AND
					pertanian.id_pertanian = $id
				GROUP BY
					pertanian.id_pertanian
				ORDER BY
					pertanian.id_pertanian DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					pertanian.*,
					satker.nama_satker,
					geografi.*,
					komoditas.nama_komoditas
				FROM
					geo_pertanian AS pertanian
					JOIN org_satker AS satker
					ON pertanian.id_satker = satker.id_satker
					JOIN mst_pangan_komoditas AS komoditas
					ON pertanian.id_komoditas = komoditas.id_komoditas
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
					pertanian.id_geografi = geografi.id_provinsi OR
					pertanian.id_geografi = geografi.id_kabupaten OR
					pertanian.id_geografi = geografi.id_kecamatan OR
					pertanian.id_geografi = geografi.id_kelurahan
				WHERE
					pertanian.is_active = 1 AND
					pertanian.id_satker = $id
				GROUP BY
					pertanian.id_pertanian
				ORDER BY
					pertanian.id_pertanian DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					pertanian.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					komoditas.nama as nama_komoditas
				FROM
					geo_pertanian AS pertanian
					JOIN org_satker AS satker
					ON pertanian.id_satker = satker.id_satker
					JOIN mst_jenis_tanaman AS komoditas
					ON pertanian.id_komoditas = komoditas.id_jenis_tanaman
					LEFT JOIN org_geografi AS geografi ON pertanian.id_geografi = geografi.id_geografi
				WHERE
					pertanian.is_active = 1 AND
					pertanian.id_satker = $id
				GROUP BY
					pertanian.id_pertanian
				ORDER BY
					pertanian.id_pertanian DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_pertanian" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_pertanian" => $id]);
    }
}
