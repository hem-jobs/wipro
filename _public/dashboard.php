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
$Route->add("/dashboard/profile", function () {
}, "GET");
