<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class OrganisasiAgama extends CI_Model
{
    private $_table = "konsos_organisasi_agama";

    public $id_organisasi_agama;

    public function get()
    {
		$sql = "SELECT DISTINCT
					agama.*,
					satker.nama_satker,
					geografi.*,
					jenis_agama.nama AS agama
				FROM
					konsos_organisasi_agama AS agama
					JOIN org_satker AS satker
					ON agama.id_satker = satker.id_satker
					JOIN mst_jenis_agama AS jenis_agama
					ON agama.id_jenis_agama = jenis_agama.id_jenis_agama
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
					agama.id_geografi = geografi.id_provinsi OR
					agama.id_geografi = geografi.id_kabupaten OR
					agama.id_geografi = geografi.id_kecamatan OR
					agama.id_geografi = geografi.id_kelurahan
				WHERE
					agama.is_active = 1 
				GROUP BY
					agama.id_organisasi_agama
				ORDER BY
					agama.id_organisasi_agama DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('agama.*,
		satker.nama_satker,
		geografi.*,
		jenis_agama.nama AS agama');
		$this->db->from('konsos_organisasi_agama AS agama');
		$this->db->join('org_satker AS satker','agama.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_agama AS jenis_agama','agama.id_jenis_agama = jenis_agama.id_jenis_agama');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','agama.id_geografi = geografi.id_provinsi OR
			agama.id_geografi = geografi.id_kabupaten OR
			agama.id_geografi = geografi.id_kecamatan OR
			agama.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('agama.id_satker', $request['satker']);
			}
		}
		$this->db->where('agama.is_active',1);
		$this->db->group_by('agama.id_organisasi_agama');
		$this->db->order_by('agama.id_organisasi_agama','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('agama.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_agama.nama AS agama,
		user1.nama_pegawai,
		DATE_FORMAT(agama.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_organisasi_agama AS agama');
		$this->db->join('org_satker AS satker','agama.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_agama AS jenis_agama','agama.id_jenis_agama = jenis_agama.id_jenis_agama');
		$this->db->join('org_geografi AS geografi','agama.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','agama.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('agama.id_satker', $request['satker']);
			}
		}
		$this->db->where('agama.is_active',1);
		$this->db->group_by('agama.id_organisasi_agama');
		$this->db->order_by('agama.id_organisasi_agama','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('agama.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_agama.nama AS agama,
		user1.nama_pegawai,
		DATE_FORMAT(agama.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_organisasi_agama AS agama');
		$this->db->join('org_satker AS satker','agama.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_agama AS jenis_agama','agama.id_jenis_agama = jenis_agama.id_jenis_agama');
		$this->db->join('org_geografi AS geografi','agama.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','agama.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('agama.id_satker', $id);
		}
		$this->db->where('agama.is_active',1);
		$this->db->group_by('agama.id_organisasi_agama');
		$this->db->order_by('agama.id_organisasi_agama','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					agama.*,
					satker.nama_satker,
					geografi.*,
					jenis_agama.nama AS agama
				FROM
					konsos_organisasi_agama AS agama
					JOIN org_satker AS satker
					ON agama.id_satker = satker.id_satker
					JOIN mst_jenis_agama AS jenis_agama
					ON agama.id_jenis_agama = jenis_agama.id_jenis_agama
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
					agama.id_geografi = geografi.id_provinsi OR
					agama.id_geografi = geografi.id_kabupaten OR
					agama.id_geografi = geografi.id_kecamatan OR
					agama.id_geografi = geografi.id_kelurahan
				WHERE
					agama.is_active = 1 AND
					agama.id_organisasi_agama = $id
				GROUP BY
					agama.id_organisasi_agama
				ORDER BY
					agama.id_organisasi_agama DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					agama.*,
					satker.nama_satker,
					geografi.*,
					jenis_agama.nama AS agama
				FROM
					konsos_organisasi_agama AS agama
					JOIN org_satker AS satker
					ON agama.id_satker = satker.id_satker
					JOIN mst_jenis_agama AS jenis_agama
					ON agama.id_jenis_agama = jenis_agama.id_jenis_agama
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
					agama.id_geografi = geografi.id_provinsi OR
					agama.id_geografi = geografi.id_kabupaten OR
					agama.id_geografi = geografi.id_kecamatan OR
					agama.id_geografi = geografi.id_kelurahan
				WHERE
					agama.is_active = 1 AND
					agama.id_satker = $id
				GROUP BY
					agama.id_organisasi_agama
				ORDER BY
					agama.id_organisasi_agama DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					agama.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_agama.nama AS agama
				FROM
					konsos_organisasi_agama AS agama
					JOIN org_satker AS satker
					ON agama.id_satker = satker.id_satker
					JOIN mst_jenis_agama AS jenis_agama
					ON agama.id_jenis_agama = jenis_agama.id_jenis_agama
					LEFT JOIN org_geografi AS geografi ON agama.id_geografi = geografi.id_geografi
				WHERE
					agama.is_active = 1 AND
					agama.id_satker = $id
				GROUP BY
					agama.id_organisasi_agama
				ORDER BY
					agama.id_organisasi_agama DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_organisasi_agama" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_organisasi_agama" => $id]);
    }
}
