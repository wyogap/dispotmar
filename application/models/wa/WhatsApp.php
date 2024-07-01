<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

defined('FIELD_STATUS_NOTOK')           OR define('FIELD_STATUS_NOTOK', 0);
defined('FIELD_STATUS_OK')              OR define('FIELD_STATUS_OK', 1);
defined('FIELD_STATUS_SEARCH')          OR define('FIELD_STATUS_SEARCH', 2);
defined('FIELD_STATUS_PICK')            OR define('FIELD_STATUS_PICK', 3);

require_once FCPATH .'application/vendor/autoload.php';

use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;

class WhatsApp extends CI_Model
{
    function get_user($nomor_wa) {
        $sql = "select * from mst_user where nomor_wa=? and is_active=1";

        return $this->db->query($sql, array($nomor_wa))->row_array();
    }

    function start_session($userdata) {
        //close existing (if any)
        $sql = "update wa_session set is_active=0 where nomor_wa=?";
        $this->db->query($sql, array($userdata['nomor_wa']));

        //create a new one
        $valuepair = array (
            'nomor_wa' => $userdata['nomor_wa'],
            'id_user' => $userdata['id_user'],
            'nama_pegawai' => $userdata['nama_pegawai'],
            'id_satker' => $userdata['id_satker'],
            "created_date" => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );

        $result = $this->db->insert('wa_session', $valuepair);
        if ($result == null)    return null;

        $res = $this->db->query("SELECT LAST_INSERT_ID(id_session) as insert_id from wa_session order by LAST_INSERT_ID(id_session) desc limit 1;")->row_array();
        $id_session = $res['insert_id']; 

        //get session
        // $id_session = $this->db->insert_id();
        //var_dump($id_session);

        $sql = "select * from wa_session where id_session=? and is_active=1";
        return $this->db->query($sql, array($id_session))->row_array();;
    }

    function get_session($userdata) {
        $sql = "select * from wa_session where nomor_wa=? and is_active=1";

        return $this->db->query($sql, array($userdata['nomor_wa']))->row_array();;
    }

    function close_session($id_session) {
        $sql = "update wa_session set is_active=0 where id_session=?";
        $this->db->query($sql, array($id_session));

        $sql = "update wa_draft_pelaporan set autoclosed_at='" .date('Y-m-d H:i:s'). "' where id_session=?";
        $this->db->query($sql, array($id_session));
    }

    function save_pesan_masuk($sessiondata, $msg, $timestamp) {
        //var_dump($sessiondata); exit;
        //create a new one
        $valuepair = array (
            'nomor_wa' => $sessiondata['nomor_wa'],
            'id_user' => $sessiondata['id_user'],
            'nama_pegawai' => $sessiondata['nama_pegawai'],
            'id_satker' => $sessiondata['id_satker'],
            'id_session' => $sessiondata['id_session'],
            'id_pesan_keluar' => $sessiondata['id_pesan_keluar_terakhir'],
            'id_draft_pelaporan' => $sessiondata['id_draft_pelaporan'],
            'pesan' => $msg,
            'timestamp' => $timestamp,
            "created_date" => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );

        $result = $this->db->insert('wa_pesan_masuk', $valuepair);
        if ($result == null)    return 0;

        //get id
        $res = $this->db->query("SELECT LAST_INSERT_ID(id_pesan_masuk) as insert_id from wa_pesan_masuk order by LAST_INSERT_ID(id_pesan_masuk) desc limit 1;")->row_array();
        $id = $res['insert_id']; 
        // $id = $this->db->insert_id();
        // var_dump($id);

        //update session
        $sql = "update wa_session set id_pesan_masuk_terakhir=?, id_pesan_masuk_awal=(case when id_pesan_masuk_awal=null then ? else id_pesan_masuk_awal end) where id_session=?";
        $this->db->query($sql, array($id, $id, $sessiondata['id_session']));

        return $id;
    }
  
    function save_pesan_keluar($sessiondata, $msg) {
        //create a new one
        $valuepair = array (
            'nomor_wa' => $sessiondata['nomor_wa'],
            'id_user' => $sessiondata['id_user'],
            'nama_pegawai' => $sessiondata['nama_pegawai'],
            'id_satker' => $sessiondata['id_satker'],
            'id_session' => $sessiondata['id_session'],
            'id_pesan_masuk' => $sessiondata['id_pesan_masuk_terakhir'],
            'id_draft_pelaporan' => $sessiondata['id_draft_pelaporan'],
            'pesan' => $msg,
            'timestamp' => date('Y-m-d H:i:s'),
            "created_date" => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );

        $result = $this->db->insert('wa_pesan_keluar', $valuepair);
        if ($result == null)    return 0;

        //get session
        $res = $this->db->query("SELECT LAST_INSERT_ID(id_pesan_keluar) as insert_id from wa_pesan_keluar order by LAST_INSERT_ID(id_pesan_keluar) desc limit 1;")->row_array();
        $id = $res['insert_id']; 
        //$id = $this->db->insert_id();

        //update session
        $sql = "update wa_session set id_pesan_keluar_terakhir=? where id_session=?";
        $this->db->query($sql, array($id, $sessiondata['id_session']));

        return $id;
    }

    function get_report_list_message() {
        //list of possible reports
        $sql = "select * from wa_template where is_active=1";
        $result = $this->db->query($sql)->result_array();

        $msg = "JENIS REPORT?" .$this->get_new_line();
        foreach($result as $r) {
            $msg .= "  [" .$r['template']. "] " .$r['label']. $this->get_new_line();
        }
        $msg .= $this->get_new_line();
        $msg .= "Pilih salah satu.";
        
        return $msg;
    }

    function get_completed_message() {
        $msg = "Pelaporan berhasil dibuat. Terima kasih.";
        return $msg;
    }

    function parse($sessiondata, $message) {
        $id_satker = $sessiondata['id_satker'];
        $id_session = $sessiondata['id_session'];

        //get message type
        $segment = "";
        $lastpos = 2;
        $pos = strpos($message, '#', $lastpos);
        if ($pos > 0) {
            $segment = substr($message, $lastpos, $pos-$lastpos);
        }
        else {
            $segment = substr($message, $lastpos);
        }

        //trim
        $template = trim($segment);
        $keyword = "#!" .$template;

        if (policy(strtoupper($template),'read')){
            $id_satker = $sessiondata['id_satker'];
        }
        else if (policy(strtoupper($template),'read_all')){
            $id_satker = null;
        }

        //get template
        $sql = "select * from wa_template_field where template=? and coalesce(field,'')!='' and is_active=1";
        $result = $this->db->query($sql, array($template))->result_array();
        if (count($result) == 0) {
            return 0;
        }

        $fields = array();
        foreach($result as $r) {
            $fields[ strtoupper($r['field']) ] = $r;
        }

        //parse the message
        $lastpos = $pos+1;
        $idx = 0;
        $name = null;
        $value = null;
        $lastfield = null;
        $lastvalue = null;
        $cnt = 0;
        do {
            //get next segment
            $pos = strpos($message, '#', $lastpos);
            if ($pos > 0) {
                $segment = substr($message, $lastpos, $pos-$lastpos);
            }
            else {
                $segment = substr($message, $lastpos);
            }
            
            //get field name
            $idx = strpos($segment, ':', 1);
            if ($idx < 0) {
                //no field -> maybe part of prev message?
                if ($lastfield != null) {
                    $lastvalue .= " #" .$segment;

                    //update last field
                    $fields[ $lastfield ] = $lastvalue;
                }

                if ($pos === FALSE) break;

                continue;
            }

            $name = strtoupper(trim(substr($segment, 0, $idx)));
            $value = trim(substr($segment, $idx+1));
            
            if (!empty($fields[ $name ])) {
                $fields[ $name ]['value'] = $value;

                //parse date
                if ($fields[ $name ]['column_name'] == 'when') {
                    $arr = date_parse($value);
                    $actual_value = $arr['year'] .'-'. str_pad($arr['month'],2,'0') .'-'. str_pad($arr['day'],2,'0');
                    $actual_value .= ' ' .($arr['hour'] ? str_pad($arr['hour'],2,'0') : "00");
                    $actual_value .= ':' .($arr['minute'] ? str_pad($arr['minute'],2,'0') : "00");
                    $actual_value .= ':' .($arr['second'] ? str_pad($arr['second'],2,'0') : "00");

                    $fields[ $name ]['actual_value'] = $actual_value;
                }

                //check for actual value
                if (!empty($fields[ $name ]['lookup_table'])) {
                    $sql = "select " .$fields[ $name ]['lookup_col_value']. " as value from " .$fields[ $name ]['lookup_table']. 
                            " where is_active=1 and " .$fields[ $name ]['lookup_col_label']. " like '%" .$value. "%'";

                    //limit by satker
                    if (!empty($id_satker) && !empty($fields[ $name ]['lookup_has_satker'])) {
                        $sql .= " AND id_satker=" .$this->db->escape($id_satker);
                    }

                    $sql .= " order by length(" .$fields[ $name ]['lookup_col_label']. ")";

                    $result = $this->db->query($sql)->result_array();
                    if ($result == null) {
                        $fields[ $name ]['actual_value'] = null;
                        $fields[ $name ]['status'] = FIELD_STATUS_NOTOK;
                    }
                    else if (count($result) == 1) {
                        $fields[ $name ]['actual_value'] = $result[0]['value'];
                        $fields[ $name ]['status'] = FIELD_STATUS_OK;
                    }
                    else if (count($result) <= 10) {
                        //multiple matches => pick list
                        $fields[ $name ]['actual_value'] = null;
                        $fields[ $name ]['status'] = FIELD_STATUS_PICK;
                    }
                    else {
                        //multiple matches => search
                        $fields[ $name ]['actual_value'] = null;
                        $fields[ $name ]['status'] = FIELD_STATUS_SEARCH;
                    }
                }
                else {
                    $fields[ $name ]['status'] = 1;
                }

                //if it satker, use for limiting the options
                if ($fields[ $name ]['column_name'] == 'id_satker') {
                    if (!empty($fields[ $name ]['actual_value'])) {
                        $id_satker = $fields[ $name ]['actual_value'];
                        //update session
                        $sql = "update wa_session set id_satker=? where id_session=?";
                        $this->db->query($sql, array($id_satker, $id_session));
                    }
                    else if (!empty($id_satker)) {
                        $fields[ $name ]['actual_value'] = $id_satker;
                    }
                }
            }

            if ($pos === FALSE || $cnt > 20) {
                //all done
                break;
            }

            $lastpos = $pos+1;
            $lastfield = $name;
            $lastvalue = $value;
            $cnt++;
        }
        while (TRUE);

        //create the draft pelaporan
        $valuepair = array (
            'nomor_wa' => $sessiondata['nomor_wa'],
            'id_user' => $sessiondata['id_user'],
            'nama_pegawai' => $sessiondata['nama_pegawai'],
            'id_satker' => $id_satker,
            'id_session' => $id_session,
            'template' => $template,
            'created_by' => $this->session->userdata('id_user')
        );

        $result = $this->db->insert('wa_draft_pelaporan', $valuepair);
        if ($result == null)    return 0;

        $res = $this->db->query("SELECT LAST_INSERT_ID(id_draft_pelaporan) as insert_id from wa_draft_pelaporan order by LAST_INSERT_ID(id_draft_pelaporan) desc limit 1;")->row_array();
        $id_draft = $res['insert_id']; 
        //$id_draft = $this->db->insert_id();

        //store the fields
        foreach($fields as $f) {
            $f[ 'id_draft_pelaporan' ] = $id_draft;

            unset( $f['is_active'] );
            unset( $f['created_by'] );
            unset( $f['created_date'] );
            unset( $f['updated_by'] );
            unset( $f['updated_date'] );

            $this->db->insert('wa_draft_field', $f);
        }

        //process the fields
        //mandatory
        $sql = "select * from wa_draft_field where id_draft_pelaporan=? and is_active=1 and is_mandatory=1 and value is null";
        $result = $this->db->query($sql, array($id_draft))->result_array();
        if (count($result) > 0) {
            $updated = array();
            foreach($result as $r) {
                $id_draft_field = $r['id_draft_field'];
                $updated[ $id_draft_field ] = array();
                $updated[ $id_draft_field ]['status'] = FIELD_STATUS_NOTOK;

                //if it satker, use for limiting the options
                if ($r['column_name'] == 'id_satker' && !empty($id_satker)) {
                    $updated[ $id_draft_field ]['actual_value'] = $id_satker;
                    $updated[ $id_draft_field ]['status'] = FIELD_STATUS_OK;
                    continue;
                }
    
                if (!empty($r['lookup_table'])) {
                    $sql = "select count(*) as cnt from " .$r['lookup_table']. " where is_active=1";
    
                    //limit by satker
                    if (!empty($id_satker) && !empty($r['lookup_has_satker'])) {
                        $sql .= " AND id_satker=" .$this->db->escape($id_satker);
                    }
        
                    $result = $this->db->query($sql)->row_array();
                    if ($result['cnt'] <= 10) {
                        $updated[ $id_draft_field ]['actual_value'] = null;
                        $updated[ $id_draft_field ]['status'] = FIELD_STATUS_PICK;
                    }
                    else {
                        $updated[ $id_draft_field ]['actual_value'] = null;
                        $updated[ $id_draft_field ]['status'] = FIELD_STATUS_SEARCH;
                    }
    
                    continue;
                }
            }
        
            foreach ($updated as $k => $v) {
                if (empty($v))  continue;
                $this->db->update('wa_draft_field', $v, ['id_draft_field' => $k]);
            }
            
        }
        
        //not-mandatory -> set status = 1 if no value
        $sql = "update wa_draft_field set status=1 where is_active=1 and id_draft_pelaporan=? and is_mandatory=0";
        $this->db->query($sql, array($id_draft));

        //update draft status
        $sql = "select count(*) as cnt from wa_draft_field where is_active=1 and id_draft_pelaporan=? and status!=" .$this->db->escape(FIELD_STATUS_OK);
        $result = $this->db->query($sql, array($id_draft))->row_array();

        if ($result['cnt'] == 0) {
            $valuepair = array(
                "current_field" => null,
                "confirmed_at" => date('Y-m-d H:i:s'),
                "completed_at" => date('Y-m-d H:i:s'),
                "updated_date" => date('Y-m-d H:i:s'),
                "updated_by" => $this->session->userdata('id_user')
            );

            $result = $this->db->update("wa_draft_pelaporan", $valuepair, ['id_draft_pelaporan' => $id_draft]);

            //create pelaporan
            $report_id = $this->create_pelaporan($id_draft);

            $this->close_session($id_session);
        }

        return $id_draft;
    }

    function create_draft($sessiondata, $message) {
        $template = trim($message);
        $template = str_replace('[', '', $template);
        $template = str_replace(']', '', $template);

        $id_satker = $sessiondata['id_satker'];
        $id_session = $sessiondata['id_session'];

        if (policy(strtoupper($template),'read')){
            $id_satker = $sessiondata['id_satker'];
        }
        else if (policy(strtoupper($template),'read_all')){
            $id_satker = null;
        }

        //get template
        $sql = "select * from wa_template_field where template=? and is_active=1";
        $result = $this->db->query($sql, array($template))->result_array();
        if (count($result) == 0) {
            return 0;
        }

        $fields = array();
        foreach($result as $r) {
            $name = strtoupper($r['field']);
            $id_draft_field = $r['id_template_field'];

            $fields[ $id_draft_field ] = $r;

            $fields[ $id_draft_field ]['status'] = FIELD_STATUS_NOTOK;

            //if it satker, use for limiting the options
            if ($r['column_name'] == 'id_satker' && !empty($id_satker)) {
                $sql = "select nama_satker as label from org_satker where id_satker=?";
                $result = $this->db->query($sql, $id_satker)->row_array();
                if ($result != null) {
                    $fields[ $id_draft_field ]['value'] = $result['label'];
                    $fields[ $id_draft_field ]['actual_value'] = $id_satker;
                    $fields[ $id_draft_field ]['status'] = FIELD_STATUS_OK;
                }
                continue;
            }

            if (!empty($r['lookup_table'])) {
                if ($fields[ $id_draft_field ]['lookup_search'] == 1) {
                    $fields[ $id_draft_field ]['actual_value'] = null;
                    $fields[ $id_draft_field ]['status'] = FIELD_STATUS_SEARCH;
                }
                else {
                    $fields[ $id_draft_field ]['actual_value'] = null;
                    $fields[ $id_draft_field ]['status'] = FIELD_STATUS_PICK;
                }

                continue;
            }

        }

        //create the draft pelaporan
        $valuepair = array (
            'nomor_wa' => $sessiondata['nomor_wa'],
            'id_user' => $sessiondata['id_user'],
            'nama_pegawai' => $sessiondata['nama_pegawai'],
            'id_satker' => $id_satker,
            'id_session' => $id_session,
            'template' => $template,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_user')
        );

        $result = $this->db->insert('wa_draft_pelaporan', $valuepair);
        if ($result == null)    return 0;

        $res = $this->db->query("SELECT LAST_INSERT_ID(id_draft_pelaporan) as insert_id from wa_draft_pelaporan order by LAST_INSERT_ID(id_draft_pelaporan) desc limit 1;")->row_array();
        $id_draft = $res['insert_id']; 
        //$id_draft = $this->db->insert_id();

        //store the fields
        foreach($fields as $f) {
            $f[ 'id_draft_pelaporan' ] = $id_draft;

            //unset mandatory
            if (empty($f['field'])) {
                $f['is_mandatory'] = 0;
                $f['status'] = 1;
            }

            unset( $f['is_active'] );
            unset( $f['created_by'] );
            unset( $f['created_date'] );
            unset( $f['updated_by'] );
            unset( $f['updated_date'] );

            $this->db->insert('wa_draft_field', $f);
        }

        //process the fields
        //no need => assume every fields needs imput

        //update session
        $valuepair = array (
            'id_draft_pelaporan' => $id_draft,
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id_user')
        );

        $result = $this->db->update('wa_session', $valuepair, ['id_session' => $id_session]);

        return $id_draft;
    }

    function repeat_last_message($sessiondata, $repeat = false) {
        //get last outgoing message
        $id_pesan_keluar = $sessiondata['id_pesan_keluar_terakhir'];

        $sql = "select * from wa_pesan_keluar where id_pesan_keluar=?";
        $message = $this->db->query($sql, array($id_pesan_keluar))->row_array();

        $str = '';
        if ($repeat) {
            $str = "Jawaban tidak valid. Silahkan coba lagi. " .$this->get_new_line() .$this->get_new_line(); 
        }

        if (strpos($message['pesan'], $str, 0) < 0) {
            $str .= $message['pesan'];
        }
        else {
            $str = $message['pesan'];
        }

        return $str;
    }

    function process_message($draft_id, $message) {
        //var_dump($draft_id); var_dump($message); 
        //get draft info
        $sql = "select * from wa_draft_pelaporan where is_active=1 and id_draft_pelaporan=?";
        $draft = $this->db->query($sql, array($draft_id))->row_array();
        if ($draft == null) return 0;

        $id_session = $draft['id_session'];
       
        $value = trim($message);
        if(substr($value, 0, 1) == '[') {
            $value = str_replace('[', '', $value);
            $value = str_replace(']', '', $value);
        }

        if (!empty($draft['completed_at']) && !empty($draft['confirmed_at'])) {
            $this->close_session($id_session);
            return 1;
        }

        if (!empty($draft['completed_at']) && empty($draft['confirmed_at'])) {
            if (strtolower($value) == 'ya') {
                //update confirmed at
                $valuepair = array(
                    "confirmed_at" => date('Y-m-d H:i:s'),
                    "updated_date" => date('Y-m-d H:i:s'),
                    "updated_by" => $this->session->userdata('id_user')
                );
    
                $result = $this->db->update("wa_draft_pelaporan", $valuepair, ['id_draft_pelaporan' => $draft_id]);

                //create pelaporan
                $report_id = $this->create_pelaporan($draft_id);

                //close session
                $this->close_session($id_session);

                return 1;
            }
            else if (strtolower($value) == 'tidak'){
                //redo the whole process
                $this->close_session($id_session);

                $session = $this->start_session($draft);

                $this->create_draft($session, $draft['template']);

                return 1;
            }
            else {
                //reset this field status only
                $name = strtoupper($value);
                $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and field=?";
                $field = $this->db->query($sql, array($draft_id, $name))->row_array();
                if ($field == null) {
                    //what to do?
                    return 1;
                }

                $id_draft_field = $field['id_draft_field'];
                $updated = array();
                $updated['status'] = FIELD_STATUS_NOTOK;

                if (!empty($field['lookup_table'])) {
                    $sql = "select count(*) as cnt from " .$field['lookup_table']. " where is_active=1";
    
                    //limit by satker
                    if (!empty($id_satker) && !empty($field['lookup_has_satker'])) {
                        $sql .= " AND id_satker=" .$this->db->escape($id_satker);
                    }
        
                    $result = $this->db->query($sql)->row_array();
                    if ($result['cnt'] <= 10) {
                        $updated['actual_value'] = null;
                        $updated['status'] = FIELD_STATUS_PICK;
                    }
                    else {
                        $updated['actual_value'] = null;
                        $updated['status'] = FIELD_STATUS_SEARCH;
                    }
                }

                $result = $this->db->update("wa_draft_field", $updated, ['id_draft_field' => $id_draft_field]);   
                
                //reset completed column
                $valuepair = array(
                    'completed_at' => null,
                    "updated_date" => date('Y-m-d H:i:s'),
                    "updated_by" => $this->session->userdata('id_user')
                );

                $result = $this->db->update("wa_draft_pelaporan", $valuepair, ['id_draft_pelaporan' => $draft_id]);

                return 1;
            }
            return 1;
        }

        //current field
        $name = $draft['current_field'];
        if (empty($name)) {
            //get the first invalid field
            $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and status!=1 and coalesce(field,'')!='' order by order_no asc limit 1";
            $field = $this->db->query($sql, array($draft_id))->row_array();
            if ($field == null) {
                //what to do?
                return 0;
            }
            else {
                $name = $field ['field'];
            }
        }
        else {
            $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and field=?";
            $field = $this->db->query($sql, array($draft_id, $name))->row_array();
            if ($field == null) {
                //what to do?
                return 0;
            }
        }

        //var_dump($field); exit;

        $id_draft_field = $field['id_draft_field'];

        $actual_value = null;
        $status = 0;
        $error_message = null;

        do {
            //check optional field
            if ($field['is_mandatory'] == 0) {
                if (!empty($value))     $value = strtolower($value);
                if (empty($value) || $value == 'tidak ada' || $value == 'na') {
                    $value = null;
                    $status = FIELD_STATUS_OK;
                    break;
                }
            }
            else if (empty($value)) {
                $error_message = "Data harus diisi.";
                $status = $field['status'];
                break;
            }

            //parse date
            if ($field['field'] == 'when') {
                $arr = date_parse($value);
                $actual_value = $arr['year'] .'-'. str_pad($arr['month'],2,'0') .'-'. str_pad($arr['day'],2,'0');
                $actual_value .= ' ' .($arr['hour'] ? str_pad($arr['hour'],2,'0') : "00");
                $actual_value .= ':' .($arr['minute'] ? str_pad($arr['minute'],2,'0') : "00");
                $actual_value .= ':' .($arr['second'] ? str_pad($arr['second'],2,'0') : "00");
                break;
            }

            if ($field['column_name'] == 'tags') {
                if (!empty($value)) {
                    $actual_value = $value;
                    $status = FIELD_STATUS_OK;
                }
                else {
                    $actual_value = null;
                    $status = FIELD_STATUS_PICK;
                }
                break;
            }

            //check for lookup
            if (!empty($field['lookup_table'])) {
                //pick list
                if ($field['status'] != FIELD_STATUS_SEARCH) {
                    $sql = "select " .$field['lookup_col_label']. " as label from " .$field['lookup_table']. 
                    " where is_active=1 and " .$field['lookup_col_value']. " = " .$this->db->escape($value);
    
                    //limit by satker
                    if (!empty($id_satker) && !empty($fields[ $name ]['lookup_has_satker'])) {
                        $sql .= " AND id_satker=" .$this->db->escape($id_satker);
                    }
    
                    $result = $this->db->query($sql)->row_array();
                    if ($result != null) {
                        $actual_value = $value;
                        $value = $result['label'];
                        $status = FIELD_STATUS_OK;
                        break;
                    }
                }

                //search string
                $sql = "select " .$field['lookup_col_value']. " as value from " .$field['lookup_table']. 
                " where is_active=1 and " .$field['lookup_col_label']. " like '%" .$value. "%'";
    
                //limit by satker
                if (!empty($id_satker) && !empty($field['lookup_has_satker'])) {
                    $sql .= " AND id_satker=" .$this->db->escape($id_satker);
                }
    
                $sql .= " order by length(" .$field['lookup_col_label']. ")";
    
                $result = $this->db->query($sql)->result_array();
                if ($result == null) {
                    $actual_value = null;
                    $value = null;
                    if ($field['lookup_search'] == 1) {
                        $status = FIELD_STATUS_SEARCH;
                    } 
                    else {
                        $status = FIELD_STATUS_PICK;
                    }
                    $error_message = "Jawaban tidak valid.";
                }
                else if (count($result) == 1) {
                    $actual_value = $result[0]['value'];
                    $status = FIELD_STATUS_OK;
                }
                else if (count($result) <= 10) {
                    //multiple matches => pick list
                    $actual_value = null;
                    $status = FIELD_STATUS_PICK;
                }
                else {
                    //multiple matches => search
                    $actual_value = null;
                    $status = FIELD_STATUS_SEARCH;
                    $error_message = "Terlalu banyak hasil yang mirip.";
                }         

                break;
            }
            
            $status = FIELD_STATUS_OK;
        }
        while (false);

        //if it is satker, use for limiting the options
        if ($field['column_name'] == 'id_satker') {
            if (!empty($actual_value)) {
                //update session
                $sql = "update wa_session set id_satker=? where id_session=?";
                $this->db->query($sql, array($actual_value, $id_session));
            }
        }           

        //update field
        $valuepair = array(
            "value" => $value,
            "actual_value" => $actual_value,
            "status" => $status,
            "error_message" => $error_message,
            "updated_date" => date('Y-m-d H:i:s'),
            "updated_by" => $this->session->userdata('id_user')
        );

        $result = $this->db->update("wa_draft_field", $valuepair, ['id_draft_field' => $id_draft_field]);
        if (!$result)   return 0;

        //update draft status
        $sql = "select count(*) as cnt from wa_draft_field where is_active=1 and id_draft_pelaporan=? and status!=" .$this->db->escape(FIELD_STATUS_OK);
        $result = $this->db->query($sql, array($draft_id))->row_array();

        if ($result['cnt'] == 0) {
            $valuepair = array(
                "current_field" => null,
                "completed_at" => date('Y-m-d H:i:s'),
                "updated_date" => date('Y-m-d H:i:s'),
                "updated_by" => $this->session->userdata('id_user')
            );

            $result = $this->db->update("wa_draft_pelaporan", $valuepair, ['id_draft_pelaporan' => $draft_id]);
        }

        return 1;
    }

    function get_response($draft_id) {
        //get draft info
        $sql = "select * from wa_draft_pelaporan where is_active=1 and id_draft_pelaporan=?";
        $draft = $this->db->query($sql, array($draft_id))->row_array();
        if ($draft == null) return 0;

        $id_session = $draft['id_session'];
        $id_satker = $draft['id_satker'];

        $message = '';

        if (!empty($draft['completed_at']) && !empty($draft['confirmed_at'])) {

            return $message;
        }

        if (!empty($draft['completed_at']) && empty($draft['confirmed_at'])) {
            //header
            $template = $draft['template'];
            $message .= "#!" .$template. $this->get_new_line();
            
            //field
            $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and coalesce(field,'')!='' order by order_no asc";
            $fields = $this->db->query($sql, array($draft_id))->result_array();
            foreach($fields as $f) {
                $message .= "#" .strtoupper($f['field']). ": " .$f['value']. $this->get_new_line();
            }

            $message .= "#!" .$template. $this->get_new_line();

            $message .= $this->get_new_line();
            $message .= "Ketik YA untuk menyimpan, TIDAK untuk memulai ulang. " .$this->get_new_line(). "Untuk memperbaiki salah satu data, ketik nama kolom (contoh: " .strtoupper($fields[0]['field']). ").";

            return $message;
        }

        //current field
        $name = $draft['current_field'];
        if (empty($name)) {
            //get the first invalid field
            $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and status!=1 and coalesce(field,'')!='' order by order_no asc limit 1";
            $field = $this->db->query($sql, array($draft_id))->row_array();
            if ($field == null) {
                //what to do?
                return null;
            }
            else {
                $name = $field ['field'];
            }
        }
        else {
            $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and field=?";
            $field = $this->db->query($sql, array($draft_id, $name))->row_array();
            if ($field == null) {
                //what to do?
                return null;
            }
        }

        if ($field['status'] == 1) {
            //get next invalid field
            $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and status!=1 and coalesce(field,'')!='' order by order_no asc limit 1";
            $field = $this->db->query($sql, array($draft_id))->row_array();
            if ($field == null) {
                //what to do?
                return null;
            }
            else {
                $name = $field ['field'];
            }
        }

        if (!empty($field['error_message'])) {
            $message .= $field['error_message'] .$this->get_new_line() .$this->get_new_line();
        }
        
        do {
            if ($field['column_name'] == 'tags') {
                $id_activity_jenis = $draft['id_activity_jenis'];

                $category = "";
                $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and column_name='id_activity_jenis2' order by order_no asc limit 1";
                $field2 = $this->db->query($sql, array($draft_id))->row_array();
                if ($field2 != null) {
                    $category = $field2['actual_value'];
                }

                //pick list
                $message .= $field['field'] ."?". $this->get_new_line();

                $sql = "select " .$field['lookup_col_value']. " as value, " .$field['lookup_col_label']. " as label from " .$field['lookup_table']. 
                        " where is_active=1";
    
                // if (!empty($field['value'])) {
                //     $sql .= " and " .$field['lookup_col_label']. " like '%" .$field['value']. "%'";
                // }
    
                //limit by satker
                if (!empty($id_satker) && !empty($field['lookup_has_satker'])) {
                    $sql .= " AND id_satker=" .$this->db->escape($id_satker);
                }
    
                //limit by jenis dan kategory
                if (!empty($category)) {
                    $sql .= " AND (id_activity_jenis=" .$this->db->escape($id_activity_jenis). " OR id_activity_jenis=" .$this->db->escape($category). ")";
                }
                else {
                    $sql .= " AND id_activity_jenis=" .$this->db->escape($id_activity_jenis);
                }

                //$sql .= " order by length(" .$field['lookup_col_label']. ")";
    
                $result = $this->db->query($sql)->result_array();
                if (!empty($result)) {
                    foreach($result as $r) {
                        $message .= "  [" .$r['value']. "] " .$r['label']. $this->get_new_line();
                    }
                }
    
                $message .= $this->get_new_line();
                if (count($result) > 1) {
                    $message .= "Pilih satu atau lebih (contoh: " .$result[0]['value']. "," .$result[1]['value']. ").";
                }
                else {
                    $message .= "Pilih satu atau lebih.";
                }
                
                break;
            }

            if (!empty($field['lookup_table'])) {
                if ($field['status'] == FIELD_STATUS_SEARCH) {
                    //search
                    $message .= $field['field'] ."?". $this->get_new_line();
                    
                    $message .= $this->get_new_line();
                    if (!empty($field['prompt'])) {
                        $message .= $field['prompt'];
                    }
                    else {
                        $message .= "Ketik bebas.";
                    }
                }
                else if ($field['status'] == FIELD_STATUS_PICK) {
                    //pick list
                    $message .= $field['field'] ."?". $this->get_new_line();
        
                    $sql = "select " .$field['lookup_col_value']. " as value, " .$field['lookup_col_label']. " as label from " .$field['lookup_table']. 
                            " where is_active=1";
        
                    if (!empty($field['value'])) {
                        $sql .= " and " .$field['lookup_col_label']. " like '%" .$field['value']. "%'";
                    }
        
                    //limit by satker
                    if (!empty($id_satker) && !empty($field['lookup_has_satker'])) {
                        $sql .= " AND id_satker=" .$this->db->escape($id_satker);
                    }
        
                    //$sql .= " order by length(" .$field['lookup_col_label']. ")";
        
                    $result = $this->db->query($sql)->result_array();
                    if (!empty($result)) {
                        foreach($result as $r) {
                            $message .= "  [" .$r['value']. "] " .$r['label']. $this->get_new_line();
                        }
                    }
        
                    $message .= $this->get_new_line();
                    if (!empty($field['prompt'])) {
                        $message .= $field['prompt'];
                    }
                    else if (!empty($field['lookup_multiple'])) {
                        if (count($result) > 1) {
                            $message .= "Pilih satu atau lebih (contoh: " .$result[0]['value']. "," .$result[1]['value']. ").";
                        }
                        else {
                            $message .= "Pilih satu atau lebih.";
                        }
                    }
                    else {
                        if (count($result) >= 1) {
                            $message .= "Pilih salah satu (contoh: " .$result[0]['value']. ").";
                        }
                        else {
                            $message .= "Pilih salah satu.";
                        }
                    }

                }
                else {
                    //prompt
                    $message .= $field['field'] ."?". $this->get_new_line();
        
                    $message .= $this->get_new_line();
                    if (!empty($field['prompt'])) {
                        $message .= $field['prompt'];
                    }
                    else {
                        $message .= "Ketik bebas.";
                    }
                }

                break;
            }

            //prompt
            $message .= $field['field'] ."?". $this->get_new_line();

            $message .= $this->get_new_line();
            if (!empty($field['prompt'])) {
                $message .= $field['prompt'];
            }
            else {
                $message .= "Ketik bebas.";
            }
        }
        while (false);

        //update current field in draft-pelaporan
        $valuepair = array(
            "current_field" => $field['field'],
            "updated_date" => date('Y-m-d H:i:s'),
            "updated_by" => $this->session->userdata('id_user')
        );

        $result = $this->db->update("wa_draft_pelaporan", $valuepair, ['id_draft_pelaporan' => $draft_id]);

        return $message;
    }

    function check_draft_status($draft_id) {        
        $sql = "select * from wa_draft_pelaporan where is_active=1 and id_draft_pelaporan=?";
        $draft = $this->db->query($sql, array($draft_id))->row_array();

        if ($draft == null) return 1;

        if (!empty($draft['completed_at']) || !empty($draft['autoclosed_at'])) return 1;
        
        return 0;
    }

    function get_new_line() {
        return PHP_EOL;
    }

    function create_pelaporan($draft_id) {
        //get draft info
        $sql = "select * from wa_draft_pelaporan where is_active=1 and id_draft_pelaporan=?";
        $draft = $this->db->query($sql, array($draft_id))->row_array();
        if ($draft == null) return 0;

        $template = $draft['template'];

        //get field info
        $sql = "select * from wa_draft_field where is_active=1 and id_draft_pelaporan=? and coalesce(field,'')!='' order by order_no asc";
        $fields = $this->db->query($sql, array($draft_id))->result_array();
        if ($fields == null) {
            //what to do?
            return 0;
        }

        //insert
        $valuepair = array();
        foreach($fields as $f) {
            $valuepair[ $f['column_name'] ] = (!empty($f['actual_value'])) ? $f['actual_value'] : $f['value'];
        }

        $sql = "select * from wa_template where is_active=1 and template=?";
        $result = $this->db->query($sql, array($template))->row_array();
        if ($result == null) {
            return 0;
        }

        $valuepair[ 'id_activity_jenis' ] = $result['id_activity_jenis'];

        $alamat = '';
        foreach($fields as $f) {
            if ($f['column_name'] == 'where') {
                $alamat = $f['value'];
                break;
            }
        }

        $geocode = $this->get_geocode($alamat);
        $valuepair['id_geografi'] = $geocode['id_geografi'];
        $valuepair['latitude'] = $geocode['latitude'];
        $valuepair['longitude'] = $geocode['longitude'];

        $valuepair['created_date'] = date('Y-m-d H:i:s');
        $valuepair['created_by'] = $this->session->userdata('id_user');

        $result = $this->db->insert('rekap_activity_sosial', $valuepair);
        if ($result == null)    return 0;

        //get session
        $res = $this->db->query("SELECT LAST_INSERT_ID(id_activity_sosial) as insert_id from rekap_activity_sosial order by LAST_INSERT_ID(id_activity_sosial) desc limit 1;")->row_array();
        $id = $res['insert_id']; 

        return $id;
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
        $id_geografi_provinsi = 0;

        $sql = "select id_geografi, id_geografi_parent from org_geografi where is_active=1 and level_geografi=2 and nama=" .$this->db->escape($kabupaten);
        $res = $this->db->query($sql)->row_array();
        if ($res != null) {
            $id_geografi_kabupaten = $res['id_geografi'];
            $id_geografi_provinsi = $res['id_geografi_parent'];
        }

        $sql = "select id_geografi from org_geografi where is_active=1 and level_geografi=3 and nama=" .$this->db->escape($kecamatan). " and id_geografi_parent=" .$this->db->escape($id_geografi_kabupaten);
        $res = $this->db->query($sql)->row_array();
        if ($res != null) {
            $id_geografi_kecamatan = $res['id_geografi'];
        }
 
        $sql = "select id_geografi from org_geografi where is_active=1 and level_geografi=4 and nama=" .$this->db->escape($kelurahan). " and id_geografi_parent=" .$this->db->escape($id_geografi_kecamatan);
        $res = $this->db->query($sql)->row_array();
        if ($res != null) {
            $id_geografi_kelurahan = $res['id_geografi'];
        }
       
        $sql = "select nama from org_geografi where is_active=1 and id_geografi=" .$this->db->escape($id_geografi_provinsi);
        $res = $this->db->query($sql)->row_array();
        if ($res != null) {
            $provinsi = $res['nama'];
        }

        $data = array (
            "latitude" => $latitude,
            "longitude" => $longitude,
            "kelurahan" => $kelurahan,
            "kecamatan" => $kecamatan,
            "kabupaten" => $kabupaten,
            "provinsi" => $provinsi,
            "id_geografi" => $id_geografi_kelurahan,
            "id_geografi_kecamatan" => $id_geografi_kecamatan,
            "id_geografi_kabupaten" => $id_geografi_kabupaten,
            "id_geografi_provinsi" => $id_geografi_provinsi
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


}
