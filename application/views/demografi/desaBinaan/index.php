<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Demografi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Desa Binaan</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Desa Binaan</div>
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
							<button class="btn btn-md btn-success" id="tambahdatas" data-toggle="modal" data-target="#tambahdata">
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
								<th>Provinsi</th>
								<th>Kabupaten</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
								<th>Nama Desa</th>
								<th>Jumlah Penduduk (Orang)</th>
								<th>Tingkat Pendidikan</th>
								<th>Nama Pembina</th>
								<th>Nama Tertua Desa</th>
								<th>Latitude</th>
								<th>Longitude</th>
								<th>Ket</th>
								<th>Updated By</th>
								<th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($desaBinaan as $binaan): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('DEMO','update')): ?>
										<button onclick="editModal(`<?= encrypt($binaan->id); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('DEMO','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($binaan->id); ?>`,'<?= $binaan->nama_desa ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $binaan->nama_satker ?></td>
									<td><?= $binaan->provinsi ?></td>
									<td><?= $binaan->kabupaten ?></td>
									<td><?= $binaan->kecamatan ?></td>
									<td><?= $binaan->kelurahan ?></td>
									<td><?= $binaan->nama_desa ?></td>
									<td><?= $binaan->jumlah_penduduk ?></td>
									<td><?= $binaan->tingkat_pendidikan ?></td>
									<td><?= $binaan->nama_pembina ?></td>
									<td><?= $binaan->nama_tertua_desa ?></td>
									<td><?= $binaan->latitude ?></td>
									<td><?= $binaan->longitude ?></td>
									<td><?= $binaan->keterangan ?></td>
									<td><?= $binaan->nama_pegawai ?></td>
									<td><?= $binaan->LastUpdated ?></td>
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form class="form-horizontal" method="POST" id="addForm" enctype="multipart/form-data">
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
								<label class="col-md-3 col-form-label">Wilayah</label>
								<div class="col-md-9">
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
										<input type="text" id="idprov" name="idprov" style="display:none;" class="form-control">
										<input type="text" id="idkab" name="idkab" style="display:none;" class="form-control">
										<input type="text" id="idkec" name="idkec" style="display:none;" class="form-control">
										<input type="text" id="idkel" name="idkel" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label"></label>
								<div class="col-md-9">
									<div class="form-group">
											<div class="map-view" style="display: block;">
												<div class="row">
													<div class="form-group col-md-6">
														<label>Latitude</label>
														<input type="text" id="latitude" name="latitude"
															class="form-control" readonly>
													</div>
													<div class="form-group col-md-6">
														<label>Longitude</label>
														<input type="text" id="longitude" name="longitude"
															class="form-control" readonly>
													</div>
												</div>
												<div id="map" style="width:100%;height:300px;"></div>
											</div>
									</div>
								</div>
							</div>
							<div class="form-group row" style="display:none;">
								<label class="col-md-3 col-form-label" for="kode_satker">kode satker</label>
								<div class="col-md-9">
									<input type="text" id="kode_satker" name="kode_satker" class="form-control">
									<div class="invalid-feedback warning-kode_satker"></div>
								</div>
							</div>
							<div class="form-group row" style="display:none;">
								<label class="col-md-3 col-form-label" for="wilayah">wilayah</label>
								<div class="col-md-9">
									<input type="text" id="wilayah" name="wilayah" class="form-control">
									<div class="invalid-feedback warning-wilayah"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_desa">Nama Desa</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_desa" class="form-control">
									<div class="invalid-feedback warning-nama_desa"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="jumlah_penduduk">Jumlah Penduduk (Orang)</label>
								<div class="col-md-9">
									<input type="number" id="" name="jumlah_penduduk" class="form-control">
									<div class="invalid-feedback warning-jumlah_penduduk"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="tingkat_pendidikan">Tingkat Pendidikan</label>
								<div class="col-md-9">
									<input type="text" id="" name="tingkat_pendidikan" class="form-control">
									<div class="invalid-feedback warning-tingkat_pendidikan"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_pembina">Nama Pembina</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_pembina" class="form-control">
									<div class="invalid-feedback warning-nama_pembina"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_tertua_desa">Nama Tertua Desa</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_tertua_desa" class="form-control">
									<div class="invalid-feedback warning-nama_tertua_desa"></div>
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form class="form-horizontal" method="POST" id="editForm" enctype="multipart/form-data">
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
								<label class="col-md-3 col-form-label">Wilayah</label>
								<div class="col-md-9">
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
										<input type="text" id="idprovedit" name="idprovedit" style="display:none;" class="form-control">
										<input type="text" id="idkabedit" name="idkabedit" style="display:none;" class="form-control">
										<input type="text" id="idkecedit" name="idkecedit" style="display:none;" class="form-control">
										<input type="text" id="idkeledit" name="idkeledit" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label"></label>
								<div class="col-md-9">
									<div class="form-group">
											<div class="map-view" style="display: block;">
												<div class="row">
													<div class="form-group col-md-6">
														<label>Latitude</label>
														<input type="text" id="latitudeEdit" name="latitudeEdit"
															class="form-control" readonly>
													</div>
													<div class="form-group col-md-6">
														<label>Longitude</label>
														<input type="text" id="longitudeEdit" name="longitudeEdit"
															class="form-control" readonly>
													</div>
												</div>
												<div id="map2" style="width:100%;height:300px;"></div>
											</div>
									</div>
								</div>
							</div>
							<div class="form-group row" style="display:none;">
								<label class="col-md-3 col-form-label" for="kode_satker">kode satker</label>
								<div class="col-md-9">
									<input type="text" id="kode_satkerEdit" name="kode_satkerEdit" class="form-control">
									<div class="invalid-feedback warning-kode_satkerEdit"></div>
								</div>
							</div>
							<div class="form-group row" style="display:none;">
								<label class="col-md-3 col-form-label" for="wilayah">wilayah</label>
								<div class="col-md-9">
									<input type="text" id="wilayahEdit" name="wilayahEdit" class="form-control">
									<div class="invalid-feedback warning-wilayahEdit"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_desa">Nama Desa</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_desa" class="form-control">
									<div class="invalid-feedback warning-nama_desa"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="jumlah_penduduk">Jumlah Penduduk (Orang)</label>
								<div class="col-md-9">
									<input type="number" id="" name="jumlah_penduduk" class="form-control">
									<div class="invalid-feedback warning-jumlah_penduduk"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="tingkat_pendidikan">Tingkat Pendidikan</label>
								<div class="col-md-9">
									<input type="text" id="" name="tingkat_pendidikan" class="form-control">
									<div class="invalid-feedback warning-tingkat_pendidikan"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_pembina">Nama Pembina</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_pembina" class="form-control">
									<div class="invalid-feedback warning-nama_pembina"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nama_tertua_desa">Nama Tertua Desa</label>
								<div class="col-md-9">
									<input type="text" id="" name="nama_tertua_desa" class="form-control">
									<div class="invalid-feedback warning-nama_tertua_desa"></div>
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
<script async="false"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByRkCzDDjo-th8ecT72ZBN6f69RUmwt0I&callback=initMap">
</script>
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
				url: "<?= site_url() ?>/demografi_desaBinaan/store",
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
				url: "<?= site_url() ?>demografi_desaBinaans/update",
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

			<?php if(policy('DEMO','read')): ?>
			$('select[name=satkerPicked] option[value="<?= $this->session->userdata('id_satker') ?>"]').attr('selected','selected');
			$('input[name="satker"]').val("<?= $this->session->userdata('id_satker') ?>")
			<?php endif ?>

			$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
		});

		$('#provinsi').change(function(){ 

			$('#idprov').val(0);
			$('#idkab').val(0);
			$('#idkec').val(0);
			$('#idkel').val(0);

			var id= $(this).val();
			$('#flag_location').val("prov");
			$('#idprov').val(id);

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

			$('#idkab').val(0);
			$('#idkec').val(0);
			$('#idkel').val(0);

			var id= $(this).val();

			if(id == '')
			{
				$('#flag_location').val("prov");
			}
			else
			{
				$('#flag_location').val("kab");
			}

			$('#idkab').val(id);

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
			
			$('#idkec').val(0);
			$('#idkel').val(0);

			var id= $(this).val();

			if(id == '')
			{
				$('#flag_location').val("kab");
			}
			else
			{
				$('#flag_location').val("kec");
			}

			$('#idkec').val(id);

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

			$('#idkel').val(0);

			var id= $(this).val();
			var labels = $('#kelurahan :selected').text();
			$('#wilayah').val(labels);

			if(id == '')
			{
				$('#flag_location').val("kec");
			}
			else
			{
				$('#flag_location').val("kel");
			}

			$('#idkel').val(id);
		}); 

		$('#satker').change(function(){ 
			var id= $(this).val();
			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getSatkerById/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						$('#kode_satker').val(data.kode_satker);
						initMap(data.latitude, data.longitude, 1);
					}
				});
				return false;
			} else {
				$('#kode_satker').val('');
			}
		});

		$('#satkerEdit').change(function(){ 
			var id= $(this).val();
			if (id) {
				$.ajax({
					url : "<?= site_url() ?>/api/getSatkerById/"+id,
					method : "GET",
					async : true,
					dataType : 'json',
					success: function(data){
						$('#kode_satkerEdit').val(data.kode_satker);
						initMap(data.latitude, data.longitude, 2);
					}
				});
				return false;
			} else {
				$('#kode_satkerEdit').val('');
			}
		}); 

		$('#provinsiEdit').change(function(){ 
			
			$('#idprovedit').val(0);
			$('#idkabedit').val(0);
			$('#idkecedit').val(0);
			$('#idkeledit').val(0);

			var id= $(this).val();
			$('#flag_locationedit').val("prov");
			$('#idprovedit').val(id);

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
			
			$('#idkabedit').val(0);
			$('#idkecedit').val(0);
			$('#idkeledit').val(0);

			var id= $(this).val();

			if(id == '')
			{
				$('#flag_locationedit').val("prov");
			}
			else
			{
				$('#flag_locationedit').val("kab");
			}

			$('#idkabedit').val(id);

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
			
			$('#idkecedit').val(0);
			$('#idkeledit').val(0);

			var id= $(this).val();
			
			if(id == '')
			{
				$('#flag_locationedit').val("kab");
			}
			else
			{
				$('#flag_locationedit').val("kec");
			}

			$('#idkecedit').val(id);

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
			
			$('#idkeledit').val(0);

			var id= $(this).val();
			var labels = $('#kelurahanEdit :selected').text();
			$('#wilayahEdit').val(labels);
			
			if(id == '')
			{
				$('#flag_locationedit').val("kec");
			}
			else
			{
				$('#flag_locationedit').val("kel");
			}

			$('#idkeledit').val(id);
		});

	});

	function getProvinsi(id_provinsi) {
		$.ajax({
			url : "api/getProvinsi/"+id_provinsi,
			method : "GET",
			async : true,
			dataType : 'json',
			success: function(data){
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
			url: '<?= site_url() ?>demografi_desaBinaan/' + id,
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
				$('input[name="satker"]').val(data.binaan.id_satker);
				$('input[name="nama_desa"]').val(data.binaan.nama_desa);
				$('input[name="jumlah_penduduk"]').val(data.binaan.jumlah_penduduk);
				$('input[name="tingkat_pendidikan"]').val(data.binaan.tingkat_pendidikan);
				$('input[name="nama_pembina"]').val(data.binaan.nama_pembina);
				$('input[name="nama_tertua_desa"]').val(data.binaan.nama_tertua_desa);
				$('input[name="notes"]').val(data.binaan.keterangan);
				$('#kode_satkerEdit').val(data.binaan.kode_satker);
				$('#wilayahEdit').val(data.binaan.wilayah);
				$('#latitudeEdit').val(data.binaan.latitude);
				$('#longitudeEdit').val(data.binaan.longitude);
				$('input[name="flag_locationedit"]').val(data.binaan.flag_location);
				$('input[name="idprovedit"]').val(data.binaan.id_prov);
				$('input[name="idkabedit"]').val(data.binaan.id_kab);
				$('input[name="idkecedit"]').val(data.binaan.id_kec);
				$('input[name="idkeledit"]').val(data.binaan.id_kel);
				$("select[name=satkerPicked] option[value=" + data.binaan.id_satker + "]").attr('selected','selected');

				$("#satkerEdit").val(data.binaan.id_satker);
				$("#provinsiEdit").val(data.binaan.id_provinsi);
				
				$("#satkerEdit").trigger('change');

				// getProvinsi(data.binaan.id_provinsi)
				// getKabupaten(data.binaan.id_provinsi,data.binaan.id_kabupaten)
				// getKecamatan(data.binaan.id_kabupaten,data.binaan.id_kecamatan)
				// getKelurahan(data.binaan.id_kecamatan,data.binaan.id_kelurahan)

				if(data.binaan.flag_location == 'prov')
				{
					getProvinsi(data.binaan.id_provinsi)
					getKabupaten(data.binaan.id_provinsi,0)
					getKecamatan(0,0)
					getKelurahan(0,0)
				}
				else if(data.binaan.flag_location == 'kab')
				{
					getProvinsi(data.binaan.id_provinsi)
					getKabupaten(data.binaan.id_provinsi,data.binaan.id_kabupaten)
					getKecamatan(data.binaan.id_kabupaten,0)
					getKelurahan(0,0)
				}
				else if(data.binaan.flag_location == 'kec')
				{
					getProvinsi(data.binaan.id_provinsi)
					getKabupaten(data.binaan.id_provinsi,data.binaan.id_kabupaten)
					getKecamatan(data.binaan.id_kabupaten,data.binaan.id_kecamatan)
					getKelurahan(data.binaan.id_kecamatan,0)
				}
				else if(data.binaan.flag_location == 'kel')
				{
					getProvinsi(data.binaan.id_provinsi)
					getKabupaten(data.binaan.id_provinsi,data.binaan.id_kabupaten)
					getKecamatan(data.binaan.id_kabupaten,data.binaan.id_kecamatan)
					getKelurahan(data.binaan.id_kecamatan,data.binaan.id_kelurahan)
				}
				else
				{
					getProvinsi(data.binaan.id_provinsi)
					getKabupaten(data.binaan.id_provinsi,data.binaan.id_kabupaten)
					getKecamatan(data.binaan.id_kabupaten,data.binaan.id_kecamatan)
					getKelurahan(data.binaan.id_kecamatan,data.binaan.id_kelurahan)
				}
				
				initMap(data.report.latitude, data.report.longitude, 2);
			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>' + content + '</b>');
		$('#formDelete').attr('action', '<?= site_url() ?>demografi_desaBinaan/' + id + '/delete');
		$('#deleteModal').modal();
	}
</script>

<script>
	var map, infoWindow, marker;

	function placeMarker(map, latlong){
	if(marker){
		// pindahkan marker
		marker.setPosition(latlong);
		} else {
		// buat marker baru
		marker = new google.maps.Marker({
			position: latlong,
			map: map
		});
		}
	}

	function initMap(_LAT, _LONG, cek) {
		if(_LAT == undefined){
			_LAT = -6.175392;
		}
		if(_LONG == undefined){
			_LONG = 106.827153;
		}

		_LAT = parseFloat(_LAT);
		_LONG = parseFloat(_LONG);

		if(cek == 1)
		{
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: _LAT, lng: _LONG},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
			$("#latitude").val(_LAT);
			$("#longitude").val(_LONG);

			// even listner ketika peta diklik
			google.maps.event.addListener(map, 'click', function(event) {
				placeMarker(this, event.latLng);
				$("#latitude").val(event.latLng.lat());
				$("#longitude").val(event.latLng.lng());
			});
		}
		else if(cek == 2)
		{
			map = new google.maps.Map(document.getElementById('map2'), {
				center: {lat: _LAT, lng: _LONG},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
			$("#latitudeEdit").val(_LAT);
			$("#longitudeEdit").val(_LONG);

			// even listner ketika peta diklik
			google.maps.event.addListener(map, 'click', function(event) {
				placeMarker(this, event.latLng);
				$("#latitudeEdit").val(event.latLng.lat());
				$("#longitudeEdit").val(event.latLng.lng());
			});
		}
		else
		{
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: _LAT, lng: _LONG},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
			$("#latitude").val(_LAT);
			$("#longitude").val(_LONG);

			// even listner ketika peta diklik
			google.maps.event.addListener(map, 'click', function(event) {
				placeMarker(this, event.latLng);
				$("#latitude").val(event.latLng.lat());
				$("#longitude").val(event.latLng.lng());
			});
		}
	}
</script>

