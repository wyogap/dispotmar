<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Tracer Vaksin</a></li>
			<li class="breadcrumb-item active" aria-current="page">Entry Kasus Covid</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Entry Kasus Covid</div>
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
							<a href="<?= site_url()?>entry_kasus_covid/create" id="tambahdatas"
								class="btn btn-success">Tambah</a>
						</div>
					</div>
					<br>
					<div class="table-responsive">
						<table id="example" style="table-layout: auto; width: 100%;"
							class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<th>Opsi</th>
								<th>Kontak Erat</th>
								<th>No</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Status</th>
								<th>Gejala</th>
								<th>Kab/ Kota</th>
								<th>Kecamatan</th>
								<th>Desa</th>
								<th>Total Kontak Erat</th>
								<th>Tanggal Laporan</th>
								<th>ReportedBy</th>
								<th>Kotama</th>
								<th>Satker</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($dataEntryKasusCovid as $KasusCovid): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('VAKSIN','update')): ?>
										<a class="btn btn-sm btn-default"
											href="<?= site_url()?>entry_kasus_covid/view/<?= encrypt($KasusCovid->idkasus); ?>/show">
											<i class="fa fa-eye"></i>
										</a>
										<a class="btn btn-sm btn-primary"
											href="<?= site_url()?>entry_kasus_covid/edit/<?= encrypt($KasusCovid->idkasus); ?>/edit">
											<i class="fa fa-pencil"></i>
										</a>
										<?php endif ?>
										<?php if(policy('VAKSIN','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($KasusCovid->idkasus); ?>`,'<?= $KasusCovid->namaktp; ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td class="text-center">
										<?php if(policy('VAKSIN','update')): ?>
										<a class="btn btn-sm btn-info" id="tambahdatas" data-toggle="modal"
											onclick="kontakEratgetID('<?= $KasusCovid->idkasus; ?>')"
											data-target="#tambahdata">
											<i class="fa fa-plus"></i>
										</a>
										<a class="btn btn-sm btn-info"
											href="<?= site_url()?>entry_kasus_covid/detail_kontakerat/<?= encrypt($KasusCovid->idkasus); ?>/showdetail">
											<i class="fa fa-eye"></i>
										</a>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $KasusCovid->nik ?></td>
									<td><?= $KasusCovid->namaktp ?></td>
									<td><?= $KasusCovid->status ?></td>
									<td><?= $KasusCovid->gejala ?></td>
									<td><?= $KasusCovid->geo_kabkotadomisili ?></td>
									<td><?= $KasusCovid->geo_kecdomisili ?></td>
									<td><?= $KasusCovid->geo_kelurahandomisili ?></td>
									<td><?= $KasusCovid->TotalKontak ?></td>
									<td><?= $KasusCovid->tanggallapor ?></td>
									<td><?= $KasusCovid->nama_pegawai ?></td>
									<td><?= $KasusCovid->namakotama ?></td>
									<td><?= $KasusCovid->nama_satker ?></td>
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
										<input type="text" id="flag_location" name="flag_location" style="display:none;"
											class="form-control">
										<br>
										<input type="text" id="idkasus" name="idkasus" style="display:none;"
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
									<select class="form-control" name="pekerjaan" id="pekerjaan" style="width: 100%;">
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
									<input type="text" id="alamatdomisili" name="alamatdomisili" class="form-control">
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

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function () {

		$('.modal').on('hidden.bs.modal', function (e) {
			$('select').find('option:selected').removeAttr('selected');
			$('input').val('');

			$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
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
		$("#pekerjaan").select2({
			dropdownParent: $('#tambahdata')
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
	});

	function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data dengan Nama :  <b>' + content + '</b>');
		$('#formDelete').attr('action', 'entry_kasus_covid/' + id + '/delete');
		$('#deleteModal').modal();
	}

	function kontakEratgetID(Id) {
		$('#idkasus').val(Id);
	}

</script>