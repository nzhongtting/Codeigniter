<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 사용자 인증 모델
 */
class Auth_m extends CI_Model 
{

    function __construct()
    {
        parent::__construct();
    }

    function select_master_id_info($id_v, $count_data)
    {
        $sql = "SELECT * FROM Tbl_admin_user where id_v = '" . $id_v . "' " ;
        $query = $this->db->query($sql);

        if ($count_data == 'count')
        {
            $result = $query->num_rows();
        }
        else
        {
            $result = $query->row();
        }
        return $result;
    }

}