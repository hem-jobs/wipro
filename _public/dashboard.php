<?php

use Apps\Core;
use Apps\Template;
//dashboard Home Page
$Route->add('/dashboard', function () {

    $Template = new Template(auth_url);
    $Template->addheader("dashboard.layouts.header");
    $Template->addfooter("dashboard.layouts.footer");
    $Template->assign("title", "Wipro Dashboard");
    $Template->assign("menukey", "dashboard");
    $Template->render("dashboard.index");
}, 'GET');

$Route->add('/dashboard/p2p', function () {

    $Template = new Template(auth_url);
    $Template->addheader("dashboard.layouts.header");
    $Template->addfooter("dashboard.layouts.footer");
    $Template->assign("title", "Wipro P2P");
    $Template->assign("menukey", "dashboard");
    $Template->render("dashboard.p2p");
}, 'GET');

//dashboard Profile page
$Route->add("/dashboard/withdraw_approve", function () {
    $Template = new Template(auth_url);
    $Core = new Core;
    $User = $Core->GetUserInfo($Template->storage("accid"));
    if ($User->role == "admin") {
        $withdrawals = $Core->GetUnapprovedWithdrawals();
        $withdrawals2 = $Core->GetApprovedWithdrawals();
        $Template->addheader("dashboard.layouts.header");
        $Template->addfooter("dashboard.layouts.footer");
        $Template->assign("withdrawals", $withdrawals);
        $Template->assign("withdrawals2", $withdrawals2);
        $Template->assign("title", "Approve Withdrawals");
        $Template->render("dashboard.approve_withdraw");
    }
    $Template->setError("You are not an approved user for this operation", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");

$Route->add("/dashboard/deposit_change_amount", function () {
    $Template = new Template(auth_url);
    $Core = new Core;
    $User = $Core->GetUserInfo($Template->storage("accid"));
    if ($User->role == "admin") {
        $Data = $Core->data;
        $id = $Data->id;
        $amount = $Data->amount;
        $sql = "UPDATE `deposits` SET `amount`='$amount' WHERE `id` = '$id'";
        $updated = mysqli_query($Core->dbCon, $sql);
        if ($updated) {
            $Template->setError("Amount updated successfully", 'success', '/dashboard/deposit_approve');
            $Template->redirect('/dashboard/deposit_approve');
        }
        $Template->setError("Amount update failed", 'warning', '/dashboard/deposit_approve');
        $Template->redirect('/dashboard/deposit_approve');
    }
}, "POST");

$Route->add("/dashboard/deposit_approve", function () {
    $Template = new Template(auth_url);
    $Core = new Core;
    $User = $Core->GetUserInfo($Template->storage("accid"));
    if ($User->role == "admin") {
        $deposits = $Core->GetUnapprovedDeposits();
        $deposits2 = $Core->GetApprovedDeposits();
        $Template->addheader("dashboard.layouts.header");
        $Template->addfooter("dashboard.layouts.footer");
        $Template->assign("deposits", $deposits);
        $Template->assign("deposits2", $deposits2);
        $Template->assign("title", "Approve Deposits");
        $Template->render("dashboard.approve_deposits");
    }
    $Template->setError("You are not an approved user for this operation", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");


$Route->add("/dashboard/investment_approve", function () {
    $Template = new Template(auth_url);
    $Core = new Core;
    $User = $Core->GetUserInfo($Template->storage("accid"));
    if ($User->role == "admin") {

        $Template->addheader("dashboard.layouts.header");
        $Template->addfooter("dashboard.layouts.footer");

        $Template->assign("title", "Approve Investments");
        $Template->render("dashboard.approve_investment");
    }
    $Template->setError("You are not an approved user for this operation", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");
