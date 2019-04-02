<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sec_time_convert_to_string($sec_v, $ret_type) {
    $RET_V = "" ;
    if ($sec_v > 100) {
        if ($ret_type == "Ymd") {
            $RET_V = date("Y-m-d", $sec_v) ;
        } else if ($ret_type == "time") {
            $RET_V = date("H:i:s", $sec_v) ;
        } else {
            $RET_V = date("Y-m-d H:i:s", $sec_v) ;
        }
    }
    return $RET_V ;
}

# 함수명 : 문자열 자르기 함수 3개 함수로 구성
# 사용법 : hangul("자를 문자열", 원하는 문자열 길이);

function is_han($text) {
    $text = ord($text);
    if($text >= 0xa1 && $text <= 0xfe)
	return 1;
}

function is_alpha($char) {
    $char = ord($char);
    if($char >= 0x61 && $char <= 0x7a)		return 1;
    if($char >= 0x41 && $char <= 0x5a)		return 2;
}

function cut_string($str, $length) {

	$alpha = 0 ;

    $str = trim($str) ;

    if ($str != "") {
        if(strlen($str) <= $length) {
            return $str;
        } else {

            $str = " " . $str . " " ;
            $str = @iconv("utf-8", "euc-kr", $str);		//	str_iconv($data, "utf-8", "euc-kr");
            $hangul = 0 ;
            $first = $second = 0;

            for($co = 1; $co <= $length; $co++) {
                if(is_han(substr($str, $co - 1, $co))) {
                    if($first) { // first 값이 있으면 한글의 두번째 바이트로 정의
                        $second = 1;
                        $first  = 0;
                    } else {     // first 값이 없으면 한글의 첫번째 바이트로 정의
                        $first  = 1;
                        $second = 0;
                    }
                    $hangul = 1;
                } else {
                    $first = $second = 0;
                    if(is_alpha(substr($str, $co - 1, $co)) == 2) {
                        $alpha++;
                    }
                }
            }
            if($first)
                $length--;


            if($hangul)
                $str = chop(substr($str, 0, $length));
            else
                $str = chop(substr($str, 0, $length - intval($alpha * 0.5)));


            $str = iconv("euc-kr", "utf-8", $str);		//	str_iconv($data, "utf-8", "euc-kr");


            return $str."..";
        }
    } else {
        return $str;
    }

    return $str;
}

function MakeSecond_F($ye, $mo, $da, $ho, $mi, $se) {       	//				년, 월,	일,		시, 분, 초
	$time_second = mktime($ho, $mi, $se, $mo, $da, $ye) ;
	return $time_second ;
}


function before_month_from_now_month($now_y_month_str) {    //  2018-07  형태..
    $Ret_v = "" ;
    if ($now_y_month_str != "") {
        $SS = explode("-", $now_y_month_str) ;
        $today_sec_v = MakeSecond_F($SS[0], $SS[1], 10, 0, 0, 0) ;
        $before_month_sec = $today_sec_v - 86400 * 30 ;
        $Ret_v = date("Y-m", $before_month_sec) ;
    }
    return $Ret_v ;
}

function date_str_to_sec($date_str) {
	$ret_v = 0 ;
	$date_str = trim($date_str) ;	//	2016-09-28 13:22:33  형태
	if (strcmp($date_str, "")) {
		$SSS = explode(" ", $date_str) ;
		$date_tmp_1 = trim($SSS[0]) ;
		$date_tmp_2 = trim($SSS[1]) ;

		$s_date = explode("-", $date_tmp_1) ;
		$s_time = explode(":", $date_tmp_2) ;

		$ret_v = MakeSecond_F($s_date[0], $s_date[1], $s_date[2], $s_time[0], $s_time[1], $s_time[2]) ;
	}

	return $ret_v ;
}

function date_short_str_to_sec($date_str) {
    $ret_v = 0 ;
    $date_str = trim($date_str) ;	//	2016-09-28 형태
    if (strcmp($date_str, "")) {
        $date_str = $date_str . " 00:00:01" ;
        $ret_v = date_str_to_sec($date_str) ;
    }

    return $ret_v ;
}


function pagination_replae_sky($pagination) {
    $pagination = str_replace("<ul>", "", $pagination) ;
    $pagination = str_replace("</ul>", "", $pagination) ;
    $pagination = str_replace("<li>", "", $pagination) ;
    $pagination = str_replace("</li>", "", $pagination) ;

    $pagination = str_replace("<a ", "<a class='page_link_pagination' ", $pagination) ;

    //  </a> &nbsp; <a

    $pagination = str_replace("</a> &nbsp; <a", "</a> <a", $pagination) ;

    return $pagination ;
}

function comma_make_null_replae_sky($str_v) {
    $str_v = str_replace(",", "", $str_v) ;
    $str_v = $str_v * 1 ;
    return $str_v ;
}

function get_percent_two_number_f($price_1, $price_2) {
    $percent_point_2 = "0.00" ;
    if ($price_2 > 0) {
        $percent_v = $price_1 / $price_2 * 100 ;
        $percent_point_2 = number_format($percent_v, 2, '.', '');
    }
    return $percent_point_2 ;
}

function array_double_same_return_f($array_a) {
    $tmp_str = "" ;
    for ($i=0; $i < sizeof($array_a); $i++) {
        for ($si=($i+1); $si < sizeof($array_a); $si++) {
            if ($array_a[$i] == $array_a[$si]) {
                if ($tmp_str == "")     $tmp_str = $array_a[$i] ;
                else                    $tmp_str = $tmp_str . "," . $array_a[$i] ;
            }
        }
    }   //  for
    $ret_A = explode(",", $tmp_str) ;
    return $ret_A ;
}

function same_array_del_array_unique_f($array_a) {
    $tmp_str = "" ;
    array_unique($array_a) ;
    for ($i=0; $i <= sizeof($array_a); $i++) {
        if (empty($array_a[$i]) == false ) {
            if (strlen($array_a[$i]) != '') {    //  div_2_no_div
                if ($tmp_str == "")     $tmp_str = $array_a[$i] ;
                else                    $tmp_str = $tmp_str . "," . $array_a[$i] ;
            }
        }
    }   //  for
    $ret_A = explode(",", $tmp_str) ;
    return $ret_A ;
}


function array_same_del_check_duplicate_del_array_unique_f($array_a) {
    $tmp_str = "" ;
    array_unique($array_a) ;
    for ($i=0; $i <= sizeof($array_a); $i++) {
        if (empty($array_a[$i]) == false ) {
            if (strlen($array_a[$i]) > 11) {    //  div_2_no_div
                if ($tmp_str == "")     $tmp_str = $array_a[$i] ;
                else                    $tmp_str = $tmp_str . "," . $array_a[$i] ;
            }
        }
    }   //  for
    $ret_A = explode(",", $tmp_str) ;
    return $ret_A ;
}


function array_duplicate_del_array_unique_f($array_a) {
    $tmp_str = "" ;
    for ($i=0; $i <= sizeof($array_a); $i++) {
        if (empty($array_a[$i]) == false ) {
            if (strlen($array_a[$i]) > 11) {    //  010-8875-9661
                if ($tmp_str == "")     $tmp_str = $array_a[$i] ;
                else                    $tmp_str = $tmp_str . "," . $array_a[$i] ;
            }
        }
    }   //  for
    $ret_A = explode(",", $tmp_str) ;
    return $ret_A ;
}

function array_check_duplicate_del_ff($s1, $s2) {
    for ($i=0; $i < sizeof($s1); $i++) {
        for ($aa=0; $aa < sizeof($s2); $aa++) {
            if ($s1[$i] == $s2[$aa]) {
                $s1[$i] = "" ;
                break ;
            }
        }
    }
    $new_i = 0 ;
    $ret_A = "" ;
    for ($i=0; $i < sizeof($s1); $i++) {
        if ($s1[$i] != '') {
            $ret_A[$new_i] = $s1[$i] ;
            $new_i++ ;
        }
    }
    if ($new_i == 0) {
        $ret_A[0] = "010-0000-0000" ;
    }
    return $ret_A ;
}

function header_top_class_on_check($uri_1, $uri_2) {
    $uri_1_2 = $uri_1 . "/" . $uri_2 ;

    for ($i=0; $i < 6; $i++) {
        $class_on[$i] = "" ;
    }

    //  http://main.lsinvest.co.kr/z_dir/ci/lsinvest_design_board/add_board/0
    if ($uri_1 == "lsinvest_design_board") {
        if ( ($uri_2 == "add_board") || ($uri_2 == "list_board") ||($uri_2 == "list_board_view") ||($uri_2 == "list_board_edit") ) {
            $class_on[0] = " class=\"on\"" ;
        }
    }

    if ($uri_1 == "lsinvest_design_set") {
        if ( ($uri_2 == "analyst_mem_list") || ($uri_2 == "analyst_mem_add") ||($uri_2 == "analyst_mem_update") || ($uri_2 == "club_list") || ($uri_2 == "club_add") || ($uri_2 == "club_update") ) {
            $class_on[0] = " class=\"on\"" ;
        }
    }

    if ($uri_1 == "lsinvest_design_sale") {
        if (
            $uri_2 == "list_marketing" ||
            $uri_2 == "list_marketing_kind_1_add" ||
            $uri_2 == "list_marketing_add" ||
            $uri_2 == "list_marketing_edit" ||
            $uri_2 == "month_marketing" ||
            $uri_2 == "month_landing_check" ||
            $uri_2 == "list_group" ||
            $uri_2 == "list_mem_group"

        ) {
            $class_on[0] = " class=\"on\"" ;
        }
    }

    if ($uri_1 == "lsinvest_design_set") {
        if (
            ($uri_2 == "member_list") ||
            ($uri_2 == "club_member_search_list") ||
            ($uri_2 == "club_mem_list") ||

            ($uri_2 == "nomem_list") ||
            ($uri_2 == "club_refund_list") ||
            ($uri_2 == "black_no_sms_send_list") ||
            ($uri_2 == "member_excel_add") ||
            ($uri_2 == "nomem_check_club_list") ||

            ($uri_2 == "member_view") ||
            ($uri_2 == "club_mem_again_list") ||
            ($uri_2 == "club_mem_again_search_list") ||

            ($uri_2 == "club_member_re_damdang") ||

            ($uri_2 == "member_info_change_list") )
        {
            $class_on[1] = " class=\"on\"" ;
        }
    }

    if ($uri_1 == "lsinvest_design_sale") {
        if (
            ($uri_2 == "month_new_sale") ||
            ($uri_2 == "neo_month_check_sale") ||
            ($uri_2 == "neo_month_man_check_sale") ||
            ($uri_2 == "news_count_month_check")  )
        {
            $class_on[2] = " class=\"on\"" ;
        }
    }


    if ($uri_1 == "lsinvest_design_set") {
        if (
            ($uri_2 == "club_stock_list") ||
            ($uri_2 == "club_stock_del_list")  )
        {
            $class_on[3] = " class=\"on\"" ;
        }
    }

    //  lsinvest_stock_set/club_stock_day_end_list
    if ($uri_1 == "lsinvest_stock_set") {
        if  ($uri_2 == "club_stock_day_end_list")
        {
            $class_on[3] = " class=\"on\"" ;
        }
    }


    if ($uri_1 == "lsinvest_design_set") {
        if (
            ($uri_2 == "munja_day_simple_view_list") ||
            ($uri_2 == "munja_reserve_list")  )
        {
            $class_on[4] = " class=\"on\"" ;
        }
    }

    if ($uri_1 == "lsinvest_work") {
        if (
            ($uri_2 == "board_list") ||
            ($uri_2 == "board_write") ||
            ($uri_2 == "board_view")  )
        {
            $class_on[5] = " class=\"on\"" ;
        }
    }

    return $class_on ;

}

function session_account_team_special_check_f($id_v) {
    /*
    김경아 : tmxkr
    허남천 : sky9
    최민혁 : cmh9066
    윤동건 : ydg3412
    박상훈 : veloce30   analyst011
    김세영 : abong

     성신헌 : sung777
     박주희 : jhee88
     이유라 : uraura
     김병섭 : kbs1045
     */
    $super_side_admin = 0 ;
    if (
        ($id_v == "sky9") ||
        ($id_v == "cmh9066") ||
        ($id_v == "ydg3412") ||
        ($id_v == "tmxkr") ||
        ($id_v == "veloce30") ||
        ($id_v == "analyst011") ||
        ($id_v == "sung777") ||
        ($id_v == "jhee88") ||
        ($id_v == "uraura") ||
        ($id_v == "abong") ||
        ($id_v == "kbs1045")
    ) {
        $super_side_admin = 1 ;
    }
    return $super_side_admin ;
}

//  //  man_manage=5:man_time=5:sale=5:bonus=5:money=5:man_id=5:money_cal=5:cal_set=5:group_set=5
/*
    man_manage_v	직원관리	1 : 조회만 가능  5 : 등록 수정 삭제 가능
    man_time_v	    근태관리	1 : 조회만 가능  5 : 등록 수정 삭제 가능
    sale_v	        매출관리	1 : 조회만 가능  5 : 등록 수정 삭제 가능
    bonus_v	        성과금	    1 : 조회만 가능  5 : 등록 수정 삭제 가능
    money_v	        시책관리  	1 : 조회만 가능  5 : 등록 수정 삭제 가능
    man_id_v	    계정관리	1 : 조회만 가능  5 : 등록 수정 삭제 가능
    money_cal_v	    정산관리	1 : 조회만 가능  5 : 등록 수정 삭제 가능
    cal_set_v	    정산설정	1 : 조회만 가능  5 : 등록 수정 삭제 가능
    group_set_v	    소속관리	1 : 조회만 가능  5 : 등록 수정 삭제 가능
 */

function page_no_nnnnnnnnnn_level_check_f($level_str, $field_v) {     //  group_set
    //  man_manage=5:man_time=5:sale=5:bonus=5:money=5:man_id=5:money_cal=5:cal_set=5:group_set=5
    $ret_v = 0 ;
    if ($level_str != "") {
        $SSS = explode(":", $level_str) ;

        for ($i=0; $i < sizeof($SSS); $i++) {
            $tmp_v = trim($SSS[$i]) ;
            if ($tmp_v != "") {
                $part_s = explode("=", $tmp_v) ;
                $title_v = $part_s[0] ;
                $value_v = $part_s[1] ;
                if ($title_v == $field_v) {
                    $ret_v = $value_v ;
                    break ;
                }
            }
        }
    }

    return $ret_v ;

}

function payment_type_view($type_no)        // sale_set
{

    if( $type_no == '01') { $view_type = "삭제"; }
    else if( $type_no == '02') { $view_type = "입금"; }
    else if( $type_no == '03') { $view_type = "환불"; }
    else if( $type_no == '04') { $view_type = "정지"; }
    else if( $type_no == '05') { $view_type = "정지해제"; }
    else if( $type_no == '06') { $view_type = "이동매출"; }
    else if( $type_no == '07') { $view_type = "이동환불"; }
    else if( $type_no == '08') { $view_type = "취소"; }
    else if( $type_no == '09') { $view_type = "환불삭제"; }
    else if( $type_no == '99') { $view_type = "기타"; }
    else { $view_type = ""; };

    return $view_type ;
}
