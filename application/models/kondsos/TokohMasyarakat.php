<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class TokohMasyarakat extends CI_Model
{
    private $_table = "konsos_tokoh_masyarakat";

    public $id_tokoh_masyarakat;

    public function get()
    {
		$sql = "SELECT DISTINCT
					tokoh.*,
					satker.nama_satker,
					geografi.*,
					agama.nama AS agama
				FROM
					konsos_tokoh_masyarakat AS tokoh
					JOIN org_satker AS satker
					ON tokoh.id_satker = satker.id_satker
					JOIN mst_jenis_agama AS agama
					ON tokoh.id_jenis_agama = agama.id_jenis_agama
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
					tokoh.id_geografi = geografi.id_provinsi OR
					tokoh.id_geografi = geografi.id_kabupaten OR
					tokoh.id_geografi = geografi.id_kecamatan OR
					tokoh.id_geografi = geografi.id_kelurahan
				WHERE
					tokoh.is_active = 1 
				GROUP BY
					tokoh.id_tokoh_masyarakat
				ORDER BY
					tokoh.id_tokoh_masyarakat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('tokoh.*,
		satker.nama_satker,
		geografi.*,
		agama.nama AS agama');
		$this->db->from('konsos_tokoh_masyarakat AS tokoh');
		$this->db->join('org_satker AS satker','tokoh.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_agama AS agama','tokoh.id_jenis_agama = agama.id_jenis_agama');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','tokoh.id_geografi = geografi.id_provinsi OR
			tokoh.id_geografi = geografi.id_kabupaten OR
			tokoh.id_geografi = geografi.id_kecamatan OR
			tokoh.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('tokoh.id_satker', $request['satker']);
			}
		}
		$this->db->where('tokoh.is_active',1);
		$this->db->group_by('tokoh.id_tokoh_masyarakat');
		$this->db->order_by('tokoh.id_tokoh_masyarakat','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('tokoh.*,
		tokoh.nama as namanew,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		agama.nama AS agama,
		user1.nama_pegawai,
		DATE_FORMAT(tokoh.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_tokoh_masyarakat AS tokoh');
		$this->db->join('org_satker AS satker','tokoh.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_agama AS agama','tokoh.id_jenis_agama = agama.id_jenis_agama');
		$this->db->join('org_geografi AS geografi','tokoh.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','tokoh.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('tokoh.id_satker', $request['satker']);
			}
		}
		$this->db->where('tokoh.is_active',1);
		$this->db->group_by('tokoh.id_tokoh_masyarakat');
		$this->db->order_by('tokoh.id_tokoh_masyarakat','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('tokoh.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		agama.nama AS agama,
		user1.nama_pegawai,
		DATE_FORMAT(tokoh.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_tokoh_masyarakat AS tokoh');
		$this->db->join('org_satker AS satker','tokoh.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_agama AS agama','tokoh.id_jenis_agama = agama.id_jenis_agama');
		$this->db->join('org_geografi AS geografi','tokoh.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','tokoh.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('tokoh.id_satker', $id);
		}
		$this->db->where('tokoh.is_active',1);
		$this->db->group_by('tokoh.id_tokoh_masyarakat');
		$this->db->order_by('tokoh.id_tokoh_masyarakat','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					tokoh.*,
					satker.nama_satker,
					geografi.*
				FROM
					konsos_tokoh_masyarakat AS tokoh
					JOIN org_satker AS satker
					ON tokoh.id_satker = satker.id_satker
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
					tokoh.id_geografi = geografi.id_provinsi OR
					tokoh.id_geografi = geografi.id_kabupaten OR
					tokoh.id_geografi = geografi.id_kecamatan OR
					tokoh.id_geografi = geografi.id_kelurahan
				WHERE
					tokoh.is_active = 1 AND
					tokoh.id_tokoh_masyarakat = $id
				GROUP BY
					tokoh.id_tokoh_masyarakat
				ORDER BY
					tokoh.id_tokoh_masyarakat DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					tokoh.*,
					satker.nama_satker,
					geografi.*,
					agama.nama AS agama
				FROM
					konsos_tokoh_masyarakat AS tokoh
					JOIN org_satker AS satker
					ON tokoh.id_satker = satker.id_satker
					JOIN mst_jenis_agama AS agama
					ON tokoh.id_jenis_agama = agama.id_jenis_agama
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
					tokoh.id_geografi = geografi.id_provinsi OR
					tokoh.id_geografi = geografi.id_kabupaten OR
					tokoh.id_geografi = geografi.id_kecamatan OR
					tokoh.id_geografi = geografi.id_kelurahan
				WHERE
					tokoh.is_active = 1 AND
					tokoh.id_satker = $id
				GROUP BY
					tokoh.id_tokoh_masyarakat
				ORDER BY
					tokoh.id_tokoh_masyarakat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					tokoh.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					agama.nama AS agama
				FROM
					konsos_tokoh_masyarakat AS tokoh
					JOIN org_satker AS satker
					ON tokoh.id_satker = satker.id_satker
					JOIN mst_jenis_agama AS agama
					ON tokoh.id_jenis_agama = agama.id_jenis_agama
					LEFT JOIN org_geografi AS geografi ON tokoh.id_geografi = geografi.id_geografi
				WHERE
					tokoh.is_active = 1 AND
					tokoh.id_satker = $id
				GROUP BY
					tokoh.id_tokoh_masyarakat
				ORDER BY
					tokoh.id_tokoh_masyarakat DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_tokoh_masyarakat" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_tokoh_masyarakat" => $id]);
    }
}
