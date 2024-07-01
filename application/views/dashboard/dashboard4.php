<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Personel dan Lahan Tidur</h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12" style="height: 120px">
			<div class="card overflow-hidden">
				<div class="card-body" style="height: 100px">
					<form method="GET" id="search"  action="<?= site_url() ?>dashboard4">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Kotama" name="kotama" id="kotama">
											<option value="">-- Pilih Kotama --</option>
											<?php foreach($kotamas as $kotama): ?>
											<option
												<?= $this->input->get('kotama') == $kotama->id_satker ? 'selected' : '' ?>
												value="<?= $kotama->id_satker ?>"><?= $kotama->nama_satker  ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Satker" name="satker" id="satker">
											<option value="">-- Pilih Satker --</option>
											<?php foreach($satkers as $satker): ?>
											<option
												<?= $this->input->get('satker') == $satker->id_satker ? 'selected' : '' ?>
												value="<?= $satker->id_satker ?>"><?= $satker->nama_satker ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-0">
								<div class="form-group row">
									<div class="col-md-12">
										<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-1" style="display:none;" id="div_hapusfilter">
								<div class="form-group row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-warning"><a style="color:white;" href="<?= site_url()?>dashboard4" class="side-menu">Hapus Filter</a></button>
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
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-3">
					<div class="card bg-secondary">
						<div class="card-body text-center p-1">
							<p class="mb-1" >Total Lahan</p>
							<h2 class="mb-1"> 
								<?= number_format(($summaryLahanTidur->sum_luas_total) ? $summaryLahanTidur->sum_luas_total : 0,2,".",".")  ?>
							</h2>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-secondary">
						<div class="card-body text-center p-1">
							<p class="mb-1">Digarap</p>
							<h2 class="mb-1"> 
								<?= number_format(($summaryLahanTidur->sum_digarap) ? $summaryLahanTidur->sum_digarap : 0,2,".",".")  ?>
							</h2>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-secondary">
						<div class="card-body text-center p-1">
							<p class="mb-1">Lahan Tidur</p>
							<h2 class="mb-1"> 
								<?= number_format(($summaryLahanTidur->sum_lahan_tidur) ? $summaryLahanTidur->sum_lahan_tidur : 0,2,".",".")  ?>
							</h2>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-info">
						<div class="card-body text-center p-1">
							<p class="mb-1">Satker</p>
							<h2 class="mb-1">
								<?= def_number_format($summaryPersonel->count_satker, 0) ?>
							</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-3">
					<div class="card bg-info">
						<div class="card-body text-center p-1">
							<p class="mb-1">Personel</p>
							<h2 class="mb-1"><?= def_number_format($summaryPersonel->sum_jumlah_personel, 0) ?></h2>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-success">
						<div class="card-body text-center p-1">
							<p class="mb-1">Perwira</p>
							<h2 class="mb-1"><?= def_number_format($summaryPersonel->sum_perwira, 0) ?></h2>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-success">
						<div class="card-body text-center p-1">
							<p class="mb-1">Bintara</p>
							<h2 class="mb-1"><?= def_number_format($summaryPersonel->sum_bintara, 0) ?></h2>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-success">
						<div class="card-body text-center p-1">
							<p class="mb-1">Tamtama</p>
							<h2 class="mb-1"><?= def_number_format($summaryPersonel->sum_tamtama, 0) ?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Row End-->

	<!-- row opened -->
	<div class="row">
		<div class="col-md-4">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Personel By Kotama</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" id="personelByKotama-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
						<label id="flag-personelByKotama" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<!-- <div id="personelByKotama" class="chartsh"></div> -->
					<canvas id="personelByKotama" style="height:320px;"></canvas>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Personel By Strata</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" id="personelByStrata-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
						<label id="flag-personelByStrata" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<!-- <div id="personelByStrata" class="chartsh"></div> -->
					<canvas id="personelByStrata" style="height:320px;"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Personel By Satker</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
							class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" id="personelBySatker-fullscreen" data-toggle="card-fullscreen"><i
							class="fe fe-maximize"></i></a>
						<label id="flag-personelBySatker" style="display:none;">a</label>
					</div>
				</div>
				<div class="personel-barchart" style="height:368px;" id="personelBySatker_dev">
					<div class="card-body">
						<canvas id="personelBySatker" class="chartjs-render-monitor chart-dropshadow2"></canvas>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- row closed -->
	<br/>
	<!-- row opened -->
	<div class="row">
		<div class="col-md-6">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Sebaran Lahan Tidur</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div id="lahanMap" style="width:100%;height:380px;"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card mb-0">
				<div class="card-header">
					<h5 class="card-title">Sebaran Personel</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div id="personelMap" style="width:100%;height:380px;"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>

<script async="false" src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=mapLibReady"></script>
<script src="<?php echo base_url() ?>assets/js/map-util.js"></script>

<script>
function lahanTidurMarkerListener(myMap, marker, markerData){
	return function() {
		myMap.infowindow.setContent(
			'<div id="content">'+
			'<div id="siteNotice">Lahan Tidur</div>'+
			'<div id="bodyContent">'+
			'<p style="font-size: 12px;font-weight: bold;">'+markerData.lokasi+'</p>'+
			'<p style="font-size: 12px;">Luas : <span style="color: red;font-weight: bold;">'+markerData.lahan_tidur+' Ha</span></p><br>'+
			'</div>'+
			'</div>'
		);
		myMap.infowindow.open(myMap.map, marker);
	}
}

function lahanTidurMarkerFactory(myMap, markerData){
	return new google.maps.Marker({
				position: pos,
				map: myMap.map,
				title: markerData.nama_satker,
				icon: myMap.siteUrl + 'assets/images/markers/grass.png'
			});	

}

var lahanTidurMyMap = {
	domId: 'lahanMap',
	markerListener: lahanTidurMarkerListener,
	markerFactory: lahanTidurMarkerFactory,
	recreateMarkerOnZoom: true,
	siteUrl: "<?= site_url() ?>",
	markerDatas: <?= $lahanTidurMarkersJson ?>,
	map: null,
	infowindow: null,
	myMarkers: [],
	zoom: 4
}

function personelMarkerListener(myMap, marker, markerData){
	return function() {
		myMap.infowindow.setContent(
				'<div id="content">'+
				'<div id="bodyContent">'+
				'<div id="siteNotice">Satker</div>' +
				'<a target="_blank" style="color: #0000ff;" href="' + myMap.siteUrl + 'organisasi_satker/' + markerData.id_satker_encrypted + '/show"><h5 id="firstHeading" class="firstHeading">'+markerData.nama_satker+'</h5></a>' +
				'<h6>' + nullSafe(markerData.nama_pimpinan) + '</h6>' +
				'<h6>' + nullSafe(markerData.geo_path) + '</h6>' +
				'<center><table>' + 
				'<tr><td>Personel</td><td> : </td><td><span style="color: red;font-weight: bold;">' + markerData.sum_jumlah_personel + ' Orang</span></td></tr>' + 
				'<tr><td>Perwira</td><td> : </td><td><span style="color: red;font-weight: bold;">' + markerData.sum_perwira + ' Orang</span></td></tr>' + 
				'<tr><td>Bintara</td><td> : </td><td><span style="color: red;font-weight: bold;">' + markerData.sum_bintara + ' Orang</span></td></tr>' + 
				'<tr><td>Tamtama</td><td> : </td><td><span style="color: red;font-weight: bold;">' + markerData.sum_tamtama + ' Orang</span></td></tr>' + 
				'</table></center>' + 
				'</div>'+
				'</div>'
			);
		myMap.infowindow.open(myMap.map, marker);
	}
}

function personelMarkerFactory(myMap, markerData){
	return new google.maps.Marker({
				position: pos,
				map: myMap.map,
				title: markerData.nama_satker,
				icon: myMap.siteUrl + 'assets/images/markers/grass.png'
			});	

}

var personelMyMap = {
	domId: 'personelMap',
	markerListener: personelMarkerListener,
	markerFactory: null,
	recreateMarkerOnZoom: true,
	siteUrl: "<?= site_url() ?>",
	markerDatas: <?= $personelMarkersJson ?>,
	map: null,
	infowindow: null,
	myMarkers: [],
	zoom: 4
}

function mapLibReady(){
	initMap(lahanTidurMyMap, lahanTidurMyMap.markerDatas);
	initMap(personelMyMap, personelMyMap.markerDatas);
}

</script>

<script>

	$(function (e) {
		
		$("#kotama").select2();
		$("#satker").select2();

		var valkotama = getUrlVars()["kotama"];
		var valsatker = getUrlVars()["satker"];

		if(valkotama != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(valsatker != undefined)
		{
			$('#div_hapusfilter').css("display", "block");
		}
		
		'use strict'
		$("#kotama").change(function() {
			$("#search").submit();
		});

		var dynamicColors = function () {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}

		$("#personelByKotama-fullscreen").click(function() {

			if($("#flag-personelByKotama").text() == "a")
			{
				$("#flag-personelByKotama").text("b");
			}
			else
			{
				$("#flag-personelByKotama").text("a");
				$("#personelByKotama").height('320px');
			}
		});

		$("#personelByStrata-fullscreen").click(function() {

			if($("#flag-personelByStrata").text() == "a")
			{
				$("#flag-personelByStrata").text("b");
			}
			else
			{
				$("#flag-personelByStrata").text("a");
				$("#personelByStrata").height('320px');
			}
		});

		$("#personelBySatker-fullscreen").click(function() {

			if($("#flag-personelBySatker").text() == "a")
			{
				$("#flag-personelBySatker").text("b");
				$("#personelBySatker_dev").height('auto');
			}
			else
			{
				$("#flag-personelBySatker").text("a");
				$("#personelBySatker_dev").height('368');
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>dashboard4/getPersonelByStrata?kotama=<?= $this->input->get('kotama') ?>&satker=<?= $this->input->get('satker') ?>",
			dataType: "json",
			success: function (response) {
				// if (response.total[0] == null) {
				// 	$("#personelByStrata").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				// }else{
				// 	var chartData = [];
				// 	$.each(response.labels, function (index, value) {
				// 		chartData[index] = [value, parseInt(response.total[index])];
				// 	})

				// 	c3.generate({
				// 		bindto: '#personelByStrata', // id of chart wrapper
				// 		data: {
				// 			columns: chartData,
				// 			type: 'pie', // default type of chart
				// 		},
				// 		axis: {},
				// 		legend: {
				// 			show: false, //hide legend
				// 		},
				// 		padding: {
				// 			bottom: 0,
				// 			top: 0
				// 		},
				// 	});
				// }

				const canvas = document.getElementById("personelByStrata");
				var ConvertResponseTotal = response.total.map(i=>Number(i));
				//var SortConvertResponseTotal = ConvertResponseTotal.sort(function(a, b){return a - b});
				
				if (response.labels.length == 0) {
					$("#personelByStrata").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					let myChart = new Chart(canvas, {
						type: 'pie',
						data: {
							datasets: [{
								backgroundColor: bacgrounds,
								data: ConvertResponseTotal, //response.total,
							}],
							labels: response.labels,
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: {
								display: false,
								labels: {
									usePointStyle: true,
								},
							},
							title: {
								display: false,
								text: 'Normal Legend'
							},
							tooltips: {
  								callbacks: {
    							label: function(tooltipItem, data) {
	  								//caption	                       
	  								var idx = tooltipItem['index'];           
	  								var caption = data.labels[idx];  
      								//get the concerned dataset
      								var dataset = data.datasets[tooltipItem.datasetIndex];
      								//calculate the total of this data set
      								var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
        								return previousValue + currentValue;
      								});
      								//get the current items value
      								var currentValue = dataset.data[tooltipItem.index];
      								//calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
      								var percentage = (currentValue * 100 / total).toFixed(2); //Math.floor(((currentValue/total) * 100)+0.5);

      								return ' ' + caption + ' : ' + percentage + '%';
   									}
  								}
							},
							plugins: {
      							datalabels: {
									display: true,
									anchor: 'end',
        							align: 'start',
        							offset: 10,
									formatter: (value, ctx) => {
										let sum = 0;
										let dataArr = ctx.chart.data.datasets[0].data;
										dataArr.map(data => {
											sum += data;
										});
										let percentage = (value * 100 / sum).toFixed(2)+"%";
										return percentage;
									},
									color: '#fff',
									font: {
          								size: '14'
       								},
								}
							}
						},
					});
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>dashboard4/getPersonelByKotama",
			dataType: "json",
			success: function (response) {
				// if (response.labels.length == 0) {
				// 	$("#personelByKotama").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				// }else{
				// 	var chartData = [];
				// 	$.each(response.labels, function (index, value) {
				// 		chartData[index] = [value, parseInt(response.total[index])];
				// 	})

				// 	c3.generate({
				// 		bindto: '#personelByKotama', // id of chart wrapper
				// 		data: {
				// 			columns: chartData,
				// 			type: 'pie', // default type of chart
				// 		},
				// 		tooltip: {
				// 			format: {
				// 				value: function (value, ratio, id) {
				// 					return value+' ('+(ratio*100)+'%)';
				// 				} 
				// 			}
				// 		},
				// 		axis: {},
				// 		legend: {
				// 			show: false, //hide legend
				// 		},
				// 		padding: {
				// 			bottom: 0,
				// 			top: 0
				// 		},
				// 	});
				// }

				const canvas = document.getElementById("personelByKotama");
				var ConvertResponseTotal = response.total.map(i=>Number(i));
				//var SortConvertResponseTotal = ConvertResponseTotal.sort(function(a, b){return a - b});
				
				if (response.labels.length == 0) {
					$("#personelByKotama").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					let myChart = new Chart(canvas, {
						type: 'pie',
						data: {
							datasets: [{
								backgroundColor: bacgrounds,
								data: ConvertResponseTotal, //response.total,
							}],
							labels: response.labels,
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: {
								display: false,
								labels: {
									usePointStyle: true,
								},
							},
							title: {
								display: false,
								text: 'Normal Legend'
							},
							tooltips: {
  								callbacks: {
    							label: function(tooltipItem, data) {
	  								//caption	                       
	  								var idx = tooltipItem['index'];           
	  								var caption = data.labels[idx];  
      								//get the concerned dataset
      								var dataset = data.datasets[tooltipItem.datasetIndex];
      								//calculate the total of this data set
      								var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
        								return previousValue + currentValue;
      								});
      								//get the current items value
      								var currentValue = dataset.data[tooltipItem.index];
      								//calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
      								var percentage = (currentValue * 100 / total).toFixed(2); //Math.floor(((currentValue/total) * 100)+0.5);

      								return ' ' + caption + ' : ' + percentage + '%';
   									}
  								}
							},
							plugins: {
      							datalabels: {
									display: true,
									anchor: 'end',
        							align: 'start',
        							offset: 10,
									formatter: (value, ctx) => {
										let sum = 0;
										let dataArr = ctx.chart.data.datasets[0].data;
										dataArr.map(data => {
											sum += data;
										});
										let percentage = (value * 100 / sum).toFixed(2)+"%";
										return percentage;
									},
									color: '#fff',
									font: {
          								size: '14'
       								},
								}
							}
						},
					});
				}
			}
		});
		
		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>dashboard4/getPersonelBySatker?kotama=<?= $this->input->get('kotama') ?>&satker=<?= $this->input->get('satker') ?>",
			dataType: "json",
			success: function (response) {
				// console.log("response", response)
				const canvas = document.getElementById("personelBySatker");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.5rem 'Roboto', sans-serif";
					ctx.fillStyle = '#8492a6';
					ctx.fillText("Data Tidak Ditemukan",10,50);
				}else{
					var bacgrounds = [];
					$.each(response.labels, function (index, value) {
						bacgrounds.push(dynamicColors())
					});

					canvas.setAttribute('height', (response.labels.length*50) + 50)

					new Chart(canvas, {
						type: 'horizontalBar',
						data: {
							labels: response.labels,
							datasets: [{
								label: "Total Estimasi",
								backgroundColor: bacgrounds,
								data: response.total,
							}]
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							tooltips: {
								mode: 'index',
								titleFontSize: 12,
								titleFontColor: '#000',
								bodyFontColor: '#000',
								backgroundColor: '#fff',
								cornerRadius: 3,
								intersect: false,
								position: 'average',
            					yAlign: 'top',
            					xAlign: 'right',
							},
							legend: {
								display: false,
								labels: {
									usePointStyle: true,
								},
							},
							scales: {
								xAxes: [{
									barPercentage: 0.2,
									barSpacing: 3,
									ticks: {
										fontColor: "#8e9cad",
										beginAtZero: true
									},
									display: true,
									gridLines: {
										display: true,
										color: 'rgb(142, 156, 173,0.1)',
										drawBorder: false
									},
									scaleLabel: {
										display: false,
										labelString: 'Month',
										fontColor: '#8492a6 '
									}
								}],
								yAxes: [{
									barPercentage: 1,
									barSpacing: 2,
									ticks: {
										fontColor: "#8e9cad",
									},
									display: true,
									gridLines: {
										display: true,
										color: 'rgb(142, 156, 173,0.1)',
										drawBorder: false
									},
									scaleLabel: {
										display: false,
										labelString: 'sales',
										fontColor: '#8492a6 '
									}
								}]
							},
							"hover": {
              					"animationDuration": 1
            				},
							"animation": {
                			"duration": 1,
              				"onComplete": function() {
                				var chartInstance = this.chart,
                 				ctx = chartInstance.ctx;
 
                				ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
               					ctx.textAlign = 'bottom';
                				ctx.textBaseline = 'top';
 
                				this.data.datasets.forEach(function(dataset, i) {
                  				var meta = chartInstance.controller.getDatasetMeta(i);
                  				meta.data.forEach(function(bar, index) {
                    			var data = dataset.data[index];
                    			ctx.fillText(data, bar._model.x + 5, bar._model.y - 5);
                  				});
               					});
              				}
           	 				},
							title: {
								display: false,
								text: 'Normal Legend'
							},
							plugins: {
      							datalabels: {
									display: false,
								}
							},
							onClick: (e, chartEvents) => {
							}
						}
					});
				}
			}
		});

	});

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
</script>
