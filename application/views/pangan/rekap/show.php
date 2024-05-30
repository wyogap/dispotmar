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
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Data Ketahanan Pangan Terkini</div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-2">
							<h6>Satker</h6>
						</div>
						<div class="col-md-10">
							<h6><?= $pangan->nama_satker ?></h6>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<h6>Lokasi</h6>
						</div>
						<div class="col-md-10">
							<h6><?= $pangan->PROVINSI.', '.$pangan->KABUPATEN.', '.$pangan->KECAMATAN.', '.$pangan->KELURAHAN ?></h6>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered text-nowrap">
							<thead>
								<tr>
									<th>Luas Lahan (HA)</th>
									<th>TMT Pelaksanaan</th>
									<th>Estimasi Panen</th>
									<th>Estimasi Hasil</th>
									<th>Satuan</th>
									<th>Status Lahan</th>
									<th>Keterangan</th>
									<th>Progress</th>
									<th>Komoditas</th>
									<th>Kluster</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?= $pangan->luas_lahan ?></td>
									<td><?= $pangan->tmt ?></td>
									<td><?= $pangan->estimasi_panen ?></td>
									<td><?= $pangan->estimasi_hasil ?></td>
									<td><?= $pangan->nama_satuan ?></td>
									<td><?= $pangan->nama_statuslahan ?></td>
									<td><?= $pangan->keterangan ?></td>
									<td><?= $pangan->nama_progres ?></td>
									<td><?= $pangan->nama_komoditas ?></td>
									<td><?= $pangan->nama_cluster ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
	<!-- row opened -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Riwayat Perubahan Data Ketahanan Pangan</div>
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
							<thead>
								<tr>
									<th style="width: 5px;">No</th>
									<th>Luas Lahan (HA)</th>
									<th>TMT Pelaksanaan</th>
									<th>Estimasi Panen</th>
									<th>Estimasi Hasil</th>
									<th>Satuan</th>
									<th>Status Lahan</th>
									<th>Keterangan</th>
									<th>Progress</th>
									<th>Komoditas</th>
									<th>Kluster</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($histories as $history): ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $history->luas_lahan ?></td>
									<td><?= $history->tmt ?></td>
									<td><?= $history->estimasi_panen ?></td>
									<td><?= $history->estimasi_hasil ?></td>
									<td><?= $history->satuan ?></td>
									<td><?= $history->status ?></td>
									<td><?= $history->keterangan ?></td>
									<td><?= $history->progress ?></td>
									<td><?= $history->komoditas ?></td>
									<td><?= $history->cluster ?></td>
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
