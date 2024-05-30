<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>User Management</a></li>
			<li class="breadcrumb-item active" aria-current="page">Permission</li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Role Permission</h4>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<?php if($modules): ?>
					<form method="POST" action="<?= site_url() ?>role_permission/<?= encrypt($role->id_role) ?>/update">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
						<div class="table-responsive">
							<table
								class="table table-bordered border-top table-responsive-md table-striped text-center mb-0 text-nowrap">
								<thead>
									<tr>
										<th>#</th>
										<th>Modul</th>
										<th>Create</th>
										<th>Read Only</th>
										<th>Read All</th>
										<th>Update</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; foreach($modules as $modul): ?>
									<tr>
										<td><?= $no++ ?></td>
										<td class="text-left"><?= $modul->nama_modul ?></td>
										<td>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="create" name="create[<?= $modul->id_permission ?>]" <?= ($modul->create) ? 'checked' : '' ?>>
											</div>
										</td>
										<td>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="read" name="read[<?= $modul->id_permission ?>]" <?= ($modul->read) ? 'checked' : '' ?>>
											</div>
										</td>
										<td>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="read_all" name="read_all[<?= $modul->id_permission ?>]" <?= ($modul->read_all) ? 'checked' : '' ?>>
											</div>
										</td>
										<td>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="update" name="update[<?= $modul->id_permission ?>]" <?= ($modul->update) ? 'checked' : '' ?>>
											</div>
										</td>
										<td>
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="delete" name="delete[<?= $modul->id_permission ?>]" <?= ($modul->delete) ? 'checked' : '' ?>>
											</div>
										</td>
									</tr>
									<?php endforeach?>
								</tbody>
							</table>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-success">Simpan</button>
							</div>
						</div>
					</form>
					<?php else: ?>
						<center>
							<h3 class="text-muted">Role belum memiliki Permission</h3>
							<h4 class="text-muted">Buat Permission untuk role terlebih dahulu</h4>
							<a href="<?= site_url()?>role_permission/<?= encrypt($role->id_role) ?>/store" class="btn btn-success">Generate Permissions</a>
						</center>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- NOTED :
Kriteria implement di masing2 modul:
Create : jika true maka show button tambah
Read : Jika true maka hanya menampilkan data yang dimiliki user satker login
Read All : Jika true menampilkan seluruh data satker 
Update : Jika true maka show button edit
Delete : Jika true maka show button delete -->
