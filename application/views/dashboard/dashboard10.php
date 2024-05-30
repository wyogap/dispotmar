<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo $title ?></h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12 product">
			<div class="card">
				<div class="card-body">
					<div class="form-group row">
						<label class="col-md-1 col-form-label">Dari</label>
						<div class="col-md-3">
							<input class="form-control" type="date" id="tglstart">
							<div class="invalid-feedback warning-tmt"></div>
						</div>
						<label class="col-md-1 col-form-label">Sampai</label>
						<div class="col-md-3">
							<input class="form-control" type="date" id="tglend" disabled>
							<div class="invalid-feedback warning-estimate"></div>
						</div>
						&nbsp;
						<div class="col-md-1" style="display:none;" id="div_hapusfilter">
							<div class="form-group row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-warning"><a style="color:white;"
											href="<?= site_url()?>dashboard10" class="side-menu">Hapus
											Filter</a></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12 product">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Terkini</h3>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12 col-xl-4 lg-mt-5">
							<div class="row">
								<div class="col-6">
									<div class="card box-shadow-0 overflow-hidden">
										<div class="card-body p-4">
											<div class="text-center">
												<div class="chart-wrapper text-center">
													<canvas id="tempchart1"
														class="areaChart1 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>
												</div>
												<h3 class="mt-3 mb-0 ">
													<?php if($CurrentTempTanaman): ?>
													<?= $CurrentTempTanaman->value ?>&nbsp;<?= $CurrentTempTanaman->unit ?>
													<?php else: ?>
													<?php endif ?>
												</h3>
												<h5 class="mt-3 mb-0 ">Temperatur Tanaman</h3>
											</div>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="card box-shadow-0 overflow-hidden">
										<div class="card-body p-4">
											<div class="text-center">
												<div class="chart-wrapper text-center">
													<canvas id="tempchart11"
														class="areaChart1 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>
												</div>
												<h3 class="mt-3 mb-0 ">
													<?php if($CurrentTempTorrent): ?>
													<?= $CurrentTempTorrent->value ?>&nbsp;<?= $CurrentTempTorrent->unit ?>
													<?php else: ?>
													<?php endif ?>
												</h3>
												<h5 class="mt-3 mb-0 ">Temperatur Toren</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-xl-4 lg-mt-5">
							<div class="row">
								<div class="col-6">
									<div class="card box-shadow-0 overflow-hidden">
										<div class="card-body p-4">
											<div class="text-center">
												<div class="chart-wrapper text-center">
													<canvas id="tempchart2"
														class="areaChart1 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>
												</div>
												<h3 class="mt-3 mb-0 ">
													<?php if($CurrentPHTanaman): ?>
													<?= $CurrentPHTanaman->value ?>
													<?php else: ?>
													<?php endif ?>
												</h3>
												<h5 class="mt-3 mb-0 ">PH Tanaman</h3>
											</div>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="card box-shadow-0 overflow-hidden">
										<div class="card-body p-4">
											<div class="text-center">
												<div class="chart-wrapper text-center">
													<canvas id="tempchart22"
														class="areaChart1 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>
												</div>
												<h3 class="mt-3 mb-0 ">
													<?php if($CurrentPHTorrent): ?>
													<?= $CurrentPHTorrent->value ?>
													<?php else: ?>
													<?php endif ?>
												</h3>
												<h5 class="mt-3 mb-0 ">PH Toren</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-xl-4 lg-mt-5">
							<div class="row">
								<div class="col-6">
									<div class="card box-shadow-0 overflow-hidden">
										<div class="card-body p-4">
											<div class="text-center">
												<div class="chart-wrapper text-center">
													<canvas id="tempchart3"
														class="areaChart1 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>
												</div>
												<h3 class="mt-3 mb-0 ">
													<?php if($CurrentTDSTanaman): ?>
													<?= $CurrentTDSTanaman->value ?>&nbsp;<?= $CurrentTDSTanaman->unit ?>
													<?php else: ?>
													<?php endif ?>
												</h3>
												<h5 class="mt-3 mb-0 ">TDS Tanaman</h3>
											</div>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="card box-shadow-0 overflow-hidden">
										<div class="card-body p-4">
											<div class="text-center">
												<div class="chart-wrapper text-center">
													<canvas id="tempchart33"
														class="areaChart1 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>
												</div>
												<h3 class="mt-3 mb-0 ">
													<?php if($CurrentTDSTorrent): ?>
													<?= $CurrentTDSTorrent->value ?>&nbsp;<?= $CurrentTDSTorrent->unit ?>
													<?php else: ?>
													<?php endif ?>
												</h3>
												<h5 class="mt-3 mb-0 ">TDS Toren</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-6 product">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Temperatur Tanaman</h3>
					<div class="card-options ">
						<a href="#" class="card-options-fullscreen" id="temperaturTanaman-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<label id="flag-temperaturTanaman" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<canvas id="temperaturTanaman" style="height:250px;"
						class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-6 product">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Temperatur Toren</h3>
					<div class="card-options ">
						<a href="#" class="card-options-fullscreen" id="temperaturTorrent-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<label id="flag-temperaturTorrent" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<canvas id="temperaturTorrent" style="height:250px;"
						class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-6 product">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data PH Tanaman</h3>
					<div class="card-options ">
						<a href="#" class="card-options-fullscreen" id="PhTanaman-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<label id="flag-PhTanaman" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<canvas id="PhTanaman" style="height:250px;"
						class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-6 product">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data PH Toren</h3>
					<div class="card-options ">
						<a href="#" class="card-options-fullscreen" id="PhTorrent-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<label id="flag-PhTorrent" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<canvas id="PhTorrent" style="height:250px;"
						class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-6 product">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Total Dissolve solid (TDS) Tanaman</h3>
					<div class="card-options ">
						<a href="#" class="card-options-fullscreen" id="TDSTanaman-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<label id="flag-TDSTanaman" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<canvas id="TDSTanaman" style="height:250px;"
						class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
		<div class="col-xl-6 product">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Total Dissolve solid (TDS) Toren</h3>
					<div class="card-options ">
						<a href="#" class="card-options-fullscreen" id="TDSTorrent-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<label id="flag-TDSTorrent" style="display:none;">a</label>
					</div>
				</div>
				<div class="card-body">
					<canvas id="TDSTorrent" style="height:250px;"
						class="chartjs-render-monitor chart-dropshadow2"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->

	<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
	<script>
		$(document).ready(function () {
			$("#temperaturTanaman-fullscreen").click(function() {
			if($("#flag-temperaturTanaman").text() == "a")
			{
				$("#flag-temperaturTanaman").text("b");
				$("#temperaturTanaman").height('auto');
			}
			else
			{
				$("#flag-temperaturTanaman").text("a");
				$("#temperaturTanaman").height('250');
			}
		});

		$("#temperaturTorrent-fullscreen").click(function() {
			if($("#flag-temperaturTorrent").text() == "a")
			{
				$("#flag-temperaturTorrent").text("b");
				$("#temperaturTorrent").height('auto');
			}
			else
			{
				$("#flag-temperaturTorrent").text("a");
				$("#temperaturTorrent").height('250');
			}
		});

		$("#PhTanaman-fullscreen").click(function() {
			if($("#flag-PhTanaman").text() == "a")
			{
				$("#flag-PhTanaman").text("b");
				$("#PhTanaman").height('auto');
			}
			else
			{
				$("#flag-PhTanaman").text("a");
				$("#PhTanaman").height('250');
			}
		});

		$("#PhTorrent-fullscreen").click(function() {
			if($("#flag-PhTorrent").text() == "a")
			{
				$("#flag-PhTorrent").text("b");
				$("#PhTorrent").height('auto');
			}
			else
			{
				$("#flag-PhTorrent").text("a");
				$("#PhTorrent").height('250');
			}
		});

		$("#TDSTanaman-fullscreen").click(function() {
			if($("#flag-TDSTanaman").text() == "a")
			{
				$("#flag-TDSTanaman").text("b");
				$("#TDSTanaman").height('auto');
			}
			else
			{
				$("#flag-TDSTanaman").text("a");
				$("#TDSTanaman").height('250');
			}
		});

		$("#TDSTorrent-fullscreen").click(function() {
			if($("#flag-TDSTorrent").text() == "a")
			{
				$("#flag-TDSTorrent").text("b");
				$("#TDSTorrent").height('auto');
			}
			else
			{
				$("#flag-TDSTorrent").text("a");
				$("#TDSTorrent").height('250');
			}
		});
		
			var tglstart_value = '0';
			var tglend_value = '0';

			$('#tglstart').change(function () {
				tglstart_value = $(this).val();

				if (tglstart_value != '0') {
					$('#tglend').prop("disabled", false);
					$('#div_hapusfilter').css("display", "block");
				}

				if (tglend_value != '0') {
					generate_chart(tglstart_value, tglend_value);
					$('#div_hapusfilter').css("display", "block");
				}
			});

			$('#tglend').change(function () {
				tglend_value = $(this).val();

				if (tglstart_value != '0' && tglend_value != '0') {
					generate_chart(tglstart_value, tglend_value);
					$('#div_hapusfilter').css("display", "block");
				}
			});

			generate_chart(tglstart_value, tglend_value);
		});

		function generate_chart(tglstart_value, tglend_value) {
			//chart temp tanaman
			$.ajax({
				type: "GET",
				url: "<?= site_url() ?>/api/getdatatemperaturTanaman/" + tglstart_value + "/" + tglend_value + "?>",
				dataType: "json",
				success: function (data) {
					var vlabel = [];
					var vdata = [];
					for (var i = 0; i < data.length; i++) {
						vlabel[vlabel.length] = data[i].timestampnew;
						vdata[vdata.length] = data[i].value;
					}

					var ctx = document.getElementById("temperaturTanaman");
					var chart1;

					if (window.chart1 != undefined) {
						window.chart1.destroy();
					}

					if (vlabel.length == 0) {
						const ctxs = ctx.getContext("2d");
						ctxs.font = "1.3rem 'Roboto', sans-serif";
						ctxs.fillStyle = '#8492a6';
						ctxs.fillText("Data Tidak Ditemukan", 50, 50);
					} else {
						window.chart1 = new Chart(ctx, {
							type: 'line',
							data: {
								labels: vlabel,
								type: 'line',
								defaultFontFamily: 'Montserrat',
								datasets: [{
									label: "Tanaman",
									data: vdata,
									backgroundColor: 'transparent',
									borderColor: 'rgba(33, 91, 220)',
									borderWidth: 3,
									pointStyle: 'circle',
									pointRadius: 5,
									pointBorderColor: 'transparent',
									pointBackgroundColor: 'rgba(33, 91, 220)',
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								tooltips: {
									callbacks: {
										label: function (tooltipItem) {
											return "di Tanaman " + Number(tooltipItem
												.yLabel) + " °C";
										}
									},
									mode: 'index',
									titleFontSize: 12,
									titleFontColor: '#8492a6  ',
									bodyFontColor: '#8492a6  ',
									backgroundColor: '#fff',
									titleFontFamily: 'Montserrat',
									bodyFontFamily: 'Montserrat',
									cornerRadius: 3,
									intersect: false,
								},
								legend: {
									display: false,
									labels: {
										usePointStyle: true,
										fontFamily: 'Montserrat',
									},
								},
								scales: {
									xAxes: [{
										display: true,
										gridLines: {
											display: true,
											color: 'rgb(142, 156, 173,0.1)',
											drawBorder: false
										},
										ticks: {
											fontColor: '#8e9cad',
											autoSkip: true,
											maxTicksLimit: 4,
											maxRotation: 0,
											labelOffset: 10
										},
										scaleLabel: {
											display: false,
											labelString: 'Month',
											fontColor: 'transparent'
										}
									}],
									yAxes: [{
										ticks: {
											fontColor: "#8e9cad",
											//beginAtZero: true
										},
										display: true,
										gridLines: {
											display: false,
											drawBorder: false
										},
										scaleLabel: {
											display: false,
											labelString: 'sales',
											fontColor: 'transparent'
										}
									}]
								},
								title: {
									display: false,
									text: 'Normal Legend'
								},
								plugins: {
									datalabels: {
										display: false,
									}
								}
							}
						});
					}

				}
			});

			//chart temp toren
			$.ajax({
				type: "GET",
				url: "<?= site_url() ?>/api/getdatatemperaturTorrent/" + tglstart_value + "/" + tglend_value + "?>",
				dataType: "json",
				success: function (data) {

					var vlabel = [];
					var vdata = [];
					for (var i = 0; i < data.length; i++) {
						vlabel[vlabel.length] = data[i].timestampnew;
						vdata[vdata.length] = data[i].value;
					}

					var ctx = document.getElementById("temperaturTorrent");
					var chart2;

					if (window.chart2 != undefined) {
						window.chart2.destroy();
					}

					if (vlabel.length == 0) {
						const ctxs = ctx.getContext("2d");
						ctxs.font = "1.3rem 'Roboto', sans-serif";
						ctxs.fillStyle = '#8492a6';
						ctxs.fillText("Data Tidak Ditemukan", 50, 50);
					} else {
						window.chart2 = new Chart(ctx, {
							type: 'line',
							data: {
								labels: vlabel,
								type: 'line',
								defaultFontFamily: 'Montserrat',
								datasets: [{
									label: "Torrent",
									data: vdata,
									backgroundColor: 'transparent',
									borderColor: '#00e600',
									borderWidth: 3,
									pointStyle: 'circle',
									pointRadius: 5,
									pointBorderColor: 'transparent',
									pointBackgroundColor: '#00e600',
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								tooltips: {
									callbacks: {
										label: function (tooltipItem) {
											return "Dekat Toren " + Number(tooltipItem
													.yLabel) +
												" °C";
										}
									},
									mode: 'index',
									titleFontSize: 12,
									titleFontColor: '#8492a6  ',
									bodyFontColor: '#8492a6  ',
									backgroundColor: '#fff',
									titleFontFamily: 'Montserrat',
									bodyFontFamily: 'Montserrat',
									cornerRadius: 3,
									intersect: false,
								},
								legend: {
									display: false,
									labels: {
										usePointStyle: true,
										fontFamily: 'Montserrat',
									},
								},
								scales: {
									xAxes: [{
										display: true,
										gridLines: {
											display: true,
											color: 'rgb(142, 156, 173,0.1)',
											drawBorder: false
										},
										ticks: {
											fontColor: '#8e9cad',
											autoSkip: true,
											maxTicksLimit: 4,
											maxRotation: 0,
											labelOffset: 10
										},
										scaleLabel: {
											display: false,
											labelString: 'Month',
											fontColor: 'transparent'
										}
									}],
									yAxes: [{
										ticks: {
											fontColor: "#8e9cad",
											//beginAtZero: true
										},
										display: true,
										gridLines: {
											display: false,
											drawBorder: false
										},
										scaleLabel: {
											display: false,
											labelString: 'sales',
											fontColor: 'transparent'
										}
									}]
								},
								title: {
									display: false,
									text: 'Normal Legend'
								},
								plugins: {
									datalabels: {
										display: false,
									}
								}
							}
						});
					}
				}
			});

			//chart ph tanaman
			$.ajax({
				type: "GET",
				url: "<?= site_url() ?>/api/getdataPhTanaman/" + tglstart_value + "/" + tglend_value + "?>",
				dataType: "json",
				success: function (data) {

					var vlabel = [];
					var vdata = [];
					for (var i = 0; i < data.length; i++) {
						vlabel[vlabel.length] = data[i].timestampnew;
						vdata[vdata.length] = data[i].value;
					}

					var ctx = document.getElementById("PhTanaman");
					var chart3;

					if (window.chart3 != undefined) {
						window.chart3.destroy();
					}

					if (vlabel.length == 0) {
						const ctxs = ctx.getContext("2d");
						ctxs.font = "1.3rem 'Roboto', sans-serif";
						ctxs.fillStyle = '#8492a6';
						ctxs.fillText("Data Tidak Ditemukan", 50, 50);
					} else {
						window.chart3 = new Chart(ctx, {
							type: 'line',
							data: {
								labels: vlabel,
								type: 'line',
								defaultFontFamily: 'Montserrat',
								datasets: [{
									label: "Torrent",
									data: vdata,
									backgroundColor: 'transparent',
									borderColor: '#f88a61',
									borderWidth: 3,
									pointStyle: 'circle',
									pointRadius: 5,
									pointBorderColor: 'transparent',
									pointBackgroundColor: '#f88a61',
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								tooltips: {
									callbacks: {
										label: function (tooltipItem) {
											return "Ph Tanaman " + Number(tooltipItem.yLabel);
										}
									},
									mode: 'index',
									titleFontSize: 12,
									titleFontColor: '#8492a6  ',
									bodyFontColor: '#8492a6  ',
									backgroundColor: '#fff',
									titleFontFamily: 'Montserrat',
									bodyFontFamily: 'Montserrat',
									cornerRadius: 3,
									intersect: false,
								},
								legend: {
									display: false,
									labels: {
										usePointStyle: true,
										fontFamily: 'Montserrat',
									},
								},
								scales: {
									xAxes: [{
										display: true,
										gridLines: {
											display: true,
											color: 'rgb(142, 156, 173,0.1)',
											drawBorder: false
										},
										ticks: {
											fontColor: '#8e9cad',
											autoSkip: true,
											maxTicksLimit: 4,
											maxRotation: 0,
											labelOffset: 10
										},
										scaleLabel: {
											display: false,
											labelString: 'Month',
											fontColor: 'transparent'
										}
									}],
									yAxes: [{
										ticks: {
											fontColor: "#8e9cad",
											//beginAtZero: true
										},
										display: true,
										gridLines: {
											display: false,
											drawBorder: false
										},
										scaleLabel: {
											display: false,
											labelString: 'sales',
											fontColor: 'transparent'
										}
									}]
								},
								title: {
									display: false,
									text: 'Normal Legend'
								},
								plugins: {
									datalabels: {
										display: false,
									}
								}
							}
						});
					}
				}
			});

			//chart ph toren
			$.ajax({
				type: "GET",
				url: "<?= site_url() ?>/api/getdataPhTorrent/" + tglstart_value + "/" + tglend_value + "?>",
				dataType: "json",
				success: function (data) {

					var vlabel = [];
					var vdata = [];
					for (var i = 0; i < data.length; i++) {
						vlabel[vlabel.length] = data[i].timestampnew;
						vdata[vdata.length] = data[i].value;
					}

					var ctx = document.getElementById("PhTorrent");
					var chart4;

					if (window.chart4 != undefined) {
						window.chart4.destroy();
					}

					if (vlabel.length == 0) {
						const ctxs = ctx.getContext("2d");
						ctxs.font = "1.3rem 'Roboto', sans-serif";
						ctxs.fillStyle = '#8492a6';
						ctxs.fillText("Data Tidak Ditemukan", 50, 50);
					} else {
						window.chart4 = new Chart(ctx, {
							type: 'line',
							data: {
								labels: vlabel,
								type: 'line',
								defaultFontFamily: 'Montserrat',
								datasets: [{
									label: "Torrent",
									data: vdata,
									backgroundColor: 'transparent',
									borderColor: '#b82e8a',
									borderWidth: 3,
									pointStyle: 'circle',
									pointRadius: 5,
									pointBorderColor: 'transparent',
									pointBackgroundColor: '#b82e8a',
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								tooltips: {
									callbacks: {
										label: function (tooltipItem) {
											return "Ph Toren " + Number(tooltipItem.yLabel);
										}
									},
									mode: 'index',
									titleFontSize: 12,
									titleFontColor: '#8492a6  ',
									bodyFontColor: '#8492a6  ',
									backgroundColor: '#fff',
									titleFontFamily: 'Montserrat',
									bodyFontFamily: 'Montserrat',
									cornerRadius: 3,
									intersect: false,
								},
								legend: {
									display: false,
									labels: {
										usePointStyle: true,
										fontFamily: 'Montserrat',
									},
								},
								scales: {
									xAxes: [{
										display: true,
										gridLines: {
											display: true,
											color: 'rgb(142, 156, 173,0.1)',
											drawBorder: false
										},
										ticks: {
											fontColor: '#8e9cad',
											autoSkip: true,
											maxTicksLimit: 4,
											maxRotation: 0,
											labelOffset: 10
										},
										scaleLabel: {
											display: false,
											labelString: 'Month',
											fontColor: 'transparent'
										}
									}],
									yAxes: [{
										ticks: {
											fontColor: "#8e9cad",
											//beginAtZero: true
										},
										display: true,
										gridLines: {
											display: false,
											drawBorder: false
										},
										scaleLabel: {
											display: false,
											labelString: 'sales',
											fontColor: 'transparent'
										}
									}]
								},
								title: {
									display: false,
									text: 'Normal Legend'
								},
								plugins: {
									datalabels: {
										display: false,
									}
								}
							}
						});
					}
				}
			});

			//chart tds tanaman
			$.ajax({
				type: "GET",
				url: "<?= site_url() ?>/api/getdataTDSTanaman/" + tglstart_value + "/" + tglend_value + "?>",
				dataType: "json",
				success: function (data) {

					var vlabel = [];
					var vdata = [];
					for (var i = 0; i < data.length; i++) {
						vlabel[vlabel.length] = data[i].timestampnew;
						vdata[vdata.length] = data[i].value;
					}

					var ctx = document.getElementById("TDSTanaman");
					var chart5;

					if (window.chart5 != undefined) {
						window.chart5.destroy();
					}

					if (vlabel.length == 0) {
						const ctxs = ctx.getContext("2d");
						ctxs.font = "1.3rem 'Roboto', sans-serif";
						ctxs.fillStyle = '#8492a6';
						ctxs.fillText("Data Tidak Ditemukan", 50, 50);
					} else {
						window.chart5 = new Chart(ctx, {
							type: 'line',
							data: {
								labels: vlabel,
								type: 'line',
								defaultFontFamily: 'Montserrat',
								datasets: [{
									label: "Torrent",
									data: vdata,
									backgroundColor: 'transparent',
									borderColor: '#737373',
									borderWidth: 3,
									pointStyle: 'circle',
									pointRadius: 5,
									pointBorderColor: 'transparent',
									pointBackgroundColor: '#737373',
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								tooltips: {
									callbacks: {
										label: function (tooltipItem) {
											return "TDS Tanaman " + Number(tooltipItem
													.yLabel) +
												" ppm";
										}
									},
									mode: 'index',
									titleFontSize: 12,
									titleFontColor: '#8492a6  ',
									bodyFontColor: '#8492a6  ',
									backgroundColor: '#fff',
									titleFontFamily: 'Montserrat',
									bodyFontFamily: 'Montserrat',
									cornerRadius: 3,
									intersect: false,
								},
								legend: {
									display: false,
									labels: {
										usePointStyle: true,
										fontFamily: 'Montserrat',
									},
								},
								scales: {
									xAxes: [{
										display: true,
										gridLines: {
											display: true,
											color: 'rgb(142, 156, 173,0.1)',
											drawBorder: false
										},
										ticks: {
											fontColor: '#8e9cad',
											autoSkip: true,
											maxTicksLimit: 4,
											maxRotation: 0,
											labelOffset: 10
										},
										scaleLabel: {
											display: false,
											labelString: 'Month',
											fontColor: 'transparent'
										}
									}],
									yAxes: [{
										ticks: {
											fontColor: "#8e9cad",
											//beginAtZero: true
										},
										display: true,
										gridLines: {
											display: false,
											drawBorder: false
										},
										scaleLabel: {
											display: false,
											labelString: 'sales',
											fontColor: 'transparent'
										}
									}]
								},
								title: {
									display: false,
									text: 'Normal Legend'
								},
								plugins: {
									datalabels: {
										display: false,
									}
								}
							}
						});
					}
				}
			});

			//chart tds toren
			$.ajax({
				type: "GET",
				url: "<?= site_url() ?>/api/getdataTDSTorrent/" + tglstart_value + "/" + tglend_value + "?>",
				dataType: "json",
				success: function (data) {

					var vlabel = [];
					var vdata = [];
					for (var i = 0; i < data.length; i++) {
						vlabel[vlabel.length] = data[i].timestampnew;
						vdata[vdata.length] = data[i].value;
					}

					var ctx = document.getElementById("TDSTorrent");
					var chart6;

					if (window.chart6 != undefined) {
						window.chart6.destroy();
					}

					if (vlabel.length == 0) {
						const ctxs = ctx.getContext("2d");
						ctxs.font = "1.3rem 'Roboto', sans-serif";
						ctxs.fillStyle = '#8492a6';
						ctxs.fillText("Data Tidak Ditemukan", 50, 50);
					} else {
						window.chart6 = new Chart(ctx, {
							type: 'line',
							data: {
								labels: vlabel,
								type: 'line',
								defaultFontFamily: 'Montserrat',
								datasets: [{
									label: "Torrent",
									data: vdata,
									backgroundColor: 'transparent',
									borderColor: '#ff0000',
									borderWidth: 3,
									pointStyle: 'circle',
									pointRadius: 5,
									pointBorderColor: 'transparent',
									pointBackgroundColor: '#ff0000',
								}]
							},
							options: {
								responsive: true,
								maintainAspectRatio: false,
								tooltips: {
									callbacks: {
										label: function (tooltipItem) {
											return "TDS Toren " + Number(tooltipItem.yLabel) +
												" ppm";
										}
									},
									mode: 'index',
									titleFontSize: 12,
									titleFontColor: '#8492a6  ',
									bodyFontColor: '#8492a6  ',
									backgroundColor: '#fff',
									titleFontFamily: 'Montserrat',
									bodyFontFamily: 'Montserrat',
									cornerRadius: 3,
									intersect: false,
								},
								legend: {
									display: false,
									labels: {
										usePointStyle: true,
										fontFamily: 'Montserrat',
									},
								},
								scales: {
									xAxes: [{
										display: true,
										gridLines: {
											display: true,
											color: 'rgb(142, 156, 173,0.1)',
											drawBorder: false
										},
										ticks: {
											fontColor: '#8e9cad',
											autoSkip: true,
											maxTicksLimit: 4,
											maxRotation: 0,
											labelOffset: 10
										},
										scaleLabel: {
											display: false,
											labelString: 'Month',
											fontColor: 'transparent'
										}
									}],
									yAxes: [{
										ticks: {
											fontColor: "#8e9cad",
											//beginAtZero: true
										},
										display: true,
										gridLines: {
											display: false,
											drawBorder: false
										},
										scaleLabel: {
											display: false,
											labelString: 'sales',
											fontColor: 'transparent'
										}
									}]
								},
								title: {
									display: false,
									text: 'Normal Legend'
								},
								plugins: {
									datalabels: {
										display: false,
									}
								}
							}
						});
					}
				}
			});
		}

		$(function (e) {
			'use strict'

			/* Chartjs (#areachart1) */
			var ctx = document.getElementById("tempchart1");
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8',
						'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15',
						'Date 16', 'Date 17'
					],
					type: 'line',
					datasets: [{
						data: [45, 23, 32, 67, 49, 72, 52, 55, 46, 54, 32, 74, 88, 36, 36, 32, 48, 54,
							110
						],
						label: 'Admissions',
						backgroundColor: 'transparent',
						borderColor: '#2205bf',
						borderWidth: '2.5',
						pointBorderColor: 'transparent',
						pointBackgroundColor: 'transparent',
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					responsive: true,
					tooltips: {
						enabled: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								color: 'transparent',
								zeroLineColor: 'transparent'
							},
							ticks: {
								fontSize: 2,
								fontColor: 'transparent'
							}
						}],
						yAxes: [{
							display: false,
							ticks: {
								display: false,
							}
						}]
					},
					title: {
						display: false,
					},

					plugins: {
						datalabels: {
							display: false,
						}
					},
					elements: {
						line: {
							borderWidth: 1
						},
						point: {
							radius: 4,
							hitRadius: 10,
							hoverRadius: 4
						}
					}
				}
			});
			/* Chartjs (#areachart1) closed */

			/* Chartjs (#areachart1) */
			var ctx = document.getElementById("tempchart11");
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8',
						'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15',
						'Date 16', 'Date 17'
					],
					type: 'line',
					datasets: [{
						data: [45, 23, 32, 67, 49, 72, 52, 55, 46, 54, 32, 74, 88, 36, 36, 32, 48, 54,
							110
						],
						label: 'Admissions',
						backgroundColor: 'transparent',
						borderColor: '#00e600',
						borderWidth: '2.5',
						pointBorderColor: 'transparent',
						pointBackgroundColor: 'transparent',
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					responsive: true,
					tooltips: {
						enabled: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								color: 'transparent',
								zeroLineColor: 'transparent'
							},
							ticks: {
								fontSize: 2,
								fontColor: 'transparent'
							}
						}],
						yAxes: [{
							display: false,
							ticks: {
								display: false,
							}
						}]
					},
					title: {
						display: false,
					},

					plugins: {
						datalabels: {
							display: false,
						}
					},
					elements: {
						line: {
							borderWidth: 1
						},
						point: {
							radius: 4,
							hitRadius: 10,
							hoverRadius: 4
						}
					}
				}
			});
			/* Chartjs (#areachart1) closed */

			/* Chartjs (#areachart2) */
			var ctx = document.getElementById("tempchart2");
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8',
						'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15',
						'Date 16', 'Date 17'
					],
					type: 'line',
					datasets: [{
						data: [28, 56, 36, 32, 48, 54, 37, 58, 66, 53, 21, 24, 14, 45, 0, 32, 67, 49,
							52, 55, 46, 54, 130
						],
						label: 'Admissions',
						backgroundColor: 'transparent',
						borderColor: '#f88a61',
						borderWidth: '2.5',
						pointBorderColor: 'transparent',
						pointBackgroundColor: 'transparent',
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					responsive: true,
					tooltips: {
						enabled: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								color: 'transparent',
								zeroLineColor: 'transparent'
							},
							ticks: {
								fontSize: 2,
								fontColor: 'transparent'
							}
						}],
						yAxes: [{
							display: false,
							ticks: {
								display: false,
							}
						}]
					},
					title: {
						display: false,
					},

					plugins: {
						datalabels: {
							display: false,
						}
					},
					elements: {
						line: {
							borderWidth: 1
						},
						point: {
							radius: 4,
							hitRadius: 10,
							hoverRadius: 4
						}
					}
				}
			});
			/* Chartjs (#areachart2) closed */

			/* Chartjs (#areachart2) */
			var ctx = document.getElementById("tempchart22");
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8',
						'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15',
						'Date 16', 'Date 17'
					],
					type: 'line',
					datasets: [{
						data: [28, 56, 36, 32, 48, 54, 37, 58, 66, 53, 21, 24, 14, 45, 0, 32, 67, 49,
							52, 55, 46, 54, 130
						],
						label: 'Admissions',
						backgroundColor: 'transparent',
						borderColor: '#b82e8a',
						borderWidth: '2.5',
						pointBorderColor: 'transparent',
						pointBackgroundColor: 'transparent',
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					responsive: true,
					tooltips: {
						enabled: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								color: 'transparent',
								zeroLineColor: 'transparent'
							},
							ticks: {
								fontSize: 2,
								fontColor: 'transparent'
							}
						}],
						yAxes: [{
							display: false,
							ticks: {
								display: false,
							}
						}]
					},
					title: {
						display: false,
					},

					plugins: {
						datalabels: {
							display: false,
						}
					},
					elements: {
						line: {
							borderWidth: 1
						},
						point: {
							radius: 4,
							hitRadius: 10,
							hoverRadius: 4
						}
					}
				}
			});
			/* Chartjs (#areachart2) closed */

			/* Chartjs (#areachart4) */
			var ctx = document.getElementById("tempchart3");
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8',
						'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15',
						'Date 16', 'Date 17'
					],
					type: 'line',
					datasets: [{
						data: [28, 56, 36, 52, 48, 24, 14, 45, 80, 32, 45, 54, 51, 52, 48, 54, 67, 49,
							58, 78, 54, 120
						],
						label: 'Admissions',
						backgroundColor: 'transparent',
						borderColor: '#737373',
						borderWidth: '3',
						pointBorderColor: 'transparent',
						pointBackgroundColor: 'transparent',
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					responsive: true,
					tooltips: {
						enabled: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								color: 'transparent',
								zeroLineColor: 'transparent'
							},
							ticks: {
								fontSize: 2,
								fontColor: 'transparent'
							}
						}],
						yAxes: [{
							display: false,
							ticks: {
								display: false,
							}
						}]
					},
					title: {
						display: false,
					},

					plugins: {
						datalabels: {
							display: false,
						}
					},
					elements: {
						line: {
							borderWidth: 1
						},
						point: {
							radius: 4,
							hitRadius: 10,
							hoverRadius: 4
						}
					}
				}
			});
			/* Chartjs (#areachart4 closed) */

			/* Chartjs (#areachart4) */
			var ctx = document.getElementById("tempchart33");
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['Date 1', 'Date 2', 'Date 3', 'Date 4', 'Date 5', 'Date 6', 'Date 7', 'Date 8',
						'Date 9', 'Date 10', 'Date 11', 'Date 12', 'Date 13', 'Date 14', 'Date 15',
						'Date 16', 'Date 17'
					],
					type: 'line',
					datasets: [{
						data: [28, 56, 36, 52, 48, 24, 14, 45, 80, 32, 45, 54, 51, 52, 48, 54, 67, 49,
							58, 78, 54, 120
						],
						label: 'Admissions',
						backgroundColor: 'transparent',
						borderColor: '#ff0000',
						borderWidth: '3',
						pointBorderColor: 'transparent',
						pointBackgroundColor: 'transparent',
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					responsive: true,
					tooltips: {
						enabled: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								color: 'transparent',
								zeroLineColor: 'transparent'
							},
							ticks: {
								fontSize: 2,
								fontColor: 'transparent'
							}
						}],
						yAxes: [{
							display: false,
							ticks: {
								display: false,
							}
						}]
					},
					title: {
						display: false,
					},

					plugins: {
						datalabels: {
							display: false,
						}
					},
					elements: {
						line: {
							borderWidth: 1
						},
						point: {
							radius: 4,
							hitRadius: 10,
							hoverRadius: 4
						}
					}
				}
			});
			/* Chartjs (#areachart4 closed) */

		});

	</script>
