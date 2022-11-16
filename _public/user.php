<?php

use Apps\MysqliDb;

$Route->add('/login', function () {

    $Template = new Apps\Template;
    if ($Template->storage('accid')) {
        $Template->redirect("/dashboard");
    }
    $Template->assign("title", "Wipro Login");

    $Template->render("pages.login");
}, 'GET');

$Route->add('/register/{id}', function ($id) {

    $Template = new Apps\Template;
    $Template->assign("title", "Wipro Register");
    $Template->assign("ref_id", $id);
    $Template->render("pages.register");
}, 'GET');


$Route->add('/register', function () {

    $Template = new Apps\Template;
    if ($Template->storage('accid')) {
        $Template->redirect("/dashboard");
    }
    $Template->assign("title", "Wipro Register");
    $Template->render("pages.register");
}, 'GET');

$Route->add('/activate_user/{email}', function ($email) {
    $Template = new Apps\Template;
    $Core = new Apps\Core;
    $sql = "SELECT * FROM `user` WHERE `hash`='$email'";

    $selected = mysqli_query($Core->dbCon, $sql);
    if ($selected->num_rows) {
        $selected = mysqli_fetch_object($selected);
        if (!$selected->verified) {
            $sql2 = "UPDATE `user` SET verified  = '1' WHERE `hash`='$email'";
            $selected2 = mysqli_query($Core->dbCon, $sql2);
            if ($selected2) {
                $subject = "Account Verification";
                $message = "<h2>Account Verification</h2>
                <br />
                <p>Account verification was successful!!!</p>
                <br />
                <br />
                <p> The Wipro Investments team</p>
                ";
                $Core->SendMail($selected->email, $selected->name, $subject, $message);
                $Template->authorize($selected->id);
                $Template->store("accid", $selected->id);
                $Template->setError('Email account verified', 'success', "/dashboard");
                $Template->redirect("/dashboard");
            }
        }
        $Template->setError("Account already verified", 'success', "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError("No Such Account", 'warning', "/");
    $Template->redirect("/");
}, 'GET');


//Post

$Route->add('/user/create-account', function () {
    $Template = new Apps\Template;
    $Core = new Apps\Core;
    $Data = $Core->data;
    $email = $Data->email;
    $name = $Data->name;
    $ref_id = $Data->ref_id;
    $password = md5($Data->password . encrypt_salt);

    $hash = md5($Data->email . encrypt_salt);
    $created = $Core->CreateUser($email, $name, $ref_id, $password, $hash);
    if ($created) {
        $created = (int)$created;
        $Template->authorize($created);
        $Login = $Core->GetUserInfo($created);
        $subject = "Welcome to Wipro Investments";

        $mailbody = "
        <h1>Welcome to Wipro</h1>
        <br />
        <h2>Your account creation was successful</h2>
        <br />
        <p>Click on the link below 👇 to verify your email address.</p>
        <br />
        <a href=\"http://www.wiproinvestment.com/activate_user/$hash\" style=\"color:blue;font-size: 16px;border:1px solid blue; text-decoration: none;\">Activate</a>
        <br />
        <br />
        <p>Warm regards from the Technical Support Wipro Investments</p>
        <br/>
         ";

        $Core->SendMail($Login->email, $Login->name, $subject, $mailbody);
        $Template->setError('Account created successfully', 'success', "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError('Account creation failed', 'warning', "/register");
    $Template->redirect("/register");
}, 'POST');




$Route->add('/user/login', function () {
    $Template = new Apps\Template;
    $Core = new Apps\Core;
    $Data = $Core->data;
    $email = $Data->email;
    $password = md5($Data->password . encrypt_salt);

    $login = $Core->UserLogin($email, $password);
    if ($login->id) {
        $Template->authorize($login->id);
        $Template->store("accid", $login->id);
        $Template->setError('', 'success', "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError('Login Failed!!! check credentials and try again', 'danger', "/login");
    $Template->redirect("/login");
}, 'POST');


$Route->add('/users/p2p/send', function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $email = $Data->email;
    $amount = $Data->amount;
    $sender_id = $Data->id;
    $sql = "SELECT * FROM `user` WHERE `email`='$email' OR `id`= '$email'";
    $sender = $Core->GetUserInfo($sender_id);
    $reciever = mysqli_query($Core->dbCon, $sql);
    if ($reciever->num_rows) {
        $reciever = mysqli_fetch_object($reciever);
        $reciever_id = $reciever->id;
        if ($sender->balance >= $amount) {
            $sender_balance = $sender->balance - $amount;
            $reciever_balance = $reciever->balance + $amount;
            $Core->UpdateBalance($sender_id, $sender_balance);
            $Core->AddTransaction($sender_id, $amount, 'P2P', 'done');
            $Core->UpdateBalance($reciever_id, $reciever_balance);
            $Core->AddTransaction($reciever_id, $amount, 'P2P', 'done');
            $Template->setError("Transaction completed successfully", "success", "/dashboard");
            $Template->redirect("/dashboard");
        } else {
            $Template->setError("Your Balance is low", "warning", "/dashboard");
            $Template->redirect("/dashboard");
        }
    }
    $Template->setError("No Such Account", "warning", "/dashboard");
    $Template->redirect("/dashboard");
}, 'POST');
