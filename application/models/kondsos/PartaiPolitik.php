<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class PartaiPolitik extends CI_Model
{
    private $_table = "konsos_partai_politik";

    public $id_partai_politik;

    public function get()
    {
		$sql = "SELECT DISTINCT
					parpol.*,
					satker.nama_satker,
					geografi.*,
					partai.nama AS partai
				FROM
					konsos_partai_politik AS parpol
					JOIN org_satker AS satker
					ON parpol.id_satker = satker.id_satker
					JOIN mst_partai AS partai
					ON parpol.id_partai = partai.id_partai
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
					parpol.id_geografi = geografi.id_provinsi OR
					parpol.id_geografi = geografi.id_kabupaten OR
					parpol.id_geografi = geografi.id_kecamatan OR
					parpol.id_geografi = geografi.id_kelurahan
				WHERE
					parpol.is_active = 1 
				GROUP BY
					parpol.id_partai_politik
				ORDER BY
					parpol.id_partai_politik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('parpol.*,
		satker.nama_satker,
		geografi.*,
		partai.nama AS partai');
		$this->db->from('konsos_partai_politik AS parpol');
		$this->db->join('org_satker AS satker','parpol.id_satker = satker.id_satker');
		$this->db->join('mst_partai AS partai','parpol.id_partai = partai.id_partai');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','parpol.id_geografi = geografi.id_provinsi OR
			parpol.id_geografi = geografi.id_kabupaten OR
			parpol.id_geografi = geografi.id_kecamatan OR
			parpol.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('parpol.id_satker', $request['satker']);
			}
		}
		$this->db->where('parpol.is_active',1);
		$this->db->group_by('parpol.id_partai_politik');
		$this->db->order_by('parpol.id_partai_politik','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('parpol.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		partai.nama AS partai,
		user1.nama_pegawai,
		DATE_FORMAT(parpol.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_partai_politik AS parpol');
		$this->db->join('org_satker AS satker','parpol.id_satker = satker.id_satker');
		$this->db->join('mst_partai AS partai','parpol.id_partai = partai.id_partai');
		$this->db->join('org_geografi AS geografi','parpol.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','parpol.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('parpol.id_satker', $request['satker']);
			}
		}
		$this->db->where('parpol.is_active',1);
		$this->db->group_by('parpol.id_partai_politik');
		$this->db->order_by('parpol.id_partai_politik','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getExport($id)
    {
		$this->db->select('parpol.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		partai.nama AS partai,
		user1.nama_pegawai,
		DATE_FORMAT(parpol.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_partai_politik AS parpol');
		$this->db->join('org_satker AS satker','parpol.id_satker = satker.id_satker');
		$this->db->join('mst_partai AS partai','parpol.id_partai = partai.id_partai');
		$this->db->join('org_geografi AS geografi','parpol.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','parpol.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('parpol.id_satker', $id);
		}
		$this->db->where('parpol.is_active',1);
		$this->db->group_by('parpol.id_partai_politik');
		$this->db->order_by('parpol.id_partai_politik','DESC');
			
		return $this->db->get()->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					parpol.*,
					satker.nama_satker,
					geografi.*,
					partai.nama AS partai
				FROM
					konsos_partai_politik AS parpol
					JOIN org_satker AS satker
					ON parpol.id_satker = satker.id_satker
					JOIN mst_partai AS partai
					ON parpol.id_partai = partai.id_partai
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
					parpol.id_geografi = geografi.id_provinsi OR
					parpol.id_geografi = geografi.id_kabupaten OR
					parpol.id_geografi = geografi.id_kecamatan OR
					parpol.id_geografi = geografi.id_kelurahan
				WHERE
					parpol.is_active = 1 AND
					parpol.id_partai_politik = $id
				GROUP BY
					parpol.id_partai_politik
				ORDER BY
					parpol.id_partai_politik DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					parpol.*,
					satker.nama_satker,
					geografi.*,
					partai.nama AS partai
				FROM
					konsos_partai_politik AS parpol
					JOIN org_satker AS satker
					ON parpol.id_satker = satker.id_satker
					JOIN mst_partai AS partai
					ON parpol.id_partai = partai.id_partai
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
					parpol.id_geografi = geografi.id_provinsi OR
					parpol.id_geografi = geografi.id_kabupaten OR
					parpol.id_geografi = geografi.id_kecamatan OR
					parpol.id_geografi = geografi.id_kelurahan
				WHERE
					parpol.is_active = 1 AND
					parpol.id_satker = $id
				GROUP BY
					parpol.id_partai_politik
				ORDER BY
					parpol.id_partai_politik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					parpol.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					partai.nama AS partai
				FROM
					konsos_partai_politik AS parpol
					JOIN org_satker AS satker
					ON parpol.id_satker = satker.id_satker
					JOIN mst_partai AS partai
					ON parpol.id_partai = partai.id_partai
					LEFT JOIN org_geografi AS geografi ON parpol.id_geografi = geografi.id_geografi
				WHERE
					parpol.is_active = 1 AND
					parpol.id_satker = $id
				GROUP BY
					parpol.id_partai_politik
				ORDER BY
					parpol.id_partai_politik DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_partai_politik" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_partai_politik" => $id]);
    }
}
