<?php
include HOSTING_MAIN_ROOT . "/application/views/leftmenu_admin.php" ;
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
                    결과목록
                    <small>Result of level test list</small>
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
                            <h3 class="box-title">LIST</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- [종료] 목록의 header //-->


                            <!-- [시작] 목록 //-->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody><tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                    <tr>
                                        <td>183</td>
                                        <td>John Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="label label-success">Approved</span></td>
                                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    </tr>
                                    <tr>
                                        <td>219</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="label label-warning">Pending</span></td>
                                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    </tr>
                                    <tr>
                                        <td>657</td>
                                        <td>Bob Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="label label-primary">Approved</span></td>
                                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    </tr>
                                    <tr>
                                        <td>175</td>
                                        <td>Mike Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="label label-danger">Denied</span></td>
                                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                    </tr>
                                    </tbody></table>

                            </div>
                            <!-- [종료] 목록 //-->

                </div><!--  2 //-->
            </div><!--  1 //-->







        </div>
    </section>
</div>

<!-----  ------------------------------------------------------------------------------------------------------------------------ //-->