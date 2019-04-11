<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 문제은행 모델

Tbl_pro_group
    group_v		문제 그룹
    group_title	그룹 Title

Tbl_problem
    n_auto
    group_v		문제 그룹
    num_v		보이는 번호
    question_str	질문

Tbl_pro_ans
    n_ans
    pro_n_auto
    group_v		문제 그룹
    ans_num_v	답변 번호
    ans_str		답변 String
    next_q		답변 선택했을때  다음 문제
    n_result	답변 선택했을때  다음 결과~~~

Tbl_pro_result
    n_result
    group_v		문제 그룹
    title_v		초급, 입문, ~~~
    msg_v		설명 표현~~~ html code
    img_1
    img_1_link
    img_2
    img_2_link

 */

class Problem_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function select_pro_group()
    {
        $sql = "SELECT * FROM Tbl_pro_group order by group_v desc limit 100 " ;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function select_pro_group_one($one_group)
    {
        $sql = "SELECT * FROM Tbl_pro_group where group_v = $one_group limit 1 " ;
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    function insert_pro_group_db($arrays)
    {
        $insert_array = array(
            'group_title' => $arrays['group_title']
        ) ;
        $this->db->insert('Tbl_pro_group', $insert_array);
        $result = $this->db->insert_id() ;
        return $result;
    }

    function select_problem_list($one_group)
    {
        $sql = "SELECT * FROM Tbl_problem where group_v = $one_group order by num_v asc limit 100 " ;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function select_problem_one($n_auto)
    {
        $sql = "SELECT * FROM Tbl_problem where n_auto = $n_auto limit 1 " ;
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    function insert_problem_db($arrays)
    {
        $insert_array = array(
            'group_v' => $arrays['group_v']   ,
            'num_v' => $arrays['num_v']   ,
            'question_str' => $arrays['question_str']
        ) ;
        $this->db->insert('Tbl_problem', $insert_array);
        $result = $this->db->insert_id() ;
        return $result;
    }

    function select_problem_ans_all_list($one_group)
    {
        $sql = "SELECT * FROM Tbl_pro_ans where group_v = $one_group order by pro_n_auto asc,  ans_num_v asc limit 500 " ;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function select_problem_ans_one_problem_list($pro_n_auto)
    {
        $sql = "SELECT * FROM Tbl_pro_ans where pro_n_auto = $pro_n_auto order by ans_num_v asc limit 500 " ;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function insert_pro_ans_db($arrays)
    {
        $insert_array = array(
            'pro_n_auto' => $arrays['pro_n_auto']   ,
            'group_v' => $arrays['group_v']   ,
            'ans_num_v' => $arrays['ans_num_v']   ,
            'ans_str' => $arrays['ans_str']   ,
            'next_q' => $arrays['next_q']   ,
            'n_result' => $arrays['n_result']
        ) ;
        $this->db->insert('Tbl_pro_ans', $insert_array);
        $result = $this->db->insert_id() ;
        return $result;
    }

    function update_pro_db($arrays)
    {
        $modify_array = array(
            'num_v' => $arrays['num_v']   ,
            'question_str' => $arrays['question_str']
        ) ;
        $Where_array = array(
            'n_auto' => $arrays['n_auto']
        ) ;
        $this->db->update('Tbl_problem', $modify_array, $Where_array);

        return true ;
    }

    function update_pro_ans_db($arrays)
    {
        $modify_array = array(
            'ans_num_v' => $arrays['ans_num_v']   ,
            'ans_str' => $arrays['ans_str']   ,
            'next_q' => $arrays['next_q']   ,
            'n_result' => $arrays['n_result']
        ) ;
        $Where_array = array(
            'n_ans' => $arrays['n_ans']
        ) ;
        $this->db->update('Tbl_pro_ans', $modify_array, $Where_array);

        return true ;
    }

    function delete_pro_ans_db($arrays) {
        $Where_array = array(
            'n_ans' => $arrays['n_ans']
        ) ;
        $this->db->delete('Tbl_pro_ans', $Where_array);
        return true ;
    }


    function select_pro_result_list($one_group)
    {
        $sql = "SELECT * FROM Tbl_pro_result where group_v = $one_group order by title_v asc limit 50 " ;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function select_pro_result_one_info($n_result)
    {
        $sql = "SELECT * FROM Tbl_pro_result where n_result = $n_result limit 1 " ;
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }


    function insert_pro_result_db($arrays)
    {
        $insert_array = array(
            'group_v' => $arrays['group_v']   ,
            'title_v' => $arrays['title_v']   ,
            'msg_v' => $arrays['msg_v']   ,
            'img_1' => $arrays['img_1']   ,
            'img_1_link' => $arrays['img_1_link']   ,
            'img_2' => $arrays['img_2']   ,
            'img_2_link' => $arrays['img_2_link'],
            'level_key' => $arrays['level_key']
        ) ;
        $this->db->insert('Tbl_pro_result', $insert_array);
        $result = $this->db->insert_id() ;
        return $result;
    }


    function update_pro_result_db($arrays)
    {
        $modify_array = array(
            'title_v' => $arrays['title_v']   ,
            'msg_v' => $arrays['msg_v']   ,
            'img_1' => $arrays['img_1']   ,
            'img_1_link' => $arrays['img_1_link']   ,
            'img_2' => $arrays['img_2']   ,
            'img_2_link' => $arrays['img_2_link'],
            'level_key' => $arrays['level_key']
        ) ;
        $Where_array = array(
            'n_result' => $arrays['n_result']
        ) ;
        $this->db->update('Tbl_pro_result', $modify_array, $Where_array);

        return true ;
    }

    function update_group_title($arrays)
    {
        $modify_array = array(
            'group_title' => $arrays['group_title']
        ) ;
        $Where_array = array(
            'group_v' => $arrays['group_v']
        ) ;
        $this->db->update('Tbl_pro_group', $modify_array, $Where_array);
    }

    function chk_group_state($gidx)
    {
        $sql = "SELECT count(*) cnt FROM Tbl_problem where group_v = '".$gidx."'" ;
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result->cnt;
    }

    function del_group($gidx)
    {
        $Where_array = array(
            'group_v' => $gidx
        ) ;
        $this->db->delete('Tbl_pro_group', $Where_array);
        return true ;
    }

    function chk_question_state($n_auto)
    {
        $sql = "SELECT count(*) cnt FROM Tbl_pro_ans where pro_n_auto = '".$n_auto."'" ;
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result->cnt;
    }

    function del_question($n_auto)
    {
        $Where_array = array(
            'n_auto' => $n_auto
        ) ;
        $this->db->delete('Tbl_problem', $Where_array);
        return true ;
    }

    function del_answer($n_ans)
    {
        $Where_array = array(
            'n_ans' => $n_ans
        );
        $this->db->delete('Tbl_pro_ans', $Where_array);
        return true ;
    }
}
