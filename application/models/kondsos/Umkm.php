<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Umkm extends CI_Model
{
    private $_table = "konsos_umkm";

    public $id_umkm;

    public function get()
    {
		$sql = "SELECT DISTINCT
					umkm.*,
					satker.nama_satker,
					geografi.*
				FROM
					konsos_umkm AS umkm
					JOIN org_satker AS satker
					ON umkm.id_satker = satker.id_satker
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
					umkm.id_geografi = geografi.id_provinsi OR
					umkm.id_geografi = geografi.id_kabupaten OR
					umkm.id_geografi = geografi.id_kecamatan OR
					umkm.id_geografi = geografi.id_kelurahan
				WHERE
					umkm.is_active = 1 
				GROUP BY
					umkm.id_umkm
				ORDER BY
					umkm.id_umkm DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('umkm.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('konsos_umkm AS umkm');
		$this->db->join('org_satker AS satker','umkm.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','umkm.id_geografi = geografi.id_provinsi OR
			umkm.id_geografi = geografi.id_kabupaten OR
			umkm.id_geografi = geografi.id_kecamatan OR
			umkm.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('umkm.id_satker', $request['satker']);
			}
		}
		$this->db->where('umkm.is_active',1);
		$this->db->group_by('umkm.id_umkm');
		$this->db->order_by('umkm.id_umkm','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('umkm.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(umkm.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_umkm AS umkm');
		$this->db->join('org_satker AS satker','umkm.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','umkm.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','umkm.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('umkm.id_satker', $request['satker']);
			}
		}
		$this->db->where('umkm.is_active',1);
		$this->db->group_by('umkm.id_umkm');
		$this->db->order_by('umkm.id_umkm','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getExport($id)
    {
		$this->db->select('umkm.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(umkm.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_umkm AS umkm');
		$this->db->join('org_satker AS satker','umkm.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','umkm.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','umkm.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('umkm.id_satker', $id);
		}
		$this->db->where('umkm.is_active',1);
		$this->db->group_by('umkm.id_umkm');
		$this->db->order_by('umkm.id_umkm','DESC');
			
		return $this->db->get()->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					umkm.*,
					satker.nama_satker,
					geografi.*
				FROM
					konsos_umkm AS umkm
					JOIN org_satker AS satker
					ON umkm.id_satker = satker.id_satker
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
					umkm.id_geografi = geografi.id_provinsi OR
					umkm.id_geografi = geografi.id_kabupaten OR
					umkm.id_geografi = geografi.id_kecamatan OR
					umkm.id_geografi = geografi.id_kelurahan
				WHERE
					umkm.is_active = 1 AND
					umkm.id_umkm = $id
				GROUP BY
					umkm.id_umkm
				ORDER BY
					umkm.id_umkm DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					umkm.*,
					satker.nama_satker,
					geografi.*
				FROM
					konsos_umkm AS umkm
					JOIN org_satker AS satker
					ON umkm.id_satker = satker.id_satker
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
					umkm.id_geografi = geografi.id_provinsi OR
					umkm.id_geografi = geografi.id_kabupaten OR
					umkm.id_geografi = geografi.id_kecamatan OR
					umkm.id_geografi = geografi.id_kelurahan
				WHERE
					umkm.is_active = 1 AND
					umkm.id_satker = $id
				GROUP BY
					umkm.id_umkm
				ORDER BY
					umkm.id_umkm DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					umkm.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI
				FROM
					konsos_umkm AS umkm
					JOIN org_satker AS satker
					ON umkm.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi ON umkm.id_geografi = geografi.id_geografi
				WHERE
					umkm.is_active = 1 AND
					umkm.id_satker = $id
				GROUP BY
					umkm.id_umkm
				ORDER BY
					umkm.id_umkm DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_umkm" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_umkm" => $id]);
    }
}
