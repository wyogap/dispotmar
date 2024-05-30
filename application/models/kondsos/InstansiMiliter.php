<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class InstansiMiliter extends CI_Model
{
    private $_table = "konsos_instansi_militer";

    public $id_instansi_militer;

    public function get()
    {
		$sql = "SELECT DISTINCT
					militer.*,
					satker.nama_satker,
					geografi.*,
					instansi.nama AS instansi
				FROM
					konsos_instansi_militer AS militer
					JOIN org_satker AS satker
					ON militer.id_satker = satker.id_satker
					JOIN mst_instansi AS instansi
					ON militer.id_instansi = instansi.id_instansi
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
					militer.id_geografi = geografi.id_provinsi OR
					militer.id_geografi = geografi.id_kabupaten OR
					militer.id_geografi = geografi.id_kecamatan OR
					militer.id_geografi = geografi.id_kelurahan
				WHERE
					militer.is_active = 1 
				GROUP BY
					militer.id_instansi_militer
				ORDER BY
					militer.id_instansi_militer DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('militer.*,
		satker.nama_satker,
		geografi.*,
		instansi.nama AS instansi');
		$this->db->from('konsos_instansi_militer AS militer');
		$this->db->join('org_satker AS satker','militer.id_satker = satker.id_satker');
		$this->db->join('mst_instansi AS instansi','militer.id_instansi = instansi.id_instansi');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','militer.id_geografi = geografi.id_provinsi OR
			militer.id_geografi = geografi.id_kabupaten OR
			militer.id_geografi = geografi.id_kecamatan OR
			militer.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('militer.id_satker', $request['satker']);
			}
		}
		$this->db->where('militer.is_active',1);
		$this->db->group_by('militer.id_instansi_militer');
		$this->db->order_by('militer.id_instansi_militer','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('militer.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		instansi.nama AS instansi,
		user1.nama_pegawai,
		DATE_FORMAT(militer.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_instansi_militer AS militer');
		$this->db->join('org_satker AS satker','militer.id_satker = satker.id_satker');
		$this->db->join('mst_instansi AS instansi','militer.id_instansi = instansi.id_instansi');
		$this->db->join('org_geografi AS geografi','militer.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','militer.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('militer.id_satker', $request['satker']);
			}
		}
		$this->db->where('militer.is_active',1);
		$this->db->group_by('militer.id_instansi_militer');
		$this->db->order_by('militer.id_instansi_militer','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('militer.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		instansi.nama AS instansi,
		user1.nama_pegawai,
		DATE_FORMAT(militer.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_instansi_militer AS militer');
		$this->db->join('org_satker AS satker','militer.id_satker = satker.id_satker');
		$this->db->join('mst_instansi AS instansi','militer.id_instansi = instansi.id_instansi');
		$this->db->join('org_geografi AS geografi','militer.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','militer.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('militer.id_satker', $id);
		}
		$this->db->where('militer.is_active',1);
		$this->db->group_by('militer.id_instansi_militer');
		$this->db->order_by('militer.id_instansi_militer','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					militer.*,
					satker.nama_satker,
					geografi.*,
					instansi.nama AS instansi
				FROM
					konsos_instansi_militer AS militer
					JOIN org_satker AS satker
					ON militer.id_satker = satker.id_satker
					JOIN mst_instansi AS instansi
					ON militer.id_instansi = instansi.id_instansi
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
					militer.id_geografi = geografi.id_provinsi OR
					militer.id_geografi = geografi.id_kabupaten OR
					militer.id_geografi = geografi.id_kecamatan OR
					militer.id_geografi = geografi.id_kelurahan
				WHERE
					militer.is_active = 1 AND
					militer.id_instansi_militer = $id
				GROUP BY
					militer.id_instansi_militer
				ORDER BY
					militer.id_instansi_militer DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					militer.*,
					satker.nama_satker,
					geografi.*,
					instansi.nama AS instansi
				FROM
					konsos_instansi_militer AS militer
					JOIN org_satker AS satker
					ON militer.id_satker = satker.id_satker
					JOIN mst_instansi AS instansi
					ON militer.id_instansi = instansi.id_instansi
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
					militer.id_geografi = geografi.id_provinsi OR
					militer.id_geografi = geografi.id_kabupaten OR
					militer.id_geografi = geografi.id_kecamatan OR
					militer.id_geografi = geografi.id_kelurahan
				WHERE
					militer.is_active = 1 AND
					militer.id_satker = $id
				GROUP BY
					militer.id_instansi_militer
				ORDER BY
					militer.id_instansi_militer DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					militer.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					instansi.nama AS instansi
				FROM
					konsos_instansi_militer AS militer
					JOIN org_satker AS satker
					ON militer.id_satker = satker.id_satker
					JOIN mst_instansi AS instansi
					ON militer.id_instansi = instansi.id_instansi
					LEFT JOIN org_geografi AS geografi ON militer.id_geografi = geografi.id_geografi
				WHERE
					militer.is_active = 1 AND
					militer.id_satker = $id
				GROUP BY
					militer.id_instansi_militer
				ORDER BY
					militer.id_instansi_militer DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_instansi_militer" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_instansi_militer" => $id]);
    }
}
