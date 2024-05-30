<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoPelayaranRakyat extends CI_Model
{
    private $_table = "geo_pelayaran_rakyat";

    public $id_pelayaran_rakyat;

    public function get()
    {
		$sql = "SELECT DISTINCT
					pelayaran.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pelayaran_rakyat AS pelayaran
					JOIN org_satker AS satker
					ON pelayaran.id_satker = satker.id_satker
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
					pelayaran.id_geografi = geografi.id_provinsi OR
					pelayaran.id_geografi = geografi.id_kabupaten OR
					pelayaran.id_geografi = geografi.id_kecamatan OR
					pelayaran.id_geografi = geografi.id_kelurahan
				WHERE
					pelayaran.is_active = 1 
				GROUP BY
					pelayaran.id_pelayaran_rakyat
				ORDER BY
					pelayaran.id_pelayaran_rakyat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('pelayaran.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('geo_pelayaran_rakyat AS pelayaran');
		$this->db->join('org_satker AS satker','pelayaran.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','pelayaran.id_geografi = geografi.id_provinsi OR
			pelayaran.id_geografi = geografi.id_kabupaten OR
			pelayaran.id_geografi = geografi.id_kecamatan OR
			pelayaran.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pelayaran.id_satker', $request['satker']);
			}
		}
		$this->db->where('pelayaran.is_active',1);
		$this->db->group_by('pelayaran.id_pelayaran_rakyat');
		$this->db->order_by('pelayaran.id_pelayaran_rakyat','DESC');
			
		return $this->db->get()->result();
	}
	
	public function LISTgetdataForDatatable($request = null)
    {
		$this->db->select('pelayaran.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(pelayaran.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pelayaran_rakyat AS pelayaran');
		$this->db->join('org_satker AS satker','pelayaran.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','pelayaran.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pelayaran.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pelayaran.id_satker', $request['satker']);
			}
		}
		$this->db->where('pelayaran.is_active',1);
		$this->db->group_by('pelayaran.id_pelayaran_rakyat');
		$this->db->order_by('pelayaran.id_pelayaran_rakyat','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('pelayaran.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(pelayaran.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_pelayaran_rakyat AS pelayaran');
		$this->db->join('org_satker AS satker','pelayaran.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','pelayaran.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pelayaran.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('pelayaran.id_satker', $id);
		}
		$this->db->where('pelayaran.is_active',1);
		$this->db->group_by('pelayaran.id_pelayaran_rakyat');
		$this->db->order_by('pelayaran.id_pelayaran_rakyat','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					pelayaran.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pelayaran_rakyat AS pelayaran
					JOIN org_satker AS satker
					ON pelayaran.id_satker = satker.id_satker
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
					pelayaran.id_geografi = geografi.id_provinsi OR
					pelayaran.id_geografi = geografi.id_kabupaten OR
					pelayaran.id_geografi = geografi.id_kecamatan OR
					pelayaran.id_geografi = geografi.id_kelurahan
				WHERE
					pelayaran.is_active = 1 AND
					pelayaran.id_pelayaran_rakyat = $id
				GROUP BY
					pelayaran.id_pelayaran_rakyat
				ORDER BY
					pelayaran.id_pelayaran_rakyat DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
	}
	
    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					pelayaran.*,
					satker.nama_satker,
					geografi.*
				FROM
					geo_pelayaran_rakyat AS pelayaran
					JOIN org_satker AS satker
					ON pelayaran.id_satker = satker.id_satker
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
					pelayaran.id_geografi = geografi.id_provinsi OR
					pelayaran.id_geografi = geografi.id_kabupaten OR
					pelayaran.id_geografi = geografi.id_kecamatan OR
					pelayaran.id_geografi = geografi.id_kelurahan
				WHERE
					pelayaran.is_active = 1 AND
					pelayaran.id_satker = $id
				GROUP BY
					pelayaran.id_pelayaran_rakyat
				ORDER BY
					pelayaran.id_pelayaran_rakyat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					pelayaran.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI
				FROM
					geo_pelayaran_rakyat AS pelayaran
					JOIN org_satker AS satker
					ON pelayaran.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi ON pelayaran.id_geografi = geografi.id_geografi
				WHERE
					pelayaran.is_active = 1 AND
					pelayaran.id_satker = $id
				GROUP BY
					pelayaran.id_pelayaran_rakyat
				ORDER BY
					pelayaran.id_pelayaran_rakyat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_pelayaran_rakyat" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_pelayaran_rakyat" => $id]);
    }
}
