<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->ci =& get_instance();
        $this->load->database();    // DB 연결
    }

	public function index()
	{
	    // 경고창
        $this->load->helper('alert') ;

        // IP 확 인
        $ip_ok_check = $this->access_ip_view_ok_check() ;

        if ( $ip_ok_check == "ok" )
        {
            $this->load->view('auth/login_v');
        }
        else
        {
            $board_list_link = "http://www.esangschool.com/" ;
            replace($board_list_link);
        }
	}

    public function logout()
    {
        $this->load->helper('alert') ;
        $this->session->sess_destroy() ;

        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' ;
        alert('로그아웃 되었습니다', LOGIN_NEED_URL);
        exit ;
    }

    public function login_admin_act()
    {

        $this->load->model(array('Auth_m'));

		//	경고창 헬퍼 로딩
        $this->load->helper('alert') ;
        $board_list_link = "/CI/Temp" ;

        if ( @$this->session->userdata('esangschool_logged_in') == TRUE)
        {
            replace($board_list_link) ;
            exit ;
        }

		//	폼 검증 라이브러리 로드
        $this->load->library('form_validation');

        //	폼 검증할 필드와 규칙 사전 정의
        $this->form_validation->set_rules('user_id', '아이디', 'required');
        $this->form_validation->set_rules('user_pw', '비밀번호', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            $tmp_id = $this->commonclass->common_replace_quoto_f($this->input->post('user_id', TRUE));
            $tmp_pw = $this->commonclass->common_replace_quoto_f($this->input->post('user_pw', TRUE));

            $result_count = $this->Auth_m->select_master_id_info($tmp_id, 'count');

            if ($result_count == 1) {

                $result = $this->Auth_m->select_master_id_info($tmp_id, '');
                $mb_pw = $result->aduser_pw ;
                $mb_name = $result->aduser_power;

                if ($mb_pw == $tmp_pw)
                {
                    //	세션 생성
                    $newdata = array(
                        'sess_id' => $tmp_id,
                        'sess_name' => $mb_name,
                        'esangschool_logged_in' => TRUE
                    );

                    $this->ci->session->set_userdata($newdata);
                    replace($board_list_link);
                    exit;

                } else {
                    $login_msg = "아이디, 비번 확인하세요 2 ";
                    alert($login_msg, LOGIN_NEED_MASTER_URL);
                    exit;
                }

            } else {
                $login_msg = "아이디, 비번 확인하세요 1 ";
                alert($login_msg, LOGIN_NEED_MASTER_URL);
                exit;
            }

        } else {
            $login_msg = "아이디, 비번 확인하세요 0 " ;
            alert($login_msg, LOGIN_NEED_MASTER_URL);
            exit ;
        }
    }


}
