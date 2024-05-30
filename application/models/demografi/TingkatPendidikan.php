<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class TingkatPendidikan extends CI_Model
{
    private $_table = "demo_tingkat_pendidikan";

    public $id_tingkat_pendidikan;

    public function get()
    {
		$sql = "SELECT DISTINCT
					pendidikan.*,
					satker.nama_satker,
					geografi.*
				FROM
					demo_tingkat_pendidikan AS pendidikan
					JOIN org_satker AS satker
					ON pendidikan.id_satker = satker.id_satker
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
					pendidikan.id_geografi = geografi.id_provinsi OR
					pendidikan.id_geografi = geografi.id_kabupaten OR
					pendidikan.id_geografi = geografi.id_kecamatan OR
					pendidikan.id_geografi = geografi.id_kelurahan
				WHERE
					pendidikan.is_active = 1 
				GROUP BY
					pendidikan.id_tingkat_pendidikan
				ORDER BY
					pendidikan.id_tingkat_pendidikan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }
    
    public function list($request = null)
    {
		$this->db->select('pendidikan.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('demo_tingkat_pendidikan AS pendidikan');
		$this->db->join('org_satker AS satker','pendidikan.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','pendidikan.id_geografi = geografi.id_provinsi OR
			pendidikan.id_geografi = geografi.id_kabupaten OR
			pendidikan.id_geografi = geografi.id_kecamatan OR
			pendidikan.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pendidikan.id_satker', $request['satker']);
			}
		}
		$this->db->where('pendidikan.is_active',1);
		$this->db->group_by('pendidikan.id_tingkat_pendidikan');
		$this->db->order_by('pendidikan.id_tingkat_pendidikan','DESC');
			
		return $this->db->get()->result();
	}

	public function get()
    {
		$sql = "SELECT DISTINCT
					pendidikan.*,
					satker.nama_satker,
					geografi.nama as wilayah,
					geografi.*
				FROM
					demo_tingkat_pendidikan AS pendidikan
					JOIN org_satker AS satker
					ON pendidikan.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi
				ON
					pendidikan.id_geografi = geografi.id_geografi
				WHERE
					pendidikan.is_active = 1 
				GROUP BY
					pendidikan.id_tingkat_pendidikan
				ORDER BY
					pendidikan.id_tingkat_pendidikan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }
    
    public function getdataForDatatable($request = null)
    {
		$this->db->select('pendidikan.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(pendidikan.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_tingkat_pendidikan AS pendidikan');
		$this->db->join('org_satker AS satker','pendidikan.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','pendidikan.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pendidikan.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pendidikan.id_satker', $request['satker']);
			}
		}
		$this->db->where('pendidikan.is_active',1);
		$this->db->group_by('pendidikan.id_tingkat_pendidikan');
		$this->db->order_by('pendidikan.id_tingkat_pendidikan','DESC');
			
		return $this->db->get()->result();
	}
	
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					pendidikan.*,
					satker.nama_satker,
					geografi.*
				FROM
					demo_tingkat_pendidikan AS pendidikan
					JOIN org_satker AS satker
					ON pendidikan.id_satker = satker.id_satker
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
					pendidikan.id_geografi = geografi.id_provinsi OR
					pendidikan.id_geografi = geografi.id_kabupaten OR
					pendidikan.id_geografi = geografi.id_kecamatan OR
					pendidikan.id_geografi = geografi.id_kelurahan
				WHERE
					pendidikan.is_active = 1 AND
					pendidikan.id_tingkat_pendidikan = $id
				GROUP BY
					pendidikan.id_tingkat_pendidikan
				ORDER BY
					pendidikan.id_tingkat_pendidikan DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					pendidikan.*,
					satker.nama_satker,
					geografi.*
				FROM
					demo_tingkat_pendidikan AS pendidikan
					JOIN org_satker AS satker
					ON pendidikan.id_satker = satker.id_satker
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
					pendidikan.id_geografi = geografi.id_provinsi OR
					pendidikan.id_geografi = geografi.id_kabupaten OR
					pendidikan.id_geografi = geografi.id_kecamatan OR
					pendidikan.id_geografi = geografi.id_kelurahan
				WHERE
					pendidikan.is_active = 1 AND
					pendidikan.id_satker = $id
				GROUP BY
					pendidikan.id_tingkat_pendidikan
				ORDER BY
					pendidikan.id_tingkat_pendidikan DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_tingkat_pendidikan" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_tingkat_pendidikan" => $id]);
    }
}
