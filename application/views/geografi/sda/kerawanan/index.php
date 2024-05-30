<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Geografi</a></li>
			<li class="breadcrumb-item active" aria-current="page">SDA</li>
			<li class="breadcrumb-item active" aria-current="page">Kerawanan</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Kerawanan Geografi</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-success" id="tambahdatas" data-toggle="modal" data-target="#tambahdata">
								Tambah Data
							</button>
						</div>
					</div>
					<br>
					<div class="table-responsive">
					<table id="example" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<tr>
									<td>Opsi</td>
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
									<th>Updated By</th>
									<th>Last Updated</th>
								</tr>
								</thead>
							<tbody>
								<?php $no=1; foreach($dataKerawanan as $kerawanan): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('KONSOS','update')): ?>
										<button onclick="editModal(`<?= encrypt($kerawanan->id_kerawanan); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('KONSOS','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($kerawanan->id_kerawanan); ?>`,'Kerawanan')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $kerawanan->nama_satker ?></td>
									<td><?= $kerawanan->wilayah ?></td>
									<td><?= $kerawanan->gempa_tektonik ?></td>
									<td><?= $kerawanan->gempa_vulkanik ?></td>
									<td><?= $kerawanan->banjir ?></td>
									<td><?= $kerawanan->gunung_meletus ?></td>
									<td><?= $kerawanan->tsunami ?></td>
									<td><?= $kerawanan->kebakaran ?></td>
									<td><?= $kerawanan->angin ?></td>
									<td><?= $kerawanan->longsor ?></td>
									<td><?= $kerawanan->keterangan ?></td>
									<td><?= $kerawanan->nama_pegawai ?></td>
									<td><?= $kerawanan->LastUpdated ?></td>
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
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
								<label class="col-md-4 col-form-label">Satker </label>
								<div class="col-md-8">
									<?php if(($this->session->userdata('role') == 'Satker')): ?>
										<input type="hidden" class="form-control" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
										<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
									<?php else: ?>
										<select class="form-control" id="satker" name="satker" style="width: 100%;">
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
								<label class="col-md-4 col-form-label">Wilayah</label>
								<div class="col-md-8">
									<div class="col-md-15">
										<select class="form-control" id="provinsi" name="provinsi" style="width: 100%;">
											<option value="">Pilih Provinsi</option>
											<?php foreach($provinsi as $prov): ?>
											<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-provinsi"></div>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kabupaten" name="kabupaten" style="width: 100%;">
											<option value="">Pilih Kabupaten</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kecamatan" name="kecamatan" style="width: 100%;">
											<option value="">Pilih Kecamatan</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kelurahan" name="kelurahan" style="width: 100%;">
											<option value="">Pilih Kelurahan</option>
										</select>
										<input type="text" id="flag_location" name="flag_location" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="tektonik">Gempa Tektonik</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="tektonik" class="form-control"> -->
									<select class="form-control" name="tektonik" id="tektonik" style="width: 100%;">
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-tektonik"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="vulkanik">Gempa Vulkanik</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="vulkanik" class="form-control"> -->
									<select class="form-control" name="vulkanik" id="vulkanik" style="width: 100%;">
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-vulkanik"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="banjir">Banjir</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="banjir" class="form-control"> -->
									<select class="form-control" name="banjir" id="banjir" style="width: 100%;">
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-banjir"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="gunung">Gunung Meletus</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="gunung" class="form-control"> -->
									<select class="form-control" name="gunung" id="gunung" style="width: 100%;">
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-gunung"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="tsunami">Tsunami</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="tsunami" class="form-control"> -->
									<select class="form-control" name="tsunami" id="tsunami" style="width: 100%;">
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-tsunami"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="kebakaran">Kebakaran</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="kebakaran" class="form-control"> -->
									<select class="form-control" name="kebakaran" id="kebakaran" style="width: 100%;">
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-kebakaran"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="angin">Angin</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="angin" class="form-control"> -->
									<select class="form-control" name="angin" id="angin" style="width: 100%;">
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-angin"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="longsor">Longsor</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="longsor" class="form-control"> -->
									<select class="form-control" name="longsor" id="longsor" style="width: 100%;">
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-longsor"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="notes">Keterangan</label>
								<div class="col-md-8">
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
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
								<label class="col-md-4 col-form-label">Satker </label>
								<div class="col-md-8">
										<?php if(($this->session->userdata('role') == 'Satker')): ?>
											<input type="hidden" class="form-control" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" style="width: 100%;" disabled>
										<?php else: ?>
											<select class="form-control" id="satkerEdit" name="satker" style="width: 100%;">
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
								<label class="col-md-4 col-form-label">Wilayah</label>
								<div class="col-md-8">
									<div class="col-md-15">
										<select class="form-control" id="provinsiEdit" name="provinsi" style="width: 100%;">
											<option value="">Pilih Provinsi</option>
											<?php foreach($provinsi as $prov): ?>
											<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-provinsi"></div>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kabupatenEdit" name="kabupaten" style="width: 100%;">
											<option value="">Pilih Kabupaten</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kecamatanEdit" name="kecamatan" style="width: 100%;">
											<option value="">Pilih Kecamatan</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select class="form-control" id="kelurahanEdit" name="kelurahan" style="width: 100%;">
											<option value="">Pilih Kelurahan</option>
										</select>
										<input type="text" id="flag_locationedit" name="flag_locationedit" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="tektonik">Gempa Tektonik</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="tektonik" class="form-control"> -->
									<select class="form-control" name="tektonik" id="tektonikEdit" style="width: 100%;">
										<option value="">Pilih</option>
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-tektonik"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="vulkanik">Gempa Vulkanik</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="vulkanik" class="form-control"> -->
									<select class="form-control" name="vulkanik" id="vulkanikEdit" style="width: 100%;">
										<option value="">Pilih</option>
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-vulkanik"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="banjir">Banjir</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="banjir" class="form-control"> -->
									<select class="form-control" name="banjir" id="banjirEdit" style="width: 100%;">
										<option value="">Pilih</option>
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-banjir"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="gunung">Gunung Meletus</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="gunung" class="form-control"> -->
									<select class="form-control" name="gunung" id="gunungEdit" style="width: 100%;">
										<option value="">Pilih</option>
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-gunung"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="tsunami">Tsunami</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="tsunami" class="form-control"> -->
									<select class="form-control" name="tsunami" id="tsunamiEdit" style="width: 100%;">
										<option value="">Pilih</option>
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-tsunami"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="kebakaran">Kebakaran</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="kebakaran" class="form-control"> -->
									<select class="form-control" name="kebakaran" id="kebakaranEdit" style="width: 100%;">
										<option value="">Pilih</option>
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-kebakaran"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="angin">Angin</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="angin" class="form-control"> -->
									<select class="form-control" name="angin" id="anginEdit" style="width: 100%;">
										<option value="">Pilih</option>
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-angin"></div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="longsor">Longsor</label>
								<div class="col-md-8">
									<!-- <input type="text" id="" name="longsor" class="form-control"> -->
									<select class="form-control" name="longsor" id="longsorEdit" style="width: 100%;">
										<option value="">Pilih</option>
										<option value="Berpotensi">Berpotensi</option>
										<option value="Tidak Berpotensi">Tidak Berpotensi</option>
									</select>
									<div class="invalid-feedback warning-longsor"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4 col-form-label" for="notes">Keterangan</label>
								<div class="col-md-8">
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="formDelete" method="POST" action="">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
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

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function () {
		$("#satker").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#provinsi").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#kabupaten").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#kecamatan").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#kelurahan").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#tektonik").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#vulkanik").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#banjir").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#gunung").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#tsunami").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#kebakaran").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#angin").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#longsor").select2({
			dropdownParent: $('#tambahdata')
		});


		$("#satkerEdit").select2({
			dropdownParent: $('#editModal')
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
		$("#kelurahanEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#tektonikEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#vulkanikEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#banjirEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#gunungEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#tsunamiEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#kebakaranEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#anginEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#longsorEdit").select2({
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

		$('#addForm').submit(function () {
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>/geografi_kerawanan/store",
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

		$('#editForm').submit(function () {
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>geografi_kerawanans/update",
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

		$('#provinsi').change(function(){ 
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
						$('#kabupaten').html(html);
					}
				});
				return false;
			} else {
				$('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 

		$('#provinsi').change(function(){ 
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
						$('#kabupaten').html(html);
					}
				});
				return false;
			} else {
				$('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 
		$('#kabupaten').change(function(){ 
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
						$('#kecamatan').html(html);
					}
				});
				return false;
			} else {
				$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 
		$('#kecamatan').change(function(){ 
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
						$('#kelurahan').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
			}
		}); 
		$('#kelurahan').change(function(){
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

		$('#provinsiEdit').change(function(){ 
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
						$('#kabupatenEdit').html(html);
						$('#kecamatanEdit').html('<option value="">Pilih Kecamatan</option>');
						$('#kelurahanEdit').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kabupatenEdit').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 
		$('#kabupatenEdit').change(function(){ 
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
						$('#kecamatanEdit').html(html);
						$('#kelurahanEdit').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kecamatanEdit').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 
		$('#kecamatanEdit').change(function(){ 
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
						$('#kelurahanEdit').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahanEdit').html('<option value="">Pilih Kelurahan</option>');
			}
		}); 
		$('#kelurahanEdit').change(function(){ 
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
				$('#provinsiEdit').html(html);
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
				$('#kabupatenEdit').html(html);
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
				$('#kecamatanEdit').html(html);
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
				$('#kelurahanEdit').html(html);
			}
		});
	}

	function editModal(id) {
		$('#editModal').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: '<?= site_url() ?>geografi_kerawanan/' + id,
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
				//$('input[name="satker"]').val(data.kerawanan.id_satker);
				///$('input[name="tektonik"]').val(data.kerawanan.gempa_tektonik);
				//$('input[name="vulkanik"]').val(data.kerawanan.gempa_vulkanik);
				//$('input[name="banjir"]').val(data.kerawanan.banjir);
				//$('input[name="gunung"]').val(data.kerawanan.gunung_meletus);
				//$('input[name="tsunami"]').val(data.kerawanan.tsunami);
				//$('input[name="kebakaran"]').val(data.kerawanan.kebakaran);
				//$('input[name="angin"]').val(data.kerawanan.angin);
				//$('input[name="longsor"]').val(data.kerawanan.longsor);
				$('input[name="notes"]').val(data.kerawanan.keterangan);
				$('input[name="flag_locationedit"]').val(data.kerawanan.flag_location);
				//$("select[name=satker] option[value="+data.kerawanan.id_satker+"]").attr('selected','selected');
				$("select[name=satkerPicked] option[value=" + data.kerawanan.id_satker + "]").attr('selected','selected');
				//$("select[name=provinsi] option[value="+data.kerawanan.id_provinsi+"]").attr('selected','selected');

				$("#satkerEdit").val(data.kerawanan.id_satker);
				$("#provinsiEdit").val(data.kerawanan.id_provinsi);
				$("#tektonikEdit").val(data.kerawanan.gempa_tektonik);
				$("#vulkanikEdit").val(data.kerawanan.gempa_vulkanik);
				$("#banjirEdit").val(data.kerawanan.banjir);
				$("#gunungEdit").val(data.kerawanan.gunung_meletus);
				$("#tsunamiEdit").val(data.kerawanan.tsunami);
				$("#kebakaranEdit").val(data.kerawanan.kebakaran);
				$("#anginEdit").val(data.kerawanan.angin);
				$("#longsorEdit").val(data.kerawanan.longsor);
				
				$("#satkerEdit").trigger('change');
				// $("#provinsiEdit").trigger('change');
				// $("#kabupatenEdit").trigger('change');
				// $("#kecamatanEdit").trigger('change');
				// $("#kelurahanEdit").trigger('change');
				$("#tektonikEdit").trigger('change');
				$("#vulkanikEdit").trigger('change');
				$("#banjirEdit").trigger('change');
				$("#gunungEdit").trigger('change');
				$("#tsunamiEdit").trigger('change');
				$("#kebakaranEdit").trigger('change');
				$("#anginEdit").trigger('change');
				$("#longsorEdit").trigger('change');

				if(data.kerawanan.flag_location == 'prov')
				{
					getProvinsi(data.kerawanan.id_provinsi)
					getKabupaten(data.kerawanan.id_provinsi,0)
					getKecamatan(0,0)
					getKelurahan(0,0)
				}
				else if(data.kerawanan.flag_location == 'kab')
				{
					getProvinsi(data.kerawanan.id_provinsi)
					getKabupaten(data.kerawanan.id_provinsi,data.kerawanan.id_kabupaten)
					getKecamatan(data.kerawanan.id_kabupaten,0)
					getKelurahan(0,0)
				}
				else if(data.kerawanan.flag_location == 'kec')
				{
					getProvinsi(data.kerawanan.id_provinsi)
					getKabupaten(data.kerawanan.id_provinsi,data.kerawanan.id_kabupaten)
					getKecamatan(data.kerawanan.id_kabupaten,data.kerawanan.id_kecamatan)
					getKelurahan(data.kerawanan.id_kecamatan,0)
				}
				else if(data.kerawanan.flag_location == 'kel')
				{
					getProvinsi(data.kerawanan.id_provinsi)
					getKabupaten(data.kerawanan.id_provinsi,data.kerawanan.id_kabupaten)
					getKecamatan(data.kerawanan.id_kabupaten,data.kerawanan.id_kecamatan)
					getKelurahan(data.kerawanan.id_kecamatan,data.kerawanan.id_kelurahan)
				}
				else
				{
					getProvinsi(data.kerawanan.id_provinsi)
					getKabupaten(data.kerawanan.id_provinsi,data.kerawanan.id_kabupaten)
					getKecamatan(data.kerawanan.id_kabupaten,data.kerawanan.id_kecamatan)
					getKelurahan(data.kerawanan.id_kecamatan,data.kerawanan.id_kelurahan)
				}
			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>' + content + '</b>');
		$('#formDelete').attr('action', '<?= site_url() ?>geografi_kerawanan/' + id + '/delete');
		$('#deleteModal').modal();
	}
</script>
