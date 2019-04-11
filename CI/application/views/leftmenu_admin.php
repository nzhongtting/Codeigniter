<?php
$login_id = $this->session->userdata('sess_id');
$login_name = $this->session->userdata('sess_name');
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/CI/AdminLTE/dist/img/admin_160_160_2.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$login_name?>(<?=$login_id?>) </p>
                <a href="#"><i class="fa fa-circle text-success"></i> 온라인</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">E.Sang S NAVIGATION</li>

            <li class="<?=$cate['cate01']=='leveltest'?"active ":""?> treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>레벨테스트</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=$cate['cate02']=='0'?"active ":""?>"><a href="/CI/Levellist"><i class="fa fa-circle-o"></i> 결과 목록</a></li>
                    <li class="<?=$cate['cate02']=='1'?"active ":""?>"><a href="/CI/Problem_set"><i class="fa fa-circle-o"></i> 문제 은행</a></li>
                </ul>
            </li>

            <li class="<?=$cate['cate01']=='just_main'?"active ":""?>"><a href="/CI/Temp"><i class="fa fa-circle-o text-red"></i> <span>Initial page</span></a></li>

            <!-- 추후 이용 가능 : 2019.04.02 by shhong
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-share"></i> <span>Multilevel</span>
                                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-circle-o"></i> Level One
                                        <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                        <li class="treeview">
                                            <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            </ul>
                        </li>
            <li class="header">LABELS</li>
                        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
            //-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

