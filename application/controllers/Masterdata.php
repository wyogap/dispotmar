<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterdata extends CI_Controller {

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

	// public function index()
	// {
	// 		$this->data['title'] = 'Dashboard';
	// 		$data['isi'] = $this->load->view('dashboard/dash1', $this->data, true);
	// 		$this->load->view('skin/layout', $data);
	// }

	public function satker()
	{
			$this->data['title'] = 'Masterdata Satker';
			$data['isi'] = $this->load->view('masterdata/satker', $this->data, true);
			$this->load->view('skin/layout', $data);
	}

	public function sda()
	{
			$this->data['title'] = 'Masterdata SDA';
			$data['isi'] = $this->load->view('masterdata/mst_geografi/sda', $this->data, true);
			$this->load->view('skin/layout', $data);
	}

	public function sdab()
	{
			$this->data['title'] = 'Masterdata SDAB';
			$data['isi'] = $this->load->view('masterdata/mst_geografi/sdab', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function sarana()
	{
			$this->data['title'] = 'Masterdata Sarana';
			$data['isi'] = $this->load->view('masterdata/mst_geografi/sarana', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function industri()
	{
			$this->data['title'] = 'Masterdata Industri';
			$data['isi'] = $this->load->view('masterdata/mst_geografi/industri', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	// demografi
	public function jumlahPenduduk()
	{
			$this->data['title'] = 'Masterdata Penduduk';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/jumlahPenduduk', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function agama()
	{
			$this->data['title'] = 'Masterdata Agama';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/agama', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function sukuBangsa()
	{
			$this->data['title'] = 'Masterdata Suku Bangsa';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/sukuBangsa', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function desaPesisir()
	{
			$this->data['title'] = 'Masterdata Desa Pesisir';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/desaPesisir', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function sakaBahari()
	{
			$this->data['title'] = 'Masterdata Saka Bahari';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/sakaBahari', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function pekerjaanMasyarakat()
	{
			$this->data['title'] = 'Masterdata Pekerjaan Masyarakat';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/pekerjaanMasyarakat', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function tingkatPendidikan()
	{
			$this->data['title'] = 'Masterdata Tingkat Pendidikan';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/tingkatPendidikan', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function sekolahMaritim()
	{
			$this->data['title'] = 'Masterdata Sekolah Maritim';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/sekolahMaritim', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function rumahSakit()
	{
			$this->data['title'] = 'Masterdata Rumah Sakit';
			$data['isi'] = $this->load->view('masterdata/mst_demografi/rumahSakit', $this->data, true);
			$this->load->view('skin/layout', $data);
	}

	// mst_kondsos
	public function tkhMasyarakat()
	{
			$this->data['title'] = 'Masterdata Tokoh Masyarakat';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/tkhMasyarakat', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function orgAgama()
	{
			$this->data['title'] = 'Masterdata Organisasi Keagamaan';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/orgAgama', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function orgPolitik()
	{
			$this->data['title'] = 'Masterdata Organisasi Politik';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/orgPolitik', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function orgMassa()
	{
			$this->data['title'] = 'Masterdata Organisasi Massa';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/orgMassa', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function parPol()
	{
			$this->data['title'] = 'Masterdata Partai Politik';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/parPol', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function indUmkm()
	{
			$this->data['title'] = 'Masterdata Industri UMKM';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/indUmkm', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function indMenengah()
	{
			$this->data['title'] = 'Masterdata Industri Menengah ';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/indMenengah', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function objPariwisata()
	{
			$this->data['title'] = 'Masterdata Objek Pariwisata';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/objPariwisata', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function penSejarah()
	{
			$this->data['title'] = 'Masterdata Peninggalan Sejarah';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/penSejarah', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function budaya()
	{
			$this->data['title'] = 'Masterdata Budaya';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/budaya', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	public function insMiliter()
	{
			$this->data['title'] = 'Masterdata Instansi Militer';
			$data['isi'] = $this->load->view('masterdata/mst_kondsos/insMiliter', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
	// mst_satker
	public function satKerja()
	{
			$this->data['title'] = 'Masterdata Profil Satuan Kerja';
			$data['isi'] = $this->load->view('masterdata/mst_satker/satKerja', $this->data, true);
			$this->load->view('skin/layout', $data);
	}	
	public function wilker()
	{
			$this->data['title'] = 'Masterdata Batas Wilayah Kerja';
			$data['isi'] = $this->load->view('masterdata/mst_satker/wilker', $this->data, true);
			$this->load->view('skin/layout', $data);
	}
}
	
