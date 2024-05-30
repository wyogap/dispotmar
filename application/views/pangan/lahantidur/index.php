<div class="section">
	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Ketahanan Pangan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Rekap Lahan Tidur</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Rekap Lahan Tidur</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<!-- <div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-success" data-toggle="modal" data-target="#tambahdata">
								Tambah
							</button>
						</div>
					</div>
					<br> -->
					<div class="table-responsive">
					<table id="example" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
							<thead>
								<th>Opsi</th>
								<th>No</th>
								<th>Satker</th>
								<th>Lokasi</th>
								<th>Luas Total (HA)</th>
								<th>Digarap (HA)</th>
								<th>Lahan Tidur (HA)</th>
								<th>Ket</th>
								<th>Updated By</th>
								<th>Last Updated</th>
							</thead>
							<tbody>
								<?php $no=1; foreach($lahantidur as $lahan): ?>
								<tr>
									<td class="text-center">
										<?php if(policy('KETPANG','update')): ?>
										<a href="pangan_lahantidur_edit/<?= encrypt($lahan->id_lahan_tidur) ?>" class="btn btn-sm btn-primary">
											<i class="fa fa-pencil "></i>
										</a>
										<?php endif ?>
										<?php if(policy('KETPANG','delete')): ?>
										<button onclick="deleteConfirm(`<?= encrypt($lahan->id_lahan_tidur); ?>`,'<?= $lahan->lokasi; ?>')" class="btn btn-sm btn-danger">
											<i class="fa fa-trash "></i>
										</button>
										<?php endif ?>
									</td>
									<td><?= $no++ ?></td>
									<td><?= $lahan->nama_satker ?></td>
									<td><?= $lahan->lokasi ?></td>
									<td><?= $lahan->luas_total ?></td>
									<td><?= $lahan->digarap ?></td>
									<td><?= $lahan->lahan_tidur ?></td>
									<td><?= $lahan->keterangan ?></td>
									<td><?= $lahan->nama_pegawai ?></td>
									<td><?= $lahan->LastUpdated ?></td>
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

<script>
function deleteConfirm(id,content){
    $('input[name="id"]').val(id);
	$('#delete-modal-content').html('Anda akan menghapus data <b>'+content+'</b>');
	$('#formDelete').attr('action', 'pangan_lahantidur/'+id+'/delete');
	$('#deleteModal').modal();
}
</script>
