<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class PeninggalanSejarah extends CI_Model
{
    private $_table = "konsos_peninggalan_sejarah";

    public $id_peninggalan_sejarah;

    public function get()
    {
		$sql = "SELECT DISTINCT
					sejarah.*,
					satker.nama_satker,
					geografi.*,
					pengelola.nama AS pengelola
				FROM
					konsos_peninggalan_sejarah AS sejarah
					JOIN org_satker AS satker
					ON sejarah.id_satker = satker.id_satker
					JOIN mst_pengelola AS pengelola
					ON sejarah.id_pengelola = pengelola.id_pengelola
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
					sejarah.id_geografi = geografi.id_provinsi OR
					sejarah.id_geografi = geografi.id_kabupaten OR
					sejarah.id_geografi = geografi.id_kecamatan OR
					sejarah.id_geografi = geografi.id_kelurahan
				WHERE
					sejarah.is_active = 1 
				GROUP BY
					sejarah.id_peninggalan_sejarah
				ORDER BY
					sejarah.id_peninggalan_sejarah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('sejarah.*,
		satker.nama_satker,
		geografi.*,
		pengelola.nama AS pengelola');
		$this->db->from('konsos_peninggalan_sejarah AS sejarah');
		$this->db->join('org_satker AS satker','sejarah.id_satker = satker.id_satker');
		$this->db->join('mst_pengelola AS pengelola','sejarah.id_pengelola = pengelola.id_pengelola');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','sejarah.id_geografi = geografi.id_provinsi OR
			sejarah.id_geografi = geografi.id_kabupaten OR
			sejarah.id_geografi = geografi.id_kecamatan OR
			sejarah.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('sejarah.id_satker', $request['satker']);
			}
		}
		$this->db->where('sejarah.is_active',1);
		$this->db->group_by('sejarah.id_peninggalan_sejarah');
		$this->db->order_by('sejarah.id_peninggalan_sejarah','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('sejarah.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		pengelola.nama AS pengelola,
		user1.nama_pegawai,
		DATE_FORMAT(sejarah.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_peninggalan_sejarah AS sejarah');
		$this->db->join('org_satker AS satker','sejarah.id_satker = satker.id_satker');
		$this->db->join('mst_pengelola AS pengelola','sejarah.id_pengelola = pengelola.id_pengelola');
		$this->db->join('org_geografi AS geografi','sejarah.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','sejarah.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('sejarah.id_satker', $request['satker']);
			}
		}
		$this->db->where('sejarah.is_active',1);
		$this->db->group_by('sejarah.id_peninggalan_sejarah');
		$this->db->order_by('sejarah.id_peninggalan_sejarah','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('sejarah.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		pengelola.nama AS pengelola,
		user1.nama_pegawai,
		DATE_FORMAT(sejarah.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('konsos_peninggalan_sejarah AS sejarah');
		$this->db->join('org_satker AS satker','sejarah.id_satker = satker.id_satker');
		$this->db->join('mst_pengelola AS pengelola','sejarah.id_pengelola = pengelola.id_pengelola');
		$this->db->join('org_geografi AS geografi','sejarah.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','sejarah.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('sejarah.id_satker', $id);
		}
		$this->db->where('sejarah.is_active',1);
		$this->db->group_by('sejarah.id_peninggalan_sejarah');
		$this->db->order_by('sejarah.id_peninggalan_sejarah','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					sejarah.*,
					satker.nama_satker,
					geografi.*,
					pengelola.nama AS pengelola
				FROM
					konsos_peninggalan_sejarah AS sejarah
					JOIN org_satker AS satker
					ON sejarah.id_satker = satker.id_satker
					JOIN mst_pengelola AS pengelola
					ON sejarah.id_pengelola = pengelola.id_pengelola
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
					sejarah.id_geografi = geografi.id_provinsi OR
					sejarah.id_geografi = geografi.id_kabupaten OR
					sejarah.id_geografi = geografi.id_kecamatan OR
					sejarah.id_geografi = geografi.id_kelurahan
				WHERE
					sejarah.is_active = 1 AND
					sejarah.id_peninggalan_sejarah = $id
				GROUP BY
					sejarah.id_peninggalan_sejarah
				ORDER BY
					sejarah.id_peninggalan_sejarah DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					sejarah.*,
					satker.nama_satker,
					geografi.*,
					pengelola.nama AS pengelola
				FROM
					konsos_peninggalan_sejarah AS sejarah
					JOIN org_satker AS satker
					ON sejarah.id_satker = satker.id_satker
					JOIN mst_pengelola AS pengelola
					ON sejarah.id_pengelola = pengelola.id_pengelola
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
					sejarah.id_geografi = geografi.id_provinsi OR
					sejarah.id_geografi = geografi.id_kabupaten OR
					sejarah.id_geografi = geografi.id_kecamatan OR
					sejarah.id_geografi = geografi.id_kelurahan
				WHERE
					sejarah.is_active = 1 AND
					sejarah.id_satker = $id
				GROUP BY
					sejarah.id_peninggalan_sejarah
				ORDER BY
					sejarah.id_peninggalan_sejarah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					sejarah.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					pengelola.nama AS pengelola
				FROM
					konsos_peninggalan_sejarah AS sejarah
					JOIN org_satker AS satker
					ON sejarah.id_satker = satker.id_satker
					JOIN mst_pengelola AS pengelola
					ON sejarah.id_pengelola = pengelola.id_pengelola
					LEFT JOIN org_geografi AS geografi ON sejarah.id_geografi = geografi.id_geografi
				WHERE
					sejarah.is_active = 1 AND
					sejarah.id_satker = $id
				GROUP BY
					sejarah.id_peninggalan_sejarah
				ORDER BY
					sejarah.id_peninggalan_sejarah DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_peninggalan_sejarah" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_peninggalan_sejarah" => $id]);
    }
}
