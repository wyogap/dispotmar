<div class="section">
	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Geografi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Rekap Mangrove</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Rekap Mangrove</div>
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
								<th>Wilayah</th>
								<th>Jumlah</th>
								<th>Tanggal Tanam</th>
								<th>Tanggal Lapor</th>
								<th>Latitude</th>
								<th>Longitude</th>
								<th>Ket</th>
								<th>Updated By</th>
								<th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($mangroves as $mangrove): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('KETPANG','update')): ?>
										<button onclick="editModal(`<?= encrypt($mangrove->id_mangrove); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil"></i>
										</button>
										<?php endif ?>
										<?php if(policy('KETPANG','delete')): ?>
										<button onclick="deleteConfirm(`<?= encrypt($mangrove->id_mangrove); ?>`,'Mangrove')" class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $mangrove->nama_satker ?></td>
									<td><?= $mangrove->nama_geografi ?></td>
									<td><?= $mangrove->jumlah ?></td>
									<td><?= $mangrove->tgl_tanam ?></td>
									<td><?= $mangrove->tgl_lapor ?></td>
									<td><?= $mangrove->latitude ?></td>
									<td><?= $mangrove->longitude ?></td>
									<td><?= $mangrove->keterangan ?></td>
									<td><?= $mangrove->nama_pegawai ?></td>
									<td><?= $mangrove->LastUpdated ?></td>
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

<!-- Delete Confirmation-->
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

<!-- Edit Data -->
<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="editForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
				<input type="hidden" id="id_mangrove" name="id_mangrove" value="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Satuan Kerja</label>
								<div class="col-md-9">
										<?php if(($this->session->userdata('role') == 'Superadmin' || $this->session->userdata('role') == 'Admin Data' || $this->session->userdata('role') == 'Admin')): ?>
											<select class="form-control" id="satkerEdit" name="satker" style="width: 100%;">
										<?php else: ?>
											<input type="hidden" class="form-control" id="satkerEdit" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
										<?php endif ?>
											<option value="">Pilih Satuan Kerja</option>
											<?php foreach($satkers as $satker): ?>
											<option value="<?= $satker->id_satker ?>"
												<?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>>
												<?= $satker->nama_satker ?>
											</option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-satker"></div>
									</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jumlah Mangrove</label>
								<div class="col-md-9">
									<input type="number" class="form-control" id="jmlEdit" name="jml" value="">
									<div class="invalid-feedback warning-what"></div>
								</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Tanggal Tanam</label>
									<div class="col-md-9">
										<input type="date" class="form-control" name="datetanam" id="datetanamEdit" placeholder="YYYY-MM-DD HH:ii:ss">
										<div class="invalid-feedback warning-datetanam"></div>
									</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Lokasi</label>
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
									<div class="form-group">
									<br>
											<div class="map-view">
												<div class="row">
													<div class="form-group col-md-6">
														<label>Latitude</label>
														<input type="text" id="latitudeEdit" name="latitude"
															class="form-control" readonly>
													</div>
													<div class="form-group col-md-6">
														<label>Longitude</label>
														<input type="text" id="longitudeEdit" name="longitude"
															class="form-control" readonly>
													</div>
												</div>
												<div id="map" style="width:100%;height:380px;"></div>
											</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Tanggal Lapor</label>
									<div class="col-md-9">
										<input type="date" class="form-control" name="datelapor" id="datelaporEdit" placeholder="YYYY-MM-DD HH:ii:ss">
										<div class="invalid-feedback warning-datelapor"></div>
									</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Keterangan</label>
									<div class="col-md-9">
									<input type="text" class="form-control" rows="6" id="keteranganEdit" name="keterangan">
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

<!-- Tambah Data -->
<div class="modal fade" id="tambahdata" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="margin-right:600px;">
		<div class="modal-content" style="width:1100px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="addForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
								<label class="col-md-3 col-form-label">Jumlah Mangrove</label>
								<div class="col-md-9">
									<input type="number" class="form-control" id="jml" name="jml" value="">
									<div class="invalid-feedback warning-what"></div>
								</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Tanggal Tanam</label>
									<div class="col-md-9">
										<input type="date" class="form-control" name="datetanam" id="datetanam" placeholder="YYYY-MM-DD HH:ii:ss">
										<div class="invalid-feedback warning-datetanam"></div>
									</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Lokasi</label>
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
									<div class="form-group">
									<br>
											<div class="map-view">
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
												<div id="map2" style="width:100%;height:380px;"></div>
											</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Tanggal Lapor</label>
									<div class="col-md-9">
										<input type="date" class="form-control" name="datelapor" id="datelapor" placeholder="YYYY-MM-DD HH:ii:ss">
										<div class="invalid-feedback warning-datelapor"></div>
									</div>
							</div>
							<div class="form-group row">
									<label class="col-md-3 col-form-label">Keterangan</label>
									<div class="col-md-9">
									<input type="text" class="form-control" rows="6" id="keterangan" name="keterangan">
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

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByRkCzDDjo-th8ecT72ZBN6f69RUmwt0I&callback=initMap"></script>

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
	
	$('input').on('keyup change', function(){
		var name = $(this).attr('name')
		$('input[name="'+name+'"]').removeClass('is-invalid')
		$('.warning-'+name).html('')
	});
	$('select').on('change', function(){
		var name = $(this).attr('name')
		$('.warning-'+name).html('')
	});

	$('#editModal').on('hidden.bs.modal', function (e) {
		$('input').val('');
		$('select').find('option:selected').removeAttr('selected');
		$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
	});

	$('#addForm').submit(function () {
			$.ajax({
				type: "POST",
				url: "<?= site_url() ?>/pangan_mangrove_add/store",
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
		var formData = new FormData();
		formData.append('csrf_al', $('input[name="csrf_al"]').val());
		formData.append('id_mangrove', $('input[name="id_mangrove"]').val());
		formData.append('satker', $('#satkerEdit').val());
		formData.append('jml', $('#jmlEdit').val());
		formData.append('datetanam', $('#datetanamEdit').val());
		formData.append('provinsi', $('#provinsiEdit').val());
		formData.append('kabupaten', $('#kabupatenEdit').val());
		formData.append('kecamatan', $('#kecamatanEdit').val());
		formData.append('kelurahan', $('#kelurahanEdit').val());
		formData.append('datelapor', $('#datelaporEdit').val());
		formData.append('keterangan', $('#keteranganEdit').val());
		formData.append('latitude', $('#latitudeEdit').val());
		formData.append('longitude', $('#longitudeEdit').val());
		formData.append('flag_locationedit', $('#flag_locationedit').val());
		$.ajax({
			type: "POST",
			url: "pangan_mangrove_edits/update",
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
			error: function(data) {
				console.log(data)
			}
		});
		return false;
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

	$('#satker').change(function(){ 
		var id= $(this).val();
		if (id) {
			$.ajax({
				url : "api/getLatLong_byIdSatker/"+id,
				method : "GET",
				async : true,
				dataType : 'json',
				success: function(data){
					$('#latitude').val(data[0].latitude);
					$('#longitude').val(data[0].longitude);
					initMap2(data[0].latitude, data[0].longitude, 1);
				}
			});
			return false;
		} else {
		}
	});

	$('#satkerEdit').change(function(){ 
		var id= $(this).val();
		if (id) {
			$.ajax({
				url : "api/getLatLong_byIdSatker/"+id,
				method : "GET",
				async : true,
				dataType : 'json',
				success: function(data){
					$('#latitudeEdit').val(data[0].latitude);
					$('#longitudeEdit').val(data[0].longitude);
					initMap(data[0].latitude, data[0].longitude, 2);
				}
			});
			return false;
		} else {
		}
	});

});
</script>

<script>
	function editModal(id){
		$('#editModal').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: 'pangan_mangrove_edit/'+id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function(data){
				//console.log(data)
				$('select[name=satker]').find('option:selected').removeAttr('selected');
				$('select[name=provinsi]').find('option:selected').removeAttr('selected');
				$('select[name=kabupaten]').find('option:selected').removeAttr('selected');
				$('select[name=kecamatan]').find('option:selected').removeAttr('selected');
				$('select[name=kelurahan]').find('option:selected').removeAttr('selected');
				$('input[name="id_mangrove"]').val(id);
				$('input[name="jml"]').val(data.mangrove.jumlah);
				$('#datetanamEdit').val(data.mangrove.tgl_tanamNew);
				$('#datelaporEdit').val(data.mangrove.tgl_laporNew);
				$('input[name="latitude"]').val(data.mangrove.latitude);
				$('input[name="longitude"]').val(data.mangrove.longitude);
				$('input[name="keterangan"]').val(data.mangrove.keterangan);
				$('input[name="flag_locationedit"]').val(data.mangrove.flag_location);
				
				//$("select[name=satker] option[value="+data.mangrove.id_satker+"]").attr('selected','selected');
				//$("select[name=provinsi] option[value="+data.mangrove.id_provinsi+"]").attr('selected','selected');

				$("#satkerEdit").val(data.mangrove.id_satker);
				$("#provinsiEdit").val(data.mangrove.id_provinsi);

				$("#satkerEdit").trigger('change');
				//$("#provinsiEdit").trigger('change');

				if(data.mangrove.flag_location == 'prov')
				{
					getProvinsi(data.mangrove.id_provinsi)
					getKabupaten(data.mangrove.id_provinsi,0)
					getKecamatan(0,0)
					getKelurahan(0,0)
				}
				else if(data.mangrove.flag_location == 'kab')
				{
					getProvinsi(data.mangrove.id_provinsi)
					getKabupaten(data.mangrove.id_provinsi,data.mangrove.id_kabupaten)
					getKecamatan(data.mangrove.id_kabupaten,0)
					getKelurahan(0,0)
				}
				else if(data.mangrove.flag_location == 'kec')
				{
					getProvinsi(data.mangrove.id_provinsi)
					getKabupaten(data.mangrove.id_provinsi,data.mangrove.id_kabupaten)
					getKecamatan(data.mangrove.id_kabupaten,data.mangrove.id_kecamatan)
					getKelurahan(data.mangrove.id_kecamatan,0)
				}
				else if(data.mangrove.flag_location == 'kel')
				{
					getProvinsi(data.mangrove.id_provinsi)
					getKabupaten(data.mangrove.id_provinsi,data.mangrove.id_kabupaten)
					getKecamatan(data.mangrove.id_kabupaten,data.mangrove.id_kecamatan)
					getKelurahan(data.mangrove.id_kecamatan,data.mangrove.id_kelurahan)
				}
				else
				{
					getProvinsi(data.mangrove.id_provinsi)
					getKabupaten(data.mangrove.id_provinsi,data.mangrove.id_kabupaten)
					getKecamatan(data.mangrove.id_kabupaten,data.mangrove.id_kecamatan)
					getKelurahan(data.mangrove.id_kecamatan,data.mangrove.id_kelurahan)
				}
			},
			error: function(){
				alert('Could not displaying data');
			}           
		});
	}

	function deleteConfirm(id,content) {
    	$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>'+content+'</b>');
		$('#formDelete').attr('action', 'pangan_mangrove/'+id+'/delete');
		$('#deleteModal').modal();
	}

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
			url : "api/getKabupaten/"+id_provinsi,
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
			url : "api/getKecamatan/"+id_kabupaten,
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
			url : "api/getKelurahan/"+id_kecamatan,
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
</script>

<script>
	$(function(){
		initMap2();
	});

	var map, infoWindow, marker;
	var map2, infoWindow2, marker2;

	function placeMarker(map, latlong) {
		if (marker) {
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

	function placeMarker2(map2, latlong2) {
		if (marker2) {
			// pindahkan marker
			marker2.setPosition(latlong2);
		} else {
			// buat marker baru
			marker2 = new google.maps.Marker({
				position: latlong2,
				map: map2
			});
		}
	}

	function initMap(_LAT, _LONG, cek) {
		_LAT = parseFloat(_LAT);
		_LONG = parseFloat(_LONG);

		if(cek == 2)
		{
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: _LAT, lng: _LONG},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
			$("#latitudeEdit").val(_LAT);
			$("#longitudeEdit").val(_LONG);
		}

		// even listner ketika peta diklik
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(this, event.latLng);
			$("#latitudeEdit").val(event.latLng.lat());
			$("#longitudeEdit").val(event.latLng.lng());
		});

		// map = new google.maps.Map(document.getElementById('map'), {
		// 	center: {
		// 		lat: -6.1755367,
		// 		lng: 106.8273503
		// 	},
		// 	zoom: 6
		// });
		// infoWindow = new google.maps.InfoWindow;

		// // Try HTML5 geolocation.
		// if (navigator.geolocation) {
		// 	navigator.geolocation.getCurrentPosition(function (position) {
		// 		var pos = {
		// 			lat: position.coords.latitude,
		// 			lng: position.coords.longitude
		// 		};

		// 		marker = new google.maps.Marker({
		// 			position: pos,
		// 			map,
		// 		});

		// 		$("#latitudeEdit").val(position.coords.latitude);
		// 		$("#longitudeEdit").val(position.coords.longitude);

		// 		map.setCenter(pos);
		// 	}, function () {
		// 		handleLocationError(true, infoWindow, map.getCenter());
		// 	});
		// } else {
		// 	// Browser doesn't support Geolocation
		// 	handleLocationError(false, infoWindow, map.getCenter());
		// }

		// // even listner ketika peta diklik
		// google.maps.event.addListener(map, 'click', function (event) {
		// 	placeMarker(this, event.latLng);
		// 	$("#latitudeEdit").val(event.latLng.lat());
		// 	$("#longitudeEdit").val(event.latLng.lng());
		// });
	}

	function initMap2(_LAT, _LONG, cek) {
		_LAT = parseFloat(_LAT);
		_LONG = parseFloat(_LONG);

		if(cek == 1)
		{
			map = new google.maps.Map(document.getElementById('map2'), {
				center: {lat: _LAT, lng: _LONG},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
			$("#latitude").val(_LAT);
			$("#longitude").val(_LONG);
		}
		else
		{
			_LAT = -6.175392;
			_LONG = 106.827153;

			map = new google.maps.Map(document.getElementById('map2'), {
				center: {lat: _LAT, lng: _LONG},
				zoom: 6
			});
		
			marker = new google.maps.Marker({
					position: {lat: _LAT, lng: _LONG},
					map,
				});
				
			$("#latitude").val(_LAT);
			$("#longitude").val(_LONG);
		}

		// even listner ketika peta diklik
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(this, event.latLng);
			$("#latitude").val(event.latLng.lat());
			$("#longitude").val(event.latLng.lng());
		});
		// map2 = new google.maps.Map(document.getElementById('map2'), {
		// 	center: {
		// 		lat: -6.1755367,
		// 		lng: 106.8273503
		// 	},
		// 	zoom: 6
		// });
		// infoWindow2 = new google.maps.InfoWindow;

		// // Try HTML5 geolocation.
		// if (navigator.geolocation) {
		// 	navigator.geolocation.getCurrentPosition(function (position) {
		// 		var pos2 = {
		// 			lat: position.coords.latitude,
		// 			lng: position.coords.longitude
		// 		};

		// 		marker2 = new google.maps.Marker({
		// 			position: pos2,
		// 			map2,
		// 		});

		// 		$("#latitude").val(position.coords.latitude);
		// 		$("#longitude").val(position.coords.longitude);

		// 		map2.setCenter(pos2);
		// 	}, function () {
		// 		handleLocationError2(true, infoWindow2, map2.getCenter());
		// 	});
		// } else {
		// 	// Browser doesn't support Geolocation
		// 	handleLocationError2(false, infoWindow2, map2.getCenter());
		// }

		// // even listner ketika peta diklik
		// google.maps.event.addListener(map2, 'click', function (event) {
		// 	placeMarker2(this, event.latLng);
		// 	$("#latitude").val(event.latLng.lat());
		// 	$("#longitude").val(event.latLng.lng());
		// });
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
			'Error: The Geolocation service failed.' :
			'Error: Your browser doesn\'t support geolocation.');
		infoWindow.open(map);
	}

	function handleLocationError2(browserHasGeolocation2, infoWindow2, pos2) {
		infoWindow2.setPosition(pos2);
		infoWindow2.setContent(browserHasGeolocation2 ?
			'Error: The Geolocation service failed.' :
			'Error: Your browser doesn\'t support geolocation.');
		infoWindow2.open(map2);
	}

</script>
