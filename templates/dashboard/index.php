<?php 
$User = $Core->GetUserInfo($Template->storage('accid'));
?>
<!-- inner hero start -->
<section class="inner-hero bg_img" data-background="<?= $assets ?>/images/bg/bg-1.webp">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="page-title">Dashboard</h2>
                <ul class="page-breadcrumb">
                    <li><a href="./">Home</a></li>
                    <li>Dashboard</li>
                </ul>
                <h5><?=$Self->Toast()?></h5>
            </div>
        </div>
    </div>
</section>
<!-- inner hero end -->

<!-- dashboard section start -->
<div class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row mb-none-30">
                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">Deposit Wallet Balance</span>
                                <h4 class="currency-amount">$<?= $User->balance?></h4>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-dollar-sign"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">Interest Wallet Balance</span>
                                <h4 class="currency-amount">$1,105</h4>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-wallet"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">Total Invest</span>
                                <h4 class="currency-amount">$500</h4>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-cubes "></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">Total Deposit</span>
                                <h4 class="currency-amount">$1,050</h4>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-credit-card"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">Total Withdraw</span>
                                <h4 class="currency-amount">$1703</h4>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-cloud-download-alt"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-30">
                        <div class="d-widget d-flex flex-wrap">
                            <div class="col-8">
                                <span class="caption">Referral Earnings</span>
                                <h4 class="currency-amount">$1710.5</h4>
                            </div>
                            <div class="col-4">
                                <div class="icon ml-auto">
                                    <i class="las la-user-friends"></i>
                                </div>
                            </div>
                        </div><!-- d-widget-two end -->
                    </div>
                </div><!-- row end -->
            </div>
        </div>
    </div>
</div>
<!-- dashboard section end -->