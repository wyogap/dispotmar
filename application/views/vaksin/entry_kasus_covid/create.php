<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Tracer Covid</a></li>
			<li class="breadcrumb-item active" aria-current="page">Form Entry Kasus Covid</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">Form Entry Kasus Covid</div>
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
											<a class="nav-link disabled" id="gejala-tab" data-toggle="tab"
												href="#gejala" role="tab" aria-controls="gejala"
												aria-selected="true">Gejala</a>
										</li>
										<li class="nav-item">
											<a class="nav-link disabled" id="pelapor-tab" data-toggle="tab"
												href="#pelapor" role="tab" aria-controls="pelapor"
												aria-selected="true">Pelapor</a>
										</li>
									</ul>
									<div class="tab-content  p-3 border" id="myTabContent">
										<div class="tab-pane fade p-0 active show" id="profile" role="tabpanel"
											aria-labelledby="profile-tab">
											<div id="profile-log-switch">
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Tanggal Laporan</label>
													<div class="col-md-4">
														<input type="date" class="form-control" name="tanggallapor"
															id="tanggallapor" placeholder="YYYY-MM-DD HH:ii:ss">
														<div class="invalid-feedback warning-tanggallapor"></div>
													</div>
													<label class="col-md-2 col-form-label">Provinsi</label>
													<div class="col-md-4">
														<select class="form-control" id="provinsi" name="provinsi"
															style="width:100%;">
															<option value="">Pilih Provinsi</option>
															<?php foreach($provinsi as $prov): ?>
															<option value="<?= $prov->id_geografi ?>"><?= $prov->nama ?>
															</option>
															<?php endforeach ?>
														</select>
														<div class="text-danger warning-provinsi"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">NIK</label>
													<div class="col-md-4">
														<input type="text" id="nik" name="nik" maxlength="20"
															oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
															class="form-control" value="">
														<div class="invalid-feedback warning-nik"></div>
													</div>
													<label class="col-md-2 col-form-label">Kabupaten</label>
													<div class="col-md-4">
														<select class="form-control" id="kabupaten" name="kabupaten"
															style="width:100%;">
															<option value="">Pilih Kabupaten</option>
														</select>
														<div class="text-danger warning-kabupaten"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Nama KTP</label>
													<div class="col-md-4">
														<input type="text" id="namaktp" name="namaktp"
															class="form-control" value="">
														<div class="text-danger warning-namaktp"></div>
													</div>
													<label class="col-md-2 col-form-label">Kecamatan</label>
													<div class="col-md-4">
														<select class="form-control" id="kecamatan" name="kecamatan"
															style="width:100%;">
															<option value="">Pilih Kecamatan</option>
														</select>
														<div class="text-danger warning-kecamatan"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Usia</label>
													<div class="col-md-4">
														<input type="number" id="umur" name="umur" class="form-control"
															value="">
														<div class="invalid-feedback warning-umur"></div>
													</div>
													<label class="col-md-2 col-form-label">Kelurahan</label>
													<div class="col-md-4">
														<select class="form-control" id="kelurahan" name="kelurahan"
															style="width:100%;">
															<option value="">Pilih Kelurahan</option>
														</select>
														<div class="text-danger warning-kelurahan"></div>
														<input type="text" id="flag_location" name="flag_location"
															style="display:none;" class="form-control">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">No Hp/WA</label>
													<div class="col-md-4">
														<input type="text" id="telphp" name="telphp" maxlength="13"
															oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
															class="form-control" value="">
														<div class="text-danger warning-telphp"></div>
													</div>
													<label class="col-md-2 col-form-label">Alamat KTP</label>
													<div class="col-md-4">
														<textarea class="form-control" rows="3" id="alamatktp"
															name="alamatktp"></textarea>
														<div class="invalid-feedback warning-alamatktp"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label"></label>
													<div class="col-md-4">
													</div>
													<label class="col-md-2 col-form-label">Alamat Domisili</label>
													<div class="col-md-4">
														<textarea class="form-control" rows="3" id="alamatdomisili"
															name="alamatdomisili"></textarea>
														<div class="invalid-feedback warning-alamatdomisili"></div>
													</div>
												</div>
												<div class="text-left">
													<a href="<?= site_url()?>entry_kasus_covid" target="_blank"
														class="btn btn-danger">Back To
														List</a>
													<button id="btnNextProfile" type="button"
														class="btn btn-info">Next</button>
												</div>
											</div>
										</div>

										<div class="tab-pane fade p-0 " id="gejala" role="tabpanel"
											aria-labelledby="gejala-tab">
											<div id="profile-log-switch">
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Status</label>
													<div class="col-md-4">
														<select class="form-control" style="width: 100%;" id="ddlstatus"
															name="ddlstatus">
															<option value="" selected>Pilih Status</option>
															<option value="Suspect">Suspect</option>
															<option value="Konfirmasi">Konfirmasi</option>
															<option value="Karantina">Karantina</option>
															<option value="Isoman">Isoman</option>
															<option value="Selesai">Selesai</option>
														</select>
														<div class="invalid-feedback warning-ddlstatus"></div>
													</div>
													<label class="col-md-2 col-form-label">Gejala</label>
													<div class="col-md-4">
														<select class="form-control" style="width: 100%;" id="ddlgejala"
															name="ddlgejala">
															<option value="" selected>Pilih Gejala</option>
															<option value="TanpaGejala">Tanpa Gejala</option>
															<option value="Ringan">Ringan</option>
															<option value="Sedang">Sedang</option>
															<option value="Berat">Berat</option>
														</select>
														<div class="text-danger warning-ddlgejala"></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-2 col-form-label">Faskes</label>
													<div class="col-md-4">
														<input type="text" id="faskes" name="faskes"
															class="form-control" value="">
														<div class="text-danger warning-faskes"></div>
													</div>
													<label class="col-md-2 col-form-label">Deskripsi Gejala</label>
													<div class="col-md-4">
														<textarea class="form-control" rows="3" id="deskripsigejala"
															name="deskripsigejala"></textarea>
														<div class="invalid-feedback warning-deskripsigejala"></div>
													</div>
												</div>
												<div class="form-group row" id="div_lokasikarantina"
													style="display:none;">
													<label class="col-md-2 col-form-label"></label>
													<div class="col-md-4">
													</div>
													<label class="col-md-2 col-form-label">Lokasi Karantina</label>
													<div class="col-md-4">
														<input type="text" id="lokasikarantina" name="lokasikarantina"
															class="form-control" value="">
														<div class="text-danger warning-lokasikarantina"></div>
													</div>
												</div>
												<div class="text-left">
													<a href="<?= site_url()?>entry_kasus_covid" target="_blank"
														class="btn btn-danger">Back To
														List</a>
													<button id="btnNextGejala" type="button"
														class="btn btn-info">Next</button>
												</div>
											</div>
										</div>

										<div class="tab-pane fade p-0 " id="pelapor" role="tabpanel"
											aria-labelledby="pelapor-tab">
											<div class="form-group row">
												<label class="col-md-2 col-form-label">Kotama</label>
												<div class="col-md-4">
													<select class="form-control" id="kotama" name="kotama"
														style="width:100%;">
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
												<label class="col-md-2 col-form-label">Satuan Kerja</label>
												<div class="col-md-4">
													<select class="form-control" id="satkerpelapor" name="satkerpelapor"
														style="width:100%;">
														<option value="">Pilih Satker Pelapor</option>
													</select>
													<div class="text-danger warning-satkerpelapor"></div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-2 col-form-label">Pelapor</label>
												<div class="col-md-4">
													<select class="form-control" id="reportedby" name="reportedby"
														style="width:100%;">
														<option value="">Pilih Pelapor</option>
														<?php foreach($users as $user): ?>
														<option value="<?= $user->id_user ?>"><?= $user->nama_pegawai ?>
														</option>
														<?php endforeach ?>
													</select>
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
										<button id="btnSubmit" type="submit" class="btn btn-primary"
											style="display: none;">Simpan</button>
										<button id="btnLoading" class="btn btn-secondary" style="display: none;"
											disabled>Sedang menyimpan data</button>
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

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function () {
		$("#ddlstatus").select2();
		$("#ddlgejala").select2();
		$("#provinsi").select2();
		$("#kabupaten").select2();
		$("#kecamatan").select2();
		$("#kelurahan").select2();
		$("#kotama").select2();
		$("#satkerpelapor").select2();
		$("#reportedby").select2();

		$('input').on('keyup change', function () {
			var name = $(this).attr('name')
			$('input[name="' + name + '"]').removeClass('is-invalid')
			$('.warning-' + name).html('')
		});
		$('select').on('change', function () {
			var name = $(this).attr('name')
			$('.warning-' + name).html('')
		});

		$('#ddlstatus').change(function () {
			var valueddl = $(this).val();
			if (valueddl == 'Karantina') {
				$('#div_lokasikarantina').show();
			} else {
				$('#div_lokasikarantina').hide();
			}
		});

		$('#btnNextProfile').on('click', function () {
			if (
				$('#nik').val() == "" ||
				$('#namaktp').val() == "" ||
				$('#tanggallapor').val() == "" ||
				$('#umur').val() == "" ||
				$('#telphp').val() == "" ||
				$('#provinsi').val() == "" ||
				$('#kabupaten').val() == "" ||
				$('#kecamatan').val() == "" ||
				$('#kelurahan').val() == "" ||
				$('#alamatktp').val() == "" ||
				$('#alamatdomisili').val() == ""
			) {
				alert("Lengkapi data terlebih dahulu !");
			} else {
				$('#profile-tab').removeClass("active show")
				$('#profile').removeClass("active show")

				$('#gejala-tab').removeClass("disabled")
				$('#gejala-tab').addClass("active show")
				$('#gejala').addClass("active show")
			}
		});

		$('#btnNextGejala').on('click', function () {
			if (
				$('#ddlstatus').val() == "" ||
				$('#ddlgejala').val() == "" ||
				$('#deskripsigejala').val() == ""
			) {
				alert("Lengkapi data terlebih dahulu !");
			} else {
				$('#gejala-tab').removeClass("active show")
				$('#gejala').removeClass("active show")

				$('#pelapor-tab').removeClass("disabled")
				$('#pelapor-tab').addClass("active show")
				$('#pelapor').addClass("active show")
				$('#btnSubmit').show();
			}
		});

		$('#provinsi').change(function () {
			var id = $(this).val();
			$('#flag_location').val("prov");

			if (id) {
				$.ajax({
					url: "<?= site_url() ?>api/getKabupaten/" + id,
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
						$('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
						$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
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
					url: "<?= site_url() ?>api/getKecamatan/" + id,
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
						$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
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

			if (id) {
				$.ajax({
					url: "<?= site_url() ?>api/getKelurahan/" + id,
					method: "GET",
					async: true,
					dataType: 'json',
					success: function (data) {
						var html = '';
						var i;
						html += '<option value="">Pilih Kelurahan</option>';
						for (i = 0; i < data.length; i++) {
							html += '<option value=' + data[i].id_geografi + '>' + data[i]
								.nama + '</option>';
						}
						$('#kelurahan').html(html);
					}
				});
				return false;
			} else {
				$('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
			}
		});
		$('#kelurahan').change(function () {
			var id = $(this).val();
			if (id == '') {
				$('#flag_location').val("kec");
			} else {
				$('#flag_location').val("kel");
			}
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
							html += '<option value="">Pilih Satker Pelapor</option>';
							for (i = 0; i < data.length; i++) {
								html += '<option value=' + data[i].id_satker + '>' + data[i]
									.nama_satker + '</option>';
							}
							$('#satkerpelapor').html(html);
						} else {
							var html = '';
							var valueText_kotama = $('#kotama :selected').text();
							var value_kotama = $('#kotama').val();
							html += '<option value="">Pilih Satker</option>';
							html += '<option value=' + value_kotama + ' selected>' +
								valueText_kotama + '</option>';
							$('#satkerpelapor').html(html);
						}
					}
				});
				return false;
			} else {
				$('#satkerpelapor').html('<option value="">Pilih Satker Pelapor</option>');
			}
		});

		$('#addForm').submit(function () {

			if (
				$('#kotama').val() == "" ||
				$('#satkerpelapor').val() == "" ||
				$('#reportedby').val() == ""
			) {
				alert("Lengkapi data terlebih dahulu !");
			} else {
				var formData = new FormData();
				formData.append('csrf_al', $('input[name="csrf_al"]').val());
				formData.append('tanggallapor', $('#tanggallapor').val());
				formData.append('nik', $('#nik').val());
				formData.append('namaktp', $('#namaktp').val());
				formData.append('umur', $('#umur').val());
				formData.append('telphp', $('#telphp').val());
				formData.append('alamatktp', $('#alamatktp').val());
				formData.append('alamatdomisili', $('#alamatdomisili').val());
				formData.append('provinsidomisili', $('#provinsi').val());
				formData.append('kabkotadomisili', $('#kabupaten').val());
				formData.append('kecdomisili', $('#kecamatan').val());
				formData.append('kelurahandomisili', $('#kelurahan').val());
				formData.append('status', $('#ddlstatus').val());
				formData.append('gejala', $('#ddlgejala').val());
				formData.append('deskripsigejala', $('#deskripsigejala').val());
				formData.append('lokasikarantina', $('#lokasikarantina').val());
				formData.append('faskes', $('#faskes').val());
				formData.append('kotama', $('#kotama').val());
				formData.append('satkerpelapor', $('#satkerpelapor').val());
				formData.append('reportedby', $('#reportedby').val());
				formData.append('flag_location', $('#flag_location').val());

				$.ajax({
					type: "POST",
					url: "<?= site_url()?>entry_kasus_covid/store",
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
							//window.location.reload();
							var link = "<?= site_url() ?>/entry_kasus_covid";
							window.location.assign(link)
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

</script>
