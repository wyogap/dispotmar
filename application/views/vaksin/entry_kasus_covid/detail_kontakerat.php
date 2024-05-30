<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Tracer Covid</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detail Kontak Erat</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- Detail Tab -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Detail Kasus</div>
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
							<form class="form-horizontal" method="POST" enctype="multipart/form-data">
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
											<br>
											<div id="profile-log-switch">
												<div class="row">
													<br>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Tanggal
																Laporan</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->tanggallapor ?>" disabled>
																<div class="invalid-feedback warning-tanggallapor">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">NIK</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->nik ?>" disabled>
																<div class="invalid-feedback warning-nik"></div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Provinsi</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->PROVINSI ?>" disabled>
																<div class="invalid-feedback warning-nik"></div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Nama KTP</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->namaktp ?>" disabled>
																<div class="text-danger warning-namaktp"></div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Usia</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->umur ?>" disabled>
																<div class="invalid-feedback warning-umur"></div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Kabupaten</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->KABUPATEN ?>" disabled>
																<div class="text-danger warning-kabupaten"></div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">No Hp/WA</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->telphp ?>" disabled>
																<div class="text-danger warning-telphp"></div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Alamat KTP</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->alamatktp ?>" disabled>
																<div class="invalid-feedback warning-alamatktp"></div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Kecamatan</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->KECAMATAN ?>" disabled>
																<div class="text-danger warning-kecamatan"></div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">

														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Alamat
																Domisili</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->alamatdomisili ?>" disabled>
																<div class="invalid-feedback warning-alamatdomisili">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Kelurahan</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->KELURAHAN ?>" disabled>
																<div class="text-danger warning-kelurahan"></div>
																<input type="text" id="" name="" style="display:none;"
																	class="form-control">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="tab-pane fade p-0 " id="gejala" role="tabpanel"
											aria-labelledby="gejala-tab">
											<br>
											<div id="profile-log-switch">
												<div class="row">
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Status</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->status ?>" disabled>
																<div class="invalid-feedback warning-ddlstatus"></div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Gejala</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->gejala ?>" disabled>
																<div class="text-danger warning-ddlgejala"></div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Faskes</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->faskes ?>" disabled>
																<div class="text-danger warning-faskes"></div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Deskripsi
																Gejala</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->deskripsigejala ?>"
																	disabled>
																<div class="invalid-feedback warning-deskripsigejala">
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">
															<label class="col-md-4 col-form-label">Lokasi
																Karantina</label>
															<div class="col-md-8">
																<input type="text" class="form-control"
																	value="<?= $kasuscovid->lokasikarantina ?>"
																	disabled>
																<div class="text-danger warning-faskes"></div>
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-12">
														<div class="form-group row">

														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="tab-pane fade p-0 " id="pelapor" role="tabpanel"
											aria-labelledby="pelapor-tab">
											<br>
											<div class="row">
												<div class="col-lg-4 col-md-12">
													<div class="form-group row">
														<label class="col-md-4 col-form-label">Kotama</label>
														<div class="col-md-8">
															<input type="text" class="form-control"
																value="<?= $kasuscovid->namakotama ?>" disabled>
															<div class="text-danger warning-kotama"></div>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-12">
													<div class="form-group row">
														<label class="col-md-4 col-form-label">Satuan Kerja</label>
														<div class="col-md-8">
															<input type="text" class="form-control"
																value="<?= $kasuscovid->nama_satker ?>" disabled>
															<div class="text-danger warning-satkerpelapor"></div>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-12">
													<div class="form-group row">
														<label class="col-md-4 col-form-label">Pelapor</label>
														<div class="col-md-8">
															<input type="text" class="form-control"
																value="<?= $kasuscovid->nama_pegawai ?>" disabled>
															<div class="text-danger warning-reportedby"></div>
														</div>
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
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<!-- Table List -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">List Detail Kontak Erat</div>
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
						<div class="col-md-12 text-right">
							<button class="btn btn-success" id="tambahdatas" data-toggle="modal"
								data-target="#tambahdata">
								Tambah Data
							</button>
						</div>
					</div>
					<br>
					<div class="table-responsive">
						<table id="example" style="table-layout: auto; width: 100%;"
							class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<th>Opsi</th>
								<th>No</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Usia</th>
								<th>Nomer Hp</th>
								<th>Pekerjaan</th>
								<th>Alamat</th>
								<th>Provinsi</th>
								<th>Kab/ Kota</th>
								<th>Kecamatan</th>
								<th>Updated By</th>
								<th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($dataKontakErat as $kontak): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('VAKSIN','update')): ?>
										<button onclick="editModal(`<?= encrypt($kontak->idkontak); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('VAKSIN','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($kontak->idkontak); ?>`,'<?= $kontak->namaktp; ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $kontak->nik ?></td>
									<td><?= $kontak->namaktp ?></td>
									<td><?= $kontak->umur ?></td>
									<td><?= $kontak->nohp ?></td>
									<td><?= $kontak->pekerjaan ?></td>
									<td><?= $kontak->alamatdomisili ?></td>
									<td><?= $kontak->PROVINSI ?></td>
									<td><?= $kontak->KABUPATEN ?></td>
									<td><?= $kontak->KECAMATAN ?></td>
									<td><?= $kontak->nama_pegawai ?></td>
									<td><?= $kontak->updated_date ?></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<!-- Hapus Data-->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form id="formDelete" method="POST" action="">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
						value="<?= $this->security->get_csrf_hash();?>">
					<input type="hidden" name="id" value="">
					<div class="modal-body">
						<span id="delete-modal-content"></span>
					</div>
					<div class="modal-footer">
						<button class="btn" type="button" data-dismiss="modal">Batal</button>
						<button class="btn btn-danger" type="submit">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<!-- Tambah Data Kontak Erat-->
	<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahdata" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document" style="margin-right:200px;">
			<div class="modal-content" style="width:700px;">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" method="POST" id="addForm">
					<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Wilayah Domisili</label>
									<div class="col-md-9">
										<div class="col-md-15">
											<select class="form-control" id="provinsi" name="provinsi"
												style="width: 100%;">
												<option value="">Pilih Provinsi</option>
												<?php foreach($provinsi as $prov): ?>
												<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
												<?php endforeach ?>
											</select>
											<div class="text-danger warning-provinsi"></div>
										</div>
										<br>
										<div class="col-md-15">
											<select class="form-control" id="kabupaten" name="kabupaten"
												style="width: 100%;">
												<option value="">Pilih Kabupaten</option>
											</select>
										</div>
										<br>
										<div class="col-md-15">
											<select class="form-control" id="kecamatan" name="kecamatan"
												style="width: 100%;">
												<option value="">Pilih Kecamatan</option>
											</select>
											<input type="text" id="flag_location" name="flag_location"
												style="display:none;" class="form-control">
											<br>
											<input type="text" id="idkasus" name="idkasus"
												value="<?= $kasuscovid->idkasus ?>" style="display:none;"
												class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nik">NIK</label>
									<div class="col-md-9">
										<input type="text"
											oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
											pattern="(?=).{1,20}" title="Must contain 20 Number" id="nik" name="nik"
											class="form-control">
										<div class="invalid-feedback warning-nik"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="namaktp">Nama KTP</label>
									<div class="col-md-9">
										<input type="text" id="namaktp" name="namaktp" class="form-control">
										<div class="invalid-feedback warning-namaktp"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="umur">Usia</label>
									<div class="col-md-9">
										<input type="number" id="umur" name="umur" class="form-control">
										<div class="invalid-feedback warning-umur"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="Pekerjaan">Pekerjaan</label>
									<div class="col-md-9">
										<select class="form-control" name="pekerjaan" id="pekerjaan"
											style="width: 100%;">
											<option value="" selected>Pilih Pekerjaan</option>
											<option value="Karyawan Swasta">Karyawan Swasta</option>
											<option value="IRT">IRT</option>
											<option value="ASN/PNS">ASN/PNS</option>
											<option value="TNI">TNI</option>
											<option value="POLRI">POLRI</option>
											<option value="Pedagang">Pedagang</option>
											<option value="Petani">Petani</option>
											<option value="Nelayan">Nelayan</option>
											<option value="Wiraswasta">Wiraswasta</option>
											<option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
											<option value="Lain - Lain">Lain-lain</option>
										</select>
										<div class="invalid-feedback warning-pekerjaan"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nohp">No HP</label>
									<div class="col-md-9">
										<input type="text"
											oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
											pattern="(?=).{1,13}" title="Must contain 13 Number" id="nohp" name="nohp"
											class="form-control">
										<div class="invalid-feedback warning-nohp"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="alamatdomisili">Alamat Domisili</label>
									<div class="col-md-9">
										<input type="text" id="alamatdomisili" name="alamatdomisili"
											class="form-control">
										<div class="invalid-feedback warning-alamatdomisili"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<!-- Edit Data -->
	<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document" style="margin-right:200px;">
			<div class="modal-content" style="width:700px;">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" method="POST" id="editForm">
					<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
					<input type="hidden" name="id" value="">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Wilayah Domisili</label>
									<div class="col-md-9">
										<div class="col-md-15">
											<select class="form-control" id="provinsiEdit" name="provinsiEdit"
												style="width: 100%;">
												<option value="">Pilih Provinsi</option>
												<?php foreach($provinsi as $prov): ?>
												<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
												<?php endforeach ?>
											</select>
											<div class="text-danger warning-provinsiEdit"></div>
										</div>
										<br>
										<div class="col-md-15">
											<select class="form-control" id="kabupatenEdit" name="kabupatenEdit"
												style="width: 100%;">
												<option value="">Pilih Kabupaten</option>
											</select>
										</div>
										<br>
										<div class="col-md-15">
											<select class="form-control" id="kecamatanEdit" name="kecamatanEdit"
												style="width: 100%;">
												<option value="">Pilih Kecamatan</option>
											</select>
											<input type="text" id="flag_locationEdit" name="flag_locationEdit"
												style="display:none;" class="form-control">
											<br>
											<input type="text" id="idkasusEdit" name="idkasusEdit"
												value="<?= $kasuscovid->idkasus ?>" style="display:none;"
												class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nikEdit">NIK</label>
									<div class="col-md-9">
										<input type="text"
											oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
											pattern="(?=).{1,20}" title="Must contain 20 Number" id="nikEdit"
											name="nikEdit" class="form-control">
										<div class="invalid-feedback warning-nikEdit"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="namaktpEdit">Nama KTP</label>
									<div class="col-md-9">
										<input type="text" id="namaktpEdit" name="namaktpEdit" class="form-control">
										<div class="invalid-feedback warning-namaktpEdit"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="umurEdit">Usia</label>
									<div class="col-md-9">
										<input type="number" id="umurEdit" name="umurEdit" class="form-control">
										<div class="invalid-feedback warning-umurEdit"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="PekerjaanEdit">Pekerjaan</label>
									<div class="col-md-9">
										<select class="form-control" name="pekerjaanEdit" id="pekerjaanEdit"
											style="width: 100%;">
											<option value="" selected>Pilih Pekerjaan</option>
											<option value="Karyawan Swasta">Karyawan Swasta</option>
											<option value="IRT">IRT</option>
											<option value="ASN/PNS">ASN/PNS</option>
											<option value="TNI">TNI</option>
											<option value="POLRI">POLRI</option>
											<option value="Pedagang">Pedagang</option>
											<option value="Petani">Petani</option>
											<option value="Nelayan">Nelayan</option>
											<option value="Wiraswasta">Wiraswasta</option>
											<option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
											<option value="Lain - Lain">Lain-lain</option>
										</select>
										<div class="invalid-feedback warning-pekerjaan"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nohpEdit">No HP</label>
									<div class="col-md-9">
										<input type="text"
											oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
											pattern="(?=).{1,13}" title="Must contain 13 Number" id="nohpEdit"
											name="nohpEdit" class="form-control">
										<div class="invalid-feedback warning-nohpEdit"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="alamatdomisiliEdit">Alamat
										Domisili</label>
									<div class="col-md-9">
										<input type="text" id="alamatdomisiliEdit" name="alamatdomisiliEdit"
											class="form-control">
										<div class="invalid-feedback warning-alamatdomisiliEdit"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function () {

		// $('.modal').on('hidden.bs.modal', function (e) {
		// 	$('select').find('option:selected').removeAttr('selected');
		// 	$('input').val('');

		// 	$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
		// });

		$("#provinsi").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#kabupaten").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#kecamatan").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#pekerjaan").select2({
			dropdownParent: $('#tambahdata')
		});

		$("#provinsiEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#kabupatenEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#kecamatanEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#pekerjaanEdit").select2({
			dropdownParent: $('#editModal')
		});

		$('#provinsi').change(function () {
			var id = $(this).val();
			$('#flag_location').val("prov");

			if (id) {
				$.ajax({
					url: "<?= site_url() ?>/api/getKabupaten/" + id,
					method: "GET",
					async: true,
					dataType: 'json',
					success: function (data) {
						var html = '';
						var i;
						html += '<option value="">Pilih Kabupaten</option>';
						for (i = 0; i < data.length; i++) {
							html += '<option value=' + data[i].id_geografi + '>' + data[i]
								.nama + '</option>';
						}
						$('#kabupaten').html(html);
					}
				});
				return false;
			} else {
				$('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
			}
		});
		$('#kabupaten').change(function () {
			var id = $(this).val();
			if (id == '') {
				$('#flag_location').val("prov");
			} else {
				$('#flag_location').val("kab");
			}

			if (id) {
				$.ajax({
					url: "<?= site_url() ?>/api/getKecamatan/" + id,
					method: "GET",
					async: true,
					dataType: 'json',
					success: function (data) {
						var html = '';
						var i;
						html += '<option value="">Pilih Kecamatan</option>';
						for (i = 0; i < data.length; i++) {
							html += '<option value=' + data[i].id_geografi + '>' + data[i]
								.nama + '</option>';
						}
						$('#kecamatan').html(html);
					}
				});
				return false;
			} else {
				$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
			}
		});
		$('#kecamatan').change(function () {
			var id = $(this).val();
			if (id == '') {
				$('#flag_location').val("kab");
			} else {
				$('#flag_location').val("kec");
			}
		});

		$('#provinsiEdit').change(function () {
			var id = $(this).val();
			$('#flag_locationEdit').val("prov");

			if (id) {
				$.ajax({
					url: "<?= site_url() ?>/api/getKabupaten/" + id,
					method: "GET",
					async: true,
					dataType: 'json',
					success: function (data) {
						var html = '';
						var i;
						html += '<option value="">Pilih Kabupaten</option>';
						for (i = 0; i < data.length; i++) {
							html += '<option value=' + data[i].id_geografi + '>' + data[i]
								.nama + '</option>';
						}
						$('#kabupatenEdit').html(html);
					}
				});
				return false;
			} else {
				$('#kabupatenEdit').html('<option value="">Pilih Kabupaten</option>');
			}
		});
		$('#kabupatenEdit').change(function () {
			var id = $(this).val();
			if (id == '') {
				$('#flag_locationEdit').val("prov");
			} else {
				$('#flag_locationEdit').val("kab");
			}

			if (id) {
				$.ajax({
					url: "<?= site_url() ?>/api/getKecamatan/" + id,
					method: "GET",
					async: true,
					dataType: 'json',
					success: function (data) {
						var html = '';
						var i;
						html += '<option value="">Pilih Kecamatan</option>';
						for (i = 0; i < data.length; i++) {
							html += '<option value=' + data[i].id_geografi + '>' + data[i]
								.nama + '</option>';
						}
						$('#kecamatanEdit').html(html);
					}
				});
				return false;
			} else {
				$('#kecamatanEdit').html('<option value="">Pilih Kecamatan</option>');
			}
		});
		$('#kecamatanEdit').change(function () {
			var id = $(this).val();
			if (id == '') {
				$('#flag_locationEdit').val("kab");
			} else {
				$('#flag_locationEdit').val("kec");
			}
		});

		$('#addForm').submit(function () {
			if (
				$('#kabupaten').val() == '' ||
				$('#kecamatan').val() == ''
			) {
				alert("Lengkapi data terlebih dahulu !")
			} else {
				$.ajax({
					type: "POST",
					url: "<?= site_url() ?>/entry_kasus_covid/store_kontakerat",
					dataType: "json",
					data: $(this).serialize(),
					success: function (data) {
						if (data[0].status == 0) {
							$('input[name="csrf_al"]').val(data[0].csrf)
							$.each(data[1], function (key, value) {
								$('.warning-' + key).html(value)
								$('.warning-' + key).show()
								if ($('input[name="' + key + '"]').val() == '') {
									$('input[name="' + key + '"]').addClass(
										'is-invalid')
								}
							});
						} else {
							window.location.reload();
						}
					},
					error: function (data) {
						console.log(data)
					}
				});
			}

			return false;
		});

		$('#editForm').submit(function () {
			if (
				$('#kabupatenEdit').val() == '' ||
				$('#kecamatanEdit').val() == ''
			) {
				alert("Lengkapi data terlebih dahulu !")
			} else {
				$.ajax({
					type: "POST",
					url: "<?= site_url() ?>/entry_kasus_covid/update_kontakerat",
					dataType: "json",
					data: $(this).serialize(),
					success: function (data) {
						if (data[0].status == 0) {
							$('input[name="csrf_al"]').val(data[0].csrf)
							$.each(data[1], function (key, value) {
								$('input[name="' + key + '"]').addClass('is-invalid')
								$('.warning-' + key).html(value)
							});
						} else {
							location.reload(true);
						}
					},
					error: function (data) {
						console.log(data)
					}
				});
			}

			return false;
		});

	});

	function editModal(id) {
		$('#editModal').modal();

		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: '<?= site_url()?>entry_kasus_covid/edit_kontakerat/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('select[name=provinsiEdit]').find('option:selected').removeAttr('selected');
				$('select[name=kabupatenEdit]').find('option:selected').removeAttr('selected');
				$('select[name=kecamatanEdit]').find('option:selected').removeAttr('selected');
				$('select[name=pekerjaanEdit]').find('option:selected').removeAttr('selected');
				$('input[name="id"]').val(id);
				$('#nikEdit').val(data.Editkontakerat.nik);
				$('#namaktpEdit').val(data.Editkontakerat.namaktp);
				$('#umurEdit').val(data.Editkontakerat.umur);
				$('#pekerjaanEdit').val(data.Editkontakerat.pekerjaan);
				$("#alamatdomisiliEdit").val(data.Editkontakerat.alamatdomisili);
				$("#nohpEdit").val(data.Editkontakerat.nohp);
				$("#flag_locationEdit").val(data.Editkontakerat.flag_location);

				$("#pekerjaanEdit").trigger('change');
				$("#provinsiEdit").val(data.Editkontakerat.id_provinsi);

				if (data.Editkontakerat.flag_location == 'prov') {
					getProvinsi(data.Editkontakerat.id_provinsi)
					getKabupaten(data.Editkontakerat.id_provinsi, 0)
					getKecamatan(0, 0)
				} else if (data.Editkontakerat.flag_location == 'kab') {
					getProvinsi(data.Editkontakerat.id_provinsi)
					getKabupaten(data.Editkontakerat.id_provinsi, data.Editkontakerat.id_kabupaten)
					getKecamatan(data.Editkontakerat.id_kabupaten, 0)
				} else if (data.Editkontakerat.flag_location == 'kec') {
					getProvinsi(data.Editkontakerat.id_provinsi)
					getKabupaten(data.Editkontakerat.id_provinsi, data.Editkontakerat.id_kabupaten)
					getKecamatan(data.Editkontakerat.id_kabupaten, data.Editkontakerat.id_kecamatan)
				} else {
					getProvinsi(data.Editkontakerat.id_provinsi)
					getKabupaten(data.Editkontakerat.id_provinsi, data.Editkontakerat.id_kabupaten)
					getKecamatan(data.Editkontakerat.id_kabupaten, data.Editkontakerat.id_kecamatan)
				}
			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function getProvinsi(id_provinsi) {
		$.ajax({
			url: "<?= site_url()?>api/getProvinsi/" + id_provinsi,
			method: "GET",
			async: true,
			dataType: 'json',
			success: function (data) {
				//console.log(data);
				var html = '';
				var i;
				html += '<option value="">Pilih Provinsi</option>';
				for (i = 0; i < data.length; i++) {
					if (data[i].id_geografi == id_provinsi) {
						html += '<option value=' + data[i].id_geografi + ' selected>' + data[i].nama +
							'</option>';
					} else {
						html += '<option value=' + data[i].id_geografi + '>' + data[i].nama + '</option>';
					}
				}
				$('#provinsiEdit').html(html);
			}
		});
	}

	function getKabupaten(id_provinsi, id_kabupaten) {
		$.ajax({
			url: "<?= site_url()?>api/getKabupaten/" + id_provinsi,
			method: "GET",
			async: true,
			dataType: 'json',
			success: function (data) {
				var html = '';
				var i;
				html += '<option value="">Pilih Kabupaten</option>';
				for (i = 0; i < data.length; i++) {
					if (data[i].id_geografi == id_kabupaten) {
						html += '<option value=' + data[i].id_geografi + ' selected>' + data[i].nama +
							'</option>';
					} else {
						html += '<option value=' + data[i].id_geografi + '>' + data[i].nama + '</option>';
					}
				}
				$('#kabupatenEdit').html(html);
			}
		});
	}

	function getKecamatan(id_kabupaten, id_kecamatan) {
		$.ajax({
			url: "<?= site_url()?>api/getKecamatan/" + id_kabupaten,
			method: "GET",
			async: true,
			dataType: 'json',
			success: function (data) {
				var html = '';
				var i;
				html += '<option value="">Pilih Kecamatan</option>';
				for (i = 0; i < data.length; i++) {
					if (data[i].id_geografi == id_kecamatan) {
						html += '<option value=' + data[i].id_geografi + ' selected>' + data[i].nama +
							'</option>';
					} else {
						html += '<option value=' + data[i].id_geografi + '>' + data[i].nama + '</option>';
					}
				}
				$('#kecamatanEdit').html(html);
			}
		});
	}

	function getKelurahan(id_kecamatan, id_kelurahan) {
		$.ajax({
			url: "<?= site_url()?>api/getKelurahan/" + id_kecamatan,
			method: "GET",
			async: true,
			dataType: 'json',
			success: function (data) {
				var html = '';
				var i;
				html += '<option value="">Pilih Kelurahan</option>';
				for (i = 0; i < data.length; i++) {
					if (data[i].id_geografi == id_kelurahan) {
						html += '<option value=' + data[i].id_geografi + ' selected>' + data[i].nama +
							'</option>';
					} else {
						html += '<option value=' + data[i].id_geografi + '>' + data[i].nama + '</option>';
					}
				}
				$('#kelurahanEdit').html(html);
			}
		});
	}

	function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data dengan Nama :  <b>' + content + '</b>');
		$('#formDelete').attr('action', '<?= site_url()?>entry_kasus_covid/' + id + '/deletekontakerat');
		$('#deleteModal').modal();
	}

</script>