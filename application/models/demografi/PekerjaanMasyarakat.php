<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class PekerjaanMasyarakat extends CI_Model
{
    private $_table = "demo_pekerjaan_masyarakat";

    public $id_pekerjaan_masyarakat;

    public function get()
    {
		$sql = "SELECT DISTINCT
					pekerjaan.*,
					pekerjaan.mayoritas1 AS id_mayoritas1,
					pekerjaan.mayoritas2 AS id_mayoritas2,
					pekerjaan.mayoritas3 AS id_mayoritas3,
					satker.nama_satker,
					geografi.*,
					mayoritas1.nama AS mayoritas1,
					mayoritas2.nama AS mayoritas2,
					mayoritas3.nama AS mayoritas3
				FROM
					demo_pekerjaan_masyarakat AS pekerjaan
					JOIN org_satker AS satker
					ON pekerjaan.id_satker = satker.id_satker
					JOIN mst_mayoritas_pekerjaan AS mayoritas1
					ON pekerjaan.mayoritas1 = mayoritas1.id_mayoritas_pekerjaan
					JOIN mst_mayoritas_pekerjaan AS mayoritas2
					ON pekerjaan.mayoritas2 = mayoritas2.id_mayoritas_pekerjaan
					JOIN mst_mayoritas_pekerjaan AS mayoritas3
					ON pekerjaan.mayoritas3 = mayoritas3.id_mayoritas_pekerjaan
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
					pekerjaan.id_geografi = geografi.id_provinsi OR
					pekerjaan.id_geografi = geografi.id_kabupaten OR
					pekerjaan.id_geografi = geografi.id_kecamatan OR
					pekerjaan.id_geografi = geografi.id_kelurahan
				WHERE
					pekerjaan.is_active = 1 
				GROUP BY
					pekerjaan.id_pekerjaan_masyarakat
				ORDER BY
					pekerjaan.id_pekerjaan_masyarakat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }
    
    public function list($request = null)
    {
		$this->db->select('pekerjaan.*,
		pekerjaan.mayoritas1 AS id_mayoritas1,
		pekerjaan.mayoritas2 AS id_mayoritas2,
		pekerjaan.mayoritas3 AS id_mayoritas3,
		satker.nama_satker,
		geografi.*,
		mayoritas1.nama AS mayoritas1,
		mayoritas2.nama AS mayoritas2,
		mayoritas3.nama AS mayoritas3');
		$this->db->from('demo_pekerjaan_masyarakat AS pekerjaan');
		$this->db->join('org_satker AS satker','pekerjaan.id_satker = satker.id_satker');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas1','pekerjaan.mayoritas1 = mayoritas1.id_mayoritas_pekerjaan');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas2','pekerjaan.mayoritas2 = mayoritas2.id_mayoritas_pekerjaan');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas3','pekerjaan.mayoritas3 = mayoritas3.id_mayoritas_pekerjaan');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','pekerjaan.id_geografi = geografi.id_provinsi OR
			pekerjaan.id_geografi = geografi.id_kabupaten OR
			pekerjaan.id_geografi = geografi.id_kecamatan OR
			pekerjaan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pekerjaan.id_satker', $request['satker']);
			}
		}
		$this->db->where('pekerjaan.is_active',1);
		$this->db->group_by('pekerjaan.id_pekerjaan_masyarakat');
		$this->db->order_by('pekerjaan.id_pekerjaan_masyarakat','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('pekerjaan.*,
		pekerjaan.mayoritas1 AS id_mayoritas1,
		pekerjaan.mayoritas2 AS id_mayoritas2,
		pekerjaan.mayoritas3 AS id_mayoritas3,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		mayoritas1.nama AS mayoritas1,
		mayoritas2.nama AS mayoritas2,
		mayoritas3.nama AS mayoritas3,
		user1.nama_pegawai,
		DATE_FORMAT(pekerjaan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_pekerjaan_masyarakat AS pekerjaan');
		$this->db->join('org_satker AS satker','pekerjaan.id_satker = satker.id_satker');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas1','pekerjaan.mayoritas1 = mayoritas1.id_mayoritas_pekerjaan');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas2','pekerjaan.mayoritas2 = mayoritas2.id_mayoritas_pekerjaan');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas3','pekerjaan.mayoritas3 = mayoritas3.id_mayoritas_pekerjaan');
		$this->db->join('org_geografi AS geografi','pekerjaan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pekerjaan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pekerjaan.id_satker', $request['satker']);
			}
		}
		$this->db->where('pekerjaan.is_active',1);
		$this->db->group_by('pekerjaan.id_pekerjaan_masyarakat');
		$this->db->order_by('pekerjaan.id_pekerjaan_masyarakat','DESC');
			
		return $this->db->get()->result();
	}

	public function getExport($id)
    {
		$this->db->select('pekerjaan.*,
		pekerjaan.mayoritas1 AS id_mayoritas1,
		pekerjaan.mayoritas2 AS id_mayoritas2,
		pekerjaan.mayoritas3 AS id_mayoritas3,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		mayoritas1.nama AS mayoritas1,
		mayoritas2.nama AS mayoritas2,
		mayoritas3.nama AS mayoritas3,
		user1.nama_pegawai,
		DATE_FORMAT(pekerjaan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_pekerjaan_masyarakat AS pekerjaan');
		$this->db->join('org_satker AS satker','pekerjaan.id_satker = satker.id_satker');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas1','pekerjaan.mayoritas1 = mayoritas1.id_mayoritas_pekerjaan');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas2','pekerjaan.mayoritas2 = mayoritas2.id_mayoritas_pekerjaan');
		$this->db->join('mst_mayoritas_pekerjaan AS mayoritas3','pekerjaan.mayoritas3 = mayoritas3.id_mayoritas_pekerjaan');
		$this->db->join('org_geografi AS geografi','pekerjaan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pekerjaan.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('pekerjaan.id_satker', $id);
		}
		$this->db->where('pekerjaan.is_active',1);
		$this->db->group_by('pekerjaan.id_pekerjaan_masyarakat');
		$this->db->order_by('pekerjaan.id_pekerjaan_masyarakat','DESC');
			
		return $this->db->get()->result();
	}
	
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					pekerjaan.*,
					pekerjaan.mayoritas1 AS id_mayoritas1,
					pekerjaan.mayoritas2 AS id_mayoritas2,
					pekerjaan.mayoritas3 AS id_mayoritas3,
					satker.nama_satker,
					geografi.*,
					mayoritas1.nama AS mayoritas1,
					mayoritas2.nama AS mayoritas2,
					mayoritas3.nama AS mayoritas3
				FROM
					demo_pekerjaan_masyarakat AS pekerjaan
					JOIN org_satker AS satker
					ON pekerjaan.id_satker = satker.id_satker
					JOIN mst_mayoritas_pekerjaan AS mayoritas1
					ON pekerjaan.mayoritas1 = mayoritas1.id_mayoritas_pekerjaan
					JOIN mst_mayoritas_pekerjaan AS mayoritas2
					ON pekerjaan.mayoritas2 = mayoritas2.id_mayoritas_pekerjaan
					JOIN mst_mayoritas_pekerjaan AS mayoritas3
					ON pekerjaan.mayoritas3 = mayoritas3.id_mayoritas_pekerjaan
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
					pekerjaan.id_geografi = geografi.id_provinsi OR
					pekerjaan.id_geografi = geografi.id_kabupaten OR
					pekerjaan.id_geografi = geografi.id_kecamatan OR
					pekerjaan.id_geografi = geografi.id_kelurahan
				WHERE
					pekerjaan.is_active = 1 AND
					pekerjaan.id_pekerjaan_masyarakat = $id
				GROUP BY
					pekerjaan.id_pekerjaan_masyarakat
				ORDER BY
					pekerjaan.id_pekerjaan_masyarakat DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					pekerjaan.*,
					pekerjaan.mayoritas1 AS id_mayoritas1,
					pekerjaan.mayoritas2 AS id_mayoritas2,
					pekerjaan.mayoritas3 AS id_mayoritas3,
					satker.nama_satker,
					geografi.*,
					mayoritas1.nama AS mayoritas1,
					mayoritas2.nama AS mayoritas2,
					mayoritas3.nama AS mayoritas3
				FROM
					demo_pekerjaan_masyarakat AS pekerjaan
					JOIN org_satker AS satker
					ON pekerjaan.id_satker = satker.id_satker
					JOIN mst_mayoritas_pekerjaan AS mayoritas1
					ON pekerjaan.mayoritas1 = mayoritas1.id_mayoritas_pekerjaan
					JOIN mst_mayoritas_pekerjaan AS mayoritas2
					ON pekerjaan.mayoritas2 = mayoritas2.id_mayoritas_pekerjaan
					JOIN mst_mayoritas_pekerjaan AS mayoritas3
					ON pekerjaan.mayoritas3 = mayoritas3.id_mayoritas_pekerjaan
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
					pekerjaan.id_geografi = geografi.id_provinsi OR
					pekerjaan.id_geografi = geografi.id_kabupaten OR
					pekerjaan.id_geografi = geografi.id_kecamatan OR
					pekerjaan.id_geografi = geografi.id_kelurahan
				WHERE
					pekerjaan.is_active = 1 AND
					pekerjaan.id_satker = $id
				GROUP BY
					pekerjaan.id_pekerjaan_masyarakat
				ORDER BY
					pekerjaan.id_pekerjaan_masyarakat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					pekerjaan.*,
					pekerjaan.mayoritas1 AS id_mayoritas1,
					pekerjaan.mayoritas2 AS id_mayoritas2,
					pekerjaan.mayoritas3 AS id_mayoritas3,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI, 
					mayoritas1.nama AS mayoritas1,
					mayoritas2.nama AS mayoritas2,
					mayoritas3.nama AS mayoritas3
				FROM
					demo_pekerjaan_masyarakat AS pekerjaan
					JOIN org_satker AS satker
					ON pekerjaan.id_satker = satker.id_satker
					JOIN mst_mayoritas_pekerjaan AS mayoritas1
					ON pekerjaan.mayoritas1 = mayoritas1.id_mayoritas_pekerjaan
					JOIN mst_mayoritas_pekerjaan AS mayoritas2
					ON pekerjaan.mayoritas2 = mayoritas2.id_mayoritas_pekerjaan
					JOIN mst_mayoritas_pekerjaan AS mayoritas3
					ON pekerjaan.mayoritas3 = mayoritas3.id_mayoritas_pekerjaan
					LEFT JOIN org_geografi AS geografi ON pekerjaan.id_geografi = geografi.id_geografi
				WHERE
					pekerjaan.is_active = 1 AND
					pekerjaan.id_satker = $id
				GROUP BY
					pekerjaan.id_pekerjaan_masyarakat
				ORDER BY
					pekerjaan.id_pekerjaan_masyarakat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_pekerjaan_masyarakat" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_pekerjaan_masyarakat" => $id]);
    }
}
