<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Tracer Covid</a></li>
			<li class="breadcrumb-item active" aria-current="page">View Entry Kasus Covid</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">View Entry Kasus Covid</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<form class="form-horizontal" method="POST" id="addForm" enctype="multipart/form-data">
								<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
									value="<?= $this->security->get_csrf_hash();?>">

								<div class="myTab">
									<ul class="nav  nav-tabs m-0" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active show" id="profile-tab" data-toggle="tab"
												href="#profile" role="tab" aria-controls="profile"
												aria-selected="false">Profile</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="gejala-tab" data-toggle="tab" href="#gejala"
												role="tab" aria-controls="gejala" aria-selected="true">Gejala</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="pelapor-tab" data-toggle="tab" href="#pelapor"
												role="tab" aria-controls="pelapor" aria-selected="true">Pelapor</a>
										</li>
									</ul>
									<div class="tab-content  p-3 border" id="myTabContent">
										<div class="tab-pane fade p-0 active show" id="profile" role="tabpanel"
											aria-labelledby="profile-tab">
											<div id="profile-log-switch">
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Tanggal Laporan</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->tanggallapor ?>" disabled>
														<div class="invalid-feedback warning-tanggallapor"></div>
													</div>
													<label class="col-md-2 col-form-label">Provinsi</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->PROVINSI ?>" disabled>
														<div class="invalid-feedback warning-nik"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">NIK</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->nik ?>" disabled>
														<div class="invalid-feedback warning-nik"></div>
													</div>
													<label class="col-md-2 col-form-label">Kabupaten</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->KABUPATEN ?>" disabled>
														<div class="text-danger warning-kabupaten"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Nama KTP</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->namaktp ?>" disabled>
														<div class="text-danger warning-namaktp"></div>
													</div>
													<label class="col-md-2 col-form-label">Kecamatan</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->KECAMATAN ?>" disabled>
														<div class="text-danger warning-kecamatan"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Usia</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->umur ?>" disabled>
														<div class="invalid-feedback warning-umur"></div>
													</div>
													<label class="col-md-2 col-form-label">Kelurahan</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->KELURAHAN ?>" disabled>
														<div class="text-danger warning-kelurahan"></div>
														<input type="text" id="flag_location" name="flag_location"
															style="display:none;" class="form-control">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">No Hp/WA</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->telphp ?>" disabled>
														<div class="text-danger warning-telphp"></div>
													</div>
													<label class="col-md-2 col-form-label">Alamat KTP</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->alamatktp ?>" disabled>
														<div class="invalid-feedback warning-alamatktp"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label"></label>
													<div class="col-md-4">
													</div>
													<label class="col-md-2 col-form-label">Alamat Domisili</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->alamatdomisili ?>" disabled>
														<div class="invalid-feedback warning-alamatdomisili"></div>
													</div>
												</div>
											</div>
										</div>

										<div class="tab-pane fade p-0 " id="gejala" role="tabpanel"
											aria-labelledby="gejala-tab">
											<div id="profile-log-switch">
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Status</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->status ?>" disabled>
														<div class="invalid-feedback warning-ddlstatus"></div>
													</div>
													<label class="col-md-2 col-form-label">Gejala</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->gejala ?>" disabled>
														<div class="text-danger warning-ddlgejala"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Faskes</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->faskes ?>" disabled>
														<div class="text-danger warning-faskes"></div>
													</div>
													<label class="col-md-2 col-form-label">Deskripsi Gejala</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->deskripsigejala ?>" disabled>
														<div class="invalid-feedback warning-deskripsigejala"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Lokasi Karantina</label>
													<div class="col-md-4">
														<input type="text" class="form-control"
															value="<?= $kasuscovid->lokasikarantina ?>" disabled>
														<div class="text-danger warning-faskes"></div>
													</div>
													<label class="col-md-2 col-form-label"></label>
													<div class="col-md-4">
														<div class="invalid-feedback warning-deskripsigejala"></div>
													</div>
												</div>
											</div>
										</div>

										<div class="tab-pane fade p-0 " id="pelapor" role="tabpanel"
											aria-labelledby="pelapor-tab">
											<div class="form-group row">
												<label class="col-md-2 col-form-label">Kotama</label>
												<div class="col-md-4">
													<input type="text" class="form-control"
														value="<?= $kasuscovid->namakotama ?>" disabled>
													<div class="text-danger warning-kotama"></div>
												</div>
												<label class="col-md-2 col-form-label">Satuan Kerja</label>
												<div class="col-md-4">
													<input type="text" class="form-control"
														value="<?= $kasuscovid->nama_satker ?>" disabled>
													<div class="text-danger warning-satkerpelapor"></div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 col-form-label">Pelapor</label>
												<div class="col-md-4">
													<input type="text" class="form-control"
														value="<?= $kasuscovid->nama_pegawai ?>" disabled>
													<div class="text-danger warning-reportedby"></div>
												</div>
												<label class="col-md-2 col-form-label"></label>
												<div class="col-md-4">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group mb-0 mt-3 justify-content-end">
									<div class="text-center">
										<a href="<?= site_url()?>entry_kasus_covid" class="btn btn-danger">Back To
											List</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>
