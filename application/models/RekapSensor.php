<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class RekapSensor extends CI_Model
{
    private $_table = "rekap_sensor";

    public $id;

    public function create($data)
    {		
        return $this->db->insert($this->_table, $data);
    }

    public function get_CurrentTempTanaman()
    {
		$this->db->select('rs.*');
		$this->db->from('rekap_sensor AS rs');
		$this->db->where('rs.category', 'temp');
		$this->db->where('rs.group_th', 1);
        $this->db->order_by('rs.timestamp','DESC');
        $this->db->limit(1);

		return $this->db->get()->row();
    }

    public function get_CurrentTempTorrent()
    {
		$this->db->select('rs.*');
		$this->db->from('rekap_sensor AS rs');
		$this->db->where('rs.category', 'temp');
		$this->db->where('rs.group_th', 0);
        $this->db->order_by('rs.timestamp','DESC');
        $this->db->limit(1);

		return $this->db->get()->row();
    }

    public function get_CurrentTDSTanaman()
    {
		$this->db->select('rs.*');
		$this->db->from('rekap_sensor AS rs');
		$this->db->where('rs.category', 'tds');
		$this->db->where('rs.group_th', 1);
        $this->db->order_by('rs.timestamp','DESC');
        $this->db->limit(1);

		return $this->db->get()->row();
    }

    public function get_CurrentTDSTorrent()
    {
		$this->db->select('rs.*');
		$this->db->from('rekap_sensor AS rs');
		$this->db->where('rs.category', 'tds');
		$this->db->where('rs.group_th', 0);
        $this->db->order_by('rs.timestamp','DESC');
        $this->db->limit(1);

		return $this->db->get()->row();
    }

    public function get_CurrentPHTanaman()
    {
		$this->db->select('rs.*');
		$this->db->from('rekap_sensor AS rs');
		$this->db->where('rs.category', 'ph');
		$this->db->where('rs.group_th', 1);
        $this->db->order_by('rs.timestamp','DESC');
        $this->db->limit(1);

		return $this->db->get()->row();
    }

    public function get_CurrentPHTorrent()
    {
		$this->db->select('rs.*');
		$this->db->from('rekap_sensor AS rs');
		$this->db->where('rs.category', 'ph');
		$this->db->where('rs.group_th', 0);
        $this->db->order_by('rs.timestamp','DESC');
        $this->db->limit(1);

		return $this->db->get()->row();
    }
}
