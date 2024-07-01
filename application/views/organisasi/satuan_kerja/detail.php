<div class="section">

	<!--  Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fe fe-life-buoy mr-1"></i> Pages</a></li>
			<li class="breadcrumb-item active" aria-current="page">Profile</li>
		</ol>
	</div>
	<!--  Page-header closed -->

	<!-- row opened -->
	<div class="row" id="user-profile">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body" style="height:300px; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url('<?php echo base_url() ?>uploads/satker/sampul/<?= $satker->gambarsampul ?>');">
  					<div class="wideget-user">
						<div class="row">
							<div class="col-lg-12 col-xl-6 col-md-12">
								<div class="wideget-user-desc d-flex">
									<div class="user-wrap mt-lg-0">
										<h4><?= $satker->nama_satker ?></h4>
										<?php if($satker->level == 1): ?>
											<h6 class="text-muted mb-3 font-weight-normal">Tidak Memiliki Parent Satker</h6>
										<?php elseif($satker->level == 2): ?>
											<h4 class="text-muted mb-3 font-weight-normal"><b><?= $parentSatker1->nama_satker ?></b></h4>
										<?php elseif($satker->level == 3): ?>
											<h4 class="text-muted mb-3 font-weight-normal"><b><?= $parentSatker2->nama_satker.', '.$parentSatker1->nama_satker ?></b></h4>
										<?php endif ?>
										<span class="btn btn-default mt-1 mb-1"><b><?= $satker->kode_satker ?></b></span>
										<span class="btn btn-default mt-1 mb-1" id="getid" style="display:none;"><?= $satker->id_satker ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
				<div class="myTab">
					<ul class="nav  nav-tabs m-0" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="geografi-sda-tab" data-toggle="tab" href="#geografi-sda" role="tab" aria-controls="geografi-sda" aria-selected="true">Geografi - SDA</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="geografi-sdab-tab" data-toggle="tab" href="#geografi-sdab" role="tab" aria-controls="geografi-sdab" aria-selected="true">Geografi - SDAB</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="geografi-sarpras-tab" data-toggle="tab" href="#geografi-sarpras" role="tab" aria-controls="geografi-sarpras" aria-selected="true">Geografi - SARPRAS</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="geografi-injasmar-tab" data-toggle="tab" href="#geografi-injasmar" role="tab" aria-controls="geografi-injasmar" aria-selected="true">Geografi - INJASMAR</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="demografi-tab" data-toggle="tab" href="#demografi" role="tab" aria-controls="demografi" aria-selected="true">Demografi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="konsos-tab" data-toggle="tab" href="#konsos" role="tab" aria-controls="konsos" aria-selected="true">Konsos</a>
						</li>
					</ul>
				
						<div class="tab-content  p-3 border" id="myTabContent">
							<div class="tab-pane fade p-0 active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div id="profile-log-switch">
									<div class="table-responsive mb-5">
										<table class="table row table-borderless w-100 m-0 border">
											<tbody class="col-lg-6 p-0">
												<tr>
													<td><strong>Nama Satker :</strong> <?= $satker->nama_satker ?></td>
												</tr>
												<tr>
													<td><strong>Kode Satker :</strong> <?= $satker->kode_satker ?> </td>
												</tr>
												<tr>
													<td><strong>Tipe Organisasi :</strong> <?= $satker->jenis_organisasi ?>
													</td>
												</tr>
												<tr>
													<td><strong>Parent Satker :</strong> <?= $satker->nama_parent_satker ?></td>
												</tr>
											</tbody>
											<tbody class="col-lg-6 p-0">
												<tr>
													<td><strong>Pimpinan :</strong> <?= $satker->nama_pimpinan ?></td>
												</tr>
												<tr>
													<td><strong>Alamat :</strong> <?= $satker->alamat ?></td>
												</tr>
												<tr>
													<td><strong>Kel : </strong><?= $satker->KELURAHAN ?>, <strong>Kec : </strong><?= $satker->KECAMATAN ?>, <strong>Kab : </strong><?= $satker->KABUPATEN ?>, <strong>Prov : </strong><?= $satker->PROVINSI ?></td>
												</tr>
												<tr>
													<td><strong>Email :</strong> <?= $satker->email ?></td>
												</tr>
												<tr>
													<td><strong>Phone :</strong> <?= $satker->No_Telp ?></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="p-5 border">
										<div class="media-heading">
											<h4><strong>Lokasi</strong></h4>
										</div>
										<div id="map" style="width:100%;height:380px;"></div>
									</div>
									<div class="p-5 border">
										<div class="media-heading">
											<h4><strong>Deskripsi</strong></h4>
										</div>
										<p class="description mb-5"><?= $satker->keterangan ?></p>
									</div>
									<div class="p-5 border">
										<div class="media-heading">
											<h4><strong>Galeri Foto</strong></h4>
										</div>
										<div class="gallery box-shadow-0">
											<!-- <div class="row">
												<div class="col-lg-3 col-md-12 col-xl-3 mb-5" >
													<div class="g-img shadow">
														<a href="<?php echo base_url() ?>assets/images/bg-login.jpg">
															<img class="img-responsive" src="<?php echo base_url() ?>assets/images/bg-login.jpg" alt="Thumb-2" title="Image 01">
														</a>
													</div>
												</div>
												<div class="col-lg-3 col-md-12 col-xl-3 mb-5" >
													<div class="g-img shadow">
														<a href="<?php echo base_url() ?>assets/images/bg-login9.jpg">
															<img class="img-responsive" src="<?php echo base_url() ?>assets/images/bg-login9.jpg" alt="Thumb-2" title="Image 01">
														</a>
													</div>
												</div>
												<div class="col-lg-3 col-md-12 col-xl-3 mb-5">
													<div class="g-img shadow">
														<a href="<?php echo base_url() ?>assets/images/bg-login3.jpg">
															<img class="img-responsive" src="<?php echo base_url() ?>assets/images/bg-login3.jpg" alt="Thumb-2" title="Image 02">
														</a>
													</div>
												</div>
												<div class="col-lg-3 col-md-12 col-xl-3 mb-5" >
													<div class="g-img shadow">
														<a href="<?php echo base_url() ?>assets/images/bg-login2.jpg">
															<img class="img-responsive" src="<?php echo base_url() ?>assets/images/bg-login2.jpg" alt="Thumb-2" title="Image 03">
														</a>
													</div>
												</div>
											</div> -->
											<div class="row">
												<a class="elem col-md-3" data-lcl-thumb="<?php echo base_url() ?>assets/images/bg-login.jpg" data-lcl-txt="Image 1 Description" href="<?php echo base_url() ?>assets/images/bg-login.jpg" title="Image 1"><span class="cover-image" data-image-src="<?php echo base_url() ?>assets/images/bg-login.jpg"></span></a>
												<a class="elem col-md-3" data-lcl-thumb="<?php echo base_url() ?>assets/images/bg-login9.jpg" data-lcl-txt="Image 2 Description" href="<?php echo base_url() ?>assets/images/bg-login9.jpg" title="Image 2"><span class="cover-image" data-image-src="<?php echo base_url() ?>assets/images/bg-login9.jpg"></span></a>
												<a class="elem col-md-3" data-lcl-thumb="<?php echo base_url() ?>assets/images/bg-login2.jpg" data-lcl-txt="Image 3 Description" href="<?php echo base_url() ?>assets/images/bg-login2.jpg" title="Image 3"><span class="cover-image" data-image-src="<?php echo base_url() ?>assets/images/bg-login2.jpg"></span></a>
												<a class="elem col-md-3" data-lcl-thumb="<?php echo base_url() ?>assets/images/bg-login3.jpg" data-lcl-txt="Image 4 Description" href="<?php echo base_url() ?>assets/images/bg-login3.jpg" title="Image 4"><span class="cover-image" data-image-src="<?php echo base_url() ?>assets/images/bg-login3.jpg"></span></a>
												<br>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade p-0 " id="geografi-sda" role="tabpanel" aria-labelledby="geografi-sda-tab">
								<div class="widget-users row">
									<div class="col-md-12">
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">A. Pantai</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-a"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Pantai</th>
															<th>Jenis Pantai</th>
															<th>Panjang Pantai (Km)</th>
															<th>Material Dasar Pantai</th>
															<th>Ciri Khusus</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">B. Hutan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-b"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Tanaman</th>
															<th>Luas Hutan (Ha)</th>
															<th>Status Hutan</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">C. Gunung</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-c"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Gunung</th>
															<th>Tinggi Gunung (Mdpl)</th>
															<th>Status</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">D. Kerawanan Geografi</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-d" text-align="center"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<tr>
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
																<th>Ket</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">E. Curah Hujan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-e"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<tr>
																<th>No</th>
																<th>Satker</th>
																<th>Wilayah</th>
																<th>Suhu Max (°C)</th>
																<th>Suhu Min (°C)</th>
																<th>Kelembapan Udara</th>
																<th>Musim Hujan (Bulan/Th)</th>
																<th>Curah Hujan</th>
																<th>Ket</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">F. Struktur Tanah</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-f"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Tanah</th>
															<th>Kemiringan</th>
															<th>Pemanfaatan</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">G. Sumber Air</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-g"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<tr>

																<th>No</th>
																<th>Satker</th>
																<th>Wilayah</th>
																<th>Sumber Air</th>
																<th>Debit Air</th>
																<th>Kondisi Air</th>
																<th>Ket</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">H. Sungai </div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-h"
														class="table table-striped table-bordered text-nowrap">
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
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">I. Pulau Terluar</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-i"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Pulau</th>
															<th>Luas Pulau (Ha)</th>
															<th>Jumlah Penduduk (Orang)</th>
															<th>Jarak Pulau Utama (Km)</th>
															<th>Transportasi</th>
															<th>Ket</th>
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
							</div>

							<div class="tab-pane fade p-0 " id="geografi-sdab" role="tabpanel" aria-labelledby="geografi-sdab-tab">
								<div class="widget-users row">
									<div class="col-md-12">
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">A. Perkebunan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-a1"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Tanaman</th>
															<th>Luas (Ha)</th>
															<th>Tonase Hasil</th>
															<th>Masa Panen</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">B. Pertanian</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-b1"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Tanaman</th>
															<th>Luas (Ha)</th>
															<th>Tonase Hasil (Ton)</th>
															<th>Masa Panen</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">C. Peternakan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-c1"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Hewan</th>
															<th>Luas (Ha)</th>
															<th>Tonase Hasil (Ton)</th>
															<th>Masa Panen</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">D. Pertambangan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-d1"
														class="table table-striped table-bordered text-nowrap">
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
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">E. Pembudidayaan Ikan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-e1"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Ikan</th>
															<th>Luas Tambak (Ha)</th>
															<th>Tonase Hasil (Ton)</th>
															<th>Masa Panen</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">F. Keramba Jaring Apung</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-f1"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Ikan</th>
															<th>Tonase (Ton)</th>
															<th>Penghasilan (Rp)</th>
															<th>Luas (Ha)</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">G. Konservasi Lingkungan Hidup</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-g1"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis yg Dikonservasikan</th>
															<th>Penanggung Jawab</th>
															<th>Luas (Ha)</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">H. Sumber Listrik </div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-h1"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Sumber Listrik</th>
															<th>Energi Yg Dihasilkan (Kw)</th>
															<th>Luas Cakupan</th>
															<th>Ket</th>
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
							</div>

							<div class="tab-pane fade p-0 " id="geografi-sarpras" role="tabpanel" aria-labelledby="geografi-sarpras-tab">
								<div class="widget-users row">
									<div class="col-md-12">
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">A. Pelabuhan Sungai</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-a2"
														class="table table-striped table-bordered text-nowrap">
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
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">B. Pelabuhan Laut</div> <!-- tabel belum sesuai-->
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-b2"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Pelabuhan</th>
															<th>Informasi Umum</th>
															<th>Hidrografi</th>
															<th>Topografi</th>
															<th>Pasang Surut</th>
															<th>Arus</th>
															<th>alamat</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">C. Pelabuhan Perikanan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-c2"
														class="table table-striped table-bordered text-nowrap">
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
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">D. Sarana Prasarana Jalan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-d2"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Klasifikasi Jalan Sesuai Administrasi Pemerintahan</th>
															<th>%</th>
															<th>Klasifikasi Jalan Sesuai Beban Muatan Sumbu</th>
															<th>%</th>
															<th>Ket</th>
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
							</div>

							<div class="tab-pane fade p-0 " id="geografi-injasmar" role="tabpanel" aria-labelledby="geografi-injasmar-tab">
								<div class="widget-users row">
									<div class="col-md-12">
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">A. Galangan Kapal</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-a3"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Galangan</th>
															<th>Pemilik</th>
															<th>Maks GT</th>
															<th>Status Kepemilikan</th>
															<th>Fasilitas</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">B.Industri Mesin dan Sparepart Perkapalan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-b3"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Perusahaan</th>
															<th>Hasil Produksi</th>
															<th>Besaran Produksi / Bulan</th>
															<th>Status Kepemilikan</th>
															<th>Penggunaan Hasil Produksi</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">C. Angkutan Laut Nasional</div>
											</div>
											<div class="card-body text-center">
												<div class="col-md-12 col-lg-12 card-title">1. Pelayaran Rakyat</div>
												<div class="col-md-12 text-center">
													<div class="table-responsive">
														<table id="tbl-c3"
															class="table table-striped table-bordered text-nowrap">
															<thead>
																<th>No</th>
																<th>Satker</th>
																<th>Wilayah</th>
																<th>Nama Perusahaan</th>
																<th>Nama kapal</th>
																<th>GT Kapal</th>
																<th>Rute</th>
																<th>Frekuensi Pelayaran</th>
																<th>Maks Daya Angkut Orang</th>
																<th>Maks DAya Angkut Transportasi</th>
																<th>Ket</th>
															</thead>
															<tbody>
															</tbody>
														</table>
														<br>
													</div>
												</div>
											</div>
											<div class="card-body text-center">
												<div class="col-md-12 col-lg-12 card-title">2. Ekspedisi Laut</div>
												<div class="col-md-12 text-center">
													<div class="table-responsive">
														<table id="tbl-d3"
															class="table table-striped table-bordered text-nowrap">
															<thead>
																<th>No</th>
																<th>Satker</th>
																<th>Wilayah</th>
																<th>Nama Perusahaan</th>
																<th>Jenis Barang / Muatan</th>
																<th>Frekuensi Pelayaran</th>
																<th>Jumlah Kapal</th>
																<th>GT Kapal</th>
																<th>Ket</th>
															</thead>
															<tbody>
															</tbody>
														</table>
														<br>
													</div>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
												<div class="card-header">
													<div class="card-title">D. Ship Chandler</div>
												</div>
												<div class="card-body text-center">
													<div class="table-responsive">
														<table id="tbl-e3"
															class="table table-striped table-bordered text-nowrap">
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
																<th>Ket</th>
															</thead>
															<tbody>
															</tbody>
														</table>
														<br>
													</div>
												</div>
										</div>
										<div class="card box-shadow-0">
												<div class="card-header">
													<div class="card-title">E. Industri Perikanan</div>
												</div>
												<div class="card-body text-center">
													<div class="table-responsive">
														<table id="tbl-f3"
															class="table table-striped table-bordered text-nowrap">
															<thead>
																<th>No</th>
																<th>Satker</th>
																<th>Wilayah</th>
																<th>Nama Perusahaan</th>
																<th>GT Kapal</th>
																<th>Jumlah Kapal</th>
																<th>Jenis Ikan</th>
																<th>Alamat</th>
																<th>Pemilik</th>
																<th>Data Pemilik</th>
																<th>Hasil Produksi</th>
																<th>Pemanfaatan</th>
																<th>Omzet</th>
																<th>Ket</th>
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
							</div>

							<div class="tab-pane fade p-0 " id="demografi" role="tabpanel" aria-labelledby="demografi-tab">
								<div class="widget-users row">
									<div class="col-md-12">
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">A. Jumlah Penduduk </div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-a4"
														class="table table-striped table-bordered text-nowrap">
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
															<td rowspan="2">Ket</td>
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
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">B. Agama</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-b4"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Agama</th>
															<th>%</th>
															<th>Jumlah Tempat Ibadah</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">C Suku Bangsa</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-c4"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Suku</th>
															<th>Persentase</th>
															<th>Ciri Khas</th>
															<th>Bahasa Adat</th>
															<th>Tertua Adat</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">D. Desa Pesisir</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-d4"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Desa</th>
															<th>Jumlah Penduduk</th>
															<th>Tingkat Pendidikan</th>
															<th>Nama Pembina</th>
															<th>Nama Tertua Desa</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">E. Saka Bahari</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-e4"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Saka</th>
															<th>Jumlah Saka</th>
															<th>Sekolah yang Terlibat</th>
															<th>Nama Pembina</th>
															<th>Nomor Gugus Depan</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">F. Pekerjaan Masyarakat</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-f4"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Mayoritas 1</th>
															<th>Mayoritas 2</th>
															<th>Mayoritas 3</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">H. Sekolah Maritim </div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-h4"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Perguruan Tinggi/SMA Sederajat</th>
															<th>Jumlah Siswa</th>
															<th>Jumlah Pengajar</th>
															<th>Kerjasama Dengan Instansi</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">I. Rumah Sakit</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
												<table id="tbl-i4"
													class="table table-striped table-bordered text-nowrap">
													<thead>
														<th>No</th>
														<th>Satker</th>
														<th>Wilayah</th>
														<th>Nama RS</th>
														<th>Jenis RS</th>
														<th>Kelas RS</th>
														<th>Penyelenggara RS</th>
														<th>Alamat RS</th>
														<th>Ket</th>
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
							</div>

							<div class="tab-pane fade p-0 " id="konsos" role="tabpanel" aria-labelledby="konsos-tab">
								<div class="widget-users row">
									<div class="col-md-12">
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">A. Tokoh Masyarakat dan Tokoh Agama</div>
											</div>
											<div class="card-body text-center">
													<div class="table-responsive">
														<table id="tbl-a5"
															class="table table-striped table-bordered text-nowrap">
															<thead>
																<th>No</th>
																<th>Satker</th>
																<th>Wilayah</th>
																<th>Agama</th>
																<th>Nama</th>
																<th>Usia</th>
																<th>Alamat</th>
																<th>Pekerjaan</th>
																<th>Ket</th>
															</thead>
															<tbody>
															</tbody>
														</table>
														<br>
													</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">B. Organisasi Keagamaan</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-b5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Organisasi</th>
															<th>Alamat Kantor Pusat</th>
															<th>Agama</th>
															<th>Pemimpin</th>
															<th>Jumlah Anggota</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">C. Organisasi Politik</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-c5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Organisasi</th>
															<th>Alamat Kantor Pusat</th>
															<th>Tertua</th>
															<th>Partai</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">D. Organisasi Massa</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-d5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Nama Organisasi</th>
															<th>Alamat Kantor Pusat</th>
															<th>Tertua</th>
															<th>Bidang</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">E. Partai Politik</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-e5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Partai</th>
															<th>Prosentase</th>
															<th>Dominasi Wilayah</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">F. Usaha Kecil Kerajinan Rakyat (UMKM)</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-f5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Industri</th>
															<th>Penjualan</th>
															<th>Jumlah Tenaga Kerja/th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">G. Industri Menengah</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-g5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Jenis Industri</th>
															<th>Sumber Bahan Baku</th>
															<th>Penjualan</th>
															<th>Jumlah Tenaga Kerja</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">H. Objek Pariwisata</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-h5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Objek Pariwisata</th>
															<th>Alamat</th>
															<th>Pengelola</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">I. Peninggalan Sejarah</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-i5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Objek Wilayah</th>
															<th>Titik Koordinat</th>
															<th>Pengelola</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">J. Budaya</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-j5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Kebudayaan Asli</th>
															<th>Ket</th>
														</thead>
														<tbody>
														</tbody>
													</table>
													<br>
												</div>
											</div>
										</div>
										<div class="card box-shadow-0">
											<div class="card-header">
												<div class="card-title">K. Instansi Militer dan Polisi</div>
											</div>
											<div class="card-body text-center">
												<div class="table-responsive">
													<table id="tbl-k5"
														class="table table-striped table-bordered text-nowrap">
														<thead>
															<th>No</th>
															<th>Satker</th>
															<th>Wilayah</th>
															<th>Instansi</th>
															<th>Cakupan wilayah</th>
															<th>Jumlah Personil</th>
															<th>Ket</th>
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
							</div>
						</div>
				</div>

				</div>
			</div>
		</div><!-- col end -->
	</div>
	<!-- row closed -->
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false" src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=mapLibReady"></script>
<script src="<?php echo base_url() ?>assets/js/map-util.js"></script>

<script>

$(document).ready(function () {
	$('#profile-tab').click(function(){ 
	});

	$('#geografi-sda-tab').click(function(){ 
		var id = $('#getid').html();

		getdatapantai(id,"pantai");  
		getdatahutan(id,"hutan");   
		getdatagunung(id,"gunung");   
		getdatakerawanan(id,"kerawanan");   
		getdatahujan(id,"hujan");   
		getdatatanah(id,"tanah");   
		getdataair(id,"air");   
		getdatasungai(id,"sungai");   
		getdatapulau(id,"pulau");  
	});

	$('#geografi-sdab-tab').click(function(){ 
		var id = $('#getid').html();

		getdataperkebunan(id,"perkebunan");  
		getdatapertanian(id,"pertanian");   
		getdatapeternakan(id,"peternakan");   
		getdatapertambangan(id,"pertambangan");   
		getdatabudidayaikan(id,"budidayaikan");   
		getdatajaringapung(id,"jaringapung");   
		getdatakonservasi(id,"konservasi");   
		getdatalistrik(id,"listrik");
	});

	$('#geografi-sarpras-tab').click(function(){ 
		var id = $('#getid').html();

		getdatapelabuhansungai(id,"pelabuhansungai");  
		getdatapelabuhanlaut(id,"pelabuhanlaut");   
		getdatapelabuhanikan(id,"pelabuhanikan");   
		getdatasapras(id,"sapras");
	});

	$('#geografi-injasmar-tab').click(function(){ 
		var id = $('#getid').html();

		getdatagalangankapal(id,"galangankapal");  
		getdataindustrimesin(id,"industrimesin");   
		getdatalautnasional_pelayaran(id,"lautnasional_pelayaran");   
		getdatalautnasional_ekspedisi(id,"lautnasional_ekspedisi"); 
		getdatashipchandler(id,"shipchandler"); 
		getdataindustriperikanan(id,"industriperikanan");
	});

	$('#demografi-tab').click(function(){ 
		var id = $('#getid').html();

		getdatajumlahpenduduk(id,"jumlahpenduduk");  
		getdatademoagama(id,"demoagama");   
		getdatasukubangsa(id,"sukubangsa");   
		getdatadesapesisir(id,"desapesisir"); 
		getdatasakabahari(id,"sakabahari"); 
		getdatapekerjaanmasyarakat(id,"pekerjaanmasyarakat");
		getdatasekolahmaritim(id,"sekolahmaritim");  
		getdatarumahsakit(id,"rumahsakit"); 
	});

	$('#konsos-tab').click(function(){ 
		var id = $('#getid').html();

		getdatatokohmasyarakat(id,"tokohmasyarakat");  
		getdataorgagama(id,"orgagama");   
		getdataorgpolitik(id,"orgpolitik");   
		getdataorgmasa(id,"orgmasa"); 
		getdatapartaipolitik(id,"partaipolitik"); 
		getdataumkm(id,"umkm");
		getdataindustrimenengah(id,"industrimenengah");  
		getdatapariwisata(id,"pariwisata");   
		getdatasejarah(id,"sejarah");   
		getdatabudaya(id,"budaya"); 
		getdatamiliterpolisi(id,"militerpolisi");
	});
})

//demografi
function getdatajumlahpenduduk(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_DEMOGRAFI/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-a4').empty();
			$('#tbl-a4').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-a4').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatademoagama(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_DEMOGRAFI/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-b4').empty();
			$('#tbl-b4').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-b4').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].agama,
			data[i].prosentase,
			data[i].jumlah_tempat_ibadah,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatasukubangsa(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_DEMOGRAFI/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-c4').empty();
			$('#tbl-c4').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-c4').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatadesapesisir(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_DEMOGRAFI/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-d4').empty();
			$('#tbl-d4').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-d4').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatasakabahari(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_DEMOGRAFI/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-e4').empty();
			$('#tbl-e4').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-e4').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapekerjaanmasyarakat(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_DEMOGRAFI/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-f4').empty();
			$('#tbl-f4').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-f4').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].mayoritas1,
			data[i].mayoritas2,
			data[i].mayoritas3,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatasekolahmaritim(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_DEMOGRAFI/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-h4').empty();
			$('#tbl-h4').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-h4').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_sekolah,
			data[i].jumlah_siswa,
			data[i].jumlah_pengajar,
			data[i].kerjasama_instansi,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatarumahsakit(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_DEMOGRAFI/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-i4').empty();
			$('#tbl-i4').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-i4').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

//konsos
function getdatatokohmasyarakat(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-a5').empty();
			$('#tbl-a5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-a5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdataorgagama(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-b5').empty();
			$('#tbl-b5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-b5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdataorgpolitik(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-c5').empty();
			$('#tbl-c5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-c5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].organisasi,
			data[i].alamat_kantor_pusat,
			data[i].tertua,
			data[i].partai,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdataorgmasa(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-d5').empty();
			$('#tbl-d5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-d5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_organisasi,
			data[i].alamat_kantor_pusat,
			data[i].tertua,
			data[i].bidang,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapartaipolitik(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-e5').empty();
			$('#tbl-e5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-e5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].partai,
			data[i].prosentase,
			data[i].dominasi_wilayah,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdataumkm(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-f5').empty();
			$('#tbl-f5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-f5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].jenis_industri,
			data[i].penjualan,
			data[i].jumlah_tenaga_kerja,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdataindustrimenengah(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-g5').empty();
			$('#tbl-g5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-g5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].jenis_industri,
			data[i].sumber_bahan_baku,
			data[i].penjualan,
			data[i].jumlah_tenaga_kerja,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapariwisata(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-h5').empty();
			$('#tbl-h5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-h5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].objek_pariwisata,
			data[i].alamat,
			data[i].pengelola,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatasejarah(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-i5').empty();
			$('#tbl-i5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-i5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].objek_sejarah,
			data[i].titik_kordinat,
			data[i].pengelola,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatabudaya(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-j5').empty();
			$('#tbl-j5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-j5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].kebudayaan_asli,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatamiliterpolisi(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_KONSOS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-k5').empty();
			$('#tbl-k5').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-k5').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].instansi,
			data[i].cakupan_wilayah,
			data[i].jumlah_personel,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

//geo-sda
function getdatapantai(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-a').empty();
			$('#tbl-a').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-a').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatahutan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-b').empty();
			$('#tbl-b').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-b').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].jenis_tanaman,
			data[i].luas_hutan,
			data[i].status_hutan,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatagunung(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-c').empty();
			$('#tbl-c').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-c').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_gunung,
			data[i].tinggi_gunung,
			data[i].status_gunung,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatakerawanan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-d').empty();
			$('#tbl-d').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-d').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatahujan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-e').empty();
			$('#tbl-e').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-e').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].suhu_min,
			data[i].suhu_max,
			"Belum ??",
			data[i].musim_hujan,
			data[i].curah_hujan, 
			data[i].keterangan  
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatatanah(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-f').empty();
			$('#tbl-f').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-f').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].jenis_tanah,
			data[i].kemiringan,
			data[i].pemanfaatan,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdataair(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-g').empty();
			$('#tbl-g').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-g').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].jenis_sumberair,
			data[i].debit_air,
			data[i].kondisi_air,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatasungai(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-h').empty();
			$('#tbl-h').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-h').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapulau(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDA/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-i').empty();
			$('#tbl-i').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-i').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

//geo-sdab
function getdataperkebunan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDAB/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-a1').empty();
			$('#tbl-a1').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-a1').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_komoditas,
			data[i].luas,
			data[i].tonase_hasil,
			data[i].masa_panen,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapertanian(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDAB/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-b1').empty();
			$('#tbl-b1').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-b1').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_komoditas,
			data[i].luas,
			data[i].tonase_hasil,
			data[i].masa_panen,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapeternakan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDAB/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-c1').empty();
			$('#tbl-c1').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-c1').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_komoditas,
			data[i].luas,
			data[i].tonase_hasil,
			data[i].masa_panen,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapertambangan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDAB/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-d1').empty();
			$('#tbl-d1').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-d1').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatabudidayaikan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDAB/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-e1').empty();
			$('#tbl-e1').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-e1').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].jenis_ikan,
			data[i].luas,
			data[i].tonase_hasil,
			data[i].masa_panen,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatajaringapung(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDAB/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-f1').empty();
			$('#tbl-f1').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-f1').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].jenis_ikan,
			data[i].luas,
			data[i].tonase,
			data[i].penghasilan,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatakonservasi(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDAB/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-g1').empty();
			$('#tbl-g1').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-g1').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].jenis_konservasi,
			data[i].penanggung_jawab,
			data[i].luas,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatalistrik(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SDAB/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-h1').empty();
			$('#tbl-h1').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-h1').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].sumber_listrik,
			data[i].energi_dihasilkan,
			data[i].luas_cakupan,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

//geo-sapras
function getdatapelabuhansungai(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SARPRAS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-a2').empty();
			$('#tbl-a2').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-a2').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapelabuhanlaut(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SARPRAS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-b2').empty();
			$('#tbl-b2').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-b2').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_pelabuhan,
			data[i].informasi_umum,
			data[i].hidrografi,
			data[i].topografi,
			data[i].pasang_surut,
			data[i].arus,
			data[i].alamat,
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatapelabuhanikan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SARPRAS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-c2').empty();
			$('#tbl-c2').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-c2').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_pelabuhan,
			data[i].kelas_pelabuhanikan,
			data[i].wpp,
			data[i].status,
			data[i].pengelola,
			data[i].pengelola,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function getdatasapras(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_SARPRAS/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-d2').empty();
			$('#tbl-d2').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-d2').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].kelas_admpemerintah,
			data[i].prosentase_pemerintah,
			data[i].kelas_bebanmuatan,
			data[i].prosentase_beban_muatan,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

//geo-injasmar
function getdatagalangankapal(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_INJASMAR/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-a3').empty();
			$('#tbl-a3').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-a3').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdataindustrimesin(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_INJASMAR/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-b3').empty();
			$('#tbl-b3').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-b3').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatalautnasional_pelayaran(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_INJASMAR/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-c3').empty();
			$('#tbl-c3').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-c3').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatalautnasional_ekspedisi(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_INJASMAR/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-d3').empty();
			$('#tbl-d3').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-d3').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdatashipchandler(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_INJASMAR/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-e3').empty();
			$('#tbl-e3').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-e3').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
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
            alert('Could not displaying data');
        }
		        
    });
}

function getdataindustriperikanan(id,id2)
{
	$.ajax({
		url: '<?= site_url() ?>/organisasi_satker/getProfile_Geo_INJASMAR/'+id+'/'+id2,
		method : "GET",
		async : true,
		dataType : 'json',
		success: function(data){
			var counter = 1
			$('#tbl-f3').empty();
			$('#tbl-f3').DataTable().destroy();
			for(i=0; i<data.length; i++){
			counter = counter + i
			var table = $('#tbl-f3').DataTable();
			table.row.add( 
			[
			i + 1,
			data[i].nama_satker,
			data[i].PROVINSI,
			data[i].nama_perusahaan,
			data[i].gt_kapal,
			data[i].jumlah_kapal,
			data[i].jenis_ikan,
			data[i].alamat,
			data[i].pemilik,
			data[i].data_pemilik,
			data[i].hasil_produksi,
			data[i].pemanfaatan  ,
			data[i].omzet,
			data[i].keterangan
            ]).draw();
			}
		},
        error: function(){
            alert('Could not displaying data');
        }
		        
    });
}

function markerListener(myMap, marker, markerData){
	return function() {
		myMap.infowindow.setContent(
			'<div id="content">' +
				'<div id="siteNotice">Satker</div>' +
				'<h6>' + nullSafe(markerData.nama_satker) + '</h6>' +
				'<h6>' + nullSafe(markerData.nama_pimpinan) + '</h6>' +
				'<h6>' + nullSafe(markerData.lokasi) + '</h6>' +
			'</div>'
		);
		myMap.infowindow.open(map, marker);
	}
}

var center = {
	lat: <?= $satker->latitude ?>,
	lng: <?= $satker->longitude ?>
};

var globalMyMap = {
	domId: 'map',
	markerListener: markerListener,
	markerFactory: null,
	recreateMarkerOnZoom: true,
	siteUrl: "<?= site_url() ?>",
	markerDatas: <?= $markerDatasJson ?>,
	map: null,
	infowindow: null,
	myMarkers: [],
	zoom: 5,
	center: center
}

function mapLibReady(){
	initMap(globalMyMap, globalMyMap.markerDatas);
}

</script>

