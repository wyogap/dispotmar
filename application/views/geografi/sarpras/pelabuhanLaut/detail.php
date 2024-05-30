<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Geografi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Pelabuhan Laut</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header" style="background-color:#003399;">
					<h3 class="card-title" style="color:white;">Detail Data Pelabuhan</h3>
					<div class="card-options">
						<div class="col-md-12 text-right">
							<a href="<?= site_url()?>geografi_pelabuhanLaut" class="btn btn-danger">Kembali</a>
							<a href="<?= site_url()?>geografi_pelabuhanLaut/<?= encrypt($pelabuhanLaut->id_pelabuhan_laut)?>/edit" class="btn btn-success">
								Edit
							</a>
						</div>
					</div>			
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Satker</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->nama_satker ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Nama Pelabuhan</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->nama_pelabuhan ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Wilayah</label>
								<div class="col-md-3">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->PROVINSI ?>" disabled>
									<div class="text-danger warning-provinsi"></div>
								</div>
								<?php if(($pelabuhanLaut->flag_location == 'prov')): ?>
									<div class="col-md-2">
										<input type="text" class="form-control" value="-" disabled>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control" value="-" disabled>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" value="-" disabled>
									</div>
								<?php elseif(($pelabuhanLaut->flag_location == 'kab')): ?>
									<div class="col-md-2">
										<input type="text" class="form-control" value="<?= $pelabuhanLaut->KABUPATEN ?>" disabled>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control" value="-" disabled>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" value="-" disabled>
									</div>
								<?php elseif(($pelabuhanLaut->flag_location == 'kec')): ?>
									<div class="col-md-2">
										<input type="text" class="form-control" value="<?= $pelabuhanLaut->KABUPATEN ?>" disabled>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control" value="<?= $pelabuhanLaut->KECAMATAN ?>" disabled>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" value="-" disabled>
									</div>
								<?php elseif(($pelabuhanLaut->flag_location == 'kel')): ?>
									<div class="col-md-2">
										<input type="text" class="form-control" value="<?= $pelabuhanLaut->KABUPATEN ?>" disabled>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control" value="<?= $pelabuhanLaut->KECAMATAN ?>" disabled>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" value="<?= $pelabuhanLaut->KELURAHAN ?>" disabled>
									</div>
								<?php else: ?>
									<div class="col-md-2">
										<input type="text" class="form-control" value="-" disabled>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control" value="-" disabled>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" value="-" disabled>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Alamat</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->alamat ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Telepon / Fax</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->telepon ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Informasi Umum</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->informasi_umum ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Kelas Pelabuhan</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->kelas_pelabuhan ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Hidrografi</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->hidrografi ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Topografi</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->topografi ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Pasang Surut</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->pasang_surut ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Arus</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->arus ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Tanda Pengenal Masuk Pelabuhan</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->tanda_pengenal ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="card">
				<div class="card-header" style="background-color:#003cb3;">
					<h3 class="card-title" style="color:white;">Iklim</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Cuaca</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->iklim_cuaca ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Penglihatan</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->iklim_penglihatan ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Angin</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->iklim_angin ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Gelombang</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->iklim_gelombang ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Kondisi Klimatologi</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->iklim_kondisi_klimatologi ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-6">
			<div class="card">
				<div class="card-header" style="background-color:#0044cc;">
					<h3 class="card-title" style="color:white;">Alur Masuk Pelabuhan</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-3 col-form-label">Panjang</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->alur_masuk_panjang ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-3 col-form-label">Lebar</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->alur_masuk_luas ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-3 col-form-label">Kedalaman</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->alur_masuk_kedalaman ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="card">
				<div class="card-header" style="background-color:#0044cc;">
					<h3 class="card-title" style="color:white;">Kolam Pelabuhan</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-3 col-form-label">Luas</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->kolam_luas ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-3 col-form-label">Dalam Minimal</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->kolam_dalam_min ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-3 col-form-label">Dalam Maksimal</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->kolam_dalam_max ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-6">
			<div class="card">
				<div class="card-header" style="background-color:#004de6;">
					<h3 class="card-title" style="color:white;">Ukuran Maksimum Kapal</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-3 col-form-label">Panjang</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->ukuran_kapal_panjang ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-3 col-form-label">Draft</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->ukuran_kapal_draft ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-3 col-form-label">Berat Total</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->ukuran_kapal_berat ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="card">
				<div class="card-header" style="background-color:#004de6;">
					<h3 class="card-title" style="color:white;">Karantina</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-3 col-form-label">Daerah</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->karantina_daerah ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<br>
							<div class="row">
								<label class="col-md-3 col-form-label">Koordinat</label>
								<div class="col-md-8">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->karantina_koordinat ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
							<br>
							<br>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="card">
				<div class="card-header" style="background-color:#0055ff;">
					<h3 class="card-title" style="color:white;">Stasiun Radio Pantai</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Jenis</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->radio_jenis ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Nama Panggilan</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->radio_nama_panggilan ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Frekuensi</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->radio_frekuensi ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Kelas Pancaran</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->radio_kelas_pancaran ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header" style="background-color:#1a66ff;">
					<h3 class="card-title" style="color:white;">Kepanduan</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Wajib</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->kepanduan_apakah_wajib ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Batas Tonase Wajib Pandu</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->kepanduan_batas_tonase ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Kapal Tunda</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->kepanduan_kapal_tunda ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Posisi Antar / Jemput</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->kepanduan_posisi_antarjemput ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
			<div class="card">
				<div class="card-header" style="background-color:#3377ff;">
					<h3 class="card-title" style="color:white;">Berlabuh Jangkar</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Lokasi</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->berlabuh_lokasi ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Lokasi Dilarang</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->berlabuh_lokasi_dilarang ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Kedalaman Laut</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->berlabuh_kedalaman_laut ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Jenis Dasar Laut</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->berlabuh_jenis_dasar_laut ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header" style="background-color:#4d88ff;">
					<h3 class="card-title" style="color:white;">Tempat Sandar</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Nama</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->sandar_nama ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Panjang</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->sandar_panjang ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Lebar</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->sandar_lebar ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Kedalaman</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->sandar_kedalaman ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Kontruksi</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->sandar_konstruksi ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header" style="background-color:#6699ff;">
					<h3 class="card-title" style="color:white;">Gudang Dan Lapangan Penumpukan</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Nama</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->gudang_nama ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Luas</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->gudang_luas ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Kapasitas</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->gudang_kapasitas ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Jumlah</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->gudang_jumlah ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header" style="background-color:#80aaff;">
					<h3 class="card-title" style="color:white;">Terminal Penumpang</h3>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Jumlah</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->terminal_jumlah ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
								<label class="col-md-2 col-form-label">Ukuran</label>
								<div class="col-md-4">
									<input type="text" name="total" value="<?= $pelabuhanLaut->terminal_ukuran ?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div class="row">
								<label class="col-md-2 col-form-label">Kapasitas</label>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?= $pelabuhanLaut->terminal_kapasitas ?>" disabled>
								<div class="text-danger warning-provinsi"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- row closed -->
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
