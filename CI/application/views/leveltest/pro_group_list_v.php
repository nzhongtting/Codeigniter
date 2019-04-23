<?php
include HOSTING_MAIN_ROOT . "/application/views/leftmenu_admin.php" ;
?>

<script>

    $(document).ready(function(){
        $("#add_group_btn").click(function(){

            if($("#group_title").val() == ''){
                alert('그룹의 Title를 입력해주세요.');
                $("#group_title").focus();
                return false;
            } else {
                var act = '/CI/Problem_set/group_add_db' ;
                $("#upload_action").attr('action', act).submit();
            }
        });
    });

    function cancel_modify()
    {
        $('#g_idx').val("");
        $('#group_title').val("");
        $("#control_box").html("");
        $('#del_result').val("");
    }

    function g_modify_bnt(Z,Y)
    {
        $('#g_idx').val(Z);
        $('#group_title').val(Y);
        $('#del_result').val("");

        $("#control_box").html('<table><tr><td><button type="button" class="btn btn-info pull-right" onclick="modify_title()" >Title 수정</button></td><td>&nbsp;&nbsp;</td><td><button type="button" class="btn btn-default pull-right" id="cencel_modify_btn" onclick="cancel_modify();"  >취소</button></td></tr></table>');
    }

    function modify_title()
    {
        var group_title = $('#group_title').val();
        var gidx =  $('#g_idx').val();
        if( group_title !='' )
        {
            $.ajax({cache:false,url: "/CI/Ajax_problem/title_set",data: { gidx : gidx ,group_title	: group_title  }, success: function(result){
                },
                complete: function(){
                    location.reload();
                }
            });
        }
        else
        {
            alert("채널명을 입력하세요" );
        }
    }

    function del_group(Z)
    {
        $.ajax({cache:false,url: "/CI/Ajax_problem/problem_group_del/delactionresult",data: { gidx : Z }, success: function(result)
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
                location.reload();
            }
            else if( $('#del_result').val() == 0  )
            {
                alert('해당 문제 그룹에 질문이 등록되어 있어 삭제 할 수 없습니다.');
            }
        }
        });
    }


    function poplvtest(Z) { window.open("/CI/Leveltest/level_test?quiz_no=1&group_v="+Z, "a", "width=530, height=922, left=100, top=50"); }

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
                    문제 은행, 목록
                    <small>Group list</small>
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
                            <h3 class="box-title">LIST & EDITFORM <i class="fa fa-fw fa-list-alt"></i></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- [종료] 목록의 header //-->

                            <!-- [시작] 목록 //-->
                            <div class="box-body table-responsive no-padding">

                                <?php
                                $attributes = array('id' => 'upload_action', 'name' => 'upload_action');
                                echo form_open('Problem_set/group_add_db' , $attributes);
                                ?>

                                <table class="table" style="margin-bottom: 0px;">
                                    <input type="hidden" id="g_idx" name="g_idx" value="">
                                    <input type="hidden" id="del_result" name="del_result">
                                    <tbody>
                                    <tr>
                                        <th width="80%"><input type="text" class="form-control" id="group_title" name="group_title" placeholder="그룹 Title 등록..."></th>
                                        <th width="10%"><div id="control_box" name="control_box"></div></th>
                                        <th width="10%"><button type="button" class="btn btn-primary pull-right" id="add_group_btn">그룹 등록</button></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">등록순서 : ⓐ 그룹 Title 등록 , ⓑ 결과 화면 관리 , ⓒ 질문 관리  </th>
                                    </tr>
                                    </tbody></table>

                                <table class="table table-hover" border="0">
                                    <tbody>
                                    <tr bgcolor="#b0def8" onmouseover="this.style.background='#b0def8'" onmouseout="this.style.background='#b0def8'" >
                                        <th width="20%" style="text-align: center;">TiTle </th>
                                        <th width="20%" style="text-align: center;">Title & 그룹 처리</th>
                                        <th width="5%" style="text-align: center;">CODE</th>
                                        <th colspan="5" style="text-align: center;" width="60%">관리항목</th>
                                    </tr>

                                    <?php
                                    foreach ($list as $lt)
                                    {
                                        $link_problem = "/CI/Problem_set/problem_list/" . $lt->group_v ;
                                        $link_result  = "/CI/Problem_set/problem_result_list/" . $lt->group_v ;
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $lt->group_title ; ?></td>
                                            <td align="center">
                                                <table>
                                                    <tr>
                                                        <td><button type="button" class="btn btn-block btn-info btn-xs" onclick="g_modify_bnt('<?=$lt->group_v?>','<?php echo $lt->group_title ; ?>')" >수정</button></td>
                                                        <td>&nbsp;&nbsp;</td>
                                                        <td><button type="button" class="btn btn-block btn-warning btn-xs" onclick="del_group('<?=$lt->group_v?>')">삭제</button></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="center"><?=$lt->group_v?></td>
                                            <td align="center">
                                                <a href="<?php echo $link_result ; ?>" class="btn btn-block btn-default btn-xs" role="button" style="width: 130px"> <i class="fa fa-fw fa-television"></i> 결과 화면 관리 - ①
                                            </td>
                                            <td align="center">
                                                <a href="<?php echo $link_problem ; ?>" class="btn btn-default btn-xs" role="button" style="width: 100px"> <i class="fa fa-fw fa-paste"></i> 질문 관리 - ② </a>
                                                </a>
                                            </td>
                                            <td align="center">
                                                <a href="/CI/Levellist/index/0/0/0|<?=$lt->group_v?>" class="btn btn-block btn-default btn-xs" role="button" style="width: 100px"> <i class="fa fa-fw fa-th-list"></i> 결과 목록</a>
                                            </td>
                                            <!-- // [추가] PC or Mobile 구분 추가 by shhong 20190422 //-->
                                            <td align="center">
                                                <a href="javascript:poplvtest('<?=$lt->group_v?>');" target="_new" class="btn btn-block btn-default btn-xs" role="button" style="width: 100px"> <i class="fa fa-fw fa-link"></i> PC 확인  </a>
                                            </td>
                                            <td align="center">
                                                <a href="/CI/Leveltest/level_test?quiz_no=1&group_v=<?=$lt->group_v?>" target="_new" class="btn btn-block btn-default btn-xs" role="button" style="width: 100px"> <i class="fa fa-fw fa-link"></i> 모바일 확인  </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>

                                </form>
                            </div>
                            <!-- [종료] 목록 //-->

                </div><!--  2 //-->
            </div><!--  1 //-->

            <div class="modal fade" id="modal-problem">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h3 class="modal-title">문제은행</h3><br>

                            <div class="row">
                                <div class="col-md-6">그룹 Title : ... </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                        <div class="modal-body">

                            <table cellpadding="0" cellspacing="0" class="style1" id="levetest_justlist" name="levetest_justlist" style="width: 100%;">
                                <colgroup>
                                    <col width="3px">
                                    <col width="210px">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th bgcolor="#efefef">&nbsp;질 문</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </div>
    </section>
</div>


<!-----  ------------------------------------------------------------------------------------------------------------------------ //-->