<div class="section" id="app">
	<!-- Page-header opened -->
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Gelar Pangkalan</h4>
		</div>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12" style="height: 170px">
			<div class="card overflow-hidden">
				<div class="card-body m-0 p-3" style="height: 160px">
					<div class="row">
						<div class="col-xl-4" style="height: 170px">
							<h6>
								<input type="checkbox" 
									v-model="kotamaSelect"
									v-on:change="changeKotamaSelect"
									:disabled="kotamas.length == 0"
								> 
								Kotama : 
							</h6>
							<div style="height:110px; overflow-y: scroll;">
								<span v-for="kotama in kotamas" :key="kotama.id_satker">
									<input type="checkbox" 
										v-model="kotama.selected"
										v-on:change="changeSatker"
										>
									{{ kotama.nama_satker }} 									<br/>
								</span>
							</div>
						</div>
						<div class="col-xl-4" style="height: 170px">
							<h6>
								<input type="checkbox" 
									v-model="lantamalSelect"
									v-on:change="changeLantamalSelect"
									:disabled="lantamals.length == 0"
								> 
								Lantamal : 
							</h6>
							<div style="height:110px; overflow-y: scroll;">
								<span v-for="lantamal in lantamals" :key="lantamal.id_satker">
									<input type="checkbox" 
										v-model="lantamal.selected"
										v-on:change="changeSatker"
										>
									{{ lantamal.nama_satker }} 									<br/>
								</span>
							</div>
						</div>
						<div class="col-xl-4" style="height: 170px">
							<h6>
								<input type="checkbox" 
									v-model="lanalSelect"
									v-on:change="changeLanalSelect"
									:disabled="lanals.length == 0"
								> 
								Lanal : 
							</h6>
							<div style="height:110px; overflow-y: scroll;">
								<span v-for="lanal in lanals" :key="lanal.id_satker">
									<input type="checkbox" 
										v-model="lanal.selected"
										v-on:change="changeSatker"
										>
									{{ lanal.nama_satker }} 
									<br/>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="card-body">
			<div id="map" style="width:100%;height:500px;"></div>
		</div>
	</div>

	<!-- row closed -->
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false"
	src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=mapLibReady"></script>
<script src="<?php echo base_url() ?>assets/js/vue.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/map-util.js"></script>

<script>
function markerListener(myMap, marker, markerData){
	return function() {
		myMap.infowindow.setContent(
			'<div id="content">' +
				'<div id="siteNotice">Satker</div>' +
				'<a target="_blank" style="color: #0000FF;" href="'+myMap.siteUrl+'organisasi_satker/'+ markerData.id_satker_encrypted +'/show"><h5 id="firstHeading" class="firstHeading">'+markerData.nama_satker+'</h5></a>' +
				'<h6>' + nullSafe(markerData.nama_pimpinan) + '</h6>' +
				'<h6>' + nullSafe(markerData.geo_path) + '</h6>' +
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
	markerDatas: <?= $satkers_json ?>,
	map: null,
	infowindow: null,
	myMarkers: []
}
</script>

<script>

function mapLibReady(){
	initVue(globalMyMap);
}

function initVue(myMap){
	var myMap = myMap;
	var app = new Vue({
		el: '#app',
		data: {
			markerDatas: myMap.markerDatas.map(function(item){
				item.selected = true
				return item
			}),
			kotamas: [],
			lantamals: [],
			lanals: []
		},
		mounted() {
			var initMapResult = initMap(myMap, []);
			myMap.map = initMapResult.map;
			myMap.infowindow = initMapResult.infowindow;
			myMap.myMarkers = initMapResult.myMarkers;
			this.changeSatker();
		},
		computed: {
			kotamaSelect: function () {
				return this.kotamas
					.filter(function(item){
						return item.selected;
					})
					.length > 0;
    		},
			lantamalSelect: function () {
				return this.lantamals
					.filter(function(item){
						return item.selected;
					})
					.length > 0;
    		},
			lanalSelect: function () {
				return this.lanals
					.filter(function(item){
						return item.selected;
					})
					.length > 0;
    		}
		},
		methods: {
			recreateMarkers: function () {
				recreateMarkers(
					myMap,
					this.markerDatas.filter(function(item){return  item.selected})
				);
			},
			changeKotamaSelect: function () {
				var isSelect = !this.kotamaSelect;
				this.kotamas
					.forEach(element => {
						element.selected = isSelect;
					});
				this.changeSatker();
			},
			changeLantamalSelect: function () {
				var isSelect = !this.lantamalSelect;
				this.lantamals
					.forEach(element => {
						element.selected = isSelect;
					});
				this.changeSatker();
			},
			changeLanalSelect: function () {
				var isSelect = !this.lanalSelect;
				this.lanals
					.forEach(element => {
						element.selected = isSelect;
					});
				this.changeSatker();
			},
			changeSatker: function () {
				this.kotamas = this.markerDatas
					.filter(function(item){
						return item.level == 1;
					});
				var selectedIdKotamas = this.kotamas
					.filter(function(item){return item.selected})
					.map(function(item){return item.id_satker});

				this.lantamals = this.markerDatas
					.filter(function(item){
						if ( item.level == 2 ){
							if (selectedIdKotamas.includes(item.id_kotama)){
								return true;
							} else {
								item.selected = false;
								return false;
							}
						} else {
							return false;
						}
					});
				
				var selectedIdLantamals = this.lantamals
					.filter(function(item){return item.selected})
					.map(function(item){return item.id_satker})

				this.lanals = this.markerDatas
					.filter(function(item){
						if ( item.level == 3 ){
								if (selectedIdLantamals.includes(item.id_lantamal)){
									return true;
								} else {
									item.selected = false;
									return false;
								}
							} else {
								return false;
							}
					})

				this.recreateMarkers();
			},
		},
	});
	
}

</script>
