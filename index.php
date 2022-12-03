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
    $Template = new Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Wipro Home");
    $Template->render("home");
}, 'GET');


//Pages dynamic route//


$Route->add('/{page}', function ($page) {

    $Template = new Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Wipro " . ucfirst($page));
    $Template->render("pages.{$page}");
}, 'GET');



$Route->add("/test/mail", function () {

    $Core = new Apps\Core;
    $sent = $Core->sendMail("obiefunamarcel@gmail.com", "Marcel", "Test", "Test Mail", "Just a test");
    $Core->debug($sent);
}, "GET");

//Logout Sessions//
$Route->add(
    '/auth/logout',
    function () {
        $Template = new Template;
        $Template->expire();
        $Template->cleanAll(session_delete_timout);
        $Template->redirect("/");
    },
    'GET'
);
//Logout Sessions//



$Route->run('/');
