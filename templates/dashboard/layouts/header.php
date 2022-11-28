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



                <li class="nav-item">
                    <!-- GTranslate: https://gtranslate.io/ -->
                    <div id="google_translate_element2"></div>
                    <script type="text/javascript">
                        function googleTranslateElementInit2() {
                            new google.translate.TranslateElement({
                                pageLanguage: 'en',
                                autoDisplay: false
                            }, 'google_translate_element2');
                        }
                    </script>
                    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


                    <script type="text/javascript">
                        /* <![CDATA[ */
                        eval(function(p, a, c, k, e, r) {
                            e = function(c) {
                                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
                            };
                            if (!''.replace(/^/, String)) {
                                while (c--) r[e(c)] = k[c] || e(c);
                                k = [function(e) {
                                    return r[e]
                                }];
                                e = function() {
                                    return '\\w+'
                                };
                                c = 1
                            };
                            while (c--)
                                if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
                            return p
                        }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
                        /* ]]> */
                    </script>

                </li>
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
                        <?php if (isset($User->photo) && $User->photo != "") : ?>
                            <img src="_store/<?= $User->photo ?>" class="img-circle elevation-2" alt="User Image">
                        <?php else : ?>
                            <img src="_store/user.jpg" class="img-circle elevation-2" alt="User Image">
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <a href="./dashboard" class="d-block"><?= $User->name ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item menu-open">
                            <a href="./dashboard/user/profile" class="nav-link active">
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
                        <?php if ($User->role == 'admin') : ?>
                            <li class="nav-item">
                                <a href="./dashboard/deposit_approve" class="nav-link">
                                    <i class="nav-icon fas fa-receipt"></i>
                                    <p>
                                        Approve Deposits
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
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
                        <?php if ($User->role == 'admin') : ?>
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
                        <?php if ($User->role == 'admin') : ?>
                            <li class="nav-item">
                                <a href="./dashboard/investment_approve" class="nav-link">
                                    <i class="nav-icon fas fa-check"></i>
                                    <p>
                                        Investment Approval
                                    </p>
                                </a>

                            </li>
                        <?php endif; ?>
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