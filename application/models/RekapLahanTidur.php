<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class RekapLahanTidur extends CI_Model
{
    private $_table = "rekap_lahan_tidur";

    public $id_lahan_tidur;

    public function all($request = null)
    {
		$this->db->select('lahantidur.*,SUM(lahantidur.luas_total) AS total,SUM(lahantidur.digarap) AS budidaya, SUM(lahantidur.lahan_tidur) AS lahan,satker.nama_satker,
		GEOGRAFI.PROVINSI, 
		GEOGRAFI.KABUPATEN, 
		GEOGRAFI.KECAMATAN, 
		GEOGRAFI.KELURAHAN,
		user1.nama_pegawai,
		DATE_FORMAT(lahantidur.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from("$this->_table AS lahantidur");
		$this->db->join('org_satker as satker','lahantidur.id_satker = satker.id_satker');
		$this->db->join('mst_user AS user1','lahantidur.updated_by = user1.id_user','left');
		$this->db->join('
			(SELECT DISTINCT
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
				KEL.id_geografi_parent = KEC.id_geografi) AS GEOGRAFI','lahantidur.id_geografi = GEOGRAFI.id_provinsi OR
				lahantidur.id_geografi = GEOGRAFI.id_kabupaten OR
				lahantidur.id_geografi = GEOGRAFI.id_kecamatan OR
				lahantidur.id_geografi = GEOGRAFI.id_kelurahan','left');
        $this->db->where('lahantidur.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('lahantidur.id_satker', $request['satker']);
			}
		}
		$this->db->group_by('lahantidur.id_lahan_tidur');
		$this->db->order_by('lahantidur.id_lahan_tidur', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }

	public function getExport($id)
    {
		$this->db->select('lahantidur.*,SUM(lahantidur.luas_total) AS total,SUM(lahantidur.digarap) AS budidaya, SUM(lahantidur.lahan_tidur) AS lahan,satker.nama_satker,
		GEOGRAFI.nama as wilayah,
		user1.nama_pegawai,
		DATE_FORMAT(lahantidur.updated_date, "%d/%m/%Y") as LastUpdated');
		$this->db->from("$this->_table AS lahantidur");
		$this->db->join('org_satker as satker','lahantidur.id_satker = satker.id_satker');
		$this->db->join('mst_user AS user1','lahantidur.updated_by = user1.id_user','left');
		$this->db->join('org_geografi AS GEOGRAFI','lahantidur.id_geografi = GEOGRAFI.id_geografi','left');
        $this->db->where('lahantidur.is_active',1);
		
		if ($id != 0) {
			$this->db->where('lahantidur.id_satker', $id);
		}

		$this->db->group_by('lahantidur.id_lahan_tidur');
		$this->db->order_by('lahantidur.id_lahan_tidur', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }

	public function summaryByParentSatker($kotama = null, $satker = null)
    {
		$this->db->select('
			SUM(lahantidur.luas_total) AS sum_luas_total, 
			SUM(lahantidur.digarap) AS sum_digarap, 
			SUM(lahantidur.lahan_tidur) AS sum_lahan_tidur
			');
		$this->db->from("$this->_table AS lahantidur");
		$this->db->where('lahantidur.is_active',1);
		
		$parent_satker = '';
		if($satker) {
			$parent_satker = $satker;
		} else if ($kotama) {
			$parent_satker = $kotama;
		}
		if ( $parent_satker ) {
			$satker_id_by_parent = satker_id_by_parent($parent_satker);
			$this->db->join("
			(
				$satker_id_by_parent
			) AS satker_tree",
			'satker_tree.id_satker = lahantidur.id_satker',
			'inner'
			);
		}

		$query = $this->db->get();

		return $query->row();
	}
	
	public function byParentSatker($kotama = null, $satker = null)
    {
		$this->db->select('lahantidur.*, satker.nama_satker');
		$this->db->from("$this->_table AS lahantidur");
        $this->db->join('org_satker as satker','lahantidur.id_satker = satker.id_satker');
		$this->db->where('lahantidur.is_active',1);

		$parent_satker = '';
		if($satker) {
			$parent_satker = $satker;
		} else if ($kotama) {
			$parent_satker = $kotama;
		}

		if ( $parent_satker ) {
			$satker_id_by_parent = satker_id_by_parent($parent_satker);
			$this->db->join("
			(
				$satker_id_by_parent
			) AS satker_tree",
			'satker_tree.id_satker = lahantidur.id_satker',
			'inner'
			);	
		}

		$this->db->order_by('lahantidur.id_lahan_tidur', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }

    public function get($request = null)
    {
		$this->db->select('lahantidur.*,SUM(lahantidur.luas_total) AS total,SUM(lahantidur.digarap) AS budidaya, SUM(lahantidur.lahan_tidur) AS lahan,satker.nama_satker');
		$this->db->from("$this->_table AS lahantidur");
        $this->db->join('org_satker as satker','lahantidur.id_satker = satker.id_satker');
        $this->db->where('lahantidur.is_active',1);
		if ($request) {
			if($request['satker']) {
				$this->db->where('lahantidur.id_satker', $request['satker']);
			} else if ( $request['kotama'] ) {
				$this->db->where('lahantidur.id_satker', $request['kotama']);
			}
		}
		$this->db->order_by('lahantidur.id_lahan_tidur', 'DESC');
		$query = $this->db->get();

		return $query->result();
    }
    
    public function find($id)
    {
		$sql = "SELECT DISTINCT
		lahantidur.*,
		geografi.*
	FROM
		rekap_lahan_tidur AS lahantidur
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
		lahantidur.id_geografi = geografi.id_provinsi OR
		lahantidur.id_geografi = geografi.id_kabupaten OR
		lahantidur.id_geografi = geografi.id_kecamatan OR
		lahantidur.id_geografi = geografi.id_kelurahan
	WHERE
		lahantidur.is_active = 1 AND
		lahantidur.id_lahan_tidur = $id
	GROUP BY
		lahantidur.id_lahan_tidur";
		$query = $this->db->query($sql);
		
		return $query->row();

        // return $this->db->get_where($this->_table, ["id_lahan_tidur" => $id,"is_active" => 1])->row();
    }

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_lahan_tidur" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table,['is_active' => FALSE], ["id_lahan_tidur" => $id]);
    }
}
