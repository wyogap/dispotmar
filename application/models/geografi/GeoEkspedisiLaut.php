<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoEkspedisiLaut extends CI_Model
{
    private $_table = "geo_ekspedisi_laut";

    public $id_ekspedisi_laut;

    public function get()
    {
		$sql = "SELECT DISTINCT
					ekspedisi.*,
					satker.nama_satker,
					geografi.*,
					jenis_muatan.nama AS jenis_muatan
				FROM
					geo_ekspedisi_laut AS ekspedisi
					JOIN org_satker AS satker
					ON ekspedisi.id_satker = satker.id_satker
					JOIN mst_jenis_muatan AS jenis_muatan
					ON ekspedisi.id_jenis_muatan = jenis_muatan.id_jenis_muatan
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
					ekspedisi.id_geografi = geografi.id_provinsi OR
					ekspedisi.id_geografi = geografi.id_kabupaten OR
					ekspedisi.id_geografi = geografi.id_kecamatan OR
					ekspedisi.id_geografi = geografi.id_kelurahan
				WHERE
					ekspedisi.is_active = 1 
				GROUP BY
					ekspedisi.id_ekspedisi_laut
				ORDER BY
					ekspedisi.id_ekspedisi_laut DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('ekspedisi.*,
		satker.nama_satker,
		geografi.*,
		jenis_muatan.nama AS jenis_muatan');
		$this->db->from('geo_ekspedisi_laut AS ekspedisi');
		$this->db->join('org_satker AS satker','ekspedisi.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_muatan AS jenis_muatan','ekspedisi.id_jenis_muatan = jenis_muatan.id_jenis_muatan');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','ekspedisi.id_geografi = geografi.id_provinsi OR
			ekspedisi.id_geografi = geografi.id_kabupaten OR
			ekspedisi.id_geografi = geografi.id_kecamatan OR
			ekspedisi.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('ekspedisi.id_satker', $request['satker']);
			}
		}
		$this->db->where('ekspedisi.is_active',1);
		$this->db->group_by('ekspedisi.id_ekspedisi_laut');
		$this->db->order_by('ekspedisi.id_ekspedisi_laut','DESC');
			
		return $this->db->get()->result();
	}
	
	public function LISTgetdataForDatatable($request = null)
    {
		$this->db->select('ekspedisi.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_muatan.nama AS jenis_muatan,
		user1.nama_pegawai,
		DATE_FORMAT(ekspedisi.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_ekspedisi_laut AS ekspedisi');
		$this->db->join('org_satker AS satker','ekspedisi.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_muatan AS jenis_muatan','ekspedisi.id_jenis_muatan = jenis_muatan.id_jenis_muatan');
		$this->db->join('org_geografi AS geografi','ekspedisi.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','ekspedisi.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('ekspedisi.id_satker', $request['satker']);
			}
		}
		$this->db->where('ekspedisi.is_active',1);
		$this->db->group_by('ekspedisi.id_ekspedisi_laut');
		$this->db->order_by('ekspedisi.id_ekspedisi_laut','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('ekspedisi.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_muatan.nama AS jenis_muatan,
		user1.nama_pegawai,
		DATE_FORMAT(ekspedisi.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_ekspedisi_laut AS ekspedisi');
		$this->db->join('org_satker AS satker','ekspedisi.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_muatan AS jenis_muatan','ekspedisi.id_jenis_muatan = jenis_muatan.id_jenis_muatan');
		$this->db->join('org_geografi AS geografi','ekspedisi.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','ekspedisi.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('ekspedisi.id_satker', $id);
		}
		$this->db->where('ekspedisi.is_active',1);
		$this->db->group_by('ekspedisi.id_ekspedisi_laut');
		$this->db->order_by('ekspedisi.id_ekspedisi_laut','DESC');
			
		return $this->db->get()->result();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					ekspedisi.*,
					satker.nama_satker,
					geografi.*,
					jenis_muatan.nama AS jenis_muatan
				FROM
					geo_ekspedisi_laut AS ekspedisi
					JOIN org_satker AS satker
					ON ekspedisi.id_satker = satker.id_satker
					JOIN mst_jenis_muatan AS jenis_muatan
					ON ekspedisi.id_jenis_muatan = jenis_muatan.id_jenis_muatan
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
					ekspedisi.id_geografi = geografi.id_provinsi OR
					ekspedisi.id_geografi = geografi.id_kabupaten OR
					ekspedisi.id_geografi = geografi.id_kecamatan OR
					ekspedisi.id_geografi = geografi.id_kelurahan
				WHERE
					ekspedisi.is_active = 1 AND
					ekspedisi.id_satker = $id
				GROUP BY
					ekspedisi.id_ekspedisi_laut
				ORDER BY
					ekspedisi.id_ekspedisi_laut DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					ekspedisi.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_muatan.nama AS jenis_muatan
				FROM
					geo_ekspedisi_laut AS ekspedisi
					JOIN org_satker AS satker
					ON ekspedisi.id_satker = satker.id_satker
					JOIN mst_jenis_muatan AS jenis_muatan
					ON ekspedisi.id_jenis_muatan = jenis_muatan.id_jenis_muatan
					LEFT JOIN org_geografi AS geografi ON ekspedisi.id_geografi = geografi.id_geografi
				WHERE
					ekspedisi.is_active = 1 AND
					ekspedisi.id_satker = $id
				GROUP BY
					ekspedisi.id_ekspedisi_laut
				ORDER BY
					ekspedisi.id_ekspedisi_laut DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					ekspedisi.*,
					satker.nama_satker,
					geografi.*,
					jenis_muatan.nama AS jenis_muatan
				FROM
					geo_ekspedisi_laut AS ekspedisi
					JOIN org_satker AS satker
					ON ekspedisi.id_satker = satker.id_satker
					JOIN mst_jenis_muatan AS jenis_muatan
					ON ekspedisi.id_jenis_muatan = jenis_muatan.id_jenis_muatan
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
					ekspedisi.id_geografi = geografi.id_provinsi OR
					ekspedisi.id_geografi = geografi.id_kabupaten OR
					ekspedisi.id_geografi = geografi.id_kecamatan OR
					ekspedisi.id_geografi = geografi.id_kelurahan
				WHERE
					ekspedisi.is_active = 1 AND
					ekspedisi.id_ekspedisi_laut = $id
				GROUP BY
					ekspedisi.id_ekspedisi_laut
				ORDER BY
					ekspedisi.id_ekspedisi_laut DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
	}
	
    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_ekspedisi_laut" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_ekspedisi_laut" => $id]);
    }
}
