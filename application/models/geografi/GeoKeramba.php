<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class GeoKeramba extends CI_Model
{
    private $_table = "geo_keramba_jaring";

    public $id_keramba;

    public function get()
    {
		$sql = "SELECT DISTINCT
					keramba.*,
					satker.nama_satker,
					geografi.*,
					jenis_ikan.nama AS jenis_ikan
				FROM
					geo_keramba_jaring AS keramba
					JOIN org_satker AS satker
					ON keramba.id_satker = satker.id_satker
					JOIN mst_jenis_ikan AS jenis_ikan
					ON keramba.id_jenis_ikan = jenis_ikan.id_jenis_ikan
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
					keramba.id_geografi = geografi.id_provinsi OR
					keramba.id_geografi = geografi.id_kabupaten OR
					keramba.id_geografi = geografi.id_kecamatan OR
					keramba.id_geografi = geografi.id_kelurahan
				WHERE
					keramba.is_active = 1 
				GROUP BY
					keramba.id_keramba
				ORDER BY
					keramba.id_keramba DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function list($request = null)
    {
		$this->db->select('keramba.*,
		satker.nama_satker,
		geografi.*,
		jenis_ikan.nama AS jenis_ikan');
		$this->db->from('geo_keramba_jaring AS keramba');
		$this->db->join('org_satker AS satker','keramba.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_ikan AS jenis_ikan','keramba.id_jenis_ikan = jenis_ikan.id_jenis_ikan');
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
			KEL.id_geografi_parent = KEC.id_geografi) AS geografi','keramba.id_geografi = geografi.id_provinsi OR
			keramba.id_geografi = geografi.id_kabupaten OR
			keramba.id_geografi = geografi.id_kecamatan OR
			keramba.id_geografi = geografi.id_kelurahan');
		if ($request) {
			if($request['satker']) {
				$this->db->where('keramba.id_satker', $request['satker']);
			}
		}
		$this->db->where('keramba.is_active',1);
		$this->db->group_by('keramba.id_keramba');
		$this->db->order_by('keramba.id_keramba','DESC');
			
		return $this->db->get()->result();
    }
	
	public function getdataForDatatable($request = null)
    {
		$this->db->select('keramba.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_ikan.nama AS jenis_ikan,
		user1.nama_pegawai,
		DATE_FORMAT(keramba.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_keramba_jaring AS keramba');
		$this->db->join('org_satker AS satker','keramba.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_ikan AS jenis_ikan','keramba.id_jenis_ikan = jenis_ikan.id_jenis_ikan');
		$this->db->join('org_geografi AS geografi','keramba.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','keramba.updated_by = user1.id_user','left');
		if ($request) {
			if($request['satker']) {
				$this->db->where('keramba.id_satker', $request['satker']);
			}
		}
		$this->db->where('keramba.is_active',1);
		$this->db->group_by('keramba.id_keramba');
		$this->db->order_by('keramba.id_keramba','DESC');
			
		return $this->db->get()->result();
	}
	
	public function getExport($id)
    {
		$this->db->select('keramba.*,
		satker.nama_satker,
		geografi.nama as wilayah,
		geografi.*,
		jenis_ikan.nama AS jenis_ikan,
		user1.nama_pegawai,
		DATE_FORMAT(keramba.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from('geo_keramba_jaring AS keramba');
		$this->db->join('org_satker AS satker','keramba.id_satker = satker.id_satker');
		$this->db->join('mst_jenis_ikan AS jenis_ikan','keramba.id_jenis_ikan = jenis_ikan.id_jenis_ikan');
		$this->db->join('org_geografi AS geografi','keramba.id_geografi = geografi.id_geografi');
		$this->db->join('mst_user AS user1','keramba.updated_by = user1.id_user','left');
		if ($id != 0) {
			$this->db->where('keramba.id_satker', $id);
		}
		$this->db->where('keramba.is_active',1);
		$this->db->group_by('keramba.id_keramba');
		$this->db->order_by('keramba.id_keramba','DESC');
			
		return $this->db->get()->result();
    }

    public function find($id)
    {
		$sql = "SELECT DISTINCT
					keramba.*,
					satker.nama_satker,
					geografi.*,
					jenis_ikan.nama AS jenis_ikan
				FROM
					geo_keramba_jaring AS keramba
					JOIN org_satker AS satker
					ON keramba.id_satker = satker.id_satker
					JOIN mst_jenis_ikan AS jenis_ikan
					ON keramba.id_jenis_ikan = jenis_ikan.id_jenis_ikan
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
					keramba.id_geografi = geografi.id_provinsi OR
					keramba.id_geografi = geografi.id_kabupaten OR
					keramba.id_geografi = geografi.id_kecamatan OR
					keramba.id_geografi = geografi.id_kelurahan
				WHERE
					keramba.is_active = 1 AND
					keramba.id_keramba = $id
				GROUP BY
					keramba.id_keramba
				ORDER BY
					keramba.id_keramba DESC";

		$query = $this->db->query($sql);
			
		return $query->row();
    }

    public function getBySatker($id)
    {
		$sql = "SELECT DISTINCT
					keramba.*,
					satker.nama_satker,
					geografi.*,
					jenis_ikan.nama AS jenis_ikan
				FROM
					geo_keramba_jaring AS keramba
					JOIN org_satker AS satker
					ON keramba.id_satker = satker.id_satker
					JOIN mst_jenis_ikan AS jenis_ikan
					ON keramba.id_jenis_ikan = jenis_ikan.id_jenis_ikan
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
					keramba.id_geografi = geografi.id_provinsi OR
					keramba.id_geografi = geografi.id_kabupaten OR
					keramba.id_geografi = geografi.id_kecamatan OR
					keramba.id_geografi = geografi.id_kelurahan
				WHERE
					keramba.is_active = 1 AND
					keramba.id_satker = $id
				GROUP BY
					keramba.id_keramba
				ORDER BY
					keramba.id_keramba DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
	}
	
	public function getBySatkernew($id)
    {
		$sql = "SELECT DISTINCT
					keramba.*,
					satker.nama_satker,
					geografi.*,
					geografi.nama as PROVINSI,
					jenis_ikan.nama AS jenis_ikan
				FROM
					geo_keramba_jaring AS keramba
					JOIN org_satker AS satker
					ON keramba.id_satker = satker.id_satker
					JOIN mst_jenis_ikan AS jenis_ikan
					ON keramba.id_jenis_ikan = jenis_ikan.id_jenis_ikan
					LEFT JOIN org_geografi AS geografi ON keramba.id_geografi = geografi.id_geografi
				WHERE
					keramba.is_active = 1 AND
					keramba.id_satker = $id
				GROUP BY
					keramba.id_keramba
				ORDER BY
					keramba.id_keramba DESC";

		$query = $this->db->query($sql);
			
		return $query->result();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_keramba" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_keramba" => $id]);
    }
}
