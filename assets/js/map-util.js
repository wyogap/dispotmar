function getMarkerIconAnchor(markerData, zoomLevel) {
	var iconDir = 'anchor4';
	var iconSize = 6;
	if (markerData.id_kotama == 4){
		iconDir = 'anchor1';
	} else if (markerData.id_kotama == 32) {
		iconDir = 'anchor2';
	} else if (markerData.id_kotama == 62) {
		iconDir = 'anchor3';
	} 

	if (markerData.level == 1){
		iconSize = 3;
	} else if (markerData.level == 2) {
		iconSize = 2;
	} else if (markerData.level == 3) {
		iconSize = 1;
	} 

	var increase = Math.floor(zoomLevel / 2);
	if ( increase > 8 ){
		increase = 8
	}

	iconSize += increase 
	iconFile = iconDir + '/anchor-' + iconSize + '.png';

	// console.log("increase ", increase);
	// console.log("zoomLevel ", zoomLevel);
	// console.log("iconFile ", iconFile);
	return iconFile;
}

function nullSafe(input) {
	if (input){
		return input;
	} else {
		return '';
	}
}

function clearMarkers(myMap) {
	myMap.myMarkers.forEach(function(item){return item.marker.setMap(null)})
}

function changeMarkerIcon(myMap) {
	recreateMarkers(myMap, myMap.myMarkers.map(function(item){return item.data}));
}

function recreateMarkers(myMap, newMarkerDatas) {
	// console.log("recreateMarkers map", myMap.map);
	// console.log("recreateMarkers newMarkerDatas", newMarkerDatas);
	clearMarkers(myMap);
	var myMarkers = []
	var marker, i;
	for (i = 0; i < newMarkerDatas.length; i++) { 
		var markerData =  newMarkerDatas[i];
		if ( !(markerData.latitude && markerData.longitude) ){
			continue;
		}
		pos = new google.maps.LatLng(markerData.latitude, markerData.longitude);

		var marker = null;
		if ( myMap.markerFactory ) {
			marker = myMap.markerFactory(myMap, markerData);
		} else {
			marker = new google.maps.Marker({
				position: pos,
				map: myMap.map,
				title: markerData.nama_satker,
				icon: myMap.siteUrl + 'assets/images/markers/' + getMarkerIconAnchor(markerData, myMap.map.getZoom())
			});	
		}

		myMarkers.push({
			data: markerData,
			marker: marker
		});
	
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
            var markerDataInt = markerData
            return myMap.markerListener(myMap, marker, markerDataInt);
		})(marker, i));
	}
	myMap.myMarkers = myMarkers;
}

function initMap(myMap, markerDatas) {
	var center = myMap.center ? myMap.center :{ lat: -2.548926, lng: 118.0148634 }
	var map = new google.maps.Map(document.getElementById(myMap.domId), {
		center: center,
		zoom: (myMap.zoom) ? myMap.zoom : 5
	});
	myMap.map = map;

	var infowindow = new google.maps.InfoWindow({maxWidth: 1000}); 
	myMap.infowindow = infowindow;

	if (myMap.recreateMarkerOnZoom) {
		google.maps.event.addListener(map, 'zoom_changed', function() {
			changeMarkerIcon(myMap);
		});	
	}
	
	recreateMarkers(myMap, markerDatas);
	return myMap;
}

function formatNumber(num) {
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}
