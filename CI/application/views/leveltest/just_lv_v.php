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


if( $params == "memoinfo" )
{
    $inday = date("Y-m-d", $each_memo['date_in']);
    $content = nl2br($each_memo['memo_body']);
    echo "<tr><td height='50px'></td><td>".$content."</td></tr><tr><td></td><td style='text-align: right'>등록일 : ".$inday."</td></tr>" ;
}


if( $params == "getuserinfo" )
{
    $resultArr = array(); // 결과값

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


if( $params == 'memolist' )
{
    $cnt = 0 ;
    foreach ($memolist as $lt)
    {
        $inday = date("Y-m-d", $lt->date_in);
        $body_text = strip_tags( $lt->memo_body );
        $msg_v = cut_string($body_text, 50) ;
?>
        <tr style="text-align: center">
            <td><?=$inday?></td>
            <td><?=$msg_v?></td>
            <td align="center">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs" data-toggle="modal" data-target="#modal-memo" onclick="get_memo('<?=$lt->m_idx?>','<?=$lt->c_idx?>')" >확인</button>
                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td>
                            <button type="button" class="btn btn-block btn-warning btn-xs" onclick="delmemo('<?=$lt->m_idx?>','<?=$lt->c_idx?>')">삭제</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
<?php
    $cnt++;
    }

    if($cnt == 0 )
    {
        echo "<tr style='text-align: center'><td colspan='3' align='center' height='190px'> <br><br><br>등록된 메모가 없습니다.</td></tr>";
    }
    if($cnt == 1 )
    {
        echo "<tr style='text-align: center'><td colspan='3' align='center' height='150px'> </td></tr>";
    }
    if($cnt == 2 )
    {
        echo "<tr style='text-align: center'><td colspan='3' align='center' height='110px'> </td></tr>";
    }
    if($cnt == 3 )
    {
        echo "<tr style='text-align: center'><td colspan='3' align='center' height='70px'> </td></tr>";
    }
    if($cnt == 4 )
    {
        echo "<tr style='text-align: center'><td colspan='3' align='center' height='35px'> </td></tr>";
    }


}

?>

