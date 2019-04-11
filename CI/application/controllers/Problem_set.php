<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem_set extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->run_check('Problem_set/index()');
        $this->just_main();
	}

    public function _remap($method)
    {
        $this->load->view('header_admin');
        if ( method_exists($this, $method) )
        {
            $this->{"{$method}"}();
        }
        $this->load->view('footer_admin');
    }

    public function just_main()
    {
        $data   = array();

        // 화면의 카테고리 표시 값 : $category
        $category	= array(
            'cate01'		=> 'leveltest' ,    // 분류 : 상
            'cate02'		=> '1',              // 분류 : 중
            'cate03'		=> ''               // 분류 : 하
        );
        $data['cate'] = $category;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        $data['list'] = $this->Problem_m->select_pro_group() ;

        $this->load->view('leveltest/pro_group_list_v', $data);

    }

    public function group_add_db()
    {
        $this->load->helper('alert') ;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        if ( @$this->session->userdata('esangschool_logged_in') == TRUE)
        {

            //	폼 검증 라이브러리 로드
            $this->load->library('form_validation');

            //	폼 검증할 필드와 규칙 사전 정의
            $this->form_validation->set_rules('group_title', 'Group Title', 'required');

            if ($this->form_validation->run() == TRUE)
            {
                $group_title = $this->commonclass->common_replace_quoto_f($this->input->post('group_title', TRUE));

                $upload_data['group_title'] = $group_title ;
                $insert_key = $this->Problem_m->insert_pro_group_db($upload_data) ;

                $login_msg = "등록되었습니다 " ;
                $go_page = "/CI/Problem_set/just_main" ;

            } else {
                $login_msg = "비정상 접근 입니다 " ;
                $go_page = "/CI/Problem_set/just_main" ;
            }

            alert($login_msg, $go_page);
            exit ;

        } else {
            $login_msg = "로그인 하세요 ";
            alert($login_msg, LOGIN_NEED_MASTER_URL);
            exit;
        }

    }

    public function problem_result_list()
    {
        $data   = array();

        // 화면의 카테고리 표시 값 : $category
        $category	= array(
            'cate01'		=> 'leveltest' ,    // 분류 : 상
            'cate02'		=> '1',              // 분류 : 중
            'cate03'		=> ''               // 분류 : 하
        );
        $data['cate'] = $category;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        $group_v = $this->uri->segment(3) ;

        $data['group_info'] = $this->Problem_m->select_pro_group_one($group_v) ;
        $data['list'] = $this->Problem_m->select_pro_result_list($group_v) ;

        $this->load->view('leveltest/problem_result_list_v', $data);

    }

    public function problem_result_add_db()
    {
        $this->load->helper('alert') ;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        if ( @$this->session->userdata('esangschool_logged_in') == TRUE)
        {

            //	폼 검증 라이브러리 로드
            $this->load->library('form_validation');

            //	폼 검증할 필드와 규칙 사전 정의
            $this->form_validation->set_rules('group_v', 'Result Title', 'required');
            $this->form_validation->set_rules('title_v', 'Result Title', 'required');

            if ($this->form_validation->run() == TRUE)
            {

                $group_v = $this->commonclass->common_replace_quoto_f($this->input->post('group_v', TRUE));
                $title_v = $this->commonclass->common_replace_quoto_f($this->input->post('title_v', TRUE));
                $msg_v = $this->commonclass->common_replace_quoto_f($this->input->post('msg_v', TRUE));
                $img_1 = $this->commonclass->common_replace_quoto_f($this->input->post('img_1', TRUE));
                $img_1_link = $this->commonclass->common_replace_quoto_f($this->input->post('img_1_link', TRUE));
                $img_2 = $this->commonclass->common_replace_quoto_f($this->input->post('img_2', TRUE));
                $img_2_link = $this->commonclass->common_replace_quoto_f($this->input->post('img_2_link', TRUE));
                $level_key = $this->commonclass->common_replace_quoto_f($this->input->post('level_key', TRUE));

                $upload_data['group_v'] = $group_v ;
                $upload_data['title_v'] = $title_v ;
                $upload_data['msg_v'] = $msg_v ;
                $upload_data['img_1'] = $img_1 ;
                $upload_data['img_1_link'] = $img_1_link ;
                $upload_data['img_2'] = $img_2 ;
                $upload_data['img_2_link'] = $img_2_link ;
                $upload_data['level_key'] = $level_key ;

                $insert_key = $this->Problem_m->insert_pro_result_db($upload_data) ;

                $login_msg = "등록되었습니다 " ;
                $go_page = "/CI/Problem_set/problem_result_list/" . $group_v ;

            } else {
                $login_msg = "비정상 접근 입니다 " ;
                $go_page = "/CI/Problem_set/just_main" ;
            }

            alert($login_msg, $go_page);
            exit ;

        } else {
            $login_msg = "로그인 하세요 ";
            alert($login_msg, LOGIN_NEED_MASTER_URL);
            exit;
        }

    }

    public function problem_result_edit()
    {
        $data   = array();

        // 화면의 카테고리 표시 값 : $category
        $category	= array(
            'cate01'		=> 'leveltest' ,    // 분류 : 상
            'cate02'		=> '1',              // 분류 : 중
            'cate03'		=> ''               // 분류 : 하
        );
        $data['cate'] = $category;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        $n_result = $this->uri->segment(3) ;
        $tmp_d = $this->Problem_m->select_pro_result_one_info($n_result) ;
        $data['result_one_info'] = $tmp_d ;
        $group_v = $tmp_d->group_v ;    //  result_one_info

        $data['group_info'] = $this->Problem_m->select_pro_group_one($group_v) ;

        $data['list'] = $this->Problem_m->select_pro_result_list($group_v) ;

        $this->load->view('leveltest/problem_result_edit_v', $data);

    }

    public function problem_result_edit_db()
    {
        $this->load->helper('alert') ;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        if ( @$this->session->userdata('esangschool_logged_in') == TRUE)
        {

            //	폼 검증 라이브러리 로드
            $this->load->library('form_validation');

            //	폼 검증할 필드와 규칙 사전 정의

            $this->form_validation->set_rules('n_result', 'Result Title', 'required');
            $this->form_validation->set_rules('group_v', 'Result Title', 'required');
            $this->form_validation->set_rules('title_v', 'Result Title', 'required');

            if ($this->form_validation->run() == TRUE)
            {

                $n_result = $this->commonclass->common_replace_quoto_f($this->input->post('n_result', TRUE));
                $group_v = $this->commonclass->common_replace_quoto_f($this->input->post('group_v', TRUE));
                $title_v = $this->commonclass->common_replace_quoto_f($this->input->post('title_v', TRUE));
                $msg_v = $this->commonclass->common_replace_quoto_f($this->input->post('msg_v', TRUE));
                $img_1 = $this->commonclass->common_replace_quoto_f($this->input->post('img_1', TRUE));
                $img_1_link = $this->commonclass->common_replace_quoto_f($this->input->post('img_1_link', TRUE));
                $img_2 = $this->commonclass->common_replace_quoto_f($this->input->post('img_2', TRUE));
                $img_2_link = $this->commonclass->common_replace_quoto_f($this->input->post('img_2_link', TRUE));
                $level_key = $this->commonclass->common_replace_quoto_f($this->input->post('level_key', TRUE));

                $upload_data['n_result'] = $n_result ;
                $upload_data['group_v'] = $group_v ;
                $upload_data['title_v'] = $title_v ;
                $upload_data['msg_v'] = $msg_v ;
                $upload_data['img_1'] = $img_1 ;
                $upload_data['img_1_link'] = $img_1_link ;
                $upload_data['img_2'] = $img_2 ;
                $upload_data['img_2_link'] = $img_2_link ;
                $upload_data['level_key'] = $level_key ;

                $insert_key = $this->Problem_m->update_pro_result_db($upload_data) ;

                $login_msg = "수정 등록되었습니다" ;
                $go_page = "/CI/Problem_set/problem_result_edit/" . $n_result ;

            } else {
                $login_msg = "비정상 접근 입니다 " ;
                $go_page = "/CI/Problem_set/just_main" ;
            }

            alert($login_msg, $go_page);
            exit ;

        } else {
            $login_msg = "로그인 하세요 ";
            alert($login_msg, LOGIN_NEED_MASTER_URL);
            exit;
        }

    }

    public function problem_list()
    {
        $data   = array();

        // 화면의 카테고리 표시 값 : $category
        $category	= array(
            'cate01'		=> 'leveltest' ,    // 분류 : 상
            'cate02'		=> '1',              // 분류 : 중
            'cate03'		=> ''               // 분류 : 하
        );
        $data['cate'] = $category;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        $group_v = $this->uri->segment(3) ;

        $data['group_info'] = $this->Problem_m->select_pro_group_one($group_v) ;
        $data['list'] = $this->Problem_m->select_problem_list($group_v) ;

        $data['result_list'] = $this->Problem_m->select_pro_result_list($group_v) ;

        $this->load->view('leveltest/problem_list_v', $data);

    }

    public function problem_add_db()
    {
        $this->load->helper('alert') ;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        if ( @$this->session->userdata('esangschool_logged_in') == TRUE)
        {

            //	폼 검증 라이브러리 로드
            $this->load->library('form_validation');

            //	폼 검증할 필드와 규칙 사전 정의
            $this->form_validation->set_rules('group_v', ' key ', 'required');
            $this->form_validation->set_rules('question_str', 'qustion Title', 'required');

            if ($this->form_validation->run() == TRUE)
            {

                $group_v = $this->commonclass->common_replace_quoto_f($this->input->post('group_v', TRUE));
                $num_v = $this->commonclass->common_replace_quoto_f($this->input->post('num_v', TRUE));
                $question_str = $this->commonclass->common_replace_quoto_f($this->input->post('question_str', TRUE));

                $upload_data['group_v'] = $group_v ;
                $upload_data['num_v'] = $num_v ;
                $upload_data['question_str'] = $question_str ;

                $pro_n_auto = $this->Problem_m->insert_problem_db($upload_data) ;

                if ($pro_n_auto > 0) {

                    for ($i=1; $i < 9; $i++) {
                        $name_num = "num_ans_" . $i;
                        $name_str = "string_ans_" . $i;
                        $name_next_question = "next_question_" . $i;
                        $name_next_result = "next_result_" . $i;

                        $ans_num_v = $this->commonclass->common_replace_quoto_f($this->input->post($name_num, TRUE));
                        $ans_str = $this->commonclass->common_replace_quoto_f($this->input->post($name_str, TRUE));
                        $next_q = $this->commonclass->common_replace_quoto_f($this->input->post($name_next_question, TRUE));
                        $n_result = $this->commonclass->common_replace_quoto_f($this->input->post($name_next_result, TRUE));

                        if ($next_q == "")      $next_q = 0 ;
                        if ($n_result == "")    $n_result = 0 ;

                        if ($ans_str != "") {
                            $upload_data['pro_n_auto'] = $pro_n_auto ;
                            $upload_data['group_v'] = $group_v ;
                            $upload_data['ans_num_v'] = $ans_num_v ;
                            $upload_data['ans_str'] = $ans_str ;
                            $upload_data['next_q'] = $next_q ;
                            $upload_data['n_result'] = $n_result ;

                            $pro_ans_key = $this->Problem_m->insert_pro_ans_db($upload_data) ;

                        }

                    }

                }

                $login_msg = "등록되었습니다 " ;
                $go_page = "/CI/Problem_set/problem_list/" . $group_v ;

            } else {
                $login_msg = "비정상 접근 입니다 " ;
                $go_page = "/CI/Problem_set/just_main" ;
            }

            alert($login_msg, $go_page);
            exit ;

        } else {
            $login_msg = "로그인 하세요 ";
            alert($login_msg, LOGIN_NEED_MASTER_URL);
            exit;
        }

    }

    public function problem_edit()
    {
        $data   = array();

        // 화면의 카테고리 표시 값 : $category
        $category	= array(
            'cate01'		=> 'leveltest' ,    // 분류 : 상
            'cate02'		=> '1',              // 분류 : 중
            'cate03'		=> ''               // 분류 : 하
        );
        $data['cate'] = $category;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        $n_auto = $this->uri->segment(3) ;      //  problem  key

        $tmp_d = $this->Problem_m->select_problem_one($n_auto) ;
        $data['problem_one_info'] = $tmp_d ;
        $group_v = $tmp_d->group_v ;    //  result_one_info
        $data['group_info'] = $this->Problem_m->select_pro_group_one($group_v) ;
        $data['list'] = $this->Problem_m->select_problem_list($group_v) ;
        $data['result_list'] = $this->Problem_m->select_pro_result_list($group_v) ;

        $data['ans_list'] = $this->Problem_m->select_problem_ans_one_problem_list($n_auto) ;

        $this->load->view('leveltest/problem_edit_v', $data);

    }

    public function problem_edit_db()
    {
        $this->load->helper('alert') ;

        $this->load->database();    // DB 연결
        $this->load->model(array('Problem_m'));

        if ( @$this->session->userdata('esangschool_logged_in') == TRUE)
        {

            //	폼 검증 라이브러리 로드
            $this->load->library('form_validation');

            //	폼 검증할 필드와 규칙 사전 정의

            $this->form_validation->set_rules('n_auto', ' key ', 'required');
            $this->form_validation->set_rules('group_v', ' key ', 'required');
            $this->form_validation->set_rules('question_str', 'qustion Title', 'required');

            if ($this->form_validation->run() == TRUE)
            {

                $n_auto = $this->commonclass->common_replace_quoto_f($this->input->post('n_auto', TRUE));
                $group_v = $this->commonclass->common_replace_quoto_f($this->input->post('group_v', TRUE));
                $num_v = $this->commonclass->common_replace_quoto_f($this->input->post('num_v', TRUE));
                $question_str = $this->commonclass->common_replace_quoto_f($this->input->post('question_str', TRUE));

                $ans_list = $this->Problem_m->select_problem_ans_one_problem_list($n_auto) ;

                $upload_data['n_auto'] = $n_auto ;
                $upload_data['group_v'] = $group_v ;
                $upload_data['num_v'] = $num_v ;
                $upload_data['question_str'] = $question_str ;

                $this->Problem_m->update_pro_db($upload_data) ;

                $pro_n_auto = $n_auto ;

                if ($pro_n_auto > 0) {

                    foreach ($ans_list as $lt) {

                        $n_ans = $lt->n_ans;

                        $name_num = "db_num_ans_" . $n_ans;
                        $name_str = "db_string_ans_" . $n_ans;
                        $name_next_question = "db_next_question_" . $n_ans;
                        $name_next_result = "db_next_result_" . $n_ans;

                        $ans_num_v = $this->commonclass->common_replace_quoto_f($this->input->post($name_num, TRUE));
                        $ans_str = $this->commonclass->common_replace_quoto_f($this->input->post($name_str, TRUE));
                        $next_q = $this->commonclass->common_replace_quoto_f($this->input->post($name_next_question, TRUE));
                        $n_result = $this->commonclass->common_replace_quoto_f($this->input->post($name_next_result, TRUE));

                        if ($ans_str != "") {
                            if ($next_q == "")      $next_q = 0 ;
                            if ($n_result == "")    $n_result = 0 ;

                            $upload_data['n_ans'] = $n_ans ;
                            $upload_data['ans_num_v'] = $ans_num_v ;
                            $upload_data['ans_str'] = $ans_str ;
                            $upload_data['next_q'] = $next_q ;
                            $upload_data['n_result'] = $n_result ;

                            $this->Problem_m->update_pro_ans_db($upload_data) ;

                        } else {

                            $upload_data['n_ans'] = $n_ans ;

                            $this->Problem_m->delete_pro_ans_db($upload_data) ;

                        }

                    }


                    for ($i=1; $i < 9; $i++) {
                        $name_num = "num_ans_" . $i;
                        $name_str = "string_ans_" . $i;
                        $name_next_question = "next_question_" . $i;
                        $name_next_result = "next_result_" . $i;

                        $ans_num_v = $this->commonclass->common_replace_quoto_f($this->input->post($name_num, TRUE));
                        $ans_str = $this->commonclass->common_replace_quoto_f($this->input->post($name_str, TRUE));
                        $next_q = $this->commonclass->common_replace_quoto_f($this->input->post($name_next_question, TRUE));
                        $n_result = $this->commonclass->common_replace_quoto_f($this->input->post($name_next_result, TRUE));

                        if ($next_q == "")      $next_q = 0 ;
                        if ($n_result == "")    $n_result = 0 ;

                        if ($ans_str != "") {
                            $upload_data['pro_n_auto'] = $pro_n_auto ;
                            $upload_data['group_v'] = $group_v ;
                            $upload_data['ans_num_v'] = $ans_num_v ;
                            $upload_data['ans_str'] = $ans_str ;
                            $upload_data['next_q'] = $next_q ;
                            $upload_data['n_result'] = $n_result ;

                            $pro_ans_key = $this->Problem_m->insert_pro_ans_db($upload_data) ;

                        }
                    }
                }

                $login_msg = "수정 등록되었습니다" ;
                $go_page = "/CI/Problem_set/problem_edit/" . $n_auto ;


            } else {
                $login_msg = "비정상 접근 입니다 " ;
                $go_page = "/CI/Problem_set/just_main" ;
            }

            alert($login_msg, $go_page);
            exit ;

        } else {
            $login_msg = "로그인 하세요 ";
            alert($login_msg, LOGIN_NEED_MASTER_URL);
            exit;
        }

    }

}
