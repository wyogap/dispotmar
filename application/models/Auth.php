<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Auth extends CI_Model
{
	private $_table = "mst_user";

    public $id_user;

    public function login($data)
    {
		$this->db->select('mst_user.*, mst_role.nama_role');
		$this->db->from('mst_user');
		$this->db->join('mst_role','mst_user.id_role = mst_role.id_role');
		$this->db->where('username', $data['username']);
		//$this->db->where('password', sha1($data['password']));
		//$this->db->where('password', md5($data['password']));
		$user = $this->db->get();

		$this->db->select('mst_permission.*,mst_modul.kode_modul');
		$this->db->from('mst_permission');
		$this->db->join('mst_modul','mst_permission.id_modul = mst_modul.id_modul');
		$this->db->where('id_role', $user->row()->id_role);
		$permissions = $this->db->get()->result();

		$perms = [];
		foreach ($permissions as $permission) {
			$perms[$permission->kode_modul] = [
				'create' => $permission->create,
				'read' => $permission->read,
				'read_all' => $permission->read_all,
				'update' => $permission->update,
				'delete' => $permission->delete,
			];
		}

        //var_dump($perms); exit;

		if ($user->num_rows()) 
		{
				//if login success
				if(password_verify($data['password'], $user->row()->password))
				{
					if($user->row()->fault >= 3)
					{
						//reset flag if any fault > 5 mnt
						$dt1 = date_create($user->row()->fault_date);
						$dt2 = date_create($data['fault_date']);
						$Interval_dateFlag = date_diff($dt1, $dt2);
						$min = $Interval_dateFlag->format('%i');
				
						if($min > 5)
						{
							//reset
							$this->db->where_in("username", $data['username']);
							$this->db->update($this->_table, ['fault' => 0, 'fault_date' => null]);

							$userData = [
								'id_user'		=> $user->row()->id_user,
								'nama_pegawai'	=> $user->row()->nama_pegawai,
								'phone'			=> $user->row()->phone,
								'email'			=> $user->row()->email,
								'is_active'		=> $user->row()->is_active,
								'id_satker'		=> $user->row()->id_satker,
								'id_role'		=> $user->row()->id_role,
								'pangkat'		=> $user->row()->pangkat,
								'nrp'			=> $user->row()->nrp,
								'username'		=> $user->row()->username,
								'password'		=> $user->row()->password,
								'photo'			=> $user->row()->photo,
								'created_date'	=> $user->row()->created_date,
								'updated_by'	=> $user->row()->updated_by,
								'updated_date'	=> $user->row()->updated_date,
								'role'			=> $user->row()->nama_role,
								'permissions'	=> $perms,
								'notifable'		=> $user->row()->notifable,
								'logged_in'		=> TRUE,
								];
								$this->session->set_userdata($userData);
								//redirect('form_pelaporan');
								redirect('home');
						}
						else
						{
							$countMin = 5 - $min;
							$alert = 'Silahkan Anda Login '.$countMin.' Menit Kemudian !';
							$this->session->set_flashdata('error', $alert);
							redirect_back();
						}
					}
					else
					{
						//reset
						$this->db->where_in("username", $data['username']);
						$this->db->update($this->_table, ['fault' => 0, 'fault_date' => null]);

						$userData = [
							'id_user'		=> $user->row()->id_user,
							'nama_pegawai'	=> $user->row()->nama_pegawai,
							'phone'			=> $user->row()->phone,
							'email'			=> $user->row()->email,
							'is_active'		=> $user->row()->is_active,
							'id_satker'		=> $user->row()->id_satker,
							'id_role'		=> $user->row()->id_role,
							'pangkat'		=> $user->row()->pangkat,
							'nrp'			=> $user->row()->nrp,
							'username'		=> $user->row()->username,
							'password'		=> $user->row()->password,
							'photo'			=> $user->row()->photo,
							'created_date'	=> $user->row()->created_date,
							'updated_by'	=> $user->row()->updated_by,
							'updated_date'	=> $user->row()->updated_date,
							'role'			=> $user->row()->nama_role,
							'permissions'	=> $perms,
							'notifable'		=> $user->row()->notifable,
							'logged_in'		=> TRUE,
							];
							$this->session->set_userdata($userData);
							//redirect('form_pelaporan');
							redirect('home');
					}
				}
				else
				{
					$countFlag = 0;

					if($user->row()->fault >= 3)
					{
						$dt1 = date_create($user->row()->fault_date);
						$dt2 = date_create($data['fault_date']);
						$Interval_dateFlag = date_diff($dt1, $dt2);
						$min = $Interval_dateFlag->format('%i');
				
						if($min > 5)
						{
							//reset
							$this->db->where_in("username", $data['username']);
							$this->db->update($this->_table, ['fault' => 0, 'fault_date' => null]);

							$countFlag = 1;
							$this->db->where_in("username", $data['username']);
							$this->db->update($this->_table, ['fault' => $countFlag, 'fault_date' => $data['fault_date']]);

							$this->session->set_flashdata('error', 'Gagal Login');
							redirect_back();
						}
						else
						{
							$countMin = 5 - $min;
							$alert = 'Silahkan Anda Login '.$countMin.' Menit Kemudian !';
							$this->session->set_flashdata('error', $alert);
							redirect_back();
						}
					}
					else
					{
						if($user->row()->fault >= 2)
						{
							$countFlag = ($user->row()->fault) + 1;
							$this->db->where_in("username", $data['username']);
							$this->db->update($this->_table, ['fault' => $countFlag, 'fault_date' => $data['fault_date']]);
	
							$this->session->set_flashdata('error', 'Silahkan Anda Login 5 Menit Kemudian !');
							redirect_back();
						}
						else
						{
							$countFlag = ($user->row()->fault) + 1;
							$this->db->where_in("username", $data['username']);
							$this->db->update($this->_table, ['fault' => $countFlag, 'fault_date' => $data['fault_date']]);
	
							$this->session->set_flashdata('error', 'Gagal Login');
							redirect_back();
						}
					}
				}
		}
		else 
		{
			$this->session->set_flashdata('error', 'Gagal Login');
			redirect_back();
		}
	}
}
