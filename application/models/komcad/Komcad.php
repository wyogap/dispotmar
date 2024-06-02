<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Komcad extends CI_Model
{
    private $_table = "rekap_komcad";

    public function get($filter = null)
    {
		$this->db->select("a.*");
		$this->db->select("w1.id_geografi as id_kelurahan, w1.nama as nama_kelurahan");
		$this->db->select("w2.id_geografi as id_kecamatan, w2.nama as nama_kecamatan");
		$this->db->select("w3.id_geografi as id_kabupaten, w3.nama as nama_kabupaten");
		$this->db->select("w4.id_geografi as id_provinsi, w4.nama as nama_provinsi");
		$this->db->select("s.nama_satker");
        //$this->db->from("rekap_kbn a");
        $this->db->join("org_geografi w1", "w1.id_geografi=a.id_geografi and w1.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w2", "w2.id_geografi=w1.id_geografi_parent and w2.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w3", "w3.id_geografi=w2.id_geografi_parent and w3.is_active=1", "LEFT OUTER");
        $this->db->join("org_geografi w4", "w4.id_geografi=w3.id_geografi_parent and w4.is_active=1", "LEFT OUTER");
        $this->db->join("org_satker s", "s.id_satker=a.id_satker and s.is_active=1");

        $this->db->where("a.is_active", 1);
        if ($filter != null) {
            $this->db->where($filter);
        }

        $this->db->order_by("a.id_satker, a.id_komcad");

		$query = $this->db->get($this->_table);
			
		return $query->result();
    }

    public function find($id)
    {
        $filter = array(
            "a.id_komcad" => $id
        );

		$result = $this->get($filter);
		if ($result == null)    return null;

		return $result[0];
    }

    public function getBySatker($id)
    {
        $filter = array(
            "a.id_satker" => $id
        );

		return $this->get($filter);
	}
	
    public function create($data)
    {		
        $result = $this->db->insert($this->_table, $data);
        if ($result == null)    return 0;

        return $this->db->last_insert_id();
    }

    public function update($id,$data)
    {
        return $this->db->update($this->_table, $data, ["id_komcad" => $id]);
    }

    public function delete($id)
    {
        return $this->db->update($this->_table, ['is_active' => 0], ["id_komcad" => $id]);
    }
}
