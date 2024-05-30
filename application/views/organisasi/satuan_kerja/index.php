<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i> Organisasi</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Satker</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Data Satker</div>
					<div class="card-options">
						<div class="col-md-12 text-right">
							<a href="<?= site_url()?>organisasi_satker/create" id="tambahdatas" class="btn btn-success">Tambah</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<tr>
									<th class="text-center">Opsi</th>
									<th style="width: 5px;">No</th>
									<th>Satker</th>
									<th>Kode Satker</th>
									<th>Parent</th>
									<th>Level</th>
									<th>Updated By</th>
									<th>Last Updated</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach($satkers as $satker): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('ORG','read')): ?>
											<a href="<?= site_url()?>organisasi_satker/<?= encrypt($satker->id_satker) ?>/show" class="btn btn-sm btn-default "><i class="fa fa-eye "></i></a>
										<?php endif ?>
										<?php if(policy('ORG','update')): ?>
											<a href="<?= site_url()?>organisasi_satker/<?= encrypt($satker->id_satker) ?>/edit" class="btn btn-sm btn-primary "><i class="fa fa-pencil "></i></a>
										<?php endif ?>
										<?php if(policy('ORG','delete')): ?>
											<button
												onclick="deleteConfirm(`<?= encrypt($satker->id_satker); ?>`,'<?= $satker->nama_satker; ?>')"
												class="btn btn-sm btn-danger">
												<i class="fa fa-trash "></i>
											</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $satker->nama_satker ?></td>
									<td><?= $satker->kode_satker ?></td>
									<td><?= $satker->nama_parent_satker ?></td>
									<td><?= $satker->jenis_organisasi;?></td>
									<td><?= $satker->nama_pegawai ?></td>
									<td><?= $satker->LastUpdated;?></td>
									
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
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

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	function deleteConfirm(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>' + content + '</b>');
		$('#formDelete').attr('action', 'organisasi_satker/' + id + '/delete');
		$('#deleteModal').modal();
	}
</script>
