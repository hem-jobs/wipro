<?php

use Apps\MysqliDb;

$Route->add('/invest/{package}', function ($package) {
    $Template = new Apps\Template(auth_url);
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Wipro " . ucfirst($package));
    $Template->assign("package", ucfirst($package));
    $Template->render("dashboard.investments");
}, "GET");


$Route->add('/users/deposit', function () {
    $Template = new Apps\Template(auth_url);
    $Template->addheader("dashboard.layouts.header");
    $Template->addfooter("dashboard.layouts.footer");
    $Template->assign("title", "Wipro Deposit");
    $Template->render("dashboard.deposit");
}, "GET");

$Route->add('/user/deposit', function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $Template->addheader("dashboard.layouts.header");
    $Template->addfooter("dashboard.layouts.footer");
    $Template->assign("title", "Wipro Deposit");
    $Template->assign("amount", $Data->amount);
    $Template->assign("method", $Data->method);
    $Template->assign("id", $Data->id);
    $Template->render("dashboard.payment");
}, "POST");

$Route->add('/dashboard/withdraw', function () {
    $Template = new Apps\Template(auth_url);
    $Template->addheader("dashboard.layouts.header");
    $Template->addfooter("dashboard.layouts.footer");
    $Template->assign("title", "Wipro Withdrawal");
    $Template->render("dashboard.withdraw");
}, "GET");

$Route->add("/approve_withdrawal/{id}", function ($id) {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $User = $Core->GetUserInfo($Template->storage('accid'));
    if ($User->role == 'admin') {
        $Core->ApproveWithdrawal($id, "done");
        $Template->setError('Withrawal Approved', 'success', "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError('You can\'t do that', 'success', "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");

$Route->add("/finish_investment/{id}", function ($id) {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $User = $Core->GetUserInfo($Template->storage('accid'));
    if ($User->role == 'admin') {
        $sql = "SELECT * FROM `investments` WHERE `id` = '$id'";
        $invest = mysqli_query($Core->dbCon, $sql);
        $invest = mysqli_fetch_object($invest);
        $roi = $invest->roi;
        $investment_amount = $invest->amount;
        $investment_yield = (int)(($roi / 100) * $investment_amount);

        $Investor = $Core->GetUserInfo($invest->user);
        $prev_balance = $Investor->balance;
        $new_balance = $prev_balance + $investment_yield;
        $save_balance = "UPDATE `user` SET `balance` = '$new_balance' WHERE `id` = '$id' = '$Investor->id'";
        $saved = mysqli_query($Core->dbCon, $save_balance);

        $update_investment = "UPDATE `investments` SET `status` = 'done' WHERE `id` = '$id'";
        $saved = mysqli_query($Core->dbCon, $update_investment);
        $Core->UpdateTransaction($invest->trans_id, 'done');
        $Template->setError('Investment Approved', 'success', "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError('You are not allowed to do this', 'success', "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");

$Route->add("/abort_investment/{id}", function ($id) {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    if ($Core->GetUserInfo($Template->storage('accid'))->role == 'admin') {
        $sql = "SELECT * FROM `investments` WHERE `id` = '$id'";
        $invest = mysqli_query($Core->dbCon, $sql);
        $invest = mysqli_fetch_object($invest);
        $trans_id = $invest->trans_id;
        $user_id = $invest->user;
        $user = $Core->GetUserInfo($user_id);
        $balance = $user->balance + $invest->amount;
        $Core->UpdateBalance($user_id, $balance);

        $Core->DeleteTransaction($trans_id);
        $Core->DeleteInvestment($id);
        $Template->setError("Deleted", "success", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("You are not authorized", "success", "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");

$Route->add("/user/complete_deposit", function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $id = $Data->id;
    $amount = $Data->amount;
    $method = $Data->method;
    $hash = $Data->hash;
    $create = $Core->CreateDeposit($id, $amount, $method, $Core->AddTransaction($id, $amount, "Deposit", "pending"), $hash);
    if ($create) {
        $Template->setError("\${$amount} deposited successfully Awaiting approval from the admins", "success", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("Creating Deposit Failed Unexpectedly, please try again", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "POST");


$Route->add("/approve_deposit/{id}", function ($id) {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    if ($Core->GetUserInfo($Template->storage('accid'))->role == 'admin') {
        $Core->ApproveDeposit($id, "done");
        $Template->setError("Deposit approved", "success", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("Clearance denied", "success", "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");

$Route->add("/decline_deposit/{id}", function ($id) {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    if ($Core->GetUserInfo($Template->storage('accid'))->role == 'admin') {
        $Core->DeclineDeposit($id);
        $Template->setError("Deposit Declined", "success", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("You are not permited", "success", "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");
$Route->add("/delete_withdrawal/{id}", function ($id) {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    if ($Core->GetUserInfo($Template->storage('accid'))->role == 'admin') {
        $sql = "SELECT * FROM `withdrawals` WHERE `id` = '$id'";
        $sql = mysqli_query($Core->dbCon, $sql);
        $withdrawal = mysqli_fetch_object($sql);
        $Core->DeleteTransaction($withdrawal->trans_id);
        $Core->DeleteWithdrawal($id);
        
        $balance = (int)$withdrawal->amount + (int)($Core->GetUserInfo($withdrawal->user)->balance);
        $Core->UpdateBalance($withdrawal->user, $balance);
        $Template->setError("Deleted withdrawal", "success", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("Access denied", "success", "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");

$Route->add("/users/withdraw", function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $address = $Data->address;
    $amount = $Data->amount;
    $coin = $Data->coin;
    $id = $Data->id;
    $user = $Core->GetUserInfo($id);
    $balance = $user->balance;
    if ($balance >= $amount) {
        $balance = $balance - $amount;
        $Core->CreateWithdrawal($id, $coin, $address, $amount, "pending", $Core->AddTransaction($id, $amount, "Withdrawal", "pending"));
        $Core->UpdateBalance($id, $balance);
        $Template->setError("Withdrawal request Placed Successfully!!!, \${$amount} has been removed from your balance", "success", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("You do not have enough", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "POST");



$Route->add('/invest/{package}', function ($package) {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $id = $Template->storage('accid');
    $amount = $Data->amount;
    $roi = $Data->roi;
    $days = $Data->days;
    $user = $Core->GetUserInfo($id);
    if ($user->balance >= $amount) {
        $user_balance = $user->balance - $amount;
        $first_inv = $Core->CheckFirstInv($id);
        $create = $Core->CreateInvestment(
            $id,
            $amount,
            $package,
            $roi,
            $days,
            "progress",
            $Core->AddTransaction($id, $amount, $package, 'progress')
        );
        if ($create) {
            if ($first_inv) {
                if (isset($user->ref_id)) {
                    $commision = $amount * 0.1;
                    $ref = $Core->GetUserInfo($user->ref_id);
                    $Core->AddTransaction($user->ref_id, $commision, "Commission", 'done');
                    $commision = $commision + $ref->balance;
                    $Core->UpdateBalance($user->ref_id, $commision);
                }
                // $Core->SendMail($ref->email, $ref->name, "You Earned Commission", "<p>Your downline {$user->name} just placed their first investment!!!</p></br> <p>You have been rewarded with {$commision} </p>");
            }
            $Core->UpdateBalance($id, $user_balance);
            $Template->setError("Investment Completed successfully", "success", "/dashboard");
            $Template->redirect("/dashboard");
        }
        $Template->setError("Investing Failed unexpectedly", "warning", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("You do not have enough balance to complete the investments,\nPlease increase your balance!!! ", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "POST");

