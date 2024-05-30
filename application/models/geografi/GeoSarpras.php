<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoSarpras extends CI_Model
{
    private $_table = "geo_sarpras_jalan";

    public $id_sarpras;

    public function get()
    {
		$sql = "SELECT DISTINCT
					sarpras.*,
					satker.nama_satker,
					geografi.*,
					kelas_admpemerintah.nama AS kelas_admpemerintah,
					kelas_bebanmuatan.nama AS kelas_bebanmuatan
				FROM
					geo_sarpras_jalan AS sarpras
					JOIN org_satker AS satker
					ON sarpras.id_satker = satker.id_satker
					JOIN mst_kelas_admpemerintah AS kelas_admpemerintah
					ON sarpras.id_kelas_admpemerintah = kelas_admpemerintah.id_kelas_admpemerintah
					JOIN mst_kelas_bebanmuatan AS kelas_bebanmuatan
					ON sarpras.id_kelas_bebanmuatan = kelas_bebanmuatan.id_kelas_bebanmuatan
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
					sarpras.id_geografi = geografi.id_provinsi OR
					sarpras.id_geografi = geografi.id_kabupaten OR
					sarpras.id_geografi = geografi.id_kecamatan OR
					sarpras.id_geografi = geografi.id_kelurahan
				WHERE
					sarpras.is_active = 1 
				GROUP BY
					sarpras.id_sarpras
				ORDER BY
					sarpras.id_sarpras DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('sarpras.*,
		satker.nama_satker,
		geografi.*,
		kelas_admpemerintah.nama AS kelas_admpemerintah,
		kelas_bebanmuatan.nama AS kelas_bebanmuatan');
		$this->db->from('geo_sarpras_jalan AS sarpras');
		$this->db->join('org_satker AS satker','sarpras.id_satker = satker.id_satker');
		$this->db->join('mst_kelas_admpemerintah AS kelas_admpemerintah','sarpras.id_kelas_admpemerintah = kelas_admpemerintah.id_kelas_admpemerintah');
		$this->db->join('mst_kelas_bebanmuatan AS kelas_bebanmuatan','sarpras.id_kelas_bebanmuatan = kelas_bebanmuatan.id_kelas_bebanmuatan');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','sarpras.id_geografi = geografi.id_provinsi OR
			sarpras.id_geografi = geografi.id_kabupaten OR
			sarpras.id_geografi = geografi.id_kecamatan OR
			sarpras.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('sarpras.id_satker', $request['satker']);
			}
		}
		$this->db->where('sarpras.is_active',1);
		$this->db->group_by('sarpras.id_sarpras');
		$this->db->order_by('sarpras.id_sarpras','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('sarpras.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		kelas_admpemerintah.nama AS kelas_admpemerintah,
		kelas_bebanmuatan.nama AS kelas_bebanmuatan,
		user1.nama_pegawai,
		DATE_FORMAT(sarpras.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_sarpras_jalan AS sarpras');
		$this->db->join('org_satker AS satker','sarpras.id_satker = satker.id_satker');
		$this->db->join('mst_kelas_admpemerintah AS kelas_admpemerintah','sarpras.id_kelas_admpemerintah = kelas_admpemerintah.id_kelas_admpemerintah');
		$this->db->join('mst_kelas_bebanmuatan AS kelas_bebanmuatan','sarpras.id_kelas_bebanmuatan = kelas_bebanmuatan.id_kelas_bebanmuatan');
		$this->db->join('org_geografi AS geografi','sarpras.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','sarpras.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('sarpras.id_satker', $request['satker']);
			}
		}
		$this->db->where('sarpras.is_active',1);
		$this->db->group_by('sarpras.id_sarpras');
		$this->db->order_by('sarpras.id_sarpras','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('sarpras.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		kelas_admpemerintah.nama AS kelas_admpemerintah,
		kelas_bebanmuatan.nama AS kelas_bebanmuatan,
		user1.nama_pegawai,
		DATE_FORMAT(sarpras.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_sarpras_jalan AS sarpras');
		$this->db->join('org_satker AS satker','sarpras.id_satker = satker.id_satker');
		$this->db->join('mst_kelas_admpemerintah AS kelas_admpemerintah','sarpras.id_kelas_admpemerintah = kelas_admpemerintah.id_kelas_admpemerintah');
		$this->db->join('mst_kelas_bebanmuatan AS kelas_bebanmuatan','sarpras.id_kelas_bebanmuatan = kelas_bebanmuatan.id_kelas_bebanmuatan');
		$this->db->join('org_geografi AS geografi','sarpras.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','sarpras.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('sarpras.id_satker', $id);
		}
		$this->db->where('sarpras.is_active',1);
		$this->db->group_by('sarpras.id_sarpras');
		$this->db->order_by('sarpras.id_sarpras','DESC');
			
		return $this->db->get()->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
					sarpras.*,
					satker.nama_satker,
					geografi.*,
					kelas_admpemerintah.nama AS kelas_admpemerintah,
					kelas_bebanmuatan.nama AS kelas_bebanmuatan
				FROM
					geo_sarpras_jalan AS sarpras
					JOIN org_satker AS satker
					ON sarpras.id_satker = satker.id_satker
					JOIN mst_kelas_admpemerintah AS kelas_admpemerintah
					ON sarpras.id_kelas_admpemerintah = kelas_admpemerintah.id_kelas_admpemerintah
					JOIN mst_kelas_bebanmuatan AS kelas_bebanmuatan
					ON sarpras.id_kelas_bebanmuatan = kelas_bebanmuatan.id_kelas_bebanmuatan
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
					sarpras.id_geografi = geografi.id_provinsi OR
					sarpras.id_geografi = geografi.id_kabupaten OR
					sarpras.id_geografi = geografi.id_kecamatan OR
					sarpras.id_geografi = geografi.id_kelurahan
				WHERE
					sarpras.is_active = 1 AND
					sarpras.id_sarpras = $id
				GROUP BY
					sarpras.id_sarpras
				ORDER BY
					sarpras.id_sarpras DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					sarpras.*,
					satker.nama_satker,
					geografi.*,
					kelas_admpemerintah.nama AS kelas_admpemerintah,
					kelas_bebanmuatan.nama AS kelas_bebanmuatan
				FROM
					geo_sarpras_jalan AS sarpras
					JOIN org_satker AS satker
					ON sarpras.id_satker = satker.id_satker
					JOIN mst_kelas_admpemerintah AS kelas_admpemerintah
					ON sarpras.id_kelas_admpemerintah = kelas_admpemerintah.id_kelas_admpemerintah
					JOIN mst_kelas_bebanmuatan AS kelas_bebanmuatan
					ON sarpras.id_kelas_bebanmuatan = kelas_bebanmuatan.id_kelas_bebanmuatan
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
					sarpras.id_geografi = geografi.id_provinsi OR
					sarpras.id_geografi = geografi.id_kabupaten OR
					sarpras.id_geografi = geografi.id_kecamatan OR
					sarpras.id_geografi = geografi.id_kelurahan
				WHERE
					sarpras.is_active = 1 AND
					sarpras.id_satker = $id
				GROUP BY
					sarpras.id_sarpras
				ORDER BY
					sarpras.id_sarpras DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					sarpras.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					kelas_admpemerintah.nama AS kelas_admpemerintah,
					kelas_bebanmuatan.nama AS kelas_bebanmuatan
				FROM
					geo_sarpras_jalan AS sarpras
					JOIN org_satker AS satker
					ON sarpras.id_satker = satker.id_satker
					JOIN mst_kelas_admpemerintah AS kelas_admpemerintah
					ON sarpras.id_kelas_admpemerintah = kelas_admpemerintah.id_kelas_admpemerintah
					JOIN mst_kelas_bebanmuatan AS kelas_bebanmuatan
					ON sarpras.id_kelas_bebanmuatan = kelas_bebanmuatan.id_kelas_bebanmuatan
					LEFT JOIN org_geografi AS geografi ON sarpras.id_geografi = geografi.id_geografi
				WHERE
					sarpras.is_active = 1 AND
					sarpras.id_satker = $id
				GROUP BY
					sarpras.id_sarpras
				ORDER BY
					sarpras.id_sarpras DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }


    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_sarpras" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_sarpras" => $id]);
    }
}
