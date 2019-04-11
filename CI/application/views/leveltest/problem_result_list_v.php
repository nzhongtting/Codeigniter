<?php
include HOSTING_MAIN_ROOT . "/application/views/leftmenu_admin.php" ;

//  /CI/Problem_set/problem_result_list/ 3

?>

<script>
    $(document).ready(function(){
        $("#add_result_btn").click(function(){

            if($("#title_v").val() == ''){
                alert('결과 Title를 입력해주세요.');
                $("#title_v").focus();
                return false;
            } else {
                var act = '/CI/Problem_set/problem_result_add_db' ;
                $("#upload_action").attr('action', act).submit();
            }
        });
    });

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
                    문제 은행, 결과화면 등록
                    <small> Input of results screen</small>
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
                        include HOSTING_MAIN_ROOT . "/application/views/leveltest/part_list_result.php" ;
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
                        <h3 class="box-title">INPUTFORM <i class="fa fa-fw fa-edit"></i> </h3>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!-- [종료] 등록 header //-->




                    <?php
                    $attributes = array('id' => 'upload_action', 'name' => 'upload_action');
                    echo form_open('Problem_set/problem_result_add_db' , $attributes);
                    ?>
                    <input type="hidden" name="group_v" value="<?php echo $group_v ; ?>">

                    <table class="table table-hover">
                        <colgroup>
                            <col width="160px"/><col width=""/>
                            <col width="160px"/><col width=""/>
                        </colgroup>
                        <tr>
                            <TD>결과 Title</TD>
                            <td>
                                <input type="text" class="form-control" id="title_v" name="title_v" value="" style="width: 400px;">
                            </td>
                            <TD>레벨 결과</TD>
                            <td>
                                <select class="form-control" id="level_key" name="level_key">
                                    <option value=""> Level </option>
                                    <option value="1">입 문</option>
                                    <option value="2">초 급</option>
                                    <option value="5">중 급</option>
                                    <option value="9">고 급</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <TD> 링크 종류 .<b>1</b></TD>
                            <td>
                                <input type="text" class="form-control" id="img_1" name="img_1" value="" style="width: 200px;">
                            </td>
                            <TD>링크 URL .<b>1</b></TD>
                            <td>
                                <input type="text" class="form-control" id="img_1_link" name="img_1_link" value="">
                            </td>
                        </tr>

                        <tr>
                            <TD> 링크 종류 .<b>2</b></TD>
                            <td>
                                <input type="text" class="form-control" id="img_2" name="img_2" value="" style="width: 200px;">
                            </td>
                            <TD>링크 URL .<b>2</b></TD>
                            <td>
                                <input type="text" class="form-control" id="img_2_link" name="img_2_link" value="">
                            </td>
                        </tr>

                        <tr>
                            <TD>MSG Code</TD>
                            <td colspan="3">
                                <textarea  class="form-control" id="msg_v" name="msg_v" rows="3"> </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" align="right">
                                <table>
                                    <tr>
                                        <td><a href="/CI/Problem_set" class="btn btn-default" role="button" style="width: 100px">목록으로</a>&nbsp;&nbsp;</td>
                                        <td><button type="button" class="btn btn-primary" id="add_result_btn"> Result 등록</button></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>


                                </form>


                </div><!--  2 //-->
            </div><!--  1 //-->

        </div>
    </section>
</div>

<!-----  ------------------------------------------------------------------------------------------------------------------------ //-->