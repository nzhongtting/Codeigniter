<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 사용자 인증 모델
 */
class Levellist_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function search_record_count($sum_search_val)
    {
        $wherequery = $this->searchtype_query($sum_search_val);
        $sql = "SELECT COUNT(*) As cnt FROM Tbl_customer_info WHERE c_idx LIKE '%%'".$wherequery ;
        log_message('debug', '#### PWD : Levellist_m/search_record_count $sql : '.$sql.' - by shhong');
        $q = $this->db->query($sql);
        $row = $q->row();
        return $row->cnt;
    }

    function get_list($offset , $limit , $sum_search_val)
    {
        $wherequery = $this->searchtype_query($sum_search_val);
        $limit_query = '';
        if ($limit != '' OR $offset != '')
        {
            // 페이징이 있을 경우 처리
            $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
        }
        $sql = "SELECT * FROM Tbl_customer_info WHERE c_idx LIKE '%%'" . $wherequery . " ORDER BY c_idx desc  " . $limit_query;
        log_message('debug', '#### PWD : Levellist_m/get_list $sql : '.$sql.' - by shhong');
        $query = $this -> db -> query($sql);
        $result = $query -> result();
        return $result;
    }


    public function searchtype_query($sum_search_val)
    {

        log_message('debug', '#### PWD : Levellist_m/searchtype_query  - by shhong');

        $wherequery = "";

        if( $sum_search_val['searchphone'] != '0')
        {
            $wherequery .= " and mphone like '%".$sum_search_val['searchphone']."%' ";
        }

        if( $sum_search_val['searchname'] != '0')
        {
            $wherequery .= " and c_name like '%".$sum_search_val['searchname']."%' ";
        }

        if( $sum_search_val['searchtype'] != '0')
        {

            $cutword = explode("|", $sum_search_val['searchtype'] );

            if($cutword[0]  != '0')
            {
                $wherequery .= " and result = '".$cutword[0]."' ";
            }

            if(!empty($cutword[1]))
            {
                $wherequery .= " and g_idx = '".$cutword[1]."' ";
            }

            if(!empty($cutword[2]))
            {
                $wherequery .= " and chk_pc_m = '".$cutword[2]."' ";
            }

        }

        log_message('DEBUG', '#### PWD : Levellist_m/searchtype_query $wherequery : '.$wherequery.'  - by shhong');
        return $wherequery ;
    }

    function chk_temporary($c_idx)
    {
        $sql ="SELECT * FROM Tbl_level_temporary where increase between '1' and '5' and c_idx ='".$c_idx."' ";
        $query = $this->db->query($sql);
        return  $query->num_rows();
    }

    function get_temporary_list()
    {
        $sql =" select * from Tbl_level_temporary where increase between 1 and 5  order by increase desc ";
        log_message('DEBUG', '#### PWD : Levellist_m/get_temporary_list $sql : '.$sql.'  - by shhong');
        $query = $this->db->query($sql);
        return $query->result();
    }

    function set_temporary_info($c_idx)
    {

        $sql ="SELECT  max(increase) as maxval FROM Tbl_level_temporary where increase between '1' and '5' ";
        $query = $this->db->query($sql);
        $row = $query->row();

        if( $row->maxval == '5' )
        {
            $sql = "update  Tbl_level_temporary set increase = increase - 1 where increase between '1' and '5' ";
            $this->db->query($sql);
            $insert_increase_val = 5 ;
        }
        else
        {
            $insert_increase_val = $row->maxval + 1 ;
        }

        log_message('debug', '#### SQL : Levellist_m/set_temporary_info $insert_increase_val : '.$insert_increase_val.' - by shhong');

        $insert_array = array(
            'date_in' => time(),
            'c_idx' => $c_idx,
            'increase' => $insert_increase_val
        ) ;
        $this->db->insert('Tbl_level_temporary', $insert_array);
        log_message('debug', '#### SQL : Levellist_m/set_temporary_info : '.$this->db->last_query() .' - by shhong');
        $result = $this->db->insert_id() ;
    }

    function get_temporary_result($type)
    {
        $sql ="SELECT * FROM Tbl_level_temporary where increase between '1' and '5' ";
        log_message('DEBUG', '#### PWD : Levellist_m/get_temporary_result $sql : '.$sql.'  - by shhong');
        $query = $this->db->query($sql);

        if( $type == 'count')
        {
            return  $query->num_rows();
        }
        else
        {
            return $query->result();
        }
    }

    function get_leveltest_result($justget,$type)
    {
        $sql ="SELECT * FROM ".$justget['tablenname']." where c_idx ='" . $justget['c_idx'] . "'  ";
        log_message('DEBUG', '#### PWD : Levellist_m/get_leveltest_result $sql : '.$sql.'  - by shhong');
        $query = $this->db->query($sql);

        if( $type == 'count')
        {
            return  $query->num_rows();
        }
        else
        {
            return $query->result();
        }
    }

    function get_question_str($idx,$type)
    {
        $sql ="Select * from Tbl_problem where n_auto='".$idx."' ";
        $query = $this->db->query($sql);

        if( $type == 'count')
        {
            return  $query->num_rows();
        }
        else
        {
            log_message('DEBUG', '#### PWD : Levellist_m/get_question_str $sql : '.$sql.'  - by shhong');
            return $query->row_array();
        }
    }

    function get_answer_str($idx,$type)
    {
        $sql ="Select * from Tbl_pro_ans where n_ans='".$idx."' ";
        $query = $this->db->query($sql);

        if( $type == 'count')
        {
            return  $query->num_rows();
        }
        else
        {
            log_message('DEBUG', '#### PWD : Levellist_m/get_answer_str $sql : '.$sql.'  - by shhong');
            return $query->row_array();
        }
    }

    function get_levetest_userinfo($idx,$type)
    {
        $sql ="Select * from Tbl_customer_info where c_idx='".$idx."' ";
        $query = $this->db->query($sql);

        if( $type == 'count')
        {
            return  $query->num_rows();
        }
        else
        {
            log_message('DEBUG', '#### PWD : Levellist_m/get_levetest_userinfo $sql : '.$sql.'  - by shhong');
            return $query->row_array();
        }
    }

    function get_leveltest_group()
    {
        $sql ="Select * from Tbl_pro_group order by group_v desc ";
        $query = $this->db->query($sql);
        log_message('DEBUG', '#### PWD : Levellist_m/get_leveltest_group $sql : '.$sql.'  - by shhong');
        return $query->result();
    }

    function get_group_info($idx,$type)
    {
        $sql = "Select * from Tbl_pro_group where group_v='" . $idx . "' ";
        $query = $this->db->query($sql);

        if ($type == 'count') {
            return $query->num_rows();
        } else {
            log_message('DEBUG', '#### PWD : Levellist_m/get_group_info $sql : ' . $sql . '  - by shhong');
            return $query->row_array();
        }
    }

    ### DELETE 레벨테스트 결과
    function db_delete_result($cidx)
    {
        log_message('DEBUG', ' #### PWD : Levellist_m/db_delete_result $cidx :'.$cidx.' - by shhong');

        $this->db->where('c_idx', $cidx);
        $this->db->delete('Tbl_customer_info');

        $this->db->where('c_idx', $cidx);
        $this->db->delete('Tbl_leveltest_result');

        $this->db->where('c_idx', $cidx);
        $this->db->delete('Tbl_level_temporary');

    }

}
