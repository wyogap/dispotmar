<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Geografi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Industri Jasa Maritim</li>
			<li class="breadcrumb-item active" aria-current="page">Angkutan Laut Nasional</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Angkutan Laut Nasional</div>
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
                        <div class="col-md-12 col-lg-12 card-title">Pelayaran Rakyat</div>
						<div class="col-md-12 text-right">
							<button class="btn btn-success" id="tambahdatas" data-toggle="modal" data-target="#tambahDataPelayaran">
								Tambah Data
							</button>
						</div>
					</div>
					<br>
					<div class="table-responsive">
					<table id="example" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
                                <th>Opsi</th>
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
                                <th>Ket</th>
								<th>Updated By</th>
                                <th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($dataPelayaran as $pelayaran): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('GEO','update')): ?>
										<button onclick="editModalPelayaran(`<?= encrypt($pelayaran->id_pelayaran_rakyat); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('GEO','delete')): ?>
										<button
											onclick="deleteConfirmPelayaran(`<?= encrypt($pelayaran->id_pelayaran_rakyat); ?>`,'<?= $pelayaran->nama_perusahaan ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $pelayaran->nama_satker ?></td>
									<td><?= $pelayaran->wilayah ?></td>
									<td><?= $pelayaran->nama_perusahaan ?></td>
									<td><?= $pelayaran->nama_kapal ?></td>
									<td><?= $pelayaran->gt_kapal ?></td>
									<td><?= $pelayaran->rute ?></td>
									<td><?= $pelayaran->frekuensi_pelayaran ?></td>
									<td><?= $pelayaran->maks_daya_angkut_orang ?></td>
									<td><?= $pelayaran->maks_daya_angkut_transportasi ?></td>
									<td><?= $pelayaran->keterangan ?></td>
									<td><?= $pelayaran->nama_pegawai ?></td>
									<td><?= $pelayaran->LastUpdated ?></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						<br>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
                        <div class="col-md-12 col-lg-12 card-title">Ekspedisi Laut</div>
						<div class="col-md-12 text-right">
							<button class="btn btn-success" id="tambahdatas1" data-toggle="modal" data-target="#tambahDataEkspedisi">
								Tambah Data
							</button>
						</div>
					</div>
					<br>
					<div class="table-responsive">
					<table id="example1" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
                                <th>Opsi</th>
								<th>No</th>
								<th>Satker</th>
								<th>Wilayah</th>
								<th>Nama Perusahaan</th>
                                <th>Jenis Barang / Muatan</th>
                                <th>Frekuensi Pelayaran</th>
                                <th>Jumlah Kapal</th>
                                <th>GT Kapal</th>
                                <th>Ket</th>
                                <th>Updated By</th>
                                <th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($dataEkspedisi as $ekspedisi): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('GEO','update')): ?>
										<button onclick="editModalEkspedisi(`<?= encrypt($ekspedisi->id_ekspedisi_laut); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('GEO','delete')): ?>
										<button
											onclick="deleteConfirmEkspedisi(`<?= encrypt($ekspedisi->id_ekspedisi_laut); ?>`,'<?= $ekspedisi->nama_perusahaan ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $ekspedisi->nama_satker ?></td>
									<td><?= $ekspedisi->wilayah ?></td>
									<td><?= $ekspedisi->nama_perusahaan ?></td>
									<td><?= $ekspedisi->jenis_muatan ?></td>
									<td><?= $ekspedisi->frekuensi_pelayaran ?></td>
									<td><?= $ekspedisi->jumlah_kapal ?></td>
									<td><?= $ekspedisi->gt_kapal ?></td>
									<td><?= $ekspedisi->keterangan ?></td>
									<td><?= $ekspedisi->nama_pegawai ?></td>
									<td><?= $ekspedisi->LastUpdated ?></td>
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
</div>

<!-- Tambah Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahDataPelayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form class="form-horizontal" method="POST" id="addFormPelayaran">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker </label>
								<div class="col-md-9">
									<?php if(($this->session->userdata('role') == 'Satker')): ?>
										<input type="hidden" class="form-control" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
										<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
									<?php else: ?>
										<select class="form-control" id="satkerPelayaran" name="satker" style="width: 100%;">
									<?php endif ?>
										<option value="">Pilih Satuan Kerja</option>
										<?php foreach($satkers as $satker): ?>
										<option value="<?= $satker->id_satker ?>" <?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>><?= $satker->nama_satker ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-satker"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Wilayah</label>
								<div class="col-md-9">
									<div class="col-md-15">
										<select class="form-control" id="provinsiPelayaran" name="provinsi" style="width: 100%;">
											<option value="">Pilih Provinsi</option>
											<?php foreach($provinsi as $prov): ?>
											<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-provinsi"></div>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kabupatenPelayaran" name="kabupaten" style="width: 100%;">
											<option value="">Pilih Kabupaten</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kecamatanPelayaran" name="kecamatan" style="width: 100%;">
											<option value="">Pilih Kecamatan</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kelurahanPelayaran" name="kelurahan" style="width: 100%;">
											<option value="">Pilih Kelurahan</option>
										</select>
										<input type="text" id="flag_location" name="flag_location" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_pelayaran">Nama Perusahaan</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_pelayaran" class="form-control">
									<div class="invalid-feedback warning-nama_pelayaran"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_kapal">Nama Kapal</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_kapal" class="form-control">
									<div class="invalid-feedback warning-nama_kapal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="gt_kapal">GT Kapal</label>
								<div class="col-md-9">
									<input type="text" onkeypress="return isNumberKey(event)" id="" name="gt_kapal" class="form-control">
									<div class="invalid-feedback warning-gt_kapal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="rute">Rute</label>
								<div class="col-md-9">
									<input type="text" id="" name="rute" class="form-control">
									<div class="invalid-feedback warning-rute"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="frekuensi_pelayaran">Frekuensi Pelayaran</label>
								<div class="col-md-9">
									<input type="text" onkeypress="return isNumberKey(event)" id="" name="frekuensi_pelayaran" class="form-control">
									<div class="invalid-feedback warning-frekuensi_pelayaran"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="maks_daya_angkut_orang">Maksimum Daya Angkut Orang</label>
								<div class="col-md-9">
									<input type="text" id="" name="maks_daya_angkut_orang" class="form-control">
									<div class="invalid-feedback warning-maks_daya_angkut_orang"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="maks_daya_angkut_transportasi">Maksimum Daya Angkut Transportasi</label>
								<div class="col-md-9">
									<input type="text" id="" name="maks_daya_angkut_transportasi" class="form-control">
									<div class="invalid-feedback warning-maks_daya_angkut_transportasi"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="notes">Keterangan</label>
								<div class="col-md-9">
									<input type="text" id="" name="notes" class="form-control">
									<div class="text-danger warning-notes"></div>
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

<!-- Edit Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModalPelayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form class="form-horizontal" method="POST" id="editFormPelayaran">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker </label>
								<div class="col-md-9">
										<?php if(($this->session->userdata('role') == 'Satker')): ?>
											<input type="hidden" class="form-control" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" style="width: 100%;" disabled>
										<?php else: ?>
											<select class="form-control" id="satkerPelayaranEdit" name="satker" style="width: 100%;">
										<?php endif ?>
										<option value="">Pilih Satuan Kerja</option>
										<?php foreach($satkers as $satker): ?>
										<option value="<?= $satker->id_satker ?>"><?= $satker->nama_satker ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-satker"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Wilayah</label>
								<div class="col-md-9">
									<div class="col-md-15">
										<select class="form-control" id="provinsiEditPelayaran" name="provinsi" style="width: 100%;">
											<option value="">Pilih Provinsi</option>
											<?php foreach($provinsi as $prov): ?>
											<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-provinsi"></div>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kabupatenEditPelayaran" name="kabupaten" style="width: 100%;">
											<option value="">Pilih Kabupaten</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kecamatanEditPelayaran" name="kecamatan" style="width: 100%;">
											<option value="">Pilih Kecamatan</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kelurahanEditPelayaran" name="kelurahan" style="width: 100%;">
											<option value="">Pilih Kelurahan</option>
										</select>
										<input type="text" id="flag_locationedit" name="flag_locationedit" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_pelayaran">Nama Perusahaan</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_pelayaran" class="form-control">
									<div class="invalid-feedback warning-nama_pelayaran"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_kapal">Nama Kapal</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_kapal" class="form-control">
									<div class="invalid-feedback warning-nama_kapal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="gt_kapal">GT Kapal</label>
								<div class="col-md-9">
									<input type="text" onkeypress="return isNumberKey(event)" id="" name="gt_kapal" class="form-control">
									<div class="invalid-feedback warning-gt_kapal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="rute">Rute</label>
								<div class="col-md-9">
									<input type="text" id="" name="rute" class="form-control">
									<div class="invalid-feedback warning-rute"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="frekuensi_pelayaran">Frekuensi Pelayaran</label>
								<div class="col-md-9">
									<input type="text" onkeypress="return isNumberKey(event)" id="" name="frekuensi_pelayaran" class="form-control">
									<div class="invalid-feedback warning-frekuensi_pelayaran"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="maks_daya_angkut_orang">Maksimum Daya Angkut Orang</label>
								<div class="col-md-9">
									<input type="text" id="" name="maks_daya_angkut_orang" class="form-control">
									<div class="invalid-feedback warning-maks_daya_angkut_orang"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="maks_daya_angkut_transportasi">Maksimum Daya Angkut Transportasi</label>
								<div class="col-md-9">
									<input type="text" id="" name="maks_daya_angkut_transportasi" class="form-control">
									<div class="invalid-feedback warning-maks_daya_angkut_transportasi"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="notes">Keterangan</label>
								<div class="col-md-9">
									<input type="text" id="" name="notes" class="form-control">
									<div class="text-danger warning-notes"></div>
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

<!-- Hapus Data-->
<div class="modal fade" id="deleteModalPelayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="formDeletePelayaran" method="POST" action="">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body">
					<span id="delete-modal-content-pelayaran"></span>
				</div>
				<div class="modal-footer">
					<button class="btn" type="button" data-dismiss="modal">Batal</button>
					<button class="btn btn-danger" type="submit">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Tambah Data -->
<div class="modal fade" id="tambahDataEkspedisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form class="form-horizontal" method="POST" id="addFormEkspedisi">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker </label>
								<div class="col-md-9">
									<?php if(($this->session->userdata('role') == 'Satker')): ?>
										<input type="hidden" class="form-control" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
										<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
									<?php else: ?>
										<select class="form-control" id="satkerEkspedisi" name="satker" style="width: 100%;">
									<?php endif ?>
										<option value="">Pilih Satuan Kerja</option>
										<?php foreach($satkers as $satker): ?>
										<option value="<?= $satker->id_satker ?>" <?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>><?= $satker->nama_satker ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-satker"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Wilayah</label>
								<div class="col-md-9">
									<div class="col-md-15">
										<select class="form-control" id="provinsiEkspedisi" name="provinsi" style="width: 100%;">
											<option value="">Pilih Provinsi</option>
											<?php foreach($provinsi as $prov): ?>
											<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-provinsi"></div>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kabupatenEkspedisi" name="kabupaten" style="width: 100%;">
											<option value="">Pilih Kabupaten</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kecamatanEkspedisi" name="kecamatan" style="width: 100%;">
											<option value="">Pilih Kecamatan</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kelurahanEkspedisi" name="kelurahan" style="width: 100%;">
											<option value="">Pilih Kelurahan</option>
										</select>
										<input type="text" id="flag_location1" name="flag_location1" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_perusahaan">Nama Perusahaan</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_perusahaan" class="form-control">
									<div class="invalid-feedback warning-nama_perusahaan"></div>
								</div>
							</div>
							<!-- <div class="form-group row">
								<label class="col-md-3 col-form-label" for="jenis_muatan">Jenis Muatan</label>
								<div class="col-md-9">
									<input type="text" id="" name="jenis_muatan" class="form-control">
									<div class="invalid-feedback warning-jenis_muatan"></div>
								</div>
							</div> -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jenis Muatan </label>
								<div class="col-md-9">
									<select class="form-control" name="jenis_muatan" id="jenis_muatan" style="width: 100%;">
										<?php foreach($jenisMuatan as $jenis): ?>
											<option value="<?= $jenis->id_jenis_muatan ?>"><?= $jenis->nama ?></option>
										<?php endforeach?>
									</select>
									<div class="invalid-feedback warning-jenis_muatan"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="frekuensi_pelayaran">Frekuensi Pelayaran</label>
								<div class="col-md-9">
									<input type="text" onkeypress="return isNumberKey(event)" id="" name="frekuensi_pelayaran" class="form-control">
									<div class="invalid-feedback warning-frekuensi_pelayaran"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="jumlah_kapal">Jumlah Kapal</label>
								<div class="col-md-9">
									<input type="number" id="" name="jumlah_kapal" class="form-control">
									<div class="invalid-feedback warning-jumlah_kapal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="gt_kapal">GT Kapal</label>
								<div class="col-md-9">
									<input type="text" onkeypress="return isNumberKey(event)" id="" name="gt_kapal" class="form-control">
									<div class="invalid-feedback warning-gt_kapal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="notes">Keterangan</label>
								<div class="col-md-9">
									<input type="text" id="" name="notes" class="form-control">
									<div class="text-danger warning-notes"></div>
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

<!-- Edit Data -->
<div class="modal fade" id="editModalEkspedisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form class="form-horizontal" method="POST" id="editFormEkspedisi">
			<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker </label>
								<div class="col-md-9">
										<?php if(($this->session->userdata('role') == 'Satker')): ?>
											<input type="hidden" class="form-control" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" style="width: 100%;" disabled>
										<?php else: ?>
											<select class="form-control" id="satkerEkspedisiEdit" name="satker" style="width: 100%;">
										<?php endif ?>
										<option value="">Pilih Satuan Kerja</option>
										<?php foreach($satkers as $satker): ?>
										<option value="<?= $satker->id_satker ?>"><?= $satker->nama_satker ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-satker"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Wilayah</label>
								<div class="col-md-9">
									<div class="col-md-15">
										<select class="form-control" id="provinsiEditEkspedisi" name="provinsi" style="width: 100%;">
											<option value="">Pilih Provinsi</option>
											<?php foreach($provinsi as $prov): ?>
											<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-provinsi"></div>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kabupatenEditEkspedisi" name="kabupaten" style="width: 100%;">
											<option value="">Pilih Kabupaten</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kecamatanEditEkspedisi" name="kecamatan" style="width: 100%;">
											<option value="">Pilih Kecamatan</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kelurahanEditEkspedisi" name="kelurahan" style="width: 100%;">
											<option value="">Pilih Kelurahan</option>
										</select>
										<input type="text" id="flag_locationedit1" name="flag_locationedit1" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_perusahaan">Nama Perusahaan</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_perusahaan" class="form-control">
									<div class="invalid-feedback warning-nama_perusahaan"></div>
								</div>
							</div>
							<!-- <div class="form-group row">
								<label class="col-md-3 col-form-label" for="jenis_muatan">Jenis Muatan</label>
								<div class="col-md-9">
									<input type="text" id="" name="jenis_muatan" class="form-control">
									<div class="invalid-feedback warning-jenis_muatan"></div>
								</div>
							</div> -->
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jenis Muatan </label>
								<div class="col-md-9">
									<select class="form-control" name="jenis_muatan" id="jenis_muatanEdit" style="width: 100%;">
										<?php foreach($jenisMuatan as $jenis): ?>
											<option value="<?= $jenis->id_jenis_muatan ?>"><?= $jenis->nama ?></option>
										<?php endforeach?>
									</select>
									<div class="invalid-feedback warning-jenis_muatan"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="frekuensi_pelayaran">Frekuensi Pelayaran</label>
								<div class="col-md-9">
									<input type="text" onkeypress="return isNumberKey(event)" id="" name="frekuensi_pelayaran" class="form-control">
									<div class="invalid-feedback warning-frekuensi_pelayaran"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="jumlah_kapal">Jumlah Kapal</label>
								<div class="col-md-9">
									<input type="number" id="" name="jumlah_kapal" class="form-control">
									<div class="invalid-feedback warning-jumlah_kapal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="gt_kapal">GT Kapal</label>
								<div class="col-md-9">
									<input type="text" onkeypress="return isNumberKey(event)" id="" name="gt_kapal" class="form-control">
									<div class="invalid-feedback warning-gt_kapal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="notes">Keterangan</label>
								<div class="col-md-9">
									<input type="text" id="" name="notes" class="form-control">
									<div class="text-danger warning-notes"></div>
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

<!-- Hapus Data-->
<div class="modal fade" id="deleteModalEkspedisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="formDeleteEkspedisi" method="POST" action="">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body">
					<span id="delete-modal-content-ekspedisi"></span>
				</div>
				<div class="modal-footer">
					<button class="btn" type="button" data-dismiss="modal">Batal</button>
					<button class="btn btn-danger" type="submit">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function () {
		$("#satkerPelayaran").select2({
			dropdownParent: $('#tambahDataPelayaran')
		});
		$("#provinsiPelayaran").select2({
			dropdownParent: $('#tambahDataPelayaran')
		});
		$("#kabupatenPelayaran").select2({
			dropdownParent: $('#tambahDataPelayaran')
		});
		$("#kecamatanPelayaran").select2({
			dropdownParent: $('#tambahDataPelayaran')
		});
		$("#kelurahanPelayaran").select2({
			dropdownParent: $('#tambahDataPelayaran')
		});


		$("#satkerPelayaranEdit").select2({
			dropdownParent: $('#editModalPelayaran')
		});
		$("#provinsiEditPelayaran").select2({
			dropdownParent: $('#editModalPelayaran')
		});
		$("#kabupatenEditPelayaran").select2({
			dropdownParent: $('#editModalPelayaran')
		});
		$("#kecamatanEditPelayaran").select2({
			dropdownParent: $('#editModalPelayaran')
		});
		$("#kelurahanEditPelayaran").select2({
			dropdownParent: $('#editModalPelayaran')
		});


		$("#satkerEkspedisi").select2({
			dropdownParent: $('#tambahDataEkspedisi')
		});
		$("#provinsiEkspedisi").select2({
			dropdownParent: $('#tambahDataEkspedisi')
		});
		$("#kabupatenEkspedisi").select2({
			dropdownParent: $('#tambahDataEkspedisi')
		});
		$("#kecamatanEkspedisi").select2({
			dropdownParent: $('#tambahDataEkspedisi')
		});
		$("#kelurahanEkspedisi").select2({
			dropdownParent: $('#tambahDataEkspedisi')
		});
		$("#jenis_muatan").select2({
			dropdownParent: $('#tambahDataEkspedisi')
		});


		$("#satkerEkspedisiEdit").select2({
			dropdownParent: $('#editModalEkspedisi')
		});
		$("#provinsiEditEkspedisi").select2({
			dropdownParent: $('#editModalEkspedisi')
		});
		$("#kabupatenEditEkspedisi").select2({
			dropdownParent: $('#editModalEkspedisi')
		});
		$("#kecamatanEditEkspedisi").select2({
			dropdownParent: $('#editModalEkspedisi')
		});
		$("#kelurahanEditEkspedisi").select2({
			dropdownParent: $('#editModalEkspedisi')
		});
		$("#jenis_muatanEdit").select2({
			dropdownParent: $('#editModalEkspedisi')
		});

		$('input').on('keyup change', function () {
			var name = $(this).attr('name')
			$('input[name="' + name + '"]').removeClass('is-invalid')
			$('.warning-' + name).html('')
		});

		$('select').on('change', function () {
			var name = $(this).attr('name')
			$('.warning-' + name).html('')
		});

		$('#addFormPelayaran').submit(function () {
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>/geografi_pelayaran/store",
				dataType: "json",
				data: $(this).serialize(),
				success: function (data) {
					if (data[0].status == 0) {
						$('input[name="csrf_al"]').val(data[0].csrf)
						$.each(data[1], function (key, value) {
							$('.warning-' + key).html(value)
							$('.warning-' + key).show()
							if ($('input[name="' + key + '"]').val() == '') {
								$('input[name="' + key + '"]').addClass('is-invalid')
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
			return false;
		});

		$('#editFormPelayaran').submit(function () {
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>geografi_pelayarans/update",
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
			return false;
		});

		$('.modal').on('hidden.bs.modal', function (e) {
			$('select').find('option:selected').removeAttr('selected');
			$('input').val('');

			<?php if(policy('GEO','read')): ?>
			$('select[name=satkerPicked] option[value="<?= $this->session->userdata('id_satker') ?>"]').attr('selected','selected');
			$('input[name="satker"]').val("<?= $this->session->userdata('id_satker') ?>")
			<?php endif ?>
			
			$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
		});

		$('#provinsiPelayaran').change(function(){ 
			var id= $(this).val();
			$('#flag_location').val("prov");

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKabupaten/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kabupaten</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kabupatenPelayaran').html(html);
					}
				});
				return false;
			} else {
				$('#kabupatenPelayaran').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 

		$('#kabupatenPelayaran').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location').val("prov");
			}
			else
			{
				$('#flag_location').val("kab");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKecamatan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kecamatan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kecamatanPelayaran').html(html);
					}
				});
				return false;
			} else {
				$('#kecamatanPelayaran').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 

		$('#kecamatanPelayaran').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location').val("kab");
			}
			else
			{
				$('#flag_location').val("kec");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKelurahan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kelurahan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kelurahanPelayaran').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahanPelayaran').html('<option value="">Pilih Kelurahan</option>');
			}
		}); 

		$('#kelurahanPelayaran').change(function(){
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location').val("kec");
			}
			else
			{
				$('#flag_location').val("kel");
			}
		}); 


		$('#provinsiEditPelayaran').change(function(){ 
			var id= $(this).val();
			$('#flag_locationedit').val("prov");

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKabupaten/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kabupaten</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kabupatenEditPelayaran').html(html);
						$('#kecamatanEditPelayaran').html('<option value="">Pilih Kecamatan</option>');
						$('#kelurahanEditPelayaran').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kabupatenEditPelayaran').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 

		$('#kabupatenEditPelayaran').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationedit').val("prov");
			}
			else
			{
				$('#flag_locationedit').val("kab");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKecamatan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kecamatan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kecamatanEditPelayaran').html(html);
						$('#kelurahanEditPelayaran').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kecamatanEditPelayaran').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 

		$('#kecamatanEditPelayaran').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationedit').val("kab");
			}
			else
			{
				$('#flag_locationedit').val("kec");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKelurahan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kelurahan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kelurahanEditPelayaran').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahanEditPelayaran').html('<option value="">Pilih Kelurahan</option>');
			}
		}); 

		$('#kelurahanEditPelayaran').change(function(){
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationedit').val("kec");
			}
			else
			{
				$('#flag_locationedit').val("kel");
			}
		}); 


		$('#addFormEkspedisi').submit(function () {
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>/geografi_ekspedisi/store",
				dataType: "json",
				data: $(this).serialize(),
				success: function (data) {
					if (data[0].status == 0) {
						$('input[name="csrf_al"]').val(data[0].csrf)
						$.each(data[1], function (key, value) {
							$('.warning-' + key).html(value)
							$('.warning-' + key).show()
							if ($('input[name="' + key + '"]').val() == '') {
								$('input[name="' + key + '"]').addClass('is-invalid')
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
			return false;
		});

		$('#editFormEkspedisi').submit(function () {
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>geografi_ekspedisis/update",
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
			return false;
		});

		$('#provinsiEkspedisi').change(function(){ 
			var id= $(this).val();
			$('#flag_location1').val("prov");

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKabupaten/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kabupaten</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kabupatenEkspedisi').html(html);
					}
				});
				return false;
			} else {
				$('#kabupatenEkspedisi').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 

		$('#kabupatenEkspedisi').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location1').val("prov");
			}
			else
			{
				$('#flag_location1').val("kab");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKecamatan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kecamatan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kecamatanEkspedisi').html(html);
					}
				});
				return false;
			} else {
				$('#kecamatanEkspedisi').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 

		$('#kecamatanEkspedisi').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location1').val("kab");
			}
			else
			{
				$('#flag_location1').val("kec");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKelurahan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kelurahan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kelurahanEkspedisi').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahanEkspedisi').html('<option value="">Pilih Kelurahan</option>');
			}
		}); 

		$('#kelurahanEkspedisi').change(function(){
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_location1').val("kec");
			}
			else
			{
				$('#flag_location1').val("kel");
			}
		}); 

		$('#provinsiEditEkspedisi').change(function(){ 
			var id= $(this).val();
			$('#flag_locationedit1').val("prov");

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKabupaten/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kabupaten</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kabupatenEditEkspedisi').html(html);
						$('#kecamatanEditEkspedisi').html('<option value="">Pilih Kecamatan</option>');
						$('#kelurahanEditEkspedisi').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kabupatenEditEkspedisi').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 

		$('#kabupatenEditEkspedisi').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationedit1').val("prov");
			}
			else
			{
				$('#flag_locationedit1').val("kab");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKecamatan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kecamatan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kecamatanEditEkspedisi').html(html);
						$('#kelurahanEditEkspedisi').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kecamatanEditEkspedisi').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 

		$('#kecamatanEditEkspedisi').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationedit1').val("kab");
			}
			else
			{
				$('#flag_locationedit1').val("kec");
			}

			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getKelurahan/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						var html = '';
						var i;
						html += '<option value="">Pilih Kelurahan</option>';
						for(i=0; i<data.length; i++){
							html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
						}
						$('#kelurahanEditEkspedisi').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahanEditEkspedisi').html('<option value="">Pilih Kelurahan</option>');
			}
		});

		$('#kelurahanEditEkspedisi').change(function(){
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationedit1').val("kec");
			}
			else
			{
				$('#flag_locationedit1').val("kel");
			}
		}); 
	});

	function getProvinsi(id_provinsi) {
		$.ajax({
			url : "api/getProvinsi/"+id_provinsi,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				//console.log(data);
				var html = '';
				var i;
				html += '<option value="">Pilih Provinsi</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_provinsi) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#provinsiEditPelayaran').html(html);
			}
		});
	}

	function getKabupaten(id_provinsi,id_kabupaten) {
		$.ajax({
			url : "<?= site_url() ?>api/getKabupaten/"+id_provinsi,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kabupaten</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kabupaten) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kabupatenEditPelayaran').html(html);
			}
		});
	}

	function getKecamatan(id_kabupaten,id_kecamatan) {
		$.ajax({
			url : "<?= site_url() ?>api/getKecamatan/"+id_kabupaten,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kecamatan</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kecamatan) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kecamatanEditPelayaran').html(html);
			}
		});
	}

	function getKelurahan(id_kecamatan,id_kelurahan) {
		$.ajax({
			url : "<?= site_url() ?>api/getKelurahan/"+id_kecamatan,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kelurahan</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kelurahan) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kelurahanEditPelayaran').html(html);
			}
		});
	}

	function editModalPelayaran(id) {
		$('#editModalPelayaran').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: '<?= site_url() ?>geografi_pelayaran/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
				$('select[name=satker]').find('option:selected').removeAttr('selected');
				$('select[name=satkerPicked]').find('option:selected').removeAttr('selected');
				$('select[name=provinsi]').find('option:selected').removeAttr('selected');
				$('select[name=kabupaten]').find('option:selected').removeAttr('selected');
				$('select[name=kecamatan]').find('option:selected').removeAttr('selected');
				$('select[name=kelurahan]').find('option:selected').removeAttr('selected');
				$('input[name="id"]').val(id);
				$('input[name="satker"]').val(data.pelayaran.id_satker);
				$('input[name="nama_pelayaran"]').val(data.pelayaran.nama_perusahaan);
				$('input[name="nama_kapal"]').val(data.pelayaran.nama_kapal);
				$('input[name="gt_kapal"]').val(data.pelayaran.gt_kapal);
				$('input[name="rute"]').val(data.pelayaran.rute);
				$('input[name="frekuensi_pelayaran"]').val(data.pelayaran.frekuensi_pelayaran);
				$('input[name="maks_daya_angkut_orang"]').val(data.pelayaran.maks_daya_angkut_orang);
				$('input[name="maks_daya_angkut_transportasi"]').val(data.pelayaran.maks_daya_angkut_transportasi);
				$('input[name="notes"]').val(data.pelayaran.keterangan);
				$('input[name="flag_locationedit"]').val(data.pelayaran.flag_location);
				//$("select[name=satker] option[value="+data.pelayaran.id_satker+"]").attr('selected','selected');
				$("select[name=satkerPicked] option[value=" + data.pelayaran.id_satker + "]").attr('selected','selected');
				//$("select[name=provinsi] option[value="+data.pelayaran.id_provinsi+"]").attr('selected','selected');

				$("#satkerPelayaranEdit").val(data.pelayaran.id_satker);
				$("#provinsiEditPelayaran").val(data.pelayaran.id_provinsi);
				
				$("#satkerPelayaranEdit").trigger('change');
				// $("#provinsiEditPelayaran").trigger('change');
				// $("#kabupatenEditPelayaran").trigger('change');
				// $("#kecamatanEditPelayaran").trigger('change');
				// $("#kelurahanEditPelayaran").trigger('change');

				// getProvinsi(data.pelayaran.id_provinsi)
				// getKabupaten(data.pelayaran.id_provinsi,data.pelayaran.id_kabupaten)
				// getKecamatan(data.pelayaran.id_kabupaten,data.pelayaran.id_kecamatan)
				// getKelurahan(data.pelayaran.id_kecamatan,data.pelayaran.id_kelurahan)

				if(data.pelayaran.flag_location == 'prov')
				{
					getProvinsi(data.pelayaran.id_provinsi)
					getKabupaten(data.pelayaran.id_provinsi,0)
					getKecamatan(0,0)
					getKelurahan(0,0)
				}
				else if(data.pelayaran.flag_location == 'kab')
				{
					getProvinsi(data.pelayaran.id_provinsi)
					getKabupaten(data.pelayaran.id_provinsi,data.pelayaran.id_kabupaten)
					getKecamatan(data.pelayaran.id_kabupaten,0)
					getKelurahan(0,0)
				}
				else if(data.pelayaran.flag_location == 'kec')
				{
					getProvinsi(data.pelayaran.id_provinsi)
					getKabupaten(data.pelayaran.id_provinsi,data.pelayaran.id_kabupaten)
					getKecamatan(data.pelayaran.id_kabupaten,data.pelayaran.id_kecamatan)
					getKelurahan(data.pelayaran.id_kecamatan,0)
				}
				else if(data.pelayaran.flag_location == 'kel')
				{
					getProvinsi(data.pelayaran.id_provinsi)
					getKabupaten(data.pelayaran.id_provinsi,data.pelayaran.id_kabupaten)
					getKecamatan(data.pelayaran.id_kabupaten,data.pelayaran.id_kecamatan)
					getKelurahan(data.pelayaran.id_kecamatan,data.pelayaran.id_kelurahan)
				}
				else
				{
					getProvinsi(data.pelayaran.id_provinsi)
					getKabupaten(data.pelayaran.id_provinsi,data.pelayaran.id_kabupaten)
					getKecamatan(data.pelayaran.id_kabupaten,data.pelayaran.id_kecamatan)
					getKelurahan(data.pelayaran.id_kecamatan,data.pelayaran.id_kelurahan)
				}
			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function deleteConfirmPelayaran(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content-pelayaran').html('Anda akan menghapus data <b>' + content + '</b>');
		$('#formDeletePelayaran').attr('action', '<?= site_url() ?>geografi_pelayaran/' + id + '/delete');
		$('#deleteModalPelayaran').modal();
	}


	function getProvinsiEkspedisi(id_provinsi) {
		$.ajax({
			url : "api/getProvinsi/"+id_provinsi,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				//console.log(data);
				var html = '';
				var i;
				html += '<option value="">Pilih Provinsi</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_provinsi) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#provinsiEditEkspedisi').html(html);
			}
		});
	}

	function getKabupatenEkspedisi(id_provinsi,id_kabupaten) {
		$.ajax({
			url : "<?= site_url() ?>api/getKabupaten/"+id_provinsi,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kabupaten</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kabupaten) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kabupatenEditEkspedisi').html(html);
			}
		});
	}

	function getKecamatanEkspedisi(id_kabupaten,id_kecamatan) {
		$.ajax({
			url : "<?= site_url() ?>api/getKecamatan/"+id_kabupaten,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kecamatan</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kecamatan) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kecamatanEditEkspedisi').html(html);
			}
		});
	}

	function getKelurahanEkspedisi(id_kecamatan,id_kelurahan) {
		$.ajax({
			url : "<?= site_url() ?>api/getKelurahan/"+id_kecamatan,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				html += '<option value="">Pilih Kelurahan</option>';
				for(i=0; i<data.length; i++){
					if (data[i].id_geografi == id_kelurahan) {
						html += '<option value='+data[i].id_geografi+' selected>'+data[i].nama+'</option>';
					}else{
						html += '<option value='+data[i].id_geografi+'>'+data[i].nama+'</option>';
					}
				}
				$('#kelurahanEditEkspedisi').html(html);
			}
		});
	}

	function editModalEkspedisi(id) {
		$('#editModalEkspedisi').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: '<?= site_url() ?>geografi_ekspedisi/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
				$('select[name=satker]').find('option:selected').removeAttr('selected');
				$('select[name=satkerPicked]').find('option:selected').removeAttr('selected');
				$('select[name=provinsi]').find('option:selected').removeAttr('selected');
				$('select[name=kabupaten]').find('option:selected').removeAttr('selected');
				$('select[name=kecamatan]').find('option:selected').removeAttr('selected');
				$('select[name=kelurahan]').find('option:selected').removeAttr('selected');
				$('select[name=jenis_muatan]').find('option:selected').removeAttr('selected');
				$('input[name="id"]').val(id);
				$('input[name="satker"]').val(data.ekspedisi.id_satker);
				$('input[name="nama_perusahaan"]').val(data.ekspedisi.nama_perusahaan);
				$('input[name="frekuensi_pelayaran"]').val(data.ekspedisi.frekuensi_pelayaran);
				$('input[name="jumlah_kapal"]').val(data.ekspedisi.jumlah_kapal);
				$('input[name="gt_kapal"]').val(data.ekspedisi.gt_kapal);
				$('input[name="notes"]').val(data.ekspedisi.keterangan);
				$('input[name="flag_locationedit1"]').val(data.ekspedisi.flag_location);
				//$("select[name=satker] option[value="+data.ekspedisi.id_satker+"]").attr('selected','selected');
				$("select[name=satkerPicked] option[value=" + data.ekspedisi.id_satker + "]").attr('selected','selected');
				//$("select[name=provinsi] option[value="+data.ekspedisi.id_provinsi+"]").attr('selected','selected');
				//$("select[name=jenis_muatan] option[value="+data.ekspedisi.id_jenis_muatan+"]").attr('selected','selected');

				$("#satkerEkspedisiEdit").val(data.ekspedisi.id_satker);
				$("#provinsiEditEkspedisi").val(data.ekspedisi.id_provinsi);
				$("#jenis_muatanEdit").val(data.ekspedisi.id_jenis_muatan);
				
				$("#satkerEkspedisiEdit").trigger('change');
				// $("#provinsiEditEkspedisi").trigger('change');
				// $("#kabupatenEditEkspedisi").trigger('change');
				// $("#kecamatanEditEkspedisi").trigger('change');
				// $("#kelurahanEditEkspedisi").trigger('change');
				$("#jenis_muatanEdit").trigger('change');

				// getProvinsiEkspedisi(data.ekspedisi.id_provinsi)
				// getKabupatenEkspedisi(data.ekspedisi.id_provinsi,data.ekspedisi.id_kabupaten)
				// getKecamatanEkspedisi(data.ekspedisi.id_kabupaten,data.ekspedisi.id_kecamatan)
				// getKelurahanEkspedisi(data.ekspedisi.id_kecamatan,data.ekspedisi.id_kelurahan)
				
				if(data.ekspedisi.flag_location == 'prov')
				{
					getProvinsiEkspedisi(data.ekspedisi.id_provinsi)
					getKabupatenEkspedisi(data.ekspedisi.id_provinsi,0)
					getKecamatanEkspedisi(0,0)
					getKelurahanEkspedisi(0,0)
				}
				else if(data.ekspedisi.flag_location == 'kab')
				{
					getProvinsiEkspedisi(data.ekspedisi.id_provinsi)
					getKabupatenEkspedisi(data.ekspedisi.id_provinsi,data.ekspedisi.id_kabupaten)
					getKecamatanEkspedisi(data.ekspedisi.id_kabupaten,0)
					getKelurahanEkspedisi(0,0)
				}
				else if(data.ekspedisi.flag_location == 'kec')
				{
					getProvinsiEkspedisi(data.ekspedisi.id_provinsi)
					getKabupatenEkspedisi(data.ekspedisi.id_provinsi,data.ekspedisi.id_kabupaten)
					getKecamatanEkspedisi(data.ekspedisi.id_kabupaten,data.ekspedisi.id_kecamatan)
					getKelurahanEkspedisi(data.ekspedisi.id_kecamatan,0)
				}
				else if(data.ekspedisi.flag_location == 'kel')
				{
					getProvinsiEkspedisi(data.ekspedisi.id_provinsi)
					getKabupatenEkspedisi(data.ekspedisi.id_provinsi,data.ekspedisi.id_kabupaten)
					getKecamatanEkspedisi(data.ekspedisi.id_kabupaten,data.ekspedisi.id_kecamatan)
					getKelurahanEkspedisi(data.ekspedisi.id_kecamatan,data.ekspedisi.id_kelurahan)
				}
				else
				{
					getProvinsiEkspedisi(data.ekspedisi.id_provinsi)
					getKabupatenEkspedisi(data.ekspedisi.id_provinsi,data.ekspedisi.id_kabupaten)
					getKecamatanEkspedisi(data.ekspedisi.id_kabupaten,data.ekspedisi.id_kecamatan)
					getKelurahanEkspedisi(data.ekspedisi.id_kecamatan,data.ekspedisi.id_kelurahan)
				}
			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function deleteConfirmEkspedisi(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content-ekspedisi').html('Anda akan menghapus data <b>' + content + '</b>');
		$('#formDeleteEkspedisi').attr('action', '<?= site_url() ?>geografi_ekspedisi/' + id + '/delete');
		$('#deleteModalEkspedisi').modal();
	}
</script>
