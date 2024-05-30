<div class="row">
		
	<div class="col-md-6">
		<div class="card overflow-hidden">
			<div class="card-body">
				<div id="map" style="width:100%;height:500px;"></div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card mb-0" >
			<div class="card-header">
				<h4 class="card-title"><?= $title?> - <?= $nama_satker?>  </h4>
				<div class="card-options ">
					<!-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
						class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
						class="fe fe-maximize"></i></a> -->
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

<script async="false"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByRkCzDDjo-th8ecT72ZBN6f69RUmwt0I&callback=initMap"></script>

<script>
	$(document).ready(function() {
    	$('#table-detail').DataTable();
	} );

	var markerDatas = <?= $markers_json ?>;

	function initMap() {
		//console.log('markerDatas', markerDatas);
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {
				lat: -2.548926,
				lng: 118.0148634
			},
			zoom: 4
		});
		var infowindow = new google.maps.InfoWindow({maxWidth: 1000}), marker, i;
		for (i = 0; i < markerDatas.length; i++) {
			markerData = markerDatas[i]
			pos = new google.maps.LatLng(markerData.latitude, markerData.longitude);
			marker = new google.maps.Marker({
				position: pos,
				map: map,
				title: markerData.nama_satker,
				icon: '<?= site_url()?>assets/images/markers/embassy.png'
			});
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent(
								'<div id="content">' +
									'<div id="siteNotice">Mangrove</div>' +
									'<table>' +
									'<tr> <td>Jumlah Tanam</td> <td>:</td> <td>' + markerData.jumlah + '</td></tr>' +
									'<tr> <td>Tanggal Tanam</td> <td>:</td> <td>' + (markerData.tgl_tanam ? markerData.tgl_tanam : '') + '</td></tr>' +
									'<tr> <td>Keterangan</td> <td>:</td> <td>' + markerData.keterangan + '</td></tr>' +
									'</table>' +
								'</div>'
					);				
					infowindow.open(map, marker);
				}
			})(marker, i));
		}
	}
</script>
