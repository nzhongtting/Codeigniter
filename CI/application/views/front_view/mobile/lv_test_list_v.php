<?php
/**
 *  * Created by PhpStorm.
 * User: UiSoo Kim
 * Date: 2019-04-03
 * Time: 오후 3:57
 */

$test_question  = '';

if( $lv_test_list )
{
    $test_question  = $lv_test_list[0]->question_str;
}
?>

<script>
    function fn_next_question()
    {
        var q_answer   = $( '.q_answer:checked' )
            ,n_ans      = $( q_answer ).attr( 'n_ans' )     // 선택 답변
            ,next_q_key = $( q_answer ).attr( 'next_q' )    // 다은 문제
            ,n_result   = $( q_answer ).attr( 'n_result' )  // 결과

        // 답변 선택
        if( n_ans )
        {
            var now_q_key  = $( '#q_key' ).val()               // 현재 질문
                ,mem_answer = $( '#mem_answer' ).val();         // 누적 선택 답변

            // 누적 답변
            if( mem_answer )
                mem_answer  = jQuery.parseJSON( '<?php echo $mem_answer; ?>' );

            // 현재 답변
            var object      = {
                n_ans   : n_ans
                ,q_key  : now_q_key
            };

            // 답변 누적
            if( mem_answer )
                mem_answer.push( object );
            else
                mem_answer  = [object];

            mem_answer  = JSON.stringify( mem_answer );


            $( '#q_key' ).val( next_q_key );
            $( '#mem_answer' ).val( mem_answer );

            if(( next_q_key == 0 && n_result == 0 ) || ( next_q_key > 0 && n_result > 0 ))
            {
                // 답변에 다음 문제, 결론이 모두 없는 경우
                // 또는 다음 문제, 결론이 모두 있는 경우
                alert( '질문의 답변에 오류가 있습니다.' );
            }
            else if( next_q_key == 0 && n_result > 0 )
            {
                // 레벨테스트 결과
                $( '#n_result' ).val( n_result );

                // var act = "/CI/Leveltest/level_test_result";
                var act = "/CI/Leveltest/level_test_result";

                $( '#form_question' ).attr( 'action', act ).submit();
            }
            else
            {
                // 레벨테스트 다음 문제
                var group_v = '<?php echo $group_v; ?>'
                    ,quiz_no = '<?php echo $quiz_no +1; ?>';

                // var act = "/CI/Leveltest/level_test?group_v="+ group_v +"&quiz_no="+ quiz_no;
                var act = "/CI/Leveltest/level_test?group_v="+ group_v +"&quiz_no="+ quiz_no;

                $( '#form_question' ).attr( 'action', act ).submit();
            }
        }
        else
        {
            alert( '다음 질문에 해당 되는 것을 선택해주세요.' );
        }
    }
</script>

<?php
$attributes = array('id' => 'form_question', 'name' => 'form_question');
echo form_open( '' , $attributes );
?>
<input type="hidden" name="group_v" value="<?php echo $group_v; ?>" />                          <!-- 그룹 번호 -->
<input type="hidden" id="q_key" name="q_key" value="<?php echo $q_key; ?>" />                   <!-- 질문 번호 -->
<input type="hidden" id="mem_answer" name="mem_answer" value='<?php echo $mem_answer; ?>' />    <!-- 사용자 답변 -->
<input type="hidden" id="n_result" name="n_result" />                                             <!-- 사용자 결과 -->
<?php echo form_close(); ?>

<!-- container -->
<div class="container survey_wrap">
    <div class="survey_area">
        <p class="survey_info_txt">다음 질문에 해당 되는 것을 선택해주세요. </p>
        <!-- 질문 영역 시작 (공통질문) -->
        <div class="question_list active">
            <div class="question_num">
                <?php
                $q_img  = '/CI/application/views/assets/images/sub/level_num0'. $quiz_no .'.png';
                ?>
                <img src="<?php echo $q_img; ?>" alt="question1">
            </div>
            <h2 class="question_tit"><?php echo $test_question; ?></h2>
            <ul class="ans_list">
                <?php
                foreach( $lv_test_list as $lv_test )
                {
                    $n_ans      = $lv_test->n_ans;
                    $next_q     = $lv_test->next_q;
                    $n_result   = $lv_test->n_result;
                    $ans_str    = $lv_test->ans_str;

                    $ans_id     = 'ansQ1-0'. $n_ans;
                    ?>
                    <li>
                        <input type="radio" name="q_answer" class="q_answer" id="<?php echo $ans_id; ?>" n_ans="<?php echo $n_ans; ?>" next_q="<?php echo $next_q; ?>" n_result="<?php echo $n_result; ?>">
                        <label for="<?php echo $ans_id; ?>" class="ans_txt_wrap">
                            <i class="ckd_icon"></i>
                            <span class="ans_txt"><?php echo $ans_str; ?></span>
                        </label>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="btn_area">
                <a href="javascript:fn_next_question();" class="btn next_btn">
                    <img src="/CI/application/views/assets/images/sub/icon_level_btn01.png" alt="다음 질문">
                </a>
            </div>
        </div>
        <!-- 질문 영역 종료 -->
    </div>
</div>