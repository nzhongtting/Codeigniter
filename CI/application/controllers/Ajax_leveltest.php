<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_leveltest extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->ci =& get_instance();
        $this -> load -> database();
        $this->load->model(array('Levellist_m'));
        $this->load->helper('viewutil') ;
    }

    public function index()
    {
        //  $this->lists();
    }

    public function get_memo()
    {
        $this->run_check('Ajax_leveltest/get_memo');
        $m_idx		    = $this->input->get_post( 'm_idx', true );
        $data					= array();

        $data['each_memo'] = $this->Levellist_m->get_memo($m_idx);

        $this->load->view('leveltest/just_lv_v', $data);
    }

    public function just_get()
    {
        $this->run_check('Ajax_leveltest/just_get');
        $c_idx		    = $this->input->get_post( 'c_idx', true );

        log_message('debug', '#### PWD : just_get : '.$c_idx.' - by shhong');

        $justget['tablenname'] = 'Tbl_leveltest_result' ;
        $justget['c_idx']  = $c_idx ;

        $result_cnt = $this->Levellist_m->get_leveltest_result($justget,'count');

        log_message('DEBUG', '#### CHK : Ajax_leveltest/just_get $result_cnt : '.$result_cnt.'  - by shhong');

        if( $result_cnt > 0 )
        {
            $data					= array();
            $data['list']           = $this->Levellist_m->get_leveltest_result($justget,'');

            foreach ( $data['list'] as $item )
            {
                $result_cnt1 = $this->Levellist_m->get_question_str($item->b_idx,'count');
                if( $result_cnt1 == '1')
                {
                    $result_val = $this->Levellist_m->get_question_str($item->b_idx,'');
                    $item->question = $result_val['question_str'];
                }
                else
                {
                    $item->question = 'EMPTY or DELETED';
                }

                $result_cnt2 = $this->Levellist_m->get_answer_str($item->b_result_val,'count');
                if( $result_cnt2 == '1')
                {
                    $result_val = $this->Levellist_m->get_answer_str($item->b_result_val,'');
                    $item->answer = $result_val['ans_str'];
                }
                else
                {
                    $item->answer = 'EMPTY or DELETED';
                }
            }

            $this->load->view('leveltest/just_lv_v', $data);
        }
        else
        {
            log_message('DEBUG', '#### CHK : Ajax_leveltest/just_get  - by shhong');
        }
    }

    public function get_user()
    {
        $this->run_check('Ajax_leveltest/get_user');
        $c_idx		    = $this->input->get_post( 'c_idx', true );

        $data					= array();
        $result_cnt = $this->Levellist_m->get_levetest_userinfo($c_idx,'count');

        log_message('DEBUG', '#### CHK : Ajax_leveltest/get_user $result_cnt : '.$result_cnt.'  - by shhong');

        if( $result_cnt == '1' )
        {
            $data['userinfo'] = $this->Levellist_m->get_levetest_userinfo($c_idx,'');
        }
        else
        {
            log_message('DEBUG', '#### CHK : Ajax_leveltest/get_user  -empty- by shhong');
        }

        $this->load->view('leveltest/just_lv_v', $data);
    }

    public function get_tempry()
    {
        $this->run_check('Ajax_leveltest/get_tempry');
        $c_idx		    = $this->input->get_post( 'c_idx', true );
        $this->Levellist_m->set_temporary_info($c_idx);
    }

    public function set_result()
    {
        $this->run_check('Ajax_leveltest/set_result');
        $c_idx		    = $this->input->get_post( 'c_idx', true );
        $this->Levellist_m->db_delete_result($c_idx);
    }

    public function get_memo_list()
    {
        $this->run_check('Ajax_leveltest/get_memo_list');
        $c_idx		    = $this->input->get_post( 'c_idx', true );
        $data					= array();

        $data['memolist'] = $this->Levellist_m->get_memo_list($c_idx,'');
        $this->load->view('leveltest/just_lv_v', $data);
    }

    public function del_memo()
    {
        $this->run_check('Ajax_leveltest/del_memo');
        $m_idx		    = $this->input->get_post( 'm_idx', true );

        $this->Levellist_m->del_memo($m_idx);
    }

    public function memo_save()
    {
        $this->run_check('Ajax_leveltest/memo_save');
        $memo_body         = $this->commonclass->common_replace_quoto_f($this->input->post('memobody', TRUE));
        $c_idx              = $this->commonclass->common_replace_quoto_f($this->input->post('selected_c_idx', TRUE));


        log_message('DEBUG', '#### CHK : Ajax_leveltest/memo_save  :'.$memo_body.' by shhong');

        $arrays['memo_body']    = $memo_body;
        $arrays['c_idx']        = $c_idx;

        $this->Levellist_m->memo_save($arrays);
    }

}
