<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Geografi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Sarana Prasarana</li>
			<li class="breadcrumb-item active" aria-current="page">Pelabuhan Sungai</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Pelabuhan Laut</div>
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
						<!-- <div class="col-md-12 col-lg-12 card-title">Data Hutan</div> -->
						<div class="col-md-12 text-right">
							<a href="<?php site_url()?>geografi_pelabuhanLaut/create" id="tambahdatas" class="btn btn-success">
								Tambah Data
							</a>
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
								<th>Nama Pelabuhan</th>
								<th>Alamat</th>
								<th>No Telp</th>
								<th>Informasi Umum</th>
								<th>Updated By</th>
								<th>Last Updated</th>
							</thead>
							<tbody>

							<?php $no=1; foreach($dataPelabuhanLaut as $laut): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('GEO','update')): ?>
											<a href="<?php site_url()?>geografi_pelabuhanLaut/<?= encrypt($laut->id_pelabuhan_laut)?>/show" class="btn btn-sm btn-default">
												<i class="fa fa-eye "></i>
											</a>
										<?php endif ?>
										<?php if(policy('GEO','update')): ?>
											<a href="<?php site_url()?>geografi_pelabuhanLaut/<?= encrypt($laut->id_pelabuhan_laut)?>/edit" class="btn btn-sm btn-primary">
												<i class="fa fa-pencil "></i>
											</a>
										<?php endif ?>
										<?php if(policy('GEO','delete')): ?>
										<button
											onclick="deleteConfirm(`<?= encrypt($laut->id_pelabuhan_laut); ?>`,'<?= $laut->nama_pelabuhan ?>')"
											class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $laut->nama_satker ?></td>
									<td><?= $laut->wilayah ?></td>
									<td><?= $laut->nama_pelabuhan ?></td>
									<td><?= $laut->alamat ?></td>
									<td class="text-center"><?= $laut->telepon ?></td>
									<td><?= $laut->informasi_umum ?></td>
									<td class="text-center"><?= $laut->nama_pegawai ?></td>
									<td class="text-center"><?= $laut->LastUpdated ?></td>
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
function deleteConfirm(id, content) {
	$('input[name="id"]').val(id);
	$('#delete-modal-content').html('Anda akan menghapus data <b>' + content + '</b>');
	$('#formDelete').attr('action', '<?= site_url() ?>geografi_pelabuhanLaut/' + id + '/delete');
	$('#deleteModal').modal();
}
</script>
