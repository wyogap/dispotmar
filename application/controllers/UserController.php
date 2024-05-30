<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('User','user');
		$this->load->model('Role','role');
		$this->load->model('SatuanKerja','satker');
	}

	public function index()
	{
		if (!policy('USERMAN','read_all')) show_404();

		$this->data['title'] = 'User Management';
		$this->data['users'] = $this->user->get();
		$this->data['roles'] = $this->role->get();
		$this->data['satkers'] = $this->satker->get();

		$data['isi'] = $this->load->view('user/index', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('USERMAN','update')) show_404();

		$this->data['user'] = $this->user->find(decrypt($id));
		echo json_encode($this->data);
	}

	public function store()
    {
		if (!policy('USERMAN','create')) show_404();

		$this->form_validation->set_rules('name','Nama Pegawai','trim|required');
		$this->form_validation->set_rules('pangkat','Pangkat','trim|required');
		$this->form_validation->set_rules('nrp','NRP','trim|required');
		$this->form_validation->set_rules('satker','Satuan Kerja','trim|required');
		$this->form_validation->set_rules('phone','Telepon','trim|required|min_length[10]|max_length[25]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[mst_user.email]|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('username','Username','trim|required|is_unique[mst_user.username]');
		$this->form_validation->set_rules('password', 'Katasandi', 'required|min_length[8]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Katasandi', 'required|min_length[8]|matches[password]');
		$this->form_validation->set_rules('role','Role','trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			// $this->session->set_flashdata('error', 'Data Anda tidak berhasil disimpan, Silahkan cek kembali data yang Anda masukkan.');;
			// redirect_back();
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'name' 		=> form_error('name'),
				'pangkat' 	=> form_error('pangkat'),
				'nrp' 		=> form_error('nrp'),
				'satker' 	=> form_error('satker'),
				'phone' 	=> form_error('phone'),
				'email' 	=> form_error('email'),
				'username' 	=> form_error('username'),
				'password' 	=> form_error('password'),
				'passconf' 	=> form_error('passconf'),
				'role' 		=> form_error('role')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = [
				'nama_pegawai'	=> $this->input->post('name'),
				'pangkat'		=> $this->input->post('pangkat'),
				'nrp'			=> $this->input->post('nrp'),
				'id_satker'		=> $this->input->post('satker'),
				'phone'			=> $this->input->post('phone'),
				'email'			=> $this->input->post('email'),
				'username'		=> $this->input->post('username'),
				'password'		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				//'password'		=> sha1($this->input->post('password')),
				//'password'		=> md5($this->input->post('password')),
				//'password2'		=> $this->input->post('password'),
				'id_role'		=> $this->input->post('role'),
				'photo'			=> $this->user->do_upload(),
				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date("Y-m-d H:i:s")
			];

			if ($this->user->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}

			// if ($this->user->create($data)) {
			// 	$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
			// 	redirect_back();
			// } else {
			// 	$this->session->set_flashdata('error', 'Data anda tidak berhasil disimpan');
			// 	redirect_back();
			// }
		}
    }

	public function update()
    {
		if (!policy('USERMAN','update')) show_404();

		$this->form_validation->set_rules('name','Nama Pegawai','trim|required');
		$this->form_validation->set_rules('pangkat','Pangkat','trim|required');
		$this->form_validation->set_rules('nrp','NRP','trim|required');
		$this->form_validation->set_rules('satker','Satuan Kerja','trim|required');
		$this->form_validation->set_rules('phone','Telepon','trim|required|min_length[10]|max_length[25]');
		//$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[mst_user.email]|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|min_length[3]|max_length[50]');
		//$this->form_validation->set_rules('username','Username','trim|required|is_unique[mst_user.username]');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password', 'Katasandi', 'required|min_length[8]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Katasandi', 'required|min_length[8]|matches[password]');
		$this->form_validation->set_rules('role','Role','trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			// $this->session->set_flashdata('error', 'Data Anda tidak berhasil disimpan, Silahkan cek kembali data yang Anda masukkan.');;
			// redirect_back();
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'name' 		=> form_error('name'),
				'pangkat' 	=> form_error('pangkat'),
				'nrp' 		=> form_error('nrp'),
				'satker' 	=> form_error('satker'),
				'phone' 	=> form_error('phone'),
				'email' 	=> form_error('email'),
				'username' 	=> form_error('username'),
				'password' 	=> form_error('password'),
				'passconf' 	=> form_error('passconf'),
				'role' 		=> form_error('role')
			];
			echo json_encode([$status,$response]);
		}else{
			$notifable = ($this->input->post('notifable') == 1) ? 1 : 0;

			if($this->input->post('photo') == "undefined")
			{
				$data = [
					'nama_pegawai'	=> $this->input->post('name'),
					'pangkat'		=> $this->input->post('pangkat'),
					'nrp'			=> $this->input->post('nrp'),
					'id_satker'		=> $this->input->post('satker'),
					'phone'			=> $this->input->post('phone'),
					'email'			=> $this->input->post('email'),
					'username'		=> $this->input->post('username'),
					'id_role'		=> $this->input->post('role'),
					// 'photo'			=> $this->user->do_upload(),
					'notifable'		=> $notifable,
					'updated_by'	=> $this->session->userdata('id_user'),
					'updated_date'	=> date("Y-m-d H:i:s")
				];
			}
			else if($this->input->post('photo') != "undefined")
			{
				$data = [
					'nama_pegawai'	=> $this->input->post('name'),
					'pangkat'		=> $this->input->post('pangkat'),
					'nrp'			=> $this->input->post('nrp'),
					'id_satker'		=> $this->input->post('satker'),
					'phone'			=> $this->input->post('phone'),
					'email'			=> $this->input->post('email'),
					'username'		=> $this->input->post('username'),
					'id_role'		=> $this->input->post('role'),
					'photo'			=> $this->user->do_upload(),
					'notifable'		=> $notifable,
					'updated_by'	=> $this->session->userdata('id_user'),
					'updated_date'	=> date("Y-m-d H:i:s")
				];
			}

			if ($this->input->post('password') != "TidakEdit" && $this->input->post('passconf') != "TidakEdit") 
			{
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				//$data['password'] = sha1($this->input->post('password'));
				//$data['password'] = md5($this->input->post('password'));
				//$data['password2'] = $this->input->post('password');
			}
			else
			{
				$data['password'] = $this->input->post('pass_old');
			}

			$id = decrypt($this->input->post('id_user'));

			if ($this->user->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}

			// if ($this->user->update($id,$data)) {
			// 	$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
			// 	redirect_back();
			// } else {
			// 	$this->session->set_flashdata('error', 'Data anda tidak berhasil disimpan');
			// 	redirect_back();
			// }
		}
	}
	
	public function notifable()
    {
		if (!policy('USERMAN','update')) show_404();

		$notifable = ($this->input->post('notifable')) ? 1 : 0;
		$data = [
			'notifable'		=> $notifable
		];
		$id = decrypt($this->input->post('id'));

		if ($this->user->update($id,$data)) {
			$this->session->set_flashdata('success', 'Notifikasi berhasil diubah');
			redirect_back();
			// echo json_encode([['status' => 1]]);
		}
	}

	public function delete($id=null)
    {
		if (!policy('USERMAN','delete')) show_404();

        if (!isset($id)) show_404();
        
        if ($this->user->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
        } else {
			$this->session->set_flashdata('error', 'Data telah digunakan, tidak dapat menghapus data');
			redirect_back();
		}
	}
	
	public function edit()
	{
			$this->data['title'] = 'User Edit';
			$data['isi'] = $this->load->view('user/edit', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
}
