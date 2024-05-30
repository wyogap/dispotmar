<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Pesisir extends CI_Model
{
    private $_table = "demo_desa_pesisir";

    public $id_desa_pesisir;

    public function get()
    {
		$sql = "SELECT DISTINCT
					pesisir.*,
					satker.nama_satker,
					geografi.*
				FROM
					demo_desa_pesisir AS pesisir
					JOIN org_satker AS satker
					ON pesisir.id_satker = satker.id_satker
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
					pesisir.id_geografi = geografi.id_provinsi OR
					pesisir.id_geografi = geografi.id_kabupaten OR
					pesisir.id_geografi = geografi.id_kecamatan OR
					pesisir.id_geografi = geografi.id_kelurahan
				WHERE
					pesisir.is_active = 1 
				GROUP BY
					pesisir.id_desa_pesisir
				ORDER BY
					pesisir.id_desa_pesisir DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('pesisir.*,
		satker.nama_satker,
		geografi.*');
		$this->db->from('demo_desa_pesisir AS pesisir');
		$this->db->join('org_satker AS satker','pesisir.id_satker = satker.id_satker');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','pesisir.id_geografi = geografi.id_provinsi OR
			pesisir.id_geografi = geografi.id_kabupaten OR
			pesisir.id_geografi = geografi.id_kecamatan OR
			pesisir.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pesisir.id_satker', $request['satker']);
			}
		}
		$this->db->where('pesisir.is_active',1);
		$this->db->group_by('pesisir.id_desa_pesisir');
		$this->db->order_by('pesisir.id_desa_pesisir','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('pesisir.*,
		satker.nama_satker,
		prov.nama as provinsi,
		kab.nama as kabupaten,
		kec.nama as kecamatan,
		kel.nama as kelurahan,
		user1.nama_pegawai,
		DATE_FORMAT(pesisir.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_desa_pesisir AS pesisir');
		$this->db->join('org_satker AS satker','pesisir.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS prov','pesisir.id_prov = prov.id_geografi', 'left');
		$this->db->join('org_geografi AS kab','pesisir.id_kab = kab.id_geografi', 'left');
		$this->db->join('org_geografi AS kec','pesisir.id_kec = kec.id_geografi', 'left');
		$this->db->join('org_geografi AS kel','pesisir.id_kel = kel.id_geografi', 'left');
		$this->db->join('mst_user AS user1','pesisir.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('pesisir.id_satker', $request['satker']);
			}
		}
		$this->db->where('pesisir.id_prov',null);
		$this->db->where('pesisir.is_active',1);
		$this->db->group_by('pesisir.id_desa_pesisir');
		$this->db->order_by('pesisir.id_desa_pesisir','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getExport($id)
    {
		$this->db->select('pesisir.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		user1.nama_pegawai,
		DATE_FORMAT(pesisir.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('demo_desa_pesisir AS pesisir');
		$this->db->join('org_satker AS satker','pesisir.id_satker = satker.id_satker');
		$this->db->join('org_geografi AS geografi','pesisir.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','pesisir.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('pesisir.id_satker', $id);
		}
		$this->db->where('pesisir.is_active',1);
		$this->db->group_by('pesisir.id_desa_pesisir');
		$this->db->order_by('pesisir.id_desa_pesisir','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					pesisir.*,
					satker.nama_satker,
					geografi.*
				FROM
					demo_desa_pesisir AS pesisir
					JOIN org_satker AS satker
					ON pesisir.id_satker = satker.id_satker
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
					pesisir.id_geografi = geografi.id_provinsi OR
					pesisir.id_geografi = geografi.id_kabupaten OR
					pesisir.id_geografi = geografi.id_kecamatan OR
					pesisir.id_geografi = geografi.id_kelurahan
				WHERE
					pesisir.is_active = 1 AND
					pesisir.id_desa_pesisir = $id
				GROUP BY
					pesisir.id_desa_pesisir
				ORDER BY
					pesisir.id_desa_pesisir DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					pesisir.*,
					satker.nama_satker,
					geografi.*
				FROM
					demo_desa_pesisir AS pesisir
					JOIN org_satker AS satker
					ON pesisir.id_satker = satker.id_satker
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
					pesisir.id_geografi = geografi.id_provinsi OR
					pesisir.id_geografi = geografi.id_kabupaten OR
					pesisir.id_geografi = geografi.id_kecamatan OR
					pesisir.id_geografi = geografi.id_kelurahan
				WHERE
					pesisir.is_active = 1 AND
					pesisir.id_satker = $id
				GROUP BY
					pesisir.id_desa_pesisir
				ORDER BY
					pesisir.id_desa_pesisir DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					pesisir.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI
				FROM
					demo_desa_pesisir AS pesisir
					JOIN org_satker AS satker
					ON pesisir.id_satker = satker.id_satker
					LEFT JOIN org_geografi AS geografi ON pesisir.id_geografi = geografi.id_geografi
				WHERE
					pesisir.is_active = 1 AND
					pesisir.id_satker = $id
				GROUP BY
					pesisir.id_desa_pesisir
				ORDER BY
					pesisir.id_desa_pesisir DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_desa_pesisir" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_desa_pesisir" => $id]);
    }
}
