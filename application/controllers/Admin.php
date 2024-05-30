<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// public function index()
	// {
	// 	$this->load->view('login');
	// }

	public function index()
	{
			$this->data['title'] = 'Dashboard';
			$data['isi'] = $this->load->view('dashboard/dash1', $this->data, true);
			$this->load->view('skin/layout', $data);
	}

	public function masterdata_hutan()
	{
			$this->data['title'] = 'Masterdata Hutan';
			$data['isi'] = $this->load->view('masterdata/hutan', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	
}
