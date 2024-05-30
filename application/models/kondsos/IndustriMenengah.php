<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class IndustriMenengah extends CI_Model
{
    private $_table = "konsos_industri_menengah";

    public $id_industri_menengah;

    public function get()
    {
		$sql = "SELECT DISTINCT
					industri.*,
					satker.nama_satker,
					geografi.*
				FROM
					konsos_industri_menengah AS industri
					JOIN org_satker AS satker
					ON industri.id_satker = satker.id_satker
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
					industri.id_geografi = geografi.id_provinsi OR
					industri.id_geografi = geografi.id_kabupaten OR
					industri.id_geografi = geografi.id_kecamatan OR
					industri.id_geografi = geografi.id_kelurahan
				WHERE
					industri.is_active = 1 
				GROUP BY
					industri.id_industri_menengah
				ORDER BY
					industri.id_industri_menengah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('industri.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('konsos_industri_menengah AS industri');
		$this->db->join('org_satker AS satker','industri.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','industri.id_geografi = geografi.id_provinsi OR
			industri.id_geografi = geografi.id_kabupaten OR
			industri.id_geografi = geografi.id_kecamatan OR
			industri.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('industri.id_satker', $request['satker']);
			}
		}
		$this->db->where('industri.is_active',1);
		$this->db->group_by('industri.id_industri_menengah');
		$this->db->order_by('industri.id_industri_menengah','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('industri.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(industri.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_industri_menengah AS industri');
		$this->db->join('org_satker AS satker','industri.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','industri.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','industri.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('industri.id_satker', $request['satker']);
			}
		}
		$this->db->where('industri.is_active',1);
		$this->db->group_by('industri.id_industri_menengah');
		$this->db->order_by('industri.id_industri_menengah','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getExport($id)
    {
		$this->db->select('industri.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(industri.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_industri_menengah AS industri');
		$this->db->join('org_satker AS satker','industri.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','industri.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','industri.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('industri.id_satker', $id);
		}
		$this->db->where('industri.is_active',1);
		$this->db->group_by('industri.id_industri_menengah');
		$this->db->order_by('industri.id_industri_menengah','DESC');
			
		return $this->db->get()->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					industri.*,
					satker.nama_satker,
					geografi.*
				FROM
					konsos_industri_menengah AS industri
					JOIN org_satker AS satker
					ON industri.id_satker = satker.id_satker
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
					industri.id_geografi = geografi.id_provinsi OR
					industri.id_geografi = geografi.id_kabupaten OR
					industri.id_geografi = geografi.id_kecamatan OR
					industri.id_geografi = geografi.id_kelurahan
				WHERE
					industri.is_active = 1 AND
					industri.id_industri_menengah = $id
				GROUP BY
					industri.id_industri_menengah
				ORDER BY
					industri.id_industri_menengah DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					industri.*,
					satker.nama_satker,
					geografi.*
				FROM
					konsos_industri_menengah AS industri
					JOIN org_satker AS satker
					ON industri.id_satker = satker.id_satker
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
					industri.id_geografi = geografi.id_provinsi OR
					industri.id_geografi = geografi.id_kabupaten OR
					industri.id_geografi = geografi.id_kecamatan OR
					industri.id_geografi = geografi.id_kelurahan
				WHERE
					industri.is_active = 1 AND
					industri.id_satker = $id
				GROUP BY
					industri.id_industri_menengah
				ORDER BY
					industri.id_industri_menengah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					industri.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI
				FROM
					konsos_industri_menengah AS industri
					JOIN org_satker AS satker
					ON industri.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi ON industri.id_geografi = geografi.id_geografi
				WHERE
					industri.is_active = 1 AND
					industri.id_satker = $id
				GROUP BY
					industri.id_industri_menengah
				ORDER BY
					industri.id_industri_menengah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_industri_menengah" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_industri_menengah" => $id]);
    }
}
