<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->ci =& get_instance();
        // $this->load->model(array('log_check_m', 'lscompany_m'));
        $this->load->helper(array('form', 'url', 'viewutil_helper'));
        $this->load->library(array('session', 'commonclass'));
    }

    public function access_ip_view_ok_check() {
        $access_now_ip = getenv("REMOTE_ADDR") ;
        if (
            ($access_now_ip == "115.93.15.27") ||
            ($access_now_ip == "115.93.15.29") ||
            ($access_now_ip == "106.247.2.248") ||
            ($access_now_ip == "106.242.25.106") ||
            ($access_now_ip == "106.242.25.109") ||
            ($access_now_ip == "182.208.80.99")
        ) {
            return "ok" ;
        } else {
            return "no" ;
        }
    }

    public function save_log_ins_ff($work_kind, $msg_v) {

        $date_sec = time() ;
        $staff_info = $this->session->userdata('sess_mb_no');
        $staff_id = $this->session->userdata('sess_user_id');
        $staff_name = $this->session->userdata('sess_mb_name');

        $upload_log_ins['work_kind'] = $work_kind ;
        $upload_log_ins['msg_v'] = $msg_v ;
        $upload_log_ins['url_v'] = $_SERVER['PHP_SELF'] ;
        $upload_log_ins['date_sec'] = $date_sec ;
        $upload_log_ins['staff_info'] = $staff_info ;
        $upload_log_ins['staff_id'] = $staff_id ;
        $upload_log_ins['staff_name'] = $staff_name ;

        $log_ins = $this->log_check_m->insert_staff_log_f($upload_log_ins) ;

        return ;

    }

    public function click_page_auto_ins_ff() {

        $date_sec = time() ;
        $staff_info = $this->session->userdata('sess_mb_no');
        $staff_id = $this->session->userdata('sess_user_id');
        $staff_name = $this->session->userdata('sess_mb_name');

        $url_1_v = $this->uri->segment(1) ;
        $url_2_v = $this->uri->segment(2) ;
        $url_3_v = $this->uri->segment(3) ;
        $url_4_v = $this->uri->segment(4) ;

        $upload_log_ins['url_1_v'] = $url_1_v ;
        $upload_log_ins['url_2_v'] = $url_2_v ;
        $upload_log_ins['url_3_v'] = $url_3_v ;
        $upload_log_ins['url_4_v'] = $url_4_v ;

        $upload_log_ins['url_v'] = $_SERVER['PHP_SELF'] ;
        $upload_log_ins['date_sec'] = $date_sec ;
        $upload_log_ins['staff_info'] = $staff_info ;
        $upload_log_ins['staff_id'] = $staff_id ;
        $upload_log_ins['staff_name'] = $staff_name ;

        $log_ins = $this->log_check_m->insert_z_click_4_log_f($upload_log_ins) ;

        return ;

    }

    public function logs_write($logs , $type)
    {
        $login_id = $this->session->userdata('sess_id');
        if( $type == 1)
        {
            log_message('DEBUG', '#### MSG : '.$logs.' , WHO : '.$login_id.' - by shhong' );
        }
        else if( $type == 2)
        {
            log_message('DEBUG', '#### CHK : '.$logs.' , WHO : '.$login_id.' - by shhong' );
        }
    }

    public function run_check($funcctionname)
    {
        // [시작] 로그인 확인 by shhong - 20190402
        $login_id = $this->session->userdata('sess_id');

        if ( @$this->session->userdata('esangschool_logged_in') == TRUE)
        {
            log_message('DEBUG', '#### PWD : '.$funcctionname.' , WHO : '.$login_id.' - by shhong' );
        }
        else
        {
            $this->load->helper('alert') ;
            log_message('error', '#### '.$funcctionname.' - You need login by shhong' );
            alert('YOU NEED LOGIN', LOGIN_NEED_URL);
            exit;
        }
        // [종료] 로그인 확인 by shhong - 20190402
    }

}
