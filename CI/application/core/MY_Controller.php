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
			($access_now_ip == "192.168.0.129") ||
            ($access_now_ip == "182.208.80.99") ||
            ($access_now_ip == "192.168.0.63")
        ) {
            return "ok" ;
        } else {
            return "no" ;
        }
    }


    public function run_check($funcctionname)
    {
        // [����] �α��� Ȯ�� by shhong - 20190402
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
        // [����] �α��� Ȯ�� by shhong - 20190402
    }

}
