<?php
include HOSTING_MAIN_ROOT . "/application/views/leftmenu_admin.php" ;

//  /CI/Problem_set/problem_list/ 3

?>
<script src="//code.jquery.com/jquery.min.js"></script>
<script>
    var answer_cnt = 0 ;
    var error_chk1 = 0 ;
    var error_chk2 = 0 ;

    $(document).ready(function(){
        $("#add_problem_btn").click(function(){

            formcheck();

            if($("#question_str").val() == ''){
                alert('질문을 입력 해주세요.');
                $("#title_v").focus();
                return false;
            }
            else if ( answer_cnt < 2 )
            {
                alert('답 String 를 2개 이상 입력하세요');
                return false;
            }
            else if( error_chk1 > 0 )
            {
                alert('선택안함\n각 [답 String] 에 [Next 문제] 또는 [결론] 중 \n한가지를 꼭 선택해야 합니다.');
                return false;
            }
            else if( error_chk2 > 0 )
            {
                alert('2개선택\n각 [답 String] 에 [Next 문제] 또는 [결론] 중 \n한가지만 꼭 선택해야 합니다.');
                return false;
            }
            else
            {
               var act = '/CI/Problem_set/problem_add_db' ;
               $("#upload_action").attr('action', act).submit();
            }
        });
    });


    function formcheck()
    {
        var chk_cnt = $("input[class='chk0']").length; // 전체 개수
        answer_cnt = 0 ;
        error_chk1 = 0;
        error_chk2 = 0;

        for(var i=1; i < chk_cnt + 1 ; i++)
        {
            if( $('#string_ans_'+i).val() )
            {
                answer_cnt++;
                var next_val    = $('#next_question_'+i).val() * 1 ;
                var result_val  = $('#next_result_'+i).val()  * 1  ;
                var sum_next_result = next_val + result_val ;

                if( sum_next_result == 0 )
                {
                    error_chk1++;
                }

                if( $('#next_question_'+i+' option:selected').val() > 0  && $('#next_result_'+i+' option:selected').val() > 0  )
                {
                    error_chk2++;
                }

            }
        }
    }

</script>

<?php
//  group_info

$group_v = $this->uri->segment(3) ;
$group_title = $group_info->group_title ;

?>

<!--- main start  Div 에 작성 //-->
<!------------------------------------------------------------------------------------------------------------------------------ //-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="row">

            <!-- [시작] content-header //-->
            <section class="content-header">
                <h1>
                    문제 은행, 질문작성
                    <small> Problem List & input </small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Temp"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">레벨테스트</a></li>
                    <li class="active">문제은행</li>
                </ol>
            </section><br>
            <!-- [종료] content-header //-->

            <div class="col-xs-12"> <!--  1 //-->
                <div class="box box-primary"> <!--  2 //-->

                        <!-- [시작] 목록의 header //-->

                        <div class="box-header with-border">
                            <h3 class="box-title">LIST <i class="fa fa-fw fa-list-alt"></i>  -  <?php echo $group_title ; ?>  </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- [종료] 목록의 header //-->

                    <div class="box-body table-responsive no-padding">
                    <br>

                        <?php
                        $next_problem_num = 1 ;
                        include HOSTING_MAIN_ROOT . "/application/views/leveltest/part_list_problem.php" ;
                        ?>
                        <br>
                    </div>
                            <!-- [종료] 목록 //-->
                </div><!--  2 //-->
            </div><!--  1 //-->



                    <div class="col-xs-12"> <!--  1 //-->
                        <div class="box box-primary box box-primary collapsed-box"> <!--  2 //-->

                    <!-- [시작] 등록 header //-->

                    <div class="box-header with-border">
                        <h3 class="box-title">INPUTFORM <i class="fa fa-fw fa-edit"></i></h3>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!-- [종료] 등록 header //-->

                            <?php
                            $attributes = array('id' => 'upload_action', 'name' => 'upload_action');
                            echo form_open('Problem_set/problem_add_db' , $attributes);
                            ?>
                            <input type="hidden" name="group_v" value="<?php echo $group_v ; ?>">

                            <table class="table">
                                <tbody>
                                <tr>
                                    <th width="20%">No. <input type="text" class="form-control" id="num_v" name="num_v" value="<?php echo $next_problem_num ; ?>"></th>
                                    <th width="60%">질문 <input type="text" class="form-control" id="question_str" name="question_str" ></th>
                                    <th width="30%">&nbsp;</th>
                                </tr>
                                </tbody></table>

                            <h4><b>질문의 답변 & 다음문제</b></h4>
                            <table class="table table-hover">
                                <tbody>
                                <tr bgcolor="#dee0e0" onmouseover="this.style.background='#dee0e0'" onmouseout="this.style.background='#dee0e0'" >
                                    <th width="10%">순서</th>
                                    <th width="20%">답 String</th>
                                    <th width="50%">Next 문제</th>
                                    <th width="20%">결론</th>
                                </tr>
                                <?php
                                for ($i=1; $i < 9; $i++) {
                                $name_num = "num_ans_" . $i ;
                                $name_str = "string_ans_" . $i ;
                                $name_next_question = "next_question_" . $i ;
                                $name_next_result = "next_result_" . $i ;
                                ?>
                                <tr>
                                    <td><input type="text" class="form-control" id="<?php echo $name_num ; ?>" name="<?php echo $name_num ; ?>" value="<?php echo $i ; ?>" style="width: 50px; text-align: right;"></td>
                                    <td><input type="text" class="form-control" id="<?php echo $name_str ; ?>" name="<?php echo $name_str ; ?>" value="" style="width: 150px; "></td>
                                    <td>

                                        <select class="form-control" name="<?php echo $name_next_question ; ?>" id="<?php echo $name_next_question ; ?>">
                                            <?php echo $opt_question ; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="<?php echo $name_next_result ; ?>" id="<?php echo $name_next_result ; ?>">
                                            <?php echo $opt_result ; ?>
                                        </select>
                                    </td>
                                    <input type="hidden" class='chk0'>
                                </tr>

                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" align="right">
                                        <a href="/CI/Problem_set" class="btn btn-default" role="button" style="width: 100px">목록으로</a>&nbsp;&nbsp;
                                        <button type="button" class="btn btn-primary pull-right" id="add_problem_btn">질문등록</button>
                                    </td>
                                </tr>
                                </tbody></table>

                            </form>
                        </div><!--  2 //-->
                    </div><!--  1 //-->

        </div>
    </section>
</div>

<!-----  ------------------------------------------------------------------------------------------------------------------------ //-->