<?php
include HOSTING_MAIN_ROOT . "/application/views/leftmenu_admin.php" ;
?>

<script src="/CI/include/levellist.js?v=2019040441" type="text/javascript"></script>

<!--- main start  Div 에 작성 //-->
<!------------------------------------------------------------------------------------------------------------------------------ //-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="row">

            <!-- [시작] content-header //-->
            <section class="content-header">
                <h1>
                    결과목록
                    <small>List of level test result</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Temp"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">레벨테스트</a></li>
                    <li class="active">결과목록</li>
                </ol>
            </section><br>
            <!-- [종료] content-header //-->


            <div class="col-xs-12"> <!--  1 //-->
                <div class="box box-primary"> <!--  2 //-->

                        <!-- [시작] 목록의 header //-->
                        <div class="box-header with-border">
                            <h3 class="box-title">LIST <i class="fa fa-fw fa-list-alt"></i> </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- [종료] 목록의 header //-->


                            <!-- [시작] 목록 //-->
                            <div class="box-body table-responsive no-padding">


                                <form class="form-horizontal" id="search_action" name="search_action" method="post" accept-charset="utf-8"  onsubmit="return false;" >
                                    <table class="table" style="margin-bottom: 2px;">
                                        <tbody>
                                        <tr>
                                            <th><input type="text" class="form-control" id="c_name" name="c_name" placeholder="이름 ..."></th>
                                            <th><input type="text" class="form-control" id="mphone" name="mphone" placeholder="연락처 ..."></th>
                                            <th>

                                                <select class="form-control" id="result_type" name="result_type" >
                                                    <option value=""> Level </option>
                                                    <option value="1">입 문</option>
                                                    <option value="2">초 급</option>
                                                    <option value="5">중 급</option>
                                                    <option value="9">고 급</option>
                                                </select>

                                            </th>

                                            <th>

                                                <select class="form-control" id="g_idx" name="g_idx" >
                                                    <option value=""> Level Group </option>
                                                    <?php
                                                    foreach($group_list as $lm)
                                                    {
                                                    ?>
                                                        <option value="<?=$lm->group_v?>"> <?=$lm->group_title?> </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                            </th>
                                            <th>
                                                <!-- PC or mobile select // [추가] PC or Mobile 구분 추가 by shhong 20190422 -->
                                                <select class="form-control" id="chk_pc_m" name="chk_pc_m" >
                                                    <option value=""> All ( PC or Mobile ) </option>
                                                    <option value="pc">PC</option>
                                                    <option value="mo">Mobile</option>
                                                </select>
                                            </th>

                                            <th></th>
                                            <th>
                                                    <button type="button" class="btn btn-primary pull-right" onclick="search_list();">Search</button>
                                            </th>
                                        </tr>
                                        </tbody></table>
                                    &nbsp;&nbsp;&nbsp;연락처가 <font color="#ba4222" size="5">■</font>  색이면 중복입니다.
                                <table class="table">
                                    <tbody><tr bgcolor="#b0def8">
                                        <th width="5%" style="text-align: center">No.</th>
                                        <th width="10%" style="text-align: center">등록일</th>
                                        <th width="25%" style="text-align: center">Title</th>
                                        <th width="10%" style="text-align: center">이름</th>
                                        <th width="15%" style="text-align: center">연락처</th>
                                        <th width="5%" style="text-align: center">결과</th>
                                        <th width="15%" style="text-align: center">구분</th>
                                        <th width="15%" colspan="3" style="text-align: center">&nbsp;처리</th>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-hover">
                                    <tbody>

                                    <?php
                                    foreach($list as $lt)
                                    {
                                        $inday = date("Y-m-d H:i:s", $lt->date_in);
                                                if( $lt->result =='1' ) { $result = "<span class='label label-success'>입 문</span>"; }
                                        else   if( $lt->result =='2' ) { $result = "<span class='label label-primary'>초 급</span>"; }
                                        else   if( $lt->result =='5' ) { $result = "<span class='label label-warning'>중 급</span>"; }
                                        else   if( $lt->result =='9' ) { $result = "<span class='label label-danger'>고 급</span>"; }
                                        else                            { $result = ""; }

                                                if( $lt->chk_pc_m =='pc' ) { $chkpcm = "PC"; }
                                        else   if( $lt->chk_pc_m =='mo' ) { $chkpcm = "Mobile"; }
                                        else   { $chkpcm = ""; }
                                    ?>
                                        <tr>
                                            <td width="5%" style="text-align: center"><?=$lt->c_idx?></td>
                                            <td width="10%" style="text-align: center"><?=$inday?></td>
                                            <td width="25%" style="text-align: center"><?=$lt->groupname?></td>
                                            <td width="10%" style="text-align: center"><?=$lt->c_name?></td>
                                            <td width="15%" style="text-align: center;<?php if($lt->cntmphone > 1) { echo "color:#ba4222;'"; }  else { echo ""; } ?>"><?=$lt->mphone?></td>
                                            <td width="5%" style="text-align: center"><?=$result?></td>
                                            <td width="15%" style="text-align: center"><?=$chkpcm?></td>
                                            <td width="5%" style="text-align: center">
                                                <button type="button" class="btn btn-block btn-info btn-xs" data-toggle="modal" data-target="#modal-default" style="width: 52px;" onclick="confirm_result('<?=$lt->c_idx?>');">확 인</button>
                                            </td>
                                            <td width="5%" style="text-align: center">
                                                <button type="button" class="btn btn-block btn-default btn-xs" onclick="temporary_crud('<?=$lt->c_idx?>')" <?php if( $lt->temporary_yon =='1' ) { echo " disabled"; } else { echo ""; } ?> >TEMP <i class="fa fa-fw fa-tags"></i></button>
                                            </td>
                                            <td width="5%" style="text-align: center"><button type="button" class="btn btn-block btn-danger btn-xs" style="width: 52px;" onclick="result_del('<?=$lt->c_idx?>');">삭 제</button></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <table class="table" style="margin-bottom: 0px;">
                                    <tbody>
                                    <tr>
                                        <th width="70%">
                                            <?php echo $this->pagination->create_links(); ?>
                                        </th>
                                        <th width="30%" style="text-align: center">
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                                </form>
                            </div>
                            <!-- [종료] 목록 //-->

                </div><!--  2 //-->
            </div><!--  1 //-->


            <div class="col-xs-12"> <!--  1 //-->
                <div class="box box-primary box box-primary collapsed-box"> <!--  2 //-->

                    <!-- [시작] 임시저장 header //-->
                    <div class="box-header with-border">
                        <h3 class="box-title">TEMPORARY  <i class="fa fa-fw fa-tags"></i></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-plus"></i></button>
                        </div>
                        ( max 5 )
                    </div>
                    <!-- [종료] 임시저장 header //-->


                    <!-- [시작] 목록 //-->
                    <div class="box-body table-responsive no-padding" style="display: none;">
                        <form class="form-horizontal" id="temporary_action" name="temporary_action" method="post" accept-charset="utf-8"  onsubmit="return false;" >
<br>

                            <table class="table" id="temporary_list" name="temporary_list" >
                                <tbody>
                                <tr>
                                    <th width="10%"></th>


                                    <?php
                                    $cnt_th = 0 ;
                                    foreach($temporary_list as $ltem)
                                    {

                                        $inday = date("Y-m-d H:i:s", $ltem->c_datein);

                                        if( $ltem->result =='1' ) { $result = "<span class='label label-success'>입 문</span>"; }
                                        else   if( $ltem->result =='2' ) { $result = "<span class='label label-primary'>초 급</span>"; }
                                        else   if( $ltem->result =='5' ) { $result = "<span class='label label-warning'>중 급</span>"; }
                                        else   if( $ltem->result =='9' ) { $result = "<span class='label label-danger'>고 급</span>"; }
                                        else                            { $result = ""; }

                                    ?>
                                    <th width="18%">
                                        <div class="info-box bg-aqua">
                                            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text"><?=$result?>&nbsp;&nbsp;<?=$ltem->c_name?> </span>
                                                <span class="info-box-number"><?=$ltem->mphone?></span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 40%"></div>
                                                </div>
                                                <span class="progress-description"><?=$inday?></span>
                                            </div>
                                        </div>
                                    </th>
                                    <?php
                                        $cnt_th++;
                                    }
                                    if( $cnt_th <= 4)
                                    {
                                        if( $cnt_th == 4) { $percent='18%'; } else if( $cnt_th == 3) { $percent='36%'; }
                                        else if( $cnt_th == 2) { $percent='54%'; } else if( $cnt_th == 1) { $percent='72%'; }
                                        else if( $cnt_th == 0) { $percent='90%'; }
                                        echo "<th width='".$percent."'>&nbsp;</th>";
                                    }
                                    ?>

                                    <th width="10%"></th>

                                </tr>
                                </tbody>
                            </table>


                        </form>
                    </div>

                </div><!--  2 //-->
            </div><!--  1 //-->


            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h3 class="modal-title">레벨테스트 결과</h3><br>

                            <div class="row">
                                <div class="col-md-6">&nbsp;&nbsp;이름 : <span id="u_name" name="u_name"></span></div>
                                <div class="col-md-6">등록일 : <span id="c_inday" name="c_inday"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">&nbsp;&nbsp;연락처 : <span id="c_mphone" name="c_mphone"></span></div>
                                <div class="col-md-6">LEVEL : <span id="c_level" name="c_level"></span></div>
                            </div>

                        </div>
                        <div class="modal-body">

                            <table cellpadding="0" cellspacing="0" class="style1" id="levetest_justlist" name="levetest_justlist" style="width: 100%;">
                                <colgroup>
                                    <col width="3px">
                                    <col width="170px">
                                    <col width="50px">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th bgcolor="#efefef">&nbsp;질 문</th>
                                    <th bgcolor="#efefef">&nbsp;답</th>
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