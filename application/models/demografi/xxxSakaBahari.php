<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class xxxSakaBahari extends CI_Model
{
    private $_table = "demo_saka_bahari";

    public $id_saka_bahari;

    public function get()
    {
		$sql = "SELECT DISTINCT
					bahari.*,
					satker.nama_satker,
					geografi.*,
					saka.nama AS saka
				FROM
					demo_saka_bahari AS bahari
					JOIN org_satker AS satker
					ON bahari.id_satker = satker.id_satker
					JOIN mst_jenis_saka AS saka
					ON bahari.id_jenis_saka = saka.id_jenis_saka
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
					bahari.id_geografi = geografi.id_provinsi OR
					bahari.id_geografi = geografi.id_kabupaten OR
					bahari.id_geografi = geografi.id_kecamatan OR
					bahari.id_geografi = geografi.id_kelurahan
				WHERE
					bahari.is_active = 1 
				GROUP BY
					bahari.id_saka_bahari
				ORDER BY
					bahari.id_saka_bahari DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('bahari.*,
		satker.nama_satker,
		geografi.*,
		saka.nama AS saka');
		$this->db->from('demo_saka_bahari AS bahari');
		$this->db->join('org_satker AS satker','bahari.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_saka AS saka','bahari.id_jenis_saka = saka.id_jenis_saka');
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
                    KEL.id_geografi_parent = KEC.id_geografi) AS geografi','bahari.id_geografi = geografi.id_provinsi OR
                    bahari.id_geografi = geografi.id_kabupaten OR
                    bahari.id_geografi = geografi.id_kecamatan OR
                    bahari.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('bahari.id_satker', $request['satker']);
			}
		}
		$this->db->where('bahari.is_active',1);
		$this->db->group_by('bahari.id_saka_bahari');
		$this->db->order_by('bahari.id_saka_bahari','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getdataForDatatable_get()
    {
		$sql = "SELECT DISTINCT
					bahari.*,
					satker.nama_satker,
					geografi.nama as wilayah,
					geografi.*,
					saka.nama AS saka
				FROM
					demo_saka_bahari AS bahari
					JOIN org_satker AS satker
					ON bahari.id_satker = satker.id_satker
					JOIN mst_jenis_saka AS saka
					ON bahari.id_jenis_saka = saka.id_jenis_saka
					LEFT JOIN org_geografi AS geografi
				ON
					bahari.id_geografi = geografi.id_geografi
				WHERE
					bahari.is_active = 1 
				GROUP BY
					bahari.id_saka_bahari
				ORDER BY
					bahari.id_saka_bahari DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function getdataForDatatable($request = null)
    {
		$this->db->select('bahari.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		saka.nama AS saka,
		user1.nama_pegawai,
		DATE_FORMAT(bahari.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_saka_bahari AS bahari');
		$this->db->join('org_satker AS satker','bahari.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_saka AS saka','bahari.id_jenis_saka = saka.id_jenis_saka');
		$this->db->join('org_geografi AS geografi','bahari.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','bahari.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('bahari.id_satker', $request['satker']);
			}
		}
		$this->db->where('bahari.is_active',1);
		$this->db->group_by('bahari.id_saka_bahari');
		$this->db->order_by('bahari.id_saka_bahari','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('bahari.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		saka.nama AS saka,
		user1.nama_pegawai,
		DATE_FORMAT(bahari.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_saka_bahari AS bahari');
		$this->db->join('org_satker AS satker','bahari.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_saka AS saka','bahari.id_jenis_saka = saka.id_jenis_saka');
		$this->db->join('org_geografi AS geografi','bahari.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','bahari.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('bahari.id_satker', $id);
		}
		$this->db->where('bahari.is_active',1);
		$this->db->group_by('bahari.id_saka_bahari');
		$this->db->order_by('bahari.id_saka_bahari','DESC');
			
		return $this->db->get()->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					bahari.*,
					satker.nama_satker,
					geografi.*,
					saka.nama AS saka
				FROM
					demo_saka_bahari AS bahari
					JOIN org_satker AS satker
					ON bahari.id_satker = satker.id_satker
					JOIN mst_jenis_saka AS saka
					ON bahari.id_jenis_saka = saka.id_jenis_saka
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
					bahari.id_geografi = geografi.id_provinsi OR
					bahari.id_geografi = geografi.id_kabupaten OR
					bahari.id_geografi = geografi.id_kecamatan OR
					bahari.id_geografi = geografi.id_kelurahan
				WHERE
					bahari.is_active = 1 AND
					bahari.id_saka_bahari = $id
				GROUP BY
					bahari.id_saka_bahari
				ORDER BY
					bahari.id_saka_bahari DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					bahari.*,
					satker.nama_satker,
					geografi.*,
					saka.nama AS saka
				FROM
					demo_saka_bahari AS bahari
					JOIN org_satker AS satker
					ON bahari.id_satker = satker.id_satker
					JOIN mst_jenis_saka AS saka
					ON bahari.id_jenis_saka = saka.id_jenis_saka
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
					bahari.id_geografi = geografi.id_provinsi OR
					bahari.id_geografi = geografi.id_kabupaten OR
					bahari.id_geografi = geografi.id_kecamatan OR
					bahari.id_geografi = geografi.id_kelurahan
				WHERE
					bahari.is_active = 1 AND
					bahari.id_satker = $id
				GROUP BY
					bahari.id_saka_bahari
				ORDER BY
					bahari.id_saka_bahari DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					bahari.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					saka.nama AS saka
				FROM
					demo_saka_bahari AS bahari
					JOIN org_satker AS satker
					ON bahari.id_satker = satker.id_satker
					JOIN mst_jenis_saka AS saka
					ON bahari.id_jenis_saka = saka.id_jenis_saka
					LEFT JOIN org_geografi AS geografi ON bahari.id_geografi = geografi.id_geografi
				WHERE
					bahari.is_active = 1 AND
					bahari.id_satker = $id
				GROUP BY
					bahari.id_saka_bahari
				ORDER BY
					bahari.id_saka_bahari DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_saka_bahari" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_saka_bahari" => $id]);
    }
}
