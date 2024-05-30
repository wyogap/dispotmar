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

    $permission = $CI->session->userdata('permissions')[$modul];
    if ($permission[$action] != '') {
		return TRUE;
	} else {
		return FALSE;
    }
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
