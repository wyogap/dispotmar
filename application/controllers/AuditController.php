<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuditController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth', 'auth');
	}

	public function index()
	{
			$this->data['title'] = 'Audit Trail';

			$this->db->select('audit.*,user.nama_pegawai');
			$this->db->join('mst_user AS user','audit.user_id = user.id_user');
			$this->db->from('user_audit_trails AS audit');

			$this->data['audits'] = $this->db->get()->result();

			$data['isi'] = $this->load->view('audit/index', $this->data, true);
			$this->load->view('skin/layout', $data);
	}

	
}
