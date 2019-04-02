<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//	메세지 출력후 이동
function alert($msg='MOVE ON !!', $url='')
{
	$CI =& get_instance();
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset'). "\" />" ;
	echo "
	<SCRIPT type='text/JavaScript'>
	alert('".$msg."');
	location.replace('".$url."');
	</SCRIPT>";
	exit ;
}


//	창 닫기
function alert_close($msg)
{
	$CI =& get_instance();
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset'). "\" />" ;

	echo "
	<SCRIPT type='text/JavaScript'>
	alert('".$msg."');
	window.close();
	</SCRIPT>";
	exit ;
	
}


//	경고창만
function alert_only($msg, $exit=TRUE)
{
	$CI =& get_instance();
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset'). "\" />" ;

	echo "
	<SCRIPT type='text/JavaScript'>
	alert('".$msg."');
	</SCRIPT>";
	if ($exit) {
		exit ;
	}
	
}

// 단지 메세지 출력
function just_msg($msg, $exit=TRUE)
{
    $CI =& get_instance();
    echo "$msg";
    if ($exit) {
        exit ;
    }
}


//	
function replace($url = '/')
{
	echo "<SCRIPT type='text/JavaScript'>" ;
	if ($url) echo "window.location.replace('".$url."')" ;
	echo "</SCRIPT>";
	exit ;
}

/* End of file */
