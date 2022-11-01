<?php


$Route->add('/crypto/invest/{package}', function ($package) {
    $Template = new Apps\Template(auth_url);
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign("title", "Wipro ". ucfirst($package));
    $Template->assign("package", ucfirst($package));
    $Template->render("dashboard.investments");
    
    
}, "GET");
