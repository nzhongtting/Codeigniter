<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Levellist extends MY_Controller
{

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
        $data   = array();

        // 화면의 카테고리 표시 값 : $category
        $category	= array(
            'cate01'		=> 'leveltest' ,    // 분류 : 상 - 레벨테스트
            'cate02'		=> '0',             // 분류 : 중 - 결과목록
            'cate03'		=> ''               // 분류 : 하 - 없음
        );

        $data['cate'] = $category;
        $this->load->view('leveltest/lv_list_v', $data);
    }

}
