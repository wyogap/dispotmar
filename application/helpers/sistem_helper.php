<?php
if (!function_exists('redirect_back')) {
    function redirect_back()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: http://' . $_SERVER['SERVER_NAME']);
        }
        exit;
    }
}

if (!function_exists('in_access')) {
    function in_access()
    {
        $ci = &get_instance();
        if ($ci->session->userdata('logged_in') != TRUE) {
            $ci->session->set_flashdata('error', 'Anda harus Login terlebih dahulu');
            redirect('logout');
        }
    }
}

function notification($message)
{
	$CI =&get_instance();
    $CI->load->library('ci_pusher');
	$pusher = $CI->ci_pusher->get_pusher();

	$data['message'] = $CI->session->userdata('nama_pegawai').' '.$message;

	$pusher->trigger('angkatanlaut', 'my-event', $data);
}

function policy($modul,$action)
{
	$CI =&get_instance();
	// $modul = $CI->db->get_where("mst_modul", ["kode_modul" => $modul])->row();
	// $id_role = $CI->session->userdata('id_role');
	
	// $permission = $CI->db->get_where("mst_permission", ["id_role" => $id_role,"id_modul" => $modul->id_modul])->row();
	// if ($permission->$action != '') {
	// 	return TRUE;
	// } else {
	// 	return FALSE;
    // }

    $permissions = $CI->session->userdata('permissions');
    if (empty($permissions[$modul])) {
        return FALSE;
    }

    $permission = $permissions[$modul];
    if (empty($permission[$action])) {
		return FALSE;
    }

    return TRUE;
}

function encrypt($string)
{
    $output = false;
    $secret_key     = '18feb99505071997';
    $secret_iv      = '1308201711inf019';
    $encrypt_method = 'aes-256-cbc';
    // hash
    $key    = hash("sha256", $secret_key);
    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv     = substr(hash("sha256", $secret_iv), 0, 16);
    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}

function decrypt($string)
{
    $output = false;
    $secret_key     = '18feb99505071997';
    $secret_iv      = '1308201711inf019';
    $encrypt_method = 'aes-256-cbc';
    // hash
    $key    = hash("sha256", $secret_key);
    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash("sha256", $secret_iv), 0, 16);
    //do the decryption given text/string/number
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function getSysConfig($sysKey)
{
    $CI = &get_instance();
    $CI->db->select('sysValue');
    $CI->db->from('sysconfig');
    $CI->db->where('sysKey', $sysKey);
    $query = $CI->db->get()->row()->sysValue;
    return $query;
}


// terbilang
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

function def_number_format($input, $decimal_point = 2){
    return number_format(($input ? $input : 0), $decimal_point,",",".");
}

function print_json_error($error_msg) {
    $ci = &get_instance();
    $json = ['status' => 0, 'error' => $error_msg, 'csrf' => $ci->security->get_csrf_hash()];
    echo json_encode($json, JSON_INVALID_UTF8_IGNORE);
    exit;
}

function get_geocode($alamat) {

    $alamat = str_replace(' ','+',$alamat);
    $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($alamat).'&sensor=false&key='.GOOGLEMAP_KEY);

    $output= json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;
    $kelurahan = $output->results[0]->address_components[0]->long_name;
    $kecamatan = $output->results[0]->address_components[1]->long_name;
    $kabupaten = $output->results[0]->address_components[2]->long_name;
    if (strpos($kabupaten, "Regency", 0) != FALSE) {
        $kabupaten = "Kab. " .trim(str_replace("Regency", "", $kabupaten));
    }
    else if (strpos($kabupaten, "City", 0) != FALSE) {
        $kabupaten = "Kota " .trim(str_replace("City", "", $kabupaten));
    }
    
    $id_geografi_kelurahan = 0;
    $id_geografi_kecamatan = 0;
    $id_geografi_kabupaten = 0;

    $sql = "select id_geografi from org_geografi where is_active=1 and level_geografi=2 and nama=" .$this->db->escape($kabupaten);
    $res = $this->db->query($sql)->row_array();
    if ($res != null) {
        $id_geografi_kabupaten = $res['id_geografi'];
    }

    $sql = "select id_geografi from org_geografi where is_active=1 and level_geografi=3 and nama=" .$this->db->escape($kecamatan). " and id_geografi_parent=" .$id_geografi_kabupaten;
    $res = $this->db->query($sql)->row_array();
    if ($res != null) {
        $id_geografi_kecamatan = $res['id_geografi'];
    }

    $sql = "select id_geografi from org_geografi where is_active=1 and level_geografi=4 and nama=" .$this->db->escape($kelurahan). " and id_geografi_parent=" .$id_geografi_kecamatan;
    $res = $this->db->query($sql)->row_array();
    if ($res != null) {
        $id_geografi_kelurahan = $res['id_geografi'];
    }
   
    $data = array (
        "latitude" => $latitude,
        "longitude" => $longitude,
        "kelurahan" => $kelurahan,
        "kecamatan" => $kecamatan,
        "kabupaten" => $kabupaten,
        "id_geografi" => $id_geografi_kelurahan,
        "id_geografi_kecamatan" => $id_geografi_kecamatan,
        "id_geografi_kabupaten" => $id_geografi_kabupaten
    );

    return $data;

    // $httpClient = new \GuzzleHttp\Client(['verify' => false ]);
    // $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, GOOGLEMAP_KEY);
    // $geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');

    // $result = $geocoder->geocodeQuery(GeocodeQuery::create($alamat));
    // $location = $result->get(0);
    // $adminlevels = $location->getAdminLevels();
    // $provinsi = $adminlevels->get(1)->getName();
    // $kabupaten = $adminlevels->get(2)->getName();
    // if (strpos($kabupaten, "Regency", 0) != FALSE) {
    //     $kabupaten = "Kab. " .trim(str_replace("Regency", "", $kabupaten));
    // }
    // else if (strpos($kabupaten, "City", 0) != FALSE) {
    //     $kabupaten = "Kota " .trim(str_replace("City", "", $kabupaten));
    // }
    // $kecamatan = $adminlevels->get(3)->getName();
    // $kelurahan = $adminlevels->get(4)->getName();
    // echo "$provinsi, $kabupaten, $kecamatan, $kelurahan"; exit;

}


