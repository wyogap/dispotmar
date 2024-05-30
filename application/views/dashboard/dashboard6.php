<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
		<h4 class="page-title mb-0"><?php echo $title ?></h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12" style="height: 120px">
			<div class="card overflow-hidden">
				<div class="card-body" style="height: 100px">
					<form method="GET" id="search" action="<?= site_url() ?>dashboard6">
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
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Jenis Data" name="jenisdata" id="jenisdata">
											<optgroup label="Geografi">
												<option value="<?= encrypt('geo_pantai') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_pantai')) ? 'selected' : '' ?>>Pantai</option>
												<option value="<?= encrypt('geo_hutan') ?>" <?= ($this->input->get('jenisdata') ==  strval(encrypt('geo_hutan'))) ? 'selected' : '' ?>>Hutan</option>
												<option value="<?= encrypt('geo_gunung') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_gunung')) ? 'selected' : '' ?>>Gunung</option>
												<option value="<?= encrypt('geo_kerawanan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_kerawanan')) ? 'selected' : '' ?>>Kerawanan Geografi</option>
												<option value="<?= encrypt('geo_curah_hujan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_curah_hujan')) ? 'selected' : '' ?>>Curah Hujan</option>
												<option value="<?= encrypt('geo_struktur_tanah') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_struktur_tanah')) ? 'selected' : '' ?>>Struktur Tanah</option>
												<option value="<?= encrypt('geo_sumber_air') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_sumber_air')) ? 'selected' : '' ?>>Sumber Air</option>
												<option value="<?= encrypt('geo_sungai') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_sungai')) ? 'selected' : '' ?>>Sungai</option>
												<option value="<?= encrypt('geo_pulau_terluar') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_pulau_terluar')) ? 'selected' : '' ?>>Pulau Terluar</option>
												<option value="<?= encrypt('geo_perkebunan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_perkebunan')) ? 'selected' : '' ?>>Perkebunan</option>
												<option value="<?= encrypt('geo_pertanian') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_pertanian')) ? 'selected' : '' ?>>Pertanian</option>
												<option value="<?= encrypt('geo_peternakan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_peternakan')) ? 'selected' : '' ?>>Peternakan</option>
												<option value="<?= encrypt('geo_pertambangan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_pertambangan')) ? 'selected' : '' ?>>Pertambangan</option>
												<option value="<?= encrypt('geo_budidaya_ikan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_budidaya_ikan')) ? 'selected' : '' ?>>Pembudidayaan Ikan</option>
												<option value="<?= encrypt('geo_keramba_jaring') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_keramba_jaring')) ? 'selected' : '' ?>>Keramba Jaring Apung</option>
												<option value="<?= encrypt('geo_konservasi_lingkungan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_konservasi_lingkungan')) ? 'selected' : '' ?>>Konservasi Lingkungan Hidup</option>
												<option value="<?= encrypt('geo_listrik') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_listrik')) ? 'selected' : '' ?>>Sumber Listrik</option>
												<option value="<?= encrypt('geo_pelabuhan_sungai') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_pelabuhan_sungai')) ? 'selected' : '' ?>>Pelabuhan Sungai</option>
												<option value="<?= encrypt('geo_pelabuhan_laut') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_pelabuhan_laut')) ? 'selected' : '' ?>>Pelabuhan Laut</option>
												<option value="<?= encrypt('geo_pelabuhan_perikanan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_pelabuhan_perikanan')) ? 'selected' : '' ?>>Pelabuhan Ikan</option>
												<option value="<?= encrypt('geo_sarpras_jalan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_sarpras_jalan')) ? 'selected' : '' ?>>Sarana Prasarana Jalan</option>
												<option value="<?= encrypt('geo_galangan_kapal') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_galangan_kapal')) ? 'selected' : '' ?>>Galangan Kapal</option>
												<option value="<?= encrypt('geo_industri_mesin') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_industri_mesin')) ? 'selected' : '' ?>>Industri Mesin</option>
												<option value="<?= encrypt('geo_pelayaran_rakyat') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_pelayaran_rakyat')) ? 'selected' : '' ?>>Angkatan Laut Nasional</option>
												<option value="<?= encrypt('geo_ship_handler') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_ship_handler')) ? 'selected' : '' ?>>Ship Handler</option>
												<option value="<?= encrypt('geo_industri_perikanan') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('geo_industri_perikanan')) ? 'selected' : '' ?>>Industri Perikanan</option>
											</optgroup>
											<optgroup label="Demografi">
												<option value="<?= encrypt('demo_jumlah_penduduk') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('demo_jumlah_penduduk')) ? 'selected' : '' ?>>Jumlah Penduduk</option>
												<option value="<?= encrypt('demo_agama') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('demo_agama')) ? 'selected' : '' ?>>Agama</option>
												<option value="<?= encrypt('demo_suku_bangsa') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('demo_suku_bangsa')) ? 'selected' : '' ?>>Suku Bangsa</option>
												<option value="<?= encrypt('demo_desa_pesisir') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('demo_desa_pesisir')) ? 'selected' : '' ?>>Desa Pesisir</option>
												<option value="<?= encrypt('demo_saka_bahari') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('demo_saka_bahari')) ? 'selected' : '' ?>>Saka Bahari</option>
												<option value="<?= encrypt('demo_pekerjaan_masyarakat') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('demo_pekerjaan_masyarakat')) ? 'selected' : '' ?>>Pekerjaan Masyarakat</option>
												<option value="<?= encrypt('demo_sekolah_maritim') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('demo_sekolah_maritim')) ? 'selected' : '' ?>>Sekolah Maritim</option>
												<option value="<?= encrypt('demo_rumahsakit') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('demo_rumahsakit')) ? 'selected' : '' ?>>Rumah Saki</option>
											</optgroup>
											<optgroup label="Kondisi Sosial">
												<option value="<?= encrypt('konsos_tokoh_masyarakat') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_tokoh_masyarakat')) ? 'selected' : '' ?>>Tokoh Masyarakat</option>
												<option value="<?= encrypt('konsos_organisasi_agama') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_organisasi_agama')) ? 'selected' : '' ?>>Organisasi Agama</option>
												<option value="<?= encrypt('konsos_partai_politik') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_partai_politik')) ? 'selected' : '' ?>>Partai Politik</option>
												<option value="<?= encrypt('konsos_umkm') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_umkm')) ? 'selected' : '' ?>>Industri UMKM</option>
												<option value="<?= encrypt('konsos_industri_menengah') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_industri_menengah')) ? 'selected' : '' ?>>Industri Menengah</option>
												<option value="<?= encrypt('konsos_objek_pariwisata') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_objek_pariwisata')) ? 'selected' : '' ?>>Objek Pariwisata</option>
												<option value="<?= encrypt('konsos_peninggalan_sejarah') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_peninggalan_sejarah')) ? 'selected' : '' ?>>Peninggalan Sejarah</option>
												<option value="<?= encrypt('konsos_budaya') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_budaya')) ? 'selected' : '' ?>>Budaya</option>
												<option value="<?= encrypt('konsos_instansi_militer') ?>" <?= ($this->input->get('jenisdata') ==  encrypt('konsos_instansi_militer')) ? 'selected' : '' ?>>Instansi Militer dan Polisi</option>											
											</optgroup>
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
										<button type="submit" class="btn btn-warning"><a style="color:white;" href="<?= site_url()?>dashboard6" class="side-menu">Hapus Filter</a></button>
									</div>
								</div>
							</div>
							<!-- <div class="col-md-2">
								<div class="form-group row" style="margin-top: -20px">
									<div class="card bg-secondary" >
										<div class="card-body text-center">
											<p class="mb-1">Total [ex:pantai]</p>
											<h2 class="mb-1">22</h2>
										</div>
									</div>
								</div>
							</div> -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Row End-->

	<div class="row">
		<div class="col-md-4">
			<div class="card bg-secondary">
				<div class="card-body text-center p-2">
					<p class="mb-1">Lahan Tidur (HA)</p>
					<h2 class="mb-1">
						<?= number_format(($summaryLahanTidur->sum_lahan_tidur) ? $summaryLahanTidur->sum_lahan_tidur : 0,2,".",".")  ?>
					</h2>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bg-secondary">
				<div class="card-body text-center p-2">
					<p class="mb-1">Satker </p>
					<h2 class="mb-1" id="jumlahSatker">  </h2>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bg-secondary">
				<div class="card-body text-center p-2">
					<p class="mb-1">Jumlah <?= $jenisdata ?></p>
					<h2 class="mb-1" id="jumlahObject"> </h2>
				</div>
			</div>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">Jumlah By Kotama</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" id="chart-kotama-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<label id="flag-chart-kotama" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<!-- <div id="chart-kotama" class="chartsh"></div> -->
					<canvas id="chart-kotama" style="height:320px;"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">Jumlah By Lantamal</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
				<canvas id="bar-chart-horizontal"
							class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-4">
			<div class="card mb-0" style="overflow:auto;">
				<div class="card-header">
					<h5 class="card-title">Jumlah By Satker</h5>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
				<canvas id="bar-chart-horizontal2"
							class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->

</div>

<div class="modal" id="detailModal">
  <div class="modal-dialog modal-geodemokonsos" role="document">
    <div class="modal-content" id="detailModal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script>
	var jumlahObject = 0;
	var jumlahSatker = 0;
	function updateJumlahObject(level, chartResponse){
		$.each(chartResponse.labels, function (index, value) {
			if ( level == 2 ){
				jumlahObject += parseInt(chartResponse.total[index]);
			}
			jumlahSatker++
		});

		$( "#jumlahSatker" ).text(jumlahSatker);
		$( "#jumlahObject" ).text(jumlahObject);
	}
	$(document).ready(function () {
		$("#kotama").select2();
		$("#satker").select2();
		$("#jenisdata").select2();

		var valkotama = getUrlVars()["kotama"];
		var valsatker = getUrlVars()["satker"];
		if(valkotama != '')
		{
			$('#div_hapusfilter').css("display", "block");
		}
		if(valsatker != '')
		{
			$('#div_hapusfilter').css("display", "block");
		}

		$("#kotama").change(function() {
			$("#search").submit();
		});
		$("#lantamal").change(function() {
			$("#search").submit();
		});

		$("#chart-kotama-fullscreen").click(function() {

			if($("#flag-chart-kotama").text() == "a")
			{
				$("#flag-chart-kotama").text("b");
			}
			else
			{
				$("#flag-chart-kotama").text("a");
				$("#chart-kotama").height('320px');
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

	function showDetailData(id_satker) {
		var detailUrl = "<?= site_url() ?>dashboard6DetailController?id_satker=" + id_satker + "&jenisdata=<?= $this->input->get('jenisdata') ?>";
		//console.log("detailUrl", detailUrl)
		$.ajax({
			type: "GET",
			url: detailUrl,
			dataType: "html",
			success: function (response) {
				// console.log("response", response);
				$("#detailModal-content") .html(response);
				$("#detailModal").modal()
			}
		});
	}

	$(function (e) {
		'use strict'
		//$('#satker').select2();
		//$('#jenisdata').select2();

		var dynamicColors = function () {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getGeodemokonsosChart/1?kotama=&satker=&jenisdata=<?= $this->input->get('jenisdata') ?>",
			dataType: "json",
			success: function (response) {
				// if (response.labels.length == 0) {
				// 	$("#chart-kotama").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
				// } else {
				// 	var chartData = [];
				// 	$.each(response.labels, function (index, value) {
				// 		chartData[index] = [value, parseInt(response.total[index])];
				// 	})

				// 	c3.generate({
				// 		bindto: '#chart-kotama', // id of chart wrapper
				// 		data: {
				// 			columns: chartData,
				// 			type: 'pie', // default type of chart
				// 			onclick: function (d, element) { 
				// 				var index = d.index
				// 				var id_satker = response.id_satkers[index];
				// 				showDetailData(id_satker)
				// 			}
				// 		},
				// 		axis: {},
				// 		legend: {
				// 			show: false, //hide legend
				// 		},
				// 		padding: {
				// 			bottom: 0,
				// 			top: 0
				// 		}
				// 	});
				// }

				const canvas = document.getElementById("chart-kotama");
				var ConvertResponseTotal = response.total.map(i=>Number(i));
				//var SortConvertResponseTotal = ConvertResponseTotal.sort(function(a, b){return a - b});
				
				if (response.labels.length == 0) {
					$("#chart-kotama").html("<h3 class='text-muted'>Data Tidak Ditemukan</h3>")
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
			url: "<?= site_url() ?>/api/getGeodemokonsosChart/2?kotama=<?= $this->input->get('kotama') ?>&satker=<?= $this->input->get('satker') ?>&jenisdata=<?= $this->input->get('jenisdata') ?>",
			dataType: "json",
			success: function (response) {
				//console.log("response", response)
				updateJumlahObject(2, response);
				const canvas = document.getElementById("bar-chart-horizontal");

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
								if (chartEvents && chartEvents.length > 0) {
									var chartEvent = chartEvents[0];
									var _datasetIndex = chartEvent._datasetIndex
									var _index = chartEvent._index
									var id_satker = response.id_satkers[_index];
									showDetailData(id_satker)
								}
							}
						}
					});
				}
			}
		});

		$.ajax({
			type: "GET",
			url: "<?= site_url() ?>/api/getGeodemokonsosChart/3?kotama=<?= $this->input->get('kotama') ?>&satker=<?= $this->input->get('satker') ?>&jenisdata=<?= $this->input->get('jenisdata') ?>",
			dataType: "json",
			success: function (response) {
				updateJumlahObject(3, response);
				const canvas = document.getElementById("bar-chart-horizontal2");

				if (response.labels.length == 0) {
					const ctx = canvas.getContext("2d");
					ctx.font = "1.3rem 'Roboto', sans-serif";
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
								if (chartEvents && chartEvents.length > 0) {
									var chartEvent = chartEvents[0];
									var _datasetIndex = chartEvent._datasetIndex
									var _index = chartEvent._index
									var id_satker = response.id_satkers[_index];
									showDetailData(id_satker)
								}
							}
						}
					});
				}
			}
		});
	});
</script>
