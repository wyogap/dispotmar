<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('STR_START_LAPORAN')      OR define('STR_START_LAPORAN', "#!");
defined('STR_LAPOR')              OR define('STR_LAPOR', 'lapor');

defined('WA_APIKEY')              OR define('WA_APIKEY', '1XILYIS22AFBNMUP');
defined('WA_NUMBERKEY')           OR define('WA_NUMBERKEY', 'a1xViEZ2Tu5Tidvz');

class WAController extends CI_Controller {
    const STR_START_LAPORAN = "#!";
    const STR_LAPOR = 'lapor';

	public function __construct()
	{
		parent::__construct();
		in_access();
		$this->load->model('wa/WhatsApp', 'wa');
    }

    public function index()
	{
        //echo "Testing"; exit;
		$this->data['title'] = 'Rekap - Saka Bahari';

		$data['isi'] = $this->load->view('wa/whatsapp', $this->data, true);
		$this->load->view('skin/layout', $data);
	}

    public function message() {
        
        $nomor_wa = $this->input->post('nomor_wa');
        $message = $this->input->post('message');
        $timestamp = date('Y-m-d H:i:s');

        //check for valid nomor_wa
        $user = $this->wa->get_user($nomor_wa);
        if (empty($user)) {
            //tidak terdaftar
            print_json_error("tidak-terdaftar");
        }

        $message_out = $this->process_message($user, $message, $timestamp);

        $this->send_message($user, $message_out);
    }

    // protected function get_message() {
    //     $result = array();
    //     $result['nomor_wa'] = $this->input->post('nomor_wa');
    //     $result['message'] = $this->input->post('message');
    //     $result['timestamp'] = date('Y-m-d H:i:s');

    //     return $result;
    // }

    protected function send_message($user, $message_out) {
        $json = array();
        $json['status'] = 1;
        $json['message'] = $message_out;

        echo json_encode($json);
    }

    protected function process_message($user, $message, $timestamp) {
        $message = trim($message);
 
        if (STR_START_LAPORAN == substr($message, 0, 2)) {
            //start new session
            $session = $this->wa->start_session($user);

            //save incoming message
            $this->wa->save_pesan_masuk($session, $message, $timestamp);

            //full template message => parse it => create draft report
            $draft_id = $this->wa->parse($session, $message);

            //ask for missing field
            $message_out = $this->wa->get_response($draft_id);
            if ($message_out == null) {
                $status = $this->wa->check_draft_status($draft_id);
                if ($status == 1) {
                    //completed/auto-completed
                    $message_out = $this->wa->get_completed_message();
                }
                else {
                    $this->wa->close_session($session['id_session']);

                    //start new session
                    $session = $this->wa->start_session($user);

                    //ask for report type
                    $message_out = $this->wa->get_report_list_message();
                }
            }                

            //$this->send_message($user, $message_out);

            //save outgoing message
            $this->wa->save_pesan_keluar($session, $message_out);
        }
        else if (STR_LAPOR == strtolower(substr($message, 0, strlen(STR_LAPOR)))) {
            //start new session
            $session = $this->wa->start_session($user);

            //save incoming message
            $this->wa->save_pesan_masuk($session, $message, $timestamp);

            //ask for report type
            $message_out = $this->wa->get_report_list_message();

            //$this->send_message($user, $message_out);

            //save outgoing message
            $this->wa->save_pesan_keluar($session, $message_out);
        }
        else {
            //continue existing session => get current session
            $session = $this->wa->get_session($user);

            if (empty($session)) {
                //no active session -> start new session
                $session = $this->wa->start_session($user);

                //save incoming message
                $this->wa->save_pesan_masuk($session, $message, $timestamp);

                //ask for report type
                $message_out = $this->wa->get_report_list_message();
            }
            else if (empty($session['id_draft_pelaporan'])) {
                //save incoming message
                $this->wa->save_pesan_masuk($session, $message, $timestamp);

                $draft_id = $this->wa->create_draft($session, $message);
                if (!$draft_id) {
                    //repeat last message
                    $message_out = $this->wa->repeat_last_message($session, true);

                    //last message is report_list_message => should never need the failover below
                    if ($message_out == null) {
                        $this->wa->close_session($session['id_session']);

                        //start new session
                        $session = $this->wa->start_session($user);

                        //ask for report type
                        $message_out = $this->wa->get_report_list_message();
                    }
                }
                else {
                    $message_out = $this->wa->get_response($draft_id);

                    //empty draft => should never need the failover below
                    if ($message_out == null) {
                        $status = $this->wa->check_draft_status($draft_id);
                        if ($status == 1) {
                            //completed/auto-completed
                            $message_out = $this->wa->get_completed_message();
                        }
                        else {
                            $this->wa->close_session($session['id_session']);

                            //start new session
                            $session = $this->wa->start_session($user);

                            //ask for report type
                            $message_out = $this->wa->get_report_list_message();
                        }
                    }                
                }
            }
            else {
                //save incoming message
                $id = $this->wa->save_pesan_masuk($session, $message, $timestamp);

                //process message => get draft report => get current field
                $draft_id = $session['id_draft_pelaporan'];
                $status = $this->wa->process_message($draft_id, $message);

                if (!$status) {
                    //repeat last message
                    $message_out = $this->wa->repeat_last_message($session, true);
                    if ($message_out == null) {
                        $this->wa->close_session($session['id_session']);

                        //start new session
                        $session = $this->wa->start_session($user);

                        //ask for report type
                        $message_out = $this->wa->get_report_list_message();
                    }
                }
                else {
                    //get next field (if necessary)
                    $message_out = $this->wa->get_response($draft_id);
                    if ($message_out == null) {
                        $status = $this->wa->check_draft_status($draft_id);
                        if ($status == 1) {
                            //completed/auto-completed
                            $message_out = $this->wa->get_completed_message();
                        }
                        else {
                            $this->wa->close_session($session['id_session']);

                            //start new session
                            $session = $this->wa->start_session($user);

                            //ask for report type
                            $message_out = $this->wa->get_report_list_message();
                        }
                    }      
                    
                }
            }
  
            //$this->send_message($user, $message_out);

            //save outgoing message
            $this->wa->save_pesan_keluar($session, $message_out);
        }

        return $message_out;
    }

    public function webhook() {
        $data = $this->input->post('data');
        $nomor_wa = $data['message_id'];
        $message = $data["message_body"];
        $timestamp = date('Y-m-d H:i:s');

        //check for valid nomor_wa
        $user = $this->wa->get_user($nomor_wa);
        if (empty($user)) {
            //tidak terdaftar
            print_json_error("tidak-terdaftar");
        }

        $message_out = $this->process_message($user, $message, $timestamp);

        $this->send_whatsapp($user, $message_out);
    }

    protected function send_whatsapp($user, $message_out) {
        $dataSending = Array();
        $dataSending["api_key"] = WA_APIKEY;
        $dataSending["number_key"] = WA_NUMBERKEY;
        $dataSending["phone_no"] = $user["nomor_wa"];
        $dataSending["message"] = $message_out;
        $dataSending["wait_until_send"] = "1"; //This is an optional parameter, if you use this parameter the response will appear after sending the message is complete
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }

    public function setwebhook() {
        $dataSending = Array();
        $dataSending["api_key"] = WA_APIKEY;
        $dataSending["number_key"] = WA_NUMBERKEY;
        $dataSending["endpoint_url"] = site_url() ."wa/webhook";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/set_webhook',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }

    public function cekapi() {
        $dataSending = Array();
        $dataSending["api-key"] = WA_APIKEY;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/checking_key',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
}
