<?php
// based on original work from the PHP Laravel framework
if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}
?>

<div class="section">

	<!-- Page-header opened -->
	<div class="page-header">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo site_url() ?>kbn"><i class="ti-package mr-1"></i>Kampung Bahari Nusantara</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $kbn->nama; ?></li>
		</ol>
	</div>
	<!-- Page-header closed -->

	<!-- row opened -->
    <div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card card-collapsed" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Profil - <?= $kbn->nama; ?></div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4 text-right">
                            Nama :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->nama; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Klaster :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->klaster; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Deskripsi :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->deskripsi; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Tanggal Peresmian :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->tgl_peresmian; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Ketua Pelaksana :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->nama_ketua_pelaksana; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Kelurahan/Desa :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->nama_kelurahan; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Kecamatan :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->nama_kecamatan; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Kabupaten/Kota :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->nama_kabupaten; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
                            Provinsi :
						</div>
						<div class="col-md-8 text-left">
                            <?= $kbn->nama_provinsi; ?>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>

    <div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Sumber Daya Alam - <?= $kbn->nama; ?></div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
                    <div class="myTab">
                        <ul class="nav nav-tabs nav-justified m-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="sda-pantai-tab" data-toggle="tab" href="#sda-pantai" role="tab" aria-controls="sda-pantai" aria-selected="false">Pantai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-hutan-tab" data-toggle="tab" href="#sda-hutan" role="tab" aria-controls="sda-hutan" aria-selected="true">Hutan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-gunung-tab" data-toggle="tab" href="#sda-gunung" role="tab" aria-controls="sda-gunung" aria-selected="true">Gunung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-kerawanan-tab" data-toggle="tab" href="#sda-kerawanan" role="tab" aria-controls="sda-kerawanan" aria-selected="true">Kerawanan Geografi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-hujan-tab" data-toggle="tab" href="#sda-hujan" role="tab" aria-controls="sda-hujan" aria-selected="true">Curah Hujan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-tanah-tab" data-toggle="tab" href="#sda-tanah" role="tab" aria-controls="sda-tanah" aria-selected="true">Struktur Tanah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-sumberair-tab" data-toggle="tab" href="#sda-sumberair" role="tab" aria-controls="sda-sumberair" aria-selected="true">Sumber Air</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-sungai-tab" data-toggle="tab" href="#sda-sungai" role="tab" aria-controls="sda-sungai" aria-selected="true">Sungai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-pulauterluar-tab" data-toggle="tab" href="#sda-pulauterluar" role="tab" aria-controls="sda-pulauterluar" aria-selected="true">Pulau Terluar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sda-mangrove-tab" data-toggle="tab" href="#sda-mangrove" role="tab" aria-controls="sda-mangrove" aria-selected="true">Mangrove</a>
                            </li>
                        </ul>
                        <div class="tab-content  p-3 border" id="myTabContent">
							<div class="tab-pane fade p-0 active show" id="sda-pantai" role="tabpanel" aria-labelledby="sda-pantai-tab">
                                <div class="table-responsive">
                                    <table id="tpantai" style="table-layout: auto; width: 100%;" class="table table-striped  table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="nama_pantai">Nama Pantai</th>
                                            <th tcg-field="jenis_pantai">Jenis Pantai</th>
                                            <th tcg-field="panjang_pantai">Panjang Pantai (Km)</th>
                                            <th tcg-field="material_dasar_pantai">Material Dasar Pantai</th>
                                            <th tcg-field="ciri_khusus">Ciri Khusus</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-hutan" role="tabpanel" aria-labelledby="sda-hutan-tab">
                                <div class="table-responsive">
                                    <table id="thutan" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="jenis_tanaman_hutan">Jenis Tanaman</th>
                                            <th tcg-field="luas_hutan">Luas Hutan (Ha)</th>
                                            <th tcg-field="status_hutan">Status Hutan</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-gunung" role="tabpanel" aria-labelledby="sda-gunung-tab">
                                <div class="table-responsive">
                                    <table id="tgunung" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="nama_gunung">Nama Gunung</th>
                                            <th tcg-field="tinggi_gunung">Tinggi Gunung (Mdpl)</th>
                                            <th tcg-field="status_gunung">Status</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-kerawanan" role="tabpanel" aria-labelledby="sda-kerawanan-tab">
                                <div class="table-responsive">
                                    <table id="tkerawanan" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="gempa_tektonik">Gempa Tektonik</th>
                                            <th tcg-field="gempa_vulkanik">Gempa Vulkanik</th>
                                            <th tcg-field="banjir">Banjir</th>
                                            <th tcg-field="gunung_meletus">Gunung Meletus</th>
                                            <th tcg-field="tsunami">Tsunami</th>
                                            <th tcg-field="kebakaran">Kebakaran</th>
                                            <th tcg-field="angin">Angin</th>
                                            <th tcg-field="longsor">Longsor</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-hujan" role="tabpanel" aria-labelledby="sda-hujan-tab">
                                <div class="table-responsive">
                                    <table id="thujan" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="suhu_min">Suhu Min (°C)</th>
                                            <th tcg-field="suhu_max">Suhu Max (°C)</th>
                                            <th tcg-field="kelembaban_udara">Kelembapan Udara</th>
                                            <th tcg-field="musim_hujan">Musim Hujan (Bulan/Th)</th>
                                            <th tcg-field="curah_hujan">Curah Hujan</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-tanah" role="tabpanel" aria-labelledby="sda-tanah-tab">
                                <div class="table-responsive">
                                    <table id="ttanah" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="jenis_tanah">Jenis Tanah</th>
                                            <th tcg-field="kemiringan">Kemiringan</th>
                                            <th tcg-field="pemanfaatan">Pemanfaatan</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-sumberair" role="tabpanel" aria-labelledby="sda-sumberair-tab">
                                <div class="table-responsive">
                                    <table id="tsumberair" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="jenis_sumberair">Sumber Air</th>
                                            <th tcg-field="debit_air">Debit Air</th>
                                            <th tcg-field="kondisi_air">Kondisi Air</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-sungai" role="tabpanel" aria-labelledby="sda-sungai-tab">
                                <div class="table-responsive">
                                    <table id="tsungai" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="nama_sungai">Nama Sungai</th>
                                            <th tcg-field="lebar">Lebar (m)</th>
                                            <th tcg-field="panjang">Panjang (Km)</th>
                                            <th tcg-field="sumber_sungai">Sumber Sungai</th>
                                            <th tcg-field="anak_sungai">Anak Sungai</th>
                                            <th tcg-field="pemanfaatan_sungai">Pemanfaatan</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-pulauterluar" role="tabpanel" aria-labelledby="sda-pulauterluar-tab">
                                <div class="table-responsive">
                                    <table id="tpulauterluar" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="nama_pulau">Nama Pulau</th>
                                            <th tcg-field="luas_pulau">Luas Pulau (Ha)</th>
                                            <th tcg-field="jumlah_penduduk">Jumlah Penduduk (orang)</th>
                                            <th tcg-field="jarak_pulau_utama">Jarak Pulau Utama (km)</th>
                                            <th tcg-field="transportasi">Transportasi</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sda-mangrove" role="tabpanel" aria-labelledby="sda-mangrove-tab">
                                <div class="table-responsive">
                                    <table id="tmangrove" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="jumlah">Jumlah</th>
                                            <th tcg-field="tgl_tanam">Tanggal Tanam</th>
                                            <th tcg-field="tgl_lapor">Tanggal Lapor</th>
                                            <th tcg-field="latitude">Latitude</th>
                                            <th tcg-field="longitude">Longitude</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>

    <div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card" style="overflow:auto;">
				<div class="card-header">
					<div class="card-title">Sumber Daya Alam Buatan - <?= $kbn->nama; ?></div>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
                    <div class="myTab">
                        <ul class="nav nav-tabs nav-justified m-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="sdab-perkebunan-tab" data-toggle="tab" href="#sdab-perkebunan" role="tab" aria-controls="sdab-perkebunan" aria-selected="false">Perkebunan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sdab-pertanian-tab" data-toggle="tab" href="#sdab-pertanian" role="tab" aria-controls="sdab-pertanian" aria-selected="true">Pertanian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sdab-peternakan-tab" data-toggle="tab" href="#sdab-peternakan" role="tab" aria-controls="sdab-peternakan" aria-selected="true">Peternakan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sdab-pertambangan-tab" data-toggle="tab" href="#sdab-pertambangan" role="tab" aria-controls="sdab-pertambangan" aria-selected="true">Pertambangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sdab-budidayaikan-tab" data-toggle="tab" href="#sdab-budidayaikan" role="tab" aria-controls="sdab-budidayaikan" aria-selected="true">Pembudidayaan Ikan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sdab-kerambajaring-tab" data-toggle="tab" href="#sdab-kerambajaring" role="tab" aria-controls="sdab-kerambajaring" aria-selected="true">Keramba Jaring Apung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sdab-konservasi-tab" data-toggle="tab" href="#sdab-konservasi" role="tab" aria-controls="sdab-konservasi" aria-selected="true">Konservasi Lingkungan Hidup</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sdab-sumberlistrik-tab" data-toggle="tab" href="#sdab-sumberlistrik" role="tab" aria-controls="sdab-sumberlistrik" aria-selected="true">Sumber Listrik</a>
                            </li>
                        </ul>
                        <div class="tab-content  p-3 border" id="myTabContent">
							<div class="tab-pane fade p-0 active show" id="sdab-perkebunan" role="tabpanel" aria-labelledby="sdab-perkebunan-tab">
                                <div class="table-responsive">
                                    <table id="tperkebunan" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="komoditas">Jenis Tanaman</th>
                                            <th tcg-field="luas">Luas (Ha)</th>
                                            <th tcg-field="tonase_hasil">Tonase Hasil</th>
                                            <th tcg-field="masa_panen">Masa Panen</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sdab-pertanian" role="tabpanel" aria-labelledby="sdab-pertanian-tab">
                                <div class="table-responsive">
                                    <table id="tpertanian" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="komoditas">Jenis Tanaman</th>
                                            <th tcg-field="luas">Luas (Ha)</th>
                                            <th tcg-field="tonase_hasil">Tonase Hasil</th>
                                            <th tcg-field="masa_panen">Masa Panen</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sdab-peternakan" role="tabpanel" aria-labelledby="sdab-peternakan-tab">
                                <div class="table-responsive">
                                    <table id="tpeternakan" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="komoditas">Jenis Hewan</th>
                                            <th tcg-field="luas">Luas Daerah (Ha)</th>
                                            <th tcg-field="tonase_hasil">Tonase Hasil (Ton)</th>
                                            <th tcg-field="masa_panen">Masa Panen</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sdab-pertambangan" role="tabpanel" aria-labelledby="sdab-pertambangan-tab">
                                <div class="table-responsive">
                                    <table id="tpertambangan" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="jenis_bahantambang">Jenis Bahan Tambang</th>
                                            <th tcg-field="tehnik_penambangan">Teknik Penambangan</th>
                                            <th tcg-field="penggunaan">Penggunaan</th>
                                            <th tcg-field="jumlah_tenaga_kerja">Jumlah Tenaga Kerja</th>
                                            <th tcg-field="luas_tambang">Luas Tambang (Ha)</th> <!--tambahan-->
                                            <th tcg-field="tonase_hasil">Tonase Hasil (Ton)</th><!--tambahan-->
                                            <th tcg-field="pemilik">Pemilik</th><!--tambahan-->
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sdab-budidayaikan" role="tabpanel" aria-labelledby="sdab-budidayaikan-tab">
                                <div class="table-responsive">
                                    <table id="tbudidayaikan" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="jenis_ikan">Jenis Ikan</th>
                                            <th tcg-field="luas">Luas Tambak (Ha)</th>
                                            <th tcg-field="tonase_hasil">Tonase Hasil (Ton)</th>
                                            <th tcg-field="masa_panen">Masa Panen</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sdab-kerambajaring" role="tabpanel" aria-labelledby="sdab-kerambajaring-tab">
                                <div class="table-responsive">
                                    <table id="tkerambajaring" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="jenis_ikan">Jenis Ikan</th>
                                            <th tcg-field="tonase">Tonase (Ton)</th>
                                            <th tcg-field="penghasilan">Penghasilan (Rp)</th>
                                            <th tcg-field="luas">Luas (Ha)</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sdab-konservasi" role="tabpanel" aria-labelledby="sdab-konservasi-tab">
                                <div class="table-responsive">
                                    <table id="tkonservasi" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="jenis_konservasi">Jenis yg Dikonservasikan</th>
                                            <th tcg-field="penganggung_jawab">Penanggung Jawab</th>
                                            <th tcg-field="luas">Luas (Ha)</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
							<div class="tab-pane fade p-0" id="sdab-sumberlistrik" role="tabpanel" aria-labelledby="sdab-sumberlistrik-tab">
                                <div class="table-responsive">
                                    <table id="tsumberlistrik" style="table-layout: auto; width: 100%;" class="table table-striped table-bordered key-buttons text-nowrap lowercaseCaption_DT">
                                        <thead>
                                            <th>No</th>
                                            <th tcg-field="sumber_listrik">Sumber Listrik</th>
                                            <th tcg-field="energi_dihasilkan">Energi Yg Dihasilkan (Kw)</th>
                                            <th tcg-field="luas_cakupan">Luas Cakupan</th>
                                            <th tcg-field="keterangan">Ket</th>
                                            <th>Updated By</th>
                                            <th>Last Updated</th>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>

    <div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card overflow-hidden">
				<div class="card-header">
					<h3 class="card-title">Kegiatan - <?= $kbn->nama; ?></h3>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
								class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
                <div class="myTab">
                        <ul class="nav nav-tabs nav-justified m-0" id="myTab" role="tablist">
                            <?php if (str_contains($kbn->klaster, 'edukasi')) { ?>
                            <li class="nav-item">
                                <a class="nav-link active show" id="klaster-edukasi-tab" data-toggle="tab" href="#klaster-edukasi" role="tab" aria-controls="klaster-edukasi" aria-selected="false">Klaster Edukasi</a>
                            </li>
                            <?php } ?>
                            <?php if (str_contains($kbn->klaster, 'ekonomi')) { ?>
                            <li class="nav-item">
                                <a class="nav-link" id="klaster-ekonomi-tab" data-toggle="tab" href="#klaster-ekonomi" role="tab" aria-controls="klaster-ekonomi" aria-selected="true">Klaster Ekonomi</a>
                            </li>
                            <?php } ?>
                            <?php if (str_contains($kbn->klaster, 'kesehatan')) { ?>
                            <li class="nav-item">
                                <a class="nav-link" id="klaster-kesehatan-tab" data-toggle="tab" href="#klaster-kesehatan" role="tab" aria-controls="klaster-kesehatan" aria-selected="true">Klaster Kesehatan</a>
                            </li>
                            <?php } ?>
                            <?php if (str_contains($kbn->klaster, 'pariwisata')) { ?>
                            <li class="nav-item">
                                <a class="nav-link" id="klaster-pariwisata-tab" data-toggle="tab" href="#klaster-pariwisata" role="tab" aria-controls="klaster-pariwisata" aria-selected="true">Klaster Pariwisata</a>
                            </li>
                            <?php } ?>
                            <?php if (str_contains($kbn->klaster, 'pertahanan')) { ?>
                            <li class="nav-item">
                                <a class="nav-link" id="klaster-pertahanan-tab" data-toggle="tab" href="#klaster-pertahanan" role="tab" aria-controls="klaster-pertahanan" aria-selected="true">Klaster Pertahanan</a>
                            </li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content  p-3 border" id="myTabContent">
                            <?php if (str_contains($kbn->klaster, 'edukasi')) { ?>
							<div class="tab-pane fade p-0 active show" id="klaster-edukasi" role="tabpanel" aria-labelledby="klaster-edukasi-tab">
                                <div class="latest-timeline-1 activity-scroll" id="activities-edukasi">
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (str_contains($kbn->klaster, 'ekonomi')) { ?>
							<div class="tab-pane fade p-0" id="klaster-ekonomi" role="tabpanel" aria-labelledby="klaster-ekonomi-tab">
                               <div class="latest-timeline-1 activity-scroll" id="activities-ekonomi">
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (str_contains($kbn->klaster, 'kesehatan')) { ?>
							<div class="tab-pane fade p-0" id="klaster-kesehatan" role="tabpanel" aria-labelledby="klaster-kesehatan-tab">
                               <div class="latest-timeline-1 activity-scroll" id="activities-kesehatan">
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (str_contains($kbn->klaster, 'pariwisata')) { ?>
							<div class="tab-pane fade p-0" id="klaster-pariwisata" role="tabpanel" aria-labelledby="klaster-pariwisata-tab">
                                <div class="latest-timeline-1 activity-scroll" id="activities-pariwisata">
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (str_contains($kbn->klaster, 'pertahanan')) { ?>
							<div class="tab-pane fade p-0" id="klaster-pertahanan" role="tabpanel" aria-labelledby="klaster-pertahanan-tab">
                                <div class="latest-timeline-1 activity-scroll" id="activities-pertahanan">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
				</div>
			</div>
			<?php echo $this->pagination->create_links(); ?>
		</div>
    </div>
	<!-- row closed -->
</div>

<!-- Tambah Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 800px; max-width: 800px;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form class="form-horizontal" method="POST" id="editForm" tcg-mode="edit">
                <input type="hidden" name="csrf_al" value="<?= $this->security->get_csrf_hash();?>" tcg-type='input'>
                <input type="hidden" name="id_sakabahari" value="<?= $bahari->id_sakabahari; ?>" tcg-type='input'>
                <input type="hidden" name="id_anggota" value="" tcg-type='input'>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12" tcg-allow-edit=1 tcg-allow-add=1>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="nama">Nama</label>
								<div class="col-md-9">
									<input type="text" id="nama" name="nama" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-nama"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="tgl_lahir">Tanggal Lahir</label>
								<div class="col-md-9">
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-tgl_lahir"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
								<div class="col-md-9">
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" style="width: 100%;" tcg-type='input'>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
									<div class="invalid-feedback warning-jenis_kelamin"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="no_hp">Nomor HP</label>
								<div class="col-md-9">
									<input type="text" id="no_hp" name="no_hp" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-no_hp"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="email">Email</label>
								<div class="col-md-9">
									<input type="text" id="email" name="email" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-email"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="alamat">Alamat</label>
								<div class="col-md-9">
									<input type="text" id="alamat" name="alamat" class="form-control" tcg-type='input'>
									<div class="invalid-feedback warning-alamat"></div>
								</div>
							</div>
							<div class="form-group row" tcg-allow-edit=1 tcg-allow-add=1>
								<label class="col-md-3 col-form-label" for="foto">Foto</label>
								<div class="col-md-9">
                                    <input type="file" class="dropify" id="foto" name="foto">
									<div class="invalid-feedback warning-foto"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary btn-save-anggota">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Hapus Data-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form id="deleteForm" method="POST" action="">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash();?>">
			<input type="hidden" name="id" value="">
				<div class="modal-body" style="height: auto;">
					<span id="delete-modal-content"></span>
				</div>
				<div class="modal-footer">
					<button class="btn" type="button" data-dismiss="modal">Batal</button>
					<button class="btn btn-danger" type="submit">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<script async="false" src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLEMAP_KEY ?>&callback=initMap&libraries=places"></script>

<script type="text/javascript">
	$(function (e) {

		'use strict'
		var dynamicColors = function () {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		}

		// $("#years").change(function() {
		// 	var id= $(this).val();
		// 	getDataPelaporanBarChart(id);
		// });

		//getMainActitivies();

        <?php if (str_contains($kbn->klaster, 'edukasi')) { ?>
        getActitivies('edukasi', $('#activities-edukasi'));
        <?php } ?>
        <?php if (str_contains($kbn->klaster, 'ekonomi')) { ?>
        getActitivies('ekonomi', $('#activities-ekonomi'));
        <?php } ?>
        <?php if (str_contains($kbn->klaster, 'kesehatan')) { ?>
        getActitivies('kesehatan', $('#activities-kesehatan'));
        <?php } ?>
        <?php if (str_contains($kbn->klaster, 'pariwisata')) { ?>
        getActitivies('pariwisata', $('#activities-pariwisata'));
        <?php } ?>
        <?php if (str_contains($kbn->klaster, 'pertahanan')) { ?>
        getActitivies('pertahanan', $('#activities-pertahanan'));
        <?php } ?>

	});


	function getActitivies(klaster, dom){
		$.ajax({
			url   : "<?= site_url()?>api/getKbnActivityByKbn/" +klaster+ "/<?= $kbn->id_kbn; ?>",
			type  : 'GET',
			async : true,
			dataType : 'json',
			success : function(data){
				//console.log(data);
				var html = '';
				var count = 1;
				var i;
				if (data.length == 0) {
					html = '<div class="wrapper w-100 text-center"><h2 class="text-muted">Data Laporan Belum Tersedia</h2></div>'
				}else{
					for(i=0; i<data.length; i++){

						if(data[i].flag_location == "prov")
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
						else if(data[i].flag_location == "kab")
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
						else if(data[i].flag_location == "kec")
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].KECAMATAN+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
						else if(data[i].flag_location == "kel")
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].KELURAHAN+', '+data[i].KECAMATAN+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
						else
						{
							html += '<ul class="timeline-1 mb-0">'+
									'<li class="mt-0">'+
										'<i class="fa fa-angle-right bg-primary text-white product-icon primary-dropshadow"></i>'+
										'<span class="font-weight-semibold mb-4 fs-15">'+data[i].nama_satker+'</span>'+
										'<a class="float-right fs-12 text-muted">Pada tanggal '+moment(data[i].created_date).format('DD MMMM YYYY')+'</a>'+
										'<p class="mb-0 mt-2 text-muted">'+
										'<span class="text-primary font-weight-semibold">'+data[i].nama_pegawai+'</span> melaporkan '+
										'<a href="<?= site_url() ?>data_pelaporan/'+data[i].id_activity_sosial+'/show" class="text-info font-weight-semibold">'+data[i].what+'</a> di '+data[i].where+', '+data[i].KELURAHAN+', '+data[i].KECAMATAN+', '+data[i].KABUPATEN+', '+data[i].PROVINSI+' </p>'+
										'<div class="mt-2">'+
											'<span class="badge badge-success-light">'+data[i].nama_jenis+'</span>'+
											'<div class="text-right">'+
												'<small class="text-muted ml-auto badge badge-light">'+moment(data[i].created_date).fromNow()+'</small>'+
											'</div>'+
										'</div>'+
									'</li>'+
								'</ul>';
						}
					}
				}
				dom.html(html);
			}
	
		});
	}
	
</script>

<script>
    var profil = null;
    var dt_sda = {};
    var dt_sdab = {};

    var tab_sda = [ 'pantai', 'hutan', 'gunung', 'kerawanan', 'hujan', 'tanah', 'sumberair', 'sungai', 'pulauterluar', 'mangrove' ];
    var tab_sdab = [ 'perkebunan', 'pertanian', 'peternakan', 'pertambangan', 'budidayaikan', 'kerambajaring', 'konservasi', 'sumberlistrik' ];

	$(document).ready(function () {
		$("#editModal select").select2({
			dropdownParent: $('#editModal')
		});

		$('input').on('keyup change', function () {
			var name = $(this).attr('name')
			$('input[name="' + name + '"]').removeClass('is-invalid')
			$('.warning-' + name).html('')
		});

		$('select').on('change', function () {
			var name = $(this).attr('name')
			$('.warning-' + name).html('')
		});

		$('#editForm').submit(function (e) {
            e.preventDefault();

            simpanAnggota();
		});

		$('#deleteForm').submit(function (e) {
            e.preventDefault();

            hapusAnggota();
		});

		$('.modal').on('hidden.bs.modal', function (e) {
            let modal = $(this);
            let frm = modal.find("#editForm");

			$('select').find('option:selected').removeAttr('selected');
			$('input').val('');
            $('#foto').val(null);

            <?php if(policy('SAKA','read')): ?>
			$('select[name=satkerPicked] option[value="<?= $this->session->userdata('id_satker') ?>"]').attr('selected','selected');
			$('input[name="satker"]').val("<?= $this->session->userdata('id_satker') ?>")
			<?php endif ?>

			$('input[name="csrf_al"]').val("<?= $this->security->get_csrf_hash() ?>")
		});

        tab_sda.forEach(function(sda) {
            let columns = [];
            columns.push({
                    data: null,
                    className: "text-right",
                    orderable: 'false',
                    defaultContent: "",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                });

            let tbl = $('#t' +sda);
            let fields = tbl.find("th[tcg-field]");
            fields.each(function(dom) {
                let field = $(dom).attr("tcg-field"); 
                columns.push(
                    {
                        data: field,
                        className: "text-center",
                        orderable: 'true',
                    }
                );
            });

            columns.push(
                {
                    data: "updated_by",
                    className: "text-center",
                    orderable: 'true',
                }
            );

            columns.push(
                {
                    data: "updated_date",
                    className: "text-center",
                    orderable: 'true',
                }
            );

            let ajax = "<?php echo site_url() ?>kbn/sda/" +sda+ "/<?= $kbn->id_kbn; ?>";

            let dt = $('#t' +sda).DataTable( {
                lengthChange: false,
                "ajax": ajax,
                "columns": columns
            });

            // let buttons2 = new $.fn.dataTable.Buttons( dt, {
            //     buttons: [
            //         {
            //             extend: 'copy',
            //             exportOptions: {
            //                 columns: ':visible'
            //             }
            //         },
            //         {
            //             extend: 'excel',
            //             exportOptions: {
            //                 columns: ':visible'
            //             }
            //         },
            //         'colvis'
            //     ]
            // });    

            // buttons2.container()
            //     .appendTo( '#t' +sda+ '_wrapper .col-md-6:eq(0)' );  
                
            dt.on('order.dt search.dt', function () {
                let i = 1;

                dt.cells(null, 1, { search: 'applied', order: 'applied' })
                .every(function (cell) {
                    this.data(i++);
                });
            })
            .draw();

            dt_sda[sda] = dt;
        });


        tab_sdab.forEach(function(sda) {
            let columns = [];
            columns.push({
                    data: null,
                    className: "text-right",
                    orderable: 'false',
                    defaultContent: "",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                });

            let tbl = $('#t' +sda);
            let fields = tbl.find("th[tcg-field]");
            fields.each(function(dom) {
                let field = $(dom).attr("tcg-field"); 
                columns.push(
                    {
                        data: field,
                        className: "text-center",
                        orderable: 'true',
                    }
                );
            });

            columns.push(
                {
                    data: "updated_by",
                    className: "text-center",
                    orderable: 'true',
                }
            );

            columns.push(
                {
                    data: "updated_date",
                    className: "text-center",
                    orderable: 'true',
                }
            );

            let ajax = "<?php echo site_url() ?>kbn/sdab/" +sda+ "/<?= $kbn->id_kbn; ?>";

            let dt = $('#t' +sda).DataTable( {
                lengthChange: false,
                "ajax": ajax,
                "columns": columns
            });

            // let buttons2 = new $.fn.dataTable.Buttons( dt, {
            //     buttons: [
            //         {
            //             extend: 'copy',
            //             exportOptions: {
            //                 columns: ':visible'
            //             }
            //         },
            //         {
            //             extend: 'excel',
            //             exportOptions: {
            //                 columns: ':visible'
            //             }
            //         },
            //         'colvis'
            //     ]
            // });    

            // buttons2.container()
            //     .appendTo( '#t' +sda+ '_wrapper .col-md-6:eq(0)' );  
                
            dt.on('order.dt search.dt', function () {
                let i = 1;

                dt.cells(null, 1, { search: 'applied', order: 'applied' })
                .every(function (cell) {
                    this.data(i++);
                });
            })
            .draw();

            dt_sdab[sda] = dt;
        });
        
        //create tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

	});

    function simpanAnggota() {
        let mode = $('#editForm').attr("tcg-mode");
        if (mode == null) {
            mode == 'edit';
        }

        let url = "<?= site_url() ?>sakabahari/anggota/update";
        if (mode == 'add') {
            url = "<?= site_url() ?>sakabahari/anggota/store";
        }

        frmData = new FormData();
        elements = $('#editForm').find("[tcg-type='input']");
        elements.each(function(idx, dom) {
            el = $(dom);
            field = el.attr('name');
            val = el.val();
            frmData.append(field, val);
        })

        fileInput = document.querySelector("#foto");
        if (fileInput.files.length > 0) {
            frmData.append('foto', fileInput.files[0]);
        }

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: frmData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000,
            success: function (data) {
                if (data[0].status == 0) {
                    $('input[name="csrf_al"]').val(data[0].csrf)
                    $.each(data[1], function (key, value) {
                        if (value != null && value != '') {
                            $('input[name="' + key + '"]').addClass('is-invalid')
                            $('.warning-' + key).html(value)
                        }
                    });
                } else {
                    dt.ajax.reload();
                    toastr.success("Data berhasil disimpan");
                    $('#editModal').modal('hide');
                }
            },
            error: function (data) {
                console.log(data);
                toastr.error("TIDAK berhasil menyimpan data");
                $('#editModal').modal('hide');
            }
        });
        return false;

    }

    function hapusAnggota() {
        let url = $('#deleteForm').attr('action');

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000,
            success: function (data) {
                if (data[0].status == 0) {
                    toastr.error("TIDAK berhasil menghapus data anggota");
                } else {
                   toastr.success("Berhasil menghapus data anggota");
                   dt.ajax.reload();
                }
                $('#deleteModal').modal('hide');
            },
            error: function (data) {
                console.log(data);
                toastr.error("TIDAK berhasil menghapus data anggota");
                $('#deleteModal').modal('hide');
            }
        });
        return false;

    }

    function showAddModal() {
        $('#editModal').modal();

        $("#editForm").find("[tcg-allow-add=1]").show();
        $("#editForm").find("[tcg-allow-add=0]").hide();
        $('#editForm').attr('tcg-mode', 'add');

        $('#editModal').find(".modal-title").html("Tambah Data");
        
        // Reset current preview
        var dropify = $("#foto").data('dropify');
        dropify.resetPreview();
        dropify.clearElement();
    }

	function showEditModal(id) {
		$('#editModal').modal();

        $("#editForm").find("[tcg-allow-edit=1]").show();
        $("#editForm").find("[tcg-allow-edit=0]").hide();
        $('#editForm').attr('tcg-mode', 'edit');

        $('#editModal').find(".modal-title").html("Edit Data");

		$.ajax({
			type: 'ajax',
			method: 'GET',
			url: '<?= site_url() ?>sakabahari/anggota/' + id,
			data: {
				id: id
			},
			dataType: 'json',
			success: function (data) {
                //profil = data.anggota;

                elements = $('#editForm').find("[tcg-type='input']");
                elements.each(function(idx) {
                    el = $(this);
                    field = el.attr('name');
                    val = data.anggota[field];
                    el.val(val);
                    el.attr("defaultValue",val);
                })

                val = data.anggota['jenis_kelamin'];
                $("#jenis_kelamin").val(val).trigger("change");

                //dropify
                if (data.anggota["foto"] != null && data.anggota["foto"] != '') {
                    let img = "<?= site_url() ?>" +data.anggota["foto"];

                    // Get dropify instance
                    var dropify = $("#foto").data('dropify');

                    // Reset current preview
                    dropify.resetPreview();
                    dropify.clearElement();

                    // Set new default file and re-init the dropify element
                    dropify.settings.defaultFile = img;
                    dropify.destroy();
                    dropify.init();
                }

			},
			error: function (data) {
				console.log(data);
			}
		});
	}

	function showDeleteModal(id, content) {
		$('input[name="id"]').val(id);
		$('#delete-modal-content').html('Anda akan menghapus data <b>"' + content + '"</b>');
		$('#deleteForm').attr('action', '<?= site_url() ?>sakabahari/anggota/' + id + '/delete');
		$('#deleteModal').modal();
	}
</script>
