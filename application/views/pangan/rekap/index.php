<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Ketahanan Pangan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Rekap Pangan</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card overflow-hidden">
				<div class="card-header">
					<h3 class="card-title">Filter</h3>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<form method="GET" action="pangan_rekap">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group row">
									<label class="col-md-2 col-form-label">Satker </label>
									<div class="col-md-10">
										<?php if(($this->session->userdata('role') == 'Satker')): ?>
											<input type="hidden" class="form-control" id="hiddensatker" name="satker" value="<?= $this->session->userdata('id_satker') ?>">
											<select class="form-control" id="satkerPicked" name="satkerPicked" disabled>
										<?php else: ?>
											<select class="form-control" id="satker" name="satker" style="width:100%;">
										<?php endif ?>
											<option value="">Pilih Satuan Kerja</option>
											<?php foreach($satkers as $satker): ?>
											<option 
												<?= $this->input->get('satker') == $satker->id_satker ? 'selected' : '' ?> 
												value="<?= $satker->id_satker ?>" 
												<?= ($this->session->userdata('role') == 'Satker' && $satker->id_satker == $this->session->userdata('id_satker')) ? 'selected' : '' ?>
											>
											<?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
										<div class="text-danger warning-satker"></div>
									</div>
								</div>
							</div>
							<div class="col-xl-4">
								<div class="form-group row">
								<label class="col-md-4 col-form-label">TMT Pelaksanaan</label>
									<div class="col-md-8">
										<input type="text" class="form-control pull-right" name="tmt" id="tmt">
									</div>
								</div>
							</div>
							<div class="col-xl-4">
								<div class="form-group row">
								<label class="col-md-4 col-form-label">Estimasi Panen</label>
									<div class="col-md-8">
										<input type="text" class="form-control pull-right" name="panen" id="panen">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="text-center">
									<button class="btn btn-primary btn-block mt-5" type="submit">Filter</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->


	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
			<div class="card-header">
					<div class="card-title">
						Data Pelaporan &emsp;
						<?= $this->input->get() ? '<a href="pangan_rekap" style="color:white;" class="btn btn-sm btn-warning">Hapus Filter</a>' : '' ?>
					</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
					<table id="example" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<tr>
									<th>Opsi</th>
									<th style="width: 5px;">No</th>
									<th>Nama Satker</th>
									<th>Kluster</th>
									<th>Komoditas</th>
									<th>Luas Lahan (HA)</th>
									<th>TMT Pelaksanaan</th>
									<th>Estimasi Panen</th>
									<th>Estimasi Hasil</th>
									<th>Satuan Estimasi Hasil</th>
									<th>Jumlah Bibit/Bakalan</th>
									<th>Satuan</th>
									<th>Status Lahan</th>
									<th>Keterangan</th>
									<th>Progress</th>
									<th>Lokasi</th>
									<th>Created Date</th>
									<th>Updated By</th>
									<th>Last Updated</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=1; foreach($rekap as $pangan): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('KETPANG','update')): ?>
										<a href="pangan_rekap/<?= encrypt($pangan->id_rekap_pangan) ?>" class="btn btn-sm btn-primary">
											<i class="fa fa-eye "></i>
										</a>
										<a href="pangan_rekap_edit/<?= encrypt($pangan->id_rekap_pangan) ?>" class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</a>
										<?php endif ?>
										<?php if(policy('KETPANG','delete')): ?>
										<button onclick="deleteConfirm(`<?= encrypt($pangan->id_rekap_pangan); ?>`)" class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $pangan->nama_satker ?></td>
									<td><?= $pangan->nama_cluster ?></td>
									<td><?= $pangan->nama_komoditas ?></td>
									<td><?= $pangan->luas_lahan ?></td>
									<td class="text-center"><?= $pangan->tmt_ ?></td>
									<td class="text-center"><?= $pangan->estimasi_panen_ ?></td>
									<td><?= $pangan->estimasi_hasil ?></td>
									<td><?= $pangan->nama_satuan ?></td>
									<td><?= $pangan->jmlbibit ?></td>
									<td><?= $pangan->nama_satuan2 ?></td>
									<td><?= $pangan->nama_statuslahan ?></td>
									<td><?= $pangan->keterangan ?></td>
									<td><?= $pangan->nama_progres ?></td>
									<td><?= $pangan->PROVINSI ?></td>
									<td><?= $pangan->createddate ?></td>
									<td><?= $pangan->nama_pegawai ?></td>
									<td><?= $pangan->LastUpdated ?></td>
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
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<form class="form-horizontal">
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="Kluster">Kluster</label>
								<div class="col-md-9">
									<select class="form-control">
										<option value="Perikanan">Perikanan</option>
										<option value="Peternakan">Peternakan</option>
										<option value="Pertanian">Pertanian</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama Komoditas</label>
								<div class="col-md-9">
									<input type="text" class="form-control" value="">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</div>
</div>
<!-- Edit Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<form class="form-horizontal">
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="Kluster">Kluster</label>
								<div class="col-md-9">
									<select class="form-control">
										<option value="Perikanan">Perikanan</option>
										<option value="Peternakan">Peternakan</option>
										<option value="Pertanian">Pertanian</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama Komoditas</label>
								<div class="col-md-9">
									<input type="text" class="form-control" value="">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</div>
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

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function () {
		$("#satker").select2();
	});

	$(function (e) {
		'use strict'

		$('#tmt').daterangepicker({
			autoUpdateInput: false,
			locale: {
				format: 'YYYY-MM-DD'
			}
		});
		$('#panen').daterangepicker({
			autoUpdateInput: false,
			locale: {
				format: 'YYYY-MM-DD'
			}
		});

		<?php if ($this->input->get('tmt')): ?>
			const tmtStart = "<?= explode(' ',$this->input->get('tmt'))[0] ?>"
			const tmtEnd = "<?= explode(' ',$this->input->get('tmt'))[2] ?>"
			$('#tmt').daterangepicker({
				locale: {
					format: 'YYYY-MM-DD'
				},
				startDate: tmtStart,
				endDate: tmtEnd
			});
		<?php endif ?>
		<?php if ($this->input->get('panen')): ?>
			const panenStart = "<?= explode(' ',$this->input->get('panen'))[0] ?>"
			const panenEnd = "<?= explode(' ',$this->input->get('panen'))[2] ?>"
			$('#panen').daterangepicker({
				locale: {
					format: 'YYYY-MM-DD'
				},
				startDate: panenStart,
				endDate: panenEnd
			});
		<?php endif ?>

		$('#tmt').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		});
		$('#panen').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		});
	});
</script>
<script>
function deleteConfirm(id){
    $('input[name="id"]').val(id);
	$('#delete-modal-content').html('Anda akan menghapus data rekap pangan.');
	$('#formDelete').attr('action', 'pangan_rekap/'+id+'/delete');
	$('#deleteModal').modal();
}
</script>
