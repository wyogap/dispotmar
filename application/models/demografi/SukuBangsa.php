<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class SukuBangsa extends CI_Model
{
    private $_table = "demo_suku_bangsa";

    public $id_suku;

    public function get()
    {
		$sql = "SELECT DISTINCT
					suku.*,
					satker.nama_satker,
					geografi.*,
					bahasa_adat.nama AS bahasa_adat,
					jenis_suku.nama AS jenis_suku
				FROM
					demo_suku_bangsa AS suku
					JOIN org_satker AS satker
					ON suku.id_satker = satker.id_satker
					JOIN mst_bahasa_adat AS bahasa_adat
					ON suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat
					JOIN mst_jenis_suku AS jenis_suku
					ON suku.id_jenis_suku = jenis_suku.id_jenis_suku
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
					suku.id_geografi = geografi.id_provinsi OR
					suku.id_geografi = geografi.id_kabupaten OR
					suku.id_geografi = geografi.id_kecamatan OR
					suku.id_geografi = geografi.id_kelurahan
				WHERE
					suku.is_active = 1 
				GROUP BY
					suku.id_suku
				ORDER BY
					suku.id_suku DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('suku.*,
		satker.nama_satker,
		geografi.*,
		bahasa_adat.nama AS bahasa_adat,
		jenis_suku.nama AS jenis_suku');
		$this->db->from('demo_suku_bangsa AS suku');
		$this->db->join('org_satker AS satker','suku.id_satker = satker.id_satker');
		$this->db->join('mst_bahasa_adat AS bahasa_adat','suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat');
		$this->db->join('mst_jenis_suku AS jenis_suku','suku.id_jenis_suku = jenis_suku.id_jenis_suku');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','suku.id_geografi = geografi.id_provinsi OR
			suku.id_geografi = geografi.id_kabupaten OR
			suku.id_geografi = geografi.id_kecamatan OR
			suku.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('suku.id_satker', $request['satker']);
			}
		}
		$this->db->where('suku.is_active',1);
		$this->db->group_by('suku.id_suku');
		$this->db->order_by('suku.id_suku','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable_get()
    {
		$sql = "SELECT DISTINCT
					suku.*,
					satker.nama_satker,
					geografi.nama as wilayah,
					geografi.*,
					bahasa_adat.nama AS bahasa_adat,
					jenis_suku.nama AS jenis_suku
				FROM
					demo_suku_bangsa AS suku
					JOIN org_satker AS satker
					ON suku.id_satker = satker.id_satker
					JOIN mst_bahasa_adat AS bahasa_adat
					ON suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat
					JOIN mst_jenis_suku AS jenis_suku
					ON suku.id_jenis_suku = jenis_suku.id_jenis_suku
					LEFT JOIN org_geografi AS geografi
				ON
					suku.id_geografi = geografi.id_geografi
				WHERE
					suku.is_active = 1 
				GROUP BY
					suku.id_suku
				ORDER BY
					suku.id_suku DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function getdataForDatatable($request = null)
    {
		$this->db->select('suku.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		bahasa_adat.nama AS bahasa_adat,
		jenis_suku.nama AS jenis_suku,
		user1.nama_pegawai,
		DATE_FORMAT(suku.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_suku_bangsa AS suku');
		$this->db->join('org_satker AS satker','suku.id_satker = satker.id_satker');
		$this->db->join('mst_bahasa_adat AS bahasa_adat','suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat');
		$this->db->join('mst_jenis_suku AS jenis_suku','suku.id_jenis_suku = jenis_suku.id_jenis_suku');
		$this->db->join('org_geografi AS geografi','suku.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','suku.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('suku.id_satker', $request['satker']);
			}
		}
		$this->db->where('suku.is_active',1);
		$this->db->group_by('suku.id_suku');
		$this->db->order_by('suku.id_suku','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('suku.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		bahasa_adat.nama AS bahasa_adat,
		jenis_suku.nama AS jenis_suku,
		user1.nama_pegawai,
		DATE_FORMAT(suku.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_suku_bangsa AS suku');
		$this->db->join('org_satker AS satker','suku.id_satker = satker.id_satker');
		$this->db->join('mst_bahasa_adat AS bahasa_adat','suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat');
		$this->db->join('mst_jenis_suku AS jenis_suku','suku.id_jenis_suku = jenis_suku.id_jenis_suku');
		$this->db->join('org_geografi AS geografi','suku.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','suku.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('suku.id_satker', $id);
		}
		$this->db->where('suku.is_active',1);
		$this->db->group_by('suku.id_suku');
		$this->db->order_by('suku.id_suku','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					suku.*,
					satker.nama_satker,
					geografi.*,
					bahasa_adat.nama AS bahasa_adat,
					jenis_suku.nama AS jenis_suku
				FROM
					demo_suku_bangsa AS suku
					JOIN org_satker AS satker
					ON suku.id_satker = satker.id_satker
					JOIN mst_bahasa_adat AS bahasa_adat
					ON suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat
					JOIN mst_jenis_suku AS jenis_suku
					ON suku.id_jenis_suku = jenis_suku.id_jenis_suku
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
					suku.id_geografi = geografi.id_provinsi OR
					suku.id_geografi = geografi.id_kabupaten OR
					suku.id_geografi = geografi.id_kecamatan OR
					suku.id_geografi = geografi.id_kelurahan
				WHERE
					suku.is_active = 1 AND
					suku.id_suku = $id
				GROUP BY
					suku.id_suku
				ORDER BY
					suku.id_suku DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					suku.*,
					satker.nama_satker,
					geografi.*,
					bahasa_adat.nama AS bahasa_adat,
					jenis_suku.nama AS jenis_suku
				FROM
					demo_suku_bangsa AS suku
					JOIN org_satker AS satker
					ON suku.id_satker = satker.id_satker
					JOIN mst_bahasa_adat AS bahasa_adat
					ON suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat
					JOIN mst_jenis_suku AS jenis_suku
					ON suku.id_jenis_suku = jenis_suku.id_jenis_suku
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
					suku.id_geografi = geografi.id_provinsi OR
					suku.id_geografi = geografi.id_kabupaten OR
					suku.id_geografi = geografi.id_kecamatan OR
					suku.id_geografi = geografi.id_kelurahan
				WHERE
					suku.is_active = 1 AND
					suku.id_satker = $id
				GROUP BY
					suku.id_suku
				ORDER BY
					suku.id_suku DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					suku.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					bahasa_adat.nama AS bahasa_adat,
					jenis_suku.nama AS jenis_suku
				FROM
					demo_suku_bangsa AS suku
					JOIN org_satker AS satker
					ON suku.id_satker = satker.id_satker
					JOIN mst_bahasa_adat AS bahasa_adat
					ON suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat
					JOIN mst_jenis_suku AS jenis_suku
					ON suku.id_jenis_suku = jenis_suku.id_jenis_suku
					LEFT JOIN org_geografi AS geografi ON suku.id_geografi = geografi.id_geografi
				WHERE
					suku.is_active = 1 AND
					suku.id_satker = $id
				GROUP BY
					suku.id_suku
				ORDER BY
					suku.id_suku DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_suku" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_suku" => $id]);
    }
}
