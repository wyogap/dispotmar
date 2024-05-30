<div class="section">
	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="ti-package mr-1"></i>Audit Trail</a></li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Audit Trail</div>
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
						<table id="tbl-a" class="table table-striped table-bordered text-nowrap">
							<!-- sort data terakhir paling atas -->
							<thead>
								<tr>
									<th>Id</th>
									<th>Nama User</th>
									<th>Event</th>
									<th>Nama Table</th>
									<th>Old Value</th>
									<th>New Value</th>
									<th>URL</th>
									<th>Created At</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($audits as $audit): ?>
								<tr>
									<td><?= $audit->id ?></td>
									<td><?= $audit->nama_pegawai ?></td>
									<td><?= $audit->event ?></td>
									<td><?= $audit->table_name ?></td>
									<td><?= $audit->old_values ?></td>
									<td><?= $audit->new_values ?></td>
									<td><?= $audit->url ?></td>
									<td><?= $audit->created_at ?></td>
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
