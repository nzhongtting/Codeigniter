<?php
include HOSTING_MAIN_ROOT . "/application/views/leftmenu_admin.php" ;

//  /CI/Problem_set/problem_list/ 3

//  group_info

$n_auto = $this->uri->segment(3) ;      //  problem  key

$group_v = $group_info->group_v ;
$group_title = $group_info->group_title ;

?>

<script>

    var answer_cnt = 0 ;
    var error_chk1 = 0 ;
    var error_chk2 = 0 ;

    $(document).ready(function(){
        $("#add_problem_btn").click(function(){

            formcheck();

            if($("#title_v").val() == ''){
                alert('이름을 입력해주세요.');
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
                var act = '/CI/Problem_set/problem_edit_db' ;
                $("#upload_action").attr('action', act).submit();
            }
        });


        function formcheck()
        {
            // 질문의 답변이 추가된 것
            var db_string_ans = 0 ;
            var db_error_chk1 = 0 ;
            var db_error_chk2 = 0 ;

            <?php
            $script_str = "";
            foreach ($ans_list as $lt)
            {
                $n_ans = $lt->n_ans ;
                $script_str = "
                if( $('#db_string_ans_".$n_ans."').val() ) 
                {
                    db_string_ans++; 
                    
                    var sum_db_question = 0 ;
                    sum_db_question = ( $('#db_next_question_".$n_ans."').val() * 1 ) + ( $('#db_next_result_".$n_ans."').val() * 1 ) ; 
                    if( sum_db_question == 0 ) { db_error_chk1++; }

                    if( $('#db_next_question_".$n_ans." option:selected').val() > 0  && $('#db_next_result_".$n_ans." option:selected').val() > 0  )
                    {
                    db_error_chk2++;
                    }
                }";
                echo "$script_str";
            }
            ?>
            console.log("db_string_ans : "+db_string_ans);

            // 기본적으로 출력되는 8개 체크
            var chk_cnt = $("input[class='chk0']").length; // 전체 개수
            answer_cnt = 0 + db_string_ans ;
            error_chk1 = 0 + db_error_chk1 ;
            error_chk2 = 0 + db_error_chk2 ;

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

            // console.log("answer_cnt : "+answer_cnt);
            // console.log("error_chk1 : "+error_chk1);
            // console.log("error_chk2 : "+error_chk2);
        }



        $("#add_new_problem_btn").click(function(){
            var act = '/CI/Problem_set/problem_list/<?php echo $group_v ; ?>' ;
            $("#upload_action").attr('action', act).submit();
        });
    });

    function del_question(Z)
    {
        ans = confirm("정말 삭제하시겠습니까 ?\n(삭제항목이 이미 적용되었으면 삭제되지 않습니다)\n참조 - 삭제시 기존 등록된 것의 답 표시는 [EMPTY or DELETED] 표시 됩니다. ");
        if( ans == true )
        {

            $.ajax({cache:false,url: "/CI/Ajax_problem/problem_question_del/delactionquestion",data: { nauto : Z }, success: function(result)
                {
                    if( result )
                    {
                        $('#del_result').val(result);
                    }
                },
                complete: function()
                {
                    if( $('#del_result').val() == 1 )
                    {
                        alert('정상적으로 삭제되었습니다.');
                        location.href="/CI/Problem_set/problem_list/<?=$problem_one_info->group_v?>";
                    }
                    else if( $('#del_result').val() == 0  )
                    {
                        alert('해당 문제 질문에 답변이 등록되어 있어 삭제 할 수 없습니다.');
                    }
                }
            });
        }
    }

    function del_answer(Z)
    {
        ans = confirm("정말 삭제하시겠습니까 ?\n참조 - 삭제시 기존 등록된 것의 답 표시는 [EMPTY or DELETED] 표시 됩니다. ");
        if( ans == true )
        {

            $.ajax({cache:false,url: "/CI/Ajax_problem/problem_answer_del",data: { nans : Z }, success: function(result)
            {},
                complete: function()
                {
                    location.reload();
                }
            });

        }
    }
</script>


<!--- main start  Div 에 작성 //-->
<!------------------------------------------------------------------------------------------------------------------------------ //-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="row">

            <!-- [시작] content-header //-->
            <section class="content-header">
                <h1>
                    문제 은행, 질문수정
                    <small> Problem List & modify </small>
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
                            <h3 class="box-title">LIST <i class="fa fa-fw fa-list-alt"></i>  - <?php echo $group_title ; ?> </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- [종료] 목록의 header //-->



                    <div class="box-body table-responsive no-padding">
                        <br>
                        <?php
                        include HOSTING_MAIN_ROOT . "/application/views/leveltest/part_list_edit_problem.php" ;
                        ?>

                        <br>
                    </div>
                    <!-- [종료] 목록 //-->
                </div><!--  2 //-->
            </div><!--  1 //-->

            <div class="col-xs-12"> <!--  1 //-->
                <div class="box box-primary box box-primary collapsed-box"> <!--  2 //-->

                    <!-- [시작] 수정 header //-->

                    <div class="box-header with-border">
                        <h3 class="box-title">MODIFYFORM <i class="fa fa-fw fa-edit"></i></h3>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!-- [종료] 수정 header //-->

                                <?php
                                /*

                                Tbl_problem
                                    n_auto
                                    group_v		문제 그룹
                                    num_v		보이는 번호
                                    question_str	질문

                                Tbl_pro_ans
                                    n_ans
                                    pro_n_auto
                                    group_v		문제 그룹
                                    ans_num_v	답변 번호
                                    ans_str		답변 String
                                    next_q		답변 선택했을때  다음 문제
                                    n_result	답변 선택했을때  다음 결과~~~

                                Tbl_pro_result
                                    n_result
                                    group_v		문제 그룹
                                    title_v		초급, 입문, ~~~
                                    msg_v		설명 표현~~~ html code
                                    img_1
                                    img_1_link
                                    img_2
                                    img_2_link
                                */

                                ?>

                                <BR>
                                <?php
                                $attributes = array('id' => 'upload_action', 'name' => 'upload_action');
                                echo form_open('Problem_set/problem_edit_db' , $attributes);

                                ?>
                                <input type="hidden" name="n_auto" value="<?php echo $problem_one_info->n_auto ; ?>">
                                <input type="hidden" name="group_v" value="<?php echo $group_v ; ?>">
                                <input type="hidden" name="del_result" id="del_result" value="">

                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th width="20%">No. <input type="text" class="form-control" id="num_v" name="num_v" value="<?php echo $problem_one_info->num_v ; ?>"></th>
                                        <th width="60%">질문 <input type="text" class="form-control" id="question_str" name="question_str" value="<?php echo $problem_one_info->question_str ; ?>" ></th>
                                        <th width="30%">&nbsp;</th>
                                    </tr>
                                    </tbody></table>

                    <h4><b>질문의 답변 & 다음문제</b> <small class="text-red"> *  답변삭제시 - "답 String" 를 지우고 "수정"하여도 삭제 가능 </small></h4>
                    <table class="table table-hover">
                        <tbody>
                        <tr bgcolor="#dee0e0" onmouseover="this.style.background='#dee0e0'" onmouseout="this.style.background='#dee0e0'" >
                            <th width="10%">순서</th>
                            <th width="20%">답 String</th>
                            <th width="40%">Next 문제</th>
                            <th width="25%">결론</th>
                            <th width="5%" style="text-align: center">처리</th>
                        </tr>
                        <?php
                        foreach ($ans_list as $lt) {

                        $n_ans = $lt->n_ans ;
                        $ans_num_v = $lt->ans_num_v ;
                        $ans_str = $lt->ans_str ;
                        $next_q = $lt->next_q ;
                        $n_result = $lt->n_result ;

                        $name_num = "db_num_ans_" . $n_ans ;
                        $name_str = "db_string_ans_" . $n_ans ;
                        $name_next_question = "db_next_question_" . $n_ans ;
                        $name_next_result = "db_next_result_" . $n_ans ;
                        $aa_next_q[] = $next_q ;
                        $aa_next_q_id[] = $name_next_question ;
                        $aa_result[] = $n_result ;
                        $aa_result_id[] = $name_next_result ;
                        ?>
                        <tr>
                            <td><input type="text" class="form-control" id="<?php echo $name_num ; ?>" name="<?php echo $name_num ; ?>" value="<?php echo $ans_num_v ; ?>" style="width: 50px; text-align: right;"></td>
                            <td><input type="text" class="form-control" id="<?php echo $name_str ; ?>" name="<?php echo $name_str ; ?>" value="<?php echo $ans_str ; ?>"  style="width: 150px; "></td>
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
                            <td><button type="button" class="btn btn-warning pull-right" onclick="del_answer('<?=$n_ans?>')" >삭제</button></td>
                        </tr>
                            <?php
                        }
                        for ($i=1; $i < 9; $i++) {
                        $name_num = "num_ans_" . $i ;
                        $name_str = "string_ans_" . $i ;
                        $name_next_question = "next_question_" . $i ;
                        $name_next_result = "next_result_" . $i ;
                        ?>
                                <TD> <input type="text" class="form-control"  id="<?php echo $name_num ; ?>" name="<?php echo $name_num ; ?>" value="<?php echo $i ; ?>" style="width: 50px; text-align: right;"> </TD>
                                <TD> <input type="text" class="form-control"  id="<?php echo $name_str ; ?>" name="<?php echo $name_str ; ?>" value="" style="width: 150px; "> </TD>
                                <TD>
                                    <select class="form-control"  name="<?php echo $name_next_question ; ?>" id="<?php echo $name_next_question ; ?>">
                                        <?php echo $opt_question ; ?>
                                    </select>
                                </TD>
                                <TD>
                                    <select class="form-control"  name="<?php echo $name_next_result ; ?>" id="<?php echo $name_next_result ; ?>">
                                        <?php echo $opt_result ; ?>
                                    </select>
                                </TD>
                                <td></td>
                                <input type="hidden" class='chk0'>
                            </TR>
                            <?php
                        }
                        ?>

                        <tr>
                            <td colspan="5" align="right">
                                <table>
                                    <tr>
                                        <td><a href="/CI/Problem_set" class="btn btn-default" role="button" style="width: 100px">목록으로</a>&nbsp;&nbsp;</td>
                                        <td><button type="button" class="btn btn-warning pull-right" id="add_problem_btn">질문수정</button></td>
                                        <td><button type="button" class="btn btn-primary pull-right" id="add_new_problem_btn">등록으로</button>&nbsp;&nbsp;</td>
                                        <td><button type="button" class="btn btn-danger pull-right" onclick="del_question('<?=$n_auto?>')" >삭제하기</button>&nbsp;&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        </tbody></table>
                                </form>

<script>
    <?php
    if( !empty($aa_next_q) )
    {
        for ($i = 0; $i < sizeof($aa_next_q); $i++)
        {
        ?>
        try {
            $('#<?php echo $aa_next_q_id[$i]; ?> > option[value=<?php echo $aa_next_q[$i]; ?>]').attr('selected', 'true');
            $('#<?php echo $aa_result_id[$i]; ?> > option[value=<?php echo $aa_result[$i]; ?>]').attr('selected', 'true');
        } catch (e) {
        }
        <?php
        }
    }
    ?>
</script>

                </div><!--  2 //-->
            </div><!--  1 //-->

        </div>
    </section>
</div>

<!-----  ------------------------------------------------------------------------------------------------------------------------ //-->