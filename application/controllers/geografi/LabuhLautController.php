<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LabuhLautController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('geografi/GeoPelabuhanLaut', 'pelabuhanLaut');
		$this->load->model('SatuanKerja', 'satker');
		$this->load->model('Geografi','geo');
    }

    public function index()
	{
		$this->data['title'] = 'Geografi - Pelabuhan Laut';

		if (policy('GEO','read')) {
			$this->data['dataPelabuhanLaut'] = $this->pelabuhanLaut->getdataForDatatable(['satker' => $this->session->userdata('id_satker')]);
		}else if (policy('GEO','read_all')){
			$this->data['dataPelabuhanLaut'] = $this->pelabuhanLaut->getdataForDatatable();
		}

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sarpras/pelabuhanLaut/index', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function show($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['title'] = 'Pelabuhan Laut';
		$this->data['pelabuhanLaut'] = $this->pelabuhanLaut->find(decrypt($id));

		$data['isi'] = $this->load->view('geografi/sarpras/pelabuhanLaut/detail', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function store(){
		if (!policy('GEO','create')) show_404();

		$this->form_validation->set_rules('satker', 'satker', 'trim|required');
		$this->form_validation->set_rules('nama_pelabuhan', 'nama pelabuhan', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
		$this->form_validation->set_rules('informasi_umum', 'informasi umum', 'trim|required');
		$this->form_validation->set_rules('hidrografi', 'hidrografi', 'trim|required');
		$this->form_validation->set_rules('topografi', 'topografi', 'trim|required');
		$this->form_validation->set_rules('pasang_surut', 'pasang surut', 'trim|required');
		$this->form_validation->set_rules('arus', 'arus', 'trim|required');
		$this->form_validation->set_rules('iklim_cuaca', 'iklim cuaca', 'trim|required');
		$this->form_validation->set_rules('iklim_penglihatan', 'iklim penglihatan', 'trim|required');
		$this->form_validation->set_rules('iklim_angin', 'iklim angin', 'trim|required');
		$this->form_validation->set_rules('iklim_gelombang', 'iklim gelombang', 'trim|required');
		$this->form_validation->set_rules('iklim_kondisi_klimatologi', 'iklim kondisi klimatologi', 'trim|required');
		$this->form_validation->set_rules('kelas_pelabuhan', 'kelas pelabuhan', 'trim|required');
		$this->form_validation->set_rules('tanda_pengenal', 'tanda pengenal', 'trim|required');
		$this->form_validation->set_rules('alur_masuk_panjang', 'alur masuk panjang', 'trim|required');
		$this->form_validation->set_rules('alur_masuk_luas', 'alur masuk luas', 'trim|required');
		$this->form_validation->set_rules('alur_masuk_kedalaman', 'alur masuk kedalaman', 'trim|required');
		$this->form_validation->set_rules('kolam_luas', 'kolam luas', 'trim|required');
		$this->form_validation->set_rules('kolam_dalam_min', 'kolam dalam min', 'trim|required');
		$this->form_validation->set_rules('kolam_dalam_max', 'kolam dalam max', 'trim|required');
		$this->form_validation->set_rules('ukuran_kapal_panjang', 'ukuran kapal panjang', 'trim|required');
		$this->form_validation->set_rules('ukuran_kapal_draft', 'ukuran kapal draft', 'trim|required');
		$this->form_validation->set_rules('ukuran_kapal_berat', 'ukuran kapal berat', 'trim|required');
		$this->form_validation->set_rules('berlabuh_lokasi', 'berlabuh lokasi', 'trim|required');
		$this->form_validation->set_rules('berlabuh_lokasi_dilarang', 'berlabuh lokasi dilarang', 'trim|required');
		$this->form_validation->set_rules('berlabuh_kedalaman_laut', 'berlabuh kedalaman laut', 'trim|required');
		$this->form_validation->set_rules('berlabuh_jenis_dasar_laut', 'berlabuh jenis dasar laut', 'trim|required');
		$this->form_validation->set_rules('radio_jenis', 'radio jenis', 'trim|required');
		$this->form_validation->set_rules('radio_nama_panggilan', 'radio nama panggilan', 'trim|required');
		$this->form_validation->set_rules('radio_frekuensi', 'radio frekuensi', 'trim|required');
		$this->form_validation->set_rules('radio_kelas_pancaran', 'radio kelas pancaran', 'trim|required');
		$this->form_validation->set_rules('karantina_daerah', 'karantina daerah', 'trim|required');
		$this->form_validation->set_rules('karantina_koordinat', 'karantina koordinat', 'trim|required');
		$this->form_validation->set_rules('kepanduan_apakah_wajib', 'kepanduan apakah wajib', 'trim|required');
		$this->form_validation->set_rules('kepanduan_batas_tonase', 'kepanduan batas tonase', 'trim|required');
		$this->form_validation->set_rules('kepanduan_kapal_tunda', 'kepanduan kapal tunda', 'trim|required');
		$this->form_validation->set_rules('kepanduan_posisi_antarjemput', 'kepanduan posisi antarjemput', 'trim|required');
		$this->form_validation->set_rules('sandar_nama', 'sandar nama', 'trim|required');
		$this->form_validation->set_rules('sandar_panjang', 'sandar panjang', 'trim|required');
		$this->form_validation->set_rules('sandar_lebar', 'sandar lebar', 'trim|required');
		$this->form_validation->set_rules('sandar_kedalaman', 'sandar kedalaman', 'trim|required');
		$this->form_validation->set_rules('sandar_konstruksi', 'sandar konstruksi', 'trim|required');
		$this->form_validation->set_rules('gudang_nama', 'gudang nama', 'trim|required');
		$this->form_validation->set_rules('gudang_luas', 'gudang luas', 'trim|required');
		$this->form_validation->set_rules('gudang_kapasitas', 'gudang kapasitas', 'trim|required');
		$this->form_validation->set_rules('gudang_jumlah', 'gudang jumlah', 'trim|required');
		$this->form_validation->set_rules('terminal_jumlah', 'terminal jumlah', 'trim|required');
		$this->form_validation->set_rules('terminal_ukuran', 'terminal ukuran', 'trim|required');
		$this->form_validation->set_rules('terminal_kapasitas', 'terminal kapasitas', 'trim|required');
		$this->form_validation->set_rules('flag_location', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'nama_pelabuhan'		=> form_error('nama_pelabuhan'),
				'provinsi'		=> form_error('provinsi'),
				'alamat'		=> form_error('alamat'),
				'telepon'		=> form_error('telepon'),
				'informasi_umum'		=> form_error('informasi_umum'),
				'hidrografi'		=> form_error('hidrografi'),
				'topografi'		=> form_error('topografi'),
				'pasang_surut'		=> form_error('pasang_surut'),
				'arus'		=> form_error('arus'),
				'iklim_cuaca'		=> form_error('iklim_cuaca'),
				'iklim_penglihatan'		=> form_error('iklim_penglihatan'),
				'iklim_angin'		=> form_error('iklim_angin'),
				'iklim_gelombang'		=> form_error('iklim_gelombang'),
				'iklim_kondisi_klimatologi'		=> form_error('iklim_kondisi_klimatologi'),
				'kelas_pelabuhan'		=> form_error('kelas_pelabuhan'),
				'tanda_pengenal'		=> form_error('tanda_pengenal'),
				'alur_masuk_panjang'		=> form_error('alur_masuk_panjang'),
				'alur_masuk_luas'		=> form_error('alur_masuk_luas'),
				'alur_masuk_kedalaman'		=> form_error('alur_masuk_kedalaman'),
				'kolam_luas'		=> form_error('kolam_luas'),
				'kolam_dalam_min'		=> form_error('kolam_dalam_min'),
				'kolam_dalam_max'		=> form_error('kolam_dalam_max'),
				'ukuran_kapal_panjang'		=> form_error('ukuran_kapal_panjang'),
				'ukuran_kapal_draft'		=> form_error('ukuran_kapal_draft'),
				'ukuran_kapal_berat'		=> form_error('ukuran_kapal_berat'),
				'berlabuh_lokasi'		=> form_error('berlabuh_lokasi'),
				'berlabuh_lokasi_dilarang'		=> form_error('berlabuh_lokasi_dilarang'),
				'berlabuh_kedalaman_laut'		=> form_error('berlabuh_kedalaman_laut'),
				'berlabuh_jenis_dasar_laut'		=> form_error('berlabuh_jenis_dasar_laut'),
				'radio_jenis'		=> form_error('radio_jenis'),
				'radio_nama_panggilan'		=> form_error('radio_nama_panggilan'),
				'radio_frekuensi'		=> form_error('radio_frekuensi'),
				'radio_kelas_pancaran'		=> form_error('radio_kelas_pancaran'),
				'karantina_daerah'		=> form_error('karantina_daerah'),
				'karantina_koordinat'		=> form_error('karantina_koordinat'),
				'kepanduan_apakah_wajib'		=> form_error('kepanduan_apakah_wajib'),
				'kepanduan_batas_tonase'		=> form_error('kepanduan_batas_tonase'),
				'kepanduan_kapal_tunda'		=> form_error('kepanduan_kapal_tunda'),
				'kepanduan_posisi_antarjemput'		=> form_error('kepanduan_posisi_antarjemput'),
				'sandar_nama'		=> form_error('sandar_nama'),
				'sandar_panjang'		=> form_error('sandar_panjang'),
				'sandar_lebar'		=> form_error('sandar_lebar'),
				'sandar_kedalaman'		=> form_error('sandar_kedalaman'),
				'sandar_konstruksi'		=> form_error('sandar_konstruksi'),
				'gudang_nama'		=> form_error('gudang_nama'),
				'gudang_luas'		=> form_error('gudang_luas'),
				'gudang_kapasitas'		=> form_error('gudang_kapasitas'),
				'gudang_jumlah'		=> form_error('gudang_jumlah'),
				'terminal_jumlah'		=> form_error('terminal_jumlah'),
				'terminal_ukuran'		=> form_error('terminal_ukuran'),
				'terminal_kapasitas'		=> form_error('terminal_kapasitas'),
				'flag_location'		=> form_error('flag_location')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),

				'nama_pelabuhan'	=> $this->input->post('nama_pelabuhan'),
				'alamat'	=> $this->input->post('alamat'),
				'telepon'	=> $this->input->post('telepon'),
				'informasi_umum'	=> $this->input->post('informasi_umum'),
				'hidrografi'	=> $this->input->post('hidrografi'),
				'topografi'	=> $this->input->post('topografi'),
				'pasang_surut'	=> $this->input->post('pasang_surut'),
				'arus'	=> $this->input->post('arus'),
				'iklim_cuaca'	=> $this->input->post('iklim_cuaca'),
				'iklim_penglihatan'	=> $this->input->post('iklim_penglihatan'),
				'iklim_angin'	=> $this->input->post('iklim_angin'),
				'iklim_gelombang'	=> $this->input->post('iklim_gelombang'),
				'iklim_kondisi_klimatologi'	=> $this->input->post('iklim_kondisi_klimatologi'),
				'kelas_pelabuhan'	=> $this->input->post('kelas_pelabuhan'),
				'tanda_pengenal'	=> $this->input->post('tanda_pengenal'),
				'alur_masuk_panjang'	=> $this->input->post('alur_masuk_panjang'),
				'alur_masuk_luas'	=> $this->input->post('alur_masuk_luas'),
				'alur_masuk_kedalaman'	=> $this->input->post('alur_masuk_kedalaman'),
				'kolam_luas'	=> $this->input->post('kolam_luas'),
				'kolam_dalam_min'	=> $this->input->post('kolam_dalam_min'),
				'kolam_dalam_max'	=> $this->input->post('kolam_dalam_max'),
				'ukuran_kapal_panjang'	=> $this->input->post('ukuran_kapal_panjang'),
				'ukuran_kapal_draft'	=> $this->input->post('ukuran_kapal_draft'),
				'ukuran_kapal_berat'	=> $this->input->post('ukuran_kapal_berat'),
				'berlabuh_lokasi'	=> $this->input->post('berlabuh_lokasi'),
				'berlabuh_lokasi_dilarang'	=> $this->input->post('berlabuh_lokasi_dilarang'),
				'berlabuh_kedalaman_laut'	=> $this->input->post('berlabuh_kedalaman_laut'),
				'berlabuh_jenis_dasar_laut'	=> $this->input->post('berlabuh_jenis_dasar_laut'),
				'radio_jenis'	=> $this->input->post('radio_jenis'),
				'radio_nama_panggilan'	=> $this->input->post('radio_nama_panggilan'),
				'radio_frekuensi'	=> $this->input->post('radio_frekuensi'),
				'radio_kelas_pancaran'	=> $this->input->post('radio_kelas_pancaran'),
				'karantina_daerah'	=> $this->input->post('karantina_daerah'),
				'karantina_koordinat'	=> $this->input->post('karantina_koordinat'),
				'kepanduan_apakah_wajib'	=> $this->input->post('kepanduan_apakah_wajib'),
				'kepanduan_batas_tonase'	=> $this->input->post('kepanduan_batas_tonase'),
				'kepanduan_kapal_tunda'	=> $this->input->post('kepanduan_kapal_tunda'),
				'kepanduan_posisi_antarjemput'	=> $this->input->post('kepanduan_posisi_antarjemput'),
				'sandar_nama'	=> $this->input->post('sandar_nama'),
				'sandar_panjang'	=> $this->input->post('sandar_panjang'),
				'sandar_lebar'	=> $this->input->post('sandar_lebar'),
				'sandar_kedalaman'	=> $this->input->post('sandar_kedalaman'),
				'sandar_konstruksi'	=> $this->input->post('sandar_konstruksi'),
				'gudang_nama'	=> $this->input->post('gudang_nama'),
				'gudang_luas'	=> $this->input->post('gudang_luas'),
				'gudang_kapasitas'	=> $this->input->post('gudang_kapasitas'),
				'gudang_jumlah'	=> $this->input->post('gudang_jumlah'),
				'terminal_jumlah'	=> $this->input->post('terminal_jumlah'),
				'terminal_ukuran'	=> $this->input->post('terminal_ukuran'),
				'terminal_kapasitas'	=> $this->input->post('terminal_kapasitas'),
				'flag_location'	=> $this->input->post('flag_location'),

				'is_active'		=> TRUE,
				'created_by'	=> $this->session->userdata('id_user'),
				'created_date'	=> date('Y-m-d H:i:s')
			);

			if ($this->input->post('kelurahan')) {
				$data['id_geografi'] = $this->input->post('kelurahan');
			}else if ($this->input->post('kecamatan')) {
				$data['id_geografi'] = $this->input->post('kecamatan');
			}else if ($this->input->post('kabupaten')) {
				$data['id_geografi'] = $this->input->post('kabupaten');
			}else if ($this->input->post('provinsi')) {
				$data['id_geografi'] = $this->input->post('provinsi');
			}

			if ($this->pelabuhanLaut->create($data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function update(){
		if (!policy('GEO','update')) show_404();

		$this->form_validation->set_rules('satker', 'satker', 'trim|required');
		$this->form_validation->set_rules('nama_pelabuhan', 'nama pelabuhan', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
		$this->form_validation->set_rules('informasi_umum', 'informasi umum', 'trim|required');
		$this->form_validation->set_rules('hidrografi', 'hidrografi', 'trim|required');
		$this->form_validation->set_rules('topografi', 'topografi', 'trim|required');
		$this->form_validation->set_rules('pasang_surut', 'pasang surut', 'trim|required');
		$this->form_validation->set_rules('arus', 'arus', 'trim|required');
		$this->form_validation->set_rules('iklim_cuaca', 'iklim cuaca', 'trim|required');
		$this->form_validation->set_rules('iklim_penglihatan', 'iklim penglihatan', 'trim|required');
		$this->form_validation->set_rules('iklim_angin', 'iklim angin', 'trim|required');
		$this->form_validation->set_rules('iklim_gelombang', 'iklim gelombang', 'trim|required');
		$this->form_validation->set_rules('iklim_kondisi_klimatologi', 'iklim kondisi klimatologi', 'trim|required');
		$this->form_validation->set_rules('kelas_pelabuhan', 'kelas pelabuhan', 'trim|required');
		$this->form_validation->set_rules('tanda_pengenal', 'tanda pengenal', 'trim|required');
		$this->form_validation->set_rules('alur_masuk_panjang', 'alur masuk panjang', 'trim|required');
		$this->form_validation->set_rules('alur_masuk_luas', 'alur masuk luas', 'trim|required');
		$this->form_validation->set_rules('alur_masuk_kedalaman', 'alur masuk kedalaman', 'trim|required');
		$this->form_validation->set_rules('kolam_luas', 'kolam luas', 'trim|required');
		$this->form_validation->set_rules('kolam_dalam_min', 'kolam dalam min', 'trim|required');
		$this->form_validation->set_rules('kolam_dalam_max', 'kolam dalam max', 'trim|required');
		$this->form_validation->set_rules('ukuran_kapal_panjang', 'ukuran kapal panjang', 'trim|required');
		$this->form_validation->set_rules('ukuran_kapal_draft', 'ukuran kapal draft', 'trim|required');
		$this->form_validation->set_rules('ukuran_kapal_berat', 'ukuran kapal berat', 'trim|required');
		$this->form_validation->set_rules('berlabuh_lokasi', 'berlabuh lokasi', 'trim|required');
		$this->form_validation->set_rules('berlabuh_lokasi_dilarang', 'berlabuh lokasi dilarang', 'trim|required');
		$this->form_validation->set_rules('berlabuh_kedalaman_laut', 'berlabuh kedalaman laut', 'trim|required');
		$this->form_validation->set_rules('berlabuh_jenis_dasar_laut', 'berlabuh jenis dasar laut', 'trim|required');
		$this->form_validation->set_rules('radio_jenis', 'radio jenis', 'trim|required');
		$this->form_validation->set_rules('radio_nama_panggilan', 'radio nama panggilan', 'trim|required');
		$this->form_validation->set_rules('radio_frekuensi', 'radio frekuensi', 'trim|required');
		$this->form_validation->set_rules('radio_kelas_pancaran', 'radio kelas pancaran', 'trim|required');
		$this->form_validation->set_rules('karantina_daerah', 'karantina daerah', 'trim|required');
		$this->form_validation->set_rules('karantina_koordinat', 'karantina koordinat', 'trim|required');
		$this->form_validation->set_rules('kepanduan_apakah_wajib', 'kepanduan apakah wajib', 'trim|required');
		$this->form_validation->set_rules('kepanduan_batas_tonase', 'kepanduan batas tonase', 'trim|required');
		$this->form_validation->set_rules('kepanduan_kapal_tunda', 'kepanduan kapal tunda', 'trim|required');
		$this->form_validation->set_rules('kepanduan_posisi_antarjemput', 'kepanduan posisi antarjemput', 'trim|required');
		$this->form_validation->set_rules('sandar_nama', 'sandar nama', 'trim|required');
		$this->form_validation->set_rules('sandar_panjang', 'sandar panjang', 'trim|required');
		$this->form_validation->set_rules('sandar_lebar', 'sandar lebar', 'trim|required');
		$this->form_validation->set_rules('sandar_kedalaman', 'sandar kedalaman', 'trim|required');
		$this->form_validation->set_rules('sandar_konstruksi', 'sandar konstruksi', 'trim|required');
		$this->form_validation->set_rules('gudang_nama', 'gudang nama', 'trim|required');
		$this->form_validation->set_rules('gudang_luas', 'gudang luas', 'trim|required');
		$this->form_validation->set_rules('gudang_kapasitas', 'gudang kapasitas', 'trim|required');
		$this->form_validation->set_rules('gudang_jumlah', 'gudang jumlah', 'trim|required');
		$this->form_validation->set_rules('terminal_jumlah', 'terminal jumlah', 'trim|required');
		$this->form_validation->set_rules('terminal_ukuran', 'terminal ukuran', 'trim|required');
		$this->form_validation->set_rules('terminal_kapasitas', 'terminal kapasitas', 'trim|required');
		$this->form_validation->set_rules('flag_locationedit', 'flag location', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$status = ['status' => 0, 'csrf' => $this->security->get_csrf_hash()];
			$response = [
				'satker'		=> form_error('satker'),
				'nama_pelabuhan'		=> form_error('nama_pelabuhan'),
				'provinsi'		=> form_error('provinsi'),
				'alamat'		=> form_error('alamat'),
				'telepon'		=> form_error('telepon'),
				'informasi_umum'		=> form_error('informasi_umum'),
				'hidrografi'		=> form_error('hidrografi'),
				'topografi'		=> form_error('topografi'),
				'pasang_surut'		=> form_error('pasang_surut'),
				'arus'		=> form_error('arus'),
				'iklim_cuaca'		=> form_error('iklim_cuaca'),
				'iklim_penglihatan'		=> form_error('iklim_penglihatan'),
				'iklim_angin'		=> form_error('iklim_angin'),
				'iklim_gelombang'		=> form_error('iklim_gelombang'),
				'iklim_kondisi_klimatologi'		=> form_error('iklim_kondisi_klimatologi'),
				'kelas_pelabuhan'		=> form_error('kelas_pelabuhan'),
				'tanda_pengenal'		=> form_error('tanda_pengenal'),
				'alur_masuk_panjang'		=> form_error('alur_masuk_panjang'),
				'alur_masuk_luas'		=> form_error('alur_masuk_luas'),
				'alur_masuk_kedalaman'		=> form_error('alur_masuk_kedalaman'),
				'kolam_luas'		=> form_error('kolam_luas'),
				'kolam_dalam_min'		=> form_error('kolam_dalam_min'),
				'kolam_dalam_max'		=> form_error('kolam_dalam_max'),
				'ukuran_kapal_panjang'		=> form_error('ukuran_kapal_panjang'),
				'ukuran_kapal_draft'		=> form_error('ukuran_kapal_draft'),
				'ukuran_kapal_berat'		=> form_error('ukuran_kapal_berat'),
				'berlabuh_lokasi'		=> form_error('berlabuh_lokasi'),
				'berlabuh_lokasi_dilarang'		=> form_error('berlabuh_lokasi_dilarang'),
				'berlabuh_kedalaman_laut'		=> form_error('berlabuh_kedalaman_laut'),
				'berlabuh_jenis_dasar_laut'		=> form_error('berlabuh_jenis_dasar_laut'),
				'radio_jenis'		=> form_error('radio_jenis'),
				'radio_nama_panggilan'		=> form_error('radio_nama_panggilan'),
				'radio_frekuensi'		=> form_error('radio_frekuensi'),
				'radio_kelas_pancaran'		=> form_error('radio_kelas_pancaran'),
				'karantina_daerah'		=> form_error('karantina_daerah'),
				'karantina_koordinat'		=> form_error('karantina_koordinat'),
				'kepanduan_apakah_wajib'		=> form_error('kepanduan_apakah_wajib'),
				'kepanduan_batas_tonase'		=> form_error('kepanduan_batas_tonase'),
				'kepanduan_kapal_tunda'		=> form_error('kepanduan_kapal_tunda'),
				'kepanduan_posisi_antarjemput'		=> form_error('kepanduan_posisi_antarjemput'),
				'sandar_nama'		=> form_error('sandar_nama'),
				'sandar_panjang'		=> form_error('sandar_panjang'),
				'sandar_lebar'		=> form_error('sandar_lebar'),
				'sandar_kedalaman'		=> form_error('sandar_kedalaman'),
				'sandar_konstruksi'		=> form_error('sandar_konstruksi'),
				'gudang_nama'		=> form_error('gudang_nama'),
				'gudang_luas'		=> form_error('gudang_luas'),
				'gudang_kapasitas'		=> form_error('gudang_kapasitas'),
				'gudang_jumlah'		=> form_error('gudang_jumlah'),
				'terminal_jumlah'		=> form_error('terminal_jumlah'),
				'terminal_ukuran'		=> form_error('terminal_ukuran'),
				'terminal_kapasitas'		=> form_error('terminal_kapasitas'),
				'flag_locationedit'		=> form_error('flag_locationedit')
			];
			echo json_encode([$status,$response]);
		}else{
			$data = array(
				'id_satker'		=> $this->input->post('satker'),

				'nama_pelabuhan'	=> $this->input->post('nama_pelabuhan'),
				'alamat'	=> $this->input->post('alamat'),
				'telepon'	=> $this->input->post('telepon'),
				'informasi_umum'	=> $this->input->post('informasi_umum'),
				'hidrografi'	=> $this->input->post('hidrografi'),
				'topografi'	=> $this->input->post('topografi'),
				'pasang_surut'	=> $this->input->post('pasang_surut'),
				'arus'	=> $this->input->post('arus'),
				'iklim_cuaca'	=> $this->input->post('iklim_cuaca'),
				'iklim_penglihatan'	=> $this->input->post('iklim_penglihatan'),
				'iklim_angin'	=> $this->input->post('iklim_angin'),
				'iklim_gelombang'	=> $this->input->post('iklim_gelombang'),
				'iklim_kondisi_klimatologi'	=> $this->input->post('iklim_kondisi_klimatologi'),
				'kelas_pelabuhan'	=> $this->input->post('kelas_pelabuhan'),
				'tanda_pengenal'	=> $this->input->post('tanda_pengenal'),
				'alur_masuk_panjang'	=> $this->input->post('alur_masuk_panjang'),
				'alur_masuk_luas'	=> $this->input->post('alur_masuk_luas'),
				'alur_masuk_kedalaman'	=> $this->input->post('alur_masuk_kedalaman'),
				'kolam_luas'	=> $this->input->post('kolam_luas'),
				'kolam_dalam_min'	=> $this->input->post('kolam_dalam_min'),
				'kolam_dalam_max'	=> $this->input->post('kolam_dalam_max'),
				'ukuran_kapal_panjang'	=> $this->input->post('ukuran_kapal_panjang'),
				'ukuran_kapal_draft'	=> $this->input->post('ukuran_kapal_draft'),
				'ukuran_kapal_berat'	=> $this->input->post('ukuran_kapal_berat'),
				'berlabuh_lokasi'	=> $this->input->post('berlabuh_lokasi'),
				'berlabuh_lokasi_dilarang'	=> $this->input->post('berlabuh_lokasi_dilarang'),
				'berlabuh_kedalaman_laut'	=> $this->input->post('berlabuh_kedalaman_laut'),
				'berlabuh_jenis_dasar_laut'	=> $this->input->post('berlabuh_jenis_dasar_laut'),
				'radio_jenis'	=> $this->input->post('radio_jenis'),
				'radio_nama_panggilan'	=> $this->input->post('radio_nama_panggilan'),
				'radio_frekuensi'	=> $this->input->post('radio_frekuensi'),
				'radio_kelas_pancaran'	=> $this->input->post('radio_kelas_pancaran'),
				'karantina_daerah'	=> $this->input->post('karantina_daerah'),
				'karantina_koordinat'	=> $this->input->post('karantina_koordinat'),
				'kepanduan_apakah_wajib'	=> $this->input->post('kepanduan_apakah_wajib'),
				'kepanduan_batas_tonase'	=> $this->input->post('kepanduan_batas_tonase'),
				'kepanduan_kapal_tunda'	=> $this->input->post('kepanduan_kapal_tunda'),
				'kepanduan_posisi_antarjemput'	=> $this->input->post('kepanduan_posisi_antarjemput'),
				'sandar_nama'	=> $this->input->post('sandar_nama'),
				'sandar_panjang'	=> $this->input->post('sandar_panjang'),
				'sandar_lebar'	=> $this->input->post('sandar_lebar'),
				'sandar_kedalaman'	=> $this->input->post('sandar_kedalaman'),
				'sandar_konstruksi'	=> $this->input->post('sandar_konstruksi'),
				'gudang_nama'	=> $this->input->post('gudang_nama'),
				'gudang_luas'	=> $this->input->post('gudang_luas'),
				'gudang_kapasitas'	=> $this->input->post('gudang_kapasitas'),
				'gudang_jumlah'	=> $this->input->post('gudang_jumlah'),
				'terminal_jumlah'	=> $this->input->post('terminal_jumlah'),
				'terminal_ukuran'	=> $this->input->post('terminal_ukuran'),
				'terminal_kapasitas'	=> $this->input->post('terminal_kapasitas'),
				'flag_location'	=> $this->input->post('flag_locationedit'),
				'updated_by'	=> $this->session->userdata('id_user'),
				'updated_date'	=> date('Y-m-d H:i:s')
			);

			if ($this->input->post('kelurahan')) {
				$data['id_geografi'] = $this->input->post('kelurahan');
			}else if ($this->input->post('kecamatan')) {
				$data['id_geografi'] = $this->input->post('kecamatan');
			}else if ($this->input->post('kabupaten')) {
				$data['id_geografi'] = $this->input->post('kabupaten');
			}else if ($this->input->post('provinsi')) {
				$data['id_geografi'] = $this->input->post('provinsi');
			}

			$id = decrypt($this->input->post('id'));

			if ($this->pelabuhanLaut->update($id,$data)) {
				$this->session->set_flashdata('success', 'Data anda berhasil disimpan');
				echo json_encode([['status' => 1]]);
			}
		}
	}

	public function delete($id=null)
    {
		if (!policy('GEO','delete')) show_404();

		if (!isset($id)) show_404();

		if ($this->pelabuhanLaut->delete(decrypt($id))) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect_back();
		} else {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus data');
			redirect_back();
		}
	}
	
	public function create()
	{
		if (!policy('GEO','update')) show_404();

		$this->data['title'] = 'Pelabuhan Laut';

		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sarpras/pelabuhanLaut/add', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

	public function edit($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['title'] = 'Pelabuhan Laut';
		$this->data['pelabuhanLaut'] = $this->pelabuhanLaut->find(decrypt($id));
		$this->data['satkers'] = $this->satker->get();
		$this->data['provinsi'] = $this->geo->getLevel(1);

		$data['isi'] = $this->load->view('geografi/sarpras/pelabuhanLaut/edit', $this->data, true);

		$this->load->view('skin/layout', $data);
	}

	public function data($id)
	{
		if (!policy('GEO','update')) show_404();

		$this->data['pelabuhanLaut'] = $this->pelabuhanLaut->find(decrypt($id));
		echo json_encode($this->data);
	}
}
