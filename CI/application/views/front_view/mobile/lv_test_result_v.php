<?php
/**
 *  * Created by PhpStorm.
 * User: UiSoo Kim
 * Date: 2019-04-04
 * Time: 오후 3:35
 */
// 퍼블 : /lsinvest/m/html/level_test/level_result.html

$title_v    = '';
$video_url  = '';
$r_img_title= '';
$r_img_url  = '';
$level_key  = '';

if( $lv_test_result )
{
    $title_v    = $lv_test_result->title_v;
    $video_url  = $lv_test_result->img_1_link;
    $r_img_title= $lv_test_result->img_2;
    $r_img_url  = $lv_test_result->img_2_link;
    $level_key  = $lv_test_result->level_key;
}
?>

<script>
    jQuery(document).ready(function($)
    {
        // 서비스 이용약관 팝업
        $( '.lvResult_input .show' ).click( function(e)
        {
            e.preventDefault();
            $( 'body' ).css( 'overflow', 'hidden' );
            $( '.policyPop, .popup-bg' ).show();
        });

        // 서비스 이용약관 팝업 닫기
        $( '.popup-bg, .close_btn, .policyPop .close' ).on( 'click', function(e)
        {
            e.preventDefault();
            $( 'body' ).css( 'overflow', 'visible' );
            $( '.policyPop' ).hide();
        });
    });

    // 테스트 결과 저장
    function fn_save_test_result()
    {
        var user_name   = $( '#user_name' ).val()
            ,mobile_01   = $( '#mobile_01' ).val()
            ,mobile_02   = $( '#mobile_02' ).val()
            ,mobile_03   = $( '#mobile_03' ).val()
            ,agree_psn   = $( '#terms_check01' ).is( ':checked' )
            ,agree_sms   = $( '#terms_check02' ).is( ':checked' );


        if( !user_name )
        {
            alert( '이름을 입력해주세요.' );
        }
        else if( !mobile_01 || mobile_02.length < 3 || mobile_03.length < 4 )
        {
            alert( '연락처를 입력해주세요.' );
        }
        else if( !agree_psn )
        {
            alert( '이용약관 동의 해주세요.' );
        }
        else if( !agree_sms )
        {
            alert( 'SMS 동의 해주세요.' );
        }
        else
        {
            // var act = "/CI/Leveltest/save_test_result";
            var act = "/CI/Leveltest/save_test_result";

            $( '#form_result' ).attr( 'action', act ).submit();
        }
    }

    // 인풋 숫자만
    function fn_only_number(event)
    {
        var key_code   = event.keyCode;

        if(( key_code >= 48 && key_code <= 57 ) || ( key_code >= 96 && key_code <= 105 ) || ( key_code == 8 ))
        {

        }
        else
        {
            event.returnValue   = false;
        }
    }

    // 인풋 최대 글자수
    function fn_max_length(target)
    {
        if( target.value.length > target.maxLength )
        {
            target.value    = target.value.slice( 0, target.maxLength );
        }
    }
</script>

<!-- container -->
<div class="container level_result">
    <div class="lvResult_area">
        <div class="play_wrap">
            <iframe width="100%" height="170" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer;encrypted-media; gyroscope; picture-in-picture"></iframe>
            <span class="now_view"><span><em class="level_txt">[입문]</em> 강의 맛보기 시청중</span></span>
        </div>
        <div class="lvResult">
            <img class="lv_01 active" src="<?php echo $r_img_url; ?>" alt="<?php echo $r_img_title; ?>" />
        </div>
        <div class="lvResult_input">
            <?php
            $attributes = array('id' => 'form_result', 'name' => 'form_result');
            echo form_open( '' , $attributes );
            ?>
                <input type="hidden" name="group_v" value='<?php echo $group_v; ?>' />          <!-- 그룹 번호 -->
                <input type="hidden" name="mem_answer" value='<?php echo $mem_answer; ?>' />    <!-- 사용자 답변 -->
                <input type="hidden" name="n_result" value='<?php echo $n_result; ?>' />        <!-- 사용자 결과 키 -->
                <input type="hidden" name="level_key" value='<?php echo $level_key; ?>' />      <!-- 결과 레벨 키 -->

                <label>
                    <span class="input_txt">이름</span>
                    <input type="text" class="input_basic" id="user_name" name="user_name" maxlength="10" />
                </label>
                <label>
                    <span class="input_txt">연락처</span>
                    <span class="input_phone_box">
                        <select id="mobile_01" name="mobile_01" >
                            <option value="010" selected="selected">010</option>
                            <option value="011">011</option>
                            <option value="016">016</option>
                            <option value="017">017</option>
                            <option value="018">018</option>
                            <option value="019">019</option>
                        </select> - <input type="number" class="input_sm" maxlength="4" id="mobile_02" name="mobile_02" onkeydown="fn_only_number(event);" oninput="fn_max_length(this)" /> - <input type="number" class="input_sm" maxlength="4" id="mobile_03" name="mobile_03" onkeydown="fn_only_number(event);" oninput="fn_max_length(this)" />
                    </span>
                </label>
            <?php echo form_close(); ?>

            <ul class="policy">
                <li class="check clearfix">
                    <input type="checkbox" id="terms_check01" value="" name="chk_1" ><label for="terms_check01"><I class="ckd_icon"></I><span class="fll">서비스 이용약관 및 개인정보처리방침에 동의</span><a href="#;" class="show fll">보기</a></label>
                </li>
                <li class="check">
                    <input type="checkbox" id="terms_check02" value="" name="chk_2" ><label for="terms_check02"><I class="ckd_icon"></I><span>SMS 수신 동의</span></label>
                </li>
            </ul>
            <div class="btn_area">
                <a href="javascript:fn_save_test_result();" class="btn compBtn">
                    <img src="/CI/application/views/assets/images/sub/icon_lvResult_btn.gif">
                </a>
            </div>
        </div>
    </div>
</div>
<!-- container end -->

<!-- 서비스 이용약관 팝업 -->
<div class="policyPop" >
    <div class="popup-bg"></div>
    <div class="pop_content">
        <div class="top_cont">
            <h2>서비스 이용약관 및 개인정보처리방침</h2><a href="#;" class="close"></a>
        </div>
        <ul class="policy_list_area">
            <li>
                <h3>서비스 이용약관</h3>
                <p class="txt">개인정보처리 및 이용에 대한 필수 동의를 거부할 권리가 있습니다. <br>그러나 동의를 거부하실 경우, School 에서 제공하는 서비스를 <br>이용하실 수 없습니다.그러나 동의를 거부하실 경우, School 에서 </p>
            </li>
            <li>
                <h3>개인정보처리방침</h3>
                <p class="txt">개인정보처리 및 이용에 대한 필수 동의를 거부할 권리가 있습니다. <br>그러나 동의를 거부하실 경우, School 에서 제공하는 서비스를 <br>이용하실 수 없습니다.그러나 동의를 거부하실 경우, School 에서 </p>
            </li>
        </ul>
        <a href="#" class="close_btn">닫기</a>
    </div>
</div>
<!-- 서비스 이용약관 종료 -->

<!--<script>
    // 서비스 이용약관 팝업
    $('.lvResult_input .show').on('click', function(e){
        e.preventDefault();
        $('body').css('overflow', 'hidden');
        $('.policyPop, .popup-bg').show();
    });
    // 서비스 이용약관 팝업 닫기
    $('.popup-bg, .close_btn, .policyPop .close').on('click', function(e){
        e.preventDefault();
        $('body').css('overflow', 'visible');
        $('.policyPop').hide();
    });
    $('.compBtn').on('click', function(){
        alert('상담 신청이 완료 되었습니다.');
        location.href='https://pf.kakao.com/_yrGNj';
    });
</script>-->