<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard10Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		
		$this->load->model('RekapSensor', 'sensor');
	}
	
	public function index()
	{
		$this->data['title'] = 'Sensor';
		
		
		$this->data['CurrentTempTanaman'] = $this->sensor->get_CurrentTempTanaman();
		$this->data['CurrentTempTorrent'] = $this->sensor->get_CurrentTempTorrent();
		$this->data['CurrentTDSTanaman'] = $this->sensor->get_CurrentTDSTanaman();
		$this->data['CurrentTDSTorrent'] = $this->sensor->get_CurrentTDSTorrent();
		$this->data['CurrentPHTanaman'] = $this->sensor->get_CurrentPHTanaman();
		$this->data['CurrentPHTorrent'] = $this->sensor->get_CurrentPHTorrent();

		$data['isi'] = $this->load->view('dashboard/dashboard10', $this->data, true);
		$this->load->view('skin/layout', $data);
	}    
}
