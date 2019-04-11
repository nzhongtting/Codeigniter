<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Levellist extends MY_Controller
{

    function __construct() {
        parent::__construct();
        $this -> load -> database();
        $this -> load -> model('Levellist_m');
        $this->load->library('pagination');
    }

    public function index()
    {
        $this->run_check('Levellist/index()');
        $this->list_detail();
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


    public function list_detail()
    {
        ### [기본 Set-up] #####################################
        $data   = array();
        // 화면의 카테고리 표시 값 : $category
        $category	= array(
            'cate01'		=> 'leveltest' ,    // 분류 : 상 - 레벨테스트
            'cate02'		=> '0',             // 분류 : 중 - 결과목록
            'cate03'		=> ''               // 분류 : 하 - 없음
        );


        ### [페이징] #####################################

        ################################################################################################################################################
        /// [시작] segment 정의 -----------------------------------

        // library - pagination 사용시 URL segment '6' 은 항상 page number 임 - by shhong
        if($this->uri->segment(6)){
            $page = ($this->uri->segment(6)) ;
        }
        else{
            $page = 0;
        }

        if($this->uri->segment(3)){
            $searchname = ($this->uri->segment(3)) ;
        }
        else{
            $searchname = 0;
        }

        if($this->uri->segment(4)){
            $searchphone = ($this->uri->segment(4)) ;
        }
        else{
            $searchphone = 0;
        }

        if($this->uri->segment(5)){
            $searchtype = ($this->uri->segment(5)) ;
        }
        else{
            $searchtype = '0';
        }

        $sum_uri = "/".$searchname."/".$searchphone."/".$searchtype ;  // uri 를 3 , 4, 5 까지 합친것 기본
        /// [종료] segment 정의 -----------------------------------

        ################################################################################################################################################
        /// [시작] 페이징 설정값 SET ----------------------------

        $config = array();
        $config["base_url"] = base_url() . "./Levellist/index".$sum_uri;      // uri 3 - 검색 type , uri 4 - 검색어 , uri 5 - 예비 , uri 6 - 페이지 번호
        $perpage    = 10 ;       // 한페이지에 출력되는 목록 수

        $searchphone    = urldecode($searchphone) ;
        $searchname     = urldecode($searchname) ;
        $searchtype    = urldecode($searchtype) ;

        $sum_search_val= array();
        $sum_search_val['searchphone'] = $searchphone ;
        $sum_search_val['searchname'] = $searchname ;
        $sum_search_val['searchtype'] = $searchtype ;

        log_message('debug', '#### PWD : $searchtype : '.$searchtype.' - by shhong');

        $total_row  = $this ->Levellist_m->search_record_count($sum_search_val);

        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config["total_rows"] = $total_row;
        $config["per_page"] = $perpage ;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2;
        $config['cur_tag_open'] = '<li class="active">&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';


        /// [종료] 페이징 설정값 SET ----------------------------

        ################################################################################################################################################
        /// [시작] 페이징 번호 계산 ----------------------------
        function rise_x($total_row , $page  , $perpage )
        {
            $page   = $page - 1 ;
            $j = 0 ;
            $arraynum = array();
            for($i=0;$i<$total_row;$i+=$perpage)
            {
                $arraynum[$j] = $i ;
                $j++;
            }
            $k = $arraynum[$page];
            return $k;
        }

        if( $page > 0  )
        {
            $valx  =  rise_x($total_row , $page , $perpage)  ;
        }
        else
        {
            $valx  =  0 ;
        }
        /// [종료] 페이징 번호 계산 ----------------------------

        $this->pagination->initialize($config);

        ################################################################################################################################################

        $data['list'] = $this -> Levellist_m -> get_list($valx,$config["per_page"] ,$sum_search_val);

        foreach ( $data['list'] as $item )
        {
            // Tbl_level_temporary 에 추ㄱㅏ 여부를    $item->temporary_yon 에 담아서 보낸다.
            $result_cnt = $this -> Levellist_m -> chk_temporary($item->c_idx);
            $item->temporary_yon = $result_cnt ;

            $groupinfo = $this->Levellist_m -> get_group_info($item->g_idx,'');
            $item->groupname      = $groupinfo['group_title'] ;
        }

        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

        $data["temporary_list"] = $this -> Levellist_m -> get_temporary_list();
        foreach ( $data['temporary_list'] as $it )
        {
            $userinfo = $this->Levellist_m->get_levetest_userinfo($it->c_idx,'');
            $it->c_name         = $userinfo['c_name'] ;
            $it->result         = $userinfo['result'] ;
            $it->mphone         = $userinfo['mphone'] ;
            $it->c_datein       = $userinfo['date_in'] ;
        }

        $data['group_list'] = $this -> Levellist_m -> get_leveltest_group();

        $data['cate'] = $category;
        $this->load->view('leveltest/lv_list_v', $data);
    }

}
