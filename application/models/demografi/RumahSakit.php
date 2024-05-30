<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class RumahSakit extends CI_Model
{
    private $_table = "demo_rumahsakit";

    public $id_rumahsakit;

    public function get()
    {
		$sql = "SELECT DISTINCT
					rumahsakit.*,
					satker.nama_satker,
					geografi.*,
					jenis.nama AS jenis_rumahsakit,
					kelas.nama AS kelas_rumahsakit
				FROM
					demo_rumahsakit AS rumahsakit
					JOIN org_satker AS satker
					ON rumahsakit.id_satker = satker.id_satker
					JOIN mst_jenis_rumahsakit AS jenis
					ON rumahsakit.id_jenis_rumahsakit = jenis.id_jenis_rumahsakit
					JOIN mst_kelas_rumahsakit AS kelas
					ON rumahsakit.id_kelas_rumahsakit = kelas.id_kelas_rumahsakit
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
					rumahsakit.id_geografi = geografi.id_provinsi OR
					rumahsakit.id_geografi = geografi.id_kabupaten OR
					rumahsakit.id_geografi = geografi.id_kecamatan OR
					rumahsakit.id_geografi = geografi.id_kelurahan
				WHERE
					rumahsakit.is_active = 1 
				GROUP BY
					rumahsakit.id_rumahsakit
				ORDER BY
					rumahsakit.id_rumahsakit DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('rumahsakit.*,
		satker.nama_satker,
		geografi.*,
		jenis.nama AS jenis_rumahsakit,
		kelas.nama AS kelas_rumahsakit,
		penyelenggara.nama AS penyelenggara_rumahsakit');
		$this->db->from('demo_rumahsakit AS rumahsakit');
		$this->db->join('org_satker AS satker','rumahsakit.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_rumahsakit AS jenis','rumahsakit.id_jenis_rumahsakit = jenis.id_jenis_rumahsakit');
		$this->db->join('mst_kelas_rumahsakit AS kelas','rumahsakit.id_kelas_rumahsakit = kelas.id_kelas_rumahsakit');
		$this->db->join('mst_penyelenggara_rumahsakit AS penyelenggara','rumahsakit.id_penyelenggara_rumahsakit = penyelenggara.id_penyelenggara_rumahsakit');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','rumahsakit.id_geografi = geografi.id_provinsi OR
			rumahsakit.id_geografi = geografi.id_kabupaten OR
			rumahsakit.id_geografi = geografi.id_kecamatan OR
			rumahsakit.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('rumahsakit.id_satker', $request['satker']);
			}
		}
		$this->db->where('rumahsakit.is_active',1);
		$this->db->group_by('rumahsakit.id_rumahsakit');
		$this->db->order_by('rumahsakit.id_rumahsakit','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('rumahsakit.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis.nama AS jenis_rumahsakit,
		kelas.nama AS kelas_rumahsakit,
		user1.nama_pegawai,
		DATE_FORMAT(rumahsakit.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_rumahsakit AS rumahsakit');
		$this->db->join('org_satker AS satker','rumahsakit.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_rumahsakit AS jenis','rumahsakit.id_jenis_rumahsakit = jenis.id_jenis_rumahsakit');
		$this->db->join('mst_kelas_rumahsakit AS kelas','rumahsakit.id_kelas_rumahsakit = kelas.id_kelas_rumahsakit');
		//$this->db->join('mst_penyelenggara_rumahsakit AS penyelenggara','rumahsakit.id_penyelenggara_rumahsakit = penyelenggara.id_penyelenggara_rumahsakit');
		$this->db->join('org_geografi AS geografi','rumahsakit.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','rumahsakit.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('rumahsakit.id_satker', $request['satker']);
			}
		}
		$this->db->where('rumahsakit.is_active',1);
		$this->db->group_by('rumahsakit.id_rumahsakit');
		$this->db->order_by('rumahsakit.id_rumahsakit','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('rumahsakit.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis.nama AS jenis_rumahsakit,
		kelas.nama AS kelas_rumahsakit,
		user1.nama_pegawai,
		DATE_FORMAT(rumahsakit.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_rumahsakit AS rumahsakit');
		$this->db->join('org_satker AS satker','rumahsakit.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_rumahsakit AS jenis','rumahsakit.id_jenis_rumahsakit = jenis.id_jenis_rumahsakit');
		$this->db->join('mst_kelas_rumahsakit AS kelas','rumahsakit.id_kelas_rumahsakit = kelas.id_kelas_rumahsakit');
		//$this->db->join('mst_penyelenggara_rumahsakit AS penyelenggara','rumahsakit.id_penyelenggara_rumahsakit = penyelenggara.id_penyelenggara_rumahsakit');
		$this->db->join('org_geografi AS geografi','rumahsakit.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','rumahsakit.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('rumahsakit.id_satker', $id);
		}
		$this->db->where('rumahsakit.is_active',1);
		$this->db->group_by('rumahsakit.id_rumahsakit');
		$this->db->order_by('rumahsakit.id_rumahsakit','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					rumahsakit.*,
					satker.nama_satker,
					geografi.*,
					jenis.nama AS jenis_rumahsakit,
					kelas.nama AS kelas_rumahsakit
				FROM
					demo_rumahsakit AS rumahsakit
					JOIN org_satker AS satker
					ON rumahsakit.id_satker = satker.id_satker
					JOIN mst_jenis_rumahsakit AS jenis
					ON rumahsakit.id_jenis_rumahsakit = jenis.id_jenis_rumahsakit
					JOIN mst_kelas_rumahsakit AS kelas
					ON rumahsakit.id_kelas_rumahsakit = kelas.id_kelas_rumahsakit
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
					rumahsakit.id_geografi = geografi.id_provinsi OR
					rumahsakit.id_geografi = geografi.id_kabupaten OR
					rumahsakit.id_geografi = geografi.id_kecamatan OR
					rumahsakit.id_geografi = geografi.id_kelurahan
				WHERE
					rumahsakit.is_active = 1 AND
					rumahsakit.id_rumahsakit = $id
				GROUP BY
					rumahsakit.id_rumahsakit
				ORDER BY
					rumahsakit.id_rumahsakit DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					rumahsakit.*,
					satker.nama_satker,
					geografi.*,
					jenis.nama AS jenis_rumahsakit,
					kelas.nama AS kelas_rumahsakit
				FROM
					demo_rumahsakit AS rumahsakit
					JOIN org_satker AS satker
					ON rumahsakit.id_satker = satker.id_satker
					JOIN mst_jenis_rumahsakit AS jenis
					ON rumahsakit.id_jenis_rumahsakit = jenis.id_jenis_rumahsakit
					JOIN mst_kelas_rumahsakit AS kelas
					ON rumahsakit.id_kelas_rumahsakit = kelas.id_kelas_rumahsakit
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
					rumahsakit.id_geografi = geografi.id_provinsi OR
					rumahsakit.id_geografi = geografi.id_kabupaten OR
					rumahsakit.id_geografi = geografi.id_kecamatan OR
					rumahsakit.id_geografi = geografi.id_kelurahan
				WHERE
					rumahsakit.is_active = 1 AND
					rumahsakit.id_satker = $id
				GROUP BY
					rumahsakit.id_rumahsakit
				ORDER BY
					rumahsakit.id_rumahsakit DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					rumahsakit.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis.nama AS jenis_rumahsakit,
					kelas.nama AS kelas_rumahsakit
				FROM
					demo_rumahsakit AS rumahsakit
					JOIN org_satker AS satker
					ON rumahsakit.id_satker = satker.id_satker
					JOIN mst_jenis_rumahsakit AS jenis
					ON rumahsakit.id_jenis_rumahsakit = jenis.id_jenis_rumahsakit
					JOIN mst_kelas_rumahsakit AS kelas
					ON rumahsakit.id_kelas_rumahsakit = kelas.id_kelas_rumahsakit
					LEFT JOIN org_geografi AS geografi ON rumahsakit.id_geografi = geografi.id_geografi
				WHERE
					rumahsakit.is_active = 1 AND
					rumahsakit.id_satker = $id
				GROUP BY
					rumahsakit.id_rumahsakit
				ORDER BY
					rumahsakit.id_rumahsakit DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_rumahsakit" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_rumahsakit" => $id]);
    }
}
