<?php


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




//Post

$Route->add('/user/create-account', function () {
    $Template = new Apps\Template(auth_url);
    $Core = new Apps\Core;
    $Data = $Core->data;
    $email = $Data->email;
    $name = $Data->name;
    $ref_id = $Data->ref_id;
    $password = $Data->password;

    $created = $Core->CreateUser($email, $name, $ref_id, $password);
    if ($created) {
        $Template->authorize($created);
        $Login = $Core->GetUserInfo($created);
        $Mailer = new Apps\Emailer();
        $EmailTemplate = new Apps\EmailTemplate('mails.welcome');
        $subject = "Welcome to Wipro Investments";
        $EmailTemplate->subject = $subject;
        $EmailTemplate->name = $Login->name;
        $EmailTemplate->mailbody = "Right choice you made, we are sending our hearts to you for your trust in our services";
        $Mailer->subject = $subject;
        $Mailer->SetTemplate($EmailTemplate);
        $Mailer->toEmail = $Login->email;
        $Mailer->send();
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
    $password = $Data->password;

    $login = $Core->UserLogin($email, $password);
    if ($login) {
        $Template->authorize($login);
        $Login = $Core->GetUserInfo($login);
        $Template->store("accid", $login);
        $Core->SendMail($Login->email, $Login->name);
        $Template->setError('Login Successful', 'success', "/dashboard");
        $Template->redirect("/dashboard");
    }
    $Template->setError('Login Failed!!! check credentials and try again', 'danger', "/login");
    $Template->redirect("/login");
}, 'POST');
