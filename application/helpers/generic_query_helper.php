<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function satker_id_by_parent($parent_satker){
    return "
    WITH RECURSIVE org_satker_path (id_satker, nama_satker, id_level, path, top_id_satker) AS
    (
      SELECT 
          id_satker, nama_satker, id_level, nama_satker as path, id_satker as top_id_satker
      FROM 
          org_satker
      WHERE 
          is_active = 1 and
          id_parent_satker = $parent_satker
      UNION ALL
      SELECT 
          c.id_satker, c.nama_satker, c.id_level, CONCAT(cp.path, ' > ', c.nama_satker), cp.top_id_satker
      FROM 
          org_satker_path AS cp 
          JOIN org_satker AS c ON cp.id_satker = c.id_parent_satker
      WHERE 
          is_active = 1 
    )
    SELECT id_satker FROM org_satker_path
    union all
    select $parent_satker     
    ";
}

function satker_tree_table() {
    return "
    select 
        `kotama`.`id_satker`, kotama.nama_satker, kotama.latitude, kotama.longitude, 
        kotama.nama_pimpinan, kotama.order_satker,
        kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,  
        null as id_lantamal, null as nama_lantamal, null as order_lantamal,
        null as id_lanal, null as nama_lanal,
        1 as level
    from 
        org_satker as kotama
    where
        kotama.id_level=1 and kotama.is_active = 1 
    union all
    select 
        lantamal.id_satker, lantamal.nama_satker, lantamal.latitude, lantamal.longitude, 
        lantamal.nama_pimpinan, lantamal.order_satker,
        kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,
        lantamal.id_satker id_lantamal, lantamal.nama_satker nama_lantamal, lantamal.order_satker order_lantamal,
        null id_lanal, null nama_lanal,
        2 as level
    from 
        org_satker as kotama
        inner join org_satker as lantamal on lantamal.id_parent_satker =kotama.id_satker
    where
        kotama.id_level = 1 and lantamal.is_active = 1 
    union all	
    select 
        lanal.id_satker, lanal.nama_satker, lanal.latitude, lanal.longitude, 
        lanal.nama_pimpinan, lanal.order_satker,
        kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,
        lantamal.id_satker id_lantamal, lantamal.nama_satker nama_lantamal, lantamal.order_satker order_lantamal,
        lanal.id_satker id_lanal, lanal.nama_satker nama_lanal,
        3 as level
    from 
        org_satker as kotama
        inner join org_satker as lantamal on lantamal.id_parent_satker =kotama.id_satker
        inner join org_satker as lanal on lanal.id_parent_satker =lantamal.id_satker 
    where
        kotama.id_level = 1 and lanal.is_active = 1 	
    ";
}

function satker_tree_geo_table()
{
    $sql = "
        select
            satker.*, geografi.nama as geo_nama, geografi.geo_path 
        from 
            (
                select 
                    `kotama`.`id_satker`, kotama.nama_satker, kotama.latitude, kotama.longitude, kotama.id_geografi, kotama.nama_pimpinan, 
                    kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,
                    null as id_lantamal, null as nama_lantamal,
                    null as id_lanal, null as nama_lanal,
                    1 as level
                from 
                    org_satker as kotama
                where
                    kotama.id_level=1 and kotama.is_active = 1 
                union all
                select 
                    lantamal.id_satker, lantamal.nama_satker, lantamal.latitude, lantamal.longitude, lantamal.id_geografi, lantamal.nama_pimpinan,
                    kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,
                    lantamal.id_satker id_lantamal, lantamal.nama_satker nama_lantamal,
                    null id_lanal, null nama_lanal,
                    2 as level
                from 
                    org_satker as kotama
                    inner join org_satker as lantamal on lantamal.id_parent_satker =kotama.id_satker
                where
                    kotama.id_level = 1 and lantamal.is_active = 1 
                union all	
                select 
                    lanal.id_satker, lanal.nama_satker, lanal.latitude, lanal.longitude, lanal.id_geografi, lanal.nama_pimpinan,
                    kotama.id_satker id_kotama, kotama.nama_satker nama_kotama,
                    lantamal.id_satker id_lantamal, lantamal.nama_satker nama_lantamal,
                    lanal.id_satker id_lanal, lanal.nama_satker nama_lanal,
                    3 as level
                from 
                    org_satker as kotama
                    inner join org_satker as lantamal on lantamal.id_parent_satker =kotama.id_satker
                    inner join org_satker as lanal on lanal.id_parent_satker =lantamal.id_satker 
                where
                    kotama.id_level = 1 and lanal.is_active = 1 	
            ) satker
            left join 
            (	
                SELECT 
                    a.id_geografi, a.nama, a.level_geografi
                    , case when a.level_geografi=1 then a.nama 
                        when a.level_geografi=2 then concat(a.nama, ', ', p1.nama)
                        when a.level_geografi=3 then concat(a.nama, ', ', p1.nama, ', ', p2.nama)
                        when a.level_geografi=4 then concat(a.nama, ', ', p1.nama, ', ', p2.nama, ', ', p3.nama)
                        end as geo_path
                    , case when a.level_geografi=1 then a.id_geografi 
                        when a.level_geografi=2 then p1.id_geografi
                        when a.level_geografi=3 then p2.id_geografi
                        when a.level_geografi=4 then p3.id_geografi
                        end as id_prov 
                FROM 
                    org_geografi a
                    left join org_geografi p1 on p1.id_geografi=a.id_geografi_parent and p1.is_active=1
                    left join org_geografi p2 on p2.id_geografi=p1.id_geografi_parent and p2.is_active=1
                    left join org_geografi p3 on p3.id_geografi=p2.id_geografi_parent and p3.is_active=1
                where 
                    a.is_active=1
            ) geografi on satker.id_geografi = geografi.id_geografi 	
    ";
    return $sql;
}

function getGeodemokonsosConfigName($tableName)
{
    $configs = getGeodemokonsosConfigs();
    if ( array_key_exists($tableName, $configs)  ) {
        return $configs[$tableName]['title'];
    } else {
        return $tableName;
    }
}

function getGeodemokonsosConfigs(){

    $geo_pantai = [
        'title' => "Pantai",
        'tableName' => 'geo_pantai',
        'tableAlias' => 'pantai',
        'columns' => [
            "nama_satker" => "Satker", 
            "wilayah" => "Wilayah", 
            "nama_pantai" => "Nama Pantai", 
            "jenis_pantai" => "Jenis Pantai", 
            "panjang_pantai" => "Panjang Pantai (Km)", 
            "material_dasar_pantai" => "Material Dasar Pantai", 
            "ciri_khusus" => "Ciri Khusus", 
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select 
                pantai.*, satker.nama_satker, geografi.nama as wilayah, geografi.*, jenis_pantai.nama AS jenis_pantai
            from 
                geo_pantai pantai
                inner join org_satker satker on satker.id_satker = pantai.id_satker
                inner join mst_jenis_pantai jenis_pantai on jenis_pantai.id_jenis_pantai = pantai.id_jenis_pantai 
                inner join org_geografi geografi on geografi.id_geografi = pantai.id_geografi
            "
    ];

    $geo_hutan = [
        'title' => "Hutan",
        'tableName' => 'geo_hutan',
        'tableAlias' => 'hutan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah", 
            "jenis_tanaman" => "Jenis Tanaman", 
            "luas_hutan" => "Luas Hutan (Ha)", 
            "status_hutan" => "Status Hutan",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                hutan.*, satker.nama_satker, geografi.nama as wilayah, 
                geografi.*, jenis_tanaman.nama AS jenis_tanaman, status_hutan.nama AS status_hutan
            from
                geo_hutan AS hutan
                inner join org_satker AS satker on hutan.id_satker = satker.id_satker
                inner join mst_jenis_tanaman_hutan AS jenis_tanaman on hutan.id_jenis_tanaman_hutan = jenis_tanaman.id_jenis_tanaman_hutan
                inner join mst_status_hutan AS status_hutan on hutan.id_status_hutan = status_hutan.id_status_hutan
                inner join org_geografi AS geografi on hutan.id_geografi = geografi.id_geografi
            "
    ];

    $geo_gunung = [
        'title' => "Gunung",
        'tableName' => 'geo_gunung',
        'tableAlias' => 'gunung',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_gunung" => "Nama Gunung",
            "tinggi_gunung" => "Tinggi Gunung (Mdpl)",
            "status_gunung" => "Status",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                gunung.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, status_gunung.nama AS status_gunung
            from
                geo_gunung AS gunung
                inner join org_satker AS satker on gunung.id_satker = satker.id_satker
                inner join mst_status_gunung AS status_gunung on gunung.id_status_gunung = status_gunung.id_status_gunung
                inner join org_geografi AS geografi on gunung.id_geografi = geografi.id_geografi
            "
    ];
    
    $geo_kerawanan = [
        'title' => "Kerawanan",
        'tableName' => 'geo_kerawanan',
        'tableAlias' => 'kerawanan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "gempa_tektonik" => "Gempa Tektonik",
            "gempa_vulkanik" => "Gempa Vulkanik",
            "banjir" => "Banjir",
            "gunung_meletus" => "Gunung Meletus",
            "tsunami" => "Tsunami",
            "kebakaran" => "Kebakaran",
            "angin" => "Angin",
            "longsor" => "Longsor",
            "keterangan" => "Ket"				
        ],
        'sqlSelect' => "
            select
                kerawanan.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_kerawanan AS kerawanan
                inner join org_satker AS satker on kerawanan.id_satker = satker.id_satker
                inner join org_geografi AS geografi on kerawanan.id_geografi = geografi.id_geografi
            "
    ];

    $geo_curah_hujan = [
        'title' => "Curah Hujan",
        'tableName' => 'geo_curah_hujan',
        'tableAlias' => 'hujan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "suhu_min" => "Suhu Min (°C)",
            "suhu_max" => "Suhu Max (°C)",
            "kelembaban_udara" => "Kelembapan Udara",
            "musim_hujan" => "Musim Hujan (Bulan/Th)",
            "curah_hujan" => "Curah Hujan",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                hujan.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_curah_hujan AS hujan
                inner join org_satker AS satker on hujan.id_satker = satker.id_satker
                inner join org_geografi AS geografi on hujan.id_geografi = geografi.id_geografi
            "
    ];

    $geo_struktur_tanah = [
        'title' => "Struktur Tanah",
        'tableName' => 'geo_struktur_tanah',
        'tableAlias' => 'tanah',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_tanah" => "Jenis Tanah",
            "kemiringan" => "Kemiringan",
            "pemanfaatan" => "Pemanfaatan",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                tanah.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, jenis_tanah.nama AS jenis_tanah
            from
                geo_struktur_tanah AS tanah
                inner join org_satker AS satker on tanah.id_satker = satker.id_satker
                inner join mst_jenis_tanah AS jenis_tanah on tanah.id_jenis_tanah = jenis_tanah.id_jenis_tanah
                inner join org_geografi AS geografi on tanah.id_geografi = geografi.id_geografi
            "
    ];

    $geo_sumber_air = [
        'title' => "Sumber Air",
        'tableName' => 'geo_sumber_air',
        'tableAlias' => 'air',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_sumberair" => "Sumber Air",
            "debit_air" => "Debit Air",
            "kondisi_air" => "Kondisi Air",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                air.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, jenis_sumberair.nama AS jenis_sumberair
            from
                geo_sumber_air AS air
                inner join org_satker AS satker on air.id_satker = satker.id_satker
                inner join mst_jenis_sumberair AS jenis_sumberair on air.id_jenis_sumberair = jenis_sumberair.id_jenis_sumberair
                inner join org_geografi AS geografi on air.id_geografi = geografi.id_geografi
            "
    ];

    $geo_sungai = [
        'title' => "Sungai",
        'tableName' => 'geo_sungai',
        'tableAlias' => 'sungai',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_sungai" => "Nama Sungai",
            "lebar" => "Lebar (m)",
            "panjang" => "Panjang (Km)",
            "sumber_sungai" => "Sumber Sungai",
            "anak_sungai" => "Anak Sungai",
            "pemanfaatan_sungai" => "Pemanfaatan",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                sungai.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, pemanfaatan_sungai.nama AS pemanfaatan_sungai
            from
                geo_sungai AS sungai
                inner join org_satker AS satker on sungai.id_satker = satker.id_satker
                inner join mst_pemanfaatan_sungai AS pemanfaatan_sungai on sungai.id_pemanfaatan_sungai = pemanfaatan_sungai.id_pemanfaatan_sungai
                inner join org_geografi AS geografi on sungai.id_geografi = geografi.id_geografi
            "
    ];

    $geo_pulau_terluar = [
        'title' => "Pulau Terluar",
        'tableName' => 'geo_pulau_terluar',
        'tableAlias' => 'pulau',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_pulau" => "Nama Pulau",
            "luas_pulau" => "Luas Pulau (Ha)",
            "jumlah_penduduk" => "Jumlah Penduduk",
            "jarak_pulau_utama" => "Jarak Pulau Utama",
            "transportasi" => "Transportasi",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                pulau.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_pulau_terluar AS pulau
                inner join org_satker AS satker on pulau.id_satker = satker.id_satker
                inner join org_geografi AS geografi on pulau.id_geografi = geografi.id_geografi
            "
    ];

    $geo_perkebunan = [
        'title' => "Perkebunan",
        'tableName' => 'geo_perkebunan',
        'tableAlias' => 'perkebunan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_komoditas" => "Jenis Tanaman",
            "luas" => "Luas (Ha)",
            "tonase_hasil" => "Tonase Hasil",
            "masa_panen" => "Masa Panen",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                perkebunan.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, komoditas.nama_komoditas
            from
                geo_perkebunan AS perkebunan
                inner join org_satker AS satker on perkebunan.id_satker = satker.id_satker
                inner join mst_pangan_komoditas AS komoditas on perkebunan.id_komoditas = komoditas.id_komoditas
                inner join org_geografi AS geografi on perkebunan.id_geografi = geografi.id_geografi
            "
    ];

    $geo_pertanian = [
        'title' => "Pertanian",
        'tableName' => 'geo_pertanian',
        'tableAlias' => 'pertanian',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_komoditas" => "Jenis Tanaman",
            "luas" => "Luas",
            "tonase_hasil" => "Tonase Hasil",
            "masa_panen" => "Masa Panen",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                pertanian.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, komoditas.nama as nama_komoditas
            from
                geo_pertanian AS pertanian
                inner join org_satker AS satker on pertanian.id_satker = satker.id_satker
                inner join mst_jenis_tanaman AS komoditas on pertanian.id_komoditas = komoditas.id_jenis_tanaman
                inner join org_geografi AS geografi on pertanian.id_geografi = geografi.id_geografi
            "
    ];

    $geo_peternakan = [
        'title' => "Peternakan",
        'tableName' => 'geo_peternakan',
        'tableAlias' => 'peternakan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_komoditas" => "Jenis Hewan",
            "luas" => "Luas Daerah",
            "tonase_hasil" => "Tonase Hasil",
            "masa_panen" => "Masa Panen",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                peternakan.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, komoditas.nama_hewan as nama_komoditas
            from
                geo_peternakan AS peternakan
                inner join org_satker AS satker on peternakan.id_satker = satker.id_satker
                inner join mst_jenis_hewan AS komoditas on peternakan.id_komoditas = komoditas.id_jenis_hewan
                inner join org_geografi AS geografi on peternakan.id_geografi = geografi.id_geografi
            "
    ];

    $geo_pertambangan = [
        'title' => "Pertambangan",
        'tableName' => 'geo_pertambangan',
        'tableAlias' => 'pertambangan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_bahantambang" => "Jenis Bahan Tambang",
            "luas_tambang" => "Luas Tambang (Ha)",
            "tonase_hasil" => "Tonase Hasil",
            "pemilik" => "Pemilik",
            "teknik_penambangan" => "Teknik Penambangan",
            "penggunaan" => "Penggunaan",
            "jumlah_tenaga_kerja" => "Jumlah Tenaga Kerja",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                pertambangan.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, jenis_bahantambang.nama AS jenis_bahantambang
            from
                geo_pertambangan AS pertambangan
                inner join org_satker AS satker on pertambangan.id_satker = satker.id_satker
                inner join mst_jenis_bahantambang AS jenis_bahantambang on pertambangan.id_jenis_bahantambang = jenis_bahantambang.id_jenis_bahantambang
                inner join org_geografi AS geografi on pertambangan.id_geografi = geografi.id_geografi
            "
    ];

    $geo_budidaya_ikan = [
        'title' => "Ikan",
        'tableName' => 'geo_budidaya_ikan',
        'tableAlias' => 'ikan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_ikan" => "Jenis Ikan",
            "luas" => "Luas Tambak",
            "tonase_hasil" => "Tonase Hasil",
            "masa_panen" => "Masa Panen",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                ikan.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, jenis_ikan.nama AS jenis_ikan
            from
                geo_budidaya_ikan AS ikan
                inner join org_satker AS satker on ikan.id_satker = satker.id_satker
                inner join mst_jenis_ikan AS jenis_ikan on ikan.id_jenis_ikan = jenis_ikan.id_jenis_ikan
                inner join org_geografi AS geografi on ikan.id_geografi = geografi.id_geografi
            "
    ];

    $geo_keramba_jaring = [
        'title' => "Keramba Jaring",
        'tableName' => 'geo_keramba_jaring',
        'tableAlias' => 'keramba',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_ikan" => "Jenis Ikan",
            "luas" => "Luas (Ha)",
            "tonase" => "Tonase (Ton)",
            "penghasilan" => "Penghasilan (Rp)",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                keramba.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, jenis_ikan.nama AS jenis_ikan
            from
                geo_keramba_jaring AS keramba
                inner join org_satker AS satker on keramba.id_satker = satker.id_satker
                inner join mst_jenis_ikan AS jenis_ikan on keramba.id_jenis_ikan = jenis_ikan.id_jenis_ikan
                inner join org_geografi AS geografi on keramba.id_geografi = geografi.id_geografi
            "
    ];

    $geo_konservasi_lingkungan = [
        'title' => "Konservasi Lingkungan Hidup",
        'tableName' => 'geo_konservasi_lingkungan',
        'tableAlias' => 'konservasi',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_konservasi" => "Jenis yg Dikonservasikan",
            "penanggung_jawab" => "Penanggung Jawab",
            "luas" => "Luas (Ha)",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                konservasi.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, jenis_konservasi.nama AS jenis_konservasi
            from
                geo_konservasi_lingkungan AS konservasi
                inner join org_satker AS satker on konservasi.id_satker = satker.id_satker
                inner join mst_jenis_konservasi AS jenis_konservasi on konservasi.id_jenis_konservasi = jenis_konservasi.id_jenis_konservasi
                inner join org_geografi AS geografi on konservasi.id_geografi = geografi.id_geografi
            "
    ];

    $geo_listrik = [
        'title' => "Sumber Listrik",
        'tableName' => 'geo_listrik',
        'tableAlias' => 'listrik',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "sumber_listrik" => "Sumber Listrik",
            "energi_dihasilkan" => "Energi Yg Dihasilkan (Kw)",
            "luas_cakupan" => "Luas Cakupan",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                listrik.*, satker.nama_satker, geografi.nama as  wilayah,
                geografi.*, sumber_listrik.nama AS sumber_listrik
            from
                geo_listrik AS listrik
                inner join org_satker AS satker on listrik.id_satker = satker.id_satker
                inner join mst_sumber_listrik AS sumber_listrik on listrik.id_sumber_listrik = sumber_listrik.id_sumber_listrik
                inner join org_geografi AS geografi on listrik.id_geografi = geografi.id_geografi
            "
    ];

    $geo_pelabuhan_sungai = [
        'title' => "Pelabuhan Sungai",
        'tableName' => 'geo_pelabuhan_sungai',
        'tableAlias' => 'sungai',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_pelabuhan" => "Nama Pelabuhan",
            "nama_sungai" => "Nama Sungai",
            "jarak_dari_laut" => "Jarak Dari Laut (Km)",
            "pasang_tinggi" => "Pasang Tinggi (m)",
            "surut_rendah" => "Surut Rendah (m)",
            "draft_maks" => "Draft Maks (m)",
            "lebar_kapal_maks" => "Lebar Kapal Maks (m)",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                sungai.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_pelabuhan_sungai AS sungai
                inner join org_satker AS satker on sungai.id_satker = satker.id_satker
                inner join org_geografi AS geografi on sungai.id_geografi = geografi.id_geografi
            "
    ];

    $geo_pelabuhan_laut = [
        'title' => "Pelabuhan Laut",
        'tableName' => 'geo_pelabuhan_laut',
        'tableAlias' => 'laut',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_pelabuhan" => "Nama Pelabuhan",
            "informasi_umum" => "Informasi Umum",
            "hidrografi" => "Hidrografi",
            "topografi" => "Topografi",
            "pasang_surut" => "Pasang Surut",
            "arus" => "Arus"
        ],
        'sqlSelect' => "
            select
                laut.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_pelabuhan_laut AS laut
                inner join org_satker AS satker on laut.id_satker = satker.id_satker
                inner join org_geografi AS geografi on laut.id_geografi = geografi.id_geografi
            "
    ];

    $geo_pelabuhan_perikanan = [
        'title' => "Pelabuhan Ikan",
        'tableName' => 'geo_pelabuhan_perikanan',
        'tableAlias' => 'ikan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_pelabuhan" => "Nama Pelabuhan",
            "kelas_pelabuhanikan" => "Kelas Pelabuhan",
            "wpp" => "WPP",
            "status" => "Status",
            "pengelola" => "Pengelola",
            "fasilitas" => "Fasilitas",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                ikan.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, kelas_pelabuhanikan.nama AS kelas_pelabuhanikan, wpp.nama AS wpp
            from
                geo_pelabuhan_perikanan AS ikan
                inner join org_satker AS satker on ikan.id_satker = satker.id_satker
                inner join mst_kelas_pelabuhanikan AS kelas_pelabuhanikan on ikan.id_kelas_pelabuhanikan = kelas_pelabuhanikan.id_kelas_pelabuhanikan
                inner join mst_wpp AS wpp on ikan.id_wpp = wpp.id_wpp
                inner join org_geografi AS geografi on ikan.id_geografi = geografi.id_geografi		
            "
    ];
    
    $geo_sarpras_jalan = [
        'title' => "Sarana Prasarana Jalan",
        'tableName' => 'geo_sarpras_jalan',
        'tableAlias' => 'sarpras',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "kelas_admpemerintah" => "Klasifikasi Jalan Sesuai Administrasi Pemerintahan",
            "prosentase_pemerintah" => "%",
            "kelas_bebanmuatan" => "Klasifikasi Jalan Sesuai Beban Muatan Sumbu",
            "prosentase_beban_muatan" => "%",
            "keterangan" => "Ket"				
        ],
        'sqlSelect' => "
            select
                sarpras.*, satker.nama_satker, geografi.nama as wilayah, geografi.*,
                kelas_admpemerintah.nama AS kelas_admpemerintah, kelas_bebanmuatan.nama AS kelas_bebanmuatan
            from
                geo_sarpras_jalan AS sarpras
                inner join org_satker AS satker on sarpras.id_satker = satker.id_satker
                inner join mst_kelas_admpemerintah AS kelas_admpemerintah on sarpras.id_kelas_admpemerintah = kelas_admpemerintah.id_kelas_admpemerintah
                inner join mst_kelas_bebanmuatan AS kelas_bebanmuatan on sarpras.id_kelas_bebanmuatan = kelas_bebanmuatan.id_kelas_bebanmuatan
                inner join org_geografi AS geografi on sarpras.id_geografi = geografi.id_geografi	
            "
    ];

    $geo_galangan_kapal = [
        'title' => "Galangan Kapan",
        'tableName' => 'geo_galangan_kapal',
        'tableAlias' => 'kapal',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_galangan" => "Nama Galangan",
            "pemilik" => "Pemilik",
            "maks_gt" => "Maks GT",
            "status_kepemilikan" => "Status Kepemilikan",
            "fasilitas" => "Fasilitas",
            "keterangan" => "Ket"				
        ],
        'sqlSelect' => "
            select
                kapal.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_galangan_kapal AS kapal
                inner join org_satker AS satker on kapal.id_satker = satker.id_satker
                inner join org_geografi AS geografi on kapal.id_geografi = geografi.id_geografi	
            "
    ];

    $geo_industri_mesin = [
        'title' => "Industri Mesin",
        'tableName' => 'geo_industri_mesin',
        'tableAlias' => 'mesin',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_perusahaan" => "Nama Perusahaan",
            "hasil_produksi" => "Hasil Produksi",
            "besaran_produksi" => "Besaran Produksi / Bulan",
            "status_kepemilikan" => "Status Kepemilikan",
            "penggunaan_hasil_produksi" => "Penggunaan Hasil Produksi",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                mesin.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_industri_mesin AS mesin
                inner join org_satker AS satker on mesin.id_satker = satker.id_satker
                inner join org_geografi AS geografi on mesin.id_geografi = geografi.id_geografi	
            "
    ];

    $geo_pelayaran_rakyat = [
        'title' => "Angkatan Laut Nasional",
        'tableName' => 'geo_pelayaran_rakyat',
        'tableAlias' => 'pelayaran',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_perusahaan" => "Nama Perusahaan",
            "nama_kapal" => "Nama kapal",
            "gt_kapal" => "GT Kapal",
            "rute" => "Rute",
            "frekuensi_pelayaran" => "Frekuensi Pelayaran (Mil)",
            "maks_daya_angkut_orang" => "Maks Daya Angkut Orang",
            "maks_daya_angkut_transportasi" => "Maks Daya Angkut Transportasi",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                pelayaran.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_pelayaran_rakyat AS pelayaran
                inner join org_satker AS satker on pelayaran.id_satker = satker.id_satker
                inner join org_geografi AS geografi on pelayaran.id_geografi = geografi.id_geografi	
            "
    ];

    $geo_ship_handler = [
        'title' => "Ship Handler",
        'tableName' => 'geo_ship_handler',
        'tableAlias' => 'ship',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_perusahaan" => "Nama Perusahaan",
            "nama_kapal" => "Nama Kapal",
            "gt_kapal" => "GT Kapal",
            "fasilitas" => "Fasilitas",
            "alamat" => "Alamat",
            "pemilik" => "Pemilik",
            "data_pemilik" => "Data Pemilik",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                ship.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_ship_handler AS ship
                inner join org_satker AS satker on ship.id_satker = satker.id_satker
                inner join org_geografi AS geografi on ship.id_geografi = geografi.id_geografi
        "
    ];

    $geo_industri_perikanan = [
        'title' => "Industri Perikanan",
        'tableName' => 'geo_industri_perikanan',
        'tableAlias' => 'ikan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_perusahaan" => "Nama Perusahaan",
            "gt_kapal" => "GT Kapal",
            "jumlah_kapal" => "Jumlah Kapal",
            "alamat" => "Alamat",
            "pemilik" => "Pemilik",
            "data_pemilik" => "Data Pemilik",
            "hasil_produksi" => "Hasil Produksi (Ton)",
            "pemanfaatan" => "Pemanfaatan",
            "omzet" => "Omzet (Rp)",
            "keterangan" => "Ket"				
        ],
        'sqlSelect' => "
            select
                ikan.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                geo_industri_perikanan AS ikan
                inner join org_satker AS satker on ikan.id_satker = satker.id_satker
                inner join org_geografi AS geografi on ikan.id_geografi = geografi.id_geografi
        "
    ];

    $demo_jumlah_penduduk = [
        'title' => "Jumlah Penduduk",
        'tableName' => 'demo_jumlah_penduduk',
        'tableAlias' => 'penduduk',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jumlah_penduduk" => "Jumlah Penduduk (Orang)",
            "jumlah_pria" => "Pria",
            "jumlah_wanita" => "Wanita",
            "age0018" => "0-18 (Tahun)",
            "age1839" => "18-40 (Tahun)",
            "age4045" => "40-45 (Tahun)",
            "age55high" => "55 (Tahun)",
            "tahun" => "",
            "angka_kelahiran" => "Kelahiran",
            "angka_kematian" => "Kematian",
            "SMP" => "SMP",
            "SMA" => "SMA",
            "S1" => "S1",
            "S2" => "S1",
            "keterangan" => "Ket"				
        ],
        'sqlSelect' => "
            select
                penduduk.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                demo_jumlah_penduduk AS penduduk
                inner join org_satker AS satker on penduduk.id_satker = satker.id_satker
                inner join org_geografi AS geografi on penduduk.id_geografi = geografi.id_geografi
        "
    ];
    
    $demo_agama = [
        'title' => "Agama",
        'tableName' => 'demo_agama',
        'tableAlias' => 'agama',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "agama" => "Agama",
            "prosentase" => "%",
            "jumlah_tempat_ibadah" => "Jumlah Tempat Ibadah (Buah)",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
        select
            agama.*, satker.nama_satker, geografi.nama as wilayah,
            geografi.*, jenisAgama.nama AS agama
        from
            demo_agama AS agama
            inner join org_satker AS satker on agama.id_satker = satker.id_satker
            inner join mst_jenis_agama AS jenisAgama on agama.id_jenis_agama = jenisAgama.id_jenis_agama
            inner join org_geografi AS geografi on agama.id_geografi = geografi.id_geografi
        "
    ];

    $demo_suku_bangsa = [
        'title' => "Suku Bangsa",
        'tableName' => 'demo_suku_bangsa',
        'tableAlias' => 'suku',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_suku" => "Suku",
            "prosentase" => "Persentase (%)",
            "ciri_khas" => "Ciri Khas",
            "bahasa_adat" => "Bahasa Adat",
            "tertua_adat" => "Tertua Adat",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
        select
            suku.*, satker.nama_satker, geografi.nama as wilayah,
            geografi.*, bahasa_adat.nama AS bahasa_adat, jenis_suku.nama AS jenis_suku
        from
            demo_suku_bangsa AS suku
            inner join org_satker AS satker on suku.id_satker = satker.id_satker
            inner join mst_bahasa_adat AS bahasa_adat on suku.id_bahasa_adat = bahasa_adat.id_bahasa_adat
            inner join mst_jenis_suku AS jenis_suku on suku.id_jenis_suku = jenis_suku.id_jenis_suku
            inner join org_geografi AS geografi on suku.id_geografi = geografi.id_geografi
        "
    ];

    $demo_desa_pesisir = [
        'title' => "Desa Pesisir",
        'tableName' => 'demo_desa_pesisir',
        'tableAlias' => 'pesisir',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_desa" => "Nama Desa",
            "jumlah_penduduk" => "Jumlah Penduduk (Orang)",
            "tingkat_pendidikan" => "Tingkat Pendidikan",
            "nama_pembina" => "Nama Pembina",
            "nama_tertua_desa" => "Nama Tertua Desa",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                pesisir.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                demo_desa_pesisir AS pesisir
                inner join org_satker AS satker on pesisir.id_satker = satker.id_satker
                inner join org_geografi AS geografi on pesisir.id_geografi = geografi.id_geografi
        "
    ];

    $demo_saka_bahari = [
        'title' => "Saka Bahari",
        'tableName' => 'demo_saka_bahari',
        'tableAlias' => 'bahari',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "saka" => "Jenis Saka",
            "jumlah_saka" => "Jumlah Saka",
            "sekolah_terlibat" => "Sekolah yang Terlibat",
            "nama_pembina" => "Nama Pembina",
            "no_gugus_depan" => "Nomor Gugus Depan",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                bahari.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, saka.nama AS saka
            from
                demo_saka_bahari AS bahari
                inner join org_satker AS satker on bahari.id_satker = satker.id_satker
                inner join mst_jenis_saka AS saka on bahari.id_jenis_saka = saka.id_jenis_saka
                inner join org_geografi AS geografi on bahari.id_geografi = geografi.id_geografi
        "
    ];
    
    $demo_pekerjaan_masyarakat = [
        'title' => "Pekerjaan Masyarakat",
        'tableName' => 'demo_pekerjaan_masyarakat',
        'tableAlias' => 'pekerjaan',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "mayoritas1" => "Mayoritas 1",
            "mayoritas2" => "Mayoritas 2",
            "mayoritas3" => "Mayoritas 3",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                pekerjaan.*, pekerjaan.mayoritas1 AS id_mayoritas1, pekerjaan.mayoritas2 AS id_mayoritas2,
                pekerjaan.mayoritas3 AS id_mayoritas3, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, mayoritas1.nama AS mayoritas1,
                mayoritas2.nama AS mayoritas2, mayoritas3.nama AS mayoritas3
            from
                demo_pekerjaan_masyarakat AS pekerjaan
                inner join org_satker AS satker on pekerjaan.id_satker = satker.id_satker
                inner join mst_mayoritas_pekerjaan AS mayoritas1 on pekerjaan.mayoritas1 = mayoritas1.id_mayoritas_pekerjaan
                inner join mst_mayoritas_pekerjaan AS mayoritas2 on pekerjaan.mayoritas2 = mayoritas2.id_mayoritas_pekerjaan
                inner join mst_mayoritas_pekerjaan AS mayoritas3 on pekerjaan.mayoritas3 = mayoritas3.id_mayoritas_pekerjaan
                inner join org_geografi AS geografi on pekerjaan.id_geografi = geografi.id_geografi
        "
    ];

    $demo_sekolah_maritim = [
        'title' => "Sekolah Maritim",
        'tableName' => 'demo_sekolah_maritim',
        'tableAlias' => 'maritim',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_sekolah" => "Nama Perguruan Tinggi/SMA Sederajat",
            "jumlah_siswa" => "Jumlah Siswa",
            "jumlah_pengajar" => "Jumlah Pengajar",
            "kerjasama_instansi" => "Kerjasama Dengan Instansi",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                maritim.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                demo_sekolah_maritim AS maritim
                inner join org_satker AS satker on maritim.id_satker = satker.id_satker
                inner join org_geografi AS geografi on maritim.id_geografi = geografi.id_geografi
        "
    ];

    $demo_rumahsakit = [
        'title' => "Rumah Sakit",
        'tableName' => 'demo_rumahsakit',
        'tableAlias' => 'rumahsakit',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_rumahsakit" => "Nama RS",
            "jenis_rumahsakit" => "Jenis RS",
            "kelas_rumahsakit" => "Kelas RS",
            "id_penyelenggara_rumahsakit" => "Penyelenggara RS",
            "alamat_rumahsakit" => "Alamat RS",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                rumahsakit.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, jenis.nama AS jenis_rumahsakit, kelas.nama AS kelas_rumahsakit
            from
                demo_rumahsakit AS rumahsakit
                inner join org_satker AS satker on rumahsakit.id_satker = satker.id_satker
                inner join mst_jenis_rumahsakit AS jenis on rumahsakit.id_jenis_rumahsakit = jenis.id_jenis_rumahsakit
                inner join mst_kelas_rumahsakit AS kelas on rumahsakit.id_kelas_rumahsakit = kelas.id_kelas_rumahsakit
                inner join org_geografi AS geografi on rumahsakit.id_geografi = geografi.id_geografi
        "
    ];

    $konsos_tokoh_masyarakat = [
        'title' => "Tokoh Masyarakat",
        'tableName' => 'konsos_tokoh_masyarakat',
        'tableAlias' => 'tokoh',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "agama" => "Agama",
            "nama" => "Nama",
            "usia" => "Usia (Tahun)",
            "alamat" => "Alamat",
            "pekerjaan" => "Pekerjaan",
            "keterangan" => "Ket"				
        ],
        'sqlSelect' => "
            select
                tokoh.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, agama.nama AS agama
            from
                konsos_tokoh_masyarakat AS tokoh
                inner join org_satker AS satker on tokoh.id_satker = satker.id_satker
                inner join mst_jenis_agama AS agama on tokoh.id_jenis_agama = agama.id_jenis_agama
                inner join org_geografi AS geografi on tokoh.id_geografi = geografi.id_geografi		
        "
    ];

    $konsos_organisasi_agama = [
        'title' => "Organisasi Agama",
        'tableName' => 'konsos_organisasi_agama',
        'tableAlias' => 'agama',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "nama_organisasi" => "Nama Organisasi",
            "alamat_kantor_pusat" => "Alamat Kantor Pusat",
            "agama" => "Agama",
            "pemimpin" => "Pemimpin",
            "jumlah_anggota" => "Jumlah Anggota (Orang)",
            "keterangan" => "Ket"				
        ],
        'sqlSelect' => "
        select
            agama.*, satker.nama_satker, geografi.nama as wilayah,
            geografi.*, jenis_agama.nama AS agama
        from
            konsos_organisasi_agama AS agama
            inner join org_satker AS satker on agama.id_satker = satker.id_satker
            inner join mst_jenis_agama AS jenis_agama on agama.id_jenis_agama = jenis_agama.id_jenis_agama
            inner join org_geografi AS geografi on agama.id_geografi = geografi.id_geografi
        "
    ];

    $konsos_partai_politik = [
        'title' => "Partai Politik",
        'tableName' => 'konsos_partai_politik',
        'tableAlias' => 'parpol',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "partai" => "Partai",
            "prosentase" => "Prosentase (%)",
            "dominasi_wilayah" => "Dominasi Wilayah",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                parpol.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, partai.nama AS partai
            from
                konsos_partai_politik AS parpol
                inner join org_satker AS satker on parpol.id_satker = satker.id_satker
                inner join mst_partai AS partai on parpol.id_partai = partai.id_partai
                inner join org_geografi AS geografi on parpol.id_geografi = geografi.id_geografi
        "
    ];

    $konsos_umkm = [
        'title' => "Industri UMKM",
        'tableName' => 'konsos_umkm',
        'tableAlias' => 'umkm',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_industri" => "Jenis Industri",
            "penjualan" => "Penjualan",
            "jumlah_tenaga_kerja" => "Jumlah Tenaga Kerja (Orang)",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
        select
            umkm.*, satker.nama_satker,
            geografi.nama as wilayah, geografi.*
        from
            konsos_umkm AS umkm
            inner join org_satker AS satker on umkm.id_satker = satker.id_satker
            inner join org_geografi AS geografi on umkm.id_geografi = geografi.id_geografi		
        "
    ];

    $konsos_industri_menengah = [
        'title' => "Industri Menengah",
        'tableName' => 'konsos_industri_menengah',
        'tableAlias' => 'industri',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "jenis_industri" => "Jenis Industri",
            "sumber_bahan_baku" => "Sumber Bahan Baku",
            "penjualan" => "Penjualan",
            "jumlah_tenaga_kerja" => "Jumlah Tenaga Kerja (Orang)",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                industri.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                konsos_industri_menengah AS industri
                inner join org_satker AS satker on industri.id_satker = satker.id_satker
                inner join org_geografi AS geografi on industri.id_geografi = geografi.id_geografi
        "
    ];

    $konsos_objek_pariwisata = [
        'title' => "Objek Pariwisata",
        'tableName' => 'konsos_objek_pariwisata',
        'tableAlias' => 'pariwisata',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "objek_pariwisata" => "Objek Pariwisata",
            "alamat" => "Alamat",
            "Pengelola" => "Pengelola",
            "keterangan" => "Ket"				
        ],
        'sqlSelect' => "
            select
                pariwisata.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                konsos_objek_pariwisata AS pariwisata
                inner join org_satker AS satker on pariwisata.id_satker = satker.id_satker
                inner join org_geografi AS geografi on pariwisata.id_geografi = geografi.id_geografi
        "
    ];

    $konsos_peninggalan_sejarah = [
        'title' => "Peninggalan Sejarah",
        'tableName' => 'konsos_peninggalan_sejarah',
        'tableAlias' => 'sejarah',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "objek_sejarah" => "Objek Sejarah",
            "titik_kordinat" => "Titik Koordinat",
            "pengelola" => "Pengelola",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                sejarah.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, pengelola.nama AS pengelola
            from
                konsos_peninggalan_sejarah AS sejarah
                inner join org_satker AS satker on sejarah.id_satker = satker.id_satker 
                inner join mst_pengelola AS pengelola on sejarah.id_pengelola = pengelola.id_pengelola 
                inner join org_geografi AS geografi on sejarah.id_geografi = geografi.id_geografi
        "
    ];

    $konsos_budaya = [
        'title' => "Budaya",
        'tableName' => 'konsos_budaya',
        'tableAlias' => 'budaya',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "kebudayaan_asli" => "Kebudayaan Asli",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                budaya.*, satker.nama_satker,
                geografi.nama as wilayah, geografi.*
            from
                konsos_budaya AS budaya
                inner join org_satker AS satker on budaya.id_satker = satker.id_satker
                inner join org_geografi AS geografi on budaya.id_geografi = geografi.id_geografi
        "
    ];

    $konsos_instansi_militer = [
        'title' => "Instansi Militer dan Polisi",
        'tableName' => 'konsos_instansi_militer',
        'tableAlias' => 'militer',
        'columns' => [
            "nama_satker" => "Satker",
            "wilayah" => "Wilayah",
            "instansi" => "Instansi",
            "cakupan_wilayah" => "Cakupan wilayah",
            "jumlah_personel" => "Jumlah Personil",
            "keterangan" => "Ket"
        ],
        'sqlSelect' => "
            select
                militer.*, satker.nama_satker, geografi.nama as wilayah,
                geografi.*, instansi.nama AS instansi
            from
                konsos_instansi_militer AS militer
                inner join org_satker AS satker on militer.id_satker = satker.id_satker
                inner join mst_instansi AS instansi  on  militer.id_instansi = instansi.id_instansi
                inner join org_geografi AS geografi on militer.id_geografi = geografi.id_geografi
        "
    ];

    $configs = [
        'geo_pantai' => $geo_pantai,
        'geo_hutan' => $geo_hutan,
        'geo_gunung' => $geo_gunung,
        'geo_kerawanan' => $geo_kerawanan,
        'geo_curah_hujan' => $geo_curah_hujan,
        'geo_struktur_tanah' => $geo_struktur_tanah,
        'geo_sumber_air' => $geo_sumber_air,
        'geo_sungai' => $geo_sungai,
        'geo_pulau_terluar' => $geo_pulau_terluar,
        'geo_perkebunan' => $geo_perkebunan,
        'geo_pertanian' => $geo_pertanian,
        'geo_peternakan' => $geo_peternakan,
        'geo_pertambangan' => $geo_pertambangan,
        'geo_budidaya_ikan' => $geo_budidaya_ikan,
        'geo_keramba_jaring' => $geo_keramba_jaring,
        'geo_konservasi_lingkungan' => $geo_konservasi_lingkungan,
        'geo_listrik' => $geo_listrik,
        'geo_pelabuhan_sungai' => $geo_pelabuhan_sungai,
        'geo_pelabuhan_laut' => $geo_pelabuhan_laut,
        'geo_pelabuhan_perikanan' => $geo_pelabuhan_perikanan,
        'geo_sarpras_jalan' => $geo_sarpras_jalan,
        'geo_galangan_kapal' => $geo_galangan_kapal,
        'geo_industri_mesin' => $geo_industri_mesin,
        'geo_pelayaran_rakyat' => $geo_pelayaran_rakyat,
        'geo_ship_handler' => $geo_ship_handler,
        'geo_industri_perikanan' => $geo_industri_perikanan,
        'demo_jumlah_penduduk' => $demo_jumlah_penduduk,
        'demo_agama' => $demo_agama,
        'demo_suku_bangsa' => $demo_suku_bangsa,
        'demo_desa_pesisir' => $demo_desa_pesisir,
        'demo_saka_bahari' => $demo_saka_bahari,
        'demo_pekerjaan_masyarakat' => $demo_pekerjaan_masyarakat,
        'demo_sekolah_maritim' => $demo_sekolah_maritim,
        'demo_rumahsakit' => $demo_rumahsakit,
        'konsos_tokoh_masyarakat' => $konsos_tokoh_masyarakat,
        'konsos_organisasi_agama' => $konsos_organisasi_agama,
        'konsos_partai_politik' => $konsos_partai_politik,
        'konsos_umkm' => $konsos_umkm,
        'konsos_industri_menengah' => $konsos_industri_menengah,
        'konsos_objek_pariwisata' => $konsos_objek_pariwisata,
        'konsos_peninggalan_sejarah' => $konsos_peninggalan_sejarah,
        'konsos_budaya' => $konsos_budaya,
        'konsos_instansi_militer' => $konsos_instansi_militer
    ];

    return $configs;
}

function orderChartData($level, $data){
    if ($level == 2) {
        usort(
            $data, 
            function($a, $b) {
                if ($b->order_satker && $a->order_satker) {
                    return $a->order_satker - $b->order_satker;
                } else {
                    return $a->id_satker - $b->id_satker;
                }
            }
        );		
    } else {
        usort(
            $data, 
            function($a, $b) {
                return $b->total - $a->total;
            }
        );		
    }
    return $data;
}
