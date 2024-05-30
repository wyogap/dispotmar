<div id="map" style="width:100%;height:500px;"></div>

<script>
function markerListener(myMap, marker, markerData){
	return function() {
		myMap.infowindow.setContent(
			'<div id="content">' +
				'<div id="siteNotice">Mangrove</div>' +
				'<a target="_blank" style="color: #0000FF;" href="'+myMap.siteUrl+'organisasi_satker/'+ markerData.id_satker_encrypted +'/show"><h5 id="firstHeading" class="firstHeading">'+markerData.nama_satker+'</h5></a>' +
				'<h6>' + nullSafe(markerData.nama_pimpinan) + '</h6>' +
				'<h6>' + nullSafe(markerData.nama_geografi) + '</h6>' +
				'<table>' +
				'<tr> <td>Jumlah Tanam</td> <td>:</td> <td>' + nullSafe(markerData.jumlah) + '</td></tr>' +
				'<tr> <td>Tanggal Tanam</td> <td>:</td> <td>' + nullSafe(markerData.tgl_tanam) + '</td></tr>' +
				'<tr> <td>Keterangan</td> <td>:</td> <td>' + nullSafe(markerData.keterangan) + '</td></tr>' +
				'</table>' +
			'</div>'
		);
		myMap.infowindow.open(map, marker);
	}
}

var globalMyMap = {
	domId: 'map',
	markerListener: markerListener,
	markerFactory: null,
	recreateMarkerOnZoom: true,
	siteUrl: "<?= site_url() ?>",
	markerDatas: <?= $markers_json ?>,
	map: null,
	infowindow: null,
	myMarkers: [],
	zoom: 4
}

$(document).ready(function () {
	initMap(globalMyMap, globalMyMap.markerDatas);
});

</script>

