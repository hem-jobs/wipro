<?php

//dashboard Home Page
$Route->add('/dashboard', function () {

    $Template = new Apps\Template(auth_url);
    $Template->addheader("dashboard.layouts.header");
    $Template->addfooter("dashboard.layouts.footer");
    $Template->assign("title", "Wipro Dashboard");
    $Template->assign("menukey", "dashboard");
    $Template->render("dashboard.index");
}, 'GET');

$Route->add('/dashboard/p2p', function () {

    $Template = new Apps\Template(auth_url);
    $Template->addheader("dashboard.layouts.header");
    $Template->addfooter("dashboard.layouts.footer");
    $Template->assign("title", "Wipro P2P");
    $Template->assign("menukey", "dashboard");
    $Template->render("dashboard.p2p");
}, 'GET');

//dashboard Profile page
$Route->add("/dashboard/withdraw_approve", function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $User = $Core->GetUserInfo($Template->storage("accid"));
    if($User->role == "admin"){
        $withdrawals = $Core->GetUnapprovedWithdrawals();
        $Template->addheader("dashboard.layouts.header");
        $Template->addfooter("dashboard.layouts.footer");
        $Template->assign("withdrawals", $withdrawals);
        $Template->assign("title", "Approve Withdrawals");
        $Template->render("dashboard.approve_withdraw");
    }
    $Template->setError("You are not an approved user for this operation", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");
