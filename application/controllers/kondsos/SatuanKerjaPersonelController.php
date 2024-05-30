<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SatuanKerjaPersonelController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
	}

	public function index()
	{
		$this->data['title'] = 'Personel Satker';
		$data['isi'] = $this->load->view('organisasi/personel/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

}
