<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Sebaran Komponen Cadangan</h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12" style="">
			<div class="card overflow-hidden">
				<div class="card-body" style="">
					<form method="GET" id="search"  action="<?= site_url() ?>komcad/dashboard">
						<div class="row">
							
							<div class="col-md-4">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Kotama" name="kotama" id="kotama" multiple>
											<?php foreach($kotamas as $kotama): ?>
											<option
												<?= $this->input->get('kotama') == $kotama->id_satker ? 'selected' : '' ?>
												value="<?= $kotama->id_satker ?>"><?= $kotama->nama_satker  ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control"
											data-placeholder="Pilih Satker" name="satker" id="satker" multiple>
											<?php foreach($satkers as $satker): ?>
											<option
												<?= $this->input->get('satker') == $satker->id_satker ? 'selected' : '' ?>
												value="<?= $satker->id_satker ?>"><?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control" data-placeholder="Golongan Pangkat" 
											name="golongan_pangkat" id="golongan_pangkat" multiple>
											<option value="Perwira">Perwira</option>
											<option value="Bintara">Bintara</option>
											<option value="Tamtama">Tamtama</option>
										</select>
									</div>
								</div>
							</div>

                            <div class="col-md-1" style="display:none;" id="div_hapusfilter">
								<div class="form-group row">
									<div class="col-md-12">
										<button class="btn btn-warning btn-hapus-filter"><a style="color:white;" class="side-menu">Hapus Filter</a></button>
									</div>
								</div>
							</div>
                        </div>

					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Row End-->

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card overflow-hidden">
				<div class="card-body">
					<div id="map" style="width:100%;height:500px;"></div>
				</div>
			</div>
		</div>
	</div>

    <!-- <div class="row">
		<div class="col-md-6">
			<div class="card overflow-hidden">
				<div class="card-body">
					<div id="chart-pie-jurusan" style="width:100%;height:500px;"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card overflow-hidden">
				<div class="card-body">
					<div id="chart-bar-satker" style="width:100%;height:500px;"></div>
				</div>
			</div>
		</div>
	</div> -->

	<!-- Row End-->
</div>
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false"
	src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=mapLibReady"></script>

<script src="<?php echo base_url() ?>assets/js/mustache.min.js"></script>

<script id="mappopup" type="text/template">
    {{#profil}}
    <div id="content">
        <h5 id="firstHeading" class="firstHeading">{{nama}}</h5>
        <div id="siteNotice">{{pangkat}}</div>
        <h6>{{geo_path}}</h6>
        <h6>{{jenjang_pendidikan}} / {{jurusan}}</h6>
    </div>
    {{/profil}}
</script>

<script>
    var kotamas = <?= json_encode($kotamas, JSON_INVALID_UTF8_IGNORE); ?>;
    var satkers = <?= json_encode($satkers, JSON_INVALID_UTF8_IGNORE); ?>;
    var komcad = <?= json_encode($komcad, JSON_INVALID_UTF8_IGNORE); ?>;

    $(document).ready(function () {
        $("select").select2({ width: '100%' });
        // $("#satker").select2();
        // $("#klaster").select2();

        $("#kotama").change(function() {
            let vkotamas = $(this).val();
            if (vkotamas == null) {
                recreateMarkers(globalMyMap, globalMyMap.markerDatas);
            }
            else {
                //populate the satker select
                el = $("#satker");
                let vsatkers = el.val()
                el.empty();

                for (i=0; i<satkers.length; i++) {
                    let s = satkers[i];
                    if (!vkotamas.includes(s.id_kotama.toString())) {
                        continue;
                    }

                    let _option = $("<option>").val(s.id_satker).text(s.nama_satker);
                    if (s.id_level == 2) {
                        _option.addClass("select-option-level-1");
                    }
                    else if (s.id_level == 3) {
                        _option.addClass("select-option-level-2");
                    }

                    el.append(_option);
                }

                //reset the value
                el.val(vsatkers);
            }
        });

        $("#satker").change(function() {
            recreateMarkers(globalMyMap, globalMyMap.markerDatas);
        });

        $("#golongan_pangkat").change(function() {
            recreateMarkers(globalMyMap, globalMyMap.markerDatas);
        });

    })

    // Read a page's GET URL variables and return them as an associative array.
    function getUrlVars()
	{
   		var vars = [], hash;
   	 	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
   	 	for(var i = 0; i < hashes.length; i++)
  	  	{
  	      	hash = hashes[i].split('=');	
	        vars.push(hash[0]);
 	       	vars[hash[0]] = hash[1];
 	   	}
 	   	return vars;
	}

    function markerListener(myMap, marker, markerData){
        return function() {
            //parse moustache template
            let template = $("#mappopup").html();
            Mustache.parse(template);
            let rendered_template = Mustache.render(template, {
                profil: markerData
            });

            myMap.infowindow.setContent(rendered_template);
            myMap.infowindow.open(myMap.map, marker);
        }
    }

    var globalMyMap = {
        domId: 'map',
        markerListener: markerListener,
        markerFactory: null,
        recreateMarkerOnZoom: false,
        siteUrl: "<?= site_url() ?>/komcad/dashboard",
        markerDatas: komcad,
        map: null,
        infowindow: null,
        myMarkers: []
    }
 
    function mapLibReady(){
        initMap(globalMyMap, globalMyMap.markerDatas);
    }
</script>

<script>
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

        let cntEdukasi = cntEkonomi = cntKesehatan = cntPariwisata = cntPertahanan = 0;

        let vkotamas = $("#kotama").val();
        let vsatkers = $("#satker").val();
        let vpangkat = $("#golongan_pangkat").val();

        var myMarkers = []
        var marker, i;
        for (i = 0; i < newMarkerDatas.length; i++) { 
            var markerData =  newMarkerDatas[i];
            if ( !(markerData.latitude && markerData.longitude) ){
                continue;
            }

            //check if marker to be shown based on selection
            if ((vkotamas != null && vkotamas.length > 0) || (vsatkers != null && vsatkers > 0)) {
                if (vsatkers != null && vsatkers > 0) {
                    //check selected satkers
                    let flag = 0;
                    if (!vsatkers.includes(markerData.id_satker.toString())) {
                        flag = 1;
                    }
                    else if (!vsatkers.includes(markerData.id_lantamal.toString())) {
                        flag = 1;
                    }

                    //not visible
                    if (flag == 0) {
                        continue;
                    }
                }
                else {
                    //check selected kotama
                    let flag = 0;
                    if (!vkotamas.includes(markerData.id_kotama.toString())) {
                        flag = 1;
                    }

                    //not visible
                    if (flag == 0) {
                        continue;
                    }
                }
            }

            if (vpangkat != null && vpangkat.length>0) {
                let flag = 0;
                for(j=0; j<vpangkat.length; j++) {
                    let k = vpangkat[j];
                    if (markerData.golongan_pangkat == k) {
                        flag = 1;
                        break;
                    }
                }

                //not visible
                if (flag == 0) {
                    continue;
                }
            }

            pos = new google.maps.LatLng(markerData.latitude, markerData.longitude);

            var marker = null;
            if ( myMap.markerFactory ) {
                marker = myMap.markerFactory(myMap, markerData);
            } else {
                marker = new google.maps.Marker({
                    position: pos,
                    map: myMap.map,
                    title: markerData.nama,
                    //icon: myMap.siteUrl + 'assets/images/markers/' + getMarkerIconAnchor(markerData, myMap.map.getZoom())
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

        if ((vkotamas != null && vkotamas.length > 0) || (vsatkers != null && vsatkers > 0) || (vpangkat != null && vpangkat > 0)) {
            $("#div_hapusfilter").show();
        }
        else {
            $("#div_hapusfilter").hide();
        }
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


</script>
