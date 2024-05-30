<div class="row">
		
	<div class="col-md-12">
		<div class="card mb-0" >
			<div class="card-header">
				<h4 class="card-title"><?= $title?> - <?= $nama_satker?>  </h4>
				<div class="card-options ">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
						class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
						class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="table-detail" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
						<thead>
							<th>No</th>
							<?php foreach($columns as $columnKey => $columnValue): ?>
								<th><?= $columnValue ?></th>
							<?php endforeach ?>
						</thead>
						<tbody>
							<?php $no=1; foreach($tableDatas as $tableData): ?>
							<tr>
								<td><?= $no++ ?></td>
								<?php foreach($columns as $columnKey => $columnValue): ?>
									<td><?= $tableData->{$columnKey} ?></td>
								<?php endforeach ?>
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

<script>
	$(document).ready(function() {
    	$('#table-detail').DataTable();
	} );
</script>