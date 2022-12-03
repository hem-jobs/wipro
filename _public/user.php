<?php

use Apps\Template;
use Apps\Core;

$Route->add('/login', function () {

    $Template = new Template;
    if ($Template->storage('accid')) {
        $Template->redirect("/dashboard");
    }
    $Template->assign("title", "Wipro Login");

    $Template->render("pages.login");
}, 'GET');

$Route->add('/register/{id}', function ($id) {

    $Template = new Template;
    $Template->assign("title", "Wipro Register");
    $Template->assign("ref_id", $id);
    $Template->render("pages.register");
}, 'GET');


$Route->add('/register', function () {

    $Template = new Template;
    if ($Template->storage('accid')) {
        $Template->redirect("/dashboard");
    }
    $Template->assign("title", "Wipro Register");
    $Template->render("pages.register");
}, 'GET');

$Route->add('/activate_user/{email}', function ($email) {
    $Template = new Template;
    $Core = new Core;
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
                $Core->sendMail($selected->email, $selected->name, "Verified", $subject, $message);
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
    $Template = new Template;
    $Core = new Core;
    $Data = $Core->data;
    $email = $Data->email;
    $name = $Data->name;
    $username = $Data->username;
    if (isset($Data->ref_id)) {
        $ref_id = $Core->ConvertIdUsername($Data->ref_id);
    } else {
        $ref_id = null;
    }
    $password = md5($Data->password . encrypt_salt);
    $repassword = md5($Data->repassword . encrypt_salt);
    if ($password == $repassword) {
        $hash = md5($Data->email . encrypt_salt);
        if ($ref_id) {

            $created = $Core->CreateUser($email, $name, $ref_id, $password, $hash, $username);
        } else {
            $created  = $Core->CreateUser2($email, $name, $password, $hash, $username);
        }
        if ($created) {
            $created = (int)$created;
            $Template->authorize($created);
            $Login = $Core->GetUserInfo($created);
            $subject = "Welcome to Wipro Investments";
            $caption = "Verification";
            $mailbody = "
            <div class=\"container-fluid background-secondary m-5\">
            <h1>Welcome to Wipro {$Login->name}</h1>
            </div>
            <div class=\"card\">
            <br />
            <h2>Your account creation was successful</h2>
            <h2 class=\"font-weight-bold\">Your username is: {$Login->username}</h2>
            <br />
            <p>Click on the link below to verify your email address.</p>
            <br />
            <a href=\"http://www.wiproinvestment.com/activate_user/$hash\" style=\"color:gold;font-size: 16px;border:1px solid blue; text-decoration: none; margin: 16px;\">Activate</a>
            <br />
            <br />
            </div>
            <p>Warm regards from the Technical Support Wipro Investments</p>
            <br/>
            ";
            $Core->sendMail($Login->email, $Login->name, $subject, $caption, $mailbody);


            if ($ref_id) {
                $referer = $Core->GetUserInfo($ref_id);
                $caption = "Referral";
                $subject = "You got a new referral";
                $mailbody = "
                <h2>A new user {$Login->name} signed up with your referral link</h2>
                <br />
                <p> You can reach out to them at <strong>{$Login->email}</strong></p>
                <br />
                <h5>Cheers to moving to financial freedom</h5>
                <br />
                <p>Encourage your referals to Invest and get a 10% referral income on their investment</p>
                ";
                $Core->sendMail($referer->email, $referer->name, $subject, $caption, $mailbody);
            }

            $Template->setError('Account created successfully', 'success', "/dashboard");
            $Template->redirect("/dashboard");
        }
        $Template->setError('Account creation failed, check email and username and ensure you are not reusing them', 'warning', "/register");
        $Template->redirect("/register");
    }
    $Template->setError('Passwords did not match', 'danger', "/register");
    $Template->redirect("/register");
}, 'POST');




$Route->add('/user/login', function () {
    $Template = new Template;
    $Core = new Core;
    $Data = $Core->data;
    $email = $Data->email;
    $password = md5($Data->password . encrypt_salt);

    $login = $Core->UserLogin($email, $password);
    if ($login) {
        if ($login->id) {
            $Template->authorize($login->id);
            $Template->store("accid", $login->id);
            $Template->setError('', 'success', "/dashboard");
            $Template->redirect("/dashboard");
        }
    }
    $Template->setError('Login Failed!!! check credentials and try again', 'danger', "/login");
    $Template->redirect("/login");
}, 'POST');


$Route->add('/users/p2p/send', function () {
    $Template = new Template(auth_url);
    $Core = new Core;
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


$Route->add("/messages/send", function () {
    $Template = new Template;
    $Core  = new Core;
    $Data = $Core->data;
    $email = $Data->email;
    $name = $Data->name;
    $message = $Data->message;

    $sql = "INSERT INTO `messages` (`email`, `name`, `message`) VALUES ('$email', '$name', '$message)";
    $send = mysqli_query($Core->dbCon, $sql);
    if ($send) {
        $Template->setError("Message sent successfully", "success", "/contact");
        $Template->redirect("/contact");
    }
    $Template->setError("Message not sent", "success", "/contact");
    $Template->redirect("/contact");
}, "GET");


$Route->add("/users/list", function () {
    $Template = new Template(auth_url);
    $Core = new Core;
    if ($Core->GetUserInfo($Template->storage("accid"))->role == 'admin') {
        $Template->addheader("dashboard.layouts.header");
        $Template->addfooter("dashboard.layouts.footer");
        $Template->assign("title", "Users");
        $Template->render("dashboard.users");
    } else {

        $Template->setError("Not authorized", "warning", "/dashboard");
        $Template->redirect("/dashboard");
    }
}, "GET");


$Route->add("/referals/view/{id}", function ($id) {
    $Template = new Template(auth_url);
    $Core = new Core;
    if ($Core->GetUserInfo($Template->storage("accid"))->role == 'admin') {
        $Template->addheader("dashboard.layouts.header");
        $Template->addfooter("dashboard.layouts.footer");
        $Template->assign("title", "Users");
        $Template->assign("ref_id", $id);
        $Template->render("dashboard.referals");
    } else {

        $Template->setError("Not authorized", "warning", "/dashboard");
        $Template->redirect("/dashboard");
    }
}, "GET");
