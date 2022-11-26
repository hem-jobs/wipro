<?php
$Core = new Apps\Core;
$User = $Core->GetUserInfo($Template->storage('accid'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= domain ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= $assets ?>/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= $assets ?>/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $assets ?>/admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= $assets ?>/images/favicon.png" alt="Wipro Logo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./dashboard" class="nav-link">Home</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">1</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item">

                        </a>

                        <!-- Message Start -->
                        <div class="media">
                            <img src="<?= $assets ?>/admin/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->

                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-5">
            <!-- Brand Logo -->
            <a href="./" class="brand-link">
                <img src="<?= $assets ?>/images/favicon.png" alt="Wipro Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Wipro</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= $assets ?>/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="./dashboard" class="d-block"><?= $User->name ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item menu-open">
                            <a href="javascript:void(0)" class="nav-link active">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="./users/deposit" class="nav-link">
                                <i class="nav-icon fas fa-money-check"></i>
                                <p>
                                    Fund Wallet
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./dashboard/p2p" class="nav-link">
                                <i class="nav-icon fas fa-sync"></i>
                                <p>
                                    P2P
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="./dashboard/withdraw" class="nav-link">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Withdrawals
                                </p>
                            </a>

                        </li>
                        <?php if($User->role == 'admin'): ?>
                        <li class="nav-item">
                            <a href="./dashboard/withdraw_approve" class="nav-link">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Approve Withdrawals
                                </p>
                            </a>

                        </li>
                       <?php endif; ?>
                        <li class="nav-item">
                            <a href="./plan" class="nav-link">
                                <i class="nav-icon fas fa-arrow-down"></i>
                                <p>
                                    Invest
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="./auth/logout" class="nav-link">
                                <i class="nav-icon fa fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                            </a>

                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>