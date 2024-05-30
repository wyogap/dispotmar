<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Tracer Vaksin</a></li>
			<li class="breadcrumb-item active" aria-current="page">Pendaftaran Vaksin</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Pendaftaran Vaksin</div>
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
								<th>NIK</th>
								<th>Nama</th>
								<th>No Hp</th>
                                <th>Pernah Vaksin</th>
                                <th>Dosis</th>
								<th>Provinsi</th>
								<th>Kabupaten/Kota</th>
								<th>Kecamatan</th>
                                <th>Email</th>
                                <th>Updated By</th>
                                <th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($dataDaftarVaksin as $vaksin): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('VAKSIN','update')): ?>
										<a class="btn btn-sm btn-default"
											onclick="viewModal(`<?= encrypt($vaksin->iddaftar); ?>`)">
											<i class="fa fa-eye"></i>
										</a>
										<button onclick="editModal(`<?= encrypt($vaksin->iddaftar); ?>`)"
											class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</button>
										<?php endif ?>
										<?php if(policy('VAKSIN','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($vaksin->iddaftar); ?>`,'<?= $vaksin->NamaKTP; ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $vaksin->NIK ?></td>
									<td><?= $vaksin->NamaKTP ?></td>
									<td><?= $vaksin->nohp ?></td>
									<td><?= $vaksin->pernahvaksin ?></td>
									<td><?= $vaksin->dosiske ?></td>
									<td><?= $vaksin->geo_provinsidomisili ?></td>
									<td><?= $vaksin->geo_kabkotadomisili ?></td>
									<td><?= $vaksin->geo_kecdomisili ?></td>
									<td><?= $vaksin->email ?></td>
									<td><?= $vaksin->nama_pegawai ?></td>
									<td><?= $vaksin->updated_date ?></td>
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
								<label class="col-md-3 col-form-label">Wilayah Domisili</label>
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
								<label class="col-md-3 col-form-label" for="nik">NIK</label>
								<div class="col-md-9">
									<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="(?=).{1,20}" title="Must contain 20 Number" id="" name="nik" class="form-control">
									<div class="invalid-feedback warning-nik"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="namaktp">Nama KTP</label>
								<div class="col-md-9">
									<input type="text" id="" name="namaktp" class="form-control">
									<div class="invalid-feedback warning-namaktp"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nohp">No HP</label>
								<div class="col-md-9">
									<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="(?=).{1,13}" title="Must contain 13 Number" id="" name="nohp" class="form-control">
									<div class="invalid-feedback warning-nohp"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="pernahvaksin">Pernah Vaksin</label>
								<div class="col-md-9">
									<select class="form-control" name="pernahvaksin" id="pernahvaksin" style="width: 100%;">
										<option value="Pernah" selected>Pernah</option>
										<option value="Tidak">Tidak Pernah</option>
									</select>
									<div class="invalid-feedback warning-pernahvaksin"></div>
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="dosis">Dosis</label>
								<div class="col-md-9">
									<select class="form-control" name="dosis" id="dosis" style="width: 100%;">
										<option value="Pertama" selected>Pertama</option>
										<option value="Kedua">Kedua</option>
									</select>
									<div class="invalid-feedback warning-dosis"></div>
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="email">Email</label>
								<div class="col-md-9">
									<input type="text" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" title="Format Email Salah" id="" name="email" class="form-control">
									<div class="invalid-feedback warning-email"></div>
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
								<label class="col-md-3 col-form-label">Wilayah Domisili</label>
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
										<input type="text" id="flag_locationEdit" name="flag_locationEdit" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nik">NIK</label>
								<div class="col-md-9">
									<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="(?=).{1,20}" title="Must contain 20 Number" onkeypress="return isNumberKey(event)"  id="" name="nik" class="form-control">
									<div class="invalid-feedback warning-nik"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="namaktp">Nama KTP</label>
								<div class="col-md-9">
									<input type="text" id="" name="namaktp" class="form-control">
									<div class="invalid-feedback warning-namaktp"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nohp">No HP</label>
								<div class="col-md-9">
									<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="(?=).{1,13}" title="Must contain 13 Number" id="" name="nohp" class="form-control">
									<div class="invalid-feedback warning-nohp"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="pernahvaksin">Pernah Vaksin</label>
								<div class="col-md-9">
									<select class="form-control" name="pernahvaksin" id="pernahvaksinEdit" style="width: 100%;">
										<option value="Pernah" selected>Pernah</option>
										<option value="Tidak">Tidak Pernah</option>
									</select>
									<div class="invalid-feedback warning-pernahvaksin"></div>
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="dosis">Dosis</label>
								<div class="col-md-9">
									<select class="form-control" name="dosis" id="dosisEdit" style="width: 100%;">
										<option value="Pertama" selected>Pertama</option>
										<option value="Kedua">Kedua</option>
									</select>
									<div class="invalid-feedback warning-dosis"></div>
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="email">Email</label>
								<div class="col-md-9">
									<input type="text" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" title="Format Email Salah" id="" name="email" class="form-control">
									<div class="invalid-feedback warning-email"></div>
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Data</h5>
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
										<select disabled class="form-control" id="provinsiView" name="provinsiView" style="width: 100%;">
											<option value="">Pilih Provinsi</option>
											<?php foreach($provinsi as $prov): ?>
											<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-provinsi"></div>
									</div>
									<br>
									<div class="col-md-15">
										<select disabled class="form-control" id="kabupatenView" name="kabupatenView" style="width: 100%;">
											<option value="">Pilih Kabupaten</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select disabled class="form-control" id="kecamatanView" name="kecamatanView" style="width: 100%;">
											<option value="">Pilih Kecamatan</option>
										</select>
									</div>
									<br>
									<div class="col-md-15">
										<select disabled class="form-control" id="kelurahanView" name="kelurahanView" style="width: 100%;">
											<option value="">Pilih Kelurahan</option>
										</select>
										<input type="text" id="flag_locationView" name="flag_locationView" style="display:none;" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nikView">NIK</label>
								<div class="col-md-9">
									<input type="text" disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="(?=).{1,20}" title="Must contain 20 Number" onkeypress="return isNumberKey(event)"  id="" name="nikView" class="form-control">
									<div class="invalid-feedback warning-nikView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="namaktpView">Nama KTP</label>
								<div class="col-md-9">
									<input type="text" disabled id="" name="namaktpView" class="form-control">
									<div class="invalid-feedback warning-namaktpView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="nohpView">No HP</label>
								<div class="col-md-9">
									<input type="text" disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="(?=).{1,13}" title="Must contain 13 Number" id="" name="nohpView" class="form-control">
									<div class="invalid-feedback warning-nohpView"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="pernahvaksinView">Pernah Vaksin</label>
								<div class="col-md-9">
									<select disabled class="form-control" name="pernahvaksinView" id="pernahvaksinView" style="width: 100%;">
										<option value="Pernah" selected>Pernah</option>
										<option value="Tidak">Tidak Pernah</option>
									</select>
									<div class="invalid-feedback warning-pernahvaksinView"></div>
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="dosisView">Dosis</label>
								<div class="col-md-9">
									<select disabled class="form-control" name="dosisView" id="dosisView" style="width: 100%;">
										<option value="Pertama" selected>Pertama</option>
										<option value="Kedua">Kedua</option>
									</select>
									<div class="invalid-feedback warning-dosis"></div>
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="emailView">Email</label>
								<div class="col-md-9">
									<input disabled type="text" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" title="Format Email Salah" id="" name="emailView" class="form-control">
									<div class="invalid-feedback warning-emailView"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
		$("#pernahvaksin").select2({
			dropdownParent: $('#tambahdata')
		});
		$("#dosis").select2({
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
		$("#kelurahanEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#pernahvaksinEdit").select2({
			dropdownParent: $('#editModal')
		});
		$("#dosisEdit").select2({
			dropdownParent: $('#editModal')
		});

		$("#provinsiView").select2({
			dropdownParent: $('#viewModal')
		});
		$("#kabupatenView").select2({
			dropdownParent: $('#viewModal')
		});
		$("#kecamatanView").select2({
			dropdownParent: $('#viewModal')
		});
		$("#kelurahanView").select2({
			dropdownParent: $('#viewModal')
		});
		$("#pernahvaksinView").select2({
			dropdownParent: $('#viewModal')
		});
		$("#dosisView").select2({
			dropdownParent: $('#viewModal')
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
				url: "<?= site_url() ?>/daftar_vaksin/store",
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
				url: "daftar_vaksins/update",
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

		$('#provinsiView').change(function(){ 
			var id= $(this).val();
			$('#flag_locationView').val("prov");

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
						$('#kabupatenView').html(html);
						$('#kecamatanView').html('<option value="">Pilih Kecamatan</option>');
						$('#kelurahanView').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kabupatenView').html('<option value="">Pilih Kabupaten</option>');
			}
		}); 
		$('#kabupatenView').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationView').val("prov");
			}
			else
			{
				$('#flag_locationView').val("kab");
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
						$('#kecamatanView').html(html);
						$('#kelurahanView').html('<option value="">Pilih Kelurahan</option>');
					}
				});
				return false;
			} else {
				$('#kecamatanView').html('<option value="">Pilih Kecamatan</option>');
			}
		}); 
		$('#kecamatanView').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationView').val("kab");
			}
			else
			{
				$('#flag_locationView').val("kec");
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
						$('#kelurahanView').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahanView').html('<option value="">Pilih Kelurahan</option>');
			}
		}); 
		$('#kelurahanView').change(function(){ 
			var id= $(this).val();
			if(id == '')
			{
				$('#flag_locationView').val("kec");
			}
			else
			{
				$('#flag_locationView').val("kel");
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

	function getProvinsiView(id_provinsi) {
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
				$('#provinsiView').html(html);
			}
		});
	}

	function getKabupatenView(id_provinsi,id_kabupaten) {
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
				$('#kabupatenView').html(html);
			}
		});
	}

	function getKecamatanView(id_kabupaten,id_kecamatan) {
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
				$('#kecamatanView').html(html);
			}
		});
	}

	function getKelurahanView(id_kecamatan,id_kelurahan) {
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
				$('#kelurahanView').html(html);
			}
		});
	}

	function editModal(id) {
		$('#editModal').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: 'daftar_vaksin/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
				//console.log(data);
				$('select[name=provinsi]').find('option:selected').removeAttr('selected');
				$('select[name=kabupaten]').find('option:selected').removeAttr('selected');
				$('select[name=kecamatan]').find('option:selected').removeAttr('selected');
				$('select[name=kelurahan]').find('option:selected').removeAttr('selected');
				$('select[name=dosisEdit]').find('option:selected').removeAttr('selected');
				$('select[name=pernahvaksinEdit]').find('option:selected').removeAttr('selected');
				$('input[name="id"]').val(id);
				$('input[name="nik"]').val(data.daftarvaksin.NIK);
				$('input[name="namaktp"]').val(data.daftarvaksin.NamaKTP);
				$('input[name="nohp"]').val(data.daftarvaksin.nohp);
				$("#pernahvaksinEdit").val(data.daftarvaksin.pernahvaksin);
				$("#dosisEdit").val(data.daftarvaksin.dosiske);
				$('input[name="email"]').val(data.daftarvaksin.email);
				$('input[name="flag_locationEdit"]').val(data.daftarvaksin.flag_location);

				$("#pernahvaksinEdit").trigger('change');
				$("#dosisEdit").trigger('change');
				
				$("#provinsiEdit").val(data.daftarvaksin.id_provinsi);
				
				if(data.daftarvaksin.flag_location == 'prov')
				{
					getProvinsi(data.daftarvaksin.id_provinsi)
					getKabupaten(data.daftarvaksin.id_provinsi,0)
					getKecamatan(0,0)
					getKelurahan(0,0)
				}
				else if(data.daftarvaksin.flag_location == 'kab')
				{
					getProvinsi(data.daftarvaksin.id_provinsi)
					getKabupaten(data.daftarvaksin.id_provinsi,data.daftarvaksin.id_kabupaten)
					getKecamatan(data.daftarvaksin.id_kabupaten,0)
					getKelurahan(0,0)
				}
				else if(data.daftarvaksin.flag_location == 'kec')
				{
					getProvinsi(data.daftarvaksin.id_provinsi)
					getKabupaten(data.daftarvaksin.id_provinsi,data.daftarvaksin.id_kabupaten)
					getKecamatan(data.daftarvaksin.id_kabupaten,data.daftarvaksin.id_kecamatan)
					getKelurahan(data.daftarvaksin.id_kecamatan,0)
				}
				else if(data.daftarvaksin.flag_location == 'kel')
				{
					getProvinsi(data.daftarvaksin.id_provinsi)
					getKabupaten(data.daftarvaksin.id_provinsi,data.daftarvaksin.id_kabupaten)
					getKecamatan(data.daftarvaksin.id_kabupaten,data.daftarvaksin.id_kecamatan)
					getKelurahan(data.daftarvaksin.id_kecamatan,data.daftarvaksin.id_kelurahan)
				}
				else
				{
					getProvinsi(data.daftarvaksin.id_provinsi)
					getKabupaten(data.daftarvaksin.id_provinsi,data.daftarvaksin.id_kabupaten)
					getKecamatan(data.daftarvaksin.id_kabupaten,data.daftarvaksin.id_kecamatan)
					getKelurahan(data.daftarvaksin.id_kecamatan,data.daftarvaksin.id_kelurahan)
				}
			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function viewModal(id) {
		$('#viewModal').modal();
		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: 'daftar_vaksin/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
				//console.log(data);
				$('select[name=provinsiView]').find('option:selected').removeAttr('selected');
				$('select[name=kabupatenView]').find('option:selected').removeAttr('selected');
				$('select[name=kecamatanView]').find('option:selected').removeAttr('selected');
				$('select[name=kelurahanView]').find('option:selected').removeAttr('selected');
				$('select[name=dosisView]').find('option:selected').removeAttr('selected');
				$('select[name=pernahvaksinView]').find('option:selected').removeAttr('selected');
				$('input[name="idView"]').val(id);
				$('input[name="nikView"]').val(data.daftarvaksin.NIK);
				$('input[name="namaktpView"]').val(data.daftarvaksin.NamaKTP);
				$('input[name="nohpView"]').val(data.daftarvaksin.nohp);
				$("#pernahvaksinView").val(data.daftarvaksin.pernahvaksin);
				$("#dosisView").val(data.daftarvaksin.dosiske);
				$('input[name="emailView"]').val(data.daftarvaksin.email);
				$('input[name="flag_locationView"]').val(data.daftarvaksin.flag_location);

				$("#pernahvaksinView").trigger('change');
				$("#dosisView").trigger('change');
				
				$("#provinsiView").val(data.daftarvaksin.id_provinsi);
				
				if(data.daftarvaksin.flag_location == 'prov')
				{
					getProvinsiView(data.daftarvaksin.id_provinsi)
					getKabupatenView(data.daftarvaksin.id_provinsi,0)
					getKecamatanView(0,0)
					getKelurahanView(0,0)
				}
				else if(data.daftarvaksin.flag_location == 'kab')
				{
					getProvinsiView(data.daftarvaksin.id_provinsi)
					getKabupatenView(data.daftarvaksin.id_provinsi,data.daftarvaksin.id_kabupaten)
					getKecamatanView(data.daftarvaksin.id_kabupaten,0)
					getKelurahanView(0,0)
				}
				else if(data.daftarvaksin.flag_location == 'kec')
				{
					getProvinsiView(data.daftarvaksin.id_provinsi)
					getKabupatenView(data.daftarvaksin.id_provinsi,data.daftarvaksin.id_kabupaten)
					getKecamatanView(data.daftarvaksin.id_kabupaten,data.daftarvaksin.id_kecamatan)
					getKelurahanView(data.daftarvaksin.id_kecamatan,0)
				}
				else if(data.daftarvaksin.flag_location == 'kel')
				{
					getProvinsiView(data.daftarvaksin.id_provinsi)
					getKabupatenView(data.daftarvaksin.id_provinsi,data.daftarvaksin.id_kabupaten)
					getKecamatanView(data.daftarvaksin.id_kabupaten,data.daftarvaksin.id_kecamatan)
					getKelurahanView(data.daftarvaksin.id_kecamatan,data.daftarvaksin.id_kelurahan)
				}
				else
				{
					getProvinsiView(data.daftarvaksin.id_provinsi)
					getKabupatenView(data.daftarvaksin.id_provinsi,data.daftarvaksin.id_kabupaten)
					getKecamatanView(data.daftarvaksin.id_kabupaten,data.daftarvaksin.id_kecamatan)
					getKelurahanView(data.daftarvaksin.id_kecamatan,data.daftarvaksin.id_kelurahan)
				}
			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data dengan Nama :  <b>' + content + '</b>');
		$('#formDelete').attr('action', 'daftar_vaksin/' + id + '/delete');
		$('#deleteModal').modal();
	}

</script>
