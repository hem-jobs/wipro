<?php

use Apps\Template;

define('DOT', '.');
require_once DOT . "/bootstrap.php";
require_once DOT . "/_public/user.php";
require_once DOT . "/_public/profiles.php";
include_once DOT . "/_public/investments.php";
include_once DOT . "/_public/dashboard.php";


//Home page//
$Route->add('/', function () {

    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Wipro Home");

    $Template->render("home");
}, 'GET');



//Home page//
$Route->add('/testmail', function () {

    $name = "Agu Chux";
    $body = "Welcome to";

    $EmailTemplate = new Apps\EmailTemplate('mail.default');
    $EmailTemplate->fullname = $name;
    $EmailTemplate->body = $body;

    $mailer = new Apps\Emailer();
    $mailer->SetTemplate($EmailTemplate);
    $mailer->toEmail = "obiefunamarcel@gmail.com";
    $mailer->toName = "Agu Chux";
    $mailer->fromEmail = "info@wiproinvestment.com";
    $mailer->fromName = "Wipro";

    $sent = $mailer->send();
    die($sent);
    
}, 'GET');


//Home page//



// Dashboard routes //



//Pages dynamic route//


$Route->add('/{page}', function ($page) {

    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Wipro " . ucfirst($page));
    $Template->render("pages.{$page}");
}, 'GET');





//Logout Sessions//
$Route->add(
    '/auth/logout',
    function () {
        $Template = new Apps\Template;
        $Template->expire();
        $Template->cleanAll(session_delete_timout);
        $Template->redirect("/");
    },
    'GET'
);
//Logout Sessions//



$Route->run('/');
