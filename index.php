<?php


define('DOT', '.');
require_once DOT . "/bootstrap.php";

//Home page//
$Route->add('/crypto/', function () {
    
    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title","Wipro Home");

    $Template->render("home");

}, 'GET');


//Home page//

// Dashboard routes //

$Route->add('/crypto/dashboard', function () {
    
    $Template = new Apps\Template(auth_url);
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title","Wipro Dashboard");

    $Template->render("dashboard.index");

}, 'GET');

//Pages dynamic route//

$Route->add('/crypto/{page}', function ($page) {
    
    $Template = new Apps\Template;
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title","Wipro ".ucfirst($page));

    $Template->render("pages.{$page}");

}, 'GET');





//Logout Sessions//
$Route->add(
    '/auth/logout',
    function () {
        $Template = new Apps\Template;
        $Template->expire();
        $Template->cleanAll(session_delete_timout);
        $Template->redirect(auth_url);
    },
    'GET'
);
//Logout Sessions//



$Route->run('/');
