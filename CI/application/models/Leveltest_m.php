<?php
/**
 *  * Created by PhpStorm.
 * User: UiSoo Kim
 * Date: 2019-04-04
 * Time: 오후 1:03
 */

class Leveltest_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    // 첫 문제 키 조회
    function select_first_question($param)
    {
        $sql = "SELECT  tp.n_auto
                FROM    `Tbl_problem` tp
                        ,(
                          SELECT	group_v
                                    ,MIN( num_v ) AS num_v
                            FROM	`Tbl_problem`
                            WHERE	group_v = {$param['group_v']}
                            GROUP BY
                                    group_v
                        ) tp2
                WHERE   tp.group_v  = tp2.group_v
                AND     tp.num_v    = tp2.num_v
                LIMIT   1";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // 문제 조회
    function select_question($param)
    {
        $sql = "SELECT	tp.n_auto
                        ,tpa.n_ans
                        ,tp.question_str
                        ,tpa.ans_str
                        ,tpa.next_q
                        ,tpa.n_result
                        ,tp.group_v
                FROM	`Tbl_problem`	tp
                        ,`Tbl_pro_ans`	tpa
                WHERE	tp.group_v	= {$param['group_v']}
                AND		tp.n_auto	= {$param['q_key']}
                AND		tp.group_v	= tpa.group_v
                AND		tp.n_auto	= tpa.pro_n_auto
                ORDER BY
                        tpa.ans_num_v ASC";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // 테스트 결과 조회
    function select_question_result($param)
    {
        $sql    = "SELECT	*
                    FROM	`Tbl_pro_result`
                    WHERE	group_v		= {$param['group_v']}
                    AND		n_result	= {$param['r_num']}";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // 테스트 결과 저장
    function insert_tbl_customer_info($param)
    {
        $insert_array   = array(
            'date_in'   => $param['date_in']
            ,'c_name'   => $param['c_name']
            ,'mphone'	=> $param['mphone']
            ,'result'   => $param['result']
            ,'g_idx'    => $param['group_v']
        );
        $this->db->insert('Tbl_customer_info', $insert_array);

        $result = $this->db->insert_id();
        return $result;
    }

    // 테스트 답변 저장
    function insert_tbl_leveltest_result($param)
    {
        $insert_array   = array(
            'c_idx'         => $param['c_idx']
            ,'b_idx'        => $param['b_idx']
            ,'b_result_val' => $param['b_result_val']
            ,'g_idx'        => $param['group_v']
        );
        $this->db->insert('Tbl_leveltest_result', $insert_array);

        $result = $this->db->insert_id();
        return $result;
    }
}