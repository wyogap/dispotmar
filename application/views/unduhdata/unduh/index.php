<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Export Data</a></li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<div class="row">
		<div class="col-xl-12">
			<div class="card overflow-hidden">
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div id="menus">
										<label class="col-form-label">Pilih Menu :</label>
										<select class="form-control" data-placeholder="Menu" name="Menu" id="Menu">
											<option value=""></option>
											<option value="Menupelaporan">Data Pelaporan Harian</option>
											<option value="Menuketahananpangan">Data Ketahanan Pangan</option>
											<option value="Menugeo">Data Geografi</option>
											<option value="Menudemo">Data Demografi</option>
											<option value="Menukonsos">Data Kondisi Sosial</option>
											<option value="Menusatker">Data Satuan Kerja</option>
											<option value="Menuuser">Data User</option>
										</select>
										<label id="labelrole" style="display:none;"><?= $this->session->userdata('role') ?></label>
										<label id="label_idsatker" style="display:none;"><?= $this->session->userdata('id_satker') ?></label>
									</div>
									<div style="display:none;" id="div_subMenuGeo">
										<label class="col-form-label">Pilih Sub Menu Geografi :</label>
										<select class="form-control" data-placeholder="Menu" name="subMenuGeo" id="subMenuGeo" style="width:100%;">
											<option value=""></option>
											<option value="sda">Data Sumber Daya Alam</option>
											<option value="sdab">Data Sumber Daya Alam Buatan</option>
											<option value="sarpras">Data Sarana Prasarana</option>
											<option value="injasmar">Data Industri Jasa Maritim</option>
										</select>
										<label id="labelrole" style="display:none;"><?= $this->session->userdata('role') ?></label>
										<label id="label_idsatker" style="display:none;"><?= $this->session->userdata('id_satker') ?></label>
									</div>
									<br>
									<div style="display:none;" id="div_kotama">
										<label class="col-form-label">Pilih Kotama :</label>
										<select class="form-control select2-show-search border-bottom-0 br-md-0" data-placeholder="Kotama" name="kotama" id="kotama" style="width:100%;">
											<option value="">Kotama</option>
												<?php foreach($kotama as $kot): ?>
											<option
												<?= $this->input->get('kotama') == $kot->id_satker ? 'selected' : '' ?>
												value="<?= $kot->id_satker ?>"><?= $kot->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<br>
									<div style="display:none;" id="div_satker">
										<label class="col-form-label">Pilih Satker :</label>
										<select class="form-control select2-show-search border-bottom-0 br-md-0" data-placeholder="Satker" name="satker" id="satker" style="width:100%;">
											<option value="">Satker</option>
										</select>
									</div>
									<br>
									<button class="btn btn-warning" style="color:white;" id="hapusfilter" type="submit">Hapus Filter</button>
								</div>
								<div class="col-md-6">
									<div style="display:none;">
										<select multiple="multiple" id="fruit_select" style="width:100%;">
										</select>
									</div>
									<div id="div_MenuLaporanHarian" style="display:none;">
										<select multiple="multiple" id="MenuLaporanHarian" style="width:100%;">
											<option value="datalaporanharian">Data Laporan Harian</option>
											<option value="datajenislaporanharian">Data Jenis Pelaporan</option>
										</select>
									</div>
									<div id="div_Menuketahananpangan" style="display:none;">
										<select multiple="multiple" id="Menuketahananpangan" style="width:100%;">
											<option value="datarekappangan">Data Rekap Pangan</option>
											<option value="datalahantidur">Data Lahan Tidur</option>
											<option value="datakomoditas">Data Komoditas</option>
										</select>
									</div>
									<div id="div_subMenuGeo_sda" style="display:none;">
										<select multiple="multiple" id="subMenuGeo_sda" style="width:100%;">
											<option value="datapantai">Data Pantai</option>
											<option value="datahutan">Data Hutan</option>
											<option value="datagunung">Data Gunung</option>
											<option value="datakerawanan">Data Kerawanan Geografi</option>
											<option value="datahujan">Data Curah Hujan</option>
											<option value="datatanah">Data Struktur Tanah</option>
											<option value="dataair">Data Sumber Air</option>
											<option value="datasungai">Data Sungai</option>
											<option value="datapulau">Data Pulau Terluar</option>
											<option value="datamangrove">Data Rekap Mangrove</option>
										</select>
									</div>
									<div id="div_subMenuGeo_sdab" style="display:none;">
										<select multiple="multiple" id="subMenuGeo_sdab" style="width:100%;">
											<option value="dataperkebunan">Data Perkebunan</option>
											<option value="datapertanian">Data Pertanian</option>
											<option value="datapeternakan">Data Peternakan</option>
											<option value="datapertambangan">Data Pertambangan</option>
											<option value="databudidayaikan">Data Pembudidayaan Ikan</option>
											<option value="datajaringapung">Data Keramba Jaring Apung</option>
											<option value="datakonservasi">Data Konservasi Lingkungan Hidup</option>
											<option value="datalistrik">Data Sumber Listrik</option>
										</select>
									</div>
									<div id="div_subMenuGeo_sarpras" style="display:none;">
										<select multiple="multiple" id="subMenuGeo_sarpras" style="width:100%;">
											<option value="datapelabuhansungai">Data Pelabuhan Sungai</option>
											<option value="datapelabuhanlaut">Data Pelabuhan Laut</option>
											<option value="datapelabuhanikan">Data Pelabuhan Ikan</option>
											<option value="datasapras">Data Sarana Prasarana Jalan</option>
										</select>
									</div>
									<div id="div_subMenuGeo_injasmar" style="display:none;">
										<select multiple="multiple" id="subMenuGeo_injasmar" style="width:100%;">
											<option value="datagalangankapal">Data Galangan Kapal</option>
											<option value="dataindustrimesin">Data Industri Mesin</option>
											<option value="datalautnasional_pelayaran">Data Pelayaran Laut Nasional</option>
											<option value="datalautnasional_ekspedisi">Data Ekspedisi Laut Nasional</option>
											<option value="datashipchandler">Data Ship Chandler</option>
											<option value="dataindustriperikanan">Data Industri Perikanan</option>
										</select>
									</div>
									<div id="div_Menudemografi" style="display:none;">
										<select multiple="multiple" id="Menudemografi" style="width:100%;">
											<option value="datajumlahpenduduk">Data Jumlah Penduduk</option>
											<option value="datademoagama">Data Agama</option>
											<option value="datasukubangsa">Data Suku Bangsa</option>
											<option value="datadesabinaan">Data Desa Binaan</option>
											<option value="datadesapesisir">Data Desa Pesisir</option>
											<option value="datasakabahari">Data Saka Bahari</option>
											<option value="datapekerjaanmasyarakat">Data Pekerjaan Masyarakat</option>
											<option value="datasekolahmaritim">Data Sekolah Maritim</option>
											<option value="datarumahsakit">Data Rumah Sakit</option>
										</select>
									</div>
									<div id="div_Menusatuankerja" style="display:none;">
										<select multiple="multiple" id="Menusatuankerja" style="width:100%;">
											<option value="datasatuankerja">Data Satuan Kerja</option>
											<option value="datasatuankerjapersonel">Data Satuan Kerja Personel</option>
										</select>
									</div>
									<div id="div_Menukonsos" style="display:none;">
										<select multiple="multiple" id="Menukonsos" style="width:100%;">
											<option value="datatokohmasyarakat">Data Tokoh Masyarakat</option>
											<option value="dataorgagama">Data Organisasi Agama</option>
											<option value="dataorgpolitik">Data Organisasi Politik</option>
											<option value="dataorgmasa">Data Organisasi Masa</option>
											<option value="datapartaipolitik">Data Partai Politik</option>
											<option value="dataumkm">Data Industri UMKM</option>
											<option value="dataindustrimenengah">Data Industri Menengah</option>
											<option value="datapariwisata">Data Objek Pariwisata</option>
											<option value="datasejarah">Data Peninggalan Sejarah</option>
											<option value="databudaya">Data Budaya</option>
											<option value="datamiliterpolisi">Data Instansi Militer dan Polisi</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<!-- Blank -->
			<div class="card" style="overflow:auto; display:block;" id="card_blank">
				<div class="card-header">
					<div class="card-title">Export Data</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<label>Pilih Data Terlebih Dahulu ...</label>
				</div>
			</div>

			<!-- Konsos Tokoh Masyarakat -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datatokohmasyarakat">
				<div class="card-header">
					<div class="card-title">Data Tokoh Masyarakat</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datatokohmasyarakat" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Agama</th>
									<th>Nama</th>
									<th>Usia (Tahun)</th>
									<th>Alamat</th>
									<th>Pekerjaan</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Organisasi Agama-->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataorgagama">
				<div class="card-header">
					<div class="card-title">Data Organisasi Agama</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataorgagama" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Nama Organisasi</th>
									<th>Alamat Kantor Pusat</th>
									<th>Agama</th>
									<th>Pemimpin</th>
									<th>Jumlah Anggota (Orang)</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Organisasi Politik -->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataorgpolitik">
				<div class="card-header">
					<div class="card-title">Data Organisasi Politik</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataorgpolitik" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Nama Organisasi</th>
									<th>Alamat Kantor Pusat</th>
									<th>Tertua</th>
									<th>Partai</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Organisasi Masa-->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataorgmasa">
				<div class="card-header">
					<div class="card-title">Data Organisasi Masa</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataorgmasa" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Nama Organisasi</th>
									<th>Alamat Kantor Pusat</th>
									<th>Tertua</th>
									<th>Bidang</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Partai Politik-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapartaipolitik">
				<div class="card-header">
					<div class="card-title">Data Partai Politik</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapartaipolitik" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Partai</th>
									<th>Prosentase (%)</th>
									<th>Dominasi Wilayah</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Industri UMKM-->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataumkm">
				<div class="card-header">
					<div class="card-title">Data Industri UMKM</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataumkm" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Jenis Industri</th>
									<th>Penjualan</th>
									<th>Jumlah Tenaga Kerja (Orang)</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Industri Menengah-->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataindustrimenengah">
				<div class="card-header">
					<div class="card-title">Data Industri Menengah</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataindustrimenengah" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Jenis Industri</th>
									<th>Sumber Bahan Baku</th>
                                	<th>Penjualan</th>
                                	<th>Jumlah Tenaga Kerja (Orang)</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Objek Pariwisata-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapariwisata">
				<div class="card-header">
					<div class="card-title">Data Objek Pariwisata</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapariwisata" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Objek Pariwisata</th>
									<th>Alamat</th>
                                	<th>Pengelola</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Peninggalan Sejarah -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datasejarah">
				<div class="card-header">
					<div class="card-title">Data Peninggalan Sejarah</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datasejarah" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Objek Sejarah</th>
									<th>Titik Koordinat</th>
                                	<th>Pengelola</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Budaya -->
			<div class="card" style="overflow:auto; display:none;" id="dt_databudaya">
				<div class="card-header">
					<div class="card-title">Data Budaya</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="databudaya" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Kebudayaan Asli</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Konsos Instansi Militer dan Polisi-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datamiliterpolisi">
				<div class="card-header">
					<div class="card-title">Data Instansi Militer dan Polisi</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datamiliterpolisi" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Instansi</th>
									<th>Cakupan wilayah</th>
                                	<th>Jumlah Personil</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- Satker Satuan Kerja Personel-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datasatuankerjapersonel">
				<div class="card-header">
					<div class="card-title">Data Satuan Kerja Personel</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datasatuankerjapersonel" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Level</th>
									<th>Perwira</th>
									<th>Bintara</th>
									<th>Tamtama</th>
									<th>Jumlah Personel</th>
									<th>Struktur</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Satker Satuan Kerja-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datasatuankerja">
				<div class="card-header">
					<div class="card-title">Data Satuan Kerja</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datasatuankerja" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Kode Satker</th>
									<th>Parent</th>
									<th>Level</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- User-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datauser">
				<div class="card-header">
					<div class="card-title">Data User</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datauser" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Nama Pegawai</th>
									<th>Pangkat</th>
									<th>NRP</th>
									<th>Jabatan</th>
									<th>Satker</th>
									<th>Telp</th>
									<th>Email</th>
									<th>Username</th>
									<th>Role</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- Laphar - Laporan Harian-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datalaporanharian">
				<div class="card-header">
					<div class="card-title">Data User</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datalaporanharian" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th class="text-center">No</th>
									<th class="text-center">Satker</th>
									<th class="text-center">Jenis</th>
									<th class="text-center">Siapa</th>
									<th class="text-center">Apa</th>
									<th class="text-center">Kapan</th>
									<th class="text-center">Dimana</th>
									<th class="text-center">Mengapa</th>
									<th class="text-center">Bagaimana</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Laphar - Jenis Laporan Harian-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datajenislaporanharian">
				<div class="card-header">
					<div class="card-title">Data User</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datajenislaporanharian" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th style="width:5px;" class="text-center">No</th>
									<th class="text-center">Jenis Pelaporan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- Pangan - Komoditas-->
			<div class="card" style="overflow:auto; display:none;" id="dt_datakomoditas">
				<div class="card-header">
					<div class="card-title">Data Komoditas</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datakomoditas" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th style="width:5px;" class="text-center">No</th>
									<th class="text-center">Cluster</th>
									<th class="text-center">Nama Komoditas</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Pangan - Lahan Tidur -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datalahantidur">
				<div class="card-header">
					<div class="card-title">Data Lahan Tidur</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datalahantidur" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Lokasi</th>
									<th>Luas Total (HA)</th>
									<th>Digarap (HA)</th>
									<th>Lahan Tidur (HA)</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Pangan - Rekap Pangan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datarekappangan">
				<div class="card-header">
					<div class="card-title">Data Rekap Pangan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datarekappangan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Nama Satker</th>
									<th>Cluster</th>
									<th>Komoditas</th>
									<th>Luas Lahan (HA)</th>
									<th>TMT Pelaksanaan</th>
									<th>Estimasi Panen</th>
									<th>Estimasi Hasil</th>
									<th>Satuan Estimasi Hasil</th>
									<th>Jumlah Bibit/Bakalan</th>
									<th>Satuan</th>
									<th>Status Lahan</th>
									<th>Progress</th>
									<th>Lokasi</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- Demo - Jumlah Penduduk -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datajumlahpenduduk">
				<div class="card-header">
					<div class="card-title">Data Jumlah Penduduk</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datajumlahpenduduk" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<tr>
									<td rowspan="2">No</td>
									<td rowspan="2">Satker</td>
									<td rowspan="2">Wilayah</td>
									<td rowspan="2">Jumlah Penduduk (Orang)</td>
									<td colspan="2" class="text-center">Rasio (Orang)</td>
									<td colspan="4" class="text-center">Usia</td>
									<td rowspan="2">Tahun</td>
									<td colspan="2" class="text-center">Angka</td>
									<td colspan="4" class="text-center">Pendidikan</td>
									<td rowspan="2">Keterangan</td>
								</tr>
								<tr>
									<td>Pria</td>
									<td>Wanita</td>
									<td>0-18 (Tahun)</td>
									<td>18-40 (Tahun)</td>
									<td>40-45 (Tahun)</td>
									<td>>55 (Tahun)</td>
									<td>Kelahiran</td>
									<td>Kematian</td>
									<td>SMP</td>
									<td>SMA</td>
									<td>S1</td>
									<td>S2</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Demo - Agama -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datademoagama">
				<div class="card-header">
					<div class="card-title">Data Agama</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datademoagama" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Agama</th>
								<th>%</th>
								<th>Jumlah Tempat Ibadah (Buah)</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Demo - Suku Bangsa -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datasukubangsa">
				<div class="card-header">
					<div class="card-title">Data Suku Bangsa</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datasukubangsa" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Suku</th>
								<th>Persentase (%)</th>
								<th>Ciri Khas</th>
								<th>Bahasa Adat</th>
								<th>Tertua Adat</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Demo - Desa Binaan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datadesabinaan">
				<div class="card-header">
					<div class="card-title">Data Desa Binaan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datadesabinaan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Desa</th>
								<th>Jumlah Penduduk (Orang)</th>
								<th>Tingkat Pendidikan</th>
								<th>Nama Pembina</th>
								<th>Nama Tertua Desa</th>
								<th>Latitude</th>
								<th>Longitude</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Demo - Desa Pesisir -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datadesapesisir">
				<div class="card-header">
					<div class="card-title">Data Desa Pesisir</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datadesapesisir" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Desa</th>
								<th>Jumlah Penduduk (Orang)</th>
								<th>Tingkat Pendidikan</th>
								<th>Nama Pembina</th>
								<th>Nama Tertua Desa</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Demo - Saka Bahari -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datasakabahari">
				<div class="card-header">
					<div class="card-title">Data Saka Bahari</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datasakabahari" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Saka</th>
								<th>Jumlah Anggota Saka</th>
								<th>Sekolah yang Terlibat</th>
								<th>Nama Pembina</th>
								<th>Nomor Gugus Depan</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Demo - Pekerjaan Masyarakat -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapekerjaanmasyarakat">
				<div class="card-header">
					<div class="card-title">Data Pekerjaan Masyarakat</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapekerjaanmasyarakat" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Mayoritas 1</th>
								<th>Mayoritas 2</th>
								<th>Mayoritas 3</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Demo - Sekolah Maritim -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datasekolahmaritim">
				<div class="card-header">
					<div class="card-title">Data Sekolah Maritim</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datasekolahmaritim" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Perguruan Tinggi/SMA Sederajat</th>
								<th>Jumlah Siswa</th>
                                <th>Jumlah Pengajar</th>
                                <th>Kerjasama Dengan Instansi</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Demo - Rumah Sakit -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datarumahsakit">
				<div class="card-header">
					<div class="card-title">Data Rumah Sakit</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datarumahsakit" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama RS</th>
								<th>Jenis RS</th>
                                <th>Kelas RS</th>
                                <th>Penyelenggara RS</th>
                                <th>Alamat RS</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- Geo - Pantai -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapantai">
				<div class="card-header">
					<div class="card-title">Data Pantai</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapantai" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Pantai</th>
                                <th>Jenis Pantai</th>
                                <th>Panjang Pantai (Km)</th>
                                <th>Material Dasar Pantai</th>
                                <th>Ciri Khusus</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Hutan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datahutan">
				<div class="card-header">
					<div class="card-title">Data Hutan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datahutan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Tanaman</th>
                                <th>Luas Hutan (Ha)</th>
                                <th>Status Hutan</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Gunung -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datagunung">
				<div class="card-header">
					<div class="card-title">Data Gunung</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datagunung" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Gunung</th>
                                <th>Tinggi Gunung (Mdpl)</th>
                                <th>Status</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Kerawanan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datakerawanan">
				<div class="card-header">
					<div class="card-title">Data Kerawanan Geografi</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datakerawanan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
									<th>No</th>
									<th>Satker</th>
									<th>Wilayah</th>
									<th>Gempa Tektonik</th>
									<th>Gempa Vulkanik</th>
									<th>Banjir</th>
									<th>Gunung Meletus</th>
									<th>Tsunami</th>
									<th>Kebakaran</th>
									<th>Angin</th>
									<th>Longsor</th>
									<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Curah Hujan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datahujan">
				<div class="card-header">
					<div class="card-title">Data Curah Hujan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datahujan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Suhu Min (°C)</th>
								<th>Suhu Max (°C)</th>
								<th>Kelembapan Udara</th>
								<th>Musim Hujan (Bulan/Th)</th>
								<th>Curah Hujan</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Tanah -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datatanah">
				<div class="card-header">
					<div class="card-title">Data Tanah</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datatanah" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Tanah</th>
                                <th>Kemiringan</th>
                                <th>Pemanfaatan</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Sumber Air -->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataair">
				<div class="card-header">
					<div class="card-title">Data Sumber Air</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataair" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Sumber Air</th>
                                <th>Debit Air</th>
                                <th>Kondisi Air</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Sungai -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datasungai">
				<div class="card-header">
					<div class="card-title">Data Sungai</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datasungai" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Sungai</th>
                                <th>Lebar (m)</th>
                                <th>Panjang (Km)</th>
                                <th>Sumber Sungai</th>
                                <th>Anak Sungai</th>
                                <th>Pemanfaatan</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Pulau Terluar -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapulau">
				<div class="card-header">
					<div class="card-title">Data Pulau Terluar</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapulau" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Pulau</th>
                                <th>Luas Pulau (Ha)</th>
                                <th>Jumlah Penduduk (orang)</th>
                                <th>Jarak Pulau Utama (km)</th>
                                <th>Transportasi</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Mangrove -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datamangrove">
				<div class="card-header">
					<div class="card-title">Data Mangrove</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datamangrove" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Jumlah</th>
								<th>Tanggal Tanam</th>
								<th>Lokasi</th>
								<th>Tanggal Lapor</th>
								<th>Latitude</th>
								<th>Longitude</th>
								<th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- Geo - Perkebunan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataperkebunan">
				<div class="card-header">
					<div class="card-title">Data Perkebunan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataperkebunan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Tanaman</th>
                                <th>Luas (Ha)</th>
                                <th>Tonase Hasil</th>
                                <th>Masa Panen</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Pertanian -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapertanian">
				<div class="card-header">
					<div class="card-title">Data Pertanian</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapertanian" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Tanaman</th>
                                <th>Luas (Ha)</th>
                                <th>Tonase Hasil (Ton)</th>
                                <th>Masa Panen</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Peternakan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapeternakan">
				<div class="card-header">
					<div class="card-title">Data Peternakan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapeternakan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Hewan</th>
                                <th>Luas Daerah (Ha)</th>
                                <th>Tonase Hasil (Ton)</th>
                                <th>Masa Panen</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Pertambangan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapertambangan">
				<div class="card-header">
					<div class="card-title">Data Pertambangan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapertambangan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Bahan Tambang</th>
								<th>Luas Tambang (Ha)</th> <!--tambahan-->
								<th>Tonase Hasil (Ton)</th><!--tambahan-->
								<th>Pemilik</th><!--tambahan-->
                                <th>Teknik Penambangan</th>
                                <th>Penggunaan</th>
                                <th>Jumlah Tenaga Kerja</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Pembudidayaan Ikan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_databudidayaikan">
				<div class="card-header">
					<div class="card-title">Data Pembudidayaan Ikan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="databudidayaikan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Ikan</th>
                                <th>Luas Tambak (Ha)</th>
                                <th>Tonase Hasil (Ton)</th>
                                <th>Masa Panen</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Keramba Jaring Apung -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datajaringapung">
				<div class="card-header">
					<div class="card-title">Data Keramba Jaring Apung</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datajaringapung" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis Ikan</th>
                                <th>Luas (Ha)</th>
                                <th>Tonase (Ton)</th>
                                <th>Penghasilan (Rp)</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Konservasi Lingkungan Hidup -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datakonservasi">
				<div class="card-header">
					<div class="card-title">Data Konservasi Lingkungan Hidup</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datakonservasi" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Jenis yg Dikonservasikan</th>
                                <th>Penanggung Jawab</th>
                                <th>Luas (Ha)</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Konservasi Lingkungan Hidup -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datalistrik">
				<div class="card-header">
					<div class="card-title">Data Sumber Listrik</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datalistrik" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Sumber Listrik</th>
                                <th>Energi Yg Dihasilkan (Kw)</th>
                                <th>Luas Cakupan</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- Geo - Pelabuhan Sungai -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapelabuhansungai">
				<div class="card-header">
					<div class="card-title">Data Pelabuhan Sungai</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapelabuhansungai" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Pelabuhan</th>
                                <th>Nama Sungai</th>
                                <th>Jarak Dari Laut (Km)</th>
                                <th>Pasang Tinggi (m)</th>
                                <th>Surut Rendah (m)</th>
                                <th>Draft Maks (m)</th>
                                <th>Lebar Kapal Maks (m)</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Pelabuhan Laut -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapelabuhanlaut">
				<div class="card-header">
					<div class="card-title">Data Pelabuhan Laut</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapelabuhanlaut" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Pelabuhan</th>
								<th>Alamat</th>
								<th>No Telp</th>
								<th>Informasi Umum</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Pelabuhan Ikan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datapelabuhanikan">
				<div class="card-header">
					<div class="card-title">Data Pelabuhan Ikan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datapelabuhanikan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Pelabuhan</th>
                                <th>Kelas Pelabuhan</th>
                                <th>WPP</th>
                                <th>Status</th>
                                <th>Pengelola</th>
                                <th>Fasilitas</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Sarana Prasarana Jalan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datasapras">
				<div class="card-header">
					<div class="card-title">Data Sarana Prasarana Jalan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datasapras" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Klasifikasi Jalan Sesuai Administrasi Pemerintahan</th>
                                <th>%</th>
                                <th>Klasifikasi Jalan Sesuai Beban Muatan Sumbu</th>
                                <th>%</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>

			<!-- Geo - Galangan Kapal -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datagalangankapal">
				<div class="card-header">
					<div class="card-title">Data Galangan Kapal</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datagalangankapal" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Galangan</th>
                                <th>Pemilik</th>
                                <th>Maks GT</th>
                                <th>Status Kepemilikan</th>
                                <th>Fasilitas</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Industri Mesin -->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataindustrimesin">
				<div class="card-header">
					<div class="card-title">Data Industri Mesin</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataindustrimesin" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Perusahaan</th>
                                <th>Hasil Produksi</th>
                                <th>Besaran Produksi / Bulan</th>
                                <th>Status Kepemilikan</th>
                                <th>Penggunaan Hasil Produksi</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Angkutan Laut Nasional - Pelayaran Rakyat -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datalautnasional_pelayaran">
				<div class="card-header">
					<div class="card-title">Data Angkutan Laut Nasional - Pelayaran Rakyat</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datalautnasional_pelayaran" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Perusahaan</th>
                                <th>Nama kapal</th>
                                <th>GT Kapal</th>
                                <th>Rute</th>
                                <th>Frekuensi Pelayaran (Mil)</th>
                                <th>Maks Daya Angkut Orang</th>
								<th>Maks Daya Angkut Transportasi</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Angkutan Laut Nasional - Ekspedisi Laut -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datalautnasional_ekspedisi">
				<div class="card-header">
					<div class="card-title">Data Angkutan Laut Nasional - Ekspedisi Laut</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datalautnasional_ekspedisi" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Perusahaan</th>
                                <th>Jenis Barang / Muatan</th>
                                <th>Frekuensi Pelayaran</th>
                                <th>Jumlah Kapal</th>
                                <th>GT Kapal</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Ship Chandler -->
			<div class="card" style="overflow:auto; display:none;" id="dt_datashipchandler">
				<div class="card-header">
					<div class="card-title">Data Ship Chandler</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="datashipchandler" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Perusahaan</th>
                                <th>Nama Kapal</th>
                                <th>GT Kapal</th>
                                <th>Fasilitas</th>
								<th>Alamat</th>
								<th>Pemilik</th>
								<th>Data Pemilik</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
			<!-- Geo - Industri Perikanan -->
			<div class="card" style="overflow:auto; display:none;" id="dt_dataindustriperikanan">
				<div class="card-header">
					<div class="card-title">Data Industri Perikanan</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
							<table id="dataindustriperikanan" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
								<thead>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Perusahaan</th>
                                <th>GT Kapal</th>
                                <th>Jumlah Kapal</th>
								<th>Alamat</th>
								<th>Pemilik</th>
								<th>Data Pemilik</th>
								<th>Hasil Produksi (Ton)</th>
								<th>Pemanfaatan</th>
								<th>Omzet (Rp)</th>
                                <th>Keterangan</th>
								</thead>
								<tbody>
								</tbody>
							</table>
							<br>
					</div>
				</div>
			</div>
					
		</div>
	</div>
	<!-- row closed -->
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>

<script>
	$(document).ready(function () {
		$("#Menu").select2();
		$("#subMenuGeo").select2();
		$("#kotama").select2();
		$("#satker").select2();

		var status = "blank";

		$('#hapusfilter').click(function () {
			clear();
			DTclear();
			location.reload();
		});

		$('#Menu').change(function(){ 
			var valuemenu = $(this).val();
			
			clear();

			if(valuemenu == 'Menugeo')
			{
				$("#div_subMenuGeo").css("display", "block");
			}
			else if(valuemenu == 'Menupelaporan')
			{
				$("#div_MenuLaporanHarian").css("display", "block");
			}
			else if(valuemenu == 'Menuketahananpangan')
			{
				$("#div_Menuketahananpangan").css("display", "block");
			}
			else if(valuemenu == 'Menudemo')
			{
				$("#div_Menudemografi").css("display", "block");
			}
			else if(valuemenu == 'Menukonsos')
			{
				$("#div_Menukonsos").css("display", "block");
			}
			else if(valuemenu == 'Menusatker')
			{
				$("#div_Menusatuankerja").css("display", "block");
			}
			else if(valuemenu == 'Menuuser')
			{
				if($('#labelrole').text() != 'Superadmin')
				{
					alert("Maaf anda tidak mendapat akses !")
					location.reload();
				}
				else
				{
					status = "USER";
					DTclear();
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "block");
					$("#div_satker").css("display", "block");
					$("#card_blank").css("display", "none");

					$("#dt_datauser").css("display", "block");
					getdatauser(0);
				}
			}
			else
			{
				clear();
			}
		}); 

		$('#subMenuGeo').change(function(){ 
			var valuemenu = $(this).val();
			
			clear();
			$("#div_subMenuGeo").css("display", "block");

			if(valuemenu == 'sda')
			{
				$("#div_subMenuGeo_sda").css("display", "block");
			}
			else if(valuemenu == 'sdab')
			{
				$("#div_subMenuGeo_sdab").css("display", "block");
			}
			else if(valuemenu == 'sarpras')
			{
				$("#div_subMenuGeo_sarpras").css("display", "block");
			}
			else if(valuemenu == 'injasmar')
			{
				$("#div_subMenuGeo_injasmar").css("display", "block");
			}
			else
			{
				clear();
				$("#div_subMenuGeo").css("display", "block");
			}
		}); 

		$("#kotama").change(function() {
			var id= $(this).val();

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/unduhdata_unduh/getdatasatker_bykotama/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){

						filterkotama(id);

						var html = '';
						var i;
						html += '<option value="">Pilih Satker</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_satker+'>'+data[i].nama_satker+'</option>';
						}
						$('#satker').html(html);
					}
				});
				return false;
			} else {
				$('#satker').html('<option value="">Pilih Satker</option>');
			}
		});

		$("#satker").change(function() {
			var id= $(this).val();

			filtersatker(id);
			
		});

		//Laporan Harian
		$('#MenuLaporanHarian').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "LAPHAR";

			if($("#MenuLaporanHarian option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datalaporanharian')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datalaporanharian").css("display", "block");
							getdatalaporanharian(0);
						}
						else if(valuemenu[i] == 'datajenislaporanharian')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datajenislaporanharian").css("display", "block");
							getdatajenislaporanharian(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			
		});

		//Ketahanan Pangan
		$('#Menuketahananpangan').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "PANGAN";

			if($("#Menuketahananpangan option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datarekappangan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datarekappangan").css("display", "block");
							getdatarekappangan(0);
						}
						else if(valuemenu[i] == 'datalahantidur')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datalahantidur").css("display", "block");
							getdatalahantidur(0);
						}
						else if(valuemenu[i] == 'datakomoditas')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datakomoditas").css("display", "block");
							getdatakomoditas(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			
		});

		//Satuan Kerja
		$('#Menusatuankerja').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "SATKER";

			if($("#Menusatuankerja option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datasatuankerjapersonel')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datasatuankerjapersonel").css("display", "block");
							getdatasatuankerjapersonel(0);
						}
						else if(valuemenu[i] == 'datasatuankerja')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datasatuankerja").css("display", "block");
							getdatasatuankerja(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			
		});

		//kondisi sosial
		$('#Menukonsos').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "KONSOS";

			if($("#Menukonsos option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datatokohmasyarakat')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datatokohmasyarakat").css("display", "block");
							getdatatokohmasyarakat(0);
						}
						else if(valuemenu[i] == 'dataorgagama')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataorgagama").css("display", "block");
							getdataorgagama(0);
						}
						else if(valuemenu[i] == 'dataorgpolitik')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataorgpolitik").css("display", "block");
							getdataorgpolitik(0);
						}
						else if(valuemenu[i] == 'dataorgmasa')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataorgmasa").css("display", "block");
							getdataorgmasa(0);
						}
						else if(valuemenu[i] == 'datapartaipolitik')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapartaipolitik").css("display", "block");
							getdatapartaipolitik(0);
						}
						else if(valuemenu[i] == 'dataumkm')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataumkm").css("display", "block");
							getdataumkm(0);
						}
						else if(valuemenu[i] == 'dataindustrimenengah')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataindustrimenengah").css("display", "block");
							getdataindustrimenengah(0);
						}
						else if(valuemenu[i] == 'datapariwisata')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapariwisata").css("display", "block");
							getdatapariwisata(0);
						}
						else if(valuemenu[i] == 'datasejarah')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datasejarah").css("display", "block");
							getdatasejarah(0);
						}
						else if(valuemenu[i] == 'databudaya')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_databudaya").css("display", "block");
							getdatabudaya(0);
						}
						else if(valuemenu[i] == 'datamiliterpolisi')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datamiliterpolisi").css("display", "block");
							getdatamiliterpolisi(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
						
					}
				}
			}
			
		});

		//demografi
		$('#Menudemografi').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "DEMO";

			if($("#Menudemografi option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datajumlahpenduduk')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datajumlahpenduduk").css("display", "block");
							getdatajumlahpenduduk(0);
						}
						else if(valuemenu[i] == 'datademoagama')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datademoagama").css("display", "block");
							getdatademoagama(0);
						}
						else if(valuemenu[i] == 'datasukubangsa')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datasukubangsa").css("display", "block");
							getdatasukubangsa(0);
						}
						else if(valuemenu[i] == 'datadesabinaan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datadesabinaan").css("display", "block");
							getdatadesabinaan(0);
						}
						else if(valuemenu[i] == 'datadesapesisir')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datadesapesisir").css("display", "block");
							getdatadesapesisir(0);
						}
						else if(valuemenu[i] == 'datasakabahari')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datasakabahari").css("display", "block");
							getdatasakabahari(0);
						}
						else if(valuemenu[i] == 'datapekerjaanmasyarakat')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapekerjaanmasyarakat").css("display", "block");
							getdatapekerjaanmasyarakat(0);
						}
						else if(valuemenu[i] == 'datasekolahmaritim')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datasekolahmaritim").css("display", "block");
							getdatasekolahmaritim(0);
						}
						else if(valuemenu[i] == 'datarumahsakit')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datarumahsakit").css("display", "block");
							getdatarumahsakit(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
						
					}
				}
			}
			
		});

		//geo sda
		$('#subMenuGeo_sda').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "GEO_SDA";

			if($("#subMenuGeo_sda option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datapantai')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapantai").css("display", "block");
							getdatapantai(0);
						}
						else if(valuemenu[i] == 'datahutan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datahutan").css("display", "block");
							getdatahutan(0);
						}
						else if(valuemenu[i] == 'datagunung')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datagunung").css("display", "block");
							getdatagunung(0);
						}
						else if(valuemenu[i] == 'datakerawanan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datakerawanan").css("display", "block");
							getdatakerawanan(0);
						}
						else if(valuemenu[i] == 'datahujan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datahujan").css("display", "block");
							getdatahujan(0);
						}
						else if(valuemenu[i] == 'datatanah')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datatanah").css("display", "block");
							getdatatanah(0);
						}
						else if(valuemenu[i] == 'dataair')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataair").css("display", "block");
							getdataair(0);
						}
						else if(valuemenu[i] == 'datasungai')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datasungai").css("display", "block");
							getdatasungai(0);
						}
						else if(valuemenu[i] == 'datapulau')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapulau").css("display", "block");
							getdatapulau(0);
						}
						else if(valuemenu[i] == 'datamangrove')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datamangrove").css("display", "block");
							getdatamangrove(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
						
					}
				}
			}
			
		});

		//geo sdab
		$('#subMenuGeo_sdab').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "GEO_SDAB";

			if($("#subMenuGeo_sdab option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'dataperkebunan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataperkebunan").css("display", "block");
							getdataperkebunan(0);
						}
						else if(valuemenu[i] == 'datapertanian')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapertanian").css("display", "block");
							getdatapertanian(0);
						}
						else if(valuemenu[i] == 'datapeternakan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapeternakan").css("display", "block");
							getdatapeternakan(0);
						}
						else if(valuemenu[i] == 'datapertambangan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapertambangan").css("display", "block");
							getdatapertambangan(0);
						}
						else if(valuemenu[i] == 'databudidayaikan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_databudidayaikan").css("display", "block");
							getdatabudidayaikan(0);
						}
						else if(valuemenu[i] == 'datajaringapung')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datajaringapung").css("display", "block");
							getdatajaringapung(0);
						}
						else if(valuemenu[i] == 'datakonservasi')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datakonservasi").css("display", "block");
							getdatakonservasi(0);
						}
						else if(valuemenu[i] == 'datalistrik')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datalistrik").css("display", "block");
							getdatalistrik(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
						
					}
				}
			}
			
		});

		//geo sarpras
		$('#subMenuGeo_sarpras').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "GEO_SARPRAS";

			if($("#subMenuGeo_sarpras option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datapelabuhansungai')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapelabuhansungai").css("display", "block");
							getdatapelabuhansungai(0);
						}
						else if(valuemenu[i] == 'datapelabuhanlaut')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapelabuhanlaut").css("display", "block");
							getdatapelabuhanlaut(0);
						}
						else if(valuemenu[i] == 'datapelabuhanikan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datapelabuhanikan").css("display", "block");
							getdatapelabuhanikan(0);
						}
						else if(valuemenu[i] == 'datasapras')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datasapras").css("display", "block");
							getdatasapras(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
						
					}
				}
			}
			
		});

		//geo injasmar
		$('#subMenuGeo_injasmar').change(function(){ 
			var valuemenu = [];
			valuemenu = $(this).val();
			status = "";
			status = "GEO_INJASMAR";

			if($("#subMenuGeo_injasmar option:selected").length > 5) 
			{
				alert("Maaf maksimal hanya bisa 5 data, filter otomatis akan dihapus !");
				location.reload();
			}
			else
			{
				if(valuemenu == "")
				{
					$('#kotama').val('').trigger('change');
					$("#div_kotama").css("display", "none");
					$("#div_satker").css("display", "none");
					DTclear();
				}
				else
				{
					DTclear();
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datagalangankapal')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datagalangankapal").css("display", "block");
							getdatagalangankapal(0);
						}
						else if(valuemenu[i] == 'dataindustrimesin')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataindustrimesin").css("display", "block");
							getdataindustrimesin(0);
						}
						else if(valuemenu[i] == 'datalautnasional_pelayaran')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datalautnasional_pelayaran").css("display", "block");
							getdatalautnasional_pelayaran(0);
						}
						else if(valuemenu[i] == 'datalautnasional_ekspedisi')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datalautnasional_ekspedisi").css("display", "block");
							getdatalautnasional_ekspedisi(0);
						}
						else if(valuemenu[i] == 'datashipchandler')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_datashipchandler").css("display", "block");
							getdatashipchandler(0);
						}
						else if(valuemenu[i] == 'dataindustriperikanan')
						{
							$('#kotama').val('').trigger('change');
							$("#div_kotama").css("display", "block");
							$("#div_satker").css("display", "block");
							$("#card_blank").css("display", "none");

							$("#dt_dataindustriperikanan").css("display", "block");
							getdataindustriperikanan(0);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
						
					}
				}
			}
			
		});
		
		function clear()
		{
			$("#div_subMenuGeo").css("display", "none");
			$("#div_MenuLaporanHarian").css("display", "none");
			$("#div_Menuketahananpangan").css("display", "none");
			$("#div_subMenuGeo_sda").css("display", "none");
			$("#div_subMenuGeo_sdab").css("display", "none");
			$("#div_subMenuGeo_sarpras").css("display", "none");
			$("#div_subMenuGeo_injasmar").css("display", "none");
			$("#div_Menudemografi").css("display", "none");
			$("#div_Menukonsos").css("display", "none");
			$("#div_Menusatuankerja").css("display", "none");
			$("#div_kotama").css("display", "none");
			$("#div_satker").css("display", "none");
			
			//kotama
			$('#kotama').val('').trigger('change');

			$('#Menukonsos').val('').trigger('change');
			$('#Menusatuankerja').val('').trigger('change');
			$('#MenuLaporanHarian').val('').trigger('change');
			$('#Menuketahananpangan').val('').trigger('change');
			$('#Menudemografi').val('').trigger('change');
			$('#subMenuGeo_sda').val('').trigger('change');
			$('#subMenuGeo_sdab').val('').trigger('change');
			$('#subMenuGeo_sarpras').val('').trigger('change');
			$('#subMenuGeo_injasmar').val('').trigger('change');
		}

		function DTclear()
		{
			//datatable
			$("#dt_datalaporanharian").css("display", "none");
			$("#dt_datajenislaporanharian").css("display", "none");
			$("#dt_datakomoditas").css("display", "none");
			$("#dt_datalahantidur").css("display", "none");
			$("#dt_datarekappangan").css("display", "none");
			$("#dt_datauser").css("display", "none");
			$("#dt_datasatuankerjapersonel").css("display", "none");
			$("#dt_datasatuankerja").css("display", "none");
			$("#dt_datatokohmasyarakat").css("display", "none");
			$("#dt_dataorgagama").css("display", "none");
			$("#dt_dataorgpolitik").css("display", "none");
			$("#dt_dataorgmasa").css("display", "none");
			$("#dt_datapartaipolitik").css("display", "none");
			$("#dt_dataumkm").css("display", "none");
			$("#dt_dataindustrimenengah").css("display", "none");
			$("#dt_datapariwisata").css("display", "none");
			$("#dt_datasejarah").css("display", "none");
			$("#dt_databudaya").css("display", "none");
			$("#dt_datamiliterpolisi").css("display", "none");
			$("#dt_datajumlahpenduduk").css("display", "none");
			$("#dt_datademoagama").css("display", "none");
			$("#dt_datasukubangsa").css("display", "none");
			$("#dt_datadesabinaan").css("display", "none");
			$("#dt_datadesapesisir").css("display", "none");
			$("#dt_datasakabahari").css("display", "none");
			$("#dt_datapekerjaanmasyarakat").css("display", "none");
			$("#dt_datasekolahmaritim").css("display", "none");
			$("#dt_datarumahsakit").css("display", "none");

			$("#dt_datapantai").css("display", "none");
			$("#dt_datahutan").css("display", "none");
			$("#dt_datagunung").css("display", "none");
			$("#dt_datakerawanan").css("display", "none");
			$("#dt_datahujan").css("display", "none");
			$("#dt_datatanah").css("display", "none");
			$("#dt_dataair").css("display", "none");
			$("#dt_datasungai").css("display", "none");
			$("#dt_datapulau").css("display", "none");
			$("#dt_datamangrove").css("display", "none");
			
			$("#dt_dataperkebunan").css("display", "none");
			$("#dt_datapertanian").css("display", "none");
			$("#dt_datapeternakan").css("display", "none");
			$("#dt_datapertambangan").css("display", "none");
			$("#dt_databudidayaikan").css("display", "none");
			$("#dt_datajaringapung").css("display", "none");
			$("#dt_datakonservasi").css("display", "none");
			$("#dt_datalistrik").css("display", "none");
			
			$("#dt_datapelabuhansungai").css("display", "none");
			$("#dt_datapelabuhanlaut").css("display", "none");
			$("#dt_datapelabuhanikan").css("display", "none");
			$("#dt_datasapras").css("display", "none");

			$("#dt_datagalangankapal").css("display", "none");
			$("#dt_dataindustrimesin").css("display", "none");
			$("#dt_datalautnasional_pelayaran").css("display", "none");
			$("#dt_datalautnasional_ekspedisi").css("display", "none");
			$("#dt_datashipchandler").css("display", "none");
			$("#dt_dataindustriperikanan").css("display", "none");
		}

		function filterkotama(id)
		{
			var valuemenu = [];

			if(status == "KONSOS")
			{
				valuemenu = $('#Menukonsos').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datatokohmasyarakat')
						{
							getdatatokohmasyarakat(id);
						}
						else if(valuemenu[i] == 'dataorgagama')
						{
							getdataorgagama(id);
						}
						else if(valuemenu[i] == 'dataorgpolitik')
						{
							getdataorgpolitik(id);
						}
						else if(valuemenu[i] == 'dataorgmasa')
						{
							getdataorgmasa(id);
						}
						else if(valuemenu[i] == 'datapartaipolitik')
						{
							getdatapartaipolitik(id);
						}
						else if(valuemenu[i] == 'dataumkm')
						{
							getdataumkm(id);
						}
						else if(valuemenu[i] == 'dataindustrimenengah')
						{
							getdataindustrimenengah(id);
						}
						else if(valuemenu[i] == 'datapariwisata')
						{
							getdatapariwisata(id);
						}
						else if(valuemenu[i] == 'datasejarah')
						{
							getdatasejarah(id);
						}
						else if(valuemenu[i] == 'databudaya')
						{
							getdatabudaya(id);
						}
						else if(valuemenu[i] == 'datamiliterpolisi')
						{
							getdatamiliterpolisi(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "SATKER")
			{
				valuemenu = $('#Menusatuankerja').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datasatuankerjapersonel')
						{
							getdatasatuankerjapersonel(id);
						}
						else if(valuemenu[i] == 'datasatuankerja')
						{
							getdatasatuankerja(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "LAPHAR")
			{
				valuemenu = $('#MenuLaporanHarian').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datalaporanharian')
						{
							getdatalaporanharian(id);
						}
						else if(valuemenu[i] == 'datajenislaporanharian')
						{
							getdatajenislaporanharian();
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "PANGAN")
			{
				valuemenu = $('#Menuketahananpangan').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datarekappangan')
						{
							getdatarekappangan(id);
						}
						else if(valuemenu[i] == 'datalahantidur')
						{
							getdatalahantidur(id);
						}
						else if(valuemenu[i] == 'datakomoditas')
						{
							getdatakomoditas();
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "DEMO")
			{
				valuemenu = $('#Menudemografi').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datajumlahpenduduk')
						{
							getdatajumlahpenduduk(id);
						}
						else if(valuemenu[i] == 'datademoagama')
						{
							getdatademoagama(id);
						}
						else if(valuemenu[i] == 'datasukubangsa')
						{
							getdatasukubangsa(id);
						}
						else if(valuemenu[i] == 'datadesabinaan')
						{
							getdatadesabinaan(id);
						}
						else if(valuemenu[i] == 'datadesapesisir')
						{
							getdatadesapesisir(id);
						}
						else if(valuemenu[i] == 'datasakabahari')
						{
							getdatasakabahari(id);
						}
						else if(valuemenu[i] == 'datapekerjaanmasyarakat')
						{
							getdatapekerjaanmasyarakat(id);
						}
						else if(valuemenu[i] == 'datasekolahmaritim')
						{
							getdatasekolahmaritim(id);
						}
						else if(valuemenu[i] == 'datarumahsakit')
						{
							getdatarumahsakit(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "GEO_SDA")
			{
				valuemenu = $('#subMenuGeo_sda').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datapantai')
						{
							getdatapantai(id);
						}
						else if(valuemenu[i] == 'datahutan')
						{
							getdatahutan(id);
						}
						else if(valuemenu[i] == 'datagunung')
						{
							getdatagunung(id);
						}
						else if(valuemenu[i] == 'datakerawanan')
						{
							getdatakerawanan(id);
						}
						else if(valuemenu[i] == 'datahujan')
						{
							getdatahujan(id);
						}
						else if(valuemenu[i] == 'datatanah')
						{
							getdatatanah(id);
						}
						else if(valuemenu[i] == 'dataair')
						{
							getdataair(id);
						}
						else if(valuemenu[i] == 'datasungai')
						{
							getdatasungai(id);
						}
						else if(valuemenu[i] == 'datapulau')
						{
							getdatapulau(id);
						}
						else if(valuemenu[i] == 'datamangrove')
						{
							getdatamangrove(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "GEO_SDAB")
			{
				valuemenu = $('#subMenuGeo_sdab').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'dataperkebunan')
						{
							getdataperkebunan(id);
						}
						else if(valuemenu[i] == 'datapertanian')
						{
							getdatapertanian(id);
						}
						else if(valuemenu[i] == 'datapeternakan')
						{
							getdatapeternakan(id);
						}
						else if(valuemenu[i] == 'datapertambangan')
						{
							getdatapertambangan(id);
						}
						else if(valuemenu[i] == 'databudidayaikan')
						{
							getdatabudidayaikan(id);
						}
						else if(valuemenu[i] == 'datajaringapung')
						{
							getdatajaringapung(id);
						}
						else if(valuemenu[i] == 'datakonservasi')
						{
							getdatakonservasi(id);
						}
						else if(valuemenu[i] == 'datalistrik')
						{
							getdatalistrik(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "GEO_SARPRAS")
			{
				valuemenu = $('#subMenuGeo_sarpras').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datapelabuhansungai')
						{
							getdatapelabuhansungai(id);
						}
						else if(valuemenu[i] == 'datapelabuhanlaut')
						{
							getdatapelabuhanlaut(id);
						}
						else if(valuemenu[i] == 'datapelabuhanikan')
						{
							getdatapelabuhanikan(id);
						}
						else if(valuemenu[i] == 'datasapras')
						{
							getdatasapras(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "GEO_INJASMAR")
			{
				valuemenu = $('#subMenuGeo_injasmar').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datagalangankapal')
						{
							getdatagalangankapal(id);
						}
						else if(valuemenu[i] == 'dataindustrimesin')
						{
							getdataindustrimesin(id);
						}
						else if(valuemenu[i] == 'datalautnasional_pelayaran')
						{
							getdatalautnasional_pelayaran(id);
						}
						else if(valuemenu[i] == 'datalautnasional_ekspedisi')
						{
							getdatalautnasional_ekspedisi(id);
						}
						else if(valuemenu[i] == 'datashipchandler')
						{
							getdatashipchandler(id);
						}
						else if(valuemenu[i] == 'dataindustriperikanan')
						{
							getdataindustriperikanan(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "USER")
			{
				getdatauser(id);
			}
			else
			{
				//do nothing
			}
		}

		function filtersatker(id)
		{
			var valuemenu = [];

			if(status == "KONSOS")
			{
				valuemenu = $('#Menukonsos').val();
				
				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datatokohmasyarakat')
						{
							getdatatokohmasyarakat(id);
						}
						else if(valuemenu[i] == 'dataorgagama')
						{
							getdataorgagama(id);
						}
						else if(valuemenu[i] == 'dataorgpolitik')
						{
							getdataorgpolitik(id);
						}
						else if(valuemenu[i] == 'dataorgmasa')
						{
							getdataorgmasa(id);
						}
						else if(valuemenu[i] == 'datapartaipolitik')
						{
							getdatapartaipolitik(id);
						}
						else if(valuemenu[i] == 'dataumkm')
						{
							getdataumkm(id);
						}
						else if(valuemenu[i] == 'dataindustrimenengah')
						{
							getdataindustrimenengah(id);
						}
						else if(valuemenu[i] == 'datapariwisata')
						{
							getdatapariwisata(id);
						}
						else if(valuemenu[i] == 'datasejarah')
						{
							getdatasejarah(id);
						}
						else if(valuemenu[i] == 'databudaya')
						{
							getdatabudaya(id);
						}
						else if(valuemenu[i] == 'datamiliterpolisi')
						{
							getdatamiliterpolisi(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "SATKER")
			{
				valuemenu = $('#Menusatuankerja').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datasatuankerjapersonel')
						{
							getdatasatuankerjapersonel(id);
						}
						else if(valuemenu[i] == 'datasatuankerja')
						{
							getdatasatuankerja(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "LAPHAR")
			{
				valuemenu = $('#MenuLaporanHarian').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datalaporanharian')
						{
							getdatalaporanharian(id);
						}
						else if(valuemenu[i] == 'datajenislaporanharian')
						{
							getdatajenislaporanharian();
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "PANGAN")
			{
				valuemenu = $('#Menuketahananpangan').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datarekappangan')
						{
							getdatarekappangan(id);
						}
						else if(valuemenu[i] == 'datalahantidur')
						{
							getdatalahantidur(id);
						}
						else if(valuemenu[i] == 'datakomoditas')
						{
							getdatakomoditas();
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "DEMO")
			{
				valuemenu = $('#Menudemografi').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datajumlahpenduduk')
						{
							getdatajumlahpenduduk(id);
						}
						else if(valuemenu[i] == 'datademoagama')
						{
							getdatademoagama(id);
						}
						else if(valuemenu[i] == 'datasukubangsa')
						{
							getdatasukubangsa(id);
						}
						else if(valuemenu[i] == 'datadesabinaan')
						{
							getdatadesabinaan(id);
						}
						else if(valuemenu[i] == 'datadesapesisir')
						{
							getdatadesapesisir(id);
						}
						else if(valuemenu[i] == 'datasakabahari')
						{
							getdatasakabahari(id);
						}
						else if(valuemenu[i] == 'datapekerjaanmasyarakat')
						{
							getdatapekerjaanmasyarakat(id);
						}
						else if(valuemenu[i] == 'datasekolahmaritim')
						{
							getdatasekolahmaritim(id);
						}
						else if(valuemenu[i] == 'datarumahsakit')
						{
							getdatarumahsakit(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "GEO_SDA")
			{
				valuemenu = $('#subMenuGeo_sda').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datapantai')
						{
							getdatapantai(id);
						}
						else if(valuemenu[i] == 'datahutan')
						{
							getdatahutan(id);
						}
						else if(valuemenu[i] == 'datagunung')
						{
							getdatagunung(id);
						}
						else if(valuemenu[i] == 'datakerawanan')
						{
							getdatakerawanan(id);
						}
						else if(valuemenu[i] == 'datahujan')
						{
							getdatahujan(id);
						}
						else if(valuemenu[i] == 'datatanah')
						{
							getdatatanah(id);
						}
						else if(valuemenu[i] == 'dataair')
						{
							getdataair(id);
						}
						else if(valuemenu[i] == 'datasungai')
						{
							getdatasungai(id);
						}
						else if(valuemenu[i] == 'datapulau')
						{
							getdatapulau(id);
						}
						else if(valuemenu[i] == 'datamangrove')
						{
							getdatamangrove(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "GEO_SDAB")
			{
				valuemenu = $('#subMenuGeo_sdab').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'dataperkebunan')
						{
							getdataperkebunan(id);
						}
						else if(valuemenu[i] == 'datapertanian')
						{
							getdatapertanian(id);
						}
						else if(valuemenu[i] == 'datapeternakan')
						{
							getdatapeternakan(id);
						}
						else if(valuemenu[i] == 'datapertambangan')
						{
							getdatapertambangan(id);
						}
						else if(valuemenu[i] == 'databudidayaikan')
						{
							getdatabudidayaikan(id);
						}
						else if(valuemenu[i] == 'datajaringapung')
						{
							getdatajaringapung(id);
						}
						else if(valuemenu[i] == 'datakonservasi')
						{
							getdatakonservasi(id);
						}
						else if(valuemenu[i] == 'datalistrik')
						{
							getdatalistrik(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "GEO_SARPRAS")
			{
				valuemenu = $('#subMenuGeo_sarpras').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datapelabuhansungai')
						{
							getdatapelabuhansungai(id);
						}
						else if(valuemenu[i] == 'datapelabuhanlaut')
						{
							getdatapelabuhanlaut(id);
						}
						else if(valuemenu[i] == 'datapelabuhanikan')
						{
							getdatapelabuhanikan(id);
						}
						else if(valuemenu[i] == 'datasapras')
						{
							getdatasapras(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "GEO_INJASMAR")
			{
				valuemenu = $('#subMenuGeo_injasmar').val();

				if(valuemenu != "")
				{
					for (var i in valuemenu)
					{
						if(valuemenu[i] == 'datagalangankapal')
						{
							getdatagalangankapal(id);
						}
						else if(valuemenu[i] == 'dataindustrimesin')
						{
							getdataindustrimesin(id);
						}
						else if(valuemenu[i] == 'datalautnasional_pelayaran')
						{
							getdatalautnasional_pelayaran(id);
						}
						else if(valuemenu[i] == 'datalautnasional_ekspedisi')
						{
							getdatalautnasional_ekspedisi(id);
						}
						else if(valuemenu[i] == 'datashipchandler')
						{
							getdatashipchandler(id);
						}
						else if(valuemenu[i] == 'dataindustriperikanan')
						{
							getdataindustriperikanan(id);
						}
						else
						{
							DTclear();
							alert('Data Tidak Ditemukan !');
						}
					}
				}
			}
			else if(status == "USER")
			{
				getdatauser(id);
			}
			else
			{
				//do nothing
			}
		}

		//get data by API and show DT
		//laporan harian
		function getdatalaporanharian(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatalaporanharian/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datalaporanharian').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].nama_jenis,
				data[i].who,
				data[i].what,
				data[i].when,
				data[i].where,
				data[i].why,
				data[i].how
            	]).draw();
				}
			},
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatajenislaporanharian()
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatajenislaporanharian',
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				//console.log(data)
				var counter = 1
				var table = $('#datajenislaporanharian').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_jenis,
            	]).draw();
				}
			},
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		
		//ketahanan pangan
		function getdatakomoditas()
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatakomoditas',
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				//console.log(data)
				var counter = 1
				var table = $('#datakomoditas').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_cluster,
				data[i].nama_komoditas,
            	]).draw();
				}
			},
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatalahantidur(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatalahantidur/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datalahantidur').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].lokasi,
				data[i].luas_total,
				data[i].digarap,
				data[i].lahan_tidur,
				data[i].keterangan
            	]).draw();
				}
			},
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatarekappangan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatarekappangan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datarekappangan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].nama_cluster,
				data[i].nama_komoditas,
				data[i].luas_lahan,
				data[i].tmt_,
				data[i].estimasi_panen_,
				data[i].estimasi_hasil,
				data[i].nama_satuan,
				data[i].jmlbibit,
				data[i].nama_satuan2,
				data[i].nama_statuslahan,
				data[i].nama_progres,
				data[i].PROVINSI,
				data[i].keterangan
            	]).draw();
				}
			},
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		//user
		function getdatauser(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatauser/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datauser').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_pegawai,
				data[i].pangkat,
				data[i].nrp,
				data[i].pangkat,
				data[i].nama_satker,
				data[i].phone,
				data[i].email,
				data[i].username,
				data[i].nama_role
            	]).draw();
				}
			},
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		//satuan kerja
		function getdatasatuankerjapersonel(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatasatuankerjapersonel/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datasatuankerjapersonel').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].level,
				data[i].perwira,
				data[i].bintara,
				data[i].tamtama,
				data[i].jumlah_personel,
				data[i].struktur
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatasatuankerja(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatasatuankerja/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datasatuankerja').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].kode_satker,
				data[i].nama_parent_satker,
				data[i].jenis_organisasi
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		//kondisi sosial
		function getdatatokohmasyarakat(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatatokohmasyarakat/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datatokohmasyarakat').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].agama,
				data[i].nama,
				data[i].usia,
				data[i].alamat,
				data[i].pekerjaan,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdataorgagama(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataorgagama/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataorgagama').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_organisasi,
				data[i].alamat_kantor_pusat,
				data[i].agama,
				data[i].pemimpin,
				data[i].jumlah_anggota,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		
		function getdataorgpolitik(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataorgpolitik/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataorgpolitik').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_organisasi,
				data[i].alamat_kantor_pusat,
				data[i].tertua,
				data[i].partai,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdataorgmasa(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataorgmasa/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataorgmasa').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_organisasi,
				data[i].alamat_kantor_pusat,
				data[i].tertua,
				data[i].bidang,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatapartaipolitik(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapartaipolitik/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapartaipolitik').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].partai,
				data[i].prosentase,
				data[i].dominasi_wilayah,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdataumkm(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataumkm/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataumkm').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_industri,
				data[i].penjualan,
				data[i].jumlah_tenaga_kerja,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdataindustrimenengah(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataindustrimenengah/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataindustrimenengah').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_industri,
				data[i].sumber_bahan_baku,
				data[i].penjualan,
				data[i].jumlah_tenaga_kerja,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatapariwisata(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapariwisata/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapariwisata').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].objek_pariwisata,
				data[i].alamat,
				data[i].Pengelola,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatasejarah(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatasejarah/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datasejarah').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].objek_sejarah,
				data[i].titik_kordinat,
				data[i].pengelola,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatabudaya(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatabudaya/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#databudaya').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].kebudayaan_asli,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		function getdatamiliterpolisi(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatamiliterpolisi/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datamiliterpolisi').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].instansi,
				data[i].cakupan_wilayah,
				data[i].jumlah_personel,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		//demografi
		function getdatajumlahpenduduk(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatajumlahpenduduk/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datajumlahpenduduk').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jumlah_penduduk,
				data[i].jumlah_pria,
				data[i].jumlah_wanita,
				data[i].age0018,
				data[i].age1839,
				data[i].age4045,
				data[i].age55high,
				data[i].tahun,
				data[i].angka_kelahiran,
				data[i].angka_kematian,
				data[i].SMP,
				data[i].SMA,
				data[i].S1,
				data[i].S2,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatademoagama(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatademoagama/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datademoagama').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].agama,
				data[i].prosentase,
				data[i].jumlah_tempat_ibadah,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatasukubangsa(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatasukubangsa/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datasukubangsa').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_suku,
				data[i].prosentase,
				data[i].ciri_khas,
				data[i].bahasa_adat,
				data[i].tertua_adat,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatadesabinaan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatadesabinaan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				//console.log(data)
				var counter = 1
				var table = $('#datadesabinaan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_desa,
				data[i].jumlah_penduduk,
				data[i].tingkat_pendidikan,
				data[i].nama_pembina,
				data[i].nama_tertua_desa,
				data[i].latitude,
				data[i].longitude,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatadesapesisir(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatadesapesisir/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datadesapesisir').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_desa,
				data[i].jumlah_penduduk,
				data[i].tingkat_pendidikan,
				data[i].nama_pembina,
				data[i].nama_tertua_desa,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatasakabahari(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatasakabahari/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datasakabahari').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].saka,
				data[i].jumlah_saka,
				data[i].sekolah_terlibat,
				data[i].nama_pembina,
				data[i].no_gugus_depan,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatapekerjaanmasyarakat(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapekerjaanmasyarakat/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapekerjaanmasyarakat').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].mayoritas1,
				data[i].mayoritas2,
				data[i].mayoritas3,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatasekolahmaritim(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatasekolahmaritim/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datasekolahmaritim').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_sekolah,
				data[i].jumlah_siswa,
				data[i].jumlah_pengajar,
				data[i].kerjasama_instansi,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatarumahsakit(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatarumahsakit/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datarumahsakit').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_rumahsakit,
				data[i].jenis_rumahsakit,
				data[i].kelas_rumahsakit,
				data[i].id_penyelenggara_rumahsakit,
				data[i].alamat_rumahsakit,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		//geo sda
		function getdatapantai(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapantainew/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				//console.log(data)
				var counter = 1
				var table = $('#datapantai').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_pantai,
				data[i].jenis_pantai,
				data[i].panjang_pantai,
				data[i].material_dasar_pantai,
				data[i].ciri_khusus,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukans !');
        	}   
    		});
		}
		function getdatahutan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatahutan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datahutan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_tanaman,
				data[i].luas_hutan,
				data[i].status_hutan,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatagunung(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatagunung/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datagunung').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_gunung,
				data[i].tinggi_gunung,
				data[i].status_gunung,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatakerawanan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatakerawanan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datakerawanan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].gempa_tektonik,
				data[i].gempa_vulkanik,
				data[i].banjir,
				data[i].gunung_meletus,
				data[i].tsunami,
				data[i].kebakaran,
				data[i].angin,
				data[i].longsor,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatahujan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatahujan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datahujan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].suhu_min,
				data[i].suhu_max,
				data[i].kelembaban_udara,
				data[i].musim_hujan,
				data[i].curah_hujan,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatatanah(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatatanah/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datatanah').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_tanah,
				data[i].kemiringan,
				data[i].pemanfaatan,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdataair(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataair/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataair').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_sumberair,
				data[i].debit_air,
				data[i].kondisi_air,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatasungai(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatasungai/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datasungai').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_sungai,
				data[i].lebar,
				data[i].panjang,
				data[i].sumber_sungai,
				data[i].anak_sungai,
				data[i].pemanfaatan_sungai,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatapulau(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapulau/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapulau').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_pulau,
				data[i].luas_pulau,
				data[i].jumlah_penduduk,
				data[i].jarak_pulau_utama,
				data[i].transportasi,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatamangrove(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatamangrove/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datamangrove').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].jumlah,
				data[i].tgl_tanam,
				data[i].nama_geografi,
				data[i].tgl_lapor,
				data[i].latitude,
				data[i].longitude,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		//geo sdab
		function getdataperkebunan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataperkebunan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataperkebunan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_komoditas,
				data[i].luas,
				data[i].tonase_hasil,
				data[i].masa_panen,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatapertanian(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapertanian/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapertanian').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_komoditas,
				data[i].luas,
				data[i].tonase_hasil,
				data[i].masa_panen,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatapeternakan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapeternakan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapeternakan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_komoditas,
				data[i].luas,
				data[i].tonase_hasil,
				data[i].masa_panen,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatapertambangan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapertambangan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapertambangan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_bahantambang,
				data[i].luas_tambang,
				data[i].tonase_hasil,
				data[i].pemilik,
				data[i].teknik_penambangan,
				data[i].penggunaan,
				data[i].jumlah_tenaga_kerja,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatabudidayaikan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatabudidayaikan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#databudidayaikan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_ikan,
				data[i].luas,
				data[i].tonase_hasil,
				data[i].masa_panen,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatajaringapung(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatajaringapung/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datajaringapung').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_ikan,
				data[i].luas,
				data[i].tonase,
				data[i].penghasilan,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatakonservasi(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatakonservasi/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datakonservasi').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].jenis_konservasi,
				data[i].penanggung_jawab,
				data[i].luas,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatalistrik(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatalistrik/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datalistrik').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].sumber_listrik,
				data[i].energi_dihasilkan,
				data[i].luas_cakupan,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		//geo sarpras
		function getdatapelabuhansungai(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapelabuhansungai/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapelabuhansungai').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_pelabuhan,
				data[i].nama_sungai,
				data[i].jarak_dari_laut,
				data[i].pasang_tinggi,
				data[i].surut_rendah,
				data[i].draft_maks,
				data[i].lebar_kapal_maks,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatapelabuhanlaut(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapelabuhanlaut/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapelabuhanlaut').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_pelabuhan,
				data[i].alamat,
				data[i].telepon,
				data[i].informasi_umum
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatapelabuhanikan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatapelabuhanikan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datapelabuhanikan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_pelabuhan,
				data[i].kelas_pelabuhanikan,
				data[i].wpp,
				data[i].status,
				data[i].pengelola,
				data[i].fasilitas,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatasapras(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatasapras/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datasapras').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].kelas_admpemerintah,
				data[i].prosentase_pemerintah,
				data[i].kelas_bebanmuatan,
				data[i].prosentase_beban_muatan,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}

		//geo injasmar
		function getdatagalangankapal(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatagalangankapal/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datagalangankapal').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_galangan,
				data[i].pemilik,
				data[i].maks_gt,
				data[i].status_kepemilikan,
				data[i].fasilitas,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdataindustrimesin(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataindustrimesin/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataindustrimesin').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_perusahaan,
				data[i].hasil_produksi,
				data[i].besaran_produksi,
				data[i].status_kepemilikan,
				data[i].penggunaan_hasil_produksi,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatalautnasional_pelayaran(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatalautnasional_pelayaran/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datalautnasional_pelayaran').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_perusahaan,
				data[i].nama_kapal,
				data[i].gt_kapal,
				data[i].rute,
				data[i].frekuensi_pelayaran,
				data[i].maks_daya_angkut_orang,
				data[i].maks_daya_angkut_transportasi,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatalautnasional_ekspedisi(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatalautnasional_ekspedisi/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datalautnasional_ekspedisi').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_perusahaan,
				data[i].jenis_muatan,
				data[i].frekuensi_pelayaran,
				data[i].jumlah_kapal,
				data[i].gt_kapal,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdatashipchandler(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdatashipchandler/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#datashipchandler').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_perusahaan,
				data[i].nama_kapal,
				data[i].gt_kapal,
				data[i].fasilitas,
				data[i].alamat,
				data[i].pemilik,
				data[i].data_pemilik,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
		function getdataindustriperikanan(idsatker)
		{
			$.ajax({
			url: '<?= site_url() ?>/unduhdata_unduh/getdataindustriperikanan/'+idsatker,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var counter = 1
				var table = $('#dataindustriperikanan').DataTable();
				table.clear().draw();

				for(i=0; i<data.length; i++){
				counter = counter + i
				table.row.add( 
				[
				i + 1,
				data[i].nama_satker,
				data[i].wilayah,
				data[i].nama_perusahaan,
				data[i].gt_kapal,
				data[i].jumlah_kapal,
				data[i].alamat,
				data[i].pemilik,
				data[i].data_pemilik,
				data[i].hasil_produksi,
				data[i].pemanfaatan,
				data[i].omzet,
				data[i].keterangan
            	]).draw();
				}
			 },
        	error: function(){
            	alert('Data Tidak Ditemukan !');
        	}   
    		});
		}
	});

</script>

