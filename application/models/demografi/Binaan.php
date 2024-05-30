<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Binaan extends CI_Model
{
    private $_table = "rekap_desabinaan";

    public $id;

    public function get()
    {
		$sql = "SELECT DISTINCT
					binaan.*,
					satker.nama_satker,
					geografi.*
				FROM
					rekap_desabinaan AS binaan
					JOIN org_satker AS satker
					ON binaan.id_satker = satker.id_satker
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
					binaan.id_geografi = geografi.id_provinsi OR
					binaan.id_geografi = geografi.id_kabupaten OR
					binaan.id_geografi = geografi.id_kecamatan OR
					binaan.id_geografi = geografi.id_kelurahan
				WHERE
					binaan.is_active = 1 
				GROUP BY
					binaan.id
				ORDER BY
					binaan.id DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('binaan.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('rekap_desabinaan AS binaan');
		$this->db->join('org_satker AS satker','binaan.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','binaan.id_geografi = geografi.id_provinsi OR
			binaan.id_geografi = geografi.id_kabupaten OR
			binaan.id_geografi = geografi.id_kecamatan OR
			binaan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('binaan.id_satker', $request['satker']);
			}
		}
		$this->db->where('binaan.is_active',1);
		$this->db->group_by('binaan.id');
		$this->db->order_by('binaan.id','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('binaan.*,
		satker.nama_satker,
		prov.nama as provinsi,
		kab.nama as kabupaten,
		kec.nama as kecamatan,
		kel.nama as kelurahan,
		user1.nama_pegawai,
		DATE_FORMAT(binaan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('rekap_desabinaan AS binaan');
		$this->db->join('org_satker AS satker','binaan.id_satker = satker.id_satker');
		$this->db->join('mst_user AS user1','binaan.updated_by = user1.id_user','left');
		$this->db->join('org_geografi AS prov','binaan.id_prov = prov.id_geografi', 'left');
		$this->db->join('org_geografi AS kab','binaan.id_kab = kab.id_geografi', 'left');
		$this->db->join('org_geografi AS kec','binaan.id_kec = kec.id_geografi', 'left');
		$this->db->join('org_geografi AS kel','binaan.id_kel = kel.id_geografi', 'left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('binaan.id_satker', $request['satker']);
			}
		}
		$this->db->where('binaan.is_active',1);
		$this->db->group_by('binaan.id');
		$this->db->order_by('binaan.id','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('binaan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(binaan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('rekap_desabinaan AS binaan');
		$this->db->join('org_satker AS satker','binaan.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','binaan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','binaan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('binaan.id_satker', $id);
		}
		$this->db->where('binaan.is_active',1);
		$this->db->group_by('binaan.id');
		$this->db->order_by('binaan.id','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					binaan.*,
					satker.nama_satker,
					geografi.*
				FROM
					rekap_desabinaan AS binaan
					JOIN org_satker AS satker
					ON binaan.id_satker = satker.id_satker
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
					binaan.id_geografi = geografi.id_provinsi OR
					binaan.id_geografi = geografi.id_kabupaten OR
					binaan.id_geografi = geografi.id_kecamatan OR
					binaan.id_geografi = geografi.id_kelurahan
				WHERE
					binaan.is_active = 1 AND
					binaan.id = $id
				GROUP BY
					binaan.id
				ORDER BY
					binaan.id DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					binaan.*,
					satker.nama_satker,
					geografi.*
				FROM
					rekap_desabinaan AS binaan
					JOIN org_satker AS satker
					ON binaan.id_satker = satker.id_satker
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
					binaan.id_geografi = geografi.id_provinsi OR
					binaan.id_geografi = geografi.id_kabupaten OR
					binaan.id_geografi = geografi.id_kecamatan OR
					binaan.id_geografi = geografi.id_kelurahan
				WHERE
					binaan.is_active = 1 AND
					binaan.id_satker = $id
				GROUP BY
					binaan.id
				ORDER BY
					binaan.id DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					binaan.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI
				FROM
					rekap_desabinaan AS binaan
					JOIN org_satker AS satker
					ON binaan.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi ON binaan.id_geografi = geografi.id_geografi
				WHERE
					binaan.is_active = 1 AND
					binaan.id_satker = $id
				GROUP BY
					binaan.id
				ORDER BY
					binaan.id DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id" => $id]);
    }
}
