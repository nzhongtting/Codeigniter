<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_problem extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->ci =& get_instance();
        $this -> load -> database();
        $this->load->model(array('Problem_m'));
    }

    public function index()
    {
        //  $this->lists();
    }

    public function title_set()
    {
        $this->run_check('Ajax_problem/title_set');
        $g_idx		        = $this->input->get_post( 'gidx', true );
        $g_title		    = $this->input->get_post( 'group_title', true );

        log_message('DEBUG', '#### CHK : Ajax_problem/title_set $g_idx : '.$g_idx.'  - by shhong');

        $arrays['group_v'] = $g_idx ;
        $arrays['group_title'] = $g_title ;

        $this->Problem_m-> update_group_title($arrays);
    }

    public function problem_group_del()
    {
        $this->run_check('Ajax_problem/problem_group_del');
        $g_idx		        = $this->input->get_post( 'gidx', true );

        log_message('DEBUG', '#### CHK : Ajax_problem/problem_group_del $g_idx : '.$g_idx.'  - by shhong');

        $result_cnt = $this->Problem_m->chk_group_state($g_idx);

        log_message('DEBUG', '#### CHK : Ajax_problem/problem_group_del $result_cnt : '.$result_cnt.'  - by shhong');
        $data = array();
        if( $result_cnt == 0 )
        {
            // 삭제 가능 -> 삭제
            $data['result_del'] = '1' ;
            $this->Problem_m->del_group($g_idx);
        }
        else
        {
            // 삭제 불가
            $data['result_del'] = '0' ;
        }

        $this->load->view('leveltest/just_lv_v', $data);
    }

    public function problem_question_del()
    {
        $this->run_check('Ajax_problem/problem_question_del');
        $n_auto		        = $this->input->get_post( 'nauto', true );
        $result_cnt =  $this->Problem_m->chk_question_state($n_auto);

        $data = array();
        if( $result_cnt == 0 )
        {
            // 삭제 가능 -> 삭제
            $data['result_del'] = '1' ;
            $this->Problem_m->del_question($n_auto);
        }
        else
        {
            // 삭제 불가
            $data['result_del'] = '0' ;
        }
        $this->load->view('leveltest/just_lv_v', $data);

    }

    public function problem_answer_del()
    {
        $this->run_check('Ajax_problem/problem_answer_del');
        $n_ans		        = $this->input->get_post( 'nans', true );
        $this->Problem_m->del_answer($n_ans);
    }
}
