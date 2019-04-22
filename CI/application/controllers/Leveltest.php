<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leveltest extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->ci =& get_instance();
//        $this->load->model(array('lsinvest_set_m', 'lsinvest_sale_m', 'lsinvest_board_m', 'group_set_m'));
//        $this->load->helper(array('form', 'url', 'viewutil_helper'));
//        $this->load->library(array('session', 'commonclass', 'common_file_class'));

        $this->load->model( array( 'Leveltest_m' ));
        $this->load->helper( array( 'cookie', 'url' ));
//        $this->load->library( array( 'session' ));
    }

    public function index()
    {
    }

    public function _remap($method)
    {
        $this->load->database();
//        $this->load->view('header_mobile');
        $this->load->view('header_lv_test');
        if( method_exists($this, $method) )
        {
            $this->{"{$method}"}();
        }
        $this->load->view('footer_lv_test');
    }


    // 페이지 - 레벨 테스트
    public function level_test()
    {
        $this->load->helper('alert');
        $return_url = "https://www.google.co.kr/";

        $this->load->database();

        $group_v    = $this->input->get_post( 'group_v', true );
        $quiz_no    = $this->input->get_post( 'quiz_no', true );
        $q_key      = $this->input->get_post( 'q_key', true );
        $mem_answer = $this->input->get_post( 'mem_answer', true );

        if( $quiz_no > 0 && $group_v > 0 )
        {
            $param  = array(
                'group_v'   => $group_v
            );

            // 첫 문제 키 조회
            if( $quiz_no == 1 )
            {
                $first_q    = $this->Leveltest_m->select_first_question( $param );

                if( $first_q )
                    $q_key  = $first_q[0]->n_auto;
                else
                    alert( '해당 그룹의 질문이 없습니다.', $return_url );
            }

            if( $q_key )
            {
                // 문제 조회
                $param['q_key'] = $q_key;
                $question_list  = $this->Leveltest_m->select_question( $param );


                $data   = array(
                    'q_key'         => $q_key
                    ,'lv_test_list' => $question_list
                    ,'mem_answer'   => $mem_answer
                    ,'quiz_no'      => $quiz_no
                    ,'group_v'      => $question_list[0]->group_v
                );

                $this->load->view('front_view/mobile/lv_test_list_v', $data);
            }
            else
            {
                alert( '존재하지 않는 질문입니다.', $return_url );
            }
        }
        else
        {
            alert( '잘 못된 접근입니다.', $return_url );
        }
    }


    // 페이지 - 레벨 테스트 결과
    public function level_test_result()
    {
        $mem_answer = $this->input->get_post( 'mem_answer', true );
        $n_result   = $this->input->get_post( 'n_result', true );
        $group_v    = $this->input->get_post( 'group_v', true );

        // 테스트 결과 조회
        $param  = array(
            'group_v'   => $group_v
            ,'r_num'    => $n_result
        );
        $q_result   = $this->Leveltest_m->select_question_result( $param );

        if( $q_result )
            $q_result   = $q_result[0];

        $data   = array(
            'mem_answer'        => $mem_answer
            ,'n_result'         => $n_result
            ,'lv_test_result'   => $q_result
            ,'group_v'          => $group_v
        );

        $this->load->view('front_view/mobile/lv_test_result_v', $data);
    }


    // 페이지 - 레벨 테스트 결과
    public function save_test_result()
    {
        $this->load->helper('alert');

        $save_error = false;

        $group_v    = $this->input->get_post( 'group_v', true );
        $mem_answer = $this->input->get_post( 'mem_answer', true );
        $n_result   = $this->input->get_post( 'n_result', true );
        $level_key  = $this->input->get_post( 'level_key', true );
        $user_name  = $this->input->get_post( 'user_name', true );
        $mobile_01  = $this->input->get_post( 'mobile_01', true );
        $mobile_02  = $this->input->get_post( 'mobile_02', true );
        $mobile_03  = $this->input->get_post( 'mobile_03', true );
        $chk_pc_m   = $this->input->get_post( 'chk_pc_m', true );       // [추가] PC or Mobile 구분 추가 by shhong 20190422

        $mobile = $mobile_01 .'-'. $mobile_02 .'-'. $mobile_03;

        $date_sec   = time();

        // 테스트 결과 저장
        $result_param  = array(
            'date_in'   => $date_sec
            ,'c_name'   => $user_name
            ,'mphone'   => $mobile
            ,'result'   => $level_key
            ,'group_v'  => $group_v
            ,'chk_pc_m' => $chk_pc_m            // [추가] PC or Mobile 구분 추가 by shhong 20190422
        );

        $c_idx  = $this->Leveltest_m->insert_tbl_customer_info( $result_param );

        if( $c_idx )
        {
            // 테스트 답변 저장
            $mem_answer = json_decode( $mem_answer );

            foreach( $mem_answer as $answer )
            {
                $answer_param   = array(
                    'c_idx'         => $c_idx
                    ,'b_idx'        => $answer->q_key
                    ,'b_result_val' => $answer->n_ans
                    ,'group_v'      => $group_v
                );
                $r_idx  = $this->Leveltest_m->insert_tbl_leveltest_result( $answer_param );

                if( !$r_idx )
                {
                    $save_error = true;
                    break;
                }
            }
        }
        else
        {
            $save_error = true;
        }

        if( $save_error )
            alert( '레벨테스트 결과 저장중 오류가 발생하였습니다.', "https://www.google.co.kr/" );
        else
            alert( '상담 신청이 완료 되었습니다.', "https://pf.kakao.com/_yrGNj" );
    }
}