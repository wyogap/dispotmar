<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Demografi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Saka Bahari</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Saka Bahari</div>
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
							<button class="btn btn-success" id="tambahdatas" data-toggle="modal" data-target="#tambahdata">
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
								<th>Jenis Saka</th>
								<th>Jumlah Anggota Saka</th>
								<th>Sekolah yang Terlibat</th>
								<th>Nama Pembina</th>
								<th>Nomor Gugus Depan</th>
								<th>Ket</th>
								<th>Updated By</th>
								<th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($dataBahari as $bahari): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('DEMO','update')): ?>
										<button onclick="editModal(`<?= encrypt($bahari->id_saka_bahari); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('DEMO','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($bahari->id_saka_bahari); ?>`,'<?= $bahari->sekolah_terlibat ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $bahari->nama_satker ?></td>
									<td><?= $bahari->wilayah ?></td>
									<td><?= $bahari->saka ?></td>
									<td><?= $bahari->jumlah_saka ?></td>
									<td><?= $bahari->sekolah_terlibat ?></td>
									<td><?= $bahari->nama_pembina ?></td>
									<td><?= $bahari->no_gugus_depan ?></td>
									<td><?= $bahari->keterangan ?></td>
									<td><?= $bahari->nama_pegawai ?></td>
									<td><?= $bahari->LastUpdated ?></td>
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
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jenis Saka</label>
								<div class="col-md-9">
									<select class="form-control" name="jenis_saka" id="jenis_saka" style="width: 100%;">
										<?php foreach($jenis_saka as $saka): ?>
											<option value="<?= $saka->id_jenis_saka ?>"><?= $saka->nama ?></option>
										<?php endforeach?>
									</select>
									<div class="invalid-feedback warning-jenis_saka"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="jumlah_saka">Jumlah Anggota Saka</label>
								<div class="col-md-9">
									<input type="number" id="" name="jumlah_saka" class="form-control">
									<div class="invalid-feedback warning-jumlah_saka"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="sekolah_terlibat">Sekolah yang Terlibat</label>
								<div class="col-md-9">
									<input type="text" id="" name="sekolah_terlibat" class="form-control">
									<div class="invalid-feedback warning-sekolah_terlibat"></div>
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
								<label class="col-md-3 col-form-label" for="no_gugus_depan">Nomor Gugus Depan</label>
								<div class="col-md-9">
									<input type="number" id="" name="no_gugus_depan" class="form-control">
									<div class="invalid-feedback warning-no_gugus_depan"></div>
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
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jenis Saka</label>
								<div class="col-md-9">
									<select class="form-control" name="jenis_saka" id="jenis_sakaEdit" style="width: 100%;">
										<?php foreach($jenis_saka as $saka): ?>
											<option value="<?= $saka->id_jenis_saka ?>"><?= $saka->nama ?></option>
										<?php endforeach?>
									</select>
									<div class="invalid-feedback warning-jenis_saka"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="jumlah_saka">Jumlah Anggota Saka</label>
								<div class="col-md-9">
									<input type="number" id="" name="jumlah_saka" class="form-control">
									<div class="invalid-feedback warning-jumlah_saka"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="sekolah_terlibat">Sekolah yang Terlibat</label>
								<div class="col-md-9">
									<input type="text" id="" name="sekolah_terlibat" class="form-control">
									<div class="invalid-feedback warning-sekolah_terlibat"></div>
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
								<label class="col-md-3 col-form-label" for="no_gugus_depan">Nomor Gugus Depan</label>
								<div class="col-md-9">
									<input type="number" id="" name="no_gugus_depan" class="form-control">
									<div class="invalid-feedback warning-no_gugus_depan"></div>
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
		$("#jenis_saka").select2({
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
		$("#jenis_sakaEdit").select2({
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
				url: "<?= site_url() ?>/demografi_sakaBahari/store",
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
				url: "<?= site_url() ?>demografi_sakaBaharis/update",
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
			url: '<?= site_url() ?>demografi_sakaBahari/' + id,
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
				$('select[name=jenis_saka]').find('option:selected').removeAttr('selected');
				$('input[name="id"]').val(id);
				$('input[name="satker"]').val(data.bahari.id_satker);
				$('input[name="jumlah_saka"]').val(data.bahari.jumlah_saka);
				$('input[name="sekolah_terlibat"]').val(data.bahari.sekolah_terlibat);
				$('input[name="nama_pembina"]').val(data.bahari.nama_pembina);
				$('input[name="no_gugus_depan"]').val(data.bahari.no_gugus_depan);
				$('input[name="notes"]').val(data.bahari.keterangan);
				$('input[name="flag_locationedit"]').val(data.bahari.flag_location);
				//$("select[name=satker] option[value="+data.bahari.id_satker+"]").attr('selected','selected');
				$("select[name=satkerPicked] option[value=" + data.bahari.id_satker + "]").attr('selected','selected');
				//$("select[name=provinsi] option[value="+data.bahari.id_provinsi+"]").attr('selected','selected');
				//$("select[name=jenis_saka] option[value="+data.bahari.id_jenis_saka+"]").attr('selected','selected');

				$("#satkerEdit").val(data.bahari.id_satker);
				$("#provinsiEdit").val(data.bahari.id_provinsi);
				$("#jenis_sakaEdit").val(data.bahari.id_jenis_saka);
				
				$("#satkerEdit").trigger('change');
				// $("#provinsiEdit").trigger('change');
				// $("#kabupatenEdit").trigger('change');
				// $("#kecamatanEdit").trigger('change');
				// $("#kelurahanEdit").trigger('change');
				$("#jenis_sakaEdit").trigger('change');

				// getProvinsi(data.bahari.id_provinsi)
				// getKabupaten(data.bahari.id_provinsi,data.bahari.id_kabupaten)
				// getKecamatan(data.bahari.id_kabupaten,data.bahari.id_kecamatan)
				// getKelurahan(data.bahari.id_kecamatan,data.bahari.id_kelurahan)

				if(data.bahari.flag_location == 'prov')
				{
					getProvinsi(data.bahari.id_provinsi)
					getKabupaten(data.bahari.id_provinsi,0)
					getKecamatan(0,0)
					getKelurahan(0,0)
				}
				else if(data.bahari.flag_location == 'kab')
				{
					getProvinsi(data.bahari.id_provinsi)
					getKabupaten(data.bahari.id_provinsi,data.bahari.id_kabupaten)
					getKecamatan(data.bahari.id_kabupaten,0)
					getKelurahan(0,0)
				}
				else if(data.bahari.flag_location == 'kec')
				{
					getProvinsi(data.bahari.id_provinsi)
					getKabupaten(data.bahari.id_provinsi,data.bahari.id_kabupaten)
					getKecamatan(data.bahari.id_kabupaten,data.bahari.id_kecamatan)
					getKelurahan(data.bahari.id_kecamatan,0)
				}
				else if(data.bahari.flag_location == 'kel')
				{
					getProvinsi(data.bahari.id_provinsi)
					getKabupaten(data.bahari.id_provinsi,data.bahari.id_kabupaten)
					getKecamatan(data.bahari.id_kabupaten,data.bahari.id_kecamatan)
					getKelurahan(data.bahari.id_kecamatan,data.bahari.id_kelurahan)
				}
				else
				{
					getProvinsi(data.bahari.id_provinsi)
					getKabupaten(data.bahari.id_provinsi,data.bahari.id_kabupaten)
					getKecamatan(data.bahari.id_kabupaten,data.bahari.id_kecamatan)
					getKelurahan(data.bahari.id_kecamatan,data.bahari.id_kelurahan)
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
		$('#formDelete').attr('action', '<?= site_url() ?>demografi_sakaBahari/' + id + '/delete');
		$('#deleteModal').modal();
	}
</script>
