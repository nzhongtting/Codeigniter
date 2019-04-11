<?php
$login_id = $this->session->userdata('sess_id');
$login_name = $this->session->userdata('sess_name');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>School</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/CI/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/CI/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/CI/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/CI/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/CI/AdminLTE/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/CI/AdminLTE/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/CI/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/CI/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/CI/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/CI/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js" defer></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" defer></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/CI/Temp" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>.A</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>School</b> Admin</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Notifications: style can be found in dropdown.less -->
                    <!-- Tasks: style can be found in dropdown.less -->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/CI/AdminLTE/dist/img/admin_160_160_2.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?=$login_name?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/CI/AdminLTE/dist/img/admin_160_160_2.jpg" class="img-circle" alt="User Image">

                                <p>
                                    <?=$login_name?>(<?=$login_id?>) - School
                                    <small>Member since April. 2019</small>
                                </p>
                            </li>
                            <!-- Menu Body - 필요시 추후 사용 할 예정 : 2019.04.02 by shhong
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>

                            </li>
                            /.row -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/CI/Login/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>