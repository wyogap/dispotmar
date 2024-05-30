<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class ProgresPangan extends CI_Model
{
    private $_table = "mst_pangan_progres";

    public $id_progres;

    public function get()
    {
        return $this->db->get($this->_table)->result();
    }
}
