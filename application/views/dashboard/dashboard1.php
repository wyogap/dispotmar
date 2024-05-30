<div class="section">
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Sebaran Produksi Ketahanan Pangan</h4>
		</div>
	</div>

	<!-- row opened -->
	<div class="row">
		<div class="col-xl-12" style="height: 170px">
			<div class="card overflow-hidden">
				<div class="card-body" style="height: 160px">
					<form method="GET" id="search"  action="<?= site_url() ?>dashboard1">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-6 col-form-label">
										<span>
											<i class="fa fa-calendar"></i> TMT PELAKSANAAN
										</span>
									</div>
									<div class="col-md-6">
										<input type="text" class="form-control pull-right" name="tmt" id="tmt">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-6 col-form-label">
										<span>
											<i class="fa fa-calendar"></i> ESTIMASI PANEN
										</span>
									</div>
									<div class="col-md-6">
										<input type="text" class="form-control pull-right" name="panen" id="panen">
									</div>
								</div>
							</div>
							
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
										<select class="form-control"
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
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Progress" name="progres" id="progres">
											<option value="">-- Pilih Progress --</option>
											<?php foreach($progress as $progres): ?>
											<option
												<?= $this->input->get('progres') == $progres->id_progres ? 'selected' : '' ?>
												value="<?= $progres->id_progres ?>"><?= $progres->nama_progres ?>
											</option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control select2-show-search border-bottom-0 br-md-0"
											data-placeholder="Pilih Komoditas" name="komoditas" id="komoditas">
											<option value="">-- Pilih Komoditas --</option>
											<?php foreach($komoditases as $komoditas): ?>
											<option
												<?= $this->input->get('komoditas') == $komoditas->id_komoditas ? 'selected' : '' ?>
												value="<?= $komoditas->id_komoditas ?>"><?= $komoditas->nama_komoditas ?>
											</option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-0">
								<div class="form-group row">
									<div class="col-md-12">
										<button class="btn btn-info" type="submit" id="btnfilter"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-1" style="display:none;" id="div_hapusfilter">
								<div class="form-group row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-warning"><a style="color:white;" href="<?= site_url()?>dashboard1" class="side-menu">Hapus Filter</a></button>
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
		<div class="col-md-2" style="height: 50px">
			<div class="card">
				<div class="card-body" style="height: 60px">
					<div class="card-order">
						<div class="row">
							<!-- ambil data dari luas lahan di tabel rekap_pangan -->
							<div class="col" style="margin-top: -15px;">
								<div class="">Luas Lahan(HA)</div>
								<div class="h6 mt-2 mb-2"><span class="font-weight-bold"><?= number_format($summaryLahan[0]->sum_pangan_luas_lahan ? $summaryLahan[0]->sum_pangan_luas_lahan: 0,2,".",".")  ?></span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2" style="height: 50px">
			<div class="card">
				<div class="card-body" style="height: 60px">
					<div class="card-order">
						<div class="row">
							<!-- ambil data dari luas lahan di tabel rekap_pangan -->
							<div class="col" style="margin-top: -15px;">
								<div class="">Lahan Tidur(HA)</div>
								<div class="h6 mt-2 mb-2"><span class="font-weight-bold"><?= number_format(($summaryLahan[0]->sum_lahan_tidur) ? $summaryLahan[0]->sum_lahan_tidur : 0,2,".",".")  ?></span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8" style="height: 50px">
			<div class="card bg-dark1">
				<div class="comodity-marquee">
					<?php foreach($komoditasList as $komoditas): ?>
						<span class="bg-dark1">
							<div class="row">
								<div class="d-flex">
									<div class="ml-3">
										<p class="text-white mb-1 fs-12">
											<?= $komoditas->nama_komoditas ?>
										</p>
										<div class="h5 m-0 fs-14 text-warning">
											<?= number_format($komoditas->total,2,".",".") . ' ' . $komoditas->nama_satuan  ?>
										</div>
									</div>
								</div>
							</div>
						</span>
					<?php endforeach ?>
					<span class="bg-dark1">
						<div class="row">
							<div class="d-flex">
								<div class="ml-3">
									<p class="text-white mb-1 fs-12">
									</p>
									<div class="h5 m-0 fs-14 text-warning">
									</div>
								</div>
							</div>
						</div>
					</span>
				</div>
			</div>
		</div>
	</div>
	<!-- row closed -->
	<br>
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
	<!-- Row End-->
</div>
<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByRkCzDDjo-th8ecT72ZBN6f69RUmwt0I&callback=mapLibReady"></script>
<script src="<?php echo base_url() ?>assets/js/map-util.js"></script>

<script>
function markerListener(myMap, marker, markerData){
	return function() {
		komoditas = <?= $this->input->get('komoditas') ? $this->input->get('komoditas') : '""' ?>;
		satker = markerData.id_satker;
		tmt = <?= $this->input->get('tmt') ? '"'.$this->input->get('tmt').'"' : '""' ?>;
		panen = <?= $this->input->get('panen') ? '"'.$this->input->get('panen').'"' : '""' ?>;
		url = "<?php echo base_url() ?>" + "DashboardController/komoditasByParentSatker?tmt=" + tmt + "&panen=" + panen + "&kotama=&satker=" + satker + "&progres=&komoditas=" + komoditas
		$.get( 
			url, 
			function( data ) {
				jsonData = JSON.parse(data)
				dataHtml = '<center><table>'
				jsonData.forEach(
					function( data ) {
						dataHtml += '<tr> <td> ' + data['nama_komoditas']  + 
						'</td> <td>' + formatNumber(Math.ceil(data['total'])) + 
						'</td> <td>' + data['nama_satuan'] +'</td> ';
					}
				);
				dataHtml += '</table></center>'
				
				myMap.infowindow.setContent(
					'<div id="content">' +
						'<div id="siteNotice">Satker</div>' +
						'<a target="_blank" style="color: #0000ff;" href="' + myMap.siteUrl + 'organisasi_satker/' + markerData.id_satker_encrypted + '/show"><h5 id="firstHeading" class="firstHeading">'+markerData.nama_satker+'</h5></a>' +
						'<h6>' + nullSafe(markerData.nama_pimpinan) + '</h6>' +
						'<h6>' + nullSafe(markerData.geo_path) + '</h6>' +
						dataHtml + 
					'</div>'
				);

			}
		);					
		myMap.infowindow.open(map, marker);
	}
}

var globalMyMap = {
	domId: 'map',
	markerListener: markerListener,
	markerFactory: null,
	recreateMarkerOnZoom: true,
	siteUrl: '',
	markerDatas: [],
	map: null,
	infowindow: null,
	myMarkers: []
}
globalMyMap.siteUrl = "<?= site_url() ?>";
globalMyMap.markerDatas = <?= $satkers_json ?>;

function mapLibReady(){
	initMap(globalMyMap, globalMyMap.markerDatas);
}

</script>

<script>
$(document).ready(function () {
	$("#kotama").select2();
	$("#satker").select2();
	$("#progres").select2();
	$("#komoditas").select2();

	var valtmt = getUrlVars()["tmt"];
	var valpanen = getUrlVars()["panen"];
	var valkotama = getUrlVars()["kotama"];
	var valsatker = getUrlVars()["satker"];
	var valkomoditas = getUrlVars()["komoditas"];
	var valprogres = getUrlVars()["progres"];

	if(valtmt != undefined)
	{
		$('#div_hapusfilter').css("display", "block");
	}
	if(valpanen != undefined)
	{
		$('#div_hapusfilter').css("display", "block");
	}
	if(valkotama != undefined)
	{
		$('#div_hapusfilter').css("display", "block");
	}
	if(valsatker != undefined)
	{
		$('#div_hapusfilter').css("display", "block");
	}
	if(valkomoditas != undefined)
	{
		$('#div_hapusfilter').css("display", "block");
	}
	if(valprogres != undefined)
	{
		$('#div_hapusfilter').css("display", "block");
	}

	$(".comodity-marquee").liMarquee({
			direction: 'left',	
			loop:-1,			
			scrolldelay: 10,		
			scrollamount:120,	
			circular: true,		
			drag: true			
	});

	$("#kotama").change(function() {
		$("#search").submit();
	});

	$('#tmt').daterangepicker({
		autoUpdateInput: false,
		locale: {
			format: 'YYYY-MM-DD'
		}
    });
	$('#panen').daterangepicker({
		autoUpdateInput: false,
		locale: {
			format: 'YYYY-MM-DD'
		}
    });

	<?php if ($this->input->get('tmt')): ?>
		const tmtStart = "<?= explode(' ',$this->input->get('tmt'))[0] ?>"
		const tmtEnd = "<?= explode(' ',$this->input->get('tmt'))[2] ?>"
		$('#tmt').daterangepicker({
			locale: {
				format: 'YYYY-MM-DD'
			},
			startDate: tmtStart,
			endDate: tmtEnd
		});
	<?php endif ?>
	<?php if ($this->input->get('panen')): ?>
		const panenStart = "<?= explode(' ',$this->input->get('panen'))[0] ?>"
		const panenEnd = "<?= explode(' ',$this->input->get('panen'))[2] ?>"
		$('#panen').daterangepicker({
			locale: {
				format: 'YYYY-MM-DD'
			},
			startDate: panenStart,
			endDate: panenEnd
		});
	<?php endif ?>
	
	$('#tmt').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
	});
	$('#panen').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
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
</script>
