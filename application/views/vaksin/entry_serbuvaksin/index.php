<div class="section">
	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Tracer Vaksin</a></li>
			<li class="breadcrumb-item active" aria-current="page">Entry Serbu Vaksin</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Entry Serbu Vaksin</div>
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
								data-target="#tambahdata">Tambah Data</button>
						</div>
					</div>

					<br>
					<div class="table-responsive">
						<table id="example" style="table-layout: auto; width: 100%;"
							class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<th class="text-center">Opsi</th>
								<th style="width: 5%;">No</th>
								<th>Lokasi</th>
								<th>Alamat Lokasi</th>
								<th>Kotama</th>
								<th>Satker Pelaksana</th>
								<th>Vaksinator</th>
								<th>Jenis Vaksin</th>
								<th>Capaian</th>
								<th>Dosis Ke</th>
								<th>Tanggal</th>
								<th>ReportedBy</th>
								<th>Lampiran</th>

							</thead>
							<tbody>
								<?php $no = 1; foreach($dataEntrySerbuVaksin as $vaksin): ?>
								<tr>
									<td>
										<?php if(policy('VAKSIN','update')): ?>
										<a class="btn btn-sm btn-default"
											onclick="viewModal(`<?= encrypt($vaksin->idvaksin); ?>`)">
											<i class="fa fa-eye"></i>
										</a>
										<button onclick="editModal(`<?= encrypt($vaksin->idvaksin); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('VAKSIN','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($vaksin->idvaksin); ?>`,'<?= $vaksin->namalokasi; ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++;?></td>
									<td><?= $vaksin->namalokasi;?></td>
									<td><?= $vaksin->alamatlokasi;?></td>
									<td><?= $vaksin->namakotama;?></td>
									<td><?= $vaksin->nama_satker;?></td>
									<td><?= $vaksin->vaksinator;?></td>
									<td><?= $vaksin->jenisvaksin;?></td>
									<td><?= $vaksin->jumlah;?></td>
									<td><?= $vaksin->dosiske;?></td>
									<td><?= $vaksin->tanggal;?></td>
									<td><?= $vaksin->nama_pegawai;?></td>

									<?php if ($vaksin->lampirandok != null){ ?>
									<td><a href="<?= base_url();?>/uploads/covid19/serbuvaksin/<?= $vaksin->lampirandok;?>"
											target="_blank" class="btn btn-sm btn-info">Download</a></td>
									<?php }else{ ?>
									<td></td>
									<?php } ?>


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
</div>

<!-- Tambah Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahdata" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:700px;">
		<div class="modal-content" style="width:1200px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="addForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<div class="modal-body">
					<br>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Lokasi Giat</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="namalokasi" name="namalokasi" value="">
									<div class="text-danger warning-namalokasi"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Alamat</label>
								<div class="col-md-9">
									<textarea class="form-control" rows="3" id="alamatlokasi"
										name="alamatlokasi"></textarea>
									<div class="invalid-feedback warning-alamatlokasi"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Kotama</label>
								<div class="col-md-9">
									<select class="form-control" id="kotama" name="kotama" style="width:100%;">
										<option value="">Pilih Kotama</option>
										<?php foreach($kotamas as $kotama): ?>
										<option
											<?= $this->input->get('kotama') == $kotama->id_satker ? 'selected' : '' ?>
											value="<?= $kotama->id_satker ?>">
											<?= $kotama->nama_satker  ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-kotama"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker</label>
								<div class="col-md-9">
									<select class="form-control" id="satkerpelaksana" name="satkerpelaksana"
										style="width:100%;">
										<option value="">Pilih Satker</option>
									</select>
									<div class="text-danger warning-satkerpelaksana"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Vaksinator</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="vaksinator" name="vaksinator" value="">
									<div class="text-danger warning-vaksinator"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jumlah Vaksinator</label>
								<div class="col-md-9">
									<input type="number" class="form-control" id="jumlahvaksinator"
										name="jumlahvaksinator" value="">
									<div class="text-danger warning-jumlahvaksinator"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jenis Vaksin</label>
								<div class="col-md-9">
									<select class="form-control" id="jenisvaksin" name="jenisvaksin"
										style="width:100%;">
										<option value="">Pilih Jenis Vaksin</option>
										<option value="Sinovac">Sinovac</option>
										<option value="Astra Zeneca">Astra Zeneca</option>
									</select>
									<div class="text-danger warning-jenisvaksin"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jumlah Capaian</label>
								<div class="col-md-9">
									<input type="number" class="form-control" id="jumlah" name="jumlah" value="">
									<div class="text-danger warning-jumlah"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Dosis</label>
								<div class="col-md-9">
									<select class="form-control" id="dosiske" name="dosiske" style="width:100%;">
										<option value="">Pilih Dosis</option>
										<option value="Pertama">Pertama</option>
										<option value="Kedua">Kedua</option>
									</select>
									<div class="text-danger warning-dosiske"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Tanggal</label>
								<div class="col-md-9">
									<input type="date" class="form-control" name="tanggal" id="tanggal"
										placeholder="YYYY-MM-DD HH:ii:ss">
									<div class="invalid-feedback warning-tanggal"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Pelapor</label>
								<div class="col-md-9">
									<select class="form-control" id="reportedby" name="reportedby" style="width:100%;">
										<option value="">Pilih Pelapor</option>
										<?php foreach($users as $user): ?>
										<option value="<?= $user->id_user ?>"><?= $user->nama_pegawai ?>
										</option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-reportedby"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Lampiran</label>
								<div class="col-md-9">
									<input type="file" class="dropify" id="lampirandok" name="lampirandok">
									<div class="invalid-feedback warning-lampirandok"></div>
									<br>
									<label class=" col-form-label" style="color:red;">*Size Max 3 mb</label>
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:700px;">
		<div class="modal-content" style="width:1200px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<input type="hidden" id="id" name="idvaksin" value="">
				<div class="modal-body">
					<br>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Lokasi Giat</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="namalokasiEdit" name="namalokasiEdit"
										value="">
									<div class="text-danger warning-namalokasiEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Alamat</label>
								<div class="col-md-9">
									<textarea class="form-control" rows="3" id="alamatlokasiEdit"
										name="alamatlokasiEdit"></textarea>
									<div class="invalid-feedback warning-alamatlokasiEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Kotama</label>
								<div class="col-md-9">
									<select class="form-control" id="kotamaEdit" name="kotamaEdit" style="width:100%;">
										<option value="">Pilih Kotama</option>
										<?php foreach($kotamas as $kotama): ?>
										<option
											<?= $this->input->get('kotama') == $kotama->id_satker ? 'selected' : '' ?>
											value="<?= $kotama->id_satker ?>">
											<?= $kotama->nama_satker  ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-kotamaEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker</label>
								<div class="col-md-9">
									<select class="form-control" id="satkerpelaksanaEdit" name="satkerpelaksanaEdit"
										style="width:100%;">
										<option value="">Pilih Satker</option>
									</select>
									<div class="text-danger warning-satkerpelaksanaEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Vaksinator</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="vaksinatorEdit" name="vaksinatorEdit"
										value="">
									<div class="text-danger warning-vaksinatorEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jumlah Vaksinator</label>
								<div class="col-md-9">
									<input type="number" class="form-control" id="jumlahvaksinatorEdit"
										name="jumlahvaksinatorEdit" value="">
									<div class="text-danger warning-jumlahvaksinatorEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jenis Vaksin</label>
								<div class="col-md-9">
									<select class="form-control" id="jenisvaksinEdit" name="jenisvaksinEdit"
										style="width:100%;">
										<option value="">Pilih Jenis Vaksin</option>
										<option value="Sinovac">Sinovac</option>
										<option value="Astra Zeneca">Astra Zeneca</option>
									</select>
									<div class="text-danger warning-jenisvaksinEdit"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jumlah Capaian</label>
								<div class="col-md-9">
									<input type="number" class="form-control" id="jumlahEdit" name="jumlahEdit"
										value="">
									<div class="text-danger warning-jumlahEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Dosis</label>
								<div class="col-md-9">
									<select class="form-control" id="dosiskeEdit" name="dosiskeEdit"
										style="width:100%;">
										<option value="">Pilih Dosis</option>
										<option value="Pertama">Pertama</option>
										<option value="Kedua">Kedua</option>
									</select>
									<div class="text-danger warning-dosiskeEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Tanggal</label>
								<div class="col-md-9">
									<input type="date" class="form-control" name="tanggalEdit" id="tanggalEdit"
										placeholder="YYYY-MM-DD HH:ii:ss">
									<div class="invalid-feedback warning-tanggalEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Pelapor</label>
								<div class="col-md-9">
									<select class="form-control" id="reportedbyEdit" name="reportedbyEdit"
										style="width:100%;">
										<option value="">Pilih Pelapor</option>
										<?php foreach($users as $user): ?>
										<option value="<?= $user->id_user ?>"><?= $user->nama_pegawai ?>
										</option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-reportedbyEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Lampiran</label>
								<div class="col-md-9">
									<input type="file" class="dropify" id="lampirandokEdit" name="lampirandokEdit">
									<input type="hidden" class="form-control-file" name="oldImage" value="">
									<br>
									<a href="#" id="btndownload" target="_blank" style="display:none;"
										class="btn btn-sm btn-info">Download Lampiran!</a>
									<br>
									<label class=" col-form-label" style="color:red;">*Size Max 3 mb</label>
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

<!-- View Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="viewModal" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:700px;">
		<div class="modal-content" style="width:1200px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="viewForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>">
				<input type="hidden" id="idvaksinView" name="idvaksinView" value="">
				<div class="modal-body">
					<br>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Lokasi Giat</label>
								<div class="col-md-9">
									<input type="text" disabled class="form-control" id="namalokasiView"
										name="namalokasiView" value="">
									<div class="text-danger warning-namalokasiView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Alamat</label>
								<div class="col-md-9">
									<textarea class="form-control" disabled rows="3" id="alamatlokasiView"
										name="alamatlokasiView"></textarea>
									<div class="invalid-feedback warning-alamatlokasiView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Kotama</label>
								<div class="col-md-9">
									<select class="form-control" disabled id="kotamaView" name="kotamaView"
										style="width:100%;">
										<option value="">Pilih Kotama</option>
										<?php foreach($kotamas as $kotama): ?>
										<option
											<?= $this->input->get('kotama') == $kotama->id_satker ? 'selected' : '' ?>
											value="<?= $kotama->id_satker ?>">
											<?= $kotama->nama_satker  ?></option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-kotamaView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satker</label>
								<div class="col-md-9">
									<select class="form-control" disabled id="satkerpelaksanaView"
										name="satkerpelaksanaView" style="width:100%;">
										<option value="">Pilih Satker</option>
									</select>
									<div class="text-danger warning-satkerpelaksanaView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Vaksinator</label>
								<div class="col-md-9">
									<input type="text" disabled class="form-control" id="vaksinatorView"
										name="vaksinatorView" value="">
									<div class="text-danger warning-vaksinatorView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jumlah Vaksinator</label>
								<div class="col-md-9">
									<input type="number" disabled class="form-control" id="jumlahvaksinatorView"
										name="jumlahvaksinatorView" value="">
									<div class="text-danger warning-jumlahvaksinatorView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jenis Vaksin</label>
								<div class="col-md-9">
									<select class="form-control" disabled id="jenisvaksinView" name="jenisvaksinView"
										style="width:100%;">
										<option value="">Pilih Jenis Vaksin</option>
										<option value="Sinovac">Sinovac</option>
										<option value="Astra Zeneca">Astra Zeneca</option>
									</select>
									<div class="text-danger warning-jenisvaksinView"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jumlah Capaian</label>
								<div class="col-md-9">
									<input type="number" disabled class="form-control" id="jumlahView" name="jumlahView"
										value="">
									<div class="text-danger warning-jumlahView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Dosis</label>
								<div class="col-md-9">
									<select class="form-control" disabled id="dosiskeView" name="dosiskeView"
										style="width:100%;">
										<option value="">Pilih Dosis</option>
										<option value="Pertama">Pertama</option>
										<option value="Kedua">Kedua</option>
									</select>
									<div class="text-danger warning-dosiskeView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Tanggal</label>
								<div class="col-md-9">
									<input type="date" disabled class="form-control" name="tanggalView" id="tanggalView"
										placeholder="YYYY-MM-DD HH:ii:ss">
									<div class="invalid-feedback warning-tanggalView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Pelapor</label>
								<div class="col-md-9">
									<select class="form-control" disabled id="reportedbyView" name="reportedbyView"
										style="width:100%;">
										<option value="">Pilih Pelapor</option>
										<?php foreach($users as $user): ?>
										<option value="<?= $user->id_user ?>"><?= $user->nama_pegawai ?>
										</option>
										<?php endforeach ?>
									</select>
									<div class="text-danger warning-reportedbyView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Lampiran</label>
								<div class="col-md-9">
									<a href="#" target="_blank" id="btndownloadView" style="display:none;"
										class="btn btn-sm btn-info">Download Lampiran!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete Confirmation-->
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
					<!-- <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a> -->
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Script -->
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#kotama").select2({
			dropdownParent: $('#tambahdata')
		});

		$("#satkerpelaksana").select2({
			dropdownParent: $('#tambahdata')
		});

		$("#jenisvaksin").select2({
			dropdownParent: $('#tambahdata')
		});

		$("#dosiske").select2({
			dropdownParent: $('#tambahdata')
		});

		$("#reportedby").select2({
			dropdownParent: $('#tambahdata')
		});

		$("#kotamaEdit").select2({
			dropdownParent: $('#editModal')
		});

		$("#satkerpelaksanaEdit").select2({
			dropdownParent: $('#editModal')
		});

		$("#jenisvaksinEdit").select2({
			dropdownParent: $('#editModal')
		});

		$("#dosiskeEdit").select2({
			dropdownParent: $('#editModal')
		});

		$("#reportedbyEdit").select2({
			dropdownParent: $('#editModal')
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

		$('#kotama').change(function () {
			var id = $(this).val();
			if (id) {
				$.ajax({
					url: "<?= site_url() ?>api/getsatkerLevel2And3/" + id,
					method: "GET",
					async: true,
					dataType: 'json',
					success: function (data) {
						if (data.length > 0) {
							var html = '';
							var i;
							html += '<option value="">Pilih Satker</option>';
							for (i = 0; i < data.length; i++) {
								html += '<option value=' + data[i].id_satker + '>' + data[i]
									.nama_satker + '</option>';
							}
							$('#satkerpelaksana').html(html);
						} else {
							var html = '';
							var valueText_kotama = $('#kotama :selected').text();
							var value_kotama = $('#kotama').val();
							html += '<option value="">Pilih Satker</option>';
							html += '<option value=' + value_kotama + ' selected>' +
								valueText_kotama + '</option>';
							$('#satkerpelaksana').html(html);
						}

					}
				});
				return false;
			} else {
				$('#satkerpelaksana').html('<option value="">Pilih Satker</option>');
			}
		});

		$('#kotamaEdit').change(function () {
			var id = $(this).val();
			if (id) {
				$.ajax({
					url: "<?= site_url() ?>api/getsatkerLevel2And3/" + id,
					method: "GET",
					async: true,
					dataType: 'json',
					success: function (data) {
						if (data.length > 0) {
							var html = '';
							var i;
							html += '<option value="">Pilih Satker</option>';
							for (i = 0; i < data.length; i++) {
								html += '<option value=' + data[i].id_satker + '>' + data[i]
									.nama_satker + '</option>';
							}
							$('#satkerpelaksanaEdit').html(html);
						} else {
							var html = '';
							var valueText_kotama = $('#kotamaEdit :selected').text();
							var value_kotama = $('#kotamaEdit').val();
							html += '<option value="">Pilih Satker</option>';
							html += '<option value=' + value_kotama + ' selected>' +
								valueText_kotama + '</option>';
							$('#satkerpelaksanaEdit').html(html);
						}

					}
				});
				return false;
			} else {
				$('#satkerpelaksanaEdit').html('<option value="">Pilih Satker</option>');
			}
		});

		$('#addForm').submit(function () {

			if (
				$('#alamatlokasi').val() == "" ||
				$('#dosiske').val() == "" ||
				$('#satkerpelaksana').val() == "" ||
				$('#vaksinator').val() == "" ||
				$('#jumlahvaksinator').val() == "" ||
				$('#jenisvaksin').val() == "" ||
				$('#reportedby').val() == ""
			) {
				alert("Lengkapi data terlebih dahulu !");
			} else {
				var formData = new FormData();
				formData.append('csrf_al', $('input[name="csrf_al"]').val());
				formData.append('namalokasi', $('#namalokasi').val());
				formData.append('alamatlokasi', $('#alamatlokasi').val());
				formData.append('satkerpelaksana', $('#satkerpelaksana').val());
				formData.append('kotama', $('#kotama').val());
				formData.append('jenisvaksin', $('#jenisvaksin').val());
				formData.append('jumlah', $('#jumlah').val());
				formData.append('dosiske', $('#dosiske').val());
				formData.append('tanggal', $('#tanggal').val());
				formData.append('reportedby', $('#reportedby').val());
				formData.append('vaksinator', $('#vaksinator').val());
				formData.append('jumlahvaksinator', $('#jumlahvaksinator').val());
				// Attach file
				formData.append('lampirandok', $('#lampirandok')[0].files[0]);

				$.ajax({
					type: "POST",
					url: "entry_serbuvaksin/store",
					dataType: "json",
					data: formData,
					processData: false,
					contentType: false,
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
				$('#alamatlokasiEdit').val() == "" ||
				$('#dosiskeEdit').val() == "" ||
				$('#satkerpelaksanaEdit').val() == "" ||
				$('#vaksinatorEdit').val() == "" ||
				$('#jumlahvaksinatorEdit').val() == "" ||
				$('#jenisvaksinEdit').val() == "" ||
				$('#reportedbyEdit').val() == ""
			) {
				alert("Lengkapi data terlebih dahulu !");
			} else {
				var formData = new FormData();
				formData.append('csrf_al', $('input[name="csrf_al"]').val());
				formData.append('idvaksin', $('input[name="idvaksin"]').val());
				formData.append('namalokasiEdit', $('#namalokasiEdit').val());
				formData.append('alamatlokasiEdit', $('#alamatlokasiEdit').val());
				formData.append('satkerpelaksanaEdit', $('#satkerpelaksanaEdit').val());
				formData.append('kotamaEdit', $('#kotamaEdit').val());
				formData.append('jenisvaksinEdit', $('#jenisvaksinEdit').val());
				formData.append('jumlahEdit', $('#jumlahEdit').val());
				formData.append('dosiskeEdit', $('#dosiskeEdit').val());
				formData.append('tanggalEdit', $('#tanggalEdit').val());
				formData.append('reportedbyEdit', $('#reportedbyEdit').val());
				formData.append('vaksinatorEdit', $('#vaksinatorEdit').val());
				formData.append('jumlahvaksinatorEdit', $('#jumlahvaksinatorEdit').val());
				// Attach file
				formData.append('lampirandok', $('#lampirandokEdit')[0].files[0]);

				$.ajax({
					type: "POST",
					url: "entry_serbuvaksins/update",
					dataType: "json",
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {
						//console.log(data)
						if (data[0].status == 0) {
							$('input[name="csrf_al"]').val(data[0].csrf)
							$.each(data[1], function (key, value) {
								$('.warning-' + key).html(value)
								$('.warning-' + key).show()
								if ($('#' + key + 'Edit').val() == '') {
									$('#' + key + 'Edit').addClass('is-invalid')
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

		$('#editModal').on('hidden.bs.modal', function (e) {
			$('input').val('');
			$('select').find('option:selected').removeAttr('selected');
			$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
		});

		$('#viewModal').on('hidden.bs.modal', function (e) {
			$('input').val('');
			$('select').find('option:selected').removeAttr('selected');
			$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
		});

	});

	function editModal(id) {
		$('#editModal').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: 'entry_serbuvaksin/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('select[name=kotamaEdit]').find('option:selected').removeAttr('selected');
				$('select[name=satkerpelaksanaEdit]').find('option:selected').removeAttr('selected');
				$('select[name=jenisvaksinEdit]').find('option:selected').removeAttr('selected');
				$('select[name=dosiskeEdit]').find('option:selected').removeAttr('selected');
				$('select[name=reportedbyEdit]').find('option:selected').removeAttr('selected');

				$('input[name="idvaksin"]').val(id);
				$('#namalokasiEdit').val(data.vaksin.namalokasi);
				$('#alamatlokasiEdit').val(data.vaksin.alamatlokasi);
				$('#vaksinatorEdit').val(data.vaksin.vaksinator);
				$('#jumlahvaksinatorEdit').val(data.vaksin.jumlahvaksinator);
				$('#jumlahEdit').val(data.vaksin.jumlah);
				$('#tanggalEdit').val(data.vaksin.tanggal);
				$('input[name="oldImage"]').val(data.vaksin.lampirandok);
				$('#LampiranPreview').attr('src', `<?= base_url();?>/uploads/covid19/serbuvaksin/` + data
					.vaksin.lampirandok);

				$("#kotamaEdit").val(data.vaksin.kotama);
				$("#satkerpelaksanaEdit").val(data.vaksin.satkerpelaksana);
				$("#jenisvaksinEdit").val(data.vaksin.jenisvaksin);
				$("#dosiskeEdit").val(data.vaksin.dosiske);
				$("#reportedbyEdit").val(data.vaksin.reportedby);

				$("#kotamaEdit").trigger('change');
				$("#satkerpelaksanaEdit").trigger('change');
				$("#jenisvaksinEdit").trigger('change');
				$("#dosiskeEdit").trigger('change');
				$("#reportedbyEdit").trigger('change');

				if (data.vaksin.lampirandok != null) {
					$('#btndownload').show();
					$("#btndownload").prop("href", `<?= base_url();?>/uploads/covid19/serbuvaksin/` + data
						.vaksin.lampirandok);
				} else {
					$('#btndownload').hide();
				}

				if (data.vaksin.satkerpelaksana) {
					getsatker(data.vaksin.kotama, data.vaksin.satkerpelaksana)
				}

			},
			error: function () {
				alert('Could not displaying data');
			}
		});
	}

	function viewModal(id) {
		$('#viewModal').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: 'entry_serbuvaksin/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('select[name=kotamaView]').find('option:selected').removeAttr('selected');
				$('select[name=satkerpelaksanaView]').find('option:selected').removeAttr('selected');
				$('select[name=jenisvaksinView]').find('option:selected').removeAttr('selected');
				$('select[name=dosiskeView]').find('option:selected').removeAttr('selected');
				$('select[name=reportedbyView]').find('option:selected').removeAttr('selected');

				$('input[name="idvaksin"]').val(id);
				$('#namalokasiView').val(data.vaksin.namalokasi);
				$('#alamatlokasiView').val(data.vaksin.alamatlokasi);
				$('#vaksinatorView').val(data.vaksin.vaksinator);
				$('#jumlahvaksinatorView').val(data.vaksin.jumlahvaksinator);
				$('#jumlahView').val(data.vaksin.jumlah);
				$('#tanggalView').val(data.vaksin.tanggal);

				$("#kotamaView").val(data.vaksin.kotama);
				$("#satkerpelaksanaView").val(data.vaksin.satkerpelaksana);
				$("#jenisvaksinView").val(data.vaksin.jenisvaksin);
				$("#dosiskeView").val(data.vaksin.dosiske);
				$("#reportedbyView").val(data.vaksin.reportedby);

				$("#kotamaView").trigger('change');
				$("#satkerpelaksanaView").trigger('change');
				$("#jenisvaksinView").trigger('change');
				$("#dosiskeView").trigger('change');
				$("#reportedbyView").trigger('change');

				if (data.vaksin.lampirandok != null) {
					$('#btndownloadView').show();
					$("#btndownloadView").prop("href", `<?= base_url();?>/uploads/covid19/serbuvaksin/` + data
						.vaksin.lampirandok);
				} else {
					$('#btndownloadView').hide();
				}

				if (data.vaksin.satkerpelaksana) {
					getsatkerView(data.vaksin.kotama, data.vaksin.satkerpelaksana)
				}

			},
			error: function () {
				alert('Could not displaying data');
			}
		});
	}


	function getsatker(idkotama, idsatker) {
		if (idsatker) {
			$.ajax({
				url: "<?= site_url() ?>api/getsatkerLevel2And3/" + idkotama,
				method: "GET",
				async: true,
				dataType: 'json',
				success: function (data) {
					if (data.length > 0) {
						var html = '';
						var i;
						html += '<option value="">Pilih Satker</option>';
						for (i = 0; i < data.length; i++) {
							if (data[i].id_satker == idsatker) {
								html += '<option value=' + data[i].id_satker + ' selected>' + data[i]
									.nama_satker +
									'</option>';
							} else {
								html += '<option value=' + data[i].id_satker + '>' + data[i].nama_satker +
									'</option>';
							}
						}
						$('#satkerpelaksanaEdit').html(html);
					} else {
						var html = '';
						var valueText_kotama = $('#kotamaEdit :selected').text();
						var value_kotama = $('#kotamaEdit').val();
						html += '<option value="">Pilih Satker</option>';
						html += '<option value=' + value_kotama + ' selected>' + valueText_kotama +
							'</option>';
						$('#satkerpelaksanaEdit').html(html);
					}

				}
			});
			return false;
		} else {
			$('#satkerpelaksanaEdit').html('<option value="">Pilih Satker</option>');
		}
	}

	function getsatkerView(idkotama, idsatker) {
		if (idsatker) {
			$.ajax({
				url: "<?= site_url() ?>api/getsatkerLevel2And3/" + idkotama,
				method: "GET",
				async: true,
				dataType: 'json',
				success: function (data) {
					if (data.length > 0) {
						var html = '';
						var i;
						html += '<option value="">Pilih Satker</option>';
						for (i = 0; i < data.length; i++) {
							if (data[i].id_satker == idsatker) {
								html += '<option value=' + data[i].id_satker + ' selected>' + data[i]
									.nama_satker +
									'</option>';
							} else {
								html += '<option value=' + data[i].id_satker + '>' + data[i].nama_satker +
									'</option>';
							}
						}
						$('#satkerpelaksanaView').html(html);
					} else {
						var html = '';
						var valueText_kotama = $('#kotamaView :selected').text();
						var value_kotama = $('#kotamaView').val();
						html += '<option value="">Pilih Satker</option>';
						html += '<option value=' + value_kotama + ' selected>' + valueText_kotama +
							'</option>';
						$('#satkerpelaksanaView').html(html);
					}
				}
			});
			return false;
		} else {
			$('#satkerpelaksanaView').html('<option value="">Pilih Satker</option>');
		}
	}

	function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>' + content + '</b>');
		$('#formDelete').attr('action', 'entry_serbuvaksin/' + id + '/delete');
		$('#deleteModal').modal();
	}

</script>
