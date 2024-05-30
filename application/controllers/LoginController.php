<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth', 'auth');
	}

	public function index()
	{
		$this->data['title'] = 'Masuk';
		$this->load->view('auth/index', $this->data);
	}

	public function login()
	{
		$data = [
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'fault_date'	=> date('Y-m-d H:i:s')
		];
		
		$this->auth->login($data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success','Anda sudah berhasil keluar dari sistem');
		redirect('login');
	}
}
