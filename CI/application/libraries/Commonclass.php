<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }

class Commonclass {

	public function common_replace_quoto_f($str_v) {
		$str_v = trim($str_v) ;
		$str_v = str_replace("'", "", $str_v) ;
		$str_v = str_replace("\"", "", $str_v) ;
		$str_v = trim($str_v) ;
		return $str_v ;
	}		
	

	public function common_url_explode($url, $key) {
		$cnt = count($url) ;
		for ($i=0; $cnt>$i; $i++) {
			if ($url[$i] == $key) {
				$k = $i + 1 ;
				return $url[$k] ;
			}
		}
	}

	public function common_segment_explode($seg)  {
		//	세그먼트 앞 뒤 / 를 제거한 후 url 를 배열로 반환
		$len = strlen($seg) ;
		if (substr($seg, 0, 1) == "/") {
			$seg = substr($seg, 1, $len) ;
		}

		$len = strlen($seg) ;
		if (substr($seg, -1) == "/") {
			$seg = substr($seg, 0, $len-1) ;
		}

		$seg_exp = explode("/", $seg) ;

		return $seg_exp ;
	}


	public function common_time_str_to_sec_f($date_str, $first_end_check) {
		//	common_time_str_to_sec_f(2016-07-21, 0)		2016-07-21 00:00:01	시간... 시작일
		//	common_time_str_to_sec_f(2016-08-21, 1)		2016-08-21 23:59:59 시간... 종료일

		$date_str = trim($date_str) ;	//	2016-07-21 

		$SSS = explode("-", $date_str) ;

		$YY = trim($SSS[0]) ;
		$MM = trim($SSS[1]) ;
		$DD = trim($SSS[2]) ;

		$time_sec = mktime(0, 0, 0, $MM, $DD, $YY);     //	mktime([시간], [분], [초], [월], [일], [연도]);

		if ($first_end_check == 0)	$time_sec++ ;
		else						$time_sec = $time_sec + 86400 - 1 ;
		
		return $time_sec ;
	}		

}

/*	end of Commonclass.php	*/
