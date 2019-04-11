<?php
$params 							= $this->uri->segment(3);

log_message('DEBUG', '#### PWD : just_lv_v.php/$params  : '.$params.'  - by shhong');

if( $params == "gettestresult" )
{
    foreach ($list as $lt)
    {
?>
        <tr>
            <td></td>
            <td ><?=$lt->question?></td>
            <td><?=$lt->answer?></td>
        </tr>
<?php
    }
}

if( $params == "getuserinfo" )
{
    $resultArr = array(); // 결과값

    //
    $inday = date("Y-m-d H:i:s", $userinfo['date_in']);

    if( $userinfo['result'] =='1' ) { $result = "<span class='label label-success'>입 문</span>"; }
    else   if( $userinfo['result'] =='2' ) { $result = "<span class='label label-primary'>초 급</span>"; }
    else   if( $userinfo['result'] =='5' ) { $result = "<span class='label label-warning'>중 급</span>"; }
    else   if( $userinfo['result'] =='9' ) { $result = "<span class='label label-danger'>고 급</span>"; }
    else                            { $result = ""; }

    array_push($resultArr,
        array(
        "date_in" =>  $inday
        ,"c_name" =>  $userinfo['c_name']
        ,"mphone" =>  $userinfo['mphone']
        ,"result" =>  $result
        ) );
    echo json_encode ( $resultArr );
}

if( $params == 'delactionresult' )
{
log_message('DEBUG', '#### CHK : just_lv_v.php $result_del : '.$result_del.'  - by shhong');
echo "$result_del";
}

if( $params == 'delactionquestion' )
{
    log_message('DEBUG', '#### CHK : just_lv_v.php $result_del : '.$result_del.'  - by shhong');
    echo "$result_del";
}

?>

