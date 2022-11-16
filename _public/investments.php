<?php


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
    $Core->ApproveWithdrawal($id, "done");
    $Template->setError('Withrawal Approved', 'success', "/dashboard");
    $Template->redirect("/dashboard");
}, "GET");

$Route->add("/user/complete_deposit", function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $id = $Data->id;
    $amount = $Data->amount;
    $method = $Data->method;
    $create = $Core->CreateDeposit($id, $amount, $method, $Core->AddTransaction($id, $amount, "Deposit", "pending"));
    if ($create) {
        $Template->setError("\${$amount} deposited successfully", "success", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("Creating Deposit Failed Unexpectedly, please try again", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "POST");


$Route->add("/approve_deposit/{id}", function ($id) {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Core->ApproveDeposit($id, "done");
    $Template->setError("Deposit approved", "success", "/dashboard");
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
        $create = $Core->CreateInvestment($id, $amount, $package, $roi, $days, "progress");
        if ($create) {
            if ($first_inv) {
                $commision = $amount * 0.1;
                $ref = $Core->GetUserInfo($user->ref_id);
                $Core->AddTransaction($user->ref_id, $commision, "Commission", 'done');
                $commision = $commision + $ref->balance;
                $Core->UpdateBalance($user->ref_id, $commision);
                // $Core->SendMail($ref->email, $ref->name, "You Earned Commission", "<p>Your downline {$user->name} just placed their first investment!!!</p></br> <p>You have been rewarded with {$commision} </p>");
            }
            $Core->UpdateBalance($id, $user_balance);
            $Core->AddTransaction($id, $amount, $package, 'progress');
            $Template->setError("Investment Completed successfully", "success", "/dashboard");
            $Template->redirect("/dashboard");
        }
        $Template->setError("Investing Failed unexpectedly", "warning", "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("You do not have enough balance to complete the investments,\nPlease increase your balance!!! ", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, "POST");
